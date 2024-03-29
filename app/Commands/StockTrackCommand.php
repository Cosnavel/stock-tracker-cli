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
    protected $description = 'Display the info of the stock with given symbol';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(HttpClientService $httpClientService): void
    {
        $symbol = $this->argument('symbol');
        $this->info('Given symbol: '.$symbol);
        /* Todo: interactive Menu and Flag support to include the other commands */
    }

    /**
     * Define the command's schedule.
     *
     *
     */
    public function schedule(Schedule $schedule): void
    {
        // $schedule->command(static::class)->everyMinute();
    }
}
