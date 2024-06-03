<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExamResource\Pages;
use App\Models\Exam;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ExamResource extends Resource implements HasShieldPermissions
{
    protected static ?string $model = Exam::class;

    protected static ?string $navigationIcon = 'gmdi-assignment-o';

    public static function getPermissionPrefixes(): array
    {
        return [
            'view',
            'view_any',
            'create',
            'update',
        ];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('user_id')
                    ->required()
                    ->hidden()
                    ->dehydrated()
                    ->numeric(),
                Forms\Components\TextInput::make('purpose')
                    ->required()
                    ->maxLength(255)
                    ->default('General Checkup'),
                Forms\Components\DateTimePicker::make('start_time'),
                Forms\Components\DateTimePicker::make('end_time'),
                Forms\Components\Select::make('doctor_id')
                    ->relationship('doctor', 'name'),
                Section::make('Formulir Pembayaran')
                    ->relationship('payment')
                    ->schema([
                        TextInput::make('bank_name')
                            ->label('Nama Bank')
                            ->helperText('Contoh: BCA, BNI, BRI, Mandiri, dll.'),
                        TextInput::make('bank_account_name')
                            ->label('Nama Pengirim'),
                        TextInput::make('bank_account')
                            ->label('Nomor Rekening Pengirim')
                            ->placeholder('1234567890'),
                        FileUpload::make('proof')
                            ->label('Bukti Pembayaran')
                            ->image()
                            ->imageEditor()
                    ]),
                Forms\Components\Toggle::make('approved'),
                Forms\Components\Toggle::make('validated')
                    ->required(),
                Forms\Components\Textarea::make('note')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->description(function (Model $record) {
                        return $record->user->email;
                    }),
                Tables\Columns\TextColumn::make('purpose')
                    ->sortable(),
                Tables\Columns\TextColumn::make('start_time')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_time')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('doctor.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('payment.method')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'online' => 'success',
                        'manual' => 'warning',
                    })
                    ->sortable(),
                Tables\Columns\ToggleColumn::make('approved')
                ->afterStateUpdated(function ($record, $state){
                    if ($state && $record->payment->method === 'manual'){
                        $record->payment->status = 'paid';
                        $record->payment->description = 'Pembayaran telah diverifikasi';
                        $record->payment->paid_at = now();
                        $record->payment->save();
                    }
                }),
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
            'edit' => Pages\EditExam::route('/{record}/edit'),
        ];
    }
}
