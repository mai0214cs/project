<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel {

    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \App\Console\Commands\Inspire::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule) {
        $schedule->call(function () {
        DB::table('group_attributes')->insert([
            'name'=>'Attribute'.rand(1, 1000000),
            'type'=>1,
            'order'=>999,
            'status'=>'Yes'
        ]);
        })->daily();
        // $schedule->command('inspire')
        //          ->hourly();
    }

}
