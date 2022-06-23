<?php
session_start();

include('db.php');


$koneksi =new mysqli("localhost","root","","db_hasilpertanian");
$alamat_pengiriman = $alamat_pengiriman_er = "";
if ($_SERVER['REQUEST_METHOD']=='POST') {
	if (empty(trim($_POST['alamat_pengiriman']))) {
		$alamat_pengiriman_er = " Maaf Alamat Pengigiriman harus diisi";
		}else{
			$alamat_pengiriman=$_POST['alamat_pengiriman'];
		}
		if (empty($alamat_pengiriman_er)) {
			# code... 
		}
}
?>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width-device-width, initial-scale=1">
<title> Checkout </title>
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
button.btn-primary {
	border:none;
	background:#2962ff;
	color:#fff;
	padding:8px 16px;
	border-radius:4px;
}
h1.title-basket {
    font-size: 20px;
    margin: 10px 0;
}
.container h1 {
	margin:0 0 10px;
}
form.bg-form {
	background: #ffff;
    padding: 2rem;
    border-radius: 8px;
}
.form-group {
    margin: 10px 0;
}
.row {
	display:flex;
	justify-content: space-between;
}
.col-md-4 {
    width: 95%;
    margin: 0 1rem;
}
.col-md-4:first-child{
    margin-left: 0;
}
.col-md-4:last-child{
    margin-right: 0;
	margin-top:10px;
}
input.form-control, select.form-control, textarea.form-control {
    border: thin solid #dadce0;
    height: 40px;
    padding: 8px;
	border-radius:4px;
	width:100%
}
input.form-control:focus, select.form-control:focus, textarea.form-control:focus {
outline-color:#2962ff;
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


</div>
</div>
</div>
	<!--seacrh-->

	<!-- Keranjang-->
<section class="konten">
	<div class="container">
		<h1> Keranjang Belanja</h1>
		<table class="table table-bordered">
		<thead>
			<tr>
				<th>No</th>
				<th>Produk</th>
				<th>Harga</th>
				<th>Jumlah</th>
				<th>Subharga</th>
			</tr>	
		</thead>
		<tbody>
			<?php $nomor=1;?>
			<?php $totalbelanja =0; ?>
			<?php  
			$keranjang=array();
			foreach ($_SESSION["keranjang"] as $product_id => $jumlah): ?>
			
			<?php
			$ambil = $koneksi->query("SELECT * FROM tb_product WHERE product_id ='$product_id'");
			$pecah = $ambil->fetch_assoc();
			$subharga =$pecah["product_price"]*$jumlah;
			
			?>
			<tr>
				<td><?php echo $nomor; ?></td>
				<td><?php echo $pecah ["product_name"]; ?></td>
				<td>Rp. <?php echo number_format($pecah["product_price"]); ?> </td>
				<td><?php echo $jumlah; ?>KG</td>
				<td>Rp. <?php echo number_format($subharga); ?></td>
				<?php $jumKG[] = $jumlah;?>
			</tr>
			<?php $nomor++; ?>
			<?php $totalbelanja+=$subharga; ?>
			<?php endforeach; ?>
		</tbody>	
			<tfoot>
				<tr>
					<th colspan="4">Total Belanja</th>
					<th>Rp. <?php echo number_format($totalbelanja)?></th>
				</tr>
			</tfoot>
			<?php $hasil1 = 0;
				for($i=0; $i<count($jumKG); $i++){
					
					$hasil1 += $jumKG[$i];
				}
				// var_dump($hasil1);
			
			?>
		</table>
		<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" class='bg-form'>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for=""><b>Nama</b></label>
						<input type="text" readonly value="<?php echo $_SESSION["pelanggan"]['admin_name'] ?>" class="form-control" required>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for=""><b>Nomor HP</b></label>
						<input type="text" readonly value="<?php echo $_SESSION["pelanggan"]['admin_telp'] ?>" class="form-control" required>
					</div>
				</div>
				<div class="col-md-4">
					<label for=""><b>Ongkir</b></label>
					<select class="form-control" name="id_ongkir" required>
					<!-- <option value>Pilih Ongkos Kirim</option> -->
						<?php 
						$ambil = $koneksi->query("SELECT * FROM ongkir");
						while ($perongkir =$ambil->fetch_assoc()){
							?>
					<option value="<?php echo $perongkir["id_ongkir"]?>">
						<?php echo $perongkir['nama_kota'] ?>
						Rp. <?php echo number_format($perongkir['tarif']*$hasil1)?>
					</option>	
						<?php } ?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label><b>Alamat Lengkap Pengiriman</b></label>
				<textarea style='height:100px' class="form-control" name="alamat_pengiriman" placeholder="masukkan alamat lengkap pengiriman(termasuk kode pos)" required></textarea>
				<span><?php echo $alamat_pengiriman_er; ?></span>
			</div>
			<button class="btn-primary" name="checkout" type="submit">Checkout</button>
		</form>
		<?php
		if (isset($_POST["checkout"]))
		{
			$admin_id = $_SESSION["pelanggan"]["admin_id"];
			$id_ongkir = $_POST["id_ongkir"];
			$tanggal_pembelian = date("Y-m-d");
			$alamat_pengiriman = $_POST['alamat_pengiriman'];
			$ambil = $koneksi->query( "SELECT * FROM ongkir WHERE id_ongkir='$id_ongkir'");
			$arrayongkir= $ambil ->fetch_assoc();
			$nama_kota =$arrayongkir['nama_kota'];
			$tarif = $arrayongkir['tarif']*$hasil1;
			$total_pembelian = $totalbelanja + $tarif;
			// echo"<br>";
			// var_dump($id_pelanggan);
			// echo"<br>";
			// var_dump($id_ongkir);
			// echo"<br>";
			// var_dump($tanggal_pembelian);
			// echo"<br>";
			// var_dump($alamat_pengiriman);
			// echo"<br>";
			// var_dump($ambil);
			// echo"<br>";
			// var_dump($arrayongkir);
			// echo"<br>";
			// var_dump($nama_kota);
			// echo"<br>";
			// var_dump($tarif);
			// echo"<br>";
			// var_dump($total_pembelian);
			// echo"<br>";
			// die;
			
			// 1. Menyimpan data ke tabel pembelian
		
			$koneksi->query("INSERT INTO pembelian (admin_id,id_ongkir,tanggal_pembelian,total_pembelian,nama_kota,tarif,alamat_pengiriman) VALUES ('$admin_id','$id_ongkir','$tanggal_pembelian', '$total_pembelian','$nama_kota','$tarif','$alamat_pengiriman') " );
			
			//mendapatkan id_pembelian barusan
			$id_pembelian_barusan = $koneksi->insert_id;
			
			
			foreach ($_SESSION["keranjang"] as $product_id => $jumlah) 
			{
				// mendapatkan data produk berdasarkan id_produk
				
				$koneksi->query("INSERT INTO pembelian_produk (id_pembelian,product_id,jumlah) VALUES ('$id_pembelian_barusan','$product_id','$jumlah')");
				
				//mengupdate stok
				$koneksi->query("UPDATE tb_product SET stok_produk=stok_produk -$jumlah WHERE product_id='$product_id'");
			
		}
			// mengkosongkan keranjang belanja
			
			unset ($_SESSION["keranjang"]);
			
			//tampilan dialihkan ke nota 
           if($koneksi){
			echo "<script>alert('pembelian suksess') ;</script>";
				echo "<script>location='nota.php?id=$id_pembelian_barusan';</script>";
            }else{
             echo "Gagal";
             }

		}

		?>
		
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