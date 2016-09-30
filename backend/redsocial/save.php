<!-- INIICO DE LA SENTENCIA PHP--> 

<!-- ARCHIVOS REQUERIDOS PARA EL FUNCIONAMIENTO DEL PROYECTO--> 
<?php
require("../pagina.php");
    require("../procesos/database.php");
    $consu = "SELECT * FROM permisos WHERE Id_cargo = ?";
     $par = array(@$_SESSION['cargo']);
     $permisos = Database::getRow($consu , $par);
     if($permisos['extra'] == 1)
     {

include("../procesos/functions.php");
require("../procesos/validator.php");
$permiso_alert = "";
if(empty($_GET['id'])) 
{
    Page::header("AGREGAR UNA RED SOCIAL"); //ENCABEZADO DE LA PAGINA TIPO RED
    $id = null;
    $red = null;
    $url =null;
}
else
{
    Page::header("MODIFICAR RED SOCIAL"); // ENCABEZADO DE LA PAGINA TIPO RED
    $id = base64_decode($_GET['id']);
    $sql = "SELECT * FROM redsocial WHERE id_red = ?";
    $params = array($id);
    $data = Database::getRow($sql, $params);
    $red = $data['nombre_red'];
    $url = $data['url'];
    
}

if(!empty($_POST))
{
    $_POST = Validator::validateForm($_POST);
    $red = $_POST['tipored'];
    $url = $_POST['url'];
      // VALIDACIONES BASICAS  - CORROBORAMOS LA INFORMACION
    try 
    {
        if(trim($_POST['tipored'])!="")
        {
           if(trim($_POST['url'])!="")
            {
                if($id == null)
                {
                    $sql = "INSERT INTO redsocial(nombre_red, url) VALUES(?,?)";
                    $params = array($red, $url);
                    Database::executeRow($sql, $params);
                    ob_end_clean();
                    header("location: redes.php");
                }
                else
                {
                    $sql = "UPDATE  redsocial SET nombre_red = ? , url = ?  WHERE id_red = ?";
                    $params = array($red,$url, $id);
                    Database::executeRow($sql, $params);
                    ob_end_clean();
                    header("location: redes.php");
                }  
            }
            else
            {
                $permiso_alert='urlvacio';
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
<br>
<br>


<!-- ESTRUCTURA DE LOS BOTONES CANCELAR Y GUARDAR--> 

<div class="panel-info col-md-6">
<div class='panel-heading'><b>AGREGAR UNA RED SOCIAL<b></div>
 <div class='panel-body'>
<form method='post' class='row' enctype='multipart/form-data'>
<link href="../assets/css/sweetalert.css" rel="stylesheet">
    
        <div class='col-md-12'>
            <i class='glyphicon glyphicon-pencil'></i>
            <input id='nombre'  type='text' name='tipored' class='validate' required autocomplete="off" length='50' maxlenght='50' value='<?php print($red); ?>' />
            <label for='nombre' class="unespacio"> Nombre de la red </label>
            </div>
              <br>
              <br>
 <div class='col-md-12'>
            <i class='glyphicon glyphicon-pencil'></i>
            <input id='nombre'  type='text' name='url' class='validate' length='50' required autocomplete="off" maxlenght='50' value='<?php print($url); ?>' />
            <label for='nombre' class="unespacio">Link de la red social</label>
            </div>
    <br>
    <br>
    <br>
    <div class="btnforms">
   <button type='submit' class='btn btn-info colordebotonmodificar'><i class='glyphicon glyphicon-pencil'></i> Guardar</button>
    <a href='redes.php'  class='btn btn-danger colordebotoneliminar'><i class='glyphicon glyphicon-remove'></i> Cancelar</a>

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
Page::footer(); // FOOTER DE LA CLASE PAGE
?>
