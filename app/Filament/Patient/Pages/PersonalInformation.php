<?php

namespace App\Filament\Patient\Pages;

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
use Filament\Tables\Filters\SelectFilter;
use function Laravel\Prompts\search;

class PersonalInformation extends Page implements HasForms
{
    use InteractsWithForms;

    public static ?string $title = 'Personal Information';
    public static ?string $navigationIcon = 'css-profile';
    protected static string $view = 'filament.patient.pages.personal-information';
    public ?array $data;
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    TextInput::make('nik')
                        ->maxLength(255)
                        ->label('NIK'),
                    TextInput::make('occupation')
                        ->maxLength(255)
                        ->label('Pekerjaan'),
                    DatePicker::make('birthdate')
                        ->label('Tanggal Lahir'),
                    TextInput::make('phone_number')
                        ->tel()
                        ->maxLength(255)
                        ->label('Nomor Telepon'),
                    TextInput::make('religion')
                        ->maxLength(255)
                        ->label('Agama'),
                    Select::make('marital_status')
                        ->native(false)
                        ->options([
                            'single' => 'Belum Menikah',
                            'married' => 'Menikah',
                            'divorced' => 'Cerai',
                            'widowed' => 'Duda/Janda'
                        ])
                        ->label('Status Pernikahan'),
                    Select::make('education')
                        ->native(false)
                        ->options([
                            'elementary' => 'SD',
                            'junior_high' => 'SMP',
                            'senior_high' => 'SMA',
                            'diploma' => 'Diploma',
                            'bachelor' => 'Sarjana',
                            'master' => 'Magister',
                            'doctor' => 'Doktor'
                        ])
                        ->label('Pendidikan'),
                    Select::make('sex')
                        ->options([
                            'm' => 'Laki-laki',
                            'f' => 'Perempuan'
                        ])
                        ->label('Jenis Kelamin'),
                    Actions::make([
                        Actions\Action::make('save')->action(function(){
                            $personalInformation = \App\Models\PersonalInformation::where('user_id', auth()->user()->id)->first();
                            if ($personalInformation) {
                                if($personalInformation->update($this->data)){
                                    Notification::make()
                                        ->body('Personal Information updated successfully')
                                        ->success()
                                        ->send();
                                }
                            } else {
                                $this->data['user_id'] = auth()->user()->id;
                                \App\Models\PersonalInformation::create($this->data);
                                Notification::make()
                                    ->body('Personal Information created successfully')
                                    ->success()
                                    ->send();
                            }
                        })
                    ])
                ])
                    ->columns(2)
                    ->statePath('data')
            ]);
    }

    function mount(){
        $personalInformation = \App\Models\PersonalInformation::where('user_id', auth()->user()->id)->first();
        if ($personalInformation) {
            $this->data = $personalInformation->toArray();
            $this->form->fill($this->data);
        }
        else{
            $this->form->fill();
        }
    }
}
