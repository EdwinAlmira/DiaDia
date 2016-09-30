<?php
require("../pagina.php");
    require("../procesos/database.php");
    $consu = "SELECT * FROM permisos WHERE Id_cargo = ?";
     $par = array(@$_SESSION['cargo']);
     $permisos = Database::getRow($consu , $par);
     if($permisos['producto'] == 1)
     {

//Cargamos los archivos necesarios
require("../procesos/validator.php");
include("../procesos/functions.php");
$permiso_alert = "";


if(empty($_GET['id'])) 
{
    //Seteamos los campos en null
    Page::header("AGREGAR PERSONAL");
    $id = null;
    $nombre = null;
    $apellido = null;
    $correo = null;
    $usuario = null;
    $cargo = null;
    $descripcion = null;
    $fechaIngreso = null;
    $horaIngreso = null;
}
else
{
    //Cargamos la informacion desde la base de datos si vamos a modificar
    Page::header("MODIFICAR PERSONAL");
    $id = base64_decode($_GET['id']);
    $sql = "SELECT * FROM personal WHERE Id_personal = ?";
    $params = array($id);
    $data = Database::getRow($sql, $params);
    $nombre = $data['nombrePersonal'];
    $apellido = $data['apellidoPersonal'];
    $correo = $data['correo_personal'];
    $usuario = $data['usuario'];
    $cargo = $data['Id_cargo'];
    $fechaIngreso = date("Y/m/d");
    $horaIngreso = date("G:i:s");
}

if(!empty($_POST))
{
    //Asignamos los nombres de los campos a las variables creadas
    $_POST = Validator::validateForm($_POST);
  	$nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['correo'];
    $usuario = $_POST['usuario'];
    $cargo = $_POST['cargo'];
    $fechaIngreso = date("Y/m/d");
    $horaIngreso = date("G:i:s");
    $clave = "lcsv";
    //Empieza el proceso de validaciones
    try 
    {
        if(trim($_POST['nombre'])!="")
        {
            if(funValidarLetra($_POST['nombre']))
            {
                $permiso_alert='nombreinvalido';
            }
            else if(trim($_POST['apellido'])!='')
            {
                if(funValidarLetra($_POST['apellido']))
                {
                  $permiso_alert='apellidoinvalido';
                     
                }
                else if(trim($_POST['correo'])!= "")
                {
                    if(funValidarCorreo($_POST['correo']))
                    {
                        $permiso_alert='correoinvalido';
                          
                    }
                    else if(trim($_POST['usuario'])!= "")
                    {
                        if(funValidarLN($_POST['usuario']))
                        {
                            $permiso_alert='aliasinvalido';
                              
                        }
                        else if($id==null)
                        {
                            $clave1 = password_hash($clave, PASSWORD_DEFAULT);
                            $sql = "INSERT INTO personal(nombrePersonal, apellidoPersonal,correo_personal,usuario,Id_cargo,fechaIngreso, horaIngreso,clave_personal,primeravez, estado_personal) VALUES(?,?,?,?,?,?,?, ?,1,1)";
                            $params = array($nombre,$apellido,$correo,$usuario,$cargo,$fechaIngreso,$horaIngreso, $clave1);
                            Database::executeRow($sql, $params);
                            ob_end_clean();
                            header("location: personal.php");   
                        }
                        else
                        {
                             $sql = "UPDATE personal SET nombrePersonal = ?, apellidoPersonal = ?, correo_personal = ?, usuario = ?, Id_cargo = ?, fechaIngreso = ?, horaIngreso = ? primeravez = 1 , estado_personal = 1 WHERE Id_personal = ?";
                            $params = array($nombre, $apellido, $correo, $usuario, $cargo, $fechaIngreso,$horaIngreso, $id);
                            Database::executeRow($sql, $params);
                            ob_end_clean();
                            header("location: personal.php");
                        }
                       
                    }
                    else
                    {
                         $permiso_alert = 'aliasvacio';
                          
                    }
                }
                else
                {
                    $permiso_alert = 'correovacio';
                    
                }
            }
            else
            {
                $permiso_alert = 'apellidovacio';
            } 
            
        }
        else
        {
            $permiso_alert = 'nombrevacio';
        } 
    }
    catch (Exception $error)
    {
        print("<div class='container-fluid titulo'> <h3> ERROR </h3> </div>".$error->getMessage()."</div>");
    }
}
?>
<br>
<br>
<br>
<link href="../assets/css/sweetalert.css" rel="stylesheet">
<div class="panel-info col-md-9">
<div class='panel-heading'><b>PERSONAL<b></div>
 <div class='panel-body'>

<!--Diseño de la pagina-->
<form method='post' class='row' enctype='multipart/form-data'>
    <div class='row'>
        <div class='col-md-12'>
          	<i class='glyphicon glyphicon-pencil col-md-1'></i>

          	<input id='nombre' type='text' name='nombre' class='validate col-md-3' length='50' maxlenght='50' value='<?php print($nombre); ?>' autocomplete="off"required/>
          	<label for='nombre' class="unespacio">Nombre</label>
        </div><br>
        <div class="col-md-12 "> <br>
            <i class='glyphicon glyphicon-pencil col-md-1'></i>
            <input id='nombre' type='text' name='apellido' class='validate  col-md-3' length='50' maxlenght='50' value='<?php print($apellido); ?>' autocomplete="off" required/>
            <label for='apellido' class="unespacio">Apellido</label>
        </div><br>
        <div class="col-md-12"> <br>
            <i class='glyphicon glyphicon-envelope col-md-1'></i>
            <input id='correo' type='text' name='correo' class='validate col-md-3' length='50' maxlenght='50' value='<?php print($correo); ?>' autocomplete="off" required/>
            <label for='correo' class="unespacio">Correo</label>
        </div>
        <div class="col-md-12"> <br>
            <i class='glyphicon glyphicon-user col-md-1'></i>
            <input id='usuario' type='text' name='usuario' class='validate col-md-3' length='50' maxlenght='50' value='<?php print($usuario); ?>' autocomplete="off" required/>
            <label for='usuario' class="unespacio">Usuario</label>
        </div>
        <div class="col-md-12"> <br>
            <i class='glyphicon glyphicon-eye-open col-md-1'></i>
            <div class=''>
                <?php
                $sql = "SELECT Id_cargo, cargos FROM cargos";
                Page::setCombo("cargo", $cargo, $sql);
                ?>
            <br>
            <br>
                <div class="btnforms dosespacio">
   <button type='submit' class='btn btn-info colordebotonmodificar'><i class='glyphicon glyphicon-pencil'></i> Guardar</button>
    <a href='personal.php'  class='btn btn-danger colordebotoneliminar'><i class='glyphicon glyphicon-remove'></i> Cancelar</a>

    </div>
            </div>
        </div>

    </div>
   <script src="../assets/js/sweetalert.min.js"></script>
    <?php include '../sweet.php'; ?>
</form>
</div>
<?php
}else{
    header("location: error.php");
}
Page::footer();
?>

