<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ApiService;
use Illuminate\Support\Facades\Auth;

class CreateApiService extends Command
{
    protected $signature = 'create:api-service {name}';
    protected $description = 'Create a new API service';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        if (Auth::check()) {
            // Получаем текущий account_id
            $accountId = Auth::user()->account_id;
            
            // Создаем новый сервис, передав account_id
            $apiService = ApiService::create([
                'name' => $this->argument('name'),
                'account_id' => $accountId,
            ]);

            $this->info('API сервис "' . $apiService->name . '" создан для аккаунта ID ' . $accountId);
        } else {
            $this->error('Вы не авторизованы.');
        }
    }
}
