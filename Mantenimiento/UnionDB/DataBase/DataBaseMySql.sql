CREATE TABLE `modulo` (  `codigomodulo` char(7) NOT NULL,  `nombremodulo` char(25) default NULL,  `descripcionmodulo` varchar(1000) default NULL,  `statusmodulo` char(8) default NULL,  `namemodulo` varchar(50) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `modulo` VALUES ('MODU001', 'Modulo', 'ads', 'Activo', 'Modulo');
INSERT INTO `modulo` VALUES ('MODU003', 'Usuario', 'usuario', 'Activo', 'Usuario');
INSERT INTO `modulo` VALUES ('MODU002', 'Perfil', 'perfil', 'Activo', 'Perfil');
INSERT INTO `modulo` VALUES ('MODU004', 'Persona', 'persona', 'Activo', 'Persona');
INSERT INTO `modulo` VALUES ('MODU005', 'CreaFormulario', 'para crear formulario', 'Activo', 'CreaFormulario');
INSERT INTO `modulo` VALUES ('MODU006', 'VerDatos', 'para ver los datos', 'Activo', 'VerDatos');
INSERT INTO `modulo` VALUES ('MODU007', 'LimpiarProyecto', 'Modulo Dedicado a la Limpieza del codigo', 'Activo', 'LimpiarProyecto');
INSERT INTO `modulo` VALUES ('MODU008', 'Generar Reportes', 'GenerarReportes', 'Activo', 'GenerarReportes');

CREATE TABLE `moduloperfil` (  `codigoperfil` char(7) NOT NULL,  `codigomodulo` char(7) NOT NULL,  `incluir` char(5) NOT NULL,  `modificar` char(5) NOT NULL,  `eliminar` char(5) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `moduloperfil` VALUES ('PERF001', 'MODU001', 'true', 'true', 'true');
INSERT INTO `moduloperfil` VALUES ('PERF001', 'MODU002', 'true', 'true', 'true');
INSERT INTO `moduloperfil` VALUES ('PERF001', 'MODU003', 'true', 'true', 'true');
INSERT INTO `moduloperfil` VALUES ('PERF001', 'MODU004', 'true', 'true', 'true');
INSERT INTO `moduloperfil` VALUES ('PERF001', 'MODU005', 'true', 'true', 'true');
INSERT INTO `moduloperfil` VALUES ('PERF001', 'MODU006', 'true', 'true', 'true');
INSERT INTO `moduloperfil` VALUES ('PERF001', 'MODU007', 'true', 'true', 'true');
INSERT INTO `moduloperfil` VALUES ('PERF001', 'MODU008', 'true', 'true', 'true');

CREATE TABLE `perfil` (  `codigoperfil` char(7) NOT NULL,  `nombreperfil` char(25) NOT NULL,  `descripcionperfil` varchar(1000) default NULL,  `statusperfil` char(8) default NULL,  PRIMARY KEY  (`codigoperfil`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `perfil` VALUES ('PERF001', 'Administrador', 'administrador de la aplicacion', 'Activo');

CREATE TABLE `persona` (  `dato` char(10) default NULL,  `idPersona` char(8) NOT NULL,  `cedula` char(8) default NULL,  `nombre` char(30) default NULL,  `apellido` char(30) default NULL,  PRIMARY KEY  (`idPersona`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `persona` (`dato`, `idPersona`, `cedula`, `nombre`, `apellido`) VALUES ('dato', 'COD00001', '12345678', 'Admin', 'Admin');

CREATE TABLE `usuario` (  `login` char(15) NOT NULL,  `codigoperfil` char(7) NOT NULL,  `cedulaempleado` char(9) NOT NULL,  `password` char(25) NOT NULL,  `statususuario` char(8) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `usuario` VALUES ('admin', 'PERF001', '12345678', 'admin', 'Activo');

CREATE  VIEW personausuario AS select persona.cedula AS cedula,persona.nombre AS nombre,persona.apellido AS apellido,usuario.login AS login from persona, usuario where usuario.cedulaempleado = persona.cedula;

CREATE  VIEW vistamodulo AS select perfil.codigoperfil AS codigoperfil,perfil.nombreperfil AS nombreperfil,perfil.descripcionperfil AS descripcionperfil,modulo.codigomodulo AS codigomodulo,modulo.nombremodulo AS nombremodulo,modulo.namemodulo AS namemodulo,moduloperfil.incluir AS incluir,moduloperfil.modificar AS modificar,moduloperfil.eliminar AS eliminar from perfil, modulo, moduloperfil where moduloperfil.codigomodulo = modulo.codigomodulo and modulo.statusmodulo = 'Activo' and moduloperfil.codigoperfil = perfil.codigoperfil and perfil.statusperfil = 'Activo';