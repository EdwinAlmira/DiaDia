<!-- INICO DE LA SENTENCIA PHP-->
<!-- ARCHIVOS REQUERIDOS  PARA EL FUNCIONAMIENTO-->  
<?php
require("../pagina.php");
	require("../procesos/database.php");
	$consu = "SELECT * FROM permisos WHERE Id_cargo = ?";
  	 $par = array(@$_SESSION['cargo']);
  	 $permisos = Database::getRow($consu , $par);
  	 if($permisos['extra'] == 1)
  	 {

require("../procesos/validator.php");
Page::header("ELIMINAR RED SOCIAL");

if(!empty($_GET['id'])) 
{
    $id = base64_decode($_GET['id']);
}
else
{
    header("location: redes.php"); //ENCABEZADO DE LA PAGINA TIPO REDES
}

if(!empty($_POST))
{
	$id = $_POST['id'];
	try 
	{
		$sql = "DELETE FROM redsocial WHERE id_red = ?"; // CONSULTA PARA ELIMINAR
	    $params = array($id);
	    Database::executeRow($sql, $params);
	    ob_end_clean();
         header("location: redes.php");
	    
	} 
	catch (Exception $error) 
	{
		print("<div class='card-panel red'><i class='material-icons left'>error</i>".$error->getMessage()."</div>"); // EN CASO DE ERROR , IMPRIMIR EL SIGUIENTE MENSAJE
	}
}
?>
<div class="center-block">
<form method='post' class='row'>
	<input type='hidden' name='id' value='<?php print($id); ?>'/>
	<button type='submit'  class='btn btn-info colordebotonmodificar col-md-2 col-md-offset-3'><i class='glyphicon glyphicon-pencil'></i> Aceptar</button>";
		
	<a href='redes.php'  class='btn btn-danger colordebotoneliminar col-md-2 col-md-offset-1'><i class='glyphicon glyphicon-remove'></i> Cancelar</a>
</form>
</div>
<?php
Page::footer(); //FOOTER DE LA CLASE PAGE
}else{
	header("location: error.php");
}
?>
