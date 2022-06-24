<?php
include('db.php');
$koneksi = new mysqli ("localhost","root","","db_hasilpertanian");
?>
<?php
			$idpembelian = $_GET["id"];
			// var_dump($idpembelian); die;
			$ambil =$koneksi->query("SELECT * FROM pembelian JOIN tb_admin ON pembelian.id_penjual=tb_admin.admin_id WHERE pembelian.id_pembelian='$idpembelian'");
			$detail =$ambil->fetch_assoc();
			?>
<!--</pre><?php //print_r($detail);?></pre>-->
<!doctype html>
<html>
<head>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

<link rel="stylesheet" href="dashboard.css">
<link rel="stylesheet" type="text/css" href="icon/css/all.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<script src='javascript/jquery.min.js'></script>
<link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>

	<style>
body{
    display: flex;
    justify-content: center;
    align-items: center;
    background: #efefef;
	height: 100vh;
	font-family:'Poppins',sans-serif;
}
.container-form {
	background: #fff;
    padding: 1rem 3rem;
    border-radius: 1rem;
	box-shadow : 0 15px 32px rgb(0 0 0 / 8%);
	max-width: 100%;
}
.row {
	display:flex;
	justify-content: space-between;
    width: 700px;
	margin: 0 0 1rem;
}
h2, h3 {
    margin-top: 0;
}
table {
			border:none;
			width:100%;
			border-spacing: 0;
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
.back-to-home {
	margin:2rem 0 .5rem;
}
.back-to-home a {
	background:#212121;
	color:#fff;
	padding:6px 12px;
	border-radius:4px;
}
.st{
	position: absolute !important;
	bottom: 9px !important;
	left: 130px !important;
}

.print2{
		display: none;
	}
	.first-header{
		display: none;
	}

@media print {
	body{
		background: white;
		height: 100%;
	}
	.container-form{
		box-shadow: none;
		width: 100%;
	}
	.print{
		display: none;
	}
	.print2{
		display: block;
	}
	.pt2{
		margin-bottom: 30px;
		margin-left: 50px;
	}
	.row{
		width: 99%;
	}
	.col-md-4{
		width: 33%;
	}
	.first-header{
		display: block !important;
	}

}

		</style>
</head>
<body>
<div class='container-form' style="position: relative;">
<h2 class="print"> Detail Pembelian</h2>
<!-- <h2 class="print2 pt2"> Laporan</h2> -->
<div class='first-header' style="display: none;">
	<div class='header-logo-univ w-100'>
		<center>
		<img src='logo-toba.png' width="75">
		</center>
	</div>
	<div class="goverment-toba">
		<h5>Pemerintah Kabupaten Toba</h5>
		<h5>Dinas Pertanian & Perikanan Tobasa</h5>
		<h6>Jl. Pertanian No.1, Huta Bulu Mejan, Kec. Balige, Toba, Sumatera Utara 22312</h6>
	</div>

</div>
<hr>
<center>
<div class="row">
	<div class="col-md-4" >
		<h3>Pembelian</h3>
		<strong>No.Pembelian : <span style='color:#bf5000;'>#<?php echo $detail['id_pembelian'];?></span></strong><br>
		Tanggal : <?php echo $detail['tanggal_pembelian'];?><br>
		Total : Rp. <?php echo number_format($detail['total_pembelian'])?>
	
	</div>
	<div class="col-md-4">
		<h3>Pelanggan</h3>
		<strong><?php echo $detail['admin_name'];?></strong><br>

			<?php echo $detail['admin_telp'];?><br>
			<?php echo $detail['admin_email'];?>
		
	</div>
	<div class="col-md-4">
		<h3>Pengiriman</h3>
		<strong><?php echo $detail['nama_kota'];?></strong><br>
		Ongkos Kirim: Rp.<?php echo number_format($detail['tarif']);?><br>
		Alamat : <?php echo $detail['alamat_pengiriman']?>
	</div>
</div>
</center>
<table class="table table-bordered">
	<thead>
		<tr>
			<th>No</th>
			<th>Nama Produk</th>
			<th>Harga</th>
			<th>Jumlah</th>
			<th>Subtotal</th>
		</tr>
	</thead>
	<tbody>
		<?php $nomor=1;?>
		<?php $ambil=$koneksi->query("SELECT * FROM pembelian_produk JOIN tb_product ON pembelian_produk.product_id=tb_product.product_id WHERE pembelian_produk.id_pembelian = $idpembelian");?>
		<?php while ($pecah=$ambil->fetch_assoc()){ ?>
		<tr>
			<td><?php echo $nomor;?></td>
			<td><?php echo $pecah['product_name'];?></td>
			<td><?php echo $pecah['product_price'];?></td>
			<td><?php echo $pecah['jumlah'];?></td>
			<td><?php echo $pecah['product_price']*$pecah['jumlah'];?></td>
		</tr>
		<?php $nomor++;?>
		<?php } ?>
	</tbody>
</table>
<div class='back-to-home print'><a href='pembelian1.php'>Back</a></div>
<div class="print st">
	<button class="btn btn-primary" style="padding: 6px 15px;" onclick="window.print()">print</button>
</div>
		</div>
		
		</body>
		</html>