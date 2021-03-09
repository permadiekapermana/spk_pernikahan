<?php
  include "../config/koneksi.php";
  error_reporting(0);
  session_start(0); 
  if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
    echo "<script>alert('Untuk mengakses sistem, Anda harus login'); window.location = '../'</script>";
  }

else{

$pel="KRIT.";
$y=substr($pel,0,4);
$query=mysql_query("SELECT * FROM kriteria WHERE substr(id_kriteria,1,4)='$y' ORDER BY id_kriteria desc limit 0,1");
$row=mysql_num_rows($query);
$data=mysql_fetch_array($query);
if ($row>0){
$no=substr($data['id_kriteria'],-6)+1;}
else{
$no=1;
}
$nourut=1000000+$no;
$nopel=$pel.substr($nourut,-6);

$pel2="SUBK.";
$y2=substr($pel2,0,4);
$query2=mysql_query("SELECT * FROM sub_kriteria WHERE substr(id_sub,1,4)='$y2' ORDER BY id_sub desc limit 0,1");
$row2=mysql_num_rows($query2);
$data2=mysql_fetch_array($query2);
if ($row2>0){
$no2=substr($data2['id_sub'],-6)+1;}
else{
$no2=1;
}
$nourut2=1000000+$no2;
$nopel2=$pel2.substr($nourut2,-6);
  
$aksi="modul/mod_kriteria/aksi_kriteria.php";

switch($_GET[act]){
  // Tampil User
  default:

echo"
<div class='row'>
  <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12'>
    <div class='page-header'>
      <h2 class='pageheader-title'>Kriteria </h2>
    </div>
  </div>
</div>
<div class='row'>
<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12'>
  <div class='card'>
  <h5 class='card-header'>Data Kriteria</h5>
    <div class='card-body'>
    <a href='?module=kriteria&act=tambahkriteria'><button type='button' class='btn btn-round btn-primary'><i class='fa fa-plus'></i> Tambah</button></a>
    </p>
    <div class='table-responsive'>
    <table id='example4' class='table table-striped table-bordered' style='width:100%'>
        <thead>
            <tr>
                <th width='5px'>No.</th>
                <th>ID Kriteria</th>
                <th>Kriteria</th>
                <th>Atribut</th>
                <th width='15%'>Aksi</th>
            </tr>
        </thead>
        <tbody>";
        $tampil = mysql_query("SELECT * FROM `kriteria`
                                  ORDER BY id_kriteria DESC");  
        $no = 1;
        while($r=mysql_fetch_array($tampil)){
        echo"
            <tr>
                <td>$no</td>
                <td>$r[id_kriteria]</td>
                <td>$r[kriteria]</td>
                <td>$r[attribut]</td>
                <td width='25%'>
                <a href='?module=kriteria&act=subkriteria&id=$r[id_kriteria] 'class='btn btn-success btn-xs'><i class='fa fa-pencil'></i> Sub Kriteria</a>
                <a href='?module=kriteria&act=editkriteria&id=$r[id_kriteria] 'class='btn btn-info btn-xs'><i class='fa fa-pencil'></i> Edit</a>
                <a href='$aksi?module=kriteria&act=hapus&id=$r[id_kriteria]' class='btn btn-danger btn-xs' onClick=\"return confirm('Yakin ingin hapus data ? Data yang dihapus tidak dapat dipulihkan !')\"><i class='fa fa-trash-o'></i> Hapus</a>
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
  
  case "tambahkriteria":

  echo"
  <div class='row'>
    <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12'>
      <div class='page-header'>
        <h2 class='pageheader-title'>Kriteria </h2>
      </div>
    </div>
  </div>
  <div class='row'>
  <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12'>
    <div class='card'>
    <h5 class='card-header'>Tambah Kriteria</h5>
      <div class='card-body'>
      
      <form method='POST' action='$aksi?module=kriteria&act=input'>       
      <div class='col-md-6'>
          <label for='id_kriteria' class='col-form-label'>ID Kriteria</label>
          <input id='id_kriteria' name='id_kriteria' value='$nopel' type='text' class='form-control' disabled>
          <input id='id_kriteria' value='$nopel' name='id_kriteria' type='hidden' class='form-control'>
      </div>     
      <div class='col-md-6'>
          <label for='kriteria' class='col-form-label'>Kriteria</label>
          <input id='kriteria' name='kriteria' type='text' class='form-control' required>
      </div> 
      <div class='col-md-6'>
        <label for='nama_produk' class='col-form-label'>Attribut</label>
        <select class='form-control' name='attribut' required>
          <option value=''>-- Pilih Attribut --</option>
          <option value='Benefit'>Benefit</option>
          <option value='Cost'>Cost</option>
        </select>
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
  
case "subkriteria":

  $edit = mysql_query("SELECT * FROM kriteria WHERE id_kriteria='$_GET[id]'");
  $r    = mysql_fetch_array($edit);

echo"
<div class='row'>
  <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12'>
    <div class='page-header'>
      <h2 class='pageheader-title'>Kriteria </h2>
    </div>
  </div>
</div>
<div class='row'>
<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12'>
  <div class='card'>
  <h5 class='card-header'>Sub Kriteria</h5>
    <div class='card-body'>
    
    <form method='POST' action='$aksi?module=kriteria&act=inputsub'>
    <div class='col-md-6'>
          <label for='id_sub' class='col-form-label'>ID Sub Kriteria</label>
          <input id='id_sub' name='id_sub' value='$nopel2' type='text' class='form-control' disabled>
          <input id='id_sub' value='$nopel2' name='id_sub' type='hidden' class='form-control'>
      </div>  
    <div class='col-md-6'>
        <label for='id_kriteria' class='col-form-label'>ID Kriteria</label>
        <input id='id_kriteria' name='id_kriteria' value='$r[id_kriteria]' type='text' class='form-control' disabled>
        <input id='id_kriteria' value='$r[id_kriteria]' name='id_kriteria' type='hidden' class='form-control'>
    </div>     
    <div class='col-md-6'>
        <label for='keterangan' class='col-form-label'>Keterangan</label>
        <input id='keterangan' name='keterangan' type='text' class='form-control' required>
    </div> 
    <div class='col-md-6'>
      <label for='nilai' class='col-form-label'>Nilai</label>
      <select class='form-control' name='nilai' required>
        <option value=''>-- Pilih Nilai --</option>
        <option value='25'>25</option>
        <option value='50'>50</option>
        <option value='75'>75</option>
        <option value='100'>100</option>
      </select>
    </div>
      <div class='col-md-6'>
      <label for='bobot' class='col-form-label'>Bobot</label>
      <select class='form-control' name='bobot' required>
        <option value=''>-- Pilih Bobot --</option>
        <option value='Kurang'>Kurang</option>
        <option value='Cukup'>Cukup</option>
        <option value='Baik'>Baik</option>
        <option value='Sangat Baik'>Sangat Baik</option>
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
                <th>ID Sub Kriteria</th>
                <th>Kriteria</th>
                <th>Nilai</th>
                <th>Keterangan</th>
                <th>Bobot</th>
                <th width='15%'>Aksi</th>
            </tr>
        </thead>
        <tbody>";
        $tampil = mysql_query("SELECT * FROM `sub_kriteria` INNER JOIN `kriteria` ON `sub_kriteria`.`id_kriteria` = `kriteria`.`id_kriteria`
                              WHERE kriteria.`id_kriteria`='$r[id_kriteria]'
                              ORDER BY id_sub DESC");  
        $no = 1;
        while($r=mysql_fetch_array($tampil)){
        echo"
            <tr>
                <td>$no</td>
                <td>$r[id_sub]</td>
                <td>$r[kriteria]</td>
                <td>$r[nilai]</td>
                <td>$r[keterangan]</td>
                <td>$r[bobot]</td>
                <td>
                <a href='?module=kriteria&act=editsubkriteria&id=$r[id_sub] 'class='btn btn-info btn-xs'><i class='fa fa-pencil'></i> Edit</a>
                <a href='$aksi?module=kriteria&act=hapussub&id=$r[id_sub]' class='btn btn-danger btn-xs' onClick=\"return confirm('Yakin ingin hapus data ? Data yang dihapus tidak dapat dipulihkan !')\"><i class='fa fa-trash-o'></i> Hapus</a>
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

     case "editsubkriteria":
  
      $edit = mysql_query("SELECT * FROM sub_kriteria WHERE id_sub='$_GET[id]'");
      $r    = mysql_fetch_array($edit);
    
      echo"
      <div class='row'>
        <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12'>
          <div class='page-header'>
            <h2 class='pageheader-title'>Sub Kriteria </h2>
          </div>
        </div>
      </div>
      <div class='row'>
      <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12'>
        <div class='card'>
        <h5 class='card-header'>Edit Sub Kriteria</h5>
          <div class='card-body'>
          
          <form method='POST' action='$aksi?module=kriteria&act=updatesub'>
          <div class='col-md-6'>
              <label for='id_sub' class='col-form-label'>ID Sub Kriteria</label>
              <input id='id_sub' name='id_sub' value='$r[id_sub]' type='text' class='form-control' disabled>
              <input id='id_sub' name='id' value='$r[id_sub]' type='hidden' class='form-control' required>
          </div>
          <div class='col-md-6'>
              <label for='id_kriteria' class='col-form-label'>ID Kriteria</label>
              <input id='id_kriteria' name='id_kriteria' value='$r[id_kriteria]' type='text' class='form-control' disabled>
              <input id='id_kriteria' name='id_kriteria' value='$r[id_kriteria]' type='hidden' class='form-control' required>
          </div> 
          <div class='col-md-6'>
              <label for='keterangan' class='col-form-label'>Keterangan</label>
              <input id='keterangan' name='keterangan' value='$r[keterangan]' type='text' class='form-control' required>
          </div>       
          <div class='col-md-6'>
            <label for='nama_produk' class='col-form-label'>Nilai</label>
            <select class='form-control' name='nilai' required>
            <option>-- Pilih nilai --</option>";
            if ($r[nilai]=='25')   {                         
            echo"                
              <option value='25' selected>25</option>
              <option value='50'>50</option>
              <option value='75'>75</option>
              <option value='100'>100</option>";
            }
            elseif ($r[nilai]=='50')    {
            echo"
              <option value='25'>25</option>
              <option value='50' selected>50</option>
              <option value='75'>75</option>
              <option value='100'>100</option>";
            }
            elseif ($r[nilai]=='75')    {
            echo"
              <option value='25'>25</option>
              <option value='50' >50</option>
              <option value='75' selected>75</option>
              <option value='100'>100</option>";
            }
            elseif ($r[nilai]=='100')    {
            echo"
              <option value='25'>25</option>
              <option value='50' >50</option>
              <option value='75'>75</option>
              <option value='100' selected>100</option>";
            }
            echo"
            </select>
          </div>
          <div class='col-md-6'>
            <label for='bobot' class='col-form-label'>Bobot</label>
            <select class='form-control' name='bobot' required>
            <option>-- Pilih nilai --</option>";
            if ($r[bobot]=='Kurang')   {                         
            echo"                
              <option value='Kurang' selected>Kurang</option>
              <option value='Cukup'>Cukup</option>
              <option value='Baik'>Baik</option>
              <option value='Sangat Baik'>Sangat Baik</option>";
            }
            elseif ($r[bobot]=='Cukup')    {
            echo"
              <option value='Kurang' >Kurang</option>
              <option value='Cukup' selected>Cukup</option>
              <option value='Baik'>Baik</option>
              <option value='Sangat Baik'>Sangat Baik</option>";
            }
            elseif ($r[bobot]=='Baik')    {
            echo"
              <option value='Kurang' >Kurang</option>
              <option value='Cukup' >Cukup</option>
              <option value='Baik' selected>Baik</option>
              <option value='Sangat Baik'>Sangat Baik</option>";
            }
            elseif ($r[bobot]=='Sangat Baik')    {
            echo"
              <option value='Kurang' >Kurang</option>
              <option value='Cukup' >Cukup</option>
              <option value='Baik' >Baik</option>
              <option value='Sangat Baik' selected>Sangat Baik</option>";
            }
            echo"
            </select>
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
    
  case "editkriteria":
  
  $edit = mysql_query("SELECT * FROM kriteria WHERE id_kriteria='$_GET[id]'");
  $r    = mysql_fetch_array($edit);

  echo"
  <div class='row'>
    <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12'>
      <div class='page-header'>
        <h2 class='pageheader-title'>Kriteria </h2>
      </div>
    </div>
  </div>
  <div class='row'>
  <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12'>
    <div class='card'>
    <h5 class='card-header'>Edit Kriteria</h5>
      <div class='card-body'>
      
      <form method='POST' action='$aksi?module=kriteria&act=update'>
      <div class='col-md-6'>
          <label for='id_kriteria' class='col-form-label'>ID Kriteria</label>
          <input id='id_kriteria' name='id_kriteria' value='$r[id_kriteria]' type='text' class='form-control' disabled>
          <input id='id_kriteria' name='id' value='$r[id_kriteria]' type='hidden' class='form-control' required>
      </div> 
      <div class='col-md-6'>
          <label for='kriteria' class='col-form-label'>Kriteria</label>
          <input id='kriteria' name='kriteria' value='$r[kriteria]' type='text' class='form-control' required>
      </div>       
      <div class='col-md-6'>
        <label for='nama_produk' class='col-form-label'>Attribut</label>
        <select class='form-control' name='attribut' required>";
        if ($r[attribut]=='Benefit')   {                         
        echo"  
          <option>-- Pilih Attribut --</option>
          <option value='Benefit' selected>Benefit</option>
          <option value='Cost'>Cost</option>";
        }
        elseif ($r[attribut]=='Cost')    {
        echo"
          <option>-- Pilih Attribut --</option>
          <option value='Benefit' >Benefit</option>
          <option value='Cost' selected>Cost</option>";
        }
        echo"
        </select>
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
