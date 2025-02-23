<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
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
*/
protected function redirectTo()
{
if (Auth::user()->role == 'admin')
{
return route('admin.home');
}
if (Auth::user()->role == 'user')
{
return route('user.home');
}
}
/**
* Create a new controller instance.
*
* @return void
*/
public function __construct()
{
$this->middleware('guest')->except('logout');
$this->middleware('auth')->only('logout');
}

public function username()
{
$identity = request()->get('email');
if(is_numeric($identity))
$fieldName = 'phone';
elseif(filter_var($identity, FILTER_VALIDATE_EMAIL))
$fieldName = 'email';
else
$fieldName = 'username';
request()->merge([$fieldName => $identity]);
return $fieldName;
}
}