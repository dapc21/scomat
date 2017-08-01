<?php
class cirre_diario_et
{
	private $id_cierre;
	private $fecha_cierre;
	private $hora_cierre;
	private $monto_total;
	private $obser_cierre;
	private $reporte_z;
	private $id_est;

	function __construct($id_cierre,$fecha_cierre,$hora_cierre,$monto_total,$obser_cierre,$reporte_z,$id_est='0')
	{
		$this->id_cierre = $id_cierre;
		$this->fecha_cierre = $fecha_cierre;
		$this->hora_cierre = $hora_cierre;
		$this->monto_total = $monto_total;
		$this->obser_cierre = $obser_cierre;
		$this->reporte_z = $reporte_z;
		$this->id_est = $id_est;
	}
	public function verid_cierre(){
		return $this->id_cierre;
	}
	public function verreporte_z(){
		return $this->reporte_z;
	}
	public function verobser_cierre(){
		return $this->obser_cierre;
	}
	public function vermonto_total(){
		return $this->monto_total;
	}
	public function verhora_cierre(){
		return $this->hora_cierre;
	}
	public function verfecha_cierre(){
		return $this->fecha_cierre;
	}
	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from cirre_diario_et where id_cierre='$this->id_cierre'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluircirre_diario_et($acceso)
	{
		session_start();
		$id_f = $_SESSION["id_franq"]; 
		
	
		//echo "insert into cirre_diario_et(id_cierre,fecha_cierre,hora_cierre,monto_total,obser_cierre,reporte_z,id_est) values ('$this->id_cierre','$this->fecha_cierre','$this->hora_cierre','$this->monto_total','$this->obser_cierre','$this->reporte_z','$this->id_est')";
		$acceso->objeto->ejecutarSql("insert into cirre_diario_et(id_cierre,fecha_cierre,hora_cierre,monto_total,obser_cierre,reporte_z,id_est,id_franq) values ('$this->id_cierre','$this->fecha_cierre','$this->hora_cierre','$this->monto_total','$this->obser_cierre','$this->reporte_z','$this->id_est','$id_f')");			
		
		$fecha= date("Y-m-d");
		$dato = lectura1($acceso,"select *from vista_caja where fecha_caja='$fecha' and status_caja_cob='CERRADA' and id_est='$this->id_est' ");
		//echo "\n:".count($dato).":";
		for($i=0;$i<count($dato);$i++)
		{
			$id_caja_cob=trim($dato[$i]["id_caja_cob"]);
			$acceso->objeto->ejecutarSql("insert into cierre_pago_et(id_caja_cob,id_cierre) values ('$id_caja_cob','$this->id_cierre')");
		}
		/*
		require_once "Graficos/Clases/estadisticas.php";
		$est=new estadisticas();
		$est->guardarDatos($acceso);
		*/
		return true;
	}
	public function modificarcirre_diario_et($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update cirre_diario_et Set id_est='$this->id_est', fecha_cierre='$this->fecha_cierre',   hora_cierre='$this->hora_cierre', monto_total='$this->monto_total', obser_cierre='$this->obser_cierre', reporte_z='$this->reporte_z' Where id_cierre='$this->id_cierre'");	
	}
	public function eliminarcirre_diario_et($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from cirre_diario_et where id_cierre='$this->id_cierre'");
	}
}
function lectura1($acceso,$sql){
	//echo "\n$sql";
	$acceso->objeto->ejecutarSql($sql);
	$i=0;
	$datoPaq=array();
	while($row=$acceso->objeto->devolverRegistro()){
		$datoPaq[$i]=$row;
		$i++;
		$acceso->objeto->siguienteRegistro();
	}
	
	return $datoPaq;
}
?>