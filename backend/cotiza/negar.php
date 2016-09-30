<!-- COMIENZO DE LA SENTENCIA PHP-->
<!-- ARCHIVOS REQUERIDOS PARA EL CATALOGO-->  
<?php
require("../pagina.php");
    require("../procesos/database.php");
    $consu = "SELECT * FROM permisos WHERE Id_cargo = ?";
     $par = array(@$_SESSION['cargo']);
     $permisos = Database::getRow($consu , $par);
     if($permisos['pedidos'] == 1)
     {
?>
<?php
require("../../backend/procesos/validator.php");
ini_set("date.timezone","America/El_Salvador");

if(empty($_GET['id'])) 
{
    $id = null;
    $Id_cotizacion = null;
    $Id_cliente = null;
    $imagenCotizacion = null;
    $cotizacion = null;
    $estadoCotizacion = null;
    $fechaIngreso = null;
    $horaIngreso = null;
    $precio = null;
    $mensajeRespuesta = null;
}
else
{
    Page::header("NEGAR COTIZACION"); // ENCABEZADO DE LA PAGINA COTIZACION
    $id = base64_decode($_GET['id']);
    $sql = "SELECT * FROM cotizaciones WHERE Id_cotizacion = ?";
    $params = array($id);
    $data = Database::getRow($sql, $params);
    $precio = $data['precio'];
    $mensajeRespuesta = $data['mensajeRespuesta'];
}

if(!empty($_POST))
{
    $_POST = Validator::validateForm($_POST);  // VALIDACIONES BASICAS - COMPROBAMOS LOS DATOS
    $precio = $_POST['precio'];
    $mensajeRespuesta = $_POST['mensajeRespuesta'];
    try 
    {
        if($mensajeRespuesta == "")
        {
            throw new Exception("Llene el campo de cotizacion.");
        }

        if($id == null)
        {
             $sql = "INSERT INTO cotizaciones(mensajeRespuesta) VALUES(?)";
             $params = array($mensajeRespuesta);
        }
        else
        {
            $sql = "UPDATE cotizaciones SET   estadoCotizacion = 2,  mensajeRespuesta = ? WHERE Id_cotizacion = ?";
            $params = array($mensajeRespuesta,$id);
        }
        Database::executeRow($sql, $params);
         ob_end_clean();
         header("location: cotiza.php");
    }
    catch (Exception $error)
    {
        print("<div class='container-fluid titulo'> <h3> ERROR </h3> </div>".$error->getMessage()."</div>");
    }
}
?>
<!-- COMIENZO DE LA ESTRUCTURA DEL PANEL--> 
<div class="container-fluid">
<form method='post' class='row' enctype='multipart/form-data'>
    <div class='row'>
        <div class='col-md-12'>
          	<i class='glyphicon glyphicon-pencil col-md-1'></i>

          	<input id='mensajeRespuesta' type='text' name='mensajeRespuesta' class='validate col-md-3' length='200' maxlenght='200' value='<?php print($mensajeRespuesta); ?>' required/>
          	<label for='nombre' class="unespacio">Mensaje Respuesta</label>
        </div><br>
            </div>
        </div>

    </div>
    <br>
    <br>
    <br>
    <div class="btnforms dosespacio">
    
 	<button type='submit' class='btn btn-info colordebotonmodificar'><i class='glyphicon glyphicon-ok '></i> Guardar</button>
    <a href='cotiza.php' class='btn btn-danger colordebotoneliminar'><i class='glyphicon glyphicon-remove '></i> Cancelar</a> <!-- ESTRUCTURA DE LOS BOTONES DE CANCERLAR Y GUARDAR--> 
    </div>
</form>
</div>
<?php
Page::footer();
?>

<?php 
}else{
    header("location: error.php");
}
?>