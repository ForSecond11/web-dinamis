<script src="js/jquery-ui.js"></script>
	<script>
	$(function() {
		$( "#datepicker2" ).datepicker();
	});
	</script>

<?php
ob_start();
?>
<form name="form1" method="post" action="?cat=gudang&page=barang&act=1">
 
      <label>Nomor</label>
      <input type="text" name="idbarang" id="idbarang" />
	  
      <label>Nama Alat</label>
      <input type="text" name="namabarang" id="namabarang"/>
	 
      <label>Gambar</label>
    <input type="text" name="gambar" id="gambar"/>
 <label>Tanggal Terima</label>
  <input type="text" name="tanggal_terima" id="datepicker" placeholder="Pilih tanggal.." />
  <label>Kondisi</label>
       <select name="kondisi" id="kondisi" >
     	<option value="">-- Tanpa Kondisi --</option>
     <?php $aa=mysqli_query($GLOBALS["___mysqli_ston"], "Select * from kondisi order by nama_kondisi"); 
     while($result = mysqli_fetch_array($aa)){ ?>
		<option value="<?php echo $result['nama_kondisi'];?>"><?php echo $result['nama_kondisi'];?></option>
	 <?php }?>
  	</select>
 <label>Tanggal Maintenance</label>
     <input type="text" name="tgl_mtn" id="datepicker2" placeholder="Pilih tanggal.." />
      <label>Kondisi Setelah Maintenance</label>
      <input type="text" name="after_mtn" id="accumdep" />
	   <label>Teknisi Pengecekan</label>
      <input type="text" name="teknisi_pengecekan" id="namabarang">
  <label>Badan Teknisi</label>
     <select name="badan_teknisi" id="currency" >
        <option value="elban">ELBAN</option>
        <option value="peralatan">PERALATAN</option>
		 <option value="peralatan">LISTRIK</option>
  </select>
   
      <p></p>
      <input type="submit" class="btn btn-primary" name="button" id="button" value="Daftar">&nbsp;&nbsp;<input type="reset" class="btn btn-danger" name="reset" id="reset" value="Reset">
</form>
<?php
ob_end_flush();
?>
<p></p>
<p></p>
