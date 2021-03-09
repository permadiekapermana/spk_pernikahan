<?php
session_start();
error_reporting(0);
include "../../../config/koneksi.php";
include "../../../config/fungsi_seo.php";

$module=$_GET[module];
$act=$_GET[act];

// Hapus nilai
if ($module=='nilai' AND $act=='hapus'){
  
  mysql_query("DELETE FROM nilai WHERE id_paket=$_GET[id]");
  header('location:../../media.php?module='.$module);
}

// Input nilai
elseif ($module=='nilai' AND $act=='input'){

$pel="RSLT.";
$y=substr($pel,0,4);
$query=mysql_query("SELECT * FROM nilai WHERE substr(id_nilai,1,4)='$y' ORDER BY id_nilai desc limit 0,1");
$row=mysql_num_rows($query);
$data=mysql_fetch_array($query);
if ($row>0){
$no=substr($data['id_nilai'],-6)+1;}
else{
$no=1;
}
$nourut=1000000+$no;
$nopel=$pel.substr($nourut,-6);

$id_nilai     = $nopel;
$jml          = count($_POST[id_kriteria]);
$id_paket     = $_POST[id_paket];
$id_kriteria  = $_POST[id_kriteria];
$nilai        = $_POST[nilai];

for ($i=0; $i < $jml; $i++){
  mysql_query("INSERT INTO nilai(id_paket, id_kriteria, nilai) VALUES('$id_paket[$i]', '$id_kriteria[$i]', '$nilai[$i]')");
  header('location:../../media.php?module='.$module);
}

}

// Update nilai
elseif ($module=='nilai' AND $act=='update'){

  $jml2          = count($_POST[id_kriteria]);
  $id_paket     = $_POST[id_paket];
  $id_kriteria  = $_POST[id_kriteria];
  $nilai        = $_POST[nilai];

  for ($j=0; $j < $jml2; $j++){
  mysql_query("UPDATE nilai SET nilai = '$nilai[$j]' WHERE id_paket = '$id_paket[$j]' AND id_kriteria = '$id_kriteria[$j]'");
  header('location:../../media.php?module='.$module);
}


}
?>