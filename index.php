<?php
session_start();
if (!isset($_SESSION['userId'])) {
	header("Location: login.php");
}
?>
<html>

<head>
	<?php include "connect.php"; ?>
	<title>Trgovački Centar</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="css.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

	<?php
	$sql = "SELECT *
	FROM products";
	$q = $conn->query($sql);

	?>
	<script type="text/javascript">
		function search() {

			var product = $('#product').val();

			$.post('scripts/scriptSearch.php', {
				product: product
			}, function(data) {
				$('#response').html(data);
			});
		}

		function getIpAdress(){
			$.get( "http://ip.jsontest.com/", function( data ) {
				$('#ip').text("Tvoja ip adresa:"+data.ip);
			});
		}

		<?php
        if (isset($_POST['submit'])) {
			
			if(empty($_POST['orderNum'])) {
				$msg = '<div class="alert alert-danger">Polje Količina je obavezno!</div>';
			} else if(!is_numeric($_POST['orderNum'])){
				$msg = '<div class="alert alert-danger">Kolicina mora biti broj!</div>';
			} else {
				$productId=trim($_POST['productId']);
				$orderNum=trim($_POST['orderNum']);
	
				
			
				$_SESSION['korpa'][] = [$productId=>$orderNum];
				
			}
		}
		
		?>
	</script>
</head>

<body>

	<?php
	include "nav.php";
	?>
	<div class="row">
		<div class="col-lg-12 col-xs-12">
			<div class="page-header">
				<h1>Pronadjite <small>Vaš omiljeni proizvod</small></h1>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-8 col-xs-12">
			<div id="response">
			<?php if(!empty($msg))echo $msg; ?>			
				<table class="table">
					<thead>
						<tr>
							<th>ID</th>
							<th>Proizvod</th>
							<th>Opis</th>
							<th>Cena</th>
							<th>Slika</th>
							<?php if (isset($_SESSION['userName']) && $_SESSION['userAdmin'] == 0){ ?>
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
								<?php if (isset($_SESSION['userName']) && $_SESSION['userAdmin'] == 0){ ?>
									<form method="POST" action="index.php" id="usrform">
										<th><input type="text" size="2" name="orderNum"></th>
										<input type="hidden" size="2" name="productId" value = "<?php echo $line->id; ?>">
										<th><button type="submit" name="submit" class="btn btn-success">Dodaj u korpu</button></th>
									</form>

								<?php } ?>
							</tr>
						<?php  } ?>
					</tbody>

				</table>
			</div>
		</div>
		<div class="col-lg-3 col-xs-12">
			<p>Unesite naziv proizvoda....</p>
			<div class="form-group">
				<label for="exampleInputPassword1">Proizvod</label>
				<input type="text" class="form-control" id="product" placeholder="Proizvod...">
			</div>

			<button onclick="search();" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Pretrazi</button>
		</div>

	</div>
	<?php
	include "footer.php"
	?>

	</div>



	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>

</html>