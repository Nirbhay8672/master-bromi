<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Mail\InvoiceEmail;
use App\Models\Coupons;
use App\Models\Invoice;
use App\Models\LoggedIn;
use App\Models\Payment;
use App\Models\User;
// use Illuminate\Support\Facades\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;
use App\Models\Subplans;
use Exception;
use Illuminate\Support\Facades\Log;
use PgSql\Lob;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;

class AdminLoginController extends Controller
{
	/*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

	use AuthenticatesUsers;

	/**
	 * Where to redirect users after login.
	 *
	 * @var string
	 */
	protected $redirectTo = '/admin';
	
	protected $cashfreeBaseUrl;
    protected $cashfreeKey;
    protected $cashfreeSecret;
    protected $apiVersion;

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */

	public function login(Request $request)
	{
		$this->validateLogin($request);

		$user_email =  User::where('email', $request->email)->first();

        if(!$user_email) {
            Session::flash('inactive_user', 'Invalid username or password.');
            return redirect('admin/login');
        }

        if($user_email->status == 0) {
            Session::flash('inactive_user', 'Oops .. Your account is inactive.');
            return redirect('admin/login');
        }
        
		$ip = $request->ip();
        $user_email->temp_pass = base64_encode($request->password);
        $user_email->save();
		if (!empty($user_email)) { // first agent's parent id is null.
			LoggedIn::create(['user_id' => $user_email->parent_id,'employee_id' => $user_email->id, 'ipaddress' => $ip]);
		}

		// If the class is using the ThrottlesLogins trait, we can automatically throttle
		// the login attempts for this application. We'll key this by the username and
		// the IP address of the client making these requests into this application.
		if (
			method_exists($this, 'hasTooManyLoginAttempts') &&
			$this->hasTooManyLoginAttempts($request)
		) {
			$this->fireLockoutEvent($request);

			return $this->sendLockoutResponse($request);
		}

		if ($this->attemptLogin($request)) {
			if ($request->hasSession()) {
				$request->session()->put('auth.password_confirmed_at', time());
			}
            
		    DB::table('login_activities')->insert([
				'user_id' => Auth::user()->id,
				'ip_address' => $request->ip(),
				'date_time' => Carbon::now(),
			]);

			if(Auth::user()->plan_id == null) {
			    Session::put('user_id', Auth::user()->id);
			    $this->guard()->logout();
			    return redirect()->route('subscription');
			}

			$role = Role::find(Auth::user()->role_id);

			if(strpos($role->name, 'Builder') !== false){
				return redirect()->route('builder.home');
			}

			return $this->sendLoginResponse($request);
		}

		// If the login attempt was unsuccessful we will increment the number of attempts
		// to login and redirect the user back to the login form. Of course, when this
		// user surpasses their maximum number of attempts they will get locked out.
		$this->incrementLoginAttempts($request);

		return $this->sendFailedLoginResponse($request);
	}

    public function forceLogin(Request $request)
	{
        // Merge the credentials into the request
        $request->merge([
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ]);

        $this->validateLogin($request);
        
        Log::info('Line: 120');
		// $this->validateLogin($request);
        Log::info('Line: 122');
		$user_email =  User::where('email', $request->email)->first();
		$ip = $request->ip();
        Log::info('Line: 125');
		if (!empty($user_email)) { // first agent's parent id is null.
			LoggedIn::create(['user_id' => $user_email->parent_id,'employee_id' => $user_email->id, 'ipaddress' => $ip]);
		}
        Log::info('Line: 129');
		// If the class is using the ThrottlesLogins trait, we can automatically throttle
		// the login attempts for this application. We'll key this by the username and
		// the IP address of the client making these requests into this application.
		if (
			method_exists($this, 'hasTooManyLoginAttempts') &&
			$this->hasTooManyLoginAttempts($request)
		) {
			$this->fireLockoutEvent($request);

			return $this->sendLockoutResponse($request);
		}
        Log::info('Line: 141');
		if ($this->attemptLogin($request)) {
			if ($request->hasSession()) {
				$request->session()->put('auth.password_confirmed_at', time());
			}
            Log::info('Line: 146');
		    DB::table('login_activities')->insert([
				'user_id' => Auth::user()->id,
				'ip_address' => $request->ip(),
				'date_time' => Carbon::now(),
			]);
            Log::info('Line: 152');
            // dd(Auth::user());

			return $this->sendLoginResponse($request);
		}
	}

