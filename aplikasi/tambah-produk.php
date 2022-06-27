<?php
session_start();
include ('db.php');
if ($_SESSION['login'] != true){
	echo '<script>window.location="login_admin.php"</script>'; 
}
$id = $_SESSION["id"];
$query = mysqli_query($conn, "SELECT * FROM tb_admin WHERE level='penjual' AND admin_id = $id");
$d = mysqli_fetch_object($query);
$telp = $d->admin_telp;
// $telp = $d['admin_telp'];
// var_dump($query->fetch_assoc());
// $test = $query->fetch_assoc();
// var_dump($query->admin_telp);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width-device-width, initial-scale=1">
<title>E-Marketplace</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="icon/css/all.css">
<link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>

<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
	<link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
<script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
</head>
<body >
		<div class='sidebar'>
<!--NAVIGATION WEB-->
		<div class='logo-content'>
		<div class='logo'>
			<i class='bx bx-menu' id='btn'></i>
			<div class='logo_name'>
				<i class="fa-solid fa-user"  style="margin-left: -10px;"></i>
				<div style="position:absolute; top:20px; left:100px;"> 
						<p style='font-size:small' >Halo <br>
						<span style='font-style:italic;color:#2962ff'><?php echo $d->username ?></span></p></div>
				</div>
			</div>
		
			
		</div>

		<ul class='nav'>
			<li><a href="dashboard-penjual.php"><i class='fas fa-tachometer-alt-slow'></i></i><span class='link_name'>Dashboard</span></a>
						<span class='tooltip'>Dashboard</span>
						</li>
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
			<p class="alert_info dashboard_alert">Untuk memperbaharui Data Produk anda silahkan <a href="#form-profil-admin">Input Ulang Form</a> dibawah !</p>
			<h3>Tambah Data Produk</h3>
			<div class="box box2">
				<form action="" method="POST" enctype="multipart/form-data">
				<select class="input-control" name="kategori" required>
					<option>--Pilih--</option>
					<?php
					$kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
					while($r = mysqli_fetch_array($kategori)){
					?>
					<option value="<?php echo $r['category_id'] ?>"><?php echo $r['category_name']?></option>
					
					<?php } ?>
					
					</select>
					
					<input type = "text" name="id" class="input-control" placeholder ="" required value="<?= $id ?>" hidden>
					<input type = "text" name="nama" class="input-control" placeholder ="Nama Produk" required>
					<input type = "text" name="harga" class="input-control" placeholder ="Harga" required>	
					<input type = "text" name="berat" class="input-control" placeholder ="Berat" required>	
					<input type = "text" name="stok" class="input-control" placeholder ="Stok" required>
					<input type = "file" name="gambar" class="input-control" required>						<textarea class ="input-control" name="deskripsi" placeholder="Deskripsi"></textarea><br>											
					<select class="input-control" name="status">
						<option value="">--Pilih--</option>
						<option value="1">Aktif</option>
					    <option value="0">Tidak Aktif</option>
					<input type="submit" name="submit" value="Submit" class="submit-btn">
				</form>
				<?php
					if(isset($_POST['submit'])){
						//print_r($_FILES['gambar']);
						// menampung inputan dari form
						$id = $_POST["id"];
						$kategori =$_POST['kategori'];
						$nama =$_POST['nama'];
						$harga =$_POST['harga'];
						$berat =$_POST['berat'];
						$stok =$_POST['stok'];
						$deskripsi =$_POST['deskripsi'];
						$status =$_POST['status'];
						// menampung data file yang diupload
						$filename =$_FILES['gambar']['name'];
						$tmp_name =$_FILES['gambar']['tmp_name'];
						$type1 = explode('.', $filename);
						$type2 = $type1[1];
						$newname = 'produk'.time().'.'.$type2;
						$no_telepon = "https://api.whatsapp.com/send?phone=".$telp." &text= Hai, saya tertarik dengan produk Anda.";
						// var_dump($kategori);
						// echo"<br>";
						// var_dump($nama);
						// echo"<br>";
						// var_dump($harga);
						// echo"<br>";
						// var_dump($berat);
						// echo"<br>";
						// var_dump($stok);
						// echo"<br>";
						// var_dump($deskripsi);
						// echo"<br>";
						// var_dump($status);
						// echo"<br>";
						// var_dump($filename);
						// echo"<br>";
						// var_dump($tmp_name);
						// echo"<br>";
						// var_dump($type1);
						// echo"<br>";
						// var_dump($type2);
						// echo"<br>";
						// var_dump($newname);
						// echo"<br>";
						// die;
						// menampung data format file yang diijinkan 
						$tipe_diizinkan = array ('jpg', 'jpeg','png','gif');
						
						// membuat validasi format file
						if (!in_array($type2, $tipe_diizinkan)){
							// jika format file tidak ada didalam tipe diizinkan
							echo '<script>alert("format file tidak diizinkan")</script>';
						} else {
							// jika format sesuai dengan array
							// proses upload file sekaligus insert database
							move_uploaded_file($tmp_name, './produk/' .$newname);
							$insert = mysqli_query ($conn, "INSERT INTO tb_product VALUES (
									null,
									'".$kategori."',
									'".$id."',
									'".$nama."',
									'".$harga."',
									'".$berat."',
									'".$stok."',
									'".$deskripsi."',
									'".$newname."',
									'".$alamat."',
									'".$no_telepon."',
									'".$status."',
									null
									) ");
							
							if($insert){
								echo '<script> alert("Tambah Data Berhasil")</script>';
								echo '<script>window.location="data-produk1.php"</script>';
							} else {
								echo 'gagal'. mysqli_error($conn);
							}
						}
						
						
					}
					?>
				
			</div>
			
			</div>
		</div>
	</div>
	<!--Footer-->

<script>
       CKEDITOR.replace( 'deskripsi' );

	let btn = document.querySelector('#btn');
	let sidebar = document.querySelector('.sidebar');
	
	btn.onclick = function(){
		sidebar.classList.toggle('active');
	}

</script>
</body>
</html>