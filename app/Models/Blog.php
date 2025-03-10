<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    /** @use HasFactory<\Database\Factories\BlogFactory> */
    
    use HasFactory , SoftDeletes;
    protected $fillable = ['name', 'data' , 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
