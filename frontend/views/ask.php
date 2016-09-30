<!doctype html>
	<html class="no-js" lang="es">
    <head>
        <meta charset="utf-8">
        <title>Preguntas de Usuarios</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="../css/ask.css">
        <link rel="stylesheet" href="../css/nav.css">
        <link rel="stylesheet" href="../css/animate.css">
        <link rel="stylesheet" href="../css/main.css">
        <link rel="stylesheet" href="../css/demo.css">
        <link rel="stylesheet" href="../css/font-awesomeq.css">
        <link href="../css/docs.css" rel="stylesheet" >
        <link href="../css/index.css" rel="stylesheet" >
        <link href="../css/index.css" rel="stylesheet" >
        <link href='https://fonts.googleapis.com/css?family=Ropa+Sans' rel='stylesheet' type='text/css'>
        <link rel="shortcut icon" href="../img/logos/logosmall.ico">

  <link href='https://fonts.googleapis.com/css?family=Advent+Pro' rel='stylesheet' type='text/css'>


        <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
    </head>
    <body>
       <?php include 'nav.php'; ?>
<br><br><br>
        <!--Preguntas Frecuentes-->
         <div class="animated fadeIn ">
        <div class="container vcenter">
          <div class="row">
            <div class="col-lg-12 blogback center-block">
              <div class="cabez"><br>
                <h1 class="text-center fuente mayuscula text-center">Preguntas Frecuentes</h1><br>
                <img src="../img/logos/blancosmall.png" class="ubicacion-preguntas">

              </div>
              <br>              
                
                <?php

                    include("../../backend/procesos/database.php");
                        $sql = "SELECT * FROM preguntas";
                    $params = null;
                    
                    $data = Database::getRows($sql, $params);
                    if($data != null)
                    {
                      $products = "";
                      foreach ($data as $row) 
                      {
                        
                        $products .= "<li><p class='text2 text-center fuente img-thumbnail'><span class='mayuscula fuentecolor tamaño'>$row[titulo]</span> <br><span class='negro tamaña'>$row[descripcion]</span></p></li>";
                        }
                        print($products);
                      }
                      else
                      {
                        print("<div class='col-xs-6 col-sm-4 col-md-3  text-center box'><i class='material-icons left'></i>No hay preguntas disponibles.</div>");
                      }
            ?>
        </div>
         </div>
    </div><br><br>
        <!--Footer-->
        <?php include 'footer.php'; ?>
    <script src="../js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<script src="../js/vendor/jquery-1.11.2.min.js"></script>
<script src="../js/vendor/bootstrap.min.js"></script>
<script src="../js/nav.js"></script>
    </body>
</html>