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
		</style>
</head>
<body>
<div class='container-form'>
<h2> Detail Pembelian</h2>
<div class="row">
<div class="col-md-4">
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
<div class='back-to-home'><a href='pembelian1.php'>Back</a></div>
		</div>
		
		</body>
		</html>