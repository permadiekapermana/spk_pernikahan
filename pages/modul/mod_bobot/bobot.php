<?php
  include "../config/koneksi.php";
  error_reporting(0);
  session_start(0); 
  if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
    echo "<script>alert('Untuk mengakses sistem, Anda harus login'); window.location = '../'</script>";
  }

else{

$pel="BOBT.";
$y=substr($pel,0,4);
$query=mysql_query("SELECT * FROM bobot WHERE substr(id_bobot,1,4)='$y' ORDER BY id_bobot desc limit 0,1");
$row=mysql_num_rows($query);
$data=mysql_fetch_array($query);
if ($row>0){
$no=substr($data['id_bobot'],-6)+1;}
else{
$no=1;
}
$nourut=1000000+$no;
$nopel=$pel.substr($nourut,-6);
  
$aksi="modul/mod_bobot/aksi_bobot.php";

switch($_GET[act]){
  // Tampil User
  default:

echo"
<div class='row'>
  <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12'>
    <div class='page-header'>
      <h2 class='pageheader-title'>Bobot </h2>
    </div>
  </div>
</div>
<div class='row'>
<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12'>
  <div class='card'>
  <h5 class='card-header'>Data Bobot</h5>
    <div class='card-body'>
    <a href='?module=bobot&act=tambahbobot'><button type='button' class='btn btn-round btn-primary'><i class='fa fa-plus'></i> Tambah</button></a>
    </p>
    <div class='table-responsive'>
    <table id='example4' class='table table-striped table-bordered' style='width:100%'>
        <thead>
            <tr>
                <th width='5px'>No.</th>
                <th>ID Bobot</th>
                <th>Kriteria</th>
                <th>Bobot</th>
                <th width='15%'>Aksi</th>
            </tr>
        </thead>
        <tbody>";
        $tampil = mysql_query("SELECT
        *
      FROM
        `bobot`
        INNER JOIN `kriteria` ON `bobot`.`id_kriteria` = `kriteria`.`id_kriteria` ORDER BY id_bobot DESC");  
        $no = 1;
        while($r=mysql_fetch_array($tampil)){
        echo"
            <tr>
                <td>$no</td>
                <td>$r[id_bobot]</td>
                <td>$r[kriteria]</td>
                <td>$r[bobot]</td>
                <td><a href='?module=bobot&act=editbobot&id=$r[id_bobot] 'class='btn btn-info btn-xs'><i class='fa fa-pencil'></i> Edit</a>
                <a href='$aksi?module=bobot&act=hapus&id=$r[id_bobot]' class='btn btn-danger btn-xs' onClick=\"return confirm('Yakin ingin hapus data ? Data yang dihapus tidak dapat dipulihkan !')\"><i class='fa fa-trash-o'></i> Hapus</a>
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
  
  case "tambahbobot":

  echo"
  <div class='row'>
    <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12'>
      <div class='page-header'>
        <h2 class='pageheader-title'>Bobot </h2>
      </div>
    </div>
  </div>
  <div class='row'>
  <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12'>
    <div class='card'>
    <h5 class='card-header'>Tambah Bobot</h5>
      <div class='card-body'>
      
      <form method='POST' action='$aksi?module=bobot&act=input'> 
      <div class='col-md-6'>
          <label for='id_bobot' class='col-form-label'>ID Bobot</label>
          <input id='id_bobot' name='id_bobot' value='$nopel' type='text' class='form-control' disabled>
          <input id='id_bobot' value='$nopel' name='id_bobot' type='hidden' class='form-control'>
      </div> 
      <div class='col-md-6'>
        <label for='nama_produk' class='col-form-label'>Kriteria</label>
        <select class='form-control' name='id_kriteria'>
          <option>-- Pilih Kriteria --</option>";
          $tampil=mysql_query("SELECT * FROM kriteria ORDER BY id_kriteria");
          while($r=mysql_fetch_array($tampil)){
          echo "<option value=$r[id_kriteria]>$r[kriteria]</option>";
          }
          echo "
        </select>
      </div>     
      <div class='col-md-6'>
          <label for='bobot' class='col-form-label'>Bobot</label>
          <input id='bobot' name='bobot' type='text' class='form-control' required>
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
    
  case "editbobot":
  
  $edit = mysql_query("SELECT * FROM bobot WHERE id_bobot='$_GET[id]'");
  $r    = mysql_fetch_array($edit);

  echo"
  <div class='row'>
    <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12'>
      <div class='page-header'>
        <h2 class='pageheader-title'>Bobot </h2>
      </div>
    </div>
  </div>
  <div class='row'>
  <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12'>
    <div class='card'>
    <h5 class='card-header'>Edit Bobot</h5>
      <div class='card-body'>
      
      <form method='POST' action='$aksi?module=bobot&act=update'>
      <div class='col-md-6'>
          <label for='id_bobot' class='col-form-label'>ID Bobot</label>
          <input id='id_bobot' name='id_bobot' value='$r[id_bobot]' type='text' class='form-control' disabled>
          <input id='id_bobot' name='id' value='$r[id_bobot]' type='hidden' class='form-control' required>
      </div>
      <div class='col-md-6'>
        <label for='id_kriteria' class='col-form-label'>Kriteria</label>
        <select class='form-control' name='id_kriteria'>";          
          $tampil=mysql_query("SELECT * FROM kriteria ORDER BY id_kriteria");
          if ($r[id_kriteria]==0){
          echo "<option value='0' selected>-- Pilih Kriteria --</option>";
          }   
          while($w=mysql_fetch_array($tampil)){
          if ($r[id_kriteria]==$w[id_kriteria]){
          echo "<option value=$w[id_kriteria] selected>$w[kriteria]</option>";
          }
          else{
          echo "<option value=$w[id_kriteria]>$w[kriteria]</option>";
          }
          }
          echo "
        </select>
      </div>   
      <div class='col-md-6'>
          <label for='bobot' class='col-form-label'>Bobot</label>
          <input id='bobot' name='bobot' value='$r[bobot]' type='text' class='form-control' required>
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
