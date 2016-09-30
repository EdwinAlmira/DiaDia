<?php

require("../../backend/procesos/database.php");
include("../../backend/procesos/functions.php");
$sql = "SELECT * FROM clientes";
$data = Database::getRows($sql, null);
$permiso_alert = "";

if(!empty($_POST))
{

    $alias = $_POST['alias'];
    $clave = $_POST['clave'];
    try
    {
        if($alias != $clave && $clave != $alias || funValidarLN($_POST['alias']))
      {
        $sql = "SELECT * FROM clientes WHERE usuario = ?";
        $param = array($alias);
        $data = Database::getRow($sql, $param);
        if($data != null)
        {
          $hash = $data['contraCliente'];
          if(password_verify($clave, $hash)) 
          {
            session_start();
            $_SESSION['Id_cliente'] = $data['Id_cliente'];
              $_SESSION['usuario'] = $data['usuario'];
              $_SESSION['correo_cliente'] = $data['correo_cliente'];
              $_SESSION['start'] = time(); // Taking now logged in time.
            // Ending a session in 30 minutes from the starting time.
            $_SESSION['expire'] = $_SESSION['start'] + (10* 60);
              header("location: ../index.php");
        }
        else 
        {
          $permiso_alert ='backendclave';
        }
        }
        else
        {
          $permiso_alert ='backendusuario';
        }
      }
      else
      {
        $permiso_alert ='backendambos';
      }
    }
    catch (Exception $error)
    {
         print("<div class='alert alert-danger id='tope' role='alert'>".$error->getMessage()."</div>");
    }
}
?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <title class="fuente">Inicia Sesión</title>
  <link rel="shortcut icon" href="img/logos/logosmall.ico">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/register.css">
  <link rel="stylesheet" href="../css/font-awesomeq.css">
  <link href="../css/bootstrap-social.css" rel="stylesheet">
  <link rel="shortcut icon" href="../img/logos/logosmall.ico">
  <script src="../../backend/assets/js/sololetras.js"></script>
  <link href="../css/docs.css" rel="stylesheet" >
  <link href="../css/main.css" rel="stylesheet" >
  <link href="../css/nav.css" rel="stylesheet" >
  <link href="../css/sweetalert.css" rel="stylesheet">

  </head>
  <body>


  <!--Barra de navegación-->
  <?php include 'nav.php'; ?>
  <?php include 'contac.php'; ?>
  <!--Cuerpo de Login -->
   
  
  <section class="seccion vcenter">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-4 col-md-4 col-sm-4 hidden-xs">
        <img src="../img/logos/laca1.png" alt="" class="img-responsive img-rounded">
      </div>
      <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <form method="post" class="form-login">
            <h2 class="form-login-heading fuente mayuscula text-center">Iniciar Sesión</h2>
            <br><br> <br><br> <br>
            <div class="login-wrap">
              <input type="text" id="alias" name="alias" class="form-control validate fuente"  placeholder="Usuario" autofocus title="Pon el usuario" onkeypress="return soloLetras(event)" onpaste="return false" required  autocomplete="off">
              <br>
              <input type="password" name="clave" id="clave" class="form-control validate fuente" placeholder="Contraseña" title="Pon la contraseña" required  autocomplete="off">
              <br>
              <button class="btn col-sm-12 btn-hola center-block fuente" type="submit" name="iniciar"><i class="fa fa-lock"></i> ENTRAR</button>
            </div>
          </form>
          <br>
          <br>
          <br>
          <a  class="fuente" href="registrar.php">¿No tienes cuenta? ¡Registrate!</a>
           <br>
            <br>
           <a class="fuente" data-toggle="modal" data-target="#contra">¿Olvidaste tu contraseña?</a>
            <!--<div class="col-sm-12 controls">
                <a class=" col-sm-5 btn  btn-social btn-facebook center-block ">
                    <span class="fa fa-facebook"></span> Registrarme con facebook
                </a>
                <div class="col-sm-2"></div>
                  <a class="col-xs-12  col-sm-5 btn  btn-social btn-google center ">
                    <span class="fa fa-google"></span> Registrarme con google
                  </a>
            </div>
            -->
      
        
      </div>
      
    </div>
  </div> 
   <br> <br>
    <br> <br>
       <br> <br>
  </section>
<br>

<div class='modal fade' id='contra'>
<form action='../email/recuperar_contra.php' method='post'>
  <div class='modal-dialog'>
    <div class='modal-content'>
      
      <div class='modal-body'>
        
        <img class='img-responsive' src='../img/logos/logomodal.png' alt='img-rude'>
        
        <br><br>
        <h4 class='text-center fuente mayuscula'> ¿HAS OLVIDADO TU CONTRASEÑA, ESTAMOS ENCANTADOS EN AYUDARTE.</h4>
        <!-- formulario de ingreso de duda-->
        <form role='form'>

        <br>
          <div class='form-group'>
            <label class=' fuente mayuscula' for='name'>Dejanos tu correo electronico</label>
            <input type='text' class='form-control fuente ' id='pwd' name='email' placeholder='Revisa tu correo para obtener tu nueva contraseña!' autocomplete="off">
         
          </div>


        </form>
        

      </div>
      <div class='modal-footer'>
        <input type='submit' class='btn btn-hola' value='Enviar mensaje'>
        <buttton class='btn btn-default' data-dismiss='modal'>Cancelar</buttton>
         
      </div>
     
    </div>
  </div>
</div>
 


<?php include 'footer.php'; ?>
<!--footer-->


<script src="../js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<script src="../js/vendor/jquery-1.11.2.min.js"></script>
<script src="../js/vendor/bootstrap.min.js"></script>
<script src="../js/nav.js"></script>
<script src="../js/vendor/sweetalert.min.js"></script>
<?php include 'sweet.php'; ?>
</body>
</html>