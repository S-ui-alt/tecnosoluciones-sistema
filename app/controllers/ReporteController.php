<?php

require_once __DIR__ . '/../models/Cliente.php';
require_once __DIR__ . '/../models/Proyecto.php';
require_once __DIR__ . '/../../vendor/setasign/fpdf/fpdf.php';

class ReporteController
{
    private Cliente $clienteModel;
    private Proyecto $proyectoModel;

    public function __construct()
    {
        $this->clienteModel = new Cliente();
        $this->proyectoModel = new Proyecto();
    }

    public function index()
    {
        $totalClientes = $this->clienteModel->contar();
        $totalProyectos = $this->proyectoModel->contar();
        $proyectosPorEstado = $this->proyectoModel->contarPorEstado();
        require __DIR__ . '/../views/reportes/index.php';
    }

    public function pdfClientes()
    {
        $clientes = $this->clienteModel->listarTodos();

        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 10, 'TecnoSoluciones S.A. - Reporte de Clientes', 0, 1, 'C');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(0, 10, 'Fecha: ' . date('d/m/Y H:i'), 0, 1, 'C');
        $pdf->Ln(5);

        // Encabezados
        $pdf->SetFillColor(52, 152, 219);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(10, 8, 'ID', 1, 0, 'C', true);
        $pdf->Cell(50, 8, 'Nombre', 1, 0, 'C', true);
        $pdf->Cell(50, 8, 'Email', 1, 0, 'C', true);
        $pdf->Cell(30, 8, 'Telefono', 1, 0, 'C', true);
        $pdf->Cell(50, 8, 'Empresa', 1, 1, 'C', true);

        // Datos
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFont('Arial', '', 10);
        foreach ($clientes as $cliente) {
            $pdf->Cell(10, 7, $cliente['id'], 1);
            $pdf->Cell(50, 7, mb_convert_encoding(substr($cliente['nombre'], 0, 25), 'ISO-8859-1', 'UTF-8'), 1);
            $pdf->Cell(50, 7, mb_convert_encoding($cliente['email'] ?? 'N/A', 'ISO-8859-1', 'UTF-8'), 1);
            $pdf->Cell(30, 7, mb_convert_encoding($cliente['telefono'] ?? 'N/A', 'ISO-8859-1', 'UTF-8'), 1);
            $pdf->Cell(50, 7, mb_convert_encoding(substr($cliente['empresa'] ?? 'N/A', 0, 25), 'ISO-8859-1', 'UTF-8'), 1);
            $pdf->Ln();
        }

        $pdf->Output('D', 'reporte_clientes_' . date('Ymd') . '.pdf');
        exit;
    }

    public function pdfProyectos()
    {
        $proyectos = $this->proyectoModel->listarTodos();

        $pdf = new FPDF();
        $pdf->AddPage('L'); // Horizontal
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 10, 'TecnoSoluciones S.A. - Reporte de Proyectos', 0, 1, 'C');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(0, 10, 'Fecha: ' . date('d/m/Y H:i'), 0, 1, 'C');
        $pdf->Ln(5);

        // Encabezados
        $pdf->SetFillColor(46, 204, 113);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(10, 8, 'ID', 1, 0, 'C', true);
        $pdf->Cell(50, 8, 'Titulo', 1, 0, 'C', true);
        $pdf->Cell(40, 8, 'Cliente', 1, 0, 'C', true);
        $pdf->Cell(25, 8, 'Inicio', 1, 0, 'C', true);
        $pdf->Cell(25, 8, 'Fin', 1, 0, 'C', true);
        $pdf->Cell(30, 8, 'Estado', 1, 0, 'C', true);
        $pdf->Cell(25, 8, 'Prioridad', 1, 0, 'C', true);
        $pdf->Cell(70, 8, 'Descripcion', 1, 1, 'C', true);

        // Datos
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFont('Arial', '', 9);

        foreach ($proyectos as $proyecto) {
            $id       = $proyecto['id'];
            $titulo   = mb_convert_encoding(substr($proyecto['titulo'], 0, 28), 'ISO-8859-1', 'UTF-8');
            $cliente  = mb_convert_encoding($proyecto['cliente_nombre'] ?? 'Sin cliente', 'ISO-8859-1', 'UTF-8');
            $f_inicio = mb_convert_encoding($proyecto['fecha_inicio'] ?? 'N/A', 'ISO-8859-1', 'UTF-8');
            $f_fin    = mb_convert_encoding($proyecto['fecha_fin'] ?? 'N/A', 'ISO-8859-1', 'UTF-8');
            $prioridad = mb_convert_encoding(ucfirst($proyecto['prioridad']), 'ISO-8859-1', 'UTF-8');
            $desc     = mb_convert_encoding(substr($proyecto['descripcion'] ?? '', 0, 40), 'ISO-8859-1', 'UTF-8');

            $pdf->Cell(10, 7, $id, 1);
            $pdf->Cell(50, 7, $titulo, 1);
            $pdf->Cell(40, 7, $cliente, 1);
            $pdf->Cell(25, 7, $f_inicio, 1);
            $pdf->Cell(25, 7, $f_fin, 1);

            $estado = $proyecto['estado'];
            $color = [255, 255, 255];

            if ($estado === 'completado') {
                $color = [46, 204, 113];
            } elseif ($estado === 'en_progreso') {
                $color = [52, 152, 219];
            } elseif ($estado === 'pendiente') {
                $color = [241, 196, 15];
            } elseif ($estado === 'cancelado') {
                $color = [231, 76, 60];
            }

            $txt_estado = mb_convert_encoding(ucfirst($estado), 'ISO-8859-1', 'UTF-8');

            $pdf->SetFillColor($color[0], $color[1], $color[2]);
            $pdf->Cell(30, 7, $txt_estado, 1, 0, 'C', true);
            $pdf->SetFillColor(255, 255, 255);

            $pdf->Cell(25, 7, $prioridad, 1, 0, 'C');
            $pdf->Cell(70, 7, $desc, 1);
            $pdf->Ln();
        }

        $pdf->Output('D', 'reporte_proyectos_' . date('Ymd') . '.pdf');
        exit;
    }
}
