<!-- Modal -->
<div class="modal fade" id="ubahModal<?= $id ?>" tabindex="-1" role="dialog" aria-labelledby="ubahModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ubahModalLabel">Pilih Barang</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
<form method="POST">       
      <div class="modal-body">
                                   

<?php


$show =$koneksi->query("SELECT m_barang.kode,
                            m_barang.nama,
                            t_sales_det.qty,
                            m_barang.harga,
                            m_barang.diskon,
                            t_sales_det.diskon_nilai,
                            t_sales_det.harga_diskon,
                            t_sales_det.total,
                            t_sales_det.sales_id,
                            t_sales_det.barang_id
                            FROM t_sales_det 
                            JOIN m_barang ON m_barang.id = t_sales_det.barang_id
                            WHERE t_sales_det.sales_id='$id'");
$showTrans=$show->fetch_assoc();                 


?>                                        
                                    <form class="user" method="POST">
                                        <div class="form-group">
                                            <label>Kode Barang</label>   
                                            <input type="text" class="form-control "
                                                value="<?= $showTrans['kode']; ?>"
                                                readonly>
                                            <input type="hidden" class="form-control "
                                                value="<?= $showTrans['barang_id']; ?>"
                                                readonly name="barang_id" id="barang_id">  
                                            <input type="hidden" class="form-control "
                                                value="<?= $showTrans['sales_id']; ?>"
                                                readonly name="sales_id" id="sales_id">                                                  
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Barang</label>   
                                            <input type="text" class="form-control "
                                                id="nama" name="nama" 
                                                value="<?= $showTrans['nama']; ?>"
                                                placeholder="Nama Barang" readonly maxlength="100">
                                        </div>
                                        <div class="form-group">
                                            <label>QTY</label>  
                                            <input type="number" class="form-control "
                                            value="<?= $showTrans['qty']; ?>"
                                                id="qty" name="qty" min="0" placeholder="Qty Barang" required>
                                        </div>                                      
                                        <button type="submit" class="btn btn-success" name="ubah"><i class="fas fa-cog"></i> Ubah Data</button>

                                    </form>                                  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
</form>      
    </div>
  </div>
</div>

<?php 
if(isset($_POST["ubah"])){
    $qty=htmlspecialchars($_POST["qty"]);
    $barang_id=htmlspecialchars($_POST["barang_id"]);
    $sales_id=htmlspecialchars($_POST["sales_id"]);
  $sql = mysqli_query($koneksi, "SELECT * FROM m_barang WHERE id='$barang_id'");
  $data = mysqli_fetch_array($sql);
  
  $kode= $data['kode'];
  $nama= $data['nama'];
  $harga= $data['harga'];
  $diskon= $data['diskon'];
  
   $diskonharga = $harga *$diskon/100;  
 $hargadiskon = $harga - $diskonharga;
 $total = ($harga*$qty)-($diskonharga*$qty);
//  echo "<script>alert('$id $kode $nama $harga $diskon $qty $diskonharga $hargadiskon $total');</script>";

$sqlubah = $koneksi->query("UPDATE t_sales_det set qty='$qty', harga_diskon='$hargadiskon', total='$total' WHERE sales_id='$sales_id'");
if ($sqlubah) {
echo "<script>alert('Data Barang Berhasil Diubah');</script>";    
  echo "<script>location='transaksi_tambah.php';</script>";  
}else{
    echo "<script>alert('Data Barang Gagal Diubah');</script>";    
  echo "<script>location='transaksi_tambah.php';</script>"; 
}
}
?>
