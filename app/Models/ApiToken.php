<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\MassAssignmentException;

class ApiToken extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('account', function ($query) {
            if (Auth::check()) {
                $query->where('account_id', Auth::user()->account_id);
            }
        });
    }

    // Указываем, какие поля могут быть массово присвоены
    protected $fillable = ['name', 'account_id', 'token']; // Добавьте нужные поля

    /**
     * Переопределяем метод обновления данных.
     * Проверяем, что обновляем только свои данные.
     */
    public static function updateOrCreate(array $attributes, array $values = [])
    {
        if (Auth::check()) {
            // Проверка на принадлежность аккаунта
            if (isset($values['account_id']) && $values['account_id'] !== Auth::user()->account_id) {
                throw new MassAssignmentException('Cannot update or create token for another account.');
            }
        }

        return parent::updateOrCreate($attributes, $values);
    }

    /**
     * Переопределяем метод удаления данных.
     * Проверяем, что удаляем только свои данные.
     */
    public function delete()
    {
        if (Auth::check() && $this->account_id !== Auth::user()->account_id) {
            throw new \Exception('You cannot delete a token from another account.');
        }

        return parent::delete();
    }
}
