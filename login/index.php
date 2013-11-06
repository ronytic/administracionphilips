<?php
include_once("../config.php");
include_once("../funciones/funciones.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php php_start();?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="<?php php_start();?>" />
<title>.::Acceso al Sistema | <?php echo $title;?>::.</title>
<link href="../css/960/960.css" type="text/css" rel="stylesheet" media="all" />
<link href="css/estilo.css" type="text/css" rel="stylesheet" media="all" />
<link rel="shortcut icon" href="../imagenes/favicon.ico" />
<script type="text/javascript" language="javascript" src="../js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="js/login.js"></script>
</head>
<body>
<div class="container_12">

    	<div class="prefix_4 grid_4">
        <div id="formLogin" class="corner-all">
        <div class="cuerpo">
   			<img src="../imagenes/logos/logo.jpg" width="250" />
			</div>
        	<div class="titulo">Acceso al sistema</div>
            <div class="cuerpo">
            	<?php
				if($_GET['incompleto']){
				?>
            	<div class="rojoC">INTRODUSCA TODOS los DATOS</div>
                <?php
				}
				if($_GET['error']){
				?>
            	<div class="naranjaC">LOS DATOS SON INCORRECTOS<br />verifique e intente nuevamente</div>
                <?php
				}
				?>
            	<form action="login.php" method="post" id="login">
               		<input type="hidden" name="u" value="<?php echo $_GET['u'];?>" />
                    <label for="usuario">Usuario</label>
                    <input type="text" name="usuario" id="usuario"/><br />
                    <label for="pass">Contraseña</label>
                    <input type="password" name="pass" id="pass"/><br />
                    <input type="submit" value="Ingresar" class="corner-all" style=""/>
                </form>
	        </div>
            </div>    
    	</div>
    	<div class="clear"></div>
       

</div>
</body>
</html>
<?php php_start();?>