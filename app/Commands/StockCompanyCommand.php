<?php

namespace App\Commands;

use App\Services\HttpClientService;
use App\Services\Logoable;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Str;
use LaravelZero\Framework\Commands\Command;

class StockCompanyCommand extends Command
{
    use Logoable;
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'company {symbol}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Display information about the company of the stock with the given symbol';

    public function handleCompany($response)
    {
        if ($response) {
            $this->task('Fetching Stock Data', function () {
                return true;
            });
            $this->line(Logoable::convertStringToAscii($response->companyName));

            $this->line("Symbol: $response->symbol");
            $this->line("Website: $response->website");
            $this->line("Exchange: $response->exchange");
            $this->line("CEO: $response->CEO");
            $this->line("Headquarter: $response->city $response->country");
            $this->line('Description: '.Str::limit($response->description, 200));
            $this->notify('Data fetched', "Company Data for {$response->symbol}");

            return;
        }
        $this->task('Fetching Stock Data', function () {
            return false;
        });

        return $this->notify('Error', 'Stock not found!');
    }

    public function handle(HttpClientService $httpClientService): void
    {
        $symbol = $this->argument('symbol');
        $this->handleCompany($httpClientService->fetchCompany($symbol));
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
