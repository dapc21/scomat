CREATE OR REPLACE VIEW vista_almacen AS 
 SELECT almacen.id_alm,
    almacen.id_gt,
    almacen.id_enc,
    almacen.nombre_alm,
    almacen.descrip_alm,
    almacen.status_alm,
    almacen.direccion_alm,
    almacen.id_estatus_reg,
    almacen.codigo_alm,
    grupo_trabajo.nombre_grupo,
    persona.cedula,
    (persona.nombre::text || ' '::text) || persona.apellido::text AS encargado,
    persona.telefono,
    encargado.descrip_enc,
    encargado.status_enc
   FROM almacen,
    grupo_trabajo,
    persona,
    encargado,
    estatus_registro
  WHERE almacen.id_gt::bpchar = grupo_trabajo.id_gt::bpchar AND encargado.id_enc::text = almacen.id_enc::text AND encargado.id_persona::bpchar = persona.id_persona::bpchar AND almacen.id_estatus_reg = estatus_registro.id_estatus_reg
  ORDER BY almacen.nombre_alm;

ALTER TABLE vista_almacen
  OWNER TO postgres;
  
  
CREATE OR REPLACE VIEW vista_encargado AS 
 SELECT persona.id_persona,
    persona.cedula,
    persona.nombre,
    persona.apellido,
    persona.telefono,
    encargado.id_enc,
    encargado.descrip_enc,
    encargado.status_enc,
    encargado.id_estatus_reg
   FROM persona,
    encargado,
    estatus_registro
  WHERE persona.id_persona::bpchar = encargado.id_persona::bpchar AND encargado.id_estatus_reg = estatus_registro.id_estatus_reg
  ORDER BY persona.cedula;

ALTER TABLE vista_encargado
  OWNER TO postgres;
  
  
CREATE OR REPLACE VIEW vista_inventario AS 
 SELECT inventario.id_inv,
    inventario.id_mot_inv,
    inventario.id_alm,
    inventario.id_estatus_reg,
    inventario.id_est_inv,
    inventario.ref_inv,
    inventario.fecha_inv,
    inventario.hora_inv,
    inventario.obser_inv,
    almacen.id_gt,
    almacen.id_enc,
    almacen.codigo_alm,
    almacen.nombre_alm,
    almacen.descrip_alm,
    almacen.direccion_alm,
    almacen.status_alm,
    grupo_trabajo.nombre_grupo,
    encargado.descrip_enc,
    encargado.status_enc,
    persona.cedula,
    (persona.nombre::text || ' '::text) || persona.apellido::text AS encargado,
    estatus_inventario.nombre_est_inv,
    motivo_inventario.nombre_mot_inv
   FROM inventario,
    almacen,
    grupo_trabajo,
    encargado,
    persona,
    estatus_inventario,
    motivo_inventario,
    estatus_registro
  WHERE inventario.id_mot_inv::text = motivo_inventario.id_mot_inv::text AND inventario.id_alm::text = almacen.id_alm::text AND almacen.id_gt::text = grupo_trabajo.id_gt::text AND almacen.id_enc::text = encargado.id_enc::text AND encargado.id_persona::text = persona.id_persona::text AND inventario.id_est_inv::text = estatus_inventario.id_est_inv::text AND inventario.id_estatus_reg = estatus_registro.id_estatus_reg
  ORDER BY inventario.fecha_inv;

ALTER TABLE vista_inventario
  OWNER TO postgres;
  
  
  
CREATE OR REPLACE VIEW vista_inventario_material AS 
 SELECT inventario_material.id_inv_mat,
    inventario_material.id_inv,
    inventario_material.id_stock,
    inventario_material.cant_sist,
    inventario_material.cant_real,
    stock_material.id_alm AS id_alm_stock,
    stock_material.id_mat,
    stock_material.stock,
    stock_material.stock_min,
    inventario.id_mot_inv,
    inventario.id_alm AS id_alm_inv,
    inventario.id_estatus_reg,
    inventario.id_est_inv,
    inventario.ref_inv,
    inventario.fecha_inv,
    inventario.hora_inv,
    inventario.obser_inv,
    almacen.codigo_alm,
    almacen.nombre_alm,
    material.codigo_mat,
    material.nombre_mat,
    material.cant_uni_ent,
    material.cant_uni_sal,
    material.impreso,
    uni_med1.nombre_uni AS nombre_uni_ent,
    uni_med1.abrev_uni AS abrev_uni_ent,
    uni_med1.status_uni AS status_uni_ent,
    uni_med2.nombre_uni AS nombre_uni_sal,
    uni_med2.abrev_uni AS abrev_uni_sal,
    uni_med2.status_uni AS status_uni_sal,
    estatus_inventario.nombre_est_inv,
    motivo_inventario.nombre_mot_inv
   FROM inventario_material,
    inventario,
    stock_material,
    almacen,
    material,
    unidad_medida uni_med1,
    unidad_medida uni_med2,
    estatus_inventario,
    motivo_inventario,
    estatus_registro
  WHERE inventario_material.id_inv::text = inventario.id_inv::text AND inventario_material.id_stock::text = stock_material.id_stock::text AND stock_material.id_alm = almacen.id_alm::bpchar AND stock_material.id_mat = material.id_mat::bpchar AND material.id_uni::text = uni_med1.id_uni::text AND material.uni_id_uni::text = uni_med2.id_uni::text AND inventario.id_mot_inv::text = motivo_inventario.id_mot_inv::text AND inventario.id_est_inv::text = estatus_inventario.id_est_inv::text AND inventario.id_estatus_reg = estatus_registro.id_estatus_reg
  ORDER BY inventario.fecha_inv;

