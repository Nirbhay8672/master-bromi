<?php

	namespace App\Http\Controllers\Superadmin;

	use App\Http\Controllers\Controller;
	use App\Models\Subplans;
	use Illuminate\Http\Request;
	use Yajra\DataTables\Facades\DataTables;

	class PlanController extends Controller
	{

		public function __construct()
		{
			$this->middleware('auth');
		}

		public function index(Request $request)
		{
			if ($request->ajax()) {
				$data = Subplans::get();
				return DataTables::of($data)
					->editColumn('Actions', function ($row) {
						$buttons = '';
						$buttons =  $buttons . '<button data-id="' . $row->id . '" onclick=getPlan(this) class="btn btn-primary"  style="width:40px;border-radius:10px;" type="button"><i class="fa fa-pencil pointer"></i></button>';
						$buttons =  $buttons . ' <button data-id="' . $row->id . '" onclick=deletePlan(this) class="btn btn-danger" style="width:40px;border-radius:10px;" type="button"><i class="fa fa-trash pointer"></i></button>';
						return $buttons;
					})
					->rawColumns(['Actions'])
					->make(true);
			}
			return view('superadmin.plans.index');
		}

		public function savePlan(Request $request)
		{
			$request->validate([
				'name' => 'required|unique:subplans,name,' .$request->id,
				'price' => 'required|numeric',
				'user_limit' => 'required|numeric',
				'extra_user_price' => 'required|numeric',
				'free_user' => 'required|numeric|lte:user_limit',
			]);

			if (!empty($request->id) && $request->id != '') {
				$data = Subplans::find($request->id);
				if (empty($data)) {
					$data =  new Subplans();
				}
			} else {
				$data =  new Subplans();
			}
			$data->name = $request->name;
			$data->price = $request->price;
			$data->user_limit = $request->user_limit;
			$data->extra_user_price = $request->extra_user_price;
			$data->free_user = $request->free_user;
			$data->details = '';
			if (isset($request->features) && !empty($request->features)) {
				$data->details = json_encode(implode('_---_',$request->features));
			}
			$data->save();
		}

		public function getSpecificPlan(Request $request)
		{
			if (!empty($request->id)) {
				$data =  Subplans::where('id', $request->id)->first();
				return json_encode($data);
			}
		}

		public function destroy(Request $request)
		{
			if (!empty($request->id)) {
				$data = Subplans::where('id', $request->id)->delete();
			}
		}
	}
