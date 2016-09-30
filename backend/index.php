<?php
include("procesos/functions.php");
require("procesos/database.php");
session_start();


$sql = "SELECT COUNT(*) as registrados FROM personal where estado_personal = 1";
$datos = Database::getRow($sql, null);
$permiso_alert = "";
if($datos['registrados'] == 0)
{
    header("location: administrador/registrar.php");
}


 ini_set("date.timezone","America/El_Salvador");
    require("procesos/validator.php");
    $fechaIngreso = date("Y/m/d");
    $horaIngreso = date("G:i:s");
    $valuando = 0;



if(!empty($_POST))
{
  $_POST = validator::validateForm($_POST);
    $alias = $_POST['alias'];
    $clave = $_POST['clave'];
    try
    { 

      if($alias != "" && $clave != "")
      {





        $sql = "SELECT * FROM personal WHERE usuario = ?";
        $param = array($alias);
        $data = Database::getRow($sql, $param);
        if($data != null)
        {
          $hash = $data['clave_personal'];
          if(password_verify($clave, $hash)) 
          {
            

       
                         
            $valuando = 1;          

            $_SESSION['Id_personal'] = $data['Id_personal'];
            $_SESSION['nombrePersonal'] = $data['nombrePersonal']." ".$data['apellidoPersonal'];
            $_SESSION['start'] = time(); // Taking now logged in time.
            $_SESSION['expire'] = $_SESSION['start'] + (10* 60);
            $_SESSION['cargo'] = $data['Id_cargo'];
            $_SESSION['usuario'] = $data['usuario'];
 
            


            if($data['primeravez'] == 1 )
{

     

            $_SESSION['Id_personal'] = $data['Id_personal'];
            $_SESSION['nombrePersonal'] = $data['nombrePersonal']." ".$data['apellidoPersonal'];
            $_SESSION['start'] = time(); // Taking now logged in time.
            $_SESSION['expire'] = $_SESSION['start'] + (10* 60);
            $_SESSION['cargo'] = $data['Id_cargo'];
            $_SESSION['usuario'] = $data['usuario'];

    header("location: administrador/nuevacontra.php");
}



          





    else    
    {    header("location: dashboard/dashboard.php?se=".base64_encode(1));
       
      }
          

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
         print("<div class='alert alert-danger' role='alert'>".$error->getMessage()."</div>");
    }
}

if($valuando == 1){

  $usuariando = $_SESSION['Id_personal'];
  $bitacoriando = "CALL insertBitacora(1, 'Se inicio sesión en sitio privado', ?, ?, ?)" ;
  $parametrando = array($usuariando, $fechaIngreso, $horaIngreso);
  Database::executeRow($bitacoriando, $parametrando);

  $id = $_SESSION['Id_personal'] ;
             $sql = "UPDATE personal SET estado_sesion = 1 WHERE Id_personal = ?";
             $params = array($id);
             Database::executeRow($sql, $params);
             ob_end_clean();

}
?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    

    <title>LOGIN | CARPINTERIA SV</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        
    <!-- Custom styles for this template -->
    <link href="assets/css/login-backend.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">

    <link href="assets/css/style-responsive.css" rel="stylesheet">
    <link href="assets/css/sweetalert.css" rel="stylesheet">
    <script src="assets/js/sololetras.js"></script>

  </head>

  <body>
    <div id="login-page">
      <div class="container">
      
          <form method="post" class="form-login">
            <h2 class="form-login-heading">INICIAR SESIÓN</h2>
             <img src="assets/logo1.png"  class="img-circle col-md-6 col-md-offset-3">
            <div class="login-wrap">
                <input type="text" id="alias" name="alias" class="form-control validate"  placeholder="Usuario" autofocus title="Pon el usuario" autocomplete="off" onkeypress="return soloLetras(event)" required>
                <br>
                <input type="password" name="clave" id="clave" class="form-control validate" placeholder="Contraseña" title="Pon la contraseña" required>
                <label class="checkbox">
                
                    <span class="pull-right">
                        <a data-toggle="modal" data-target="#admin"> ¿Olvidaste tu contraseña?</a>

    
                    </span>
                </label>


     
                <button class="btn btn-theme btn-block" type="submit" name="iniciar"><i class="fa fa-lock"></i> ENTRAR</button>
            </div>


          </form>     
      
                 <div class='modal fade' id='admin'>
<form action='../frontend/email/recuperar_admin.php' method='post'>
  <div class='modal-dialog'>
    <div class='modal-content'>
      
      <div class='modal-body'>
        
        <img class='img-responsive' src='../frontend/img/logos/logomodal.png' alt='img-rude'>
        
        <br><br>
        <h4 class='text-center fuente mayuscula'> ¿HAS OLVIDADO TU CONTRASEÑA?, ESTAMOS ENCANTADOS EN AYUDARTE.</h4>

        <!-- formulario de ingreso de duda-->
        <form role='form'>

        <br>
          <div class='form-group'>
           <br>
          
            <label class=' fuente mayuscula' for='name'>Dejanos tu correo electronico</label>
             <br>
            <input type='text' class='form-control fuente' id='pwd' name='email' placeholder='Revisa tu correo para obtener tu nueva contraseña!' autocomplete="off">
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

      </div>
    </div>

    

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/sweetalert.min.js"></script>
    <!--BACKSTRETCH-->
    <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
    <script type="text/javascript" src="assets/js/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("assets/img/i.png", {speed: 500});
    </script>
    <?php include 'sweet.php'; ?>
   <footer class="footer">
      <div class="container">     
        <p class="text-muted">La Carpinteria SV | 2016</p>
      </div>
   </footer>
  </body>
</html>




