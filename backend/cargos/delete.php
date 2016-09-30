<!-- COMIENZO DE LA SENTENCIA PHP--> 

<!-- ARCHIVOS REQUERIDOS PARA EL FUNCIONAMIENTO DEL CATALOGO--> 
<?php
require("../pagina.php");
	require("../procesos/database.php");
	$consu = "SELECT * FROM permisos WHERE Id_cargo = ?";
  	 $par = array(@$_SESSION['cargo']);
  	 $permisos = Database::getRow($consu , $par);
  	 if($permisos['personal'] == 1)
  	 {
    /*Fecha*/
    ini_set("date.timezone","America/El_Salvador");
    $fechaIngreso = date("Y/m/d");
    $horaIngreso = date("G:i:s");
    $valuando = 0;
require("../procesos/validator.php");
Page::header("¿ELIMINAR CARGO?"); // ENCABEZADO DE LA PAGINA 

if(!empty($_GET['id'])) 
{
    $id = base64_decode($_GET['id']);
}
else
{
    header("location: cargos.php"); // REDIRECCION DEL FORMULARIO
}

if(!empty($_POST))
{
	$id = $_POST['id'];
	try 
	{
		$valuando = 1;
		$sql = "DELETE FROM cargos WHERE id_cargo = ?"; // ELIMINAMOS LOS CARGOS
	    $params = array($id);
	    Database::executeRow($sql, $params);
         ob_end_clean();
         header("location: cargos.php");
	} 
	catch (Exception $error) 
	{
		print("<div class='card-panel red'><i class='material-icons left'>error</i>".$error->getMessage()."</div>"); // EN CASO DE ERROR , MOSTRARA ESTE ERROR
	}
}

if($valuando == 1){
      $usuariando = $_SESSION['Id_personal'];
      $bitacoriando = "CALL insertBitacora(5, 'Se elimino un cargo', ?, ?, ?)" ;
      $parametrando = array($usuariando, $fechaIngreso, $horaIngreso);
      Database::executeRow($bitacoriando, $parametrando);
}

?>

<!-- FIN DE LA SENTENCIA PHP--> 



<!-- COMIENZO DE LA ESTRUCTURA BOTONES ACEPTAR Y CANCELAR--> 

<br>
<br>
<div class="center-block">
<form method='post' class='row'>
	<input type='hidden' name='id' value='<?php print($id); ?>'/>
	<button type='submit' class='btn btn-info colordebotonmodificar col-md-2 col-md-offset-3'><i class='glyphicon glyphicon-pencil'></i> Aceptar</button>
	<a href='cargos.php'  class='btn btn-danger colordebotoneliminar col-md-2 col-md-offset-1'><i class='glyphicon glyphicon-remove'></i> Cancelar</a>
</form>
</div>

<!-- FIN DE LA ESTRUCTURA DE LOS BOTONES--> 

<?php
}else{
	header("location: error.php");
}
Page::footer();
?>
<!-- FOOTER DE LA CLASE PAGE--> 
