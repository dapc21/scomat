<?php 
	//exec("C:/Archivos de programa/PostgreSQL/8.4/bin/respaldo.bat"); 
	//exec('C:\Archivos de programa\PostgreSQL\8.4\bin\respaldo.bat');
	//$test = 'C:\Archivos de programa\PostgreSQL\8.4\bin\respaldo.bat';
	$linea = system('C:\\Archivos de programa\\PostgreSQL\\8.4\\bin\\respaldo.bat');
	exec($linea);
echo $linea;

?>
