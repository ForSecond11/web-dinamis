<script src="js/jquery-ui.js"></script>
	<script>
	$(function() {
		$( "#datepicker2" ).datepicker();
	});
	</script>
<?php
ob_start();
if(isset($_GET['id']))
{
	$rs=mysqli_query($GLOBALS["___mysqli_ston"], "Select * from data_barang where kode_barang='".$_GET['id']."'");
	$row=mysqli_fetch_array($rs);
?>
<form name="form1" method="post" action="?cat=gudang&page=barangedit&id=<?php echo $_GET['id']; ?>&edit=1">
	<h1><?php echo "Kode Barang : ".$row['kode_barang']; ?></h1>
	<label>Nama Alat</label>
	<input type="text" name="namabarang" id="namabarang" value="<?php echo $row['nama_barang']; ?>">
	<label>Gambar</label>
	<input type="text" name="gambar" id="gambar" value="<?php echo $row['gambar']; ?>">
    <label>Tanggal Terima</label>
    <input type="text" name="tanggal_terima" id="datepicker" placeholder="Pilih tanggal.." value="<?php echo $row['tgl_terima'];?>">
    <label>Kondisi</label>
     <select name="kondisi" id="kondisi" >
     	<option value="">-- Tanpa Kondisi --</option>
     <?php $aa=mysqli_query($GLOBALS["___mysqli_ston"], "Select * from kondisi order by nama_kondisi"); 
     while($result = mysqli_fetch_array($aa)){ ?>
		<option value="<?php echo $result['nama_kondisi'];?>"><?php echo $result['nama_kondisi'];?></option>
	 <?php }?>
  	</select>
    <label>Tanggal Maintenance</label>
    <input type="text" name="tgl_mtn" id="datepicker2" value="<?php echo $row['tgl_mtn'];?>" >
    <label>Kondisi Setelah Maintenance</label>
    <input type="text" name="after_mtn" id="accumdep" value="<?php echo $row['kondisi_stlh_mtn'];?>">
	 <label>Teknisi Pengecekan</label>
    <input type="text" name="teknisi_pengecekan" id="accumdep" value="<?php echo $row['teknisi_pengecekan'];?>">
    <label>Badan Teknisi</label>
     <select name="badan_teknisi" id="currency" >
        <option value="elban">ELBAN</option>
        <option value="peralatan">PERALATAN</option>
		 <option value="peralatan">LISTRIK</option>
  </select>
   
      <p></p>
      <input type="submit" class="btn btn-primary" name="button" id="button" value="Ubah">&nbsp;&nbsp;<input type="reset" class="btn btn-danger" name="reset" id="reset" value="Batal" onclick="window.location='?cat=gudang&page=barang'">
</form>
<?php
ob_end_flush();
}else{
	echo "<script>window.location='?cat=gudang&page=barang'</script>";
}
?>
<?php
if(isset($_GET['edit']))
{
	//$total=$_POST['acquisval']-$_POST['accumdep'];
	$rs=mysqli_query($GLOBALS["___mysqli_ston"], "Update data_barang SET nama_barang='".$_POST['namabarang']."',gambar='".$_POST['gambar']."',tgl_terima='".$_POST['tanggal_terima']."',kondisi='".$_POST['kondisi']."',tgl_mtn='".$_POST['tgl_mtn']."',kondisi_stlh_mtn='".$_POST['after_mtn']."',teknisi_pengecekan='".$_POST['teknisi_pengecekan']."',badan_teknisi='".$_POST['badan_teknisi']."' Where kode_barang='".$_GET['id']."'");
	if($rs)
	{
		echo "<script>window.location='?cat=gudang&page=barang'</script>";
	}
}
?>
