<?php
session_start();
error_reporting(0);
include "../../../config/koneksi.php";
include "../../../config/fungsi_seo.php";

$module=$_GET[module];
$act=$_GET[act];

// Hapus bobot
if ($module=='bobot' AND $act=='hapus'){
  mysql_query("DELETE FROM bobot WHERE id_bobot='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}

// Input bobot
elseif ($module=='bobot' AND $act=='input'){

  mysql_query("INSERT INTO bobot(id_bobot, id_kriteria, bobot) VALUES('$_POST[id_bobot]', '$_POST[id_kriteria]', '$_POST[bobot]')");
  header('location:../../media.php?module='.$module);

}

// Update bobot
elseif ($module=='bobot' AND $act=='update'){

  mysql_query("UPDATE bobot SET id_kriteria = '$_POST[id_kriteria]', bobot = '$_POST[bobot]' WHERE id_bobot = '$_POST[id]'");
  header('location:../../media.php?module='.$module);

}
?>
