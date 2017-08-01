//ARCHIVO QUE PERMITE ADMINISTRAR LAS VALIDACIONES DE DATOS INSTRODUCIDOS POR LOS USUARIOS ANTES DE ENVIAR CUALQUIER PETICION AL SERVIDOR
//para saber si acepta cadena vacia
var defaultEmptyOK = false
//diferentes tipos de cadenas
var digits = "0123456789";
var lowercaseLetters = "abcdefghijklmnopqrstuvwxyzáéíóúñü[]"
var uppercaseLetters = "ABCDEFGHIJKLMNOPQRSTUVWXYZÁÉÍÓÚÑ[]."
var texto = "abcdefghijklmnopqrstuvwxyzáéíóúñüABCDEFGHIJKLMNOPQRSTUVWXYZÁÉÍÓÚÑ0123456789 [](\\\".-_ :,+-*<>}{\¿?=)(/&%$º·@!ª|#~€¬\/;\'\t\n\r)"
var whitespace = " \t\n\r";
var select = "0"
var phoneChars = "";


// diferentes tipos de errores 

//var pPromptq = _("Errddddor: ");
//fin de errores de validacion 

var pPrompt = "";
var mMessage = "";
var pAlphanumeric = "";
var pAlphabetic   = "";
var pTexto   = "";
var pInteger = "";
var pNumber = "";
var pPhoneNumber = "";
var pEmail = "";
var pName = "";
var pCedula = "";
var pPassword ="";
var pSelect = "";
var pDate = "";
var pRif = "";


//fin de errores de validacion 
//retornar una arreglo
function makeArray(n) {
   for (var i = 1; i <= n; i++) {
      this[i] = 0
   } 
   return this
}

//                  CODIGO PARA FUNCIONES BASICAS                         //


// s es vacio
function isEmpty(s)
{   return ((s == null) || (s.length == 0))
}

// s es vacio o solo caracteres de espacio
function isWhitespace (s)
{   var i;
    if (isEmpty(s)) return true;
    for (i = 0; i < s.length; i++)
    {   
        var c = s.charAt(i);
        // si el caracter en que estoy no aparece en whitespace,
        // entonces retornar falso
        if (whitespace.indexOf(c) == -1) return false;
    }
    return true;
}

// Quita todos los caracteres que que estan en "bag" del string "s" s.
function stripCharsInBag (s, bag)
{   var i;
    var returnString = "";

    // Buscar por el string, si el caracter no esta en "bag", 
    // agregarlo a returnString
    
    for (i = 0; i < s.length; i++)
    {   var c = s.charAt(i);
        if (bag.indexOf(c) == -1) returnString += c;
    }

    return returnString;
}

// Lo contrario, quitar todos los caracteres que no estan en "bag" de "s"
function stripCharsNotInBag (s, bag)
{   var i;
    var returnString = "";
    for (i = 0; i < s.length; i++)
    {   
        var c = s.charAt(i);
        if (bag.indexOf(c) != -1) returnString += c;
    }

    return returnString;
}

// Quitar todos los espacios en blanco de un string
function stripWhitespace (s)
{   return stripCharsInBag (s, whitespace)
}
function charInString (c, s)
{   for (i = 0; i < s.length; i++)
    {   if (s.charAt(i) == c) return true;
    }
    return false
}

// Quita todos los espacios que antecedan al string
function stripInitialWhitespace (s)
{   var i = 0;
    while ((i < s.length) && charInString (s.charAt(i), whitespace))
       i++;
    return s.substring (i, s.length);
}

// c es una letra del alfabeto espanol
function isLetter (c)
{
	
    return( ( uppercaseLetters.indexOf( c ) != -1 ) ||
            ( lowercaseLetters.indexOf( c ) != -1 ) )
}
function isText(c)
{
    return( ( texto.indexOf( c ) != -1 ) )
}

