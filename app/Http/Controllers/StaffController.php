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
use Illuminate\Support\Facades\Storage;

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

    public function form(Request $request){
        if($request->uniqueid){
            $user = User::where('uniqueid',$request->uniqueid)->first();    
        }
        else{
            $user = User::find(Auth::user()->id)->first();
        }
        
        $pageTitle = "Registration Form";
        return view('staff.form',compact('pageTitle','user'));
    }

    public function storeForm(StaffFormRequest $request){
        $user = User::find(Auth::user()->id);
        $staffData = $request->validated();        
        $user->supporting_statement = $request->supporting_statement;
        $user->address = $request->address;
        $user->post_town = $request->post_town;
        $user->post_code = $request->post_code;
        $user->adult_cautions = $request->adult_cautions;
        $user->barred_from_children = $request->barred_from_children;
        $user->child_court_protection = $request->child_court_protection;
        $user->adult_court_protection = $request->adult_court_protection;
        $user->childcare_cancellation = $request->childcare_cancellation;
        $user->residential_cancellation = $request->residential_cancellation;
        $user->teaching_prohibition = $request->teaching_prohibition;
        $user->adult_prohibition = $request->adult_prohibition;
        $user->barred_by_employer = $request->barred_by_employer;
        $user->barred_by_professional_body = $request->barred_by_professional_body;
        $user->declaration_details = $request->declaration_details;
        if ($request->hasFile('cv_file')) {
            $file = $request->file('cv_file');
            $path = $file->store('cv_files', 'public');            
        }         
        $user->cv = $path;
        $user->save();

        
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

    public function destroy(User $user){
        $user->delete();
        if(!empty($user->cv)){
            if (Storage::disk('public')->exists($user->cv)) {
                Storage::disk('public')->delete($user->cv);
            }            
        }
        return redirect()->route('admin.staffs.index')->with('success','User Deleted');
    }
}
