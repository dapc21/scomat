CREATE OR REPLACE VIEW vista_pagoser AS 
 SELECT pagos.id_pago, pagos.id_caja_cob, pagos.fecha_pago, pagos.hora_pago, pagos.monto_pago, pagos.obser_pago, pagos.status_pago, pagos.nro_factura, pago_servicio.id_cont_serv, vista_contratoser.id_serv, vista_contratoser.id_contrato, vista_contratoser.fecha_inst, vista_contratoser.cant_serv, vista_contratoser.status_con_ser, vista_contratoser.id_tipo_servicio, vista_contratoser.nombre_servicio, vista_contratoser.status_serv, vista_contratoser.tipo_servicio, vista_contratoser.status_servicio, vista_contratoser.nombre_franq, vista_contratoser.municipio_franq, vista_contratoser.ciudad_franq, vista_contratoser.estado_franq, vista_contratoser.direccion_franq, vista_contratoser.id_tar_ser, vista_contratoser.fecha_tar_ser, vista_contratoser.hora_tar_ser, vista_contratoser.obser_tarifa_ser, vista_contratoser.status_tarifa_ser, vista_contratoser.tarifa_ser, vista_contratoser.costo_dif_men, vista_contratoser.nro_contrato, vista_contratoser.cedulacli, vista_contratoser.nombrecli, vista_contratoser.apellidocli, vista_contratoser.tipo_costo, vista_contratoser.costo_cobro, detalle_tipopago.banco, detalle_tipopago.numero, tipo_pago.tipo_pago, tipo_pago.id_tipo_pago
   FROM pago_servicio, pagos, vista_contratoser, detalle_tipopago, tipo_pago
  WHERE pagos.id_pago = pago_servicio.id_pago AND pago_servicio.id_cont_serv = vista_contratoser.id_cont_serv AND detalle_tipopago.id_pago = pagos.id_pago AND detalle_tipopago.id_tipo_pago = tipo_pago.id_tipo_pago
  ORDER BY pagos.fecha_pago, pagos.hora_pago;
  
 
 id_franq,id_contrato,fecha_pago,hora_pago,monto_pago,nro_factura,cedulacli,nombrecli,apellidocli
  
  nombre_servicio,tipo_costo,fecha_inst,cant_serv,costo_cobro

  
  
  id_contrato, cedulacli,nombrecli,apellidocli, nombre_servicio,tipo_costo, fecha_inst, cant_serv, costo_cobro
  
  CREATE OR REPLACE VIEW vista_contratoser AS 
 SELECT contrato_servicio.id_cont_serv, contrato_servicio.id_serv, contrato_servicio.id_contrato, contrato_servicio.fecha_inst, contrato_servicio.cant_serv, contrato_servicio.status_con_ser, vista_tarifa.id_tipo_servicio, vista_tarifa.nombre_servicio, vista_tarifa.status_serv, vista_tarifa.tipo_servicio, vista_tarifa.status_servicio, vista_tarifa.id_franq, vista_tarifa.nombre_franq, vista_tarifa.municipio_franq, vista_tarifa.ciudad_franq, vista_tarifa.estado_franq, vista_tarifa.direccion_franq, vista_tarifa.id_tar_ser, vista_tarifa.fecha_tar_ser, vista_tarifa.hora_tar_ser, vista_tarifa.obser_tarifa_ser, vista_tarifa.status_tarifa_ser, vista_tarifa.tarifa_ser, vista_contrato.costo_dif_men, vista_contrato.nro_contrato, vista_contrato.cedula AS cedulacli, vista_contrato.nombre AS nombrecli, vista_contrato.apellido AS apellidocli, vista_tarifa.tipo_costo, contrato_servicio.costo_cobro, vista_contrato.id_calle, vista_contrato.id_sector, vista_contrato.nro_calle, vista_contrato.nombre_calle, vista_contrato.id_zona, vista_contrato.nro_sector, vista_contrato.nombre_sector, vista_contrato.nro_zona, vista_contrato.nombre_zona, vista_contrato.status_contrato
   FROM contrato_servicio, vista_tarifa, vista_contrato
  WHERE contrato_servicio.id_serv = vista_tarifa.id_serv AND contrato_servicio.id_contrato = vista_contrato.id_contrato AND vista_tarifa.status_tarifa_ser = 'ACTIVO'::bpchar
  ORDER BY contrato_servicio.id_cont_serv;
  

  SELECT contrato_servicio.id_contrato, contrato_servicio.fecha_inst, contrato_servicio.cant_serv, contrato_servicio.costo_cobro
  , vista_contrato.cedula AS cedulacli, vista_contrato.nombre AS nombrecli, vista_contrato.apellido AS apellidocli
  , vista_tarifa.nombre_servicio, vista_tarifa.tipo_costo 
   FROM contrato_servicio, vista_tarifa, vista_contrato
  WHERE contrato_servicio.id_serv = vista_tarifa.id_serv AND contrato_servicio.id_contrato = vista_contrato.id_contrato AND vista_tarifa.status_tarifa_ser = 'ACTIVO'::bpchar
  ORDER BY contrato_servicio.id_cont_serv;
  
  , vista_contrato.cedula AS cedulacli, vista_contrato.nombre AS nombrecli, vista_contrato.apellido AS apellidocli
  
  CREATE OR REPLACE VIEW vista_contrato AS 
 SELECT 
 contrato.id_contrato, contrato.id_calle, contrato.id_persona, contrato.cli_id_persona, contrato.nro_contrato, contrato.fecha_contrato, contrato.hora_contrato, contrato.observacion, contrato.etiqueta, contrato.costo_contrato, contrato.costo_dif_men, contrato.status_contrato, contrato.nro_factura, vista_cliente.cedula, vista_cliente.nombre, vista_cliente.apellido, vista_cliente.telefono, vista_cliente.telf_casa, vista_cliente.email, contrato.direc_adicional, contrato.numero_casa, vista_calle.id_sector, vista_calle.nro_calle, vista_calle.nombre_calle, vista_calle.id_zona, vista_calle.nro_sector, vista_calle.nombre_sector, vista_calle.id_franq, vista_calle.nro_zona, vista_calle.nombre_zona, vista_calle.nombre_franq, vista_calle.municipio_franq, vista_calle.ciudad_franq, vista_calle.estado_franq, vista_calle.direccion_franq, contrato.edificio, contrato.numero_piso, vista_cliente.telf_adic
   FROM contrato, vista_cliente, vista_calle
  WHERE contrato.id_calle = vista_calle.id_calle AND contrato.cli_id_persona = vista_cliente.id_persona
  ORDER BY contrato.nro_contrato;
  
  SELECT vista_cliente.cedula , vista_cliente.nombre, vista_cliente.apellido
  FROM contrato, vista_cliente
  WHERE contrato.cli_id_persona = vista_cliente.id_persona
  ORDER BY contrato.nro_contrato;
  
  
  
  CREATE OR REPLACE VIEW vista_contrato AS 
  SELECT pagos.id_pago,pagos.id_caja_cob,pagos.fecha_pago, pagos.hora_pago,pagos.monto_pago,pagos.nro_factura, 
  contrato_servicio.id_contrato, contrato_servicio.fecha_inst, contrato_servicio.cant_serv, contrato_servicio.costo_cobro
  ,contrato.nro_contrato, vista_cliente.cedula AS cedulacli, vista_cliente.nombre AS nombrecli, vista_cliente.apellido AS apellidocli
  , vista_tarifa.id_serv, vista_tarifa.nombre_servicio, vista_tarifa.tipo_costo 
   FROM pago_servicio, pagos, contrato_servicio, vista_tarifa, contrato, vista_cliente
  WHERE pagos.id_pago = pago_servicio.id_pago AND pago_servicio.id_cont_serv = contrato_servicio.id_cont_serv and contrato_servicio.id_serv = vista_tarifa.id_serv AND contrato_servicio.id_contrato = contrato.id_contrato AND vista_tarifa.status_tarifa_ser = 'ACTIVO'::bpchar and contrato.cli_id_persona = vista_cliente.id_persona
  ORDER BY pagos.fecha_pago, pagos.hora_pago;
  
  
  
 SELECT contrato.id_contrato, contrato.id_calle, contrato.id_persona, contrato.cli_id_persona, contrato.nro_contrato, contrato.fecha_contrato, contrato.hora_contrato, contrato.observacion, contrato.etiqueta, contrato.costo_contrato, contrato.costo_dif_men, contrato.status_contrato, contrato.nro_factura, 
