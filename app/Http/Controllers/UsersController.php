<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Socialite;
use DB;
use Auth;



class UsersController extends Controller{
    
    function enter(){
        //die("here");
        return view('competition.enter');
    }

    // Upload Name
    public function upload(Request $request){
        $fname = $request->first_name;
        $lname = $request->last_name;
        $email = $request->email;

        $request->session()->put('first_name', $fname);
        $request->session()->put('last_name', $lname);
        $request->session()->put('email', $email);

        if (Auth::check()) {
            return redirect('/enter/upload');
        }
        else{
            return Socialite::driver('facebook')->redirect();  
        }     
    }

    public function uploadget(Request $request){
        
        $fname = $request->session()->pull('first_name');
        $lname = $request->session()->pull('last_name');
        $email = $request->session()->pull('email');
        
        return view('competition.upload');
    }


    public function fbphotos(Request $request,$page = null){

        $facebookResponse = $request->session()->pull('facebookResponse');
        if(@$facebookResponse->token){
            $s = Socialite::driver('facebook')->getpicturesByToken($facebookResponse->token);
        }else{
            return Socialite::driver('facebook')->redirect();
        }
        


        echo "<pre>";
        print_r($facebookResponse);
        die('dgfdg');

        // $albums = $fb->get('/me/albums', $token)->getGraphEdge()->asArray();

        // die("fb");
    }



}
