<?php

namespace App\Filament\Patient\Resources\ExamResource\Pages;

use App\Filament\Patient\Resources\ExamResource;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Get;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\HtmlString;
use Livewire\Component as Livewire;
use Midtrans\Snap;

class CreateExam extends CreateRecord
{
    use CreateRecord\Concerns\HasWizard;
    protected static string $resource = ExamResource::class;

    protected static bool $canCreateAnother = false;


    public function mount(): void
    {
        $this->form->fill([
            'name' => auth()->user()->name,
            'user_id' => auth()->id(),
        ]);
    }

    public function getSteps(): array
    {
        return [
            Wizard\Step::make('Isi Data')
                ->icon('heroicon-o-user-circle')
                ->schema([
                    TextInput::make('name')
                        ->label('Nama Pemohon')
                        ->disabled(),
                    Textarea::make('purpose')
                        ->helperText('Tuliskan keperluan anda mengikuti psikotest MMPI-2, seperti keperluan pekerjaan, pendidikan, atau lainnya.')
                        ->label('Keperluan Mengikuti Psikotest MMPI-2')
                        ->required(),
                    Checkbox::make('is_agree')
                        ->required()
                        ->label(new HtmlString('Saya setuju dengan <a href="#"><strong>Syarat dan Ketentuan</strong></a> yang berlaku.'))
                ]),
            Wizard\Step::make('Pembayaran')
                ->icon('heroicon-o-credit-card')
                ->schema([
                    Select::make('method')
                        ->label('Metode Pembayaran')
                        ->options([
                            'cash' => 'Transfer Bank Manual',
                            'midtrans' => 'Midtrans',
                        ])
                        ->native(false)
                        ->live()
                        ->suffixIcon('heroicon-o-currency-dollar')
                        ->required()
                        ->afterStateUpdated(function (Get $get, Livewire $livewire){
                            if ($get('method') === 'midtrans') {
                                $params = [
                                    'transaction_details' => [
                                        'order_id' => rand(),
                                        'gross_amount' => 10000,
                                    ],
                                    'customer_details' => [
                                        'first_name' => auth()->user()->name,
                                        'email' => auth()->user()->email,
                                    ]
                                ];
                                $snap_code = Snap::getSnapToken($params);
                                $livewire->js('snap.pay("'.$snap_code.'");');
                            }
                        }),
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
                                //->required()
                        ])
                        ->visible(fn (Get $get) => $get('method') === 'cash')
                        ->dehydrated(),
                ]),
            Wizard\Step::make('Selesai')
                ->icon('heroicon-o-check-circle')
                ->schema([
                    Placeholder::make('desc')
                        ->label('Terima kasih')
                        ->content('Terima kasih telah mengajukan permohonan psikotest MMPI-2. Permohonan anda akan segera diproses oleh dokter kami. Silahkan tunggu konfirmasi selanjutnya melalui email atau telepon.')
                        ->columnSpanFull()
                ])
        ];
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {

        $data['user_id'] = auth()->id();
        $data['payment']['user_id'] = auth()->id();

        //dd($data);

        return $data;
    }
}
