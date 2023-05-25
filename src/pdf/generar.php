<?php
require_once("tcpdf/tcpdf.php");
require_once("../../conexion.php"); // Include the database connection file

// Retrieve 'cl' and 'v' parameters from the request
$clientId = $_GET['cl'];
$saleId = $_GET['v'];

// Query the database to retrieve the sale details
$query = mysqli_query($conexion, "SELECT v.*, c.idcliente, c.nombre, v.total, v.fecha FROM ventas v INNER JOIN cliente c ON v.id_cliente = c.idcliente WHERE v.id = '$saleId'");

// Check if the sale exists
if ($row = mysqli_fetch_assoc($query)) {
    // Create a new PDF instance
    $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8');

    // Set document information
    $pdf->SetCreator('Farmacia FESC');
    $pdf->SetAuthor('Your Name');
    $pdf->SetTitle('Recibo');

    // Set margins
    $pdf->SetMargins(15, 15, 15);

    // Add a new page
    $pdf->AddPage();

    // Set font
    $pdf->SetFont('helvetica', '', 12);

    // Add content to the PDF
    $pdf->Cell(0, 10, 'Recibo de compra', 0, 1, 'C');
    $pdf->Ln(10);
    $pdf->Cell(60, 10, 'Cliente:', 0, 0);
    //$pdf->Cell(0, 10, $clientId, 0, 1);
    $pdf->Cell(0, 10, $row['nombre'], 0, 1);
    $pdf->Cell(60, 10, 'Número de venta:', 0, 0);
    $pdf->Cell(0, 10, $saleId, 0, 1);
    $pdf->Ln(10);
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->Cell(0, 10, 'Detalles de la venta', 0, 1);
    $pdf->SetFont('helvetica', '', 12);
    $pdf->Cell(60, 10, 'Total:', 0, 0);
    $pdf->Cell(0, 10, '$' . $row['total'], 0, 1);
    $pdf->Cell(60, 10, 'Fecha:', 0, 0);
    $pdf->Cell(0, 10, $row['fecha'], 0, 1);

    $pdf->Ln(10);
    $pdf->SetFont('helvetica', 'I', 10);
    $pdf->Cell(0, 10, '¡Gracias por su compra!', 0, 1, 'C');
    $pdf->SetFont('helvetica', '', 12);

    // Output the PDF as a download
    $pdf->Output('receipt.pdf', 'D');
} else {
    echo "Sale not found!";
}

