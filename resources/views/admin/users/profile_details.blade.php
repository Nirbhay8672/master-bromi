@extends('admin.layouts.app')
@section('content')
<style>
    .qty-box {
        width: 130px;
        margin: 0 auto;
        border-radius: 5px;
        overflow: hidden;
    }
    input.total-price {
        width: 70px;
        text-align: center;
        background-color: #bbb;
        border-radius: 4px;
        border: 0;
    }
    .value-box {
        border: 1px solid blue;
    }
    .pay-now {
        padding: 4px 10px;
        border-radius: 4px;
        font-size: 12px;
        margin-top: 10px;
    }
    .plan-column {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
    }
    #plan-details {
        width: 320px;
        margin: 0 auto;
    }
    .plan-label {
        font-weight: bold;
    }
</style>
<!-------------Change Password Model----------------->
<div class="modal fade" id="changepwModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
                <button class="btn-close btn-light" type="button" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="modal-body">
                @csrf
                <div class="row gy-3 mt-2">
                    <div class="form-group col-12 mb-3">
                        <div class="fname">
                            <input type="password" placeholder="Old Password" name="oldpwd" class="form-control" id="oldpwd" style="text-transform:none;">
                        </div>
                    </div>
                    <div class="form-group col-12 mb-3">
                        <div class="fname">
                            <input type="password" placeholder="New Password" name="newpwd" class="form-control" id="newpwd" style="text-transform:none;">
                        </div>
                    </div>
                    <div class="form-group col-12 mb-3">
                        <div class="fname">
                            <input type="password" placeholder="Confirm Password" name="matchpwd" class="form-control" id="matchpwd" style="text-transform:none;">
                        </div>
                    </div>
                    <input type="hidden" name="shar_string" id="shar_string">
                </div>
                <p class="error-message" style="color:red"></p>
                <div class="text-center">
                    <button class="btn btn-success" style="border-radius: 5px;" type="button" id="updatepwd">Update</button>
                    <button class="btn btn-secondary ms-2" style="border-radius: 5px;" type="button" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!--------------------------------------------------->
