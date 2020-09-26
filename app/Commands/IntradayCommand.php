<?php

namespace App\Commands;

use App\Services\HttpClientService;
use App\Services\Logoable;
use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

class IntradayCommand extends Command
{
    use Logoable;
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'intraday {symbol}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Display the intraday data of the stock with given symbol';

    public function handleIntraday($response)
    {
        if ($response) {
            $this->task("Fetching Stock Data", function () {
                return true;
            });
            $this->line(Logoable::convertStringToAscii($response->companyName));
            $this->info("Current price: $response->latestPrice $");
            $this->line("Day high: $response->high $");
            $this->line("Day low: $response->low $");
            $this->line("Difference to Open Price: $response->change %");
            $this->line("Open Price: $response->open $");
            $this->info("Market Open: ". ($response->isUSMarketOpen ? "true" : "false"));
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
        $this->handleIntraday($httpClientService->fetchQuote($symbol));
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
