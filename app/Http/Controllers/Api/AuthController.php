<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\BromiEnquiry;
use Illuminate\Support\Facades\Hash;
// use Auth;
// use Validator;
use App\Models\City;
use App\Models\State;
use App\Models\PasswordReset;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\VerificationToken;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        try {
              // Validate the request data
            $validator = Validator::make($request->all(), [
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'email' => 'required|email|unique:users',
                'mobile_number' => 'required|string',
                'company_name' => 'required|string',
                'role_id' => 'required|string',
                'state_id' => 'required|integer',
                'city_id' => 'required|integer',
                'password' => 'required|string|min:8|confirmed',
                'password_confirmation' => 'required_with:password|same:password',
                'device_type' => 'sometimes|string', 
                'device_token' => 'sometimes|string',
            ]);

            // If validation fails, return the error response
            if ($validator->fails()) {
                return response()->json([
                    'status' => 422,
                    'message' => 'Validation failed',
                    'data' => $validator->errors(),
                ]);
            }

            $verifitoken = rand(1000,9999);
            $user = User::create([
                "first_name"=> $request->first_name,
                "last_name"=> $request->last_name,
                'email' => $request->email,
                "mobile_number"=> $request->mobile_number,
                "company_name"=> $request->company_name,
                "role_id"=> $request->role_id,
                "state_id"=> $request->state_id,
                "city_id"=> $request->city_id,
                'password' => Hash::make($request->password),
                'verification_token' => $verifitoken,
                'device_type' => $request->device_type ?? null,
                'device_token' => $request->device_token ?? null,
            ]);

            // $update = User::where('id',$user->id)->update(['parent_id'=>$user->id]);
            $user->update(['parent_id'=> $user->id]);
            $token = $user->createToken('auth_token')->plainTextToken;
            //       VerificationToken::create([
            //     'token' => $verifitoken,
            //     'user_id' => $user->id,
            // ]);
            // Mail::raw("Dear User,\n\nYour verification token is: $verifitoken\n\nPlease use this token for verification purposes.", function ($message) use ($user) {
            //     $message->from('rjnbutani@gmail.com')
            //     ->to($user->email)
            //             ->subject('Verification Token');
            // });         
            //sending mail for token
            config(['mail.driver' => 'smtp']);
            config(['mail.from_name' => 'Bromi']);
            config(['mail.host' => 'smtp.gmail.com']);
            config(['mail.port' => 587]);
            config(['mail.username' => 'hathaliyank@gmail.com']);
            config(['mail.password' => 'jzmk iqib mstp njln']);
            config(['mail.encryption' => 'tls']);

            

       
            Mail::raw("Dear User,\n\nYour verification token is: $verifitoken\n\nPlease use this token for verification purposes.", function ($message) use ($request) {
                $message
                ->to($request->email)
                        ->subject('Verification Token');
            });
    
                   
                       
                        return response()->json(["status"=> 200,
                        "message"=>"Registration successful. Please verify your email.",
                        "data"=> $user]);
                    // return response()
                    //     ->json(['data' => $user,'access_token' => $token, 'token_type' => 'Bearer', ]);
        } catch (\exception $e) {
            // dd($e);
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred',
                'data' => $e,
            ], 500);
            //throw $th;
        }
        

        
    }


     public function verifyToken(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'token' => 'required',
        ]);
        $user = User::where('verification_token', $request->token)->first();

        if (!$user) {
            return response()->json(['error' => 'Invalid verification token.'], 404);
        }

        $user->is_verified = 1;
        $user->verification_token = null;
        $user->save();

        return response()->json(['message' => 'User successfully verified.'], 200);
    }

    public function login1(Request $request)
    {

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Invalid Login credential'], 401);
        } else {
            $user = User::where('email', $request['email'])->firstOrFail();
    
            if (!empty($user->is_verified)) {
                $token = $user->createToken('auth_token')->plainTextToken;
                $data = [
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                    'email' => $user->email,
                    'mobile_number' => $user->mobile_number,
                    'company_name' => $user->company_name,
                    'company_logo' => $user->company_logo,
                    'role_id' => $user->role_id,
                    'state_id' => (int) $user->state_id,
                    'city_id' => (int) $user->city_id,
                    'verification_token' => (int) $user->verification_token,
                    'id' => $user->id,
                    'token' => $token,
                    'token_type' => 'Bearer',
                ];
    
                // Set the session value
                Session::put('parent_id', $user->parent_id);
    
                return response()->json([
                    'status' => 200,
                    'data' => $data,
                ]);
            } else {
                return response()->json(['error' => 'Your email is not verified.'], 403);
            }
        }
    }
    public function login(Request $request)
    {
        try {
            if (!Auth::attempt($request->only('email', 'password'))) {
                        return response()->json([
                                'message' => 'Invalid Login credential'
                            ], 401);
            } else {
                $user = User::where('email', $request['email'])->firstOrFail();
        
                $input = [];
                if (!empty($request->input('device_type'))) { // check if device_type param exist
                    $input['device_type'] = $request->input('device_type');
                }
                if (!empty($request->input('device_token'))) { // check if device_token param exist
                    $input['device_token'] = $request->input('device_token');
                }
                if (!empty($input)) { // if any of the param exist then update user model
                    $user->update($input);
                }
                
                if (!empty($user->is_verified)) {
                    $token = $user->createToken('auth_token')->plainTextToken;
                    $data = [
                        'first_name' => $user->first_name,
                        'last_name' => $user->last_name,
                        'email' => $user->email,
                        'mobile_number' => $user->mobile_number,
                        'company_name' => $user->company_name,
                        'role_id' => $user->role_id,
                        'state_id' => (int) $user->state_id,
                        'city_id' => (int) $user->city_id,
                        'verification_token' => (int) $user->verification_token,
                        'id' => $user->id,
                        'device_type' => $user->device_type,
                        'device_token' => $user->device_token,
                        'token' => $token,
                        'token_type' => 'Bearer',
                    ];
        
                    // Set the session value
                    Session::put('parent_id', $user->parent_id);
        
                    return response()->json([
                        'status' => 200,
                        'data' => $data,
                    ]);
                } else {
                    return response()->json(['error' => 'Your email is not verified.'], 403);
                }
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong',
                'error' => $th->getMessage(),
                'data' => null,
            ], 500);
}}
    public function chnageProfile(Request $request){
		$params = $request->all();
		$user_id =  Auth::user()->id;
		$user = User::select('id','email','password')->where('id',$user_id)->first();
		if(!$user)
		{
			return response(['status' => 200,'message' => 'Something went wrong']);

		}
		$profile_details = array(
			                          'first_name'    =>  $params['firstname'],   
			                          'last_name'     =>  $params['lastname'],   
			                          'mobile_number' =>  $params['mobile_number'],   
			                          'company_name'  =>  $params['company_name']
		                         ); 
	    $user->update($profile_details);
		return response(['status' => 200,'message' => 'Profile change successfully!!', 'data'=>$profile_details], 200);
	}
    public function generateToken(Request $request)
    {
        
        $request->validate([
            'id' => 'required',
        ]);

        $user = User::where('id', $request->id)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $token = rand(1000,9999);

        VerificationToken::create([
            'token' => $token,
            'user_id' => $user->id,
        ]);
        Mail::raw("Dear User,\n\nYour verification token is: $token\n\nPlease use this token for verification purposes.", function ($message) use ($user) {
            $message->to($user->email)
                    ->subject('Verification Token');
        });


        return response()->json(['message' => 'Verification token generated successfully']);
    }

    public function verifyToken_old(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'token' => 'required',
        ]);

        $user = User::where('id', $request->id)->first();
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        
      
        $verificationToken =DB::table('verification_tokens')->where([['token', $request->token],['user_id', $user->id],['deleted_at', null]])->first();

        if (!$verificationToken) {
            return response()->json(['message' => 'Invalid verification token'], 422);
        }else{
        // Token verified successfully, you can perform any additional actions here if needed.
        VerificationToken::destroy($verificationToken->id);
        // dd($verificationToken);

        return response()->json(['message' => 'Verification token is valid']);
                }

       
    }
    public function getstate()
    {
        try {
            $state=State::all();
       return response()->json(["status"=> 200,
                        "message"=>"State List",
                        "data"=> $state]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred',
                'data' => $e,
            ], 500);
        }
       
    }

    public function getcity(Request $request)
    {
         $state_id = $request->input('id');

        try {
            $cities = City::where('state_id', $state_id)->get();
            return response()->json([
                "status" => 200,
                "message" => "City List",
                "data" => $cities
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred',
                'data' => $e,
            ], 500);
        }
    }
    
    public function sendResetLinkEmail(Request $request)
    {
        try {
            // $request->validate([
            //     'email' => 'required|email|exists:users',
            // ]);
    
            $user = User::where('email', $request->email)->first();
    
            $token = Str::random(15);
            PasswordReset::updateOrCreate(
                ['email' => $user->email],
                ['token' => $token]
            );
            Mail::send([], [], function ($message) use ($user, $token) {
                $message->to($user->email)
                        ->subject('Reset Your Password')
                        ->setBody("Click the link below to reset your password:\n\n" . url("api/reset-password")."<br> $token");
            });
            return response()->json(["status"=> 200,
            "message"=>"Password reset link sent successfully",
            "data"=> $token]);
        } catch (\Exception $e) {
            dd($e);
            return response()->json(["status"=> 500,
            "message"=>"Error",
            "data"=> $e]);
        }
        
        // return response()->json(['message' => 'Password reset link sent successfully','token' => $token]);
    }
    public function chnagePassword(Request $request)
	{
		$params = $request->all();
		$user_id =  Auth::user()->id;
		$user = User::select('id','email','password')->where('id',$user_id)->first();
		if(!$user)
		{
			return response(['status' => 401,'message' => 'Something went wrong']);

		}
		if(!Hash::check($params['oldPwd'],$user->password)) {
			return response(['status' => 401,'message' => 'old password is wrong']);
		}
	    $user->update(['password' => Hash::make($params['newPwd'])]);
		return response(['status' => 200,'message' => 'Password change successfully!!']);
	}
    public function reset(Request $request)
    {
        try {
            $passwordReset = PasswordReset::where('email', $request->email)
                ->where('token', $request->token)
                ->first();
            if (!$passwordReset) {
                return response()->json(['message' => 'Invalid reset token'], 422);
            }
    
            $user = User::where('email', $request->email)->first();
    
            $user->update([
                'password' => Hash::make($request->password)
            ]);
    
            $passwordReset->delete();
            return response()->json(["status"=> 200,
            "message"=>"Password reset successful",
            "data"=> ""]);
        } catch (\Exception $e) {
           
            return response()->json(["status"=> 401,
            "message"=>"Error",
            "data"=> $e]);
        }
        
    }
    
    
    // method for user logout and delete token
    public function profile()
    {
        return response()->json(["status"=> 200,
                        "message"=>"Profile Details",
                        "data"=> auth()->user()]);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'You have successfully logged out and the token was successfully deleted'
        ];
    }

    public function getData()
	{
		return response()->json([
			'laravel' => " @include('layouts.navbar') |  @yield('content') ->  @section('content') @endsection  | @stack('scripts') -> @push('scripts') | @extends('../../layouts/app') @section('title', 'Users')",
			'alpine' => "<div x-data='user_index'>  <template x-for='(user, index ) in users_list' :key=''> x-modal , x-text

						<script type='text/javascript'> document.addEventListener('alpine:init', () => {

					Alpine.data('user_index', () => ({

						init() {
							this.reload();

							let _this = this;

							this.dolar mukvu nextTick( function () {
								_this.myModal = $('#exampleModal').modal();
							});
							
							let php_variable =  @json(dolar  mukvu test); // array hoy to JSON.parse

							console.log(php_variable);
						},

						users_list: [],
						myModal: null,

						reload() {

							let _this = this;

							axios.get('{{ route('users.getAllUsers') }}').then((response) => {
								_this.users_list = response.data.all_users;
							}).catch((err) => {
								console.log(err);
							});
						},

						openModal(user = null ) {
							this.myModal.modal('show');

							Swal.fire({
								title: 'Do you want to save the changes?',
								showDenyButton: true,
								showCancelButton: true,
								confirmButtonText: 'Save',
								denyButtonText: 'Don save'
							}).then((result) => {
								if (result.isConfirmed) {
								} else if (result.isDenied) {
								}
							});
						},

						closeModal() {
							this.myModal.modal('hide');
						}
					}));
				});
			</script>",

			"File upload" => "private function storeProfileImage(UploadedFile dolar file, User dolar  user): void   -- Storage::delete('public/' . user->profileImage['file_path']);  || basename(file->getClientOriginalName(), '.' . file->getClientOriginalExtension()), this->storeFile(file, 'user/{user->id}/') || file->storeAs('public/{rootPath}', path);",
			"fileInput" => "let form_data = new FormData();
			let profile_image = document.getElementById('profile_image');

			if (profile_image && profile_image.files.length > 0) {
				let file = profile_image.files[0];
				form_data.set('profile_image', file, file.name);
			}",

            "extra_data" => BromiEnquiry::all(),
		]);
	}
}
