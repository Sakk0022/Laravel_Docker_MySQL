<?php

namespace App\Console\Commands;

use App\Services\ApiService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Models\Stock; // Подключите модель для работы с таблицей 'stocks'

class UpdateData extends Command
{
    protected $signature = 'data:update';
    protected $description = 'Обновление данных из внешнего источника';

    protected $apiService;

    public function __construct(ApiService $apiService)
    {
        parent::__construct();
        $this->apiService = $apiService; // Внедрение ApiService
    }

    public function handle()
    {
        Log::debug('Начато обновление данных');

        // Обновление данных по складам
        $stocksData = $this->apiService->getStocks('2025-02-12', 1, 100);
        if (!empty($stocksData['data'])) {
            foreach ($stocksData['data'] as $stock) {
                // Пример обновления или вставки данных в таблицу 'stocks'
                Stock::updateOrCreate(
                    ['barcode' => $stock['barcode']], // Уникальный идентификатор для обновления
                    [
                        'date' => $stock['date'],
                        'quantity' => $stock['quantity'],
                        'price' => $stock['price'],
                        'warehouse_name' => $stock['warehouse_name'],
                        'brand' => $stock['brand'],
                    ]
                );
            }
        }

        // Обновление других данных, например, продаж или заказов
        $salesData = $this->apiService->getSales('2025-02-12', '2025-02-12');
if (!empty($salesData['data'])) {
    foreach ($salesData['data'] as $sale) {
        // Проверка на наличие всех необходимых ключей
        if (isset($sale['nm_id'], $sale['date'], $sale['quantity'], $sale['price'], $sale['discount'])) {
            \App\Models\Sale::updateOrCreate(
                ['nm_id' => $sale['nm_id']], // Уникальный идентификатор для обновления
                [
                    'date' => $sale['date'],
                'quantity' => $sale['quantity'] ?? 0,  // Если quantity не существует, ставим 0
                'price' => $sale['price'] ?? 0,  // Если price не существует, ставим 0
                'discount' => $sale['discount'] ?? 0,
                ]
            );
        } else {
            Log::warning('Отсутствуют необходимые данные для продажи: ' . json_encode($sale));
        }
    }
}


        // Выводим информацию в консоль и лог
        $this->info('Обновление данных завершено');
        Log::debug('Обновление данных завершено');
    }
}
