<?php

namespace App\Helpers;

use Throwable;
use App\Models\User;
use App\Models\UserLoginDevice;
use Illuminate\Support\Facades\Log;

class APIHelper
{
    /**
     * Send push notification
     *
     * @param  mixed $receiver_id
     * @param  mixed $message
     * @param  mixed $title
     * @param  mixed $type
     * @param  mixed $sender_id
     * @param  mixed $params
     * @return void
     */
    public static function sendNotification($receiver_id, $message = "", $title = "", $type = NULL, $sender_id = NULL, $params = array())
    {
        try {
            // $sender = User::find($sender_id);
            $receivers = User::whereIn('id', $receiver_id)->with(['userLoginDevices' => function ($query) {
                $query->whereNull('logout_date')->where('is_signout', 0);
            }])->has('userLoginDevices')->get();
            if (!empty($receivers) && $receivers->count()) {
                $sender_name = $sender_image = "";
                $deviceTokens = array();

                $badge = 0;
                if (isset($params['badge']) && !empty($params['badge']) && $params['badge'] > 0) {
                    $badge = $params['badge'];
                }

                foreach ($receivers as $receiver) {
                    if (isset($receiver->userLoginDevices) && !empty($receiver->userLoginDevices) && $receiver->userLoginDevices->count()) {
                        $deviceTokensTemp = collect($receiver->userLoginDevices)->pluck('fcm_token')->toArray();
                        $deviceTokens = array_merge($deviceTokens, $deviceTokensTemp);
                    }
                }

                if (isset($deviceTokens) && !empty($deviceTokens)) {
                    $deviceTokens = array_unique($deviceTokens);
                    // Log::info($deviceTokens);
                    foreach ($deviceTokens as $key => $registration_id) {
                        if (!empty($registration_id) && $message != "") {

                            $data = [
                                'body' => $message,
                                'title' => $title,
                                'type' => $type,
                                // 'other'=> (isset($params['other']) ? $params['other'] : ''),
                                "badge" => $badge,
                                "sound" => ($type == 0 ? "" : "default")
                            ];

                            $fields = [
                                'to' => $registration_id,
                                'notification' => $data,
                                'data' => $data,
                                "android" => [
                                    "notification" => [
                                        "sound" => ($type == 0 ? "" : "default"),
                                    ]
                                ],
                                "apns" => [
                                    "payload" => [
                                        "aps" => [
                                            "sound" => ($type == 0 ? "" : "default")
                                        ]
                                    ]
                                ],
                                "content_available" => true
                            ];

                            // For silent notification
                            if ($type === 0) {
                                $fields["apns-priority"] = 5;
                                unset($fields['notification']);
                            }

                            $result = self::sendPushNotification(env('FCM_SERVER_KEY'), $fields);
                            if (!empty($result)) {
                                $result = json_decode($result, true);
                                if (!empty($result) && isset($result['failure']) && $result['failure'] == 1) {
                                    UserLoginDevice::where('fcm_token', $registration_id)->delete();
                                }
                            }
                        }
                    }
                }
            }
            return;
        } catch (Throwable $e) {
            Log::error($e->getMessage());
            return false;
        }
    }

    /**
     * SendPushNotification
     *
     * @param  mixed $Key
     * @param  mixed $fields
     * @return void
     */
    public static function sendPushNotification($Key, $fields)
    {
        try {
            $headers = array('Authorization: key=' . $Key, 'Content-Type: application/json');
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
            $result = curl_exec($ch);
            Log::warning($result);
            // $error = curl_error($ch);
            // Log::error($error);
            curl_close($ch);
            return $result;
        } catch (Throwable $e) {
            Log::error($e->getMessage());
            return false;
        }
    }
}
