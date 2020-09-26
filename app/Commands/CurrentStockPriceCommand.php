<?php

namespace App\Commands;

use App\Services\HttpClientService;
use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

class CurrentStockPriceCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'price {symbol}';

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
    public function handlePrice($response)
    {
        if ($response) {
            $this->task('Fetching Stock Data', function () {
                return true;
            });
            $this->info("Current price: $response $");

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
        $this->handlePrice($httpClientService->fetchPrice($symbol));
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
