<?php
error_reporting(0);
include "../config/koneksi.php";
  $pass=md5($_POST[password]);
  $cek_username = mysql_num_rows(mysql_query("SELECT * FROM users WHERE username = '$_POST[username]'"));
	if ( $cek_username > 0 ){
		echo "<script>alert('Username yang anda masukan sudah ada !');history.go(-1)</script>";
	} else{
  mysql_query("INSERT INTO users(username,
                                 password,
                                 nama_lengkap,
                                 email, 
                                 no_telp,
                                 level,
                                 blokir,
                                 id_session) 
	                       VALUES('$_POST[username]',
                                '$pass',
                                '$_POST[nama_lengkap]',
                                '$_POST[email]',
                                '$_POST[no_telp]',
                                'Pelanggan',
                                'N',
                                '$pass')");

  echo "<script>alert('Registrasi Berhasil! Silahkan Login.');history.go(-2)</script>";
  }
?>