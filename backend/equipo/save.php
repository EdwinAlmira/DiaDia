
<!-- COMIENZO  DE LA SENTENCIA  PHP--> 
<!-- ARCHIVOS REQUERIDOS PARA EL FUNCIONAMIENTO DEL CATOLOGO--> 
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

    /*Fecha*/
    ini_set("date.timezone","America/El_Salvador");
    $fechaIngreso = date("Y/m/d");
    $horaIngreso = date("G:i:s");
    $valuando = 0;

if(empty($_GET['id'])) 
{
    Page::header("AGREGAR MIEMBRO "); // ENCABEZADO DE LA PAGINA AGREGAR IMAGEN
    $id = null;
    $cargo = null;
    $nombre = null;
    $Imagen = null;
    $facebook = null;
    $twitter = null;
}
else
{
    Page::header("MODIFICAR MIEBRO");
    $id = base64_decode($_GET['id']);
    $sql = "SELECT cargo,nombre , foto, facebook,twitter FROM equipo WHERE Id_equipo = ?";
    $params = array($id);
    $data = Database::getRow($sql, $params);
    $cargo = $data['cargo'];
    $nombre = $data['nombre'];
    $Imagen = $data['foto'];
    $facebook = $data['facebook'];
    $twitter = $data['twitter'];
}

if(!empty($_POST))
{      //aca estan los posts , tengo que crearlos luego abajo para que concuerden
    $_POST = Validator::validateForm($_POST);
  	$cargo = $_POST['cargo'];
    $nombre = $_POST['nombre'];
    $Archivo = $_FILES['foto'];
    $facebook = $_POST['facebook'];
    $twitter = $_POST['twitter'];

    try 
    {
      	if($Archivo == "")   //VALIDACIONES BASICAS - COMPROBAMOS LA VERACIDAD DE LOS DATOS
        {
            throw new Exception("Datos incompletos.");
        }
          //aqui era name en vez de foto
        if($Archivo['name'] != null)
        {
            $base64 = Validator::validateImage($Archivo);
            if($base64 != false)
            {
                $Imagen = $base64;
            }
            else
            {
                throw new Exception("La imagen seleccionada no es valida.");
            }
        }
        else
        {
            if($Imagen == null)
            {
                throw new Exception("Debe seleccionar una imagen.");
            }
        }

        if ($_FILES['foto']['error'] !== UPLOAD_ERR_OK) {
          die("File upload failed with error code {$_FILES['foto']['error']}");
        }

        $info = getimagesize($_FILES['foto']['tmp_name']);
        if ($info === FALSE) {
           die("Invalid file type");
        }

        if (($info[0] == 600) || ($info[1] == 600)){

            if(trim($_POST['cargo'])!="")
            {
                
            }

            if($id == null)
            {
            	$sql = "INSERT INTO equipo(cargo, nombre , foto , facebook, twitter) VALUES(?,?,?,?,?)";
                $params = array($cargo,$nombre , $Imagen, $facebook, $twitter);
                $valuando = 1;
            }
            else
            {
                $sql = "UPDATE equipo SET cargo = ?, nombre = ?,foto = ? , facebook = ?, twitter = ? WHERE Id_equipo = ?";
                $params = array($cargo, $nombre , $Imagen, $facebook, $twitter,$id);
                $valuando = 2;
            }
            Database::executeRow($sql, $params);
            ob_end_clean();
             header("location: equipo.php");
        }
        else{

        }
        

    }
    catch (Exception $error)
    {
        print("<div class='container-fluid titulo'> <h3> ERROR </h3> </div>".$error->getMessage()."</div>");  // EN CASO DE ERROR , MOSTRAR EL SIGUIENTE MENSAJE
    }
}
if($valuando == 1){
      $usuariando = $_SESSION['Id_personal'];
      $bitacoriando = "CALL insertBitacora(3, 'Se agrego un integrante al equipo', ?, ?, ?)" ;
      $parametrando = array($usuariando, $fechaIngreso, $horaIngreso);
      Database::executeRow($bitacoriando, $parametrando);
}
else{
    if($valuando == 2){
        $usuariando = $_SESSION['Id_personal'];
        $bitacoriando = "CALL insertBitacora(4, 'Se modifico un integrante del equipo', ?, ?, ?)" ;
        $parametrando = array($usuariando, $fechaIngreso, $horaIngreso);
        Database::executeRow($bitacoriando, $parametrando);
    }
}
?>
<br>
<br>


<div class="panel-info col-md-8">
<div class='panel-heading'><b>EQUIPO<b></div>
 <div class='panel-body'>

<link href="../assets/css/sweetalert.css" rel="stylesheet">
<form method='post' class='row' enctype='multipart/form-data'>
    <div class='row'>
        <div class='col-md-12'>
         
            <div class='col-md-12'>
            <i class='glyphicon glyphicon-pencil col-md-1'></i>

            <input autocomplete="off" id='nombre' type='text' name='cargo' class='validate col-md-3' length='50' maxlenght='50' value='<?php print($cargo); ?>' required/>
            <label for='nombre' class="unespacio">Cargo</label>
        </div>
        <br><br>


        <div class='col-md-12'>
            <i class='glyphicon glyphicon-pencil col-md-1'></i>
            <input autocomplete="off" id='nombre' type='text' name='nombre' class='validate col-md-3' length='50' maxlenght='50' value='<?php print($nombre); ?>' required/>
            <label for='nombre' class="unespacio">Nombre</label>
        </div>
        <br><br>
                <div class='col-md-12'>
            <i class='glyphicon glyphicon-pencil col-md-1'></i>

            <input id='nombre' autocomplete="off" type='text' name='facebook' class='validate col-md-3' length='50' maxlenght='50' value='<?php print($facebook); ?>' required/>
            <label for='nombre' class="unespacio">Facebook</label>
        </div>
        
        <br><br>

        <div class='col-md-12'>
            <i class='glyphicon glyphicon-pencil col-md-1'></i>

            <input id='nombre' autocomplete="off" type='text' name='twitter' class='validate col-md-3' length='50' maxlenght='50' value='<?php print($twitter); ?>' required/>
            <label for='nombre' class="unespacio">Twitter</label>
            </div>
        
        <br>
         <div class="col-md-6">

            <br>
            <br>
                <label for="exampleInputFile">Seleccionar imagen (Imagen solo de  600 x 600)</label>
                <i class='glyphicon glyphicon-picture col-md-3'></i>
                <br>
                <input type="file" name='foto' id="exampleInputFile" placeholder='1200x1200px máx., 2MB máx., PNG/JPG/GIF'>
              </div>


              <!-- ESTRUCTURA DE LOS BOTONES CANCELAR Y GUARDAR--> 
                <div class="btnforms">
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
    
    <button type='submit' class='btn btn-info colordebotonmodificar'><i class='glyphicon glyphicon-pencil'></i> Guardar</button>
    <a href='equipo.php' class='btn btn-danger colordebotoneliminar'><i class='glyphicon glyphicon-remove'></i> Cancelar</a>
    </div>
    <script src="../assets/js/sweetalert.min.js"></script>
    <?php include '../sweet.php'; ?>

        </div>
    </div>
    
</form>
</div>
<?php
}else{
    header("location: error.php");
}
Page::footer(); // FOOTER DE LA CLASE PAGE
?>
