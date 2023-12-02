<?php
$servername = "localhost";
$username = "root";
$password = ""; // Kosongkan jika tidak ada password
$dbname = "taqqiacraft";

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

echo "";

// Tutup koneksi

$result= mysqli_query($conn,"SELECT * FROM admin");

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Taqqia Craft</title>
	<link rel="stylesheet" href="">
	
</head>
<body>
<div class="container cf">
	<div class="logo"></div>
	<div class="header">
		<ul>
			<li><a href="Dashboard.html">Home</a></li>
			<li><a href="produk.html">Product</a></li>
			<li><a href="bikin.html">Create Product</a></li>
			<li><a href="Dashboard.html">Workshop</a></li>
			<li><a href="About us.html">About us</a></li>
			<li><a href="admin.html">Admin</a></li>
		</ul>
		<hr>
	</div>
		<table border="1" cellpadding="10" cellspacing="0">
			<tr>
				<th>No.</th>
				<th>Edit</th>
				<th>Gambar</th>
				<th>Nama</th>
			</tr>

<?php while ($row = mysqli_fetch_assoc($result)) : ?>
			<tr>
				<td>1</td>
				<td>
					<a href="">ubah</a>
					<a href="">hapus</a>
				</td>
				<td><img src="img/tas.jpg" width="50px" alt=""></td>
				<td>Tas Tangan </td>
			</tr>
			<tr>
		
			</tr>
<?php endwhile; ?>
		</table>

</div>


</body>
</html>

