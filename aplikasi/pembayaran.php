
<?php

session_start();
include('db.php');
$koneksi = new mysqli ("localhost","root","","db_hasilpertanian");

//mendapatkan url dari pembelian

$idpembelian = $_GET["id"];
$ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pembelian='$idpembelian'");
$detailpembelian = $ambil->fetch_assoc();

//echo "<pre>";
//print_r($detailpembelian);
//echo "</pre>";

//mendapatkan id_pelanggan yang beli
$id_pelanggan_beli = $detailpembelian["admin_id"];
$id_pelanggan_login = $_SESSION["pelanggan"]["admin_id"];
if ($id_pelanggan_login !== $id_pelanggan_beli)
{
	echo "<script>alert('Jangan Nakal Dong!');</script>";
	echo "<script>location='riwayat.php';</script>";
	exit ();
}
?>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width-device-width, initial-scale=1">
<title>E-Marketplace</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
	<style>
		table {
			border:none;
			margin-bottom:2rem;
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
a.btn-default {
    color: #2962ff;
    padding: 4px 18px;
    border-radius: 4px;
    border: thin solid #2962ff;
}
a.btn-default2 {
    color: #fff;
	background:#53b54c;
    padding: 4px 18px;
    border-radius: 4px;
    border: thin solid #53b54c;
}
a.btn-default i, a.btn-default2 i{
vertical-align:-1;
margin-right:5px;
}
h1.title-basket {
    font-size: 20px;
    margin: 10px 0;
}
form.bg-form {
	background: #ffff;
    padding: 2rem;
    border-radius: 8px;
}
.alert.alert-info {
    background: #2962ff33;
    padding: 1rem 2rem;
    color: #3860cf;
    border-radius: 5px;
	margin:0 0 1.5rem;
}
input.form-control {
	border: none;
    border-bottom: 1px dashed #dadce0;
	outline-color:transparent;
	margin:5px 0;
}
input.form-control:focus {
border-bottom:1px dashed #2962ff;
outline-color:transparent;
}
		</style>
</head>
<body >
<div class='first-header'>
	<div class='header-logo-univ'>
<img src='logo-toba.png' width="75">
</div>
<div class="goverment-toba">
<h2>Pemerintah Kabupaten Toba</h2>
<h3>Dinas Pertanian & Perikanan Tobasa</h3>
<h5>Jl. Pertanian No.1, Huta Bulu Mejan, Kec. Balige, Toba, Sumatera Utara 22312</h5>
</div>

</div>
	<!--Header-->
	<header class="header-wrapper bgcolor">
<div class="header-section section" id="header-section" name="Header"><div id="headerwrap">
<div class="header-widget">
<a class="header-logo-image" href="#">
<h1 id="header-title"><i class='bx bxl-shopify' style='font-size:50px'></i></h1>
</a>
</div>
</div><div class='linklist'>
<div class="menu-widget">
<span class="menu-item">
	<a href="produk.php">Produk</a>
</span>
<span class="menu-item">
	<a href="keranjang.php">Keranjang Belanja</a>
</span>
<span class="menu-item">
	<a href="riwayat.php">Riwayat Belanja</a>
</span>
</span> 
</div>
</div><div class='logout-button'><span class='logout-btn'><a href='logout1.php'>Logout</a></span></div></div>
</header>

<body>
<div class="container">
	<h2>Konfirmasi Pembayaran</h2>
	<p>Kirim bukti pembayaran Anda disini</p>
	<br/>
	<form method="post" class='bg-form' enctype="multipart/form-data">
	<div class="alert alert-info">Total tagihan anda <strong>Rp.<?php echo number_format($detailpembelian['total_pembelian']);?></strong></div>
		<div class="form-group">
			<label>Nama Penyetor</label>
			<input type="text" class="form-control" name="nama" required>
		</div>
		<div class="form-group">
			<label>Bank</label>
			<input type="text" class="form-control" name="bank" required>
		</div>
		<div class="form-group">
			<label>Jumlah</label>
			<input type="number" class="form-control" name="jumlah" required>
		</div>
		<div class="form-group">
			<label>Bukti Pembayaran</label>
			<input style='border:none' type="file" class="form-control" name="bukti" required>
			<p class="text-danger">Foto Struk Pembayaran Minimal 1Mb</p>
		</div>
		<button class="btn btn-primary" name="kirim" type="submit">Kirim</button>
		<button class="btn btn-default" ><a style='color:#fff;' href='riwayat.php'>Back</a></button>
	</form>
</div>
<?php
	if (isset($_POST["kirim"]))
	{
		$namabukti = $_FILES["bukti"]["name"];
		$lokasibukti = $_FILES["bukti"]["tmp_name"];
		$namafiks = date("YmdHis").$namabukti;
		move_uploaded_file($lokasibukti,"bukti_pembayaran/$namafiks");
		
		$nama = $_POST["nama"];
		$bank = $_POST["bank"];
		$jumlah = $_POST["jumlah"];
		$tanggal = date("Y-m-d");
		$koneksi->query("INSERT INTO pembayaran(id_pembelian,nama,bank,jumlah,tanggal,bukti) VALUES ('$idpembelian','$nama','$bank','$jumlah','$tanggal','$namafiks')");
		
		$koneksi->query ("UPDATE pembelian SET status_pembelian='sudah kirim bukti pembayaran' WHERE id_pembelian='$idpembelian'");
		echo "<script>alert('Terimakasaih Sudah Melakukan Pembayaran!');</script>";
		echo "<script>location='riwayat.php';</script>";
		exit ();
	}
	?>
<div id='footer'>
    <div class='footer-sections row'>
      <div class='sect-left' id='footer-sec1'><img src='logo-toba.png' width='64'/>
		<h3 style='font-weight:normal'>Pemerintah Kabupaten Toba</h3>
		  <h4 style='font-weight:normal'>Dinas Pertanian &amp; Perikanan Tobasa</h4>
		  <p><small>Jl. Pertanian No.1, Huta Bulu Mejan, Kec. Balige, Toba, Sumatera Utara 22312</small></p>
		
		</div>
      
      <div class='sect-left' id='footer-sec2'><h2> Tentang Kami</h2>Dinas Pertanian & Perikanan Kabupaten Toba Yang Berlamat di Jl. Pertanian N0.1, Huta Bulu Mejan, Kec. Balige, Toba, Sumatera Utara 22312</div>
		<div class='sect-left' id='footer-sec3'><h2>Social Link</h2>
			<ul class='list-style'>
			<li><i class='bx bxl-facebook' style='color:#3b5998'></i>
				<a href='#'>Facebook</a>
				</li>
				<li><i class='bx bxl-instagram' style='color:#cd486b'></i>
				<a href='#'>Instagram</a>
				</li>
				<li><i class='bx bxl-twitter' style='color:#55acee'  ></i>
					<a href='#'>Twitter</a>
				</li>
				<li><i class='bx bxl-whatsapp' style='color:#0EDB45'></i>
				<a href='#'>Whatsapp</a>
				</li>
			</ul>
		</div>
  </div>
	<div class='footer-copyright'><p>©Copyright 2022 - Universitas Methodist Indonesia</p></div>
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