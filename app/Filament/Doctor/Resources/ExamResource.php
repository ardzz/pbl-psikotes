<?php

namespace App\Filament\Doctor\Resources;

use App\Filament\Doctor\Resources\ExamResource\Pages;
use App\Filament\Doctor\Resources\ExamResource\Pages\AnalyzeExamResult;
use App\Filament\Doctor\Resources\ExamResource\RelationManagers;
use App\Models\Exam;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ExamResource extends Resource
{
    protected static ?string $model = Exam::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getEloquentQuery(): Builder
    {
        return Exam::query()->where('doctor_id', auth()->user()->id);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('')->schema([
                        Forms\Components\Fieldset::make('Data Pasien')
                            ->schema([
                                Forms\Components\TextInput::make('name'),
                                Forms\Components\TextInput::make('email'),
                            ])
                            ->disabled()
                            ->relationship('user'),
                        Forms\Components\TextInput::make('purpose')
                            ->required()
                            ->maxLength(255)
                            ->default('General Checkup'),
                        Forms\Components\DateTimePicker::make('start_time'),
                        Forms\Components\DateTimePicker::make('end_time'),
                        Forms\Components\RichEditor::make('note')
                            ->columnSpanFull(),
                        Forms\Components\Toggle::make('validated')
                            ->required(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('purpose')
                    ->searchable(),
                Tables\Columns\TextColumn::make('start_time')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_time')
                    ->dateTime()
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
            ])
            ->filters([
                //
            ])
            ->actions([
                //Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\Action::make('Analyze')
                    ->icon('css-track')
                    ->color('gray')
                    ->url(fn(Exam $record) => Pages\AnalyzeExamResult::getUrl(['record' => $record->id]))
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
            'index' => Pages\ListExams::route('/'),
            'create' => Pages\CreateExam::route('/create'),
            'analyze' => Pages\AnalyzeExamResult::route('/{record}/analyze'),
            //'edit' => Pages\EditExam::route('/{record}/edit'),
        ];
    }
}
