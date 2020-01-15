<?php 
	session_start();
	include "../connect.php";

	$sql2 = "SELECT *
	FROM products";
	$products = $conn->query($sql2);
	while ($red = $products->fetch_array()) {
		$svi_proizvodi[$red['id']] = $red;
	}

	
	$key = $conn->real_escape_string($_POST['key']);

	unset ($_SESSION["korpa"][$key]);


    ?><table class="table">
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
			if ( isset($_SESSION['korpa']) ) {
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
								<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQQe4oNuewJGxgkTo22pB9XThxTO6HEpqaL9frNZZpFhnI5HaiFAg&s" 
								alt="Izbrisi" height="30" width="30" 
								onclick="deleteProduct('<?php echo $key; ?> ', '<?php echo $key2; ?> ')" style="cursor: pointer;">
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

	<script>
		function deleteProduct(key) {
			$.post('scripts/scriptDeleteFromBasket.php', {
				key: key
			}, function(data) {
				$('#response').html(data);
			});
		}
		
		var value;
		$.get("api/getEUR/"+<?php if (isset($_SESSION['korpa'])) { echo $all; } ?>+"", function(data){

			value = JSON.parse(data);
			
			$('#bill').text( "Vaš račun je: "+ <?php if (isset($_SESSION['korpa'])) { echo $all; }?> +" RSD / "+ value +" EUR")
		
		});
			
		setTimeout(function() {
			//("#bill").text(getEur(50));
		}, 800);
	</script>
