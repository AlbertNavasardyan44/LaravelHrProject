<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;

use DB;
use Illuminate\Support\MessageBag;

class UserController extends Controller
{
    public function showLoginForm(Request $request){
        return  view('auth/UserLogin');
    }
    public function doLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');
       // dd($request->all());
        if (Auth::attempt($credentials,true)) {
            // Authentication passed...
            return redirect()->route('Dashboard');

        } else {
            $error = new MessageBag();
            $error->add('email', 'That email is incorrect.');
            $error->add('password', 'That password is incorrect.');
            return redirect('auth/login')->withErrors($error);
        }
    }
    public function doLogout(Request $request)
    {
        Auth::logout();
        return redirect('auth/login');
    }

    public function relations($id)
    {


        $data=User::with('UserRoles')->find($id);

        if( $data->hasRoles([ 'admin']  )){

            return redirect()->route('Dashboard');
        }


    }
}
