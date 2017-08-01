
<?php
class cablemodem
{
	private $autoriza;
	private $firma;
	private $metodo;
	private $mac;
	private $contrato;
	private $nodo;
	private $plan;
	private $estado;
	private $Dato_cliente;
	private $server;
	private $securelevel;
	

	function __construct($autoriza,$firma,$metodo,$mac,$contrato,$nodo,$plan,$estado,$Dato_cliente,$server,$securelevel)
	{
		$this->autoriza = $autoriza;
		$this->firma = $firma;
		$this->metodo = $metodo;
		$this->mac = $mac;
		$this->contrato = $contrato;
		$this->nodo = $nodo;
		$this->plan = $plan;
		$this->estado = $estado;
		$this->Dato_cliente = $Dato_cliente;
		$this->server = $server;
		$this->securelevel = $securelevel;
	}
	public function verautoriza(){
		return $this->autoriza;
	}
	public function verfirma(){
		return $this->firma;
	}
	public function vercampos(){
		return $this->campos;
	}
	public function vermac(){
		return $this->mac;
	}
	public function vermetodo(){
		return $this->metodo;
	}

	public function incluircablemodem($acceso){
		
		return $acceso->objeto->ejecutarSql("insert into cablemodem(mac,contrato,nodo,plan,estado,Dato_cliente,server,securelevel) values ('$this->mac','$this->contrato','$this->nodo','$this->plan','$this->estado','$this->Dato_cliente','$this->server','$this->securelevel')");
	}
	public function modificarcablemodem($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update cablemodem Set contrato='$this->contrato', nodo='$this->nodo', plan='$this->plan', estado='$this->estado', Dato_cliente='$this->Dato_cliente' , server='$this->server', securelevel='$this->securelevel' Where mac='$this->mac'");
	}
	public function activarcablemodem($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update cablemodem Set estado='ACTV' Where mac='$this->mac'");
	}
	public function desconectarcablemodem($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update cablemodem Set estado='DESC' Where mac='$this->mac'");
	}
	public function eliminarcablemodem($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from cablemodem where mac='$this->mac'");
	}
	public function verstatuscablemodem($acceso)
	{
		$acceso->objeto->ejecutarSql("select estado from cablemodem Where mac='$this->mac'");
		if($row=$acceso->objeto->devolverRegistro()){		
			return trim($row['estado']);
		}
		else{
			return "FALSE";
		}
	}
}
?>
