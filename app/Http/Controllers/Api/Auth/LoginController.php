<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Redirect;
use Session;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => ['required', 'email:strict', 'max:255'],
            'password' => ['required', 'string'],
            //'device_name' => ['required', 'string', 'max:255'],
        ]);

        if (! Auth::guard('web')->attempt($request->only(['email', 'password']))) {
            return Redirect::back()->withErrors(['msg'=>'Please enter correct credential!']);
        }

        /**
         * @var User $user
         */
        $user = Auth::guard('web')->user();

        $token = $user->createToken(
            $request->input('email'),
            [
                'web',
            ]
        )->plainTextToken;
		
		Session::put('access_Token', $token);

        return Redirect::to('/home');
    }
}
