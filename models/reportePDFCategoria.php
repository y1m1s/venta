<?php
require_once "conexion.php";
include "../controllers/generarPDF.php";

$sql = "SELECT id_categoria, categoria, descripcion FROM categorias";
$pdo = Conexion::conexion();
$resultado = $pdo->prepare($sql);
$resultado->execute();

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFillColor(232, 232, 232);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(30, 6, 'ID', 1, 0, 'C', 1);
$pdf->Cell(50, 6, 'CATEGORIA', 1, 0, 'C', 1);
$pdf->Cell(110, 6, utf8_decode('DESCRIPCIÓN'), 1, 1, 'C', 1);

$pdf->SetFont('Arial', '', 10);
while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {

    $pdf->Cell(30, 6, $row['id_categoria'], 1, 0, 'C');
    $pdf->Cell(50, 6, utf8_decode($row['categoria']), 1, 0, 'C');
    $pdf->Cell(110, 6, utf8_decode($row['descripcion']),1, 1, 'C');
}

$pdf->Output();
