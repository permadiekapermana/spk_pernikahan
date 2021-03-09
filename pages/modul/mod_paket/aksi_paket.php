<?php
session_start();
error_reporting(0);
include "../../../config/koneksi.php";
include "../../../config/library.php";
include "../../../config/fungsi_thumb.php";
include "../../../config/fungsi_seo.php";

$module=$_GET[module];
$act=$_GET[act];

// Hapus produk
if ($module=='paket' AND $act=='hapus'){
  mysql_query("DELETE FROM nilai_paket WHERE id_paket='$_GET[id]'");
  mysql_query("DELETE FROM nilai_user WHERE id_paket='$_GET[id]'");
  mysql_query("DELETE FROM nilai WHERE id_paket='$_GET[id]'");
  mysql_query("DELETE FROM paket WHERE id_paket='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}
if ($module=='paket' AND $act=='hapus_detail'){
  $harga_paket=mysql_query("SELECT * FROM `paket` WHERE id_paket = '$_GET[id_paket]'");
  $h_paket=mysql_fetch_array($harga_paket);
  $harga_produk=mysql_query("SELECT * FROM `produk` WHERE id_produk = '$_GET[id_produk]'");
  $h_produk=mysql_fetch_array($harga_produk);

  $c = $h_paket['harga'];
  $d = $h_produk['harga'];

  $jum = $c - $d;

  mysql_query("UPDATE paket SET harga = '$jum'
            WHERE id_paket   = '$_GET[id_paket]'");
  mysql_query("DELETE FROM detail_paket WHERE id_detail='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}

// Input produk
elseif ($module=='paket' AND $act=='input'){

$lokasi_file    = $_FILES['fupload']['tmp_name'];
$tipe_file      = $_FILES['fupload']['type'];
$nama_file      = $_FILES['fupload']['name'];
$acak           = rand(1,99);
$nama_file_unik = $acak.$nama_file; 
	
 if (!empty($lokasi_file)){
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg" AND $tipe_file != "image/png"){
    echo "<script>alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG atau *.PNG !');history.go(-1)</script>";
    }
    else{
    UploadPaket($nama_file_unik);
    mysql_query("INSERT INTO paket(id_paket, nama_paket, deskripsi,  gambar) 
                VALUES('$_POST[id_paket]', '$_POST[nama_paket]', '$_POST[deskripsi]', '$nama_file_unik')");
  header('location:../../media.php?module='.$module);
  }
  }
  else{
    mysql_query("INSERT INTO paket(id_paket, nama_paket, deskripsi) 
                VALUES('$_POST[id_paket]', '$_POST[nama_paket]', '$_POST[deskripsi]')");
  header('location:../../media.php?module='.$module);
  }
}

elseif ($module=='paket' AND $act=='inputdetail'){

  $hargapaket=mysql_query("SELECT * FROM `paket` WHERE id_paket = '$_POST[id_paket]'");
  $hpaket=mysql_fetch_array($hargapaket);
  $hargaproduk=mysql_query("SELECT * FROM `produk` WHERE id_produk = '$_POST[id_produk]'");
  $hproduk=mysql_fetch_array($hargaproduk);

  $a = $hpaket['harga'];
  $b = $hproduk['harga'];

  $jumlah = $a + $b;

  
      mysql_query("INSERT INTO detail_paket(id_detail, id_paket, id_produk) 
                  VALUES('$_POST[id_detail]', '$_POST[id_paket]', '$_POST[id_produk]')");
                  mysql_query("UPDATE paket SET harga = '$jumlah'
            WHERE id_paket   = '$_POST[id_paket]'");
    header('location:../../media.php?module='.$module);
    
  }


// Update produk
elseif ($module=='paket' AND $act=='update'){

  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file; 

  // Apabila gambar tidak diganti
  if (!empty($lokasi_file)){    
  if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg" AND $tipe_file != "image/png"){
    echo "<script>alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG atau *.PNG !');history.go(-1)</script>";
    }
    else{
      UploadPaket($nama_file_unik);
    mysql_query("UPDATE paket SET nama_paket = '$_POST[nama_paket]',
                                   deskripsi   = '$_POST[deskripsi]',
                                   gambar      = '$nama_file_unik'   
                             WHERE id_paket   = '$_POST[id]'");
      header('location:../../media.php?module='.$module);
  }
  }
  else{
    mysql_query("UPDATE paket SET nama_paket = '$_POST[nama_paket]',  deskripsi   = '$_POST[deskripsi]'
                WHERE id_paket   = '$_POST[id]'");
    header('location:../../media.php?module='.$module);
  }
  
  
}
?>
