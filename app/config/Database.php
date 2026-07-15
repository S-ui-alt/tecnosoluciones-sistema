<?php


class Database
{
    private static ?PDO $instance = null;

    private const HOST = 'mariadb';
    private const DB_NAME = 'tecnosoluciones_db';
    private const USERNAME = 'tecno_user';
    private const PASSWORD = 'tecno_pass';

    public static function getConnection(): PDO
    {
        if (self::$instance === null) {
            try {
                $dsn = "mysql:host=" . self::HOST . ";dbname=" . self::DB_NAME . ";charset=utf8mb4";
                self::$instance = new PDO($dsn, self::USERNAME, self::PASSWORD, [
                  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                  PDO::ATTR_EMULATE_PREPARES => false,
                ]);
            } catch (PDOException $e) {
                die("Error de conexión; " . $e->getMessage());
            }
        }
        return self::$instance;
    }
}
