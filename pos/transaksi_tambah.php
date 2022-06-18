<?php
include "template/header.php";
include "template/sidebar.php";
  $sql = mysqli_query($koneksi, "SELECT id FROM t_sales order by id desc limit 1");
  $data = mysqli_fetch_array($sql);
  $no=$data['id'];
$urutan = $no+1;
date_default_timezone_set('Asia/Jakarta');
        $tgl = date("Ym");
$no = $tgl."-". sprintf("%04s", $urutan);
$subtotal = 0;
?>


 <!-- Page Heading -->
<div class="col-xl-12 col-lg-12 col-md-9">
<form method="POST">     
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Tambah Data Transaksi</h6>
                        </div>
                        <div class="card-body">
                            <h7 class="m-0 font-weight-bold text-primary">Transaksi</h7>                         
                                    <form class="user" method="POST">
                                        <div class="form-group">
                                            <label>No</label>   
                                            <input type="text" class="form-control "
                                                id="notransaksi" name="notransaksi" 
                                                readonly value="<?= $no ;?>"
                                                >
                                        </div> 
                                        <div class="form-group">
                                            <label>Tanggal</label>   
                                            <input type="date" class="form-control "
                                                id="tgltransaksi" name="tgltransaksi" 
                                                required value="<?php echo date("Y-m-d"); ?>"
                                                >
                                        </div>           
                            <h7 class="m-0 font-weight-bold text-primary">Customer</h7>                                          
                                        <div class="form-group">
          <select class="form-control" name="customer" id="customer" required>
<?php
$tampil =$koneksi->query("SELECT * FROM m_customer ORDER BY id desc");
                
while($tampilCus=$tampil->fetch_assoc()){
    $id = $tampilCus['id'];
?>                  
              
              <option value="<?= $tampilCus['id']?>"><?= $tampilCus['name']?></option>
<?php 
                                        }
?>              
          </select>   
                                        </div>

                                         <div class="form-group"  id="tabel_customer" name="tabel_customer"></div>                                          
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pilihModal">
  Pilih Barang
</button>

<br>
<br>
                            <div class="table-responsive">
                               
                                <table class="table table-bordered" id="" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th rowspan="2">Opsi</th>
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
                            WHERE t_sales_det.no_transaksi IS NULL
                            ORDER BY t_sales_det.sales_id desc");
                $no=1;
while($tampilCus=$tampil->fetch_assoc()){
        $id = $tampilCus['sales_id'];
        
?>                                        
                                        <tr>
                                            <td>
                                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#ubahModal<?= $id ?>">
                                                  Ubah
                                                </button>  
                                                <?php include "transaksi_ubah_barang.php"; ?>
                                                <a href="transaksi_hapus_barang.php?id=<?php echo $tampilCus['sales_id']; ?>" 
                                                class="btn btn-danger" onclick="return confirm('Yakin Akan Hapus Data Barang?');">
                                                Hapus</a>




                                            </td>
                                            <td>
                                                <input type='hidden' name='update[]' value='<?= $id ?>' >
                                                <?= $tampilCus['kode'];?>                                           
                                            </td>
                                            <td><?= $tampilCus['nama'];?></td>
                                            <td><?= $tampilCus['qty'];?></td>
                                            <td>Rp. <?= number_format($tampilCus['harga']);?></td>
                                            <td><?= $tampilCus['diskon'];?>%</td>
                                            <td>Rp. <?= number_format($tampilCus['diskon_nilai']);?></td>
                                            <td>Rp. <?= number_format($tampilCus['harga_diskon']);?></td>
                                            <td>Rp. <?= number_format($tampilCus['total']);?></td>
                                        </tr>
                                        


                                        
                                        
<?php 
$subtotal = $subtotal +$tampilCus['total']; 
}
?>                                        
                                    </tbody>
                                </table>


                            </div>
<table style="float: right;">
    <tr>
        <th>Subtotal</th>
        <td>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Rp. </span>
            <input type="number" class="form-control" name="angkasubtotal" id="angkasubtotal" min="0" value="<?= $subtotal; ?>" onchange="totalnya()" readonly>
        </div>
        </td>
    </tr>
    <tr>
        <th>Diskon</th>
        <td>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Rp. </span>
            <input type="number" name="angkadiskon" id="angkadiskon" min="0" value="0" class="form-control" onchange="totalnya()">
        </div>            
        </td>
    </tr>
    <tr>
        <th>Ongkir</th>
        <td>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Rp. </span>
            <input type="number" name="angkaongkir" id="angkaongkir" min="0" value="0" class="form-control" onchange="totalnya()">
        </div>                
        </td>
    </tr>
    <tr>
        <th>Total Bayar</th>
        <td>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Rp. </span>
            <input type="number"  name="total_jumlah" id="total_jumlah" class="form-control"value="" readonly>
        </div>              
        </td>
    </tr>
</table> 


		<script type="text/javascript">
		function totalnya() {
		    var vangkasubtotal = parseInt(document.getElementById('angkasubtotal').value);
		var vangkaongkir = parseInt(document.getElementById('angkaongkir').value);
		var vangkadiskon = parseInt(document.getElementById('angkadiskon').value);

		var jumlah_harga = vangkasubtotal  - vangkadiskon + vangkaongkir;

		document.getElementById('total_jumlah').value = jumlah_harga;
		}
		
		</script>
        <div class="input-group mb-3">
            <button type="submit" class="btn btn-primary" name="save"><i class="fas fa-plus"></i> Tambah Data</button>
            <a href="transaksi.php" class="btn btn-warning" style="margin-left:1%;"><i class="fas fa-arrow-left"></i> Kembali</a>
        </div>
                                        


                        </div>
                    </div>
