<?php

namespace App\Http\Controllers;
use Auth;
use App\User;
use App\Order;
use Carbon\Carbon;
use App\Form;
use App\Player;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        if (Auth::user()->isSupport || Auth::user()->isAdmin || Auth::user()->isAleradas){


        	Carbon::setWeekStartsAt(Carbon::MONDAY);
        	$en = Carbon::now()->locale('en_US');
        	$start = $en->startOfWeek()->format('Y-m-d H:i');
        	$end = $en->endOfWeek()->format('Y-m-d H:i');
        	$orderAmount = Order::whereBetween('created_at', [$start, $end])->where('Approved', 'done')->get();
        	$amount = 0;

        	foreach ($orderAmount as $amounts) {
        		$amount = $amount + $amounts->amount/100;
        	}

        	$forms = Form::where('sent', 0)->count();

        	$play = Player::all()->count();

        	$playw = Player::whereBetween('created_at', [$start, $end])->get();
        	$playwc = $playw->count();

            return view('dashboard', ['amount' => $amount, 'forms' => $forms, 'play' => $play, 'playw' => $playw, 'playwc' => $playwc]);
        }else{
            return redirect("https://nuotykiuzeme.lt");
        }
        
    }

    public function Anketos()
    {
    	$forms = Form::where('sent', 0)->paginate(15);

        return view('users.anketos ',['forms' => $forms]);
    }

    public function Atmestos()
    {
    	$forms = Form::where('rejected', 1)->paginate(15);

        return view('users.anketos2',['forms' => $forms]);
    }

    public function Patvirtintos()
    {
    	$forms = Form::where('accepted', 1)->paginate(15);

        return view('users.anketos3',['forms' => $forms]);
    }

    public function show($id)
    {
    	$forms = Form::find($id);
        // $fafa = Forms_vote::where('voted_for', $id)->all();
        $balsaiu = Forms_vote::where('voted_for', $id)->where('reason', 'Už')->count();
        $balsaip = Forms_vote::where('voted_for', $id)->where('reason', 'Prieš')->count();

        return view('profile.edit', ['forms' => $forms, 'balsaiu' => $balsaiu, 'balsaip' => $balsaip]);
    }
}
