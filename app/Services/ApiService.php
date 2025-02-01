<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ApiService
{
    protected $baseUrl = 'http://89.108.115.241:6969';
    protected $key = 'E6kUTYrYwZq2tN4QEtyzsbEBk3ie';

    /**
     * Получить данные о продажах.
     *
     * @param string $dateFrom
     * @param string $dateTo
     * @param int $page
     * @param int $limit
     * @return array
     */
    public function getSales($dateFrom, $dateTo, $page = 1, $limit = 500)
    {
        $response = Http::get("$this->baseUrl/api/sales", [
            'dateFrom' => $dateFrom,
            'dateTo' => $dateTo,
            'page' => $page,
            'limit' => $limit,
            'key' => $this->key,
        ]);

        if ($response->successful()) {
            return $response->json();
        } else {
            Log::error('API Error (Sales): ' . $response->status() . ' - ' . $response->body());
            return [];
        }
    }

    /**
     * Получить данные о заказах.
     *
     * @param string $dateFrom
     * @param string $dateTo
     * @param int $page
     * @param int $limit
     * @return array
     */
    public function getOrders($dateFrom, $dateTo, $page = 1, $limit = 500)
    {
        $response = Http::get("$this->baseUrl/api/orders", [
            'dateFrom' => $dateFrom,
            'dateTo' => $dateTo,
            'page' => $page,
            'limit' => $limit,
            'key' => $this->key,
        ]);

        if ($response->successful()) {
            return $response->json();
        } else {
            Log::error('API Error (Orders): ' . $response->status() . ' - ' . $response->body());
            return [];
        }
    }

    /**
     * Получить данные о складах.
     *
     * @param string $dateFrom
     * @param int $page
     * @param int $limit
     * @return array
     */
    public function getStocks($dateFrom, $page = 1, $limit = 500)
    {
        $response = Http::get("$this->baseUrl/api/stocks", [
            'dateFrom' => $dateFrom,
            'page' => $page,
            'limit' => $limit,
            'key' => $this->key,
        ]);

        if ($response->successful()) {
            return $response->json();
        } else {
            Log::error('API Error (Stocks): ' . $response->status() . ' - ' . $response->body());
            return [];
        }
    }

    /**
     * Получить данные о доходах.
     *
     * @param string $dateFrom
     * @param string $dateTo
     * @param int $page
     * @param int $limit
     * @return array
     */
    public function getIncomes($dateFrom, $dateTo, $page = 1, $limit = 500)
    {
        $response = Http::get("$this->baseUrl/api/incomes", [
            'dateFrom' => $dateFrom,
            'dateTo' => $dateTo,
            'page' => $page,
            'limit' => $limit,
            'key' => $this->key,
        ]);

        if ($response->successful()) {
            return $response->json();
        } else {
            Log::error('API Error (Incomes): ' . $response->status() . ' - ' . $response->body());
            return [];
        }
    }
}