persona.cedula, persona.nombre, persona.apellido, persona.telefono, cliente.telf_casa, cliente.email, 
contrato.direc_adicional, contrato.numero_casa, 
calle.id_sector, calle.nro_calle, calle.nombre_calle, 
zona.id_zona, sector.nro_sector, sector.nombre_sector, zona.id_franq, zona.nro_zona, zona.nombre_zona, 
franquicia.nombre_franq, franquicia.municipio_franq, franquicia.ciudad_franq, franquicia.estado_franq, franquicia.direccion_franq, 
contrato.edificio, contrato.numero_piso, cliente.telf_adic
   FROM contrato, persona, cliente,calle,sector,zona,franquicia
  WHERE contrato.id_calle = calle.id_calle AND contrato.cli_id_persona = cliente.id_persona and persona.id_persona = cliente.id_persona
  and calle.id_sector = sector.id_sector and sector.id_zona = zona.id_zona and zona.id_franq = franquicia.id_franq
  ORDER BY contrato.nro_contrato;
  
  
  
  CREATE OR REPLACE VIEW vista_para_cortar AS
SELECT id_contrato,nro_contrato,id_franq,apellido,nombre,status_contrato,  
(select sum(cant_serv*costo_cobro) from contrato_servicio where contrato_servicio.id_contrato = vista_contrato.id_contrato and status_con_ser='DEUDA') as deuda   ,
nombre_calle,nombre_sector,nombre_zona,nombre_franq,id_calle,id_sector,id_zona  FROM vista_contrato where vista_contrato.status_contrato='ACTIVO'



  (select fecha_inst from contrato_servicio where contrato_servicio.id_contrato = vista_contrato.id_contrato and status_con_ser='DEUDA') as fecha_inst
  


