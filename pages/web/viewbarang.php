<?php
include("../../_db.php");
if (!isset($_GET['id'])){
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
<?php 
	/* Koneksi database*/
	include '../../phpqrcode/index.php';
	include 'paging.php'; //include pagination file
	
	//pagination variables
	$hal = (isset($_REQUEST['hal']) && !empty($_REQUEST['hal']))?$_REQUEST['hal']:1;
	$per_hal = 44; //berapa banyak blok
	$adjacents  = 7;
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
	$query = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT kode_barang, nama_barang, tanggal, acquisval, accumdep, total, currency from data_barang GROUP BY kode_barang LIMIT $offset,$per_hal");


while($result = mysqli_fetch_array($query)){
	$gambar = "../../phpqrcode/temp/"."test".md5($result['kode_barang'].'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
QRcode::png("http://192.168.43.61/angkasapura/dashboard.php?cat=gudang&page=barangedit&id=".$result['kode_barang'], $gambar, $errorCorrectionLevel, $matrixPointSize, 4);   	
?>  
<table>
<tr>
    <td><img src="<?php echo $gambar;?>" width="70"/></td></tr>
    <tr><td><?php echo $result['kode_barang']; ?></td>
    </tr>
</table>
    <?php
	$ids=sha1($result['kode_barang']);
	?>     
 
<?php
}
?>
</table>
<?php
echo paginate($reload, $hal, $total_hals, $adjacents);
}else{
	include '../../phpqrcode/index.php';
	$query = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * from data_barang where kode_barang='".$_GET['id']."'");
while($result = mysqli_fetch_array($query)){
	$gambar = "../../phpqrcode/temp/"."test".md5($result['kode_barang'].'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
QRcode::png("http://192.168.43.61/angkasapura/dashboard.php?cat=gudang&page=barangedit&id=".$result['kode_barang'], $gambar, $errorCorrectionLevel, $matrixPointSize, 4);
?>
<table>
<tr>
    <td><img src="<?php echo $gambar;?>" width="70"/></td></tr>
    <tr><td><?php echo $result['kode_barang']; ?></td>
    </tr>
</table>
    <?php
	$ids=sha1($result['kode_barang']);
}
}
?>
</table>