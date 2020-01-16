<?php
session_start();
if (!isset($_SESSION['userId'])) {
	header("Location: login.php");
}
?>
<html>

<head>

	<title>Trgovački Centar</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="css.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>



	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>

	<script text="text/javascript">
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
	<br>
	<h3> <b>Neobrađene porudžbine:</b></h3>
	<div id="processedOrders" class="pt-5">
		<table id="processed" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th class="th-sm">Br. </th>
					<th class="th-sm">Ime </th>
					<th class="th-sm">Prezime </th>
					<th class="th-sm">Proizvod </th>
					<th class="th-sm">Količina </th>
					<th class="th-sm">Cena </th>
					<th class="th-sm">Ukupno </th>
					<th class="th-sm">Adresa </th>
					<th class="th-sm">Odgovor </th>
				</tr>
			</thead>
			<tbody>
			</tbody>
			<tfoot>
				<tr>
					<th class="th-sm">Br. </th>
					<th class="th-sm">Ime </th>
					<th class="th-sm">Prezime </th>
					<th class="th-sm">Proizvod </th>
					<th class="th-sm">Količina </th>
					<th class="th-sm">Cena </th>
					<th class="th-sm">Ukupno </th>
					<th class="th-sm">Adresa </th>
					<th class="th-sm">Odgovor </th>
				</tr>
			</tfoot>
		</table>
	</div>
	<hr>
	<br>
	<h3> <b>Obrađene porudžbine:</b></h3>
	<div id="notProcessedOrders" class="pt-5">
		<table id="notProcessed" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th class="th-sm">Br. </th>
					<th class="th-sm">Ime </th>
					<th class="th-sm">Prezime </th>
					<th class="th-sm">Proizvod </th>
					<th class="th-sm">Količina </th>
					<th class="th-sm">Cena </th>
					<th class="th-sm">Ukupno </th>
					<th class="th-sm">Adresa </th>
				</tr>
			</thead>
			<tbody>
			</tbody>
			<tfoot>
				<tr>
					<th class="th-sm">Br. </th>
					<th class="th-sm">Ime </th>
					<th class="th-sm">Prezime </th>
					<th class="th-sm">Proizvod </th>
					<th class="th-sm">Količina </th>
					<th class="th-sm">Cena </th>
					<th class="th-sm">Ukupno </th>
					<th class="th-sm">Adresa </th>
				</tr>
			</tfoot>
		</table>
	</div>


	<?php
	include "footer.php"
	?>
	</div>


	<script>
		var processed;
		// get list of orders and user data
		$.post("controller.php", {
				processedList : "getOrderList"
			})
			.done(function(data) {
				processed = JSON.parse(data);
			});

		setTimeout(function() {

			for (value in processed) {

				var table = $('#processed').DataTable();

				table.row.add([
					processed[value].order_id,
					processed[value].name,
					processed[value].surname,
					processed[value].product,
					processed[value].quantity,
					processed[value].price,
					processed[value].price * processed[value].quantity,
					processed[value].address,
					processed[value].id
				]).draw(false);

			}

		}, 300);

		var notProcessed;
		// get list of orders and user data
		$.post("controller.php", {
				notProcessedList: "getOrderList"
			})
			.done(function(data) {
				notProcessed = JSON.parse(data);
			});

		setTimeout(function() {

			for (value in notProcessed) {

				var table = $('#notProcessed').DataTable();

				table.row.add([
					notProcessed[value].order_id,
					notProcessed[value].name,
					notProcessed[value].surname,
					notProcessed[value].product,
					notProcessed[value].quantity,
					notProcessed[value].price,
					notProcessed[value].price * notProcessed[value].quantity,
					notProcessed[value].address,
				]).draw(false);

			}

		}, 300);


		$(document).ready(function() {
			$('#processed').DataTable({

				columnDefs: [{
					targets: 8,
					render: function(data, type, row, meta) {
						if (type === 'display') {
							data = '<a href="scripts/scriptAcceptOrder.php?id=' + encodeURIComponent(data) + '">Prihvati Porudžbinu</a>';
						}
						return data;
					}
				}],

			});

			$('#notProcessed').DataTable({
			});

		});
	</script>

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>

</html>