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
use Filament\Support\Exceptions\Halt;
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
                    ->visible(fn (Model $record) => $record->hasExamResult())
                    ->columnSpanFull(),
                RichEditor::make('conclusion')
                    ->visible(fn (Model $record) => $record->hasExamResult())
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
                    ->color(function (Model $record) {
                        return $record->hasExamResult() ? 'danger' : 'info';
                    })
                    ->label(function (?Model $record) {
                        return $record->hasExamResult() ? 'Re-analyze Exam' : 'Analyze Exam';
                    })
                    /* @var Exam $record */
                    ->action(function (Model $record){
                        $exam_result = ExamResult::where('exam_id', $record->id)->first();

                        try {
                            $scale = $record->analyze();
                            if (!$scale->CNSValidity()) {
                                Notification::make()
                                    ->body('Exam tidak dapat dianalisis karena CNSValidity tidak valid, karena jumlah soal yang tidak dijawab >= 30 soal')
                                    ->title('Exam Tidak Valid')
                                    ->danger()
                                    ->send();
                                $this->halt();
                            }
                        }catch (\Exception $e){
                            if (!($e instanceof Halt)){
                                Notification::make()
                                    ->body($e->getMessage())
                                    ->title('Error')
                                    ->danger()
                                    ->send();
                                $this->halt();
                            }
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
                            }else{
                                foreach ($output as $data) {
                                    foreach ($data['sub_categories'] as $key => $sub_category) {
                                        $exam_result = ExamResult::where('exam_id', $record->id)
                                            ->where('category', $data['category'])
                                            ->where('sub_category', $key)
                                            ->first();

                                        $exam_result->raw_score = $sub_category['raw_score'];
                                        $exam_result->t_score = $sub_category['t_score'];
                                        $exam_result->k_score = $sub_category['k_score'];
                                        $exam_result->save();
                                    }
                                }
                            }

                            $record->doctor()->notify(
                                Notification::make()
                                    ->body(function() use ($record) {
                                        return "Report pada {$record->user->name} berhasil di-generate, silahkan cek pada halaman report";
                                    })
                                    ->title('Analisis Selesai')
                                    ->success()
                                    ->toDatabase()
                            );
                        });
                    }),
                Action::make('validate')
                    ->icon('bx-check')
                    ->color('success')
                    ->label('Validate Report')
                    /* @var Exam $record */
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

                        $record->user()->notify(
                            Notification::make()
                                ->body(function() use ($record) {
                                    return "Selamat, report psikotes anda telah divalidasi oleh {$record->doctor->name}. Silahkan unduh sertifikat pada halaman exam";
                                })
                                ->title('Psikotes Anda Telah Divalidasi')
                                ->success()
                                ->toDatabase()
                        );
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
