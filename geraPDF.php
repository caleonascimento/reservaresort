<?php 
require "vendor/autoload.php";

use Fpdf\Fpdf;

$oPdf = new Fpdf();

class PDF extends FPDF {
    // Page header
    function Header()
    {
        // Logo
        $this->Image('img/logo-salinas-resort.png',10,6,30);
        // Arial bold 15
        $this->SetFont('Arial','B',15);
        // Move to the right
        $this->Cell(80);
        // Title
        $this->Cell(30,10,'Titulo',1,0,'C');
        // Line break
        $this->Ln(30);
    }

    // Page footer
    function Footer()
    {
        // Logo
        $this->Image('img/logo_foot_sm.png', 10, 270, 50);
        $this->SetY(-30);
        $this->SetLeftMargin(100);
        $this->MultiCell(0,5, utf8_decode("Atendimento\n 0800 300 6565 resers@gfphoteis.com.br\n Segunda a sexta-feira: 8h às 18h às 12h\n"), 1);
        $this->SetLeftMargin(0);
        // Position at 1.5 cm from bottom
        $this->SetY(-9);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Page number
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
}


$sMainText = "Eu, XXXXXXX XXXXX XXXXXX XXXXXXXXX XX XXXXXXXX, ". "inscrito no CPF: XXX.XXX.XXX-XX e no RG: XXXXXXX,".
        " proprietário da unidade XXXXXXXXXXXXXX, cota XXXXXXXXXXXXXXXX \n" . 
        "Autorizo o Sr(a). XXXXXXXXX XX XXXXXXXX XXXXXX XXXXXXXXX XXXXXX, inscrito no CPF: XXX.XXX.XXX-XX e no RG: XXXXXXX, ". 
        "Endereço: XX. XXXXXXXXXXXXXX XXXXXXX XXXXXXXXXXX XXXXXXXXXXXXX \n". 
        "CEP: 00000-000 Telefone: (XX) XXXXX-XXXX e-mail: XXXXXXXXXXXXX@email.com.br, de minha semana no período de".
        " XX/XX/XXXX a XX/XX/XXXX, com os seguintes acompanhantes.\n";

//TODO: Listar tipos de unidades do empreendimento
$sMainText .= "(XX) Apartamento 1 quarto - acomodação máxima (4 pessoas)\n";
$sMainText .= "(XX) Apartamento 2 quarto - acomodação máxima (7 pessoas)\n";
$sMainText .= "\n";

$sMainText .= "Acompanhante (1): XXXXXXXXXXX XX XXXXXX XXXXXXXXXXXXXXXXX XXXXXXXX Idade: XX inscrito no CPF: XXX.XXX.XXX-XX\n";
$sMainText .= "Acompanhante (2): XXXXXXXXXXX XX XXXXXX XXXXXXXXXXXXXXXXX XXXXXXXX Idade: XX inscrito no CPF: XXX.XXX.XXX-XX\n";
$sMainText .= "Acompanhante (3): XXXXXXXXXXX XX XXXXXX XXXXXXXXXXXXXXXXX XXXXXXXX Idade: XX inscrito no CPF: XXX.XXX.XXX-XX\n";
$sMainText .= "Acompanhante (4): XXXXXXXXXXX XX XXXXXX XXXXXXXXXXXXXXXXX XXXXXXXX Idade: XX inscrito no CPF: XXX.XXX.XXX-XX\n";
$sMainText .= "Acompanhante (5): XXXXXXXXXXX XX XXXXXX XXXXXXXXXXXXXXXXX XXXXXXXX Idade: XX inscrito no CPF: XXX.XXX.XXX-XX\n";

$sTermoAceite = "Estou ciente e me responsabilizo por qualquer dano material no período de locação indicado por mim neste " . 
                "formulário. Assinatura reconhecida em cartório ou envio da carta devidamente preenchida junto a um " .
                "documento com foto do proprietário.";

$sAssinatura = "\n_______________________________________________________________\n" . 
               "Assinatura do(a) Proprietário(a)\n" . 
               "Belém PA, XX de XXXXXXXXXXX de 20XX";  


// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);


$pdf->cell(0,10,utf8_decode("CARTA DE AUTORIZAÇÃO PARA UTILIZAÇÃO DE TERCEIROS"), 1, 1, 'C');
$pdf->Ln();
$pdf->MultiCell(0,7, utf8_decode($sMainText), 1);
$pdf->Ln();
$pdf->MultiCell(0,5, utf8_decode($sTermoAceite), 1);
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->MultiCell(0,5, utf8_decode($sAssinatura), 1,'C');
$pdf->Output();
?>