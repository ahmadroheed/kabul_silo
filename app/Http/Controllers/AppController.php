<?php

namespace App\Http\Controllers;

use Session;
use URL;
use App;

class AppController extends Controller
{
    public function setLocale($lang)
   	{
   		Session::put('locale',$lang);
   		return redirect(url(URL::previous()));
   	}


   	public function index()
   	{
   		if (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
      }else{
   			Session::put('locale','dr');
      }
   		return view('index');
   	}
}
