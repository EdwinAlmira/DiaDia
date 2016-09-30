<!doctype html>
<html class="no-js" lang="es">
<head>
    <meta charset="utf-8">
    <title>Formulario de Compra</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--Estilos-->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="../css/mainEdwin.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/animate.css">
    <link rel="stylesheet" href="../css/nav.css">
    <link rel="stylesheet" href="../css/products.css">
        <link href="../css/index.css" rel="stylesheet" >
      <link href='https://fonts.googleapis.com/css?family=Ropa+Sans' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Advent+Pro' rel='stylesheet' type='text/css'>

</head>
<body>
    <!-- Barra de navegación -->
    <?php include 'nav.php'; ?>
    <?php include 'detalle.php'; ?>
<?php     
    require("../../backend/procesos/database.php");
    require("../../backend/procesos/validator.php");
    $id = @$_SESSION['Id_cliente'];
    $Imagen = $_FILES['imagenCotizacion'];
    $cotiza = $_POST['cotizacion'];
    
try 
    {
         $todayh = getdate();
    $d = $todayh['mday'];
    $m = $todayh['mon'];
    $y = $todayh['year'];
    $fecha = $d . "/" . $m . "/" .$y;
        if($Imagen['name'] != null)
        {
            $base64 = Validator::validateImage($Imagen);
            if($base64 != "")
            {
                $Archivo = $base64;
            }
            else
            {
                throw new Exception("La imagen seleccionada no es valida.");
               
            }
        }
        else
        {
            throw new Exception("");
        }


        if ($_FILES['imagenCotizacion']['error'] !== UPLOAD_ERR_OK) {
               die("File upload failed with error code {$_FILES['imagenCotizacion']['error']}");
            }

            $info = getimagesize($_FILES['imagenCotizacion']['tmp_name']);
            if ($info === FALSE) {
               die("Invalid file type");
            }

            if (($info[0] > 0) || ($info[1] > 0)){
            
        if($id != null)
        {

            $sql = "INSERT INTO cotizaciones(Id_cliente, imagenCotizacion, cotizacion,estadoCotizacion) VALUES(?, ?, ?,0)";
            $params = array($id , $Archivo, $cotiza);
            Database::executeRow($sql, $params);
        ob_start();
         header("location:../index.php");
        
        }else{
            echo $id;
        }

        }
        else{

        }
        

    }
    catch (Exception $error)
    {
        print("<div class='container-fluid titulo'> <h3>  </h3> </div>".$error->getMessage()."</div>");
    } ?>




    <!--Blog-->
    <div class='animated zoomIn'>
    <div class="container vcenter">
      <div class="row">
        <div class="blogback col-md-offset-1 col-md-10">
          <div class="cabez"><br>
            <h1 class="text-center fuente">COTIZA TUS IDEAS</h1><br>
            <img src='../img/logos/blancosmall.png' class='ubicacion2'>
        </div>
        <br>
                  <?php
                            if(isset($_SESSION['usuario'])){
                             $nombre_usu = $_SESSION['usuario'];

                             print("<h3 class='text-center fuente mayuscula'>¡BIENVENIDO $nombre_usu , TUS IDEAS VALEN ORO PARA NOSOTROS! </h3>");} ?>
                
                <!-- formulario de ingreso de duda-->
                <form role="form" method="post" enctype="multipart/form-data">

                    <div class="form-group detalle">
                    <label class='fuente mayuscula' for='pwd fuente' >Comentanos tu idea:</label>

                       
                        <textarea class="form-control" name="cotizacion" rows="3"></textarea>

                    </div>
                    <div class="detalle">
                        
                       <label class='fuente mayuscula' for='exampleInputFile'>Para servirte mejor , por favor dejanos un ejemplo de tu cotizacion</label>
                        <input type='file' name='imagenCotizacion' id='imagenCotizacion'  class="btn btn-hola">
                         <br> <button class="btn btn-hola col-lg-offset-9 col-lg-2 fuente">Enviar Cotización</button><br><br>
                    </div>
                    <br>
                </form>
    </div>
</div>
</div>
</div>

<br>



<!--Footer-->

               
<!--fin del DOM-->
    <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="../js/vendor/jquery-1.11.2.min.js"><\/script>')</script>

<script src="../js/vendor/bootstrap.min.js"></script>

<script src="../js/nav.js"></script>
</body>
</html>
