<?php 
	include "connect.php";

	
	$value = $conn->real_escape_string($_POST['product']);

	if (empty($value)){
		$sql="SELECT * FROM products";
	} else {
		$sql="SELECT * FROM products WHERE product LIKE '%$value%'";
	}
		
	if($q=$conn->query($sql)) {
		?>
		<table class="table">
		<thead>
				<tr>
					<th>ID</th>
					<th>Proizvod</th>
					<th>Opis</th>
                    <th>Cena</th>
                    <th>Slika</th>
                    <th>Kupovina</th>
                           
				</tr>
			</thead>
			<tbody>
				<?php while($red=$q->fetch_object()){  ?>
				<tr>
					<td><?php echo $red->id; ?></td>
					<td><?php echo $red->product; ?></td>
					<td><?php echo $red->discription; ?></td>
                    <td><?php echo $red->price; ?></td>
                    <td> <img src="<?php echo $red->image; ?>" alt="meda..." height="50" width="50"> </td>
                    <td><a href="#">Dodaj u korpu</a></td>
				</tr>
				<?php  } ?>
			</tbody>

		</table>

		<?php
	} else {
		echo '<div class="alert alert-danger">Doslo je do greske sa bazom!</div>';
	}
	

 ?>