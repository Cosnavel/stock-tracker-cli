<?php

namespace App\Commands;

use App\Services\HttpClientService;
use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

class StockTrackCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'track {symbol}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Display the current value of the stock with given symbol';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(HttpClientService $httpClientService)
    {
        $symbol = $this->argument('symbol');
        $this->info('Given symbol: '.$symbol);
        $this->info($httpClientService::convertStringToAscii($symbol));
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
