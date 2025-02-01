<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Company;

class CreateCompany extends Command
{
    protected $signature = 'create:company {name}';
    protected $description = 'Создает новую компанию';

    public function handle()
    {
        $name = $this->argument('name');
        $company = Company::create(['name' => $name]);

        $this->info("Компания {$company->name} создана!");
    }
}

