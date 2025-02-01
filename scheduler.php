<?php
while (true) {
    // Выполняем команду планировщика Laravel
    shell_exec('php /path-to-your-project/artisan schedule:run');
    // Ждем одну минуту перед следующим запуском
    sleep(60);
}
