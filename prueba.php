<?php
$directorio="documentos/";	
$folder="";
echo archivo("holaasdasd asd ad asd asdasd.pdf");


function archivo($nombrearchivo){
	global $directorio,$folder;
	$datos=tipoarchivo($nombrearchivo);
	$rdato="";
	switch($datos){
		case 'pdf':{ ?> <a href="<?php echo $directorio.$nombrearchivo;?>"><img src="<?php echo $folder."imagenes/iconoarchivo/pdf.gif";?>" class="enlace"><?php echo substr($nombrearchivo,0,10);?></a><?php }break;
		case 'jpg':{ ?> <a href="<?php echo $directorio.$nombrearchivo;?>"><img src="<?php echo $folder."imagenes/iconoarchivo/image.gif";?>" class="enlace"><?php echo substr($nombrearchivo,0,10);?></a><?php }break;
		case 'doc':{ ?> <a href="<?php echo $directorio.$nombrearchivo;?>"><img src="<?php echo $folder."imagenes/iconoarchivo/doc.gif";?>" class="enlace"><?php echo substr($nombrearchivo,0,10);?></a><?php }break;
		case 'docx':{ ?> <a href="<?php echo $directorio.$nombrearchivo;?>"><img src="<?php echo $folder."imagenes/iconoarchivo/doc.gif";?>" class="enlace"><?php echo substr($nombrearchivo,0,10);?></a><?php }break;	
		default:{echo $nombrearchivo;}break;
	}
}
function tipoarchivo($nombrearchivo){
	$partearchivo=explode(".",$nombrearchivo);
	$tipoarchivo=end($partearchivo);
	return $tipoarchivo;
}
?>