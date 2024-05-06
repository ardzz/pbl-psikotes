<?php

namespace App\Filament\Patient\Resources\PersonalInformationResource\Pages;

use App\Filament\Patient\Resources\PersonalInformationResource;
use App\Models\User;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use Filament\Resources\Pages\Page;
use Illuminate\Contracts\View\View;

class PatientPersonalInformation extends Page implements HasForms
{
    use InteractsWithRecord, InteractsWithForms;

    protected static string $resource = PersonalInformationResource::class;

    protected static string $view = 'filament.patient.resources.personal-information-resource.pages.patient-personal-information';

    public ?array $data = [];

    public function mount(): void
    {
        $this->record = $this->resolveRecord(auth()->id());
        $this->form->fill();
    }

    public function getFormSchema(): array
    {
        return [
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
                TextInput::make('marital_status'),
                TextInput::make('education'),
                TextInput::make('sex'),
                TextInput::make('province')
                    ->maxLength(255),
                TextInput::make('city')
                    ->maxLength(255),
                TextInput::make('district')
                    ->maxLength(255),
                TextInput::make('sub_district')
                    ->maxLength(255),
                TextInput::make('address')
                    ->maxLength(255),
            ];
    }
}
