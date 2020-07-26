<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Order;
use Carbon\Carbon;
use Thedudeguy\Rcon;
use App\Service;


class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        'App\Console\Commands\CallRoute'
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function(){
            $orders = order::where('approved', 'pending')->get();
            foreach ($orders as $order) {
                $order->approved = 'cancelled';
                $order->save();
            }
        })->daily();

        $schedule->call(function(){
            $en = Carbon::now()->locale('lt');
            $start = $en->today()->format('Y-m-d H:i');

            $orders = order::where('until', $start)->get();
            foreach ($orders as $order) {
                $service = Service::where('cost', $order->amount)->get();
                $username = $order->username;
                
                $host = env('Server_IP');
                $port = env('Server_PORT');
                $password = env('Server_PASS');
                $timeout = 3;
                $rcon = new Rcon($host, $port, $password, $timeout);

                if ($rcon->connect()){

                    $rcon->sendCommand('pex user'.$username. 'group remove'. $service->name);
                }
            }
        })->daily();

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
