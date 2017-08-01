//ARCHIVO QUE PERMITE ADMINISTRAR LAS VALIDACIONES DE DATOS INSTRODUCIDOS POR LOS USUARIOS ANTES DE ENVIAR CUALQUIER PETICION AL SERVIDOR
//para saber si acepta cadena vacia
var defaultEmptyOK = false
//diferentes tipos de cadenas
var digits = "0123456789";
var lowercaseLetters = "abcdefghijklmnopqrstuvwxyzáéíóúñü"
var uppercaseLetters = "ABCDEFGHIJKLMNOPQRSTUVWXYZÁÉÍÓÚÑ"
var texto = "abcdefghijklmnopqrstuvwxyzáéíóúñüABCDEFGHIJKLMNOPQRSTUVWXYZÁÉÍÓÚÑ0123456789 (\\\".-_ :,+-*<>}{\¿?=)(/&%$·@!ª|#~€¬\/;\'\t\n\r)"
var whitespace = " \t\n\r";
var select = "0"
var phoneChars = "";


// diferentes tipos de errores 

var pPrompt = "Error: ";
var mMessage = "Error: no puede dejar este espacio vacio"
var pAlphanumeric = "ingrese un texto que contenga solo letras y/o numeros";
var pAlphabetic   = "ingrese un texto que contenga solo letras";
var pTexto   = "ingrese un texto que contenga solo letras numeros y \"\'.,-;";
var pInteger = "ingrese un numero entero";
var pNumber = "ingrese un numero";
var pPhoneNumber = "ingrese un número de teléfono de 11 digitos";
var pEmail = "ingrese una dirección de correo electrónico válida";
var pName = "ingrese un texto que contenga solo letras y/o espacios";
var pCedula = "ingrese un numero de cedula de 8 digitos";
var pPassword = "la contraseña debe ser minimo 6 digitos";
var pSelect = "no ha Seleccionado ninguna opcion en el Select";
var pDate = "debe introducir una fecha en este formato  DD/MM/AAAA";

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
function isCedula(s)
{   
	if(isInteger (s))
	{
		if(s.length==8 || s.length==7)
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
	if(isAlphanumeric(s))
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

        if (!isLetter(c))
        return false;
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
			alert("::"+c+"::");
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
		if( funcion == isPassword ) msg = pPassword;
		if( funcion == isTexto ) msg = pTexto;
		if( funcion == isSelect ) msg = pSelect;		
		if( funcion == isDate ) msg = pDate;
    }  
    if ((campo.value == null) || (campo.value.length == 0)){
        alert(mMessage);	campo.select();						
	   return false;
	}		
    if (funcion(campo.value) == true){  return true;}
    else{				
		alert(pPrompt + msg); campo.select(); return false;
	}
}