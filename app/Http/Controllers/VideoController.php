<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Player;
use App\Video;
use Session;
use Auth;


class VideoController extends Controller
{

   public function create()
   {
   	 if(Auth::user()->isAleradas())
   	 {
   		return view('youtube.submit');
	  }else
	   {
	   	  return view('errors.404');
	   }
   }

   public function store(Request $request)
   {
   		//validate
   		$this->validate(request(), [
   			'title' => 'required|max:255',
   			'desc' => 'required|max:350',
   			'author' => 'required|max:255',
   			'yt' => 'required|max:255',
   		]);

   		//Store
   		 Video::create(request(['title', 'desc', 'author', 'yt']));

   		 return redirect('video')->with('success', ['Video pridetas sekmingai!']);
   }

   public function index()
   {
	  	$video = Video::all();
	   	return view('youtube.video', ['video' => $video]);
	   		 
   }

}