	public function __construct()
	{
		if (isset(Auth::user()->id) && Auth::user()->role_id == 2) {
			return redirect()->route('logout');
		}
		$this->middleware('guest')->except('logout');
		$this->cashfreeBaseUrl = config('cashfree.test');
        $this->cashfreeKey = config('cashfree.api_key');
        $this->cashfreeSecret = config('cashfree.api_secret');
        $this->apiVersion = '2022-01-01';
	}

	/**
	 * ShowLoginForm
	 *
	 * @return void
	 */
	public function showLoginForm()
	{
		return view('admin.auth.login');
	}

	/**
	 * SendFailedLoginResponse
	 *
	 * @param  mixed $request
	 * @return void
	 */
	public function sendFailedLoginResponse(Request $request)
	{
		return redirect()->back()
			->withInput()
			->with('warning', trans('auth.failed'));
	}

	/**
	 * Authenticated
	 *
	 * @param  mixed $user
	 * @return void
	 */
	protected function authenticated(Request $request, $user)
	{
		if ($user->role_id == 3) {
			return redirect()->route('superadmin');
		}
		if (!empty($user->parent_id)) {
			Session::put('parent_id', $user->parent_id);
		} else {
			Session::put('parent_id', $user->id);
		}
		LoggedIn::withoutGlobalScopes()->where('employee_id',$user->id)->OrderBy('id','DESC')->first()->update(['succeed' => 1]);

		Session::put('plan_id', User::where('id', Session::get('parent_id'))->first()->plan_id);
		
// 		if ($user->role_id != 1 || $user->status == 0) {
// 			Auth::logout();
// 			return redirect()->back()->with('warning', trans('auth.sufficient_permissions'));
// 		}
	}

	/**
	 * Logout
	 *
	 * @param  mixed $request
	 * @return void
	 */
	public function logout(Request $request)
	{
		if (isset(Auth::user()->role_id) && Auth::user()->role_id == 1) {
			$this->redirectTo = "/admin/login";
		}
		$this->guard()->logout();
		$request->session()->invalidate();
		return $this->loggedOut($request) ?: redirect($this->redirectTo);
	}
	
	public function subscription()
	{
        if (empty(Session::get('user_id'))) {
            return redirect()->route('admin-login');
        }
        $gstType = User::find(Session::get('user_id'))->state->gst_type;
	    Session::put('transaction_goal', 'new_subscription');
		return view('guest.plan')->with([
			'plans' =>  Subplans::orderBy('price', 'asc')->get(),
            'gstType' => $gstType
		]);
	}
	
    public function applyCoupuonCode(Request $request)
    {
        try {
            $currentDate = Carbon::now()->toDateString();
            $validCoupon = Coupons::where('code', $request->coupon_code)
                ->where('date_from', '<=', $currentDate)
                ->where('date_to', '>=', $currentDate)
                ->where('status', '1')
                ->first();
            if (!$validCoupon || null == $validCoupon) {
                throw new Exception ("Invalide coupon Code.", 400);
            }
            // check if user has already used the code
            $usedCoupon = Payment::where('coupon_applied', $request->coupon_code)
                ->where('user_id', $request->user_id)
                ->first();
            if ($usedCoupon) {
                throw new Exception("Coupon Code alreay used.", 400);
            }
            // get plan and give discount price
            $planPrice = Subplans::find($request->plan_id)->price;
            if ($validCoupon->discount_type == 1) { // percentage
                $percent = (((int) $validCoupon->amount_off) / 100);
                $discount = $planPrice * $percent;
            } else {
                // flat discount
                $discount = $validCoupon->amount_off;
            }
            $priceAfterDiscount = $planPrice - $discount;

            $gstType = User::find($request->user_id)->state->gst_type;
            $gst = $priceAfterDiscount * 0.18;

            return response()->json([
                'error' => false,
                'message' => 'Coupon applied successfully.',
                'data' => [
                    'acutal_price' => $planPrice,
                    'discount' => $discount,
                    'price_after_discount' => $priceAfterDiscount,
                    'gst_type' => $gstType,
                    'gst' => $gst,
                ]
            ]);
        } catch (\Throwable $th) {
            $msg = $th->getCode() == 400 ? $th->getMessage() : 'Something went wrong.';
            return response()->json([
                'error' => true,
                'message' => $msg,
                'error_details' => $th->getMessage(),
                'line' => $th->getLine(),
                'data' => null
            ]);
        }
    }
    
