<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'body',
    ];
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    use HasFactory, SoftDeletes;
}
