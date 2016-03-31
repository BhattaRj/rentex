<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class UsersController extends Controller
{

    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $result['data']    = $this->user->findById($id);
        $result['success'] = true;
        return $result;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(UserRequest $request, $id)
    {
        $result['data']    = $this->user->updateModel($request->input('data'), Auth::id());
        $result['success'] = true;

        return $result;
    }

    /**
     * Reset password
     * @param  ResetPasswordRequest $request
     * @return object
     */
    public function resetPassword(ResetPasswordRequest $request)
    {
        $password       = $request->input('data')['password'];
        $user           = Auth::user();
        $user->password = bcrypt($password);

        $user->save();
        $result['success'] = true;

        return $result;
    }

}
