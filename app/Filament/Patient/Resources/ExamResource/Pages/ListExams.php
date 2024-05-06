<?php

namespace App\Filament\Patient\Resources\ExamResource\Pages;

use App\Filament\Patient\Resources\ExamResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListExams extends ListRecords
{
    protected static string $resource = ExamResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Request Exam'),
        ];
    }
}
