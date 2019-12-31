<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

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

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function roles() //cette fonction reflette la relation App\Role et App\User et nous permettra de faire les synchro des roles modifier depuis le user.edit
        //dans le user.update
    {
        return $this->belongsToMany('App\Role');
    }

    public function hasAnyRoles($roles){ //cette fonction vérifie que l'utilisateur actuel possède un des roles autorisé par le gate
        if ($this->roles()->whereIn('name', $roles)->first()){
            return true;
        }
        return false;
    }
    public function hasRole($role){//cette fonction vérifie que l'utilisateur actuel possède le role specifique que l'on précisera dans le gate
        if ($this->roles()->where('name', $role)->first()){
            return true;
        }
        return false;
    }
}
