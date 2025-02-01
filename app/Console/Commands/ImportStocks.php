<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ApiService;
use App\Models\Stock;

class ImportStocks extends Command
{
    protected $signature = 'import:stocks';
    protected $description = 'Import stocks data from API';

    public function handle(ApiService $apiService)
    {
        $page = 1;
        do {
            $data = $apiService->getStocks($page);

            foreach ($data['data'] as $stock) {
                Stock::create([
                    'product_name' => $stock['product_name'],
                    'quantity' => $stock['quantity'],
                    'price' => $stock['price'],
                ]);
            }

            $page++;
        } while (!empty($data['data']));

        $this->info('Stocks data imported successfully.');
    }
}