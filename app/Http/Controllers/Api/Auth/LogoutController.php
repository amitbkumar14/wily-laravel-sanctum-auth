<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Redirect;
use Session;

class LogoutController extends Controller
{
    public function __invoke(Request $request)
    {
        /**
         * @var User $user
         */
		$user = Auth::user();
		echo $tokenId = Session::get('access_Token');
        //$user = $request->user();

        //$user->currentAccessToken()->delete();
		$user->tokens()->where('id', $tokenId)->delete();
		
		$user->access_Token = $tokenId;

        event(new \Illuminate\Auth\Events\Logout('sanctum', $user));
		
		Session::flush();

        //return response()->noContent();
		return Redirect::to('/');
    }
}
