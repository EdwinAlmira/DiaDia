<!-- INICIO  DE LA SENTENCIA  PHP--> 
<?php
require("../pagina.php");
	require("../procesos/database.php");
	$consu = "SELECT * FROM permisos WHERE Id_cargo = ?";
  	 $par = array(@$_SESSION['cargo']);
  	 $permisos = Database::getRow($consu , $par);
  	 if($permisos['extra'] == 1)
  	 {

require("../procesos/validator.php");
/*Fecha*/
    ini_set("date.timezone","America/El_Salvador");
    $fechaIngreso = date("Y/m/d");
    $horaIngreso = date("G:i:s");
    $valuando = 0;

Page::header("¿ELIMINAR A ESTE MIEMBRO?");

if(!empty($_GET['id'])) 
{
    $id = base64_decode($_GET['id']);
}
else
{
    header("location: equipo.php"); // ENCABEZADO DE LA PAGINA TIPOREDES
}

if(!empty($_POST))
{
	$id = $_POST['id'];
	try 
	{
		$sql = "DELETE FROM equipo WHERE Id_equipo = ?"; // CONSULTA A LA TABLA IMAGEN PRODUCTOS
	    $params = array($id);
	    Database::executeRow($sql, $params);
	    ob_end_clean();
         header("location: equipo.php");
        $valuando = 1;
        
	    
	} 
	catch (Exception $error) 
	{
		print("<div class='card-panel red'><i class='material-icons left'>error</i>".$error->getMessage()."</div>"); // EN CASO DE ERROR MOSTRAR EL SIGUIENTE MENSAJE
	}
}

if($valuando == 1){
      $usuariando = $_SESSION['Id_personal'];
      $bitacoriando = "CALL insertBitacora(5, 'Se elimino un integrante del equipo', ?, ?, ?)" ;
      $parametrando = array($usuariando, $fechaIngreso, $horaIngreso);
      Database::executeRow($bitacoriando, $parametrando);
}
?>

<!-- ESTRUCTURA DE LOS BOTONES ACEPTAR Y CANCELAR--> 
<br>
<br>
<div class="center-block">
<form method='post' class='row'>
	<input type='hidden' name='id' value='<?php print($id); ?>'/>
	<a  href='tiporedes.php'>
	<button type='submit'  class='btn btn-info colordebotonmodificar col-md-2 col-md-offset-3'><i class='glyphicon glyphicon-pencil'></i> Aceptar</button>
	<a href='equipo.php' class='btn btn-danger colordebotoneliminar col-md-2 col-md-offset-1'><i class='glyphicon glyphicon-remove'></i> Cancelar</a>
</form>
</div>
<?php
}else{
	header("location: error.php");
}
Page::footer();
?>
