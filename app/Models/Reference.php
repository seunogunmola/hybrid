<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'referee_name',
        'referee_company_name',
        'referee_job_title',
        'referee_email'
    ];
}
