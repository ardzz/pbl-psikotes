<?php

namespace App\Filament\Patient\Resources;

use App\Filament\Patient\Resources\PaymentResource\Pages;
use App\Filament\Patient\Resources\PaymentResource\RelationManagers;
use App\Models\Payment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Request;

class PaymentResource extends Resource
{
    protected static ?string $model = Payment::class;

    protected static ?string $navigationIcon = 'untitledui-credit-card-02';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('user_id', auth()->id());
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Payment Information')
                    ->columns(2)
                    ->schema([
                        Forms\Components\Placeholder::make('')
                            ->content('You can choose to pay manually or online. If you choose to pay online, you can choose the payment method provided by the midtrans. If you choose to pay manually, you can choose the bank account that we provide.')
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('method')
                            ->helperText('Payment method directly to the bank (manual) or through a midtrans (online)')
                            ->formatStateUsing(function (string $state) {
                                return match ($state) {
                                    'manual' => 'Transfer Bank',
                                    'online' => 'Online',
                                    default => 'N/A',
                                };
                            })
                            ->disabledOn('edit')
                            ->required(),
                        Forms\Components\TextInput::make('provider_payment_method')
                            ->helperText('Provider payment method (e.g. Gopay, OVO, DANA, etc.)')
                            ->default('N/A')
                            ->maxLength(255)
                            ->disabledOn('edit'),
                        Forms\Components\TextInput::make('status')
                            ->disabledOn('edit')
                            ->required(),
                        Forms\Components\TextInput::make('amount')
                            ->prefix('Rp')
                            ->disabledOn('edit')
                            ->required()
                            ->numeric()
                            ->default(400000),
                        Forms\Components\Fieldset::make('Bank')
                            ->schema([
                                Forms\Components\TextInput::make('description')                            ->disabledOn('edit')
                                    ->disabledOn('edit')
                                    ->required()
                                    ->maxLength(255)
                                    ->default('Payment is pending'),
                                Forms\Components\TextInput::make('bank_name')
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('bank_account')
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('bank_account_name')
                                    ->maxLength(255),
                                ]),
                        Forms\Components\DateTimePicker::make('paid_at')
                            ->disabledOn('edit'),
                        Forms\Components\DateTimePicker::make('expired_at')
                            ->disabledOn('edit'),
                        Forms\Components\FileUpload::make('proof')
                            ->image()
                            ->imageEditor()
                            ->downloadable()
                            ->columnSpanFull(),
                        ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('method')
                    ->label('Jenis Pembayaran')
                    ->formatStateUsing(function (string $state) {
                        return match ($state) {
                            'manual' => 'Transfer Bank',
                            'online' => 'Online',
                            default => 'N/A',
                        };
                    }),
                Tables\Columns\TextColumn::make('provider_payment_method')
                    ->label('Provider Pembayaran')
                    ->default('N/A')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->color(fn(string $state) => match ($state) {
                        'pending' => 'warning',
                        'success' => 'success',
                        'failed' => 'danger',
                        default => 'primary',
                    })
                    ->badge(),
                Tables\Columns\TextColumn::make('description')
                    ->label('Deskripsi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('bank_name')
                    ->label('Nama Bank')
                    ->searchable(),
                Tables\Columns\TextColumn::make('bank_account')
                    ->label('Nomor Rekening')
                    ->searchable(),
                Tables\Columns\TextColumn::make('bank_account_name')
                    ->label('Nama Pemilik Rekening')
                    ->searchable(),
                Tables\Columns\TextColumn::make('amount')
                    ->prefix('Rp')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\ImageColumn::make('proof')
                    ->label('Bukti Pembayaran')
                    ->searchable(),
                Tables\Columns\TextColumn::make('paid_at')
                    ->label('Tanggal Pembayaran')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('expired_at')
                    ->label('Tanggal Kadaluarsa')
                    ->dateTime()
                    ->sortable(),
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
            'index' => Pages\ListPayments::route('/'),
            //'create' => Pages\CreatePayment::route('/create'),
            //'view' => Pages\ViewPayment::route('/{record}'),
            //'edit' => Pages\EditPayment::route('/{record}/edit'),
        ];
    }
}
