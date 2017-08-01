<?php session_start();
require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];   
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('REIMP_ARCIVO')))
{
	session_start();
	$id_f = $_SESSION["id_franq"]; 
	$id_franq = $_SESSION["id_franq"]; 
	if($id_f!='0'){
			$consult=" and  id_franq='$id_f'";
			
		}
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<form role="form" name="f1" id="form_reporte_reimprimir archivo" >
	
	<div class="border-head"><h3>Reporte de Archivos Almacenados</h3></div>
	
	<section class="panel">
	
		<header class="panel-heading">Datos de los Archivos</header>
	
		<div class="panel-body">
	
<?php
	  
	  $acceso->objeto->ejecutarSql("SELECT id_franq,nombre_franq FROM franquicia WHERE id_franq<>'' $consult order by id_franq ");
		while($row=row($acceso)){
			$id_f=trim($row["id_franq"]);
			$nombre_franq=trim($row["nombre_franq"]);
			echo '<br><label>ARCHIVOS DE '.strtoupper($nombre_franq).'</label>';
	  $ruta="archivos\\$id_f\\";
   if (is_dir($ruta)) {
      if ($dh = opendir($ruta)) {
		$i=1;
         while (($file = readdir($dh)) !== false) {
			if(strstr($file,".pdf")){
				$ruta=str_replace("\\",'/',$ruta);
				echo "<br><a href='#' onclick='desc(\"$id_f/$file\")'>$file</a>";
            }
         }
      closedir($dh);
      }
   }else{
	  echo '<div class="alert alert-danger">
				<strong>No es ruta válida.</strong>
				</div>';
	}
	  
	  }//franq
	  
	  if($id_franq=='0'){
			echo '<br><label>ARCHIVOS GENERALES</label>';
			  $ruta="archivos\\general\\";
		   if (is_dir($ruta)) {
			  if ($dh = opendir($ruta)) {
				$i=1;
				 while (($file = readdir($dh)) !== false) {
					if(strstr($file,".pdf")){
						$ruta=str_replace("\\",'/',$ruta);
						echo "<br><a href='#' onclick='desc(\"general/$file\")'>$file</a>";
					}
				 }
			  closedir($dh);
			  }
		   }else{
			  echo '<div class="alert alert-danger">
				<strong>No es ruta válida.</strong>
				</div>';
			}
	  }
	  ?>
		
	</div> <!-- FIN DEL PANEL --> 

	</section>
	<section class="panel">
	
		<div class="panel-body">
		
		<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
			<button class="btn btn-info" type="button" name="salir" onclick="conexionPHP('formulario.php','reim_archivos')" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
			<input type="hidden" name="modificar" value="CANCELAR">
			<input type="hidden" name="eliminar" value="CANCELAR">
			<input type="hidden" name="Resetear" value="CANCELAR">
		</div>
		
		</div> <!-- FIN DEL PANEL --> 

	</section> <!-- FIN DEL ÁREA DE PANEL O PANELES -->

</form> <!-- FIN DEL FORMULARIO -->

</div> <!-- FIN DE LA COLUMNA GENERAL PARA EL FORMULARIO -->
<?php 
	}
	else{
		echo '<p align="center"><img   style="background:#FFFFFF" src="imagenes/Error.jpg" width="255px" height="255px" /></p><br>
		<div align="center">
					<input  type="button" name="iniciar_sesion" value="INICIAR SESI&Oacute;N" onclick="conexionPHP(\'formulario.php\',\'Sesion\')">&nbsp;
				</div>
		';
	}
?>