<?php

namespace App\Http\Controllers;

use Hash;
use Redirect;
use Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Html\HtmlServiceProvider;
use Illuminate\Http\Request;

use App\ElectronicTDG;

//reference: https://www.cloudways.com/blog/laravel-login-authentication/
class MainController extends BaseController
{
    public function showLogin()
    {
        return view('pages.login');
    }
    
    public function doLogout()
    {
        Auth::logout();
		return redirect('')->with('success_msg', 'Successfully logged out.');
    }
    
    public function doLogin(Request $request)
    {
        $inputs = array(
            'email' => $request->input('email'),
            'password' => $request->input('password')
        );
        
        $rules = array(
            'email' => 'required|email',
            'password' => 'required|alphaNum|min:1'
        );
        
        $validator = Validator::make($inputs, $rules);
        
        if ($validator->fails()) {
            return Redirect::to('login')->withErrors($validator);
        } else {
            if (Auth::attempt(array(
                'email' => $request->input('email'),
                'password' => $request->input('password')
            ))) {
                return Redirect::to('');
            } else {
                //dd(Hash::make('admin'));
                
                return Redirect::to('login');
            }
        }
    }

	public function doAddItems(Request $request)
    {
        $electronicTDG = new ElectronicTDG();
		$inputs = $request->except('_token');
		
		$electronicTDG->add($inputs);

		return Redirect::to('inventory');
		//$electronicTDG->;
    }
}