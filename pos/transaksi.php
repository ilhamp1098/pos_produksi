<?php
include "template/header.php";
include "template/sidebar.php";

?>

 <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Transaksi</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Transaksi</h6>
                        </div>
                        <div class="card-body">
                                    <a href="transaksi_tambah.php" class="btn btn-success btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-plus"></i>
                                        </span>
                                        <span class="text">Tambah Data Transaksi</span>
                                    </a>      
                                    <br>
                                    <br>                                    
                            <div class="table-responsive">
<form method="POST">                                
                                <table class="table table-bordered" id="tb_Transaksi" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th><input type='checkbox' id='checkAll' > Check</th>
                                            <th>No.</th>
                                            <th>Kode</th>
                                            <th>Tanggal</th>
                                            <th>Nama Customer</th>
                                            <th>Jumlah Barang</th>
                                            <th>Subtotal</th>
                                            <th>Diskon</th>
                                            <th>Ongkir</th>
                                            <th>Total Bayar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
$no=1;
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
                                GROUP BY t_sales.id
                            ORDER BY t_sales.id desc");
                
while($tampilCus=$tampil->fetch_assoc()){
        $id = $tampilCus['id'];
?>                                        
                                        <tr>
                                             <td>
                                                <input type='checkbox' name='update[]' value='<?= $id ?>' >
                                            </td>
                                            <tD><?= $no++;?></tD>
                                            <td>
                                               <a href="transaksi_detail.php?id=<?= $tampilCus['id']?>"><?= $tampilCus['kode']?></a>
                                            </td>
                                            <td><?= $tampilCus['tgl']?></td>
                                            <td><?= $tampilCus['name']?></td>
                                            <td><?= $tampilCus['qty']?></td>
                                            <td>Rp. <?= number_format($tampilCus['subtotal']);?></td>
                                            <td>Rp. <?= number_format($tampilCus['diskon']);?></td>
                                            <td>Rp. <?= number_format($tampilCus['ongkir']);?></td>
                                            <td>Rp. <?= number_format($tampilCus['total_bayar']);?></td>
                                        </tr>
<?php 
                                        }
?>                                        
                                    </tbody>
                                </table>
<button type='submit' class="btn btn-danger" name='but_hapus' onclick="return confirm('Yakin Akan Hapus Data Transaksi?');">  
<i class="fa fa-trash"></i> Hapus Data
</button> 
</form>
                            </div>
                        </div>
                    </div>                       


<?php

            if(isset($_POST['but_hapus'])){
                foreach($_POST['update'] as $updateid){
  $sql = mysqli_query($koneksi, "SELECT * FROM t_sales WHERE id='$updateid'");
  $data = mysqli_fetch_array($sql);
  $kode= $data['kode'];        
                    $sqlsales = $koneksi->query("DELETE FROM t_sales WHERE id='$updateid'" );
                    $sqlsales_det = $koneksi->query("DELETE FROM t_sales_det WHERE no_transaksi='$kode'" );
                    
                }
                if ($sqlsales) {
                  echo "<script>alert('Data Transaksi Berhasil Dihapus');</script>";
                  echo "<script>location='transaksi.php';</script>";  
                  }else{
                    echo "<script>alert('Data Transaksi Gagal Dihapus');</script>";
                    echo "<script>location='transaksi.php';</script>";
                }
               
            }
        ?>  





<?php
include "template/footer.php";
?>

<script type="text/javascript">
            $(document).ready(function(){

                // Check/Uncheck ALl
                $('#checkAll').change(function(){
                    if($(this).is(':checked')){
                        $('input[name="update[]"]').prop('checked',true);
                    }else{
                        $('input[name="update[]"]').each(function(){
                            $(this).prop('checked',false);
                        }); 
                    }
                });

                // Checkbox click
                $('input[name="update[]"]').click(function(){
                    var total_checkboxes = $('input[name="update[]"]').length;
                    var total_checkboxes_checked = $('input[name="update[]"]:checked').length;

                    if(total_checkboxes_checked == total_checkboxes){
                        $('#checkAll').prop('checked',true);
                    }else{
                        $('#checkAll').prop('checked',false);
                    }
                });
            });
</script>

<script>
    $(document).ready(function() {
  $('#tb_Transaksi').DataTable({
  columnDefs: [
    { orderable: false, targets: 0 }
  ],        
        "pageLength": 25,
        "language": {
    "decimal":        "",
    "emptyTable":     "Tidak ada data di dalam tabel",
    "info":           "Ditampilkan _START_ sampai _END_ dari _TOTAL_ data",
    "infoEmpty":      "Ditampilkan 0 sampai 0 dari 0 data",
    "infoFiltered":   "(Disaring dari _MAX_ total data)",
    "infoPostFix":    "",
    "thousands":      ",",
    "lengthMenu":     "Tampilkan _MENU_ Data",
    "loadingRecords": "Memuat...",
    "processing":     "Pemrosesan...",
    "search":         "Cari Data:",
    "zeroRecords":    "Data yang dicari tidak ditemukan",
    "paginate": {
        "first":      "Awal",
        "last":       "Akhir",
        "next":       "&#10095;",
        "previous":   "&#10094;"
    }

    }
});
});

</script>