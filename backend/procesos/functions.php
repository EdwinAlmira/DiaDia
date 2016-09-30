<?php
/**************************************************************************************************
Nombre del archivo: Funciones.php
Descripción: Este archivo contiene las diferentes funciones que se utilizaran en el portal Web.
Creador(es): Daniel Carranza
Fecha de creación: 24/10/2008			Fecha última de modificación: 02/01/2009
***************************************************************************************************/

/**************************************************************************************************
Nombre de la función: funVerificarCorreo
Descripción: Esta función tiene por objetivo comprobar que un e-mail sea valido.
Creador(es): Daniel Carranza
Parametros que recibe: 
			$varDireccion		String  que almacena el e-mail.
Parametro que envia:
			Ninguno
Fecha de creación: 24/10/2008			Fecha última de modificación: 24/10/2008
***************************************************************************************************/
function funValidarCorreo($varDireccion)
{
	if(ereg('^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$',$varDireccion))
	{
		return false;
	}
	else
	{
		return true;
	}
}

/**************************************************************************************************
Nombre de la función: funVerificarDireccionWeb
Descripción: Esta función tiene por objetivo comprobar que una direccion Web sea valida.
Creador(es): Daniel Carranza
Parametros que recibe: 
			$varDireccion		String  que almacena el e-mail.
Parametro que envia:
			Ninguno
Fecha de creación: 24/10/2008			Fecha última de modificación: 24/10/2008
***************************************************************************************************/
function funValidarDireccionWeb($varDireccion)
{
	if(ereg('^http://+[a-zA-Z0-9_\-]+\.[a-zA-Z0-9_\-\.]+$',$varDireccion))
	{
		return false;
	}
	else
	{
		return true;
	}
}

/**************************************************************************************************
Nombre de la función: funPaginacion
Descripción:: Esta función tiene por objetivo estructurar los registros por paginas para facilitar la navegacin.
Creador(es): Daniel Carranza
Parametros que recibe: 
			$varLimite		Entero que almacena el valor del limite utilizado en el SELECT.
Parametro que envia:
			$varEnlaces		Retorna los vinculos a las paginas dadas por la consulta.
Fecha de creación: 24/10/2008			Fecha última de modificación: 24/10/2008
***************************************************************************************************/
$varLimite = 10;
function funPaginacion()
{
	global $varLimite;
	$varSQL = "SELECT FOUND_ROWS()";
	$varResultado = mysql_query($varSQL) or die (mysql_error());
	$varFila = mysql_fetch_array($varResultado);
	$varNumeroRegistros = $varFila[0];
	$varEnlaces = "<div align='center'>";
	$varEnlaces .= "<p class='Mensaje'>NUMERO DE REGISTROS: $varNumeroRegistros</p>";
	if($varNumeroRegistros > $varLimite)
	{
		if(isset($_GET['Pagina']))
		{
			$varPagina = $_GET['Pagina'];
		}
		else
		{
			$varPagina = 1;
		}
		$varPaginaActual = $_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING'];
		$varPaginaActual = str_replace("&Pagina=".$varPagina,"",$varPaginaActual);
		
		if($varPagina != 1)
		{
			$varPaginaAnterior = $varPagina - 1;
			$varEnlaces .= "<a href='".$varPaginaActual."&Pagina=".$varPaginaAnterior."'><img src='../images/anterior.png' alt='Anterior' border='0' align='absmiddle'></a>";
		}
		
		$varNumeroPaginas = ceil($varNumeroRegistros / $varLimite);
		if($varRango == "" or $varRango == 0) 
		{
			$varRango = 10;
		}
		$varRangoIzquierdo = max(1,$varPagina - (($varRango - 1) / 2));
		$varRangoDerecho = min($varNumeroPaginas,$varPagina + (($varRango - 1) / 2));
		if(($varRangoDerecho - $varRangoIzquierdo) < ($varRango - 1))
		{
			if($varRangoIzquierdo == 1)
			{
				$varRangoDerecho = min($varRangoIzquierdo + ($varRango - 1),$varNumeroPaginas);
			}
			else
			{
				$varRangoIzquierdo = max($varRangoDerecho - ($varRango - 1),0);
			}
		}
		if($varRangoIzquierdo > 1)
		{
			$varEnlaces .= "<strong>&nbsp;...</strong>";
		}
		for($varIndice = 1; $varIndice <= $varNumeroPaginas; $varIndice++)
		{
			if($varIndice == $varPagina)
			{
				$varEnlaces .= "<strong>$varIndice</strong>";
			}
			else
			{
				if($varRangoIzquierdo <= $varIndice and $varIndice <= $varRangoDerecho)
				{
					$varEnlaces .= "&nbsp;<a href='".$varPaginaActual."&Pagina=".$varIndice."'>".$varIndice."</a>&nbsp;";
				}
			}
		}
		if($varRangoDerecho < $varNumeroPaginas)
		{
			$varEnlaces .= "<strong>...&nbsp;</strong>";
		}		
		if(($varNumeroRegistros - ($varLimite * $varPagina)) > 0)
		{
			$varPaginaSiguiente = $varPagina + 1;
			$varEnlaces .= "<a href='".$varPaginaActual."&Pagina=".$varPaginaSiguiente."'><img src='../images/siguiente.png' alt='Siguiente' border='0' align='absmiddle'></a>";
		}
	}
	$varEnlaces .= "</div>";
	return $varEnlaces;
}

