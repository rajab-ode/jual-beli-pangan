<?php
session_start();

include('db.php');


$koneksi =new mysqli("localhost","root","","db_hasilpertanian");

if(empty($_SESSION["keranjang"]) )
{
	echo "<script>alert ('Keranjang kosong, silahkan berbelanja');</script>";
	echo "<script>location='index.php';</script>";
}
if ( !isset($_SESSION["pelanggan"]))
{
	echo "<script>alert('silahkan login');</script>";
	echo "<script>location='login-pelanggan.php';</script>";  
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
		tbody {
			background:white
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
	<a href="index.php">Home</a>
</span> 
<span class="menu-item">
	<a href="produk.php">Produk</a>
</span> 
<span class="menu-item">
	<a href="keranjang.php">Keranjang Belanja</a>
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
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem quos in fugit voluptas minus earum.</p>

</div>
</div>
</div>
	<!--seacrh-->

	<!-- Keranjang-->
<section class="konten">
	<div class="container">
		<h1 class='title-basket'> Keranjang Belanja</h1>
		<table class="table table-bordered">
		<thead>
			<tr>
				<th>No</th>
				<th>Produk</th>
				<th>Harga</th>
				<th>Jumlah</th>
				<th>SubHarga</th>
				<th>Aksi</th>
			</tr>	
		</thead>
		<tbody>
			<?php $nomor=1;?>
			<?php $totalbelanja =0; ?>
			<?php foreach ($_SESSION["keranjang"] as $product_id => $jumlah): ?>
			<?php
			$ambil = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_id ='$product_id'") ;
			$pecah = $ambil->fetch_assoc();
			$subharga =$pecah["product_price"]*$jumlah;
			
			?>
			<tr>
				<td><?php echo $nomor; ?></td>
				<td><?php echo $pecah ["product_name"]; ?></td>
				<td>Rp. <?php echo number_format($pecah["product_price"]); ?> </td>
				<td><?php echo $jumlah; ?>Kg</td>
				<td>Rp. <?php echo number_format($subharga); ?></td>
				<td> <a href="hapusprodukkeranjang.php?id=<?php echo $product_id ?>" class="btn-danger"><i class="bx bx-trash"></i></a> </td>
			</tr>
			<?php $nomor++; ?>
		<?php $totalbelanja+=$subharga;?>
			<?php endforeach ?>
		</tbody>	
	<tfoot>
	<tr style='background:#212121;color:#fff;font-weight:normal'>
		<th colspan="5">Total Belanja </th>
		<th>Rp.<?php echo number_format($totalbelanja);?>
			
		</th>	
	</tr>
	</tfoot>
		</table>
		
		<a href="produk.php" class="btn-default"><i class='bx bx-basket'></i>Lanjutkan Belanja</a>
		<a href="checkout.php" class="btn-default2"><i class='bx bx-check'></i>Checkout</a>
	</div>
	</section>
</div>
</div>
</div>
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