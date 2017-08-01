
INSERT INTO persona VALUES ('ENT00001', '10000000', 'INTERNO','INTERNO','');
INSERT INTO entidad VALUES ('ENT00001','TE001','INTERNO', 'ACTIVO');


CREATE OR REPLACE VIEW vista_caja AS 
 SELECT caja_cobrador.id_caja_cob, caja_cobrador.id_caja, caja_cobrador.id_persona, caja_cobrador.fecha_caja, caja_cobrador.apertura_caja, caja_cobrador.cierre_caja, caja_cobrador.monto_acum, caja_cobrador.status_caja AS status_caja_cob, vista_cobrador.cedula, vista_cobrador.nombre, vista_cobrador.apellido, vista_cobrador.telefono, vista_cobrador.nro_cobrador, vista_cobrador.direccion_cob, caja.nombre_caja, caja.descripcion_caja, caja.status_caja, caja.inicial, caja.tipo_caja,caja.id_franq
   FROM vista_cobrador, caja, caja_cobrador
  WHERE caja_cobrador.id_caja = caja.id_caja AND caja_cobrador.id_persona = vista_cobrador.id_persona;

