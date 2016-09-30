<?php
require("../pagina.php");
    require("../procesos/database.php");
    $consu = "SELECT * FROM permisos WHERE Id_cargo = ?";
    $par = array(@$_SESSION['cargo']);
    $permisos = Database::getRow($consu , $par);
    if($permisos['producto'] == 1)
    {
//Cargamos los archvos necesarios
include("../procesos/functions.php");
require("../procesos/validator.php");
$permiso_alert = "";
//Seleccionamos la zona horaria
    /*Fecha*/
    ini_set("date.timezone","America/El_Salvador");
    $fechaIngreso = date("Y/m/d");
    $horaIngreso = date("G:i:s");
    $valuando = 0;
//Si esta vacio el id, declaramos las variables en null
if(empty($_GET['id'])) 
{
    Page::header("AGREGAR SUBCATEGORIA");
    $id = null;
    $nombre = null;
    $categoria = null;
}
else
    //Si no estan vacios, cargamos los campos
{
    Page::header("MODIFICAR SUBCATEGORIA");
    $id = base64_decode($_GET['id']);
    $sql = "SELECT * FROM subcategorias WHERE Id_subcategoria = ?";
    $params = array($id);
    $data = Database::getRow($sql, $params);
    $nombre = $data['subcategoria'];
    $categoria = $data['Id_categoria'];
}
//Empieza el proceso de insertar
if(!empty($_POST))
{
    $_POST = Validator::validateForm($_POST);
    $nombre = $_POST['subcategoria'];
    $categoria = $_POST['categoria'];
    try 
    {
        //Empieza el proceso de validacion, antes de insertar los datos a la base
        if(trim($_POST['subcategoria'])!="")
        {
            if(funValidarLetra($_POST['subcategoria']))
            {
                $permiso_alert='nombreinvalido';
            }
            else  if($id == null)
            {
                    $valuando = 1;
                $sql = "INSERT INTO subcategorias(subcategoria,Id_categoria) VALUES(?,?)";
                $params = array($nombre,$categoria);
                Database::executeRow($sql, $params);
                ob_end_clean();
                header("location: subcategoria.php");
            }
            else
            {
                    $valuando = 2;
                $sql = "UPDATE subcategorias SET subcategoria = ?, Id_categoria = ? WHERE Id_subcategoria = ?";
                $params = array($nombre,  $categoria, $id);
                Database::executeRow($sql, $params);
                ob_end_clean();
                header("location: subcategoria.php");
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


if($valuando == 1){
      $usuariando = $_SESSION['Id_personal'];
      $bitacoriando = "CALL insertBitacora(3, 'Se agrego una subcategoria nueva', ?, ?, ?)" ;
      $parametrando = array($usuariando, $fechaIngreso, $horaIngreso);
      Database::executeRow($bitacoriando, $parametrando);
}
else{
    if($valuando == 2){
        $usuariando = $_SESSION['Id_personal'];
        $bitacoriando = "CALL insertBitacora(4, 'Se modifico una subcategoria', ?, ?, ?)" ;
        $parametrando = array($usuariando, $fechaIngreso, $horaIngreso);
        Database::executeRow($bitacoriando, $parametrando);
    }
}

?>
<!--Diseño de la pagina-->
 <link href='https://fonts.googleapis.com/css?family=Ropa+Sans' rel='stylesheet' type='text/css'>
<br>
<br>
<br>
<br>
<div class="panel-info col-md-6">
<div class='panel-heading'><b>SUBCATEGORIA</b></div>
    <div class='panel-body'>
    <form method='post' class='row' enctype='multipart/form-data'>
        <div class='col-md-12'>
            <i class='glyphicon glyphicon-pencil col-md-1'></i>

            <input autocomplete='off' id='nombre' type='text' name='subcategoria' class='validate col-md-3' length='50' maxlenght='50' value='<?php print($nombre); ?>' required/>
            
        </div><br>
        <div class="col-md-12"> <br>
            <i class='glyphicon glyphicon-tags col-md-1'></i>
            <div class=''>
                <?php
                $sql = "SELECT Id_categoria, categoria FROM categorias";
                Page::setCombo("categoria", $categoria, $sql);
                ?>
            </div>
        </div>


    </div>
    <div class="btnforms dosespacio">
    <button type='submit' class='btn btn-info colordebotonmodificar'><i class='glyphicon glyphicon-pencil'></i> Guardar</button>
    <a href='subcategoria.php' class='btn btn-danger colordebotoneliminar'><i class='glyphicon glyphicon-remove'></i> Cancelar</a>

    </div>
    <br>
    <script src="../assets/js/sweetalert.min.js"></script>
    <?php include '../sweet.php'; ?>
</form>
</div>
<?php 
}else{
    header("location: error.php");
}
?>