<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ApiService; // Предположим, что у вас есть сервис для работы с API
use App\Models\Sale; // Модель для работы с таблицей sales

class ImportSales extends Command
{
    /**
     * Название и сигнатура команды.
     *
     * @var string
     */
    protected $signature = 'import:sales {dateFrom} {dateTo}';

    /**
     * Описание команды.
     *
     * @var string
     */
    protected $description = 'Import sales data from API';

    /**
     * Выполнение команды.
     *
     * @param ApiService $apiService
     * @return int
     */
    public function handle(ApiService $apiService)
{
    $dateFrom = $this->argument('dateFrom'); // Получаем аргумент dateFrom
    $dateTo = $this->argument('dateTo'); // Получаем аргумент dateTo

    $page = 1; // Начинаем с первой страницы
    do {
        // Получаем данные из API
        $data = $apiService->getSales($dateFrom, $dateTo, $page);

        // Сохраняем данные в базу
        foreach ($data['data'] as $sale) {
            Sale::create([
                'date' => $sale['date'],
                'amount' => $sale['amount'],
            ]);
        }

        $page++; // Переходим на следующую страницу
    } while (!empty($data['data'])); // Продолжаем, пока есть данные

    $this->info('Sales data imported successfully.'); // Выводим сообщение об успехе

    return 0; // Указываем, что команда выполнена успешно
}
}
