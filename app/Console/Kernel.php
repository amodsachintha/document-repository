<?php

namespace App\Console;

use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

        $schedule->call(function () {

            $client = new Client();
            $result = $client->get('http://ec2-18-216-129-63.us-east-2.compute.amazonaws.com:8080/api');
            $val = \GuzzleHttp\json_decode($result->getBody()->getContents());
            $sc = $result->getStatusCode();

            DB::table('sanity')
                ->insert([
                    'date' => Carbon::now(),
                    'status_code' => $sc,
                    'value' => strval($val),
                ]);

            if ($val == 0) {
                Artisan::call('down');
            } elseif ($val == 1) {
                if ($this->app->isDownForMaintenance())
                    Artisan::call('up');
            }

        })->hourly();


    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
