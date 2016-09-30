  <!DOCTYPE html>
  <html lang="en">
  <head>
  	<meta charset="UTF-8">
  	<title>Quiénes somos</title>
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/register.css">
  <link rel="stylesheet" href="../css/font-awesomeq.css">
    <link href="../css/bootstrap-social.css" rel="stylesheet">
    <link href="../css/docs.css" rel="stylesheet" >
    <link href="../css/main.css" rel="stylesheet" >
    <link href="../css/nav.css" rel="stylesheet" >
    <link href="../css/animate.css" rel="stylesheet" >
    <link href="../css/index.css" rel="stylesheet" >
    <link href='https://fonts.googleapis.com/css?family=Ropa+Sans' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Advent+Pro' rel='stylesheet' type='text/css'>
    <link rel="shortcut icon" href="../img/logos/logosmall.ico">
 
  </head>

  <body>


  <!--Barra de navegación-->
  <?php include 'nav.php'; ?>

  <!--Cuerpo de Login -->
   <div class="animated zoomIn">
   <br>
   <br>
  <section class="inicio seccion">
    <div class="container-fluid">

      <div class="col-lg-12">
          <div class="col-sm-12 col-lg-12">
          <hr>
          <h1 class="fuente mayuscula text-center" >¿Quiénes somos?</h1>
          <hr>
          <br>
          <br>
          <br>
          </div>
            <?php

         include("../../backend/procesos/database.php");

$sql = "SELECT * FROM empresa";
            $params = null;
            
            $data = Database::getRows($sql, $params);
            if($data != null)
            {
              $products = "";
              foreach ($data as $row) 
              {
                
                $products .= "
                <img class='col-xs-12 col-sm-4 col-md-12  col-lg-6 bordess' src='../img/QUIENES/mi.png' alt='Mision'>
            
                
              <div class='col-xs-12 col-sm-4 col-md-12 col-lg-6'>
              

              <h2 class='center fuente mayuscula'>MISIÓN</h2>
              <br>
                <p class='text2 text-justify fuente img-thumbnail'>$row[Mision]</p>
              </div>
              </div>
                
             
                
      </div>
  
                <br> <br>
                <br> <br>
                
 <div class='container-fluid'>

      <div class='col-lg-12'>
            
                <img class='col-xs-12 col-sm-4 col-md-12  col-lg-6 bordess' src='../img/QUIENES/vi.png' alt='Mision'>
                
              <div class='col-xs-12 col-sm-4 col-md-12 col-lg-6'>
              

              <h2 class='center fuente mayuscula'>VISIÓN</h2>
              <br>
                <p class='text2 text-justify fuente img-thumbnail'>$row[Vision]</p>
              </div>
              </div>
                
                <br>
                <br>
                

      </div>

<br> <br>
                <br> <br>
                

 ";
                }
                print($products);
              }
              else
              {
                print("<div class='col-xs-6 col-sm-4 col-md-3  text-center box'><i class='material-icons left'></i>No hay mision , vision ni valores disponibles en este momento.</div>");
              }
            ?>




<div class='container-fluid'>

      <div class='col-lg-12'>
            
                <img class='col-xs-12 col-sm-4 col-md-12  col-lg-6 bordess' src='../img/QUIENES/valores.jpg' alt='Mision'>
                
              <div class='col-xs-12 col-sm-4 col-md-12 col-lg-6'>
              

              <h2 class='center fuente mayuscula'>VALORES</h2>
              <br>
                <p class='text2 text-justify fuente img-thumbnail'>

                Proveer a nuestros clientes de equipo mobiliario y accesorios decorativos   innovadores, que contribuyan a crear ambientes únicos, fabricando productos con altos estándares de calidad, diseñados a partir de productos sustentables.
                 <br>
               
<?php

        

$sql = "SELECT * FROM valores";
            $params = null;
            
            $data = Database::getRows($sql, $params);
            if($data != null)
            {
              $products = "";
              foreach ($data as $row) 
              {
                
                $products .= "<li><p class='text2 text-justify fuente img-thumbnail'><span class='mayuscula fuentecolor'>$row[titulo_valor]</span> <span class='negro'>$row[descripcion]</span></p></li>
                


              
 ";
                }
                print($products);
              }
              else
              {
                print("<div class='col-xs-6 col-sm-4 col-md-3  text-center box'><i class='material-icons left'></i>No hay mision , vision ni valores disponibles en este momento.</div>");
              }
            ?>


</p>

                


              </div>
              </div>
                
                
                

      </div>
      <br>
      <br>
      <br>




     


  </section><br>
 

    <?php include 'footer.php'; ?>

<script src="../js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<script src="../js/vendor/jquery-1.11.2.min.js"></script>
<script src="../js/vendor/bootstrap.min.js"></script>
<script src="../js/nav.js"></script>
  </body>
  </html>