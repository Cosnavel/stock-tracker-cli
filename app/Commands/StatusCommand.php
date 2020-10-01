<?php

namespace App\Commands;

use App\Services\HttpClientService;
use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

class StatusCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'status';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Display status of Stock API';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(HttpClientService $httpClientService)
    {
        $status = $httpClientService->fetchStatus()->status;
        $this->task('Api Status', function () use ($status) {
            return $status == 'up' ? true : false;
        });
        $this->notify('Stock Api', "Status: $status");
    }

    /**
     * Define the command's schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     *
     * @return void
     */
    public function schedule(Schedule $schedule): void
    {
        // $schedule->command(static::class)->everyMinute();
    }
}
