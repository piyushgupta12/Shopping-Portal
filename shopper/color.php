<?php
require 'connect.php';
require('fpdf.php');
?>
<?php
if(!isset($_SESSION['id'])||!isset($_SESSION['type'])){
header('Location:login.php');
}else if($_SESSION['type']=='admin'){
header('Location:portal.php');
}
?>
<?php
class PDF extends FPDF
{
function Header()
{
    global $title;
$this->Image('wms.jpg',10,6,30);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Calculate width of title and position
    $w = $this->GetStringWidth($title)+6;
    $this->SetX((210-$w)/2);
    // Colors of frame, background and text
    $this->SetDrawColor(0,80,180);
    $this->SetFillColor(230,230,0);
    $this->SetTextColor(220,50,50);
    // Thickness of frame (1 mm)
    $this->SetLineWidth(1);
    // Title
    $this->Cell($w,9,$title,1,1,'C',true);
    // Line break
    $this->Ln(10);
}

function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Text color in gray
    $this->SetTextColor(128);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
}

function ChapterTitle($num, $label)
{
    // Arial 12
    $this->SetFont('Arial','B',12);
    // Background color
    $this->SetFillColor(200,220,255);
    // Title
    $this->Cell(0,6,"$label",0,1,'L',true);
    // Line break
    $this->Ln(4);
}

function ChapterBody($file)
{
    // Read text file
    $txt = file_get_contents($file);
    // Times 12
    $this->SetFont('Times','B',12);
    // Output justified text
    $this->MultiCell(0,5,$txt);
    // Line break
    $this->Ln();
    // Mention in italics
    $this->SetFont('','I');
   
}

function PrintChapter($num, $title, $file)
{
    $this->ChapterTitle($num,$title);
    $this->ChapterBody($file);
}
    
    function LoadData($file)
{
    // Read file lines
    $lines = file($file);
    $data = array();
    foreach($lines as $line)
        $data[] = explode(';',trim($line));
    return $data;
}

// Simple table
function BasicTable($header, $data)
{
    // Header
    foreach($header as $col)
        $this->Cell(40,7,$col,1);
    $this->Ln();
    // Data
    foreach($data as $row)
    {
        foreach($row as $col)
            $this->Cell(40,6,$col,1);
        $this->Ln();
    }
}
    function ImprovedTable($header, $data)
{
    // Column widths
    $w = array(35, 35, 35, 35,35);
    // Header
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],7,$header[$i],1,0,'C');
    $this->Ln();
        $this->setFont('Arial','',12);
    // Data
    foreach($data as $row)
    {
        $this->Cell($w[0],6,$row[0],'LR',0,'C');
        $this->Cell($w[1],6,$row[1],'LR',0,'C');
        $this->Cell($w[2],6,$row[2],'LR',0,'C');
        $this->Cell($w[3],6,$row[3],'LR',0,'R');
        $this->Cell($w[4],6,$row[4],'LR',0,'R');
        $this->Ln();
    }
    // Closing line
    $this->Cell(array_sum($w),0,'','T');
}
    
    function FancyTable($header, $data)
{
    // Colors, line width and bold font
    $this->SetFillColor(255,0,0);
    $this->SetTextColor(255);
    $this->SetDrawColor(128,0,0);
    $this->SetLineWidth(.3);
    $this->SetFont('','B');
    // Header
    $w = array(40, 35, 40, 45);
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
    $this->Ln();
    // Color and font restoration
    $this->SetFillColor(224,235,255);
    $this->SetTextColor(0);
    $this->SetFont('');
    // Data
    $fill = false;
    foreach($data as $row)
    {
        $this->Cell($w[0],6,$row[0],'LR',0,'L',$fill);
        $this->Cell($w[1],6,$row[1],'LR',0,'L',$fill);
        $this->Cell($w[2],6,$row[2],'LR',0,'R',$fill);
        $this->Cell($w[3],6,$row[3],'LR',0,'R',$fill);
        $this->Ln();
        $fill = !$fill;
    }
    // Closing line
    $this->Cell(array_sum($w),0,'','T');
}
    
}

$pdf = new PDF();
$title = 'INVOICE STATEMENT';
$pdf->SetTitle($title);
$pdf->SetAuthor('Jules Verne');
$pdf->AddPage();
$pdf->PrintChapter(1,'WeMakeScholars.com Customer Care : 1800 800 1800 || cs@wms.com','address.txt');

$header = array('Item', 'ProductId', 'Price','Quantity', 'Subtotal');

$data = $pdf->LoadData('bill.txt');
$pdf->SetFont('Arial','B',14);
//$pdf->FancyTable($header,$data);
//$pdf->Ln(10);
$pdf->ImprovedTable($header,$data);
$pdf->Ln(10);
$pdf->Output();

?>