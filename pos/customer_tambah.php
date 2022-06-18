<?php
include "template/header.php";
include "template/sidebar.php";


?>


 <!-- Page Heading -->
<div class="col-xl-8 col-lg-12 col-md-9">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Tambah Data Customer</h6>
                        </div>
                        <div class="card-body">
                                    <form class="user" method="POST">
                                        <div class="form-group">
                                            <label>Nama Customer</label>   
                                            <input type="text" class="form-control "
                                                id="nama" name="nama" 
                                                placeholder="Nama Customer" required maxlength='30' >
                                        </div>
                                        <div class="form-group">
                                            <label>No. Telp</label>  
                                            <input type="number" class="form-control "
                                                id="telp" name="telp" placeholder="No. Telp" 
                                                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                                maxlength = "15"
                                                required>
                                        </div>
                                        <button type="submit" class="btn btn-primary" name="save"><i class="fas fa-plus"></i> Tambah Data</button>
                                        <a href="customer.php" class="btn btn-warning" style="float:right"><i class="fas fa-arrow-left"></i> Kembali</a>
                                    </form>   

                        </div>
                    </div>                       
</div>


<?php
if(isset($_POST["save"])){

  $sql = mysqli_query($koneksi, "SELECT id FROM m_customer order by id desc limit 1");
  $data = mysqli_fetch_array($sql);
  $no=$data['id'];
$urutan = $no+1;
$huruf = "C-";
$no = $huruf . sprintf("%03s", $urutan);


  $name=addslashes(htmlspecialchars($_POST["nama"]));
  $telp=htmlspecialchars($_POST["telp"]);

      $sqlinsert = $koneksi->query("INSERT INTO m_customer (id,kode,name,telp) 
      	values
      (null,'$no','$name','$telp')");
if ($sqlinsert) {
echo "<script>alert('Data Customer $name Berhasil Ditambahkan');</script>";    
  echo "<script>location='customer.php';</script>";  
}else{
    echo "<script>alert('Data Customer $name Gagal Ditambahkan');</script>";    
  echo "<script>location='customer_tambah.php';</script>"; 
}
}
?>




<?php
include "template/footer.php";
?>