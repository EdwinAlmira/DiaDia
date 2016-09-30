<?php
require("../pagina.php");
	require("../procesos/database.php");
	$consu = "SELECT * FROM permisos WHERE Id_cargo = ?";
  	 $par = array(@$_SESSION['cargo']);
  	 $permisos = Database::getRow($consu , $par);
  	 if($permisos['producto'] == 1)
  	 {

Page::header("¿ELIMINAR COMENTARIO?");
//Verificamos si esta el id
if(!empty($_GET['id'])) 
{
    $id = base64_decode($_GET['id']);
}
//Si no teiene el id redireccionamos a personal.php
else
{
    header("location: comentarios.php");
}
//Si tiene los datos el form, realiza DELETE
if(!empty($_POST))
{
	$id = $_POST['id'];
	try 
	{   

       
	    
	    $sql = "DELETE FROM comentariospro WHERE Id_com = ?";
	    $params = array($id);
	    Database::executeRow($sql, $params);
	     ob_end_clean();
         header("location: comentarios.php");

         
	} 
	catch (Exception $error) 
	{
		print("");
	}
}
?>
<br>
<br>
<div class="center-block">
<form method='post' class='row'>
	<input type='hidden' name='id' value='<?php print($id); ?>'/>
	<button type='submit'  class='btn btn-info colordebotonmodificar col-md-2 col-md-offset-3'><i class='glyphicon glyphicon-pencil'></i> Aceptar</button>";
		
	<a href='comentarios.php'  class='btn btn-danger colordebotoneliminar col-md-2 col-md-offset-1'><i class='glyphicon glyphicon-remove'></i> Cancelar</a>
</form>
</div>
<?php
}else{
	 header("location: error.php");
}
Page::footer();
?>