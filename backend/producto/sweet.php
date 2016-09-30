<link href="../assets/css/sweetalert.css" rel="stylesheet">
<script src="../assets/js/sweetalert.min.js"></script>
<?php 
            if($permiso_alert =='captcha'){
                echo "<script>swal('ERROR ','No dejes el captcha vacío','error');</script>";
            }
            if($permiso_alert=='nombrevacio')
            {
                  echo "<script>swal('ERROR ','No dejes los nombres vacíos','error');</script>";
            }
            if($permiso_alert=='descripcionvacia')
            {
            	echo "<script>swal('ERROR ','No dejes la descrición vacía','error');</script>";
            }
            if($permiso_alert=='minidescripcionvacia')
            {
                  echo "<script>swal('ERROR ','No dejes la mini descripción vacía','error');</script>";
            }
            if($permiso_alert=='apellidovacio')
            {
            	echo "<script>swal('ERROR ','No dejes los apellidos vacíos','error');</script>";
            }
            if($permiso_alert=='preciovacio')
            {
                  echo "<script>swal('ERROR ','No dejes el precio vacío','error');</script>";
            }
			if($permiso_alert=='correovacio')
            {
            	echo "<script>swal('ERROR ','No dejes el correo vacío','error');</script>";
            }
            if($permiso_alert=='aliasvacio')
            {
            	echo "<script>swal('ERROR ','No dejes el alias','error');</script>";
            }
            if($permiso_alert=='clave')
            {
            	echo "<script>swal('ERROR ','Error en las claves, no las dejes vacías y haz que coincidan','error');</script>";
            }
            if($permiso_alert=='clave1')
            {
                  echo "<script>swal('ERROR ','La clave debe de tener entr 6 y 16 caracteres, almenos una letra mayuscula y minuscula y un número','error');</script>";
            }
            if($permiso_alert=='correoinvalido')
            {
            	echo "<script>swal('ERROR ','Correo no válido','error');</script>";
            }
            if($permiso_alert=='aliasinvalido')
            {
            	echo "<script>swal('ERROR ','alias no válido. Utilice solo letras y números','error');</script>";
            }
            if($permiso_alert=='apellidoinvalido')
            {
            	echo "<script>swal('ERROR ','Apellidos no válidos.Utilice solo letras','error');</script>";
            }
            if($permiso_alert=='nombreinvalido')
            {
            	echo "<script>swal('ERROR ','Nombres no válidos.Utilice solo letras','error');</script>";
            }
            if($permiso_alert=='minidescripcioninvalida')
            {
                  echo "<script>swal('ERROR ','Mini descripción no válida.Utilice solo letras y números','error');</script>";
            }
            if($permiso_alert=='precioinvalido')
            {
                  echo "<script>swal('ERROR ','Precio no válido.Utilice solo números','error');</script>";
            }
            if($permiso_alert=='descripcioninvalida')
            {
                  echo "<script>swal('ERROR ','Descripción no válida.Utilice solo letras y números','error');</script>";
            }
            if($permiso_alert=='registrado')
            {
            	echo "<script>swal('BIENVENIDO ','Has sido registrado','success');</script>";
            }
            if($permiso_alert=='backendclave')
            {
                  echo "<script>swal('ERROR ','La contraseña ingresada es incorrecta','error');</script>";
            }
            if($permiso_alert=='backendusuario')
            {
                  echo "<script>swal('ERROR ','El usuario ingresado es incorrecto','error');</script>";
            }
            if($permiso_alert=='backendambos')
            {
                  echo "<script>swal('ERROR ','Debe ingresar un usuario y contraseña válidos','error');</script>";
            }
            if($permiso_alert=='tamañoimg')
            {
                  echo "<script>swal('ERROR ','Debe ingresar una del tamaño asignado','error');</script>";
            }
?>
