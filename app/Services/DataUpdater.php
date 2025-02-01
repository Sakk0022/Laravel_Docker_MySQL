<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Account;
use App\Models\DataEntry;
use Carbon\Carbon;

class DataUpdater
{
    public function update()
    {
        $accounts = Account::all();
        foreach ($accounts as $account) {
            $this->fetchDataForAccount($account);
        }
    }

    private function fetchDataForAccount($account)
    {
        $apiUrl = 'https://example.com/api/data';
        $headers = ['Authorization' => 'Bearer ' . $account->api_token];

        $response = Http::retry(5, 10, function ($exception, $request) {
            return $exception->getCode() === 429; // Повтор при 'Too Many Requests'
        })->get($apiUrl, $headers);

        if ($response->successful()) {
            $this->saveData($response->json(), $account->id);
        } else {
            Log::warning("Ошибка API для аккаунта {$account->id}: " . $response->status());
        }
    }

    private function saveData($data, $accountId)
    {
        foreach ($data as $item) {
            DataEntry::updateOrCreate(
                ['account_id' => $accountId, 'date' => $item['date']],
                ['data' => json_encode($item)]
            );
        }
    }
}
