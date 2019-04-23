<?php
include_once $folder.'cabecerahtml.php';

    if(empty($archivonuevo)){
        $archivonuevo="nuevo.php";
    }

    if( empty($archivovolver)){
        $archivovolver="modificar.php";
    }

    if(empty($archivolistar)){
        $archivolistar="listar.php";
    }


?>
<?php include_once $folder.'cabecera.php';?>
<div class="col-lg-12">
	<div class="row imagenfondo">
    	<div class="col-lg-offset-4 col-lg-4 alpha">
			<fieldset>
                <?php
                foreach($mensaje as $m){
					?>
                    <div class="titulo"><?php echo $m?></div>
                    <?php

				}
				?>
                <?php if(isset($botones)){if(count($botones)){foreach($botones as $ba=>$bn){
				?><a href="<?php echo $ba;?>?id=<?php echo $id;?>" class="botoninfo" target="_blank" ><?php echo $bn?></a><?php
                }
                 }
				}?>
                <hr />
                <?php if(isset($nuevo)){if($nuevo==0){?>
                <a href="<?php echo $archivonuevo;?>" class="botoncorrecto" >Nuevo Registro</a>
                <?php }
                }?>
                <?php if(isset($codinsercion)){if($codinsercion!=""){?>
                <a href="<?php echo $archivovolver;?>?id=<?php echo $codinsercion;?>" class="botoninfo" >Modificar Registro Insertado</a>
                <?php }
                }?>
                <?php if(isset($listar)){if($listar==0){?>
                <a href="<?php echo $archivolistar;?>" class="botonalerta">Listar Registros</a>
                <?php }
                }?>
         	</fieldset>
        </div>
        <div class="clear"></div>
    </div>
</div>
<?php include_once($folder."piepagina.php")?>