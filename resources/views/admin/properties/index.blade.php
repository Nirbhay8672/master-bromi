@extends('admin.layouts.app')
@section('content')
    @php
        $is_dynamic_form = true;
    @endphp
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
                            <h5 class="mb-3">List of Properties</h5>
                            <div class="row">
                                @include('admin.properties.change_menu')
                                <div class="col">

                                    @can('property-create')
                                        <a class="btn custom-icon-theme-button tooltip-btn"
                                            href="{{ route('admin.property.add') }}" data-tooltip="Add Property">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    @endcan

                                    @can('search-property')
                                        <button class="btn ms-3 custom-icon-theme-button tooltip-btn" type="button"
                                            data-bs-toggle="modal" data-bs-target="#filtermodal" data-tooltip="Filter"><i
                                                class="fa fa-filter"></i></button>
                                    @endcan

                                    <button class="btn ms-3 custom-icon-theme-button"
                                        style="background-color: #FF0000 !important;display: none; " type="button"
                                        data-tooltip="Clear Filter" id="resetfilter"><i class="fa fa-refresh"></i></button>

                                    <button class="btn ms-3 btn-warning tooltip-btn d-none" style="border-radius: 5px;"
                                        type="button" data-tooltip="Clear Filter" id="resetfilter"
                                        style="display: none;"><i class="fa fa-refresh"></i></button>
                                    <button class="btn matchbutton ms-3 custom-icon-theme-button tooltip-btn" type="button"
                                        data-bs-toggle="modal" data-bs-target="#matchModal" data-tooltip="Matching"><i
                                            class="fa fa-random"></i></button>

                                    @can('export-property')
                                        <button class="btn ms-3 custom-icon-theme-button tooltip-btn"
                                            onclick="exportProperties()" type="button" data-tooltip="Export"><i
                                                class="fa fa-upload"></i></button>
                                    @endcan


                                    @can('import-property')
                                        <button class="btn ms-3 custom-icon-theme-button tooltip-btn"
                                            onclick="importProperties()" type="button" data-tooltip="Import"><i
                                                class="fa fa-download"></i></button>
                                    @endcan

                                    @can('property-create')
                                        <button class="btn text-white delete_table_row ms-3 tooltip-btn"
                                            style="border-radius: 5px;display: none;background-color:red"
                                            onclick="deleteTableRow()" type="button" data-tooltip="Delete"><i
                                                class="fa fa-trash"></i></button>
                                    @endcan

                                    <button class="btn share_table_row ms-3 tooltip-btn"
                                        style="border-radius: 5px;display: none;background-color:#25d366;color:white;"
                                        onclick="shareTableRow()" type="button" data-tooltip="Share"><i
                                            class="fa fa-whatsapp"></i></button>

                                    <a class="btn float-end custom-icon-theme-button tooltip-btn"
                                        data-tooltip="Project Vise Unit" href="{{ route('admin.project.byunit') }}"><i
                                            class="fa fa-list"></i></a>

                                </div>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="display" id="propertyTable">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px !important;">
                                                <div class="form-check form-check-inline checkbox checkbox-dark mb-0 me-0">
                                                    <input class="form-check-input" id="select_all_checkbox"
                                                        name="selectrows" type="checkbox">
                                                    <label class="form-check-label" for="select_all_checkbox"></label>
                                                </div>
                                            </th>
                                            <th>Project Name</th>
                                            <th>Property info</th>
                                            <th>Units</th>
                                            <th>Price</th>
                                            <th>Remarks</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>


        </div>

        <div class="modal fade" id="whatsappModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Share On whatsapp</h5>
                        <button class="btn-close btn-light" type="button" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-5 m-b-4 mb-3">
                                <select class="form-select mt-1" id="conatct_id"
                                    style="border: 1px solid black;border-radius:5px;">
                                    <option value=""> Contact</option>
                                    @forelse ($conatcts_numbers as $number)
                                        @if (!empty($number['number']))
                                            <option value="{{ $number['number'] }}">{{ $number['name'] }}
                                                ({{ $number['number'] }})
                                            </option>
                                        @endif
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                            <div class="form-group col-md-3 m-b-4 mb-3">
                                <select class="form-control" id="CountryCode" name="CountryCode"
                                    style="border: 1px solid black;border-radius:5px;">
                                    <option value=""></option>
                                    <option value="93">93</option>
                                    <option value="355">355</option>
                                    <option value="213">213</option>
                                    <option value="1-684">1-684</option>
                                    <option value="376">376</option>
                                    <option value="244">244</option>
                                    <option value="1-264">1-264</option>
                                    <option value="672">672</option>
                                    <option value="1-268">1-268</option>
                                    <option value="54">54</option>
                                    <option value="374">374</option>
                                    <option value="297">297</option>
                                    <option value="61">61</option>
                                    <option value="43">43</option>
                                    <option value="994">994</option>
                                    <option value="1-242">1-242</option>
                                    <option value="973">973</option>
                                    <option value="880">880</option>
                                    <option value="1-246">1-246</option>
                                    <option value="375">375</option>
                                    <option value="32">32</option>
                                    <option value="501">501</option>
                                    <option value="229">229</option>
                                    <option value="1-441">1-441</option>
                                    <option value="975">975</option>
                                    <option value="591">591</option>
                                    <option value="387">387</option>
                                    <option value="267">267</option>
                                    <option value="55">55</option>
                                    <option value="246">246</option>
                                    <option value="1-284">1-284</option>
                                    <option value="673">673</option>
                                    <option value="359">359</option>
                                    <option value="226">226</option>
                                    <option value="257">257</option>
                                    <option value="855">855</option>
                                    <option value="237">237</option>
                                    <option value="1">1</option>
                                    <option value="238">238</option>
                                    <option value="1-345">1-345</option>
                                    <option value="236">236</option>
                                    <option value="235">235</option>
                                    <option value="56">56</option>
                                    <option value="86">86</option>
                                    <option value="61">61</option>
                                    <option value="61">61</option>
                                    <option value="57">57</option>
                                    <option value="269">269</option>
                                    <option value="682">682</option>
                                    <option value="506">506</option>
                                    <option value="385">385</option>
                                    <option value="53">53</option>
                                    <option value="599">599</option>
                                    <option value="357">357</option>
                                    <option value="420">420</option>
                                    <option value="243">243</option>
                                    <option value="45">45</option>
                                    <option value="253">253</option>
                                    <option value="1-767">1-767</option>
                                    <option value="670">670</option>
                                    <option value="593">593</option>
                                    <option value="20">20</option>
                                    <option value="503">503</option>
                                    <option value="240">240</option>
                                    <option value="291">291</option>
                                    <option value="372">372</option>
                                    <option value="251">251</option>
                                    <option value="500">500</option>
                                    <option value="298">298</option>
                                    <option value="679">679</option>
                                    <option value="358">358</option>
                                    <option value="33">33</option>
                                    <option value="689">689</option>
                                    <option value="241">241</option>
                                    <option value="220">220</option>
                                    <option value="995">995</option>
                                    <option value="49">49</option>
                                    <option value="233">233</option>
                                    <option value="350">350</option>
                                    <option value="30">30</option>
                                    <option value="299">299</option>
                                    <option value="1-473">1-473</option>
                                    <option value="1-671">1-671</option>
                                    <option value="502">502</option>
                                    <option value="44-1481">44-1481</option>
                                    <option value="224">224</option>
                                    <option value="245">245</option>
                                    <option value="592">592</option>
                                    <option value="509">509</option>
                                    <option value="504">504</option>
                                    <option value="852">852</option>
                                    <option value="36">36</option>
                                    <option value="354">354</option>
                                    <option selected="selected" value="91">91</option>
                                    <option value="62">62</option>
                                    <option value="98">98</option>
                                    <option value="964">964</option>
                                    <option value="353">353</option>
                                    <option value="44-1624">44-1624</option>
                                    <option value="972">972</option>
                                    <option value="39">39</option>
                                    <option value="225">225</option>
                                    <option value="1-876">1-876</option>
                                    <option value="81">81</option>
                                    <option value="44-1534">44-1534</option>
                                    <option value="962">962</option>
                                    <option value="7">7</option>
                                    <option value="254">254</option>
                                    <option value="686">686</option>
                                    <option value="383">383</option>
                                    <option value="965">965</option>
                                    <option value="996">996</option>
                                    <option value="856">856</option>
                                    <option value="371">371</option>
                                    <option value="961">961</option>
                                    <option value="266">266</option>
                                    <option value="231">231</option>
                                    <option value="218">218</option>
                                    <option value="423">423</option>
                                    <option value="370">370</option>
                                    <option value="352">352</option>
                                    <option value="853">853</option>
                                    <option value="389">389</option>
                                    <option value="261">261</option>
                                    <option value="265">265</option>
                                    <option value="60">60</option>
                                    <option value="960">960</option>
                                    <option value="223">223</option>
                                    <option value="356">356</option>
                                    <option value="692">692</option>
                                    <option value="222">222</option>
                                    <option value="230">230</option>
                                    <option value="262">262</option>
                                    <option value="52">52</option>
                                    <option value="691">691</option>
                                    <option value="373">373</option>
                                    <option value="377">377</option>
                                    <option value="976">976</option>
                                    <option value="382">382</option>
                                    <option value="1-664">1-664</option>
                                    <option value="212">212</option>
                                    <option value="258">258</option>
                                    <option value="95">95</option>
                                    <option value="264">264</option>
                                    <option value="674">674</option>
                                    <option value="977">977</option>
                                    <option value="31">31</option>
                                    <option value="599">599</option>
                                    <option value="687">687</option>
                                    <option value="64">64</option>
                                    <option value="505">505</option>
                                    <option value="227">227</option>
                                    <option value="234">234</option>
                                    <option value="683">683</option>
                                    <option value="850">850</option>
                                    <option value="1-670">1-670</option>
                                    <option value="47">47</option>
                                    <option value="968">968</option>
                                    <option value="92">92</option>
                                    <option value="680">680</option>
                                    <option value="970">970</option>
                                    <option value="507">507</option>
                                    <option value="675">675</option>
                                    <option value="595">595</option>
                                    <option value="51">51</option>
                                    <option value="63">63</option>
                                    <option value="64">64</option>
                                    <option value="48">48</option>
                                    <option value="351">351</option>
                                    <option value="974">974</option>
                                    <option value="242">242</option>
                                    <option value="262">262</option>
                                    <option value="40">40</option>
                                    <option value="7">7</option>
                                    <option value="250">250</option>
                                    <option value="590">590</option>
                                    <option value="290">290</option>
                                    <option value="1-869">1-869</option>
                                    <option value="1-758">1-758</option>
                                    <option value="590">590</option>
                                    <option value="508">508</option>
                                    <option value="1-784">1-784</option>
                                    <option value="685">685</option>
                                    <option value="378">378</option>
                                    <option value="239">239</option>
                                    <option value="966">966</option>
                                    <option value="221">221</option>
                                    <option value="381">381</option>
                                    <option value="248">248</option>
                                    <option value="232">232</option>
                                    <option value="65">65</option>
                                    <option value="1-721">1-721</option>
                                    <option value="421">421</option>
                                    <option value="386">386</option>
                                    <option value="677">677</option>
                                    <option value="252">252</option>
                                    <option value="27">27</option>
                                    <option value="82">82</option>
                                    <option value="211">211</option>
                                    <option value="34">34</option>
                                    <option value="94">94</option>
                                    <option value="249">249</option>
                                    <option value="597">597</option>
                                    <option value="47">47</option>
                                    <option value="268">268</option>
                                    <option value="46">46</option>
                                    <option value="41">41</option>
                                    <option value="963">963</option>
                                    <option value="886">886</option>
                                    <option value="992">992</option>
                                    <option value="255">255</option>
                                    <option value="66">66</option>
                                    <option value="228">228</option>
                                    <option value="690">690</option>
                                    <option value="676">676</option>
                                    <option value="1-868">1-868</option>
                                    <option value="216">216</option>
                                    <option value="90">90</option>
                                    <option value="993">993</option>
                                    <option value="1-649">1-649</option>
                                    <option value="688">688</option>
                                    <option value="1-340">1-340</option>
                                    <option value="256">256</option>
                                    <option value="380">380</option>
                                    <option value="971">971</option>
                                    <option value="44">44</option>
                                    <option value="1">1</option>
                                    <option value="598">598</option>
                                    <option value="998">998</option>
                                    <option value="678">678</option>
                                    <option value="379">379</option>
                                    <option value="58">58</option>
                                    <option value="84">84</option>
                                    <option value="681">681</option>
                                    <option value="212">212</option>
                                    <option value="967">967</option>
                                    <option value="260">260</option>
                                    <option value="263">263</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4 m-b-4 mb-3">
                                <div class="fname">
                                    <input type="text" placeholder="Number" name="whatsapp_number"
                                        class="form-control" pattern="[1-9]{1}[0-9]{9}" id="whatsapp_number">
                                </div>
                            </div>
                            <input type="hidden" name="shar_string" id="shar_string">
                        </div>
                        <div class="text-center mt-3">
                            <button class="btn custom-theme-button" type="button" id="shareonwhatsapp">Share</button>
                            <button class="btn btn-primary ms-3" style="border-radius: 5px;" type="button"
                                data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="propertyModal" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Property</h5>
                        <button class="btn-close btn-light" type="button" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row" id="choose-property-form">
                            <div class="col-md-4 mb-3">
                                <select class="form-select" id="property_form_type">
                                    <option value="property" selected> Properties</option>
                                    <option value="industrial"> Industrial Property</option>
                                    <option value="land"> Land Property</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="importmodal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Import Property</h5>
                        <button class="btn-close btn-light" type="button" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="form-bookmark needs-validation " method="post" id="import_form" novalidate="">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-5 m-b-20">
                                    <label for="Choose File">File</label>
                                    <input class="form-control" type="file" accept=".xlsx" name="import_file"
                                        id="import_file">
                                </div>
                                <br>
                                <div class="col-md-3 m-b-4 mb-4">
                                    <select class="form-select" name="project_id" data-error="#project_id_error"
                                        id="import_category">
                                        <option value="">Select Category</option>
                                        @forelse ($property_configuration_settings as $props)
                                            @if ($props['dropdown_for'] == 'property_specific_type')
                                                <option data-val="{{ $props['name'] }}" value="{{ $props['id'] }}">
                                                    {{ $props['name'] }}</option>
                                            @endif
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                                <div class="form-group col-md-5 m-b-10">
                                    <a id="import_url" href="{{ route('admin.importpropertyTemplate') }}">Download Sample
                                        file</a>
                                </div>
                                <br>
                            </div>
                            <div class="text-center">
                                <button class="btn custom-theme-button" id="importFile">Save</button>
                                <button class="btn btn-primary ms-3" style="border-radius: 5px;" type="button"
                                    data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="filtermodal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Filter</h5>
                        <button class="btn-close btn-light" type="button" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="form-bookmark needs-validation " method="post" id="filter_form" novalidate="">
                            @csrf
                            <div>
                                <div class="row">
                                    <div class="form-group col-md-2 m-b-4 mb-3">
                                        <select class="form-select" id="filter_property_for">
                                            <option value="">Property For</option>
                                            <option value="Rent">Rent</option>
                                            <option value="Sell">Sell</option>
                                            <option value="Both">Both</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2 m-b-4 mb-3">
                                        <select class="form-select" id="filter_property_type">
                                            <option value="">Property Type</option>
                                            @forelse ($property_configuration_settings as $props)
                                                @if ($props['dropdown_for'] == 'property_construction_type' && in_array($props['id'], $prop_type))
                                                    <option data-parent_id="{{ $props['parent_id'] }}"
                                                        value="{{ $props['id'] }}">{{ $props['name'] }}
                                                    </option>
                                                @endif
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>

                                    <div class="form-group col-md-2 m-b-4 mb-3">
                                        <select class="form-select" id="filter_specific_type">
                                            <option value="">Category</option>
                                            @forelse ($property_configuration_settings as $props)
                                                @if ($props['dropdown_for'] == 'property_specific_type' && in_array($props['parent_id'], $prop_type))
                                                    <option data-parent_id="{{ $props['parent_id'] }}"
                                                        value="{{ $props['id'] }}">{{ $props['name'] }}</option>
                                                @endif
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>


                                    <div class="form-group col-md-2 m-b-4 mb-3">
                                        <select class="form-select" id="filter_configuration">
                                            <option value="">Sub Category</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-2 m-b-4 mb-3">
                                        <label class="select2_label" for="Select Project"> Project</label>
                                        <select class="form-select" id="filter_building_id" multiple>
                                            @foreach ($projects as $building)
                                                <option value="{{ $building->id }}">{{ $building->project_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2 m-b-4 mb-3">
                                        <label class="select2_label" for="Select Area"> Locality</label>
                                        <select class="form-select" id="filter_area_id" multiple>
                                            @foreach ($areas as $area)
                                                <option value="{{ $area->id }}">{{ $area->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-3 m-b-4 mb-3">
                                        <select class="form-select" id="filter_availability_status">
                                            <option value="">Availability Status</option>
                                            <option value="1">Available</option>
                                            <option value="0">Under construction</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3 m-b-4 mb-3">
                                        <select class="form-select" id="filter_owner_is">
                                            <option value="">Owner is</option>
                                            @forelse ($property_configuration_settings as $props)
                                                @if ($props['dropdown_for'] == 'property_owner_type')
                                                    <option data-parent_id="{{ $props['parent_id'] }}"
                                                        value="{{ $props['id'] }}">{{ $props['name'] }}
                                                    </option>
                                                @endif
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>

                                    <div class="form-group col-md-3 m-b-4 mb-3">
                                        <select class="form-select" id="filter_Property_priority">
                                            <option value="">Priority</option>
                                            @forelse ($property_configuration_settings as $props)
                                                @if ($props['dropdown_for'] == 'property_priority_type')
                                                    <option data-parent_id="{{ $props['parent_id'] }}"
                                                        value="{{ $props['id'] }}">{{ $props['name'] }}
                                                    </option>
                                                @endif
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3 m-b-4 mb-3">
                                        <select class="form-select" id="filter_property_status">
                                            <option value=""> Status</option>
                                            <option value="1">Active</option>
                                            <option value="0">InActive</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-2 m-b-4 mb-3">
                                        <div>
                                            <label for="From Price">From Price</label>
                                            <input class="form-control indian_currency_amount" name="filter_from_price"
                                                id="filter_from_price" type="text" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2 mb-3">
                                        <div>
                                            <label for="To Price">To Price</label>
                                            <input class="form-control indian_currency_amount" name="filter_to_price"
                                                id="filter_to_price" type="text" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2 m-b-20">
                                        <label for="From Area">From Area</label>
                                        <input class="form-control" name="filter_from_area" id="filter_from_area"
                                            type="text" autocomplete="off">
                                    </div>
                                    <div class="form-group col-md-2 m-b-20">
                                        <label for="To Area">To Area</label>
                                        <input class="form-control" name="filter_to_area" id="filter_to_area"
                                            type="text" autocomplete="off">
                                    </div>
                                    <div class="form-group col-md-2 m-b-4 mb-3">
                                        <label for="From Date">From Date</label>
                                        <div class="input-group">
                                            <input class="form-control " id="filter_from_date" type="date"
                                                data-language="en">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2 m-b-4 mb-3">
                                        <label for="To Date">To Date</label>
                                        <div class="input-group">
                                            <input class="form-control " id="filter_to_date" type="date"
                                                data-language="en">
                                        </div>
                                    </div>
                                    <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                        <input class="form-check-input" id="filter_is_preleased" type="checkbox">
                                        <label class="form-check-label" for="filter_is_preleased">Pre-leased</label>
                                    </div>
                                    <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                        <input class="form-check-input" id="filter_is_hot" type="checkbox">
                                        <label class="form-check-label" for="filter_is_hot">Hot</label>
                                    </div>
                                    <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-3 m-b-20">
                                        <input class="form-check-input" id="filter_is_terraced" type="checkbox">
                                        <label class="form-check-label" for="filter_is_terraced">Terrace</label>
                                    </div>
                                    <div class="form-check checkbox the_filter_weekend checkbox-solid-success mb-0 col-md-3 m-b-20"
                                        style="">
                                        <input class="form-check-input" id="filter_is_weekend" type="checkbox">
                                        <label class="form-check-label" for="filter_is_weekend">Weekend</label>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button class="btn custom-theme-button" id="filtersearch">Filter</button>
                                <button class="btn btn-primary ms-3" style="border-radius: 5px;" type="button"
                                    data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="matchModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Match By</h5>
                            <button class="btn-close btn-light" type="button" data-bs-dismiss="modal"
                                aria-label="Close"> </button>
                        </div>
                        <div class="modal-body">
                            <form class="form-bookmark needs-validation " method="post" id="match_modal"
                                novalidate="">
                                @csrf
                                <div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-check checkbox  checkbox-solid-success mb-0 m-b-10">
                                                <input class="form-check-input" id="match_enquiry_all" type="checkbox">
                                                <label class="form-check-label" for="match_enquiry_all">Select All</label>
                                            </div>
                                            <div class="form-check checkbox  checkbox-solid-success mb-0 m-b-10">
                                                <input class="form-check-input" checked id="match_enquiry_for"
                                                    type="checkbox">
                                                <label class="form-check-label" for="match_enquiry_for">Property
                                                    For</label>
                                            </div>
                                            <div class="form-check checkbox  checkbox-solid-success mb-0 m-b-10">
                                                <input class="form-check-input" checked id="match_property_type"
                                                    type="checkbox">
                                                <label class="form-check-label" for="match_property_type">Property
                                                    Requirement</label>
                                            </div>
                                            <div class="form-check checkbox  checkbox-solid-success mb-0 m-b-10">
                                                <input class="form-check-input" checked id="match_specific_type"
                                                    type="checkbox">
                                                <label class="form-check-label" for="match_specific_type">Property
                                                    Category</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check checkbox  checkbox-solid-success mb-0 m-b-10">
                                                <input class="form-check-input" checked id="match_specific_sub_type"
                                                    type="checkbox">
                                                <label class="form-check-label" for="match_specific_sub_type">Property Sub
                                                    Category</label>
                                            </div>
                                            <div class="form-check checkbox  checkbox-solid-success mb-0 m-b-10">
                                                <input class="form-check-input" checked id="match_budget_from_type"
                                                    type="checkbox">
                                                <label class="form-check-label" for="match_budget_from_type">Property
                                                    Budget</label>
                                            </div>
                                            <div class="form-check checkbox  checkbox-solid-success mb-0 m-b-10">
                                                <input class="form-check-input" checked id="match_enquiry_size"
                                                    type="checkbox">
                                                <label class="form-check-label" for="match_enquiry_size">Property
                                                    Size</label>
                                            </div>
                                            <div class="form-check checkbox  the_prop_weekend checkbox-solid-success mb-0 m-b-10"
                                                style="display: none">
                                                <input class="form-check-input" checked id="match_enquiry_weekend"
                                                    type="checkbox">
                                                <label class="form-check-label" for="match_enquiry_weekend">Property
                                                    Weekend</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center mt-3">
                                    <button class="btn custom-theme-button" type="button" id="matchagain">Match</button>
                                    <button class="btn btn-primary ms-3" style="border-radius: 5px;" type="button"
                                        data-bs-dismiss="modal">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        @if (!empty($shareddata))
            <div class="modal fade" id="sharedModal" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog " role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Shared Property</h5>
                            <button class="btn-close btn-light" type="button" data-bs-dismiss="modal"
                                aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">

                            <div>
                                <div class="row">
                                    <p>Project Name:
                                        {{ isset($shareddata['project_name']) ? $shareddata['project_name'] : '' }}</p>
                                    <p>Property For: {{ isset($shareddata['for']) ? $shareddata['for'] : '' }}</p>
                                    <p>Area: {{ isset($shareddata['area']) ? $shareddata['area'] : '' }}</p>
                                    <p>Configuration : {{ isset($shareddata['config']) ? $shareddata['config'] : '' }}</p>
                                </div>
                            </div>
                            <button class="btn btn-secondary" type="button" id="YesSendRequest">Send Request</button>
                            <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Cancel</button>

                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="modal fade" id="sharedModelId" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-l" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Users</h5>
                        <button class="btn-close btn-light" type="button" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="form-bookmark needs-validation modal_form" route="" id="userRecordForm"
                            novalidate="">
                            <div class="row">
                                <div class="form-group col-md-12 m-b-4 mb-5 mt-2">
                                    <label class="select2_label" for="Property list">Select User </label>
                                    <select class="form-select" id="users_list" multiple>
                                    </select>
                                </div>
                                <div id="selectedUsersArea" class="col-md-12 m-b-4">
                                    <!-- Dynamically added checkboxes will appear here -->
                                </div>
                                <span style="color: #FF0000" id="err_partner"></span>
                                <div class="form-group m-b-4 mb-3 text-center">
                                    <button class="btn custom-theme-button" id="shareData" data-id=""
                                        type="button">Share Property</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <?php
        $matchEnquiryFor = isset($_GET['match_enquiry_for']) ? $_GET['match_enquiry_for'] : null;
        $matchPropertyType = isset($_GET['match_property_type']) ? $_GET['match_property_type'] : null;
        $matchEnqWeekend = isset($_GET['match_enquiry_weekend']) ? $_GET['match_enquiry_weekend'] : null;
        $matchSpecificType = isset($_GET['match_specific_type']) ? $_GET['match_specific_type'] : null;
        $matchSpecificSubType = isset($_GET['match_specific_sub_type']) ? $_GET['match_specific_sub_type'] : null;
        $matchBudgetType = isset($_GET['match_budget_from_type']) ? $_GET['match_budget_from_type'] : null;
        $matchEnqSize = isset($_GET['match_enquiry_size']) ? $_GET['match_enquiry_size'] : null;
        $matchEnqSource = isset($_GET['match_inquiry_source']) ? $_GET['match_inquiry_source'] : null;
        // dd($matchEnquiryFor,$matchPropertyType,$matchBudgetType,$matchSpecificType,$matchEnqSize,$matchEnqSource);
        ?>
    @endsection
    @push('scripts')
        <script>

            let filter_apply = 0;
            
            $(document).on('click', '.read-more-link', function(e) {
                e.preventDefault();
                var $this = $(this);
                var $shortText = $this.siblings('.short-text');
                var $fullText = $this.siblings('.full-text');

                if ($shortText.is(':visible')) {
                    $shortText.addClass('d-none');
                    $fullText.removeClass('d-none');
                    $this.text('Read Less');
                } else {
                    $shortText.removeClass('d-none');
                    $fullText.addClass('d-none');
                    $this.text('Read More');
                }
            });

            $(document).ready(function() {
                // Check or uncheck checkboxes based on PHP variables
                $('#match_enquiry_for').prop('checked', <?= $matchEnquiryFor === '1' ? 'true' : 'false' ?>);
                $('#match_property_type').prop('checked', <?= $matchPropertyType === '1' ? 'true' : 'false' ?>);
                $('#match_enquiry_weekend').prop('checked', <?= $matchEnqWeekend === '1' ? 'true' : 'false' ?>);
                $('#match_specific_type').prop('checked', <?= $matchSpecificType === '1' ? 'true' : 'false' ?>);
                $('#match_specific_sub_type').prop('checked', <?= $matchSpecificSubType === '1' ? 'true' : 'false' ?>);
                $('#match_budget_from_type').prop('checked', <?= $matchBudgetType === '1' ? 'true' : 'false' ?>);
                $('#match_enquiry_size').prop('checked', <?= $matchEnqSize === '1' ? 'true' : 'false' ?>);
                $('#match_inquiry_source').prop('checked', <?= $matchEnqSource === '1' ? 'true' : 'false' ?>);

            });

            //Start Shared Partner Property
            function shareUserModal(clickedElement) {
                $('#users_list').val("");
                $('#sharedModelId').modal('show');
                // Add User Partner
                const dataId = $(clickedElement).data("id");
                $('#shareData').data('data-id', dataId);
            }
            // Get record Users
            // $(document).ready(function() {
            //     try {
            //         axios.get("{{ route('admin.partnerUsers') }}")
            //             .then(function(response) {
            //                 response.data.forEach(function(user) {
            //                     const option = document.createElement("option");
            //                     const selectElement = document.getElementById("users_list");
            //                     option.value = user.partner_id;
            //                     option.textContent = user.user.first_name + ' ' + user.user.last_name;
            //                     selectElement.appendChild(option);
            //                 });
            //             })
            //             .catch(function(error) {
            //                 console.log("Error partner : ", error);
            //             });
            //     } catch (error) {
            //         console.log("err", error)
            //     }
            // });

            $(document).ready(function() {
                // Fetch users via axios
                try {
                    axios.get("{{ route('admin.partnerUsers') }}")
                        .then(function(response) {
                            const $selectElement = $('#users_list');

                            // Loop through each user and append them as options in the select box
                            response.data.forEach(function(user) {
                                const option = $('<option></option>')
                                    .val(user.partner_id)
                                    .text(user.user.first_name + ' ' + user.user.last_name);
                                $selectElement.append(option);
                            });

                            // After adding options, display checkboxes for all users
                            updateSelectedUsers();
                        })
                        .catch(function(error) {
                            console.log("Error partner: ", error);
                        });
                } catch (error) {
                    console.log("Error: ", error);
                }

                // Event listener for when users are selected from the dropdown
                $('#users_list').on('change', function() {
                    updateSelectedUsers(); // Update the checkboxes on user selection
                });

                // Function to create checkboxes based on the selected users
                function updateSelectedUsers() {
                    const $selectedUsersArea = $('#selectedUsersArea');
                    $selectedUsersArea.empty(); // Clear previous checkboxes

                    // Loop through all the options (selected or not) in the select element
                    $('#users_list option').each(function() {
                        const userId = $(this).val();
                        const userName = $(this).text();
                        const isSelected = $(this).is(':selected');

                        // Create a checkbox for each user (checked if selected)
                        const $checkbox = $('<input type="checkbox" class="user-checkbox" />')
                            .val(userId)
                            .attr('id', 'user_' + userId)
                            .prop('checked', isSelected);

                        // Label for the checkbox
                        const $label = $('<label></label>')
                            .attr('for', 'user_' + userId)
                            .text(userName);

                        // Append checkbox and label in one line (inline-block to align them)
                        const $div = $('<div></div>')
                            .css({
                                display: 'inline-block',
                                marginRight: '10px'
                            })
                            .append($checkbox)
                            .append($label);

                        // Append the checkbox with label to the selected users area
                        $selectedUsersArea.append($div);

                        // Remove user from selection when checkbox is unchecked
                        $checkbox.on('change', function() {
                            if (!$(this).is(':checked')) {
                                removeUserFromSelect(userId);
                            }
                        });
                    });
                }

                // Function to remove a user from the dropdown if the checkbox is unchecked
                function removeUserFromSelect(userId) {
                    // Unselect the user from the dropdown
                    $('#users_list option[value="' + userId + '"]').prop('selected', false);
                    updateSelectedUsers(); // Update checkboxes based on the new selection
                }
            });


            // Add User Partner
            $('#shareData').on('click', function() {
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                const selectedUserId = $('#users_list').val();
                const property_id = $(this).data('data-id');
                console.log("selectedUserId", selectedUserId);
                console.log("property_id", property_id);
                axios({
                    method: 'post',
                    url: "{{ route('admin.sharePartner') }}",
                    data: {
                        partner_id: selectedUserId,
                        property_id: property_id,
                        _token: csrfToken, // Include the CSRF token
                    },
                }).then(response => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Property Shared Successfully.',
                        showConfirmButton: false,
                        timer: 1500,
                    }).then(function() {
                        window.location.href = "{{ route('admin.properties') }}";
                    });
                }).catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error occurred',
                        text: 'An error occurred while sharing data.',
                    });
                });
            });
            //End Shared Partner Property

            // category to sub category on change filter
            $('#filter_specific_type').on('change', function() {
                let selectedCategory = this.options[this.selectedIndex].text.trim();
                let url = "{{ route('admin.getPropertyConfiguration') }}";

                try {
                    var xhr = new XMLHttpRequest();
                    xhr.open("GET", `${url}?selectedCategory=${encodeURIComponent(selectedCategory)}`, true);

                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === XMLHttpRequest.DONE) {
                            if (xhr.status === 200) {
                                var data = JSON.parse(xhr.responseText);
                                console.log("data", data);

                                var subCategorySelect = document.getElementById('filter_configuration');
                                subCategorySelect.innerHTML = '<option value="">Sub Category</option>';

                                for (var key in data) {
                                    if (data.hasOwnProperty(key)) {
                                        var option = document.createElement('option');
                                        option.value = key;
                                        option.text = data[key];
                                        option.dataset.category = data[key];
                                        subCategorySelect.appendChild(option);
                                    }
                                }
                            } else {
                                console.error("An error occurred:", xhr.statusText);
                            }
                        }
                    };

                    xhr.send();
                } catch (error) {
                    console.error("An error occurred:", error);
                }
            });

            $('#property_form_type').select2();
            //match enquiry
            matching_enquiry_url = "{{ route('admin.enquiries') }}";

            //matching popup
            function matchingEnquiry(data) {
                $('#matchModal').modal('show');
                // $('#propertyTable').DataTable().draw();
                //     $('#matchModal').modal('hide');


                // if (configuration.includes("15")) {
                //     $('.the_filter_weekend').show();
                // } else {
                //     $('.the_filter_weekend').hide();
                // }
                let propId = $(data).attr('data-id');
                console.log("propId :", propId);

                $('#matchagain').attr('data-id', $(data).attr('data-id'));
                getPropertyCategory(propId)
                // urll = matching_enquiry_url + '?pro=' + encryptSimpleString($(data).attr('data-id'));
                // window.location = urll;
            }

            function getPropertyCategory(propId) {
                $.ajax({
                    type: "GET",
                    url: "{{ route('admin.property.category') }}",
                    data: {
                        id: propId,
                    },
                    success: function(data) {
                        console.log("data.configuration matching  :", data).property_category;

                        if (data.property_category === "255" && data.week_end_villa == '1') {
                            $('.the_prop_weekend').show();
                        } else {
                            $('.the_prop_weekend').hide();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error:", error);
                    }
                });
            }

            $(document).on("click", ".open_modal_with_this", function(e) {
                $('#all_owner_contacts').html('')
                $('#all_units').html('')
                $('#all_owner_contacts').append(generate_contact_detail(makeid(10)));
                $('#all_units').append(generate_unit_detail(makeid(10)));
                floatingField()
            })

            function openwamodel(params) {
                $('#shar_string').val($(params).attr('data-share_string'))
                $('#whatsappModal').modal('show');

            }

            function shareTableRow() {
                var msg = '';
                $(".table_checkbox").each(function(index) {
                    if ($(this).prop('checked')) {
                        var strp = $($(this).closest('tr')).find('i').each(function(i, e) {
                            if ($(this).attr('data-share_string') != undefined) {
                                msg = msg + '%0a --------------------- %0a' + ($(this).attr(
                                    'data-share_string')).replace(
                                    'https://api.whatsapp.com/send?phone=the_phone_number_to_send&text=', ''
                                )
                            }
                        });
                    }
                })
                console.log("msg ::", msg);
                $('#shar_string').val('https://api.whatsapp.com/send?phone=the_phone_number_to_send&text=' + msg)
                $('#whatsappModal').modal('show');
            }

            function importProperties(params) {
                $('#importmodal').modal('show');
            }

            function exportProperties(params) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.export.property') }}",
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        window.open(data)
                    }
                });
            }

            //match enquiry
            var search_enq = '';
            $(document).ready(function() {
                // var queryString = window.location.search;
                var queryString = window.location.search;
                var urlParams = new URLSearchParams(queryString);
                var enqq = urlParams.get('enq')
                var filter_by = urlParams.get('filter_by')
                $('.matchbutton').hide()
                try {
                    search_enq = decryptSimpleString(enqq);
                    if (search_enq != '') {
                        console.log("show");
                        $('.matchbutton').show()
                    } else {
                        console.log("hide");
                        $('.matchbutton').hide()
                    }
                } catch (error) {

                }

                if ($('#sharedModal').length > 0) {
                    $('#sharedModal').modal('show');
                }

                $(document).on('click', '#YesSendRequest', function(e) {
                    $('#sharedModal').modal('hide');
                    $.ajax({
                        type: "POST",
                        url: "{{ route('admin.shared.send') }}",
                        data: {
                            shareproperty: '{{ $sharedlk }}',
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(data) {
                            if (data != '') {
                                Swal.fire({
                                    title: data,
                                    icon: "warning",
                                    showCancelButton: false,
                                })
                            }
                        }
                    })
                })

                $(document).on('click', '#shareonwhatsapp', function(e) {
                    var url = $('#shar_string').val()
                    console.log("ulr1 ==>", url);
                    url = url.replace('the_phone_number_to_send', $('#CountryCode').val() + $(
                        '#whatsapp_number').val().toString())
                    console.log("ulr2 ==>", url);
                    window.open(url, '_blank').focus();
                })

                //matching popup
                // $(document).on('click', '#matchagain', function(e) {
                // 	console.log("Matching 1");
                //     e.preventDefault();
                //     $('#propertyTable').DataTable().draw();
                //     $('#matchModal').modal('hide');
                // })
                // $(document).on('click', '#matchagain', function(e) {
                //     console.log("Matching Done");
                //     e.preventDefault();
                //     let dataId = $(this).attr('data-id');
                //     urll = matching_enquiry_url + '?pro=' + (dataId);
                //     // urll = matching_enquiry_url + '?pro=' + encryptSimpleString(dataId);
                //     window.location = urll;
                //     $('#propertyTable').DataTable().draw();
                //     $('#matchModal').modal('hide');
                // });
                if (window.location.pathname.toLowerCase() === '/admin/properties' && window.location.search === '') {
                    $('#match_enquiry_all, #match_enquiry_for, #match_property_type, #match_enquiry_weekend,#match_specific_type, #match_specific_sub_type, #match_budget_from_type, #match_enquiry_size, #match_inquiry_source')
                        .prop('checked', true);
                }
                $('#match_enquiry_all').on('change', function() {
                    let isChecked = $(this).prop('checked');
                    $('#match_enquiry_for, #match_property_type, #match_enquiry_weekend, #match_specific_type, #match_specific_sub_type, #match_budget_from_type, #match_enquiry_size, #match_inquiry_source')
                        .prop('checked', isChecked);
                });

                $(document).on('click', '#matchagain', function(e) {
                    e.preventDefault();

                    // Gather selected checkbox values
                    let selectedCheckboxes = {
                        match_enquiry_for: $('#match_enquiry_for').prop('checked') ? 1 : 0,
                        match_property_type: $('#match_property_type').prop('checked') ? 1 : 0,
                        match_enquiry_weekend: $('#match_enquiry_weekend').prop('checked') ? 1 : 0,
                        match_specific_type: $('#match_specific_type').prop('checked') ? 1 : 0,
                        match_specific_sub_type: $('#match_specific_sub_type').prop('checked') ? 1 : 0,
                        match_budget_from_type: $('#match_budget_from_type').prop('checked') ? 1 : 0,
                        match_enquiry_size: $('#match_enquiry_size').prop('checked') ? 1 : 0,
                        match_inquiry_source: $('#match_inquiry_source').prop('checked') ? 1 : 0,
                    };

                    // Construct the URL with selected checkbox values
                    let queryString = Object.entries(selectedCheckboxes)
                        .filter(([key, value]) => value === 1)
                        .map(([key, value]) => `${key}=${value}`)
                        .join('&');

                    let dataId = $(this).attr('data-id');
                    let url = matching_enquiry_url + '?' + queryString + '&pro=' + encryptSimpleString(dataId);

                    // Redirect to the new URL
                    window.location = url;
                });


                $('#propertyTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ordering: true,
                    @if (!Auth::user()->can('search-property'))
                        searching: false,
                    @endif
                    ajax: {
                        url: "{{ route('admin.properties') }}",
                        data: function(d) {
                            d.filter_property_for = $('#filter_property_for').val();
                            d.filter_property_type = $('#filter_property_type').val();
                            d.filter_specific_type = $('#filter_specific_type').val();
                            d.filter_configuration = $('#filter_configuration').val();
                            d.filter_building_id = $('#filter_building_id').val();
                            d.filter_area_id = $('#filter_area_id').val();
                            d.filter_availability_status = $('#filter_availability_status').val();
                            d.filter_owner_is = $('#filter_owner_is').val();
                            d.filter_Property_priority = $('#filter_Property_priority').val();
                            d.filter_property_status = $('#filter_property_status').val();
                            d.filter_from_date = $('#filter_from_date').val();
                            d.filter_to_date = $('#filter_to_date').val();
                            d.filter_from_price = $('#filter_from_price').val();
                            d.filter_to_price = $('#filter_to_price').val();
                            d.filter_from_area = $('#filter_from_area').val();
                            d.filter_to_area = $('#filter_to_area').val();
                            d.filter_measurement = $('#filter_measurement').val();
                            d.filter_is_preleased = Number($('#filter_is_preleased').prop('checked'));
                            d.filter_is_hot = Number($('#filter_is_hot').prop('checked'));
                            d.filter_is_terraced = Number($('#filter_is_terraced').prop('checked'));
                            d.filter_is_weekend = Number($('#filter_is_weekend').prop('checked'));
                            d.search_enq = search_enq;
                            d.match_property_type = Number($('#match_property_type').prop('checked'));
                            d.match_enquiry_weekend = Number($('#match_enquiry_weekend').prop('checked'));
                            d.match_specific_type = Number($('#match_specific_type').prop('checked'));
                            d.match_specific_sub_type = Number($('#match_specific_sub_type').prop(
                                'checked'));
                            d.match_enquiry_for = Number($('#match_enquiry_for').prop('checked'));
                            d.match_budget_from_type = Number($('#match_budget_from_type').prop('checked'));
                            d.match_enquiry_size = Number($('#match_enquiry_size').prop('checked'));
                            d.match_inquiry_source = Number($('#match_inquiry_source').prop('checked'));
                            // d.match_building = Number($('#match_building').prop('checked'));
                            d.filter_by = filter_by;
                            d.filter_apply = filter_apply;
                            d.location = window.location.href;

                        },
                    },
                    columns: [{
                            data: 'select_checkbox',
                            name: 'select_checkbox',
                            orderable: false
                        }, {
                            data: 'project_id',
                            name: 'project_id'
                        },
                        {
                            data: 'property_category',
                            name: 'property_category'
                        },
                        {
                            data: 'unit_details',
                            name: 'unit_details'
                        },
                        {
                            data: 'price',
                            name: 'price'

                        },
                        // {
                        //     data: 'remarks',
                        //     name: 'remarks'
                        // },
                        {
                            data: 'remarks',
                            name: 'remarks',
                            render: function(data, type, full, meta) {
                                if (data && data.length > 56) {
                                    return '<span class="truncated">' + data.substr(0, 56) +
                                        '...</span><span class="full" style="display:none;">' + data +
                                        '</span><span class="read-more">Read More</span>';
                                } else {
                                    return data;
                                }
                            }
                        }, {
                            data: 'Actions2',
                            name: 'Actions2',
                            orderable: false
                        },
                    ],
                    columnDefs: [{
                            "width": "2%",
                            "targets": 0
                        },
                        {
                            "width": "20%",
                            "targets": 1
                        },
                        {
                            "width": "17%",
                            "targets": 2
                        },
                        {
                            "width": "10%",
                            "targets": 3
                        },
                        {
                            "width": "12%",
                            "targets": 4
                        },
                        {
                            "width": "18%",
                            "targets": 5
                        },
                        {
                            "width": "15%",
                            "targets": 6
                        },
                    ],
                    //#B To Change Background when prop_status = 0. 
                    "createdRow": function(row, data, dataIndex) {
                        if (data['prop_status'] == 0) {
                            $(row).addClass('important-row');
                        }
                    },
                    "drawCallback": function(settings, json) {
                        setTimeout(() => {
                            $('.color-code-popover').popover({
                                html: true,
                            });
                        }, 500);
                        var popoverTriggerList = [].slice.call(document.querySelectorAll(
                            '[data-bs-toggle="popover"]'))
                        var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
                            return new bootstrap.Popover(popoverTriggerEl)
                        });
                    }
                });
                table.order([1, 'desc']).draw();
            });
            //Read more / Read less
            $('#propertyTable .read-more, #propertyTable .read-less').css('cursor', 'pointer');
            $('#propertyTable').on('click', '.read-more', function() {
                $(this).siblings('.truncated').hide();
                $(this).siblings('.full').show();
                $(this).text(' ...Read Less').removeClass('read-more').addClass('read-less');
            });
            $('#propertyTable').on('click', '.read-less', function() {
                $(this).siblings('.full').hide();
                $(this).siblings('.truncated').show();
                $(this).text('Read More').removeClass('read-less').addClass('read-more');
            });

            function getProperty(data) {
                $('#modal_form').trigger("reset");
                var id = $(data).attr('data-id');
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.getProperty') }}",
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        data = JSON.parse(data);
                        $('#this_data_id').val(data.id);
                        $('#property_for').val(data.property_for).trigger('change');
                        $('#property_type').val(data.property_type).trigger('change');
                        $('#specific_type').val(data.specific_type).trigger('change');
                        $('#building_id').val(data.building_id).trigger('change');
                        $('#is_favourite').prop('checked', Number(data.is_favourite));
                        $('#property_wing').val(data.property_wing);
                        $('#property_unit_no').val(data.property_unit_no);
                        $('#configuration').val(data.configuration).trigger('change');;
                        $('#property_status').val(data.property_status).trigger('change');;
                        $('#carpet_area').val(data.carpet_area);
                        $('#carpet_measurement').val(data.carpet_measurement).trigger('change');;
                        $('#super_builtup_area').val(data.super_builtup_area);
                        $('#super_builtup_measurement').val(data.super_builtup_measurement).trigger('change');;
                        $('#plot_area').val(data.plot_area);
                        $('#plot_measurement').val(data.plot_measurement).trigger('change');;
                        $('#terrace').val(data.terrace);
                        $('#terrace_measuremnt').val(data.terrace_measuremnt).trigger('change');;
                        $('#hot_property').prop('checked', Number(data.hot_property));
                        $('#share_to_others').prop('checked', Number(data.share_to_others));
                        $('#furnished_status').val(data.furnished_status).trigger('change');;
                        $('#fourwheller_parking').val(data.fourwheller_parking);
                        $('#property_link').val(data.property_link);
                        $('#twowheeler_parking').val(data.twowheeler_parking);
                        $('#source_of_property').val(data.source_of_property).trigger('change');;
                        $('#if_any_refrence').val(data.if_any_refrence);
                        $('#is_pre_leased').prop('checked', Number(data.is_pre_leased));
                        $('#pre_leased_remarks').val(data.pre_leased_remarks);
                        $('#price').val(data.price);
                        $('#property_remarks').val(data.property_remarks);
                        $('#owner_is').val(data.owner_is).trigger('change');;
                        $('#property_email').val(data.property_email);
                        $('#owner_info_name').val(data.owner_info_name);
                        $('#owner_contact_specific_no').val(data.owner_contact_specific_no);
                        $('#is_nri').prop('checked', Number(data.is_nri));
                        $('#care_take_name').val(data.care_take_name);
                        $('#care_take_contact_no').val(data.care_take_contact_no);
                        $('#key_arrangement').val(data.key_arrangement).trigger('change');
                        $('#Property_priority').val(data.Property_priority).trigger('change');
                        $('#reminder').val(data.reminder)
                        $('#propertyModal').modal('show');
                        $('#all_owner_contacts').html('')
                        $('#all_units').html('')
                        if (data.owner_details != '') {
                            details = JSON.parse(data.owner_details);
                            if ((details != null) && (details.length > 0)) {
                                for (let i = 0; i < details.length; i++) {
                                    id = makeid(10);
                                    $('#all_owner_contacts').append(generate_contact_detail(id))
                                    floatingField()
                                    $("[data-contact_id=" + id + "] select[name=owner_status]").select2()
                                    $("[data-contact_id=" + id + "] input[name=owner_name]").val(details[i][0]);
                                    $("[data-contact_id=" + id + "] input[name=owner_contact_no]").val(details[i][
                                        1
                                    ]);
                                    $("[data-contact_id=" + id + "] select[name=owner_status]").val(details[i][2])
                                        .trigger('change');
                                }
                            }
                        }
                        if (data.unit_details != '') {
                            details = JSON.parse(data.unit_details);
                            if ((details != null) && (details.length > 0)) {

                                for (let i = 0; i < details.length; i++) {
                                    id = makeid(10);
                                    $('#all_units').append(generate_unit_detail(id))
                                    floatingField()
                                    $("[data-unit_id=" + id + "] select[name=unit_status]").select2()
                                    $("[data-unit_id=" + id + "] select[name=furnished_status]").select2()
                                    $("[data-unit_id=" + id + "] input[name=wing]").val(details[i][0]);
                                    $("[data-unit_id=" + id + "] input[name=unit_unit_no]").val(details[i][1]);
                                    $("[data-unit_id=" + id + "] select[name=unit_status]").val(details[i][2])
                                        .trigger('change');
                                    $("[data-unit_id=" + id + "] input[name=price]").val(details[i][3]);
                                    $("[data-unit_id=" + id + "] select[name=furnished_status]").val(details[i][4])
                                        .trigger('change');
                                }
                            }
                        }
                        $('#show_building_address').val($('#building_id').find(":selected").attr('data-addr'));
                        triggerChangeinput()
                        floatingField()
                        $('#choose-property-form').hide();

                    }
                });
            }

            $(document).on('change', '#conatct_id', function(e) {
                $('#whatsapp_number').val($(this).val())
            })

            $(document).on('change', '#building_id', function(e) {
                if (isNaN(Number($(this).val()))) {
                    $('#show_building_address').removeAttr('disabled')
                } else {
                    $('#show_building_address').attr('disabled', 'disabled')
                    $('#show_building_address').val($('#building_id').find(":selected").attr('data-addr')).trigger(
                        'change');
                }
                $('#show_building_address').parent().parent().addClass('focused')
            })

            function ShareLink(params) {
                var share_link = $(params).attr('data-link');
                Swal.fire({
                    title: "Property Link",
                    text: $(params).attr('data-link'),
                    confirmButtonText: 'Copy',
                }).then((value) => {
                    if (value.value) {
                        copyToClipboard(share_link);
                        Swal.fire({
                            icon: "success",
                            title: "Copied!",
                        });
                    }
                });
            }

            function copyToClipboard(text) {
                var $temp = $("<input>");
                $("body").append($temp);
                $temp.val(text).select();
                document.execCommand("copy");
                $temp.remove();
            }

            function deleteProperty(data) {
                Swal.fire({
                    title: "Are you sure?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                }).then(function(isConfirm) {
                    if (isConfirm.isConfirmed) {
                        var id = $(data).attr('data-id');
                        $.ajax({
                            type: "POST",
                            url: "{{ route('admin.deleteProperty') }}",
                            data: {
                                id: id,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(data) {
                                $('#propertyTable').DataTable().draw();
                            }
                        });
                    }
                })

            }

            var allowedselect2s = ['building_id'];
            $(document).on('keydown', '.select2-search__field', function(e) {
                setTimeout(() => {
                    var par = $(this).closest('.select2-dropdown')
                    var tar = $(par).find('.select2-results')
                    var kar = $(tar).find('.select2-results__options')
                    var opt = $(kar).find('li')
                    if (opt.length == 1 && $(opt[0]).text() == 'No results found' && $(this).val() != '') {
                        var idd = $(kar).attr('id')
                        idd = idd.replace("select2-", "");
                        idd = idd.replace("-results", "");
                        if (allowedselect2s.includes(idd)) {
                            $("#" + idd + " option[last_added='" + true + "']").each(function(i, e) {
                                $('#' + idd + ' option[value="' + $(this).val() + '"]').detach();
                            });
                            if ($("#" + idd + " option[value='" + $(this).val() + "']").length == 0) {
                                var newState = new Option($(this).val(), $(this).val(), true, true);

                                vvvv = $.parseHTML('<option last_added="true" value="' + $(this).val() +
                                    '" selected="">' + $(this).val() + '</option>');
                                $("#" + idd).append(vvvv).trigger('change');
                            }
                        }
                    } else if ($(this).val() != '' && $(opt[0])[0] !== undefined && $($(opt[0])[0]).attr(
                            'id') != '') {
                        var idd = $(kar).attr('id')
                        idd = idd.replace("select2-", "");
                        idd = idd.replace("-results", "");
                        if (allowedselect2s.includes(idd)) {
                            $("#" + idd + " option[last_added='" + true + "']").each(function(i, e) {
                                $('#' + idd + ' option[value="' + $(this).val() + '"]').detach();
                            });
                            if ($("#" + idd + " option[value='" + $(this).val() + "']").length == 0) {
                                var newState = new Option($(this).val(), $(this).val(), true, true);

                                vvvv = $.parseHTML('<option last_added="true" value="' + $(this).val() +
                                    '" selected="">' + $(this).val() + '</option>');
                                $("#" + idd).append(vvvv).trigger('change');
                            }
                        }
                    }
                    $('.select2-search__field').trigger('change');
                }, 50);
            })

            $(document).on('change', '#select_all_checkbox', function(e) {
                if ($(this).prop('checked')) {
                    $('.delete_table_row').show();
                    $('.share_table_row').show();

                    $(".table_checkbox").each(function(index) {
                        $(this).prop('checked', true)
                    })
                } else {
                    $('.share_table_row').hide();
                    $('.delete_table_row').hide();
                    $(".table_checkbox").each(function(index) {
                        $(this).prop('checked', false)
                    })
                }
            })

            $(document).on('change', '.table_checkbox', function(e) {
                var rowss = [];
                $(".table_checkbox").each(function(index) {
                    if ($(this).prop('checked')) {
                        rowss.push($(this).attr('data-id'))
                    }
                })
                if (rowss.length > 0) {
                    $('.delete_table_row').show();
                    $('.share_table_row').show();
                } else {
                    $('.delete_table_row').hide();
                    $('.share_table_row').hide();
                }
            })

            function deleteTableRow(params) {
                var rowss = [];
                $(".table_checkbox").each(function(index) {
                    if ($(this).prop('checked')) {
                        rowss.push($(this).attr('data-id'))
                    }
                })
                if (rowss.length > 0) {
                    Swal.fire({
                        title: "Are you sure?",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonText: 'Yes',
                    }).then(function(isConfirm) {
                        if (isConfirm.isConfirmed) {
                            $.ajax({
                                type: "POST",
                                url: "{{ route('admin.deleteProperty') }}",
                                data: {
                                    allids: JSON.stringify(rowss),
                                    _token: '{{ csrf_token() }}'
                                },
                                success: function(data) {
                                    $('.delete_table_row').hide();
                                    $('#propertyTable').DataTable().draw();
                                }
                            });
                        }
                    })
                }
            }

            $(document).on('change', '.changeTheStatus', function(e) {
                stat = 0;
                if ($(this).prop('checked')) {
                    stat = 1;
                }
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.changePropertyStatus') }}",
                    data: {
                        id: $(this).attr('data-id'),
                        status: stat,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {

                    }
                });
            })

            $(document).on('click', '#filtersearch', function(e) {
                filter_apply = 1;
                e.preventDefault();
                search_enq = '';
                $('#resetfilter').show();
                $('#resetfilter').removeClass('d-none');
                $('#propertyTable').DataTable().draw();
                $('#filtermodal').modal('hide');
            });

            $(document).on('click', '#resetfilter', function(e) {
                e.preventDefault();
                $(this).hide();
                filter_apply = 0;
                $('#filter_form').trigger("reset");
                $('#propertyTable').DataTable().draw();
                $('#filtermodal').modal('hide');
                triggerResetFilter()
            });

            $(document).on('click', '.showNumberNow', function(e) {
                numb = $(this).attr('data-val');
                $(this).replaceWith('<a href="tel:' + numb + '">' + numb + '</a>');
            })

            function makeid(length) {
                var result = '';
                var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                var charactersLength = characters.length;
                for (var i = 0; i < length; i++) {
                    result += characters.charAt(Math.floor(Math.random() * charactersLength));
                }
                return result;
            }

            function generate_contact_detail(id) {
                var myvar = '<div data-contact_id= ' + id + ' class="form-group col-md-3 m-b-20">' +
                    '<label>Name</label>' +
                    '       <input class="form-control" name="owner_name" type="text"' +
                    '            autocomplete="off">' +
                    '     </div>' +
                    '     <div data-contact_id= ' + id +
                    ' class="form-group col-md-3 m-b-20">' +
                    '<label>Contact No</label>' +
                    '       <input class="form-control" name="owner_contact_no"' +
                    '           type="text"  autocomplete="off">' +
                    '   </div>' +
                    '       <div data-contact_id= ' + id +
                    ' class="form-group col-md-3 m-b-4 mb-3">' +
                    '    <select class="form-select" name="owner_status">' +
                    '     <option value="">Contact Status</option>' +
                    '    <option value="Contactable">Contactable</option>' +
                    '     <option value="Not Contactable">Not Contactable</option>' +
                    '  </select>  </div>' +
                    '<div data-contact_id= ' + id +
                    ' class="form-group col-md-3 m-b-4 mb-3"><button data-contact_id=' + id +
                    ' class="remove_owner_contacts btn btn-danger btn-air-danger" type="button">-</button>  </div>';
                return myvar;
            }

            function generate_unit_detail(id) {
                var myvar = '<div class="row"><div  data-unit_id= ' + id + ' class="form-group col-md-2 m-b-20">' +
                    '<label>Wing</label>' +
                    '            <input class="form-control" name="wing" ' +
                    '                type="text"  autocomplete="off">' +
                    '        </div>' +
                    '<div  data-unit_id= ' + id + ' class="form-group col-md-2 m-b-20">' +
                    '<label>Unit No</label>' +
                    '            <input class="form-control" name="unit_unit_no" ' +
                    '                type="text"  autocomplete="off">' +
                    '        </div>' +
                    '        <div  data-unit_id= ' + id + ' class="form-group col-md-2 m-b-4 mb-3">' +
                    '            <select class="form-select" name="unit_status">' +
                    '                <option value="">Unit Status</option>' +
                    '                <option value="Contactable">Available</option>' +
                    '                <option value="Rent Out">Rent Out</option>' +
                    '                <option value="Sold Out">Sold Out</option>' +
                    '            </select>' +
                    '        </div>' +
                    '<div  data-unit_id= ' + id + ' class="form-group col-md-2 m-b-20">' +
                    '<label>Price</label>' +
                    '            <input class="form-control indian_currency_amount" name="price" ' +
                    '                type="text"  autocomplete="off">' +
                    '        </div>' +
                    '        <div  data-unit_id= ' + id + ' class="form-group col-md-2 m-b-4 mb-3">' +
                    '            <select class="form-select" name="furnished_status">' +
                    '                <option value="">Furnished Status</option>' +
                    @forelse ($property_configuration_settings as $props)
                        @if ($props['dropdown_for'] == 'property_furniture_type')
                            '                <option value="{{ $props['id'] }}">{{ $props['name'] }}</option>' +
                        @endif
                    @empty
                    @endforelse

                '            </select>' +
                '        </div>' +
                '<div data-unit_id= ' + id +
                    ' class="form-group col-md-1 m-b-4 mb-3"><button data-unit_id=' + id +
                    ' class="remove_units btn btn-danger btn-air-danger" type="button">-</button>  </div></div>';
                return myvar;
            }

            $(document).on('click', '#add_owner_contacts', function(e) {
                id = makeid(10);
                $('#all_owner_contacts').append(generate_contact_detail(id));
                $("#all_owner_contacts select").each(function(index) {
                    $(this).select2();
                })
                floatingField();
            })
            $(document).on('click', '.remove_owner_contacts', function(e) {
                id = $(this).attr('data-contact_id');
                $("[data-contact_id=" + id + "]").each(function(index) {
                    $(this).remove();
                });
            })

            $(document).on('click', '#add_units', function(e) {
                id = makeid(10);
                $('#all_units').append(generate_unit_detail(id));
                $("#all_units select").each(function(index) {
                    $(this).select2();
                })
                floatingField();
            })
            $(document).on('click', '.remove_units', function(e) {
                id = $(this).attr('data-unit_id');
                $("[data-unit_id=" + id + "]").each(function(index) {
                    $(this).remove();
                });
            })

            $('#modal_form').validate({ // initialize the plugin
                rules: {
                    property_for: {
                        required: true,
                    },
                    property_type: {
                        required: true,
                    },
                    specific_type: {
                        required: true,
                    },
                    building_id: {
                        required: true,
                    },
                    property_unit_no: {
                        digits: true,
                    },
                    carpet_area: {
                        digits: true,
                    },
                    super_builtup_area: {
                        digits: true,
                    },
                    plot_area: {
                        digits: true,
                    },
                    terrace: {
                        digits: true,
                    },
                    property_email: {
                        email: true,
                    },
                },
                submitHandler: function(form) { // for demo
                    alert('valid form submitted'); // for demo
                    return false; // for demo
                }
            });

            $(document).on('click', '#saveProperty', function(e) {
                e.preventDefault();
                $("#modal_form").validate();
                if (!$("#modal_form").valid()) {
                    return
                }
                $(this).prop('disabled', true);
                var owner_details = [];
                $("#modal_form [name=owner_name]").each(function(index) {
                    cona_arr = []
                    unique_id = $(this).closest('.form-group').attr('data-contact_id');
                    name = $(this).val();
                    contact = $("[data-contact_id=" + unique_id + "] input[name=owner_contact_no]").val();
                    status = $("[data-contact_id=" + unique_id + "] select[name=owner_status]").val();
                    cona_arr.push(name)
                    cona_arr.push(contact)
                    cona_arr.push(status)
                    if (filtercona_arr(cona_arr)) {
                        owner_details.push(cona_arr);
                    }
                });
                owner_details = JSON.stringify(owner_details);
                var unit_details = [];
                $("#modal_form [name=unit_unit_no]").each(function(index) {
                    cona_arr = []
                    unique_id = $(this).closest('.form-group').attr('data-unit_id');
                    name = $(this).val();
                    wing = $("[data-unit_id=" + unique_id + "] input[name=wing]").val();
                    status = $("[data-unit_id=" + unique_id + "] select[name=unit_status]").val();
                    price = $("[data-unit_id=" + unique_id + "] input[name=price]").val();
                    furnished = $("[data-unit_id=" + unique_id + "] select[name=furnished_status]").val();
                    cona_arr.push(wing)
                    cona_arr.push(name)
                    cona_arr.push(status)
                    cona_arr.push(price)
                    cona_arr.push(furnished)
                    if (filtercona_arr(cona_arr)) {
                        unit_details.push(cona_arr);
                    }
                });
                unit_details = JSON.stringify(unit_details);
                var id = $('#this_data_id').val()
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.saveProperty') }}",
                    data: {
                        id: id,
                        property_for: $('#property_for').val(),
                        property_type: $('#property_type').val(),
                        specific_type: $('#specific_type').val(),
                        building_id: $('#building_id').val(),
                        property_wing: $('#property_wing').val(),
                        property_unit_no: $('#property_unit_no').val(),
                        configuration: $('#configuration').val(),
                        property_status: $('#property_status').val(),
                        carpet_area: $('#carpet_area').val(),
                        carpet_measurement: $('#carpet_measurement').val(),
                        property_link: $('#property_link').val(),
                        show_building_address: $('#show_building_address').val(),
                        super_builtup_area: $('#super_builtup_area').val(),
                        super_builtup_measurement: $('#super_builtup_measurement').val(),
                        plot_area: $('#plot_area').val(),
                        plot_measurement: $('#plot_measurement').val(),
                        terrace: $('#terrace').val(),
                        terrace_measuremnt: $('#terrace_measuremnt').val(),
                        hot_property: Number($('#hot_property').prop('checked')),
                        share_to_others: Number($('#share_to_others').prop('checked')),
                        furnished_status: $('#furnished_status').val(),
                        fourwheller_parking: $('#fourwheller_parking').val(),
                        twowheeler_parking: $('#twowheeler_parking').val(),
                        source_of_property: $('#source_of_property').val(),
                        if_any_refrence: $('#if_any_refrence').val(),
                        is_pre_leased: Number($('#is_pre_leased').prop('checked')),
                        pre_leased_remarks: $('#pre_leased_remarks').val(),
                        price: $('#price').val(),
                        property_remarks: $('#property_remarks').val(),
                        owner_is: $('#owner_is').val(),
                        property_email: $('#property_email').val(),
                        owner_info_name: $('#owner_info_name').val(),
                        owner_contact_specific_no: $('#owner_contact_specific_no').val(),
                        is_nri: Number($('#is_nri').prop('checked')),
                        owner_details: owner_details,
                        unit_details: unit_details,
                        care_take_name: $('#care_take_name').val(),
                        care_take_contact_no: $('#care_take_contact_no').val(),
                        key_arrangement: $('#key_arrangement').val(),
                        Property_priority: $('#Property_priority').val(),
                        reminder: $('#reminder').val(),
                        is_favourite: Number($('#is_favourite').prop('checked')),
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        $('#propertyTable').DataTable().draw();
                        $('#propertyModal').modal('hide');
                        $('#saveProperty').prop('disabled', false);
                    }
                });
            })

            $(document).on('change', '#property_type', function(e) {
                var parent_value = $(this).val();
                console.log("proper type click", parent_value);
                $("#specific_type option , #configuration option").each(function() {
                    if (parent_value !== '') {
                        if ($(this).attr('value') != '') {
                            if ($(this).attr('data-parent_id') == '' || $(this).attr('data-parent_id') !=
                                parent_value) {
                                $(this).hide();
                            } else {
                                $(this).show();
                            }
                        }
                    } else {
                        $(this).show();
                    }
                });
            });

            $(document).on('change', '#filter_property_type', function(e) {
                var parent_value = $(this).val();
                console.log("type changed", parent_value);
                $("#filter_specific_type option , #filter_configuration option").each(function() {
                    if (parent_value !== '') {
                        if ($(this).attr('value') != '') {
                            if ($(this).attr('data-parent_id') == '' || $(this).attr('data-parent_id') !=
                                parent_value) {
                                $(this).hide();
                            } else {
                                $(this).show();
                            }
                        }
                    } else {
                        $(this).show();
                    }
                });
            });

            $(document).on('click', '#importFile', function(e) {
                e.preventDefault();
                var formData = new FormData();
                var files = $('#import_file')[0].files[0];
                if (files == '') {
                    return;
                }
                formData.append('csv_file', files);
                formData.append('_token', '{{ csrf_token() }}');
                $.ajax({
                    type: "POST",
                    processData: false,
                    contentType: false,
                    url: "{{ route('admin.importproperty') }}",
                    data: formData,
                    success: function(data) {
                        $('#propertyTable').DataTable().draw();
                        $('#importmodal').modal('hide');
                        $('#import_form')[0].reset();
                    }
                });
            })

            function floatingField() {
                //changed by Subhash
                $("form input").each(function(index) {
                    if ($(this).attr('type') == 'text' || $(this).attr('type') == 'email') {
                        var inputhtml = $(this).clone()
                        var parentId = $(this).parent();
                        if (parentId.find('label').length > 0) {
                            $(this).remove();
                            var currenthtml = $(parentId).html()
                            $(parentId).html('<div class="fname">' + currenthtml + '<div class="fvalue">' + inputhtml[0]
                                .outerHTML + '</div>' + '</div>')
                        }
                    }
                })

                $("form select").each(function(index) {
                    var attrs = $(this).attr('multiple');
                    if (typeof attrs === 'undefined' || attrs === false) {
                        $(this).find('option:first').attr('selected', 'selected')
                        // $(this).find('option:first').attr('disabled', 'disabled')
                    }
                    $(this).select2();
                })
            }

            $(document).on('change', '#import_category', function() {
                var type = $('#import_category option:selected').attr('data-val')
                $('#import_url').attr('href', $('#import_url').attr('href') + '?type=' + type);
            })

            $(document).on('change', '#property_form_type', function() {
                var form_type = $(this).val();
                $.ajax({
                    type: "Get",
                    url: "{{ route('admin.property.form') }}",
                    data: {
                        type: form_type
                    },
                    success: function(data) {
                        $('#property-form-content').html(data.content);
                        floatingField()
                    }
                });
            });

            $(document).on('hidden.bs.modal', '#propertyModal', function() {
                $('#choose-property-form').show();
                $('#property_form_type').val('property').change();
            });
        </script>
    @endpush
