<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ApiService;

class TestApi extends Command
{
    protected $signature = 'test:api';
    protected $description = 'Test API connection';

    public function handle(ApiService $apiService)
    {
        $sales = $apiService->getSales('2023-01-01', '2023-12-31', 1);
        $this->info('Sales Data: ' . json_encode($sales));

        $orders = $apiService->getOrders('2023-01-01', '2023-12-31', 1);
        $this->info('Orders Data: ' . json_encode($orders));

        $stocks = $apiService->getStocks('2023-01-01', 1);
        $this->info('Stocks Data: ' . json_encode($stocks));

        $incomes = $apiService->getIncomes('2023-01-01', '2023-12-31', 1);
        $this->info('Incomes Data: ' . json_encode($incomes));
    }
}