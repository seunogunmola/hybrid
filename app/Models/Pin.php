<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pin extends Model
{
    use HasFactory;
    protected $fillable = [
        'pin',
        'status',
        'user_id'
    ];

    public static function checkPin($pin){
        $pinData = Self::where(['pin'=>$pin])->first();
        if($pinData){
            if($pinData->status==1){
                return "used";
            }
            else{
                return true;
            }
        }
        else{
            return false;
        }
    }

    public static function usePin($pin,$user){
        $pinData = Self::where('pin',$pin)->first();
        if($pin){
            $pinData->status = 1;
            $pinData->user_id = $user->id;
            $pinData->save();
        }
    }
}
