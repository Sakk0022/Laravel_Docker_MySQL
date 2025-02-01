<?php



namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Company;
use App\Models\Account;
use App\Models\ApiService;
use App\Models\TokenType;
use App\Models\User;

class AddCompany extends Command
{
    protected $signature = 'add:company {companyName} {accountName} {apiServiceName} {tokenType} {tokenValue} {userId}';
    protected $description = 'Add a company and associate it with a user.';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Получаем данные из команды
        $companyName = $this->argument('companyName');
        $accountName = $this->argument('accountName');
        $apiServiceName = $this->argument('apiServiceName');
        $tokenType = $this->argument('tokenType');
        $tokenValue = $this->argument('tokenValue');
        $userId = $this->argument('userId');

        // Находим пользователя по ID
        $user = User::find($userId);
        if (!$user) {
            $this->error("Пользователь с ID $userId не найден!");
            return;
        }

        // Создаем компанию
        $company = Company::create([
            'name' => $companyName,
            'user_id' => $user->id, // Связываем компанию с пользователем
        ]);

        // Создаем аккаунт для компании
        $account = Account::create([
            'name' => $accountName,
            'company_id' => $company->id, // Привязываем аккаунт к компании
        ]);

        // Создаем сервис API для компании
        $apiService = ApiService::create([
            'name' => $apiServiceName,
        ]);

        // Связываем сервис с компанией
        $company->apiServices()->attach($apiService);

        // Создаем токен для компании
        $tokenTypeModel = TokenType::where('name', $tokenType)->first();
        if (!$tokenTypeModel) {
            $this->error("Тип токена $tokenType не найден!");
            return;
        }

        // Создаем токен для компании
        $company->tokens()->create([
            'type' => $tokenType,
            'value' => $tokenValue,
            'token_type_id' => $tokenTypeModel->id,
        ]);

        $this->info("Компания '$companyName' успешно добавлена и связана с пользователем '$user->name'.");
    }
}
