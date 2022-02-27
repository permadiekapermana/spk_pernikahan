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
$id=$_POST[id];
$query= "SELECT
`paket`.`id_paket` AS id_paket,
  `produk`.`produk` AS produk,
  `produk`.`deskripsi` AS desproduk,
  `produk`.`harga` AS harga_produk,
  `paket`.`nama_paket` AS nama_paket,
  `paket`.`deskripsi` AS `despaket`,
  `paket`.`harga` AS `harga_paket`,
  `kategori`.`kategori`
FROM
`paket`
INNER JOIN `detail_paket` ON `paket`.`id_paket` = `detail_paket`.`id_paket`
INNER JOIN `produk` ON `detail_paket`.`id_produk` = `produk`.`id_produk`
  INNER JOIN `kategori` ON `produk`.`id_kategori` = `kategori`.`id_kategori`
WHERE
`paket`.`id_paket` = '$id'
GROUP BY
`detail_paket`.`id_detail`";
		
if (!empty($query))
	  {
	  
	  $baca= mysql_query($query);
	$r    = mysql_fetch_array($baca);
		

	$pdf=new FPDF('P','cm','Legal');
	$pdf->Open();
	$pdf->AddPage();
	$pdf->SetMargins(1,3,1);
	$pdf->SetAutoPageBreak(true,3);
	$pdf->SetFont('Times','B',14);
	$pdf->Image("images/favicon.jpg",2,1,3,'L');
	$pdf->SetFont('Times','B',8);
	$pdf->Ln();
	$pdf->Cell(0,.6,' ',0,0,'C');
	$pdf->SetFont('Times','B',16);
	$pdf->Ln();
	$pdf->Cell(0,.6,'Beauty and Sparkling',0,0,'C');
	$pdf->SetFont('Times','B',16);
	$pdf->Cell(0,.6,'',0,0,'C');
	$pdf->Ln();
	$pdf->SetFont('Times','B',16);
	$pdf->Cell(0,.6,'SUMBER AYU SALON',0,0,'C');
	$pdf->Ln();
	$pdf->SetFont('Times','B',12);
	$pdf->Cell(0,.6,'Jl. Raden Dewi Sartika Blok Lingk. Paing No. 23.',0,0,'C');	
	$pdf->Ln();
	$pdf->Cell(0,.6,'Kecamatan Sumber Kabupaten Cirebon, Jawa Barat 45123',0,0,'C');
	$pdf->Ln();
	$pdf->Ln();
	$pdf->Cell(0,.2,'___________________________________________________________________________________',0,0,'C');
	$pdf->Ln();
		$pdf->Cell(0,.2,'___________________________________________________________________________________',0,0,'C');
	
	$x=$pdf->GetY();
	$pdf->SetY($x+2);
	$pdf->SetFont('Times','B',14);
	$pdf->Cell(2,1,'',2,0,'L');
	$pdf->Cell(3,1,'A. DATA PAKET',2,0,'L');
	$pdf->Ln();
	$pdf->SetFont('Times','',12);
	
		$pdf->Cell(2,1,'',2,0,'L');
		$pdf->Cell(3,1,'Kode Paket  ',2,0,'L');
		$pdf->Cell(2,1,':',2,0,'C');
		$pdf->Cell(3,1,$r['id_paket'],2,0,'L');
		$pdf->Ln();
		$pdf->Cell(2,1,'',2,0,'L');
		$pdf->Cell(3,1,'Nama Paket ',2,0,'L');
		$pdf->Cell(2,1,':',2,0,'C');
		$pdf->Cell(3,1,$r['nama_paket'],2,0,'L');
		$pdf->Ln();
		$pdf->Cell(2,1,'',2,0,'L');
		$pdf->Cell(3,1,'Deskripsi Paket  ',0,0,'L');
		$pdf->Cell(2,1,':',2,0,'C');
		$pdf->Cell(3,1,$r['despaket'],2,0,'L');
		$pdf->Ln();
		$pdf->Cell(2,1,'',2,0,'L');
		$pdf->Cell(3,1,'Harga Paket  ',2,0,'L');
		$pdf->Cell(2,1,':',2,0,'C');

        $harga_paket = number_format($r['harga_paket'],0,",",".");
		$pdf->Cell(3,1,'Rp '.$harga_paket.'',2,0,'L');
		$pdf->Ln();
		$pdf->Cell(2,1,'',2,0,'L');
		$pdf->Cell(3,1,'Cashback  ',2,0,'L');
		$pdf->Cell(2,1,':',2,0,'C');

		$cashback = "SELECT
		`nilai`.`nilai`,
		`paket`.`id_paket`,
		`kriteria`.`kriteria`,
		`sub_kriteria`.`keterangan`
	  FROM
		`nilai`
		INNER JOIN `paket` ON `nilai`.`id_paket` = `paket`.`id_paket`
		INNER JOIN `kriteria` ON `nilai`.`id_kriteria` = `kriteria`.`id_kriteria`,
		`sub_kriteria`
	  WHERE
		`paket`.`id_paket` = '$id' AND
		`kriteria`.`kriteria` = 'Cashback (%)' AND sub_kriteria.id_kriteria='KRIT.000003' AND nilai.nilai=sub_kriteria.nilai GROUP BY nilai.id_paket";
		$cbs= mysql_query($cashback);
		$cb    = mysql_fetch_array($cbs);

		$harga     = $r['harga_paket'];
		$diskon    = $cb['keterangan'];
		$nilai     = ($diskon/100)*$harga;
		$total_harga = $r['harga_paket']-$nilai;


        $cashback = number_format($nilai,0,",",".");

		$pdf->Cell(3,1,'Rp '.$cashback.'',2,0,'L');
		$pdf->Ln();
		$pdf->Cell(2,1,'',2,0,'L');
		$pdf->Cell(3,1,'Harga Setelah Cashback  ',2,0,'L');
		$pdf->Cell(2,1,':',2,0,'C');

		$after_cashback = number_format($total_harga,0,",",".");

		$pdf->Cell(3,1,'Rp '.$after_cashback.'',2,0,'L');
		$pdf->Ln();
		$pdf->Ln();

		$pdf->SetFont('Times','B',14);
	$pdf->Cell(2,1,'',2,0,'L');
	$pdf->Cell(3,1,'B. DETAIL PAKET',2,0,'L');
	$pdf->Ln();
	$pdf->SetFont('Times','',12);
	if (mysql_num_rows ($baca)>0){
		$x=$pdf->GetY();
		$pdf->SetY($x+1);
	
		$pdf->SetFont('Arial','B',12);
		//$pdf->Cell(2.2,1,'Kode buku',1,0,'C');
		$pdf->Cell(2,1,'No.',1,0,'C');
		$pdf->Cell(6,1,'Kategori',1,0,'C');
		$pdf->Cell(6,1,'Nama Produk',1,0,'C');
		$pdf->Cell(6,1,'Harga Produk',1,0,'C');
	
	
	
		$pdf->Ln();
		
		
	while ($hasil=mysql_fetch_array($baca))
	{
		$no++;
	
		
        $harga_produk = "Rp. " . number_format($hasil['harga_produk'],0,",",".");
		
		 $pdf->SetFont('Arial','',12);
		//$pdf->Cell(2.2,1,$hasil[kode_buku],1,0,'C');
		$pdf->Cell(2,1,$no.'.',1,0,'C');
		$pdf->Cell(6,1,$hasil['kategori'],1,0,'L');
		$pdf->Cell(6,1,$hasil['produk'],1,0,'L');
		$pdf->Cell(6,1,$harga_produk,1,0,'L');
	
		$pdf->Ln();
		
		}
	}
		
	}
	$pdf->Output();
	}
?>