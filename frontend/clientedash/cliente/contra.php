<?php
require("pagina.php");
require("../../../backend/procesos/database.php");
require("../../../backend/procesos/validator.php");

if(empty($_GET['id'])) 
{
    Page::header("CAMBIAR MI CONTRASEÑA");
    $id = null;
    $clave = null;
    
    
}
else
{
    Page::header("CAMBIAR MI CONTRASEÑA");
    $id = base64_decode($_GET['id']);
    $sql = "SELECT * FROM clientes WHERE Id_cliente = ?";
    $params = array($id);
    $data = Database::getRow($sql, $params);
    $clave = $data['contraCliente'];
    
   
}

if(!empty($_POST))
{
    $_POST = Validator::validateForm($_POST);
  	$clave = $_POST['clave'];
    
    
    try 
    {
      	if($clave == "")
        {
            throw new Exception("No puedes dejar la contraseña vacia");
        }
        
       
        else

        {

            $clavehash = base64_encode($clave);
            
            $sql = "UPDATE clientes SET contraCliente = ? WHERE Id_cliente = ?";
            $params = array($clavehash, $id);
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

        <div class="col-md-12"> <br>
            <i class='glyphicon glyphicon-user col-md-1'></i>
            <input id='usuario' type='password' name='clave' class='validate col-md-3' length='50' maxlenght='50' value='<?php print($clave); ?>' required/>
            <label for='usuario' class="unespacio">Contraseña</label>
            <br>
            <br>
        </div>
        <div class="btnforms dosespacio">

    

    <a href='cliente.php' class='btn btn-danger colordebotoneliminar'><i class='glyphicon glyphicon-remove '></i>Cancelar</a>
    <button type='submit' class='btn btn-info colordebotonmodificar'><i class='glyphicon glyphicon-ok '></i>Guardar</button>
    </div>

    </div>
    
</form>
</div>
<?php
Page::footer();
?>