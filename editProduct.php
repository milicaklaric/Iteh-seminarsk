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

		
		if (isset($_GET['id'])) {

			$id = $_GET['id'];

			$sql="SELECT *
			FROM products WHERE id = '$id'";
			$q=$conn->query($sql);

			$value = $q->fetch_object();

		}

		if (isset($_POST['submit'])) {
			if(empty($_POST['product'])||empty($_POST['description'])||empty($_POST['price'])||empty($_POST['image'])) {
				$msg = '<div class="alert alert-danger">Sva polja su obavezna!</div>';
			} else {
				$product=trim($_POST['product']);
				$description=$_POST['description'];
				$price=trim($_POST['price']);
				$image=trim($_POST['image']);
				$id=$_GET['id'];


					$sql="UPDATE products
					SET product = '$product', description = '$description', price = '$price', image = '$image'
					WHERE id = '$id'";
					if($conn->query($sql)){
						$msg = '<div class="alert alert-success">Proizvod je uspesno ubacen!</div>';
					} else {
						$msg = '<div class="alert alert-danger">Greska sa bazom!</div>';
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
			<div class="page-header">
			  <h1>Dodaj <small>Dodajte nov proizvod za prodaju</small></h1>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-3 col-xs-12"></div>
		<div class="col-lg-6 col-xs-12">
			<p>Ovde možete izmeniti sva polja.</p>
			<?php if(!empty($msg))echo $msg; ?>

			<form method="POST" action="editProduct.php?id=<?php echo $_GET['id']; ?>" id="usrform">
				<div class="form-group">
					<label for="exampleInputPassword1">Ime proizvoda:</label>
			    	<input type="text" class="form-control" name="product" value="<?php echo ($value->product) ?>">
			  	</div>
			  	<div class="form-group">
			    	<label for="exampleInputPassword1">Opis:</label>
					<textarea rows="4" cols="50" class="form-control" name="description" form="usrform" ><?php echo ($value->description) ?></textarea>
				</div>
				<div class="form-group">
			    	<label for="exampleInputPassword1">Cena:</label>
			    	<input type="text" class="form-control" name="price" value="<?php echo ($value->price) ?>">
				</div>
				<div class="form-group">
			    	<label for="exampleInputPassword1">Slika<small>(Unesite link na kome se nalazi Vaša slika)</small>:</label>
			    	<input type="text" class="form-control" name="image" value="<?php echo ($value->image) ?>">
			  	</div>
			  <button type="submit" name="submit" class="btn btn-primary">Izmeni</button>
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