<?php

namespace App\Console\Commands;

use App\Constants\Constants;
use App\Models\User;
use App\Models\UserNotifications;
use App\Traits\HelperFn;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class OnesignalNotification extends Command
{
    use HelperFn;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'onesignal:notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command sends onesignal push notification for schedule visit and Next follow up date on enquiries.';

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
        $notifications = UserNotifications::whereDate('schedule_date', $currentDateTime)
            ->where('notification_type', Constants::SCHEDULE_VISIT)
            ->orWhere('notification_type', Constants::LEAD_DEMO_SCHEDULED)
            ->orWhere('notification_type', Constants::ENQUIRY_FOLLOWUP)
            ->get();
        
        // Process the notifications for schedule visit & enquiry NFD
        foreach ($notifications as $notification) {
            $oneHourBefore = Carbon::parse($notification->schedule_date);
            $diffrenceInTime = $currentDateTime->diffInMinutes($oneHourBefore);

            // send a notification or execute a function
            $user = User::find($notification->user_id);

            if ($notification->notification_type == Constants::SCHEDULE_VISIT || $notification->notification_type == Constants::LEAD_DEMO_SCHEDULED) {
                # code...
                if (!empty($user->onesignal_token)) {
                    if ($isBetween10to11 /* && $notification->first_notification != 1 */) {
                    # send push notification
                        try {
                            HelperFn::sendPushNotification($user->onesignal_token, $notification->notification);
                            $notification->first_notification = 1;
                            $notification->update();
                        } catch (\Throwable $th) {
                            Log::info('Cron failed: 10 AM Notification not sent for Schedule visit');
                            Log::info('Notification Id: ' . $notification->id);
                            Log::info('Error: ' . $th->getMessage());
                        }
                        
                    }
                    // one hour before
                    if ($diffrenceInTime <= 60 /* && $notification->first_notification != 1 */) {
                        # code...
                        try {
                            HelperFn::sendPushNotification($user->onesignal_token, $notification->notification);
                            $notification->second_notification = 1;
                            $notification->update();
                        } catch (\Throwable $th) {
                            Log::info('Cron failed:  1 hour before Notification not sent for Schedule visit');
                            Log::info('Notification Id: ' . $notification->id);
                            Log::info('Error: ' . $th->getMessage());
                        }
                    }
                }
            }

            // for enquiry NFD
            if ($notification->notification_type == Constants::ENQUIRY_FOLLOWUP) {
                if (!empty($user->onesignal_token)) {
                    if ($isBetween10to11) {
                        try {
                            # send push notification
                            $v = HelperFn::sendPushNotification($user->onesignal_token, $notification->notification);
                            $notification->first_notification = 1;
                            $notification->update();
                        } catch (\Throwable $th) {
                            //throw $th;
                            Log::info('Cron failed: Notification not sent for enquiry followup');
                            Log::info('Error: ' . $th->getMessage());
                        }
                        
                    } else {
                        Log::info('Time span does not fall between 10 - 11 am: ' . $currentDateTime);
                    }
                }
            }
        }
    }
}
