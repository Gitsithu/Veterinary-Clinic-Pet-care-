<?php

namespace App\Http\Controllers\Auth;
use DB;
use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     * condition sit yamen exmaple login==1 2 3
     */
    
    
    // protected $redirectTo = '/backend/dashboard';
 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    protected function authenticated(Request $request, $user)
    {
       
        if($user->role_id == 3) {
            return redirect('/');

        }
        else{
            return redirect('/backend/dashboard'); 
        } 
            
            }/**
     * Create a new controller instance.
     *
     * @return void
     */



    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