/**************************************************************************************************
Nombre de la función: funValidarTelefono
Descripción:: Esta función tiene por objetivo comprobar que el telefono introducido es valido.
Creador(es): Daniel Carranza
Parametros que recibe: 
			$varTelefono		String que almacena el telefono.
Parametro que envia:
			Ninguno
Fecha de creación: 24/10/2008			Fecha última de modificación: 24/10/2008
***************************************************************************************************/
function funValidarTelefono($varTelefono)
{
	if(ereg("^[[:space:]0-9\(\)\-]+$",$varTelefono))
	{
		return false;
	}
	else
	{
		return true;
	}
}
/**************************************************************************************************
Nombre de la función: funValidarDinero
Descripción:: Esta función tiene por objetivo comprobar si una variable contiene un valor de precio tipo entero positivo.
Creador(es): Guillermo Moraes
Parametros que recibe: 
			$varDinero		String que almacena el numero a evaluar.
Parametro que envia:
			Ninguno
Fecha de creación: 24/10/2008			Fecha última de modificación: 24/10/2008
***************************************************************************************************/
function funValidarDinero($varDinero)
{
	if(ereg("^[0-9$]+$",$varDinero))
	{
		return false;
	}
	else
	{
		return true;
	}
}
/**************************************************************************************************
Nombre de la función: funValidarNumero
Descripción:: Esta función tiene por objetivo comprobar si una variable contiene un valor numerico tipo entero positivo.
Creador(es): Daniel Carranza
Parametros que recibe: 
			$varNumero		String que almacena el numero a evaluar.
Parametro que envia:
			Ninguno
Fecha de creación: 24/10/2008			Fecha última de modificación: 24/10/2008
***************************************************************************************************/
function funValidarNumero($varNumero)
{
	if(ereg("^[0-9.]+$",$varNumero))
	{
		return false;
	}
	else
	{
		return true;
	}
}
/**************************************************************************************************
Nombre de la función: funValidarTallas
Descripción:: Esta función tiene por objetivo comprobar si una variable contiene un valor de solo letras y números.
Creador(es): Guillermo Morales 
Parametros que recibe: 
			$varLN		String que almacenan las letras a evaluar.
Parametro que envia:
			Ninguno
Fecha de creación: 03/05/2016			Fecha última de modificación: 03/05/2016
***************************************************************************************************/
function funValidarTallas($varTallas)
{
	if(ereg("^[xsXSsSmMlL]+$",$varTallas))
	{
		return false;
	}
	else
	{
		return true;
	}
}
/**************************************************************************************************
Nombre de la función: funValidarDuda
Descripción:: Esta función tiene por objetivo comprobar si una variable contiene un valor de solo letras y números.
Creador(es): Guillermo Morales 
Parametros que recibe: 
			$varLN		String que almacenan las letras a evaluar.
Parametro que envia:
			Ninguno
Fecha de creación: 28/08/2016			Fecha última de modificación: 28/08/2016
***************************************************************************************************/
function funValidarDuda($varDuda)
{
	if(ereg("^[[:space:]a-zñÑA-Z¿?0-9]+$",$varDuda))
	{
		return false;
	}
	else
	{
		return true;
	}
}
/**************************************************************************************************
Nombre de la función: funValidarLN
Descripción:: Esta función tiene por objetivo comprobar si una variable contiene un valor de solo letras y números.
Creador(es): Guillermo Morales 
Parametros que recibe: 
			$varLN		String que almacenan las letras a evaluar.
Parametro que envia:
			Ninguno
Fecha de creación: 03/05/2016			Fecha última de modificación: 03/05/2016
***************************************************************************************************/
function funValidarPregunta($varPregunta)
{
	if(ereg("^[[:space:]a-zA-Z¿?]+$",$varPregunta))
	{
		return false;
	}
	else
	{
		return true;
	}
}
/**************************************************************************************************
Nombre de la función: funValidarLN
Descripción:: Esta función tiene por objetivo comprobar si una variable contiene un valor de solo letras y números.
Creador(es): Guillermo Morales 
Parametros que recibe: 
			$varLN		String que almacenan las letras a evaluar.
Parametro que envia:
			Ninguno
Fecha de creación: 03/05/2016			Fecha última de modificación: 03/05/2016
***************************************************************************************************/
function funValidarLN($varLN)
{
	if(ereg("^[[:space:]a-zA-Zñ0-9.]+$",$varLN))
	{
		return false;
	}
	else
	{
		return true;
	}
}
/**************************************************************************************************
Nombre de la función: funValidarLetra
Descripción:: Esta función tiene por objetivo comprobar si una variable contiene un valor de solo letras.
Creador(es): Guillermo Morales 
Parametros que recibe: 
			$varLetra		String que almacenan las letras a evaluar.
Parametro que envia:
			Ninguno
Fecha de creación: 03/05/2016			Fecha última de modificación: 03/05/2016
***************************************************************************************************/
function funValidarLetra($varLetra)
{
	if(ereg("^[[:space:]a-zA-Z.]+$",$varLetra))
	{
		return false;
	}
	else
	{
		return true;
	}
}
/**************************************************************************************************
Nombre de la función: funAsignarFecha
Descripción: Esta función tiene por objetivo validar y formatear una fecha.
Creador(es): Daniel Carranza
Parametros que recibe: 
			$varDia		Entero que almacena el dia.
			$varMes		Entero que almacena el mes.
			$varAnio		Entero que almacena el ao.
Parametro que envia:
			$varFecha		String que almacena la fecha.
Fecha de creación: 24/10/2008			Fecha última de modificación: 24/10/2008
***************************************************************************************************/
function funAsignarFecha($varDia,$varMes,$varAnio)
{
	if(!empty($varDia) && !empty($varMes) && !empty($varAnio))
	{
		if(checkdate($varMes,$varDia,$varAnio))
		{
			$varFecha = $varAnio."-".$varMes."-".$varDia;
		}
		else
		{
			throw new Exception("La fecha no es valida.");
		}
	}
	else
	{
		$varFecha = "0000-00-00";
	}
	return $varFecha;
}

