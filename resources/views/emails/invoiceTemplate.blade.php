<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .invoice {
            width: 100%;
            margin: auto;
            border-collapse: collapse;
        }

        .invoice-header {
            background-color: #f2f2f2;
            padding: 20px;
            text-align: center;
        }

        .invoice-body {
            padding: 20px;
        }

        #invoice-head {
            display: flex;
            justify-content: space-between;
        }

        .invoice-details {
            margin-bottom: 20px;
        }

        .invoice-details h2 {
            margin-top: 0;
        }

        .user-details h2 {
            margin-top: 0;
        }

        .invoice-table {
            width: 100%;
            border-collapse: collapse;
        }

        .invoice-table th,
        .invoice-table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .invoice-total {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="invoice">
        <div class="invoice-header">
            <div style="max-width:100px;margin: 0 auto;">
                <img src="https://updates.mrweb.co.in/bromi/public/admins/assets/images/logo/Bromi-Logo.png" alt="Logo" style=" max-width: 100%;">
            </div> 
        </div>
        <div class="invoice-body">
            
            <div id="invoice-head">
                <div class="invoice-details">
                    <h2>Invoice Details</h2>
                    <p><strong>Invoice Number:</strong> {{$sequence}}</p>
                    {{-- <p>
                        <strong>Plan Purchase
                        Date:</strong>{{ \Carbon\Carbon::parse($user->plan_expire_on)->subYear(1)->format('F j, Y') }}
                    </p> --}}
                    {{-- <p><strong>Plan Expiry Date:</strong>
                        {{ \Carbon\Carbon::parse($user->plan_expire_on)->format('F j, Y') }}
                    </p> --}}
                </div>
                <div class="user-details">
                    <h2>Invoice To</h2>
                    <p><strong> Company: </strong>{{ ucfirst($user->company_name) }}</p>
                    <p><strong> Phone:</strong> {{ $user->mobile_number }} </p>
                    <p><strong> Email:</strong> {{ $user->email }}</p>
                </div>
            </div>

            {{-- <p style="margin:30px 0;"> <strong>Description: </strong> <u> {{ $description }}  </u> </p> --}}
            
            <table class="invoice-table">
                <thead>
                    <tr>
                        <th>Description</th>
                        <th>Type</th>
                        <th>Users Count</th>
                        <th>Price (Excl. Tax)</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- main plan --}}
                    @php
                        $planPricee = 0;
                    @endphp
                    @if (empty($extraUserAdded))
                    @php
                        $planPricee = $user->Plan->price;
                    @endphp
                    <tr>
                        <td>{{ $user->Plan->name }} Plan</td>
                        <td> 1 {{ ucfirst($user->plan_type) }} </td>
                        <td> {{ $user->total_user_limit ?? 0 }} <small>(Transfered:{{$user->total_user_limit - $user->Plan->user_limit}} )</small></td>
                        <td>₹ {{ number_format($planPricee, 2) }}</td>
                    </tr>
                    @endif
                    {{-- additional users --}}
                    <tr>
                        <td colspan="2">Additional Users</td>
                        <td> {{@$extraUserAdded ?? 0}} </td>
                        <td>₹ {{ number_format(@$extraUserPrice, 2) }} </td>
                    </tr>
                    {{-- discount --}}
                    <tr>
                        <td colspan="3"> Discount </td>
                        <td colspan="3"> - ₹ {{ number_format(@$discount, 2) }}</td>
                    </tr>
                    {{-- subtotal --}}
                    <?php
                    $pr = $planPricee;
                    $dis = $discount ?? 0;
                    $extraU = $extraUserPrice ?? 0;
                    $subtotal = ($pr + $extraU) - $dis;
                    ?>
                     <tr>
                        <td colspan="3"> <strong>Subtotal</strong> </td>
                        <td> ₹ <strong> {{ number_format($subtotal, 2) }} </strong> </td>
                    </tr>
                    
                    @if ($gst_type == 'intra_state')
                        
                    <tr>
                        <td colspan="3"> CGST (9%) </td>
                        <td> + ₹ {{number_format($gst/2)}} </td>
                    </tr>
                    <tr>
                        <td colspan="3"> SGST (9%) </td>
                        <td> + ₹ {{number_format($gst/2)}} </td>
                    </tr>
                    @else
                    <tr>
                        <td colspan="3"> IGST (18%) </td>
                        <td colspan="3"> + ₹ {{number_format($gst)}} </td>
                    </tr>
                    @endif
                    
                </tbody>
            </table>
            <div class="invoice-total">
                <p><strong>Total:</strong> ₹ {{ number_format(($subtotal + $gst), 2) }} </p>
            </div>
        </div>
    </div>
    <p style="margin-top: 100px;"></p>
    <p style="padding-left: 20px; text-align:center;">
        Thanks,<br>
        For your business!
    </p>
</body>

</html>
