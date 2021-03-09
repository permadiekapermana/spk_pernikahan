<?php
error_reporting(0);
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{

include "class.ezpdf.php";
include "../../../config/koneksi.php";
include "../../../config/library.php";
include "rupiah.php";
define('FPDF_FONTPATH','font/');
require('fpdf_protection.php');


	$query= "SELECT
	Sum(`nilai_paket`.`nilai`) AS `total_nilai`,
	`nilai_paket`.`id_paket`,
	`paket`.`nama_paket`
  FROM
	`nilai_paket`
	INNER JOIN `paket` ON `nilai_paket`.`id_paket` = `paket`.`id_paket`
  GROUP BY
	`nilai_paket`.`id_paket`,
	`paket`.`nama_paket`
  ORDER BY
	`total_nilai` DESC";
	
if (!empty($query))
	  {
	  
	  $baca= mysql_query($query);
	

	$pdf=new FPDF('L','cm','Legal');
	$pdf->Open();
	$pdf->AddPage();
	$pdf->SetMargins(1,3,1);
	$pdf->SetAutoPageBreak(true,3);
	$pdf->SetFont('Arial','B',14);
	$pdf->Image("images/favicon.jpg",7,1,3,'L');
	$pdf->SetFont('Arial','B',16);
	$pdf->Ln();
	$pdf->Cell(0,.6,'Beauty and Sparkling',0,0,'C');
	$pdf->Ln();
	$pdf->SetFont('Arial','B',14);
	$pdf->Cell(0,.6,'SUMBER AYU SALON',0,0,'C');
	$pdf->Ln();
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(0,.6,'Jl. Raden Dewi Sartika Blok Lingk. Paing No. 23.',0,0,'C');
	$pdf->Ln();
	$pdf->Cell(0,.6,'Kecamatan Sumber Kabupaten Cirebon, Jawa Barat 45123',0,0,'C');	
	$pdf->Ln();
	$pdf->Ln();
	$pdf->Ln();
	$pdf->Cell(0,.2,'_______________________________________________________________________________________________________________________________________',0,0,'C');
	$pdf->Ln();
		$pdf->Cell(0,.2,'_______________________________________________________________________________________________________________________________________',0,0,'C');
	$x=$pdf->GetY();
	$pdf->SetY($x+1);
	$pdf->Cell(0,1,'Rekomendasi Paket Pernikahan Untuk Anda Dari Kami',0,0,'C');


		if (mysql_num_rows ($baca)>0){
	$x=$pdf->GetY();
	$pdf->SetY($x+1);

	$pdf->SetFont('Arial','B',12);
	//$pdf->Cell(2.2,1,'Kode buku',1,0,'C');
	$pdf->Cell(2,1,'No.',1,0,'C');
	$pdf->Cell(6,1,'ID Paket',1,0,'C');
	$pdf->Cell(12,1,'Nama Paket',1,0,'C');
	$pdf->Cell(6,1,'Nilai',1,0,'C');



	$pdf->Ln();
	
	
while ($hasil=mysql_fetch_array($baca))
{
	$no++;

	
	
	 $pdf->SetFont('Arial','',12);
	//$pdf->Cell(2.2,1,$hasil[kode_buku],1,0,'C');
	$pdf->Cell(2,1,$no.'.',1,0,'C');
	$pdf->Cell(6,1,$hasil['id_paket'],1,0,'L');
	$pdf->Cell(12,1,$hasil['nama_paket'],1,0,'L');
	$pdf->Cell(6,1,$hasil['total_nilai'],1,0,'L');

	$pdf->Ln();
	
	}
	
	
	}
	$pdf->Output();
	}}
?>
