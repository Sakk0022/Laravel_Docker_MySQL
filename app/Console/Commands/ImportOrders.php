<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ApiService;
use App\Models\Order;

class ImportOrders extends Command
{
    protected $signature = 'import:orders {dateFrom} {dateTo}';
    protected $description = 'Import orders data from API';

    public function handle(ApiService $apiService)
    {
        $dateFrom = $this->argument('dateFrom');
        $dateTo = $this->argument('dateTo');

        $page = 1;
        do {
            $data = $apiService->getOrders($dateFrom, $dateTo, $page);

            foreach ($data['data'] as $order) {
                Order::create([
                    'order_number' => $order['order_number'],
                    'order_date' => $order['order_date'],
                    'total_amount' => $order['total_amount'],
                    'status' => $order['status'],
                ]);
            }

            $page++;
        } while (!empty($data['data']));

        $this->info('Orders data imported successfully.');
    }
}