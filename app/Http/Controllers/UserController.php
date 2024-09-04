<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Destination;
use App\Models\Mail;

class UserController extends Controller
{
    public function index(){
        $resource = "Users";
        $pageTitle = "View All Users";
        $users = User::all();
        return view('admin.users.index',compact('users','pageTitle','resource'));
    }

    public function create(){
        $pageTitle = "Create User";
        $departments = Destination::all();
        return view('admin.users.create',compact('pageTitle','departments'));
    }
    public function edit($uniqueid){        
        $user = User::where('uniqueid',$uniqueid)->first();
        $pageTitle = "Editing User : ".$user->name;
        if($user){
            $departments = Destination::all();
            return view('admin.users.edit',compact('user','pageTitle','departments'));
        }
        else{
            return redirect()->route('admin.users.all')->with(['message'=>'User Not Found','alert-type'=>'error']);
        }
    }
    public function delete($id){
        $user = User::findOrFail($id);
        $user->delete();
        return back()->with(['message'=>'User Deleted Successfully','alert-type'=>'success']);
    }

    public function store(StoreUserRequest $request){
        if($request->validated()){
            $data = $request->validated();
            $data['uniqueid'] = str()->random('7');            
            $data['password'] = Hash::make($data['password']);
            if(isset($request->department_id)){
                $data['department_id'] = $request->department_id;
            }
            
            $created = User::create($data);

            if($created){
                return redirect()->route('admin.users.all')->with(['message'=>'User Created Successfully','alert-type'=>'success']);
            }
            else{
                return back()->with(['message'=>'An Error Occured','alert-type'=>'error']);
            }
        }        
    }

    public function update(UpdateUserRequest $request,$id){
        $user = User::findOrFail($id);

        if($request->validated()){
            $data = $request->validated();
            if(isset($data['password']))  {
                $data['password'] = Hash::make($data['password']);
            }     
            if(isset($request->department_id)){
                $data['department_id'] = $request->department_id;
            }            
             
            $updated = $user->update($data);

            if($updated){
                return redirect()->route('admin.users.all')->with(['message'=>'User Updated Successfully','alert-type'=>'success']);
            }
            else{
                return back()->with(['message'=>'An Error Occured','alert-type'=>'error']);
            }
        }        
    }

    public function logout(Request $request){
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');        
    }

    public function viewMail($uniqueid){
        $pageTitle = "View Mail";
        $mail = Mail::where('uniqueid',$uniqueid)->first();
        return view('user.mail.view',compact('mail','pageTitle'));
    }
}
