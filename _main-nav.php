<!--NAVIGASI MENU UTAMA-->

<div class="leftmenu">
  <ul class="nav nav-tabs nav-stacked">
    <li class="active"><a href="dashboard.php"><span class="icon-align-justify"></span> Dashboard</a></li>
    
    <!--MENU GUDANG-->
    <?php
	if($_SESSION['login_hash']=="gudang")
	{
	?>
    <li class="dropdown"><a href="#"><span class="icon-th-list"></span> Data Master</a>
      <ul>
        <li><a href="?cat=gudang&page=barang">Master Barang</a></li>
        <li><a href="?cat=gudang&page=kondisi">Master Kondisi</a></li>
      </ul>
    </li>        
    <li class="dropdown"><a href="#"><span class="icon-pencil">Laporan</span></a>
      <ul>
        <li><a href="?cat=gudang&page=monthreporting">excel</a></li>
        <li><a href="?cat=gudang&page=laporannamabarang">Laporan Menurut Nama Barang</a></li>
        <li><a href="?cat=gudang&page=laporankondisibarang">Laporan Menurut Kondisi Barang</a></li>    
      </ul>
    </li>
    <?php
	}elseif($_SESSION['login_hash']=="sekretaris"){
	?>
   
     <!--MENU ADMIN-->
        <?php
	}elseif($_SESSION['login_hash']=="administrator"){
	?>    
    <li class="dropdown"><a href="#"><span class="icon-pencil"></span> System</a>
      <ul>       
        <li><a href="?cat=administrator&page=user">User Management</a></li> 
        
      </ul>
    </li>
  	<?php
	}
	?>
  </ul>
</div>
<!--leftmenu-->

</div>
<!--mainleft--> 
<!-- END OF LEFT PANEL -->