/**************************************************************************************************
Nombre de la función: funSubirImagen
Descripción: Esta función tiene por objetivo subir una imagen en el servidor.
Creador(es): Daniel Carranza
Parametros que recibe: 
			$varTemporal	Array que almacena los datos de la imagen.
			$varDirectorio	String que almacena el directorio donde se almacenara la imagen.
			$varAncho		Entero que almacena el ancho máximo de la imagen (pxeles).
			$varBytes		Entero que almacena el tamaño máximo de la imagen (bytes).
Parametro que envia:
			$varURL		String que almacena la URL de la imagen.
Fecha de creación: 24/10/2008			Fecha última de modificación: 24/10/2008
***************************************************************************************************/
function funSubirImagen($varTemporal,$varDirectorio,$varAncho,$varBytes)
{
	$varError = "";
	if(is_uploaded_file($varTemporal['tmp_name']))
	{
		if($varTemporal['size'] <= $varBytes)
		{
			$varNombre = rtrim($varTemporal['name']);
			$varNombre = strtolower($varNombre);
			$varExtension = substr($varNombre,-4);
			$varArchivo = time().$varExtension;
			if(ereg(".jpg",$varArchivo) || ereg(".png",$varArchivo))
			{
				$varURL = $varDirectorio.$varArchivo;
				if(move_uploaded_file($varTemporal['tmp_name'],$varURL))
				{
					$varImagen = getimagesize($varURL);
					if($varImagen[0] <= $varAncho)
					{
						chmod($varURL,0644);
					}
					else
					{
						@unlink($varURL);
						$varError = "La imagen $varTemporal[name] debe poseer un ancho menor a $varAncho p&iacute;xeles.";
						$varURL = "";
					}
				}
				else
				{
					$varError = "No es posible subir la imagen $varTemporal[name].";
					$varURL = "";
				}
			}
			else
			{
				$varError = "La imagen $varTemporal[name] no posee un formato valido.";
				$varURL = "";
			}
		}
		else
		{
			$varError = "La imagen $varTemporal[name] sobrepasa el tama&ntilde;o de $varBytes bytes.";
			$varURL = "";
		}
	}
	else
	{
		$varURL = "";
	}
	if($varError != "")
	{
		echo "<div class='Mensaje'><img src='../images/advertencia.png' border='0' align='absmiddle'>&nbsp;$varError</div>";
	}
	return $varURL;
}

