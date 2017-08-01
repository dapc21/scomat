DROP VIEW public.vista_franq;
DROP VIEW public.vistamodulo;
DROP VIEW public.vista_zona1;
DROP VIEW public.vista_vendedor;
DROP VIEW public.vista_urb;
DROP VIEW public.vista_ubicli;
DROP VIEW public.vista_tiposerv;
DROP VIEW public.vista_tipopago;
DROP VIEW public.vista_tecnico;
DROP VIEW public.vista_tarifa;
DROP VIEW public.vista_sms;
DROP VIEW public.vista_servicio_status;
DROP VIEW public.vista_serv;
DROP VIEW public.vista_sector1;
DROP VIEW public.vista_resumen_orden;
DROP VIEW public.vista_reportemovimiento;
DROP VIEW public.vista_reporteinventario;
DROP VIEW public.vista_rep_orden;
DROP VIEW public.vista_reclamo;
DROP VIEW public.vista_recibos;
DROP VIEW public.vista_pser;
DROP VIEW public.vista_servicios;
DROP VIEW public.vista_ps_est;
DROP VIEW public.vista_promocion;
DROP VIEW public.vista_planillaped;
DROP VIEW public.vista_planillamov;
DROP VIEW public.vista_planillainv;
DROP VIEW public.vista_pedido;
DROP VIEW public.vista_para_cortar;
DROP VIEW public.vista_pagodeposito;
DROP VIEW public.vista_pago_ser;
DROP VIEW public.vista_pago_cont;
DROP VIEW public.vista_ordengrupo;
DROP VIEW public.vista_orden_rep_con;
DROP VIEW public.vista_orden_rep;
DROP VIEW public.vista_orden_imp;
DROP VIEW public.vista_orden;
DROP VIEW public.vista_orden;
DROP VIEW public.vista_notas;
DROP VIEW public.vista_ubica;
DROP VIEW public.vista_municipio;
DROP VIEW public.vista_movimiento_mov_mat_uni;
DROP VIEW public.vista_movimiento_mov_mat;
DROP VIEW public.vista_mov_materiales;
DROP VIEW public.vista_mov_mat_o;
DROP VIEW public.vista_modelo;
DROP VIEW public.vista_matped_und;
DROP VIEW public.vista_matped;
DROP VIEW public.vista_matpadre_und;
DROP VIEW public.vista_matpadre;
DROP VIEW public.vista_materialesuniinv;
DROP VIEW public.vista_materiales_unid;
DROP VIEW public.vista_materiales_prov;
DROP VIEW public.vista_materiales_orden;
DROP VIEW public.vista_materiales;
DROP VIEW public.vista_llamadas;
DROP VIEW public.vista_interfaz_equipo;
DROP VIEW public.vista_gt_tec_per;
DROP VIEW public.vista_grupoubicacion;
DROP VIEW public.vista_grupotecnico;
DROP VIEW public.vista_grupo;
DROP VIEW public.vista_gerentes;
--DROP VIEW public.vista_estado;
DROP VIEW public.vista_equipo_sistema;
DROP VIEW public.vista_entidad;
DROP VIEW public.vista_edificio1;
DROP VIEW public.vista_edificio;
DROP VIEW public.vista_deudacli;
DROP VIEW public.vista_deuda;
DROP VIEW public.vista_detalleorden;
DROP VIEW public.vista_convenio;
DROP VIEW public.vista_contratoser;
DROP VIEW public.vista_contratorec;
DROP VIEW public.vista_contratodeu_f;




/*

ALTER TABLE estado  DROP id_franq;
ALTER TABLE zona  DROP id_franq;
ALTER TABLE zona  DROP id_franq;

*/
update franquicia set municipio_franq='';
ALTER TABLE franquicia ALTER column municipio_franq TYPE character(8);
ALTER TABLE franquicia rename column municipio_franq to id_emp;

ALTER TABLE franquicia  DROP ciudad_franq;

update franquicia set estado_franq='';
ALTER TABLE franquicia ALTER column estado_franq TYPE character(8);
ALTER TABLE franquicia rename column estado_franq to obser_franq;

ALTER TABLE franquicia  DROP abrev_franq;


ALTER TABLE ONLY public.contrato DROP CONSTRAINT fk_contrato_relations_vendedor;

update contrato set id_persona='';
ALTER TABLE contrato rename column id_persona to id_venta;
ALTER TABLE ONLY contrato
    ADD CONSTRAINT fk_venta_contrato FOREIGN KEY (id_venta) REFERENCES venta_contrato(id_venta) ON UPDATE RESTRICT ON DELETE RESTRICT;


update contrato set urbanizacion='';
ALTER TABLE contrato ALTER column urbanizacion TYPE character(10);
ALTER TABLE contrato rename column urbanizacion to id_urb;

update contrato set edificio='';
ALTER TABLE contrato ALTER column edificio TYPE character(10);
ALTER TABLE contrato rename column edificio to id_edif;



ALTER TABLE contrato  DROP hora_contrato;
ALTER TABLE contrato  DROP nro_factura;
ALTER TABLE contrato  DROP nro_abo;
ALTER TABLE contrato  DROP otra_dir;
ALTER TABLE contrato  DROP vitacora;
ALTER TABLE contrato  DROP new_cont;
ALTER TABLE contrato  DROP costo_contrato;





ALTER TABLE statuscont ALTER column idstatus TYPE character(20);
ALTER TABLE statuscont rename column idstatus to status_contrato;