CREATE OR REPLACE VIEW vista_orden AS 
 SELECT ordenes_tecnicos.id_orden, ordenes_tecnicos.id_persona, ordenes_tecnicos.id_det_orden, ordenes_tecnicos.fecha_orden, ordenes_tecnicos.fecha_final, ordenes_tecnicos.detalle_orden, ordenes_tecnicos.comentario_orden, ordenes_tecnicos.status_orden, ordenes_tecnicos.id_contrato, vista_tecnico.cedula, vista_tecnico.nombre, vista_tecnico.apellido, vista_tecnico.telefono, vista_tecnico.num_tecnico, vista_tecnico.direccion_tec, vista_detalleorden.id_tipo_orden, vista_detalleorden.nombre_det_orden, vista_detalleorden.nombre_tipo_orden, vista_contrato.nro_contrato, vista_contrato.cedula AS cedulacli, vista_contrato.nombre AS nombrecli, vista_contrato.apellido AS apellidocli, vista_detalleorden.tipo_detalle, vista_contrato.etiqueta, ordenes_tecnicos.prioridad
   FROM vista_tecnico, vista_detalleorden, vista_contrato, ordenes_tecnicos
  WHERE ordenes_tecnicos.id_persona = vista_tecnico.id_persona AND ordenes_tecnicos.id_det_orden = vista_detalleorden.id_det_orden AND ordenes_tecnicos.id_contrato = vista_contrato.id_contrato;

ALTER TABLE vista_orden OWNER TO postgres;

  
  
  
  
select ordenes_tecnicos.id_orden, ordenes_tecnicos.id_persona, ordenes_tecnicos.id_det_orden, ordenes_tecnicos.fecha_orden, ordenes_tecnicos.fecha_final, ordenes_tecnicos.detalle_orden, ordenes_tecnicos.comentario_orden, ordenes_tecnicos.status_orden, ordenes_tecnicos.id_contrato, ordenes_tecnicos.prioridad, 
tipo_orden.id_tipo_orden, tipo_orden.nombre_tipo_orden, 
persona.cedula as cedulacli, persona.nombre as nombrecli, persona.apellido as apellidocli, 
 vista_tecnico.cedula, vista_tecnico.nombre, vista_tecnico.apellido, 
cliente.id_persona, 
  detalle_orden.nombre_det_orden, detalle_orden.tipo_detalle, 
 contrato.id_persona, contrato.cli_id_persona, contrato.nro_contrato, contrato.etiqueta, contrato.status_contrato 
from detalle_orden, contrato, ordenes_tecnicos, tipo_orden, persona, vista_tecnico, cliente 
where tipo_orden.id_tipo_orden = detalle_orden.id_tipo_orden and detalle_orden.id_det_orden = ordenes_tecnicos.id_det_orden and ordenes_tecnicos.id_persona = vista_tecnico.id_persona and ordenes_tecnicos.id_contrato = contrato.id_contrato and contrato.cli_id_persona = cliente.id_persona and cliente.id_persona = persona.id_persona order by ordenes_tecnicos.id_orden Asc

