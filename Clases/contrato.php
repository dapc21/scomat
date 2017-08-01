<?php
session_start();
require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];
require_once "Clases/cliente.php";
class contrato  extends cliente
{
	private $id_contrato;
	private $id_calle;
	private $id_persona;
	private $cli_id_persona;
	private $nro_contrato;
	private $fecha_contrato;
	private $hora_contrato;
	private $observacion;
	private $etiqueta;
	private $costo_contrato;
	private $costo_dif_men;
	private $status_contrato;
	private $id_serv;
	private $direc_adicional;
	private $numero_casa;
	private $id_edif;
	private $numero_piso;
	private $postel;
	private $taps;
	private $pto;
	private $id_gt;
	private $id_g_a;
	private $id_urb;
	private $cod_id_persona;
	private $contrato_fisico;
	private $etiqueta_n;
	private $tipo_fact;
	private $contrato_imp;
	private $ultima_act;
	private $camb_prop;
	private $dat;

	function __construct($dat)
	{ 
		parent::__construct($dat);
		$this->id_contrato = $dat['id_contrato'];
		$this->id_calle = $dat['id_calle'];
		$this->id_venta = $dat['id_venta'];
		$this->id_persona = $dat['vendedor_id_persona'];
		$this->cli_id_persona = $dat['id_persona'];
		$this->nro_contrato = $dat['nro_contrato'];
		$this->fecha_contrato = formatfecha($dat['fecha_contrato']);
		$this->observacion = $dat['observacion'];
		$this->etiqueta = $dat['etiqueta'];
		$this->costo_dif_men = $dat['costo_dif_men'];
		$this->status_contrato = $dat['status_contrato'];
		$this->id_serv = $dat['id_serv_v'];
		$this->direc_adicional = $dat['direc_adicional'];
		$this->numero_casa = $dat['numero_casa'];
		$this->id_edif = $dat['id_edif'];
		$this->numero_piso = $dat['numero_piso'];
		$this->postel = $dat['postel'];
		$this->taps = $dat['taps'];
		$this->pto = $dat['pto'];
		$this->id_gt = $dat['id_gt'];
		$this->id_g_a = $dat['id_g_a'];
		$this->id_urb = $dat['id_urb'];
		$this->cod_id_persona = $dat['cod_id_persona'];
		$this->contrato_fisico = $dat['contrato_fisico'];
		$this->etiqueta_n = $dat['etiqueta_n'];
		$this->tipo_fact = $dat['tipo_fact'];
		$this->ultima_act = $dat['ultima_act'];
		$this->contrato_imp = $dat['contrato_imp'];
		$this->camb_prop = $dat['camb_prop'];
		$dat['fecha_nac'] = formatfecha($dat['fecha_nac']);
		$this->dat = $dat;
	}
	public function incluir($acceso)
	{
		require_once "venta_contrato.php";
		$obj_venta_contrato=new venta_contrato($this->dat);
		$obj_venta_contrato->incluir($acceso);

		$acceso->objeto->ejecutarSql("select nro_contrato from contrato,vista_ubica where contrato.id_calle=vista_ubica.id_calle and  status_contrato<>'VACIO' ORDER BY num desc  LIMIT 1 offset 0 ");
		$nro_abonado= verCodLong($acceso,"nro_contrato");

		
		parent::incluir($acceso);
		$acceso->objeto->ejecutarSql("insert into contrato(id_contrato,id_calle,id_venta,cli_id_persona,nro_contrato,fecha_contrato,observacion,etiqueta,costo_dif_men,status_contrato,direc_adicional,numero_casa,id_edif,numero_piso,postel,taps,pto,id_g_a,id_urb, cod_id_persona,contrato_fisico, etiqueta_n, tipo_fact, contrato_imp, ultima_act) values 
		 	('$this->id_contrato','$this->id_calle','$this->id_venta','$this->cli_id_persona','$this->nro_contrato','$this->fecha_contrato','$this->observacion','$this->etiqueta','$this->costo_dif_men','POR INSTALAR','$this->direc_adicional','$this->numero_casa','$this->id_edif','$this->numero_piso','$this->postel','$this->taps','$this->pto','$this->id_g_a','$this->id_urb','$this->cod_id_persona','$this->contrato_fisico','$this->etiqueta_n','$this->tipo_fact','$this->contrato_imp','$this->ultima_act')");
				
			 	require_once "contrato_servicio_temp.php";
				$obj_cst=new contrato_servicio_temp($this->dat);
				 $resp=$obj_cst->incluir_contrato_servicio($acceso,$this->id_contrato);

				$acceso->objeto->ejecutarSql("Update recibos Set status_pago='FACTURADO' Where nro_recibo='$this->contrato_fisico' and tipo='CONTRATO' ");
				$this->ordenInstalacion($acceso);
			
		
		$acceso->objeto->ejecutarSql("select * from contrato_servicio where id_contrato='$this->id_contrato'");
		if($acceso->objeto->registros<=0){
			$acceso->objeto->sql_error=$acceso->objeto->sql_error."NO SE REGISTRARON LOS SERVICIOS SUSCRITOS";
		}else{
			$obj_venta_contrato->agregar_cargo_afiliacion($acceso);
			$acceso->objeto->ejecutarSql("select update_saldo('$this->id_contrato');");
		}
	}
	public function modificar($acceso)
	{
		parent::modificar($acceso);
			$this->ultima_act=date("Y-m-d");
			$resp=$acceso->objeto->ejecutarSql("Update contrato Set id_calle='$this->id_calle',observacion='$this->observacion', etiqueta='$this->etiqueta',  costo_dif_men='$this->costo_dif_men',   direc_adicional='$this->direc_adicional', numero_casa='$this->numero_casa', id_edif='$this->id_edif', numero_piso='$this->numero_piso', postel='$this->postel', taps='$this->taps', pto='$this->pto', id_g_a='$this->id_g_a', id_urb='$this->id_urb', cod_id_persona='$this->cod_id_persona', contrato_fisico='$this->contrato_fisico', etiqueta_n='$this->etiqueta_n', tipo_fact='$this->tipo_fact', contrato_imp='$this->contrato_imp', ultima_act='$this->ultima_act' Where id_contrato='$this->id_contrato'");
		
	}

	public function ordenInstalacion($acceso)
	{
		session_start();
		$ini_u = $_SESSION["ini_u"]; 
		$acceso->objeto->ejecutarSql("select id_contrato from contrato where id_contrato='$this->id_contrato' ");
		if($row=row($acceso)){
				
				require_once "ordenes_tecnicos.php";
				$id_det_orden="DEO00001";
				
				$acceso->objeto->ejecutarSql("select id_orden from ordenes_tecnicos  where (id_orden ILIKE '$ini_u%')   ORDER BY id_orden desc LIMIT 1 offset 0 ");
				$id_orden=$ini_u.verCodLong($acceso,"id_orden");
				$dat = array();
				$dat['id_orden']=$id_orden;
				$dat['id_det_orden']=$id_det_orden;
				$dat['id_contrato']=$this->id_contrato;
				$dat['detalle_orden']="GENERADO AUTOMATICAMENTE";
				$dat['comentario_orden']='';
				$dat['prioridad']='NORMAL';

				$obj=new ordenes_tecnicos($dat);
				$obj->incluir($acceso);
				return true;
		}
	}
}
?>