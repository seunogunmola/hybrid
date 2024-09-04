<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    protected $fillable = [
        'uniqueid',
        'title',
        'description',
        'file_url',
        'uploaded_by'
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'uploaded_by', 'id');
    }
}
