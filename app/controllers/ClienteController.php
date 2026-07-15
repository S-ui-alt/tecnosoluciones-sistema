<?php

require_once __DIR__ . '/../models/Cliente.php';

class ClienteController
{
    private Cliente $clienteModel;

    public function __construct()
    {
        $this->clienteModel = new Cliente();
    }

    public function index()
    {
        $clientes = $this->clienteModel->listarTodos();
        require __DIR__ . '/../views/clientes/index.php';
    }

    public function create()
    {
        require __DIR__ . '/../views/clientes/create.php';
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $datos = [
                'nombre' => htmlspecialchars(trim($_POST['nombre'])),
                'email' => filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL),
                'telefono' => htmlspecialchars(trim($_POST['telefono'] ?? '')),
                'direccion' => htmlspecialchars(trim($_POST['direccion'] ?? '')),
                'empresa' => htmlspecialchars(trim($_POST['empresa'] ?? ''))
            ];

            try {
                if ($this->clienteModel->crear($datos)) {
                    $_SESSION['mensaje'] = "Cliente creado exitosamente";
                } else {
                    $_SESSION['error'] = "Error al crear cliente";
                }
            } catch (PDOException $e) {
                $_SESSION['error'] = "Error de base de datos: " . $e->getMessage();
            }
            header('Location: index.php?controller=cliente&action=index');
            exit;

        }
    }

    public function editar()
    {
        $id = $_GET['id'] ?? null;
        $cliente = $this->clienteModel->obtenerPorId((int)$id);
        if (!$cliente) {
            header('Location: index.php?controller=cliente&action=index');
            exit;
        }
        require __DIR__ . '/../views/clientes/edit.php';
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = (int)$_POST['id'];
            $datos = [
                'nombre' => htmlspecialchars(trim($_POST['nombre'])),
                'email' => filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL),
                'telefono' => htmlspecialchars(trim($_POST['telefono'] ?? '')),
                'direccion' => htmlspecialchars(trim($_POST['direccion'] ?? '')),
                'empresa' => htmlspecialchars(trim($_POST['empresa'] ?? ''))
            ];

            if ($this->clienteModel->actualizar($id, $datos)) {
                $_SESSION['mensaje'] = "Cliente actualizado exitosamente";
            }
            header('Location: index.php?controller=cliente&action=index');
            exit;
        }
    }

    public function delete()
    {
        $id = (int)($_GET['id'] ?? 0);
        if ($this->clienteModel->eliminar($id)) {
            $_SESSION['mensaje'] = "Cliente eliminado exitosamente";
        }
        header('Location: index.php?controller=cliente&action=index');
        exit;
    }
}
