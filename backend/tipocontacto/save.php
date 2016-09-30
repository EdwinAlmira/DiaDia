<!-- INIICO DE LA SENTENCIA PHP--> 
<?php
require("../pagina.php");
require("../procesos/database.php");
require("../procesos/validator.php");

if(empty($_GET['id'])) 
{
    Page::header("Agregar tipo de contacto");
    $id = null;
    $nombre = null;
    $descripcion = null;
}
else
{
    Page::header("Modificar tipo de contacto");
    $id = $_GET['id'];
    $sql = "SELECT * FROM tipocontacto WHERE Id_tipoContacto = ?";
    $params = array($id);
    $data = Database::getRow($sql, $params);
    $nombre = $data['tipoContacto'];
}

if(!empty($_POST))
{
    $_POST = Validator::validateForm($_POST);
  	$nombre = $_POST['nombre'];
    try 
    {
      	if($nombre == "")
        {
            throw new Exception("Datos incompletos.");
        }

        if($id == null)
        {
        	$sql = "INSERT INTO tipocontacto(tipoContacto) VALUES(?)";
            $params = array($nombre);
        }
        else
        {
            $sql = "UPDATE tipocontacto SET tipoContacto = ? WHERE Id_tipoContacto = ?";
            $params = array($nombre, $id);
        }
        Database::executeRow($sql, $params);

        ob_end_clean();
        header("location: tipocontacto.php");
    }
    catch (Exception $error)
    {
        print("<div class='container-fluid titulo'> <h3> ERROR </h3> </div>".$error->getMessage()."</div>");
    }
}
?>

<!-- ESTRUCTURA DE LOS BOTONES  ACEPTAR Y CANCELAR--> 
<div class="container-fluid">
<form method='post' class='row' enctype='multipart/form-data'>
    <div class='row'>
        <div class='col-md-6'>
          	<i class='glyphicon glyphicon-pencil'></i>
          	<input id='nombre' type='text' name='nombre' class='validate' length='50' maxlenght='50' value='<?php print($nombre); ?>' required/>
          	<label for='nombre'>Nombre</label>
        </div>
    </div>
    <div class="btnforms">
    <a href='cargos.php' class='btn btn-danger'><i class='glyphicon glyphicon-remove'></i>Cancelar</a>
 	<button type='submit' class='btn btn-primary'><i class='glyphicon glyphicon-ok'></i>Guardar</button>
    </div>
</form>
</div>
<?php
Page::footer();
?>