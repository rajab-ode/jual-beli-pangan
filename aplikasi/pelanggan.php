<?php

session_start();
include ('db.php');
if ($_SESSION['login'] != true){
	echo '<script>window.location="login_admin.php"</script>'; 
}
$query = mysqli_query($conn, "SELECT * FROM tb_admin WHERE level='admin'");
$d = mysqli_fetch_object($query);
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
<script src='javascript/jquery.min.js'></script>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
	<style>
table {
			border:none;
			margin-bottom:2rem;
		}
		tbody {
			background:white
		}
		tfoot {
    background: #212121;
    color: #fff;
}
table.table.table-bordered thead {
    background: #2962ff;
	color:#fff;
	text-align:center;
	letter-spacing:1;
}
table.table.table-bordered tr:nth-child(2n) {
    background: #efefef;
}
.table tr, table.table.table-bordered thead th, table.table.table-bordered tr td {
	font-weight:normal;
	border:thin solid #dadce0;
}
table.table.table-bordered tr td {
	text-align:center;
}
	</style>
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
	
	
	<div class="main-content">
	<div class='dashboard-profil'>
		<div class="section-admin">
		<div class="container">
			<p class="alert_info dashboard_alert">Berikut Data <a href="#form-profil-admin">Pelanggan</a> anda dibawah !</p>
			<h3>Dashboard Profil</h3>
			<div class="box box2">
	<h2> Data Pelanggan</h2>
	<br>
<table class="table table-bordered">
<thead>
<tr>
	<th>no</th>
	<th>nama</th>
	<th>email</th>
	<th>telepon</th>
	<th>aksi</th>
</tr>	
</thead>
<tbody>
	<?php $nomor=1; ?>
	<?php 
	$pelanggan=mysqli_query($conn,"SELECT * FROM tb_admin WHERE level='pembeli' ");?>
	<?php while($pecah = $pelanggan->fetch_assoc()){ ?>
	<tr>
		<td> <?php echo $nomor; ?></td>
		<td> <?php echo $pecah ['admin_name']; ?></td>
		<td> <?php echo $pecah['admin_email']; ?></td>
		<td> <?php echo $pecah ['admin_telp']; ?></td>
		<td>
			<a href="" class="btn btn-danger"><i class='bx bx-trash'></i></a>
		</td>
	</tr>
	<?php $nomor++; ?>
	<?php } ?>
</tbody>
</table></div>
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