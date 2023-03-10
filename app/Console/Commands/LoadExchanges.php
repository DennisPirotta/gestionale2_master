<?php

namespace App\Console\Commands;

use App\Models\Exchange;
use Carbon\Carbon;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Console\Command\Command as CommandAlias;

class LoadExchanges extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'exchanges:load';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Load Exchanges from API';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $response = Http::get('https://api.twelvedata.com/time_series',[
            'apikey' => 'f9a705d145864db6af87e9135dcc9f40',
            'interval' => '15min',
            'symbol' => 'EUR/CHF',
            'start_date' => Carbon::now()->subWeek()->format('Y-m-d 00:00:00'),
            'end_date' => Carbon::now()->format('Y-m-d H:i:00'),
        ])->json();
        foreach ($response['values'] as $value){
            try {
                Exchange::create([
                    'datetime' => $value['datetime'],
                    'value' => $value['close']
                ]);
            }catch (Exception){}
        }
        return CommandAlias::SUCCESS;
    }
}
