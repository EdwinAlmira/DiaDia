<?php
require("../procesos/database.php");
include("../procesos/functions.php");
$sql = "SELECT * FROM personal";
$data = Database::getRows($sql, null);
$permiso_alert = "";
$error = "";
session_start();



require("../procesos/validator.php");
date_default_timezone_set('America/Guatemala');


    //Seteamos los campos en null
    
    $id = $_SESSION['Id_personal'];
    $clave1 = null;
    $clave2 = null;


if(!empty($_POST))
{
    $_POST = Validator::validateForm($_POST);
    $clave1 = $_POST['clave1'];
    $clave2 = $_POST['clave2'];
    
    
    try 
    {
        function validar_clave($clave1,&$error_clave)
        {
        if(strlen($clave1) < 6){
            $error_clave = "La clave debe tener al menos 6 caracteres";
            return false;
        }
        if(strlen($clave1) > 16){
            $error_clave = "La clave no puede tener más de 16 caracteres";
            return false;
        }
        if (!preg_match('`[a-z]`',$clave1)){
            $error_clave = "La clave debe tener al menos una letra minúscula";
            return false;
        }
        if (!preg_match('`[A-Z]`',$clave1)){
            $error_clave = "La clave debe tener al menos una letra mayúscula";
            return false;
        }
        if (!preg_match('`[0-9]`',$clave1)){
            $error_clave = "La clave debe tener al menos un caracter numérico";
            return false;
        }
        $error_clave = "";
        return true;
        }
       
       if(isset($_POST['g-recaptcha-response']) && $_POST['g-recaptcha-response'])
        {
            
                             if($clave1 == $clave2)
                            {
                                if (validar_clave($clave1,$error)) 
                                {
                                    $clave = password_hash($clave1, PASSWORD_DEFAULT);
                                    $sql = "UPDATE personal SET clave_personal = ?, primeravez = 0 WHERE Id_personal = ?";
                                    $param = array($clave , $id);
                                    Database::executeRow($sql, $param);
                                    header("location: ../index.php");
                                }
                                else
                                {
                                    $permiso_alert='clave';
                                }
                            }
                            else
                            {
                                $permiso_alert ='clave2';
                            }
                        
                  
                
            
        }
        
    }
    catch (Exception $error)
    {
        print("<div class='card-panel red'><i class='material-icons left'>error</i>".$error->getMessage()."</div>");
    }
}
else
{
    $nombres = null;
    $apellidos = null;
    $correo = null;
    $alias = null;
}
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>REGISTRAR | CARPINTERIA SV</title>

    <!-- Bootstrap core CSS -->
    <link href="../assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="../assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="../assets/css/sweetalert.css" rel="stylesheet">   
    <!-- Custom styles for this template -->
    <link href="../assets/css/login-backend.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
    <link href="../assets/css/style-responsive.css" rel="stylesheet">
    <script src="../assets/js/sololetras.js"></script>
  </head>

  <body>
      <div id="login-page" class="formulario">
        <div class="container">
        
              <form method="post" class="form-login">
                <h2 class="form-login-heading">REGISTRARME</h2>
                <div class="login-wrap">
                    
                    <input type="password" name="clave1" id="clave1" class="form-control validate" placeholder="Contraseña" title="Pon la contraseña" length='25' maxlenght='25' required autocomplete="off">
                <br>
                <input type="password" name="clave2" id="clave2" class="form-control validate" placeholder="Confirmar Contraseña" title="Vuelve a escribir la contraseña" length='25' maxlenght='25' required autocomplete="off">
                <br>
                <div class="g-recaptcha"  data-sitekey="6LfM9iUTAAAAAFxEsCwATEK8urmwGfpZiKWvwDpG"></div>
                <br>
                    <button class="btn btn-theme btn-block" type="submit" name="iniciar"><i class="fa fa-lock"></i>NUEVA CONTRASEÑA</button>
                </div>


              </form>       
        
        </div>
      </div>


    <!-- js placed at the end of the document so the pages load faster -->
    <script src="../assets/js/jquery.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/sweetalert.min.js"></script>
    <!--BACKSTRETCH-->
    <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
    <script type="text/javascript" src="../assets/js/jquery.backstretch.min.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script>
        $.backstretch("../assets/img/i.png", {speed: 500});
    </script>
   <footer class="footer">
        <div class="container">         
            <p class="text-muted">La Carpinteria SV | 2016</p>
        </div>
   </footer>
   <?php include '../sweet.php'; ?>
  </body>
</html>
