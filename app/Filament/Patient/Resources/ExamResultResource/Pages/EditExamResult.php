<?php

namespace App\Filament\Patient\Resources\ExamResultResource\Pages;

use App\Filament\Patient\Resources\ExamResultResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditExamResult extends EditRecord
{
    protected static string $resource = ExamResultResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
