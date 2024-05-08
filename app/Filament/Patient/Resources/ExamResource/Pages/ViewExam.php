<?php

namespace App\Filament\Patient\Resources\ExamResource\Pages;

use App\Filament\Patient\Resources\ExamResource;
use Filament\Actions;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Pages\ViewRecord;

class ViewExam extends ViewRecord
{
    protected static string $resource = ExamResource::class;
    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }

    public static function canAccess(array $parameters = []): bool
    {
        return $parameters['record']->isExamBelongToMe();
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $payment = $this->getRecord()->payment;
        $data['name'] = $this->getRecord()->user->name;

        return $data;
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            Section::make()->schema([
                TextInput::make('name')
                    ->label('Nama Pemohon'),
                Textarea::make('purpose')
                    ->helperText('Tuliskan keperluan anda mengikuti psikotest MMPI-2, seperti keperluan pekerjaan, pendidikan, atau lainnya.')
                    ->label('Keperluan Mengikuti Psikotest MMPI-2')
                    ->required()
            ]),
            Section::make('Formulir Pembayaran')
                ->relationship('payment')
                ->schema([
                    TextInput::make('bank_name')
                        ->label('Nama Bank')
                        ->helperText('Contoh: BCA, BNI, BRI, Mandiri, dll.')
                        ->required(),
                    TextInput::make('bank_account_name')
                        ->label('Nama Pengirim')
                        ->required(),
                    TextInput::make('bank_account')
                        ->label('Nomor Rekening Pengirim')
                        ->placeholder('1234567890')
                        ->required(),
                    FileUpload::make('proof')
                        ->label('Bukti Pembayaran')
                        ->image()
                        ->imageEditor()
                        ->required()
                ])
            ->visible(fn () => $this->getRecord()->payment->isManual()),
            Section::make('Status Pembayaran')
                ->relationship('payment')
                ->schema([
                    TextInput::make('status')
                        ->label('Status Pembayaran')
                        ->disabled(),
                    TextInput::make('provider_payment_method')
                        ->label('Metode Pembayaran')
                        ->disabled(),
                    TextInput::make('description')
                        ->label('Deskripsi')
                        ->disabled(),
                ])
        ]);
    }
}
