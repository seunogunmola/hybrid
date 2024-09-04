<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Destination;
use App\Models\File;
use App\Models\Mail;
use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    public function index(){        
        $user = User::find(auth()->user()->id);
        $pageTitle = "Dashboard";        
        // $categories = Category::count();
        // $destinations = Destination::count();
        // $recentMails = Mail::where(['destination_id'=>$user->department_id,'status'=>'1'])->get();
        // $mails = count($recentMails);
        $files = File::count();
        return view('user.dashboard',compact('pageTitle','user','files'));
    }
}
