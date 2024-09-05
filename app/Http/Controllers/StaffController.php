<?php

namespace App\Http\Controllers;

use App\Http\Requests\StaffFormRequest;
use Illuminate\Http\Request;
use App\Models\Pin;
use App\Http\Requests\StoreStaffRequest;
use App\Models\EmploymentHistory;
use App\Models\Reference;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class StaffController extends Controller
{
    public function index(){
        $pageTitle = "View Registrations";
        $staffs = User::where('role','user')->get();
        return view('admin.staff.index',compact('pageTitle','staffs'));
    }

    public function verify(){
        $pageTitle = "Verify Pin";
        return view('staff.verify',compact('pageTitle'));
    }

    public function verifyPin(Request $request){
        //CHECK IF PIN HAS BEEN USED
        $pin = $request->pin;
        $pinStatus = Pin::checkPin($pin);
        
        if($pinStatus === true){
            return redirect()->route('staff.register',['pin'=>$pin]);
        }
        else if($pinStatus === "used"){
            return redirect()->route('verify.page')->with('error','Pin has Been Used');
        }
        else{
            return redirect()->route('verify.page')->with('error','Invalid Pin');
        }
    }

    public function register(Request $request){
        $pinStatus = Pin::checkPin($request->pin);
        if($pinStatus===true){
            $pageTitle = 'Register';
            return view('staff.register',['pin'=>$request->pin,'pageTitle'=>$pageTitle]);
        }
        else{
            if($pinStatus==false){
                $message = 'Invalid Pin';                  
            }
            else if($pinStatus=="used"){
                $message = 'Pin has been used';                 
            }
            return redirect()->route('staff.register')->with('error',$message);
        }
    }

    public function store(StoreStaffRequest $request){
        $data = $request->validated();
        $data['role'] = "user";
        $data['password'] = Hash::make($data['password']);
        $data['uniqueid'] = Str::random(7);
        $pin=$data['pin'];
        unset($data['pin']);
        $user=User::create($data);
        if($user){
            //USE PIN
            Pin::usePin($pin,$user);
            //Log User In 
            Auth::login($user);
            $message = 'Your Registration was Successful, We will get back to You Soon';
            return redirect()->route('staff.form',['uniqueid'=>$data['uniqueid']])->with('success',$message);
        }
        else{
            return redirect()->back();
        }
    }

    public function form(){
        $pageTitle = "Registration Form";
        return view('staff.form',compact('pageTitle'));
    }

    public function storeForm(StaffFormRequest $request){
        $user = User::find(Auth::user()->id);
        $user->supporting_statement = $request->supporting_statement;
        if ($request->hasFile('cv_file')) {
            $file = $request->file('cv_file');
            $path = $file->store('cv_files', 'public');            
        }         
        $user->cv = $path;
        $user->save();

        $staffData = $request->validated();
        $employment_history = [];
        $references = [];
        //LOOP THROUGH JOB HISTORIES
        foreach($request->company_name as $index=>$company_name){
            $employment_history = [
                'user_id'=>Auth::user()->id,
                'job_title'=>$request->job_title[$index] ?? null,
                'company_name'=>$company_name,
                'job_start_date'=>$request->job_start_date[$index] ?? null,
                'job_end_date'=>$request->job_end_date[$index] ?? null,
                'job_details'=>$request->job_details[$index] ?? null,
            ];
            EmploymentHistory::create($employment_history);
        }
        
        //LOOP THROUGH REFERENCE
        foreach($request->referee_company_name as $index=>$referee_company_name){
            $references = [
                'user_id'=>Auth::user()->id,
                'referee_name'=>$request->referee_name[$index] ?? null,
                'referee_company_name'=>$referee_company_name,
                'referee_job_title'=>$request->referee_job_title[$index] ?? null,
                'referee_email'=>$request->referee_email[$index] ?? null,
            ];
            Reference::create($references);
        }     
        
        
        return redirect()->route('register.success',['uniqueid'=>$user->uniqueid])->with('success','Form Saved');
    }

    public function success(Request $request){
        $uniqueid = $request->uniqueid;
        $user = User::where('uniqueid',$uniqueid)->with('pin','references','employments')->first();
        
        if(!$user){
            return redirect()->route('verify.page');
        }
        $pageTitle = "Registration Success";
        return view('staff.success',compact('user','pageTitle'));
    }
}
