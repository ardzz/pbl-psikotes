<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\Actions;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

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
                            ->label('Midtrans Server Key'),
                        TextInput::make('midtrans_client_key')
                            ->formatStateUsing(function (string $state) {
                                return $state ? '********' : null;
                            })
                            ->label('Midtrans Client Key'),
                        Select::make('midtrans_environment')
                            ->options([
                                'sandbox' => 'Sandbox',
                                'production' => 'Production',
                            ])
                            ->native(false)
                            ->label('Midtrans Environment'),
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
                                if ($setting) {
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