/**************************************************************************************************
Nombre de la función: funCambiarImagen
Descripción: Esta función tiene por objetivo cambiar una imagen almacenada en el servidor.
Creador(es): Daniel Carranza
Parametros que recibe: 
			$varTemporal		Array que almacena los datos de la imagen.
			$varDirectorio		String que almacena el directorio donde se almacenara la imagen.
			$varActual			String que almacena la URL de la imagen actual.
			$varAncho			Entero que almacena el ancho mximo de la imagen (pxeles).
			$varBytes			Entero que almanena el tamao mximo de la imagen (bytes).
Parametro que envia:
			$varURL			String que almacena la URL de la imagen.
Fecha de creación: 24/10/2008			Fecha última de modificación: 24/10/2008
***************************************************************************************************/
function funCambiarImagen($varTemporal,$varActual,$varDirectorio,$varAncho,$varBytes)
{
	$varError = "";
	if(is_uploaded_file($varTemporal['tmp_name']))
	{
		if($varTemporal['size'] <= $varBytes)
		{
			$varNombre = rtrim($varTemporal['name']);
			$varNombre = strtolower($varNombre);
			$varExtension = substr($varNombre,-4);
			$varArchivo = time().$varExtension;
			if(ereg(".jpg",$varArchivo) || ereg(".png",$varArchivo))
			{
				$varURL = $varDirectorio.$varArchivo;
				if(move_uploaded_file($varTemporal['tmp_name'],$varURL))
				{
					$varImagen = getimagesize($varURL);
					if ($varImagen[0] <= $varAncho)
					{
						@unlink($varActual);
						chmod($varURL,0644);
					}
					else
					{
						@unlink($varURL);
						$varError = "La imagen $varTemporal[name] debe poseer un ancho menor a $ancho p&iacute;xeles.";
						$varURL = $varActual;
					}
				}
				else
				{
					$varError = "No es posible subir la imagen $varTemporal[name].";
					$varURL = $varActual;
				}
			}
			else
			{
				$varError = "La imagen $varTemporal[name] no posee un formato valido.";
				$varURL = $varActual;
			}
		}
		else
		{
			$varError = "La imagen $varTemporal[name] sobrepasa el tama&ntilde;o de $bytes bytes.";
			$varURL = $varActual;
		}
	}
	else
	{
		$varURL = $varActual;
	}
	if($varError != "")
	{
		echo "<div class='Mensaje'><img src='../images/advertencia.png' border='0' align='absmiddle'>&nbsp;$varError</div>";
	}
	return $varURL;
}

/**************************************************************************************************
Nombre de la función: funValidarFormulario
Descripción: Esta función tiene por objetivo validar los campos de los formularios.
Creador(es): Daniel Carranza
Parametros que recibe: 
			$varFormulario		Array que almacena el conjunto de campos del formulario.
Parametro que envia:
			$varFormulario		Array que almacena los campos validados del formulario.
Fecha de creación: 24/10/2008			Fecha última de modificación: 24/10/2008
***************************************************************************************************/
function funValidarFormulario($varFormulario)
{
	foreach($varFormulario as $varIndice => $varValor)
	{
		$varValor = htmlentities($varValor,ENT_QUOTES);
		$varValor = stripslashes($varValor);
		$varValor = trim($varValor);
		$varFormulario[$varIndice] = $varValor;
	}
	return $varFormulario;
}

