<?php
  require("../../backend/procesos/database.php");
  include 'nav.php';
  $id = base64_decode($_GET['id']);
  $sql = "SELECT * from productos where Id_producto = ?";
  $params = array($id);
  $data = Database::getRows($sql, $params);

if(!empty($_POST))
{
    $ti = $_POST['titulo'];
    $com = $_POST['comen'];
    $id_cli = $_SESSION['Id_cliente'];

    $todayh = getdate();
    $d = $todayh['mday'];
    $m = $todayh['mon'];
    $y = $todayh['year'];
    $fecha = $d . "/" . $m . "/" .$y;
    //Agregar aqui parametros nuevos
    try 
    {
        $sql = "INSERT INTO comentariospro (id_cliente , id_pro , titulo , comentario , fecha) VALUES (? , ? , ? , ? , ?)"; 
        $params = array($id_cli , $id , $ti , $com , $fecha);
        Database::executeRow($sql, $params);
        ob_end_clean();
        header("location: prev.php?id=".base64_encode($id)."");
    }
    catch (Exception $error)
    {
        print("<div class='container-fluid titulo'> <h3> ERROR </h3> </div>".$error->getMessage()."</div>"); // EN CASO DE ERROR SE MOSTRARA ESTE MENSAJE
    }
}
?>
<!doctype html>
<html class="no-js" lang="es">
<head>
    <meta charset="utf-8">
    <title>Detalles del producto</title>
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


                

                echo '<h1 class="text-center fuente mayuscula">&nbsp&nbsp'.$key['nombreProdu'].'</h1><br>
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
          $s = "SELECT imagen from productos where Id_producto = ?";
          $params = array($id);
          $dat = Database::getRows($s, $params);
          foreach ($dat as $key) {
            echo '<img id="Imagenco" src="data:image/*;base64,'.$key['imagen'].'" class="col-xs-12 col-md-12 col-lg-12 ">';
          }

          foreach ($data as $key) {
            echo '
               
                <br><p class="espacio">.</p>
                <h3 class="fuente mayuscula fuentecolor ">&nbsp&nbspDESCRIPCION DEL PRODUCTO:</h3>

                <br><p class="text-left fuente mayuscula">&nbsp&nbsp&nbsp&nbsp'.$key['descripcion'].'</p><br>
            ';
          }
        ?>

<?php
     $s = "SELECT COUNT(calificacion) AS c FROM calificaciones where Id_producto = ?";
     $params = array($id);
     $dat = Database::getRows($s, $params);
     



     foreach ($dat as $key) {
       $prom = $key['c'];
     }
    $tot =0;
      //for ($i = 0; $i < $prom; $i++ ) { 
         $ss = "SELECT * from calificaciones where Id_producto = ?";
         $par = array($id);
         $data = Database::getRows($ss, $par);

     
         

         foreach ($data as $ke) {
           $tot = $tot + $ke['calificacion'];    
         }
         if($prom > 0)
         {
           $res = $tot / $prom;



          $resultadoprom =  intval($res);

           if( $resultadoprom == 1)
            {
                echo '<p class="fuente">&nbsp&nbsp&nbsp&nbspLa calificacion actual de este producto es de:</p>
                    <img src="../img/logos/una_star.png" class="">'; 
            }

             if( $resultadoprom == 2)
            {
                echo '<p class="fuente">&nbsp&nbsp&nbsp&nbspLa calificacion actual de este producto es de:</p>
                    <img src="../img/logos/dos_star.png" class="">'; 
            }
            
             if( $resultadoprom == 3)
            {
                echo '<p class="fuente">&nbsp&nbsp&nbsp&nbspLa calificacion actual de este producto es de:</p>
                    <img src="../img/logos/tres_star.png" class="">'; 
            }
             if( $resultadoprom == 4)
            {
                echo '<p class="fuente">&nbsp&nbsp&nbsp&nbspLa calificacion actual de este producto es de:</p>
                    <img src="../img/logos/cuatro_star.png" class="">'; 
            }
             if( $resultadoprom == 5)
            {
                echo '<p class="fuente">&nbsp&nbsp&nbsp&nbspLa calificacion actual de este producto es de:</p>
                    &nbsp<img src="../img/logos/estrellas.png" class="">'; 
            }
           
           
            

           
         }else{
            echo '<p>El producto no ha sido valorado aun se el primero</p>';
         }
      //}
     


     
?>
<form method='POST' action="rat.php" enctype='multipart/form-data'>
<br>
<br>
  <p class="fuente">&nbsp&nbsp&nbsp&nbspEvalua nuestros productos</p>
          <div id="rateYo"  ></div>
          <input class="form-control" name="val" id="val" rows="5" type="hidden"</input>
          <input class="form-control" name="pro" value="<?php echo base64_decode($_GET['id']);?>" type="hidden"</input>
          <input class="form-control" name="cli" value="<?php echo $_SESSION['Id_cliente'];?>" type="hidden"</input>
          <br>&nbsp&nbsp
          <button class="btn btn-success btn-circle text-uppercase" id="getRating"><span class="glyphicon glyphicon-ok"></span> Calificar</button>
  
</form>
<br>
<br>



<div class="r">
    <div class="">

        <div class="panel panel-default widget">
            <div class="panel-heading">
                
                <h3 class="panel-title fuente mayuscula"><span class="glyphicon glyphicon-comment"></span> Comentarios</h3>
            </div>

            <br>
            
            <br>

            <form method='post' class='row' enctype='multipart/form-data'> 
                 <div class="form-group">
                    <label for="email" class="col-sm-2 control-label fuente mayuscula">&nbsp&nbsp&nbspTitulo</label>
                    <div class="col-sm-9">
                      <input class="form-control" name="titulo" id="addComment" rows="5"></input>
                    </div>
                </div>
                <br>
                <br>
                <div class="form-group">
                    <label for="email" class="col-sm-2 control-label fuente mayuscula">&nbsp&nbsp&nbspCometario</label>
                    <div class="col-sm-9">
                      <textarea class="form-control" name="comen" id="addComment" rows="5"></textarea>
                    <br>
                    <br>
                    </div>
                </div>
                

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">                    
                        <button class="btn btn-success btn-circle text-uppercase" type="submit" id="submitComment"><span class="glyphicon glyphicon-comment"></span> Hacer comentario</button>
                    </div>
                </div>            
            </form>
            <div class="panel-body">
                <ul class="list-group">
                    <?php
                      $query = "SELECT C.nombreCliente , CC.titulo , CC.comentario , CC.fecha 
                       from clientes AS C , comentariospro AS CC , productos AS Pro
                       where CC.id_cliente = C.Id_cliente AND CC.id_pro = ? AND Pro.Id_producto = ?";
                       $par = array($id , $id);
                       $gri = Database::getRows($query, $par);

                       foreach ($gri as $key) {
                         echo '
                            <li class="list-group-item">
                              <div class="row">
                                  <div class="col-xs-2 col-md-1">
                                      <img src="" class="img-circle img-responsive" alt="" /></div>
                                  <div class="col-xs-10 col-md-11">
                                      <div>
                                          <a class="fuente mayuscula fuentecolor">
                                              '.$key['titulo'].'</a>
                                          <div class="mic-info fuente">
                                              Por: <a class="fuentecolor">'.$key['nombreCliente'].'</a> - '.$key['fecha'].'
                                          </div>
                                      </div>
                                       <br>

                                      <div class="comment-text fuente">
                                          <p><span class="glyphicon glyphicon-envelope"></span> '.$key['comentario'].'</p>
                                      </div>
                                  </div>
                              </div>
                          </li>
                         ';
                       }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>

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
