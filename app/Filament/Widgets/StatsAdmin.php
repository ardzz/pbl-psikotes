<?php

namespace App\Filament\Widgets;

use Akaunting\Money\Money;
use App\Models\Exam;
use App\Models\Payment;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsAdmin extends BaseWidget
{
    protected static ?int $sort = 1;
    protected function getStats(): array
    {
        return [
            Stat::make('Total Pendapatan', Money::IDR(Payment::sum('amount'), true)),
            Stat::make('Total Pendapatan Bulan Ini', Money::IDR(Payment::whereMonth('created_at', now()->month)->sum('amount'), true)),
            Stat::make('Total Pasien', User::patients()->count()),
            Stat::make('Total Dokter', User::doctors()->count()),
            Stat::make('Total Ujian', Exam::all()->count()),
            Stat::make('Total Ujian Tertunda', Exam::where('approved', false)->count())->color('warning')
        ];
    }
}
