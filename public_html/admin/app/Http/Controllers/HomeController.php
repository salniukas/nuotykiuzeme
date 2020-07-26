<?php

namespace App\Http\Controllers;
use Auth;
use App\User;
use App\Order;
use Carbon\Carbon;
use App\Authme;
use Illuminate\Http\Request;
use App\Service;
use App\Blog;

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
        	$en = Carbon::now()->locale('lt');
        	$start = $en->startOfWeek()->format('Y-m-d H:i');
        	$end = $en->endOfWeek()->format('Y-m-d H:i');
        	$orderAmount = Order::whereBetween('created_at', [$start, $end])->where('Approved', 'done')->get();
        	$amount = 0;

        	foreach ($orderAmount as $amounts) {
        		$amount = $amount + $amounts->amount/100;
        	}

        	$play = Authme::all()->count();

            $startu = $en->startOfWeek()->getPreciseTimestamp(3);
            $endu = $en->endOfWeek()->getPreciseTimestamp(3);


        	// $playw = Authme::where(DB::raw('UNIX_TIMESTAMP(regdate)'),'>=', $startu)->get();
        	
            $playw = Authme::where('regdate', '>', $startu)->where('regdate', '<', $endu)->get();
            $playwc = $playw->count();


            $user = Auth::user();
            $minecraft = $user->minecraft;

            $orders = Order::orderBy('created_at', 'desc')->where('Approved', 'done')->where('username', Auth::user()->minecraft)->get();

            return view('dashboard', ['amount' => $amount,'play' => $play, 'playw' => $playw, 'playwc' => $playwc,'orders' => $orders, 'minecraft' => $minecraft]);
        
    }

    public function players()
    {
        $players = Authme::paginate(15);
        return view('pages.table_list', ['players' => $players]);
    }

    public function finish(Request $request)
    {
        $user = Auth::user();
        $user->minecraft = $request->minecraft;
        $user->save();

        return redirect('home');
    }

    public function orders()
    {
        if(Auth::user()->isAdmin()){
            $orders = Order::orderBy('created_at', 'desc')->paginate(15);

            return view('users.anketos ',['orders' => $orders]);
        }
    }

    public function ordersDe()
    {
        if(Auth::user()->isAdmin()){
           $orders = Order::orderBy('created_at', 'desc')->where('Approved', 'cancelled')->paginate(15);

            return view('users.anketos',['orders' => $orders]);
        }
    }

    public function ordersA()
    {
        if(Auth::user()->isAdmin()){
           $orders = Order::orderBy('created_at', 'desc')->where('Approved', 'done')->paginate(15);
            return view('users.anketos',['orders' => $orders]);
        }
    }

    public function paslaugaC()
    {
        if(Auth::user()->isAdmin()){
            return view('pages.createP');
        }
            
    }
    public function paslaugaS(Request $request)
    {
        if(Auth::user()->isAdmin()){
            Service::create(request(['name', 'cmd', 'cost']));
            $request->session()->flash('success', 'Paslauga sukurta');
            return redirect('service/list');
        }
            
    }

    public function paslaugos()
    {
        if(Auth::user()->isAdmin()){
            $services = Service::all();
            return view('users.paslaugosl',['services' => $services]);
        }
            
    }
    public function paslaugosD($id)
    {
        if(Auth::user()->isAdmin()){
            $service = Service::find($id);
            $service->delete();
            return redirect('service/list');
        }
            
    }
    public function paslaugosE($id)
    {
        if(Auth::user()->isAdmin()){
            $service = Service::find($id);
            return view('pages.createE', ['service' => $service]);
        }
            
    }
    public function paslaugosES(Request $request)
    {
        if(Auth::user()->isAdmin()){
            $service = Service::find($request->id);
            $service->name = $request->name;
            $service->cmd = $request->cmd;
            $service->cost = $request->cost;
            $service->save();
            return redirect('service/list');
        }
            
    }

    public function BlogS(Request $request)
    {
        Blog::create(request(['title', 'content']));
        return redirect('Bloglist');
    }

    public function Bloglist()
    {
    	$blogs = Blog::all();
        return view('pages.blogl',['blogs' => $blogs]);
    }
}
