<?php
require("../pagina.php");
    require("../procesos/database.php");
    $consu = "SELECT * FROM permisos WHERE Id_cargo = ?";
     $par = array(@$_SESSION['cargo']);
     $permisos = Database::getRow($consu , $par);
     if($permisos['producto'] == 1)
     {
?>

<?php
include("../procesos/functions.php");
require("../procesos/validator.php");

    /*Fecha*/
    ini_set("date.timezone","America/El_Salvador");
    $fechaIngreso = date("Y/m/d");
    $horaIngreso = date("G:i:s");
    $valuando = 0;

$permiso_alert = "";
    

$mensaje = "";

if(empty($_GET['id'])) 
{
    Page::header("AGREGAR PRODUCTO");
    $id = null;
    $nombre = null;
    $miniDescrip = null;
    $descripcion = null;
    $precio = null;
    $subcategoria = null;
    $fechaIngreso = null;
    $horaIngreso = null;
}
else
{
    Page::header("MODIFICAR PRODUCTO");
    $id = base64_decode($_GET['id']);
    $sql = "SELECT * FROM productos WHERE Id_producto = ?";
    $params = array($id);
    $data = Database::getRow($sql, $params);
    $nombre = $data['nombreProdu'];
    $miniDescrip = $data['miniDescrip'];
    $descripcion = $data['descripcion'];
    $precio = $data['precio'];
    $subcategoria = $data['Id_subcategoria'];
    $fechaIngreso = date("Y/m/d");
    $horaIngreso = date("G:i:s");
    $Imagen = $data['imagen'];

}

if(!empty($_POST))
{
    $_POST = Validator::validateForm($_POST);
    $nombre = $_POST['nombreProdu'];
    $miniDescrip = $_POST['minidescripcion'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $subcategoria = $_POST['subcategoria'];
    $fechaIngreso = date("Y/m/d");
    $horaIngreso = date("G:i:s");
    $Archivo = $_FILES['foto'];
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



if ($_FILES['foto']['error'] !== UPLOAD_ERR_OK) {
   die("File upload failed with error code {$_FILES['foto']['error']}");
}

$info = getimagesize($_FILES['foto']['tmp_name']);
if ($info === FALSE) {
   die("Invalid file type");
}

if (($info[0] == 800) || ($info[1] == 600)){
        
    

        if(trim($_POST['nombreProdu'])!="")
        {
            if(funValidarLetra($_POST['nombreProdu']))
            {
                $permiso_alert='nombreinvalido';
            }
            else if(trim($_POST['minidescripcion'])!='')
            {
                if(funValidarLN($_POST['minidescripcion']))
                {
                  $permiso_alert='minidescripcioninvalida';
                     
                }
                else if(trim($_POST['descripcion'])!= "")
                {
                    if(funValidarLN($_POST['descripcion']))
                    {
                        $permiso_alert='descripcioninvalida';
                          
                    }
                    else if(trim($_POST['precio'])!= "")
                    {
                        if(funValidarNumero($_POST['precio']))
                        {
                            $permiso_alert='precioinvalido';
                              
                        }
                        else if($id==null)
                        {
                             $permiso_alert='ingresado';
                            $sql = "INSERT INTO productos(nombreProdu, miniDescrip,descripcion,precio,Id_subcategoria, estadoProducto,fechaIngreso,horaIngreso,imagen) VALUES(?,?,?,?,?,1,?,?,?)";
                            $params = array($nombre,$miniDescrip,$descripcion,$precio,$subcategoria,$fechaIngreso,$horaIngreso,$Imagen);
                            Database::executeRow($sql, $params);
                            ob_end_clean();
                                 
                             header("location: productos.php");    
                             $valuando = 1;
                        }
                        else
                        {
                            $sql = "UPDATE productos SET nombreProdu = ?, miniDescrip = ?, descripcion = ?, precio = ?, Id_subcategoria = ?, estadoProducto = 1, fechaIngreso = ?, horaIngreso = ?, imagen = ? WHERE Id_producto = ?";
                            $params = array($nombre, $miniDescrip, $descripcion, $precio, $subcategoria,$fechaIngreso,$horaIngreso, $Imagen,  $id);
                            Database::executeRow($sql, $params);
                            ob_end_clean();
                            header("location: productos.php");
                            $valuando = 2;
                        }
                       
                    }
                    else
                    {
                         $permiso_alert = 'preciovacio';
                          
                    }
                }
                else
                {
                    $permiso_alert = 'descripcionvacia';
                    
                }
            }
            else
            {
                $permiso_alert = 'minidescripcionvacia';
            } 
            
        }
        else
        {
            $permiso_alert = 'nombrevacio';
        }  

    }
    else{

         $permiso_alert = 'tamañoimg';

    }

    }
    catch (Exception $error)
    {
        print("<div class='container-fluid titulo'>".$error->getMessage()."</div>");
    }
}

if($valuando == 1){
      $usuariando = $_SESSION['Id_personal'];
      $bitacoriando = "CALL insertBitacora(3, 'Se agrego un producto nuevo', ?, ?, ?)" ;
      $parametrando = array($usuariando, $fechaIngreso, $horaIngreso);
      Database::executeRow($bitacoriando, $parametrando);
}
else{
    if($valuando == 2){
        $usuariando = $_SESSION['Id_personal'];
        $bitacoriando = "CALL insertBitacora(4, 'Se modifico un producto', ?, ?, ?)" ;
        $parametrando = array($usuariando, $fechaIngreso, $horaIngreso);
        Database::executeRow($bitacoriando, $parametrando);
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
          	<input id='nombre' type='text' name='nombreProdu' class='validate col-md-3' length='50' maxlenght='50' autocomplete="off" value='<?php print($nombre); ?>' />
          	<label for='nombre' class="unespacio">Nombre Producto</label>
        </div><br>
        <div class="col-md-12"> <br>
            <i class='glyphicon glyphicon-pencil col-md-1'></i>
            <textarea id='nombre' type='text' name='minidescripcion' placeholder='Mini Descripción' class='validate  col-md-3 estira' length='50' autocomplete="off" maxlenght='50' /><?php print($miniDescrip); ?></textarea>
        </div><br>
        <div class="col-md-12"> <br>
            <i class='glyphicon glyphicon-pencil col-md-1'></i>
            <textarea id='nombre' type='text' name='descripcion' class='validate col-md-3 estira' placeholder="Descripción" length='50' autocomplete="off" maxlenght='50' /><?php print($descripcion); ?></textarea>
        </div>
        <div class="col-md-12"> <br>
            <i class='glyphicon glyphicon-usd col-md-1'></i>
            <input id='nombre' type='text' name='precio' class='validate col-md-3 ' length='50' maxlenght='50' autocomplete="off" value='<?php print($precio); ?>' />
            <label for='nombre' class="unespacio">Precio</label>
        </div>
        <div class="col-md-12"> <br>
            <i class='glyphicon glyphicon-tags col-md-1'></i>
            <div class=''>
                <?php
                $sql = "SELECT Id_subcategoria, subcategoria FROM subcategorias";
                Page::setCombo("subcategoria", $subcategoria, $sql);
                ?>
            </div>
        </div>
      <div class="col-md-6">

            <br>
            <br>
                <label for="exampleInputFile">Seleccionar imagen. (Imagenes solamenete de 800 x 600) </label>
                <i class='glyphicon glyphicon-picture col-md-3'></i>
                <br>
                <input type="file" name='foto' id="exampleInputFile" placeholder='1200x1200px máx., 2MB máx., PNG/JPG/GIF'>
              </div>

    </div>
<br><br>
    <div class="btnforms dosespacio">
    <button type='submit' class='btn btn-info colordebotonmodificar'><i class='glyphicon glyphicon-pencil'></i> Guardar</button>
    <a href='productos.php' class='btn btn-danger colordebotoneliminar'><i class='glyphicon glyphicon-remove'></i> Cancelar</a>
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