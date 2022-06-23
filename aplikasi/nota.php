<?php
session_start();

include('db.php');

$koneksi =new mysqli("localhost","root","","db_hasilpertanian");
?>
 

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
.col-md-4 h3 {
    font-size: 25px;
    margin-bottom: 10px;
}
.row {
	display:flex;
	justify-content:space-between;
	margin:2rem 0;
}
.row.bg-white, .bg-white {
    background: #fff;
    padding: 2rem;
    border-radius: 1rem;
}
.alert.alert-info {
    background: #2962ff33;
    padding: 1rem 2rem;
    color: #3860cf;
    border-radius: 5px;
}
a.btn.btn-success {
    background: #0ED005;
	transition: .2s ease-in-out;
}

a.btn.btn-success:hover{
    background: #0E9843;

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
<!--	Hero Wrapper	-->
	<div class='hero-content'>
<div class="jumbotron-content">
<div class="jumbotron-inner">
<h2 class="title">Temukan Pangan Terbaik Disini.</h2>
<p><b>Silahkan Berbelanja !</p></b>

</div>
</div>
</div>
<!--	Hero Wrapper	-->
	
<body>
	<section class="konten">
		<div class="container">
			<h2> Detail Pembelian </h2>
			<?php
			$ambil = $koneksi->query("SELECT * FROM pembelian JOIN tb_admin ON pembelian.admin_id=tb_admin.admin_id WHERE pembelian.id_pembelian='$_GET[id]'");
			// var_dump($ambil); 
			$detail =$ambil->fetch_assoc();
			?>
			<!--<pre> <?php //print_r($detail);?></pre>-->
		
			<?php
			$idpelangganyangbeli = $detail["admin_id"];
			$idpelangganyanglogin = $_SESSION["pelanggan"]["admin_id"];
			if ($idpelangganyangbeli!==$idpelangganyanglogin)
			{
				echo "<script>alert('jangan nakal');</script>";
				echo "<script>location='riwayat.php';</script>";
				exit();
			}
			?>
			<div class="row bg-white">
				<div class="col-md-4">
					<h3>Pembelian</h3>
					<strong>No.Pembelian: <span style='color:red'>#<?php echo $detail['id_pembelian'];?></span></strong><br>
					Tanggal : <?php echo $detail['tanggal_pembelian'];?><br>
					Total : Rp. <?php echo number_format($detail['total_pembelian'])?>
					<br>
					Status : <?php echo $detail['status_pembelian'];?>
				</div>
				<div class="col-md-4">
					<h3>Pelanggan</h3>
					<strong><?php echo $detail['admin_name'];?></strong><br>
					<p>
						<?php echo $detail['admin_telp'];?><br>
						<?php echo $detail['admin_email'];?>
					</p>
				</div>
				<div class="col-md-4">
					<h3>Pengiriman</h3>
					<strong><?php echo $detail['nama_kota'];?></strong><br>
					Ongkos Kirim: Rp.<?php echo number_format($detail['tarif']);?><br>
					Alamat : <?php echo $detail['alamat_pengiriman']?>
				</div>
			</div>
			<div class='bg-white'>
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama Produk</th>
							<th>Harga</th>
							<th>Jumlah</th>
							<th>Subtotal</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
						<?php $nomor=1;?>
						<?php $ambil=$koneksi->query("SELECT * FROM pembelian_produk JOIN tb_product ON pembelian_produk.product_id=tb_product.product_id WHERE pembelian_produk.id_pembelian='$_GET[id]'");?>
					<?php while ($pecah=$ambil->fetch_assoc()){ ?>
						<tr>
							<td><?php echo $nomor;?></td>
							<td><?php echo $pecah['product_name'];?></td>
							<td>Rp.<?php echo number_format($pecah['product_price']);?></td>
							<td><?php echo $pecah['jumlah'];?>Kg</td>
							<td>Rp.<?php echo number_format( $pecah['product_price']*$pecah['jumlah']);?></td>
							<td><?php echo $detail['status_pembelian'];?></td>
						</tr>
						<?php $nomor++;?>
						<?php } ?>
					</tbody>
					</table>
					<div class="row" style="">
						<div class="col-md-7">
						<div class="alert alert-info">
							<p>Silahkan melakukan pembayaran <b>Rp. <?php echo $detail['total_pembelian'];?></b></a></p>
							<?php
							$query = mysqli_query($conn, "SELECT * FROM tb_admin WHERE level='admin'");
							$d = mysqli_fetch_object($query);?>
							<div class='logo_name'><p style='font-size:bold'>Atas Nama <span style='font-style:italic;color:#D41114'><?php echo $d->admin_name ?></span></p></div> 
							<div class='logo_name'><p style='font-size:bold'>Bank Mandiri <span style='font-style:italic;color:#D41114'><?php echo $d->no_rekening?></span></p></div>
						</div>
						</div>
					</div>
					<div style="position:absolute; right:250px; top:1150px;">
						<i class='bx bxl-whatsapp' style='color:white; font-size:50px; position:absolute; top:-13px; left:15px;'></i>
						<a class="btn btn-success" style="padding: 20px 25px 20px 70px; color:white; border-radius:25px; font-weight:bold" href="https://api.whatsapp.com/send?phone=6285220832295" target="_blank">Chat Penjual</a>
					</div>
					<div class="row">
						<div class="col-md-7">
						<div class="alert alert-info">
							<p>Setelah Melakukan Pembayaran Silahkan Kunjungi <b><a href="riwayat.php">Riwayat Belanja</a></b></p>
						</div>
						</div>
					</div>
				</table>
			</div>
		</div>
	</section>

</table>
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
	
	
	<script src='javascript/jquery.min.js'></script>
	<script>
	$(window).scroll(function(){
		$('header').toggleClass('scrolled',$(this).scrollTop()>50);
	});				
	</script>
</body>
</html>