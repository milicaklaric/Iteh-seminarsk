<?php
session_start();
if (!isset($_SESSION['userName']) || $_SESSION['userAdmin'] != 1) {
	header("Location: login.php");
}
?>
<html>

<head>
	<?php require "connect.php"; ?>
	<title>Trgovački Centar</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="css.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

	<?php

	$sql = "SELECT *
	FROM products";
	$products = $conn->query($sql);




	?>

	<script type="text/javascript">
		function del(id) {

			$.post('scripts/scriptDeleteFromProducts.php', {
				id: id
			}, function(data) {
				$('#response').html(data);
			});
		}
		
		function getIpAdress(){
			$.get( "http://ip.jsontest.com/", function( data ) {
				$('#ip').text("Tvoja ip adresa:"+data.ip);
			});
		}
	</script>


</head>

<body>

	<?php
	include "nav.php";
	?>

	<div class="row">
		<div class="col-lg-12 col-xs-12">
			<div class="page-header">
				<h1>Izmenite <small>ili izbrišite proizvod</small></h1>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 col-xs-12">
			<div id="response">
				<table class="table">
					<thead>
						<tr>
							<th>ID</th>
							<th>Proizvod</th>
							<th>Opis</th>
							<th>Cena</th>
							<th>Slika</th>
							<th>Administrator</th>
							<th>Izbrisi</th>
							<th>Izmeni</th>
						</tr>
					</thead>
					<tbody>
						<?php while ($line = $products->fetch_object()) {  ?>
							<tr>
								<td><?php echo $line->id; ?></td>
								<td><?php echo $line->product; ?></td>
								<td><?php echo $line->description; ?></td>
								<td><?php echo $line->price; ?></td>
								<td> <img src="<?php echo $line->image; ?>" alt="" height="50" width="50"> </td>
								<td>
									<?php
									$users_id = $line->users_id;
									$sql1 = "SELECT *
									FROM users WHERE id = '$users_id'";
									$user = $conn->query($sql1);
									$value = $user->fetch_object();
									echo $value->name;
									?>
								</td>
								<td><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQQe4oNuewJGxgkTo22pB9XThxTO6HEpqaL9frNZZpFhnI5HaiFAg&s" alt="Izbrisi" height="30" width="30" onclick="del(<?php echo $line->id; ?>)" style="cursor: pointer;"></td>
								<td><a href="editProduct.php?id=<?php echo $line->id; ?>"><img src="https://cdn3.iconfinder.com/data/icons/simplius-pack/512/pencil_and_paper-512.png" alt="Izmeni" height="30" width="30" style="cursor: pointer;"></a></li>

							</tr>
						<?php  } ?>
					</tbody>

				</table>
			</div>
		</div>

	</div>


	<?php
	include "footer.php"
	?>


	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>




	<script>
		function edit(id) {
			alert(id);
		}
	</script>
</body>

</html>