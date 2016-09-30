<?php
	require("../../backend/procesos/database.php");
	$sql = "INSERT INTO calificaciones (calificacion , id_producto , id_cliente) VALUES (? , ? , ?)";
    $params = array($_POST['val'] , $_POST['pro'] , $_POST['cli']);
    Database::executeRow($sql, $params);
    header("location: prev.php?id=".base64_encode($_POST['pro'])."");
?>