<?php
  include "../config/koneksi.php";
  error_reporting(0);
  session_start(0); 
  if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
    echo "<script>alert('Untuk mengakses sistem, Anda harus login'); window.location = '../'</script>";
  }

else{

$pel="PROD.";
$y=substr($pel,0,4);
$query=mysql_query("SELECT * FROM produk WHERE substr(id_produk,1,4)='$y' ORDER BY id_produk desc limit 0,1");
$row=mysql_num_rows($query);
$data=mysql_fetch_array($query);
if ($row>0){
$no=substr($data['id_produk'],-6)+1;}
else{
$no=1;
}
$nourut=1000000+$no;
$nopel=$pel.substr($nourut,-6);

$aksi="modul/mod_produk/aksi_produk.php";

switch($_GET[act]){
  // Tampil User
  default:

echo"
<div class='row'>
  <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12'>
    <div class='page-header'>
      <h2 class='pageheader-title'>Produk </h2>
    </div>
  </div>
</div>
<div class='row'>
<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12'>
  <div class='card'>
  <h5 class='card-header'>Data Produk</h5>
    <div class='card-body'>
    <a href='?module=produk&act=tambahproduk'><button type='button' class='btn btn-round btn-primary'><i class='fa fa-plus'></i> Tambah</button></a>
    </p>
    <div class='table-responsive'>
    <table id='example4' class='table table-striped table-bordered' style='width:100%'>
        <thead>
            <tr>
                <th width='5px'>No.</th>
                <th>ID Produk</th>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Gambar</th>                
                <th>Deskripsi</th>
                <th>Harga</th>
                <th width='15%'>Aksi</th>
            </tr>
        </thead>
        <tbody>";
        $tampil = mysql_query("SELECT * FROM `produk`
                              INNER JOIN `kategori` ON `produk`.`id_kategori` = `kategori`.`id_kategori`
                              ORDER BY id_produk DESC");  
        $no = 1;
        while($r=mysql_fetch_array($tampil)){
        echo"
            <tr>
                <td>$no</td>
                <td>$r[id_produk]</td>
                <td>$r[produk]</td>
                <td>$r[kategori]</td>
                <th><img src='upload/produk/$r[gambar]' border='3' height='100' width='100'></img></th>
                <th>$r[deskripsi]</th>
                <th>$r[harga]</th>
                <td><a href='?module=produk&act=editproduk&id=$r[id_produk] 'class='btn btn-info btn-xs'><i class='fa fa-pencil'></i> Edit</a>
                <a href='$aksi?module=produk&act=hapus&id=$r[id_produk]' class='btn btn-danger btn-xs' onClick=\"return confirm('Yakin ingin hapus data ? Data yang dihapus tidak dapat dipulihkan !')\"><i class='fa fa-trash-o'></i> Hapus</a>
                </td>
            </tr>";
						$no++;						
	        }
        echo"               
        </tbody>
    </table>
</div>
    </div>
  </div>
</div>
</div>";
  
    break;
  
  case "tambahproduk":

  echo"
  <div class='row'>
    <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12'>
      <div class='page-header'>
        <h2 class='pageheader-title'>Produk </h2>
      </div>
    </div>
  </div>
  <div class='row'>
  <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12'>
    <div class='card'>
    <h5 class='card-header'>Tambah Produk</h5>
      <div class='card-body'>
      
      <form method='POST' action='$aksi?module=produk&act=input' enctype='multipart/form-data'>
      <div class='col-md-6'>
          <label for='id_produk' class='col-form-label'>Kode Produk</label>
          <input id='id_produk' value='$nopel' name='id_produk' type='text' class='form-control' disabled>
          <input id='id_produk' value='$nopel' name='id_produk' type='hidden' class='form-control'>
      </div>
      <div class='col-md-6'>
          <label for='nama_produk' class='col-form-label'>Nama Produk</label>
          <input id='nama_produk' name='produk' type='text' class='form-control' required>
      </div>
      <div class='col-md-6'>
        <label for='nama_produk' class='col-form-label'>Kategori Produk</label>
        <select class='form-control' name='id_kategori' required'>
          <option value=''>-- Pilih Kategori Produk --</option>";
          $tampil=mysql_query("SELECT * FROM kategori ORDER BY id_kategori");
          while($r=mysql_fetch_array($tampil)){
          echo "<option value=$r[id_kategori]>$r[kategori]</option>";
          }
          echo "
        </select>
      </div>    
      <div class='col-md-6'>
          <label for='deskripsi' class='col-form-label'>Deskripsi Produk</label>
          <textarea id='deskripsi' name='deskripsi' class='form-control' required></textarea>
      </div>
      <div class='col-md-6'>
          <label for='harga' class='col-form-label'>Harga Produk</label>
          <input id='harga' name='harga' type='number' class='form-control' required>
      </div>
      <div class='col-md-6'>
          <label for='fupload' class='col-form-label'>Gambar</label>
          <input type='file' name='fupload' class='form-control'>
          <p class='help-block'><i>File gambar harus berekstensi .JPG / .PNG agar dapat diupload.</i></p>
      </div>
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
    
  case "editproduk":

  $edit = mysql_query("SELECT * FROM produk WHERE id_produk='$_GET[id]'");
  $r    = mysql_fetch_array($edit);

  echo"
  <div class='row'>
    <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12'>
      <div class='page-header'>
        <h2 class='pageheader-title'>Produk </h2>
      </div>
    </div>
  </div>
  <div class='row'>
  <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12'>
    <div class='card'>
    <h5 class='card-header'>Edit Produk</h5>
      <div class='card-body'>
      
      <form method='POST' action='$aksi?module=produk&act=update' enctype='multipart/form-data'>
      <div class='col-md-6'>
          <label for='id_produk' class='col-form-label'>Kode Produk</label>
          <input id='id_produk' value='$r[id_produk]' name='id_produk' type='text' class='form-control' disabled>
          <input id='id_produk' value='$r[id_produk]' name='id' type='hidden' class='form-control'>
      </div>
      <div class='col-md-6'>
          <label for='produk' class='col-form-label'>Nama Produk</label>
          <input id='produk' value='$r[produk]' name='produk' type='text' class='form-control' required>
      </div>
      <div class='col-md-6'>
        <label for='nama_produk' class='col-form-label'>Kategori Produk</label>
        <select class='form-control' name='id_kategori' required>";          
          $tampil=mysql_query("SELECT * FROM kategori ORDER BY id_kategori");
          if ($r[id_kategori]==0){
          echo "<option value='0' selected>-- Pilih Kategori --</option>";
          }   
          while($w=mysql_fetch_array($tampil)){
          if ($r[id_kategori]==$w[id_kategori]){
          echo "<option value=$w[id_kategori] selected>$w[kategori]</option>";
          }
          else{
          echo "<option value=$w[id_kategori]>$w[kategori]</option>";
          }
          }
          echo "
        </select>
      </div>    
      <div class='col-md-6'>
          <label for='deskripsi' class='col-form-label'>Deskripsi Produk</label>
          <textarea id='deskripsi' name='deskripsi' type='text' class='form-control' required>$r[deskripsi]</textarea>
      </div>
      <div class='col-md-6'>
          <label for='harga' class='col-form-label'>Harga Produk</label>
          <input id='harga' name='harga' value='$r[harga]' type='number' class='form-control' required>
      </div><br>
      <div class='col-md-6'>  
          <img src='upload/produk/$r[gambar]' border='3' height='300' width='300'></img>
      </div>
      <div class='col-md-6'>          
          <label for='fupload' class='col-form-label'>Gambar</label>
          <input type='file' name='fupload' class='form-control'>
          <p class='help-block'><i>File gambar harus berekstensi .JPG / .PNG agar dapat diupload.</i></p>
      </div>
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
}
}
?>
