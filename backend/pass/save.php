<?php
//Cargamos los archvos necesarios
require("../pagina.php");
include("../procesos/functions.php");
require("../procesos/database.php");
require("../procesos/validator.php");
$permiso_alert = "";
//Seleccionamos la zona horaria
date_default_timezone_set('America/Guatemala');
//Si esta vacio el id, declaramos las variables en null

Page::header("Modificar contra");

//Empieza el proceso de insertar
if(!empty($_POST))
{
    $_POST = Validator::validateForm($_POST);
    $clave = $_POST['pas'];
    try 
    {
        $id = $_SESSION['Id_personal'];
        $clave1 = password_hash($clave, PASSWORD_DEFAULT);
        $sql = "UPDATE personal SET clave_personal = ? WHERE Id_personal = ?";
        $params = array($clave1 , $id);
        Database::executeRow($sql, $params);
        ob_end_clean();
        header("location: pas.php");
       
    }
    catch (Exception $error)
    {
        print("<div class='container-fluid titulo'> <h3> ERROR </h3> </div>".$error->getMessage()."</div>");
    }
}
?>
<!--Diseño de la pagina-->
 <link href='https://fonts.googleapis.com/css?family=Ropa+Sans' rel='stylesheet' type='text/css'>
<br>
<div class="panel panel-info">
<div class='panel-heading'><b>Clave</b></div>
    <div class='panel-body'>
    <form method='post' class='row' enctype='multipart/form-data'>
        <div class='col-md-12'>
            <i class='glyphicon glyphicon-pencil col-md-1'></i>

            <input id='nombre' type='text' name='pas' class='validate col-md-3' length='50' maxlenght='50' required/>
            
        </div>


    </div>
    <div class="btnforms dosespacio">
    <a href='pas.php' class='btn btn-danger colordebotoneliminar'><i class='glyphicon glyphicon-remove'></i>CANCELAR</a>
    <button type='submit' class='btn btn-info colordebotonmodificar'><i class='glyphicon glyphicon-pencil'></i>GUARDAR</butto>
    
    </div>
    <br>
    <script src="../assets/js/sweetalert.min.js"></script>
    <?php include '../sweet.php'; ?>
</form>
</div>
