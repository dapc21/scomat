<?php
listar_directorios_ruta("red/");
function listar_directorios_ruta($ruta){
   if (is_dir($ruta)) {
      if ($dh = opendir($ruta)) {
         while (($file = readdir($dh)) !== false) {
           if(filetype($ruta . $file)=="file"){
				echo "<br>$ruta$file";
				
			}
			
         }
      closedir($dh);
      }
   }else
      echo "<br>No es ruta valida";
}
?>