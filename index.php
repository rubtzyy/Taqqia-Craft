<?php
require("connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Edit Produk</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">


</head>
<body class="bg-light">
	<div class="container bg-dark text-light p-3 rounded my-4">
		<div class="d-flex align-items-center justify-content-between px-3">
			<h2>
				<a href="index.php" class="text-white text-decoration-none">
					<i class="bi bi-bar-chart-fill"></i> Taqqia Craft </a>
				</h2>

				<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addproduct"> <i class="bi bi-plus-lg"></i> Add Product</button>
			</div>
		</div>


		<div class="container mt-5 p-0">
			<table class="table table-hover text-center">
				<thead class="bg-dark text-light">
					<tr>
						<th while="10%" scope="col" class="rounded-start">No</th>
						<th while="15%" scope="col">Gambar</th>
						<th while="10%" scope="col">Nama</th>
						<th while="10%" scope="col">Harga</th>
						<th while="35%" scope="col">Deskripsi</th>
						<th while="20%" scope="col" class="rounded-end">Aksi</th>
					</tr>
				</thead>
				<tbody class="bg-white">

					<?php 
					$query="SELECT * FROM `product`";
					$result=mysqli_query($con, $query);
					$i=1;
					$fetch_src=FETCH_SRC;
					while ($fetch=mysqli_fetch_assoc($result))
					{
						echo<<<product
						<tr class="align-middle">
						<th scope="row">$i</th>
						<td><img src="$fetch_src$fetch[gambar]" width="100px"></td>
						<td>$fetch[nama] </td>
						<td>Rp.$fetch[harga]</td>
						<td>$fetch[deskripsi]</td>
						<td>
						<a href="?edit=$fetch[id]"class="btn btn-warning me-2"><i class="bi bi-pencil-square"></i></a>
						<button onclick="confirm_rem($fetch[id])" class="btn btn-danger"><i class="bi bi-trash"></i></button>
						</td>
						</tr>
						product;
						$i++;
					}

					?>
					
				</tbody>
			</table>
		</div>



		<div class="modal fade" id="addproduct" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
			<div class="modal-dialog">
				<form action="crud.php" method="POST" enctype="multipart/form-data">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Add Product</h5>
						</div>
						<div class="modal-body">
							<div class="input-group mb-3">
								<span class="input-group-text">Name</span>
								<input type="text" class="form-control" name="name" required>
							</div>
							<div class="input-group mb-3">
								<span class="input-group-text">Price</span>
								<input type="number" class="form-control" name="price" min="1" required>
							</div>
							<div class="input-group mb-3">
								<span class="input-group-text">Description</span>
								<textarea class="form-control" name="desc" required></textarea>
							</div>
							<div class="input-group mb-3">
								<label class="input-group-text" >Image</label>
								<input type="file" class="form-control" name="image" accept=".jpg, .png, .svg, .jpeg" required >
							</div>
						</div>

						<div class="modal-footer">
							<button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
							<button type="submit" class="btn btn-success" name="addproduct">Add</button>
						</div>
					</div>
				</form>
			</div>
		</div>

		<div class="modal fade" id="editproduct" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
			<div class="modal-dialog">
				<form action="crud.php" method="POST" enctype="multipart/form-data">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Edit Product</h5>
						</div>
						<div class="modal-body">
							<div class="input-group mb-3">
								<span class="input-group-text">Name</span>
								<input type="text" class="form-control" name="name" id="editname" required>
							</div>
							<div class="input-group mb-3">
								<span class="input-group-text">Price</span>
								<input type="number" class="form-control" name="price" id="editprice" min="1" required>
							</div>
							<div class="input-group mb-3">
								<span class="input-group-text">Description</span>
								<textarea class="form-control" name="desc" id="editdesc" required></textarea>
							</div>
							<img src="" id="editimg" width="100%" class="mb-3"> <br>
							<div class="input-group mb-3">
								<label class="input-group-text" >Image</label>
								<input type="file" class="form-control" name="image" accept=".jpg, .png, .svg, .jpeg" >
							</div>
						</div>

						<div class="modal-footer">
							<button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
							<button type="submit" class="btn btn-success" name="editproduct">Edit Produk</button>
						</div>
					</div>
				</form>
			</div>
		</div>


		<?php
		if(isset($_GET['edit']) && $_GET['edit']>0)
		{
			$query="SELECT * FROM `product` WHERE `id`='$_GET[edit]'";
			$result=mysqli_query($con, $query);
			$fetch=mysqli_fetch_assoc($result);
			echo"
			<script>
			var editproduct = new bootstrap.Modal(document.getElementById('editproduct'), {
				keyboard: false I
				});

					document.querySelector('#editname').value=`$fetch[nama]`;
					document.querySelector('#editprice').value=`$fetch[harga]`;
					document.querySelector('#editdesc').value=`$fetch[deskripsi]`;
					document.querySelector('#editimg').src=`$fetch_src$fetch[gambar]`;
					editproduct.show();
				</script>
				";
			}
			?>


				<script> I
				function confirm_rem(id) {
					if(confirm("Yakin, ingin menghapus?")) {
						window.location.href="crud.php?rem="+id;
					}
				}
				</script>


				</body>
				</html>


