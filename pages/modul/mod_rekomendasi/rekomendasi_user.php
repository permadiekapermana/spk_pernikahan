<?php
	//Gunakan Koneksi
include "../../../config/koneksi.php";
	//Buat array bobot { C1 = 35%; C2 = 25%; C3 = 25%; dan C4 = 15%.}

$pel="RML.";
$y=substr($pel,0,2);
$query=mysql_query("select * from ramal_history where substr(id_ramal,1,2)='$y' order by id_ramal desc limit 0,1");
$row=mysql_num_rows($query);
$data=mysql_fetch_array($query);
	
if ($row>0){
$no=substr($data['id_ramal'],-3)+1;}
else{
$no=1;
}
$nourut=1000+$no;
$nopel=$pel.substr($nourut,-3);

$aksi="modul/mod_analisis/aksi_analisis.php";	
switch($_GET[act]){
default:

    // mysql_query("DELETE FROM temp ");
	// mysql_query("DELETE FROM temp_produk ");
	

echo"	
<div class='row'>
<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12'>
  <div class='card'>
  <h5 class='card-header'>Rekomendasi Paket Pernikahan</h5>
  
  
			 
	
	<div class='card-body'>
	&nbsp&nbsp&nbsp <a href='modul/mod_laporan/cetak_rekomendasi.php' target='_blank' class='btn btn-primary btn-xs'>Cetak Rekomendasi</a> <br>
		<table class='table'>
		<thead>
			<tr>
				<th scope='col>No.</th>
				<th scope='col>No.</th>
				<th scope='col'>ID Paket</th>
				<th scope='col'>Gambar</th>
				<th scope='col'>Paket</th>
				<th>Nilai</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>";
		$tampil = mysql_query("SELECT
		Sum(`nilai_paket`.`nilai`) AS `total_nilai`,
		`nilai_paket`.`id_paket`,
		`paket`.`nama_paket`,
		`paket`.`gambar`
	  FROM
		`nilai_paket`
		INNER JOIN `paket` ON `nilai_paket`.`id_paket` = `paket`.`id_paket`
	  GROUP BY
		`nilai_paket`.`id_paket`,
		`paket`.`nama_paket`,
		`paket`.`gambar`
	  ORDER BY
		`total_nilai` DESC");  
		$no = 1;
		while($r=mysql_fetch_array($tampil)){
		echo"
			<tr>
				<th scope='row'>$no</th>
				<td>$r[id_paket]</td>
				<td><img src='upload/paket/$r[gambar]' border='3' height='100' width='100'></img></td>
				<td>$r[nama_paket]</td>";
				$tampil2 = mysql_query("SELECT
				SUM(`nilai_paket`.`nilai`) AS total_nilai,
				`nilai_paket`.`id_paket`
			  	FROM
				`nilai_paket` WHERE id_paket='$r[id_paket]' GROUP BY id_paket"); 
  
     
			while($r2=mysql_fetch_array($tampil2)){				
				echo"
				<td>";echo round($r2['total_nilai'],4); "</td>";
				echo"<td>
				<form method='POST' action='modul/mod_laporan/cetak_detail.php' target='_blank'  enctype='multipart/form-data'>
				<input type='hidden' name='id' value='$r[id_paket]' class='form-control' >
				<button class='btn btn-success btn-xs' type='submit'><i class='fa fa-print'></i> Cetak</button></p>
				</form>
				</td>";
				}				
				$no++;
				}
				echo "
			</tr>				
		</tbody>
	</table>	
	</div>

  </div>
</div>
</div>";
	
	break;

}
?>