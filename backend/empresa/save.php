<?php
require("../pagina.php");
    require("../procesos/database.php");
    $consu = "SELECT * FROM permisos WHERE Id_cargo = ?";
     $par = array(@$_SESSION['cargo']);
     $permisos = Database::getRow($consu , $par);
     if($permisos['extra'] == 1)
     {

//Cargamos los archivos necesarios
require("../procesos/validator.php");
include("../procesos/functions.php");
$permiso_alert = "";

if(empty($_GET['id'])) 
{
    //Seteamos los campos en null
    Page::header("MODIFICAR EMPRESA");
    $id = null;
    $mision = null;
    $vision = null;

    
}
else
{
    //Cargamos la informacion desde la base de datos si vamos a modificar
    Page::header("MODIFICAR EMPRESA");
    $id = base64_decode($_GET['id']);
    $sql = "SELECT * FROM empresa WHERE Id_empresa = ?";
    $params = array($id);
    $data = Database::getRow($sql, $params);
    $mision = $data['Mision'];
    $vision = $data['Vision'];
    

if(!empty($_POST))
{
    //Asignamos los nombres de los campos a las variables creadas
    $_POST = Validator::validateForm($_POST);
    $mision = $_POST['Mision'];
    $vision = $_POST['Vision'];
    //Empieza el proceso de validaciones
        if(trim($_POST['Mision'])!="")
        {
            if(funValidarLetra($_POST['Mision']))
            {
                $permiso_alert='misioninvalida';
            }
            else if(trim($_POST['Vision'])!='')
            {
                if(funValidarMV($_POST['Vision']))
                {
                    $permiso_alert='visioninvalida';
                }
                else
                {
                    $sql = "UPDATE empresa SET Mision = ?, Vision = ? WHERE Id_empresa = ?";
                    $params = array($mision, $vision,$id);
                    Database::executeRow($sql, $params);
                    ob_end_clean();
                    header("location: empresa.php");
                }
            }
            else
            {
                $permiso_alert = 'visionvacia';
            }        
        }
        else
        {
             $permiso_alert = 'misionvacia';
        }
 }
          }                 
                       
                   
    

?>
<link href="../assets/css/sweetalert.css" rel="stylesheet">
<div class="panel-info col-md-8">
<div class='panel-heading'><b>MODIFICAR EMPRESA<b></div>
 <div class='panel-body'>

<!--Diseño de la pagina-->
<form method='post' class='row' enctype='multipart/form-data'>
    <div class='row'>
        <div class="col-md-12"> <br>
            <i class='glyphicon glyphicon-pencil col-md-1'></i>
            <textarea id='nombre' type='text' name='Mision' class='validate col-md-4 estira' length='50' autocomplete="off" maxlenght='50' /><?php print($mision); ?></textarea>
            <label for='nombre' class="unespacio">Mision</label>
        </div><br>
        <div class="col-md-12"> <br>
            <i class='glyphicon glyphicon-pencil col-md-1'></i>
            <textarea id='nombre' type='text' name='Vision' class='validate col-md-4 estira' length='50' autocomplete="off" maxlenght='50' /><?php print($vision); ?></textarea>
            <label for='nombre' class="unespacio">Vision</label>
        </div><br>
       
        
        
        <br>
       
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
       
    <div class="btnforms dosespacio">
     <button type='submit' class='btn btn-info colordebotonmodificar'><i class='glyphicon glyphicon-ok '></i> Guardar</button>
    <a href='empresa.php' class='btn btn-danger colordebotoneliminar'><i class='glyphicon glyphicon-remove '></i> Cancelar</a>
  

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
