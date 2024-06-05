<?php

namespace App\Filament\Doctor\Resources;

use App\Filament\Doctor\Resources\ExamResource\Pages;
use App\Filament\Doctor\Resources\ExamResource\Pages\AnalyzeExamResult;
use App\Filament\Doctor\Resources\ExamResource\RelationManagers;
use App\Models\Exam;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\HtmlString;
use Saade\FilamentAutograph\Forms\Components\Enums\DownloadableFormat;
use Saade\FilamentAutograph\Forms\Components\SignaturePad;

class ExamResource extends Resource
{
    protected static ?string $model = Exam::class;

    protected static ?string $navigationIcon = 'gmdi-assignment-o';

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
                    /*RichEditor::make('notes')
                        ->columnSpanFull(),*/
                    RichEditor::make('response_to_test')
                        ->label('Sikap Terhadap Tes')
                        ->required()
                        ->visible(fn (Model $record) => $record->hasExamResult())
                        ->columnSpanFull(),
                    Fieldset::make('INDEKS KAPASITAS MENTAL')
                        ->schema([
                            Placeholder::make('')
                                ->columnSpanFull()
                                ->content(function(){
                                    return new HtmlString('<table><thead><tr><th>Skor</th><th>Keterangan</th></tr></thead><tbody><tr><td>0</td><td>Kurang</td></tr><tr><td>1</td><td>Sedang</td></tr><tr><td>2</td><td>Besar</td></tr></tbody></table>');
                                }),
                            TextInput::make('work_performance')
                                ->numeric()
                                ->required()
                                ->label('Potensi Kinerja'),
                            TextInput::make('adaptability')
                                ->numeric()
                                ->required()
                                ->label('Kemampuan Adaptasi'),
                            TextInput::make('psychological_issue')
                                ->numeric()
                                ->required()
                                ->label('Kendala Psikologis'),
                            TextInput::make('destructive_action')
                                ->numeric()
                                ->required()
                                ->label('Perilaku Beresiko'),
                            TextInput::make('moral_integrity')
                                ->numeric()
                                ->required()
                                ->label('Integritas Moral')
                        ])->visible(fn (Model $record) => $record->hasExamResult()),
                    RichEditor::make('clinical_profile')
                        ->label('Profil Klinis')
                        ->visible(fn (Model $record) => $record->hasExamResult())
                        ->required()
                        ->columnSpanFull()->visible(fn (Model $record) => $record->hasExamResult()),
                    Fieldset::make('INDEKS KEPRIBADIAN DASAR')
                        ->schema([
                            Placeholder::make('')
                                ->columnSpanFull()
                                ->content(function(){
                                    return new HtmlString('<table><thead><tr><th>Skor</th><th>Keterangan</th></tr></thead><tbody><tr><td>0</td><td>Kurang</td></tr><tr><td>1</td><td>Sedang</td></tr><tr><td>2</td><td>Besar</td></tr></tbody></table>');
                                }),
                            TextInput::make('openness')
                                ->required()
                                ->numeric()
                                ->label('Keterbukaan'),
                            TextInput::make('conscientiousness')
                                ->required()
                                ->numeric()
                                ->label('Kesungguhan'),
                            TextInput::make('extraversion')
                                ->required()
                                ->numeric()
                                ->label('Ekstraversi'),
                            TextInput::make('agreeableness')
                                ->required()
                                ->numeric()
                                ->label('Kemurahan Hati'),
                            TextInput::make('neuroticism')
                                ->required()
                                ->numeric()
                                ->label('Neurotisme')
                        ])->visible(fn (Model $record) => $record->hasExamResult()),
                    RichEditor::make('conclusion')
                        ->label('Kesimpulan')
                        ->visible(fn (Model $record) => $record->hasExamResult())
                        ->required()
                        ->columnSpanFull(),
                    SignaturePad::make('signature')
                        ->visible(fn (Model $record) => $record->hasExamResult())
                        ->downloadable()                    // Allow download of the signature (defaults to false)
                        ->downloadableFormats([             // Available formats for download (defaults to all)
                            DownloadableFormat::PNG,
                            DownloadableFormat::JPG,
                            DownloadableFormat::SVG,
                        ])
                        ->downloadActionDropdownPlacement('center'),
                    Forms\Components\Toggle::make('validated')
                        ->disabled(),
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
                Tables\Actions\EditAction::make(),
                //Tables\Actions\ViewAction::make(),
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
            'analyze' => Pages\AnalyzeExamResult::route('/{record}/analyze'),
        ];
    }
}
