<?php
namespace App\Traits;

trait HelperFn
{
    public static function formatIndianCurrency($num) {
        $num = (string)$num;
        $lastThree = substr($num, -3);
        $restUnits = substr($num, 0, -3);
        if (strlen($restUnits) > 0) {
            $restUnits = (strlen($restUnits) % 2 == 1) ? "0" . $restUnits : $restUnits;
            $restUnits = chunk_split($restUnits, 2, ',');
            $restUnits = rtrim($restUnits, ',');
            $formattedNum = ltrim($restUnits, '0') . ',' . $lastThree;
        } else {
            $formattedNum = $lastThree;
        }
        return $formattedNum;
    }

    public static function formatIndianCurrencyStr($num) {
        $num = preg_replace('/[^\d]/', '', $num);
        $lastThree = substr($num, -3);
        $restUnits = substr($num, 0, -3);
        if (strlen($restUnits) > 0) {
            $restUnits = (strlen($restUnits) % 2 == 1) ? "0" . $restUnits : $restUnits;
            $restUnits = chunk_split($restUnits, 2, ',');
            $restUnits = rtrim($restUnits, ',');
            $formattedNum = ltrim($restUnits, '0') . ',' . $lastThree;
        } else {
            $formattedNum = $lastThree;
        }
    
        return $formattedNum;
    }
    
    

    public static function sendPushNotification($userId, $message) 
    {
        // Assuming you have the user's OneSignal ID stored in your database
        // $userId = "ca336139-c7dc-4b3d-9b36-36c60d4cedd7"; // Replace with the actual user ID

        $appId = config('app.onesignalId');
        $restApiKey =  config('app.onesignalKey'); // Replace with your OneSignal REST API Key

        $url = "https://onesignal.com/api/v1/notifications";
        $data = array(
            'app_id' => $appId,
            'include_player_ids' => array($userId),
            'contents' => array(
                'en' => $message
            )
        );

        $data_string = json_encode($data);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: Basic ' . $restApiKey
        ));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);
        curl_close($ch);
    }
}