ALTER TABLE vista_inventario_material
  OWNER TO postgres;
  
  
CREATE OR REPLACE VIEW vista_material AS 
 SELECT material.id_mat,
    material.id_fam,
    material.id_uni,
    material.uni_id_uni,
    material.codigo_mat,
    material.nombre_mat,
    material.cant_uni_ent,
    material.cant_uni_sal,
    material.impreso,
    material.id_estatus_reg,
    uni_med1.nombre_uni AS nombre_uni_ent,
    uni_med1.abrev_uni AS abrev_uni_ent,
    uni_med1.status_uni AS status_uni_ent,
    uni_med2.nombre_uni AS nombre_uni_sal,
    uni_med2.abrev_uni AS abrev_uni_sal,
    uni_med2.status_uni AS status_uni_sal,
    familia.nombre_fam,
    familia.descrip_fam,
    familia.status_fam
   FROM material,
    unidad_medida uni_med1,
    unidad_medida uni_med2,
    familia,
    estatus_registro
  WHERE material.id_uni::text = uni_med1.id_uni::text AND material.uni_id_uni::text = uni_med2.id_uni::text AND material.id_fam::text = familia.id_fam::text AND material.id_estatus_reg = estatus_registro.id_estatus_reg
  ORDER BY material.nombre_mat;

ALTER TABLE vista_material
  OWNER TO postgres;
  
  
CREATE OR REPLACE VIEW vista_motivo_movimiento AS 
 SELECT motivo_movimiento.id_mot_mov,
    motivo_movimiento.nombre_mot_mov,
    motivo_movimiento.status_mot_mov,
    motivo_movimiento.id_estatus_reg,
    tipo_movimiento.id_tipo_mov,
    tipo_movimiento.nombre_tipo_mov,
    tipo_movimiento.descrip_tipo_mov,
    tipo_movimiento.status_tipo_mov
   FROM motivo_movimiento,
    tipo_movimiento,
    estatus_registro
  WHERE motivo_movimiento.id_tipo_mov::text = tipo_movimiento.id_tipo_mov::text AND motivo_movimiento.id_estatus_reg = estatus_registro.id_estatus_reg
  ORDER BY motivo_movimiento.nombre_mot_mov;

ALTER TABLE vista_motivo_movimiento
  OWNER TO postgres;

  
CREATE OR REPLACE VIEW vista_movimiento AS 
 SELECT movimiento.id_mov,
    movimiento.id_res,
    movimiento.id_alm,
    movimiento.id_tipo_mov,
    movimiento.ref_mov,
    movimiento.fecha_mov,
    movimiento.hora_mov,
    movimiento.mot_mov,
    tipo_movimiento.nombre_tipo_mov,
    responsable.descrip_res,
    persona.cedula AS cedula_responsable,
    (persona.nombre::text || ' '::text) || persona.apellido::text AS responsable,
    tipo_responsable.nombre_tipo_res,
    almacen.id_gt,
    almacen.id_enc,
    almacen.codigo_alm,
    almacen.nombre_alm,
    almacen.descrip_alm,
    almacen.direccion_alm,
    almacen.status_alm,
    grupo_trabajo.nombre_grupo,
    encargado.descrip_enc,
    encargado.status_enc,
    persona.cedula AS cedula_encargado,
    (persona.nombre::text || ' '::text) || persona.apellido::text AS encargado
   FROM movimiento,
    almacen,
    grupo_trabajo,
    tipo_movimiento,
    responsable,
    tipo_responsable,
    encargado,
    persona,
    estatus_registro
  WHERE movimiento.id_tipo_mov::text = tipo_movimiento.id_tipo_mov::text AND tipo_responsable.id_tipo_res::text = responsable.id_tipo_res::text AND movimiento.id_res::text = responsable.id_res::text AND responsable.id_persona::text = persona.id_persona::text AND movimiento.id_alm::text = almacen.id_alm::text AND almacen.id_gt::text = grupo_trabajo.id_gt::text AND almacen.id_enc::text = encargado.id_enc::text AND encargado.id_persona::text = persona.id_persona::text AND movimiento.id_estatus_reg = estatus_registro.id_estatus_reg
  ORDER BY movimiento.fecha_mov;

