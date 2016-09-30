/*Se oculta el elemento de objetos en el carrito*/
 var elem = document.getElementById('barranueva');
    elem.style.visibility = 'hidden';

/*Redirecciona al formulario de compra*/
function getBuy(){
	 window.location.assign("compra.php");
}
$(document).ready(function() {
	
   rudeware.getView("../views/nav.php","rudenav");
});

/*Objeto que obtiene vistas con ajax*/
var rudeware={};
rudeware.getView = function(view,section) {
	$.post(
		view,
		{},
		function(data) {
			$("."+section).html(data);			
		}
	).fail(function(xhr) {
		alert("No se pudo establecer conexión con el servidor");
	})
}

/*Aparece objetos en el carrito y boton comprar*/
$('.btn-hola-carrito').click(function() {
    $(this).toggleClass("btn-hola-carrito-active");
    var elem = document.getElementById('barranueva');
    elem.style.visibility = 'visible';
    document.getElementById("boton1").innerHTML = "Objetos en el carrito - 1";
});

/*Cambia la cantidad de objetos en el carrito*/
$('.btn-hola-carrito2').click(function() {
    $(this).toggleClass("btn-hola-carrito2-active");
    document.getElementById("boton1").innerHTML = "Objetos en el carrito - 2";
});