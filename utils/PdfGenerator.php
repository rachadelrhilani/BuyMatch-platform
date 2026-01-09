<?php
require_once __DIR__ . '/../vendor/autoload.php';

use FPDF;

class PdfGenerator
{
    public static function generateTicket(array $ticket, string $path)
    {
        $pdf = new FPDF();
$pdf->AddPage();

    // --- Styles du Ticket (Equivalent .ticket) ---
    $x = 15;
    $y = $pdf->GetY();
    $width = 180;
    $height = 85;

    // Background gris clair
    $pdf->SetFillColor(249, 249, 249);
    $pdf->Rect($x, $y, $width, $height, 'F');
    
    // Bordure en pointillés (simulée par SetDash si disponible, sinon ligne continue légère)
    $pdf->SetDrawColor(68, 68, 68);
    $pdf->Rect($x, $y, $width, $height);

    // --- Header (Equivalent .header) ---
    $pdf->SetY($y + 5);
    $pdf->SetFont('Arial', 'B', 20);
    $pdf->SetTextColor(26, 86, 219); // Bleu (#1a56db)
    $pdf->Cell(0, 15, 'BuyMatch Ticket', 0, 1, 'C');
    
    // Ligne sous le titre
    $pdf->Line($x + 20, $y + 20, $x + $width - 20, $y + 20);
    $pdf->Ln(5);

    // --- Détails (Equivalent .details) ---
    $pdf->SetTextColor(51, 51, 51);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->SetX($x + 10);
    
    // Libellés en gras et contenu normal
    $pdf->Write(8, 'Match: ');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Write(8, ( $ticket['titre']));
    $pdf->Ln(8);

    $pdf->SetX($x + 10);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Write(8, 'Date: ');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Write(8, date('d/m/Y H:i', strtotime($ticket->matchDatetime ?? $ticket['date_event'])));
    $pdf->Ln(8);

    $pdf->SetX($x + 10);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Write(8, 'Category: ');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Write(8, $ticket->categoryName ?? $ticket['categorie']);
    $pdf->Ln(8);

    $pdf->SetX($x + 10);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Write(8, 'Price: ');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Write(8,  $ticket['prix'] . ' $');
    $pdf->Ln(12);

    // --- QR Code Placeholder (Equivalent .qr-placeholder) ---
    $pdf->SetFillColor(238, 238, 238);
    $pdf->SetDrawColor(204, 204, 204);
    $pdf->Rect($x + 40, $pdf->GetY(), 100, 12, 'DF');
    $pdf->SetFont('Courier', 'B', 14);
    $pdf->Cell(0, 12, 'QR: ' . ($ticket->qrCode ?? $ticket['numero']), 0, 1, 'C');

    // --- Footer (Equivalent .footer) ---
    $pdf->Ln(2);
    $pdf->SetFont('Arial', '', 9);
    $pdf->SetTextColor(119, 119, 119);
    $pdf->Cell(0, 5, 'Thank you for your purchase! Please present this ticket at the entrance.', 0, 1, 'C');

    $pdf->Ln(15); // Espace entre les tickets


$pdf->Output('F', $path);
    }
}
