<?php
session_start();
include "../connect.php";


$value = $conn->real_escape_string($_POST['product']);

if (empty($value)) {
	$sql = "SELECT * FROM products";
} else {
	$sql = "SELECT * FROM products WHERE product LIKE '%$value%'";
}

if ($q = $conn->query($sql)) {
?>
	<table class="table">
		<thead>
			<tr>
				<th>ID</th>
				<th>Proizvod</th>
				<th>Opis</th>
				<th>Cena</th>
				<th>Slika</th>
				<?php if (isset($_SESSION['userName']) && $_SESSION['userAdmin'] == 0) { ?>
					<th>Količina</th>
					<th>Kupovina</th>
				<?php } ?>

			</tr>
		</thead>
		<tbody>
			<?php while ($line = $q->fetch_object()) {  ?>
				<tr>
					<td><?php echo $line->id; ?></td>
					<td><?php echo $line->product; ?></td>
					<td><?php echo $line->description; ?></td>
					<td><?php echo $line->price; ?></td>
					<td> <img src="<?php echo $line->image; ?>" alt="" height="50" width="50"> </td>
					<?php if (isset($_SESSION['userName']) && $_SESSION['userAdmin'] == 0) { ?>
						<form method="POST" action="index.php" id="usrform">
							<th><input type="text" size="2" name="orderNum"></th>
							<input type="hidden" size="2" name="productId" value="<?php echo $line->id; ?>">
							<th><button type="submit" name="submit" class="btn btn-success">Dodaj u korpu</button></th>
						</form>

					<?php } ?>
				</tr>
			<?php  } ?>
		</tbody>

	</table>

<?php
} else {
	echo '<div class="alert alert-danger">Doslo je do greske sa bazom!</div>';
}


?>