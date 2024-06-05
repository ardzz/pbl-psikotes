<?php

namespace App\Filament\Resources\ExamResource\Pages;

use App\Filament\Resources\ExamResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\HtmlString;

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
            $this->record->user->notify(Notification::make()
                ->title('Pembayaran telah diverifikasi')
                ->body(function (){
                    return new HtmlString('Psikotes dengan keterangan <strong>'.$this->record->purpose.'</strong> telah diverifikasi, anda dapat mengerjakan psikotes sekarang.');
                })
                ->success()
                ->toDatabase()
            );
        }
    }
}
