-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.1.30-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win32
-- HeidiSQL Versión:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para salabv2
CREATE DATABASE IF NOT EXISTS `salabv2` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `salabv2`;

-- Volcando estructura para tabla salabv2.alumno
CREATE TABLE IF NOT EXISTS `alumno` (
  `noControl` bigint(10) NOT NULL,
  `nombre_al` varchar(45) DEFAULT NULL,
  `aPaterno_al` varchar(45) DEFAULT NULL,
  `aMaterno_al` varchar(45) DEFAULT NULL,
  `idCarrera` int(11) NOT NULL,
  PRIMARY KEY (`noControl`,`idCarrera`),
  KEY `fk_Alumnos_Carrera_idx` (`idCarrera`),
  CONSTRAINT `fk_Alumnos_Carrera` FOREIGN KEY (`idCarrera`) REFERENCES `carrera` (`idCarrera`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla salabv2.alumno: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `alumno` DISABLE KEYS */;
/*!40000 ALTER TABLE `alumno` ENABLE KEYS */;

-- Volcando estructura para tabla salabv2.asignatura
CREATE TABLE IF NOT EXISTS `asignatura` (
  `idAsignatura` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_as` varchar(45) DEFAULT NULL,
  `clave` varchar(45) DEFAULT NULL,
  `idCarrera` int(11) NOT NULL,
  `idProfesor` int(11) NOT NULL,
  `idEstatus` int(11) NOT NULL,
  PRIMARY KEY (`idAsignatura`,`idCarrera`,`idProfesor`,`idEstatus`),
  KEY `fk_Asignatura_Carrera1_idx` (`idCarrera`),
  KEY `fk_Asignatura_Profesor1_idx` (`idProfesor`),
  KEY `fk_Asignatura_Estatus1_idx` (`idEstatus`),
  CONSTRAINT `fk_Asignatura_Carrera1` FOREIGN KEY (`idCarrera`) REFERENCES `carrera` (`idCarrera`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Asignatura_Estatus1` FOREIGN KEY (`idEstatus`) REFERENCES `estatus` (`idEstatus`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Asignatura_Profesor1` FOREIGN KEY (`idProfesor`) REFERENCES `profesor` (`idProfesor`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla salabv2.asignatura: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `asignatura` DISABLE KEYS */;
/*!40000 ALTER TABLE `asignatura` ENABLE KEYS */;

-- Volcando estructura para tabla salabv2.aula
CREATE TABLE IF NOT EXISTS `aula` (
  `idAula` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_au` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idAula`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla salabv2.aula: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `aula` DISABLE KEYS */;
/*!40000 ALTER TABLE `aula` ENABLE KEYS */;

-- Volcando estructura para tabla salabv2.carrera
CREATE TABLE IF NOT EXISTS `carrera` (
  `idCarrera` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_ca` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idCarrera`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla salabv2.carrera: ~9 rows (aproximadamente)
/*!40000 ALTER TABLE `carrera` DISABLE KEYS */;
INSERT INTO `carrera` (`idCarrera`, `nombre_ca`) VALUES
	(1, 'INGENIERIA EN SISTEMAS COMPUTACIONALES'),
	(2, 'INGENIERIA EN ADMINISTRACION'),
	(3, 'INGENIERIA EN GESTION EMPRESARIAL'),
	(4, 'INGENIERIA INFORMATICA'),
	(5, 'INGENIERIA CIVIL'),
	(6, 'INGENIERIA MECATRONICA'),
	(7, 'INGENIERIA ELECTROMECANICA'),
	(8, 'LICENCIATURA EN ADMINISTRACION'),
	(9, 'CONTADOR PUBLICO');
/*!40000 ALTER TABLE `carrera` ENABLE KEYS */;

-- Volcando estructura para tabla salabv2.computadora
CREATE TABLE IF NOT EXISTS `computadora` (
  `idComputadora` int(11) NOT NULL AUTO_INCREMENT,
  `fabricante` varchar(45) DEFAULT NULL,
  `procesador` varchar(45) DEFAULT NULL,
  `memoriaInstalada` varchar(45) DEFAULT NULL,
  `discoDuro` varchar(45) DEFAULT NULL,
  `soVersion` varchar(45) DEFAULT NULL,
  `tipoSistema` varchar(45) DEFAULT NULL,
  `numeroSerie` varchar(45) DEFAULT NULL,
  `fechaAlta` datetime(6) DEFAULT NULL,
  `fechaIngreso` datetime(6) DEFAULT NULL,
  `comentarios` varchar(255) DEFAULT NULL,
  `idAula` int(11) NOT NULL,
  `control` int(11) DEFAULT '0',
  `idEstatus` int(11) NOT NULL,
  PRIMARY KEY (`idComputadora`,`idAula`,`idEstatus`),
  KEY `fk_Computadora_Estatus1_idx` (`idEstatus`),
  KEY `fk_Computadora_Aula1_idx` (`idAula`),
  CONSTRAINT `fk_Computadora_Aula1` FOREIGN KEY (`idAula`) REFERENCES `aula` (`idAula`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Computadora_Estatus1` FOREIGN KEY (`idEstatus`) REFERENCES `estatus` (`idEstatus`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla salabv2.computadora: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `computadora` DISABLE KEYS */;
/*!40000 ALTER TABLE `computadora` ENABLE KEYS */;

-- Volcando estructura para tabla salabv2.controllab
CREATE TABLE IF NOT EXISTS `controllab` (
  `idControlLab` int(11) NOT NULL AUTO_INCREMENT,
  `fechaInicio` datetime(6) DEFAULT NULL,
  `fechaFin` datetime(6) DEFAULT NULL,
  `noControl` bigint(10) NOT NULL,
  `idComputadora` int(11) DEFAULT NULL,
  `idEstatus` int(11) NOT NULL,
  PRIMARY KEY (`idControlLab`,`noControl`,`idEstatus`),
  KEY `fk_ControlLab_Estatus1_idx` (`idEstatus`),
  KEY `fk_ControlLab_Alumno1_idx` (`noControl`),
  CONSTRAINT `fk_ControlLab_Alumno1` FOREIGN KEY (`noControl`) REFERENCES `alumno` (`noControl`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ControlLab_Estatus1` FOREIGN KEY (`idEstatus`) REFERENCES `estatus` (`idEstatus`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla salabv2.controllab: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `controllab` DISABLE KEYS */;
/*!40000 ALTER TABLE `controllab` ENABLE KEYS */;

-- Volcando estructura para tabla salabv2.dispositivo
CREATE TABLE IF NOT EXISTS `dispositivo` (
  `idDispositivo` int(11) NOT NULL AUTO_INCREMENT,
  `fabricante` varchar(45) DEFAULT NULL,
  `modelo` varchar(45) DEFAULT NULL,
  `numeroSerie` varchar(45) DEFAULT NULL,
  `idTipoDispositivo` int(11) NOT NULL,
  `fechaAlta` datetime(6) DEFAULT NULL,
  `fechaIngreso` datetime(6) DEFAULT NULL,
  `comentarios` varchar(255) DEFAULT NULL,
  `idAula` int(11) NOT NULL,
  `idEstatus` int(11) NOT NULL DEFAULT '3',
  PRIMARY KEY (`idDispositivo`,`idTipoDispositivo`,`idAula`,`idEstatus`),
  KEY `fk_Monitor_Estatus1_idx` (`idEstatus`),
  KEY `fk_Inventario_Tipo_Equipo1_idx` (`idTipoDispositivo`),
  KEY `fk_Dispositivo_Aula1_idx` (`idAula`),
  CONSTRAINT `fk_Dispositivo_Aula1` FOREIGN KEY (`idAula`) REFERENCES `aula` (`idAula`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Inventario_Tipo_Equipo1` FOREIGN KEY (`idTipoDispositivo`) REFERENCES `tipodispositivo` (`idTipoDispositivo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Monitor_Estatus1` FOREIGN KEY (`idEstatus`) REFERENCES `estatus` (`idEstatus`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla salabv2.dispositivo: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `dispositivo` DISABLE KEYS */;
/*!40000 ALTER TABLE `dispositivo` ENABLE KEYS */;

-- Volcando estructura para tabla salabv2.estatus
CREATE TABLE IF NOT EXISTS `estatus` (
  `idEstatus` int(11) NOT NULL DEFAULT '1',
  `nombre_estatus` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idEstatus`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla salabv2.estatus: ~7 rows (aproximadamente)
/*!40000 ALTER TABLE `estatus` DISABLE KEYS */;
INSERT INTO `estatus` (`idEstatus`, `nombre_estatus`) VALUES
	(1, 'ACTIVO'),
	(2, 'INACTIVO'),
	(3, 'ALTA'),
	(4, 'BAJA'),
	(5, 'EN PROCESO'),
	(6, 'FINALIZADO'),
	(7, 'SEGUIMIENTO');
/*!40000 ALTER TABLE `estatus` ENABLE KEYS */;

-- Volcando estructura para tabla salabv2.horario
CREATE TABLE IF NOT EXISTS `horario` (
  `idHorario` int(11) NOT NULL AUTO_INCREMENT,
  `horaInicio` time(6) DEFAULT NULL,
  `horaFin` time(6) DEFAULT NULL,
  `dia` varchar(45) DEFAULT NULL,
  `idAula` int(11) NOT NULL,
  `idAsignatura` int(11) NOT NULL,
  `idCarrera` int(11) NOT NULL,
  `idProfesor` int(11) NOT NULL,
  `idEstatus` int(11) NOT NULL DEFAULT '3',
  PRIMARY KEY (`idHorario`,`idAula`,`idEstatus`),
  KEY `fk_Horario_Aula1_idx` (`idAula`),
  KEY `fk_Horario_Asignatura1_idx` (`idAsignatura`,`idCarrera`,`idProfesor`),
  KEY `fk_Horario_Estatus1_idx` (`idEstatus`),
  CONSTRAINT `fk_Horario_Asignatura1` FOREIGN KEY (`idAsignatura`, `idCarrera`, `idProfesor`) REFERENCES `asignatura` (`idAsignatura`, `idCarrera`, `idProfesor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Horario_Aula1` FOREIGN KEY (`idAula`) REFERENCES `aula` (`idAula`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Horario_Estatus1` FOREIGN KEY (`idEstatus`) REFERENCES `estatus` (`idEstatus`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla salabv2.horario: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `horario` DISABLE KEYS */;
/*!40000 ALTER TABLE `horario` ENABLE KEYS */;

-- Volcando estructura para tabla salabv2.incidencia
CREATE TABLE IF NOT EXISTS `incidencia` (
  `idIncidencia` int(11) NOT NULL AUTO_INCREMENT,
  `asunto` varchar(45) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `comentario` varchar(255) DEFAULT NULL,
  `fechaAlta` datetime(6) DEFAULT NULL,
  `fechaModificacion` datetime(6) DEFAULT NULL,
  `categoria` varchar(45) DEFAULT NULL,
  `idUsuario` int(11) NOT NULL,
  `idEstatus` int(11) NOT NULL DEFAULT '5',
  PRIMARY KEY (`idIncidencia`,`idUsuario`,`idEstatus`),
  KEY `fk_Incidencias_Usuario1_idx` (`idUsuario`),
  KEY `fk_Incidencias_Estatus1_idx` (`idEstatus`),
  CONSTRAINT `fk_Incidencias_Estatus1` FOREIGN KEY (`idEstatus`) REFERENCES `estatus` (`idEstatus`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Incidencias_Usuario1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla salabv2.incidencia: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `incidencia` DISABLE KEYS */;
/*!40000 ALTER TABLE `incidencia` ENABLE KEYS */;

-- Volcando estructura para tabla salabv2.profesor
CREATE TABLE IF NOT EXISTS `profesor` (
  `idProfesor` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_pr` varchar(45) DEFAULT NULL,
  `aPaterno_pr` varchar(45) DEFAULT NULL,
  `aMaterno_pr` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idProfesor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla salabv2.profesor: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `profesor` DISABLE KEYS */;
/*!40000 ALTER TABLE `profesor` ENABLE KEYS */;

-- Volcando estructura para tabla salabv2.reparacion
CREATE TABLE IF NOT EXISTS `reparacion` (
  `idReparacion` int(11) NOT NULL AUTO_INCREMENT,
  `diagnostico` varchar(45) DEFAULT NULL,
  `fechaInicio` datetime(6) DEFAULT NULL,
  `fechaFin` datetime(6) DEFAULT NULL,
  `idComputadora` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idEstatus` int(11) NOT NULL,
  PRIMARY KEY (`idReparacion`,`idUsuario`,`idEstatus`),
  KEY `fk_Reparacion_Computadora1_idx` (`idComputadora`),
  KEY `fk_Reparacion_Estatus1_idx` (`idEstatus`),
  KEY `fk_Reparacion_Usuario1_idx` (`idUsuario`),
  CONSTRAINT `fk_Reparacion_Computadora1` FOREIGN KEY (`idComputadora`) REFERENCES `computadora` (`idComputadora`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Reparacion_Estatus1` FOREIGN KEY (`idEstatus`) REFERENCES `estatus` (`idEstatus`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Reparacion_Usuario1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla salabv2.reparacion: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `reparacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `reparacion` ENABLE KEYS */;

-- Volcando estructura para tabla salabv2.tipodispositivo
CREATE TABLE IF NOT EXISTS `tipodispositivo` (
  `idTipoDispositivo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_tipdis` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idTipoDispositivo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla salabv2.tipodispositivo: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `tipodispositivo` DISABLE KEYS */;
INSERT INTO `tipodispositivo` (`idTipoDispositivo`, `nombre_tipdis`) VALUES
	(1, 'MOUSE'),
	(2, 'TECLADO'),
	(3, 'MONITOR'),
	(4, 'CAÑON');
/*!40000 ALTER TABLE `tipodispositivo` ENABLE KEYS */;

-- Volcando estructura para tabla salabv2.tipousuario
CREATE TABLE IF NOT EXISTS `tipousuario` (
  `idTipoUsuario` int(11) NOT NULL DEFAULT '3',
  `nombre_tipusr` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idTipoUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla salabv2.tipousuario: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `tipousuario` DISABLE KEYS */;
INSERT INTO `tipousuario` (`idTipoUsuario`, `nombre_tipusr`) VALUES
	(1, 'ADMIN'),
	(2, 'TIPO2'),
	(3, 'TIPO3');
/*!40000 ALTER TABLE `tipousuario` ENABLE KEYS */;

-- Volcando estructura para tabla salabv2.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_usr` varchar(45) NOT NULL,
  `aPaterno_usr` varchar(45) DEFAULT NULL,
  `aMaterno_usr` varchar(45) DEFAULT NULL,
  `email` varchar(45) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `fechaCreacion` datetime(6) DEFAULT NULL,
  `idTipoUsuario` int(11) NOT NULL DEFAULT '3',
  `idEstatus` int(11) DEFAULT '1',
  PRIMARY KEY (`idUsuario`,`idTipoUsuario`),
  KEY `fk_Usuario_TipoUsuario1_idx` (`idTipoUsuario`),
  CONSTRAINT `fk_Usuario_TipoUsuario1` FOREIGN KEY (`idTipoUsuario`) REFERENCES `tipousuario` (`idTipoUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla salabv2.usuario: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`idUsuario`, `nombre_usr`, `aPaterno_usr`, `aMaterno_usr`, `email`, `username`, `password`, `telefono`, `fechaCreacion`, `idTipoUsuario`, `idEstatus`) VALUES
	(1, 'EDUARDO', 'CAUICH', 'HERRERA', 'lalo_lego@hotmail.com', 'xsirlalo', '21232f297a57a5a743894a0e4a801fc3', '9982366146', '2018-05-31 11:48:02.000000', 1, 1);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
