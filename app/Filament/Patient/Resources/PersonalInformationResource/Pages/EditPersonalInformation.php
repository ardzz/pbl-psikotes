<?php

namespace App\Filament\Patient\Resources\PersonalInformationResource\Pages;

use App\Filament\Patient\Resources\PersonalInformationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPersonalInformation extends EditRecord
{
    protected static string $resource = PersonalInformationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
