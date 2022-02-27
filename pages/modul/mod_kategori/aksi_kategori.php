<?php
session_start();
error_reporting(0);
include "../../../config/koneksi.php";
include "../../../config/fungsi_seo.php";

$module=$_GET[module];
$act=$_GET[act];

// Hapus kategori
if ($module=='kategori' AND $act=='hapus'){
  mysql_query("DELETE FROM kategori WHERE id_kategori='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}

// Input kategori
elseif ($module=='kategori' AND $act=='input'){

  mysql_query("INSERT INTO kategori(id_kategori, kategori) VALUES('$_POST[id_kategori]',  '$_POST[kategori]')");
  header('location:../../media.php?module='.$module);

}

// Update kategori
elseif ($module=='kategori' AND $act=='update'){

  mysql_query("UPDATE kategori SET  kategori = '$_POST[kategori]' WHERE id_kategori = '$_POST[id]'");
  header('location:../../media.php?module='.$module);

}
?>