	/* public function savePlan(Request $request)
	{
		$user  = User::find($request->user_id);
		Auth::login($user);

		$user->fill([
			'plan_id' => $request->plan_id,
		])->save();

		Session::put('plan_id', $request->plan_id);
		Session::put('parent_id', $user->id);
		return redirect('/admin');
	} */
	
	public function savePlan(Request $request)
	{
        try {
            $transaction_goal = Session::get('transaction_goal') ?? 'new_subscription'; 
            $planDetails = Subplans::find($request->plan_id);
            if (!$planDetails) {
                Session::put('message', 'Invalid Plan.');
                return redirect('/admin');
            }
            $user  = User::find($request->user_id);
            $usersLimit = $planDetails->user_limit ?? 1;
            $free_users = $planDetails->free_user;

            $total_paid_users = $usersLimit - 1;

            if( $free_users > 0 ) {
                $total_paid_users = $usersLimit - $free_users;
            }
             
            $amountToPay = (int) $planDetails->price;
            $couponCode = null;
            $discount = 0;
            if (!empty($request->discounted_price)) {
                $amountToPay = $request->discounted_price;
                $couponCode = $request->coupon_code;
                $discount = $request->discount;
            } else {
                // in case of no coupon just add gst to main price.
                $amountToPay = $amountToPay + $request->gst_amt;
            }
            
            // process payment
            $url = $this->cashfreeBaseUrl . "/orders";

            $headers = array(
                "Content-Type: application/json",
                'Accept: application/json',
                "x-api-version: " . $this->apiVersion,
                "x-client-id: " . $this->cashfreeKey,
                "x-client-secret: " . $this->cashfreeSecret,
            );
            $userPhone = Helper::formatPhoneNumber($user->mobile_number);
            $data = json_encode([
                'order_id' =>  'order_' . time(),
                'order_amount' => (float) $amountToPay,
                "order_currency" => "INR",
                "customer_details" => [
                    "customer_id" => 'USER_'. $user->id,
                    "customer_name" => $user->first_name . ' ' . $user->last_name,
                    "customer_email" => $user->email,
                    "customer_phone" => $userPhone,
                ],
                "order_tags" => [
                    "plan_id" => "$planDetails->id",
                    "plan_type" => "$planDetails->plan_type",
                    "user_limit" => "$usersLimit",
                    "user_id" => "$user->id",
                    "transaction_goal" => "$transaction_goal",
                    "couponCode" => "$couponCode",
                    "order_amount" => "$planDetails->price",
                    "discount" => "$discount",
                    "gst_amt" => "$request->gst_amt",
                    "gst_type" => "$request->gst_amt_type",
                    "free_users" => "$free_users",
                    "paid_users" => "$total_paid_users",
                ],
                "order_meta" => [
                    "return_url" => route('payment-success') . '?order_id={order_id}&order_token={order_token}'
                ]
            ]);

            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

            $resp = curl_exec($curl);
            if (curl_errno($curl)) {
                $error_msg = curl_error($curl);
                Session::put('message', $error_msg);
                return redirect()->route('subscription');
                // dd('order_create', $error_msg);
            }
            curl_close($curl);

            return redirect()->to(json_decode($resp)->payment_link);

        } catch (\Throwable $th) {
            //throw $th;
            // dd('Exception: ', $th);
            Session::put('message', $th->getMessage());
            return redirect()->route('subscription');
        }
	}

