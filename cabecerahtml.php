<?php
include_once 'class/usuarios.php';
$codusuario=$_SESSION['idusuario'];
$nivel=$_SESSION['nivel'];
$usuarios=new usuarios;
$us=$usuarios->mostrar($_SESSION['idusuario']);
$us=array_shift($us);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php php_start();?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="keywords" content="<?php php_start();?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo $titulo;?> | <?php echo $title?></title>
<link href="<?php echo $folder;?>css/bootstrap/bootstrap.min.css" type="text/css" rel="stylesheet" media="screen">
<link href="<?php echo $folder;?>css/tabcontent.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $folder;?>css/core.css" type="text/css" rel="stylesheet" media="screen">
<link href="<?php echo $folder;?>css/menu/styles.css" type="text/css" rel="stylesheet" media="screen">
<link href="<?php echo $folder;?>css/select2.css" type="text/css" rel="stylesheet">
<link rel="shortcut icon" type="image/x-icon" href="<?php echo $folder; ?>imagenes/favicon.ico" />
<script language="javascript" type="text/javascript" src="<?php echo $folder;?>js/jquery-1.12.4.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $folder;?>js/bootstrap/bootstrap.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $folder;?>js/tabcontent.js"></script> 
<script language="javascript" type="text/javascript" src="<?php echo $folder;?>js/jquery.form.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $folder;?>js/select2.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $folder;?>js/select2_locale_es.js"></script>

<script language="javascript" type="text/javascript" src="<?php echo $folder;?>js/busquedas/busquedas.js"></script>
<link href="<?php echo $folder;?>css/ui/jquery.ui.all.css" type="text/css" rel="stylesheet" media="screen">
<script src="<?php echo $folder;?>js/ui/jquery.ui.core.js" language="javascript"></script>
<script src="<?php echo $folder;?>js/ui/jquery.ui.datepicker.js" language="javascript"></script>
<script language="javascript">
$(document).ready(function(e) {
    $('input[type=date]').click(function(e){e.preventDefault();}).datepicker();
	$("select").css({'width':'100%'}).not(".nolista").select2({'placeholder':'Búsqueda no encontrada','loadMorePadding':0});	
});
</script>