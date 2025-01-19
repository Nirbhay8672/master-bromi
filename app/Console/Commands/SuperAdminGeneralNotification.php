<?php

namespace App\Console\Commands;

use App\Constants\Constants;
use App\Models\User;
use App\Models\UserNotifications;
use App\Traits\HelperFn;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SuperAdminGeneralNotification extends Command
{
    use HelperFn;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'onesignal:superAdminGeneralNotification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command sends onesignal push notification for general notification to all admins.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Get the current date and time
        $currentDateTime = now();

        $isBetween10to11 = $currentDateTime->between(
            Carbon::parse('10:00:00'),
            Carbon::parse('11:00:00'),
            true // Set to true to include the boundaries
        );
        // Find records in the database where the schedule_date matches the current time and 30 minutes before
        DB::enableQueryLog();
        $notifications = UserNotifications::whereDate('schedule_date', $currentDateTime)
            ->where('notification_type', Constants::GENERAL)
            ->where('general_notif_status', '!=', 'Sent')
            ->get();
        
        // Process the notifications for schedule visit & enquiry NFD
        foreach ($notifications as $notification) {
            $scheduleTime = Carbon::parse($notification->schedule_date);
            $diffrenceInTime = $currentDateTime->diffInMinutes($scheduleTime);

            // send a notification or execute a function
            $user = User::find($notification->user_id);

            # code...
            if (!empty($user->onesignal_token)) {
                if ($diffrenceInTime <= 60) {
                # send push notification
                    try {
                        HelperFn::sendPushNotification($user->onesignal_token, $notification->notification);
                        $notification->first_notification = 1;
                        $notification->update();
                    } catch (\Throwable $th) {
                        Log::info('Cron failed: 10 AM Notification not sent for (general notification)');
                        Log::info('Error: ' . $th->getMessage());
                    }
                    
                }
                // one hour before
                if ($diffrenceInTime <= 30) {
                    # code...
                    try {
                        HelperFn::sendPushNotification($user->onesignal_token, $notification->notification);
                        $notification->second_notification = 1;
                        $notification->general_notif_status = 'Sent';
                        $notification->update();
                    } catch (\Throwable $th) {
                        Log::info('Cron failed: 1 hour before Notification not sent (general notification)');
                        Log::info('Error: ' . $th->getMessage());
                    }
                }
            }
        }
    }
}
