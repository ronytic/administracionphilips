$(document).ready(function(e) {
    $("#cargar").click(function(e) {
		e.preventDefault();
        var a=$("select[name=splantilla]").val();
		$.post("cargarplantilla.php",{id:a},function(data){alert(data);$("#plantilla").before(data)});
    });
});