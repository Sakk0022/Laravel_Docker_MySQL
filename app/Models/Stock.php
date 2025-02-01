<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    // Указываем имя таблицы (если она не соответствует имени модели)
    protected $table = 'stocks';  // Убедитесь, что это имя вашей таблицы

    // Массовое заполнение (чтобы избежать ошибок при сохранении данных)
    protected $fillable = [
        'date', 'last_change_date', 'supplier_article', 'tech_size', 'barcode', 
        'quantity', 'is_supply', 'is_realization', 'quantity_full', 'warehouse_name', 
        'in_way_to_client', 'in_way_from_client', 'nm_id', 'subject', 'category', 
        'brand', 'sc_code', 'price', 'discount'
    ];

    // Пример scope
    public function scopeFresh($query)
    {
        return $query->where('date', '>=', now()->subDays(7)); // Данные за последнюю неделю
    }
}