// c es un digito
function isDigit (c)
{   return ((c >= "0") && (c <= "9"))
}

// c es letra o digito
function isLetterOrDigit (c)
{   return (isLetter(c) || isDigit(c))
}
//para saber si la cadena es un entero
function isInteger (s)
{   var i;
    if (isEmpty(s)) 
       if (isInteger.arguments.length == 1) return defaultEmptyOK;
       else return (isInteger.arguments[1] == true);
    
    for (i = 0; i < s.length; i++)
    {   
        var c = s.charAt(i);
        if( i != 0 ) {
            if (!isDigit(c)) return false;
        } else { 
            if (!isDigit(c) && (c != "-") || (c == "+")) return false;
        }
    }
    return true;
}
//para saber si la cadena es tipo cedula
function isRif (s)
{   
	//alert(s);
	if(s.length==10){
		
		 var c = s.charAt(8);
		 //alert(c);
		 if(c=='-'){
			var num=s.substring(0,8)+s.charAt(9);
			//alert(num);
			if(isInteger(num))
			{
				return true;
			}
			else{
				return false;
			}
		 }
		 else{
			return false;
		 }
	}
	else{
		return false;
	}
}
function isCedulaE(s)
{   
	//alert(":entro aqui:"+s);
	if(isInteger (s))
	{
		if(s.length==10 || s.length==9 || s.length==8 || s.length==7 || s.length==6)
			return true;
		else
			return false;
	}
	else
		return false;
}
function isCedula(s)
{   
	//alert(":entro aqui:"+s);
	if(isInteger (s))
	{
		if(s.length==10 || s.length==9 || s.length==8 || s.length==7 || s.length==6 || s.length==5)
			return true;
		else
			return false;
	}
	else
		return false;
}
//para saber si la cadena es tipo password
function isPassword(s)
{   
	if(isText(s))
	{
		if(s.length>=6)
			return true;
		else
			return false;
	}
	else
		return false;
}

// s es un numero (entero o flotante, con o sin signo)
function isNumber (s)
{   var i;
    var dotAppeared;
    dotAppeared = false;
    if (isEmpty(s)) 
       if (isNumber.arguments.length == 1) return defaultEmptyOK;
       else return (isNumber.arguments[1] == true);
    
    for (i = 0; i < s.length; i++)
    {   
        var c = s.charAt(i);
        if( i != 0 ) {
            if ( c == "." ) {
                if( !dotAppeared )
                    dotAppeared = true;
                else
                    return false;
            } else     
                if (!isDigit(c)) return false;
        } else { 
            if ( c == "." ) {
                if( !dotAppeared )
                    dotAppeared = true;
                else
                    return false;
            } else     
                if (!isDigit(c) && (c != "-") || (c == "+")) return false;
        }
    }
    return true;
}

//                        STRINGS SIMPLES                                 //

// s tiene solo letras
function isAlphabetic(s)
{
   var i;

    for (i = 0; i < s.length; i++)
    {   
		//alert( "entro al for");
        // Check that current character is letter.
        var c = s.charAt(i);

        if (!isLetter(c)){
        return false;
		}
    }
    return true;
}
//para saber si es tipo texto
function isTexto(s)
{
	var i;
	//alert("tamaño:"+s.length+"::");
    for (i = 0; i < s.length; i++)
    {   
       var c = s.charAt(i);
        if (!isText(c))
		{
			//alert("::"+c+"::");
			return false;
		}
    }
    return true;
}
function isSelect(c)
{    
	//alert("::"+c+"::");
	return( ( select.indexOf( c ) == -1 ))
}
// s tiene solo letras y numeros
function isAlphanumeric (s)
{   var i;
	
    if (isEmpty(s))
       if (isAlphanumeric.arguments.length == 1) return defaultEmptyOK;
       else return (isAlphanumeric.arguments[1] == true);

    for (i = 0; i < s.length; i++)
    {   
        var c = s.charAt(i);
        if (! (isLetter(c) || isDigit(c) || c=='_' ) )
        return false;
    }
    return true;
}

