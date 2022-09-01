<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;
use LaravelInteraction\Vote\Concerns\Voteable;

class Post extends Model
{

    use HasFactory, SoftDeletes, Sluggable;
    use Voteable;

    protected $with = ['user'];

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'body',
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable() : array
    {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }






}
