<?php

namespace App\Filament\Patient\Widgets;

use App\Models\Exam;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsPatient extends BaseWidget
{
    protected static ?int $sort = 1;
    protected function getStats(): array
    {
        return [
            Stat::make('Total Exam', Exam::where('user_id', auth()->id())->count()),
            Stat::make('Total Pending Exam', Exam::where('user_id', auth()->id())->where('approved', false)->count()),
            Stat::make('Total Approved Exam', Exam::where('user_id', auth()->id())->where('approved', true)->count()),
            Stat::make('Total Validated Exam', Exam::where('user_id', auth()->id())->where('validated', true)->count()),
        ];
    }
}
