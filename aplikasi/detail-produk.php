<?php
include('db.php');
$koneksi =new mysqli("localhost","root","","db_hasilpertanian");
?>
<?php
//mendapatkan id produk dari url
session_start();
$product_id = $_GET["id"];
//query ambil data
$ambil=$koneksi->query("SELECT * FROM tb_product WHERE product_id='$product_id'");
$detail=$ambil->fetch_assoc(); 
//echo "<pre>";
//print_r($detail);
//echo "</pre>";

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width-device-width, initial-scale=1">
<title> E-COMMERCE </title>
<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
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
<span class="menu-item"><a href="index.php">Home</a></span><span class="menu-item"><a href="produk.php">Produk</a></span><span class="menu-item"><a href="keranjang.php">Keranjang Belanja</a></span>
</div>
</div><div class='logout-button'><span class='logout-btn'><a href='logout1.php'>Logout</a></span></div></div>
</header>
<!--	Hero Wrapper	-->
	<div class='hero-content'>
<div class="jumbotron-content">
<div class="jumbotron-inner">
<h2 class="title">Temukan Pangan Terbaik Disini.</h2>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem quos in fugit voluptas minus earum.</p>
<div class="search">
		<div class="search-form">
			<form action="produk.php" method="get">
				<input type="text" name="search" placeholder="Cari Produk...">
				<input type="submit" name="cari" value="Cari Produk">
			</form>
		</div>
	</div>
</div>
</div>
</div>
	<!--seacrh-->

<section class="content">
	<div class="container" style='background:#f1f1f1'>
	<h2 style='margin:20px 0;'>Produk Yang Akan Dibeli :</h2>
	<div class="card-detail-produk">
	<div class="col-md-6">
		<img src="produk/<?php echo $detail["product_image"];?>" alt="" class="img-responsive" style='width:150px;border-radius:15px;'>
	</div>	
	<div class="col-md-6" style='margin-left:1rem'>
		<h2><?php echo $detail["product_name"]?></h2>
		<h4>Rp. <?php echo number_format($detail["product_price"]);?></h4>
		<p><?php echo $detail["product_descrption"];?></p>
		<h5>Stok:<?php echo $detail['stok_produk']?></h5>
				
		<form method="post">
			<div class="form-group">
				<div class="input-group">
				<input style='margin:10px 0;border:thin solid #999;padding:4px 10px;border-radius:4px;' placeholder='Cth : 12' type="number" class="form-control" name="jumlah" max="<?php echo $detail['stok_produk']?>">
				
					<button class="btn btn-primary" name="beli">Beli</button>
	</div>
	</div>
		</form>
		<?php
		//jika ada tombol beli
		if (isset($_POST["beli"]))
		{
			//mendapatkan jumlah yang di inputkan
			$jumlah = $_POST["jumlah"];
			//masukkan dikeranjang belanja
			$_SESSION["keranjang"][$product_id] = $jumlah;
			
		
			echo "<script>location='keranjang.php';</script>";
		}
		?>
		</div>
		</div>
	</div>
</section>
</div>
	<!-- footer-->
	<div id='footer'>
    <div class='footer-sections row'>
      <div class='sect-left' id='footer-sec1'><img src='logo-toba.png' width='64'/>
		<h3 style='font-weight:normal'>Pemerintah Kabupaten Toba</h3>
		  <h4 style='font-weight:normal'>Dinas Pertanian &amp; Perikanan Tobasa</h4>
		  <p><small>Jl. Pertanian No.1, Huta Bulu Mejan, Kec. Balige, Toba, Sumatera Utara 22312</small></p>
		
		</div>
      
      <div class='sect-left' id='footer-sec2'><h2> Tentang Kami</h2>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima numquam, ex eius illum distinctio. Rerum harum quod, libero enim laudantium laboriosam excepturi non, vel placeat facere similique adipisci architecto ducimus.</div>
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
