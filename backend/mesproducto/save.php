<?php
require("../pagina.php");
    require("../procesos/database.php");
    $consu = "SELECT * FROM permisos WHERE Id_cargo = ?";
     $par = array(@$_SESSION['cargo']);
     $permisos = Database::getRow($consu , $par);
     if($permisos['personal'] == 1)
     {
include("../procesos/functions.php");
require("../procesos/validator.php");
$permiso_alert = "";
date_default_timezone_set('America/Guatemala');
$mensaje = "";
if(empty($_GET['id'])) 
{
    Page::header("AGREGAR  MES");
    $id = null;
    $nombre = null;
    $fecha_inicio = null;
    $fecha_fin = null;
}
else
{
    Page::header("MODIFICAR MES");
    $id = base64_decode($_GET['id']);
    $sql = "SELECT * FROM mesproducto WHERE Id_mes = ?";
    $params = array($id);
    $data = Database::getRow($sql, $params);
    $nombre = $data['nombre'];
    $Imagen = $data['imagen'];
    $fecha_inicio = $data['fecha_inicio'];
    $fecha_fin = $data['fecha_fin'];
}

if(!empty($_POST))
{
    $_POST = Validator::validateForm($_POST);
    $nombre = $_POST['nombre'];
    $Archivo = $_FILES['foto'];
    $fecha_inicio = $_POST['inicio'];
    $fecha_fin = $_POST['fin'];   
    try 
    {
      	if($Archivo == "")   //VALIDACIONES BASICAS - COMPROBAMOS LA VERACIDAD DE LOS DATOS
        {
            throw new Exception("Datos incompletos.");
        }

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
        if(trim($_POST['nombre'])!="")
        {
            if(funValidarLetra($_POST['nombre']))
            {
                $permiso_alert='nombreinvalido';
            }
            if ($_FILES['foto']['error'] !== UPLOAD_ERR_OK) {
               die("File upload failed with error code {$_FILES['foto']['error']}");
            }

            $info = getimagesize($_FILES['foto']['tmp_name']);
            if ($info === FALSE) {
               die("Invalid file type");
            }

            if (($info[0] == 320) || ($info[1] == 240)){
            
                     if($id==null)
                        {
                            $permiso_alert='ingresado';
                            $sql = "INSERT INTO mesproducto(nombre,imagen,fecha_inicio,fecha_fin,estado_mes) VALUES(?,?,?,?,0)";
                            $params = array($nombre,$Imagen,$fecha_inicio,$fecha_fin);
                            Database::executeRow($sql, $params);
                            ob_end_clean();
                                 
                             header("location: mesproducto.php");    
                        }
                        else
                        {
                            $sql = "UPDATE mesproducto SET nombre = ?, imagen = ?, fecha_inicio = ?, fecha_fin = ?, estado_mes = 0 WHERE Id_mes = ?";
                            $params = array($nombre,$Imagen,$fecha_inicio,$fecha_fin, $id);
                            Database::executeRow($sql, $params);
                            ob_end_clean();
                            header("location: mesproducto.php");
                        }
                       
                    }
                    else{

                    }
                
                
            
            
            
        }
        else
        {
            $permiso_alert = 'nombrevacio';
        }   
    }
    catch (Exception $error)
    {
        print("<div class='container-fluid titulo'>".$error->getMessage()."</div>");
    }
}
?>
<br>
<div class="panel-info col-md-6">
<div class='panel-heading'><b>PRODUCTO</b></div>
<div class='panel-body'>
<form method='post' class='row' enctype='multipart/form-data'>
<link href="../assets/css/sweetalert.css" rel="stylesheet">
    <div class='row'>
        <div class='col-md-12'>
          	<i class='glyphicon glyphicon-pencil col-md-1'></i>
            <?php echo $id; ?>
          	<input id='nombre' type='text' name='nombre' class='validate col-md-3' length='50' maxlenght='50' autocomplete="off" value='<?php print($nombre); ?>' />

          	<label for='nombre' class="unespacio">Nombre del mes</label>
        </div><br>
        <div class="col-md-12"> <br>
            <i class='glyphicon glyphicon-pencil col-md-1'></i>

            <input id='nombre' type='text' name='inicio' class='validate col-md-3' length='50' maxlenght='50' autocomplete="off" value='<?php print($fecha_inicio); ?>' />
            <label for='nombre' class="unespacio">Fecha de inicio (año/mes/dia)</label>
        </div><br>
        <div class="col-md-12"> <br>
            <i class='glyphicon glyphicon-pencil col-md-1'></i>
            <input id='nombre' type='text' name='fin' class='validate col-md-3' length='50' maxlenght='50' autocomplete="off" value='<?php print($fecha_fin); ?>' />
            <label for='nombre' class="unespacio">Fecha de fin (año/mes/dia)</label>
        </div>
        
             <div class="col-md-6">

            <br>
            <br>
                <label for="exampleInputFile">Seleccionar imagen (Imagen de  320 x 240</label>
                <i class='glyphicon glyphicon-picture col-md-3'></i>
                <br>
                <input type="file" name='foto' id="exampleInputFile" placeholder='1200x1200px máx., 2MB máx., PNG/JPG/GIF'>
              </div>

    </div>
<br><br>
    <div class="btnforms dosespacio">
    <button type='submit' class='btn btn-info colordebotonmodificar'><i class='glyphicon glyphicon-pencil'></i> Guardar</button>
    <a href='mesproducto.php' class='btn btn-danger colordebotoneliminar'><i class='glyphicon glyphicon-remove'></i> Cancelar</a>
    </div>
    <script src="../assets/js/sweetalert.min.js"></script>
    <?php include '../sweet.php'; ?>
</form>
</div>
<?php 
}else{
     header("location: error.php");
}
?>