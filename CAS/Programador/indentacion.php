<?php
//$cad='';
//indentacion($cad);

function indentacion($cad)
{
	$cad=str_replace('
','',$cad);
	

	$cant=strlen($cad);
	$cadena="";
	$tru=false;
	$cTab=0;
	$cont=0;
	$enter='
';
	for($i=0;$i<$cant;$i++)
	{
		$ca1=$cad[$i].$cad[$i+1].$cad[$i+2];
		$ca=$ca1.$cad[$i+3];
		$ca2=$ca.$cad[$i+4];
		$ca3=$ca2.$cad[$i+5];
		$ca4=$ca3.$cad[$i+6];
		$ca5=$ca4.$cad[$i+7];
		$ca6=$ca5.$cad[$i+8];
		$ca7=$ca6.$cad[$i+9];
		$ca8=$ca7.$cad[$i+10];
		if($cad[$i]=='<')
		{
			if(strtoupper($ca)=="<BR>")
			{
				$cadena=tab($cadena,$cTab).$ca;
				//$cadena=tab($cadena,$cTab);
				$i=$i+3;
			}
			else if(strtoupper($ca1)=="<H3"){
				$cadena=tab($cadena,$cTab).$ca1;
				$cTab++;
				$i=$i+2;
			}
			else if(strtoupper($ca2)=="</H3>"){
				$cTab--;
				$cadena=tab($cadena,$cTab).$ca2;
				$i=$i+4;
			}
			else if(strtoupper($ca2)=="<FORM"){
				$cadena=tab($cadena,$cTab).$ca2;
				$cTab++;
				$i=$i+4;
			}
			else if(strtoupper($ca3)=="<TABLE"){
				$cadena=tab($cadena,$cTab).$ca3;
				$cTab++;
				$i=$i+5;
			}
			else if(strtoupper($ca1)=="<TR"){
				$cadena=tab($cadena,$cTab).$ca1;
				$cTab++;
				$i=$i+2;
			}
			else if(strtoupper($ca1)=="<TD"){
				$cadena=tab($cadena,$cTab).$ca1;
				$cTab++;
				$i=$i+2;
			}
			else if(strtoupper($ca4)=="</FORM>"){
				$cTab--;
				$cadena=tab($cadena,$cTab).$ca4;
				$i=$i+6;
			}
			else if(strtoupper($ca5)=="</TABLE>"){
				$cTab--;
				$cadena=tab($cadena,$cTab).$ca5;
				$i=$i+7;
			}
			else if(strtoupper($ca2)=="</TR>"){
				$cTab--;
				$cadena=tab($cadena,$cTab).$ca2;
				$i=$i+4;
			}
			else if(strtoupper($ca2)=="</TD>"){
				$cTab--;
				$cadena=tab($cadena,$cTab).$ca2;
				$i=$i+4;
			}
			else if(strtoupper($ca3)=="<INPUT"){
				$cadena=tab($cadena,$cTab).$ca3;
				$i=$i+5;
			}
			else if(strtoupper($ca2)=="<FONT"){
				$cadena=tab($cadena,$cTab).$ca2;
				$i=$i+4;
			}
			else if(strtoupper($ca3)=="<LABEL"){
				$cadena=tab($cadena,$cTab).$ca3;
				$cTab++;
				$i=$i+5;
			}
			else if(strtoupper($ca5)=="</LABEL>"){
				$cTab--;
				$cadena=tab($cadena,$cTab).$ca5;
				$i=$i+7;
			}
			else if(strtoupper($ca4)=="<STRONG"){
				$cadena=tab($cadena,$cTab).$ca4;
				$cTab++;
				$i=$i+6;
			}
			else if(strtoupper($ca6)=="</STRONG>"){
				$cTab--;
				$cadena=tab($cadena,$cTab).$ca6;
				$i=$i+8;
			}
			else if(strtoupper($ca6)=="<TEXTAREA"){
				$cadena=tab($cadena,$cTab).$ca6;
				$i=$i+8;
			}
			else if(strtoupper($ca4)=="<SELECT"){
				$cadena=tab($cadena,$cTab).$ca4;
				$cTab++;
				$i=$i+6;
			}
			else if(strtoupper($ca6)=="</SELECT>"){
				$cTab--;
				$cadena=tab($cadena,$cTab).$ca6;
				$i=$i+8;
			}
			else if(strtoupper($ca4)=="<OPTION"){
				$cadena=tab($cadena,$cTab).$ca4;
				
				$i=$i+6;
			}
			else if(strtoupper($ca)=="<DIV"){
				$cadena=tab($cadena,$cTab).$ca;
				$cTab++;
				$i=$i+3;
			}
			else if(strtoupper($ca3)=="</DIV>"){
				$cTab--;
				$cadena=tab($cadena,$cTab).$ca3;
				$i=$i+5;
			}
			else if(strtoupper($ca2)=="<SPAN"){
				$cadena=tab($cadena,$cTab).$ca2;
				$cTab++;
				$i=$i+4;
			}
			else if(strtoupper($ca4)=="</SPAN>"){
				$cTab--;
				$cadena=tab($cadena,$cTab).$ca4;
				$i=$i+6;
			}
			else if(strtoupper($ca2)=="<HTML"){
				$cadena=tab($cadena,$cTab).$ca2;
				$cTab++;
				$i=$i+4;
			}
			else if(strtoupper($ca4)=="</HTML>"){
				$cTab--;
				$cadena=tab($cadena,$cTab).$ca4;
				$i=$i+6;
			}
			else if(strtoupper($ca2)=="<HEAD"){
				$cadena=tab($cadena,$cTab).$ca2;
				$cTab++;
				$i=$i+4;
			}
			else if(strtoupper($ca4)=="</HEAD>"){
				$cTab--;
				$cadena=tab($cadena,$cTab).$ca4;
				$i=$i+6;
			}
			else if(strtoupper($ca2)=="<BODY"){
				$cadena=tab($cadena,$cTab).$ca2;
				$cTab++;
				$i=$i+4;
			}
			else if(strtoupper($ca4)=="</BODY>"){
				$cTab--;
				$cadena=tab($cadena,$cTab).$ca4;
				$i=$i+6;
			}
			else if(strtoupper($ca3)=="<TITLE"){
				$cadena=tab($cadena,$cTab).$ca3;
				$i=$i+5;
			}
			else if(strtoupper($ca4)=="<SCRIPT"){
				$cadena=tab($cadena,$cTab).$ca4;
				$i=$i+6;
			}
			else if(strtoupper($ca1)=="<UL"){
				$cadena=tab($cadena,$cTab).$ca1;
				$cTab++;
				$i=$i+2;
			}
			else if(strtoupper($ca2)=="</UL>"){
				$cTab--;
				$cadena=tab($cadena,$cTab).$ca2;
				$i=$i+4;
			}
			else if(strtoupper($ca1)=="<LI"){
				$cadena=tab($cadena,$cTab).$ca1;
				$cTab++;
				$i=$i+2;
			}
			else if(strtoupper($ca2)=="</LI>"){
				$cTab--;
				$cadena=tab($cadena,$cTab).$ca2;
				$i=$i+4;
			}
			else{
				$cadena.=$cad[$i];
			}
		}
		else{
			$cadena.=$cad[$i];
		}
	}
	return $cadena;
	//$id = fopen("prueba.html","w+");
	//fwrite($id,$cadena);
	//echo $cadena;
	//fclose ($id);
}
function tab($cad,$cTab)
{
	$tab='	';
	$enter='
';
	$cad.=$enter;
	for($j=0;$j<$cTab;$j++)
	{
		$cad.=$tab;
	}
	return $cad;
}
?>