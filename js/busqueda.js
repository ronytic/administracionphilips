$(document).ready(function(e) {
	//cuando se ejecuta se anulara la accion
	//siempre el return false al final y los 3
	//submit anulamos a todo el formulario
    $("#formulariobusqueda").submit(function(e) {
        e.preventDefault();
		e.stopPropagation();
		
		//var nombre=$("#nom").attr("name");
		var nombretexto=$("#nom").val();
		var citexto=$("#ci").val();
		$.post("buscarpersona.php",{"nombre":nombretexto,"ci":citexto},respuesta)
		
		return false;
    });
	function respuesta(data){
		$("#respuesta").html(data)	
	}
	//que contenedor que evento y la funcion del evento(accion a realizar)
	//on verifica  o busca todo el documento
	$("#respuesta").on("click",".anadir",function(e) {
			e.preventDefault();
			e.stopPropagation();
			//this para seleccionar el mismo al atributo rel
			var id=$(this).attr("rel");
			$("#respuesta").html("");
			$.post("anadirpersona.php",{"idpac":id},respuestaanadir)
			return false;
    });
	function respuestaanadir(data){
		//multiple
		//$("#seleccionados").html($("#seleccionados").html()+data);	
		//msolo uno
		$("#seleccionados").html(data);	
	}
	
	//no se puede utilizar porque el formulario ya lo randeriso o sea lo borro
	//entonces solo se puede utilizar para cuando solo tengamos el fomulario...ojo
	
});