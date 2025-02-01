<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\TokenType;
use Illuminate\Support\Facades\Auth;

class CreateTokenType extends Command
{
    protected $signature = 'create:token-type {name}';
    protected $description = 'Create a new token type';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        if (Auth::check()) {
            // Получаем текущий account_id
            $accountId = Auth::user()->account_id;
            
            // Создаем новый тип токена, передав account_id
            $tokenType = TokenType::create([
                'name' => $this->argument('name'),
                'account_id' => $accountId,
            ]);

            $this->info('Тип токена "' . $tokenType->name . '" создан для аккаунта ID ' . $accountId);
        } else {
            $this->error('Вы не авторизованы.');
        }
    }
}
