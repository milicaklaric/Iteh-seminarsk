<?php
session_start();
if (!isset($_SESSION['userId'])) {
	header("Location: login.php");
}
// session_destroy();

?>
<html>

<head>
	<?php require "connect.php"; ?>
	<title>Trgovački Centar</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="css.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

	<?php

	$userId = $_SESSION['userId'];
	$sql1 = "SELECT *
	FROM orders WHERE user_id=$userId";
	$orders = $conn->query($sql1);

	$sql2 = "SELECT *
	FROM products";
	$products = $conn->query($sql2);
	while ($red = $products->fetch_array()) {
		$svi_proizvodi[$red['id']] = $red;
	}

	if (isset($_POST['address']) || isset($_POST['bill'])) {
        $address = $_POST['address'];
        $bill = $_POST['bill'];

		if (empty($_SESSION['korpa'])) {
			// do nothing
		} else {
            $userId = $_SESSION['userId'];
			$sql2 = "INSERT INTO orders (user_id, time_ordered, address, bill) VALUES ('$userId', NOW(), '$address', $bill)";

            if ($conn->query($sql2)) {
                $order_id = $conn->insert_id;

				foreach ($_SESSION['korpa'] as $key => $value) {

					foreach ($value as $key2 => $value2) {
						$sql2 = "INSERT INTO order_list (order_id, product_id, quantity) VALUES ('$order_id', '$key2','$value2')";
						$q2 = $conn->query($sql2);
					}
				}
				unset ($_SESSION["korpa"]);
    
				$msg = "<div class='alert alert-success'>Uspešno poslata porudžbina!</div>";
				
			} else {
                $msg = "<div class='alert alert-danger'>Vaša porudžbina nije poslata!</div>";
            }
            
        }
        
	}
	?>

</head>

<body>

	<?php
	include "nav.php";
	?>
	<div class="row">
		<div class="col-lg-12 col-xs-12">
			<div class="page-header row">
				<div class="col-lg-6">
					<h1>Korpa <small>Naručite proizvode</small></h1>
				</div>
				<div class="col-lg-6 ">
					<button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#myModal">Poruči</button>
				</div>


			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 col-xs-12">
			<div id="response">
				<?php if (!empty($msg)) echo $msg; ?>
				<table class="table">
					<thead>
						<tr>
							<th>Broj</th>
							<th>Proizvod</th>
							<th>Opis</th>
							<th>Cena</th>
							<th>Kolicina</th>
							<th>Zbir</th>
							<th>Slika</th>
							<th>Izbriši</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$all = 0;
						if (isset($_SESSION['korpa'])) {
							foreach ($_SESSION['korpa'] as $key => $value) {
								foreach ($value as $key2 => $value2) {
									$all += $value2 * $svi_proizvodi[$key2]['price']; ?>
									<tr>
										<td>
											<?php echo $svi_proizvodi[$key2]['id']; ?>
										</td>
										<td>
											<?php echo $svi_proizvodi[$key2]['product']; ?>
										</td>
										<td>
											<?php echo $svi_proizvodi[$key2]['description']; ?>
										</td>
										<td>
											<?php echo $svi_proizvodi[$key2]['price']; ?>
										</td>
										<td>
											<?php echo $value2; ?>
										</td>
										<td>
											<?php echo $value2 * $svi_proizvodi[$key2]['price']; ?>
										</td>
										<td>
											<img src="<?php echo $svi_proizvodi[$key2]['image']; ?>" width="50px" alt="">
										</td>
										<td>
											<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQQe4oNuewJGxgkTo22pB9XThxTO6HEpqaL9frNZZpFhnI5HaiFAg&s" alt="Izbrisi" height="30" width="30" onclick="deleteProduct(<?php echo $key; ?>)" style="cursor: pointer;">
										</td>
									</tr>
						<?php
								}
							}
						}
						?>
					</tbody>

				</table>
				<h4 id="bill"></h4>
			</div>
		</div>

		<div id="myModal" class="modal fade" role="dialog">
			<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Dodaj adresu</h4>
					</div>
					<div class="modal-body">
						<form action="basket.php" method="POST">
							<label for="address">Adresa:</label>
							<input type="text" name="address" id="address" required>
							<input type="hidden" name="bill" value="<?php echo $all; ?>">
							<br>
							<label>Vaš račun je: <?php echo $all . " RSD"; ?></label>
							<br>
							<input type="submit" class="btn btn-success" value="Poruči">
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>

			</div>
		</div>
	</div>

	<?php
	include "footer.php"
	?>

	<script>
		function deleteProduct(key) {
			$.post('scripts/scriptDeleteFromBasket.php', {
				key: key
			}, function(data) {
				$('#response').html(data);
			});
		}
		
		var value;
		$.get("api/getEUR/"+<?php if (isset($_SESSION['korpa'])) { echo $all; } else {echo 0;} ?>+"", function(data){

			value = JSON.parse(data);
			
			$('#bill').text( "Vaš račun je: "+ <?php if (isset($_SESSION['korpa'])) { echo $all; } else {echo 0;}?> +" RSD / "+ value +" EUR")
		
		});
			
		setTimeout(function() {
			//("#bill").text(getEur(50));
		}, 800);
	</script>

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>

</html>