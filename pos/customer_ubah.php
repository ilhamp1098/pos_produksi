<?php
include "template/header.php";
include "template/sidebar.php";

$id=$_GET['id'];
$tampil =$koneksi->query("SELECT * FROM m_customer where id='$id' ");
         $tampilCus=$tampil->fetch_assoc();    

?>


 <!-- Page Heading -->
<div class="col-xl-8 col-lg-12 col-md-9">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Ubah Data Customer</h6>
                        </div>
                        <div class="card-body">
                                    <form class="user" method="POST">
                                        <div class="form-group">
                                            <label>Kode Customer</label>   
                                            <input type="text" class="form-control "
                                                value="<?= $tampilCus['kode']; ?>"
                                                readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Customer</label>   
                                            <input type="text" class="form-control "
                                                id="nama" name="nama" value="<?= $tampilCus['name']; ?>"
                                                placeholder="Nama Customer" required maxlength='30' >
                                        </div>
                                        <div class="form-group">
                                            <label>No. Telp</label>  
                                            <input type="number" class="form-control "
                                            value="<?= $tampilCus['telp']; ?>"
                                                id="telp" name="telp" placeholder="No. Telp" 
                                                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                                maxlength = "15"
                                                required>
                                        </div>
                                        <button type="submit" class="btn btn-success" name="ubah"><i class="fas fa-cog"></i> Ubah Data</button>
                                        <a href="customer.php" class="btn btn-warning" style="float:right"><i class="fas fa-arrow-left"></i> Kembali</a>
                                    </form>   

                        </div>
                    </div>                       
</div>


<?php
if(isset($_POST["ubah"])){



  $name=addslashes(htmlspecialchars($_POST["nama"]));
  $telp=htmlspecialchars($_POST["telp"]);

      $sqlubah = $koneksi->query("UPDATE m_customer set name='$name', telp='$telp' WHERE id='$id'");
if ($sqlubah) {
echo "<script>alert('Data Customer Berhasil Diubah');</script>";    
  echo "<script>location='customer.php';</script>";  
}else{
    echo "<script>alert('Data Customer Gagal Diubah');</script>";    
  echo "<script>location='customer_ubah.php';</script>"; 
}
}
?>




<?php
include "template/footer.php";
?>

<script>
    $(document).ready(function() {
  $('#tb_customer').DataTable();
});

</script>