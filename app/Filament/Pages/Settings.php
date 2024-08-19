<?php

namespace App\Filament\Pages;

use App\Facades\WhatsAppAPI;
use App\Models\Setting;
use BaconQrCode\Encoder\QrCode;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Components\View;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Support\Enums\IconPosition;
use Filament\Support\Enums\IconSize;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;

class Settings extends Page implements HasForms
{
    use InteractsWithForms;

    public static ?string $title = 'Settings';
    public static ?string $navigationIcon = 'fluentui-settings-20-o';
    protected static string $view = 'filament.pages.setting';
    public ?array $data;
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Bank Setting')
                    ->icon('bx-wallet')
                    ->iconSize(IconSize::Large)
                    ->iconColor('primary')
                    ->schema([
                        TextInput::make('bank_name')->label('Bank Name'),
                        TextInput::make('bank_account')->label('Bank Account'),
                        TextInput::make('bank_account_name')->label('Bank Account Name'),
                        TextInput::make('amount')
                            ->prefix('Rp')
                            ->numeric()
                            ->label('Psikotest Price'),
                ])->columns(2),

                Section::make('Midtrans Setting')
                    ->icon('bx-wallet')
                    ->iconSize(IconSize::Large)
                    ->iconColor('primary')
                    ->schema([
                        TextInput::make('midtrans_server_key')
                            ->formatStateUsing(function (string $state) {
                                return $state ? '********' : null;
                            })
                            ->suffixAction(Actions\Action::make('reveal')
                                ->label('Midtrans Server Key')
                                ->icon(function (Get $get){
                                    return $get('midtrans_server_key_revealed') ? 'bx-lock-open-alt' : 'heroicon-o-eye';
                                })
                                ->disabled(fn (Get $get) => $get('midtrans_server_key_revealed'))
                                ->form([
                                    TextInput::make('password')
                                        ->label('Enter your password to reveal the key')
                                        ->required()
                                        ->password()
                                ])
                                ->action(function (array $data, Set $set){
                                    if (Hash::check($data['password'], auth()->user()->password)) {
                                        $set('midtrans_server_key', decrypt(Setting::where('name', 'midtrans_server_key')->first()->value));
                                        $set('midtrans_server_key_revealed', true);
                                    }else{
                                        Notification::make()
                                            ->body('Password is incorrect')
                                            ->danger()
                                            ->send();
                                    }
                                })
                            )
                            ->label('Midtrans Server Key'),
                        TextInput::make('midtrans_client_key')
                            ->formatStateUsing(function (string $state) {
                                return $state ? '********' : null;
                            })
                            ->suffixAction(Actions\Action::make('reveal')
                                ->label('Midtrans Client Key')
                                ->icon(function (Get $get){
                                    return $get('midtrans_client_key_revealed') ? 'bx-lock-open-alt' : 'heroicon-o-eye';
                                })
                                ->disabled(fn (Get $get) => $get('midtrans_client_key_revealed'))
                                ->form([
                                    TextInput::make('password')
                                        ->label('Enter your password to reveal the key')
                                        ->required()
                                        ->password()
                                ])
                                ->form([
                                    TextInput::make('password')
                                        ->label('Enter your password to reveal the key')
                                        ->required()
                                        ->password()
                                ])
                                ->action(function (array $data, Set $set){
                                    if (Hash::check($data['password'], auth()->user()->password)) {
                                        $set('midtrans_client_key', decrypt(Setting::where('name', 'midtrans_client_key')->first()->value));
                                        $set('midtrans_client_key_revealed', true);
                                    }else{
                                        Notification::make()
                                            ->title('Error')
                                            ->danger()
                                            ->body('Password is incorrect')
                                            ->send();
                                    }
                                })
                            )
                            ->label('Midtrans Client Key'),
                        Select::make('midtrans_environment')
                            ->options([
                                'sandbox' => 'Sandbox',
                                'production' => 'Production',
                            ])
                            ->native(false)
                            ->label('Midtrans Environment'),
                        Toggle::make('midtrans_enabled')
                            ->columnSpanFull()
                            ->label('Midtrans Enabled'),
                ])->columns(2),

