@extends('admin.layouts.app')
@section('content')
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
                        <div class="card-header pb-0">
                            <a class="btn custom-icon-theme-button tooltip-btn"
                                href="{{ route('admin.settings') }}"
                                data-tooltip="Back"
                                style="float: inline-end;"
                            >
                                <i class="fa fa-backward"></i>
                            </a>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('invoice') }}">
                                @csrf
                                <div class="invoice">
                                    <div>
                                        <div>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="media">
                                                        <div class="media-left"><img class="media-object img-80"
                                                                src="{{ asset('admins/assets/images/logo/Bromi-Logo-old.png') }}"
                                                                alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4 text-center">
                                                    <h1>Invoice</h1>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="text-md-end text-xs-center">
                                                        <div class="fname col-sm-5" style="float: right">
                                                            <div class="fvalue mb-2">
                                                                <input class="form-control" rows="3"
                                                                    type="text" value="" name="invoice_no"
                                                                    id="invoice_no" data-bs-original-title=""
                                                                    title=""
                                                                    placeholder="Invoice Number Here">
                                                            </div>
                                                            <p>
                                                                Issued:<span>
                                                                    {{ \Carbon\Carbon::now()->format('F j, Y') }}
                                                                </span><br>
                                                                {{-- Payment Due: June
                                                                <span>27, 2015</span> --}}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row invo-profile">
                                            <div class="col-xl-3">
                                                <div class="media">
                                                    <div class="media-body m-l-20">
                                                        <h4 class="media-heading">
                                                            {{ !empty(Auth::user()->first_name) ? Auth::user()->first_name : 'Bunny Den' }}
                                                            {{ Auth::user()->last_name }}
                                                        </h4>
                                                        <p>{{ !empty(Auth::user()->email) ? Auth::user()->email : 'test@mailcom' }}
                                                            <br>
                                                            {{ !empty($user->address) ? $user->address : 'B 402 Ashok nagar  Delhi' }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-4">
                                            </div>
                                            <div class="col-xl-5">
                                                <div class="text-xl-end" id="project">
                                                    <h6
                                                        style="position: relative;display: flex;float: left;left: 105px;">
                                                        To,</h6>
                                                    <br>
                                                    <div class="fname" style="display: -webkit-inline-box">
                                                        <div class="fvalue col-xl-6">
                                                            <input class="form-control" type="text"
                                                                value="" name="cust_land_mark"
                                                                id="cust_land_mark" data-bs-original-title=""
                                                                title="" placeholder="Land mark Here">
                                                        </div>
                                                        <div class="fvalue col-xl-6 ms-2">
                                                            <input class="form-control" type="text"
                                                                value="" name="cust_street" id="cust_street"
                                                                data-bs-original-title="" title=""
                                                                placeholder="Street Here">
                                                        </div>
                                                    </div>
                                                    <div class="fname mt-3" style="display: -webkit-inline-box">
                                                        <div class="fvalue col-xl-6">
                                                            <input class="form-control" type="text"
                                                                value="" name="cust_city" id="cust_city"
                                                                data-bs-original-title="" title=""
                                                                placeholder="City Here">
                                                        </div>
                                                        <div class="fvalue col-xl-6 ms-2">
                                                            <input class="form-control" type="text"
                                                                value="" name="cust_email" id="cust_email"
                                                                data-bs-original-title="" title=""
                                                                placeholder="Email Here" style="text-transform: lowercase;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="table-responsive invoice-table" id="table">
                                                <table class="table table-bordered table-striped">
                                                    <tbody id="table-body">
                                                        <tr>
                                                            <td class="item">
                                                                <h6 class="mb-0">Property Name</h6>
                                                            </td>
                                                            <td class="item">
                                                                <h6 class="mb-0">Property Description</h6>
                                                            </td>
                                                            <td class="subsub_total">
                                                                <h6 class="mb-0">Property Total</h6>
                                                            </td>
                                                            <td class="subsub_total">
                                                                <h6 class="mb-0">Action</h6>
                                                            </td>
                                                        </tr>
                                                        <tr id="row1">
                                                            <td>
                                                                <div class="fname">
                                                                    <div class="fvalue">
                                                                        <input class="form-control" type="text"
                                                                            value="" name="property_name[]"
                                                                            id="address"
                                                                            data-bs-original-title=""
                                                                            title=""
                                                                            placeholder="Property Name Here">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="fname">
                                                                    <div class="fvalue">
                                                                        <input class="form-control" type="text"
                                                                            value="" name="description[]"
                                                                            id="address"
                                                                            data-bs-original-title=""
                                                                            title=""
                                                                            placeholder="Property Description Here">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="fname">
                                                                    <div class="fvalue">
                                                                        <input class="form-control" type="text"
                                                                            value="" name="property_total[]"
                                                                            id="property_total"
                                                                            data-bs-original-title=""
                                                                            title=""
                                                                            placeholder="Property Total Here">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr id="row2">
                                                            <td>
                                                                <div class="fname">
                                                                    <div class="fvalue">
                                                                        <input class="form-control" type="text"
                                                                            value="" name="property_name[]"
                                                                            id="address"
                                                                            data-bs-original-title=""
                                                                            title=""
                                                                            placeholder="Property Name Here">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="fname">
                                                                    <div class="fvalue">
                                                                        <input class="form-control" type="text"
                                                                            value="" name="description[]"
                                                                            id="address"
                                                                            data-bs-original-title=""
                                                                            title=""
                                                                            placeholder="Property Description Here">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="fname">
                                                                    <div class="fvalue">
                                                                        <input class="form-control" type="text"
                                                                            value="" name="property_total[]"
                                                                            id="property_total"
                                                                            data-bs-original-title=""
                                                                            title=""
                                                                            placeholder="Property Total Here">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr id="row3">
                                                            <td>
                                                                <div class="fname">
                                                                    <div class="fvalue">
                                                                        <input class="form-control" type="text"
                                                                            value="" name="property_name[]"
                                                                            id="address"
                                                                            data-bs-original-title=""
                                                                            title=""
                                                                            placeholder="Property Name Here">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="fname">
                                                                    <div class="fvalue">
                                                                        <input class="form-control" type="text"
                                                                            value="" name="description[]"
                                                                            id="address"
                                                                            data-bs-original-title=""
                                                                            title=""
                                                                            placeholder="Property Description Here">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="fname">
                                                                    <div class="fvalue">
                                                                        <input class="form-control" type="text"
                                                                            value="" name="property_total[]"
                                                                            id="property_total"
                                                                            data-bs-original-title=""
                                                                            title=""
                                                                            placeholder="Property Total Here">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                    <div>
                                                        <td></td>
                                                        <td class="Rate">
                                                            <h6 class="mb-0 p-2">Total Due</h6>
                                                        </td>
                                                        <td id="total-due" class="payment">
                                                            <h6 class="mb-0 p-2"><span class="material-icons">&#8377;</span> 0.00</h6>
                                                        </td>
                                                        <td>
                                                        </td>
                                                    </div>
                                                </table>
                                            </div>
                                            <div class="row" style="margin-left: 10px;">
                                                <div class="col">
                                                    <button
                                                        class="btn custom-icon-theme-button"
                                                        type="button"
                                                        onclick="addRow()"
                                                    ><i class="fa fa-plus"></i> Add More Fields </button>
                                                </div>
                                            </div>
                                            <div class="row mt-5">
                                                <div class="col-md-8">
                                                    <div style="margin-left: 15px;">
                                                        <label for="">Terms :</label>
                                                        <div class="fname">
                                                            <div class="fvalue">
                                                                <textarea class="form-control" type="text" value="" name="terms" id="address"
                                                                    data-bs-original-title="" title="" placeholder="Enter Terms Here">
                                                                </textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- <div class="col-md-4">
                                                    <label for="">Authorized Sign :</label>
                                                    <div class="fname">
                                                        <div class="fvalue">
                                                            <textarea class="form-control" type="text" value="" name="sign" id="address"
                                                                data-bs-original-title="" title="" placeholder="Signature">
                                                                </textarea>
                                                        </div>
                                                    </div>
                                                </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 text-center mt-5 mb-3">
                                        <div class="text-center mt-3">
                                            <button class="btn btn-primary ms-3" style="border-radius: 5px;" type="submit">Download Invoice</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        let rowCounter = 3;

        function calculateTotalDue() {
            const propertyTotalInputs = document.getElementsByName("property_total[]");
            let totalDue = 0;

            propertyTotalInputs.forEach((input) => {
                const value = parseFloat(input.value);
                if (!isNaN(value)) {
                    totalDue += value;
                }
            });

            const totalDueCell = document.getElementById("total-due");
            totalDueCell.innerHTML = `<h6 class="mb-0 p-2">$${totalDue.toFixed(2)}</h6>`;
        }

        calculateTotalDue();

        function addRow() {
            rowCounter++;
            let newRow = `
            <tr id="row${rowCounter}">
                <td>
                    <div class="fname">
                        <div class="fvalue">
                            <input class="form-control" type="text" value="" name="property_name[]" id="address"
                                data-bs-original-title="" title="" placeholder="Property Name Here">
                        </div>
                    </div>
                </td>
                <td>
                    <div class="fname">
                        <div class="fvalue">
                            <input class="form-control" type="text" value="" name="description[]" id="address"
                                data-bs-original-title="" title="" placeholder="Property Description Here">
                        </div>
                    </div>
                </td>
                <td>
                    <div class="fname">
                        <div class="fvalue">
                            <input class="form-control" type="text" value="" name="property_total[]"
                                id="property_total" data-bs-original-title="" title=""
                                placeholder="Property Total Here">
                        </div>
                    </div>
                </td>
                <td>
                    <button class="btn text-white remove_btn" style="background-color:red;border-radius:5px;" onclick="removeRow('row${rowCounter}')"><i class="fa fa-trash"></i></button>
                </td>
            </tr>`;

            const tableBody = document.getElementById("table-body");
            tableBody.insertAdjacentHTML("beforeend", newRow);
            calculateTotalDue();
        }

        function removeRow(rowId) {
            let row = document.getElementById(rowId);
            row.remove();

            calculateTotalDue();
        }
    </script>
@endpush
