<?php
	require("../../backend/procesos/database.php");
	$sql = "DELETE FROM cotizaciones where Id_cotizacion = ?";
    $params = array(base64_decode($_GET['id']));
    Database::executeRow($sql, $params);
    header("location: rec.php?id");
?>