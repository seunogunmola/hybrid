<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Destination;
use App\Models\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;


class MailController extends Controller
{
    public $resource = "Mail";

    public $categories;
    public $destinations;

    public  $rules = [
        'sender'=>'string|required',
        'subject'=>'string|required',
        'description'=>'string|required',
        'destination_id'=>'string|required',
        'category_id'=>'string|required',
        'date'=>'date|required',
        'file'=>'file',
    ];

    public function __construct()
    {
        $this->categories = Category::all()->sortBy('category_name');
        $this->destinations = Destination::all()->sortBy('destination_name');
    }

    public function index(Request $request)
    {
        #SET PAGE TITLE    
        $action = "View Mails";
        $resource = $this->resource;
        $pageTitle = $resource.' | '.$action;

        $categories = $this->categories;
        $destinations = $this->destinations;

        $where = [];
        $destination_id = $request->destination_id;
        $category_id = $request->category_id;
        $status = $request->status;
        $sender = $request->sender;
        if(isset($request->destination_id) && $request->destination_id !== "all"){
            $where['destination_id'] = $destination_id;
        }
        if(isset($category_id) && $category_id !== "all"){
            $where['category_id'] = $category_id;
        }
        if(isset($status) && $status !== "all"){
            $where['status'] = $status;
        }
        if(isset($sender) && $sender !== ""){
            $where['sender'] = $sender;
        }

        #GET MAILS        
        $mails = Mail::where($where)->get();
        
        return view('admin.mail.index',compact('resource','action','pageTitle','mails','categories','destinations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $resource = $this->resource;
        $pageTitle = "Create Mail";
        $categories = $this->categories;
        $destinations = $this->destinations;
        return view('admin.mail.create',compact('pageTitle','categories','resource','destinations'));    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = $this->rules;

        $validated = $request->validate($rules);

        if($validated){
            $mail_data = [
                'uniqueid'=>str()->random(7),
                'sender'=>$request->sender,
                'subject'=>$request->subject,
                'description'=>$request->description,
                'destination_id'=>$request->destination_id,
                'category_id'=>$request->category_id,
                'date'=>$request->date,
                'received_by'=>Auth::user()->id,
                'status'=>'0',
                'reference_no'=>$request->reference_no,
                'remarks'=>$request->remarks,
                'date_minuted'=>$request->date_minuted
            ];

            if($uploadedFile = $request->file){
                $extention = $uploadedFile->getClientOriginalExtension();                
                $filename = hexdec(uniqid()).'.'.$extention;                
                $destination = 'uploads/';           

                if($uploadedFile->move($destination,$filename)){
                    $mail_data['file'] = $destination.$filename;
                }
            }
            
            if(Mail::create($mail_data)){
                $message = [
                    'type'=>'success',
                    'message'=>'Mail Saved Successfully'
                ];

                return redirect(route('admin.mail.index'))->with($message);
            }
            else{
                return redirect()->back();
            }
            
        }
        else{
            echo "validation errors";exit;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mail  $mail
     * @return \Illuminate\Http\Response
     */
    public function show(Mail $mail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mail  $mail
     * @return \Illuminate\Http\Response
     */
    public function edit($uniqueid)
    {        
        //GET MAIL
        $mail = Mail::where('uniqueid',$uniqueid)->first();
        if($mail){
            $pageTitle = "Edit Mail : ".$mail->description;
            $categories = $this->categories;
            $destinations = $this->destinations;
            return view('admin.mail.edit',compact('pageTitle','categories','mail','destinations'));           
        }
        else{
            return redirect()->route('admin.mail.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mail  $mail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $mail = Mail::findOrFail($id);
        
        $rules = $this->rules;

        $validated = $request->validate($rules);

        if($validated){
            $mail_data = [
                'sender'=>$request->sender,                
                'subject'=>$request->subject,
                'description'=>$request->description,
                'destination_id'=>$request->destination_id,
                'category_id'=>$request->category_id,
                'date'=>$request->date,
                // 'updated_at'=>date('Y-m-d h:i:s'),
                'status'=>$request->status,
                'reference_no'=>$request->reference_no,
                'remarks'=>$request->remarks,
                'date_minuted'=>$request->date_minuted
                
            ];


            if($uploadedFile = $request->file){
                $extention = $uploadedFile->getClientOriginalExtension();                
                $filename = hexdec(uniqid()).'.'.$extention;                
                $destination = 'uploads/';           

                if($uploadedFile->move($destination,$filename)){
                    $mail_data['file'] = $destination.$filename;
                }
            }
            
            if($mail->update($mail_data)){
                $message = [
                    'type'=>'success',
                    'message'=>'Mail Updated Successfully'
                ];

                return redirect(route('admin.mail.index'))->with($message);
            }
            else{
                return redirect()->back();
            }
            
        }
        else{
            echo "validation errors";exit;
        }        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mail  $mail
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mail $mail,$id)
    {
        $mail = $mail->findOrFail($id);
        if($mail->delete()){
            @unlink($mail->file);
            return redirect(route('admin.mail.index'))->with(['message'=>'Mail Deleted Successfully','type'=>'success']);
        }
        else{
            return back()->with(['message'=>'An Error Occured','type'=>'error']);
        }
    }

    public function view($uniqueid){
        $pageTitle = "View Mail";
        $mail = Mail::where('uniqueid',$uniqueid)->first();
        return view('admin.mail.view',compact('mail','pageTitle'));
    }
}
