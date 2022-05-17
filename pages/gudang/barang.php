<script src="js/jquery-ui.js"></script>

<?php
ob_start();
?>

<?php
ob_end_flush();
?>
<p></p>
<p></p>
<span class="span4">
<?php

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
<h2>Data Barang</h2> <input type="button" class="btn btn-primary" name="cetak" id="cetak" value="Cetak" onClick="window.open('pages/web/viewbarang.php','popuppage','width=500,toolbar=0,resizable=0,scrollbars=no,height=400,top=100,left=100');"> <a href="?cat=gudang&page=baranginput" class="btn btn-primary">Tambah Data Barang</a>
<?php 
	/* Koneksi database*/
	include 'phpqrcode/index.php';
	include 'pages/web/paging.php'; //include pagination file
	
	//pagination variables
	$hal = (isset($_REQUEST['hal']) && !empty($_REQUEST['hal']))?$_REQUEST['hal']:1;
	$per_hal = 40; //berapa banyak blok
	$adjacents  = 10;
	$offset = ($hal - 1) * $per_hal;
	$reload="?cat=gudang&page=barang";
	//Cari berapa banyak jumlah data*/
	
	$count_query   = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT COUNT(kode_barang) AS numrows, kode_barang, nama_barang, currency 
FROM data_barang");
	if($count_query === FALSE) {
    die(mysqli_error($GLOBALS["___mysqli_ston"])); 
	}
	$row     = mysqli_fetch_array($count_query);
	$numrows = $row['numrows']; //dapatkan jumlah data
	
	$total_hals = ceil($numrows/$per_hal);

	
	//jalankan query menampilkan data per blok $offset dan $per_hal
	$query = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * from data_barang GROUP BY kode_barang LIMIT $offset,$per_hal");

?>
<table  class="responsive table table-striped table-bordered" width="500">
<thead>

  <tr>
     <td>Nomor</td>
    <td>Nama Alat</td>
    <td>Gambar</td>
    <td>Tanggal Terima Barang</td>
    <td>Kondisi</td>
    <td>Tanggal Maintenance</td> 
    <td>Kondisi setelah Maintenance</td>  
    <td>Teknisi Pengecekan</td>
    <td>Badan Teknisi</td>
    <td>Barcode</td>
    <td>Tindak Lanjut</td>
    </tr>
  </thead>
<?php
while($result = mysqli_fetch_array($query)){
$gambar = "phpqrcode/temp/"."test".md5($result['kode_barang'].'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';

QRcode::png("http://192.168.43.61/angkasapura/dashboard.php?cat=gudang&page=barangedit&id=".$result['kode_barang'], $gambar, $errorCorrectionLevel, $matrixPointSize, 4);   	

?>

<tr >
    <td><?php echo $result['kode_barang']; ?></td>
    <td><?php echo $result['nama_barang']; ?></td> 
    <td><?php echo $result['gambar']; ?></td>
    <td><?php echo $result['tgl_terima']; ?></td>
    <td><?php echo $result['kondisi']; ?></td>
    <td><?php echo $result['tgl_mtn']; ?></td> 
    <td><?php echo $result['kondisi_stlh_mtn']; ?></td> 
    <td><?php echo $result['teknisi_pengecekan']; ?></td>
    <td><?php echo $result['badan_teknisi']; ?></td>
    <td><img src="<?php echo $gambar;?>" /><input type="button" class="btn btn-primary" name="cetak" id="cetak" value="Cetak" onClick="window.open('pages/web/viewbarang.php?id=<?php echo $result['kode_barang']; ?>','popuppage','width=500,toolbar=0,resizable=0,scrollbars=no,height=400,top=100,left=100');"></td>
    <td><a class="btn btn-primary" href="?cat=gudang&page=barangedit&id=<?php echo $result['kode_barang']; ?>">Edit</a></td>
	<td><a class="btn btn-danger" href="?cat=gudang&page=barang&del=1&id=<?php echo $result['kode_barang']; ?>">Hapus</a></td>   
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

	$rs=mysqli_query($GLOBALS["___mysqli_ston"], "Insert into data_barang (`kode_barang`,`nama_barang`,`gambar`,`tgl_terima`,`kondisi`,`tgl_mtn`,`kondisi_stlh_mtn`,`teknisi_pengecekan`,`badan_teknisi`) values 
	('".$_POST['idbarang']."','".$_POST['namabarang']."','".$_POST['gambar']."','".$_POST['tanggal_terima']."','".$_POST['kondisi']."','".$_POST['tgl_mtn']."','".$_POST['after_mtn']."','".$_POST['teknisi_pengecekan']."','".$_POST['badan_teknisi']."')") or die(mysqli_error($GLOBALS["___mysqli_ston"]));
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
	$ff=mysqli_query($GLOBALS["___mysqli_ston"], "Delete from data_barang Where kode_barang='".$ids."'");
	if($ff)
	{
		echo "<script>window.location='?cat=gudang&page=barang'</script>";
	}
}


?>
