<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyTokenTypeTable extends Migration
{
    public function up()
{
    Schema::create('company_token_type', function (Blueprint $table) {
        $table->id();
        $table->foreignId('company_id')->constrained()->onDelete('cascade');
        $table->foreignId('token_type_id')->constrained()->onDelete('cascade');
        $table->timestamps();
    });
    
}

public function down()
{
    Schema::dropIfExists('company_token_type');
}

}
