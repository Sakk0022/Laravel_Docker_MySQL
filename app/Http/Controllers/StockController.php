<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class StockController extends Controller
{
    // Метод для сохранения данных
    public function saveStocks()
    {
        $today = now()->toDateString();
        // Получаем данные через API
        $response = Http::get('http://89.108.115.241:6969/api/stocks', [
            'dateFrom' => $today,
            'dateTo' => $today,
            'page' => 1,
            'key' => 'E6kUTYrYwZq2tN4QEtyzsbEBk3ie',
            'limit' => 100
        ]);

        $data = $response->json()['data'];  // Декодируем JSON-ответ в массив

        // Проходим по данным и сохраняем их в базе данных
        foreach ($data as $item) {
            Stock::updateOrCreate(
                [
                    'supplier_article' => $item['supplier_article'],  // Используем уникальные поля для поиска
                    'barcode' => $item['barcode']
                ],
                [
                    'date' => $item['date'],
                    'last_change_date' => $item['last_change_date'],
                    'tech_size' => $item['tech_size'] ?? '',  // Если tech_size не существует, ставим пустую строку
                    'quantity' => $item['quantity'] ?? 0,  // Если quantity не существует, ставим 0
                    'is_supply' => $item['is_supply'] ?? 0,  // Если is_supply не существует, ставим 0
                    'is_realization' => $item['is_realization'] ?? 0,  // Если is_realization не существует, ставим 0
                    'quantity_full' => $item['quantity_full'] ?? 0,  // Если quantity_full не существует, ставим 0
                    'warehouse_name' => $item['warehouse_name'] ?? '',  // Если warehouse_name не существует, ставим пустую строку
                    'in_way_to_client' => $item['in_way_to_client'] ?? 0,  // Если in_way_to_client не существует, ставим 0
                    'in_way_from_client' => $item['in_way_from_client'] ?? 0,  // Если in_way_from_client не существует, ставим 0
                    'nm_id' => $item['nm_id'] ?? '',  // Если nm_id не существует, ставим пустую строку
                    'subject' => $item['subject'] ?? '',  // Если subject не существует, ставим пустую строку
                    'category' => $item['category'] ?? '',  // Если category не существует, ставим пустую строку
                    'brand' => $item['brand'] ?? '',  // Если brand не существует, ставим пустую строку
                    'sc_code' => $item['sc_code'] ?? '',  // Если sc_code не существует, ставим пустую строку
                    'price' => $item['price'] ?? 0,  // Если price не существует, ставим 0
                    'discount' => $item['discount'] ?? 0,  // Если discount не существует, ставим 0
                ]
            );
        }
    }

    // Метод для вызова сохранения данных
    public function index()
{
    // Сохраняем данные
    $this->saveStocks();

    // После сохранения перенаправляем на страницу со списком товаров
    return redirect('/stocks');
}

}
