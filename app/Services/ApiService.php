<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ApiService
{
    protected $baseUrl = 'http://89.108.115.241:6969';
    protected $key = 'E6kUTYrYwZq2tN4QEtyzsbEBk3ie';

    // Стандартные параметры для запросов
    protected $maxRetries = 5; // Максимальное количество попыток
    protected $waitTime = 1; // Начальная задержка в секундах

    /**
     * Выполнить запрос с повторной попыткой в случае ошибки "Too many requests".
     *
     * @param string $url
     * @param array $params
     * @return array
     */
    protected function fetchWithRetry($url, $params)
    {
        $retryCount = 0;

        while ($retryCount < $this->maxRetries) {
            $response = Http::get($url, $params);

            if ($response->status() == 429) {
                // Если ошибка "Too many requests", ждем и пробуем снова
                Log::warning("API Error 429: Слишком много запросов. Повторная попытка через $this->waitTime секунд.");
                sleep($this->waitTime);
                $retryCount++;
                $this->waitTime *= 2; // Экспоненциальная задержка
            } else {
                return $response->json();
            }
        }

        Log::error('API Error (Too many retries): ' . $response->status() . ' - ' . $response->body());
        return [];
    }

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
        $params = [
            'dateFrom' => $dateFrom,
            'dateTo' => $dateTo,
            'page' => $page,
            'limit' => $limit,
            'key' => $this->key,
        ];

        return $this->fetchWithRetry("$this->baseUrl/api/sales", $params);
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
        $params = [
            'dateFrom' => $dateFrom,
            'dateTo' => $dateTo,
            'page' => $page,
            'limit' => $limit,
            'key' => $this->key,
        ];

        return $this->fetchWithRetry("$this->baseUrl/api/orders", $params);
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
        $params = [
            'dateFrom' => $dateFrom,
            'page' => $page,
            'limit' => $limit,
            'key' => $this->key,
        ];

        return $this->fetchWithRetry("$this->baseUrl/api/stocks", $params);
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
        $params = [
            'dateFrom' => $dateFrom,
            'dateTo' => $dateTo,
            'page' => $page,
            'limit' => $limit,
            'key' => $this->key,
        ];

        return $this->fetchWithRetry("$this->baseUrl/api/incomes", $params);
    }
}
