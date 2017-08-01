<?php
require_once "procesos.php";
class mov_mat
{
	private $id_mat;
	private $id_mov;
	private $cant_mov;
	private $dato;

	function __construct($id_mat,$id_mov,$cant_mov,$dato)
	{
		$this->id_mat = $id_mat;
		$this->id_mov = $id_mov;
		$this->cant_mov = $cant_mov;
		$this->dato = $dato;
	}
	public function verid_mat(){
		return $this->id_mat;
	}
	public function verdato(){
		return $this->dato;
	}
	public function vercant_mov(){
		return $this->cant_mov;
	}
	public function verid_mov(){
		return $this->id_mov;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from mov_mat where id_mat='$this->id_mat' and id_mov='$this->id_mov'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluirmov_mat($acceso)
	{
		//echo $this->dato;
		if( $this->dato != "dato"){
			$this->incluirtamov_mat($acceso);
			
		}else {
			$this->incluirnormalamov_mat($acceso);
		}
			
		//return $acceso->objeto->ejecutarSql("insert into mov_mat(id_mat,id_mov,cant_mov) values ('$this->id_mat','$this->id_mov','$this->cant_mov')");		
		
	}
	public function incluirtamov_mat($acceso)
	{
		$valor=explode("<@@>",trim($this->dato));	
		//ECHO "select id_mat from materiales where id_m='$valor[1]' and id_dep='$valor[0]'";
		$acceso->objeto->ejecutarSql("select id_mat from materiales where id_m='$valor[1]' and id_dep='$valor[0]'");
		
		if($acceso->objeto->registros>0){
			$row=$acceso->objeto->devolverRegistro();
			$this->id_mat=trim($row["id_mat"]);
			$this->incluirnormalamov_mat($acceso);
			
		}else{
			session_start();
			$ini_u = $_SESSION["ini_u"];  
			$acceso->objeto->ejecutarSql("select  id_mat from materiales  where (id_mat ILIKE '$ini_u%')   ORDER BY id_mat desc LIMIT 1 offset 0 ");
			$i_ma=$ini_u.verCodLong($acceso,"id_mat");	
			/*
			$acceso->objeto->ejecutarSql("select * from materiales where (id_mat ilike 'A%') ORDER BY id_mat desc LIMIT 1 offset 0"); 
			$i_ma="AZ".verCodLong($acceso,"id_mat");
			*/
			//echo "insert into materiales(id_mat,id_m,id_dep,stock,stock_min,observacion) values ('$i_ma','$valor[1]','$valor[0]','0','0','CREADO POR EL SISTEMA')";
			$acceso->objeto->ejecutarSql("insert into materiales(id_mat,id_m,id_dep,stock,stock_min,observacion) values ('$i_ma','$valor[1]','$valor[0]','0','0','CREADO POR EL SISTEMA')");
			$this->id_mat=$i_ma;			
			$this->incluirnormalamov_mat($acceso);
		}
		
		
	}
	public function incluirnormalamov_mat($acceso)
	{
	//	echo "insert into mov_mat(id_mat,id_mov,cant_mov) values ('$this->id_mat','$this->id_mov','$this->cant_mov')";
		if($acceso->objeto->ejecutarSql("insert into mov_mat(id_mat,id_mov,cant_mov) values ('$this->id_mat','$this->id_mov','$this->cant_mov')")){			
			$acceso->objeto->ejecutarSql("select tipo_ent_sal from movimiento as a, tipo_movimiento as b where a.id_mov='$this->id_mov' and a.id_tm=b.id_tm");
			if($row=$acceso->objeto->devolverRegistro()){		
				$tipo_ent_sal=trim($row["tipo_ent_sal"]);
				if($tipo_ent_sal=="SALIDA"){
				//echo "Update materiales Set stock=stock-'$this->cant_mov' Where id_mat='$this->id_mat'";
					return $acceso->objeto->ejecutarSql("Update materiales Set stock=stock-'$this->cant_mov' Where id_mat='$this->id_mat'");	
				}else{
				//echo "Update materiales Set stock=stock+'$this->cant_mov' Where id_mat='$this->id_mat'";
					return $acceso->objeto->ejecutarSql("Update materiales Set stock=stock+'$this->cant_mov' Where id_mat='$this->id_mat'");	
				}
			}else{
				return false;
			}				
		}	
	}
	
	public function modificarmov_mat($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update mov_mat Set id_mov='$this->id_mov', cant_mov='$this->cant_mov' Where id_mat='$this->id_mat'");	
	}
	public function eliminarmov_mat($acceso)
	{
		$valor=explode("<@@>",trim($this->dato));
		$acceso->objeto->ejecutarSql("select cant_mov from mov_mat where id_mat='$this->id_mat' and id_mov='$this->id_mov'");
		if($row=$acceso->objeto->devolverRegistro()){
			$cant_mov=trim($row["cant_mov"]);
		}
		if(trim($valor[1])=="SALIDA"){
			$acceso->objeto->ejecutarSql("Update materiales Set stock=stock+'$cant_mov' Where id_mat='$this->id_mat'");			
		}else{
			$acceso->objeto->ejecutarSql("Update materiales Set stock=stock-'$cant_mov' Where id_mat='$this->id_mat'");			
		}
		return $acceso->objeto->ejecutarSql("delete from mov_mat where id_mat='$this->id_mat' and id_mov='$this->id_mov'");
	}
	public function eliminarDosmov_mat($acceso)
	{
		$valor=explode("<@@>",trim($this->cant_mov));
		$acceso->objeto->ejecutarSql("select id_mat from materiales where id_m='$valor[1]' and id_dep='$valor[0]'");
		if($row=$acceso->objeto->devolverRegistro()){
			$id_mat=trim($row["id_mat"]);
		}
		
		$acceso->objeto->ejecutarSql("select cant_mov from mov_mat where id_mat='$id_mat' and id_mov='$this->id_mov'");
		if($row=$acceso->objeto->devolverRegistro()){
			$cant_mov=trim($row["cant_mov"]);
		}
		$valor=explode("<@@>",trim($this->dato));
		if(trim($valor[1])=="SALIDA"){
			$acceso->objeto->ejecutarSql("Update materiales Set stock=stock+'$cant_mov' Where id_mat='$id_mat'");			
		}else{
			$acceso->objeto->ejecutarSql("Update materiales Set stock=stock-'$cant_mov' Where id_mat='$id_mat'");			
		}
		return $acceso->objeto->ejecutarSql("delete from mov_mat where id_mat='$id_mat' and id_mov='$this->id_mov'");
	}
}
//$acceso->objeto->ejecutarSql("Update materiales Set stock=stock-'$this->cant_mov' Where id_mat='$this->id_mat'");	
	
?>