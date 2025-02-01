<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ApiToken;
use Illuminate\Support\Str;

class CreateApiToken extends Command
{
    protected $signature = 'create:api-token {account_id}';
    protected $description = 'Создает новый API токен для аккаунта';

    public function handle()
    {
        $accountId = $this->argument('account_id');
        $token = ApiToken::create([
            'account_id' => $accountId,
            'token' => Str::random(60),
        ]);

        $this->info("API токен для аккаунта ID {$accountId} создан: {$token->token}");
    }
}
