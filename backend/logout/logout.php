<?php
	require("../procesos/database.php");

	session_start();
    $id =  $_SESSION['Id_personal'];
    $sql = "UPDATE personal SET estado_sesion = 0 WHERE Id_personal = ?"; // ACTUALIZAMOS EN LA TABLA CLIENTES
	    $params = array($id);
	    Database::executeRow($sql, $params);
	     session_destroy();
	    ob_end_clean();	
	
	header("location: ../index.php");
?>