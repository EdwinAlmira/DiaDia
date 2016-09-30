<?php
require("pagina.php");
require("../../../backend/procesos/database.php");
require("../../../backend/procesos/validator.php");

if(empty($_GET['id'])) 
{
    Page::header("EDITAR MI PERFIL");
    $id = null;
    $nombre = null;
    $apellido = null;
    $correo = null;
    $usuario = null;
   
    
}
else
{
    Page::header("EDITAR MI PERFIL");
    $id = base64_decode($_GET['id']);
    $sql = "SELECT * FROM clientes WHERE Id_cliente = ?";
    $params = array($id);
    $data = Database::getRow($sql, $params);
    $nombre = $data['nombreCliente'];
    $apellido = $data['apellidoCliente'];
    $correo = $data['correo_cliente'];
    $usuario = $data['usuario'];
   
}

if(!empty($_POST))
{
    $_POST = Validator::validateForm($_POST);
  	$nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['correo'];
    $usuario = $_POST['usuario'];
    
    try 
    {
      	if($nombre == "")
        {
            throw new Exception("Llene el campo nombre.");
        }
        if($apellido == "")
        {
            throw new Exception("Llene el campo apellido.");
        }
        if($correo == "")
        {
            throw new Exception("Llene el campo correo.");
        }
        if($usuario == "")
        {
            throw new Exception("Llene el campo usuario.");
        }
        
       
        if($id == null)
        {
            

        	$sql = "INSERT INTO clientes(nombreCliente, apellidoCliente,correo_cliente,usuario) VALUES(?,?,?,?)";
            $params = array($nombre,$apellido,$correo,$usuario);
        }
        else
        {

            $sql = "UPDATE clientes SET nombreCliente = ?, apellidoCliente = ?, correo_cliente = ?, usuario = ?  WHERE Id_cliente = ?";
            $params = array($nombre, $apellido, $correo, $usuario, $id);
        }
        Database::executeRow($sql, $params);
         ob_end_clean();
         header("location: cliente.php");
    }
    catch (Exception $error)
    {
        print("<div class='container-fluid titulo'> <h3> ERROR </h3> </div>".$error->getMessage()."</div>");
    }
}
?>
<div class="cpanel panel-success">
<div class='panel-heading'><b>MODIFICAR MI PERFIL DE USUARIO<b></div>
<div class='panel-body'>

<form method='post' class='row' enctype='multipart/form-data'>
    <div class='row'>
        <div class='col-md-12'>
          	<i class='glyphicon glyphicon-pencil col-md-1'></i>

          	<input id='nombre' type='text' name='nombre' class='validate col-md-3' length='50' maxlenght='50' value='<?php print($nombre); ?>' required/>
          	<label for='nombre' class="unespacio">Nombre</label>
        </div><br>
        <div class="col-md-12"> <br>
            <i class='glyphicon glyphicon-pencil col-md-1'></i>
            <input id='nombre' type='text' name='apellido' class='validate  col-md-3' length='50' maxlenght='50' value='<?php print($apellido); ?>' required/>
            <label for='apellido' class="unespacio">Apellido</label>
        </div><br>
        <div class="col-md-12"> <br>
            <i class='glyphicon glyphicon-envelope col-md-1'></i>
            <input id='correo' type='text' name='correo' class='validate col-md-3' length='50' maxlenght='50' value='<?php print($correo); ?>' required/>
            <label for='correo' class="unespacio">Correo</label>
        </div>
        <div class="col-md-12"> <br>
            <i class='glyphicon glyphicon-user col-md-1'></i>
            <input id='usuario' type='text' name='usuario' class='validate col-md-3' length='50' maxlenght='50' value='<?php print($usuario); ?>' required/>
            <label for='usuario' class="unespacio">Usuario</label>
            <br>
            <br>
        </div>
        <br>
        <br>

        <div class="btnforms dosespacio">

    <a href='cliente.php' class='btn btn-danger colordebotoneliminar'><i class='glyphicon glyphicon-remove '></i> Cancelar</a>
    <button type='submit' class='btn btn-info  colordebotonmodificar'><i class='glyphicon glyphicon-ok '></i> Guardar</button>

    </div>

    </div>
    
</form>
</div>
<?php
Page::footer();
?>