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
        $sql = "SELECT EXTRACT(DAY FROM time_ordered) AS oday , bill FROM orders where status = 1";
        $q = $conn->query($sql);

        $array = array();

        while ($line = $q->fetch_object()) {

            $bool = false;

            for ($count = 0; $count < count($array); $count++) {
                if ($array[$count]->oday == $line->oday){
                    $array[$count]->bill += $line->bill;
                    $bool = true;
                }
            }
            
            if ($bool) {
               // Do nothing
            } else {
                $array [] = $line;
            }
        }

    ?>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['bar']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Day', 'Amount'],
                <?php for ($count = 0; $count < count($array); $count++) {  ?>
                    ['<?php echo $array[$count]->oday; ?>', <?php echo $array[$count]->bill; ?>],
                <?php  } ?>
            ]);

            var options = {
                chart: {
                    title: 'Prikaz grafika po danima',
                    subtitle: 'Mesec januar 2020',
                }
            };

            var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

            chart.draw(data, google.charts.Bar.convertOptions(options));
        }

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
                <h1>Grafikon <small>Prokaz prodaje u mesecu</small></h1>
            </div>
        </div>
    </div>

    <div id="columnchart_material" style="width: 100%; height: 50%;"></div>

    <?php
    include "footer.php"
    ?>

    </div>



    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>

</html>