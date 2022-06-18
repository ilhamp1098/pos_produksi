<?php
include "template/header.php";
include "template/sidebar.php";

$id=$_GET['id'];
$tampil =$koneksi->query("SELECT * FROM m_barang where id='$id' ");
         $tampilCus=$tampil->fetch_assoc();  
?>


 <!-- Page Heading -->
<div class="col-xl-8 col-lg-12 col-md-9">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Ubah Data Barang</h6>
                        </div>
                        <div class="card-body">
                                    <form class="user" method="POST">
                                        <div class="form-group">
                                            <label>Kode Barang</label>   
                                            <input type="text" class="form-control "
                                                value="<?= $tampilCus['kode']; ?>"
                                                readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Barang</label>   
                                            <input type="text" class="form-control "
                                                id="nama" name="nama" 
                                                value="<?= $tampilCus['nama']; ?>"
                                                placeholder="Nama Barang" required maxlength="100">
                                        </div>
                                        <div class="form-group">
                                            <label>Harga Barang</label>  
                                            <input type="number" class="form-control "
                                            value="<?= $tampilCus['harga']; ?>"
                                                id="harga" name="harga" min="0" placeholder="Harga Barang"
                                                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                                maxlength = "10"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label>Diskon Barang</label>  
                                            <input type="number" class="form-control "
                                            value="<?= $tampilCus['diskon']; ?>"
                                                id="diskon" name="diskon" min="0" max="100" placeholder="Diskon Barang" 
                                                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                                maxlength = "3"
                                                required>
                                        </div>                                        
                                        <button type="submit" class="btn btn-success" name="ubah"><i class="fas fa-cog"></i> Ubah Data</button>
                                        <a href="barang.php" class="btn btn-warning" style="float:right"><i class="fas fa-arrow-left"></i> Kembali</a>

                                    </form>   

                        </div>
                    </div>                       
</div>


<?php
if(isset($_POST["ubah"])){



  $nama=addslashes(htmlspecialchars($_POST["nama"]));
  $harga=htmlspecialchars($_POST["harga"]);
  $diskon=htmlspecialchars($_POST["diskon"]);

      $sqlubah = $koneksi->query("UPDATE m_barang set nama='$nama', harga='$harga', diskon='$diskon' WHERE id='$id'");
if ($sqlubah) {
echo "<script>alert('Data Barang Berhasil Diubah');</script>";    
  echo "<script>location='barang.php';</script>";  
}else{
    echo "<script>alert('Data Barang Gagal Diubah');</script>";    
  echo "<script>location='barang_ubah.php';</script>"; 
}
}
?>




<?php
include "template/footer.php";
?>
