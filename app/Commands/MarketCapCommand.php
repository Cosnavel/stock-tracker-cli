<?php

namespace App\Commands;

use App\Services\Logoable;
use App\Services\HttpClientService;
use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

class MarketCapCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'cap {symbol}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Display market cap of the stock with given symbol';

    public function handleCap($response)
    {
        if ($response) {
            $this->task("Fetching Stock Data", function () {
                return true;
            });
            $this->line(Logoable::convertStringToAscii($response->companyName));
            $this->info("Market Cap: ".number_format($response->marketCap, 0, ',', '.')." $");
            return;
        }
        $this->task("Fetching Stock Data", function () {
            return false;
        });
        return $this->error('Stock not found!');
    }

    public function handle(HttpClientService $httpClientService)
    {
        $symbol = $this->argument('symbol');
        $this->handleCap($httpClientService->fetchQuote($symbol));
    }

    /**
     * Define the command's schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    public function schedule(Schedule $schedule): void
    {
        // $schedule->command(static::class)->everyMinute();
    }
}
