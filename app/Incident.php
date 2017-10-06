<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{

    //Relationships
    public function category()
    {
    	return $this->belongsTo('App\Category');
    }

    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    public function level()
    {
        return $this->belongsTo('App\Level');
    }

    public function support()
    {
        return $this->belongsTo('App\User', 'support_id');
    }

     public function client()
    {
        return $this->belongsTo('App\User', 'client_id');
    }

    public function messages()
    {
        return $this->hasMany('App\Message');
    }


    //Accesors
    public function getSeverityFullAttribute()
    {
    	switch ($this->severity) {
    		case 'M':
         return 'Menor';
         break;
         case 'N':
         return 'Normal';
         break;

         default:
         return 'Alta';
         break;
     }
 }

 public function getTitleShortAttribute()
 {
   return mb_strimwidth($this->title, 0, 20, '...');
}

public function getCategoryNameAttribute()
{
    if ($this->category) {
        return $this->category->name;
    }
    return 'General';
}

//Support_name
public function getSupportNameAttribute()
{
    if ($this->support) {
        return $this->support->name;
    }
    return 'Sin asignar';
}

public function getStateAttribute()
{
    if ($this->active == 0) {
        return 'Resuelto';
    }
    if ($this->support_id) {
        return 'Asignado';
    }
    return 'Pendiente';
    
}

}
