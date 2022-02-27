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
mysql_query("DELETE FROM temp_nilaiuser ");

    // mysql_query("DELETE FROM temp ");
	// mysql_query("DELETE FROM temp_produk ");
	

	echo"	
	<div class='row'>
	<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12'>
	  <div class='card'>
	  <h5 class='card-header'>Perhitungan Pemilihan Paket Pernikahan</h5>
		<div class='card-body'>
		<form method='POST' action='$aksi?module=analisis&act=input'>";    
	  
		$tampil2=mysql_query("SELECT * FROM kriteria ORDER BY id_kriteria");
		while($r2=mysql_fetch_array($tampil2)){
		echo "
		  <div class='col-md-6'>
			<label for='nama_produk' class='col-form-label'>$r2[kriteria]</label>
			<input id='id_kriteria' value='$r2[id_kriteria]' name='id_kriteria[]' type='hidden' class='form-control'>
			<input id='id_kriteria' value='$_POST[id_paket]' name='id_paket[]' type='hidden' class='form-control'>
			<select class='form-control' name='nilai[]' required>
			  <option value=''>-- Pilih $r2[kriteria] --</option>";
			  $tampil3=mysql_query("SELECT * FROM sub_kriteria WHERE id_kriteria='$r2[id_kriteria]'");
			  while($r3=mysql_fetch_array($tampil3)){
			  echo "<option value=$r3[nilai]>$r3[keterangan]</option>";
			  }
			  echo "
			</select>
		  </div>
		";
		}
			
		echo"   
		<br>
		<div class='col-md-6'>
		<button class='btn btn-primary' type='button' onclick=self.history.back()>Cancel</button>
		<button class='btn btn-primary' type='reset'>Reset</button>
		<button type='submit' class='btn btn-round btn-primary'>Submit</button>
		</div>
		</form>
		</div>
	  </div>
	</div>
	</div>";
		  
break;
case "analisispaket":

mysql_query("DELETE FROM nilai_user WHERE username='$_SESSION[namauser]'");

