<?php
class sincronizacion_servi
{
	private $id_sinc;
	private $id_servidor;
	private $fecha_sinc;
	private $hora_sin;
	private $oid_inicial;
	private $oid_final;
	private $status_sinc;
	private $dato;

	function __construct($id_sinc,$id_servidor,$fecha_sinc,$hora_sin,$oid_inicial,$oid_final,$status_sinc,$dato)
	{
		$this->id_sinc = $id_sinc;
		$this->id_servidor = $id_servidor;
		$this->fecha_sinc = $fecha_sinc;
		$this->hora_sin = $hora_sin;
		$this->oid_inicial = $oid_inicial;
		$this->oid_final = $oid_final;
		$this->status_sinc = $status_sinc;
		$this->dato = $dato;
	}
	public function verid_sinc(){
		return $this->id_sinc;
	}
	public function verdato(){
		return $this->dato;
	}
	public function verstatus_sinc(){
		return $this->status_sinc;
	}
	public function veroid_final(){
		return $this->oid_final;
	}
	public function veroid_inicial(){
		return $this->oid_inicial;
	}
	public function verhora_sin(){
		return $this->hora_sin;
	}
	public function verfecha_sinc(){
		return $this->fecha_sinc;
	}
	public function verid_servidor(){
		return $this->id_servidor;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from sincronizacion_servi where id_sinc='$this->id_sinc'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluirsincronizacion_servi($acceso)
	{
				require_once("procesos.php");
				$ini_u = $_SESSION["ini_u"];
				$servi=lectura($acceso,"select * from servidor  where status_ser='ACTIVO' and status_servidor<>'LOCAL' and sincronizar='SINCRONIZAR'");
				$login=$this->login;
				$exist_sinc=true;
				$conta=0;
				for($j=0;$j<count($servi);$j++)
				{
					$id_servidor=trim($servi[$j]['id_servidor']);
					$nombre_servidor=trim($servi[$j]['nombre_servidor']);
					$direccio_ip=strtolower(trim($servi[$j]['direccio_ip']));
					$usuario_p=strtolower(trim($servi[$j]['usuario_p']));
					$clave_p=strtolower(trim($servi[$j]['clave_p']));
					$database=strtolower(trim($servi[$j]['database']));
					
					
					$exist_sinc=true;
				//	echo ":'Postgres',$direccio_ip,$usuario_p,$clave_p,$database:";
					if($acceso_remoto=conectar('Postgres',$direccio_ip,$usuario_p,$clave_p,$database)){
					while($exist_sinc==true){
							
						$where_sql="";
						$acceso->objeto->ejecutarSql("select oid_final from sincronizacion_servi  where id_servidor='$id_servidor' and status_sinc='ACTIVO' ");
						if($row=row($acceso)){
							$oid_final=trim($row['oid_final']);
							$where_sql=" where oid > '$oid_final' ";
						}
						
						//echo "<br>select oid, sql_comp from auditoria_comp  $where_sql  order by oid asc limit 1000 ";
						$acceso_remoto->objeto->ejecutarSql("select oid, sql_comp from auditoria_comp  $where_sql  order by oid asc limit 1000 ");
						$this->oid_inicial='';
						if($row=row($acceso_remoto)){
							$exist_sinc=true;
							$sql_comp=trim($row['sql_comp']);
							if($sql_comp=='BEGIN;' || $sql_comp=='COMMIT;' || $sql_comp=='ROLLBACK;' ){
								continue;
							}
							$this->oid_inicial=trim($row['oid']);
							$this->oid_final=trim($row['oid']);
							if(!$acceso->objeto->ejecutarSql_solo($sql_comp)){
								echo "<br>$sql_comp;";
								echo '<br>'.$acceso->objeto->error().'<br>';
							}
						}else{
							$exist_sinc=false;
							echo "\nNO HAY ACTALIZACION DISPONIBLE CON EL SEVIDOR REMOTO $nombre_servidor";
							$this->oid_inicial=0;
							$this->oid_final=0;
						}
						
						while($row=row($acceso_remoto)){
							$exist_sinc=true;
							$sql_comp=trim($row['sql_comp']);
							if($sql_comp=='BEGIN;' || $sql_comp=='COMMIT;' || $sql_comp=='ROLLBACK;' ){
								continue;
							}
							$this->oid_final=trim($row['oid']);
							if(!$acceso->objeto->ejecutarSql_solo($sql_comp)){
								echo "<br>$sql_comp;";
								echo '<br>'.$acceso->objeto->error().'<br>';
							}
						}
						if($exist_sinc==true){
							$acceso->objeto->ejecutarSql("select id_sinc from sincronizacion_servi  where (id_sinc ILIKE '$ini_u%')   ORDER BY id_sinc desc LIMIT 1 offset 0 ");
							$this->id_sinc=$ini_u.verCoo($acceso,"id_sinc");
							$this->id_servidor = $id_servidor;
							$this->fecha_sinc = date("Y-m-d");
							$this->hora_sin = date("H:i:s");
							$this->status_sinc = "ACTIVO";
							echo "insert into sincronizacion_servi(id_sinc,id_servidor,fecha_sinc,hora_sin,oid_inicial,oid_final,status_sinc,dato) values ('$this->id_sinc','$this->id_servidor','$this->fecha_sinc','$this->hora_sin','$this->oid_inicial','$this->oid_final','$this->status_sinc','$this->dato')";
							$acceso->objeto->ejecutarSql("Update sincronizacion_servi Set status_sinc='INACTIVO' Where id_servidor='$this->id_servidor'");	
							$acceso->objeto->ejecutarSql("insert into sincronizacion_servi(id_sinc,id_servidor,fecha_sinc,hora_sin,oid_inicial,oid_final,status_sinc,dato) values ('$this->id_sinc','$this->id_servidor','$this->fecha_sinc','$this->hora_sin','$this->oid_inicial','$this->oid_final','$this->status_sinc','$this->dato')");
						}
					//	$acceso->objeto->ejecutarSql("COMMIT;");
						$conta++;
						if($conta==10){
							//break;
						}
					  }//while existe
					}
					else{
						echo "\nERROR AL CONECTARSE CON EL SEVIDOR REMOTO DE $nombre_servidor";
					}
				}
			
	}
	public function modificarsincronizacion_servi($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update sincronizacion_servi Set id_servidor='$this->id_servidor', fecha_sinc='$this->fecha_sinc', hora_sin='$this->hora_sin', oid_inicial='$this->oid_inicial', oid_final='$this->oid_final', status_sinc='$this->status_sinc', dato='$this->dato' Where id_sinc='$this->id_sinc'");	
	}
	public function eliminarsincronizacion_servi($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from sincronizacion_servi where id_sinc='$this->id_sinc'");
	}
}
?>