<?php
session_start();
if ($_SESSION['login'] != true){
	echo '<script>window.location="login-pelanggan.php"</script>';
}
include 'db.php';
if ($_SESSION['login'] != true){
	echo '<script>window.location="login-pelanggan.php"</script>';
}
$query = mysqli_query($conn, "SELECT * FROM tb_admin WHERE level='admin'");
$d = mysqli_fetch_object($query);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width-device-width, initial-scale=1">
<title>E-Marketplace</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

<link rel="stylesheet" href="dashboard.css">
<link rel="stylesheet" type="text/css" href="icon/css/all.css">

<link rel="stylesheet" type="text/css" href="css/style.css">
<script src='javascript/jquery.min.js'></script>
	<link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
<style>
	h2,h3{
		font-family: Timed New Roman;
	}
	div.main-content {
		display:flex;
		justify-content:center;
		align-items:center;
		text-align:center;
	}
	.container {
		padding:0;
		background:transparent;
	}
	.box2 {
		border:none;
		background : #2962ff;
		border-radius:8px;
		color:white;
		box-shadow: 0 15px 32px rgb(0 0 0 / 39%);
	}
	.box2 h2 {
		letter-spacing:1.2px;
		margin:0 0 5px;
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
			<div class='logo_name ' >
				<i class="fa-solid fa-user"  style="margin-left: -10px;"></i>
				<div style="position:absolute; top:10px; left:100px;"> 
					<p style='font-size:small' >Selamat datang <br>
					<span style='font-style:italic;color:#2962ff'><?php echo $d->username ?></span></p></div>
				</div>
			</div>
			
		</div>

		<ul class='nav'>
		<li><a href="home.php"><i class='fas fa-tachometer-alt-slow'></i><span class='link_name'>Dashboard</span></a>
			<span class='tooltip'>Dashboard</span>
			</li>
			
			
			<li><a href="profil1.php?halaman=profil"><i class='bx bx-user-circle'></i><span class='link_name'>Profil</span></a>
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
			
					<div class="bx-admin">
						<div class='admin-name'>
							<div class='say-to-admin'>
								<div class="bg-white" style="width: 1000px; height:50px; margin-top:-100px; box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px, rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;">
									<h2 style="padding-top: 5px; font-weight:bold;">DASHBOARD</h2>
								</div>
								<div class="bg-white" style="width: 1000px;">
									<div class="row mt-3 container p-2 text-dark" style="margin-left: 0.1%; min-height: 65vh; z-index: -100; box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px, rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;">
										<div class="col-sm-3 mt-3">
											<div class="card "  style="border: none;">
												<style type="text/css">
													div.c{
														height: 160px;
														position: relative;
														margin: 0 auto;
														width: 100%;
														transition: .4s all;
														border-radius: 10px;
													}
													div.c i{
														position: absolute;
														top: 50%;
														left: 50%;
														transform: translate(-50%, -50%);
														z-index: 9;
													}
													div.c h3{
														display: none;
														transition: .4 all;
													}
													div.c:hover{
														background: rgba(36, 235, 255, 1) !important;
														margin: 0 auto !important;
														transform: scale(1.1);
													}
													div.c:hover h3{
														display: block;
														position: absolute;
														top: 50%;
														left: 50%;
														transform: translate(-50%, -50%);
														text-align: center;
														text-shadow: 3px 1px 5px black,
																	-1px -3px 5px black;
														width: 100%;
														z-index: 10;
													}

												</style>
												<a href="home.php">
													<div class="c c1 card-body text-white bg-info">
														<h3>DASHBOARD</h3>
														<!-- <i class="fas fa-virus fa-8x bi me-2"></i> -->
														<i class="fas fa-tachometer-alt-slow fa-8x bi me-2"></i>
													</div>
												</a>
											</div>
										</div>										
										<div class="col-sm-3 mt-3">
											<div class="card "  style="border: none;">
												<a href="profil1.php?halaman=profil">
													<div class="c c1 card-body text-white bg-info">
														<h3>PROFIL</h3>
														<!-- <i class="fas fa-virus fa-8x bi me-2"></i> -->
														<i class='bx bx-user-circle fa-8x bi me-2'></i>
													</div>
												</a>
											</div>
										</div>
										<div class="col-sm-3 mt-3">
											<div class="card "  style="border: none;">
												<a href="data-kategori.php?halaman=kategori">
													<div class="c c1 card-body text-white bg-info">
														<h3>DATA KATEGORI</h3>
														<!-- <i class="fas fa-virus fa-8x bi me-2"></i> -->
														<i class='bx bxl-product-hunt fa-8x bi me-2' ></i>
													</div>
												</a>
											</div>
										</div>
										<div class="col-sm-3 mt-3">
											<div class="card "  style="border: none;">
												<a href="pembelian.php?halaman=pembelian">
													<div class="c c1 card-body text-white bg-info">
														<h3>DATA PEMBELIAN</h3>
														<!-- <i class="fas fa-virus fa-8x bi me-2"></i> -->
														<i class='bx bxl-product-hunt fa-8x bi me-2' ></i>

													</div>
												</a>
											</div>
										</div>
										<div class="col-sm-3 mt-3">
											<div class="card "  style="border: none;">
												<a href="pelanggan.php?halaman=pelanggan">
													<div class="c c1 card-body text-white bg-info">
														<h3>DATA PELANGGAN</h3>
														<!-- <i class="fas fa-virus fa-8x bi me-2"></i> -->
														<i class='bx bxl-product-hunt fa-8x bi me-2' ></i>

													</div>
												</a>
											</div>
										</div>
										<div class="col-sm-3 mt-3">
											<div class="card "  style="border: none;">
												<a href="penjual.php?halaman=penjual">
													<div class="c c1 card-body text-white bg-info">
														<h3>DATA PENJUAL</h3>
														<!-- <i class="fas fa-virus fa-8x bi me-2"></i> -->
														<i class='bx bxl-product-hunt fa-8x bi me-2' ></i>

													</div>
												</a>
											</div>
										</div>
										<div class="col-sm-3 mt-3">
											<div class="card "  style="border: none;">
												<a href="laporan.php">
													<div class="c c1 card-body text-white bg-info">
														<h3>LAPORAN</h3>
														<!-- <i class="fas fa-virus fa-8x bi me-2"></i> -->
														<i class='bx bxl-product-hunt fa-8x bi me-2' ></i>

													</div>
												</a>
											</div>
										</div>
									</div>
								</div>
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