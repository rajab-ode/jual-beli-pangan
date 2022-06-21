<?php

session_start();
include ('db.php');
if ($_SESSION['status_login'] != true){
	echo '<script>window.location="login_admin.php"</script>';
}
$query = mysqli_query($conn, "SELECT * FROM tb_admin WHERE level='admin'");
$d = mysqli_fetch_object($query);
$koneksi =new mysqli("localhost","root","","db_hasilpertanian");
$semuadata=array();
$tgl_mulai ="_";
$tgl_selesai="_";
if (isset($_POST["kirim"]))
{
	$tgl_mulai = $_POST["tglm"];
	$tgl_selesai = $_POST["tgls"];
	$ambil = $koneksi->query("SELECT * FROM pembelian pm LEFT JOIN pelanggan pl ON pm.id_pelanggan=pl.id_pelanggan WHERE tanggal_pembelian BETWEEN '$tgl_mulai' AND '$tgl_selesai'");
	while($pecah = $ambil->fetch_assoc())
	{
		$semuadata[]=$pecah;
	}
}
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
<meta name="viewport" content="width-device-width, initial-scale=1">
<title>Laporan</title>
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
.row .col-md-5 {
	margin-right:1rem;
}
.row .col-md-5 .form-group input.form-control {
	margin-left:.5rem;
	border:thin solid #dadce0;
	border-radius:4px;
	padding:4px 8px;
	outline-color:#2962ff;
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
		<li><a href="home.php"><i class='bx bx-user-circle'></i></i><span class='link_name'>Home</span></a>
			<span class='tooltip'>Home</span>
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
		
		<li><a href="logout.php"><i class='bx bx-log-out'></i><span class='link_name'>Logout</span></a>
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
			<p class="alert_info dashboard_alert">Berikut Data <a href="#form-profil-admin">Laporan</a> anda dibawah !</p>
			<h3>Dashboard Laporan</h3>
			<div class="box box2"><h2> Laporan Pembelian dari <?php echo $tgl_mulai ?> hingga <?php echo $tgl_selesai ?></h2>
	<br>

<thead>
<tr>
<form method="post">
	<div class="row" style='display:flex'>
		<div class="col-md-5">
		<div class="form-group">
			<label>Tanggal Mulai</label>
			<input type="date" class="form-control" name="tglm" value="<?php echo $tgl_mulai ?>">
		</div>
		</div>
		<div class="col-md-5">
		<div class="form-group">
			<label>Tanggal Selesai</label>
			<input type="date" class="form-control" name="tgls" value="<?php echo $tgl_selesai ?>">
		</div>
		</div>
		<div class="col-md-2">
			<label>&nbsp;</label>
			<button class="btn btn-primary" name="kirim" style='margin:0 0 10px;'>Lihat</button>
		</div>
	</div>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>No</th>
				<th>Pelanggan</th>
				<th>Tanggal</th>
				<th>Jumlah</th>
				<th>Status</th>
			</tr>
		</thead>
		<tbody>
			<?php $total=0;?>
			<?php foreach ($semuadata as $key => $value):?>
			<?php $total+=$value['total_pembelian']?>
			<tr>
				<td><?php echo $key+1;?></td>
				<td><?php echo $value["nama_pelanggan"]?></td>
				<td><?php echo $value["tanggal_pembelian"]?></td>
				<td>Rp.<?php echo number_format($value["total_pembelian"])?> </td>
				<td><?php echo $value["status_pembelian"]?></td>
			</tr>
			<?php endforeach ?>
		</tbody>
		<tfoot>
			<tr>
			<th colspan="3">Total</th>
			<th>Rp.<?php echo number_format($total)?></th>
			</tr>
			</tfoot>
		</tr>
	</thead>
	
</form>
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
