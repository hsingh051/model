<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Socialite;

class SocialAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('facebook')->redirect();   
    }   

    public function callback()
    {
        // when facebook call us a with token 
        $providerUser = \Socialite::driver('facebook')->user(); 
    	echo "<pre>";
    	print_r($providerUser);
    	print_r($_GET);
    	die("SDf");
    	dd($_POST);

    }
}