// s tiene solo letras, numeros o espacios en blanco
function isName (s)
{
    if (isEmpty(s)) 
       if (isName.arguments.length == 1) return defaultEmptyOK;
       else return (isAlphabetic.arguments[1] == true);
    
    return( isAlphabetic( stripCharsInBag( s, whitespace ) ) );
}
//para validar un campo tipo fecha
function isDate(fecha)
{
    if(fecha!='')
	{
		var date=fecha.split("/");
		if(date.length==3)
		{
			if(date[2].length!=4 || date[1].length!=2 || date[0].length!=2)
			{
				return false;
			}
			else{
				return true;
			}
		}
		else{
			return false;
		}
	}
	else{
			return false;
	}
}

//                           TELEFONO o EMAIL                                 //

// s es numero de telefono valido
function isPhoneNumber (s)
{   var modString;
    if (isEmpty(s)) 
       if (isPhoneNumber.arguments.length == 1) return defaultEmptyOK;
       else return (isPhoneNumber.arguments[1] == true);
    modString = stripCharsInBag( s, phoneChars );	
	if(isInteger(modString))
	{
		if(s.length==11)
			return true;
		else
			return false;
	}
	else
			return false;
}

// s es una direccion de correo valida
function isEmail (s)
{
    if (isEmpty(s)) 
       if (isEmail.arguments.length == 1) return defaultEmptyOK;
       else return (isEmail.arguments[1] == true);
    if (isWhitespace(s)) return false;
    var i = 1;
    var sLength = s.length;
    while ((i < sLength) && (s.charAt(i) != "@"))
    { i++
    }

    if ((i >= sLength) || (s.charAt(i) != "@")) return false;
    else i += 2;

    while ((i < sLength) && (s.charAt(i) != "."))
    { i++
    }

    if ((i >= sLength - 1) || (s.charAt(i) != ".")) return false;
    else return true;
}

function valdate(fecha){
	if(fecha!='')
	{
		var date=fecha.split("/");
		if(date.length==3)
		{
			if(date[2].length!=4 || date[1].length!=2 || date[0].length!=2)
			{
				alert('Error, debe introducir una fecha en este formato  DD/MM/AAAA');
				return false;
			}
			else{
				return true;
			}
		}
		else{
			alert('Error, debe introducir una fecha en este formato  DD/MM/AAAA');
			return false;
		}
	}
	else{
		alert('Error, debe introducir una fecha valida en este formato  DD/MM/AAAA');
			return false;
	}
}

// funcion que se encarga de administrar las validaciones recibe 4 parametro los ultimos dos opcionales
//
function validaCampo(campo, funcion, vacio, mensaje) 
{   
	var msg;
    if (validaCampo.arguments.length < 3) vacio = defaultEmptyOK;
    if (validaCampo.arguments.length == 4) {
        msg = mensaje;
    } else {		
        if( funcion == isAlphabetic) msg = pAlphabetic;
        if( funcion == isInteger) msg = pInteger;
        if( funcion == isAlphanumeric) msg = pAlphanumeric;
        if( funcion == isNumber ) msg = pNumber;
        if( funcion == isEmail ) msg = pEmail;
        if( funcion == isPhoneNumber ) msg = pPhoneNumber;
        if( funcion == isName ) msg = pName;
		if( funcion == isCedula ) msg = pCedula;
		if( funcion == isCedulaE ) msg = pCedulaE;
		if( funcion == isRif ) msg = pRif;
		if( funcion == isPassword ) msg = pPassword;
		if( funcion == isTexto ) msg = pTexto;
		if( funcion == isSelect ) msg = pSelect;		
		if( funcion == isDate ) msg = pDate;
    }  
    if ((campo.value == null) || (campo.value.length == 0)){
		if(vacio==true){
			return true;
		}
		else{
	        alert(mMessage+" : "+campo.name);	campo.select();						
		   return false;
		}
	}		
    if (funcion(campo.value) == true){  return true;}
    else{				
		alert(pPrompt + msg); campo.select(); return false;
	}
}