echo"	
<div class='row'>
<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12'>
  <div class='card'>
  <h5 class='card-header'>Hasil Perhitungan Pemilihan Paket Pernikahan</h5>
	<div class='card-body'>
	<h5 class='card-header'>Bobot Rumus : ";
	$bobots=mysql_query("SELECT `bobot`.`bobot` FROM `bobot`");
	while($bobot=mysql_fetch_array($bobots)){
	echo " $bobot[bobot]";
	}
	echo "<br>
	Bobot Pelanggan : ";
	$tempnilais=mysql_query("SELECT
	*
  FROM
	`temp_nilaiuser`");
	while($t=mysql_fetch_array($tempnilais)){
	echo " $t[nilai]";
	}
	echo "<br>Penilaian Paket</h5>
	<div class='card-body'>
		<table class='table'>
			<thead>
				<tr>
					<th scope='col>No.</th>
					<th scope='col>No.</th>
					<th scope='col'>ID Paket</th>
					<th scope='col'>Paket</th>";
					$tampil = mysql_query("SELECT
					`kriteria`.`kriteria`
					FROM
					`kriteria` ORDER BY id_kriteria ASC");  
					while($r=mysql_fetch_array($tampil)){
					echo"
					<th>$r[kriteria]</th>";
					}
					echo"
				</tr>
			</thead>
			<tbody>";
			$tampil = mysql_query("SELECT * FROM `paket` ORDER BY id_paket DESC");  
			$no = 1;
			while($r=mysql_fetch_array($tampil)){
			echo"
				<tr>
					<th scope='row'>$no</th>
					<td>$r[id_paket]</td>
					<td>$r[nama_paket]</td>";
					$tampil2 = mysql_query("SELECT
					*
				  FROM
					`nilai` WHERE id_paket='$r[id_paket]'");  
					while($r2=mysql_fetch_array($tampil2)){
					echo"
					<td>$r2[nilai]</td>";
					}
					echo"";
					$no++;
					}
					echo "
				</tr>				
			</tbody>
		</table>";		

		
		
	echo "
	</div>
	<h5 class='card-header'>Normalisasi Data</h5>
	<div class='card-body'>
		<table class='table'>
		<thead>
			<tr>
				<th scope='col>No.</th>
				<th scope='col>No.</th>
				<th scope='col'>ID Paket</th>
				<th scope='col'>Paket</th>";
				$tampil = mysql_query("SELECT
				`kriteria`.`kriteria`
				FROM
				`kriteria` ORDER BY id_kriteria ASC");  
				$no = 1;
				while($r=mysql_fetch_array($tampil)){
				echo"
				<th>$r[kriteria]</th>";
				}
				echo"
			</tr>
		</thead>
		<tbody>";
		$tampil = mysql_query("SELECT * FROM `paket` ORDER BY id_paket DESC");  
		$no = 1;
		while($r=mysql_fetch_array($tampil)){
		echo"
			<tr>
				<th scope='row'>$no</th>
				<td>$r[id_paket]</td>
				<td>$r[nama_paket]</td>";
				$tampil2 = mysql_query("SELECT
				`kriteria`.`id_kriteria` AS id_kriteria,
				`nilai`.`id_paket`,
				`nilai`.`nilai`,
				Max(`nilai`.`nilai`),
				`kriteria`.`attribut`,
				`kriteria`.`kriteria`
			 	FROM
				`nilai`
				INNER JOIN `kriteria` ON `nilai`.`id_kriteria` = `kriteria`.`id_kriteria` WHERE id_paket='$r[id_paket]'
				GROUP BY
				`nilai`.`id_paket`,
				`kriteria`.`kriteria` ORDER by id_paket, id_kriteria"); 
  
     
				while($r2=mysql_fetch_array($tampil2)){
				$carimax = mysql_query("SELECT
				`nilai`.`id_paket`,
				`nilai`.`id_kriteria`,
				MAX(`nilai`.`nilai`) AS nilai_max,
				`kriteria`.`attribut` AS attribut
				FROM
				`nilai`
				INNER JOIN `kriteria` ON `nilai`.`id_kriteria` = `kriteria`.`id_kriteria` WHERE nilai.id_kriteria = '$r2[id_kriteria]' GROUP BY id_kriteria  ORDER by id_kriteria ASC");
				$max = mysql_fetch_array($carimax);
				$carimin = mysql_query("SELECT
				`nilai`.`id_paket`,
				`nilai`.`id_kriteria`,
				MIN(`nilai`.`nilai`) AS nilai_min,
				`kriteria`.`attribut` AS attribut
				FROM
				`nilai`
				INNER JOIN `kriteria` ON `nilai`.`id_kriteria` = `kriteria`.`id_kriteria` WHERE nilai.id_kriteria = '$r2[id_kriteria]' GROUP BY id_kriteria  ORDER by id_kriteria ASC");
				$min = mysql_fetch_array($carimin);
				if ($r2['attribut']=='Cost'){			
				echo"
				<td>";echo round($min['nilai_min']/$r2['nilai'],4); "</td>";
				}
				else {
					echo"
					<td>";echo round($r2['nilai']/$max['nilai_max'],4); "</td>";
				}
				}				
				$no++;
				}
				echo "
			</tr>				
		</tbody>
	</table>	
	</div>

	";
		$tampil = mysql_query("SELECT * FROM `paket` ORDER BY id_paket DESC");  
		$no = 1;
		while($r=mysql_fetch_array($tampil)){
		
				$tampil2 = mysql_query("SELECT
				`kriteria`.`id_kriteria` AS id_kriteria,
				`nilai`.`id_paket`,
				`nilai`.`nilai`,
				Max(`nilai`.`nilai`),
				`kriteria`.`attribut`,
				`kriteria`.`kriteria`
			 	FROM
				`nilai`
				INNER JOIN `kriteria` ON `nilai`.`id_kriteria` = `kriteria`.`id_kriteria` WHERE id_paket='$r[id_paket]'
				GROUP BY
				`nilai`.`id_paket`,
				`kriteria`.`kriteria` ORDER by id_paket, id_kriteria"); 
  
				while($r2=mysql_fetch_array($tampil2)){
				$carimax = mysql_query("SELECT
				`nilai`.`id_paket`,
				`nilai`.`id_kriteria`,
				MAX(`nilai`.`nilai`) AS nilai_max
				FROM
				`nilai`
				INNER JOIN `kriteria` ON `nilai`.`id_kriteria` = `kriteria`.`id_kriteria` WHERE nilai.id_kriteria = '$r2[id_kriteria]' GROUP BY id_kriteria  ORDER by id_kriteria ASC");
				$max = mysql_fetch_array($carimax);
				$carimin = mysql_query("SELECT
				`nilai`.`id_paket`,
				`nilai`.`id_kriteria`,
				MIN(`nilai`.`nilai`) AS nilai_min,
				`kriteria`.`attribut` AS attribut
				FROM
				`nilai`
				INNER JOIN `kriteria` ON `nilai`.`id_kriteria` = `kriteria`.`id_kriteria` WHERE nilai.id_kriteria = '$r2[id_kriteria]' GROUP BY id_kriteria  ORDER by id_kriteria ASC");
				$min = mysql_fetch_array($carimin);
				$bobots=mysql_query("SELECT * FROM `bobot` WHERE id_kriteria = '$r2[id_kriteria]'");
				$bobot = mysql_fetch_array($bobots);
				$tempnilais=mysql_query("SELECT
				* FROM `temp_nilaiuser`");
				$t=mysql_fetch_array($tempnilais);
				
				if ($r2['attribut']=='Cost'){
				
					$hasil1= round(($min['nilai_min']/$r2['nilai'])*($bobot['bobot']*$t['nilai']),4);
					$query=mysql_query("INSERT INTO nilai_user (id_paket, nilai, username) 
				  values ('$r2[id_paket]','$hasil1', '$_SESSION[namauser]')");
				}
				elseif ($r2['attribut']!='Cost'){
					$hasil2= round(($r2['nilai']/$max['nilai_max'])*($bobot['bobot']*$t['nilai']),4);
					$query=mysql_query("INSERT INTO nilai_user (id_paket, nilai, username) 
				  values ('$r2[id_paket]','$hasil2', '$_SESSION[namauser]')");
				}
				

				
				
				
				
				}
				
				$no++;
				}
				echo "
			 <br>
	
	<h5 class='card-header'>Rekomendasi Paket Pernikahan Menurut Kriteria Pelanggan</h5>	
	<br> &nbsp&nbsp&nbsp <a href='modul/mod_laporan/cetak_rekomendasi_user.php' target='_blank' class='btn btn-primary btn-xs'>Cetak Rekomendasi</a>
	<div class='card-body'>
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
		Sum(`nilai_user`.`nilai`) AS `total_nilai`,
		`nilai_user`.`id_paket`,
		`paket`.`nama_paket`,
		`paket`.`gambar`
	  FROM
		`nilai_user`
		INNER JOIN `paket` ON `nilai_user`.`id_paket` = `paket`.`id_paket`
	  GROUP BY
		`nilai_user`.`id_paket`,
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
				SUM(`nilai_user`.`nilai`) AS total_nilai,
				`nilai_user`.`id_paket`
			  	FROM
				`nilai_user` WHERE id_paket='$r[id_paket]' GROUP BY id_paket"); 
  
     
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

	<br>
	</div>
  </div>
</div>
</div>";
	
break;

case "lihatrekomendasi":

	echo"	
	<div class='row'>
	<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12'>
	  <div class='card'>
	  <h5 class='card-header'>Hasil Perhitungan Pemilihan Paket Pernikahan</h5>
		<div class='card-body'>
		<h5 class='card-header'>Bobot Rumus : ";
		$bobots=mysql_query("SELECT `bobot`.`bobot` FROM `bobot`");
		while($bobot=mysql_fetch_array($bobots)){
		echo " $bobot[bobot]";
		}
		echo "<br>Penilaian Paket</h5>
		<div class='card-body'>
			<table class='table'>
				<thead>
					<tr>
						<th scope='col>No.</th>
						<th scope='col>No.</th>
						<th scope='col'>ID Paket</th>
						<th scope='col'>Paket</th>";
						$tampil = mysql_query("SELECT
						`kriteria`.`kriteria`
						FROM
						`kriteria` ORDER BY id_kriteria ASC");  
						$no = 1;
						while($r=mysql_fetch_array($tampil)){
						echo"
						<th>$r[kriteria]</th>";
						}
						echo"
					</tr>
				</thead>
				<tbody>";
				$tampil = mysql_query("SELECT * FROM `paket` ORDER BY id_paket DESC");  
				$no = 1;
				while($r=mysql_fetch_array($tampil)){
				echo"
					<tr>
						<th scope='row'>$no</th>
						<td>$r[id_paket]</td>
						<td>$r[nama_paket]</td>";
						$tampil2 = mysql_query("SELECT
						*
					  FROM
						`nilai` WHERE id_paket='$r[id_paket]'");  
						$no = 1;
						while($r2=mysql_fetch_array($tampil2)){
						echo"
						<td>$r2[nilai]</td>";
						}
						echo"";
						$no++;
						}
						echo "
					</tr>				
				</tbody>
			</table>";		
	
			
			
		echo "
		</div>
		<h5 class='card-header'>Normalisasi Data</h5>
		<div class='card-body'>
			<table class='table'>
			<thead>
				<tr>
					<th scope='col>No.</th>
					<th scope='col>No.</th>
					<th scope='col'>ID Paket</th>
					<th scope='col'>Paket</th>";
					$tampil = mysql_query("SELECT
					`kriteria`.`kriteria`
					FROM
					`kriteria` ORDER BY id_kriteria ASC");  
					$no = 1;
					while($r=mysql_fetch_array($tampil)){
					echo"
					<th>$r[kriteria]</th>";
					}
					echo"
				</tr>
			</thead>
			<tbody>";
			$tampil = mysql_query("SELECT * FROM `paket` ORDER BY id_paket DESC");  
			$no = 1;
			while($r=mysql_fetch_array($tampil)){
			echo"
				<tr>
					<th scope='row'>$no</th>
					<td>$r[id_paket]</td>
					<td>$r[nama_paket]</td>";
					$tampil2 = mysql_query("SELECT
					`kriteria`.`id_kriteria` AS id_kriteria,
					`nilai`.`id_paket`,
					`nilai`.`nilai`,
					Max(`nilai`.`nilai`),
					`kriteria`.`attribut`,
					`kriteria`.`kriteria`
					 FROM
					`nilai`
					INNER JOIN `kriteria` ON `nilai`.`id_kriteria` = `kriteria`.`id_kriteria` WHERE id_paket='$r[id_paket]'
					GROUP BY
					`nilai`.`id_paket`,
					`kriteria`.`kriteria` ORDER by id_paket, id_kriteria"); 
	  
		 
					$no = 1;
					while($r2=mysql_fetch_array($tampil2)){
					$carimax = mysql_query("SELECT
					`nilai`.`id_paket`,
					`nilai`.`id_kriteria`,
					MAX(`nilai`.`nilai`) AS nilai_max
					FROM
					`nilai`
					INNER JOIN `kriteria` ON `nilai`.`id_kriteria` = `kriteria`.`id_kriteria` WHERE nilai.id_kriteria = '$r2[id_kriteria]' GROUP BY id_kriteria  ORDER by id_kriteria ASC");
					$max = mysql_fetch_array($carimax);
					echo"
					<td>";echo round($r2['nilai']/$max['nilai_max'],4); "</td>";
					}				
					$no++;
					}
					echo "
				</tr>				
			</tbody>
		</table> <br>
		<p class='text-muted font-13 m-b-30'>
		<a href='?module=hasil&act=lihatrekomendasi' class='btn btn-success btn-xs'>Lihat Rekomendasi Paket</a></p>
		</div>
		</div>
	  </div>
	</div>
	</div>";
		
	break;

}
?>