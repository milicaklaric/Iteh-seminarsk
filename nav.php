<nav class="navbar navbar-default">

  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">Trgovački Centar</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <?php if (isset($_SESSION['userName']) && $_SESSION['userAdmin'] == 0) {  ?>
          <li><a href="index.php">Pretraga <span class="sr-only">(current)</span></a></li>
          <li><a href="basket.php">Moja korpa</a></li>
        <?php  } ?>
        <?php if (isset($_SESSION['userName']) && $_SESSION['userAdmin'] == 1) {  ?>
          <li><a href="index.php">Pretraga <span class="sr-only">(current)</span></a></li>
          <li><a href="addProduct.php">Dodaj proizvod</a></li>
          <li><a href="change.php">Izmeni proizvod</a></li>
          <li><a href="orders.php">Porudžbine</a></li>
          <li><a href="chart.php">Grafikon</a></li>
        <?php  } ?>
      </ul>

      <ul class="nav navbar-nav navbar-right">
      <?php if (isset($_SESSION['userName']) && $_SESSION['userAdmin'] == 1) { ?>
        <script>
          getIpAdress();
        </script>
        <li><a id="ip" class="text-right"></a></li>
    <?php }?>
        
        <?php if (!isset($_SESSION['userName'])) { ?>
          <li><a href="login.php">Prijava</a></li>
          <li><a href="register.php">Registracija</a></li>
        <?php } else { ?>
          <li><a href="logout.php">Logout</a></li>
        <?php } ?>
      </ul>


    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<div class="container-fluid">