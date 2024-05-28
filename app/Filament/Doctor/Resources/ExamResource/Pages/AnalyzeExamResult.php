<?php

namespace App\Filament\Doctor\Resources\ExamResource\Pages;

use App\Filament\Doctor\Resources\ExamResource;
use App\Filament\Doctor\Widgets\ClinicalScale;
use App\Filament\Doctor\Widgets\ContentScalesProfile;
use App\Filament\Doctor\Widgets\ExamResultTable;
use App\Filament\Doctor\Widgets\PSY5;
use App\Filament\Doctor\Widgets\RestructuredClinicalScale;
use App\Filament\Doctor\Widgets\Supplementary;
use App\Filament\Doctor\Widgets\Validity;
use App\Models\Exam;
use App\Models\ExamResult;
use Filament\Actions\Concerns\CanSubmitForm;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Saade\FilamentAutograph\Forms\Components\Enums\DownloadableFormat;
use Saade\FilamentAutograph\Forms\Components\SignaturePad;

class AnalyzeExamResult extends EditRecord implements HasForms
{
    use InteractsWithRecord;

    protected static string $resource = ExamResource::class;

    protected static string $view = 'filament.doctor.resources.exam-result-resource.pages.analyze-exam-result';

    protected static ?string $title = 'Analyze Exam Result';

    public ?array $data = [];

    public function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Exam Information')->schema([
                TextInput::make('name')->disabled(),
                TextInput::make('email')->disabled(),
                Textarea::make('purpose')
                    ->columnSpanFull()
                    ->disabled(),
                TextInput::make('start_time')->disabled(),
                TextInput::make('end_time')->disabled(),
                RichEditor::make('notes')
                    ->columnSpanFull(),
                RichEditor::make('conclusion')
                    ->required()
                    ->columnSpanFull(),
                SignaturePad::make('signature')
                    ->visible(fn (Model $record) => $record->hasExamResult())
                    ->downloadable()                    // Allow download of the signature (defaults to false)
                    ->downloadableFormats([             // Available formats for download (defaults to all)
                        DownloadableFormat::PNG,
                        DownloadableFormat::JPG,
                        DownloadableFormat::SVG,
                    ])
                    ->downloadActionDropdownPlacement('center')
            ])
                ->columns(2)
            ->footerActions([
                Action::make('submit')
                    ->icon('bx-stats')
                    ->color('success')
                    ->label('Generate Report')
                    /* @var Exam $record */
                    ->action(function (Model $record){
                        $exam_result = ExamResult::where('exam_id', $record->id)->first();
                        if ($exam_result){
                            Notification::make()
                                ->body('Report sudah pernah di-generate sebelumnya')
                                ->title('Report Sudah Ada')
                                ->danger()
                                ->send();
                            $this->halt();
                        }

                        try {
                            $scale = $record->analyze();
                            if ($scale->CNSValidity()) {
                                Notification::make()
                                    ->body('Exam tidak dapat dianalisis karena CNSValidity tidak valid, karena jumlah soal yang tidak dijawab >= 30 soal')
                                    ->title('Exam Tidak Valid')
                                    ->danger()
                                    ->send();
                                $this->halt();
                            }
                        }catch (\Exception $e){
                            Notification::make()
                                ->body($e->getMessage())
                                ->title('Error')
                                ->danger()
                                ->send();
                            $this->halt();
                        }

                        dispatch(function () use ($record, $scale, $exam_result) {
                            $method_excludes = [
                                'CNSValidity',
                                'toTF',
                                '__construct',
                                'make'
                            ];

                            $public_methods = array_filter(
                                get_class_methods($scale),
                                fn($method) => !in_array($method, $method_excludes)
                            );

                            $output = [];

                            foreach ($public_methods as $method) {
                                $output[] = [
                                    'category' => Str::snake($method),
                                    'sub_categories' => $scale->$method()
                                ];
                            }

                            if (!$exam_result) {
                                foreach ($output as $data) {
                                    logger($data['category']);
                                    foreach ($data['sub_categories'] as $key => $sub_category) {
                                        ExamResult::create([
                                            'exam_id' => $record->id,
                                            'category' => $data['category'],
                                            'sub_category' => $key,
                                            'raw_score' => $sub_category['raw_score'],
                                            't_score' => $sub_category['t_score'],
                                            'k_score' => $sub_category['k_score'],
                                        ]);
                                    }
                                }
                            }
                        });
                    })
                    ->visible(fn (Model $record) => !$record->hasExamResult()),
                Action::make('validate')
                    ->icon('bx-check')
                    ->color('success')
                    ->label('Validate Report')
                    ->action(function (Model $record){
                        $exam_result = ExamResult::where('exam_id', $record->id)->get();

                        if ($exam_result->isEmpty()){
                            Notification::make()
                                ->body('Report belum di-generate')
                                ->title('Report Belum Ada')
                                ->danger()
                                ->send();
                            $this->halt();
                        }

                        if ($this->data['conclusion'] === null){
                            Notification::make()
                                ->body('Kesimpulan belum diisi')
                                ->title('Kesimpulan Belum Ada')
                                ->danger()
                                ->send();
                            $this->halt();
                        }elseif ($this->data['signature'] === null){
                            Notification::make()
                                ->body('Tanda tangan belum diisi')
                                ->title('Tanda Tangan Belum Ada')
                                ->danger()
                                ->send();
                            $this->halt();
                        }

                        $record->validated = true;
                        $record->conclusion = $this->data['conclusion'];
                        $record->signature = $this->data['signature'];
                        $record->note = $this->data['notes'];
                        $record->save();

                        Notification::make()
                            ->body('Report berhasil divalidasi')
                            ->title('Report Validated')
                            ->success()
                            ->send();
                    })->visible(fn (Model $record) => $record->hasExamResult()),
                Action::make('invalidate')
                    ->icon('bx-x')
                    ->color('danger')
                    ->label('Invalidate Report')
                    ->action(function (Model $record){
                        $exam_result = ExamResult::where('exam_id', $record->id)->get();
                        if ($exam_result->isEmpty()){
                            Notification::make()
                                ->body('Report belum di-generate')
                                ->title('Report Belum Ada')
                                ->danger()
                                ->send();
                            $this->halt();
                        }

                        $record->validated = false;
                        $record->conclusion = null;
                        $record->signature = null;
                        $record->note = null;
                        $record->save();

                        Notification::make()
                            ->body('Report berhasil di-invalidate')
                            ->title('Report Invalidated')
                            ->success()
                            ->send();
                    })->visible(fn (Model $record) => $record->hasExamResult()),
            ])
        ])->statePath('data');
    }

    public function mount(int|string $record): void
    {
        $this->record = $this->resolveRecord($record);
        $this->form->fill([
            'name' => $this->record->user->name,
            'email' => $this->record->user->email,
            'purpose' => $this->record->purpose,
            'start_time' => $this->record->start_time,
            'end_time' => $this->record->end_time,
            'notes' => $this->record->note,
            'conclusion' => $this->record->conclusion,
            'signature' => $this->record->signature,
        ]);
    }

    protected function getFooterWidgets(): array
    {
        return $this->record->hasExamResult() ? [
            Validity::make(),
            ClinicalScale::make(),
            RestructuredClinicalScale::make(),
            ContentScalesProfile::make(),
            Supplementary::make(),
            PSY5::make(),
            ExamResultTable::make()
        ] : [];
    }
}
