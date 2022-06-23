<?php
session_start();

include('db.php');
$kontak = mysqli_query($conn,"SELECT admin_telp, admin_email, admin_address FROM tb_admin WHERE admin_id = 1");
$a = mysqli_fetch_object($kontak);

if(!empty($_SESSION["login"])){
	$login = $_SESSION["login"];

}


?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width-device-width, initial-scale=1">
<title>E-Marketplace</title>
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
<span class="menu-item"><a href="index.php">Home</a></span><span class="menu-item"><a href="produk.php">Produk</a></span> <span class="menu-item"><a href="keranjang.php">Keranjang Belanja</a></span><span class="menu-item">
</div>
</div>

<?php if(!empty($login)==true): ?>
<div class='login-button'><span class='login-btn'><a href='logout1.php'>Logout</a></span></div>
<?php elseif(empty($login)): ?>
<div class='login-button'><span class='login-btn'><a href='login-pelanggan.php'>Login</a></span></div>
<?php endif; ?>

</div>

</header>
<!--	Hero Wrapper	-->
	<div class='hero-content'>
<div class="jumbotron-content">
<div class="jumbotron-inner">
<h2 class="title">Temukan Pangan Terbaik Disini.</h2>
<p><b><strong>Silahkan Berbelanja</strong></b></p>
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
	
	
	<!--category-->
<div class="section">
		<div class="container">
			<h3 style="margin:15px 20px">Kategori Produk</h3>
			<div class="box">
				<?php
					$kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
				if (mysqli_num_rows($kategori) >0){
					while ($k = mysqli_fetch_array($kategori)){
						?>
					
						<a href="produk.php? kat=<?php echo $k['category_id'] ?>">
						<div class="col-5">
							<img src="img/simbol.png" width="50px" style="margin-bottom:5px;">
							<p><?php echo $k['category_name'] ?></p>
						</div>
							
						</a>
					<?php }} else { ?>
						<p>Kategori Tidak Ada</p>
					<?php } ?>	
				</div>
			</div>
		</div>
	
	</div>
	
	<!-- new product-->
	<div class ="section">
		<div class="container">
				<h3 style='margin:15px 20px 0;'> Produk Terbaru</h3>
				<div class="card">
					<?php
						$produk = mysqli_query($conn, "SELECT * FROM tb_product ORDER BY product_id DESC LIMIT 10");
						if (mysqli_num_rows($produk) > 0){
							while ($p = mysqli_fetch_array($produk)){ 
						?>
					<a href="detail-produk.php?id=<?php echo $p['product_id']?>">
					<div class="product-card">
						<div class='cont'>
						<img style='width:200px;height:185.7px;border-radius:15px;' src="produk/<?php echo $p['product_image']?>">
						<p class="nama" style='font-weight:bold'><?php echo substr($p['product_name'], 0 , 30)?></p>
						<p class="harga" style='margin:5px 0 10px;font-style:italic'><i class='bx bx-purchase-tag-alt' style='color:#bf5000;'></i> Rp. <?php echo number_format($p['product_price'])?></p>
						<p style='text-align:center'><a href="beli.php?id=<?php echo $p['product_id'];?> " class="btn btn-blue"><i class='bx bx-basket' ></i> Beli</a>
						<a href="detail-produk.php?id=<?php echo $p["product_id"];?>" class="btn btn-black"><i class='bx bx-detail'></i> Detail</a></p>
						<p style='margin:10px 0 0;text-align:center;'><a class="btn btn-green" href="<?php echo $p['no_telepon']?>"><i class='bx bxs-phone'></i> Hubungi Penjual</a>
							</div>
					</div>
					</a>
						<?php }} else { ?>
					<p> Produk Tidak Ada</p>
					<?php } ?>
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