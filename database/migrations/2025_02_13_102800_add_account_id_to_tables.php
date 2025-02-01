<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Добавляем столбец account_id в таблицу companies, если он еще не существует
        if (!Schema::hasColumn('companies', 'account_id')) {
            Schema::table('companies', function (Blueprint $table) {
                $table->unsignedBigInteger('account_id');
            });
        }

        // Добавляем столбец account_id в таблицу api_tokens, если он еще не существует
        if (!Schema::hasColumn('api_tokens', 'account_id')) {
            Schema::table('api_tokens', function (Blueprint $table) {
                $table->unsignedBigInteger('account_id');
            });
        }

        // Добавляем столбец account_id в таблицу api_services, если он еще не существует
        if (!Schema::hasColumn('api_services', 'account_id')) {
            Schema::table('api_services', function (Blueprint $table) {
                $table->unsignedBigInteger('account_id');
            });
        }

        // Добавляем столбец account_id в таблицу token_types, если он еще не существует
        if (!Schema::hasColumn('token_types', 'account_id')) {
            Schema::table('token_types', function (Blueprint $table) {
                $table->unsignedBigInteger('account_id');
            });
        }

        // Добавляем внешние ключи для account_id, если они еще не существуют
        Schema::table('companies', function (Blueprint $table) {
            if (!Schema::hasColumn('companies', 'account_id')) {
                $table->foreign('account_id', 'companies_account_id_foreign')
                    ->references('id')
                    ->on('accounts')
                    ->onDelete('cascade');
            }
        });
        
        Schema::table('api_tokens', function (Blueprint $table) {
            if (!Schema::hasColumn('api_tokens', 'account_id')) {
                $table->foreign('account_id')
                    ->references('id')
                    ->on('accounts')
                    ->onDelete('cascade');
            }
        });

        Schema::table('api_services', function (Blueprint $table) {
            if (!Schema::hasColumn('api_services', 'account_id')) {
                $table->foreign('account_id')
                    ->references('id')
                    ->on('accounts')
                    ->onDelete('cascade');
            }
        });

        Schema::table('token_types', function (Blueprint $table) {
            if (!Schema::hasColumn('token_types', 'account_id')) {
                $table->foreign('account_id')
                    ->references('id')
                    ->on('accounts')
                    ->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Удаляем внешние ключи
        Schema::table('companies', function (Blueprint $table) {
            $table->dropForeign('companies_account_id_foreign');
            $table->dropColumn('account_id');
        });

        Schema::table('api_tokens', function (Blueprint $table) {
            $table->dropForeign(['account_id']);
            $table->dropColumn('account_id');
        });

        Schema::table('api_services', function (Blueprint $table) {
            $table->dropForeign(['account_id']);
            $table->dropColumn('account_id');
        });

        Schema::table('token_types', function (Blueprint $table) {
            $table->dropForeign(['account_id']);
            $table->dropColumn('account_id');
        });
    }
};
