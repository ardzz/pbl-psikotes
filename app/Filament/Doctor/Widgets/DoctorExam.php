<?php

namespace App\Filament\Doctor\Widgets;

use App\Models\Exam;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class DoctorExam extends BaseWidget
{
    protected static ?int $sort = 2;
    protected int | string | array $columnSpan = 'full';
    public function table(Table $table): Table
    {
        return $table
        ->query(
            Exam::query()->where('doctor_id', auth()->id())
        )
        ->columns([
            Tables\Columns\TextColumn::make('purpose')
                ->label('Tujuan Tes')
                ->searchable(),
            Tables\Columns\TextColumn::make('start_time')
                ->label('Waktu Mulai')
                ->dateTime()
                ->sortable(),
            Tables\Columns\TextColumn::make('end_time')
                ->label('Waktu Selesai')
                ->dateTime()
                ->sortable(),
            Tables\Columns\TextColumn::make('doctor.name')
                ->label('Nama Dokter')
                ->numeric()
                ->sortable(),
            Tables\Columns\IconColumn::make('approved')
                ->boolean(),
            Tables\Columns\IconColumn::make('validated')
                ->boolean(),
            Tables\Columns\TextColumn::make('created_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
            Tables\Columns\TextColumn::make('updated_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
        ]);
    }
}
