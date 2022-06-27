<?php
session_start();
if ($_SESSION['login'] != true){
	echo '<script>window.location="login.php"</script>';
}
include 'db.php';
if ($_SESSION['login'] != true){
	echo '<script>window.location="login.php"</script>';
}
$id = $_SESSION["id"];
$query = mysqli_query($conn, "SELECT * FROM tb_admin WHERE level='penjual' AND admin_id = $id");
$d = mysqli_fetch_object($query);
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
</head>
<body >
<!--	HEADER -->
	
	<div class='sidebar' style="">
<!--NAVIGATION WEB-->
		<div class='logo-content'>
		<div class='logo' style="">
			<i class='bx bx-menu' id='btn' style=""></i>
			<div class='logo_name ' >
				<i class="fa-solid fa-user"  style="margin-left: -10px;"></i>
				<div style="position:absolute; top:20px; left:100px;"> 
					<p style='font-size:small' >Selamat datang <br>
					<span style='font-style:italic;color:#2962ff'><?php echo $d->username ?></span></p></div>
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
	
<!--	MAIN CONTENT	-->
	<div class="main-content">
	<div class='dashboard-profil'>
		<div class="section-admin">
		<div class="container">
			<p class="alert_info dashboard_alert">Untuk memperbaharui profil anda silahkan <a href="#form-profil-admin">Input Ulang Form</a> dibawah !</p>
			<h3>Dashboard Profil</h3>
			<div class="box box2">
				<form action="" method="POST" id='form-profil-admin'>
					<label class="form name" for='form-profil'>Name</label>
				<input type="text" name="nama" placeholder="Nama Lengkap" class="input-control" value="<?php echo $d->admin_name ?>" required>
					
					<label class="form username" for='form-profil'>Username</label>
				<input type="text" name="user" placeholder="Username" class="input-control"  value="<?php echo $d->username ?>" required>
					
					<label class="form number" for='form-profil'>Number Phone</label>
				<input type="text" name="hp" placeholder="No Hp" class="input-control" value="<?php echo $d->admin_telp ?>" required>
					
					<label class="form mail" for='form-profil'>Mail Address</label>
				<input type="email" name="email" placeholder="Email" class="input-control"  value="<?php echo $d->admin_email ?>" required>
					
					<label class="form address" for='form-profil'>Address</label>
				<input type="text" name="alamat" placeholder="Alamat " class="input-control"  value="<?php echo $d->admin_address ?>" required>
				<input type="submit" name="submit" value="Ubah Profil" class="submit-btn">
							</form>
				<?php
					if(isset($_POST['submit'])){
						
						$nama	 = $_POST['nama'];
						$user	 = $_POST['user'];
						$hp		 = $_POST['hp'];
						$email	 = $_POST['email'];
						$alamat	 = $_POST['alamat'];
						
						$update = mysqli_query($conn, "UPDATE tb_admin SET 
											  admin_name = '".$nama."',
											  username = '".$user."',
											  admin_telp = '".$hp."',
											  admin_email = '".$email."',
											  admin_address = '".$alamat."'
											  WHERE admin_id = '".$d->admin_id."' ");
						if($update){
							echo '<script>alert("Ubah data berhasil")</script>';
							echo '<script>window.location="home-penjual.php"</script>';
						} else{
							echo 'gagal' .mysqli_error($conn);
						}
					}
						   ?>
			</div>
				<h3>Ubah Password</h3>
			<div class="box box2">
				<form action="" method="POST">
					<input type="password" name="pass1" placeholder="Password Baru" class="input-control" required>
					<input type="password" name="pass2" placeholder="Konfirmasi Password Baru" class="input-control" required>
					<input type="submit" name="ubah_password" value="Ubah Password" class="submit-btn">
				</form>
				<?php
					if (isset($_POST['ubah_password'])){
						
						$pass1	 = $_POST['pass1'];
						$pass2	 = $_POST['pass2'];
						if ($pass2 != $pass1){
							echo '<script>alert("Konfirmasi Password Baru tidak sesuai")</script>';
						} else
						
						$u_pass= mysqli_query($conn, "UPDATE tb_admin SET (
			
											  password = '".MD5($pass1)."'
											  WHERE admin_id = '".$d->admin_id."' ");
						if($u_pass){
							echo '<script>alert("Ubah data berhasil")</script>';
							
						} else{
							echo 'gagal' .mysqli_error($conn);
						}
					}
						   ?>
			</div>
		</div>
	</div>

		 </div>
		</div>
	</div>
	

<script>
	let btn = document.querySelector('#btn');
	let sidebar = document.querySelector('.sidebar');
	
	btn.onclick = function(){
		sidebar.classList.toggle('active');
	}
	</script>
</body>
</html>