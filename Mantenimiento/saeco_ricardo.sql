--
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODO328', 'REGISTRAR PAGO DEPOSITO', 'REGISTRAR PAGO DEPOSITO', 'REGISTRAR PAGO DEPOSITO', 'ACTIVO');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODO329', 'CONFIRMAR PAGO DEPOSITO', 'CONFIRMAR PAGO DEPOSITO', 'CONFIRMAR PAGO DEPOSITO', 'ACTIVO');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODO330', 'PROCESAR PAGO DEPOSITO', 'PROCESAR PAGO DEPOSITO', 'PROCESAR PAGO DEPOSITO', 'ACTIVO');



ALTER TABLE banco ADD tipo_banco character(25);
update banco set tipo_banco='';



ALTER TABLE pagodeposito ADD obser_p character(255);


CREATE OR REPLACE VIEW vista_pagodeposito AS 
 SELECT persona.cedula, persona.nombre, persona.apellido, contrato.nro_contrato, 
    sector.nombre_sector, franquicia.nombre_franq, franquicia.id_franq, 
    pagodeposito.monto_dep, pagodeposito.id_pd, pagodeposito.id_contrato, 
    pagodeposito.fecha_reg, pagodeposito.hora_reg, pagodeposito.login_reg, 
    pagodeposito.fecha_dep, pagodeposito.banco, pagodeposito.numero_ref, 
    pagodeposito.fecha_conf, pagodeposito.hora_conf, pagodeposito.login_conf, 
    pagodeposito.fecha_proc, pagodeposito.tipo_dt, pagodeposito.login_proc, 
    pagodeposito.status_pd, ciudad.id_mun, pagodeposito.cedula_titular,obser_p
   FROM cliente, contrato, calle, sector, persona, zona, ciudad, municipio, 
    estado, franquicia, pagodeposito
  WHERE cliente.id_persona = contrato.cli_id_persona AND contrato.id_calle = calle.id_calle AND calle.id_sector = sector.id_sector AND sector.id_zona = zona.id_zona AND persona.id_persona = cliente.id_persona AND zona.id_ciudad = ciudad.id_ciudad AND ciudad.id_mun = municipio.id_mun AND municipio.id_esta = estado.id_esta AND estado.id_franq = franquicia.id_franq AND pagodeposito.id_contrato = contrato.id_contrato
  ORDER BY pagodeposito.fecha_reg, pagodeposito.hora_reg;