</form>                    
</div>

<?php

            if(isset($_POST['save'])){
$notransaksi=htmlspecialchars($_POST["notransaksi"]);
$tgltransaksi=htmlspecialchars($_POST["tgltransaksi"]);
$customer=htmlspecialchars($_POST["customer"]);

$angkasubtotal=htmlspecialchars($_POST["angkasubtotal"]);
$angkadiskon=htmlspecialchars($_POST["angkadiskon"]);
$angkaongkir=htmlspecialchars($_POST["angkaongkir"]);

$total_bayar = $angkasubtotal - $angkadiskon + $angkaongkir;

foreach($_POST['update'] as $updateid){
 
$sqlubah = $koneksi->query("UPDATE t_sales_det set no_transaksi='$notransaksi' WHERE sales_id='$updateid'");
}


                    //  echo "<script>alert('Data $notransaksi $tgltransaksi $customer $angkasubtotal $angkadiskon $angkaongkir $total_bayar');</script>";  
                    $sqlnya = $koneksi->query("INSERT INTO t_sales (id,kode,tgl,cust_id,subtotal,diskon,ongkir,total_bayar) 
                    VALUES (null,'$notransaksi','$tgltransaksi','$customer','$angkasubtotal','$angkadiskon','$angkaongkir','$total_bayar')");
                    
                    if ($sqlnya) {
                      echo "<script>alert('Data Transaksi Berhasil Dibuat');</script>";
                      echo "<script>location='transaksi.php';</script>";  
                      }else{
                        echo "<script>alert('Data Transaksi Gagal Dibuat');</script>";
                        echo "<script>location='transaksi_tambah.php';</script>";
                    }
                

               
            }
        ?> 

 

<!-- Modal -->
<div class="modal fade" id="pilihModal" tabindex="-1" role="dialog" aria-labelledby="pilihModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="pilihModalLabel">Pilih Barang</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
<form method="POST">       
      <div class="modal-body">
                            <div class="table-responsive">          
                                <table class="table table-bordered" id="tb_barang" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Check<br><input type='checkbox' id='checkAll' ></th>
                                            <th>QTY</th>
                                            <th>Kode</th>
                                            <th>Nama Barang</th>
                                            <th>Harga</th>
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
                                            <td>
                                                <input type="number" name="qty<?= $id ?>" id="qty<?= $id ?>" min="0" value="0" class="form-control"
                                                style="width: 100px;"
                                                 oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                                maxlength = "3"    
                                                    >
                                            </td>
                                            <td><?= $tampilCus['kode']?></td>
                                            <td><?= $tampilCus['nama']?></td>
                                            <td>Rp. <?= number_format($tampilCus['harga']);?></td>
                                        </tr>
<?php 
                                        }
?>                                        
                                    </tbody>
                                </table>
                            </div>                                
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="pilih" id="pilih" class="btn btn-primary">Pilih Barang</button>
      </div>
</form>      
    </div>
  </div>
</div>
<?php

            if(isset($_POST['pilih'])){
                foreach($_POST['update'] as $updateid){
  $sql = mysqli_query($koneksi, "SELECT * FROM m_barang WHERE id='$updateid'");
  $data = mysqli_fetch_array($sql);
  
  $kode= $data['kode'];
  $nama= $data['nama'];
  $harga= $data['harga'];
  $diskon= $data['diskon'];
  
  $qty = $_POST['qty'.$updateid];
 $diskonharga = $harga *$diskon/100;  
 $hargadiskon = $harga - $diskonharga;
 $total = ($harga*$qty)-($diskonharga*$qty);
    // echo "<script>alert('$updateid $kode $nama $harga $diskon $qty $diskonharga $hargadiskon $total');</script>";

if ($qty>0) {
                    $sqlnya = $koneksi->query("INSERT INTO t_sales_det (sales_id,barang_id,harga_bandrol,qty,diskon_pct,diskon_nilai,harga_diskon,total) 
                VALUES (null,'$updateid','$harga','$qty','$diskon','$diskonharga','$hargadiskon','$total')");
}                    
                    
                }
                if ($sqlnya) {
                  echo "<script>alert('Data Barang Berhasil Dipilih');</script>";
                  echo "<script>location='transaksi_tambah.php';</script>";  
                  }else{
                    echo "<script>alert('Data Barang Gagal Dipilih');</script>";
                    echo "<script>location='transaksi_tambah.php';</script>";
                }
               
            }
        ?>  



<?php
include "template/footer.php";
?>
<script type="text/javascript">

    $(document).ready(function(){

        $('#customer').change(function(){

            //Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax
            var customer = $('#customer').val();
            
            $.ajax({
                type : 'GET',
                url : 'cek_customer.php',
                data :  'customer=' + customer,
                    success: function (data) {

                    //jika data berhasil didapatkan, tampilkan ke dalam option select kabupaten
                    $("#tabel_customer").html(data);
                }
                
            });
        });
        
		$('#customer').ready(function(){

			//Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax
			var customer = $('#customer').val();

      		$.ajax({
            	type : 'GET',
           		url : 'cek_customer.php',
            	data :  'customer=' + customer,
					success: function (data) {

					//jika data berhasil didapatkan, tampilkan ke dalam option select kabupaten
					$("#tabel_customer").html(data);
				}
          	});
		});        




        
    });
</script> 

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

