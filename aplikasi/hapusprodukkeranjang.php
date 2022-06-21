<?php
session_start();
$product_id=$_GET["id"];
unset($_SESSION["keranjang"][$product_id]);

echo "<script>alert ('Yakin untuk hapus ?');</script>";
echo "<script>location='keranjang.php';</script>";
?>