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
if ($module=='produk' AND $act=='hapus'){
  mysql_query("DELETE FROM produk WHERE id_produk='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}

// Input produk
elseif ($module=='produk' AND $act=='input'){

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
    UploadProduk($nama_file_unik);
    mysql_query("INSERT INTO produk(id_produk, id_kategori, produk, deskripsi, harga, gambar) 
                VALUES('$_POST[id_produk]', '$_POST[id_kategori]', '$_POST[produk]', '$_POST[deskripsi]', '$_POST[harga]', '$nama_file_unik')");
  header('location:../../media.php?module='.$module);
  }
  }
  else{
    mysql_query("INSERT INTO produk(id_produk, id_kategori, produk,	deskripsi, harga) VALUES('$_POST[id_produk]', '$_POST[id_kategori]', '$_POST[produk]', '$_POST[deskripsi]', '$_POST[harga]')");
  header('location:../../media.php?module='.$module);
  }
}


// Update produk
elseif ($module=='produk' AND $act=='update'){

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
        UploadProduk($nama_file_unik);
        mysql_query("UPDATE produk SET id_kategori = '$_POST[id_kategori]',
                                       produk       = '$_POST[produk]',
                                       deskripsi   = '$_POST[deskripsi]',
                                       harga   = '$_POST[harga]',
                                       gambar      = '$nama_file_unik'   
                                 WHERE id_produk   = '$_POST[id]'");
        header('location:../../media.php?module='.$module);
    }
    }
    
  
  else{
    
    mysql_query("UPDATE produk SET id_kategori = '$_POST[id_kategori]', produk = '$_POST[produk]', deskripsi   = '$_POST[deskripsi]', harga   = '$_POST[harga]'
                WHERE id_produk   = '$_POST[id]'");
    header('location:../../media.php?module='.$module);
  }

  
}
?>