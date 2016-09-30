<?php
	@session_start();

	function rev($red)
	{
		if($_SESSION['us'] == 1)
		{
			header("location: ../usu.php");
		}else{
			header("location:" .$red);
		}
	}
?>