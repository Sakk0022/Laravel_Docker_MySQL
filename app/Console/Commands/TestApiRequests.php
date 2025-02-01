<?php
namespace App\Console\Commands;

use App\Services\ApiService;
use Illuminate\Console\Command;

class TestApiRequests extends Command
{
    protected $signature = 'test:api-requests';
    protected $description = 'Тестирование API запросов с повторной попыткой';

    protected $apiService;

    public function __construct(ApiService $apiService)
    {
        parent::__construct();
        $this->apiService = $apiService;
    }

    public function handle()
    {
        $dateFrom = '2025-01-01';
        $dateTo = '2025-01-31';
        
        // Пример вызова метода и логирования ошибок
        $this->info('Запрашиваем данные о продажах...');
        $data = $this->apiService->getSales($dateFrom, $dateTo);
        $this->info('Данные о продажах: ' . json_encode($data));
    }
}