/**************************************************************************************************
Nombre de la función: funMostrarGenero
Descripción: Esta función tiene por objetivo mostrar el genero en los formularios de agregar.
Creador(es): Daniel Carranza
Parametros que recibe: 
			Ninguno
Parametro que envia:
			Ninguno
Fecha de creación: 24/10/2008			Fecha última de modificación: 24/10/2008
***************************************************************************************************/
function funMostrarGenero()
{
	echo "<select name='Genero' size='1' style='width:205px;'>";
	if(!isset($_POST['Genero']) || $_POST['Genero'] == "")
	{
		echo "<option value='' SELECTED></option>\n";
		echo "<option value='M'>Masculino</option>\n";
		echo "<option value='F'>Femenino</option>\n";
	}
	if(isset($_POST['Genero']) && $_POST['Genero'] == "M")
	{
		echo "<option value='M' SELECTED>Masculino</option>\n";
		echo "<option value='F'>Femenino</option>\n";
	}
	if(isset($_POST['Genero']) && $_POST['Genero'] == "F")
	{
		echo "<option value='F' SELECTED>Femenino</option>\n";
		echo "<option value='M'>Masculino</option>\n";
	}
	echo "</select>";
}

/**************************************************************************************************
Nombre de la función: funCambiarGenero
Descripción: Esta función tiene por objetivo mostrar el genero en los formularios de modificar.
Creador(es): Daniel Carranza
Parametros que recibe: 
			$varGenero		String que almacena el genero.
Parametro que envia:
			Ninguno
Fecha de creación: 24/10/2008			Fecha última de modificación: 24/10/2008
***************************************************************************************************/
function funCambiarGenero($varGenero)
{
	echo "<select name='Genero' size='1' style='width:205px;'>";
	if($varGenero == "M")
	{
		echo "<option value='M' SELECTED>Masculino</option>\n";
		echo "<option value='F'>Femenino</option>\n";
	}
	if($varGenero == "F")
	{
		echo "<option value='F' SELECTED>Femenino</option>\n";
		echo "<option value='M'>Masculino</option>\n";
	}
	echo "</select>";
}

/**************************************************************************************************
Nombre de la función: funMostrarFecha
Descripción: Esta función tiene por objetivo mostrar los campos de fecha en los formularios de agregar.
Creador(es): Daniel Carranza
Parametros que recibe: 
			$varDia			String que almacena el nombre del indice para el dia.
			$varMes			String que almacena el nombre del indice para el mes.
			$varAnio		String que almacena el nombre del indice para el ao.
Parametro que envia:
			Ninguno
Fecha de creación: 24/10/2008			Fecha última de modificación: 24/10/2008
***************************************************************************************************/
function funMostrarFecha($varDia,$varMes,$varAnio)
{
	echo "<select name='$varDia' size='1'>";
	if(!isset($_POST[$varDia]) || $_POST[$varDia] == "")
	{
		echo "<option value='' SELECTED>DD</option>\n";
	}
	for($varIndice=1; $varIndice<=31; $varIndice++)
	{
		$varIndice = sprintf("%02d",$varIndice);
		if(isset($_POST[$varDia]) && $varIndice == $_POST[$varDia])
		{
			$varSeleccionado = " SELECTED";
		}
		else
		{
			$varSeleccionado = "";
		}	
		echo "<option value='$varIndice'.$varSeleccionado>$varIndice</option>\n";
	}
	echo "</select>";
	
	echo "<select name='$varMes' size='1'>";
	if(!isset($_POST[$varMes]) || $_POST[$varMes] == "")
	{
		echo "<option value='' SELECTED>MM</option>\n";
	}
	for($varIndice=1; $varIndice<=12; $varIndice++)
	{
		$varIndice = sprintf("%02d",$varIndice);
		if(isset($_POST[$varMes]) && $varIndice == $_POST[$varMes])
		{
			$varSeleccionado = " SELECTED";
		}
		else
		{
			$varSeleccionado = "";
		}
		echo "<option value='$varIndice'.$varSeleccionado>$varIndice</option>\n";
	}
	echo "</select>";
	
	echo "<select name='$varAnio' size='1'>";
	if(!isset($_POST[$varAnio]) || $_POST[$varAnio] == "")
	{
		echo "<option value='' SELECTED>AAAA</option>\n";
	}
	for($varIndice=(date("Y")+1); $varIndice>=(date("Y")-50); $varIndice--)
	{
		if(isset($_POST[$varAnio]) && $varIndice == $_POST[$varAnio])
		{
			$varSeleccionado = " SELECTED";
		}
		else
		{
			$varSeleccionado = "";
		}
		echo "<option value='$varIndice'.$varSeleccionado>$varIndice</option>\n";
	}
	echo "</select>";
}