ALTER TABLE vista_movimiento
  OWNER TO postgres;
  
  
CREATE OR REPLACE VIEW vista_movimiento_material AS 
 SELECT movimiento_material.id_mov_mat,
    movimiento_material.id_stock,
    movimiento_material.id_mov,
    movimiento_material.cant_mov_mat,
    movimiento_material.id_estatus_reg,
    stock_material.id_mat,
    stock_material.id_alm AS id_alm_stock,
    stock_material.stock,
    stock_material.stock_min,
    movimiento.id_tipo_mov,
    movimiento.id_res,
    movimiento.ref_mov,
    movimiento.id_alm AS id_alm_mov,
    movimiento.mot_mov,
    movimiento.fecha_mov,
    movimiento.hora_mov,
    tipo_movimiento.nombre_tipo_mov,
    tipo_movimiento.descrip_tipo_mov,
    tipo_movimiento.status_tipo_mov,
    perso1.cedula AS cedula_res,
    (perso1.nombre::text || ' '::text) || perso1.apellido::text AS responsable,
    perso1.telefono AS telefono_res,
    responsable.id_tipo_res,
    responsable.id_persona,
    responsable.descrip_res,
    responsable.status_res,
    tipo_responsable.nombre_tipo_res,
    tipo_responsable.status_tipo_res,
    almacen.id_gt,
    almacen.id_enc,
    almacen.nombre_alm,
    almacen.descrip_alm,
    almacen.status_alm,
    almacen.direccion_alm,
    almacen.codigo_alm,
    grupo_trabajo.nombre_grupo,
    perso2.cedula AS cedula_enc,
    (perso2.nombre::text || ' '::text) || perso2.apellido::text AS encargado,
    perso2.telefono AS telefono_enc,
    encargado.descrip_enc,
    encargado.status_enc,
    material.codigo_mat,
    material.nombre_mat,
    material.cant_uni_ent,
    material.cant_uni_sal,
    material.impreso,
    uni_med1.nombre_uni AS nombre_uni_ent,
    uni_med1.abrev_uni AS abrev_uni_ent,
    uni_med1.status_uni AS status_uni_ent,
    uni_med2.nombre_uni AS nombre_uni_sal,
    uni_med2.abrev_uni AS abrev_uni_sal,
    uni_med2.status_uni AS status_uni_sal,
    familia.nombre_fam,
    familia.descrip_fam,
    familia.status_fam
   FROM movimiento_material,
    movimiento,
    stock_material,
    tipo_movimiento,
    responsable,
    tipo_responsable,
    almacen,
    grupo_trabajo,
    persona perso1,
    persona perso2,
    encargado,
    material,
    unidad_medida uni_med1,
    unidad_medida uni_med2,
    familia,
    estatus_registro
  WHERE movimiento_material.id_stock::text = stock_material.id_stock::text AND movimiento_material.id_mov::text = movimiento.id_mov::text AND movimiento.id_tipo_mov::text = tipo_movimiento.id_tipo_mov::text AND movimiento.id_res::text = responsable.id_res::text AND responsable.id_persona::bpchar = perso1.id_persona::bpchar AND responsable.id_tipo_res::text = tipo_responsable.id_tipo_res::text AND stock_material.id_mat = material.id_mat::bpchar AND stock_material.id_alm = almacen.id_alm::bpchar AND almacen.id_gt::bpchar = grupo_trabajo.id_gt::bpchar AND encargado.id_enc::text = almacen.id_enc::text AND encargado.id_persona::bpchar = perso2.id_persona::bpchar AND material.id_uni::text = uni_med1.id_uni::text AND material.uni_id_uni::text = uni_med2.id_uni::text AND material.id_fam::text = familia.id_fam::text AND movimiento_material.id_estatus_reg = estatus_registro.id_estatus_reg
  ORDER BY almacen.nombre_alm, material.nombre_mat;

ALTER TABLE vista_movimiento_material
  OWNER TO postgres;
  
  

