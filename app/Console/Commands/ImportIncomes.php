<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ApiService;
use App\Models\Income;

class ImportIncomes extends Command
{
    protected $signature = 'import:incomes {dateFrom} {dateTo}';
    protected $description = 'Import incomes data from API';

    public function handle(ApiService $apiService)
    {
        $dateFrom = $this->argument('dateFrom');
        $dateTo = $this->argument('dateTo');

        $page = 1;
        do {
            $data = $apiService->getIncomes($dateFrom, $dateTo, $page);

            foreach ($data['data'] as $income) {
                Income::create([
                    'income_date' => $income['income_date'],
                    'amount' => $income['amount'],
                    'source' => $income['source'],
                ]);
            }

            $page++;
        } while (!empty($data['data']));

        $this->info('Incomes data imported successfully.');
    }
}