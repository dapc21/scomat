<fieldset >
	  <legend class="fuenteN"<?php echo _("listado de variables disponibles");?></legend>
		<table border="0" width="500px" align="CENTER" cellpadding="4" cellspacing="4"> 
		<tr>
			<td>
				<span class="fuenteN"><?php echo _("variable");?></span>
			</td>
			
			<td>
				<span class="fuenteN"><?php echo _("descripcion");?></span>
			</td>
			
		</tr>
<?php
require_once("../procesos.php");  $ini_u = $_SESSION["ini_u"]; 
$tipo_variable=$_GET['tipo_variable'];
//echo "select *from variables_sms where status_var='ACTIVO' and (tipo_var ILIKE '%$tipo_variable%')";
			$acceso->objeto->ejecutarSql("select *from variables_sms where status_var='ACTIVO' and (tipo_var ILIKE '%$tipo_variable%')");
			$i=1;
			$bgc=array("0"=>"tbl-row-even","1"=>"tbl-row-odd");
			$fill=1;
			while ($row=row($acceso))
			{
				$fill=!$fill;
				$id_var=trim($row["id_var"]);		
				$variable=trim($row["variable"]);
				$descrip_var=trim($row["descrip_var"]);
				echo "
				<tr class='$bgc[$fill]'>
					<td>
						<span class='fuenteNormal'>$variable</span>
					</td>
					<td>
						<span class='fuenteNormal'>$descrip_var</span>
					</td>
					
				</tr>
				";
				$i++;
			}
?>

</table>
		</fieldset>