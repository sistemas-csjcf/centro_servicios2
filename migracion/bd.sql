Civil Cto: 31 03
Civil Municipal 40 03
Familia 31 10
Actuaciones
30000067 - 30023363

-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versi�n del servidor:         5.5.8-log - MySQL Community Server (GPL)
-- SO del servidor:              Win32
-- HeidiSQL Versi�n:             8.0.0.4396
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Volcando estructura de base de datos para migracion
CREATE DATABASE IF NOT EXISTS `migracion` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `migracion`;


-- Volcando estructura para tabla migracion.pa_juzgado
CREATE TABLE IF NOT EXISTS `pa_juzgado` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(70) NOT NULL,
  `fecha` varchar(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla migracion.pa_juzgado: ~84 rows (aproximadamente)
/*!40000 ALTER TABLE `pa_juzgado` DISABLE KEYS */;
INSERT INTO `pa_juzgado` (`id`, `nombre`, `fecha`) VALUES
	(1, 'JUZGADO 1 DE FAMILIA DEL CIRCUITO', '2010'),
	(2, 'JUZGADO 2 DE FAMILIA DEL CIRCUITO', '2011'),
	(3, 'JUZGADO 3 DE FAMILIA DEL CIRCUITO', '2010'),
	(4, 'JUZGADO 4 DE FAMILIA DEL CIRCUITO', '2011'),
	(5, 'JUZGADO 5 DE FAMILIA DEL CIRCUITO', '2011'),
	(6, 'JUZGADO 6 DE FAMILIA DEL CIRCUITO', '2011'),
	(7, 'JUZGADO 7 DE FAMILIA DEL CIRCUITO', '2011'),
	(8, 'JUZGADO 6 DE FAMILIA ADJUNTO', '2012'),
	(9, 'JUZGADO 7 DE FAMILIA ADJUNTO', '2013'),
	(10, 'JUZGADO 1 DE FAMILIA DEL CIRCUITO DE DESCONGESTION', '2014'),
	(11, 'JUZGADO 1 CIVIL MUNICIPAL', '2010'),
	(12, 'JUZGADO 2 CIVIL MUNICIPAL', '2011'),
	(13, 'JUZGADO 3 CIVIL MUNICIPAL', '2011'),
	(14, 'JUZGADO 4 CIVIL MUNICIPAL', '2011'),
	(15, 'JUZGADO 5 CIVIL MUNICIPAL', '2011'),
	(16, 'JUZGADO 6 CIVIL MUNICIPAL', '2011'),
	(17, 'JUZGADO 7 CIVIL MUNICIPAL', '2011'),
	(18, 'JUZGADO 8 CIVIL MUNICIPAL', '2011'),
	(19, 'JUZGADO 9 CIVIL MUNICIPAL', '2010'),
	(20, 'JUZGADO 10 CIVIL MUNICIPAL', '2011'),
	(21, 'JUZGADO 11 CIVIL MUNICIPAL', '2011'),
	(22, 'JUZGADO 12 CIVIL MUNICIPAL', '2011'),
	(23, 'JUZGADO 1 CIVIL MUNICIPAL ADJUNTO', '2013'),
	(24, 'JUZGADO 6 CIVIL MUNICIPAL ADJUNTO', '2013'),
	(25, 'JUZGADO 7 CIVIL MUNICIPAL ADJUNTO', '2013'),
	(26, 'JUZGADO 1 CIVIL MUNICIPAL DE DESCONGESTION', '2014'),
	(27, 'JUZGADO 1 CIVIL DEL CIRCUITO', '2011'),
	(28, 'JUZGADO 2 CIVIL DEL CIRCUITO', '2011'),
	(29, 'JUZGADO 3 CIVIL DEL CIRCUITO', '2011'),
	(30, 'JUZGADO 4 CIVIL DEL CIRCUITO', '2010'),
	(31, 'JUZGADO 5 CIVIL DEL CIRCUITO', '2011'),
	(32, 'JUZGADO 6 CIVIL DEL CIRCUITO', '2011'),
	(33, 'JUZGADO 2A CIVIL DEL CIRCUITO ADJUNTO', '2013'),
	(34, 'JUZGADO 2C CIVIL DEL CIRCUITO ADJUNTO', '2013'),
	(35, 'JUZGADO 5 CIVIL DEL CIRCUITO ADJUNTO', '2013'),
	(36, 'JUZGADO 1 CIVIL DEL CIRCUITO DE DESCONGESTION', '2014'),
	(37, 'JUZGADO 2 CIVIL DEL CIRCUITO DE DESCONGESTION', '2014'),
	(38, 'JUZGADO 1 LABORAL DEL CIRCUITO', '2011'),
	(39, 'JUZGADO 2 LABORAL DEL CIRCUITO', '2011'),
	(40, 'JUZGADO 3 LABORAL DEL CIRCUITO', '2011'),
	(41, 'JUZGADO 1 ADMINISTRATIVO DEL CIRCUITO', '2011'),
	(42, 'JUZGADO 2 ADMINISTRATIVO DEL CIRCUITO', '2011'),
	(43, 'JUZGADO 3 ADMINISTRATIVO DEL CIRCUITO', '2011'),
	(44, 'JUZGADO 4 ADMINISTRATIVO DEL CIRCUITO', '2011'),
	(45, 'JUZGADO 1 ADMINISTRATIVO DE DESCONGESTION', '2011'),
	(46, 'JUZGADO 2 ADMINISTRATIVO DE DESCONGESTION', '2011'),
	(47, 'JUZGADO 3 ADMINISTRATIVO DE DESCONGESTION', '2011'),
	(48, 'JUZGADO 4 ADMINISTRATIVO DE DESCONGESTION', '2014'),
	(49, 'JUZGADO 5 ADMINISTRATIVO DE DESCONGESTION', '2011'),
	(50, 'JUZGADO 6 ADMINISTRATIVO DE DESCONGESTION', ''),
	(51, 'JUZGADO 7 ADMINISTRATIVO DE DESCONGESTION', ''),
	(52, 'JUZGADO 8 ADMINISTRATIVO DE DESCONGESTION', '2014'),
	(53, 'JUZGADO 1 PENAL DEL CIRCUITO', '2010'),
	(54, 'JUZGADO 2 PENAL DEL CIRCUITO', '2010'),
	(55, 'JUZGADO 3 PENAL DEL CIRCUITO', '2010'),
	(56, 'JUZGADO 4 PENAL DEL CIRCUITO', '2010'),
	(57, 'JUZGADO 5 PENAL DEL CIRCUITO', '2010'),
	(58, 'JUZGADO 6 PENAL DEL CIRCUITO', '2010'),
	(59, 'JUZGADO 7 PENAL DEL CIRCUITO', '2010'),
	(60, 'JUZGADO 8 PENAL DEL CIRCUITO', '2011'),
	(61, 'JUZGADO 1 PENAL DEL CIRCUITO ESPECIALIZADO', '2011'),
	(62, 'JUZGADO 1 PENAL MUNICIPAL CONTROL DE GARANTIA', '2010'),
	(63, 'JUZGADO 2 PENAL MUNICIPAL CONTROL DE GARANTIA', '2011'),
	(64, 'JUZGADO 3 PENAL MUNICIPAL CONTROL DE GARANTIA', '2010'),
	(65, 'JUZGADO 4 PENAL MUNICIPAL CONTROL DE GARANTIA', '2011'),
	(66, 'JUZGADO 5 PENAL MUNICIPAL CONTROL DE GARANTIA', '2010'),
	(67, 'JUZGADO 6 PENAL MUNICIPAL CONTROL DE GARANTIA', '2011'),
	(68, 'JUZGADO 7 PENAL MUNICIPAL CONTROL DE GARANTIA', '2010'),
	(69, 'JUZGADO 8 PENAL MUNICIPAL CONTROL DE GARANTIA', '2010'),
	(70, 'JUZGADO 1 PENAL MUNICIPAL DE CONOCIMIENTO', '2010'),
	(71, 'JUZGADO 2 PENAL MUNICIPAL DE CONOCIMIENTO', '2010'),
	(72, 'JUZGADO 3 PENAL MUNICIPAL DE CONOCIMIENTO', '2011'),
	(73, 'JUZGADO 1 DE EJECUCION DE PENAS Y MEDIDAS', '2008'),
	(74, 'JUZGADO 2 DE EJECUCION DE PENAS Y MEDIDAS', '2009'),
	(75, 'SALA DISCIPLINARIA', '2011'),
	(76, 'TRIBUNAL CONTENCIOSO ADMINISTRATIVO', '2010'),
	(77, 'SALA CIVIL FAMILIA ', '2010'),
	(78, 'SALA LABORAL', '2008'),
	(79, 'SALA PENAL', '2007'),
	(80, 'JUZGADO 1 PENAL DEL CIRCUITO PARA ADOLESCENTES', '2011'),
	(81, 'JUZGADO 2 PENAL DEL CIRCUITO PARA ADOLESCENTES', ''),
	(82, 'JUZGADO 1 PENAL MUNICIPAL  ADOLESCENTES GARANTIAS', '2010'),
	(83, 'JUZGADO 2 PENAL MUNICIPAL  ADOLESCENTES GARANTIAS', '2011'),
	(84, 'JUZGADO 3 PENAL MUNICIPAL  ADOLESCENTES GARANTIAS', '2009');
/*!40000 ALTER TABLE `pa_juzgado` ENABLE KEYS */;


-- Volcando estructura para tabla migracion.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre_usuario` varchar(250) NOT NULL,
  `contrasena` varchar(250) NOT NULL,
  `perfil` varchar(100) NOT NULL,
  `ipservidor` varchar(50) DEFAULT NULL,
  `nombre_bd` varchar(50) DEFAULT NULL,
  `cod_actuacion` varchar(50) DEFAULT NULL,
  `cod_actuacion2` varchar(50) DEFAULT NULL,
  `id_juzgado` varchar(50) DEFAULT NULL,
  `especialidad` varchar(50) DEFAULT NULL,
  `juz_num` varchar(3) DEFAULT NULL,
  `juz_esp` varchar(3) DEFAULT NULL,
  `juz_enti` varchar(3) DEFAULT NULL,
  `bd` varchar(10) DEFAULT NULL,
  `server_name` varchar(20) DEFAULT NULL,
  `pswd` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla migracion.usuario: ~81 rows (aproximadamente)
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`id`, `nombre_usuario`, `contrasena`, `perfil`, `ipservidor`, `nombre_bd`, `cod_actuacion`, `cod_actuacion2`, `id_juzgado`, `especialidad`, `juz_num`, `juz_esp`, `juz_enti`, `bd`, `server_name`, `pswd`) VALUES
	(1, 'admin_ts', '21232f297a57a5a743894a0e4a801fc3', 'Administrador', NULL, NULL, NULL, NULL, '170013103009', 'TODOS', NULL, NULL, NULL, 'consejoPN', 'SAD_AUX9\\SQLEXPRESS', NULL),
	(2, 'admin_tca', '21232f297a57a5a743894a0e4a801fc3', 'Administrador', NULL, NULL, NULL, NULL, '170013103009', 'TCA', NULL, NULL, NULL, 'TCA', '192.168.89.22', NULL),
	(3, 'admin_spenal', '21232f297a57a5a743894a0e4a801fc3', 'Administrador', NULL, NULL, NULL, NULL, '170013103009', 'SPENAL', NULL, NULL, NULL, 'Spenal', '192.168.89.22', NULL),
	(4, 'juz1_cto', '0ea52b1f664cb764bc4bacabe94d0414', 'Administrador', NULL, NULL, NULL, NULL, '170013103001', 'JUZGADO', '001', '03', '31', 'consejoPN', '192.168.89.20', NULL),
	(5, 'juz2_cto', '523d7b2024a7f4baa99952fe83e89cb4', 'Administrador', NULL, NULL, NULL, NULL, '170013103002', 'JUZGADO', '002', '03', '31', 'consejoPN', '192.168.89.20', NULL),
	(6, 'juz3_cto', '1d4baff523d2b774811a5bea5739dac4', 'Administrador', NULL, NULL, NULL, NULL, '170013103003', 'JUZGADO', '003', '03', '31', 'consejoPN', '192.168.89.20', NULL),
	(7, 'juz4_cto', '88e5459cc9ff8743741acebc86c4a0cc', 'Administrador', NULL, NULL, NULL, NULL, '170013103004', 'JUZGADO', '004', '03', '31', 'consejoPN', '192.168.89.20', NULL),
	(8, 'juz5_cto', 'f13ce14dcc1b702aee69135a4999d4d7', 'Administrador', NULL, NULL, NULL, NULL, '170013103005', 'JUZGADO', '005', '03', '31', 'consejoPN', '192.168.89.20', NULL),
	(9, 'juz6_cto', '5966800cfe9442010d441de94363bb06', 'Administrador', NULL, NULL, NULL, NULL, '170013103006', 'JUZGADO', '006', '03', '31', 'consejoPN', '192.168.89.20', NULL),
	(10, 'juz1_flia', 'e6c3415cc9d0ee0c782fbc4b26fdb02f', 'Administrador', NULL, NULL, NULL, NULL, '170013110001', 'JUZGADO', '001', '10', '31', 'consejoPN', '192.168.89.20', NULL),
	(11, 'juz2_flia', 'bca7162a145a0528004213a392d9f927', 'Administrador', NULL, NULL, NULL, NULL, '170013110002', 'JUZGADO', '002', '10', '31', 'consejoPN', '192.168.89.20', NULL),
	(12, 'juz3_flia', 'b8c57b4104b7ffa15827b5c8addec0f0', 'Administrador', NULL, NULL, NULL, NULL, '170013110003', 'JUZGADO', '003', '10', '31', 'consejoPN', '192.168.89.20', NULL),
	(13, 'juz4_flia', '8aa3f041e707efd350b5d60a00c0c8a1', 'Administrador', NULL, NULL, NULL, NULL, '170013110004', 'JUZGADO', '004', '10', '31', 'consejoPN', '192.168.89.20', NULL),
	(14, 'juz5_flia', 'b127eb48043218b98added7aeb917677', 'Administrador', NULL, NULL, NULL, NULL, '170013110005', 'JUZGADO', '005', '10', '31', 'consejoPN', '192.168.89.20', NULL),
	(15, 'juz6_flia', '2c7774e82f5a5f6e85d3896c0fd3698a', 'Administrador', NULL, NULL, NULL, NULL, '170013110006', 'JUZGADO', '006', '10', '31', 'consejoPN', '192.168.89.20', NULL),
	(16, 'juz7_flia', '1e72a7d56e58562f420e343e2176d405', 'Administrador', NULL, NULL, NULL, NULL, '170013110007', 'JUZGADO', '007', '10', '31', 'consejoPN', '192.168.89.20', NULL),
	(17, 'juz1_mpal', '4da212f1ebfe602e4a2366915d418333', 'Administrador', NULL, NULL, NULL, NULL, '170014003001', 'JUZGADO', '001', '03', '40', 'consejoPN', '192.168.89.20', NULL),
	(18, 'juz2_mpal', '5047cd6b8627a65f4b65df7d62ed0ba4', 'Administrador', NULL, NULL, NULL, NULL, '170014003002', 'JUZGADO', '002', '03', '40', 'consejoPN', '192.168.89.20', NULL),
	(19, 'juz3_mpal', 'db5bd94faa5c4a7f943e57edd70e79d0', 'Administrador', NULL, NULL, NULL, NULL, '170014003003', 'JUZGADO', '003', '03', '40', 'consejoPN', '192.168.89.20', NULL),
	(20, 'juz4_mpal', '6cf8f9f257b889fa7708c3a821d0f35b', 'Administrador', NULL, NULL, NULL, NULL, '170014003004', 'JUZGADO', '004', '03', '40', 'consejoPN', '192.168.89.20', NULL),
	(21, 'juz5_mpal', '42cc76227cc38b90bba94a19b65eb95e', 'Administrador', NULL, NULL, NULL, NULL, '170014003005', 'JUZGADO', '005', '03', '40', 'consejoPN', '192.168.89.20', NULL),
	(22, 'juz6_mpal', 'df8ca8b3613e6264fefbea2797f5bcba', 'Administrador', NULL, NULL, NULL, NULL, '170014003006', 'JUZGADO', '006', '03', '40', 'consejoPN', '192.168.89.20', NULL),
	(23, 'juz7_mpal', '438ee166e7e5b3b4f288f8a739cd7d68', 'Administrador', NULL, NULL, NULL, NULL, '170014003007', 'JUZGADO', '007', '03', '40', 'consejoPN', '192.168.89.20', NULL),
	(24, 'juz8_mpal', '39214994ebd23e6d72ff97501c4c6f14', 'Administrador', NULL, NULL, NULL, NULL, '170014003008', 'JUZGADO', '008', '03', '40', 'consejoPN', '192.168.89.20', NULL),
	(25, 'juz9_mpal', '9ae9fb72f82a47cfbff616bb06cf35d3', 'Administrador', NULL, NULL, NULL, NULL, '170014003009', 'JUZGADO', '009', '03', '40', 'consejoPN', '192.168.89.20', NULL),
	(26, 'juz10_mpal', '220121f806981f978e54afe674b96f23', 'Administrador', NULL, NULL, NULL, NULL, '170014003010', 'JUZGADO', '010', '03', '40', 'consejoPN', '192.168.89.20', NULL),
	(27, 'juz11_mpal', '3a2c3198b80424f02bd67d0fc2c0c350', 'Administrador', NULL, NULL, NULL, NULL, '170014003011', 'JUZGADO', '011', '03', '40', 'consejoPN', '192.168.89.20', NULL),
	(28, 'juz12_mpal', 'c023f380ac7fcaf29c306171ef95141f', 'Administrador', NULL, NULL, NULL, NULL, '170014003012', 'JUZGADO', '012', '03', '40', 'consejoPN', '192.168.89.20', NULL),
	(29, 'juz6_pmgar', 'ABA8B9534DAAF2BEDC2DF1051DF0332E', 'Administrador', '192.168.56.46', 'Penal', '00000420', NULL, '170014088006', 'JUZGADO', '006', '88', '40', 'Penal', '192.168.56.46', NULL),
	(30, 'infancia', 'e531f738345f218f845adae22b3bdfab', 'Administrador', '192.168.56.102', 'Infancia', '00000346', NULL, '170014071002', 'JUZGADO', '002', '71', '40', 'Infancia', '192.168.56.102', NULL),
	(31, 'admin_sdiscip', 'a1e0adfc147dbd0a113ba2c038dec44e', 'Administrador', NULL, NULL, '30023365', NULL, NULL, 'DISCIPLINARIA', NULL, NULL, NULL, 'S_Discipl', '192.168.89.22', NULL),
	(32, 'ejecucion', '21232f297a57a5a743894a0e4a801fc3', 'Administrador', NULL, NULL, '30023260', NULL, '170014303000', 'EJECUCION', NULL, '03', '43', 'consejoPN', '192.168.89.20', '3j3cut1V416'),
	(33, 'juz1_pmgar', '98228131065FB595CC1D5D6283C4DC00', 'Administrador', '192.168.56.46', 'Penal', '00000420', NULL, '170014088001', 'JUZGADO', '001', '88', '40', 'Penal', '192.168.56.46', NULL),
	(34, 'juz2_pmgar', '44D7541D55766C0BBF26E4FF1693E0E2', 'Administrador', '192.168.56.46', 'Penal', '00000420', NULL, '170014088002', 'JUZGADO', '002', '88', '40', 'Penal', '192.168.56.46', NULL),
	(35, 'juz3_pmgar', 'B8B9FC6855DCCDDEDEFF8E03E33A2CB4', 'Administrador', '192.168.56.46', 'Penal', '00000420', NULL, '170014088003', 'JUZGADO', '003', '88', '40', 'Penal', '192.168.56.46', NULL),
	(36, 'juz4_pmgar', 'C9C35F3666BE40779D1BD3E207255446', 'Administrador', '192.168.56.46', 'Penal', '00000420', NULL, '170014088004', 'JUZGADO', '004', '88', '40', 'Penal', '192.168.56.46', NULL),
	(37, 'juz5_pmgar', 'A124386F98BF0AEB6D047D2B0E6F31F6', 'Administrador', '192.168.56.46', 'Penal', '00000420', NULL, '170014088005', 'JUZGADO', '005', '88', '40', 'Penal', '192.168.56.46', NULL),
	(38, 'juz7_pmgar', 'D482385CFF66B266391BF777FEAEFB66', 'Administrador', '192.168.56.46', 'Penal', '00000420', NULL, '170014088007', 'JUZGADO', '007', '88', '40', 'Penal', '192.168.56.46', NULL),
	(39, 'juz8_pmgar', '24699C524C4E29C1C1578AFD52495C27', 'Administrador', '192.168.56.46', 'Penal', '00000420', NULL, '170014088008', 'JUZGADO', '008', '88', '40', 'Penal', '192.168.56.46', NULL),
	(40, 'juz1_pmcon', '18B92B868E9F0A67B594E218F2216BAA', 'Administrador', '192.168.56.46', 'Penal', '00000420', NULL, '170014009001', 'JUZGADO', '001', '09', '40', 'Penal', '192.168.56.46', NULL),
	(41, 'juz2_pmcon', 'BD6AF45F3ACAD64B5BF8658DF939450F', 'Administrador', '192.168.56.46', 'Penal', '00000420', NULL, '170014009002', 'JUZGADO', '002', '09', '40', 'Penal', '192.168.56.46', NULL),
	(42, 'juz3_pmcon', '46DAA7A10F257863DD4326CBA967207C', 'Administrador', '192.168.56.46', 'Penal', '00000420', NULL, '170014009003', 'JUZGADO', '003', '09', '40', 'Penal', '192.168.56.46', NULL),
	(43, 'juz1_pcto', '420D41583197B5E309F2641F8E8D7A8C', 'Administrador', '192.168.56.46', 'Penal', '00000420', NULL, '170013104001', 'JUZGADO', '001', '04', '31', 'Penal', '192.168.56.46', NULL),
	(44, 'juz2_pcto', '83BF8843048BD54793BBA26C87E5A596', 'Administrador', '192.168.56.46', 'Penal', '00000420', NULL, '170013104002', 'JUZGADO', '002', '04', '31', 'Penal', '192.168.56.46', NULL),
	(45, 'juz3_pcto', '242025D35D6BC43EBDA6344A9BFC7A8D', 'Administrador', '192.168.56.46', 'Penal', '00000420', NULL, '170013104003', 'JUZGADO', '003', '04', '31', 'Penal', '192.168.56.46', NULL),
	(46, 'juz4_pcto', '321CF07AED2FAC0F5A93904DC8C0244F', 'Administrador', '192.168.56.46', 'Penal', '00000420', NULL, '170013104004', 'JUZGADO', '004', '04', '31', 'Penal', '192.168.56.46', NULL),
	(47, 'juz5_pcto', '279C3A05D45A0A44D4454AA2CD5DFAEC', 'Administrador', '192.168.56.46', 'Penal', '00000420', NULL, '170013104005', 'JUZGADO', '005', '04', '31', 'Penal', '192.168.56.46', NULL),
	(48, 'juz6_pcto', 'FF6FAECFF0AFF3A5EDCA39C9A853719C', 'Administrador', '192.168.56.46', 'Penal', '00000420', NULL, '170013104006', 'JUZGADO', '006', '04', '31', 'Penal', '192.168.56.46', NULL),
	(49, 'juz7_pcto', '7ED15A78C832598BF674FD55A07BD0AF', 'Administrador', '192.168.56.46', 'Penal', '00000420', NULL, '170013104007', 'JUZGADO', '007', '04', '31', 'Penal', '192.168.56.46', NULL),
	(50, 'juz1_pesp', 'E147227AE65D8A703BED78EE9FBB4EE2', 'Administrador', '192.168.56.46', 'Penal', '00000420', NULL, '170013107001', 'JUZGADO', '001', '07', '31', 'Penal', '192.168.56.46', NULL),
	(51, 'cespa', '79bf6fab464c1c84eb54a1761e7870bd', 'Administrador', '192.168.56.102', 'Infancia', '00000346', NULL, '170017171001', 'JUZGADO', '001', '71', '71', 'Infancia', '192.168.56.102', NULL),
	(52, 'juz1_adolgar', 'a7f2b089c841426a21865e016b6b1e83', 'Administrador', '192.168.56.102', 'Infancia', '00000346', '00000227', '170014071001', 'JUZGADO', '001', '71', '40', 'Infancia', '192.168.56.102', NULL),
	(53, 'juz2_adolgar', '2e20282288b2f5ee69b9176749dbcb00', 'Administrador', '192.168.56.102', 'Infancia', '00000346', NULL, '170014071002', 'JUZGADO', '002', '71', '40', 'Infancia', '192.168.56.102', NULL),
	(54, 'juz3_adolgar', 'cd01e8611d62b01e88c4573b2754d0b6', 'Administrador', '192.168.56.102', 'Infancia', '00000346', NULL, '170014071003', 'JUZGADO', '003', '71', '40', 'Infancia', '192.168.56.102', NULL),
	(55, 'juz1_adolpcto', 'c3946aad0db2375d9247c1f7c076f14e', 'Administrador', '192.168.56.102', 'Infancia', '00000346', NULL, '170013118001', 'JUZGADO', '001', '18', '31', 'Infancia', '192.168.56.102', NULL),
	(56, 'juz2_adolpcto', 'c8e8bfb4944ebc48b9ef3388fa91a46a', 'Administrador', '192.168.56.102', 'Infancia', '00000346', NULL, '170013118002', 'JUZGADO', '002', '18', '31', 'Infancia', '192.168.56.102', NULL),
	(57, 'cserjudma', '77A7697BF77407412A88B651AEDBB400', 'Administrador', '192.168.56.46', 'Penal', '00000420', NULL, '170010090000', 'JUZGADO', '000', '90', '00', 'Penal', '192.168.56.46', NULL),
	(58, 'juz1_lcto', 'bee283f68eb9a3b35278db8a50688f84', 'Administrador', NULL, NULL, '30000067', '30023260', '170013105001', 'JUZGADO', '001', '05', '31', 'consejoPN', '192.168.89.20', NULL),
	(59, 'juz2_lcto', 'bff79029629e61810bee2a776e51e378', 'Administrador', NULL, NULL, '30000067', '30023260', '170013105002', 'JUZGADO', '002', '05', '31', 'consejoPN', '192.168.89.20', NULL),
	(60, 'juz3_lcto', 'c178b9c62386bc7f896958ae338a0f57', 'Administrador', NULL, NULL, '30000067', '30023260', '170013105003', 'JUZGADO', '003', '05', '31', 'consejoPN', '192.168.89.20', NULL),
	(61, 'juz1_lpeqc', 'faaad7e7f2c030cc6ec4e8fc41ba2235', 'Administrador', NULL, NULL, '30023260', '30023363', '170014105001', 'JUZGADO', '001', '05', '41', 'consejoPN', '192.168.89.20', NULL),
	(62, 'juz1_admcto', '21232f297a57a5a743894a0e4a801fc3', 'Administrador', '192.168.89.22', 'TCA', '30023216', NULL, '170013333001', 'JUZGADO', '001', '33', '33', 'TCA', '192.168.89.22', NULL),
	(63, 'juz2_admcto', 'cb16108290a771779c8504e976777442', 'Administrador', '192.168.89.22', 'TCA', '30023216', NULL, '170013333002', 'JUZGADO', '002', '33', '33', 'TCA', '192.168.89.22', NULL),
	(64, 'juz3_admcto', '21232f297a57a5a743894a0e4a801fc3', 'Administrador', '192.168.89.22', 'TCA', '30023216', NULL, '170013333003', 'JUZGADO', '003', '33', '33', 'TCA', '192.168.89.22', NULL),
	(65, 'juz4_admcto', '4303fb7808892f2fad9d72e6c498eba8', 'Administrador', '192.168.89.22', 'TCA', '30023216', NULL, '170013333004', 'JUZGADO', '004', '33', '33', 'TCA', '192.168.89.22', NULL),
	(66, 'juz1_admdesor', 'ca8419a88b5ec21c0b6372d96b500469', 'Administrador', '192.168.89.22', 'TCA', '30023216', NULL, '170013333755', 'JUZGADO', '755', '33', '33', 'TCA', '192.168.89.22', NULL),
	(67, 'juz2_admdesor', 'c35fdf4d2561291bdcc2b4083b39695a', 'Administrador', '192.168.89.22', 'TCA', '30023216', NULL, '170013333756', 'JUZGADO', '756', '33', '33', 'TCA', '192.168.89.22', NULL),
	(68, 'juz1_admdes', '0eee7d3d6c4c2b0681c43cced464ea6d', 'Administrador', '192.168.89.22', 'TCA', '30023216', NULL, '170013339752', 'JUZGADO', '752', '39', '33', 'TCA', '192.168.89.22', NULL),
	(69, 'juz2_admdes', 'b35b8ac0774e7b4069bccc6701112b34', 'Administrador', '192.168.89.22', 'TCA', '30023216', NULL, '170013339753', 'JUZGADO', '753', '39', '33', 'TCA', '192.168.89.22', NULL),
	(70, 'juz3_admdes', 'e5001ddf7ba38047d48020cec3d04e91', 'Administrador', '192.168.89.22', 'TCA', '30023216', NULL, '170013339754', 'JUZGADO', '754', '39', '33', 'TCA', '192.168.89.22', NULL),
	(71, 'juz7_admdes', '780d268f38ee12b393e74b79bcaf0ae2', 'Administrador', '192.168.89.22', 'TCA', '30023216', NULL, '170013339751', 'JUZGADO', '751', '39', '33', 'TCA', '192.168.89.22', NULL),
	(72, 'admin_sl', 'c9fe38dbeb943ba5daffa15dd9b8a896', 'Administrador', '192.168.89.20', NULL, '30023260', '30023363', '170012205000', 'LABORAL', NULL, NULL, NULL, 'consejoPN', '192.168.89.20', NULL),
	(73, 'admin_tc', 'ab98bbc010ec8eeefa97a972308c04c3', 'Administrador', '192.168.89.22', NULL, '30023216', NULL, '170012315000', 'TCA', NULL, NULL, NULL, 'TCA', '192.168.89.22', NULL),
	(74, 'juz5_admcto', 'ffb73e8a14583b2fec99705acfbe9195', 'Administrador', '192.168.89.22', 'TCA', '30023216', NULL, '170013339005', 'JUZGADO', '005', '39', '33', 'TCA', '192.168.89.22', NULL),
	(75, 'juz6_admcto', '21232f297a57a5a743894a0e4a801fc3', 'Administrador', '192.168.89.22', 'TCA', '30023216', NULL, '170013339006', 'JUZGADO', '006', '39', '33', 'TCA', '192.168.89.22', NULL),
	(76, 'juz7_admcto', '63d80f6c13d1655478aac696d76ff095', 'Administrador', '192.168.89.22', 'TCA', '30023216', NULL, '170013339007', 'JUZGADO', '007', '39', '33', 'TCA', '192.168.89.22', NULL),
	(77, 'juz8_admcto', 'cd24ee9d8f00b566121343352332645e', 'Administrador', '192.168.89.22', 'TCA', '30023216', NULL, '170013339008', 'JUZGADO', '008', '39', '33', 'TCA', '192.168.89.22', NULL),
	(78, 'csajepms', '37cc66ccd57564697c6cc2abbcaade99', 'Administrador', '192.168.56.6', 'JEPMS', '00001199', NULL, '170013187000', 'JEPMS', '000', '31', '87', 'JEPMS', '192.168.56.6', NULL),
	(79, 'juz1_epenas', 'a277b862a76ef961325ac54ef2eff38b', 'Administrador', '192.168.56.6', 'JEPMS', '00001199', NULL, '170013187001', 'JUZGADO', '001', '87', '31', 'JEPMS', '192.168.56.6', NULL),
	(80, 'juz2_epenas', '2710af5b1917c46b6f7356387a1f15f6', 'Administrador', '192.168.56.6', 'JEPMS', '00001199', NULL, '170013187002', 'JUZGADO', '002', '87', '31', 'JEPMS', '192.168.56.6', NULL),
	(81, 'juz3_epenas', '47233cee5f2d7cd43f91cc652daf205a', 'Administrador', '192.168.56.6', 'JEPMS', '00001199', NULL, '170013187003', 'JUZGADO', '003', '87', '31', 'JEPMS', '192.168.56.6', NULL);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
