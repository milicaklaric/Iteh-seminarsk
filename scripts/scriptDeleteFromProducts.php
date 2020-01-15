<?php 
	include "../connect.php";

	
	$id = $conn->real_escape_string($_POST['id']);

	$sql="DELETE FROM products WHERE id='$id';";
	$conn->query($sql);
	
	$sql="SELECT *
	FROM products";
    $q=$conn->query($sql);
		
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
                    <th>Izbrisi</th>
                    <th>Izmeni</th>
				</tr>
				</thead>
				<tbody>
					<?php while($red=$q->fetch_object()){  ?>
					<tr>
						<td><?php echo $red->id; ?></td>
						<td><?php echo $red->product; ?></td>
						<td><?php echo $red->description; ?></td>
                        <td><?php echo $red->price; ?></td>
                        <td> <img src="<?php echo $red->image; ?>" alt="" height="50" width="50"> </td>
                        <td><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQQe4oNuewJGxgkTo22pB9XThxTO6HEpqaL9frNZZpFhnI5HaiFAg&s" alt="Izbrisi"height="30" width="30" onclick="del(<?php echo $red->id; ?>)" style="cursor: pointer;"></td>
                        <td><img src="https://cdn3.iconfinder.com/data/icons/simplius-pack/512/pencil_and_paper-512.png" alt="Izmeni"height="30" width="30" onclick="edit(<?php echo $red->id; ?>)" style="cursor: pointer;"></td>
					</tr>
					<?php  } ?>
				</tbody>

			</table>

		<?php
	} else {
		
		echo '<div class="alert alert-danger">Doslo je do greske sa bazom! Ili pokušavate da izbrišete proizvod koji je neko dodao u</div>';
	}
	

 ?>