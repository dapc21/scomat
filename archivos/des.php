<?php 
$file=$_GET['ruta'];
dl_files($file);
function dl_files($file){
//echo ":$file:";
	//$archi=$file;
	$archi=str_replace(" ",'_',$file);
  if (!is_file($file)) { die("<b>404 File not found!</b>"); }
  $len = filesize($file);
  $filename = basename($file);
  $file_extension = strtolower(substr(strrchr($filename,"."),1));
  $ctype="application/force-download";
  header("Pragma: public");
  header("Expires: 0");
  header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
  header("Cache-Control: public");
  header("Content-Description: File Transfer");
  header("Content-Type: $ctype");
  $header="Content-Disposition: attachment; filename=".$archi.";";
  header($header );
  header("Content-Transfer-Encoding: binary");
  header("Content-Length: ".$len);
  @readfile($file);
  exit;
  
}


?>
