<?php
  require("../../backend/procesos/database.php");

  $id = base64_decode($_GET['id']);
  $sql = "SELECT * from productos where Id_producto = ?";
  $params = array($id);
  $data = Database::getRows($sql, $params);
?>
<!doctype html>
<html class="no-js" lang="es">
<head>
    <meta charset="utf-8">
    <title>Mis cotizaciones</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- estilos a utilizar -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="../css/nav.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/animate.css">
    <link rel="stylesheet" href="../css/font-awesomeq.css">
    <link href="../css/bootstrap-social.css" rel="stylesheet">
    <link href="../css/docs.css" rel="stylesheet" >
    <link rel="stylesheet" href="../css/mainEdwin.css">
    <link rel="shortcut icon" href="../img/logos/logosmall.ico">
    <link href="../css/index.css" rel="stylesheet" >
    <link href='https://fonts.googleapis.com/css?family=Ropa+Sans' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Advent+Pro' rel='stylesheet' type='text/css'>

</head>
<body>
    <!-- Barra de navegación -->
    <?php include 'nav.php'; ?>
 <div class="animated fadeIn">
 <br>
 <br>


    <!--Cotizaciones-->
    <div class="container vcenter">
      <div class="row">
        <div class="blogback col-md-offset-1 col-md-10">
          <div class="cabez"><br>
         <?php
         if(isset($_SESSION['usuario'])){
    $nombre_usu = $_SESSION['usuario'];
    print("
         
         <h1 class='text-center fuente mayuscula'>&nbsp&nbsp&nbsp&nbspRESUMEN DE COTIZACIONES : $nombre_usu </h1><br>
            <img src='../img/logos/blancosmall.png' class='ubicacion3'>");
            } 
            ?>
        <?php
          foreach ($data as $key) {
            if($id == null)
              {
                echo '<p class="text-center">No se encontro el producto deseado</p>';
              }else
              {
                echo '<h3 class="text-center">'.$key['nombreProdu'].'</h3>';
              }
          }
        ?>
        

        </div>
        

  <!-- Tab panes -->
  <div class="tab-content ">
    <div role="tabpanel" class="tab-pane fade in active " id="Noticias">
        <?php

          if($_GET['id'] != "")
          {
            $s = "SELECT * from cotizaciones where Id_cotizacion = ?";
            $params = array($id);
            $dat = Database::getRows($s, $params);
            foreach ($dat as $key) {
              if($key['estadoCotizacion'] == 1)
            {
              $est = "<div class='alert alert-success col-xs-12 col-md-8 col-lg-5 ubialerta' role='alert'><img src='../img/logos/logosmall.png' class=''><b class='fuente'></b></i> <b class='fuente'>APROBADA Y EN PRODUCCION.</b></div>";
            } 
            if($key['estadoCotizacion'] == 2)
            { 
              $est = "<div class='alert alert-danger col-lg-7 ubialerta' role='alert'><img src='../img/logos/logosmall.png' class=''><b class='fuente'></b></i> <b class='fuente'>LO SENTIMOS, SU COTIZACION NO CUMPLE LOS REQUISITOS PARA REALIZARSE</b></div>";
            } 
            if($key['estadoCotizacion'] == 0)
            { 
                $est = "<div class='alert alert-info col-xs-12 col-md-8 col-lg-5 ubialerta' role='alert'><img src='../img/logos/logosmall.png' class=''><b class='fuente'></b></i> <b class='fuente'>EN ESPERA DE UNA RESPUESTA.</b></div>";
            }
              echo '<br><br><img id="Imagenco" src="data:image/*;base64,'.$key['imagenCotizacion'].'" class="col-xs-12 col-md-12 col-lg-12 ">
              
              
              <br><br><br><br> <br><br><br><br> <br><br><br><br> <br><br><br><br>  <br><br><br><br>  <br><br><br><br>
              <h2 class="fuente mayuscula fuentecolor ">&nbsp&nbsp&nbsp&nbspDETALLES DE LA COTIZACION:</h2>
                    
                <p class="fuente mayuscula  fuentecolor ">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspEstado:</p>
                  <p class="text-left entrada">'.$est.'</p><br><br><br><br><br><br>';}
                  
                  
                if($key['estadoCotizacion'] != 0)
            { 
                echo '<p class="fuente mayuscula fuentecolor">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspRESPUESTA A SU SOLICITUD:</p>
                  <br><p class="text-left entrada fuente">&nbsp&nbsp'.$key['mensajeRespuesta'].'</p><br>';

                 if($key['estadoCotizacion'] == 1)
            { 
                echo '<p class="fuente mayuscula fuentecolor">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspPRECIO TOTAL:</p>
                  <br><p class="text-left entrada fuente">&nbsp&nbsp'.$key['precio'].'&nbsp Dolares $(USD)</p><br>';
            }

            }
             
            
                  
            }
          else{
        ?>
    </div>

   <?php
          $sql = "SELECT * FROM cotizaciones where Id_cliente = ? ORDER BY cotizacion";
          //$params = $_SESSION['Id_cliente'];
        $data = Database::getRows($sql, array($_SESSION['Id_cliente']));
        if($data != null)
        {

          //ESTRUCTURA DE LA TABLA
          $tabla =  "
          <div class='container-fluid'>
          <table class='col-md-12 col-lg-12 col-xs-12 col-lg-10 table-hover'>
                  <thead>
                      <tr>
                        <th><h3 class='fuente mayuscula'>&nbsp&nbspTUS COTIZACIONES</h3></th>
                        <th><h3 class='fuente mayuscula'>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspAcciones</h3></th>
                      </tr>

                      <hr>
                    </thead>
                    <tbody>";


            

            foreach($data as $row)
            { 


                  $tabla .= "<tr class='active'>
                            <td class='table-hover col-xs-12 col-md-6 col-lg-9 fuente'><h5>$row[cotizacion]</h5></td>

                            <td class='tabla'>
                              <a href='rec.php?id=".base64_encode($row['Id_cotizacion'])."' class='btn btn-success colordebotonmodificar'><i class='glyphicon glyphicon-pencil'></i>&nbspVer mas</a>
                        <a href='del.php?id=".base64_encode($row['Id_cotizacion'])."' class='btn btn-danger colordebotoneliminar'><i class='glyphicon glyphicon-remove'></i>&nbspEliminar</a>
                         <br><br>
                      </td>
                        </tr>
                         
                        ";
            }
            $tabla .=   "
            </tbody>
                  </table>
            

                  </div>";
          print($tabla); //IMPRIMIMOS LA TABLA CREADA
        }
        else
        {
        print("

      <div class='col-xs-12 col-md-12 col-lg-10 col-lg-offset-2 '>
          <img src='../img/logos/cotizacion.png' >
          </div>






        "); // EN CASO DE NO HABER REGISTROS
        }
?> 

  </div>

<?php } ?>

</div>


       
</div>
</div>

</div>

</div>
</div>
</div>
</div>


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
