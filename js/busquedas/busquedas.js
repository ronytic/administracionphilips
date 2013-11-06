$(document).ready(function(e){
	$("#busqueda").ajaxForm(function(data){
		resultado(data);
	});
	$("#respuesta").on("click",".eliminar",function(e){
		var direccion=$(this).attr("href");
		e.preventDefault();
		e.stopPropagation();
		if(confirm("¿Desea eliminar este Registro?")){
			$.post(direccion,function(){
				$("#busqueda").submit();	
			});
		}
		return false;
	});
	$("#respuesta").on("click",".modificar",function(e){
		//var direccion=$(this).attr("href");
		if(confirm("¿Desea modificar este Registro?")){
			return true;
		}else{
			return false;
		}
	});
	function resultado(data){
		$("#respuesta").html(data);
		$('html, body').animate({scrollTop:400}, 'slow');
		$(this).find("input").focus();
	}
});