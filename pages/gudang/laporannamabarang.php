<script src="js/jquery-ui.js"></script>

<?php
ob_start();
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
<h2>Laporan Barang</h2>
<?php ;?>
<form name="form1" method="get" action="?cat=gudang&page=laporannamabarang">
<input class="form-control" type="hidden" name="cat" id="cat" value="gudang">
<input class="form-control" type="hidden" name="page" id="page" value="laporannamabarang">
 <input class="form-control" type="textfield" name="txtkatakunci" id="txtkatakunci">
 <input type="submit" name="btncari" id="btncari">
</form>
<?php 
$kata="";
if 	(isset($_GET['txtkatakunci'])){
	$kata=$_GET['txtkatakunci'];
}
	$query = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * from data_barang where nama_barang LIKE '%".$kata."%' GROUP BY kode_barang");

?>
<table  class="responsive table table-striped table-bordered" width="500">
<thead>

  <tr>
     <td>ID Barang</td>
    <td>Deskripsi</td>
    <td>Tanggal</td>
    <td>Lokasi</td>
    <td>Kondisi</td>
    <td>Acquis.val.</td> 
    <td>Accum.dep.</td>  
    <td>Harga Total</td>
    <td>Currency</td>
    </tr>
  </thead>
<?php
while($result = mysqli_fetch_array($query)){
?>

<tr >
    <td><?php echo $result['kode_barang']; ?></td>
    <td><?php echo $result['nama_barang']; ?></td> 
    <td><?php echo $result['tanggal']; ?></td>
    <td><?php echo $result['lokasi']; ?></td>
    <td><?php echo $result['kondisi']; ?></td>
    <td><?php echo $result['acquisval']; ?></td> 
    <td><?php echo $result['accumdep']; ?></td> 
    <td><?php echo $result['total']; ?></td>
    <td><?php echo $result['currency']; ?></td>
  </tr>   
  </tr>
<?php
}
?>
</table>
</span>
