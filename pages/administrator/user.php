<?php
ob_start();
include '_db.php'; 
?>
<form name="form1" method="post" action="?cat=administrator&page=user&act=1">
  <label>Username</label>

      <input type="text" name="username" id="username">
      <label>Password</label>
      <input type="text" name="password" id="password">
      <label>Jenis Login</label>
     <select name="jenis" id="jenis">
        <option value="gudang">Bagian Gudang</option>
        <option value="sekretaris">Sekretaris</option>
        <option value="pimpinan">Pimpinan</option>
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
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-striped">
  <tr>
    <td>Username</td>
    <td>Jenis Login</td>   
    <td>&nbsp;</td>
  </tr>
  <?php
  $rw=mysqli_query($conn, "Select * from user_login");
  while($s=mysqli_fetch_array($rw))
  {
  ?>
  <tr>
    <td><?php echo $s['username']; ?></td>
    <td><?php echo $s['login_hash']; ?></td>

    <td><a href="?cat=administrator&page=useredit&id=<?php echo sha1($s['username']); ?>">Edit</a> - <a href="?cat=administrator&page=user&del=1&id=<?php echo sha1($s['username']); ?>">Hapus</a></td>
  </tr>
  <?php
  }
  ?>
</table>
</span>
<?php
if(isset($_GET['act']))
{
	
	$rs=mysqli_query($conn, "Insert into user_login (`username`,`password`,`login_hash`) values ('".$_POST['username']."','".md5($_POST['password'])."','".$_POST['jenis']."')") or die(mysqli_error($conn));
	if($rs)
	{
		echo "<script>window.location='?cat=administrator&page=user'</script>";
	}
}
?>

<?php
if(isset($_GET['del']))
{
	$ids=$_GET['id'];
	$ff=mysqli_query($conn, "Delete from user_login Where sha1(username)='".$ids."'");
	if($ff)
	{
		echo "<script>window.location='?cat=administrator&page=user'</script>";
	}
}
?>