<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Socialite;
use DB;
use Auth;



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

        $checkuser = DB::table('users')->where('fbid',$providerUser->user['id'])->first();


        if(@$checkuser){
        	if (Auth::attempt(['email' => $checkuser->email, 'password' => $providerUser->user['id']])) {
	            // Authentication passed...
	            return redirect('/home');
	        }
        }else{
        	$checkuser = DB::table('users')->where('email',$providerUser->user['email'])->first();
        	if(@$checkuser){
	        	if (Auth::attempt(['email' => $checkuser->email, 'password' => $providerUser->user['id']])) {
		            // Authentication passed...
		            return redirect('/home');
		        }
	        }
        	
        	
        	if(@$providerUser->user['email']){

			}else{
				$providerUser->user['email'] = $providerUser->user['id']."@fb.com";
			}
			$datas = array(
                  'fbid' => $providerUser->user['id'],
                  'name' => $providerUser->user['name'],
                  'email' => $providerUser->user['email'],
                  'password' => bcrypt($providerUser->user['id']),
                  'created_at' => date("Y-m-d H:i:s"),
                  'activated' => 1,
                );
            $insert = DB::table('users')->insert($datas);
            

            if (Auth::attempt(['email' => $providerUser->user['email'], 'password' => $providerUser->user['id']])) {
	            // Authentication passed...
	            return redirect('/home');
	        }

	    	die("save");	
        }
    	echo "<pre>";
    	print_r($providerUser);
    	print_r($_GET);
    	die("SDf");
    	dd($_POST);

    }
}
