<!-- INICIO DE LA SENTENCIA PHP-->
<?php
require("../pagina.php");
    require("../procesos/database.php");
    $consu = "SELECT * FROM permisos WHERE Id_cargo = ?";
     $par = array(@$_SESSION['cargo']);
     $permisos = Database::getRow($consu , $par);
     if($permisos['producto'] == 1)
     {


include("../procesos/functions.php");
require("../procesos/validator.php");
$permiso_alert = "";

if(empty($_GET['id'])) 
{
    Page::header("AGREGAR CATEGORIA"); //ENCABEZADO DE LA PAGINA AGREGAR
    $id = null;
    $nombre = null;
    $descripcion = null;
}
else
{
    Page::header("MODIFICAR CATEGORIA"); // ENCABEZADO DE LA PAGINA MODIFICAR
    $id = base64_decode($_GET['id']);
    $sql = "SELECT * FROM categorias WHERE id_categoria = ?"; // CONSULTA A LA TABLA CATEGORIAS
    $params = array($id);
    $data = Database::getRow($sql, $params); //SE MANDAN LOS PARAMETROS
    $nombre = $data['categoria'];
}

if(!empty($_POST))
{
    $_POST = Validator::validateForm($_POST);
  	$nombre = $_POST['nombre'];
       try 
    {
        if(trim($_POST['nombre'])!="")
        {
            if(funValidarLetra($_POST['nombre']))
            {
                $permiso_alert='nombreinvalido';
            } 
            else if($id == null)
            {
                $sql = "INSERT INTO categorias(categoria) VALUES(?)";
                $params = array($nombre);
                Database::executeRow($sql, $params);
                ob_end_clean();
                header("location: categorias.php");
            }
            else 
            {
                $sql = "UPDATE categorias SET categoria = ? WHERE Id_categoria = ?";
                $params = array($nombre, $id);
                Database::executeRow($sql, $params);
                ob_end_clean();
                header("location: categorias.php");
            }
        }
        else
        {
            $permiso_alert = 'nombrevacio';
        }      
    }
    catch (Exception $error) //EN CASO DE NO HABER NINGUNGA COINCIDENCIA , EL SIGUIENTE ERROR
    {
        print("<div class='container-fluid titulo'> <h3> ERROR </h3> </div>".$error->getMessage()."</div>");
    }
}
?>


<img src="../assets/logo1.png"  class="img-circle redireccionar">

  <link href='https://fonts.googleapis.com/css?family=Ropa+Sans' rel='stylesheet' type='text/css'>
  <link href="../assets/css/sweetalert.css" rel="stylesheet">

<!-- COMIENZO DE LA ESTRUCTURA DEL PANEL--> 

<br>
<br>
<div class="panel-info col-md-6">


    <div class='panel-heading '><b>CATEGORIA<b></div>
        <div class='panel-body'>
          	
            <form method='post' class='row' enctype='multipart/form-data'>
            <i class='glyphicon glyphicon-pencil col-md-1'></i>
          	<input autocomplete='off' id='nombre' type='text' name='nombre' class='validate col-md-6' length='50' maxlenght='50' value='<?php print($nombre); ?>' required/>

          
        </div>
         <div class="btnforms dosespacio">
    <button type='submit' class='btn btn-info colordebotonmodificar'><i class='glyphicon glyphicon-pencil'></i> Guardar</button>
    <a  href='categorias.php' class='btn btn-danger colordebotoneliminar'><i class='glyphicon glyphicon-remove'></i> Cancelar</a>

   <br>
<br>
    </div>
    </div>

   <script src="../assets/js/sweetalert.min.js"></script>
   <?php include '../sweet.php'; ?>
</form>
</div>
<!-- FIN DE LA ESCTRUCTURA DEL PANEL--> 


<?php
}else{
    header("location: error.php");
}
Page::footer();
?>


