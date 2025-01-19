<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Laralink">
    <title>Bromi - Invoice</title>
    <link rel="stylesheet" href="https://invoma.vercel.app/assets/css/style.css">
</head>

<body>
    <div class="tm_container">
        <div class="tm_invoice_wrap">
            <a class="btn custom-icon-theme-button tooltip-btn"
                href="{{ route('admin.settings') }}"
                data-tooltip="Back"
                style="float: inline-end;"
            >
                <i class="fa fa-backward"></i>
            </a></h5>
            <div class="tm_invoice tm_style1" id="tm_download_section">
                <div class="tm_invoice_in">
                    <div class="tm_invoice_head tm_align_center tm_mb20">
                        <div class="tm_invoice_left">
                            <div class="tm_logo img-80"><img
                                    src="{{ public_path('admins/assets/images/logo/Bromi-Logo-old.png') }}"
                                    alt="Logo"></div>
                        </div>
                        <div>
                            <center>
                                <div class="tm_primary_color tm_f50 tm_text_uppercase">Invoice</div>
                            </center>
                        </div>
                    </div>
                    <div class="tm_invoice_info tm_mb20">
                        <div class="tm_invoice_seperator tm_gray_bg" style="position: relative; bottom: 20px;"></div>
                        <div class="tm_invoice_info_list" style="position: relative; bottom: 20px;">
                            <p class="tm_invoice_number tm_m0" style="float: left">Invoice No: <b
                                    class="tm_primary_color">#{{ !empty($request->invoice_no) ? $request->invoice_no : rand(1000, 9999) }}</b>
                            </p>
                            <p class="tm_invoice_date tm_m0" style="float: right">Date: <b class="tm_primary_color">
                                    {{ \Carbon\Carbon::now()->format('F j, Y') }}</b></p>
                        </div>
                    </div>
                    <div class="tm_invoice_head tm_mb10">
                        <div class="tm_invoice_left">
                            <p class="tm_mb2"><b class="tm_primary_color">Invoice To:</b></p>
                            <p>
                                <span class="tm_width_3">
                                    {{ !empty(Auth::user()->first_name) ? Auth::user()->first_name : 'Bunny Den' }}</span>
                                <span class="tm_width_3"> {{ Auth::user()->last_name }} </span><br>
                                <span
                                    class="tm_width_3">{{ !empty($user->address) ? $user->address : '84 Spilman Street, London' }}</span><br>
                                <span
                                    class="tm_width_3">{{ !empty($user->state_id) ? $user->state_id : 'United Kingdom' }}</span><br>
                                <span
                                    class="tm_width_3">{{ !empty(Auth::user()->email) ? Auth::user()->email : 'test@mailcom' }}</span>
                            </p>
                        </div>
                        <div class="tm_invoice_right tm_text_right"
                            style="float: right; position: relative; bottom: 135px;">
                            <p class="tm_mb2"><b class="tm_primary_color">Invoice From:</b></p>
                            <p>

                                {{ !empty($request->cust_land_mark) ? $request->cust_land_mark : 'B-1001 Spilman Street,' }},<br>
                                {{ !empty($request->cust_street) ? $request->cust_street : 'S. G. Highway' }},<br>
                                {{ !empty($request->cust_city) ? $request->cust_city : 'United Kingdom' }},<br>
                                {{ !empty($request->cust_email) ? $request->cust_email : 'user@mail.com' }},<br>
                            </p>
                        </div>
                    </div>
                    <div class="tm_table tm_style1 tm_mb30">
                        <div class="tm_round_border">
                            <div class="tm_table_responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="tm_width_2 tm_semi_bold tm_primary_color tm_gray_bg">No.</th>
                                            <th class="tm_width_3 tm_semi_bold tm_primary_color tm_gray_bg">Item</th>
                                            <th class="tm_width_5 tm_semi_bold tm_primary_color tm_gray_bg">Description
                                            </th>
                                            <th class="tm_width_2 tm_semi_bold tm_primary_color tm_gray_bg">Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $key => $item)
                                            <tr>
                                                @if ($item['property_name'])
                                                    <td class="tm_width_2">{{ $key + 1 }}.</td>
                                                    <td class="tm_width_3">{{ $item['property_name'] }}</td>
                                                @endif
                                                @if ($item['property_description'])
                                                    <td class="tm_width_5">{{ $item['property_description'] }}</td>
                                                @endif
                                                @if ($item['property_total'])
                                                    <td class="tm_width_2">{{ $item['property_total'] }}</td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tm_invoice_footer">
                            <br>
                            <div class="tm_right_footer">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td class="tm_width_3 tm_primary_color tm_border_none tm_bold">Subtoal</td>
                                            <td
                                                class="tm_width_3 tm_primary_color tm_text_right tm_border_none tm_bold">
                                                ${{ $totalSum }}.00</td>
                                        </tr>
                                        <tr>
                                            <td class="tm_width_3 tm_primary_color tm_border_none tm_pt0">Tax <span
                                                    class="tm_ternary_color"></span></td>
                                            <td class="tm_width_3 tm_primary_color tm_text_right tm_border_none tm_pt0">
                                                $0.00
                                            </td>
                                        </tr>
                                        <tr class="tm_border_top tm_border_bottom">
                                            <td class="tm_width_3 tm_border_top_0 tm_bold tm_f16 tm_primary_color">Grand
                                                Total </td>
                                            <td
                                                class="tm_width_3 tm_border_top_0 tm_bold tm_f16 tm_primary_color tm_text_right">
                                                ${{ $totalSum }}.00</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tm_padd_15_20 tm_round_border">
                        <p class="tm_mb5"><b class="tm_primary_color">Terms & Conditions:</b></p>
                        <ul class="tm_m0 tm_note_list">
                            @if (empty($request->terms))
                                <li>All claims relating to quantity or shipping errors shall be waived by Buyer unless
                                    made
                                    in writing to Seller within thirty (30) days after delivery of goods to the address
                                    stated.</li>
                                <li>Delivery dates are not guaranteed and Seller has no liability for damages that may
                                    be
                                    incurred due to any delay in shipment of goods hereunder. Taxes are excluded unless
                                    otherwise stated.</li>
                            @else
                                {{ $request->terms }}
                            @endif
                        </ul>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
    <script src="https://invoma.vercel.app/assets/js/jquery.min.js"></script>
    <script src="https://invoma.vercel.app/assets/js/jspdf.min.js"></script>
    <script src="https://invoma.vercel.app/assets/js/html2canvas.min.js"></script>
    <script src="https://invoma.vercel.app/assets/js/main.js"></script>
</body>

</html>
