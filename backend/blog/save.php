<?php
require("../pagina.php");
    require("../procesos/database.php");
    $consu = "SELECT * FROM permisos WHERE Id_cargo = ?";
     $par = array(@$_SESSION['cargo']);
     $permisos = Database::getRow($consu , $par);
     if($permisos['extra'] == 1)
     {
?>

<?php
include("../procesos/functions.php");
require("../procesos/validator.php");



$permiso_alert = "";
    
date_default_timezone_set('America/Guatemala');
$mensaje = "";

if(empty($_GET['id'])) 
{
    Page::header("AGREGAR UN ARTICULO DE BLOG");
    $id = null;
    $titulo = null;
    $cuerpo = null;
    $estado = null;
    $Imagen = null;
    
}
else
{
    Page::header("MODIFICAR ARTICULO DEL BLOG");
    $id = base64_decode($_GET['id']);
    $sql = "SELECT * FROM blogs WHERE Id_blog = ?";
    $params = array($id);
    $data = Database::getRow($sql, $params);
    $titulo = $data['titulo'];
    $cuerpo = $data['cuerpo'];
    $Imagen = $data['imagenBlog'];

}

if(!empty($_POST))
{
    $_POST = Validator::validateForm($_POST);
    $titulo = $_POST['titulo'];
    $cuerpo = $_POST['cuerpo'];
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


        if(trim($_POST['titulo'])!="")
        {
            if(funValidarLetra($_POST['titulo']))
            {
                $permiso_alert='nombreinvalido';
            }
                else if(trim($_POST['cuerpo'])!= "")
                {
                    if(funValidarLN($_POST['cuerpo']))
                    {
                        $permiso_alert='descripcioninvalida';
                          
                    }
                        else if($id==null)
                        {
                             $permiso_alert='ingresado';
                            $sql = "INSERT INTO blogs(titulo, cuerpo,imagenBlog) VALUES(?,?,?)";
                            $params = array($titulo,$cuerpo,$Imagen);
                            Database::executeRow($sql, $params);
                            ob_end_clean();
                                 
                             header("location: blog.php");    
                        }
                        else
                        {
                            $sql = "UPDATE blogs SET titulo = ?, cuerpo = ?, imagenBlog = ? ,estadoBlog = 1  WHERE Id_blog = ?";
                            $params = array($titulo, $cuerpo, $Imagen,$id);
                            Database::executeRow($sql, $params);
                            ob_end_clean();
                            header("location: blog.php");
                        }
                       
                    
                }
                else
                {
                    $permiso_alert = 'descripcionvacia';
                    
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
<div class='panel-heading'><b>ARTICULO DE BLOG</b></div>
<div class='panel-body'>
<form method='post' class='row' enctype='multipart/form-data'>
<link href="../assets/css/sweetalert.css" rel="stylesheet">
    <div class='row'>
        <div class='col-md-12'>
          	<i class='glyphicon glyphicon-pencil col-md-1'></i>
<?php echo $id; ?>
          	<input id='nombre' type='text' name='titulo' class='validate col-md-3' length='1000' maxlenght='100' autocomplete="off" value='<?php print($titulo); ?>' />
          	<label for='nombre' class="unespacio">Titulo del articulo</label>
        </div><br>
        <div class="col-md-12"> <br>
            <i class='glyphicon glyphicon-pencil col-md-1'></i>
            <textarea id='nombre' type='text' name='cuerpo' class='validate  col-md-3 estira' length='50' autocomplete="off" maxlenght='50' /><?php print($cuerpo); ?></textarea>
            <label for='nombre' class="unespacio">Cuerpo del articulo</label>
        </div><br>
        
      <div class="col-md-6">

            <br>
            <br>
                <label for="exampleInputFile">Seleccionar imagen</label>
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