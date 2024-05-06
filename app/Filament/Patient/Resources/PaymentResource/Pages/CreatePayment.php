<?php

namespace App\Filament\Patient\Resources\PaymentResource\Pages;

use App\Filament\Patient\Resources\PaymentResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePayment extends CreateRecord
{
    protected static string $resource = PaymentResource::class;
}
