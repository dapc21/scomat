DROP VIEW vista_pedido_material;

ALTER TABLE pedido_material ADD COLUMN cant_comp_mat numeric(20,2) NOT NULL DEFAULT 0.00;

CREATE OR REPLACE VIEW vista_pedido_material AS 
 SELECT pedido_material.id_ped_mat,
    pedido_material.id_ped,
    pedido_material.id_stock,
    pedido_material.cant_ped_mat,
    pedido_material.cant_comp_mat,
    stock_material.id_alm,
    stock_material.id_mat,
    stock_material.stock,
    stock_material.stock_min,
    pedido.id_estatus_reg,
    pedido.ref_ped,
    pedido.fecha_ped,
    pedido.id_est_ped,
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
    estatus_pedido,
    stock_material,
    almacen,
    material,
    unidad_medida uni_med1,
    unidad_medida uni_med2,
    estatus_registro
  WHERE pedido_material.id_ped::text = pedido.id_ped::text AND pedido_material.id_stock::text = stock_material.id_stock::text AND pedido.id_est_ped::text = estatus_pedido.id_est_ped::text AND stock_material.id_alm = almacen.id_alm::bpchar AND stock_material.id_mat = material.id_mat::bpchar AND material.id_uni::text = uni_med1.id_uni::text AND material.uni_id_uni::text = uni_med2.id_uni::text AND pedido.id_estatus_reg = estatus_registro.id_estatus_reg
  ORDER BY pedido.fecha_ped;

ALTER TABLE vista_pedido_material
  OWNER TO postgres;
