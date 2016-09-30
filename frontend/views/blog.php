<!doctype html>
<html class="no-js" lang="es">
<head>
    <meta charset="utf-8">
    <title>Noticias</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- estilos a utilizar -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="../css/nav.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/font-awesomeq.css">
    <link rel="stylesheet" href="../css/animate.css">
    <link rel="stylesheet" href="../css/mainEdwin.css">
    <link href="../css/docs.css" rel="stylesheet" >
    <link href="../css/index.css" rel="stylesheet" >
    <link href="../css/index.css" rel="stylesheet" >
    <link href='https://fonts.googleapis.com/css?family=Ropa+Sans' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Advent+Pro' rel='stylesheet' type='text/css'>
    <link rel="shortcut icon" href="../img/logos/logosmall.ico">


</head>
<body>
    <!-- Barra de navegación -->
    <?php include 'nav.php'; ?>
    <?php require("../../backend/procesos/database.php");?>
 
 <div class="animated zoomIn">
 <br>
 <br>


    <!--Blog-->
    <div class="container vcenter">
      <div class="row">
        <div class="blogback col-md-offset-1 col-md-10">
          <div class="cabez">
        <h1 class="fuente text-center mayuscula"> &nbsp&nbsp&nbspBLOG - LA CARPINTERIA SV</h1>
        <img src="../img/logos/blancosmall.png" class="ubicacion">






<br>
        </div>
        
        <br>




         <?php

                        $sql = "SELECT id_blog, titulo, imagenBlog, estadoBlog, SUBSTRING(cuerpo, 1, 240) as Resumen FROM blogs where estadoBlog = 1 order by id_blog DESC";
                    $params = null;
                    
                    $data = Database::getRows($sql, $params);
                    if($data != null)
                    {
                      $products = "";
                      foreach ($data as $row) 
                      {
                        
                        $products .= "<img class='imgproducto img-responsive activador'  
                                                    src='data:image/*;base64,$row[imagenBlog]'>
                        <br><p class='espacio'>.</p>
                        <h4 class='text-center fuente mayuscula colorfuente '><a class='fuente'  href='prevblog.php?id=".base64_encode($row['id_blog'])."'>$row[titulo] </a></h4>
                        <br><p class='text-justify entrada fuente'>$row[Resumen]...</p><br>";
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
</div>
</div>
<br>

<!--Footer -->

                <?php include 'footer.php'; ?>

    
<!--fin del DOM-->
<script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="../js/vendor/jquery-1.11.2.min.js"><\/script>')</script>

<script src="../js/vendor/bootstrap.min.js"></script>

<script src="../js/nav.js"></script>
</body>
</html>
