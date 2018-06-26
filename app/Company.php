<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name', 
        'description', 
        'user_id', 
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function books()
    {
    	return $this->hasMany('App\Project');
    }
    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }
}
