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
                        ->maxLength(255),
                    TextInput::make('occupation')
                        ->maxLength(255),
                    DatePicker::make('birthdate'),
                    TextInput::make('phone_number')
                        ->tel()
                        ->maxLength(255),
                    TextInput::make('religion')
                        ->maxLength(255),
                    Select::make('marital_status')
                        ->native(false)
                        ->options([
                            'single' => 'Single',
                            'married' => 'Married',
                            'divorced' => 'Divorced',
                            'widowed' => 'Widowed'
                        ]),
                    Select::make('education')
                        ->native(false)
                        ->options([
                            'elementary' => 'Elementary',
                            'junior_high' => 'Junior High',
                            'senior_high' => 'Senior High',
                            'diploma' => 'Diploma',
                            'bachelor' => 'Bachelor',
                            'master' => 'Master',
                            'doctor' => 'Doctor'
                        ]),
                    Select::make('sex')
                        ->options([
                            'm' => 'Male',
                            'f' => 'Female'
                        ])
                        ->label('gender'),
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
