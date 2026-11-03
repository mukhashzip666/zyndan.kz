<?php
/**
 * Конфигурация базы данных
 * Qyzylorda Times News Portal
 */

return [
    'host' => getenv('DB_HOST') ?: 'localhost',
    'port' => getenv('DB_PORT') ?: '3306',
    'database' => getenv('DB_NAME') ?: 'qyzylorda_times',
    'username' => getenv('DB_USER') ?: 'qyzylorda_user',
    'password' => getenv('DB_PASS') !== false ? getenv('DB_PASS') : 'qyzylorda_pass_2026',
    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'options' => [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]
];

