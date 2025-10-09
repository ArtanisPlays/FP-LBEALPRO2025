<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RpsStatusNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct($rps)
    {
       $this->rps = $rps;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable)
    {
        return ['mail']; // Kirim via email
    }

    /**
     * Get the mail representation of the notification.
     */
    // public function toMail(object $notifiable): MailMessage
    // {
    //     return (new MailMessage)
    //         ->line('The introduction to the notification.')
    //         ->action('Notification Action', url('/'))
    //         ->line('Thank you for using our application!');
    // }

    public function toMail($notifiable)
    {
        $status = ucfirst($this->rps->status);
        return (new MailMessage)
                    ->subject("Status Pengajuan RPS Anda: {$status}")
                    ->line("Halo {$notifiable->name},")
                    ->line("Status pengajuan RPS Anda untuk tahun akademik {$this->rps->tahun_akademik} telah diperbarui menjadi: {$status}.")
                    ->lineif($this->rps->catatan_dosen, "Catatan dari dosen wali: {$this->rps->catatan_dosen}")
                    ->action('Lihat Dashboard', url('/dashboard'))
                    ->line('Terima kasih telah menggunakan sistem kami.');
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
