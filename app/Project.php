<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
	use SoftDeletes;

	
    protected $fillable = [
        'name', 'description', 'start',
    ];


     //Relationships

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    //Accessors


    public function categories()
    {
    	return $this->hasMany('App\Category');
    }

    public function levels()
    {
    	return $this->hasMany('App\Level');
    }

    //Accesors

    public function getFirstLevelIdAttribute()
    {
        return $this->levels->first()->id;
    }
}