/**************************************************************************************************
Nombre de la función: funCambiarFecha
Descripción: Esta función tiene por objetivo mostrar los campos de fecha en los formularios de modificar.
Creador(es): Daniel Carranza
Parametros que recibe: 
			$varDia		String que almacena el nombre del indice para el dia.
			$varMes		String que almacena el nombre del indice para el mes.
			$varAnio		String que almacena el nombre del indice para el año.
			$varFecha		Array que almacena los elementos de la fecha.
Parametro que envia:
			Ninguno
Fecha de creación: 24/10/2008			Fecha última de modificación: 24/10/2008
***************************************************************************************************/
function funCambiarFecha($varDia,$varMes,$varAnio,$varFecha)
{
	$varFecha = explode("-",$varFecha);
	echo "<select name='$varDia' size='1'>";
	if($varFecha[2] == "00")
	{
		echo "<option value='' SELECTED>DD</option>";
	}
	for($varIndice=1; $varIndice<=31; $varIndice++)
	{
		$varIndice = sprintf("%02d",$varIndice);
		if($varIndice == $varFecha[2])
		{
			$varSeleccionado = " SELECTED";
		}
		else
		{
			$varSeleccionado = "";
		}
		echo "<option value='$varIndice'.$varSeleccionado>$varIndice</option>\n";
	}
	echo "</select>";

	echo "<select name='$varMes' size='1'>";
	if ($varFecha[1] == "00")
	{
		echo "<option value='' SELECTED>MM</option>";
	}
	for($varIndice=1; $varIndice<=12; $varIndice++)
	{
		$varIndice = sprintf("%02d",$varIndice);
		if ($varIndice == $varFecha[1])
		{
			$varSeleccionado = " SELECTED";
		}
		else
		{
			$varSeleccionado = "";
		}
		echo "<option value='$varIndice'.$varSeleccionado>$varIndice</option>\n";
	}
	echo "</select>";
	
	echo "<select name='$varAnio' size='1'>";
	if ($varFecha[0] == "0000")
	{
		echo "<option value='' SELECTED>AAAA</option>";
	}
	for($varIndice=(date("Y")+1); $varIndice>=(date("Y")-50); $varIndice--)
	{
		if ($varIndice == $varFecha[0])
		{
			$varSeleccionado = " SELECTED";
		}
		else
		{
			$varSeleccionado = "";
		}
		echo "<option value='$varIndice'.$varSeleccionado>$varIndice</option>\n";
	}
	echo "</select>";
}

/**************************************************************************************************
Nombre de la función: funMostrarSiNo
Descripción: Esta función tiene por objetivo mostrar un campo de seleccion de Si o No en los formularios de agregar.
Creador(es): Daniel Carranza
Parametros que recibe: 
			$varIndicen			String que almacena el nombre del indice para el campo.
Parametro que envia:
			Ninguno
Fecha de creación: 24/10/2008			Fecha última de modificación: 24/10/2008
***************************************************************************************************/
function funMostrarSiNo($varIndice)
{
	echo "<select name='$varIndice' size='1'>";
	if(!isset($_POST[$varIndice]) || $_POST[$varIndice] == "")
	{
		echo "<option value='' SELECTED>---</option>\n";
		echo "<option value='SI'>SI</option>\n";
		echo "<option value='NO'>NO</option>\n";
	}
	if(isset($_POST[$varIndice]) && $_POST[$varIndice] == "SI")
	{
		echo "<option value='SI' SELECTED>SI</option>\n";
		echo "<option value='NO'>NO</option>\n";
	}
	if(isset($_POST[$varIndice]) && $_POST[$varIndice] == "NO")
	{
		echo "<option value='NO' SELECTED>NO</option>\n";
		echo "<option value='SI'>SI</option>\n";
	}
	echo "</select>";
}

/**************************************************************************************************
Nombre de la función: funCambiarSiNo
Descripción: Esta función tiene por objetivo mostrar un campo de seleccion de Si o No en los formularios de modificar.
Creador(es): Daniel Carranza
Parametros que recibe: 
			$varIndice		String que almacena el nombre del indice para el campo.
			$varOpcion	String que almacena el valor "Si" o "No".
Parametro que envia:
			Ninguno
Fecha de creación: 24/10/2008			Fecha última de modificación: 24/10/2008
***************************************************************************************************/
function funCambiarSiNo($varIndice,$varOpcion)
{
	echo "<select name='$varIndice' size='1'>";
	if($varOpcion == "SI")
	{
		echo "<option value='SI' SELECTED>SI</option>\n";
		echo "<option value='NO'>NO</option>\n";
	}
	if($varOpcion == "NO")
	{
		echo "<option value='NO' SELECTED>NO</option>\n";
		echo "<option value='SI'>SI</option>\n";
	}
	echo "</select>";
}

