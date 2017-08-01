
CREATE OR REPLACE VIEW vista_pago_cont AS 
 SELECT pagos.id_pago, pagos.id_caja_cob, pagos.fecha_pago, pagos.hora_pago, 
    pagos.monto_pago, pagos.status_pago, pagos.nro_factura, pagos.id_contrato, 
    contrato.id_calle, contrato.cli_id_persona, contrato.nro_contrato, 
    contrato.status_contrato, persona.cedula AS cedulacli, 
    persona.nombre AS nombrecli, persona.apellido AS apellidocli, 
    cliente.tipo_cliente, cliente.inicial_doc, caja.tipo_caja, 
    caja_cobrador.id_persona AS id_persona_cob, contrato.taps, pagos.cont, 
    caja.id_caja, caja.id_franq, pagos.nro_control, pagos.desc_pago 
    ,pagos.base_imp
    ,pagos.monto_iva
    ,pagos.monto_reten
    ,pagos.islr
    ,pagos.n_credito
    
   FROM cliente, pagos, contrato, persona, caja_cobrador, caja
  WHERE persona.id_persona = cliente.id_persona AND cliente.id_persona = contrato.cli_id_persona AND contrato.id_contrato = pagos.id_contrato AND pagos.id_caja_cob = caja_cobrador.id_caja_cob AND caja_cobrador.id_caja = caja.id_caja
  ORDER BY pagos.id_pago;
  
  
  
  
CREATE OR REPLACE VIEW vista_pago_ser AS 
 SELECT pagos.id_caja_cob, pagos.fecha_pago, pagos.monto_pago, 
    contrato_servicio_pagado.cant_serv, contrato_servicio_pagado.costo_cobro, 
    contrato_servicio_pagado.id_serv, pagos.status_pago, caja.tipo_caja, 
    pagos.id_pago, contrato_servicio_pagado.fecha_inst, 
    servicios.nombre_servicio, caja.id_franq, caja_cobrador.id_est, 
    contrato_servicio_pagado.descu
   FROM pago_servicio, pagos, contrato_servicio_pagado, caja_cobrador, caja, 
    servicios
  WHERE pagos.id_pago = pago_servicio.id_pago AND pago_servicio.id_cont_serv = contrato_servicio_pagado.id_cont_serv AND pagos.id_caja_cob = caja_cobrador.id_caja_cob AND caja_cobrador.id_caja = caja.id_caja AND contrato_servicio_pagado.id_serv = servicios.id_serv;

  
  
CREATE OR REPLACE VIEW vista_tipopago AS 
 SELECT detalle_tipopago.id_tipo_pago, detalle_tipopago.id_pago, 
    detalle_tipopago.banco, detalle_tipopago.numero, detalle_tipopago.monto_tp, 
    pagos.id_caja_cob, pagos.fecha_pago, pagos.hora_pago, pagos.monto_pago, 
    pagos.obser_pago, pagos.status_pago, pagos.nro_factura, tipo_pago.tipo_pago, 
    caja.tipo_caja, pagos.id_contrato, caja.id_franq, caja_cobrador.id_est, 
    pagos.monto_reten, pagos.islr
   FROM detalle_tipopago, pagos, tipo_pago, caja_cobrador, caja
  WHERE detalle_tipopago.id_tipo_pago = tipo_pago.id_tipo_pago AND detalle_tipopago.id_pago = pagos.id_pago AND pagos.id_caja_cob = caja_cobrador.id_caja_cob AND caja_cobrador.id_caja = caja.id_caja
  ORDER BY pagos.fecha_pago;
