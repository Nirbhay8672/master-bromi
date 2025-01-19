<?php

namespace App\Http\Controllers\Api;

use Throwable;
// use App\Models\User;
use App\Models\Country;
// use App\Helpers\Helper;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
// use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    /**
     * PaginationMethod
     *
     * @param  mixed $request
     * @return void
     */
    // public function paginationMethod(Request $request)
    // {
    //     try {
    //         $user_id = $request->user()->id;
    //         $validator = Validator::make(
    //             $request->all(),
    //             [
    //                 'plate_number' => 'required',
    //             ]
    //         );

    //         if ($validator->fails()) {
    //             $result = json_decode($validator->errors(), true);
    //             $message = '';
    //             foreach ($result as $value) {
    //                 $message = implode(', ', $value);
    //                 break;
    //             }
    //             return response()->json(['status' => 0, 'message' => $message, 'result' => null]);
    //         }

    //         $per_page = 10;
    //         $page_no = 1;
    //         if (isset($request->per_page) && !empty($request->per_page)) {
    //             $per_page = $request->per_page;
    //         }
    //         if (isset($request->page_no) && !empty($request->page_no)) {
    //             $page_no = $request->page_no;
    //         }
    //         $offset = ($page_no - 1) * $per_page;

    //         $report = User::select("id", "plate_number", "rating");
    //         $report->orderBy('id', 'desc');

    //         if (!empty($per_page)) {
    //             $report->offset($offset);
    //             $report->limit($per_page);
    //         }

    //         $report = $report->get();

    //         return response()->json(['status' => 200, 'message' => "", 'result' => compact('report')]);
    //     } catch (Throwable $e) {
    //         Log::error($e->getMessage());
    //         return response()->json(['status' => 0, 'message' => trans('app.something_went_wrong'), 'result' => null]);
    //     }
    // }

    /**
     * SaveMethod
     *
     * @param  mixed $request
     * @return void
     */
    // public function saveMethod(Request $request)
    // {
    //     try {
    //         $user_id = $request->user()->id;
    //         $validator = Validator::make($request->all(), [
    //             "param1" => "required",
    //             'photo' => 'required|mimes:jpeg,png',
    //         ]);

    //         if ($validator->fails()) {
    //             $result = json_decode($validator->errors(), true);
    //             $message = '';
    //             foreach ($result as $value) {
    //                 $message = implode(', ', $value);
    //                 break;
    //             }
    //             return response()->json(['status' => 0, 'message' => $message, 'result' => null]);
    //         }

    //         $photo = null;
    //         if ($request->hasFile('photo') && $request->photo != "") {
    //             $file = $request->file('photo');
    //             $ext = $file->getClientOriginalExtension();
    //             $photo = "Img-" . \Carbon\Carbon::now()->timestamp . mt_rand(1000, 9999) . "." . $ext;
    //             Helper::uploadFile($file, config('constant.photo_url'), $photo);
    //         }

    //         $updateParams = ['user_id' => $user_id, 'param1' => $request->param1, 'photo' => $photo,  "status" => 1];

    //         $report = User::updateOrCreate(["id" => $request->id], $updateParams);

    //         if ($report) {
    //             return response()->json(
    //                 [
    //                     'status' => 200,
    //                     'message' => trans('app.Report_has_been_saved_successfully'),
    //                     'result' => null
    //                 ]
    //             );
    //         } else {
    //             return response()->json(
    //                 [
    //                     'status' => 0,
    //                     'message' => trans('app.something_went_wrong'),
    //                     'result' => null
    //                 ]
    //             );
    //         }
    //     } catch (Throwable $e) {
    //         Log::error($e->getMessage());
    //         return response()->json(
    //             [
    //                 'status' => 0,
    //                 'message' => trans('app.something_went_wrong'),
    //                 'result' => null
    //             ]
    //         );
    //     }
    // }

    /**
     * Country
     *
     * @return void
     */
    public function country()
    {
        try {
            $country = Country::select("id", "name")->get();

            if ($country) {
                return response()->json(
                    [
                        'status' => 200,
                        'message' => trans('app.Country_found'),
                        'result' => $country
                    ]
                );
            } else {
                return response()->json(
                    [
                        'status' => 0,
                        'message' => trans('app.No_country_found'),
                        'result' => null
                    ]
                );
            }
        } catch (Throwable $e) {
            Log::error($e->getMessage());
            return response()->json(
                [
                    'status' => 0,
                    'message' => trans('app.something_went_wrong'),
                    'result' => null
                ]
            );
        }
    }
}
