<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\EmailTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class EmailTemplateController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth');
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
			$data = EmailTemplate::where([['template_type','email'],['status','1']])->get();
			return DataTables::of($data)
				->editColumn('status', function ($row) {
                    $val = '<label class="badge badge-warning">InActive</label>';
                    if($row->status == 1){
                        $val = '<label class="badge badge-primary">Active</label>';
                    }
                    return $val;
                })
				->editColumn('Actions', function ($row) {
					$buttons = '';
                    $buttons =  $buttons . '<i data-url="'.route('superadmin.email.show',$row->id).'" class="fs-22 py-2 mx-2 fa-eye pointer text-info fa show-email-template" type="button"></i>';
					$buttons =  $buttons . ' <a href="' . route('superadmin.email.edit',$row->id) . '"><i class="fs-22 py-2 mx-2 fa-pencil pointer fa"></i></a>';
                    $buttons =  $buttons . '<i data-url="' . route('superadmin.email.delete',$row->id) . '" class="text-danger fs-22 py-2 mx-2 fa-trash pointer fa" type="button"></i>';
					return $buttons;
				})
				->rawColumns(['Actions','status'])
				->make(true);
		}
		return view('superadmin.email_template.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('superadmin.email_template.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
			'title' => 'required|max:200',
			'content' => 'required',

		]);

        $data = $request->all();
        if(!isset($data['status'])){
            $data['status'] = 0;
        }
        $user=Auth::user()->id;
        EmailTemplate::create([
            'title'=>$request->title,
            'content'=>$request->content,
            'template_type'=>'email',
            'status'=>$request->status,
            'user_id'=>$user,
        ]);
        return redirect()->route('superadmin.email.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['email_template'] = EmailTemplate::find($id);
        return view('superadmin.email_template.view_template',$data)->render();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['email_template'] = EmailTemplate::find($id);
        return view('superadmin.email_template.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
			'title' => 'required|max:200',
			'content' => 'required',

		]);
        
        $data = $request->all();
        unset($data['_token']);
        if(!isset($data['status'])){
            $data['status'] = 0;
        }
        $update=EmailTemplate::find($id);
        $user=Auth::user()->id;
        $update->title =$request->title;
        $update->content =$request->content;
        $update->template_type='email';
        $update->status =$request->status;
        $update->user_id =$user;
        $update->save();
        return redirect()->route('superadmin.email.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        EmailTemplate::where('id',$id)->delete();
        return response()->json(['status'=>true],200);
    }

    /******************SMS Methods**************** */
    public function smsindex(Request $request)
    {
        if ($request->ajax()) {
			$data = EmailTemplate::where([['template_type','sms'],['status','1']])->get();
			return DataTables::of($data)
				->editColumn('status', function ($row) {
                    $val = '<label class="badge badge-warning">InActive</label>';
                    if($row->status == 1){
                        $val = '<label class="badge badge-primary">Active</label>';
                    }
                    return $val;
                })
				->editColumn('Actions', function ($row) {
					$buttons = '';
                    $buttons =  $buttons . '<i data-url="'.route('superadmin.sms.show',$row->id).'" class="fs-22 py-2 mx-2 fa-eye pointer text-info fa show-email-template" type="button"></i>';
					$buttons =  $buttons . ' <a href="' . route('superadmin.sms.edit',$row->id) . '"><i class="fs-22 py-2 mx-2 fa-pencil pointer fa"></i></a>';
                    $buttons =  $buttons . '<i data-url="' . route('superadmin.sms.delete',$row->id) . '" class="text-danger fs-22 py-2 mx-2 fa-trash pointer fa" type="button"></i>';
					return $buttons;
				})
				->rawColumns(['Actions','status'])
				->make(true);
		}
		return view('superadmin.sms_template.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function smscreate()
    {
        return view('superadmin.sms_template.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function smsstore(Request $request)
    {
        // dd($request);
        $request->validate([
			'title' => 'required|max:200',
			'content' => 'required',

		]);

        $data = $request->all();
        if(!isset($data['status'])){
            $data['status'] = 0;
        }
        $user=Auth::user()->id;
        EmailTemplate::create([
            'title'=>$request->title,
            'content'=>$request->content,
            'template_type'=>'sms',
            'status'=>$request->status,
            'user_id'=>$user,
        ]);
        return redirect()->route('superadmin.sms.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function smsshow($id)
    {
        $data['email_template'] = EmailTemplate::find($id);
        return view('superadmin.sms_template.view_template',$data)->render();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function smsedit($id)
    {
        $data['email_template'] = EmailTemplate::find($id);
        return view('superadmin.sms_template.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function smsupdate(Request $request, $id)
    {
        $request->validate([
			'title' => 'required|max:200',
			'content' => 'required',

		]);
        
        $data = $request->all();
        unset($data['_token']);
        if(!isset($data['status'])){
            $data['status'] = 0;
        }
        $update=EmailTemplate::find($id);
        $user=Auth::user()->id;
        $update->title =$request->title;
        $update->content =$request->content;
        $update->template_type='sms';
        $update->status =$request->status;
        $update->user_id =$user;
        $update->save();
        return redirect()->route('superadmin.sms.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function smsdestroy($id)
    {
        EmailTemplate::where('id',$id)->delete();
        return response()->json(['status'=>true],200);
    }
}
