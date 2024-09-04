<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pin;
use App\Http\Requests\StoreStaffRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

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
            $message = 'Your Registration was Successful, We will get back to You Soon';
            return redirect()->route('verify.page')->with('success',$message);
        }
        else{
            return redirect()->back();
        }
    }
}
