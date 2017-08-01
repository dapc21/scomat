<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  

?>
<input  type="hidden" name="id_mov2" id="id_mov2" maxlength="10" size="30"onChange="validarmovimiento()" value="<?php $acceso->objeto->ejecutarSql("select *from movimiento where (id_mov ILIKE '$ini_u%') ORDER BY id_mov desc LIMIT 1 offset 0"); echo $ini_u.verCodLong2($acceso,"id_mov")?>">
<input  type="hidden" name="id_tmaunmento" id="id_tmaunmento" maxlength="10" size="30" value="A0000006">
<input  type="hidden" name="id_tmdescuento" id="id_tmdescuento" maxlength="10" size="30" value="A0000005">
<input  type="hidden" name="auxi" id="auxi" maxlength="10" size="30" value="0">
<fieldset >
			  <legend ><?php echo _("materiales utilizados en la realizacion de la orden");?></legend>	
<table border="0" width="97%" align="CENTER" > 

				<table border="0" width="97%" align="CENTER" cellpadding="4" cellspacing="4"> 
				<input  type="hidden"  name="id_mov" id="id_mov" maxlength="10" size="25"onChange="validarmovimiento()" value="<?php $acceso->objeto->ejecutarSql("select *from movimiento where (id_mov ILIKE '$ini_u%') ORDER BY id_mov desc LIMIT 1 offset 0"); echo $ini_u.verCodLong($acceso,"id_mov")?>">
				<input style="display:none;" type="checkbox" name="checkboxTrans" id="checkboxTrans" onclick="validaTransfer(this.id);">
				<input  type="hidden" name="id_tm" id="id_tm" maxlength="15" size="30" value="A0000002==SALIDA" >
				<input  type="hidden" disabled name="fecha_ent_sal" id="fecha_ent_sal" maxlength="10" size="15" value="<?php echo date("d/m/Y");?>" >
				<input  type="hidden" disabled name="hora_ent_sal" maxlength="15" size="10" value="<?php echo date("H:i:s");?>" >
				<input  type="hidden" name="id_persona" id="id_persona" maxlength="15" size="30" value="ENT00001" >	
				<input  type="hidden" name="referencia" maxlength="15" size="30" value="" >
				<input  type="hidden" name="observacion" maxlength="15" size="30" value="" >
				<input  type="hidden" name="tipo_mov" maxlength="20" size="30" value="MATERIALES" >
	
	
	  
		
				
					<input  type="hidden" name="iddep"  id="iddep" maxlength="15" size="30" value="" onchange="valIqualD();traermat();">
					<input  type="hidden" name="iddep2"  id="iddep2" maxlength="15" size="30" value="" onchange="valIqualD();traermat();">
												
				<input  type="hidden" name="numero_m" id="numero_m" maxlength="50" size="30" value="" onchange="agregar_ma_movit();">
						
				<table width="97%" cellspacing="1" cellpadding="1" border="0" align="CENTER">
					<tr>
						<td style="width: 10%;">
							<span class="fuente"><?php echo _("nro");?>
							</span>
						
						</td>
						<td style="width: 25%;">
							<span class="fuente"><?php echo _("nombre");?>
							</span>
						
						</td>
						<td style="width: 25%;">
							<span class="fuente"><?php echo _("cantidad");?>
							</span>
						</td>
						<td style="width: 25%;">
							<span class="fuente"><?php echo _("stock");?>
							</span>
						</td>
						<td style="width: 15%;">
							<span class="fuente"><?php echo _("stock min");?>
							</span>
						</td>
						
				</tr>
				</table>
				
					<div id="mov">
							<table width="97%" cellspacing="1" cellpadding="1" border="0" align="CENTER">
								<tr>
									<td style="width: 10%;">
										<input id="numero_mat" onChange="validarmat_padre_mov_mat02();" type="text" size="5" maxlength="10" value="" name="numero_mat">
									</td>
									<td style="width: 25%;">
										  <input id="nombre_mat" onChange="" type="text" size="25" maxlength="50" value="" name="nombre_mat">
									</td>
									<td style="width: 25%;">
										<input type="text" size="25" maxlength="30"  disabled>
									</td>
									<td style="width: 25%;">
										<input type="text" size="25" maxlength="30"  disabled>
									</td>
									<td style="width: 15%;">
										<input id="minver" type="text" size="5" maxlength="10" value="0" name="minver" onkeypress="return validar_numeros(event)" disabled="">
									</td>
								</tr>
					
							</table>			
					</div>	

					
						<input  type="hidden" name="idfam" id="idfam" >
						<input  type="hidden" name="id_unidad" id="id_unidad" >
						<input  type="hidden" name="uni_id_unidad" id="uni_id_unidad" >
						<input  type="hidden" name="c_uni_ent" id="c_uni_ent"  onKeyPress="return validar_numeros(event);"  onchange="pasaRvalorCan();" maxlength="4" size="5" value="1" style="text-align: left;">
						<input  type="hidden" name="c_uni_sal" id="c_uni_sal" >
						<input  type="hidden" name="id_fam" id="id_fam" >		
				
			
					<tr>
						<td colspan="2" rowspan="1">
							
							<div align="center" style=" float:center; width: 100%;">
								
									
									<div  style="display:block;width: 48%;float:left;border:1px; ">
										<div id="idregis1" style="display:block;width: auto;float:right;">
											<input  type="button" name="registrar_m" id="registrar_m" value="<?php echo _("agregar");?>" onclick="verificar_mat('incluir','movimiento')">
										</div>
										<div id="idregis2" style="display:none;width: auto;float:right;">
											<input  type="button" name="registrar1" id="registrar1" value="<?php echo _("agregar");?>" onclick="verificar_mat('incluir','movimiento_transferencia')">&nbsp;
										</div>
									</div>
									<div style="display:block;width: 48%;float:left;">
										<div  style="width: auto;float:left;">							
										
										&nbsp;&nbsp;<input  type="button" name="salir1" onclick="limpiarmov_mat()" value="<?php echo _("limpiar");?>">
										</div>
									</div>			
							</div>
							<div  style="display:none;">
								&nbsp;<input  type="button" name="modificar" value="<?php echo _("modificar");?>" onclick="verificar_mat('modificar','movimiento')">
								<input  type="button" name="eliminar" value="<?php echo _("eliminar");?>" onclick="verificar_mat('eliminar','movimiento')">
							</div>
						</td>
					</tr>
					<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12">						
						<div id="datagrid_mat" class="data"></div>		
					</div>
	 
	
	  
							
										&nbsp;&nbsp;<input  disabled type="hidden" name="imprimir"id="imprimir" onclick="ImprimirRep_reportemovimiento_new()" value="<?php echo _("imprimir");?>">
										
										
										&nbsp;&nbsp;<input  disabled type="hidden" name="imprimir1"id="imprimir1" onclick="ImprimirRep_reportemovimiento_new()" value="<?php echo _("imprimir movimiento");?>">
										&nbsp;&nbsp;<input  type="hidden" name="salir" onclick="conexionPHP_mat('formulario.php','movimiento')" value="<?php echo _("limpiar");?>">
									
	 
	 
	 
	</table>
	 </fieldset>
