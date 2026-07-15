<?php

require_once __DIR__ . '/../models/Proyecto.php';
require_once __DIR__ . '/../models/Cliente.php';

class ProyectoController
{
    private Proyecto $proyectoModel;
    private Cliente $clienteModel;

    public function __construct()
    {
        $this->proyectoModel = new Proyecto();
        $this->clienteModel = new Cliente();
    }

    public function index()
    {
        $proyectos = $this->proyectoModel->listarTodos();
        require __DIR__ . '/../views/proyectos/index.php';
    }

    public function create()
    {
        $clientes = $this->clienteModel->listarTodos();
        require __DIR__ . '/../views/proyectos/create.php';
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $datos = [
                'titulo' => htmlspecialchars(trim($_POST['titulo'])),
                'descripcion' => htmlspecialchars(trim($_POST['descripcion'] ?? '')),
                'cliente_id' => !empty($_POST['cliente_id']) ? (int)$_POST['cliente_id'] : null,
                'fecha_inicio' => $_POST['fecha_inicio'] ?: null,
                'fecha_fin' => $_POST['fecha_fin'] ?: null,
                'estado' => $_POST['estado'] ?? 'pendiente',
                'prioridad' => $_POST['prioridad'] ?? 'media'
            ];

            try {
                if ($this->proyectoModel->crear($datos)) {
                    $_SESSION['mensaje'] = "Proyecto creado exitosamente";
                } else {
                    $_SESSION['error'] = "Error al crear el proyecto en el modelo.";
                }
            } catch (PDOException $e) {
                $_SESSION['error'] = "Error de base de datos." . $e->getMessage();
            }
            header('Location: index.php?controller=proyecto&action=index');
            exit;
        }
    }

    public function edit()
    {
        $id = (int)($_GET['id'] ?? 0);
        $proyecto = $this->proyectoModel->obtenerPorId($id);
        $clientes = $this->clienteModel->listarTodos();
        if (!$proyecto) {
            header('Location: index.php?controller=proyecto&action=index');
            exit;
        }
        require __DIR__ . '/../views/proyectos/edit.php';
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = (int)$_POST['id'];
            $datos = [
                'titulo' => htmlspecialchars(trim($_POST['titulo'])),
                'descripcion' => htmlspecialchars(trim($_POST['descripcion'] ?? '')),
                'cliente_id' => !empty($_POST['cliente_id']) ? (int)$_POST['cliente_id'] : null,
                'fecha_inicio' => $_POST['fecha_inicio'] ?: null,
                'fecha_fin' => $_POST['fecha_fin'] ?: null,
                'estado' => $_POST['estado'],
                'prioridad' => $_POST['prioridad']
            ];

            if ($this->proyectoModel->actualizar($id, $datos)) {
                $_SESSION['mensaje'] = "Proyecto actualizado exitosamente";
            }
            header('Location: index.php?controller=proyecto&action=index');
            exit;
        }
    }

    public function delete()
    {
        $id = (int)($_GET['id'] ?? 0);
        if ($this->proyectoModel->eliminar($id)) {
            $_SESSION['mensaje'] = "Proyecto eliminado exitosamente";
        }
        header('Location: index.php?controller=proyecto&action=index');
        exit;
    }
}
