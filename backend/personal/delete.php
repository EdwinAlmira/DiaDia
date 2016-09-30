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
Page::header("¿ELIMINAR PERSONAL?");
//Verificamos si esta el id
if(!empty($_GET['id'])) 
{
    $id = base64_decode($_GET['id']);
}
//Si no teiene el id redireccionamos a personal.php
else
{
    header("location: personal.php");
}
//Si tiene los datos el form, realiza DELETE
if(!empty($_POST))
{
	$id = $_POST['id'];
	try 
	{
		$sql = "UPDATE personal SET estado_personal = 0 WHERE Id_personal = ?";
	    $params = array($id);
	    Database::executeRow($sql, $params);
	     ob_end_clean();
         header("location: personal.php");
         $valuando = 1;
	} 
	catch (Exception $error) 
	{
		print("<div class='card-panel red'><i class='material-icons left'>error</i>".$error->getMessage()."</div>");
	}
}
if($valuando == 1){
      $usuariando = $_SESSION['Id_personal'];
      $bitacoriando = "CALL insertBitacora(5, 'Se elimino un integrante del personal', ?, ?, ?)" ;
      $parametrando = array($usuariando, $fechaIngreso, $horaIngreso);
      Database::executeRow($bitacoriando, $parametrando);
}
?>
<br>
<br>
<div class="center-block">
<form method='post' class='row'>
	<input type='hidden' name='id' value='<?php print($id); ?>'/>
	<button type='submit'  class='btn btn-info colordebotonmodificar col-md-2 col-md-offset-3'><i class='glyphicon glyphicon-pencil'></i> Aceptar</button>";
		
	<a href='personal.php'  class='btn btn-danger colordebotoneliminar col-md-2 col-md-offset-1'><i class='glyphicon glyphicon-remove'></i> Cancelar</a>
</form>
</div>
<?php
}else{
	 header("location: error.php");
}
Page::footer();
?>