CREATE OR REPLACE VIEW vista_pedido_material AS 
 SELECT pedido_material.id_ped_mat,
    pedido_material.id_ped,
    pedido_material.id_stock,
    pedido_material.cant_ped_mat,
    stock_material.id_alm,
    stock_material.id_mat,
    stock_material.stock,
    stock_material.stock_min,
    pedido.id_estatus_reg,
    pedido.ref_ped,
    pedido.fecha_ped,
    pedido.status_ped,
    pedido.obser_ped,
    almacen.codigo_alm,
    almacen.nombre_alm,
    material.codigo_mat,
    material.nombre_mat,
    material.cant_uni_ent,
    material.cant_uni_sal,
    material.impreso,
    uni_med1.nombre_uni AS nombre_uni_ent,
    uni_med1.abrev_uni AS abrev_uni_ent,
    uni_med1.status_uni AS status_uni_ent,
    uni_med2.nombre_uni AS nombre_uni_sal,
    uni_med2.abrev_uni AS abrev_uni_sal,
    uni_med2.status_uni AS status_uni_sal
   FROM pedido_material,
    pedido,
    stock_material,
    almacen,
    material,
    unidad_medida uni_med1,
    unidad_medida uni_med2,
    estatus_registro
  WHERE pedido_material.id_ped::text = pedido.id_ped::text AND pedido_material.id_stock::text = stock_material.id_stock::text AND stock_material.id_alm = almacen.id_alm::bpchar AND stock_material.id_mat = material.id_mat::bpchar AND material.id_uni::text = uni_med1.id_uni::text AND material.uni_id_uni::text = uni_med2.id_uni::text AND pedido.id_estatus_reg = estatus_registro.id_estatus_reg
  ORDER BY pedido.fecha_ped;

ALTER TABLE vista_pedido_material
  OWNER TO postgres;
  
  
  
CREATE OR REPLACE VIEW vista_responsable AS 
 SELECT persona.id_persona,
    persona.cedula,
    persona.nombre,
    persona.apellido,
    persona.telefono,
    responsable.id_res,
    responsable.descrip_res,
    responsable.status_res,
    responsable.id_estatus_reg,
    tipo_responsable.id_tipo_res,
    tipo_responsable.nombre_tipo_res,
    tipo_responsable.status_tipo_res
   FROM persona,
    responsable,
    tipo_responsable,
    estatus_registro
  WHERE persona.id_persona::bpchar = responsable.id_persona::bpchar AND responsable.id_tipo_res::text = tipo_responsable.id_tipo_res::text AND responsable.id_estatus_reg = estatus_registro.id_estatus_reg
  ORDER BY persona.cedula;

ALTER TABLE vista_responsable
  OWNER TO postgres;

  

CREATE OR REPLACE VIEW vista_stock_material AS 
 SELECT stock_material.id_stock,
    stock_material.id_mat,
    stock_material.id_alm,
    stock_material.stock,
    stock_material.stock_min,
    stock_material.id_estatus_reg,
    almacen.id_gt,
    almacen.id_enc,
    almacen.nombre_alm,
    almacen.descrip_alm,
    almacen.status_alm,
    almacen.direccion_alm,
    almacen.codigo_alm,
    grupo_trabajo.nombre_grupo,
    persona.cedula,
    (persona.nombre::text || ' '::text) || persona.apellido::text AS encargado,
    persona.telefono,
    encargado.descrip_enc,
    encargado.status_enc,
    material.codigo_mat,
    material.nombre_mat,
    material.cant_uni_ent,
    material.cant_uni_sal,
    material.impreso,
    uni_med1.nombre_uni AS nombre_uni_ent,
    uni_med1.abrev_uni AS abrev_uni_ent,
    uni_med1.status_uni AS status_uni_ent,
    uni_med2.nombre_uni AS nombre_uni_sal,
    uni_med2.abrev_uni AS abrev_uni_sal,
    uni_med2.status_uni AS status_uni_sal,
    familia.nombre_fam,
    familia.descrip_fam,
    familia.status_fam
   FROM stock_material,
    almacen,
    grupo_trabajo,
    persona,
    encargado,
    material,
    unidad_medida uni_med1,
    unidad_medida uni_med2,
    familia,
    estatus_registro
  WHERE stock_material.id_mat = material.id_mat::bpchar AND stock_material.id_alm = almacen.id_alm::bpchar AND almacen.id_gt::bpchar = grupo_trabajo.id_gt::bpchar AND encargado.id_enc::text = almacen.id_enc::text AND encargado.id_persona::bpchar = persona.id_persona::bpchar AND material.id_uni::text = uni_med1.id_uni::text AND material.uni_id_uni::text = uni_med2.id_uni::text AND material.id_fam::text = familia.id_fam::text AND stock_material.id_estatus_reg = estatus_registro.id_estatus_reg
  ORDER BY almacen.nombre_alm, material.nombre_mat;

ALTER TABLE vista_stock_material
  OWNER TO postgres;
  
  
