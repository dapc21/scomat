
--LISTADO DE SALDOS NEGATIVOS DE BOXI PARA REVISION
select nro_contrato,cedula,nombre, apellido, (select sum(costo_cobro) from contrato_servicio_deuda where contrato_servicio_deuda.id_contrato=vista_contrato.id_contrato and costo_cobro<0) as saldo

 from vista_contrato where 
(select sum(costo_cobro) from contrato_servicio_deuda where contrato_servicio_deuda.id_contrato=vista_contrato.id_contrato and costo_cobro<0)<0
 limit 10000000;

 
 
 --PARA ACTUALIZAR LOS SALDOS NEGATIVOS EN EL CAMPO DEUDA ANTERIOR DE CONTRATO
update contrato set  costo_contrato=(select sum(costo_cobro) from contrato_servicio_deuda where contrato_servicio_deuda.id_contrato=contrato.id_contrato and costo_cobro<0) where (select sum(costo_cobro) from contrato_servicio_deuda where contrato_servicio_deuda.id_contrato=contrato.id_contrato and costo_cobro<0)<0






--LISTADO DE CLIENTES CON MAS DE 2 CONTRATOS
select nro_contrato,cedula,nombre, apellido

 from vista_contrato where (select count(*) from contrato where contrato.cli_id_persona=vista_contrato.cli_id_persona )>1 order by cedula,nro_contrato;