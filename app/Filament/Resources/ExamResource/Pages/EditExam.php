<?php

namespace App\Filament\Resources\ExamResource\Pages;

use App\Filament\Resources\ExamResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditExam extends EditRecord
{
    protected static string $resource = ExamResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    function afterSave(){
        if($this->data['approved']){
            $payment = $this->record->payment;
            if ($payment->status == 'pending'){
                $payment->status = 'paid';
                $payment->description = 'Pembayaran telah diverifikasi';
                $payment->paid_at = now();
                $payment->save();
            }
        }
    }
}
