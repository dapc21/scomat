
delete from pago_factura;

delete from detalle_tipopago;

delete from contrato_servicio_deuda;
delete from pagos;
delete from abo_cortados;
delete from mov_mat_orden;
delete from mov_mat;
delete from movimiento_orden;
delete from movimiento;
delete from mat_ped;
delete from pedido;
delete from mat_prov;
delete from proveedor;
delete from inventario_materiales;
delete from inventario;
delete from materiales ;


delete from mat_padre;


delete from mov_mat_orden;
delete from mov_mat;
delete from movimiento_orden;
delete from movimiento;
delete from est_clientes;
delete from est_ingreso;
delete from est_ordenes;
delete from est_tecnicos;
delete from grupo_ubicacion;
delete from mov_mat;
delete from movimiento;
delete from entidad where id_persona<>'ENT00001' ;
delete from auditoria;
delete from auditoria_comp;
--delete from mensualidad;
delete from orden_grupo;
delete from grupo_tecnico;
delete from grupo_trabajo;
delete from gerentes_permitidos;
delete from notas;
delete from recuperado;
delete from contrato_servicio;

delete from visitas;
delete from ordenes_tecnicos;
delete from contrato;
delete from reclamo_denuncia;
delete from comentario_cliente;
delete from cierre_pago;
delete from cierre_pago_et;
delete from caja_cobrador;
delete from cirre_diario;
delete from inventario_materiales;
delete from inventario;
delete from pago_comisiones;
delete from cobrador;
delete from vendedor;
delete from tecnico;
delete from cliente;


delete from tarifa_servicio;
delete from Servicios;
delete from edificio;
delete from edificio;
delete from calle;



------------------
delete from urbanizacion;

delete from sector;
delete from zona;
delete from ciudad;
delete from municipio;
delete from estado;


delete from notas;
delete from contrato_servicio_deuda;

delete from pagos;
delete from ordenes_tecnicos;
delete from contrato_servicio;

delete from detalle_tipopago;






delete from comandos_sms;
delete from grupo_tecnico;
delete from orden_grupo;
delete from grupo_trabajo;
delete from mantenimiento;
delete from pago_comisiones;
delete from sms;
delete from sms_sinc;
delete from tarifa_servicio;
delete from gerentes_permitidos;
delete from cliente;
delete from cobrador;
delete from tecnico;
delete from vendedor;
delete from camb_prop;
delete from usuario where login <> 'ADMIN';

delete from persona where id_persona<>'PER00001' and id_persona<>'ENT00001' ;


delete from recibos;
delete from asig_lla_cli;
delete from asigna_llamada;
delete from asigna_recibo;
delete from cablemodem;
delete from cablemodem_interfaz;
delete from cierre_historico;
delete from cierre_pago_et;
delete from cirre_diario_et;
delete from info_adic;
delete from llamadas;
delete from mat_padre;
delete from proceso_corte;
delete from recibe_recibo;
delete from tabla_cortes;

delete from deposito where id_dep<>'A0000001' ;



--inicial_id



