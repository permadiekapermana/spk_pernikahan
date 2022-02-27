<?php
  include "../config/koneksi.php";
  error_reporting(0);
  session_start(0); 
  if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
    echo "<script>alert('Untuk mengakses sistem, Anda harus login'); window.location = '../'</script>";
  }

else{

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
  
$aksi="modul/mod_nilai/aksi_nilai.php";

switch($_GET[act]){
  // Tampil User
  default:

echo"
<div class='row'>
  <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12'>
    <div class='page-header'>
      <h2 class='pageheader-title'>Nilai </h2>
    </div>
  </div>
</div>
<div class='row'>
<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12'>
  <div class='card'>
  <h5 class='card-header'>Data Nilai</h5>
    <div class='card-body'>
    <a href='?module=nilai&act=pilihpaket'><button type='button' class='btn btn-round btn-primary'><i class='fa fa-plus'></i> Tambah</button></a>
    </p>
    <div class='table-responsive'>
    <table id='example4' class='table table-striped table-bordered' style='width:100%'>
        <thead>
            <tr>
                <th width='5px'>No.</th>
                <th>Paket</th>";
                $tampil = mysql_query("SELECT
                `kriteria`.`kriteria`
                FROM
                `kriteria` ORDER BY id_kriteria ASC");  
                $no = 1;
                while($r=mysql_fetch_array($tampil)){
                echo"
                <th>$r[kriteria]</th>";
                }
                echo"
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
                <td>$r[nama_paket]</td>";
                $tampil2 = mysql_query("SELECT
                *
              FROM
                `nilai` WHERE id_paket='$r[id_paket]'"); 
                while($r2=mysql_fetch_array($tampil2)){
                echo"
                <td>$r2[nilai]</td>";
                }
                echo"
                <td width='5%'><a href='?module=nilai&act=editnilai&id=$r[id_paket] 'class='btn btn-info btn-xs'><i class='fa fa-pencil'></i> Edit</a>                
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

case "pilihpaket":

echo"	
<div class='row'>
<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12'>
  <div class='card'>
  <h5 class='card-header'>Data Paket</h5>
  <div class='card-body'>
  <form method='POST' action='?module=nilai&act=tambahnilai'>
  <div class='col-md-6'>
    <label for='id_paket' class='col-form-label'>Pilih Paket Pernikahan</label>
    <br>
    <select class='form-control' name='id_paket'>
          <option value='' selected>- Pilih Paket Pernikahan -</option>";
          $tampil=mysql_query("SELECT * FROM paket WHERE id_paket NOT IN (SELECT id_paket FROM nilai) ORDER BY id_paket");
          while($r=mysql_fetch_array($tampil)){
            echo "<option value=$r[id_paket]>$r[nama_paket]</option>";
          }
      echo "</select>
  </div>     
  <br>
  <div class='col-md-6'>
  <button type='submit' class='btn btn-round btn-primary'>Submit</button>
  </div>
  </form>
  </div>
  </div>
</div>
</div>";

break;
  
  case "tambahnilai":

  $edit = mysql_query("SELECT * FROM paket WHERE id_paket='$_POST[id_paket]'");
  $r    = mysql_fetch_array($edit);

  echo"
  <div class='row'>
    <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12'>
      <div class='page-header'>
        <h2 class='pageheader-title'>Nilai </h2>
      </div>
    </div>
  </div>
  <div class='row'>
  <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12'>
    <div class='card'>
    <h5 class='card-header'>Tambah Nilai</h5>
      <div class='card-body'>
      
      <form method='POST' action='$aksi?module=nilai&act=input'> 
      <div class='col-md-6'>
          <label class='col-form-label'>Paket Pernikahan : <b>$r[nama_paket]</b></label>
      </div>";    
    
      $tampil2=mysql_query("SELECT * FROM kriteria ORDER BY id_kriteria");
      while($r2=mysql_fetch_array($tampil2)){
      echo "
        <div class='col-md-6'>
          <label for='nama_produk' class='col-form-label'>$r2[kriteria]</label>
          <input id='id_kriteria' value='$r2[id_kriteria]' name='id_kriteria[]' type='hidden' class='form-control'>
          <input id='id_kriteria' value='$_POST[id_paket]' name='id_paket[]' type='hidden' class='form-control'>
          <select class='form-control' name='nilai[]' required>
            <option value=''>-- Pilih $r2[kriteria] --</option>";
            $tampil3=mysql_query("SELECT * FROM sub_kriteria WHERE id_kriteria='$r2[id_kriteria]'");
            while($r3=mysql_fetch_array($tampil3)){
            echo "<option value=$r3[nilai]>$r3[keterangan]</option>";
            }
            echo "
          </select>
        </div>
      ";
      }
          
      echo"   
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


     case "editnilai":

      $edit = mysql_query("SELECT * FROM paket WHERE id_paket='$_GET[id]'");
      $r    = mysql_fetch_array($edit);
    
      echo"
      <div class='row'>
        <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12'>
          <div class='page-header'>
            <h2 class='pageheader-title'>Nilai </h2>
          </div>
        </div>
      </div>
      <div class='row'>
      <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12'>
        <div class='card'>
        <h5 class='card-header'>Edit Nilai</h5>
          <div class='card-body'>
          
          <form method='POST' action='$aksi?module=nilai&act=update'> 
          <div class='col-md-6'>
              <label class='col-form-label'>Paket Pernikahan : <b>$r[nama_paket]</b></label>
          </div>";    
        
          $tampil2=mysql_query("SELECT
          nilai.id_nilai,
          `nilai`.`id_paket`,
          `nilai`.`id_kriteria`,
          `nilai`.`nilai`,
          `kriteria`.`kriteria`
        FROM
          `nilai`
          INNER JOIN `paket` ON `nilai`.`id_paket` = `paket`.`id_paket`
          INNER JOIN `kriteria` ON `nilai`.`id_kriteria` = `kriteria`.`id_kriteria` WHERE nilai.id_paket='$r[id_paket]'");
          while($r2=mysql_fetch_array($tampil2)){
          echo "
            <div class='col-md-6'>
              <label for='nama_produk' class='col-form-label'>$r2[kriteria]</label>
              <input id='id_kriteria' value='$r2[id_kriteria]' name='id_kriteria[]' type='hidden' class='form-control'>
              <input id='id_kriteria' value='$_GET[id]' name='id_paket[]' type='hidden' class='form-control'>
              <input id='id_nilai' value='$r2[id_nilai]' name='id_nilai[]' type='hidden' class='form-control'>
              <select class='form-control' name='nilai[]' required>";
                $tampil3=mysql_query("SELECT * FROM sub_kriteria WHERE id_kriteria='$r2[id_kriteria]'");
                if ($r2[id_kriteria]==0){
                echo "<option value='' selected>-- Pilih $r2[kriteria] --</option>";
                }   
                while($r3=mysql_fetch_array($tampil3)){
                if ($r2[nilai]==$r3[nilai]){
                echo "<option value=$r3[nilai] selected>$r3[keterangan]</option>";
                }
                else{
                echo "<option value=$r3[nilai]>$r3[keterangan]</option>";
                }
                }
                echo "
              </select>
            </div>
          ";
          }
              
          echo"   
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
