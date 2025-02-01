<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClearTables extends Seeder
{
    public function run()
    {
        DB::table('companies')->truncate();
        DB::table('api_tokens')->truncate();
        DB::table('api_services')->truncate();
        DB::table('token_types')->truncate();
    }
}
