
<style type="text/Css">
table.page_header {width: 100%; border: none; background-color: #DDDDFF; border-bottom: solid 1mm #AAAADD; padding: 2mm }
table.page_footer {width: 100%; border: none; background-color: #DDDDFF; border-top: solid 1mm #AAAADD; padding: 2mm}
</style>
<?php
require_once("../procesos.php"); 
?>
<page backtop="14mm" backbottom="14mm" backleft="1mm" backright="1mm" style="font-size: 12pt">
    <page_header>
        <table class="page_header">
            <tr>
                <td style="width: 50%; text-align: left">
                    SAECOSOFT, C.A.
                </td>
                <td style="width: 50%; text-align: right">
                    REPORTE DE PERSONAS
                </td>
            </tr>
        </table>
    </page_header>
    <page_footer>
        <table class="page_footer">
            <tr>
                <td style="width: 33%; text-align: left;">
                    reporte
                </td>
                <td style="width: 34%; text-align: center">
                    page [[page_cu]]/[[page_nb]]
                </td>
                <td style="width: 33%; text-align: right">
                    &copy;Saecosoft,C.A. 2012-2015
                </td>
            </tr>
        </table>
    </page_footer>

    <table style="width: 100%;" border="1" cellpadding="0" cellspacing="0">
        
            <?php 
                $acceso->objeto->ejecutarSql("select * from persona limit 2000000 ");
                while ($row=row($acceso))
                {
                    $cedula=trim($row["cedula"]);
                    $nombre=trim($row["nombre"]);
                    $apellido=trim($row["apellido"]);
                    $telefono=trim($row["telefono"]);
                    echo '<tr ><td style="width: 35%;">'.$cedula.'</td><td style="width: 25%;">'.$nombre.'</td><td style="width: 25%;">'.$apellido.'</td><td style="width: 25%;">'.$telefono.'</td></tr>';
                }
            ?>
            
        
    </table>
</page>