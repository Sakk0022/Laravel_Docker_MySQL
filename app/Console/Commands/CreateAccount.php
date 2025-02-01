<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Account;

class CreateAccount extends Command
{
    protected $signature = 'create:account {name}';
    protected $description = 'Создает новый аккаунт';

    public function handle()
    {
        $name = $this->argument('name');
        $account = Account::create(['name' => $name]);

        $this->info("Аккаунт {$account->name} создан!");
    }
}
