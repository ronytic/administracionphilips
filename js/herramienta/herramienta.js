$(document).ready(function(e) {
	$(document).on("change",".material",function(e) {
    	var l=$(this).attr('rel-linea');
		var c=($(this).val());
		//alert(l);
		var p=$("select.material[rel-linea="+l+"]>option:selected ").attr('rel-precio');
		//alert(p);
		$("input.precio[rel-linea="+l+"]").val(p);
	});  
	$(document).on("change",".cantidad",function(e){
		var c=$(this).val();
		var l=$(this).attr('rel-linea');
		var p=$("input.precio[rel-linea="+l+"]").val();
		var t=c*p;
		$("input.total[rel-linea="+l+"]").val(t);
		total();
	});
	$(document).on("click",".aumentar",function(e){
		e.preventDefault();
		var posi=$(this).parent().parent();
		$.post("aumentar.php",{'l':linea},function(data){
			posi.before(data);
			linea++;
		});
	})
});
function total(){
	var tt=0;
	$(".total").each(function(index, element) {
        var v=parseFloat($(this).val());
		//alert(v);
		tt=tt+v;
    });	
	$(".supertotal").val(tt)
}