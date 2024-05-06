<?php

namespace App\Notifications;

use App\Models\Exam;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class ExamApproved extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(protected Exam $exam)
    {
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Your MMPI-2 exam is ready!')
            ->greeting('Hello, ' . $this->exam->user()->name)
            ->line('Your MMPI-2 exam is ready. Please login to your account to start the exam.')
            ->line('If you have any questions, please contact ' . $this->exam->doctor->name . ' at ' . $this->exam->doctor->email . ' as your doctor.')
            ->action('Start Exam', url('/mmpi2'))
            ->line('Good luck!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
