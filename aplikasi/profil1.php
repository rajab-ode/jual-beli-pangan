<?php
session_start();
if ($_SESSION['login'] != true){
	echo '<script>window.location="login.php"</script>';
}
include 'db.php';
if ($_SESSION['login'] != true){
	echo '<script>window.location="login.php"</script>';
}
$query = mysqli_query($conn, "SELECT * FROM tb_admin WHERE level='admin'");
$d = mysqli_fetch_object($query);

?>

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width-device-width, initial-scale=1">
<title> E-COMMERCE </title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

<link rel="stylesheet" href="dashboard.css">
<link rel="stylesheet" type="text/css" href="icon/css/all.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<script src='javascript/jquery.min.js'></script>
	<link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
</head>
<body >
<!--	HEADER -->
	
<div class='sidebar'>
<!--NAVIGATION WEB-->
		<div class='logo-content'>
		<div class='logo'>
			<i class='bx bx-menu' id='btn'></i>
		<div class='logo_name'><p style='font-size:small'>Halo...<br/>Selamat datang... <span style='font-style:italic;color:#2962ff'><?php echo $d->level ?></span></p></div>
			
		</div>

		<ul class='nav'>
		<li><a href="home.php"><i class='fas fa-tachometer-alt-slow'></i><span class='link_name'>Dashboard</span></a>
			<span class='tooltip'>Dashboard</span>
			</li>
			
			
			<li><a href="profil1.php?halaman=profil"><i class='bx bx-label'></i><span class='link_name'>Profil</span></a>
				<span class='tooltip'>Profil</span></li>	

		<!-- ACCORDION MENU DROPDOWN START -->

		<div class="centerflip">
<button class="flippy"><li><a href="#"><i class='bx bxl-product-hunt' ></i><span class='link_name'>Data Master ▾</span></a>
			<span class='tooltip'>Data Master </span>
			</li> </button>
<div class="flippanel">
<div class="accordion-list">

<li><a href="data-kategori.php?halaman=kategori"><i class='bx bx-label'></i><span class='link_name'>Data Kategori</span></a>
				<span class='tooltip'>Data Kategori</span></li>
</div>
<div class="accordion-list">

<li><a href="pembelian.php?halaman=pembelian"><i class='bx bxl-product-hunt' ></i><span class='link_name'>Data Pembelian </span></a>
			<span class='tooltip'>Data Pembelian</span>
			</li>
</div>
<div class="accordion-list">

<li><a href="pelanggan.php?halaman=pelanggan"><i class='bx bxl-product-hunt' ></i><span class='link_name'>Data Pelanggan </span></a>
			<span class='tooltip'>Data Pelanggan</span>
			</li>
</div>
<div class="accordion-list">

<li><a href="penjual.php?halaman=penjual"><i class='bx bxl-product-hunt' ></i><span class='link_name'>Data Penjual </span></a>
			<span class='tooltip'>Data Penjual</span>
			</li>
</div>
</div>
</div>	

			<!-- ACCORDION MENU DROPDOWN END -->
			<li><a href="laporan.php"><i class='bx bxl-product-hunt' ></i><span class='link_name'>Laporan </span></a>
			<span class='tooltip'>Laporan</span>
			</li>
		
		<li><a href="logout1.php"><i class='bx bx-log-out'></i><span class='link_name'>Logout</span></a>
			<span class='tooltip'>Logout</span>
			</li>
		</ul>
	
	

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
							echo '<script>window.location="home.php"</script>';
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
	</div>
	
	

<script>
	let btn = document.querySelector('#btn');
	let sidebar = document.querySelector('.sidebar');
	
	btn.onclick = function(){
		sidebar.classList.toggle('active');
	}

</script>
<script>
$(function(){
  $(".flippy").on("click", function(){
    $(this).parent().children(".flippanel").slideToggle("normal");
  });
});
</script>
</body>
</html>