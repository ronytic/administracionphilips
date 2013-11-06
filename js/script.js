$(document).ready(function(e) {
    $("#botonmostrar").toggle(function(e) {
     	$("#mensaje").show();
		//$("#mensaje").removeClass("oculto");   
    },function(){
		
		$("#mensaje").hide();	
	});
});