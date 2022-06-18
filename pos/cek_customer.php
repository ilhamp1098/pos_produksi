<?php 
   include "template/header.php";
  
  $customer = $_GET['customer'];

// echo "$customer";
$tampil =$koneksi->query("SELECT * FROM m_customer where id='$customer' ");
         $tampilCus=$tampil->fetch_assoc();   
       
 ?>
 
                                        <div class="form-group">
                                            <label>Kode Customer</label>   
                                            <input type="text" class="form-control "
                                                
                                                readonly value="<?= $tampilCus['kode'] ;?>"
                                                >
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Customer</label>   
                                            <input type="text" class="form-control "
                                                
                                                readonly value="<?= $tampilCus['name'] ;?>"
                                                >
                                        </div>
                                        <div class="form-group">
                                            <label>No. Telp</label>   
                                            <input type="text" class="form-control "
                                                
                                                readonly value="<?= $tampilCus['telp'] ;?>"
                                                >
                                        </div>                                        