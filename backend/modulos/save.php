<?php
require("../pagina.php");
    require("../procesos/database.php");
    $consu = "SELECT * FROM permisos WHERE Id_cargo = ?";
     $par = array(@$_SESSION['cargo']);
     $permisos = Database::getRow($consu , $par);
     if($permisos['personal'] == 1)
     {





//Cargamos los archivos necesarios
require("../procesos/validator.php");
//Si elegimos agregar nuevo, reseteamos los campos
if(empty($_GET['id'])) 
{
    Page::header("AGREGAR MODULO");
    $id = null;
    $nombre = null;
    $descripcion = null;
}
else
    //Si lo modificamos, cargamos los campos
{
    Page::header("MODIFICAR PERMISOS ");
    $id = base64_decode($_GET['id']);
    $id_p = base64_decode($_GET['id_p']);
    $sql = "SELECT * FROM modulos WHERE id_modulo = ?";
    $params = array($id);
    $data = Database::getRow($sql, $params);
    $nombre = $data['permiso'];
}
//Verifica si no estan vacios los campos, si no lo estan entra al if y realiza el proceso de validacion
if(!empty($_POST))
{
    
    try 
    {
      	
        if($id == null)
        {
        	$sql = "INSERT INTO permisos(Id_cargo, producto, personal, pedidos, cliente, extra) VALUES (? , ? , ? , ? , ? , ?)";
            $params = array($_POST['producto'] , $_POST['personal'] , $_POST['pedidos'] , $_POST['cliente'] , $_POST['extra']);
        }
        //Si no era agregar un nuevo producto, lo modifica
        else
        {
            $sql = "UPDATE permisos SET producto = ? , personal = ? , pedidos = ? , cliente = ? , extra = ? WHERE Id_Permiso = ?";
            $params = array($_POST['producto'] , $_POST['personal'] , $_POST['pedidos'] , $_POST['cliente'] , $_POST['extra'] , $id_p);
        }
        Database::executeRow($sql, $params);
        ob_end_clean();
         header("location: modulos.php");


    }
    catch (Exception $error)
    {
        print("<div class='container-fluid titulo'> <h3> ERROR </h3> </div>".$error->getMessage()."</div>");
    }
}
?>
<div class="panel-info col-md-6">
<div class="panel-heading"><b>MODULOS A ADMINISTRAR<b></div>
<div class='panel-body'>
<!--Diseño de la pagina-->
<form method='post' class='row' enctype='multipart/form-data'>
    <div class='row'>
       <?php
            $consu = "SELECT * FROM permisos WHERE Id_cargo = ?";
            $par = array($id);
            $permisos = Database::getRow($consu , $par);

            if($permisos['producto'] == 1)
            {
                $producto = "checked=checked";
            }else
            {
                $producto = "";
            }if($permisos['personal'] == 1)
            {
                $personal = "checked=checked";
            }else
            {
                $personal = "";
            }if($permisos['pedidos'] == 1)
            {
                $pedidos = "checked=checked";
            }else
            {
                $pedidos = "";
            }if($permisos['cliente'] == 1)
            {
                $cliente = "checked=checked";
            }else
            {
                 $cliente = "";
            }if($permisos['extra'] == 1)
            {
                $extra = "checked=checked";
            }else
            {
                $extra = "";
            }
       ?>
        <div class='col-md-6'>
             <div class='col-md-12'>
                    <i class='glyphicon glyphicon-pencil col-md-1'></i>
                    <input type='checkbox' name='producto' value='1' <?php echo $producto ?>> Productos<br>
            </div>
             <div class='col-md-12'>
                    <i class='glyphicon glyphicon-pencil col-md-1'></i>
                    <input type='checkbox' name='personal' value='1' <?php echo $personal ?>> Personal<br>
            </div>
            <div class='col-md-12'>
                    <i class='glyphicon glyphicon-pencil col-md-1'></i>
                    <input type='checkbox' name='pedidos' value='1' <?php echo $pedidos ?>> Pedidos<br>
            </div>
            <div class='col-md-12'>
                    <i class='glyphicon glyphicon-pencil col-md-1'></i>
                    <input type='checkbox' name='cliente' value='1' <?php echo $cliente ?>> Clientes<br>
            </div>
            <div class='col-md-12'>
                    <i class='glyphicon glyphicon-pencil col-md-1'></i>
                    <input type='checkbox' name='extra' value='1' <?php echo $extra?>> Extras<br>
            </div>
        </div>
        <div class="btnforms dosespacio">
        <br>

    <br><br><br><br><br><br>
    <button type='submit' class='btn btn-info colordebotonmodificar'><i class='glyphicon glyphicon-pencil'></i> Guardar</button>
    <a href='modulos.php'  class='btn btn-danger colordebotoneliminar'><i class='glyphicon glyphicon-remove'></i> Cancelar</a>
    </div>
        
    </div>
    
</form>
</div>
<?php
}else{
    header("location: error.php");
}
Page::footer();
?>


