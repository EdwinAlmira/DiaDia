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
    Page::header("AGREGAR VALOR");
    $id = null;
    $titulo = null;
    $valor = null ;
    
}
else
{
    //Cargamos la informacion desde la base de datos si vamos a modificar
    Page::header("MODIFICAR VALOR");
    $id = base64_decode($_GET['id']);
    $sql = "SELECT * FROM valores WHERE Id_valor = ?";
    $params = array($id);
    $data = Database::getRow($sql, $params);
    $titulo = $data['titulo_valor'];
    $valor = $data['descripcion'];

    
}

if(!empty($_POST))
{
    //Asignamos los nombres de los campos a las variables creadas
    $_POST = Validator::validateForm($_POST);
  	$titulo = $_POST['titulo_valor'];
    $valor = $_POST['descripcion'];

    //Empieza el proceso de validaciones
    try 
    {
        if(trim($_POST['titulo_valor'])!="")
        {
            if(funValidarLetra($_POST['titulo_valor']))
            {
                $permiso_alert='nombreinvalido';
            }
            else if(trim($_POST['descripcion'])!='')
            {
                if(funValidarMV($_POST['descripcion']))
                {
                    $permiso_alert='descripcioninvalida';
                }
                else if($id==null)
                {
                    $sql = "INSERT INTO valores(titulo_valor, descripcion) VALUES(?,?)";
                    $params = array($titulo,$valor);
                    Database::executeRow($sql, $params);
                    ob_end_clean();
                    header("location: valores.php");   
                }
                else
                {
                    $sql = "UPDATE valores SET titulo_valor = ?, descripcion = ? WHERE Id_valor = ?";
                    $params = array($titulo, $valor, $id);
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
            $permiso_alert='nombrevacio';
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
<div class='panel-heading'><b>AGREGAR VALOR EMPRESARIAL<b></div>
 <div class='panel-body'>

<!--Diseño de la pagina-->
<form method='post' class='row' enctype='multipart/form-data'>
    <div class='row'>
        <div class='col-md-12'>
          	<i class='glyphicon glyphicon-pencil col-md-1'></i>

          	<input id='nombre' type='text' name='titulo_valor' class='validate col-md-3' autocomplete="off"required length='50' maxlenght='50' value='<?php print($titulo); ?>' />
          	<label for='nombre' class="unespacio">Titulo</label>
        </div><br>
        <div class="col-md-12"> <br>
            <i class='glyphicon glyphicon-pencil col-md-1'></i>
            <textarea id='nombre' type='text' name='descripcion' class='validate  estira3 col-md-3' autocomplete="off" required length='50' maxlenght='50' value='<?php print($valor); ?>' /></textarea>
            <label for='apellido' class="unespacio">Descripcion</label>
        </div><br>
        
    
            <br>
            <br>
            <br>   
            <br>
            <br>
            <br>
                <div class="btnforms dosespacio">
    <button type='submit' class='btn btn-info colordebotonmodificar'><i class='glyphicon glyphicon-pencil'></i> Guardar</button>
    <a href='valores.php'  class='btn btn-danger colordebotoneliminar'><i class='glyphicon glyphicon-remove'></i> Cancelar</a>

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

