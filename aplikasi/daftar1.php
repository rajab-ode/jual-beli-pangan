<?php
include('db.php');

			// jika ada tombol daftar ( ditekan tombol daftar)
			if (isset($_POST["daftar"]))
			{
				// mengambil isian nama,email,password,alamat,telepon
				global $conn;
				$nama = $_POST["admin_name"];
				$username = $_POST["username"];
				$password	= $_POST ["password"];
				$telepon	= $_POST ["admin_telp"];
				$email = $_POST["admin_email"];
				$alamat	= $_POST ["admin_address"];
				$bank = $_POST["jenis_bank"];
				$norek = $_POST["no_rekening"];
				$level = $_POST["level"];

				$cek =  mysqli_query($conn, "SELECT * FROM tb_admin WHERE username = '".$user."' AND password ='".MD5($pass)."'");
				$yangcocok = $ambil ->num_rows;
				if ($yangcocok==1)
				{
					echo "<script>alert('pendaftaran gagal, email sudah digunakan'); </script>";
					echo "<script>location='daftar1.php'; </script>";
				}
				else {
					//query insert ke tabel pelanggan
					$sql=mysqli_query($conn,"INSERT INTO tb_admin(admin_name,username,password,admin_telp,admin_email,admin_address,jenis_bank,no_rekening,level) VALUES ('$nama','$username','$password','$telepon','$email','$alamat','$bank','$norek','$level') ");
								
					echo "<script>alert('pendaftaran sukses, silahkan login'); </script>";
					echo "<script>location='login-pelanggan.php'; </script>";
				}
			}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Daftar</title>
<style>
 body {
 	background: #fff;
    direction: ltr;
    font-size: 14px;
	font-family:'Poppins',sans-serif;
    line-height: 1.4286;
    margin: 0;
    padding: 0;
}
.container-form {
	display: -webkit-box;
    display: -webkit-flex;
    display: flex;
    -webkit-flex-direction: column;
    flex-direction: column;
	padding:50px;
    min-height: 100vh;
    position: relative;
    justify-content: center;
    align-items: center;
	background:no-repeat left 0 top 250px url(swoosh.jpg);
}
.RAYh1e {
    background: #fff;
	box-shadow:  0 12px 48px rgb(26 33 52 / 11%);
	border-radius:10px;
    display: -webkit-box;
    display: -webkit-flex;
    display: flex;
    -webkit-flex-direction: column;
    flex-direction: column;
    max-width: 100%;
    position: relative;
    z-index: 2;
}
.xkfVF {
    -webkit-box-flex: 1;
    box-flex: 1;
    -webkit-flex-grow: 1;
    flex-grow: 1;
    overflow: hidden;
    padding: 24px ;
}	
.Aa1VU {
    -webkit-flex-basis: 450px;
    flex-basis: 450px;
    margin: 0 -48px;
    overflow: hidden;
    padding: 0 48px;
}
.Wxwduf {
    display: inline-block;
    font-size: 14px;
    vertical-align: top;
    white-space: normal;
    width: 100%;
}
.WEQkZc {
    -webkit-flex-basis: 450px;
    flex-basis: 450px;
    margin: 0 -48px;
    overflow: hidden;
    padding: 0 48px;
}
.form-group {
	margin:15px 0; 
}
input.form-control {
	width:490px;
	height:20px;
	padding: 6px 8px;
	font-size:14px;
	border-radius:4px;
	border:thin solid #dadce0;
	outline-color:#2962ff66;
	font-family:'Poppins',sans-serif;
}
textarea.form-control {
	border-radius:4px;
	border:thin solid #dadce0;
	width:500px;
	font-family:'Poppins',sans-serif;
	outline-color:#2962ff66
}
.btn-register {
	background:#2962ff;
	color:#fff;
	border:none;
	padding:8px 16px;
	border-radius:50px;
	width:100%;
	text-align:center;
	font-family:'Poppins',sans-serif;
}
.btn-register.home {
	background:#fff;
	border:thin solid #dadce0;
	color:#212121;
	width:100%;
	text-align:center;
	border-radius:50px;
	font-family:'Poppins',sans-serif;
	transition:all ease .5s
}
.btn-register.home:hover{
background:#212121;
}
button a.home {
	color:#dadce0;
	text-decoration:none;
	font-family:'Poppins',sans-serif;
}
a {
	color:#2962ff;
}
.title h3 {
	margin:0;
	padding:0;
	text-align:center;
}

