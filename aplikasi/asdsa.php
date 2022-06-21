<?php
session_start();
include 'db.php';
if ($_SESSION['login'] != true){
	echo '<script>window.location="login.php"</script>';
}
$produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_id = '".$_GET['id']."' ");
$p = mysqli_fetch_object($produk);



?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width-device-width, initial-scale=1">
<title> E-COMMERCE </title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
	<link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
</head>
<body >
	<div class='sidebar'>
<!--NAVIGATION WEB-->
		<div class='logo-content'>
		<div class='logo'>
			<i class='bx bx-menu' id='btn'></i>
		<div class='logo_name'>Admin</div>
		
		</div>

			<ul class='nav'>
		<li><a href="home-penjual.php"><i class='bx bx-user-circle'></i></i><span class='link_name'>Profil</span></a>
			<span class='tooltip'>Profil</span>
			</li>
			
			<li><a href="data-produk1.php?halaman=produk"><i class='bx bxl-product-hunt' ></i><span class='link_name'>Data Produk</span></a>
			<span class='tooltip'>Data Produk</span>
			</li>
			
			<li><a href="pembelian1.php?halaman=pembelian"><i class='bx bxl-product-hunt' ></i><span class='link_name'>Data Pembelian </span></a>
			<span class='tooltip'>Data Pembelian</span>
			</li>
		
			
		<li><a href="logout1.php"><i class='bx bx-log-out'></i><span class='link_name'>Logout</span></a>
			<span class='tooltip'>Logout</span>
			</li>
		</ul>
<!-- FOOTER SIDEBAR -->
			<div class='footer-sidebar'>
			<div class='footer-image'>
				<img src='logo-toba.png'/>
				<div class="footer-desc">
				<span class='goverment'>Pemerintah Kabupaten Toba</span>
					<span class='dinas-gov'>Dinas Pertanian &amp; Perikanan Tobasa </span>
					<p>Jl. Pertanian No.1, Huta Bulu Mejan, Kec. Balige, Toba, Sumatera Utara 22312</p>

			</div>
				</div>
				
			</div>
<!-- FOOTER END -->
		</div>
<!--	END		-->

	</div>
	<!--Content-->
	<div class="main-content">
		<div class="container">
			<p class="alert_info dashboard_alert">Untuk memperbaharui Data Kategori anda silahkan <a href="#">Input Ulang Form</a> dibawah !</p>
			<h3>Edit Data Produk</h3>
			<div class="box box2">
				<form action="" method="POST" enctype="multipart/form-data">
				<select class="input-control" name="kategori" required>
					<option>--Pilih--</option>
					<?php
					$kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
					while($r = mysqli_fetch_array($kategori)){
					?>
					<option value="<?php echo $r['category_id'] ?>" <?php echo ($r['category_id'] == $p->category_id)? 'selected':'';?>><?php echo $r['category_name']?></option>
					<?php } ?>
					
					</select>
					
					<input type = "text" name="nama" class="input-control" placeholder ="Nama Produk" value="<?php echo $p-> product_name ?>"required>
					<input type = "text" name="harga" class="input-control" placeholder ="Harga"  value="<?php echo $p-> product_price ?>"required>	
					<input type = "text" name="berat" class="input-control" placeholder ="Berat"  value="<?php echo $p-> berat_produk ?>"required>	
					<input type = "text" name="stok" class="input-control" placeholder ="Stok"  value="<?php echo $p-> stok_produk ?>"required>	
					<img src="produk/<?php echo $p->product_image ?>" width="100px">
					<input type="hidden" name="foto" value="<?php echo $p->product_image ?>">
					<input type = "file" name="gambar" class="input-control">						
					<textarea class ="input-control" name="deskripsi" placeholder="Deskripsi"><?php echo $p-> product_descrption ?></textarea><br>											
					<select class="input-control" name="status">
						<option value="">--Pilih--</option>
						<option value="1" <?php echo ($p->product_status ==1)? 'selected':'';?>>Aktif</option>
					    <option value="0"<?php echo ($p->product_status ==0)? 'selected':'';?>>Tidak Aktif</option>
					</select>
						<input type="submit" name="submit" value="Submit" class="btn">
				</form>
				<?php
					if(isset($_POST['submit'])){
						// data inputan dari form
						$kategori =$_POST['kategori'];
						$nama =$_POST['nama'];
						$harga =$_POST['harga'];
						$berat =$_POST['berat'];
						$stok = $_POST['stok'];
						$deskripsi =$_POST['deskripsi'];
						$status =$_POST['status'];
						$foto =$_POST['foto'];
						//data gambar terbaru
						$filename =$_FILES['gambar']['name'];
						$tmp_name =$_FILES['gambar']['tmp_name'];
						
						// jika admin ganti gambar 
						if($filename !=''){
						$type1 = explode('.', $filename);
						$type2 = $type1[1];
						$newname = 'produk'.time().'.'.$type2;
						$tipe_diizinkan = array ('jpg', 'jpeg','png','gif');
							if (!in_array($type2, $tipe_diizinkan)){
							// jika format file tidak ada didalam tipe diizinkan
							echo '<script>alert("format file tidak diizinkan")</script>';
						} else {
								unlink('./produk/'.$foto);
								move_uploaded_file($tmp_name, './produk/'.$newname);
								$namagambar = $newname;
							}
						} else {
							// jika admin tidak ganti gambar
							$namagambar = $foto;
							
						}
						
						// query update data produk
						$update = mysqli_query($conn, "UPDATE tb_product SET
												category_id = '".$kategori."',
												product_name = '".$nama."',
												product_price= '".$harga."',
												berat_produk ='".$berat."',
												stok_produk ='".$stok."',
												product_descrption= '".$deskripsi."',
												product_image = '".$namagambar."',
												product_status = '".$status."'
												WHERE product_id = '".$p->product_id."' ");
						if($update){
								echo '<script>alert("Ubah Data Berhasil")</script>';
								echo '<script>window.location="data-produk.php"</script>';
								
							} else {
								echo 'gagal'. mysqli_error($conn);
							}
						}
						
					
					?>
				
			</div>
			
			</div>
		</div>
	</div>
	<!--Footer-->
		<script>
	let btn = document.querySelector('#btn');
	let sidebar = document.querySelector('.sidebar');
	
	btn.onclick = function(){
		sidebar.classList.toggle('active');
	}
	</script>

<script>
       CKEDITOR.replace( 'deskripsi' );
</script>
</body>
</html>