<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function dashboard(){
        $pageTitle = "Vendor Dashboard";
        return view('vendor.dashboard',compact('pageTitle'));
    }
}
