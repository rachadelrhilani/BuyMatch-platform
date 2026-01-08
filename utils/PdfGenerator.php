<?php
require_once __DIR__ . '/../vendor/autoload.php';

use FPDF;

class PdfGenerator
{
    public static function generateTicket(array $ticket, string $path)
    {
        $pdf = new FPDF();
        $pdf->AddPage();

        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 10, 'Ticket de Match', 0, 1, 'C');

        $pdf->Ln(10);
        $pdf->SetFont('Arial', '', 12);

        $pdf->Cell(0, 8, 'Match : ' . $ticket['titre'], 0, 1);
        $pdf->Cell(0, 8, 'Date : ' . date('d/m/Y H:i', strtotime($ticket['date_event'])), 0, 1);
        $pdf->Cell(0, 8, 'Lieu : ' . $ticket['lieu'], 0, 1);

        $pdf->Ln(5);
        $pdf->Cell(0, 8, 'Catégorie : ' . $ticket['categorie'], 0, 1);
        $pdf->Cell(0, 8, 'Place : ' . $ticket['place'], 0, 1);
        $pdf->Cell(0, 8, 'Numéro : ' . $ticket['numero'], 0, 1);

        $pdf->Output('F', $path);
    }
}
