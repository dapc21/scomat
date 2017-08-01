<?php 
      /***************************************************
      INTERFAZ QUE IMPLEMENTA LOS ARCHIVOS QUE REALIZAN LA
      CONEXION Y LAS CONSULTAS A LA BDD
      *****************************************************/
      interface DataBaseMetodos
	{
	     /****************************************************
	     METODO QUE PERMITE ESTABLECER LA CONEXION CON LA BDD
	     SE LE ENVIA EL HOST QUE SE VA A CONECTAR EL USUARIO DE
	     LA BDD CON SU PASSWORD Y LA BDD QUE QUIERE SELECCIONAR
	     ******************************************************/
        public function conectarDataBase($host, $user, $password, $database);
            
            /****************************************************
            CON ESTE METODO SE CIERRA LA CONEXION CON LA BDD
	     ******************************************************/
      	public function desconectarDataBase();
      	
      	/****************************************************
	     ESTE METODO PERMITE CAMBIAR DE BDD MEDIANTE EL 
	     PARAMETRO QUE RECIBE
	     ******************************************************/
      	public function seleccionarDataBase($Nombre_DB);
      	
      	/********************************************************
	     ESTE METODO ES EL QUE EJECUTA TODAS LAS CONSULTAS A LA BDD
	     **********************************************************/
      	public function ejecutarSql($sql);
      	
      	/****************************************************
	     ESTE METODO PERMITE POSICIONAR EL PUNTERO DEL REGISTRO
	     HACIA EL SIGUIENTE PARA OBTENER SUS VALORES
	     ******************************************************/
      	public function siguienteRegistro();
      	
      	/****************************************************
	     ESTE METODO PERMITE POSICIONAR EL PUNTERO DEL REGISTRO
	     HACIA EL ANTERIOR PARA OBTENER SUS VALORES
	     ******************************************************/
      	public function anteriorRegistro();	
      	
      	/****************************************************
	     ESTE METODO PERMITE POSICIONAR EL PUNTERO DEL REGISTRO
	     EN VALOR DEL ID QUE SE LE ENVIE
	     ******************************************************/
      	public function seekRegistro($id);
      	
      	/****************************************************
	     ESTE METODO DEVUELVE EL REGISTRO DEL ARRAY SEGUN LA
	     POSICION QUE SE ENCUENTRE EL PUNTERO
	     ******************************************************/
      	public function &devolverRegistro();
      	
      	/****************************************************
	     ESTE METODO PERMITE LIBERAR LA VARIABLE QUE CONTIENE 
	     LOS DATOS CUANDO SE EJECUTA UN QUERY
	     ******************************************************/
      	public function limpiarConexion();	
      }
?>