<!-------------    User Profile Model  -------------->
<div class="modal fade" id="userpfmodel" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">User Profile</h5>
                <button class="btn-close btn-light" type="button" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="modal-body">
                <form class="form-bookmark needs-validation" method="post" id="modal_form" novalidate="">
                    <div class="row">
                        <div class="form-group col-md-6 m-b-4 mb-3">
                            <div class="fname {{ $user->first_name ? 'focused' : '' }}">
                                <label for="firstname">First Name</label>
                                <input type="text" name="firstname" class="form-control" id="firstname" value="{{ $user->first_name }}">
                            </div>
                        </div>
                        <div class="form-group col-md-6 m-b-4 mb-3">
                            <div class="fname {{ $user->last_name ? 'focused' : '' }}">
                                <label for="lastname">Last Name</label>
                                <input type="text" name="lastname" class="form-control" id="lastname" value="{{ $user->last_name }}">
                            </div>
                        </div>
                        <div class="form-group col-md-6 m-b-4 mb-3">
                            <div class="fname {{ $user->email ? 'focused' : '' }}">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" id="email" value="{{ $user->email }}" style="text-transform:none;" disabled>
                            </div>
                        </div>
                        <div class="form-group col-md-6 m-b-4 mb-3">
                            <div class="fname {{ $user->mobile_number ? 'focused' : '' }}">
                                <label for="mobile_number">Mobile Number</label>
                                <input type="text" name="mobile_number" class="form-control" id="mobile_number" value="{{ $user->mobile_number }}">
                            </div>
                        </div>
                        <div class="form-group col-md-6 m-b-4 mb-3">
                            <div class="fname {{ $user->company_name ? 'focused' : '' }}">
                                <label for="company_name">Company Name</label>
                                <input type="text" name="company_name" class="form-control" id="company_name" value="{{ $user->company_name }}">
                            </div>
                        </div>
                        <div class="form-group col-md-6 m-b-4 mb-3">
                            <div class="fname {{ $user->rera ? 'focused' : '' }}">
                                <label for="rera">Rera</label>
                                <input type="text" name="rera" class="form-control" id="rera" value="{{ $user->rera }}">
                            </div>
                        </div>
                        <div class="form-group col-md-6 m-b-4 mb-3">
                            <div class="fname {{ $user->gst ? 'focused' : '' }}">
                                <label for="gst">GST</label>
                                <input type="text" name="gst" class="form-control" id="gst" value="{{ $user->gst }}">
                            </div>
                        </div>
                        <div class="form-group col-md-6 m-b-4 mb-3">
                            <input type="file" name="profile_image" class="form-control" id="profile_image" accept="image/png, image/jpeg" style="border: 1px solid black;border-radius: 5px;">
                        </div>
                        <div class="form-group col-12 m-b-4 mb-3">
                            <label>Address</label>
                            <div class="fname {{ $user->address ? 'focused' : '' }}">
                                <textarea type="text" name="address" class="form-control" placeholder="Enter address" id="address">{{ $user->address ?? '-' }}</textarea>
                            </div>
                        </div>
                        <input type="hidden" name="shar_string" id="shar_string">
                    </div>
                </form>
                <p class="error-message" style="color:red"></p>
                <div class="text-center">
                    <button class="btn btn-success" style="border-radius: 5px;" type="button" id="updateprofile">Edit</button>
                    <button class="btn btn-secondary ms-3" type="button" style="border-radius: 5px;" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!--------------------------------------------------->
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">

            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->

    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="page-title mb-3" style="margin-left: 10px;">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <h3 class="text-white">Profile Details</h3>
                        </div>
                    </div>
                </div>
                <div class="user-profile">
                    <div class="row p-2">
                        <div class="col-sm-12">
                            <div class="card profile-header" style="height:auto;background-image: url(&quot;../assets/images/user-profile/bg-profile.jpg&quot;); background-size: cover; background-position: center center; display: block;">
                                <div class="row">
                                    <div class="col-12 col-sm-4 col-md-4 col-lg-4">
                                        <div class="userpro-box" style="background-color: #e8e9ec !important;border:1px solid black;border-radius:5px;width:100% !important;">
                                            <div class="img-wrraper">
                                                <img src="{{ Auth::user()->company_logo ? asset('storage/file_image'.'/'.Auth::user()->company_logo) : asset('Bromi-Logo-card.png')}}" alt="Avatar" style="width:150px;height:150px;">
                                            </div>
                                            <div class="user-designation">
                                                <div class="title"><a target="_blank" href="">
                                                        <h4>{{ $user->company_name }}</h4>
                                                        <h6>( Company )</h6>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="row mt-5 text-center">
                                                <div class="col">
                                                    <button tabindex="0" data-toggle="tooltip" class="btn btn-secondary btn-sm btn-edit tooltip-btn" data-tooltip="Update Profile" style="border-radius: 5px;width:42px;" title="Edit Profile">
                                                        <i class="fa fa-pencil"></i>
                                                    </button>
                                                    <button class="btn btn-secondary text-center changepwd ms-4 tooltip-btn" data-tooltip="Update Password" style="border-radius: 5px;width:42px;" title="Update Password">
                                                        <i class="fa fa-lock"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        @if (Auth::user()->role_id == 1)
                                            <div class="userpro-box" style="margin-top:100px;background-color: #e8e9ec !important;border:1px solid black;border-radius:5px;">

                                                @if(Auth::user()->total_paid_user > 0 )
                                                <div class="">
                                                    <p class="mb-0">
                                                        <h3>Add More Users</h3>
                                                        
                                                        <p><strong>( Per User Price: <span id="perUserPrice">{{$user->Plan->extra_user_price ?? '0' }}</span>/- )</strong></p>
                                                        @if (empty($user->Plan->extra_user_price))
                                                            <p class="m-0 text-danger" style="font-size:10px;">Extra user price not available.</p>
                                                        @endif
                                                    </p>
                                                </div>
                                                <fieldset class="qty-box">
                                                    <div class="input-group bootstrap-touchspin">
                                                        <input id="valueBox" readonly class="touchspin text-center form-control value-box" type="text" value="0" style="display: block;">
                                                    </div>
                                                </fieldset>

                                                <form id="userLimitForm" action="{{route('admin.increaseUserLimit')}}" method="post">
                                                    <p class="price-section mt-4 mb-0"> 
                                                        <strong>Total: <input type="text" id="usersLimitPrice" name="users_limit_price" readonly class="total-price" value="0"></strong>
                                                    </p>
                                                    @csrf
                                                    @php
                                                        $gst_type = Auth::user()->state->gst_type;
                                                        Session::put('transaction_goal', 'add_user');
                                                    @endphp
                                                    <input type="hidden" id="cpn_code" name="coupon_code", value=''>
                                                    <input type="hidden" name="transaction_goal", value='add_user'>
                                                    <input type="hidden" id="userLimit" name="users_limit" value="0">
                                                    <input type="hidden" name="gst_amt" value="" class="form-control mt-2" id="gstAmt">
                                                    <input type="hidden" name="gst_amt_type" class="form-control mt-2" value="{{ $gst_type }}" id="gstAmtType">
                                                    <input type="hidden" name="discounted_price" value="" class="form-control mt-2" id="discounted_price">
                                                    <input type="hidden" name="discount" value="" class="form-control mt-2" id="discount">
                                                    <button style="display: none;"
                                                        class="btn btn-primary btn-lg pay-now mt-5"
                                                        id="pay-now-btn" 
                                                        type="button"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#userLimitModal"
                                                        onclick="setDetails('{{ $gst_type }}')"
                                                    >Pay Now</button>
                                                    <br/>
                                                    <button style="visibility:hidden;"
                                                        class="btn btn-primary btn-lg pay-now" 
                                                        id="payment-btn" 
                                                        type="submit"
                                                    >Continue</button>
                                                    
                                                </form>

                                                @else

                                                    <strong>No more paid user please purchase plan</strong>

                                                    <div class="pricing-list mt-3">
                                                        <a href="{{ route('admin.plans') }}" class="btn btn-secondary mt-2 " style="border-radius: 5px;">Purchase Plan</a>
                                                    </div>
                                                    
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-12 col-sm-8 col-md-8 col-lg-8">
                                        <div class="bg-white p-3 post-about h-100" style="background-color: #e8e9ec !important;border:1px solid black;border-radius:5px;">
                                            <div class="row">
                                                <div class="col-xxl-6">
                                                    <ul>
                                                        <li>
                                                            <div class="icon"><i data-feather="user"></i></div>
                                                            <div>
                                                                <h5>{{ $user->first_name }} {{ $user->last_name }} </h5>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="icon"><i data-feather="mail"></i></div>
                                                            <div>
                                                                <h5 style="text-transform: none;">{{ $user->email }} </h5>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="icon"><i data-feather="phone"></i></div>
                                                            <div>
                                                                <h5>{{ $user->mobile_number }}
                                                                </h5>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="icon"><i data-feather="map-pin"></i></div>
                                                            <div>
                                                                <h5>{{ isset($user->State->name) ? $user->State->name : '' }}
                                                                </h5> <small class="text-muted">( State )</small>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="icon"><i data-feather="map-pin"></i></div>
                                                            <div>
                                                                <h5>{{ isset($user->city_name) ? $user->city_name : '' }}</h5>
                                                                <small class="text-muted">( City )</small>
                                                            </div>
                                                        </li>
                                                        @if(isset($user->address))
                                                        <li>
                                                            <div class="icon"><i data-feather="map-pin"></i></div>
                                                            <div>
                                                                <h5>{{ isset($user->address) ? $user->address : '' }}
                                                                </h5>
                                                            </div>
                                                        </li>
                                                        @endif
                                                    </ul>
                                                </div>
                                                <div class="col-xxl-6">
                                                    <ul>
                                                        <li>
                                                            <div class="icon"><i data-feather="briefcase"></i></div>
                                                            <div>
                                                                <h5>{{ $user->company_name }}</h5>
                                                                <small class="text-muted">( Company Name )</small>
                                                            </div>
                                                        </li>
                                                        @if($user->rera)
                                                        <li>
                                                            <div class="icon"><i data-feather="briefcase"></i></div>
                                                            <div>
                                                                <h5>{{ $user->rera }}</h5>
                                                                <small class="text-muted">( Rera Number )</small>
                                                            </div>
                                                        </li>
                                                        @endif
                                                        @if($user->gst)
                                                        <li>
                                                            <div class="icon"><i data-feather="briefcase"></i></div>
                                                            <div>
                                                                <h5>{{ $user->gst }}</h5>
                                                                <small class="text-muted">( Gst Number )</small>
                                                            </div>
                                                        </li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row p-2">
                                                <div class="col-4">
                                                    <div class="card o-hidden">
                                                        <div class="card-body bg-light-green">
                                                            <div class="media static-widget my-3">
                                                                <div class="media-body text-center">
                                                                    <h1 class="font-roboto">{{ $user_count }}</h1>
                                                                    <h3 class="mb-0">Total Sub Users</h3>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="card o-hidden">
                                                        <div class="card-body bg-light-orange">
                                                            <div class="media static-widget my-3">
                                                                <div class="media-body text-center">
                                                                    <h1 class="font-roboto">{{ $user->total_user_limit ? $user->total_user_limit - $user_count : 0 }} / {{ $user->total_user_limit ??  0 }}</h1>
                                                                    <h3 class="mb-0">Remaining Users</h3>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="card o-hidden">
                                                        <div class="card-body bg-info">
                                                            <div class="media static-widget my-3">
                                                                <div class="media-body text-center">
                                                                    <h1 class="font-roboto">{{ $total_property }}</h1>
                                                                    <h3 class="mb-0">Total Properties</h3>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="card o-hidden">
                                                        <div class="card-body bg-light-purpel">
                                                            <div class="media static-widget my-3">
                                                                <div class="media-body text-center">
                                                                    <h1 class="font-roboto">{{ $total_project }}</h1>
                                                                    <h3 class="mb-0">Total Projects</h3>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="card o-hidden">
                                                        <div class="card-body bg-secondary">
                                                            <div class="media static-widget my-3">
                                                                <div class="media-body text-center">
                                                                    <h1 class="font-roboto">{{ $total_enquiry }}</h1>
                                                                    <h3 class="mb-0">Total Enquiries</h3>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- user profile header end-->
                        <div class="col-xl-4 col-lg-12 col-md-5 xl-35">
                            <div class="default-according style-1 faq-accordion job-accordion">
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="p-0">
                                                    <button class="btn btn-link ps-0" data-bs-toggle="collapse" data-bs-target="#collapseicon2" aria-expanded="true" aria-controls="collapseicon2">Plan Details</button>
                                                </h5>
                                            </div>
                                            @if($user->plan_id > 0)
                                            <div class="collapse show h-100" id="collapseicon2" aria-labelledby="collapseicon2" data-parent="#accordion">
                                                <div class="card-body post-about h-100">
                                                    @foreach ($plans as $plan)
                                                    @if ($user->plan_id == $plan->id)
                                                    <div class="col">
                                                        <div class="pricing-block card text-center h-100">
                                                            <div class="mb-3 mt-5">
                                                                <h2>{{ $plan->name }}</h2>
                                                            </div>
                                                            <div class="pricing-header">
                                                                <div class="price-box">
                                                                    <div>
                                                                        <h3>{{ $plan->price }}</h3>
                                                                        <p>/ Year</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="pricing-list h-100">
                                                                <p>Upto {{ $plan->user_limit }} Users</p>
                                                                <p>Free {{ $plan->free_user }} Users</p>
                                                                @if (!empty($plan->details) && !empty(explode('_---_', json_decode($plan->details, true))))
                                                                <h3>Features</h3>
                                                                @foreach (explode('_---_', json_decode($plan->details, true)) as $feature)
                                                                <p>{{ $feature }}</p>
                                                                @endforeach
                                                                @endif
                                                                <a href="{{ route('admin.plans') }}" class="btn btn-secondary mt-2 tooltip-btn" data-tooltip="Upgrade Plan" style="border-radius: 5px;width:42px;" tabindex="0" data-toggle="tooltip" title="Upgrade"><i class="fa fa-wrench"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endif
                                                    @endforeach
                                                    <div class="text-center">
                                                        <h5 class="mb-3">Subscribed On :
                                                            {{ \Carbon\Carbon::parse($user->subscribed_on)->format('d/m/Y') }}
                                                        </h5>
                                                        <h5>Valid Till :
                                                            {{ \Carbon\Carbon::parse($user->plan_expire_on)->format('d/m/Y') }}
                                                        </h5>
                                                        @php
                                                        $lastPay = \App\Models\Payment::where('user_id', Auth::user()->id)->get()->last();
                                                        @endphp
                                                        <p class="border-top mt-3" ></p>
                                                        <h4>Last Payment</h4>
                                                        <p class="border-top mt-3" ></p>
                                                        <div class="row mt-3">
                                                            <div class="col-12 d-flex">
                                                                <div class="col-6">
                                                                    <strong>Paid For</strong>
                                                                </div>
                                                                <div class="col-6">
                                                                    <strong>Amount</strong>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 d-flex">
                                                                <div class="col-6">
                                                                    <strong class="text-muted">{{ucfirst(str_replace('_', ' ', $lastPay->transaction_goal ?? '-'))}}</strong>
                                                                </div>
                                                                <div class="col-6">
                                                                    <strong class="text-muted">{{ $lastPay->payment_amount ?? '-' }}</strong>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-8 col-lg-12 col-md-7 xl-65">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h3 class="text-center mb-3">Transaction Details</h3>
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <thead style="background-color: rgba(223, 223, 223, 0.804)">
                                                        <tr>
                                                            <th>Transaction Date Time</th>
                                                            <th>Order Id</th>
                                                            <th>Amount</th>
                                                            <th>Plan For</th>
                                                            <th>Plan Name</th>
                                                            <th>Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if(count($transactions) > 0)
                                                        @foreach($transactions as $transaction)
                                                        <tr>
                                                            <td>{{ $transaction->payment_completion_time ? \Carbon\Carbon::parse($transaction->payment_completion_time)->format('d/m/Y h:i:s A') : '-' }}</td>
                                                            <td>{{ $transaction->order_id }}</td>
                                                            <td>{{ $transaction->payment_amount }}</td>
                                                            <td>
                                                                @php
                                                                    if (in_array($transaction->transaction_goal, ['new_subscription', 'renew_subscription'])) {
                                                                        echo 'Annual';
                                                                    } else {
                                                                        echo ucfirst(str_replace('_',' ',$transaction->transaction_goal));
                                                                    }
                                                                    
                                                                @endphp
                                                                {{-- {{ ucfirst(str_replace('_',' ',$transaction->transaction_goal)) }} --}}
                                                            </td>
                                                            <td>{{ $transaction->plan_name }}</td>
                                                            <td>{{ $transaction->payment_status }}</td>
                                                        </tr>
                                                        @endforeach
                                                        @else
                                                        <tr>
                                                            <td colspan="6" class="text-center">No record found</td>
                                                        </tr>
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h3 class="text-center mb-3">Last 10 Open Tickets</h3>
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <thead style="background-color: rgba(223, 223, 223, 0.804)">
                                                        <tr>
                                                            <th>Ticket Id</th>
                                                            <th>Title</th>
                                                            <th>Category</th>
                                                            <th>Priority</th>
                                                            <th>Message</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if(count($tickets) > 0)
                                                        @foreach($tickets as $ticket)
                                                        <tr>
                                                            <td>{{ $ticket->ticket_id }}</td>
                                                            <td>{{ $ticket->title }}</td>
                                                            <td>{{ $ticket->category_name }}</td>
                                                            <td>{{ $ticket->priority }}</td>
                                                            <td>{{ $ticket->message }}</td>
                                                        </tr>
                                                        @endforeach
                                                        @else
                                                        <tr>
                                                            <td colspan="5" class="text-center">No record found</td>
                                                        </tr>
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @php
        $city_encoded = json_encode($cities);
        $state_encoded = json_encode($states);
        @endphp
        {{-- increase user limit modal --}}
        <div class="modal fade" id="userLimitModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop='static'>
            <div class="modal-dialog modal-l" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Summary</h5>
                        <button class="btn-close btn-light" type="button" data-bs-dismiss="modal" aria-label="Close"> </button>
                    </div>
                    <div class="modal-body">
                        <div class="d-flex justify-content-between mb-3">
                            <div class="d-flex  flex-column">
                                <input
                                    class="form-control p-2 m-r-10"
                                    type="text"
                                    {{-- name="coupon_code" --}}
                                    id="coupon_code"
                                    {{-- onkeydown="checkavailable()" --}}
                                    placeholder="Enter coupon code"
                                >
                                <p class="text-danger" id="coupon_code_msg"></p>
                            </div>
                            <span>
                                <button class="btn btn-sm btn-primary rounded" id="apply-btn" type="button">Apply</button>
                            </span>
                        </div>
                        
                        <div id="plan-details" class="m-b-20">
                            <div class="plan-row">
                                <div class="plan-column">
                                    <span class="plan-label">Users Count</span>
                                    <span id="user-count-col">0</span>
                                </div>
                                <div class="plan-column">
                                    <span class="plan-label">Gross</span>
                                    <span id="plan-price-col">0</span>
                                </div>
                                <div class="plan-column">
                                    <span class="plan-label">Discount</span>
                                    <span id="plan-discount-col">0</span>
                                </div>
                                <div class="plan-column">
                                    <span class="plan-label">Subtotal</span>
                                    <span id="plan-price-gross">0</span>
                                </div>
                                <div class="plan-column d-none" id="cgst">
                                    <span class="plan-label">cgst(9%)</span>
                                    <span id="cgst-col">0</span>
                                </div>
                                <div class="plan-column d-none" id="sgst">
                                    <span class="plan-label">sgst(9%)</span>
                                    <span id="sgst-col">0</span>
                                </div>
                                <div class="plan-column d-none" id="igst">
                                    <span class="plan-label">igst(18%)</span>
                                    <span id="igst-col">0</span>
                                </div>
                            </div>
                            <div class="plan-row">
                                <div class="plan-column m-t-10 border-top">
                                    <span class="plan-label">Grand Total</span>
                                    <span id="plan-price-amt">0</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-3 text-center">
                            <div class="col">
                                <button class="btn btn-sm btn-primary custom-theme-button me-3" id="pay_for_users" type="button">Continue</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- increase user limit modal End --}}
        @endsection

        
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script>

            let total_paid_user = JSON.parse(@json($user->total_paid_user));
                  
            function setDetails(gstType) {
                let amount = $('#usersLimitPrice').val();
                let userCount = $('#valueBox').val();
                if (!amount) {
                    console.log('Amount not found.');
                    return;
                }
                let gst = amount * 0.18;
                let gstAMT = document.getElementById('gstAmt');
                let igst = document.getElementById('igst-col');
                let sgst = document.getElementById('sgst-col');
                let cgst = document.getElementById('cgst-col');
                let planPriceAmt = document.getElementById('plan-price-amt');
                if (gstType == 'intra_state') {
                    sgst.textContent = parseFloat(gst/2).toFixed(2);
                    cgst.textContent = parseFloat(gst/2).toFixed(2);
                    $('#sgst').removeClass('d-none');
                    $('#cgst').removeClass('d-none');
                } else {
                    igst.textContent = parseFloat(gst).toFixed(2);
                    $('#igst').removeClass('d-none');
                }
                let totalAmt = parseFloat(gst) + parseFloat(amount);
                gstAMT.value = gst;
                $('#plan-price-col').text(parseFloat(amount).toFixed(2));
                $('#plan-price-gross').text(parseFloat(amount).toFixed(2));
                $('#user-count-col').text(userCount);
                planPriceAmt.textContent  = (totalAmt).toFixed(2);
            }
            $(document).ready(function() {

                $(document).on('click', '#pay_for_users', function() {
                    $('#payment-btn').trigger('click');
                })

                // Get references to the elements
                const valueBox = document.getElementById('valueBox');
                const perUserPrice = document.getElementById('perUserPrice');
                const usersLimitPrice = document.getElementById('usersLimitPrice');

                // Attach an event listener to the value box
                $(".touchspin").on("touchspin.on.startspin", function() {
                    // Code to be executed when the spinner starts spinning upwards or downwards
                
                    // Get the value entered in the value box
                    const value = parseInt($('#valueBox').val());

                    if (value <= 0 || (value > parseInt(total_paid_user) && usersLimitPrice.value <= 0)) {
                        $('#pay-now-btn').hide();
                    } else {
                        $('#pay-now-btn').show();
                    }
                    if (value > parseInt(total_paid_user)) {
                        $('#valueBox').val(value - 1); 
                        return false;
                    }
                    $('#userLimit').val(value);
                    // Get the per user price
                    const pricePerUser = parseInt(perUserPrice.textContent);
                    
                    // Calculate the total price
                    const totalPrice = value * pricePerUser;
                    console.log(totalPrice, value);
                    if (totalPrice == 0) {
                        $('#pay-now-btn').hide();
                    }
                    // Update the value of the users limit price input
                    usersLimitPrice.value = totalPrice;
                });
            });    
            
            $(document).on('click', '#apply-btn', function() {
                let couponCode = $('#coupon_code').val();
                if (!couponCode || '' == couponCode || null == couponCode) {
                    $('#coupon_code_msg').text('Please enter a valid coupon code.');
                    return;
                }
                // send ajax request.
                $('#coupon_code_msg').text('');
                let amount = document.getElementById('usersLimitPrice').value;
                let btnVal = $('#apply-btn').text();
                $('#apply-btn').html(btnVal + ' <span class="spinner-border spinner-border-sm"></span>');
                //  after successfull ajax response
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.apply-coupon') }}",
                    data: {
                        coupon_code: couponCode,
                        amount: amount,
                        payment_for: 'add_more_users',
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        console.log(response);
                        $('#apply-btn').html(btnVal);
                        
                        if (response.error) {
                            $('#coupon_code_msg').text(response.message);
                            return;
                        }
                        if (response.data.gst_type == 'intra_state') {
                            $('#cgst-col').text(parseFloat(response.data.gst/2).toFixed(2))
                            $('#sgst-col').text(parseFloat(response.data.gst/2).toFixed(2))
                            $('#sgst').removeClass('d-none');
                            $('#cgst').removeClass('d-none');
                        } else {
                            $('#igst-col').text(parseFloat(response.data.gst).toFixed(2))
                            $('#igst').removeClass('d-none');
                        }
                        let totalAmt = parseFloat(response.data.gst) + parseFloat(response.data.price_after_discount);
                        $('#coupon_code_msg').text(response.message);
                        $('#pay_without_coupon').text('Proceed to pay');
                        $('#plan-discount-col').text(parseFloat(response.data.discount).toFixed(2));
                        $('#plan-price-gross').html(response.data.price_after_discount.toFixed(2));
                        $('#plan-price-amt').html(totalAmt.toFixed(2));
                        $('#discounted_price').val(totalAmt.toFixed(2));
                        $('#discount').val(parseFloat(response.data.discount).toFixed(2));
                        $('#gstAmt').val(parseFloat(response.data.gst).toFixed(2));
                        $('#gstAmtType').val(response.data.gst_type);
                        $('#cpn_code').val(couponCode);
                        let pPrice = parseFloat($('#plan-price-amt').text());
                        console.log(pPrice);
                        // sendAjaxForPriceUpdate(pPrice);

                    },
                    error: (error) => console.log(error)
                });
                
            });
            
        </script>
        
        @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.5.1/axios.min.js" integrity="sha512-emSwuKiMyYedRwflbZB2ghzX8Cw8fmNVgZ6yQNNXXagFzFOaQmbvQ1vmDkddHjm5AITcBIZfC7k4ShQSjgPAmQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script>
            $(document).on('click', '.changepwd', function() {
                $("#changepwModal").modal('show');
            });
            //error-message
            //chnage-pwd
            function checkDetails(oldPwd, newPwd, matchpwd) {
                if (oldPwd == "" || newPwd == "" || matchpwd == "") {
                    $(".error-message").text("all fields are required")
                    return false;
                }
                if (newPwd == matchpwd) {
                    return true;
                } else {
                    $(".error-message").text("Your password not matched");
                    return false;
                }

            }

            function checkProfileDetails(firstname, lastname, mobile_number, company_name, address) {
                if (firstname == "" || lastname == "" || mobile_number == "" || company_name == "" || address == "") {
                    $(".error-message").text("all fields are required")
                    return false;
                } else {
                    return true;
                }

            }
            $(document).on('click', '#updatepwd', function() {
                var oldPwd = $("#oldpwd").val();
                var newPwd = $("#newpwd").val();
                var matchpwd = $("#matchpwd").val();
                var isValid = checkDetails(oldPwd, newPwd, matchpwd);
                if (isValid) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{url('admin/changepassword')}}",
                        method: 'POST',
                        data: {
                            oldPwd: oldPwd,
                            newPwd: newPwd,
                            matchpwd: matchpwd
                        },
                        dataType: 'JSON',
                        success: function(response) {
                            if (response.success) {
                                $("#changepwModal").modal('hide');
                                Swal.fire({
                                    title: "Your Password Changed Successfully!!"
                                })
                            } else {
                                $(".error-message").text(response.message);
                            }
                        }
                    });
                }

            });
            $(document).on('click', '#updateprofile', function() {

                var firstname = $("#firstname").val();
                var lastname = $("#lastname").val();
                var mobile_number = $("#mobile_number").val();
                var company_name = $("#company_name").val();
                var address = $("#address").val();
                var rera = $("#rera").val();
                var gst = $("#gst").val();

                var isValid = checkProfileDetails(firstname, lastname, mobile_number, company_name, address, rera);

                let form_data = new FormData();
                let profile_image = document.getElementById('profile_image');

                if (profile_image && profile_image.files.length > 0) {
                    let file = profile_image.files[0];
                    form_data.set('profile_image', file, file.name);
                }

                form_data.set('firstname', firstname);
                form_data.set('lastname', lastname);
                form_data.set('mobile_number', mobile_number);
                form_data.set('company_name', company_name);
                form_data.set('address', address);
                form_data.set('gst', gst);
                form_data.set('rera', rera);

                let settings = {
                    headers: {
                        'content-type': 'multipart/form-data',
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    }
                };

                let url = "{{url('admin/changeprofile')}}";

                if (isValid) {
                    axios.post(url, form_data, settings).then(response => {
                        window.location.href = "{{ route('admin.profile.details') }}";
                    });
                }
            });
            $('#state_id').select2();
            $('#city_id').select2();
            var cities = @Json($city_encoded);
            var states = @Json($state_encoded);

            $(document).on('change', '#state_id', function(e) {
                $('#city_id').select2('destroy');
                citiesar = JSON.parse(cities);
                $('#city_id').html('');
                for (let i = 0; i < citiesar.length; i++) {
                    if (citiesar[i]['state_id'] == $("#state_id").val()) {
                        $('#city_id').append('<option value="' + citiesar[i]['id'] + '">' + citiesar[i][
                            'name'
                        ] + '</option>')
                    }
                }
                $('#city_id').select2();

            });
            $(document).on('click', '.btn-edit', function() {
                $("#userpfmodel").modal('show');
            });
        </script>
        @endpush
