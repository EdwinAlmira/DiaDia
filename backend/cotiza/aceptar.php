<!-- COMIENZO DE LA SENTENCIA  PHP--> 
<!-- ARCHIVOS REQUERIDOS PARA EL FUNCIONAMIENTO DEL CATALOGO--> 
<?php
require("../pagina.php");
    require("../procesos/database.php");
    $consu = "SELECT * FROM permisos WHERE Id_cargo = ?";
     $par = array(@$_SESSION['cargo']);
     $permisos = Database::getRow($consu , $par);
     if($permisos['pedidos'] == 1)
     {
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
    Page::header("ACEPTAR COTIZACION"); //ENCABEZADO DE LA PAGINA COTIZACION
    $id = base64_decode($_GET['id']);
    $sql = "SELECT * FROM cotizaciones WHERE Id_cotizacion = ?"; 
    $params = array($id);
    $data = Database::getRow($sql, $params);
    $precio = $data['precio'];
    $mensajeRespuesta = $data['mensajeRespuesta'];
}

if(!empty($_POST))
{
    $_POST = Validator::validateForm($_POST);  
    $precio = $_POST['precio'];
    $mensajeRespuesta = $_POST['mensajeRespuesta'];
    try 
    {
        if($mensajeRespuesta == "")   //VALIDAMOS LOS DATOS
        {
            throw new Exception("Llene el campo de cotizacion.");
        }

        if($id == null)
        {
             $sql = "INSERT INTO cotizaciones( precio, mensajeRespuesta) VALUES(?,?)";
             $params = array($precio,$mensajeRespuesta);
        }
        else
        {
            $sql = "UPDATE cotizaciones SET   estadoCotizacion = 1,  precio = ?, mensajeRespuesta = ? WHERE Id_cotizacion = ?";
            $params = array($precio,$mensajeRespuesta,$id);
        }
        Database::executeRow($sql, $params);
         ob_end_clean();  //LIMPIAMOS LA CACHE DEL HEADER
         header("location: cotiza.php"); // REDIRECCION DESPUES DE HACER LA ACCION
    }
    catch (Exception $error)
    {
        print("<div class='container-fluid titulo'> <h3> ERROR </h3> </div>".$error->getMessage()."</div>");
    }
}
?>


<!-- COMIENZO DE LA ESTRUCTURA DEL PANEL--> 
<br>
<br>
<br>
<div class="container-fluid">
<form method='post' class='row' enctype='multipart/form-data'>
    <div class='row'>
        <div class='col-md-12'>
          	<i class='glyphicon glyphicon-pencil col-md-1'></i>

          	<input id='mensajeRespuesta' type='text' name='mensajeRespuesta' class='validate col-md-3' length='200' maxlenght='200' value='<?php print($mensajeRespuesta); ?>' required/>
          	<label for='nombre' class="unespacio">Mensaje Respuesta</label>
        </div><br>
        <div class="col-md-12"> <br>
            <i class='glyphicon glyphicon-pencil col-md-1'></i>
            <input id='precio' type='text' name='precio' class='validate  col-md-3' length='50' maxlenght='50' value='<?php print($precio); ?>' required/>
            <label for='apellido' class="unespacio">precio</label>
        </div><br>

            </div>
        </div>

    </div>
    <br>
    <br>
    <div class="btnforms dosespacio">
    <button type='submit' class='btn btn-info colordebotonmodificar'><i class='glyphicon glyphicon-ok '></i>Guardar</button>
    
    <a href='cotiza.php' class='btn btn-danger colordebotoneliminar'><i class='glyphicon glyphicon-remove '></i> Cancelar</a>
 	
    </div>

    <!-- FIN DE LA ESTRUCTURA DEL PANEL--> 
</form>
</div>
<?php
}else{
    header("location: error.php");
}
Page::footer(); // FOOTER DE LA CLASE PAGE
?>



<!-- FIN DE LA SENTENCIA  PHp--> 