<?php
include "template/header.php";
include "template/sidebar.php";

?>

 <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Barang</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Barang</h6>
                        </div>
                        <div class="card-body">
                                    <a href="barang_tambah.php" class="btn btn-success btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-plus"></i>
                                        </span>
                                        <span class="text">Tambah Data Barang</span>
                                    </a>      
                                    <br>
                                    <br>                                    
                            <div class="table-responsive">
<form method="POST">                                
                                <table class="table table-bordered" id="tb_barang" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th><input type='checkbox' id='checkAll' > Check</th>
                                            <th>Kode</th>
                                            <th>Nama Barang</th>
                                            <th>Harga</th>
                                            <th>Diskon %</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
$tampil =$koneksi->query("SELECT * FROM m_barang ORDER BY id desc");
                
while($tampilCus=$tampil->fetch_assoc()){
        $id = $tampilCus['id'];
?>                                        
                                        <tr>
                                            <td>
                                                <input type='checkbox' name='update[]' value='<?= $id ?>' >
                                            </td>
                                            <td><a href="barang_ubah.php?id=<?= $tampilCus['id']?>"><?= $tampilCus['kode']?></a></td>
                                            <td><?= $tampilCus['nama']?></td>
                                            <td>Rp. <?= number_format($tampilCus['harga']);?></td>
                                            <td><?= $tampilCus['diskon'];?>%</td>
                                        </tr>
<?php 
                                        }
?>                                        
                                    </tbody>
                                </table>
<button type='submit' class="btn btn-danger" name='but_hapus' onclick="return confirm('Yakin Akan Hapus Data Barang?');">  
<i class="fa fa-trash"></i> Hapus Data
</button> 
</form>
                            </div>
                        </div>
                    </div>                       


<?php

            if(isset($_POST['but_hapus'])){
                foreach($_POST['update'] as $updateid){

                  
                    $sqlnya = $koneksi->query("DELETE FROM m_barang WHERE id='$updateid'" );
                    
                    
                }
                if ($sqlnya) {
                  echo "<script>alert('Data Barang Berhasil Dihapus');</script>";
                  echo "<script>location='barang.php';</script>";  
                  }else{
                    echo "<script>alert('Data Barang Gagal Dihapus');</script>";
                    echo "<script>location='barang.php';</script>";
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
  $('#tb_barang').DataTable({
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