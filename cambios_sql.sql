Agregue campo en la tabla
Contrato_servicio_deuda (descu,modo_des)
Contrato_servicio_pagado (descu,modo_des)



update contrato_servicio_pagado set descu=0;
update contrato_servicio_deuda set descu=0;
update contrato_servicio_deuda set modo_des='AUTOMATICO';

agregre base_imp en pagos
CREATE OR REPLACE VIEW vista_contrato_dir AS 
 SELECT contrato.id_contrato, calle.id_calle, calle.nombre_calle, 
    sector.id_sector, sector.nombre_sector, zona.id_zona, zona.nombre_zona, 
    ciudad.id_ciudad, ciudad.id_mun, ciudad.nombre_ciudad, municipio.id_esta, 
    municipio.nombre_mun, estado.id_franq, estado.nombre_esta, 
    franquicia.nombre_franq
   FROM contrato, sector, zona, ciudad, franquicia, municipio, estado, calle
  WHERE contrato.id_calle = calle.id_calle AND calle.id_sector = sector.id_sector AND sector.id_zona = zona.id_zona AND zona.id_ciudad = ciudad.id_ciudad AND ciudad.id_mun = municipio.id_mun AND municipio.id_esta = estado.id_esta AND estado.id_franq = franquicia.id_franq;

  