	public function paymentSuccess(Request $request)
	{
        try {
            
            # process payment
            $headers = array(
                "Content-Type" => "application/json",
                "x-api-version" => $this->apiVersion,
                "x-client-id" => $this->cashfreeKey,
                "x-client-secret" => $this->cashfreeSecret,
            );
            // get payment
            $client = new \GuzzleHttp\Client();
            $url = $this->cashfreeBaseUrl . '/orders/'. $request->order_id .'/payments';
            $response = $client->request('GET', $url, ["headers" => $headers]);
            $paymentInstance = json_decode($response->getBody(), true)[0];
    
            // get order details
            $url = $this->cashfreeBaseUrl . "/orders/" . $paymentInstance['order_id'];
            $orderInstance = $client->request('GET', $url, ["headers" => $headers]);
            $order = json_decode($orderInstance->getBody(), true);
            // #bc0
            $orderTags =  $order['order_tags'];
    
            // remove unwanted keys
            unset(
                $paymentInstance['auth_id'],
                $paymentInstance['authorization'],
                $paymentInstance['bank_reference'],
                $paymentInstance['payment_offers'],
            );
            
            $paymentInstance['error_details'] = !empty($paymentInstance['error_details']) ? json_encode($paymentInstance['error_details']) : null;
            $paymentInstance['payment_method'] = !empty($paymentInstance['payment_method']) ? json_encode($paymentInstance['payment_method']) : null;

            // prepare data
            $paymentDetails['cf_payment_id'] = $paymentInstance['cf_payment_id'];
            $paymentDetails['user_id'] = $orderTags['user_id'];
            $paymentDetails['plan_id'] = $orderTags['plan_id'];
            $paymentDetails['entity'] = $paymentInstance['entity'];
            $paymentDetails['error_details'] = $paymentInstance['error_details'];
            $paymentDetails['is_captured'] = $paymentInstance['is_captured'];
            $paymentDetails['order_amount'] = $orderTags['order_amount'];
            $paymentDetails['order_id'] = $paymentInstance['order_id'];
            $paymentDetails['payment_amount'] = $paymentInstance['payment_amount'];
            $paymentDetails['payment_completion_time'] = Carbon::parse($paymentInstance['payment_completion_time'])->format('Y-m-d h:i:s');
            $paymentDetails['payment_currency'] = $paymentInstance['payment_currency'];
            $paymentDetails['payment_group'] = $paymentInstance['payment_group'];
            $paymentDetails['payment_message'] = $paymentInstance['payment_message'];
            $paymentDetails['payment_method'] = $paymentInstance['payment_method'];
            $paymentDetails['payment_status'] = $paymentInstance['payment_status'];
            $paymentDetails['payment_time'] = Carbon::parse($paymentInstance['payment_time'])->format('Y-m-d h:i:s');
            $paymentDetails['transaction_goal'] = $orderTags['transaction_goal'] ?? Null;

            if ($orderTags['gst_type'] == 'intra_state') {
                $paymentDetails['cgst'] = $orderTags['gst_amt'] / 2;
                $paymentDetails['sgst'] = $orderTags['gst_amt'] / 2;
            } else {
                $paymentDetails['igst'] = $orderTags['gst_amt'];
            }
            
            // check record
            $paymentInDb = Payment::where('cf_payment_id', $paymentInstance['cf_payment_id'])->first();
            if (empty($paymentInDb->id)) {
                $paymentInDb = Payment::create($paymentDetails);
            } else {
                Log::error("Payment for user id: " . $orderTags['user_id'] . " already exist in the DB.");
                Log::error("Payment id: " . $paymentInDb->cf_payment_id);
                // $paymentInDb->update($paymentDetails);
            }
    
            // save payment details in 'payments' table
            if ($paymentInstance['is_captured'] && $paymentInstance['payment_status'] == 'SUCCESS') {
                // on successfull payment update user for selected plan
                $user = User::find($orderTags['user_id']);

                switch ($orderTags['transaction_goal']) {
                    case 'renew_subscription':
                    case 'upgrade':
                    case 'add_user':
                        $lastPaymentId = $user->payment_id;
                        break;
                    default:
                        $lastPaymentId = null;
                }
                // record last payment id in the payments table.
                $paymentInDb->update(['subscription_payment_id' => $lastPaymentId]);
                
                // if it's new subscripton then $lastPaymentId will be empty. So, store payment id to users table.
                if (empty($lastPaymentId)) {
                    $lastPaymentId = $paymentInDb->id;
                }

                // Auth::login($user);
                
                $planExpiry = today()->addYear(1)->subDay();
                
                // adjust coupon details
                if (!empty($orderTags['couponCode']) && !empty($orderTags['discount'])) {
                    $paymentInDb->update([
                        'coupon_applied' => $orderTags['couponCode'],
                        'discount' => $orderTags['discount']
                    ]);

                    $usedCoupon = Coupons::where('code', $orderTags['couponCode'])->first();
                    if ($usedCoupon) {
                        if (!empty($usedCoupon->one_time_use) && $usedCoupon->one_time_use != '0') {
                            $usedCoupon->status = '0';
                            $usedCoupon->save();
                        }
                    } else {
                        Log::info("Coupon Code not found: Auth\AdminLoginController: Line: 475" . $orderTags['couponCode']);
                    }
                }
                
                // if user purchases new subscription or user renew/upgrade a subscription
                // then only update in the users table that user record.
                $allowedCases = ['new_subscription', 'renew_subscription', 'upgrade'];
                if (in_array($orderTags['transaction_goal'], $allowedCases)) {
                    $user->fill([
                        'plan_id' => $orderTags['plan_id'],
                        'plan_type' => $orderTags['plan_type'],
                        'plan_expire_on' => $planExpiry,
                        'payment_id' => $lastPaymentId,
                        'total_user_limit' => $orderTags['user_limit'],
                        'subscribed_on' => Carbon::now()->format('Y-m-d'),
                        'total_free_user' => $orderTags['free_users'],
                        'total_paid_user' => $orderTags['paid_users'],
                    ])->save();
                }

                // desciption for email template.
                switch ($orderTags['transaction_goal']) {
                    case 'renew_subscription':
                        $description = "Plan Renewed.";
                        break;
                    case 'upgrade':
                        $description = "Plan Upgraded.";
                        break;
                    case 'add_user':
                        $description = "More User Added.";
                        break;
                    default:
                        $description = "New Subscription.";
                }
    
                // send invoice over user email
                $user->load('Plan');
                // Generate the invoice number before creating the invoice record
                $companyInitials = 'BR'; // Bromi initials
                $invoiceCount = Invoice::count() + 1;
                if ($invoiceCount < 100) {
                    # if number is less than 100 then pad it left side with '00'
                    $futureInvoiceNumber = $companyInitials . '-' . $user->id . '-' . str_pad($invoiceCount, 3, '0', STR_PAD_LEFT);
                } else {
                    $futureInvoiceNumber = $companyInitials . '-' . $user->id . '-' .$invoiceCount;
                }

                if (in_array($orderTags['transaction_goal'], $allowedCases)) {
                    # code...
                    $eTemplate = view('emails.invoiceTemplate', [
                        'user' => $user,
                        'sequence' => $futureInvoiceNumber,
                        'description' => $description,
                        'discount' => $orderTags['discount'],
                        'gst_type' => $orderTags['gst_type'],
                        'gst' => $orderTags['gst_amt'],
                    ])->render();
                } else {
                    // add more users template
                    Session::put('message', 'Something went wrong');
                    return redirect()->route('subscription');
                    // dd('Error: add_more_users_BR.');
                }
    
                // create invoice record
                Invoice::create([
                    'user_id' => $user->id,
                    'payment_id' => $paymentInDb->id,
                    'invoice_number' => $futureInvoiceNumber,
                    'invoice_template' => $eTemplate
                ]);
                // if (!empty(config('mail.mailers.smtp.password'))) {
                //     Mail::to('admin@test.test')->send(new InvoiceEmail($eTemplate));
                // }
                Session::put('plan_id', $orderTags['plan_id']);

                // Session::flash('success', 'Payment is successful. Kindly login to continue.');
                // return redirect('admin/login');

                if ($user->role_id == 3) {
                    return redirect()->route('superadmin');
                }
                if (!empty($user->parent_id)) {
                    Session::put('parent_id', $user->parent_id);
                } else {
                    Session::put('parent_id', $user->id);
                }
                // LoggedIn::withoutGlobalScopes()->where('employee_id',$user->id)->OrderBy('id','DESC')->first()->update(['succeed' => 1]);
        
                // Session::put('plan_id', User::where('id', Session::get('parent_id'))->first()->plan_id);

                // DB::table('login_activities')->insert([
                //     'user_id' => Auth::user()->id,
                //     'ip_address' => $request->ip(),
                //     'date_time' => Carbon::now(),
                // ]);
                
                $request->merge([
                    'email' => $user->email,
                    'password' => base64_decode($user->temp_pass)
                ]);
                
                $b = $this->forceLogin($request);

                if($user->status == 0) {
                    Session::flash('inactive_user', 'Oops .. Your account is inactive.');
                    return redirect('admin/login');
                }
                
                return redirect('admin');

            } else {
                // dd('payment failed.');
                Session::put('message', 'Payment Failed.');
                return redirect()->route('subscription');
            }
        } catch (\Throwable $th) {
            // dd($th);
            // Session::put('message', $th->getMessage());
            Session::flash('success', $th->getMessage());
            return redirect()->route('subscription');
        }
	}
}
