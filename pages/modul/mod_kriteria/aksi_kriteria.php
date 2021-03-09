<?php
session_start();
error_reporting(0);
include "../../../config/koneksi.php";
include "../../../config/fungsi_seo.php";

$module=$_GET[module];
$act=$_GET[act];

// Hapus kriteria
if ($module=='kriteria' AND $act=='hapus'){
  mysql_query("DELETE FROM kriteria WHERE id_kriteria='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}

elseif ($module=='kriteria' AND $act=='hapussub'){
  mysql_query("DELETE FROM sub_kriteria WHERE id_sub='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}

// Input kriteria
elseif ($module=='kriteria' AND $act=='input'){

  mysql_query("INSERT INTO kriteria(id_kriteria, kriteria, attribut) VALUES('$_POST[id_kriteria]', '$_POST[kriteria]', '$_POST[attribut]')");
  header('location:../../media.php?module='.$module);

}

elseif ($module=='kriteria' AND $act=='inputsub'){

  mysql_query("INSERT INTO sub_kriteria (id_sub, id_kriteria, keterangan, nilai, bobot) VALUES('$_POST[id_sub]', '$_POST[id_kriteria]', '$_POST[keterangan]', '$_POST[nilai]', '$_POST[bobot]')");
  header('location:../../media.php?module='.$module);

}

// Update kriteria
elseif ($module=='kriteria' AND $act=='update'){

  mysql_query("UPDATE kriteria SET kriteria = '$_POST[kriteria]', attribut = '$_POST[attribut]' WHERE id_kriteria = '$_POST[id]'");
  header('location:../../media.php?module='.$module);

}

elseif ($module=='kriteria' AND $act=='updatesub'){

  mysql_query("UPDATE sub_kriteria SET keterangan = '$_POST[keterangan]', nilai = '$_POST[nilai]', bobot = '$_POST[bobot]' WHERE id_sub = '$_POST[id]'");
  header('location:../../media.php?module='.$module);

}

?>
