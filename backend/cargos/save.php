<!-- COMIENZO DE LA SENTENCIA PHP--> 
<!-- ARCHIVOS REQUERIDOS PARA EL FUNCIONAMIENTO DEL CATALOGO--> 
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

    /*Fecha*/
    ini_set("date.timezone","America/El_Salvador");
    $fechaIngreso = date("Y/m/d");
    $horaIngreso = date("G:i:s");
    $valuando = 0;

if(empty($_GET['id'])) 
{
    Page::header("AGREGAR CARGO"); // ENCABEZADO DE LA PAGINA AGREGAR CARGO
    $id = null;
    $nombre = null;
    $descripcion = null;
}
else
{
    Page::header("MODIFICAR CARGO");  //ENCABEZADO LA  PAGINA MODIFICAR
    $id = base64_decode($_GET['id']);
    $sql = "SELECT * FROM cargos WHERE id_cargo = ?";
    $params = array($id);
    $data = Database::getRow($sql, $params);
    $nombre = $data['cargos'];
    //Agregar aqui parametros nuevos
}

if(!empty($_POST))
{
    $_POST = Validator::validateForm($_POST);
  	$nombre = $_POST['nombre'];
    //Agregar aqui parametros nuevos
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
                $valuando = 1;
                $sql = "INSERT INTO cargos(cargos) VALUES(?)"; // INSERTAR EN LA TABLA CARGOS
                $params = array($nombre);
                Database::executeRow($sql, $params);
                ob_end_clean();
                $s = "SELECT * from cargos where cargos = ?";
                $par = array($nombre);
                $dat = Database::getRows($s , $par); 
                foreach ($dat as $key) {
                    echo $key['cargos'];
                    $sl = "INSERT INTO permisos(Id_cargo , producto, personal, pedidos, cliente, extra ) VALUES(? , ? , ? , ? , ? , ?)"; // INSERTAR EN LA TABLA CARGOS
                    $ms = array($key['Id_cargo'] , 0 , 0 , 0 , 0 ,0);
                    Database::executeRow($sl, $ms);

                }
                header("location: cargos.php");
            }
            else
            {
                $valuando = 2;
                $sql = "UPDATE cargos SET cargos = ? WHERE Id_cargo = ?"; // ACTUALIZAR O MODIFICAR EN LA TABLA CARGOS DONDE EL ID SEA EL CORRESPONDIENTE
                $params = array($nombre, $id);
                Database::executeRow($sql, $params);
                ob_end_clean();
                header("location: cargos.php");
            }
        }
        else
        {
            $permiso_alert = 'nombrevacio';
        }
    }
    catch (Exception $error)
    {
        print("<div class='container-fluid titulo'> <h3> ERROR </h3> </div>".$error->getMessage()."</div>"); // EN CASO DE ERROR SE MOSTRARA ESTE MENSAJE
    }
}

if($valuando == 1){
      $usuariando = $_SESSION['Id_personal'];
      $bitacoriando = "CALL insertBitacora(3, 'Se agrego un cargo nuevo', ?, ?, ?)" ;
      $parametrando = array($usuariando, $fechaIngreso, $horaIngreso);
      Database::executeRow($bitacoriando, $parametrando);
}
else{
    if($valuando == 2){
        $usuariando = $_SESSION['Id_personal'];
        $bitacoriando = "CALL insertBitacora(4, 'Se modifico un cargo', ?, ?, ?)" ;
        $parametrando = array($usuariando, $fechaIngreso, $horaIngreso);
        Database::executeRow($bitacoriando, $parametrando);
    }
}
?>

<!-- FIN DE LA SENTENCIA PHP--> 

<!-- COMIENZO DE LA ESTRUCTURA DEL PANEL--> 
<link href="../assets/css/sweetalert.css" rel="stylesheet">
<br>
<br>
<br>
<div class=" panel-info col-md-6">
  <div class='panel-heading'><b>CARGO<b></div>
   <div class='panel-body'>

   <form method='post' class='row' enctype='multipart/form-data'>
    

    <!--Imput que se puede repetir, TENER CUIDADO! -->
    <div class='row'>
        <div class='col-md-12'>
          	<i class=' unespacio glyphicon glyphicon-pencil'></i>
          	<input id='nombre' type='text' name='nombre' class='validate' length='50' maxlenght='50' value='<?php print($nombre); ?>' autocomplete="off" required/>
          	<label for='cargos'></label>
                <div class="btnforms dosespacio">
                <br>

   
    <button type='submit' class='btn btn-info colordebotonmodificar'><i class='glyphicon glyphicon-pencil'></i> Guardar</button>
      <a href='cargos.php'  class='btn btn-danger colordebotoneliminar'><i class='glyphicon glyphicon-remove'></i> Cancelar</a>
        </div>
    </div>


    <!--Botones, no tocar -->
    <script src="../assets/js/sweetalert.min.js"></script>
    <?php include '../sweet.php'; ?>
    </div>
</form>
</div>
<!-- FIN DE LA ESTRUCTURA DEL PANEL--> 

<?php
}else{
    header("location: error.php");
}
Page::footer();
?>



<!--FIN DE LA SENTENCIA DE PHP--> 
