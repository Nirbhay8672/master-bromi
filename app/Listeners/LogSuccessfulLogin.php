<?php

namespace App\Listeners;

use App\Models\UserLoginLog;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use PgSql\Lob;

class LogSuccessfulLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(Login $event)
    {
        // Access the authenticated user
        $user = $event->user;

        // Save user-specific information to the database (e.g., IP address)
        $userRemoteAddr = request()->ip();

        Log::info('============== Login Logs ================');
        Log::info('user Id: ' . $user->id);
        /* Locaiton information */
        $query = @unserialize (file_get_contents('http://ip-api.com/php/'));
        if ($query && $query['status'] == 'success') 
        { 
            try {
                $loginLog = UserLoginLog::create([
                    'user_id' => $user->id,
                    'country' => $query['country'],
                    'region_name' => $query['regionName'],
                    'city' => $query['city'],
                    'ip' => $query['query'],
                    'os' => php_uname()
                ]);
                Log::info('Login logs save successfully. Login_log_id: ' . json_encode($loginLog));
            } catch (\Throwable $th) {
                Log::error('Error in getting ip information: ' . $th->getMessage());
            }
        } else {
            Log::error('Error in getting ip information');
        }
        
        Log::info('============== Login Logs End ================');
        // $user->save();
    }
}
