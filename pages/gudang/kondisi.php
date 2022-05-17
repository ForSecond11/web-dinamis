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
<h2>Data Kondisi</h2> <a href="?cat=gudang&page=kondisiinput" class="btn btn-primary">Tambah Kondisi</a>
<?php 
	/* Koneksi database*/
	include 'pages/web/paging.php'; //include pagination file
	
	//pagination variables
	$hal = (isset($_REQUEST['hal']) && !empty($_REQUEST['hal']))?$_REQUEST['hal']:1;
	$per_hal = 40; //berapa banyak blok
	$adjacents  = 10;
	$offset = ($hal - 1) * $per_hal;
	$reload="?cat=gudang&page=kondisi";
	//Cari berapa banyak jumlah data*/
	
	$count_query   = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT COUNT(id) AS numrows 
FROM kondisi");
	if($count_query === FALSE) {
    die(mysqli_error($GLOBALS["___mysqli_ston"])); 
	}
	$row     = mysqli_fetch_array($count_query);
	$numrows = $row['numrows']; //dapatkan jumlah data
	
	$total_hals = ceil($numrows/$per_hal);

	
	//jalankan query menampilkan data per blok $offset dan $per_hal
	$query = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * from kondisi order by nama_kondisi LIMIT $offset,$per_hal");

?>
<table  class="responsive table table-striped table-bordered" width="500">
<thead>

  <tr>
     <td>No</td>
    <td>Nama Kondisi</td>
    <td>Aksi</td>
    </tr>
  </thead>
<?php $no = 1;
while($result = mysqli_fetch_array($query)){
?>
 
<tr >
    <td><?php echo $no; ?></td>
    <td><?php echo $result['nama_kondisi']; ?></td>
    <td><a class="btn btn-danger" href="?cat=gudang&page=kondisi&del=1&id=<?php echo $result['id']; ?>">Hapus</a></td>   
  </tr>   
  </tr>
<?php $no++;
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
	
	$rs=mysqli_query($GLOBALS["___mysqli_ston"], "Insert into kondisi (`nama_kondisi`) values ('".$_POST['nama_kondisi']."')") or die(mysqli_error($GLOBALS["___mysqli_ston"]));
	if($rs)
	{
		
		echo "<script>window.location='?cat=gudang&page=kondisi'</script>";
	}
}
?>

<?php
if(isset($_GET['del']))
{
	$ids=$_GET['id'];
	$ff=mysqli_query($GLOBALS["___mysqli_ston"], "Delete from kondisi Where id='".$ids."'");
	if($ff)
	{
		echo "<script>window.location='?cat=gudang&page=kondisi'</script>";
	}
}


?>
