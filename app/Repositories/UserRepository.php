<?php namespace App\Repositories;

use App\Models\User;


class UserRepository
{


    protected $user;

    /**
     * Creates new user instance
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }


    /**
     * Check if user is member or not
     * @param  array $userData
     * @return object
     */
    public function findByUserNameOrCreate($userData)
    {

        $user = $this->user->where('provider_id', '=', $userData->id)->first();

        if(!$user)
        {
            $user = User::create([
            	'username'=>$userData->name,
            	'email'=>$userData->email,
            	'profile_pic'=>$userData->avatar,
                'provider_id' => $userData->id,
                'user_is'=>'user'
            ]);
        }
        $this->checkIfUserNeedsUpdating($userData, $user);

        return $user;
    }


    /**
     * Update user if needed.
     * @param  array $userData
     * @param  object $user
     * @return void
     */
    public function checkIfUserNeedsUpdating($userData, $user)
    {
        $socialData = [
            	'username'     => $userData->name,
            	'email'        => $userData->email,
            	'profile_pic'  => $userData->avatar,
                'provider_id'  => $userData->id
        ];

        $dbData = [
            	'last_name'    => $user->user['last_name'],
            	'email'        => $user->email,
            	'profile_pic'  => $user->avatar,
                'provider_id'  => $user->id
        ];

        if (!empty(array_diff($socialData, $dbData)))
        {
        	$user->username    = $userData->name;
        	$user->email       = $userData->email;
        	$user->profile_pic = $userData->avatar;
        	$user->provider_id = $userData->id;

            $user->save();
        }
    }
}