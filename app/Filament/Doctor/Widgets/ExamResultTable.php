<?php

namespace App\Filament\Doctor\Widgets;

use App\Models\ExamResult;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ExamResultTable extends BaseWidget
{
    public ?Model $record;

    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                ExamResult::query()->where('exam_id', $this->record->id)
            )
            ->columns([
                Tables\Columns\TextColumn::make('category')
                    ->formatStateUsing(function (string $state) {
                        return Str::of($state)->title()->replace('_', ' ');
                    })
                    ->searchable(),
                Tables\Columns\TextColumn::make('sub_category')->searchable(),
                Tables\Columns\TextColumn::make('raw_score'),
                Tables\Columns\TextColumn::make('t_score'),
                Tables\Columns\TextColumn::make('k_score'),
            ])->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->label('Filter by category')
                    ->native(false)
                    ->searchable()
                    ->preload()
                    ->options(function () {
                        return ExamResult::select('category')->distinct()->get()->pluck('category', 'category')->map(function ($category) {
                            return Str::of($category)->title()->replace('_', ' ');
                        });
                    }),
            ]);
    }
}
