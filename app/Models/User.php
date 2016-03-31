<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;

class User extends BaseModel implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['username', 'email', 'password', 'mob_no', 'office_no', 'user_is', 'first_name', 'last_name'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function getProfilePicAttribute($value)
    {
        $value == '' ? $profile_pic = '/assets/img/avatar1.png' : $profile_pic = $value;

        return $profile_pic;
    }

    public function flats()
    {
        return $this->hasMany('App\Models\Flat');
    }

    public function shortlists()
    {
        return $this->hasMany('App\Models\Shortlist');
    }

    public function messages()
    {
        return $this->hasMany('App\Models\Messages');
    }

}
