<script src="js/jquery-ui.js"></script>

<?php
ob_start();
?>
<form name="form1" method="post" action="?cat=gudang&page=kondisi&act=1">
 
      <label>Nama Kondisi</label>
      <input type="text" name="nama_kondisi" id="nama_kondisi" />
      <input type="submit" class="btn btn-primary" name="button" id="button" value="Simpan">&nbsp;&nbsp;<input type="reset" class="btn btn-danger" name="reset" id="reset" value="Reset">
</form>
<?php
ob_end_flush();
?>
<p></p>
<p></p>

<?php

if (isset($_POST['button'])){
		
	$rs=mysqli_query($GLOBALS["___mysqli_ston"], "Insert into kondisi (`nama_kondisi`) values ('".$_POST['nama_kondisi']."')") or die(mysqli_error($GLOBALS["___mysqli_ston"]));
	if($rs)
	{
		
		echo "<script>window.location='?cat=gudang&page=kondisiinput'</script>";
	}
}
?>