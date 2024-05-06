<?php

namespace App\Filament\Patient\Resources\PersonalInformationResource\Pages;

use App\Filament\Patient\Resources\PersonalInformationResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPersonalInformation extends ViewRecord
{
    protected static string $resource = PersonalInformationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
