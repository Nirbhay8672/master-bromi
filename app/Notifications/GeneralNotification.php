<?php

namespace App\Notifications;

use App\Constants\Constants;
use App\Models\User;
use App\Models\UserNotifications;
use App\Traits\HelperFn;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class GeneralNotification extends Notification
{
    use Queueable, HelperFn;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['custom'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toCustom($notifiable)
    {
        try {
            $notifs = UserNotifications::where([
                'notification_type' => Constants::GENERAL,
                'general_notif_status' => 'Pending'
            ])->with('user')->get();
            
            foreach ($notifs as $notif) {
                $user = $notif->user;
                if (!empty($user->onesignal_token)) {
                    # send notification
                    HelperFn::sendPushNotification($user->onesignal_token, $notif->notification);
                    $notif->general_notif_status = 'Sent';
                    $notif->update();
                }
            }
        } catch (\Throwable $th) {
            // if notificaton sending failed.
            Log::error("Error on seding bulk notification: file_path: app\GeneralNotification");
            Log::error("Error Message: $th->getMessage()");
        }
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
