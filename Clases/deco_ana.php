<?php
class deco_ana
{
	private $id_da;
	private $id_contrato;
	private $codigo_da;
	private $marca_da;
	private $modelo_da;
	private $prov_da;
	private $tipo_da;
	private $chanmap_da;
	private $punto_da;
	private $status_da;
	private $fecha_act_da;
	private $obser_da;
	private $servicio;
	private $nota2;
	private $nota3;
	private $dato;

	function __construct($id_da,$id_contrato,$codigo_da,$marca_da,$modelo_da,$prov_da,$tipo_da,$chanmap_da,$punto_da,$status_da,$fecha_act_da,$obser_da,$servicio,$nota2,$nota3,$dato)
	{
		$this->id_da = $id_da;
		$this->id_contrato = $id_contrato;
		$this->codigo_da = $codigo_da;
		$this->marca_da = $marca_da;
		$this->modelo_da = $modelo_da;
		$this->prov_da = $prov_da;
		$this->tipo_da = $tipo_da;
		$this->chanmap_da = $chanmap_da;
		$this->punto_da = $punto_da;
		$this->status_da = $status_da;
		$this->fecha_act_da = $fecha_act_da;
		$this->obser_da = $obser_da;
		$this->servicio = $servicio;
		$this->nota2 = $nota2;
		$this->nota3 = $nota3;
		$this->dato = $dato;
	}
	public function verid_da(){
		return $this->id_da;
	}
	public function verdato(){
		return $this->dato;
	}
	public function vernota3(){
		return $this->nota3;
	}
	public function vernota2(){
		return $this->nota2;
	}
	public function verservicio(){
		return $this->servicio;
	}
	public function verobser_da(){
		return $this->obser_da;
	}
	public function verfecha_act_da(){
		return $this->fecha_act_da;
	}
	public function verstatus_da(){
		return $this->status_da;
	}
	public function verpunto_da(){
		return $this->punto_da;
	}
	public function verchanmap_da(){
		return $this->chanmap_da;
	}
	public function vertipo_da(){
		return $this->tipo_da;
	}
	public function verprov_da(){
		return $this->prov_da;
	}
	public function vermodelo_da(){
		return $this->modelo_da;
	}
	public function vermarca_da(){
		return $this->marca_da;
	}
	public function vercodigo_da(){
		return $this->codigo_da;
	}
	public function verid_contrato(){
		return $this->id_contrato;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from deco_ana where id_da='$this->id_da'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluirdeco_ana($acceso)
	{
		$acceso->objeto->ejecutarSql("insert into deco_ana(id_da,id_contrato,codigo_da,marca_da,modelo_da,prov_da,tipo_da,chanmap_da,punto_da,status_da,fecha_act_da,obser_da,servicio,nota2,nota3) values ('$this->id_da','$this->id_contrato','$this->codigo_da','$this->marca_da','$this->modelo_da','$this->prov_da','$this->tipo_da','$this->chanmap_da','$this->punto_da','$this->status_da','$this->fecha_act_da','$this->obser_da','$this->servicio','$this->nota2','$this->nota3')");
		session_start();		
		$ini_u = $_SESSION["ini_u"];
				
				
					$acceso->objeto->ejecutarSql("select *from interfazacc  where (id_accquery ILIKE '$ini_u%') ORDER BY id_accquery desc"); 
					$id_accquery = $ini_u.verCo($acceso,"id_accquery");
					require_once "interfazacc.php";
					
					$obj=new interfazacc($id_accquery,$this->codigo_da,"AGREGAR",'FALSE','','');
					$obj->incluirinterfazacc($acceso);
					
					$obj1=new interfazacc($id_accquery,$this->codigo_da,"DESACTIVAR",'FALSE','','');
					$obj1->incluirinterfazacc($acceso);
				
	}
	public function modificardeco_ana($acceso)
	{
		require_once "interfazacc.php";
		session_start();		
					$ini_u = $_SESSION["ini_u"];
					
							
		$acceso->objeto->ejecutarSql("select id_contrato from deco_ana where id_da='$this->id_da'");
		$row=$acceso->objeto->devolverRegistro();
		$id_contrato=trim($row['id_contrato']);
		if($id_contrato=='' and $this->id_contrato!=''){
			$this->status_da='I';
			
			
					$acceso->objeto->ejecutarSql("select *from interfazacc  where (id_accquery ILIKE '$ini_u%') ORDER BY id_accquery desc"); 
					$id_accquery = $ini_u.verCo($acceso,"id_accquery");
					
					$obj=new interfazacc($id_accquery,$this->codigo_da,"ACTIVAR",'FALSE','','');
					$obj->incluirinterfazacc($acceso);
		
		
		}
					
		$acceso->objeto->ejecutarSql("Update deco_ana Set id_contrato='$this->id_contrato', codigo_da='$this->codigo_da', marca_da='$this->marca_da', modelo_da='$this->modelo_da', prov_da='$this->prov_da', tipo_da='$this->tipo_da', chanmap_da='$this->chanmap_da', punto_da='$this->punto_da', status_da='$this->status_da', fecha_act_da='$this->fecha_act_da', obser_da='$this->obser_da', servicio='$this->servicio', nota2='$this->nota2', nota3='$this->nota3' Where id_da='$this->id_da'");
		
					
					$acceso->objeto->ejecutarSql("select *from interfazacc  where (id_accquery ILIKE '$ini_u%') ORDER BY id_accquery desc"); 
					$id_accquery = $ini_u.verCo($acceso,"id_accquery");
					
					$obj=new interfazacc($id_accquery,$this->codigo_da,"SERVICIOS",'FALSE','','');
					$obj->incluirinterfazacc($acceso);
		
	}
	public function eliminardeco_ana($acceso){
		$acceso->objeto->ejecutarSql("delete from deco_ana where id_da='$this->id_da'");
					session_start();
					$ini_u = $_SESSION["ini_u"];
					
					$acceso->objeto->ejecutarSql("select * from deco_ana where id_da='$this->id_da'");
					$row=$acceso->objeto->devolverRegistro();
					$codigo_da=trim($row['codigo_da']);
					
					$acceso->objeto->ejecutarSql("select *from interfazacc  where (id_accquery ILIKE '$ini_u%') ORDER BY id_accquery desc"); 
					$id_accquery = $ini_u.verCo($acceso,"id_accquery");
					require_once "interfazacc.php";
					
					
					$obj=new interfazacc($id_accquery,$codigo_da,"BORRAR",'FALSE','','');
					$obj->incluirinterfazacc($acceso);
	}
	public function eliminar_deco_condeco_ana($acceso)
	{
		$acceso->objeto->ejecutarSql("Update deco_ana Set id_contrato='', status_da='' , prov_da='bueno' Where id_da='$this->id_da'");	;
					session_start();
					$ini_u = $_SESSION["ini_u"];
					
					$acceso->objeto->ejecutarSql("select * from deco_ana where id_da='$this->id_da'");
					$row=$acceso->objeto->devolverRegistro();
					$codigo_da=trim($row['codigo_da']);
					
					$acceso->objeto->ejecutarSql("select *from interfazacc  where (id_accquery ILIKE '$ini_u%') ORDER BY id_accquery desc"); 
					$id_accquery = $ini_u.verCo($acceso,"id_accquery");
					require_once "interfazacc.php";
					
					
					$obj=new interfazacc($id_accquery,$codigo_da,"DESACTIVAR",'FALSE','','');
					$obj->incluirinterfazacc($acceso);
		
	}
}
?>