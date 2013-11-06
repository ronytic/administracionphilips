<?php
$datos=array();
foreach($_POST as $k=>$v){
	array_push($datos,$k."=".$v);
}

$datos=implode("&",$datos);
?>
<iframe src="ver.php?<?php echo $datos;?>" width="100%" height="800"></iframe>