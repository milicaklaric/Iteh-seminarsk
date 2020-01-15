<?php
session_start();
if (isset($_SESSION['userId'])) {
	header("Location: index.php");
}
?>
<html>

<head>
	<title>Trgovački Centar</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="css.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

	<script type="text/javascript">
		function registration() {
			var name = $('#nameReg').val();
			var surname = $('#surname').val();
			var mail = $('#mail').val();
			var phone = $('#phone').val();
			var password = $('#passwordReg').val();

			var obj = new Object();
			obj.name= name;
			obj.surname= surname;
			obj.mail= mail;
			obj.phone= phone;
			obj.password= password;
			var jsonstring = JSON.stringify(obj);

			$.post("api/registerUser", jsonstring, function (data) {
				$('#regResponse').html(data);
				console.log(data);
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
				<h1>Registracija <small></small></h1>
			</div>
		</div>
	</div>
	</div>
	<div class="row">
		<div class="col-lg-3 col-xs-12"></div>
		<div class="col-lg-6 col-xs-12">
			<p>Unesite sve podtake!</p>
			<div id="regResponse"></div>
			<div class="input-group">
				<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></span>
				<input type="text" class="form-control" id="nameReg" placeholder="Ime..." aria-describedby="basic-addon1">
			</div>
			<div class="input-group">
				<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></span>
				<input type="text" class="form-control" id="surname" placeholder="Prezime..." aria-describedby="basic-addon1">
			</div>
			<div class="input-group">
				<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></span>
				<input type="password" class="form-control" id="passwordReg" placeholder="Šifra..." aria-describedby="basic-addon1">
			</div>
			<div class="input-group">
				<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span></span>
				<input type="text" class="form-control" id="mail" placeholder="E-mail..." aria-describedby="basic-addon1">
			</div>
			<div class="input-group">
				<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span></span>
				<input type="text" class="form-control" id="phone" placeholder="Telefon..." aria-describedby="basic-addon1">
			</div>
			<br>
			<button class="btn btn-primary" onclick="registration();"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Registruj se!</button>
		</div>
		<div class="col-lg-3 col-xs-12"></div>

	</div>
	<?php
	include "footer.php"
	?>


	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>

</html>