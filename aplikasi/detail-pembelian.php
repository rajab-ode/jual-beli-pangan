<?php

include ('db.php');

$koneksi =new mysqli("localhost","root","","db_hasilpertanian");

//

// mendapatkan id_pembelian dari url
$idpembelian =$_GET["id"];
$ambil = $koneksi->query("SELECT * FROM pembayaran WHERE id_pembelian='$idpembelian'");
$detail = $ambil->fetch_assoc();


?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>E-Marketplace</title>
</head>
<style>
	body {
		height:100vh;
		display:flex;
		align-items:center;
		justify-content:center;
	}
	.row {
		display: flex;
    padding: 2rem;
    box-shadow: 0 15px 32px rgb(0 0 0 / 18%);
    border-radius: 1rem;
	border-top:5px solid #2962ff;
	}
	.row img {
		width:150px;
		height:150px;
		border-radius:10px;
		margin:0 1rem;
	}
	.table, form {
		text-align:left;
		margin-left:1rem;
	}
	.form-group {
    margin: 0 0 10px;
}
input.form-control, select.form-control {
    border: thin solid #dadce0;
    border-radius: 4px;
}
button.btn.btn-primary {
	background : #2962ff;
	padding : 8px 12px;
	border:none;
	color:#fff;
	border-radius:4px;
	cursor:pointer;
}
button.btn.btn-default {
	background : #212121;
	padding : 8px 12px;
	border:none;
	color:#fff;
	border-radius:4px;
	cursor:pointer;
}
input.form-control:focus, select.form-control:focus {
	outline-color:#2962ff;
}
</style>
<body>
<div class="row">
	<div class="col-md-6">
		<table class="table">
			<tr>
				<th>Nama</th>
				<td> : <?php echo $detail['nama'];?></td>
			</tr>
			<tr>
				<th>Bank</th>
				<td> : <?php echo $detail['bank'];?></td>
			</tr>
			<tr>
				<th>Jumlah</th>
				<td> : Rp.<?php echo number_format($detail['jumlah']);?></td>
			</tr>
			<tr>
				<th>Tanggal</th>
				<td> : <?php echo $detail['tanggal'];?></td>
			</tr>
		</table>
		
	</div>
	<form method="post">
	<div class="form-group">
		<label>No Resi Pengiriman</label>
		<input type="text" class="form-control" name="resi">
	</div>
	<div class="form-group">
		<label>Status</label>
		<select class="form-control" name="status">
			<option value="">Pilih Status</option>
			<option value="lunas">Lunas</option>
			<option value="barang dikirim">Barang Dikirim</option>
			<option value="batal">Batal</option>
		</select>
	</div>
	<button class="btn btn-primary" name="proses">Proses</button>
	<button class="btn btn-default" ><a style='color:#fff;' href='pembelian1.php'>Back</a></button>
</form>
<div class="col-md-6">
		<img src="bukti_pembayaran/<?php echo $detail['bukti']?>">
	</div>
</div>
	

	<?php
	if (isset($_POST["proses"]))
	{
		$resi = $_POST["resi"];
		$status = $_POST["status"];
		$koneksi->query("UPDATE pembelian SET resi_pengiriman='$resi',status_pembelian='$status' WHERE id_pembelian='$idpembelian'");
		echo "<script>alert('data berhasil diupdate');</script>";
		echo "<script>location='pembelian1.php';</script>";
	}
			 ?>
</body>
</html>