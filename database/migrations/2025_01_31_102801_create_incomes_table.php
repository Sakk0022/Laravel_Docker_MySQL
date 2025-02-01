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
    Schema::create('incomes', function (Blueprint $table) {
        $table->id();
        $table->date('income_date'); // Дата дохода
        $table->decimal('amount', 10, 2); // Сумма дохода
        $table->string('source'); // Источник дохода
        $table->timestamps();
        $table->date('date');
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incomes');
    }
};
