<?php
include "template/header.php";
include "template/sidebar.php";


?>


 <!-- Page Heading -->
<div class="col-xl-8 col-lg-12 col-md-9">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Tambah Data Barang</h6>
                        </div>
                        <div class="card-body">
                                    <form class="user" method="POST">
                                        <div class="form-group">
                                            <label>Nama Barang</label>   
                                            <input type="text" class="form-control "
                                                id="nama" name="nama" 
                                                placeholder="Nama Barang"
                                                required maxlength="100"
                                                >
                                        </div>
                                        <div class="form-group">
                                            <label>Harga Barang</label>  
                                            <input type="number" class="form-control "
                                                id="harga" name="harga" min="0" placeholder="Harga Barang"
                                                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                                maxlength = "10"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label>Diskon Barang</label>  
                                            <input type="number" class="form-control "
                                                id="diskon" name="diskon" min="0" max="100" placeholder="Diskon Barang"
                                                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                                maxlength = "3"
                                                required>
                                        </div>                                        
                                        <button type="submit" class="btn btn-primary" name="save"><i class="fas fa-plus"></i> Tambah Data</button>
                                        <a href="barang.php" class="btn btn-warning" style="float:right"><i class="fas fa-arrow-left"></i> Kembali</a>

                                    </form>   

                        </div>
                    </div>                       
</div>


<?php
if(isset($_POST["save"])){

  $sql = mysqli_query($koneksi, "SELECT id FROM m_barang order by id desc limit 1");
  $data = mysqli_fetch_array($sql);
  $no=$data['id'];
$urutan = $no+1;
$huruf = "B-";
$no = $huruf . sprintf("%03s", $urutan);


  $nama=addslashes(htmlspecialchars($_POST["nama"]));
  $harga=htmlspecialchars($_POST["harga"]);
  $diskon=htmlspecialchars($_POST["diskon"]);

      $sqlinsert = $koneksi->query("INSERT INTO m_barang (id,kode,nama,harga,diskon) 
      	values
      (null,'$no','$nama','$harga','$diskon')");
if ($sqlinsert) {
echo "<script>alert('Data Barang $nama Berhasil Ditambahkan');</script>";    
  echo "<script>location='barang.php';</script>";  
}else{
    echo "<script>alert('Data Barang $nama Gagal Ditambahkan');</script>";    
  echo "<script>location='barang_tambah.php';</script>"; 
}
}
?>




<?php
include "template/footer.php";
?>
