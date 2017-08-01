<?php
  // read input stream
    $data = file_get_contents("php://input");
 
    // filtering and decoding code adapted from
        // http://stackoverflow.com/questions/11843115/uploading-canvas-context-as-image-using-ajax-and-php?lq=1
    // Filter out the headers (data:,) part.
    $filteredData=substr($data, strpos($data, ",")+1);
    // Need to decode before saving since the data we received is already base64 encoded
    $decodedData=base64_decode($filteredData);
 
    // store in server
    $ext = '.png';
    $code = 'grafico'.rand(1000,9999);
    $temporalPNG = $code.$ext;
    $fp = fopen($temporalPNG, 'wb');
	$ok = fwrite( $fp, $decodedData);	
    fclose( $fp );
	
	if($ok){
        echo trim($code);
	}
    else
        echo "ERROR: FALLA EN LA APERTURA DEL ARCHIVO";
?>