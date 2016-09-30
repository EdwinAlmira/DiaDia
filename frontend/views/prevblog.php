<?php
  require("../../backend/procesos/database.php");
  include 'nav.php';
  $id = base64_decode($_GET['id']);
  $sql = "SELECT * from blogs where id_blog = ?";
  $params = array($id);
  $data = Database::getRows($sql, $params);

if(!empty($_POST))
{
    $ti = $_POST['titulo'];
    $com = $_POST['cuerpo'];
    $id_cli = $_SESSION['Id_cliente'];

    $todayh = getdate();
    $d = $todayh['mday'];
    $m = $todayh['mon'];
    $y = $todayh['year'];
    $fecha = $d . "/" . $m . "/" .$y;
    //Agregar aqui parametros nuevos

}
?>
<!doctype html>
<html class="no-js" lang="es">
<head>
    <meta charset="utf-8">
    <title>Blog</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- estilos a utilizar -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.2.0/jquery.rateyo.min.css">
<!-- Latest compiled and minified JavaScript -->
    <link rel="shortcut icon" href="../img/logos/logosmall.ico">
    <link rel="stylesheet" href="../css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="../css/nav.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/animate.css">
    <link rel="stylesheet" href="../css/mainEdwin.css">
    <link href="../css/index.css" rel="stylesheet" >
    <link href='https://fonts.googleapis.com/css?family=Ropa+Sans' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Advent+Pro' rel='stylesheet' type='text/css'>

</head>
<body>
    <!-- Barra de navegación -->
    <?php  ?>
 <div class="animated zoomIn">
 <br>
 <br>


    <!--Blog-->
    <div class="container vcenter">
      <div class="row">
        <div class="blogback col-md-offset-1 col-md-10">
          <div class="cabez"><br>
        <?php
          foreach ($data as $key) {
            if($id == null)
              {
                echo '<p class="text-center">No se encontro el producto deseado</p>';
              }else
              {


                

                echo '<h1 class="text-center fuente mayuscula">&nbsp&nbsp'.$key['titulo'].'</h1><br>
            <img src="../img/logos/blancosmall.png" class="ubicacion3">';
              }
          }
        ?>
       

<br>
        </div>
        
        <br>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane fade in active " id="Noticias">
        <?php
          $s = "SELECT imagenBlog from blogs where Id_blog = ?";
          $params = array($id);
          $dat = Database::getRows($s, $params);
          foreach ($dat as $key) {

            echo '<img id="Imagenco" src="data:image/*;base64,'.$key['imagenBlog'].'" class="col-xs-12 col-md-12 col-lg-12 ">';
          }

          foreach ($data as $key) {
            echo '
               
                <br><p class="espacio">.</p>
                <br><p class="text-left fuente col-lg-offset-1 col-lg-10">'.$key['cuerpo'].'</p><br>
            ';
          }
        ?>


    </div>
   
  </div>


</div>

 
       
</div>
</div>
</div>
</div></div></div></div>
<br>

<!--Footer -->

                <?php include 'footer.php'; ?>

    
<!--fin del DOM-->
<script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.2.0/jquery.rateyo.min.js"></script>
<script type="text/javascript">
  $(function () {
 
  var $rateYo = $("#rateYo").rateYo();
 
  $("#getRating").click(function () {
 
    /* get rating */
    var rating = $rateYo.rateYo("rating");
    document.getElementById("val").value = rating;
  });
 
  $("#setRating").click(function () {
 
    /* set rating */
    var rating = getRandomRating();
    $rateYo.rateYo("rating", rating);
  });
});

</script>
<script>window.jQuery || document.write('<script src="../js/vendor/jquery-1.11.2.min.js"><\/script>')</script>

<script src="../js/vendor/bootstrap.min.js"></script>

<script src="../js/nav.js"></script>
</body>
</html>
