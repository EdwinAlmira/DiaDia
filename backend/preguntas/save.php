<?php
require("../pagina.php");

require("../procesos/database.php");
    $consu = "SELECT * FROM permisos WHERE Id_cargo = ?";
     $par = array(@$_SESSION['cargo']);
     $permisos = Database::getRow($consu , $par);
     if($permisos['extra'] == 1)
     {
require("../procesos/validator.php");
include("../procesos/functions.php");
$permiso_alert = "";
if(empty($_GET['id'])) 
{
    //Seteamos los campos en null
    Page::header("AGREGAR PREGUNTA");
    $id = null;
    $titulo = null;
    $descripcion = null ;
    
}
else
{
    //Cargamos la informacion desde la base de datos si vamos a modificar
    Page::header("MODIFICAR PREGUNTA");
    $id = base64_decode($_GET['id']);
    $sql = "SELECT * FROM preguntas WHERE Id_pregunta = ?";
    $params = array($id);
    $data = Database::getRow($sql, $params);
    $titulo = $data['pregunta'];
    $descripcion = $data['descripcion'];

    
}

if(!empty($_POST))
{
    //Asignamos los nombres de los campos a las variables creadas
    $_POST = Validator::validateForm($_POST);
  	$titulo = $_POST['pregunta'];
    $descripcion = $_POST['descripcion'];

    //Empieza el proceso de validaciones
    try 
    {
        if(trim($_POST['pregunta'])!="")
        {
            if(funValidarPregunta($_POST['pregunta']))
            {
                $permiso_alert='preguntainvalida';
            }
            else if(trim($_POST['descripcion'])!='')
            {
                if(funValidarMV($_POST['descripcion']))
                {
                    $permiso_alert='descripcioninvalida';
                }
                else if($id==null)
                {
                    $sql = "INSERT INTO preguntas(pregunta, descripcion) VALUES(?,?)";
                    $params = array($titulo,$descripcion);
                    Database::executeRow($sql, $params);
                    ob_end_clean();
                    header("location: preguntas.php");   
                }
                else
                {
                    $sql = "UPDATE preguntas SET pregunta = ?, descripcion = ? WHERE Id_pregunta = ?";
                    $params = array($titulo, $descripcion, $id);
                    Database::executeRow($sql, $params);
                    ob_end_clean();
                    header("location: valores.php");
                }
            }
            else
            {
                $permiso_alert='descripcionvacia';
            }
        }
        else
        {
            $permiso_alert='preguntavacia';
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

<link href="../assets/css/sweetalert.css" rel="stylesheet">
<div class="panel-info col-md-6">
<div class='panel-heading'><b>AGREGAR NUEVA PREGUNTA<b></div>
 <div class='panel-body'>

<!--Diseño de la pagina-->
<form method='post' class='row' enctype='multipart/form-data'>
    <div class='row'>
        <div class='col-md-12'>
          	<i class='glyphicon glyphicon-pencil col-md-1'></i>

          	<input id='nombre' type='text' name='pregunta' class='validate col-md-3' length='50' maxlenght='50' value='<?php print($titulo); ?>' autocomplete="off"required/>
          	<label for='nombre' class="unespacio">Pregunta</label>
        </div><br>
        <div class="col-md-12"> <br>
            <i class='glyphicon glyphicon-pencil col-md-1'></i>
            <textarea id='nombre' type='text' name='descripcion' class='validate  col-md-3 estira3' length='50' maxlenght='50' value='<?php print($descripcion); ?>' autocomplete="off" required/></textarea>
            <label for='apellido' class="unespacio">Respuesta</label>
        </div><br>
            <br>
            <br>
            <br>
            <br>    
            <br>
            <br>
            <br>
                <div class="btnforms dosespacio">
    <button type='submit' class='btn btn-info colordebotonmodificar'><i class='glyphicon glyphicon-pencil'></i> Guardar</button>
    <a href='preguntas.php'  class='btn btn-danger colordebotoneliminar'><i class='glyphicon glyphicon-remove'></i> Cancelar</a>

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

