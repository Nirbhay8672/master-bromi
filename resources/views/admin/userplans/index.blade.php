@extends('admin.layouts.app')
@section('content')
    <style>
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
                <div class="col-sm-12">
                    <div class="card">
                        @if (Session::get('plan_expired_redirection'))
                            <div style="border-radius: 12px 12px 0 0;text-align: center;" class="alert alert-danger">{{ Session::get('plan_expired_redirection') }}</div>
                        @endif
                        <div class="card-header pb-0">
                            <h5>Plans</h5>
                        </div>
                        <div class="card-body pricing-content pricing-col">
                            <div class="row">
								@foreach ($plans as $plan)
								<div class="col-xl-4 col-sm-4 box-col-6">
                                    <div class="pricing-block card text-center">
                                        <div class="pricing-header">
                                            <h4 class="mt-5">{{$plan->name}}</h4>
                                            <div class="price-box">
                                                <div>
                                                    <h3>{{$plan->price}}</h3>
                                                    <p>/ Year</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="pricing-list">
                                            <ul class="pricing-inner">
                                                <li>
                                                    <h6>Upto {{$plan->user_limit}} users</h6>
                                                    <br>
                                                    <h6>Free {{$plan->free_user}} users</h6>
                                                </li>
                                                @if (!empty($plan->details) && !empty(explode('_---_',json_decode($plan->details,true))))
                                                @foreach (explode('_---_',json_decode($plan->details,true)) as $feature)
                                                    <li>
                                                        <h6>{{$feature}}</h6>
                                                    </li>
                                                @endforeach
                                                @endif
                                            </ul>
											<form action="{{route('admin.savePlan')}}" method="post">
												@csrf
												@if ($t_goal = Session::get('transaction_goal'))
                                                    <input type="hidden" name="transaction_goal" value={{ $t_goal ?? 'new_subscription' }}>
                                                @endif
                                                
												<input type="hidden" name="plan_id" value="{{ $plan->id }}">

                                                <?php

                                                $gstType = Auth::user()->state->gst_type; // gst_type
                                                $gst = $plan->price * 0.18;
                                                ?>

                                                    @if($current_plan['id'] == $plan->id)

                                                        @if($display_button && Auth::user()->total_paid_user > 0 )
                                                            <button
                                                                    class="btn btn-primary btn-lg"
                                                                    type="button"
                                                                    disabled
                                                            >Active Plan</button>
                                                        @else
                                                       
                                                            <button
                                                                class="btn btn-primary btn-lg"
                                                                type="button"
                                                                data-original-title="btn btn-primary btn-lg"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#couponModal"
                                                                onclick="setDetails({{ $plan->id }}, {{ $plan->price }}, '{{ $plan->name }}', '{{ $gstType }}', '{{ $gst }}')"
                                                            >Renew</button>
                                                        @endif
                                                    @else
                                                        @if($plan->price > $current_plan['price'] )
                                                            <button
                                                                class="btn btn-primary btn-lg"
                                                                type="button"
                                                                data-original-title="btn btn-primary btn-lg"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#couponModal"
                                                                onclick="setDetails({{ $plan->id }}, {{ $plan->price }}, '{{ $plan->name }}', '{{ $gstType }}', '{{ $gst }}')"
                                                            >Upgrade</button>
                                                        @endif
                                                    @endif
											</form>
                                        </div>
                                    </div>
                                </div>
								@endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="couponModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop='static'>
            <div class="modal-dialog modal-l" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Coupon Form</h5>
                        <button class="btn-close btn-light" type="button" data-bs-dismiss="modal" aria-label="Close"> </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('admin.savePlan')}}" method="post">
                            @csrf
                            @if ($t_goal = Session::get('transaction_goal'))
                                <input type="hidden" name="transaction_goal", value={{ $t_goal ?? 'new_subscription' }}>
                            @endif
                            <div class="form-row mb-2">
                                <div class="form-group m-b-20">
                                    <div class="">
                                        <div class="d-flex justify-content-between">
                                            <div class="d-flex  flex-column">
                                                <input
                                                    class="form-control p-2 m-r-10"
                                                    type="text"
                                                    name="coupon_code"
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
                                        <input type="hidden" name="plan_id" class="form-control mt-2" id="plan_id">
                                        <input type="hidden" name="discounted_price" value="" class="form-control mt-2" id="discounted_price">
                                        <input type="hidden" name="discount" value="" class="form-control mt-2" id="discount">
                                        <input type="hidden" name="gst_amt" value="" class="form-control mt-2" id="gstAmt">
                                        <input type="hidden" name="gst_amt_type" value="" class="form-control mt-2" id="gstAmtType">
                                    </div>
                                </div>
                            </div>
                            
                            <div id="plan-details" class="m-b-20">
                                <div class="plan-row">
                                    <div class="plan-column">
                                        <span class="plan-label">Description</span>
                                        <span id="plan-selected-name">Plan Name</span>
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

                                    <div id="priceAfterUpgradeSec" class="d-none">
                                        <div class="plan-column m-t-10 border-top ">
                                            <span class="plan-label">Upgrade Discount</span>
                                            <span id="upgradeDiscountPrice">0</span>
                                        </div>
                                        <div class="plan-column m-t-10 border-top">
                                            <span class="plan-label">Price After Upgrade</span>
                                            <span id="priceAfterUpgrade">0</span>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            
                            <div class="row mb-3 text-center">
                                <div class="col">
                                    <button class="btn btn-sm btn-primary custom-theme-button me-3" id="pay_without_coupon" type="submit">I have No Coupon</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Container-fluid Ends-->
    </div>
