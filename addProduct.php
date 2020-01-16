<?php 
	session_start();
	if (!isset($_SESSION['userName']) || $_SESSION['userAdmin']!=1){
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

	if (isset($_POST['submit'])) {
		if(empty($_POST['product'])||empty($_POST['description'])||empty($_POST['price'])||empty($_POST['image'])) {
			$msg = '<div class="alert alert-danger">Sva polja su obavezna!</div>';
		} else {
			$product= $conn->real_escape_string($_POST['product']);
			$description=$conn->real_escape_string($_POST['description']);
			$price=trim($_POST['price']);
			$image=$conn->real_escape_string($_POST['image']);
			$userId=$_SESSION['userId'];


				$sql="INSERT INTO products (users_id, product, description, price, image) VALUES 
					('".$userId."', '".$product."', '".$description."', '".$price."', '".$image."')";
				if($conn->query($sql)){
					$msg = '<div class="alert alert-success">Proizvod je uspesno ubacen!</div>';
				} else {
					$msg = '<div class="alert alert-danger">Greska sa bazom!</div>';
				}

		}
	}

	 ?>

	 <script type="text/javascript">
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
			  <h1>Dodajte <small>nov proizvod za prodaju</small></h1>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-3 col-xs-12"></div>
		<div class="col-lg-6 col-xs-12">
			<p>Ukoliko želite da Vaš proizvod bude konkurent sa ostalim, popunite sva polja.</p>
			<?php if(!empty($msg))echo $msg; ?>

			<form method="POST" action="addProduct.php" id="usrform">
				<div class="form-group">
					<label for="exampleInputPassword1">Ime proizvoda:</label>
			    	<input type="text" class="form-control" name="product" placeholder="Proizvod...">
			  	</div>
			  	<div class="form-group">
			    	<label for="exampleInputPassword1">Opis:</label>
					<textarea rows="4" cols="50" class="form-control" name="description" form="usrform" placeholder="Opis..."></textarea>
				</div>
				<div class="form-group">
			    	<label for="exampleInputPassword1">Cena:</label>
			    	<input type="text" class="form-control" name="price" placeholder="Cena...">
				</div>
				<div class="form-group">
			    	<label for="exampleInputPassword1">Slika<small>(Unesite link na kome se nalazi Vaša slika)</small>:</label>
			    	<input type="text" class="form-control" name="image" placeholder="image...">
			  	</div>
			  <button type="submit" name="submit" class="btn btn-primary">Dodaj</button>
		  </form>

		</div>
		<div class="col-lg-3 col-xs-12"></div>

	</div>

	<?php
		include "footer.php"
	?>

</div>



	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>