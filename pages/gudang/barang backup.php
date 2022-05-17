<script src="js/jquery-ui.js"></script>

<?php
ob_start();
?>
<form name="form1" method="post" action="?cat=gudang&page=barang&act=1">
 
      <label>ID Barang</label>
      <input type="text" name="idbarang" id="idbarang" />
      <label>Deskripsi</label>
      <input type="text" name="namabarang" id="namabarang">
      <label>Tanggal</label>
  <input type="text" name="tanggal" id="datepicker" placeholder="Pilih tanggal.." />
  <label>Acquis.val.</label>
      <input type="text" name="acquisval" id="acquisval" />
      <label>Accum.dep.</label>
      <input type="text" name="accumdep" id="accumdep" />
  <label>Jenis Barang</label>
     <select name="currency" id="currency" >
        <option value="idr">IDR</option>
        <option value="usd">USD</option>
  </select>
   
      <p></p>
      <input type="submit" class="btn btn-primary" name="button" id="button" value="Daftar">&nbsp;&nbsp;<input type="reset" class="btn btn-danger" name="reset" id="reset" value="Reset">
</form>
<?php
ob_end_flush();
?>
<p></p>
<p></p>
<span class="span4">
<?php
include 'phpqrcode/index.php';
//mulai
?>



<style>
.pagin {
padding: 10px 0;
font:bold 11px/30px arial, serif;
}
.pagin * {
padding: 2px 6px;
color:#0A7EC5;
margin: 2px;
border-radius:3px;
}
.pagin a {
		border:solid 1px #8DC5E6;
		text-decoration:none;
		background:#F8FCFF;
		padding:6px 7px 5px;
}

.pagin span, a:hover, .pagin a:active,.pagin span.current {
		color:#FFFFFF;
		background:-moz-linear-gradient(top,#B4F6FF 1px,#63D0FE 1px,#58B0E7);
		    
}
.pagin span,.current{
	padding:8px 7px 7px;
}
.content{
	padding:10px;
	font:bold 12px/30px gegoria,arial,serif;
	border:1px dashed #0686A1;
	border-radius:5px;
	background:-moz-linear-gradient(top,#E2EEF0 1px,#CDE5EA 1px,#E2EEF0);
	margin-bottom:10px;
	text-align:left;
	line-height:20px;
}
.outer_div{
	margin:auto;
	width:600px;
}
#loader{
	position: absolute;
	text-align: center;
	top: 75px;
	width: 100%;
	display:none;
}

</style>
<h2>Data Barang</h2>
<?php 
	/* Koneksi database*/
	include 'pages/web/paging.php'; //include pagination file
	
	//pagination variables
	$hal = (isset($_REQUEST['hal']) && !empty($_REQUEST['hal']))?$_REQUEST['hal']:1;
	$per_hal = 5; //berapa banyak blok
	$adjacents  = 5;
	$offset = ($hal - 1) * $per_hal;
	$reload="?cat=gudang&page=barang";
	//Cari berapa banyak jumlah data*/
	
	$count_query   = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT COUNT(data_barang.kode_barang) AS numrows,data_barang.kode_barang, data_barang.nama_barang, data_barang.currency, data_persediaan.stok_tersedia
FROM data_barang LEFT JOIN data_persediaan ON data_barang.kode_barang = data_persediaan.kode_barang");
	if($count_query === FALSE) {
    die(mysqli_error($GLOBALS["___mysqli_ston"])); 
	}
	$row     = mysqli_fetch_array($count_query);
	$numrows = $row['numrows']; //dapatkan jumlah data
	
	$total_hals = ceil($numrows/$per_hal);

	
	//jalankan query menampilkan data per blok $offset dan $per_hal
	$query = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT data_barang.kode_barang, data_barang.nama_barang, data_barang.tanggal, data_barang.acquisval, data_barang.accumdep, data_barang.total, data_barang.currency, data_persediaan.stok_tersedia
FROM data_barang LEFT JOIN data_persediaan ON data_barang.kode_barang = data_persediaan.kode_barang GROUP BY data_barang.kode_barang LIMIT $offset,$per_hal");

?>
<table  class="responsive table table-striped table-bordered" width="500">
<thead>

  <tr>
     <td>ID Barang</td>
    <td>Deskripsi</td>
    <td>Tanggal</td>
    <td>Acquis.val.</td> 
    <td>Accum.dep.</td>  
    <td>Harga Total</td>
    <td>Currency</td>
    <td>Barcode</td>
    <td>Aksi</td>
    </tr>
  </thead>
<?php
while($result = mysqli_fetch_array($query)){
$gambar = "phpqrcode/temp/"."test".md5($result['kode_barang'].'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';	
echo $gambar;
echo $filename;
?>

<tr >
    <td><?php echo $result['kode_barang']; ?></td>
    
    <td><?php echo $result['nama_barang']; ?></td> 
    <td><?php echo $result['tanggal']; ?></td>
    <td><?php echo $result['acquisval']; ?></td> 
    <td><?php echo $result['accumdep']; ?></td> 
    <td><?php echo $result['total']; ?></td>
    <td><?php echo $result['currency']; ?></td>
    <td><img src="<?php echo $gambar;?>" /> <hr/></td>
    <td><a class="btn btn-primary" href="?cat=gudang&page=barangedit&id=<?php echo $result['kode_barang']; ?>">Edit</a><a class="btn btn-danger" href="?cat=gudang&page=barang&del=1&id=<?php echo $result['kode_barang']; ?>">Hapus</a><a class="btn btn-danger" href="?cat=gudang&page=barang&buat=1&id=<?php echo $result['kode_barang']; ?>">Buat</a></td>   
  </tr>   
  </tr>
<?php
}
?>
</table>
<?php
echo paginate($reload, $hal, $total_hals, $adjacents);

?>






</span>
<?php
//end
if(isset($_GET['act']))
{
	
	$total=$_POST['acquisval']+$_POST['accumdep'];
	
	$rs=mysqli_query($GLOBALS["___mysqli_ston"], "Insert into data_barang (`kode_barang`,`nama_barang`,`tanggal`,`acquisval`,`accumdep`,`total`,`currency`) values ('".$_POST['idbarang']."','".$_POST['namabarang']."','".$_POST['tanggal']."','".$_POST['acquisval']."','".$_POST['accumdep']."','".$total."','".$_POST['currency']."')") or die(mysqli_error($GLOBALS["___mysqli_ston"]));
	if($rs)
	{
		
		echo "<script>window.location='?cat=gudang&page=barang'</script>";
	}
}
?>

<?php
if(isset($_GET['del']))
{
	$ids=$_GET['id'];
	$ff=mysqli_query($GLOBALS["___mysqli_ston"], "Delete from data_barang Where sha1(kode_barang)='".$ids."'");
	if($ff)
	{
		echo "<script>window.location='?cat=gudang&page=barang'</script>";
	}
}


?>
