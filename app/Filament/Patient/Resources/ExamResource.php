<?php

namespace App\Filament\Patient\Resources;


use App\Filament\Patient\Resources\ExamResource\Pages\CreateExam;
use App\Filament\Patient\Resources\ExamResource\Pages\EditExam;
use App\Filament\Patient\Resources\ExamResource\Pages\ListExams;
use App\Filament\Patient\Resources\ExamResource\Pages\ViewExam;
use App\Models\Exam;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\HtmlString;

class ExamResource extends Resource
{
    protected static ?string $model = Exam::class;

    protected static ?string $navigationIcon = 'gmdi-assignment-o';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('user_id', auth()->id());
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\RichEditor::make('purpose')
                    ->required()
                    ->columnSpanFull()
                    ->maxLength(255)
                    ->default('General Checkup'),
                Forms\Components\DateTimePicker::make('start_time')->disabled(),
                Forms\Components\DateTimePicker::make('end_time')->disabled(),
                Forms\Components\Select::make('doctor_id')
                    ->disabled()
                    ->relationship('doctor', 'name'),
                Forms\Components\TextInput::make('payment.method')
                    ->formatStateUsing(function(?Model $record){
                        if ($record->payment->method == 'manual') {
                            return 'Bank Transfer';
                        } else {
                            return 'Vendor Payment';
                        }
                    })
                    ->disabled(),
                Forms\Components\Fieldset::make()->schema([
                    Forms\Components\Toggle::make('approved')
                        ->disabled(),
                    Forms\Components\Toggle::make('validated')
                        ->disabled(),
                ])
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('purpose')
                    ->searchable(),
                Tables\Columns\TextColumn::make('start_time')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_time')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('doctor.name')
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
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\Action::make('download_certificate')
                    ->label('Certificate')
                    ->icon('untitledui-certificate')
                    ->color('success')
                    ->modalDescription(new HtmlString('Oops fitur belum ada! Sabar yaa, frontend kita lagi sibuk ngerjain paper dan tubes lainnya XD<br><br>'))
                    ->modalSubmitAction(false)
                    ->modalCancelAction(false)
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
            'index' => ListExams::route('/'),
            'create' => CreateExam::route('/create'),
        ];
    }
}
