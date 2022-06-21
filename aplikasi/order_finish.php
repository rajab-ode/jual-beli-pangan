<?php
session_start();

include('db.php');
$simpan=mysqli_query($conn, "SELECT * FROM checkout");
$p = mysqli_fetch_object($simpan);
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<style>
	* {
		font-family:'Poppins',sans-serif;
	}
.table {
		width:100%;
		border:none;
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
div.center {
    display: flex;
    justify-content: center;
}
button.btn-bg {
    position: absolute;
    bottom: 10%;
    border-radius:25px;
    background: #212121;
	padding:4px 18px;
	border:none
}
button.btn-bg a {
    color:#fff;
	text-decoration:none;
}
	</style>
</head>

<body>
<h1 style='margin:15px 20px;font-weight:normal'> CHECKOUT</h1>
<section class="konten">
	<div class="container">
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
				<td><?php echo $jumlah; ?> </td>
				<td>Rp. <?php echo number_format($subharga); ?></td>
			</tr>
			<?php $nomor++; ?>
		<?php $totalbelanja+=$subharga;?>
			<?php endforeach ?>
		</tbody>	
	<tfoot>
	<tr style='background:#212121;color:#fff'>
		<th colspan="4" >Total Belanja </th>
		<th>Rp.<?php echo number_format($totalbelanja);?>
			
		</th>	
	</tr>
	</tfoot>
	
			<div class="row">
			<div class="col-9">
				<?php
					$simpan=mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM checkout ORDER BY idcheckout DESC"));
				?>
			</div>
			</div>
	
		<table cellspacing="0" cellpadding="3">
		<h1 style='margin:15px 20px;font-weight:normal'>Formulir Pembeli</h1>
		<tr>
			<td>No. Pembelian</td>
			<td>: <?php echo $simpan['idcheckout'];?></td>
		</tr>
			<tr>
			<td>Nama Pembeli</td>
			<td>: <?php echo $simpan['nama'];?></td>
		</tr>
			<tr>
			<td>No Telp</td>
			<td>: <?php echo $simpan['notelp'];?></td>
		</tr>
		<tr>
			<td>Jenis Pengiriman</td>
			<td>: <?php echo $simpan['jenis_pengiriman'];?></td>
		</tr>
		<tr>
			<td>Alamat Pengiriman</td>
			<td>: <?php echo $simpan['alamat_pengiriman'];?></td>
		</tr>
		<div class='center'><button class='btn-bg'><a href='index.php'><svg xmlns="http://www.w3.org/2000/svg" style='width:24px;vertical-align:sub;margin-right:10px;' fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"> <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /> </svg>Kembali</a></button></div>
			</body>
</html>