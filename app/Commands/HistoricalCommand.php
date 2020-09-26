<?php

namespace App\Commands;

use App\Services\HttpClientService;
use App\Services\Logoable;
use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

class HistoricalCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'historic {symbol}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Display historical price data of the stock with given symbol';

    public function handleHistoric($response)
    {
        if ($response) {
            $this->task('Fetching Stock Data', function () {
                return true;
            });
            $this->line(Logoable::convertStringToAscii($response->companyName));
            $this->info("Current price: $response->latestPrice $");
            $this->line("Week 52 high: $response->week52High $");
            $this->line("Week 52 low: $response->week52Low $");

            return;
        }
        $this->task('Fetching Stock Data', function () {
            return false;
        });

        return $this->error('Stock not found!');
    }

    public function handle(HttpClientService $httpClientService)
    {
        $symbol = $this->argument('symbol');
        $this->handleHistoric($httpClientService->fetchQuote($symbol));
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
