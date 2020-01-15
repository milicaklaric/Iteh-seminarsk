<?php
session_start();
if (isset($_SESSION['vesuser'])) {
	header("Location: index.php");
}
?>
<html>

<head>
	<?php include "connect.php"; ?>
	<title>Trgovački Centar</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="css.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

	<script type="text/javascript">
		function login() {
			var name = $('#name').val();
			var password = $('#password').val();

			$.post('scripts/scriptLogin.php', {
				name: name,
				password: password
			}, function(data) {
				$('#logiResponse').html(data);
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
				<h1>Prijava <small></small></h1>
			</div>
		</div>
	</div>
	</div>
	<div class="row">
		<div class="col-lg-3 col-xs-12"></div>
		<div class="col-lg-6 col-xs-12">
			<p>Unesite ime i šifru!</p>
			<div id="logiResponse"></div>
			<div class="input-group">
				<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></span>
				<input type="text" class="form-control" id="name" placeholder="Ime..." aria-describedby="basic-addon1">
			</div>
			<div class="input-group">
				<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span></span>
				<input type="password" class="form-control" id="password" placeholder="Šifra..." aria-describedby="basic-addon1">
			</div>
			<br>
			<button class="btn btn-primary" onclick="login();"><span class="glyphicon glyphicon-link" aria-hidden="true"></span> Login!</button>
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