/**************************************************************************************************
Nombre de la función: funImagenMiniatura
Descripción: Esta función tiene por objetivo mostrar las imagenes en miniatura.
Creador(es): Daniel Carranza
Parametros que recibe: 
			$varImagen		String que almacena la URL de la imagen.
Parametro que envia:
			$atributo		String que almacena el ancho y alto de la imagen.
Fecha de creación: 24/10/2008			Fecha última de modificación: 24/10/2008
***************************************************************************************************/
function funImagenMiniatura($varImagen)
{
	$atributos = @getimagesize($varImagen);
	if($atributos[0] > $atributos[1])
	{
		$atributos[3] = "width='100' height='75'";
	}
	else
	{
		$atributos[3] = "width='100' height='125'";
	}
	if($atributos[0] == $atributos[1])
	{
		$atributos[3] = "width='100' height='100'";
	}
	return $atributos;
}

/**************************************************************************************************
Nombre de la función: funCrearGraficoBarras
Descripción: Esta función tiene por objetivo crear graficos de barras horizontales.
Creador(es): Daniel Carranza, Nilson Núñez
Parametros que recibe:
			$nombre			String que almacena el nombre del grafico. 
			$etiquetas			Array que almacena los nombres de las etiquetas del grafico.
			$valores			Array que almacena los valores para cada etiqueta del grafico.
Parametro que envia:
			Ninguno
Fecha de creación: 24/10/2008			Fecha última de modificación: 24/10/2008
***************************************************************************************************/
function funCrearGraficoBarras($nombre,$etiquetas,$valores)
{
	$colores = array(
	'../Componentes/Archivos/Colores/128_0_64.png',
	'../Componentes/Archivos/Colores/64_128_128.png',
	'../Componentes/Archivos/Colores/128_128_0.png',
	'../Componentes/Archivos/Colores/128_128_255.png',
	'../Componentes/Archivos/Colores/255_255_128.png',
	'../Componentes/Archivos/Colores/128_255_128.png',
	'../Componentes/Archivos/Colores/128_255_255.png',
	'../Componentes/Archivos/Colores/0_128_255.png',
	'../Componentes/Archivos/Colores/255_0_0.png',
	'../Componentes/Archivos/Colores/255_0_255.png',
	'../Componentes/Archivos/Colores/128_64_64.png',
	'../Componentes/Archivos/Colores/255_128_64.png',
	'../Componentes/Archivos/Colores/0_128_128.png',	
	'../Componentes/Archivos/Colores/255_128_128.png');
	$total = array_sum($valores);
	if($total >= 2 && count($etiquetas) >= 2)
	{
		$anchomaximo = 600;
	}
	else
	{
		$anchomaximo = 300;
	}
	echo "<div class='SubtituloPagina'>$nombre</div>";
	echo "<table align='center' style='border:solid 1px #0000FF;margin-top:10px;margin-bottom:10px;'>";
		echo "<tr class='NombreCampo' align='center' bgcolor='#CCCCCC'>";
			echo "<td width='200'>PARAMETRO</td>";
			echo "<td width='100'>CANTIDAD</td>";
		echo "</tr>";
	foreach($etiquetas as $varIndicendice => $valor)
	{
		echo "<tr class='ValorCampo' align='center'>";
			echo "<td>$valor</td>";
			echo "<td>$valores[$varIndicendice]</td>";
		echo "</tr>";
	}
	echo "</table>";

	echo "<table align='center' border='0'>";
	foreach($etiquetas as $varIndicendice => $valor)
	{
		$varIndicemagen = $colores[$varIndicendice];
		$ancho = round(($valores[$varIndicendice] * $anchomaximo) / $total, 0);
		$porcentaje = round(($valores[$varIndicendice] * 100) / $total, 2);
		echo "<tr class='ValorCampo'>";
			echo "<td>$valor</td>";
			echo "<td><img src='$varIndicemagen' width='$ancho' height='20' align='absmiddle'> $porcentaje%</td>";
		echo "</tr>";
	}
	echo "</table>";
}
?>