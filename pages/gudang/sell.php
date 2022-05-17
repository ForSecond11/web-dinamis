<script src="js/jquery-ui.js"></script>
<h2>Entry Barang Keluar</h2>
<form name="form1" method="post" action="" autocomplete="on">

<table width="50%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>Tanggal</td>
    <td><input type="text" name="tglr" id="datepicker" placeholder="Pilih tanggal.." /></td>
  </tr>
  <tr>
    <td width="40%">Kode Barang</td>
    <td width="60%"><label for="kodebarang"></label>
      <input type="text" name="kodebarang" id="kodebarang" placeholder="Pilih Barang.."  onClick="window.open('pages/web/viewbarang.php','popuppage','width=500,toolbar=0,resizable=0,scrollbars=no,height=400,top=100,left=100');">
     
</td>
  </tr>
  <tr>
    <td>Nama Barang</td>
    <td><input name="namabarang" type="text" id="namabarang" readonly="readonly"></td>
  </tr>
  <tr>
    <td>QTY</td>
    <td><input type="text" name="qty" id="qty"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><p></p><input type="submit" class="btn btn-primary" name="button" id="button" value="Tambah"></td>
  </tr>

</table>
</form>

<?php
if(isset($_POST['button']))
{
	$newDate = date("Y-m-d", strtotime($_POST['tglr']));
	
	$q2=mysqli_query($GLOBALS["___mysqli_ston"], "Select * from data_persediaan where kode_barang='".$_POST['kodebarang']."'");
	$rw=mysqli_fetch_array($q2);
	$rc=mysqli_num_rows($q2);
	if($rc==1)
	{
		if($_POST['qty'] < $rw['stok_tersedia'])
		{
			$q=mysqli_query($GLOBALS["___mysqli_ston"], "Insert into barang_keluar (`tgl`,`kode_barang`,`jumlah`) values ('".$newDate."','".$_POST['kodebarang']."','".$_POST['qty']."')") or die(mysqli_error($GLOBALS["___mysqli_ston"]));
			if($q)
			{
				$qr=mysqli_query($GLOBALS["___mysqli_ston"], "Select sum(jumlah) as jl from barang_keluar Where kode_barang='".$_POST['kodebarang']."'");
				$rw22=mysqli_fetch_array($qr);
				
				$q3=mysqli_query($GLOBALS["___mysqli_ston"], "Update data_persediaan SET keluar=".$rw22['jl'].",stok_tersedia=stok_tersedia - ".$_POST['qty']." Where kode_barang='".$_POST['kodebarang']."'");
				if($q3)
				{
					echo "Data sudah disimpan";
				}
			}
		}else{
		echo "'Stok barang kurang";
		}
	}else{
		echo "Mau jual, tapi barang kosong? Hellowwww..";
	}
}
?>
