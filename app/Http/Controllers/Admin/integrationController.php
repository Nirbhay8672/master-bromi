<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmailTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Goutte\Client;
use Illuminate\Support\Facades\DB;

class integrationController extends Controller
{
 
public function show(Request $request)
{
    return view("admin.integration.show")->with(['email_bulk' => DB::table('email_bulk')->get()]);
}

public function emaildatagetOld(Request $request)
{
    $email = $request->input('email');
    $password = $request->input('password');

    $client = new Client();

    $response = $client->request('GET', 'https://emailidea.biz/api/CheckBalance?ApiKey=687c378dba3d4f0f88c5840d8bcaa46f', [
        'auth' => [$email, $password],
    ]);

    $statusCode = $response->getStatusCode();

    if ($statusCode != 200) {
        return response()->json(['error' => 'Failed to retrieve user data'], $statusCode);
    }

    $userData = json_decode($response->getBody(), true);

    return response()->json($userData);
}

public function emaildataget(Request $request)
{
    $validatedData = $request->validate([
        'email' => 'required',
        'password' => 'required',
    ]);

    $email = $request->input('email');
    $password = $request->input('password');

	$client = new Client();
    $crawler = $client->request('GET', 'https://emailidea.biz/Login.aspx');
    
    $form = $crawler->selectButton('Login')->form();
    $form['txtEmailAddress'] = $email;
    $form['txtpass'] = $password;
    $crawler = $client->submit($form);

    $user_name = $crawler->filter('#topNavbar_lblUserFullName')->text();

    if($user_name) {
        $exp_validity = $crawler->filter('#cphMain_BreadCrumb_lblValidity')->text();
        $current_email_balance = $crawler->filter('#cphMain_BreadCrumb_lblEmailBalance')->text();

        DB::table('email_bulk')->delete();

        DB::table('email_bulk')->insert([
            'email' => $email,
            'user_name' => $user_name,
            'expired_date' => $exp_validity,
            'email_balance' => $current_email_balance,
            'user_id' => Auth::user()->id,
        ]);

	    return response()->json($user_name);
    }
    
    return response()->json(['error' => 'Somthing wrong.'], 404);
}

    public function integrationemailsendmailform (){
        return view("admin.integration.show");
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
                    //dd(Auth::user()->id == $row->user_id);
                    if(Auth::user()->id == $row->user_id){
                        $buttons = '';
                        $buttons =  $buttons . '<button data-url="'.route('admin.email.show',$row->id).'" class="btn btn-pill btn-primary show-email-template" type="button">View</button>';
                        $buttons =  $buttons . ' <a href="' . route('admin.email.edit',$row->id) . '"><button class="btn btn-pill btn-primary">Edit</button></a>';
                        $buttons =  $buttons . ' <button data-url="' . route('admin.email.delete',$row->id) . '" class="btn btn-pill btn-danger delete-record" type="button">Delete</button>';
                        return $buttons;
                    }else{
                        $buttons = '';
                        $buttons =  $buttons . '<button data-url="'.route('admin.email.show',$row->id).'" class="btn btn-pill btn-primary show-email-template" type="button">View</button>';
                        return $buttons;
                    }
					
				})
				->rawColumns(['Actions','status'])
				->make(true);
		}
		return view('admin.integration.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.integration.add');
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
            'status'=>$request->status,
            'template_type'=>'email',
            'user_id'=>$user,
        ]);
        return redirect()->route('admin.email.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showId($id)
    {
        $data['integration'] = EmailTemplate::find($id);
        return view('admin.integration.view_template',$data)->render();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['integration'] = EmailTemplate::find($id);
        return view('admin.integration.edit',$data);
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
        $update->status =$request->status;
        $update->template_type ='sms';
        $update->user_id =$user;
        $update->save();
        return redirect()->route('admin.email.index');
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
    /*************************SMS TEMPLATE******************************** */
    public function smsIndex(Request $request)
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
                    
                    if(Auth::user()->id == $row->user_id){
                        $buttons = '';
                        $buttons =  $buttons . '<button data-url="'.route('admin.email.show',$row->id).'" class="btn btn-pill btn-primary show-email-template" type="button">View</button>';
                        $buttons =  $buttons . ' <a href="' . route('admin.email.edit',$row->id) . '"><button class="btn btn-pill btn-primary">Edit</button></a>';
                        $buttons =  $buttons . ' <button data-url="' . route('admin.email.delete',$row->id) . '" class="btn btn-pill btn-danger delete-record" type="button">Delete</button>';
                        return $buttons;
                    }else{

                    }
					
				})
				->rawColumns(['Actions','status'])
				->make(true);
		}
		return view('admin.integration.smsindex');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function smsCreate()
    {
        return view('admin.integration.smsadd');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function smsStore(Request $request)
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
            'status'=>$request->status,
            'template_type'=>'sms',
            'user_id'=>$user,
        ]);
        return redirect()->route('admin.smsemail.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function smsShowId($id)
    {
        $data['integration'] = EmailTemplate::find($id);
        return view('admin.integration.view_template',$data)->render();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function smsEdit($id)
    {
        $data['integration'] = EmailTemplate::find($id);
        return view('admin.integration.smsedit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function smsUpdate(Request $request, $id)
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
        $update->status =$request->status;
        $update->template_type ='sms';
        $update->user_id =$user;
        $update->save();
        return redirect()->route('admin.smsemail.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function smsDestroy($id)
    {
        EmailTemplate::where('id',$id)->delete();
        return response()->json(['status'=>true],200);
    }
}
