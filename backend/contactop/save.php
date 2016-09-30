<!-- COMIENZO  DE LA SENTENCIA  PHP--> 
<!-- ARCHIVOS REQUERIDOS PARA EL FUNCIONAMIENTO DEL CATALOGO--> 
<?php
require("../pagina.php");
require("../procesos/database.php");
require("../procesos/validator.php");

if(empty($_GET['id'])) 
{
    Page::header("Agregar contacto personal"); // ENCABEZADO DE LA PAGINA CONTACTO PERSONAL
    $id = null;
    $idtcontacto = null;
    $contactop = null;
   
}
else
{
    Page::header("Modificar contacto personal");
    $id = $_GET['id'];
    $sql = "SELECT Id_contactoPersonal, contactopersonal.Id_tipoContacto, contactoPersonal, tipoContacto FROM contactopersonal, tipocontacto WHERE contactopersonal.Id_tipoContacto=tipocontacto.Id_tipoContacto and Id_contactoPersonal = ?";
    $params = array($id);
    $data = Database::getRow($sql, $params);
    $contacto = $data['Id_tipoContacto'];
    $contactop = $data['contactoPersonal'];   
}


if(!empty($_POST))
{
    $_POST = Validator::validateForm($_POST);
    $contacto = $_POST['contacto'];
    $contactop = $_POST['contactop'];
    try 
    {
      	if($contactop == "")                 //VALIACIONES BASICAS - CONSTATAMOS QUE LOS DATOS SEAN LOS CORRECTOS
        {
            throw new Exception("Llene el campo nombre.");
        }
        if($contacto == "")
        {
            throw new Exception("Llene el campo apellido.");
        }
        if($id == null)
        {
        	$sql = "INSERT INTO contactoPersonal(Id_tipoContacto, contactopersonal) VALUES(?,?)";
            $params = array($contacto, $contactop);
        }
        else
        {
            $sql = "UPDATE contactoPersonal SET Id_tipoContacto = ?, contactopersonal = ? WHERE Id_contactopersonal = ?";
            $params = array($contacto, $contactop, $id);
        }
        Database::executeRow($sql, $params);

        ob_end_clean();
        header("location: contactop.php");
    }
    catch (Exception $error)
    {
        print("<div class='container-fluid titulo'> <h3> ERROR </h3> </div>".$error->getMessage()."</div>");
    }
}

?>
<!-- CONSULTA A LA TABLA TIPO CONTACTO--> 
<div class="container-fluid">
<form method='post' class='row' enctype='multipart/form-data'>
    <div class='row'>
        <div class='col-md-12'>
          	<i class='glyphicon glyphicon-pencil col-md-1'></i>

          	<input id='nombre' type='text' name='contactop' class='validate col-md-3' length='50' maxlenght='50' value='<?php print($contactop); ?>' required/>
          	<label for='nombre' class="unespacio">Contacto</label>
        </div><br>
        <div class="col-md-12"> <br>
            <i class='glyphicon glyphicon-eye-open col-md-1'></i>
            <div class=''>
                <?php
                $sql = "SELECT Id_tipocontacto, tipocontacto FROM tipocontacto";
                Page::setCombo("contacto", (isset($contacto) ? $contacto : null), $sql);
                ?>
            </div>
        </div>

    </div>
    <div class="btnforms dosespacio">
    <a href='categorias.php' class='btn btn-danger'><i class='glyphicon glyphicon-remove '></i>Cancelar</a>
 	<button type='submit' class='btn btn-primary'><i class='glyphicon glyphicon-ok '></i>Guardar</button>
    </div>
</form>
</div>
<?php

//FIN DE LA SENTENCIA PHP
Page::footer();
?>
<!-- FOOTER DE LA CLASE PAGE--> 