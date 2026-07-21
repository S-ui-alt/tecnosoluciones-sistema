<?php

session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Definir rutas base
define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');

// Autocarga de clases
spl_autoload_register(function ($class) {
    $paths = [
        APP_PATH . '/controllers/' . $class . '.php',
        APP_PATH . '/models/' . $class . '.php',
        APP_PATH . '/config/' . $class . '.php'
    ];

    foreach ($paths as $path) {
        if (file_exists($path)) {
            require_once $path;
            return;
        }
    }
});

// Enrutamiento
$controller = $_GET['controller'] ?? 'auth';
$action = $_GET['action'] ?? 'mostrarLogin';

// Mapeo de controladores
$controllers = [
    'auth' => 'AuthController',
    'cliente' => 'ClienteController',
    'proyecto' => 'ProyectoController',
    'reporte' => 'ReporteController'
];

// Verificar autenticación para rutas protegidas
$publicActions = ['mostrarLogin', 'login', 'mostrarRegistro', 'registrar'];
if (!in_array($action, $publicActions) && !isset($_SESSION['user_id'])) {
    header('Location: index.php?controller=auth&action=mostrarLogin');
    exit;
}

// Instanciar controlador y ejecutar acción
if (isset($controllers[$controller])) {
    $controllerClass = $controllers[$controller];
    if (class_exists($controllerClass)) {
        $instance = new $controllerClass();
        if (method_exists($instance, $action)) {
            $instance->$action();
        } else {
            die("Accion no encontrada: " . htmlspecialchars($action));
        }
    } else {
        die("Controlador no encontrado: " . htmlspecialchars($controllerClass));
    }
} else {
    die("Controlador no valido: " . htmlspecialchars($controller));
}