function validaCampoGet(campo, funcion, vacio, mensaje) 
{   
	var msg;
    if (validaCampoGet.arguments.length < 3) vacio = defaultEmptyOK;
    if (validaCampoGet.arguments.length == 4) {
        msg = mensaje;
    } else {		
        if( funcion == isAlphabetic) msg = pAlphabetic;
        if( funcion == isInteger) msg = pInteger;
        if( funcion == isAlphanumeric) msg = pAlphanumeric;
        if( funcion == isNumber ) msg = pNumber;
        if( funcion == isEmail ) msg = pEmail;
        if( funcion == isPhoneNumber ) msg = pPhoneNumber;
        if( funcion == isName ) msg = pName;
		if( funcion == isCedula ) msg = pCedula;
		if( funcion == isCedulaE ) msg = pCedulaE;
		if( funcion == isRif ) msg = pRif;
		if( funcion == isPassword ) msg = pPassword;
		if( funcion == isTexto ) msg = pTexto;
		if( funcion == isSelect ) msg = pSelect;		
		if( funcion == isDate ) msg = pDate;
    }  
    if ((document.getElementById(campo).value == null) || (document.getElementById(campo).value.length == 0)){
		if(vacio==true){
			return true;
		}
		else{
	        alert(mMessage+" : "+document.getElementById(campo).name);	document.getElementById(campo).select();						
		   return false;
		}
	}		
    if (funcion(document.getElementById(campo).value) == true){  return true;}
    else{				
		alert(pPrompt + msg); document.getElementById(campo).select(); return false;
	}
}

function limita(obj,elEvento, maxi)
{
  var elem = obj;

  var evento = elEvento || window.event;
  var cod = evento.charCode || evento.keyCode;

    // 37 izquierda
	// 38 arriba
	// 39 derecha
	// 40 abajo
	// 8  backspace
	// 46 suprimir

  if(cod == 37 || cod == 38 || cod == 39
  || cod == 40 || cod == 8 || cod == 46)
  {
	return true;
  }

  if(elem.value.length < maxi )
  {
    return true;
  }

  return false;
}

function cuenta(obj,evento,maxi,div)
{
	var elem = obj.value;
	var info = document.getElementById(div);

	info.innerHTML = maxi-elem.length;
}


function incluirFrac(){
	conexionPHP('informacion.php',"incluirFrac",document.f1.id_cont_serv.value+"=@"+document.f1.monto1.value+"=@"+document.f1.monto2.value);
}



function soloLetras(e) { // 1
	
    tecla = (document.all) ? e.keyCode : e.which; // 2
    if (tecla==8) return true; // 3
	else if (tecla==0) return true; // 3
	else if (tecla==9) return true; // 3
	else if (tecla==241) return true; // 3
	else if (tecla==225 || tecla==233 || tecla==237 || tecla==243 || tecla==250 || tecla==193 || tecla==201 || tecla==211 || tecla==73 || tecla==218 || tecla==205 || tecla==209) return true; // 3
	
	//alert(tecla);
	
    patron =/[A-Za-z\s]/; // 4
    te = String.fromCharCode(tecla); // 5
    return patron.test(te); // 6
} 

function soloNumerico(e){ // 1
	//alert(document.f1.monto1.value);
	if(validaCampo(document.f1.monto1,isNumber)){

		if(parseFloat(document.f1.monto1.value)<parseFloat(document.f1.monto.value)){
			document.f1.monto2.value=parseFloat(document.f1.monto.value)-parseFloat(document.f1.monto1.value);
			
		}
		else{
			document.f1.monto2.value="0";
			alert("Error, El monto 1 debe ser menor al monto a inicial");
		}
	}
}

