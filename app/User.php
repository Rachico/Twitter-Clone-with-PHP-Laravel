<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, Followable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username','name', 'email', 'avatar','password',
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

    public function timeline ()
    {
        $friends = $this->follows()->pluck('id');

        return Tweet::whereIn('user_id',$friends)
            ->orWhere('user_id',$this->id)
            ->withLikes()
            ->latest()
            ->paginate(50);

    }



    public  function tweets () {
        return $this->hasMany(Tweet::class)->withLikes()->latest();
    }

    public function path($append = '')
    {
        $path = route('profile',$this->username);
        return $append ? "{$path}/{$append}" : "$path";

    }

    public function getAvatar()
    {
        $avatar = $this->avatar ?? "avatars/default-avatar.png";
        return "/storage/" . $avatar;
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

}
