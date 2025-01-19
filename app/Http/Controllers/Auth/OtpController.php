<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;
use App\Models\Otp;
use App\Models\SuperCity;
use App\Models\User;
use Session;
use Carbon\Carbon;

class OtpController extends Controller
{
    public function showOtpForm()
	{
		return view('admin.auth.otp_form');
	}

    public function otpVerification(Request $request)
    {
        $otp = Otp::where('user_id',Session::get('user_id'))
            ->where('otp',$request->otp)
            ->first();
        
        $user = User::find(Session::get('user_id'));

        if($otp)
        {
            $otp->delete();
            $user->fill([
                'email_verified_at' =>  Carbon::now(),
                'email_verified' => 1,
            ])->save();
            
            Session::forget('user_id');

            $allcity = SuperCity::where('state_id',$user->state_id)->get();

            foreach ($allcity as $key => $value) {
                $exist = City::where('name',$value->name)->where('state_id',$value->state_id)->first();

                $city = new City();
                $city->user_id =  $user->id;
                $city->name = $value->name;
                $city->state_id =$value->state_id;
                $city->save();
            }

            return redirect('admin/login')->with('success','Email verify successfully!');
        }
        else
        {
            $user->Forcedelete();
            Session::forget('user_id');
            return redirect()->route('admin.register')->with('error','Email verification failed!');
        }
    }
}
