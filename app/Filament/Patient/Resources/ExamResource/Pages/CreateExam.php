<?php

namespace App\Filament\Patient\Resources\ExamResource\Pages;

use App\Filament\Patient\Resources\ExamResource;
use App\Models\Payment;
use Faker\Provider\Text;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\DB;
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
        ]);
    }

    function midtrans($pdf_url): void
    {
        $this->sendNotification(Payment::midtrans($pdf_url));
    }

    function sendNotification($trx): Notification
    {
        $notification = match ($trx) {
            'settlement', 'capture' => Notification::make()
                ->title('Pembayaran Berhasil')
                ->success()
                ->body('Pembayaran anda telah berhasil dilakukan. Silahkan tunggu konfirmasi selanjutnya.'),
            'challenge' => Notification::make()
                ->title('Pembayaran Ditahan')
                ->success()
                ->body('Pembayaran anda ditahan oleh FDS. Silahkan hubungi kami untuk informasi lebih lanjut.'),
            'deny' => Notification::make()
                ->title('Pembayaran Ditolak')
                ->danger()
                ->body('Pembayaran anda ditolak oleh midtrans. Silahkan hubungi kami untuk informasi lebih lanjut.'),
            'expire' => Notification::make()
                ->title('Pembayaran Kadaluarsa')
                ->danger()
                ->body('Pembayaran anda telah kadaluarsa. Silahkan hubungi kami untuk informasi lebih lanjut.'),
            'cancel' => Notification::make()
                ->title('Pembayaran Dibatalkan')
                ->danger()
                ->body('Pembayaran anda telah dibatalkan. Silahkan hubungi kami untuk informasi lebih lanjut.'),
            'pending' => Notification::make()
                ->title('Pembayaran Pending')
                ->info()
                ->body('Silahkan selesaikan pembayaran anda.'),
            default => Notification::make()
                ->title('Pembayaran Gagal')
                ->danger()
                ->body('Pembayaran anda gagal. Silahkan hubungi kami untuk informasi lebih lanjut.'),
        };

        return $notification->send();
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
                        ->afterStateUpdated(function (Get $get, Livewire $livewire, Set $set){
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
                                $livewire->js(<<<JS
                                    snap.pay('$snap_code', {
                                        onSuccess: function(result){
                                            \$wire.midtrans(result.pdf_url);
                                        }
                                    });
                                JS
                                );
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
                                ->required()
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

        $this->data['user_id'] = auth()->id();
        $this->data['payment']['user_id'] = auth()->id();

        $data['user_id'] = auth()->id();
        $data['payment']['user_id'] = auth()->id();

        if ($data['method'] == 'midtrans'){
            $trx = Payment::latestMidtrans();
            if ($trx) {
                if ($trx->status != 'paid') {
                    $this->sendNotification($trx->status);
                    $this->halt();
                }
            }else{
                Notification::make()
                    ->title('Pembayaran Gagal')
                    ->danger()
                    ->body('Pembayaran anda gagal. Data transaksi tidak ditemukan, silahkan ulangi proses pembayaran.')
                    ->send();
                $this->halt();
            }
            $data['payment_id'] = $trx->id;
            $this->data['payment_id'] = $trx->id;
        }

        return $data;
    }

    function afterCreate(){
        if ($this->data['method'] == 'manual'){
            /* @var \App\Models\Exam $record */
            $record = $this->record;
            $record->payment->update([
                'user_id' => auth()->id(),
            ]);
        }
    }

}
