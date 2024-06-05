<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PersonalInformationResource\Pages;
use App\Filament\Resources\PersonalInformationResource\RelationManagers;
use App\Models\PersonalInformation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PersonalInformationResource extends Resource
{
    protected static ?string $model = PersonalInformation::class;

    protected static ?string $navigationIcon = 'css-profile';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                Forms\Components\TextInput::make('nik')
                    ->maxLength(255),
                Forms\Components\TextInput::make('occupation')
                    ->maxLength(255),
                Forms\Components\DatePicker::make('birthdate'),
                Forms\Components\TextInput::make('phone_number')
                    ->tel()
                    ->maxLength(255),
                Forms\Components\TextInput::make('religion')
                    ->maxLength(255),
                Forms\Components\TextInput::make('marital_status'),
                Forms\Components\TextInput::make('education'),
                Forms\Components\TextInput::make('sex'),
                /*Forms\Components\TextInput::make('province')
                    ->maxLength(255),
                Forms\Components\TextInput::make('city')
                    ->maxLength(255),
                Forms\Components\TextInput::make('district')
                    ->maxLength(255),
                Forms\Components\TextInput::make('sub_district')
                    ->maxLength(255),
                Forms\Components\TextInput::make('address')
                    ->maxLength(255),*/
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nik')
                    ->searchable(),
                Tables\Columns\TextColumn::make('occupation')
                    ->label('Pekerjaan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('birthdate')
                    ->label('Tanggal Lahir')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('phone_number')
                    ->label('Nomor Telepon')
                    ->searchable(),
                Tables\Columns\TextColumn::make('religion')
                    ->label('Agama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('marital_status')
                ->formatStateUsing(function(string $state){
                    return match ($state) {
                        'single' => 'Belum Menikah',
                        'married' => 'Menikah',
                        'divorced' => 'Cerai',
                        'widowed' => 'Duda/Janda',
                        default => $state,
                    };

                }),
                Tables\Columns\TextColumn::make('education')
                ->formatStateUsing(function(string $state){
                    return match ($state) {
                        'elementary' => 'SD',
                        'junior_high' => 'SMP',
                        'senior_high' => 'SMA',
                        'diploma' => 'Diploma',
                        'bachelor' => 'S1',
                        'master' => 'S2',
                        'doctor' => 'S3',
                        default => $state,
                    };
                }),
                Tables\Columns\TextColumn::make('sex')
                    ->label('Jenis Kelamin')
                    ->formatStateUsing(function (string $state){
                        return match ($state) {
                            'f' => 'Perempuan',
                            'm' => 'Laki-laki',
                        };
                }),
                /*Tables\Columns\TextColumn::make('province')
                    ->searchable(),
                Tables\Columns\TextColumn::make('city')
                    ->searchable(),
                Tables\Columns\TextColumn::make('district')
                    ->searchable(),
                Tables\Columns\TextColumn::make('sub_district')
                    ->searchable(),
                Tables\Columns\TextColumn::make('address')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                */
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListPersonalInformation::route('/'),
            'create' => Pages\CreatePersonalInformation::route('/create'),
            'edit' => Pages\EditPersonalInformation::route('/{record}/edit'),
        ];
    }
}
