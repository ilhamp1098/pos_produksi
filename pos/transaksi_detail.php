<?php
include "template/header.php";
include "template/sidebar.php";

$id=$_GET['id'];
$tampil =$koneksi->query("SELECT  t_sales.kode,
                                t_sales.tgl,
                                m_customer.name,
                                SUM(t_sales_det.qty) as qty,
                                t_sales.subtotal,
                                t_sales.diskon,
                                t_sales.ongkir,
                                t_sales.total_bayar,
                                t_sales.id
                            
                            FROM t_sales 
                                JOIN t_sales_det ON t_sales_det.no_transaksi = t_sales.kode
                                JOIN m_customer ON m_customer.id = t_sales.cust_id
                                WHERE t_sales.id = '$id'");
         $tampilCus=$tampil->fetch_assoc();  
$kode = $tampilCus['kode'];
?>


 <!-- Page Heading -->
<div class="col-xl-12 col-lg-12 col-md-9">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Transaksi Detail</h6>
                            
                        </div>
                        <div class="card-body">
<a href="transaksi.php" class="btn btn-warning" style="float:right"><i class="fas fa-arrow-left"></i> Kembali</a>                            
<table style="float: left;">
    <tr>
        <th>No. Transaksi</th>
        <td>:</td>
        <td>
          <?= $tampilCus['kode']; ?>
        </td>
    </tr>
    <tr>
        <th>Tanggal</th>
        <td>:</td>
        <td>
        <?= $tampilCus['tgl']; ?>
        </td>
    </tr>
    <tr>
        <th>Nama Customer</th>
        <td>:</td>
        <td>
        <?= $tampilCus['name']; ?>
        </td>
    </tr>
</table> 


                            <div class="table-responsive">
                               
                                <table class="table table-bordered" id="" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th rowspan="2">Kode Barang</th>
                                            <th rowspan="2">Nama Barang</th>
                                            <th rowspan="2">QTY</th>
                                            <th rowspan="2">Harga Bandrol</th>
                                            <td colspan="2" align="center">Diskon</td>
                                            
                                            <th rowspan="2">Harga Diskon</th>
                                            <th rowspan="2">Total</th>
                                        </tr> 
                                        <tr>
                                            
                                            
                                            <th>%</th>
                                            <th>Rp</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
$tampil =$koneksi->query("SELECT m_barang.kode,
                            m_barang.nama,
                            t_sales_det.qty,
                            m_barang.harga,
                            m_barang.diskon,
                            t_sales_det.diskon_nilai,
                            t_sales_det.harga_diskon,
                            t_sales_det.total,
                            t_sales_det.sales_id
                            FROM t_sales_det 
                            JOIN m_barang ON m_barang.id = t_sales_det.barang_id
                            WHERE t_sales_det.no_transaksi ='$kode'
                            ORDER BY t_sales_det.sales_id desc");
                $no=1;
while($tampilBrg=$tampil->fetch_assoc()){
        $id = $tampilBrg['sales_id'];
        
?>                                        
                                        <tr>

                                            <td>
                                                <?= $tampilBrg['kode'];?>                                           
                                            </td>
                                            <td><?= $tampilBrg['nama'];?></td>
                                            <td><?= $tampilBrg['qty'];?></td>
                                            <td>Rp. <?= number_format($tampilBrg['harga']);?></td>
                                            <td><?= $tampilBrg['diskon'];?>%</td>
                                            <td>Rp. <?= number_format($tampilBrg['diskon_nilai']);?></td>
                                            <td>Rp. <?= number_format($tampilBrg['harga_diskon']);?></td>
                                            <td>Rp. <?= number_format($tampilBrg['total']);?></td>
                                        </tr>
                                        


                                        
                                        
<?php 
$subtotal = $subtotal +$tampilBrg['total']; 
}
?>                                        
                                    </tbody>
                                </table>
                            </div>

<table style="float: right;">
    <tr>
        <th>Subtotal</th>
        <td>:</td>
        <td>
          Rp. <?= number_format($tampilCus['subtotal']); ?>
        </td>
    </tr>
    <tr>
        <th>Diskon</th>
        <td>:</td>
        <td>
          Rp. <?= number_format($tampilCus['diskon']); ?>
        </td>
    </tr>
    <tr>
        <th>Ongkir</th>
        <td>:</td>
        <td>
          Rp. <?= number_format($tampilCus['ongkir']); ?>
        </td>
    </tr>
    <tr>
        <th>Total Bayar</th>
        <td>:</td>
        <td>
          Rp. <?= number_format($tampilCus['total_bayar']); ?>
        </td>
    </tr>
</table> 
                        </div>
                    </div>                       
</div>






<?php
include "template/footer.php";
?>
