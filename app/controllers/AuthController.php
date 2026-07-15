<?php

require_once __DIR__ . '/../models/Usuario.php';

class AuthController
{
    private Usuario $usuarioModel;

    public function __construct()
    {
        $this->usuarioModel = new Usuario();
    }

    public function mostrarLogin()
    {
        if (isset($_SESSION['user_id'])) {
            header('Location: index.php?controller=proyecto&action=index');
            exit;
        }
        require __DIR__ . '/../views/auth/login.php';
    }

    public function mostrarRegistro()
    {
        require __DIR__ . '/../views/auth/registro.php';
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'] ?? '';

            $user = $this->usuarioModel->login($email, $password);

            if ($user) {
                session_regenerate_id(true);
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_nombre'] = $user['nombre'];
                $_SESSION['user_rol'] = $user['rol'];
                header('Location: index.php?controller=proyecto&action=index');
                exit;
            } else {
                $error = "Credenciales incorrectas";
                require __DIR__ . '/../views/auth/login.php';
            }
        }
    }

    public function registrar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = htmlspecialchars(trim($_POST['nombre'] ?? ''));
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'] ?? '';
            $password_confirm = $_POST['password_confirm'] ?? '';

            if ($password !== $password_confirm) {
                $error = "Las contraseñas no coinciden";
                require __DIR__ . '/../views/auth/registro.php';
                return;
            }

            if (strlen($password) < 6) {
                $error = "La contraseña debe tener al menos 6 caracteres";
                require __DIR__ . '/../views/auth/registro.php';
                return;
            }

            if ($this->usuarioModel->registrar($nombre, $email, $password)) {
                $success = "Usuario registrado correctamente. Inicie sesión.";
                require __DIR__ . '/../views/auth/login.php';
            } else {
                $error = "Error al registrar usuario. El email puede estar en uso.";
                require __DIR__ . '/../views/auth/registro.php';
            }
        }
    }

    public function logout()
    {
        session_destroy();
        header('Location: index.php?controller=auth&action=mostrarLogin');
        exit;
    }
}
