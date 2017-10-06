<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Illuminate;
use App\ProjectUser;

class User extends Authenticatable
{
    use Notifiable;

    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //Relationships

    public function projects()
    {
        return $this->belongsToMany('App\Project');
    }


    public function canTake(Incident $incident)
    {
        return ProjectUser::where('user_id', $this->id)->where('level_id', $incident->level_id)->first();
    }

    //Accessors
    public function getAvatarPathAttribute()
    {
        if ($this->is_client) 
        {
            return '/images/client.png';
        }
        return '/images/support.png';
    }

    public function getListOfProjectsAttribute()
    {
        if ($this->role == 1) {
            return $this->projects;
        }
        return Project::all();
    }

    public function getIsAdminAttribute()
    {
        return $this->role == 0;
    }

    public function getIsSupportAttribute()
    {
        return $this->role == 1;
    }

    public function getIsClientAttribute()
    {
        return $this->role == 2;
    }
}
