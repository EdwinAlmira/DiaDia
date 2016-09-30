
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

        /*Fecha*/
        ini_set("date.timezone","America/El_Salvador");
        $fechaIngreso = date("Y/m/d");
        $horaIngreso = date("G:i:s");
        $valuando = 0;

    if(empty($_GET['id'])) 
    {
        Page::header("AGREGAR PROYECTO "); // ENCABEZADO DE LA PAGINA AGREGAR IMAGEN
        $id = null;
        $Descripcion = null;
        $Imagen = null;
    }
    else
    {
        Page::header("MODIFICAR PROYECTO");
        $id = base64_decode($_GET['id']);
        $sql = "SELECT ImagenG, Descripcion FROM galerias WHERE Id_galeria = ?";
        $params = array($id);
        $data = Database::getRow($sql, $params);
        $Descripcion = $data['Descripcion'];
        $Imagen = $data['ImagenG'];


    }

    if(!empty($_POST))
    {      //aca estan los posts , tengo que crearlos luego abajo para que concuerden
        $_POST = Validator::validateForm($_POST);
        $Descripcion = $_POST['Descripcion'];
        $Archivo = $_FILES['ImagenG'];

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

    if ($_FILES['ImagenG']['error'] !== UPLOAD_ERR_OK) {
       die("File upload failed with error code {$_FILES['ImagenG']['error']}");
    }

    $info = getimagesize($_FILES['ImagenG']['tmp_name']);
    if ($info === FALSE) {
       die("Invalid file type");
    }

    if (($info[0] == 640) || ($info[1] == 480)){
            if($id == null)
            {
                $valuando = 1;
            	$sql = "INSERT INTO galerias(Descripcion , ImagenG) VALUES(?,?)";
                $params = array($Descripcion , $Imagen);
                $valuando = 1;
            }
            else
            {
                $valuando = 2;
                $sql = "UPDATE galerias SET Descripcion = ?, ImagenG = ? WHERE Id_galeria = ?";
                $params = array($Descripcion , $Imagen, $id);
                $valuando = 2;
            }
            Database::executeRow($sql, $params);
            ob_end_clean();
             header("location: galeria.php");
        }
        else{

             $permiso_alert = 'tamañoimg';

            }
        }
        catch (Exception $error)
        {
            print("<div class='container-fluid titulo'> <h3> ERROR </h3> </div>".$error->getMessage()."</div>");  // EN CASO DE ERROR , MOSTRAR EL SIGUIENTE MENSAJE
        }
    }
    if($valuando == 1){
          $usuariando = $_SESSION['Id_personal'];
          $bitacoriando = "CALL insertBitacora(3, 'Se agrego un nuevo proyecto a la galería', ?, ?, ?)" ;
          $parametrando = array($usuariando, $fechaIngreso, $horaIngreso);
          Database::executeRow($bitacoriando, $parametrando);
    }
    else{
        if($valuando == 2){
            $usuariando = $_SESSION['Id_personal'];
            $bitacoriando = "CALL insertBitacora(4, 'Se modifico un  proyecto de la galería', ?, ?, ?)" ;
            $parametrando = array($usuariando, $fechaIngreso, $horaIngreso);
            Database::executeRow($bitacoriando, $parametrando);
        }
    }
    ?>
    <br>
    <br>


    <div class="panel-info col-md-8">
    <div class='panel-heading'><b>GALERIAS<b></div>
     <div class='panel-body'>


    <form method='post' class='row' enctype='multipart/form-data'>
        <div class='row'>
            <div class='col-md-12'>
             
            <div class="col-md-12"> <br>
                <i class='glyphicon glyphicon-pencil col-md-1'></i>
                <textarea id='Descripcion' type='text' name='Descripcion' class='validate col-md-5 estira'  onKeyUp="maximo(this,140);" onKeyDown="maximo(this,140);" /><?php print($Descripcion); ?></textarea>
                <label for='nombre' class="unespacio">Descripción</label>
            </div>
            <br><br>

             <div class="col-md-6">

                <br>
                <br>
                    <label for="exampleInputFile">Seleccionar imagen</label>+
                    <label for="exampleInputFile">La Imagen tiene que ser de 640x480</label>
                    <i class='glyphicon glyphicon-picture col-md-3'></i>
                    <br>
                    <input type="file" name='ImagenG' id="exampleInputFile" placeholder='1200x1200px máx., 2MB máx., PNG/JPG/GIF'>
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
        <a href='galeria.php' class='btn btn-danger colordebotoneliminar'><i class='glyphicon glyphicon-remove'></i> Cancelar</a>
        </div>


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
