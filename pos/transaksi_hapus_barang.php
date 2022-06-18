<?php
include "template/header.php";

$id=$_GET['id'];
$sqlnya = $koneksi->query("DELETE FROM t_sales_det WHERE sales_id='$id'" );

                if ($sqlnya) {
                  echo "<script>alert('Data Barang Berhasil Dihapus');</script>";
                  echo "<script>location='transaksi_tambah.php';</script>";  
                  }else{
                    echo "<script>alert('Data Barang Gagal Dihapus');</script>";
                    echo "<script>location='transaksi_tambah.php';</script>";
                }
?>