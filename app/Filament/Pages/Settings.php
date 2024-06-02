<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Hash;
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
                    ->schema([
                        TextInput::make('midtrans_server_key')
                            ->formatStateUsing(function (string $state) {
                                return $state ? '********' : null;
                            })
                            ->suffixAction(Actions\Action::make('reveal')
                                ->label('Midtrans Server Key')
                                ->icon('heroicon-o-eye')
                                ->form([
                                    TextInput::make('password')
                                        ->label('Enter your password to reveal the key')
                                        ->required()
                                        ->password()
                                ])
                                ->action(function (array $data, Set $set){
                                    if (Hash::check($data['password'], auth()->user()->password)) {
                                        $set('midtrans_server_key', decrypt(Setting::where('name', 'midtrans_server_key')->first()->value));
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
                                ->icon('heroicon-o-eye')
                                ->form([
                                    TextInput::make('password')
                                        ->label('Enter your password to reveal the key')
                                        ->required()
                                        ->password()
                                ])
                                ->action(function (array $data, Set $set){
                                    if (Hash::check($data['password'], auth()->user()->password)) {
                                        $set('midtrans_client_key', decrypt(Setting::where('name', 'midtrans_client_key')->first()->value));
                                    }else{
                                        Notification::make()
                                            ->body('Password is incorrect')
                                            ->danger()
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
                            ->columnSpanFull()
                            ->native(false)
                            ->label('Midtrans Environment'),
                        Toggle::make('midtrans_enabled')
                            ->label('Midtrans Enabled'),
                ])->columns(2),

                Section::make('Whatsapp Notification Setting')
                    ->schema([
                        TextInput::make('whatsapp_api_url')->label('Whatsapp API URL'),
                        TextInput::make('whatsapp_api_token')->label('Whatsapp API Token'),
                ])->columns(2),
                Actions::make([
                    Actions\Action::make('save')
                        ->label('Save Setting')
                        ->action(function(){
                            $fields = $this->data;
                            foreach ($fields as $key => $value) {
                                $setting = \App\Models\Setting::where('name', $key)->first();
                                $midtrans = ['midtrans_server_key', 'midtrans_client_key'];

                                if (in_array($key, $midtrans) && !Str::of($value)->contains('*')) {
                                    if ($setting) {
                                        $setting->value = encrypt($value);
                                        $setting->save();
                                    }
                                    continue;
                                }

                                if ($setting && !Str::of($value)->contains('*')) {
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
