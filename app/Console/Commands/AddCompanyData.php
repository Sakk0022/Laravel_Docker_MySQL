<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Company;
use App\Models\Account;
use App\Models\ApiService;
use App\Models\TokenType;

class AddCompanyData extends Command
{
    protected $signature = 'add:company {company_name} {account_name} {service_name} {token_type} {token_value} {account_id}';
    protected $description = 'Добавить компанию, аккаунт, сервис и токен';

    public function handle()
    {
        // Находим аккаунт по переданному account_id
        $account = Account::find($this->argument('account_id'));

        if (!$account) {
            $this->error('Аккаунт не найден!');
            return;
        }

        // Проверяем, существует ли уже компания с таким именем
        $company = Company::where('name', $this->argument('company_name'))->first();

        if ($company) {
            $this->error('Компания с таким именем уже существует!');
            return;
        }

        // Создаем компанию
        $company = Company::create([
            'name' => $this->argument('company_name'),
            'account_id' => $account->id, // Присваиваем account_id
        ]);

        // Создаем сервис API с account_id
        $apiService = ApiService::create([
            'name' => $this->argument('service_name'),
            'account_id' => $account->id, // Присваиваем account_id
        ]);

        // Добавляем токен
        $tokenType = TokenType::create([
            'name' => $this->argument('token_type'),
            'account_id' => $account->id, // Присваиваем account_id
        ]);

        // Связываем компанию с сервисом и токеном
        $company->apiServices()->attach($apiService->id);
        $company->tokenTypes()->attach($tokenType->id);

        $this->info('Компания и токены успешно добавлены');
    }
}
