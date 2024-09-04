<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Models\Category;
use App\Models\Mail;
use App\Models\Destination;
use App\Models\User;
use App\Models\File;

class AdminController extends Controller
{
    public function dashboard(){
        $pageTitle = "Admin Dashboard";
        // $mails = Mail::count();
        // $categories = Category::count();
        // $destinations = Destination::count();        
        // $recentMails = Mail::latest()->limit(10)->get();
        $users = User::count();
        $files = File::count();        
        return view('admin.dashboard',compact('pageTitle','users','files'));
    }

    public function login(){
        $pageTitle = "Admin Login";
        return view('admin.login',compact('pageTitle'));
    }

    public function logout(Request $request){
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');        
    }
}