@endsection
@push('scripts')

<script>
    let code = document.getElementById('coupon_code');
    // let button = document.getElementById('pay_with_coupon');
    // let button_without = document.getElementById('pay_without_coupon');

    function checkavailable() {
        button.disabled = code.value != '' ? false : true;
        button_without.disabled = code.value != '' ? true : false;
    }

    function setDetails(value, planPrice, planName, gstType, gst) {
        // console.log(value, planPrice, planName, gstType, gst);return;
        let plan_id = document.getElementById('plan_id');
        let gstAMT = document.getElementById('gstAmt');
        let gstAMTTYPE = document.getElementById('gstAmtType');

        let planPriceCol = document.getElementById('plan-price-col');
        let planPriceGross = document.getElementById('plan-price-gross');
        let planPriceAmt = document.getElementById('plan-price-amt');
        let planSelectedName = document.getElementById('plan-selected-name');
        let igst = document.getElementById('igst-col');
        let sgst = document.getElementById('sgst-col');
        let cgst = document.getElementById('cgst-col');

        if (gstType == 'intra_state') {
            sgst.textContent = parseFloat(gst/2).toFixed(2);
            cgst.textContent = parseFloat(gst/2).toFixed(2);
            $('#sgst').removeClass('d-none');
            $('#cgst').removeClass('d-none');
        } else {
            igst.textContent = parseFloat(gst).toFixed(2);
            $('#igst').removeClass('d-none');
        }
        let totalAmt = parseFloat(gst) + parseFloat(planPrice);
        plan_id.value = value;
        gstAMT.value = gst;
        gstAMTTYPE.value = gstType;
        planPriceCol.textContent  = parseFloat(planPrice).toFixed(2);
        planPriceGross.textContent  = (planPrice).toFixed(2);
        planPriceAmt.textContent  = (totalAmt).toFixed(2);
        planSelectedName.textContent  = planName;
        code.value = '';
        // button.disabled = true;
        // button_without.disabled = false;
        
    }

    $(document).ready(function() {

        // Listen for changes in the content of the span
        $('#plan-price-amt').bind('DOMSubtreeModified', function() {
            // console.log('Span content changed:', $(this).text());
            // Trigger a custom event when the content changes
            $(this).trigger('spanContentChanged');
        });
        
        // Example of handling the custom event
        $('#plan-price-amt').on('spanContentChanged', function() {
            if($(this).text()) {
                if (parseFloat($('#plan-discount-col').text()) > 0) {
                    let discPr = parseFloat($('#plan-discount-col').text());
                    let amtToPay = parseFloat($('#priceAfterUpgrade').text());
                    let afterDiscApply = amtToPay - discPr;
                    console.log(discPr, amtToPay, afterDiscApply);
                    $('#priceAfterUpgrade').text(afterDiscApply)
                }
            }
        });
        
        var myModalEl = document.getElementById('couponModal')
        
        myModalEl.addEventListener('show.bs.modal', function (event) {
            $('#plan-discount-col').text('0');
            $('#coupon_code_msg').text('');
        });
            
        myModalEl.addEventListener('shown.bs.modal', function (event) {
            let pPrice = parseFloat($('#plan-price-amt').text());
            console.log(pPrice);
            sendAjaxForPriceUpdate(pPrice);
        })
    })

    function sendAjaxForPriceUpdate(pPrice) {
        $.ajax({
            url:"{{route('admin.calc')}}",
            type: 'POST',
            data: {
                _token: '{{csrf_token()}}',
                truePrice: pPrice 
            },
            success: function(success) {
                if (!success.error && success.data.calculatedPrice != pPrice) {
                    $('#priceAfterUpgradeSec').removeClass('d-none');
                    $('#priceAfterUpgrade').text(success.data.calculatedPrice);

                    $('#upgradeDiscountPrice').text(success.data.upgradeDiscount);
                }
            },
            error: function(error) {
                console.log(error)
            }
            
        });
    }
    
    $(document).on('click', '#apply-btn', function() {
        let couponCode = $('#coupon_code').val();
        if (!couponCode || '' == couponCode || null == couponCode) {
            $('#coupon_code_msg').text('Please enter a valid coupon code.');
            return;
        }
        // send ajax request.
        $('#coupon_code_msg').text('');
        let plan_id = document.getElementById('plan_id').value;
        let btnVal = $('#apply-btn').text();
        $('#apply-btn').html(btnVal + ' <span class="spinner-border spinner-border-sm"></span>');
        //  after successfull ajax response
        $.ajax({
            type: "POST",
            url: "{{ route('admin.apply-coupon') }}",
            data: {
                coupon_code: couponCode,
                plan_id: plan_id,
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

                let pPrice = parseFloat($('#plan-price-amt').text());
                console.log(pPrice);
                sendAjaxForPriceUpdate(pPrice);

            },
            error: (error) => console.log(error)
        });
        
    });
</script>

@endpush
