<?php
include_once $folder.'cabecerahtml.php';
if($archivonuevo=="" && empty($archivonuevo)){
	$archivonuevo="nuevo.php";
}
if($archivovolver=="" && empty($archivovolver)){
	$archivovolver="modificar.php";
}
if($archivolistar=="" && empty($archivolistar)){
	$archivolistar="listar.php";
}

?>
<?php include_once $folder.'cabecera.php';?>
<div class="grid_12">
	<div class="contenido imagenfondo">
    	<div class="prefix_4 grid_4 alpha">
			<fieldset>
                <?php
                foreach($mensaje as $m){
					?>
                    <div class="titulo"><?php echo $m?></div>
                    <?php
						
				}
				?>
                <?php if(count($botones)){foreach($botones as $ba=>$bn){
				?><a href="<?php echo $ba;?>?id=<?php echo $id;?>" class="botoninfo" target="_blank" ><?php echo $bn?></a><?php
				}
				}?>
                <hr />
                <?php if($nuevo==0){?>
                <a href="<?php echo $archivonuevo;?>" class="botoncorrecto" >Nuevo Registro</a>
                <?php }?>
                <?php if($codinsercion!=""){?>
                <a href="<?php echo $archivovolver;?>?id=<?php echo $codinsercion;?>" class="botoninfo" >Modificar Registro Insertado</a>
                <?php }?>
                <?php if($listar==0){?>
                <a href="<?php echo $archivolistar;?>" class="botonalerta">Listar Registros</a>
                <?php }?>
         	</fieldset>
        </div>
        <div class="clear"></div>
    </div>
</div> 
<?php include_once($folder."piepagina.php")?>