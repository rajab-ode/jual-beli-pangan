<?php
session_start();
include ('db.php');
if ($_SESSION['login'] != true){
	echo '<script>window.location="login_admin.php"</script>';
}

$id = $_SESSION["id"];
$query = mysqli_query($conn, "SELECT * FROM tb_admin WHERE level='penjual' AND admin_id = $id");
$d = mysqli_fetch_object($query);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width-device-width, initial-scale=1">
<title>E-Marketplace</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="icon/css/all.css">
<link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>

<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
		<link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
</head>
<body >
	<div class='sidebar'>
<!--NAVIGATION WEB-->
		<div class='logo-content'>
		<div class='logo'>
		<i class='bx bx-menu' id='btn'></i>
		<div class='logo_name'>
			<i class="fa-solid fa-user"  style="margin-left: -10px;"></i>
			<div style="position:absolute; top:20px; left:100px;"> 
					<p style='font-size:small' >Halo <br>
					<span style='font-style:italic;color:#2962ff'><?php echo $d->username ?></span></p></div>
			</div>
		</div>
	
		</div>

			<ul class='nav'>
				<li><a href="dashboard-penjual.php"><i class='fas fa-tachometer-alt-slow'></i></i><span class='link_name'>Dashboard</span></a>
							<span class='tooltip'>Dashboard</span>
							</li>
		<li><a href="home-penjual.php"><i class='bx bx-user-circle'></i></i><span class='link_name'>Profil</span></a>
			<span class='tooltip'>Profil</span>
			</li>

			
			<li><a href="data-produk1.php?halaman=produk"><i class='bx bxl-product-hunt' ></i><span class='link_name'>Data Produk</span></a>
			<span class='tooltip'>Data Produk</span>
			</li>
			
			<li><a href="pembelian1.php?halaman=pembelian"><i class='bx bxl-product-hunt' ></i><span class='link_name'>Data Pembelian </span></a>
			<span class='tooltip'>Data Pembelian</span>
			</li>
		
			
		<li><a href="logout1.php"><i class='bx bx-log-out'></i><span class='link_name'>Logout</span></a>
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
	<!--Content-->
	<div class="main-content">
		<div class="container">
			<p class="alert_info dashboard_alert">Untuk memperbaharui Data Produk anda silahkan <a href="#">Input Ulang Form</a> dibawah !</p>
			<h3>Data Produk</h3>
			<div class="box box2">
				<button class='btn'><a href="tambah-produk.php">Tambah Data</a></button>
				<table border="1" cellspacing="0" class="table">
					<thead>
						<tr>
							<th width="60px">No</th>
							<th>Kategori</th>
							<th>Nama Produk</th>
							<th>Harga</th>
							<th>Berat</th>
							<th>Stok</th>
							<th>Deskripsi</th>
							<th>Gambar</th>
							<th>Status</th>
							<th width="150px">Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$no =1;
							$produk = mysqli_query($conn, "SELECT * FROM tb_product LEFT JOIN tb_category USING (category_id) WHERE penjual_id = $id ORDER BY product_id DESC ");
						if(mysqli_num_rows($produk) >0){
						while($row =mysqli_fetch_array($produk)){
							
						
						?>
						<tr>
							<td><?php echo $no++ ?></td>
							<td><?php echo $row ['category_name'] ?></td>
							<td><?php echo $row ['product_name'] ?></td>
							<td>Rp. <?php echo number_format($row['product_price']) ?></td>
							<td><?php echo $row ['berat_produk'] ?></td>
							<td><?php echo $row ['stok_produk'] ?></td>
							<td><?php echo $row ['product_descrption'] ?></td>
							<td><a href="produk/<?php echo $row ['product_image'] ?>" target="_blank"><img src="produk/<?php echo $row ['product_image'] ?>" width="50px"</a></td>
							<td><?php echo ($row ['product_status'] ==0)? 'Tidak Aktif' : 'Aktif';?></td>
							<td>
								<a href="edit-produk.php? id=<?php echo $row ['product_id'] ?>"><i class='btn-bg bx bx-edit'></i></a> || <a href="proses-hapus.php?idp=<?php echo $row['product_id']?>" onClick="return confirm ('Yakin ingin hapus ?')"><i class='btn-bg bx bx-trash'></i></a>
							</td>
						</tr>
						<?php }} else { ?>
							<tr>
								<th colspan="12"> Tidak Ada Data</th>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<!--Footer-->
	<script>
	let btn = document.querySelector('#btn');
	let sidebar = document.querySelector('.sidebar');
	
	btn.onclick = function(){
		sidebar.classList.toggle('active');
	}
	</script>
</body>
</html>