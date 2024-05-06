<?php

namespace App\Filament\Patient\Resources;

use App\Models\ExamResult;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ExamResultResource extends Resource
{
    protected static ?string $model = ExamResult::class;
    protected static ?string $navigationGroup = 'Exam';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Patient\Resources\ExamResultResource\Pages\ListExamResults::route('/'),
            //'create' => Pages\CreateExamResult::route('/create'),
            'view' => \App\Filament\Patient\Resources\ExamResultResource\Pages\ViewExamResult::route('/{record}'),
            //'edit' => Pages\EditExamResult::route('/{record}/edit'),
        ];
    }
}
