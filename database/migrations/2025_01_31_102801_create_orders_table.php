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
    Schema::create('orders', function (Blueprint $table) {
        $table->id();
        $table->string('order_number'); // Номер заказа
        $table->date('order_date'); // Дата заказа
        $table->decimal('total_amount', 10, 2); // Общая сумма заказа
        $table->string('status'); // Статус заказа
        $table->timestamps();
        $table->date('date');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