                Section::make('Whatsapp Notification Setting')
                    ->icon('gmdi-whatsapp')
                    ->iconSize(IconSize::Large)
                    ->iconColor('success')
                    ->iconPosition(IconPosition::After)
                    ->schema([
                        Placeholder::make('')->content(function (){
                            $github = 'https://github.com/chrishubert/whatsapp-api';
                            return new HtmlString("Check the documentation <strong><a href='{$github}' target='_blank'>Whatsapp API</a></strong> to get the API URL and Token for Whatsapp Notification. Make sure to use the API URL with the correct format");
                        })->columnSpanFull(),
                        TextInput::make('whatsapp_api_url')
                            ->placeholder('https://wa-api.kelompoktiga.my.id/')
                            ->label('Whatsapp API URL'),
                        TextInput::make('whatsapp_api_token')
                            ->hint('If your API Token is empty, you can leave it blank')
                            ->label('Whatsapp API Token'),
                        TextInput::make('whatsapp_api_session')
                            ->live(debounce: 500)
                            ->afterStateUpdated(function (Get $get, Set $set){
                                if ($get('whatsapp_api_session')) {
                                    $status = WhatsAppAPI::getSessionStatus($get('whatsapp_api_session'));
                                    if($status['success']) {
                                        Notification::make()
                                            ->body('Whatsapp API Session is valid')
                                            ->success()
                                            ->send();
                                        $set('whatsapp_api_session_status', true);
                                    }else{
                                        Notification::make()
                                            ->body('Whatsapp API Session is invalid, ' . $status['message'])
                                            ->danger()
                                            ->send();
                                        $set('whatsapp_api_session_status', false);
                                    }
                                }
                            })
                            ->label('Whatsapp API Session'),
                        Section::make('Template')
                            ->columns(2)
                            ->schema([
                                Textarea::make('whatsapp_template_after_filled_personal_information')
                                    ->rows(20)
                                    ->label('Notification After Filled Personal Information'),
                                Textarea::make('whatsapp_template_after_requested_exam')
                                    ->rows(20)
                                    ->label('Notification After Requested Exam'),
                                Textarea::make('whatsapp_template_after_approved_exam')
                                    ->rows(20)
                                    ->label('Notification After Approved Exam'),
                                Textarea::make('whatsapp_template_after_rejected_exam')
                                    ->rows(20)
                                    ->label('Notification After Rejected Exam'),
                                Textarea::make('whatsapp_template_warning_exam_about_to_expire')
                                    ->rows(20)
                                    ->label('Warning Exam About to Expire'),
                                Textarea::make('whatsapp_template_warning_exam_expired')
                                    ->rows(20)
                                    ->label('Warning Exam Expired'),
                                Textarea::make('whatsapp_template_warning_exam_rejected')
                                    ->rows(20)
                                    ->label('Notification Exam Result Is Invalid'),
                                Textarea::make('whatsapp_template_warning_exam_approved')
                                    ->rows(20)
                                    ->label('Notification Exam Result Is Valid'),
                            ])
                            ->visible(function (Get $get){
                                $session = WhatsAppAPI::getSessionStatus($get('whatsapp_api_session'));
                                return $session['success'] && $session['state'] == 'CONNECTED';
                            }),
                        Fieldset::make('Whatsapp API Session')
                            ->schema([
                                View::make('filament.qr')
                                    ->label('Session Status')
                                    ->viewData([
                                        'code' => $this->data['code'] ?? null
                                    ])
                                    ->visible(fn (Get $get) => $get('created_session'))
                                    ->columnSpanFull(),
                                Actions::make([
                                    Actions\Action::make('create')
                                        ->label('Create Session')
                                        ->action(function (Get $get, Set $set){
                                            $session = WhatsAppAPI::startSession($get('whatsapp_api_session'));
                                            if ($session['success']) {
                                                Notification::make()
                                                    ->body('Whatsapp API Session created successfully')
                                                    ->success()
                                                    ->send();
                                                $code = WhatsAppAPI::getSessionQRCode($get('whatsapp_api_session'));
                                                if ($code['success']) {
                                                    $this->data['code'] = $code['qr'];
                                                    $set('created_session', true);
                                                }
                                                $set('created_session', false);
                                            }else{
                                                if (array_key_exists('error', $session)) {
                                                    $error = $session['error'];
                                                }else{
                                                    $error = $session['message'];
                                                }
                                                Notification::make()
                                                    ->body('Failed to create Whatsapp API Session, ' . $get('whatsapp_api_session') . " " . $error)
                                                    ->danger()
                                                    ->send();
                                                $set('created_session', false);
                                            }
                                        }),
                                    Actions\Action::make('refresh')
                                        ->color('success')
                                        ->label('Refresh QR Code')
                                        ->action(function (Get $get, Set $set){
                                            $session_status = WhatsAppAPI::getSessionStatus($get('whatsapp_api_session'));
                                            if($session_status['success'] && $session_status['state'] == 'CONNECTED'){
                                                Notification::make()
                                                    ->body('Whatsapp API Session is already connected')
                                                    ->success()
                                                    ->send();
                                            }else{
                                                $code = WhatsAppAPI::getSessionQRCode($get('whatsapp_api_session'));
                                                if ($code['success']) {
                                                    $this->data['code'] = $code['qr'];
                                                    $set('created_session', true);
                                                }else{
                                                    if (array_key_exists('error', $code)) {
                                                        $error = $code['error'];
                                                    }else{
                                                        $error = $code['message'];
                                                    }
                                                    Notification::make()
                                                        ->body('Failed to refresh QR Code, ' . $get('whatsapp_api_session') . " " . $error)
                                                        ->danger()
                                                        ->send();
                                                    $set('created_session', false);
                                                }
                                            }
                                        }),
                                    Actions\Action::make('delete')
                                        ->label('Delete Session')
                                        ->requiresConfirmation()
                                        ->modalIcon('gmdi-whatsapp')
                                        ->modalHeading('Delete Whatsapp API Session')
                                        ->modalDescription('Are you sure you want to delete this session?')
                                        ->modalSubmitActionLabel('Yes, delete it')
                                        ->color('danger')
                                        ->action(function (Get $get, Set $set){
                                            $session = WhatsAppAPI::terminateSession($get('whatsapp_api_session'));
                                            if ($session['success']) {
                                                Notification::make()
                                                    ->body('Whatsapp API Session deleted successfully')
                                                    ->success()
                                                    ->send();
                                                $set('whatsapp_api_session_status', null);
                                            }else{
                                                if (array_key_exists('error', $session)) {
                                                    $error = $session['error'];
                                                }else{
                                                    $error = $session['message'];
                                                }
                                                Notification::make()
                                                    ->body('Failed to delete Whatsapp API Session, ' . $get('whatsapp_api_session') . " " . $error)
                                                    ->danger()
                                                    ->send();
                                            }
                                        })
                                ]),

                            ]),
                        Toggle::make('whatsapp_api_enabled')
                            ->columnSpanFull()
                            ->label('Enable Whatsapp Notification'),
                ])->columns(2),
                Actions::make([
                    Actions\Action::make('save')
                        ->label('Save Setting')
                        ->action(function() {
                            $fields = $this->data;
                            foreach ($fields as $key => $value) {
                                $setting = \App\Models\Setting::where('name', $key)->first();
                                $midtrans = ['midtrans_server_key', 'midtrans_client_key'];

                                if (in_array($key, $midtrans) && !Str::of($value)->contains('*') && $setting) {
                                    $setting->value = encrypt($value);
                                    $setting->save();
                                } elseif ($setting && !Str::of($value)->contains('*')) {
                                    $setting->value = $value;
                                    $setting->save();
                                } elseif (!Str::of($value)->contains('*')) {
                                    $setting = new Setting();
                                    $setting->name = $key;
                                    $setting->value = $value;
                                    $setting->save();
                                }
                            }
                            Notification::make()
                                ->body('Setting saved successfully')
                                ->success()
                                ->send();
                        })
                ])
            ])
            ->statePath('data');
    }

    function mount(){
        $settings = \App\Models\Setting::all()->pluck('value', 'name');
        $this->form->fill($settings->toArray());
    }
}