function incluirDesc(){
	conexionPHP('informacion.php',"incluirDesc",document.f1.id_cont_serv.value+"=@"+document.f1.monto1.value+"=@"+document.f1.monto2.value);
}
	
function logearDesc(){
						location.href="reportepdf/imp_orden_serv.php?&id_orden="+id_orden()+"&login="+document.f1.login.value+"&password"+document.f1.password.value+"&";
					
}
	
function aplicaDesc(e){ // 1
	//alert(document.f1.monto1.value);
	if(validaCampo(document.f1.monto1,isNumber)){

		if(parseFloat(document.f1.monto1.value)<parseFloat(document.f1.monto.value)){
			var subtotal=parseFloat(document.f1.monto.value);
			var descu=parseFloat(document.f1.monto1.value);
			var total=subtotal-descu;
			//var porc= (descu/total)*100;
			document.f1.monto2.value=subtotal-descu;
			//document.f1.porc_desc.value=porc;
			
		}
		else{
			document.f1.monto1.value="0";
			alert("Error, El descuento debe ser menor al costo del cargo");
		}
	}
}


function aplica_nota(){
	if(validaCampo(document.f1.monto_dc,isNumber)){
		var monto_dc=parseFloat(document.f1.monto_dc.value);
		var monto_resta=parseFloat(document.f1.monto_resta.value);
		var descuento=0;
		if(verRadiotipo_nota()=="NOTA CREDITO"){
			if(parseFloat(document.f1.monto_dc.value)>parseFloat(document.f1.monto_resta.value)){
				document.f1.monto_dc.value="0";
				alert("Error, El monto de la nota de credito debe ser menor al costo del cargo");
				return;
			}
			var descuento=monto_resta-monto_dc;
		}
		else{
			var descuento=monto_resta+monto_dc;
		}
		
			document.f1.campo.value=descuento;
	}else{
		document.f1.monto_dc.value="0";
		document.f1.monto_dc.select();
	}
}

function aplica_nota_dc(){
	if(validaCampoGet("monto_dc",isNumber)){
		var monto_dc=parseFloat(document.getElementById("monto_dc").value);
		var monto_resta=parseFloat(document.getElementById("monto_resta").value);
		var descuento=0;
		if(verRadiotipo_nota()=="NOTA DE CREDITO"){
			if(parseFloat(document.getElementById("monto_dc").value)>parseFloat(document.getElementById("monto_resta").value)){
				document.getElementById("monto_dc").value="0";
				alert("Error, El monto de la nota de credito debe ser menor al costo del cargo");
				return;
			}
			var descuento=monto_resta-monto_dc;
		}
		else{
			var descuento=monto_resta+monto_dc;
		}
			document.getElementById("campo").value=descuento;
	}else{
		document.getElementById("monto_dc").value="0";
		document.getElementById("monto_dc").select();
	}
}

function calcula_dias_cargo(){
		var costo_cargo=parseFloat(document.getElementById("costo_cargo").value);
		var dias=parseInt(document.getElementById("dias").value);
		var costo_dia=costo_cargo/30;
		var descuento=dias*costo_dia;
		document.getElementById("monto_dc").value=parseInt(descuento);
	aplica_nota();
}

function verRadiotipo_nota()
{
			if(document.getElementById("tipo_nota1").checked){								
				return document.getElementById("tipo_nota1").value;
			}
			else{
				return document.getElementById("tipo_nota2").value;
			}
}


function formatdate(fecha){
	var date=fecha.split("/");
	var result=date[2]+'-'+date[1]+'-'+date[0]; 
	//alerta(result);
	return result;
}
function formatdatei(fecha){
	var date=fecha.split("-");
	var result=date[2]+'/'+date[1]+'/'+date[0]; 
	//alerta(result);
	return result;
}



