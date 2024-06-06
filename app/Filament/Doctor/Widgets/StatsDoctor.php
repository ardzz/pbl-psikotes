<?php

namespace App\Filament\Doctor\Widgets;

use App\Models\Exam;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsDoctor extends BaseWidget
{
    protected static ?int $sort = 1;
    protected function getStats(): array
    {
        return [
            Stat::make('Analyzed Exams Count', Exam::where('validated', true)->where('doctor_id', auth()->id())->count()),
            Stat::make('Pending Exams Count', Exam::where('validated', false)->where('doctor_id', auth()->id())->count()),
            Stat::make('Total Exams Count', Exam::where('doctor_id', auth()->id())->count()),
        ];
    }
}
