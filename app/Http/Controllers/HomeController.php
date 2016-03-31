<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Flat;
use App\Models\Shortlist;
use Auth;
use App\Models\Message;

class HomeController extends Controller
{

	protected $flat;

	public function __construct(Flat $flat)
	{
		$this->flat = $flat;
	}

	/**
	 * Return to the home view for client app.
	 * @return view
	 */
	public function index(Shortlist $shortlist,Message $message)
	{
		// $data['total_flats']		 = $this->flat->findall()->count();
		// $data['total_flats_of_user'] = $this->flat->findBy('created_by',Auth::id())->count();
		// $data['total_shortlists']    = $shortlist->where('user_id',Auth::id())->count();
		// $data['new_message']		 = $message->where('recever_id',Auth::id())->where('status',0)->count();

		// return view('home',compact('data'));
		//
		return view('home');

	}

}
