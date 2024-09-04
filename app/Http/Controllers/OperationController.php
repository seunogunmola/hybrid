<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\MailsImport;
use App\Models\Mail;
use App\Models\Category;

class OperationController extends Controller
{
    public function excel(){
        $pageTitle = "Upload Mails from Excel";
        return view('admin.operations.excel',compact('pageTitle'));
    }

    public function storeExcel(Request $request){
        request()->validate([
            'mail_file' => 'required'
        ]);

        $categories = Category::getCategoriesArray(true);
        
        $mails = Excel::toArray(new MailsImport, $request->file('mail_file'));
        $contentArray = $mails[0];
        $count = 0;
        for($row=1; $row <= count($contentArray)-1; $row++){
            $currentRow = $contentArray[$row];            
            $sentDate = $currentRow[1];
                       
            $mailData = [
                'uniqueid'=>str()->random(7),
                'status'=>'0',
                'date'=>$sentDate,
                'sender'=>$currentRow[2],
                'category_id'=>$categories[$currentRow[3]],
                'subject'=>$currentRow[4], 
                'description'=>$currentRow[5] != null ?  $currentRow[5] : $currentRow[4],          
                'destination'=> isset($currentRow[6]) &&  $currentRow[6] != null ?  $currentRow[6] : 'N/A',       
                'file'=> isset($currentRow[7]) &&  $currentRow[7] != null ?  $currentRow[6] : '',
                'received_by'=>auth()->user()->id       
            ];    
            
            if(Mail::create($mailData)){
                $count++;
            }
        }
        return redirect(route('admin.mail.index'))->with(['message'=>$count . " Mails Imported Successfully",'type'=>'success']);

    }

    public function backup(){
        
    }
}
