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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->string('supplier_article'); // Артикул поставщика
            $table->string('tech_size'); // Технический размер
            $table->integer('barcode'); // Штрих-код
            $table->boolean('is_supply'); // Флаг поставки
            $table->boolean('is_realization'); // Флаг реализации
            $table->integer('quantity_full'); // Полное количество
            $table->string('warehouse_name'); // Название склада
            $table->decimal('price', 10, 2); // Цена товара
            $table->decimal('discount', 10, 2); // Скидка
            $table->integer('nm_id'); // Идентификатор товара
            $table->string('subject'); // Тема
            $table->string('category'); // Категория
            $table->string('brand'); // Бренд
            $table->integer('sc_code'); // Код
            $table->decimal('in_way_to_client', 10, 2); // В пути к клиенту
            $table->decimal('in_way_from_client', 10, 2); // В пути от клиента
            $table->timestamps(); // Время создания и обновления записи
            $table->date('date'); // Дата
            $table->date('last_change_date'); // Дата последнего изменения
            $table->integer('quantity');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
