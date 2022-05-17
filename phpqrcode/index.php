<?php    
/*
 * PHP QR Code encoder
 *
 * Exemplatory usage
 *
 * PHP QR Code is distributed under LGPL 3
 * Copyright (C) 2010 Dominik Dzienia <deltalab at poczta dot fm>
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 3 of the License, or any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
 */
    
    
    // set ke lokasi ditulis , tempat untuk temp dihasilkan file PNG
    //$PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;
    
    // html PNG lokasi awalan
    //$PNG_WEB_DIR = 'temp/';

    include "qrlib.php";    
    
    //ofcourse we need rights to create temp dir
  //  if (!file_exists($PNG_TEMP_DIR))
        //mkdir($PNG_TEMP_DIR);
    
  // $filename = $PNG_TEMP_DIR.'test.png'; 
        
    // bentuk pengolahan masukan
    //remember to sanitize user input in real-life solution !!!
    $errorCorrectionLevel = 'L';
    $matrixPointSize = 4;
    
   /* if (isset($_REQUEST['buat'])) { 
    
        //it's very important!
        if (trim($_REQUEST['id']) == '')
            die('data cannot be empty! <a href="?">back</a>');
            
        // user data
        $filename = $PNG_TEMP_DIR.'test'.md5($_REQUEST['id'].'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
        QRcode::png("http://192.168.43.61/angkasapura/dashboard.php?cat=gudang&page=barangedit&id=".$_REQUEST['id'], $filename, $errorCorrectionLevel, $matrixPointSize, 4);    
        
    } else  {    
    
        //default data
        echo     
        QRcode::png('PHP QR Code :)', $filename, $errorCorrectionLevel, $matrixPointSize, 4);    
        
    }   
       
      */  
    //display generated file
   /* echo '<img src="'.$PNG_WEB_DIR.basename($filename).'" /><hr/>';  
    
    //config form
    echo '<form action="index.php" method="post">
         Data:&nbsp;<input name="data" value="" />&nbsp;
          
         </select>&nbsp;
		 <input type="submit" value="UBAH"><a href="javascript:window.print()">	
Klik Cetak </a></font></form><hr/>';
        */
		?>
      

    