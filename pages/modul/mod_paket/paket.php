<?php
  include "../config/koneksi.php";
  error_reporting(0);
  session_start(0); 
  if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
    echo "<script>alert('Untuk mengakses sistem, Anda harus login'); window.location = '../'</script>";
  }

else{

$pel="PAKT.";
$y=substr($pel,0,4);
$query=mysql_query("SELECT * FROM paket WHERE substr(id_paket,1,4)='$y' ORDER BY id_paket desc limit 0,1");
$row=mysql_num_rows($query);
$data=mysql_fetch_array($query);
if ($row>0){
$no=substr($data['id_paket'],-6)+1;}
else{
$no=1;
}
$nourut=1000000+$no;
$nopel=$pel.substr($nourut,-6);

$pel2="DPKT.";
$y2=substr($pel2,0,4);
$query2=mysql_query("SELECT * FROM detail_paket WHERE substr(id_detail,1,4)='$y2' ORDER BY id_detail desc limit 0,1");
$row2=mysql_num_rows($query2);
$data2=mysql_fetch_array($query2);
if ($row2>0){
$no2=substr($data2['id_detail'],-6)+1;}
else{
$no2=1;
}
$nourut2=1000000+$no2;
$nopel2=$pel2.substr($nourut2,-6);

$aksi="modul/mod_paket/aksi_paket.php";

switch($_GET[act]){
  // Tampil User
  default:

echo"
<div class='row'>
  <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12'>
    <div class='page-header'>
      <h2 class='pageheader-title'>Paket </h2>
    </div>
  </div>
</div>
<div class='row'>
<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12'>
  <div class='card'>
  <h5 class='card-header'>Data Paket</h5>
    <div class='card-body'>
    <a href='?module=paket&act=tambahpaket'><button type='button' class='btn btn-round btn-primary'><i class='fa fa-plus'></i> Tambah</button></a>
    </p>
    <div class='table-responsive'>
    <table id='example4' class='table table-striped table-bordered' style='width:100%'>
        <thead>
            <tr>
                <th width='5px'>No.</th>
                <th>ID Paket</th>                
                <th>Nama Paket</th>
                <th>Gambar</th>
                <th>Deskripsi</th>
                <th>Harga</td>                
                <th width='15%'>Aksi</th>
            </tr>
        </thead>
        <tbody>";
        $tampil = mysql_query("SELECT * FROM `paket` ORDER BY id_paket DESC");  
        $no = 1;
        while($r=mysql_fetch_array($tampil)){
        echo"
            <tr>
                <td>$no</td>
                <td>$r[id_paket]</td>                
                <td>$r[nama_paket]</td>
                <th><img src='upload/paket/$r[gambar]' border='3' height='100' width='100'></img></th>
                <td>$r[deskripsi]</td>                
                <td>$r[harga]</td>
                <td width='20%'>
                <a href='?module=paket&act=detailpaket&id=$r[id_paket] 'class='btn btn-success btn-xs'><i class='fa fa-pencil'></i> Detail</a>
                <a href='?module=paket&act=editpaket&id=$r[id_paket] 'class='btn btn-info btn-xs'><i class='fa fa-pencil'></i> Edit</a>
                <a href='$aksi?module=paket&act=hapus&id=$r[id_paket]' class='btn btn-danger btn-xs' onClick=\"return confirm('Yakin ingin hapus data ? Data yang dihapus tidak dapat dipulihkan !')\"><i class='fa fa-trash-o'></i> Hapus</a>
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

    case "detailpaket":

      $edit = mysql_query("SELECT * FROM paket WHERE id_paket='$_GET[id]'");
      $r    = mysql_fetch_array($edit);
    
    echo"
    <div class='row'>
      <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12'>
        <div class='page-header'>
          <h2 class='pageheader-title'>Paket </h2>
        </div>
      </div>
    </div>
    <div class='row'>
    <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12'>
      <div class='card'>
      <h5 class='card-header'>Detail Paket</h5>
        <div class='card-body'>
        
        <form method='POST' action='$aksi?module=paket&act=inputdetail'>
        <div class='col-md-6'>
              <label for='id_detail' class='col-form-label'>ID Detail Produk</label>
              <input id='id_detail' name='id_detail' value='$nopel2' type='text' class='form-control' disabled>
              <input id='id_detail' value='$nopel2' name='id_detail' type='hidden' class='form-control'>
          </div>  
        <div class='col-md-6'>
            <label for='id_paket' class='col-form-label'>ID Produk</label>
            <input id='id_paket' name='id_paket' value='$r[id_paket]' type='text' class='form-control' disabled>
            <input id='id_paket' value='$r[id_paket]' name='id_paket' type='hidden' class='form-control'>
        </div>     
        <div class='col-md-6'>
        <label for='id_produk' class='col-form-label'>Nama Produk</label>
        <select class='form-control' name='id_produk' required>
          <option value=''>-- Pilih Produk --</option>";
          $tampil=mysql_query("SELECT * FROM produk ORDER BY id_produk");
          while($r=mysql_fetch_array($tampil)){
          echo "<option value=$r[id_produk]>$r[produk]</option>";
          }
          echo "
        </select>
      </div>   
        <br>
        <div class='col-md-6'>
        <button class='btn btn-primary' type='button' onclick=self.history.back()>Cancel</button>
        <button class='btn btn-primary' type='reset'>Reset</button>
        <button type='submit' class='btn btn-round btn-primary'>Submit</button>
        </div>
        </form>
        <br>
        <table class='table table-striped table-bordered' style='width:100%'>
            <thead>
                <tr>
                    <th width='5px'>No.</th>
                    <th>ID Detail</th>
                    <th>Nama Paket</th>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Gambar</th>
                    <th width='15%'>Aksi</th>
                </tr>
            </thead>
            <tbody>";
            $tampil = mysql_query("SELECT
              `detail_paket`.`id_detail` AS id_detail,
  `paket`.`nama_paket` AS nama_paket,
  `produk`.`produk` AS produk,
  `produk`.`harga` AS harga,
  `produk`.`gambar` AS gambar,
  `paket`.`id_paket` AS id_paket,
  `produk`.`id_produk` AS id_produk
          FROM
            `detail_paket`
            INNER JOIN `paket` ON `detail_paket`.`id_paket` = `paket`.`id_paket`
            INNER JOIN `produk` ON `detail_paket`.`id_produk` = `produk`.`id_produk`
                                  WHERE paket.`id_paket`='$_GET[id]'
                                  ORDER BY paket.id_paket DESC");  
            $no = 1;
            while($r=mysql_fetch_array($tampil)){
            echo"
                <tr>
                    <td>$no</td>
                    <td>$r[id_detail]</td>
                    <td>$r[nama_paket]</td>
                    <td>$r[produk]</td>
                    <td>$r[harga]</td>
                    <td><img src='upload/produk/$r[gambar]' border='3' height='100' width='100'></img></td>
                    <td>
                    <a href='$aksi?module=paket&act=hapus_detail&id=$r[id_detail]&id_paket=$r[id_paket]&id_produk=$r[id_produk]' class='btn btn-danger btn-xs' onClick=\"return confirm('Yakin ingin hapus data ? Data yang dihapus tidak dapat dipulihkan !')\"><i class='fa fa-trash-o'></i> Hapus</a>
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
    </div>";
    
         break;
  
  case "tambahpaket":

  echo"
  <div class='row'>
    <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12'>
      <div class='page-header'>
        <h2 class='pageheader-title'>Paket </h2>
      </div>
    </div>
  </div>
  <div class='row'>
  <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12'>
    <div class='card'>
    <h5 class='card-header'>Tambah Paket</h5>
      <div class='card-body'>
      
      <form method='POST' action='$aksi?module=paket&act=input' enctype='multipart/form-data'>
      <div class='col-md-6'>
          <label for='id_paket' class='col-form-label'>Kode Paket</label>
          <input id='id_paket' value='$nopel' name='id_paket' type='text' class='form-control' disabled>
          <input id='id_paket' value='$nopel' name='id_paket' type='hidden' class='form-control'>
      </div>
      <div class='col-md-6'>
          <label for='nama_paket' class='col-form-label'>Nama Paket</label>
          <input id='nama_paket' name='nama_paket' type='text' class='form-control' required>
      </div> 
      <div class='col-md-6'>
          <label for='deskripsi' class='col-form-label'>Deskripsi Paket</label>
          <textarea id='deskripsi' name='deskripsi' class='form-control' required></textarea>
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
    
  case "editpaket":

  $edit = mysql_query("SELECT * FROM paket WHERE id_paket='$_GET[id]'");
  $r    = mysql_fetch_array($edit);

  echo"
  <div class='row'>
    <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12'>
      <div class='page-header'>
        <h2 class='pageheader-title'>Paket </h2>
      </div>
    </div>
  </div>
  <div class='row'>
  <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12'>
    <div class='card'>
    <h5 class='card-header'>Edit Paket</h5>
      <div class='card-body'>
      
      <form method='POST' action='$aksi?module=paket&act=update' enctype='multipart/form-data'>
      <div class='col-md-6'>
          <label for='id_paket' class='col-form-label'>Kode Paket</label>
          <input id='id_paket' value='$r[id_paket]' name='id_paket' type='text' class='form-control' disabled>
          <input id='id_paket' value='$r[id_paket]' name='id' type='hidden' class='form-control'>
      </div>
      <div class='col-md-6'>
          <label for='nama_paket' class='col-form-label'>Nama Paket</label>
          <input id='nama_paket' value='$r[nama_paket]' name='nama_paket' type='text' class='form-control' required>
      </div>  
      <div class='col-md-6'>
          <label for='deskripsi' class='col-form-label'>Deskripsi Produk</label>
          <textarea id='deskripsi' name='deskripsi' type='text' class='form-control' required>$r[deskripsi]</textarea>
      </div>   <br>
      <div class='col-md-6'>  
          <img src='upload/paket/$r[gambar]' border='3' height='300' width='300'></img>
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
