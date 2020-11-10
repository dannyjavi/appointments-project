-- MySQL dump 10.16  Distrib 10.1.37-MariaDB, for debian-linux-gnueabihf (armv8l)
--
-- Host: localhost    Database:'proyecto-one
-- ------------------------------------------------------
-- Server version	10.1.37-MariaDB-0+deb9u1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `citas`
--

DROP TABLE IF EXISTS `citas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `citas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `color` varchar(255) NOT NULL,
  `textcolor` varchar(255) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `sesion` time NOT NULL,
  `idPaciente` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `citas`
--

LOCK TABLES `citas` WRITE;
/*!40000 ALTER TABLE `citas` DISABLE KEYS */;
INSERT INTO `citas` VALUES (2,'prueba con id','prueba con id','','','2019-02-22 16:00:00','2019-02-22 18:00:00','01:00:00',21),(6,'prueba 22 de febrero','prueba 22 de febrero','','#FFFFFF','0000-00-00 00:00:00','0000-00-00 00:00:00','01:00:00',21),(7,'prueba 22 de febrero','prueba 22 de febrero','','#FFFFFF','2019-02-19 12:00:00','2019-02-19 12:00:00','01:00:00',16),(9,'prueba 4','prueba 4','','#FFFFFF','2019-02-20 12:00:00','2019-02-20 12:00:00','01:00:00',21),(10,'prueba 5','prueba 5','','#FFFFFF','2019-02-21 12:00:00','2019-02-21 12:00:00','01:00:00',21),(11,'prueba 6','prueba 6','','#FFFFFF','2019-02-18 12:00:00','2019-02-18 12:00:00','00:30:00',21),(12,'999','99999','','#FFFFFF','2019-02-19 12:00:00','2019-02-19 12:00:00','01:00:00',21),(15,'prueba','prueba','','#FFFFFF','2019-02-13 12:00:00','2019-02-13 12:00:00','01:00:00',21),(16,'prueba','prueba','','#FFFFFF','2019-02-13 12:00:00','2019-02-13 12:00:00','01:00:00',21),(17,'prueba','prueba','','#FFFFFF','2019-02-13 12:00:00','2019-02-13 12:00:00','01:00:00',21),(18,'prueba','prueba','','#FFFFFF','2019-02-13 12:00:00','2019-02-13 12:00:00','01:00:00',21),(21,'sabado','sabado','','#FFFFFF','2019-02-12 12:00:00','2019-02-12 12:00:00','00:30:00',21),(22,'sabado','sabado','','#FFFFFF','2019-02-12 12:00:00','2019-02-12 12:00:00','00:30:00',21),(23,'sabado','sabado','','#FFFFFF','2019-02-11 12:00:00','2019-02-11 12:00:00','01:00:00',21),(24,'sabado','sabado','','#FFFFFF','2019-02-11 12:00:00','2019-02-11 12:00:00','01:00:00',21),(25,'sabado','sabado','','#FFFFFF','2019-02-15 12:00:00','2019-02-15 12:00:00','01:00:00',16),(26,'probando si solo veo esto','probando si solo veo esto','','#FFFFFF','2019-02-26 12:00:00','2019-02-26 12:00:00','00:30:00',16);
/*!40000 ALTER TABLE `citas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `configuracion`
--

DROP TABLE IF EXISTS `configuracion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `configuracion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `host` varchar(50) NOT NULL,
  `puerto` int(11) NOT NULL,
  `email_emisor` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `asunto` varchar(50) NOT NULL,
  `cuerpo` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configuracion`
--

LOCK TABLES `configuracion` WRITE;
/*!40000 ALTER TABLE `configuracion` DISABLE KEYS */;
INSERT INTO `configuracion` VALUES (1,'smtp.gmail.com',587,'root@gmail.es','root','Bienvenido','Hola, Buenas noches. <br>Saludos');
/*!40000 ALTER TABLE `configuracion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contactos`
--

DROP TABLE IF EXISTS `contactos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contactos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(80) NOT NULL,
  `email` varchar(80) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contactos`
--

LOCK TABLES `contactos` WRITE;
/*!40000 ALTER TABLE `contactos` DISABLE KEYS */;
INSERT INTO `contactos` VALUES (1,'Contacto Gmail','gmail@hotmail.com'),(2,'Contacto Hotmail','facebook@hotmail.com');
/*!40000 ALTER TABLE `contactos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `evaluacion`
--

DROP TABLE IF EXISTS `evaluacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `evaluacion` (
  `idDiagnostico` int(10) NOT NULL AUTO_INCREMENT,
  `antecedentes` varchar(255) NOT NULL DEFAULT '',
  `ttoprevio` varchar(200) NOT NULL,
  `diagnostico` varchar(200) DEFAULT '',
  `tratamiento` varchar(200) DEFAULT NULL,
  `tipo` varchar(10) DEFAULT NULL,
  `agravante` varchar(200) DEFAULT NULL,
  `hernia` varchar(200) DEFAULT NULL,
  `restriccion` varchar(200) DEFAULT NULL,
  `idPaciente` int(10) NOT NULL,
  PRIMARY KEY (`idDiagnostico`),
  KEY `idPaciente` (`idPaciente`),
  CONSTRAINT `evaluacion_ibfk_1` FOREIGN KEY (`idPaciente`) REFERENCES `pacientes` (`idPaciente`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `evaluacion`
--

LOCK TABLES `evaluacion` WRITE;
/*!40000 ALTER TABLE `evaluacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `evaluacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `horario`
--

DROP TABLE IF EXISTS `horario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `horario` (
  `idConfiguracion` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `desde` time NOT NULL DEFAULT '00:00:00',
  `hasta` time NOT NULL DEFAULT '00:00:00',
  `instructor` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`idConfiguracion`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `horario`
--

LOCK TABLES `horario` WRITE;
/*!40000 ALTER TABLE `horario` DISABLE KEYS */;
INSERT INTO `horario` VALUES (12,'00:00:00','00:00:00',NULL);
/*!40000 ALTER TABLE `horario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mis_eventos`
--

DROP TABLE IF EXISTS `mis_eventos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mis_eventos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(250) DEFAULT NULL,
  `color` varchar(10) DEFAULT NULL,
  `inicio` datetime DEFAULT NULL,
  `fin` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mis_eventos`
--

LOCK TABLES `mis_eventos` WRITE;
/*!40000 ALTER TABLE `mis_eventos` DISABLE KEYS */;
INSERT INTO `mis_eventos` VALUES (1,'Reunion Colegio','#0071c5','2018-04-23 09:00:00','2018-04-23 11:00:00'),(2,'Gimnasio Gym','#40e0d0','2018-04-13 14:00:00','2018-04-13 17:00:00'),(3,'Reunion accionistas','#FFD700','2018-04-23 08:00:00','2018-04-23 09:00:00'),(4,'Reunion acreedores','#40e0d0','2018-04-23 10:00:00','2018-04-23 11:00:00'),(5,'Reunion con el Banco','#0071c5','2018-04-23 11:00:00','2018-04-13 12:00:00'),(6,'Reunion con amigos','#FFD700','2018-04-23 13:00:00','2018-04-23 14:00:00'),(7,'Reunion de trabajo','#0071c5','2018-04-23 14:00:00','2018-04-23 15:00:00'),(8,'Reunion semanal','#FFD700','2018-04-23 16:00:00','2018-04-23 17:00:00'),(9,'Pago de telefono','#228B22','2018-04-24 18:00:00','2018-04-24 20:00:00'),(10,'bailar','#0071c5','2018-12-03 08:00:00','2018-12-03 11:30:00'),(11,'nb mvjhb','#FFD700','2018-12-03 00:00:00','2018-12-04 00:00:00');
/*!40000 ALTER TABLE `mis_eventos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pacientes`
--

DROP TABLE IF EXISTS `pacientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pacientes` (
  `idPaciente` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL DEFAULT '',
  `apellido` varchar(30) NOT NULL,
  `apellido2` varchar(30) DEFAULT '',
  `nacimiento` date DEFAULT NULL,
  `nif` varchar(10) NOT NULL,
  `direccion` varchar(40) DEFAULT '0',
  `cp` int(6) DEFAULT '290',
  `telefono` int(10) NOT NULL,
  `profesion` varchar(45) DEFAULT NULL,
  `email` varchar(45) NOT NULL,
  `activacion` int(11) NOT NULL DEFAULT '0',
  `token` varchar(40) NOT NULL,
  `token_password` varchar(100) DEFAULT NULL,
  `password_request` int(11) DEFAULT '0',
  `privilegio` int(2) NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `password` varchar(100) NOT NULL,
  `last_session` date NOT NULL,
  PRIMARY KEY (`idPaciente`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pacientes`
--

LOCK TABLES `pacientes` WRITE;
/*!40000 ALTER TABLE `pacientes` DISABLE KEYS */;
INSERT INTO `pacientes` VALUES (1,'mario','ramirez','jaramillo','1998-09-24','123456','plaza de uncibay',29008,6337667,'medico','desarrollo@pruebas.net',1,'afb6ebe7ec9378dffaf7887c9121bcc2','',1,1,'2019-05-29 13:26:57','$2y$10$hJ.l/fJLtUje78MGLMFpFupMCnubpqBQcre/OX06FRKMV7OG1JJvG','2019-06-02');
/*!40000 ALTER TABLE `pacientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pacientes2`
--

DROP TABLE IF EXISTS `pacientes2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pacientes2` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  `apellido` varchar(30) NOT NULL,
  `apellido2` varchar(30) DEFAULT NULL,
  `nacimiento` date DEFAULT NULL,
  `nif` varchar(10) NOT NULL,
  `direccion` varchar(40) DEFAULT NULL,
  `cp` int(6) DEFAULT '290',
  `telefono` int(14) DEFAULT NULL,
  `profesion` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `diagnostico` varchar(100) DEFAULT NULL,
  `tratamiento` varchar(255) DEFAULT NULL,
  `antecedentes` varchar(255) DEFAULT NULL,
  `tipo` varchar(100) DEFAULT NULL,
  `agravante` varchar(100) DEFAULT NULL,
  `hernia` varchar(100) DEFAULT NULL,
  `restriccion` varchar(100) DEFAULT NULL,
  `antialgica` varchar(100) DEFAULT NULL,
  `territorio` varchar(100) DEFAULT NULL,
  `testing` varchar(100) DEFAULT NULL,
  `reflejos` varchar(100) DEFAULT NULL,
  `lasegue` varchar(100) DEFAULT NULL,
  `palpacion` varchar(100) DEFAULT NULL,
  `balanceart` varchar(100) DEFAULT NULL,
  `balancemusc` varchar(100) DEFAULT NULL,
  `alteraciones` varchar(100) DEFAULT NULL,
  `ttoprevio` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pacientes2`
--

LOCK TABLES `pacientes2` WRITE;
/*!40000 ALTER TABLE `pacientes2` DISABLE KEYS */;
/*!40000 ALTER TABLE `pacientes2` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registros`
--

DROP TABLE IF EXISTS `registros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `registros` (
  `idPaciente` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `usuario` varchar(10) NOT NULL DEFAULT '',
  `clave` varchar(300) NOT NULL DEFAULT '',
  `roll` varchar(3) NOT NULL DEFAULT '',
  `fecharegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idPaciente`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registros`
--

LOCK TABLES `registros` WRITE;
/*!40000 ALTER TABLE `registros` DISABLE KEYS */;
INSERT INTO `registros` VALUES (10,'admin','1234','','2018-12-04 19:53:56'),(11,'fasfasd','$2y$10$fpFAXtPI3XNzfmocowlon.IEH1.4XGpECZ.B1KcM.3fajotujv.Bi','2','2018-12-04 20:05:28'),(12,'pepe','$2y$10$m0J0w1kK.kny21u/L/HzpuzpCA7mfeMaq5eBd7pAJYwKkREIIYEoa','2','2018-12-04 20:06:10'),(13,'papito','$2y$10$Tkg3E.Uh/KRNl8x4XT0OOO95puXkZvnQMhEGscuNU0GzXfEctVIOK','2','2018-12-04 20:10:16');
/*!40000 ALTER TABLE `registros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblconfiguracionhorario`
--

DROP TABLE IF EXISTS `tblconfiguracionhorario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblconfiguracionhorario` (
  `idConfiguracion` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `desde` time NOT NULL DEFAULT '00:00:00',
  `hasta` time NOT NULL DEFAULT '00:00:00',
  `instructor` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`idConfiguracion`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblconfiguracionhorario`
--

LOCK TABLES `tblconfiguracionhorario` WRITE;
/*!40000 ALTER TABLE `tblconfiguracionhorario` DISABLE KEYS */;
INSERT INTO `tblconfiguracionhorario` VALUES (4,'15:00:00','21:00:00',1);
/*!40000 ALTER TABLE `tblconfiguracionhorario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblusuarios`
--

DROP TABLE IF EXISTS `tblusuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblusuarios` (
  `idUsuario` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `usu_usuario` varchar(45) NOT NULL DEFAULT '',
  `usu_clave` varchar(300) NOT NULL DEFAULT '',
  `usu_roll` varchar(45) NOT NULL DEFAULT '',
  `fecharegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblusuarios`
--

LOCK TABLES `tblusuarios` WRITE;
/*!40000 ALTER TABLE `tblusuarios` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblusuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_usuario`
--

DROP TABLE IF EXISTS `tipo_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_usuario`
--

LOCK TABLES `tipo_usuario` WRITE;
/*!40000 ALTER TABLE `tipo_usuario` DISABLE KEYS */;
INSERT INTO `tipo_usuario` VALUES (1,'admin'),(2,'paciente');
/*!40000 ALTER TABLE `tipo_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `email` text,
  `password` text,
  `roll` int(2) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (49,'pacients','$2y$10$SxvnPJ3U9TTyWOM0uEs5UuL9EG.POmkWMVIrXaqNRNIhL91xY.jje',2),(50,'pacients','$2y$10$yksJP7HDP.TEhMRU523ZFOSC1ntmzeio.uFc5wVZZ4oNTK8d6Sh3m',2),(51,'juanito','$2y$10$2/yTycgrTwanyl7450ey1.HKB2ercI.KHDQyGjTql3c7eMxaN/2za',2),(52,'admin','$2y$10$C/yG/0aG0hwu8.a7DAP8F.HOp/cxatxt1HEO/WWo2GgC.ghg0OfdO',0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(30) NOT NULL,
  `password` varchar(130) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `correo` varchar(80) NOT NULL,
  `last_session` datetime DEFAULT NULL,
  `activacion` int(11) NOT NULL DEFAULT '0',
  `token` varchar(40) NOT NULL,
  `token_password` varchar(100) DEFAULT NULL,
  `password_request` int(11) DEFAULT '0',
  `id_tipo` int(11) NOT NULL,
  `lopd` tinyint(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (2,'root','$2y$10$CSIDRttLppgNbTyO9xOxEuyD7nWwLcUkeszw2Chytpr9HIqv/qqdq','info','desarrollo@hotmail.com','2019-05-29 08:17:15',1,'346183a7359516d1e0445d32e261a747','',1,1,0);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-06-03  9:30:38
