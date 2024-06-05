<?php

namespace App\Filament\Patient\Resources\ExamResource\Pages;

use App\Filament\Patient\Resources\ExamResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListExams extends ListRecords
{
    protected static string $resource = ExamResource::class;

    public function getTabs(): array
    {
        return [
            'all' => Tab::make(),
            'pending' => Tab::make()
                ->label('Pending')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('approved', false)),
            'approved' => Tab::make()
                ->label('Approved')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('approved', true)),
            'validated' => Tab::make()
                ->label('Validated')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('validated', true)),
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Request Exam'),
        ];
    }
}
