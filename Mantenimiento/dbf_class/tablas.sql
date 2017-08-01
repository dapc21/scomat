CREATE TABLE cliente
( CodiClie character(255), CodSuscrip character(255), Suspendido character(255), RifClie character(255), CodiZona character(255), PTOSADIC character(255), NombComp character(255), NombClie character(255), NombClie1 character(255), apeclie character(255), apeclie1 character(255), DireClie character(255), email character(255), teleClie character(255), teleclie1 character(255), teleclie2 character(255), teleclie3 character(255), teleclie4 character(255), CIUDAD character(255), curba character(255), staespecial character(255), CANALPRE character(255), cantpri character(255), codmensual character(255), codmensec character(255), coddireccion character(255), NomUrbaniza character(255), TipoVivienda character(255), NomConjuntoResid character(255), NomEdif character(255), CodVereda character(255), CodAvenida character(255), CodTrans character(255), CodCallejon character(255), ncalle character(255), nvereda character(255), navenida character(255), ntransversal character(255), ncallejon character(255), nromanzana character(255), nombmanzana character(255), ala character(255), ubicavivienda character(255), TIPOVIVI character(255), UVIVIENDA character(255), NPISO character(255), NAPTO character(255), TORRE character(255), urba character(255), FECHACONTRATO character(255), InicClie character(255), fechainstalacion character(255), fechnac character(255), tag character(255), poste character(255), ncaja character(255), NitClie character(255), ReprClie character(255), DiasClie character(255), ncontrato character(255), NOMZONA character(255), PorcDesc character(255), RefeClie character(255), SucuClie character(255), Imprimir character(255), TipoClien character(255), CantCond character(255), TipoClie character(255), CodiEmpr character(255), fechafinal character(255), ObseOrden character(255), FechaOrden character(255), StatusOrden character(255), FechaOrFinal character(255), NUMORDEN character(255), PAGOADELANTO character(255), FaxClie character(255), CredClie character(255), MContrato character(255), Vendedor character(255));

); INSERT INTO cliente VALUES ('


'CREATE TABLE orden
( CODICLIE character(255),RIFCLIE character(255),NOMBCLIE character(255),DIRECLIE character(255),TELECLIE character(255),teleclie1 character(255),teleclie2 character(255),teleclie3 character(255),INICCLIE character(255),conorden character(255),CODIZONA character(255),NCONTRATOS character(255),PTOSADIC character(255),NUEVO character(255),CodiEmpr character(255),OBSERVACION character(255),tipoorden character(255),PRESCINTO character(255),poste character(255),ncaja character(255),FINAL character(255),STATUS character(255),sweli character(255),REFER character(255),TECNICO character(255),RESPONSA character(255),CONVENIO character(255),usuario character(255),CantConectores character(255),CantBalas character(255),CantSplinters character(255),TipoMaterial character(255),CABLE character(255),BALAS character(255),CONECTORES character(255),SPLITTER character(255),GRAPAS  character(255));

); INSERT INTO orden VALUES ('

'
delete from cliente;
delete from cuentaco;
delete from orden;
delete from zona;




INSERT INTO persona VALUES ('ENT00001', '10000000', 'INTERNO','INTERNO','');
INSERT INTO entidad VALUES ('ENT00001','TE001','INTERNO', 'ACTIVO');
INSERT INTO tipo_entidad (id_te, nombre_te, status_te) VALUES ('TE001', 'INTERNO                                           ', 'INTERNO        ');



