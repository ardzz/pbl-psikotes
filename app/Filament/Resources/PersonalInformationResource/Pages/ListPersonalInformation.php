<?php

namespace App\Filament\Resources\PersonalInformationResource\Pages;

use App\Filament\Resources\PersonalInformationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPersonalInformation extends ListRecords
{
    protected static string $resource = PersonalInformationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
