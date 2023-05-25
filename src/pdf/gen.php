<?php
// Include the TCPDF library
require_once('tcpdf/tcpdf.php');
session_start();
require_once "../../conexion.php";

// Retrieve 'client' and 'sale' arguments from the request
$client = $_GET['cl'];
$sale = $_GET['v'];

// Query the database to retrieve the sale details
$query = mysqli_query($conexion, "SELECT * FROM ventas WHERE id = '$sale' AND id_cliente = '$client'");
$result = mysqli_fetch_all($query);
//$result = $mysqli->query($query);
// Check if the sale exists

if (mysqli_num_rows($query) > 0) {
    // Fetch the sale data
    //$row = mysqli_fetch_assoc($query);
	//echo $row;
	/*
    $productName = $row['id'];
    $price = $row['total'];
    $quantity = $row['id_usuario'];
    $total = $row['fecha']
/*
    // Generate the PDF receipt using TCPDF
    $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8');
    $pdf->SetCreator('Your Company');
    $pdf->SetAuthor('Your Name');
    $pdf->SetTitle('Receipt');
    $pdf->SetMargins(15, 15, 15);
    $pdf->AddPage();

    // Add content to the PDF
    $pdf->SetFont('helvetica', '', 12);
    $pdf->Cell(0, 10, 'Receipt', 0, 1, 'C');
    $pdf->Ln(10);
    $pdf->Cell(0, 10, 'Client: ' . $client, 0, 1);
    $pdf->Cell(0, 10, 'Sale ID: ' . $sale, 0, 1);
    $pdf->Ln(10);
    $pdf->Cell(0, 10, 'Product: ' . $productName, 0, 1);
    $pdf->Cell(0, 10, 'Price: $' . $price, 0, 1);
    $pdf->Cell(0, 10, 'Quantity: ' . $quantity, 0, 1);
    $pdf->Cell(0, 10, 'Total: $' . $total, 0, 1);

    // Output the PDF as a download
    $pdf->Output('receipt.pdf', 'D');
	 */
} else {
    echo "Sale not found!";
}

// Close the database connection
$mysqli->close();
?>

