<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    if (!Schema::hasTable('accounts')) {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
    }
}



public function down()
{
    // Удаляем внешний ключ, ссылающийся на таблицу 'accounts'
    Schema::table('api_tokens', function (Blueprint $table) {
        $table->dropForeign(['account_id']); // Убедитесь, что имя внешнего ключа правильное
    });

    // Удаляем таблицу 'accounts'
    Schema::dropIfExists('accounts');
}


};
