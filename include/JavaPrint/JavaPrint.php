<?php

class JavaPrint
{
var $orientacion;
var $anchoPag;
var $altoPag;
var $formatoFuentes;
var $fuente;
var $formatoEstilos;
var $estilo;
var $formatoPaginas;
var $formato;
var $cuadroDialogo;
var $unidad;
var $formatoTamano;
var $tamano;
var $x;
var $y;
var $addprint;
var $w;
var $h;
var $page;
var $saltarPag;
var $piepag;
var $colorBorde;
var $colorRelleno;
var $colorTexto;
var $cw;
var $pie;
//var $unid;

function JavaPrint($orientacion='P', $unit='mm', $format='Carta')
{
	$this->cuadroDialogo="false";
	//Standard fonts
	$this->formatoFuentes=array('courier'=>'Courier', 'helvetica'=>'Helvetica', 'arial'=>'Helvetica','times'=>'Times');
	$this->formatoEstilos=array('b'=>'B', 'i'=>'I', 'bi'=>'BI', ''=>'');
	$this->formatotamano=array('5'=>'5', '6'=>'6', '7'=>'7', '8'=>'8', '9'=>'9', '10'=>'10', '11'=>'11', '12'=>'12', '13'=>'13', '14'=>'14', '15'=>'15', '16'=>'16', '17'=>'17', '18'=>'18', '19'=>'19', '20'=>'20');
	$this->estilo="";
	$this->fuente = 'Helvetica';
	$this->tamano = '8';
	$this->w=0;
	$this->h=0;
	$this->addprint="";
	$this->page=1;
	$this->saltarPag=0;
	$this->colorBorde="0,0,0";
	$this->colorRelleno="0,0,0";
	$this->colorTexto="0,0,0";
	$this->pie=false;
	//Scale factor
	
	
		
	//Page format
	$this->formatoPaginas=array('mediacarta'=>array(612,386.8),'carta'=>array(612,792),'factura'=>array(612.28,396),'m_letter'=>array(612,396),'a3'=>array(841.89,1190.55), 'ae'=>array(160,130),'a4'=>array(595.28,841.89), 'a5'=>array(420.94,595.28), 'legal'=>array(612,1008));
	//$this->setUnidad('pt');
	$this->setFormato($format);
	
	
	$this->setUnidad($unit);
	
	$this->setOrientacion($orientacion);
	
	$this->x=10;
	$this->y=10;
}

function setDialogo($cuadroDialogo){
	$this->cuadroDialogo=$cuadroDialogo;
}

function setOrientacion($orientacion){
	$orientacion=strtolower($orientacion);
	if($orientacion=='p' || $orientacion=='portrait')
	{
		$this->orientacion="P";
		
	}
	elseif($orientacion=='l' || $orientacion=='landscape')
	{
		$this->orientacion="L";
	}
	else{
		$this->Error('Incorrect orientacion: '.$orientacion);
		$this->orientacion="P";
	}
}
function setUnidad($unit='mm'){
	if($unit=='pt')
		$this->unidad=1;
	elseif($unit=='mm')
		$this->unidad=72/25.4;
	elseif($unit=='cm')
		$this->unidad=72/2.54;
	elseif($unit=='in')
		$this->unidad=72;
	else{
		$this->Error('Incorrect unit: '.$unit);
		$this->unidad=72/25.4;
	}
}
function setFormato($formato)
{
	$formato=strtolower($formato);
	$a=$this->formatoPaginas[$formato];
	if(!isset($this->formatoPaginas[$formato])){
		$this->Error('No esta definido el formato: '.$formato);
		$a=$this->formatoPaginas['carta'];
	}
	$this->anchoPag = $a[0]; 
	$this->altoPag = $a[1]; 
	$this->piepag=$this->altoPag;
}
function setFuente($fuente)
{
	$fuente=strtolower($fuente);
	if(!isset($this->formatoFuentes[$fuente])){
		$this->Error('No esta definida la fuente: '.$fuente);
		$this->fuente= $this->formatoFuentes['arial'];
	}
	else{
		$this->fuente=$this->formatoFuentes[$fuente];
	}
}
function setEstilo($estilo)
{
	$estilo=strtolower($estilo);
	if(!isset($this->formatoEstilos[$estilo])){
		$this->Error('No esta definido el estilo: '.$estilo);
		$this->estilo=$this->formatoEstilos[''];
	}
	else{
		$this->estilo=$this->formatoEstilos[$estilo];
	}
	
}
function setTamano($tam)
{
/*
	//$tam=strtolower($tam);
	if(!isset($this->formatoTamano[$tam])){
		$this->Error('El tamanio no esta definic: '.$tam);
		$this->tamano=$this->formatoTamano['8'];
	}
	else{
	*/
		$this->tamano=$tam;
//	}
	
}

function SetAutoPageBreak($auto, $margin=0)
{
	if($margin!=0){
		$this->saltarPag=$margin*$this->unidad;;
	}
	if($auto==true){
		$this->piepag=$this->altoPag - $this->saltarPag;
	}
}
function saltoPag(){
	
	if($this->y >= $this->piepag){
			$x=$this->x;
			$fuente=$this->fuente;
			$estilo=$this->estilo;
			$tamano=$this->tamano;
			$colorTexto=$this->colorTexto;
			$colorBorde=$this->colorBorde;
			$colorRelleno=$this->colorRelleno;
			
			$this->AddPage();
			
			$this->x=$x;
			$this->fuente=$fuente;
			$this->estilo=$estilo;
			$this->tamano=$tamano;
			$this->colorTexto=$colorTexto;
			$this->colorBorde=$colorBorde;
			$this->colorRelleno=$colorRelleno;
	}
}

function Error($msg)
{
	//Fatal error
//	die('<b>Java error:</b> '.$msg);
}

function AddPage($orientation='', $format='')
{
	if($orientation!=''){
		$this->setOrientacion($orientation);
	}
	if( $format!=''){
		$this->setFormato($format);
	}
	$this->SetY(10);
	$this->SetX(10);
	$this->addprint.="-Page-$this->orientacion=@$this->anchoPag=@$this->altoPag=@$this->cuadroDialogo-Param-";
	
	$this->pie=true;
	$this->Footer();
	$this->pie=false;
	$this->header();
	
	
	
	$this->page++;
}
function PageNo()
{
	//Get current page number
	return $this->page;
}

function SetFont($family, $style='', $size=8)
{
	global $fpdf_charwidths;
	$this->setFuente($family);
	$this->setEstilo($style);
	$this->setTamano($size);
	$fontkey=strtolower($this->fuente).strtoupper($this->estilo);
	include("font/$fontkey.php");
	
	$this->cw=$fpdf_charwidths[$fontkey];
	//echo ":".$this->cw['a'].":";
	
}
function anchoCaracter($cad){
	$tam=0;
	for($i=0;$i<strlen($cad);$i++){
		$tam+=$this->cw[$cad[$i]];
	}
	return $tam*$this->tamano/1000;
	
}

function GetX()
{
	return $this->x;
}
function SetX($x)
{
	//Set x position
	if($x>=0)
		$this->x=$x*$this->unidad;
	else
		$this->x=0;
		
	$this->x=number_format($this->x, 2, '.', '');
}
function SetH($h)
{
		$this->h=$h*$this->unidad;
}
function GetY()
{
	return $this->y;
}
function SetY($y)
{
	
	if($y>0)
		$this->y=$y*$this->unidad;
	else if($y<0){
		$mul=Abs($y)*$this->unidad;
		/*$total=$this->piepag+$mul;
		$this->y=$total;
		*/
		$res=$this->altoPag - $mul;
		
		//echo ":".$this->altoPag.":$mul:";
		//echo "<br>:".$res.":";
		$this->y=$res;
	}
	else
		$this->y=0;
		
	$this->y=number_format($this->y, 2, '.', '');
}
function SetXY($x,$y)
{
	$this->SetY($y);
	$this->SetX($x);
}
function Cell($w, $h=0, $txt='', $border='0', $ln=0, $align='', $fill=false, $link='')
{
	if($this->pie==false){
		$this->saltoPag();
	}
	$this->w=$w*$this->unidad;
	$this->h=$h*$this->unidad;
	
	
	if($align=='R'){
		$dx=($this->w-$this->anchoCaracter($txt))+$this->x;
	}
	elseif($align=='C'){
		$dx=(($this->w-$this->anchoCaracter($txt))/2)+$this->x;
	}
	else
		$dx=$this->x;
		
	
	if($fill!='0'){
		$x=$this->x;
		$k=$this->tamano/2;
		$y=$this->y - $this->h + $k;
		
		$x=number_format($x, 0, '', '');
		$y=number_format($y, 0, '', '');
		$w=number_format($this->w, 0, '', '');
		$h=number_format($this->h, 0, '', '');
		$this->addprint.="$this->colorRelleno=@$x=@$y=@$w=@$h=@=@relleno-Class-";
		
	}
	
	if($border!='0'){
		$x=$this->x;
		$k=$this->tamano/2;
		$y=$this->y - $this->h + $k;
		
		$x=number_format($x, 0, '', '');
		$y=number_format($y, 0, '', '');
		$w=number_format($this->w, 0, '', '');
		$h=number_format($this->h, 0, '', '');
		if($border=='1'){
			$this->addprint.="$this->colorBorde=@$x=@$y=@$w=@$h=@=@borde-Class-";
		}
		else{
			for($i=0;$i<strlen($border);$i++){
				$bor=$border[$i];
				if($bor=='L'){
					$x1=$x;
					$y1=$y;
					$x2=$x;
					$y2=$y+$h;
					$this->addprint.="$this->colorBorde=@$x1=@$y1=@$x2=@$y2=@=@linea-Class-";
				}
				else if($bor=='R'){
					$x1=$x+$w;
					$y1=$y;
					$x2=$x1;
					$y2=$y+$h;
					$this->addprint.="$this->colorBorde=@$x1=@$y1=@$x2=@$y2=@=@linea-Class-";
				}
				else if($bor=='T'){
					$x1=$x;
					$y1=$y;
					$x2=$x+$w;
					$y2=$y;
					$this->addprint.="$this->colorBorde=@$x1=@$y1=@$x2=@$y2=@=@linea-Class-";
				}
				else if($bor=='B'){
					$x1=$x;
					$y1=$y+$h;
					$x2=$x+$w;
					$y2=$y1;
					$this->addprint.="$this->colorBorde=@$x1=@$y1=@$x2=@$y2=@=@linea-Class-";
				}
			}
		}
	}
	$txt=utf8_encode($txt);
	$this->addprint.="$txt=@$dx=@$this->y=@$this->fuente=@$this->estilo=@$this->tamano=@$this->colorTexto-Class-";
	//if($border)
	
	
	$this->x+=$this->w;
	
	
	
	
	
	
}
function CellViejo($w, $h=0, $txt='', $border='0', $ln=0, $align='', $fill=false, $link='')
{
	$this->saltoPag();
	$this->w=$w*$this->unidad;
	$this->h=$h*$this->unidad;
	
	
	if($align=='R'){
		$dx=($this->w-$this->anchoCaracter($txt))+$this->x;
	}
	elseif($align=='C'){
		$dx=(($this->w-$this->anchoCaracter($txt))/2)+$this->x;
	}
	else
		$dx=$this->x;
		
	
	if($fill!='0'){
		$x=$this->x-2;
		$k=$this->tamano/2;
		$y=$this->y - $this->h + $k;
		
		$x=number_format($x, 0, '', '');
		$y=number_format($y, 0, '', '');
		$w=number_format($this->w+4, 0, '', '');
		$h=number_format($this->h, 0, '', '');
		$this->addprint.="$this->colorRelleno=@$x=@$y=@$w=@$h=@=@relleno-Class-";
		
	}
	
	if($border!='0'){
		$x=$this->x-2;
		$k=$this->tamano/2;
		$y=$this->y - $this->h + $k;
		
		$x=number_format($x, 0, '', '');
		$y=number_format($y, 0, '', '');
		$w=number_format($this->w+4, 0, '', '');
		$h=number_format($this->h, 0, '', '');
		if($border=='1'){
			$this->addprint.="$this->colorBorde=@$x=@$y=@$w=@$h=@=@borde-Class-";
		}
		else{
			for($i=0;$i<strlen($border);$i++){
				$bor=$border[$i];
				if($bor=='L'){
					$x1=$x;
					$y1=$y;
					$x2=$x;
					$y2=$y+$h;
					$this->addprint.="$this->colorBorde=@$x1=@$y1=@$x2=@$y2=@=@linea-Class-";
				}
				else if($bor=='R'){
					$x1=$x+$w;
					$y1=$y;
					$x2=$x1;
					$y2=$y+$h;
					$this->addprint.="$this->colorBorde=@$x1=@$y1=@$x2=@$y2=@=@linea-Class-";
				}
				else if($bor=='T'){
					$x1=$x;
					$y1=$y;
					$x2=$x+$w;
					$y2=$y;
					$this->addprint.="$this->colorBorde=@$x1=@$y1=@$x2=@$y2=@=@linea-Class-";
				}
				else if($bor=='B'){
					$x1=$x;
					$y1=$y+$h;
					$x2=$x+$w;
					$y2=$y1;
					$this->addprint.="$this->colorBorde=@$x1=@$y1=@$x2=@$y2=@=@linea-Class-";
				}
			}
		}
	}
	$txt=utf8_encode($txt);
	$this->addprint.="$txt=@$dx=@$this->y=@$this->fuente=@$this->estilo=@$this->tamano=@$this->colorTexto-Class-";
	//if($border)
	
	
	$this->x+=$this->w;
	
	
	
	
	
	
}

function MultiCell($w, $h, $txt, $border=0, $align='J', $fill=false)
{
	$xx=$this->x;
	$cad = explode("\n",$txt);
	//echo ":".count($cad).":";
	for($i=0;$i<count($cad);$i++){
		$txt=trim($cad[$i]);
		$this->Cell($w, $h, $txt, $border, $ln, $align, $fill, $link);
		//$this->addprint.="$txt=@$this->x=@$this->y=@$this->fuente=@$this->estilo=@$this->tamano=@Text-Class-";
		//$this->$w=$w*$this->unidad;
		$this->y += $h*$this->unidad;
		$this->x = $xx;
		//$this->x+=$this->$w;
	}
	//$this->Ln();
}

function Ln($h=5){
	if($this->h!=0){
		$this->y+=$this->h;
	}
	else{
		$this->y+=$h*$this->unidad;
	}
	
	$this->x=10*$this->unidad;
}
function Image($file, $x=null, $y=null, $w=0, $h=0, $type='', $link='')
{
	$this->addprint=$this->addprint="$file=@$x=@$y=@=@=@=@Img-Class-";
}
function Output($name='', $dest=''){
	if($dest=="D"){
		echo $this->addprint;
	}
	else 
		return $this->addprint;
}
function SetTextColor($r=0, $g=0, $b=0)
{
	$this->colorTexto="$r,$g,$b";
}
function SetDrawColor($r=0, $g=0, $b=0)
{
	$this->colorBorde="$r,$g,$b";
}
function SetFillColor($r=0, $g=0, $b=0)
{
	$this->colorRelleno="$r,$g,$b";
}
function SetLineWidth($width)
{
}
function Header()
{
}

function Footer()
{
}
function AliasNbPages($alias='{nb}')
{
	
}
function SetDisplayMode($zoom, $layout='continuous')
{
}

}//Class



?>
