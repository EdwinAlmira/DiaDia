<?php
require("../../backend/procesos/database.php");
require("../../backend/procesos/functions.php");

$sql = "SELECT * FROM clientes";
$data = Database::getRows($sql, null);
if($data == null)
{
    header("location: registrar.php");
}
$permiso_alert = "";
require("../../backend/procesos/validator.php");
date_default_timezone_set('America/Guatemala');
    $error = "";
    
if(!empty($_POST))
{
    $_POST = Validator::validateForm($_POST);
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $correo = $_POST['correo'];
    $alias = $_POST['alias'];
    $clave1 = $_POST['clave1'];
    $clave2 = $_POST['clave2'];
    $fechaIngreso = date("Y/m/d");
    $horaIngreso = date("G:i:s");
    if($correo == "")
    {
        $correo = null;
    }
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
            if(trim($_POST['nombres'])!="")
            {
                if(funValidarLetra($_POST['nombres']))
                {
                    $permiso_alert ='nombreinvalido';
                }
                else  if(trim($_POST['apellidos'])!="")
                {
                    if(funValidarLetra($_POST['apellidos']))
                    {
                        $permiso_alert ='apellidoinvalido';
                    }
                    else if(trim($_POST['correo'])!="")
                    {
                        if(funValidarCorreo($_POST['correo']))
                        {
                            $permiso_alert ='correoinvalido';
                        }
                        else  if(trim($_POST['alias'])!="")
                        {
                            if(funValidarLN($_POST['alias']))
                            {
                                 $permiso_alert ='aliasinvalido';
                            }
                            else if($clave1 == $clave2 && ($_POST['alias']!= $clave1))
                            {
                                if (validar_clave($clave1,$error)) 
                                {
                                    $clave = password_hash($clave1, PASSWORD_DEFAULT);
                                    $sql = "INSERT INTO clientes(nombreCliente, apellidoCliente,  correo_cliente,usuario, contraCliente, fechaIngreso, horaIngreso,estadoCliente) VALUES(?, ?, ?, ?, ?, ?, ?,1)";
                                    $param = array($nombres, $apellidos, $correo, $alias, $clave, $fechaIngreso, $horaIngreso);
                                    Database::executeRow($sql, $param);
                                    echo "Bien hechos";                               
                                    $permiso_alert ='registrado';
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
                        else
                        {
                             $permiso_alert = 'aliasvacio';
                        }
                    }
                    else
                    {
                        $permiso_alert ='correovacio';
                    }
                }
                else
                {
                    $permiso_alert = 'apellidovacio';
                }
            }
            else
            {
                $permiso_alert = 'nombrevacio';
            }
       }
       else
       {
        $permiso_alert = 'captcha';
        
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
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Registrate</title>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/register.css">
	<link rel="stylesheet" href="../css/font-awesomeq.css">
    <link href="../css/bootstrap-social.css" rel="stylesheet">
    <link href="../css/docs.css" rel="stylesheet" >
    <link href="../css/main.css" rel="stylesheet" >
    <link href="../css/nav.css" rel="stylesheet" >
    <link href="../css/sweetalert.css" rel="stylesheet" >
</head>
<body>
	

	<?php include 'nav.php' ?>


	<!-- Sección donde se encuentra el contenido de la pagina -->

	<br><br>
	<section class="inicio seccion">
		<div class="container-fluid">
			<div class="row">
			<br>
			<div class="col-xs-12 col-md-6 col-md-offset-6 col-lg-4 col-lg-offset-1">
					<div class="thumbnail card">
						<img src="../img/logos/laca1.png" alt="" class="img-responsive registrar">
						<div class="caption">
							<h3 class="text-center">Tu cuenta</h3>
							<p class="text-center">¡Sé parte de nuestra página para enterarte de nuestras novedades!</p>
						</div>
					</div>
				</div>
                
				<div id="loginbox" class="col-xs-12 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-0">
					<h2 id="title" class=" text-center">Registrarme</h2>
				<form method="post" class="form-login">

		        <div class="login-wrap">
		            <input type="text" id="nombres" name="nombres" class="form-control validate"  placeholder="Nombres" autofocus title="Pon tus nombres" length='50' maxlenght='50'autocomplete="off" required>
		            <br>
                <input type="text" id="apellidos" name="apellidos" class="form-control validate"  placeholder="Apellidos" autofocus title="Pon tus apellidos" length='50' maxlenght='50'autocomplete="off" required>
                <br>
                <input type="email" id="correo" name="correo" class="form-control validate"  placeholder="Correo" autofocus title="Pon tu correo" length='100' maxlenght='100' autocomplete="off" required>
                <br>
                <input type="text" id="alias" name="alias" class="form-control validate"  placeholder="Alias" autofocus title="Pon tu alias" length='50' maxlenght='50'autocomplete="off" required>
                <br>
		        <input type="password" name="clave1" id="clave1" class="form-control validate" placeholder="Contraseña" title="Pon la contraseña" length='25' maxlenght='25' autocomplete="off" required>
                <br>
                <input type="password" name="clave2" id="clave2" class="form-control validate" placeholder="Confirmar Contraseña" title="Vuelve a escribir la contraseña" length='25' maxlenght='25' required autocomplete="off">
		        <br>
               <div class="g-recaptcha"  data-sitekey="6LfM9iUTAAAAAFxEsCwATEK8urmwGfpZiKWvwDpG"></div>
                <br>    
                <button class="btn col-sm-12 btn-hola center-block" type="submit" name="iniciar"><i class="fa fa-lock"></i> REGISTRAR</button>
		        </div>
                <br>
                <br>
                <!--<div class="col-sm-12 controls">
                    <a class=" col-sm-5 btn  btn-social btn-facebook center-block ">
                        <span class="fa fa-facebook"></span> Registrarme con facebook
                    </a>
                <div class="col-sm-2"></div>
                    <a class="col-xs-12  col-sm-5 btn  btn-social btn-google center ">
                        <span class="fa fa-google"></span> Registrarme con google
                    </a>
                </div>

		        </form>	 -->
					</div>
				</div>
			</div>
		</section>
		<br>

		<!--Footer -->
		<?php include 'footer.php'; ?>
	
<script src="../js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<script src="../js/vendor/sweetalert.min.js"></script>
<script src="../js/vendor/jquery-1.11.2.min.js"></script>
<script src="../js/vendor/bootstrap.min.js"></script>
<script src="../js/nav.js"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>
<?php include 'sweet.php'; ?>
	</body>
	</html>