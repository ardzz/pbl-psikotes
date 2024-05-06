<?php

namespace App\Filament\Patient\Resources\PaymentResource\Pages;

use App\Filament\Patient\Resources\PaymentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPayments extends ListRecords
{
    protected static string $resource = PaymentResource::class;
}
