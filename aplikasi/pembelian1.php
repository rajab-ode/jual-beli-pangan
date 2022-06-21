<?php

include('db.php');
$koneksi = new mysqli ("localhost","root","","db_hasilpertanian");
session_start();

if ($_SESSION['status_login'] != true){
	echo '<script>window.location="login_admin.php"</script>';
}
$query = mysqli_query($conn, "SELECT * FROM tb_admin WHERE level='penjual'");
$d = mysqli_fetch_object($query);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width-device-width, initial-scale=1">
<title> E-COMMERCE </title>
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
a.btn.btn-success.lunas {
    color:  #0EDB45;
}	
a.btn.btn-success.barang.dikirim {
    color: #2962ff;
}	
a.btn.btn-success.Pending {
    color: #ffc017;
}	
a.btn.btn-success.batal {
    color: #bf5000;
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
		<li><a href="home-penjual.php"><i class='bx bx-user-circle'></i></i><span class='link_name'>Profil</span></a>
			<span class='tooltip'>Profil</span>
			</li>
			
			<li><a href="data-produk1.php?halaman=produk"><i class='bx bxl-product-hunt' ></i><span class='link_name'>Data Produk</span></a>
			<span class='tooltip'>Data Produk</span>
			</li>
			
			<li><a href="pembelian1.php?halaman=pembelian"><i class='bx bxl-product-hunt' ></i><span class='link_name'>Data Pembelian </span></a>
			<span class='tooltip'>Data Pembelian</span>
			</li>
		
			
		<li><a href="logout.php"><i class='bx bx-log-out'></i><span class='link_name'>Logout</span></a>
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
	<div class="main-content">
	<div class='dashboard-profil'>
		<div class="section-admin">
		<div class="container">
			<p class="alert_info dashboard_alert">Berikut Data <a href="#form-profil-admin">Pembelian Produk</a> anda dibawah !</p>
			<h3>Dashboard Pembelian</h3>
			<div class="box box2"><h2> Data Pembelian</h2>
<table class="table table-bordered">
<thead>
<tr>
	<th>No</th>
	<th>Nama Pelanggan</th>
	<th>Tanggal</th>
	<th>Status Pembelian</th>
	<th>Total</th>
	<th>Aksi</th>
</tr>	
</thead>
<tbody>
	<?php $nomor=1; ?>
	<?php $ambil=$koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan");?>
	<?php while ($pecah = $ambil->fetch_assoc()){ ?>
	<tr>
		<td> <?php echo $nomor; ?></td>
		<td> <?php echo $pecah ['nama_pelanggan']; ?></td>
		<td> <?php echo $pecah['tanggal_pembelian']; ?></td>
		<td class='<?php echo $pecah['status_pembelian']; ?>'> <?php echo $pecah['status_pembelian']; ?></td>
		<td> <?php echo $pecah ['total_pembelian']; ?></td>
		<td>
			<a href="detail.php?id=<?php echo $pecah['id_pembelian']; ?> "class="btn btn-info"><i class='bx bx-detail'></i></a> || 
			<a href="detail-pembelian.php?id=<?php echo $pecah['id_pembelian'];?>" class="btn btn-success <?php echo $pecah['status_pembelian']; ?>" ><i class='bx bxs-check-square' ></i></a>
			<?php if ($pecah['status_pembelian']!=="pending"):?>
	
			<?php endif ?>
		</td>
	</tr>
	<?php $nomor++; ?>
	<?php } ?>
</tbody>
</table></div>
				
<script>
	let btn = document.querySelector('#btn');
	let sidebar = document.querySelector('.sidebar');
	
	btn.onclick = function(){
		sidebar.classList.toggle('active');
	}
	</script>
</body>
</html>


