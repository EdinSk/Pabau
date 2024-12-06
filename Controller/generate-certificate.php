<?php
require_once __DIR__ . '/../libs/fpdf.php';  // Include the FPDF library

// Function to generate PDF certificate
class CertificatePDF extends FPDF {
    function Header() {
        $this->SetFont('Arial', 'B', 20);
        $this->SetFillColor(135, 206, 250);
        $this->Cell(0, 20, 'Employee Recognition Certificate', 0, 1, 'C', true);
        $this->Ln(10);
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Generated on: ' . date('Y-m-d'), 0, 0, 'C');
    }

    function ChapterTitle($category, $name, $total_votes) {
        $this->SetFont('Arial', 'B', 16);
        $this->SetTextColor(0, 102, 204);
        $this->Cell(0, 10, "Winner of '$category':", 0, 1, 'C');
        $this->SetFont('Arial', 'B', 18);
        $this->Cell(0, 10, $name, 0, 1, 'C');
        $this->SetFont('Arial', '', 14);
        $this->Cell(0, 10, "Total Votes: $total_votes", 0, 1, 'C');
        $this->Ln(10);
    }

    function ChapterBody($text) {
        $this->SetFont('Arial', '', 12);
        $this->SetTextColor(0, 0, 0);
        $this->MultiCell(0, 10, $text);
    }

    function DecorativeLine() {
        $this->SetDrawColor(0, 102, 204);
        $this->Line(10, $this->GetY(), 200, $this->GetY());
        $this->Ln(10);
    }
}

// Check if form is submitted via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Fetch data from POST
    $category_name = $_POST['category_name'];
    $winner_name = $_POST['winner_name'];
    $total_votes = $_POST['total_votes'];  // Get the total votes from POST

    // Placeholder certificate text
    $certificate_text = "Congratulations on being recognized as a top performer in the '$category_name' category. Your dedication and hard work are truly appreciated!";

    // Create and output the PDF certificate
    $pdf = new CertificatePDF();
    $pdf->AddPage();
    $pdf->ChapterTitle($category_name, $winner_name, $total_votes);
    $pdf->DecorativeLine();
    $pdf->ChapterBody($certificate_text);
    $pdf->Output('D', 'certificate_' . $winner_name . '.pdf');
} else {
    echo "Invalid request method.";
}
?>
