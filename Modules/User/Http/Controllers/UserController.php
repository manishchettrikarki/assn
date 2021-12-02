<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\User\Http\Requests\PasswordUpdateRequest;
use Modules\User\Repositories\Contracts\UserContract;

class UserController extends Controller
{
    public $userContract;
    public function __construct(UserContract $userContract)
    {
        $this->userContract = $userContract;
    }

    public function changePassword() {
        if(Auth::user()->can('view dashboard')){
            return view('user::back.users.password');
        }
        return view('user::user.password');
    }

    public function dashboard(){
        if(auth()->user()->can('view dashboard')){
            return view('back.dashboard');
        }
        return view('user::user.profile');
    }

    public function updatePassword(PasswordUpdateRequest $request) {
        $this->userContract->update(auth()->id(),[
            'password'=>bcrypt($request->newpassword)
        ]);
        Auth::logout();
        return redirect()->route('login');
    }
}