.ea{
	display: none;
}

.hadir{
	display:block;
}
	</style>
</head>
<body>
	<div class='container-form'>
		<div class='RAYh1e'>
			<div class='xkfVF'>
				<div class="Aa1VU">
					<div class="Wxwduf">
						<div class='WEQkZc'>
							<div class='title'><h3>Form Daftar</h3></div>
								<form method='post'>
									<div class="form-group">
										<label class="control-label col-md-3">Nama</label>
										<div class="col-md-7">
											<input type="text" class="form-control" name="admin_name"  placeholder=' Contoh : Alex' required>	
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3">Username</label>
										<div class="col-md-7">
											<input type="text" class="form-control" name="username"  placeholder=' Contoh : Alex' required>	
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3">Password</label>
										<div class="col-md-7">
											<input type="password" class="form-control" name="password" placeholder=' ******' required>	
										</div>
									</div>
									<div class="form-group">
											<label class="control-label col-md-3">Telp / HP</label>
										<div class="col-md-7">
											<input type="text" class="form-control" name="admin_telp" placeholder='628319012321' required>	
										</div>
									</div>
									<div class="form-group">
											<label class="control-label col-md-3">Email</label>
										<div class="col-md-7">
											<input type="text" class="form-control" name="admin_email" placeholder=' Contoh : alex@gmail.com' required>	
										</div>
									</div>
									<div class="form-group">
											<label class="control-label col-md-3" id="ae">Alamat</label>
										<div class="col-md-7">
											<textarea class="form-control" name="admin_address" placeholder=' Jakarta, Indonesia' required></textarea>	
										</div>
									</div>
									<div class="form-group">
										<input class="form-check-input" type="radio" name="level" onclick="func2()" name="flexRadioDefault" id="flexRadioDefault1" value="pembeli">
										<label class="form-check-label" for="flexRadioDefault1">
											Pembeli
										</label>
										<input class="form-check-input" name="level" type="radio" onclick="func()" name="flexRadioDefault" id="flexRadioDefault1" value="penjual">
										<label class="form-check-label" for="flexRadioDefault1">
											Penjual
										</label>

										
										<script>
											function func(){
												document.getElementById("ea").classList.add("hadir")
												document.getElementById("ea").classList.remove("ea")
												document.getElementById("ea2").classList.remove("ea")
											}
											function func2(){
												document.getElementById("ea").classList.add("ea")
												document.getElementById("ea2").classList.add("ea")
												document.getElementById("ea").classList.remove("hadir")
											}
										</script>
									</div>
									<div class="form-group ea" id="ea">
										<label class="control-label col-md-3">Bank</label>
										<div class="col-md-7">
											<input type="text" class="form-control" name="jenis_bank" placeholder=' contoh : Mandiri'>	
										</div>
									</div>
									<div class="form-group ea" id="ea2">
											<label class="control-label col-md-3">No Rekening</label>
										<div class="col-md-7">
											<input type="text" class="form-control" name="no_rekening" placeholder=' contoh : 111-222-333-444' >	
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-7 col-md-offset-3">
											<button type="submit" name="daftar" class="btn-register">daftar</button>
										</div>
									</div>
										<div class="col-md-7 col-md-offset-3">
											<button class="btn-register home" name="Beranda"><a href='index.php' class='home'>Beranda</button>
										</div>
								</form>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>

<script type="text/javascript">
	
	// a.addEventListener(mousehover, fun);
	function myFunt(){
		alert("eaa")
		
	}

	
</script>
			

</body>
</html>