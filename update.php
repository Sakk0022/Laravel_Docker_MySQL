<?php
echo "Update script is running...\n";

try {
    // Подключение к базе
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=PHP_WORK', 'laravel_user', '135798642');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Получаем список всех таблиц
    $tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);

    foreach ($tables as $table) {
        echo "Updating table: $table...\n";

        // Получаем список столбцов, кроме PRIMARY KEY и AUTO_INCREMENT
        $columns = $pdo->query("SHOW COLUMNS FROM `$table`")->fetchAll(PDO::FETCH_ASSOC);
        $setClauses = [];

        foreach ($columns as $column) {
            $name = $column['Field'];
            $type = $column['Type'];

            // Пропускаем первичные ключи и автоинкрементные поля
            if (strpos($column['Extra'], 'auto_increment') !== false) {
                continue;
            }

            // Определяем тестовое значение на основе типа данных
            if (strpos($type, 'int') !== false) {
                $value = rand(1, 100); // случайное число
            } elseif (strpos($type, 'varchar') !== false || strpos($type, 'text') !== false) {
                $value = "'Updated Value'";
            } elseif (strpos($type, 'date') !== false || strpos($type, 'timestamp') !== false) {
                $value = "'2025-01-01 00:00:00'";
            } else {
                $value = "NULL";
            }

            // Оборачиваем имя колонки в кавычки (backtick)
            $setClauses[] = "`$name` = $value";
        }

        if (!empty($setClauses)) {
            $sql = "UPDATE `$table` SET " . implode(', ', $setClauses);
            $pdo->exec($sql);
            echo "Table $table updated successfully.\n";
        } else {
            echo "Skipping table $table (no updatable columns).\n";
        }
    }

    echo "All tables updated successfully!\n";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
