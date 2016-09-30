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
    <title>Noticias</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- estilos a utilizar -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
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
    <?php include 'nav.php'; ?>
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
                echo '<h3 class="text-center">'.$key['nombreProdu'].'</h3>';
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

          if($_GET['id'] != "")
          {
            $s = "SELECT * from cotizaciones where Id_cotizacion = ?";
            $params = array($id);
            $dat = Database::getRows($s, $params);
            
            foreach ($dat as $key) {
              if($key['estadoCotizacion'] == 2)
            {
              $est = "Aprobado";
            } 
            if($key['estadoCotizacion'] == 1)
            { 
              $est = "Espera";
            } 
            else{
                $est = "Negado";
            }
              echo '<img id="Imagenco" src="data:image/*;base64,'.$key['imagenCotizacion'].'" class="col-xs-12 col-md-12 col-lg-12 ">
              <br><p class="espacio">.</p>
              <p>Cotizacion:</p>
                  <br><p class="text-left entrada">'.$key['mensajeRespuesta'].'</p><br>

                <p>Estado:</p>
                  <br><p class="text-left entrada">'.$est.'</p><br>

                <p>Descripcion:</p>
                  <br><p class="text-left entrada">'.$key['mensajeRespuesta'].'</p><br>
              ';
            }
          }else{
        ?>
    </div>

   <?php
          $sql = "SELECT * FROM cotizaciones where Id_cliente = ? ORDER BY cotizacion";
          //$params = $_SESSION['Id_cliente'];
        $data = Database::getRows($sql, array($_SESSION['Id_cliente']));
        if($data != null)
        {

          //ESTRUCTURA DE LA TABLA
          $tabla =  "<br>
          <div class='container-fluid'>
          <table class='col-md-12 col-lg-12 col-xs-12 col-lg-10 table-hover'>
                  <thead>
                      <tr>
                        <th><h4>CARGOS EXISTENTES</h4></th>
                        <th><h4>Acciones</h4></th>
                      </tr>
                    </thead>
                    <tbody>";
            foreach($data as $row)
            {
                  $tabla .= "<tr class='active'>
                            <td class='table-hover col-xs-12 col-md-6 col-lg-9'><h5>$row[cotizacion]</h5></td>
                            <td class='tabla'>
                              <a href='rec.php?id=".base64_encode($row['Id_cotizacion'])."' class='btn btn-info colordebotonmodificar'><i class='glyphicon glyphicon-pencil'></i>Ver mas</a>
                        <a href='rec.php?id=".base64_encode($row['Id_cotizacion'])."' class='btn btn-danger colordebotoneliminar'><i class='glyphicon glyphicon-remove'></i>Eliminar</a>
                      </td>
                        </tr>";
            }
            $tabla .=   "</tbody>
                  </table>
                  </div>";
          print($tabla); //IMPRIMIMOS LA TABLA CREADA
        }
        else
        {
        print("<div class='alert alert-danger col-xs-12 col-md-8 col-lg-3' role='alert'><b> AVISO:</b></i> <b>NO HAY CARGOS REGISTRADOS.</b></div>"); // EN CASO DE NO HABER REGISTROS
        }
?> <br><br><br>
  </div>

<?php } ?>
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
