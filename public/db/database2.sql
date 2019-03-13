-- --------------------------------------------------------
-- Anfitrião:                    127.0.0.1
-- Versão do servidor:           10.1.37-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Versão:              9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table 2207508_wrc.component
CREATE TABLE IF NOT EXISTS `component` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cost` float DEFAULT NULL,
  `link` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table 2207508_wrc.component: ~10 rows (approximately)
/*!40000 ALTER TABLE `component` DISABLE KEYS */;
INSERT INTO `component` (`id`, `type`, `description`, `cost`, `link`, `image`) VALUES
	(1, 'Processador', 'AMD FX 4300 Black Edition 3.8GHz 8MB BOX SKAM3+', 58.3, 'https://www.chiptec.net/componentes-para-computadores/processadores/amd-socket-am3/amd-fx-4300-black-edition-3-8ghz-8mb-box-skam3.html?___SID=U', 'amd-fx-4300-black-edition-3-8ghz-8mb-box-skam3-fd4300wmhkbox-by-amd-67f.gif'),
	(2, 'Gráfica', 'Asrock 760GM-HDV AMD 760G SKAM3+', 56.9, 'https://www.chiptec.net/componentes-para-computadores/motherboards/amd-socket-am3/asrock-760gm-hdv-amd-760g-skam3.html?___SID=U', 'asrock-760gm-hdv-amd-760g-skam3-90-mxb7u0-a0uayz-by-asrock-947.gif'),
	(3, 'Cooling', 'Arctic Cooling Alpine 11 Pro Rev.2', 9.5, 'https://www.chiptec.net/componentes-para-computadores/cooling/coolers-para-cpu/arctic-cooling-alpine-11-pro-rev-2.html', 'arctic-cooling-alpine-11-pro-rev-2-ucaco-ap110-gbb01-by-arctic-47b.gif'),
	(4, 'Fonte', 'Aerocool KCAS 500W 80 PLUS Bronze', 37.9, 'https://www.chiptec.net/componentes-para-computadores/fontes/fontes-de-alimentacao/aerocool-kcas-500w-80-plus-bronze.html?___SID=U', 'aerocool-kcas-500w-80-plus-bronze-kcas500s-by-aerocool-4ba.gif'),
	(5, 'RAM', 'Corsair Vengeance Blue 2x4096MB (8GB) DDR3 1600Mhz CAS9 1.5V', 59.9, 'https://www.chiptec.net/componentes-para-computadores/memorias-ram/memorias-ddriii/memorias-ddr3-1600/corsair-vengeance-blue-2x4096mb-8gb-ddr3-1600mhz-cas9-1-5v.html?___SID=U', 'corsair-vengeance-blue-2x4096mb-8gb-ddr3-1600mhz-cas9-1-5v-cmz8gx3m2a1600c9b-by-corsair-bf8.gif'),
	(6, 'Caixa', 'Aerocool CS-105 - Black', 28.9, 'https://www.chiptec.net/componentes-para-computadores/caixas-para-computadores/caixas-micro-atx/aerocool-cs-105-black.html?___SID=U', 'aerocool-cs-105-black-cs105bl-by-aerocool-234.gif'),
	(7, 'Disco', 'HP 1TB 6G SATA 7200RPM 3.5 NHP LFF HDD', 79.9, 'https://www.chiptec.net/componentes-para-computadores/armazenamento-interno/discos-rigidos-3-5-sata/hp-1tb-6g-sata-7200rpm-3-5-nhp-lff-hdd.html?___SID=U', 'hp-1tb-6g-sata-7200rpm-3-5-nhp-lff-hdd-843266-b21-by-hp-c4b.gif'),
	(8, 'CPU', 'Intel Core i5 7640X 4GHz 6MB BOX', 205.9, 'https://www.chiptec.net/componentes-para-computadores/processadores/intel-socket-2066/intel-core-i5-7640x-4ghz-6mb-box.html?___SID=U', 'intel-core-i5-7640x-4ghz-6mb-box-bx80677i57640x-by-intel-0a1.gif'),
	(9, 'Caixa', 'Aerocool Cyclops Advance Black USB 3.0', 51.9, 'https://www.chiptec.net/componentes-para-computadores/caixas-para-computadores/caixas-atx/aerocool-cyclops-advance-black-usb-3-0.html?___SID=U', 'aerocool-cyclops-advance-black-usb-3-0-cyclopsadbk-by-aerocool-ae6.gif'),
	(10, 'Caixa', 'Aerocool Quartz Blue', 65.9, 'https://www.chiptec.net/componentes-para-computadores/caixas-para-computadores/caixas-atx/aerocool-quartz-blue.html?___SID=U', 'aerocool-quartz-blue-quartzbl-by-aerocool-deb.gif');
/*!40000 ALTER TABLE `component` ENABLE KEYS */;

-- Dumping structure for table 2207508_wrc.computer
CREATE TABLE IF NOT EXISTS `computer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` float DEFAULT NULL,
  `image` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `longdesc` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table 2207508_wrc.computer: ~3 rows (approximately)
/*!40000 ALTER TABLE `computer` DISABLE KEYS */;
INSERT INTO `computer` (`id`, `description`, `price`, `image`, `longdesc`) VALUES
	(1, 'Computador básico', 300, 'aerocool-cs-105-black-cs105bl-by-aerocool-234.gif', 'Este computador serve as necessidades básicas do utilizador ocasional'),
	(2, 'Computador médio', 600, 'aerocool-cyclops-advance-black-usb-3-0-cyclopsadbk-by-aerocool-ae6.gif', 'Perfeito para uma utilização diária na maioria dos casos'),
	(3, 'Computador gaming', 1200, 'aerocool-quartz-blue-quartzbl-by-aerocool-deb.gif', 'Computador de alto rendimento, para gaming, utilização intensiva, desenvolvimento aplicacional.');
/*!40000 ALTER TABLE `computer` ENABLE KEYS */;

-- Dumping structure for table 2207508_wrc.computercomponents
CREATE TABLE IF NOT EXISTS `computercomponents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `computerid` int(11) DEFAULT NULL,
  `componentid` int(11) DEFAULT NULL,
  `qtd` int(11) DEFAULT NULL,
  `ordering` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table 2207508_wrc.computercomponents: ~10 rows (approximately)
/*!40000 ALTER TABLE `computercomponents` DISABLE KEYS */;
INSERT INTO `computercomponents` (`id`, `computerid`, `componentid`, `qtd`, `ordering`) VALUES
	(1, 1, 1, 1, 1),
	(2, 1, 2, 1, 2),
	(3, 1, 3, 1, 3),
	(4, 1, 4, 1, 4),
	(5, 1, 5, 1, 5),
	(6, 1, 6, 1, 7),
	(7, 1, 7, 1, 6),
	(8, 1, 8, 1, 8),
	(9, 2, 9, 1, 1),
	(10, 3, 10, 1, 1);
/*!40000 ALTER TABLE `computercomponents` ENABLE KEYS */;

-- Dumping structure for table 2207508_wrc.oauth_access_tokens
CREATE TABLE IF NOT EXISTS `oauth_access_tokens` (
  `access_token` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `client_id` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `expires` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `scope` varchar(4000) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`access_token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table 2207508_wrc.oauth_access_tokens: ~0 rows (approximately)
/*!40000 ALTER TABLE `oauth_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_access_tokens` ENABLE KEYS */;

-- Dumping structure for table 2207508_wrc.oauth_clients
CREATE TABLE IF NOT EXISTS `oauth_clients` (
  `client_id` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `client_secret` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `redirect_uri` varchar(2000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `grant_types` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `scope` varchar(4000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table 2207508_wrc.oauth_clients: ~0 rows (approximately)
/*!40000 ALTER TABLE `oauth_clients` DISABLE KEYS */;
INSERT INTO `oauth_clients` (`client_id`, `client_secret`, `redirect_uri`, `grant_types`, `scope`, `user_id`) VALUES
	('gdiogo2@gmail.com', 'thisismysecret', 'http://127.0.0.1:8080/my-oauth2-walkthrough/error.php', 'refresh_token password client_credentials', NULL, NULL);
/*!40000 ALTER TABLE `oauth_clients` ENABLE KEYS */;

-- Dumping structure for table 2207508_wrc.orderinfo
CREATE TABLE IF NOT EXISTS `orderinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `phonenumber` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `taxnumber` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `computerid` int(11) NOT NULL,
  `computerdesc` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `computercost` decimal(18,2) NOT NULL,
  `computerprice` decimal(18,2) NOT NULL,
  `computerqtd` int(11) NOT NULL,
  `computervatprice` decimal(18,2) NOT NULL,
  `computertotalprice` decimal(18,2) NOT NULL,
  `deliveryname` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `deliverystreet` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `deliveryzipcode` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `deliverycity` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `invoicename` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `invoicestreet` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `invoicezipcode` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `invoicecity` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table 2207508_wrc.orderinfo: ~29 rows (approximately)
/*!40000 ALTER TABLE `orderinfo` DISABLE KEYS */;
INSERT INTO `orderinfo` (`id`, `email`, `phonenumber`, `taxnumber`, `computerid`, `computerdesc`, `computercost`, `computerprice`, `computerqtd`, `computervatprice`, `computertotalprice`, `deliveryname`, `deliverystreet`, `deliveryzipcode`, `deliverycity`, `invoicename`, `invoicestreet`, `invoicezipcode`, `invoicecity`) VALUES
	(1, 'dadomingues@gmail.com', '968038530', '221786961', 1, 'Computador básico', 537.20, 300.00, 0, 0.00, 0.00, 'David Domingues', 'Praceta Carlos Paião,, 27, 3D', '2785-679', 'Rana', 'David Domingues', 'Praceta Carlos Paião,, 27, 3D', '2785-679', 'Rana'),
	(2, 'dadomingues@gmail.com', '968038530', '221786961', 1, 'Computador básico', 537.20, 300.00, 0, 0.00, 0.00, 'David Domingues', 'Praceta Carlos Paião,, 27, 3D', '2785-679', 'Rana', 'David Domingues', 'Praceta Carlos Paião,, 27, 3D', '2785-679', 'Rana'),
	(3, 'dadomingues@gmail.com', '968038530', '221786961', 1, 'Computador básico', 537.20, 300.00, 0, 0.00, 0.00, 'David Domingues', 'Praceta Carlos Paião,, 27, 3D', '2785-679', 'Rana', 'David Domingues', 'Praceta Carlos Paião,, 27, 3D', '2785-679', 'Rana'),
	(4, 'dadomingues@gmail.com', '968038530', '221786961', 1, 'Computador básico', 537.20, 300.00, 0, 0.00, 0.00, 'David Domingues', 'Praceta Carlos Paião,, 27, 3D', '2785-679', 'Rana', 'David Domingues', 'Praceta Carlos Paião,, 27, 3D', '2785-679', 'Rana'),
	(5, 'dadomingues@gmail.com', '968038530', '221786961', 1, 'Computador básico', 537.20, 300.00, 0, 0.00, 0.00, 'David Domingues', 'Praceta Carlos Paião,, 27, 3D', '2785-679', 'Rana', 'David Domingues', 'Praceta Carlos Paião,, 27, 3D', '2785-679', 'Rana'),
	(6, 'dadomingues@gmail.com', '968038530', '221786961', 1, 'Computador básico', 537.20, 300.00, 0, 0.00, 0.00, 'David Domingues', 'Praceta Carlos Paião,, 27, 3D', '2785-679', 'Rana', 'David Domingues', 'Praceta Carlos Paião,, 27, 3D', '2785-679', 'Rana'),
	(7, 'dadomingues@gmail.com', '968038530', '221786961', 1, 'Computador básico', 537.20, 300.00, 0, 0.00, 0.00, 'David Domingues', 'Praceta Carlos Paião,, 27, 3D', '2785-679', 'Rana', 'David Domingues', 'Praceta Carlos Paião,, 27, 3D', '2785-679', 'Rana'),
	(8, 'dadomingues@gmail.com', '968038530', '221786961', 1, 'Computador básico', 537.20, 300.00, 0, 0.00, 0.00, 'David Domingues', 'Praceta Carlos Paião,, 27, 3D', '2785-679', 'Rana', 'David Domingues', 'Praceta Carlos Paião,, 27, 3D', '2785-679', 'Rana'),
	(9, 'dadomingues@gmail.com', '968038530', '221786961', 1, 'Computador básico', 537.20, 300.00, 0, 0.00, 0.00, 'David Domingues', 'Praceta Carlos Paião,, 27, 3D', '2785-679', 'Rana', 'David Domingues', 'Praceta Carlos Paião,, 27, 3D', '2785-679', 'Rana'),
	(10, 'dadomingues@gmail.com', '968038530', '2132123111', 1, 'Computador básico', 537.20, 300.00, 0, 0.00, 0.00, 'David Domingues', 'Praceta Carlos Paião,, 27, 3D', '2785-679', 'Rana', 'David Domingues', 'Praceta Carlos Paião,, 27, 3D', '2785-679', 'Rana'),
	(11, 'dadomingues@gmail.com', '968038530', '111212123', 1, 'Computador básico', 537.20, 300.00, 0, 0.00, 0.00, 'David Domingues', 'Praceta Carlos Paião,, 27, 3D', '2785-679', 'Rana', 'David Domingues', 'Praceta Carlos Paião,, 27, 3D', '2785-679', 'Rana'),
	(12, 'dadomingues@gmail.com', '968038530', '111212123', 1, 'Computador básico', 537.20, 300.00, 0, 0.00, 0.00, 'David Domingues', 'Praceta Carlos Paião,, 27, 3D', '2785-679', 'Rana', 'David Domingues', 'Praceta Carlos Paião,, 27, 3D', '2785-679', 'Rana'),
	(13, 'dadomingues@gmail.com', '968038530', '111212123', 1, 'Computador básico', 537.20, 300.00, 0, 0.00, 0.00, 'David Domingues', 'Praceta Carlos Paião,, 27, 3D', '2785-679', 'Rana', 'David Domingues', 'Praceta Carlos Paião,, 27, 3D', '2785-679', 'Rana'),
	(14, 'dadomingues@gmail.com', '968038530', '111212123', 1, 'Computador básico', 537.20, 300.00, 0, 0.00, 0.00, 'David Domingues', 'Praceta Carlos Paião,, 27, 3D', '2785-679', 'Rana', 'David Domingues', 'Praceta Carlos Paião,, 27, 3D', '2785-679', 'Rana'),
	(15, 'dadomingues@gmail.com', '968038530', '1231321321', 1, 'Computador básico', 537.20, 300.00, 1, 56.10, 300.00, 'David Domingues', 'Praceta Carlos Paião,, 27, 3D', '2785-679', 'Rana', 'David Domingues', 'Praceta Carlos Paião,, 27, 3D', '2785-679', 'Rana'),
	(16, 'dadomingues@gmail.com', '968038530', '1231321321', 1, 'Computador básico', 537.20, 300.00, 1, 56.10, 300.00, 'David Domingues', 'Praceta Carlos Paião,, 27, 3D', '2785-679', 'Rana', 'David Domingues', 'Praceta Carlos Paião,, 27, 3D', '2785-679', 'Rana'),
	(17, 'dadomingues@gmail.com', '968038530', '1231321321', 1, 'Computador básico', 537.20, 300.00, 1, 56.10, 300.00, 'David Domingues', 'Praceta Carlos Paião,, 27, 3D', '2785-679', 'Rana', 'David Domingues', 'Praceta Carlos Paião,, 27, 3D', '2785-679', 'Rana'),
	(18, 'dadomingues@gmail.com', '968038530', '1231321321', 1, 'Computador básico', 537.20, 300.00, 2, 112.20, 600.00, 'David Domingues', 'Praceta Carlos Paião,, 27, 3D', '2785-679', 'Rana', 'David Domingues', 'Praceta Carlos Paião,, 27, 3D', '2785-679', 'Rana'),
	(19, 'dadomingues@gmail.com', '968038530', '1231321321', 1, 'Computador básico', 537.20, 300.00, 1, 56.10, 300.00, 'David Domingues', 'Praceta Carlos Paião,, 27, 3D', '2785-679', 'Rana', 'David Domingues', 'Praceta Carlos Paião,, 27, 3D', '2785-679', 'Rana'),
	(20, 'dadomingues@gmail.com', '968038530', '1231321321', 1, 'Computador básico', 537.20, 300.00, 3, 168.29, 900.00, 'David Domingues', 'Praceta Carlos Paião,, 27, 3D', '2785-679', 'Rana', 'David Domingues', 'Praceta Carlos Paião,, 27, 3D', '2785-679', 'Rana'),
	(21, 'gdiogo2@gmail.com', '968038530', '212154546', 1, 'Computador básico', 537.20, 300.00, 1, 56.10, 300.00, 'Graça Diogo', 'Praceta Carlos Paião, 27, 3D', '2785-679', 'Rana', 'Graça Diogo', 'Praceta Carlos Paião, 27, 3D', '2785-679', 'Rana'),
	(22, 'gdiogo2@gmail.com', '968038530', '212154546', 1, 'Computador básico', 537.20, 300.00, 1, 56.10, 300.00, 'Graça Diogo', 'Praceta Carlos Paião, 27, 3D', '2785-679', 'Rana', 'Graça Diogo', 'Praceta Carlos Paião, 27, 3D', '2785-679', 'Rana'),
	(23, 'gdiogo2@gmail.com', '968038530', '212154546', 1, 'Computador básico', 537.20, 300.00, 1, 56.10, 300.00, 'Graça Diogo', 'Praceta Carlos Paião, 27, 3D', '2785-679', 'Rana', 'Graça Diogo', 'Praceta Carlos Paião, 27, 3D', '2785-679', 'Rana'),
	(24, 'gdiogo2@gmail.com', '968038530', '212154546', 1, 'Computador básico', 537.20, 300.00, 1, 56.10, 300.00, 'Graça Diogo', 'Praceta Carlos Paião, 27, 3D', '2785-679', 'Rana', 'Graça Diogo', 'Praceta Carlos Paião, 27, 3D', '2785-679', 'Rana'),
	(25, 'gdiogo2@gmail.com', '968038530', '212154546', 1, 'Computador básico', 537.20, 300.00, 1, 56.10, 300.00, 'Graça Diogo', 'Praceta Carlos Paião, 27, 3D', '2785-679', 'Rana', 'Graça Diogo', 'Praceta Carlos Paião, 27, 3D', '2785-679', 'Rana'),
	(26, 'gdiogo2@gmail.com', '968038530', '212154546', 1, 'Computador básico', 537.20, 300.00, 1, 56.10, 300.00, 'Graça Diogo', 'Praceta Carlos Paião, 27, 3D', '2785-679', 'Rana', 'Graça Diogo', 'Praceta Carlos Paião, 27, 3D', '2785-679', 'Rana'),
	(27, 'gdiogo2@gmail.com', '968038530', '212154546', 1, 'Computador básico', 537.20, 300.00, 1, 56.10, 300.00, 'Graça Diogo', 'Praceta Carlos Paião, 27, 3D', '2785-679', 'Rana', 'Graça Diogo', 'Praceta Carlos Paião, 27, 3D', '2785-679', 'Rana'),
	(28, 'gdiogo2@gmail.com', '968038530', '212154546', 1, 'Computador básico', 537.20, 300.00, 1, 56.10, 300.00, 'Graça Diogo', 'Praceta Carlos Paião, 27, 3D', '2785-679', 'Rana', 'Graça Diogo', 'Praceta Carlos Paião, 27, 3D', '2785-679', 'Rana'),
	(29, 'gdiogo2@gmail.com', '968038530', '212154546', 1, 'Computador básico', 537.20, 300.00, 1, 56.10, 300.00, 'Graça Diogo', 'Praceta Carlos Paião, 27, 3D', '2785-679', 'Rana', 'Graça Diogo', 'Praceta Carlos Paião, 27, 3D', '2785-679', 'Rana'),
	(30, 'gdiogo2@gmail.com', '968038530', '212154546', 1, 'Computador básico', 537.20, 300.00, 1, 56.10, 300.00, 'Graça Diogo', 'Praceta Carlos Paião, 27, 3D', '2785-679', 'Rana', 'Graça Diogo', 'Praceta Carlos Paião, 27, 3D', '2785-679', 'Rana'),
	(31, 'gdiogo2@gmail.com', '968038530', '212154546', 1, 'Computador básico', 537.20, 300.00, 1, 56.10, 300.00, 'Graça Diogo', 'Praceta Carlos Paião, 27, 3D', '2785-679', 'Rana', 'Graça Diogo', 'Praceta Carlos Paião, 27, 3D', '2785-679', 'Rana');
/*!40000 ALTER TABLE `orderinfo` ENABLE KEYS */;

-- Dumping structure for table 2207508_wrc.orderinfodetails
CREATE TABLE IF NOT EXISTS `orderinfodetails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orderinfoid` int(11) DEFAULT NULL,
  `computerid` int(11) DEFAULT NULL,
  `componentid` int(11) DEFAULT NULL,
  `type` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `qtd` int(11) DEFAULT NULL,
  `cost` float DEFAULT NULL,
  `link` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=272 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table 2207508_wrc.orderinfodetails: ~129 rows (approximately)
/*!40000 ALTER TABLE `orderinfodetails` DISABLE KEYS */;
INSERT INTO `orderinfodetails` (`id`, `orderinfoid`, `computerid`, `componentid`, `type`, `description`, `qtd`, `cost`, `link`, `image`) VALUES
	(1, 10, NULL, NULL, 'Processador', 'AMD FX 4300 Black Edition 3.8GHz 8MB BOX SKAM3+', NULL, 58.3, 'https://www.chiptec.net/componentes-para-computadores/processadores/amd-socket-am3/amd-fx-4300-black-edition-3-8ghz-8mb-box-skam3.html?___SID=U', 'amd-fx-4300-black-edition-3-8ghz-8mb-box-skam3-fd4300wmhkbox-by-amd-67f.gif'),
	(2, 14, 1, 1, 'Processador', 'AMD FX 4300 Black Edition 3.8GHz 8MB BOX SKAM3+', 1, 58.3, 'https://www.chiptec.net/componentes-para-computadores/processadores/amd-socket-am3/amd-fx-4300-black-edition-3-8ghz-8mb-box-skam3.html?___SID=U', 'amd-fx-4300-black-edition-3-8ghz-8mb-box-skam3-fd4300wmhkbox-by-amd-67f.gif'),
	(3, 14, 1, 2, 'Gráfica', 'Asrock 760GM-HDV AMD 760G SKAM3+', 1, 56.9, 'https://www.chiptec.net/componentes-para-computadores/motherboards/amd-socket-am3/asrock-760gm-hdv-amd-760g-skam3.html?___SID=U', 'asrock-760gm-hdv-amd-760g-skam3-90-mxb7u0-a0uayz-by-asrock-947.gif'),
	(4, 14, 1, 3, 'Cooling', 'Arctic Cooling Alpine 11 Pro Rev.2', 1, 9.5, 'https://www.chiptec.net/componentes-para-computadores/cooling/coolers-para-cpu/arctic-cooling-alpine-11-pro-rev-2.html', 'arctic-cooling-alpine-11-pro-rev-2-ucaco-ap110-gbb01-by-arctic-47b.gif'),
	(5, 14, 1, 4, 'Fonte', 'Aerocool KCAS 500W 80 PLUS Bronze', 1, 37.9, 'https://www.chiptec.net/componentes-para-computadores/fontes/fontes-de-alimentacao/aerocool-kcas-500w-80-plus-bronze.html?___SID=U', 'aerocool-kcas-500w-80-plus-bronze-kcas500s-by-aerocool-4ba.gif'),
	(6, 14, 1, 5, 'RAM', 'Corsair Vengeance Blue 2x4096MB (8GB) DDR3 1600Mhz CAS9 1.5V', 1, 59.9, 'https://www.chiptec.net/componentes-para-computadores/memorias-ram/memorias-ddriii/memorias-ddr3-1600/corsair-vengeance-blue-2x4096mb-8gb-ddr3-1600mhz-cas9-1-5v.html?___SID=U', 'corsair-vengeance-blue-2x4096mb-8gb-ddr3-1600mhz-cas9-1-5v-cmz8gx3m2a1600c9b-by-corsair-bf8.gif'),
	(7, 14, 1, 6, 'Caixa', 'Aerocool CS-105 - Black', 1, 28.9, 'https://www.chiptec.net/componentes-para-computadores/caixas-para-computadores/caixas-micro-atx/aerocool-cs-105-black.html?___SID=U', 'aerocool-cs-105-black-cs105bl-by-aerocool-234.gif'),
	(8, 14, 1, 7, 'Disco', 'HP 1TB 6G SATA 7200RPM 3.5 NHP LFF HDD', 1, 79.9, 'https://www.chiptec.net/componentes-para-computadores/armazenamento-interno/discos-rigidos-3-5-sata/hp-1tb-6g-sata-7200rpm-3-5-nhp-lff-hdd.html?___SID=U', 'hp-1tb-6g-sata-7200rpm-3-5-nhp-lff-hdd-843266-b21-by-hp-c4b.gif'),
	(9, 14, 1, 8, 'CPU', 'Intel Core i5 7640X 4GHz 6MB BOX', 1, 205.9, 'https://www.chiptec.net/componentes-para-computadores/processadores/intel-socket-2066/intel-core-i5-7640x-4ghz-6mb-box.html?___SID=U', 'intel-core-i5-7640x-4ghz-6mb-box-bx80677i57640x-by-intel-0a1.gif'),
	(17, 15, 1, 1, 'Processador', 'AMD FX 4300 Black Edition 3.8GHz 8MB BOX SKAM3+', 1, 58.3, 'https://www.chiptec.net/componentes-para-computadores/processadores/amd-socket-am3/amd-fx-4300-black-edition-3-8ghz-8mb-box-skam3.html?___SID=U', 'amd-fx-4300-black-edition-3-8ghz-8mb-box-skam3-fd4300wmhkbox-by-amd-67f.gif'),
	(18, 15, 1, 2, 'Gráfica', 'Asrock 760GM-HDV AMD 760G SKAM3+', 1, 56.9, 'https://www.chiptec.net/componentes-para-computadores/motherboards/amd-socket-am3/asrock-760gm-hdv-amd-760g-skam3.html?___SID=U', 'asrock-760gm-hdv-amd-760g-skam3-90-mxb7u0-a0uayz-by-asrock-947.gif'),
	(19, 15, 1, 3, 'Cooling', 'Arctic Cooling Alpine 11 Pro Rev.2', 1, 9.5, 'https://www.chiptec.net/componentes-para-computadores/cooling/coolers-para-cpu/arctic-cooling-alpine-11-pro-rev-2.html', 'arctic-cooling-alpine-11-pro-rev-2-ucaco-ap110-gbb01-by-arctic-47b.gif'),
	(20, 15, 1, 4, 'Fonte', 'Aerocool KCAS 500W 80 PLUS Bronze', 1, 37.9, 'https://www.chiptec.net/componentes-para-computadores/fontes/fontes-de-alimentacao/aerocool-kcas-500w-80-plus-bronze.html?___SID=U', 'aerocool-kcas-500w-80-plus-bronze-kcas500s-by-aerocool-4ba.gif'),
	(21, 15, 1, 5, 'RAM', 'Corsair Vengeance Blue 2x4096MB (8GB) DDR3 1600Mhz CAS9 1.5V', 1, 59.9, 'https://www.chiptec.net/componentes-para-computadores/memorias-ram/memorias-ddriii/memorias-ddr3-1600/corsair-vengeance-blue-2x4096mb-8gb-ddr3-1600mhz-cas9-1-5v.html?___SID=U', 'corsair-vengeance-blue-2x4096mb-8gb-ddr3-1600mhz-cas9-1-5v-cmz8gx3m2a1600c9b-by-corsair-bf8.gif'),
	(22, 15, 1, 6, 'Caixa', 'Aerocool CS-105 - Black', 1, 28.9, 'https://www.chiptec.net/componentes-para-computadores/caixas-para-computadores/caixas-micro-atx/aerocool-cs-105-black.html?___SID=U', 'aerocool-cs-105-black-cs105bl-by-aerocool-234.gif'),
	(23, 15, 1, 7, 'Disco', 'HP 1TB 6G SATA 7200RPM 3.5 NHP LFF HDD', 1, 79.9, 'https://www.chiptec.net/componentes-para-computadores/armazenamento-interno/discos-rigidos-3-5-sata/hp-1tb-6g-sata-7200rpm-3-5-nhp-lff-hdd.html?___SID=U', 'hp-1tb-6g-sata-7200rpm-3-5-nhp-lff-hdd-843266-b21-by-hp-c4b.gif'),
	(24, 15, 1, 8, 'CPU', 'Intel Core i5 7640X 4GHz 6MB BOX', 1, 205.9, 'https://www.chiptec.net/componentes-para-computadores/processadores/intel-socket-2066/intel-core-i5-7640x-4ghz-6mb-box.html?___SID=U', 'intel-core-i5-7640x-4ghz-6mb-box-bx80677i57640x-by-intel-0a1.gif'),
	(32, 16, 1, 1, 'Processador', 'AMD FX 4300 Black Edition 3.8GHz 8MB BOX SKAM3+', 1, 58.3, 'https://www.chiptec.net/componentes-para-computadores/processadores/amd-socket-am3/amd-fx-4300-black-edition-3-8ghz-8mb-box-skam3.html?___SID=U', 'amd-fx-4300-black-edition-3-8ghz-8mb-box-skam3-fd4300wmhkbox-by-amd-67f.gif'),
	(33, 16, 1, 2, 'Gráfica', 'Asrock 760GM-HDV AMD 760G SKAM3+', 1, 56.9, 'https://www.chiptec.net/componentes-para-computadores/motherboards/amd-socket-am3/asrock-760gm-hdv-amd-760g-skam3.html?___SID=U', 'asrock-760gm-hdv-amd-760g-skam3-90-mxb7u0-a0uayz-by-asrock-947.gif'),
	(34, 16, 1, 3, 'Cooling', 'Arctic Cooling Alpine 11 Pro Rev.2', 1, 9.5, 'https://www.chiptec.net/componentes-para-computadores/cooling/coolers-para-cpu/arctic-cooling-alpine-11-pro-rev-2.html', 'arctic-cooling-alpine-11-pro-rev-2-ucaco-ap110-gbb01-by-arctic-47b.gif'),
	(35, 16, 1, 4, 'Fonte', 'Aerocool KCAS 500W 80 PLUS Bronze', 1, 37.9, 'https://www.chiptec.net/componentes-para-computadores/fontes/fontes-de-alimentacao/aerocool-kcas-500w-80-plus-bronze.html?___SID=U', 'aerocool-kcas-500w-80-plus-bronze-kcas500s-by-aerocool-4ba.gif'),
	(36, 16, 1, 5, 'RAM', 'Corsair Vengeance Blue 2x4096MB (8GB) DDR3 1600Mhz CAS9 1.5V', 1, 59.9, 'https://www.chiptec.net/componentes-para-computadores/memorias-ram/memorias-ddriii/memorias-ddr3-1600/corsair-vengeance-blue-2x4096mb-8gb-ddr3-1600mhz-cas9-1-5v.html?___SID=U', 'corsair-vengeance-blue-2x4096mb-8gb-ddr3-1600mhz-cas9-1-5v-cmz8gx3m2a1600c9b-by-corsair-bf8.gif'),
	(37, 16, 1, 6, 'Caixa', 'Aerocool CS-105 - Black', 1, 28.9, 'https://www.chiptec.net/componentes-para-computadores/caixas-para-computadores/caixas-micro-atx/aerocool-cs-105-black.html?___SID=U', 'aerocool-cs-105-black-cs105bl-by-aerocool-234.gif'),
	(38, 16, 1, 7, 'Disco', 'HP 1TB 6G SATA 7200RPM 3.5 NHP LFF HDD', 1, 79.9, 'https://www.chiptec.net/componentes-para-computadores/armazenamento-interno/discos-rigidos-3-5-sata/hp-1tb-6g-sata-7200rpm-3-5-nhp-lff-hdd.html?___SID=U', 'hp-1tb-6g-sata-7200rpm-3-5-nhp-lff-hdd-843266-b21-by-hp-c4b.gif'),
	(39, 16, 1, 8, 'CPU', 'Intel Core i5 7640X 4GHz 6MB BOX', 1, 205.9, 'https://www.chiptec.net/componentes-para-computadores/processadores/intel-socket-2066/intel-core-i5-7640x-4ghz-6mb-box.html?___SID=U', 'intel-core-i5-7640x-4ghz-6mb-box-bx80677i57640x-by-intel-0a1.gif'),
	(47, 17, 1, 1, 'Processador', 'AMD FX 4300 Black Edition 3.8GHz 8MB BOX SKAM3+', 1, 58.3, 'https://www.chiptec.net/componentes-para-computadores/processadores/amd-socket-am3/amd-fx-4300-black-edition-3-8ghz-8mb-box-skam3.html?___SID=U', 'amd-fx-4300-black-edition-3-8ghz-8mb-box-skam3-fd4300wmhkbox-by-amd-67f.gif'),
	(48, 17, 1, 2, 'Gráfica', 'Asrock 760GM-HDV AMD 760G SKAM3+', 1, 56.9, 'https://www.chiptec.net/componentes-para-computadores/motherboards/amd-socket-am3/asrock-760gm-hdv-amd-760g-skam3.html?___SID=U', 'asrock-760gm-hdv-amd-760g-skam3-90-mxb7u0-a0uayz-by-asrock-947.gif'),
	(49, 17, 1, 3, 'Cooling', 'Arctic Cooling Alpine 11 Pro Rev.2', 1, 9.5, 'https://www.chiptec.net/componentes-para-computadores/cooling/coolers-para-cpu/arctic-cooling-alpine-11-pro-rev-2.html', 'arctic-cooling-alpine-11-pro-rev-2-ucaco-ap110-gbb01-by-arctic-47b.gif'),
	(50, 17, 1, 4, 'Fonte', 'Aerocool KCAS 500W 80 PLUS Bronze', 1, 37.9, 'https://www.chiptec.net/componentes-para-computadores/fontes/fontes-de-alimentacao/aerocool-kcas-500w-80-plus-bronze.html?___SID=U', 'aerocool-kcas-500w-80-plus-bronze-kcas500s-by-aerocool-4ba.gif'),
	(51, 17, 1, 5, 'RAM', 'Corsair Vengeance Blue 2x4096MB (8GB) DDR3 1600Mhz CAS9 1.5V', 1, 59.9, 'https://www.chiptec.net/componentes-para-computadores/memorias-ram/memorias-ddriii/memorias-ddr3-1600/corsair-vengeance-blue-2x4096mb-8gb-ddr3-1600mhz-cas9-1-5v.html?___SID=U', 'corsair-vengeance-blue-2x4096mb-8gb-ddr3-1600mhz-cas9-1-5v-cmz8gx3m2a1600c9b-by-corsair-bf8.gif'),
	(52, 17, 1, 6, 'Caixa', 'Aerocool CS-105 - Black', 1, 28.9, 'https://www.chiptec.net/componentes-para-computadores/caixas-para-computadores/caixas-micro-atx/aerocool-cs-105-black.html?___SID=U', 'aerocool-cs-105-black-cs105bl-by-aerocool-234.gif'),
	(53, 17, 1, 7, 'Disco', 'HP 1TB 6G SATA 7200RPM 3.5 NHP LFF HDD', 1, 79.9, 'https://www.chiptec.net/componentes-para-computadores/armazenamento-interno/discos-rigidos-3-5-sata/hp-1tb-6g-sata-7200rpm-3-5-nhp-lff-hdd.html?___SID=U', 'hp-1tb-6g-sata-7200rpm-3-5-nhp-lff-hdd-843266-b21-by-hp-c4b.gif'),
	(54, 17, 1, 8, 'CPU', 'Intel Core i5 7640X 4GHz 6MB BOX', 1, 205.9, 'https://www.chiptec.net/componentes-para-computadores/processadores/intel-socket-2066/intel-core-i5-7640x-4ghz-6mb-box.html?___SID=U', 'intel-core-i5-7640x-4ghz-6mb-box-bx80677i57640x-by-intel-0a1.gif'),
	(62, 18, 1, 1, 'Processador', 'AMD FX 4300 Black Edition 3.8GHz 8MB BOX SKAM3+', 1, 58.3, 'https://www.chiptec.net/componentes-para-computadores/processadores/amd-socket-am3/amd-fx-4300-black-edition-3-8ghz-8mb-box-skam3.html?___SID=U', 'amd-fx-4300-black-edition-3-8ghz-8mb-box-skam3-fd4300wmhkbox-by-amd-67f.gif'),
	(63, 18, 1, 2, 'Gráfica', 'Asrock 760GM-HDV AMD 760G SKAM3+', 1, 56.9, 'https://www.chiptec.net/componentes-para-computadores/motherboards/amd-socket-am3/asrock-760gm-hdv-amd-760g-skam3.html?___SID=U', 'asrock-760gm-hdv-amd-760g-skam3-90-mxb7u0-a0uayz-by-asrock-947.gif'),
	(64, 18, 1, 3, 'Cooling', 'Arctic Cooling Alpine 11 Pro Rev.2', 1, 9.5, 'https://www.chiptec.net/componentes-para-computadores/cooling/coolers-para-cpu/arctic-cooling-alpine-11-pro-rev-2.html', 'arctic-cooling-alpine-11-pro-rev-2-ucaco-ap110-gbb01-by-arctic-47b.gif'),
	(65, 18, 1, 4, 'Fonte', 'Aerocool KCAS 500W 80 PLUS Bronze', 1, 37.9, 'https://www.chiptec.net/componentes-para-computadores/fontes/fontes-de-alimentacao/aerocool-kcas-500w-80-plus-bronze.html?___SID=U', 'aerocool-kcas-500w-80-plus-bronze-kcas500s-by-aerocool-4ba.gif'),
	(66, 18, 1, 5, 'RAM', 'Corsair Vengeance Blue 2x4096MB (8GB) DDR3 1600Mhz CAS9 1.5V', 1, 59.9, 'https://www.chiptec.net/componentes-para-computadores/memorias-ram/memorias-ddriii/memorias-ddr3-1600/corsair-vengeance-blue-2x4096mb-8gb-ddr3-1600mhz-cas9-1-5v.html?___SID=U', 'corsair-vengeance-blue-2x4096mb-8gb-ddr3-1600mhz-cas9-1-5v-cmz8gx3m2a1600c9b-by-corsair-bf8.gif'),
	(67, 18, 1, 6, 'Caixa', 'Aerocool CS-105 - Black', 1, 28.9, 'https://www.chiptec.net/componentes-para-computadores/caixas-para-computadores/caixas-micro-atx/aerocool-cs-105-black.html?___SID=U', 'aerocool-cs-105-black-cs105bl-by-aerocool-234.gif'),
	(68, 18, 1, 7, 'Disco', 'HP 1TB 6G SATA 7200RPM 3.5 NHP LFF HDD', 1, 79.9, 'https://www.chiptec.net/componentes-para-computadores/armazenamento-interno/discos-rigidos-3-5-sata/hp-1tb-6g-sata-7200rpm-3-5-nhp-lff-hdd.html?___SID=U', 'hp-1tb-6g-sata-7200rpm-3-5-nhp-lff-hdd-843266-b21-by-hp-c4b.gif'),
	(69, 18, 1, 8, 'CPU', 'Intel Core i5 7640X 4GHz 6MB BOX', 1, 205.9, 'https://www.chiptec.net/componentes-para-computadores/processadores/intel-socket-2066/intel-core-i5-7640x-4ghz-6mb-box.html?___SID=U', 'intel-core-i5-7640x-4ghz-6mb-box-bx80677i57640x-by-intel-0a1.gif'),
	(77, 19, 1, 1, 'Processador', 'AMD FX 4300 Black Edition 3.8GHz 8MB BOX SKAM3+', 1, 58.3, 'https://www.chiptec.net/componentes-para-computadores/processadores/amd-socket-am3/amd-fx-4300-black-edition-3-8ghz-8mb-box-skam3.html?___SID=U', 'amd-fx-4300-black-edition-3-8ghz-8mb-box-skam3-fd4300wmhkbox-by-amd-67f.gif'),
	(78, 19, 1, 2, 'Gráfica', 'Asrock 760GM-HDV AMD 760G SKAM3+', 1, 56.9, 'https://www.chiptec.net/componentes-para-computadores/motherboards/amd-socket-am3/asrock-760gm-hdv-amd-760g-skam3.html?___SID=U', 'asrock-760gm-hdv-amd-760g-skam3-90-mxb7u0-a0uayz-by-asrock-947.gif'),
	(79, 19, 1, 3, 'Cooling', 'Arctic Cooling Alpine 11 Pro Rev.2', 1, 9.5, 'https://www.chiptec.net/componentes-para-computadores/cooling/coolers-para-cpu/arctic-cooling-alpine-11-pro-rev-2.html', 'arctic-cooling-alpine-11-pro-rev-2-ucaco-ap110-gbb01-by-arctic-47b.gif'),
	(80, 19, 1, 4, 'Fonte', 'Aerocool KCAS 500W 80 PLUS Bronze', 1, 37.9, 'https://www.chiptec.net/componentes-para-computadores/fontes/fontes-de-alimentacao/aerocool-kcas-500w-80-plus-bronze.html?___SID=U', 'aerocool-kcas-500w-80-plus-bronze-kcas500s-by-aerocool-4ba.gif'),
	(81, 19, 1, 5, 'RAM', 'Corsair Vengeance Blue 2x4096MB (8GB) DDR3 1600Mhz CAS9 1.5V', 1, 59.9, 'https://www.chiptec.net/componentes-para-computadores/memorias-ram/memorias-ddriii/memorias-ddr3-1600/corsair-vengeance-blue-2x4096mb-8gb-ddr3-1600mhz-cas9-1-5v.html?___SID=U', 'corsair-vengeance-blue-2x4096mb-8gb-ddr3-1600mhz-cas9-1-5v-cmz8gx3m2a1600c9b-by-corsair-bf8.gif'),
	(82, 19, 1, 6, 'Caixa', 'Aerocool CS-105 - Black', 1, 28.9, 'https://www.chiptec.net/componentes-para-computadores/caixas-para-computadores/caixas-micro-atx/aerocool-cs-105-black.html?___SID=U', 'aerocool-cs-105-black-cs105bl-by-aerocool-234.gif'),
	(83, 19, 1, 7, 'Disco', 'HP 1TB 6G SATA 7200RPM 3.5 NHP LFF HDD', 1, 79.9, 'https://www.chiptec.net/componentes-para-computadores/armazenamento-interno/discos-rigidos-3-5-sata/hp-1tb-6g-sata-7200rpm-3-5-nhp-lff-hdd.html?___SID=U', 'hp-1tb-6g-sata-7200rpm-3-5-nhp-lff-hdd-843266-b21-by-hp-c4b.gif'),
	(84, 19, 1, 8, 'CPU', 'Intel Core i5 7640X 4GHz 6MB BOX', 1, 205.9, 'https://www.chiptec.net/componentes-para-computadores/processadores/intel-socket-2066/intel-core-i5-7640x-4ghz-6mb-box.html?___SID=U', 'intel-core-i5-7640x-4ghz-6mb-box-bx80677i57640x-by-intel-0a1.gif'),
	(92, 20, 1, 1, 'Processador', 'AMD FX 4300 Black Edition 3.8GHz 8MB BOX SKAM3+', 1, 58.3, 'https://www.chiptec.net/componentes-para-computadores/processadores/amd-socket-am3/amd-fx-4300-black-edition-3-8ghz-8mb-box-skam3.html?___SID=U', 'amd-fx-4300-black-edition-3-8ghz-8mb-box-skam3-fd4300wmhkbox-by-amd-67f.gif'),
	(93, 20, 1, 2, 'Gráfica', 'Asrock 760GM-HDV AMD 760G SKAM3+', 1, 56.9, 'https://www.chiptec.net/componentes-para-computadores/motherboards/amd-socket-am3/asrock-760gm-hdv-amd-760g-skam3.html?___SID=U', 'asrock-760gm-hdv-amd-760g-skam3-90-mxb7u0-a0uayz-by-asrock-947.gif'),
	(94, 20, 1, 3, 'Cooling', 'Arctic Cooling Alpine 11 Pro Rev.2', 1, 9.5, 'https://www.chiptec.net/componentes-para-computadores/cooling/coolers-para-cpu/arctic-cooling-alpine-11-pro-rev-2.html', 'arctic-cooling-alpine-11-pro-rev-2-ucaco-ap110-gbb01-by-arctic-47b.gif'),
	(95, 20, 1, 4, 'Fonte', 'Aerocool KCAS 500W 80 PLUS Bronze', 1, 37.9, 'https://www.chiptec.net/componentes-para-computadores/fontes/fontes-de-alimentacao/aerocool-kcas-500w-80-plus-bronze.html?___SID=U', 'aerocool-kcas-500w-80-plus-bronze-kcas500s-by-aerocool-4ba.gif'),
	(96, 20, 1, 5, 'RAM', 'Corsair Vengeance Blue 2x4096MB (8GB) DDR3 1600Mhz CAS9 1.5V', 1, 59.9, 'https://www.chiptec.net/componentes-para-computadores/memorias-ram/memorias-ddriii/memorias-ddr3-1600/corsair-vengeance-blue-2x4096mb-8gb-ddr3-1600mhz-cas9-1-5v.html?___SID=U', 'corsair-vengeance-blue-2x4096mb-8gb-ddr3-1600mhz-cas9-1-5v-cmz8gx3m2a1600c9b-by-corsair-bf8.gif'),
	(97, 20, 1, 6, 'Caixa', 'Aerocool CS-105 - Black', 1, 28.9, 'https://www.chiptec.net/componentes-para-computadores/caixas-para-computadores/caixas-micro-atx/aerocool-cs-105-black.html?___SID=U', 'aerocool-cs-105-black-cs105bl-by-aerocool-234.gif'),
	(98, 20, 1, 7, 'Disco', 'HP 1TB 6G SATA 7200RPM 3.5 NHP LFF HDD', 1, 79.9, 'https://www.chiptec.net/componentes-para-computadores/armazenamento-interno/discos-rigidos-3-5-sata/hp-1tb-6g-sata-7200rpm-3-5-nhp-lff-hdd.html?___SID=U', 'hp-1tb-6g-sata-7200rpm-3-5-nhp-lff-hdd-843266-b21-by-hp-c4b.gif'),
	(99, 20, 1, 8, 'CPU', 'Intel Core i5 7640X 4GHz 6MB BOX', 1, 205.9, 'https://www.chiptec.net/componentes-para-computadores/processadores/intel-socket-2066/intel-core-i5-7640x-4ghz-6mb-box.html?___SID=U', 'intel-core-i5-7640x-4ghz-6mb-box-bx80677i57640x-by-intel-0a1.gif'),
	(107, 21, 1, 1, 'Processador', 'AMD FX 4300 Black Edition 3.8GHz 8MB BOX SKAM3+', 1, 58.3, 'https://www.chiptec.net/componentes-para-computadores/processadores/amd-socket-am3/amd-fx-4300-black-edition-3-8ghz-8mb-box-skam3.html?___SID=U', 'amd-fx-4300-black-edition-3-8ghz-8mb-box-skam3-fd4300wmhkbox-by-amd-67f.gif'),
	(108, 21, 1, 2, 'Gráfica', 'Asrock 760GM-HDV AMD 760G SKAM3+', 1, 56.9, 'https://www.chiptec.net/componentes-para-computadores/motherboards/amd-socket-am3/asrock-760gm-hdv-amd-760g-skam3.html?___SID=U', 'asrock-760gm-hdv-amd-760g-skam3-90-mxb7u0-a0uayz-by-asrock-947.gif'),
	(109, 21, 1, 3, 'Cooling', 'Arctic Cooling Alpine 11 Pro Rev.2', 1, 9.5, 'https://www.chiptec.net/componentes-para-computadores/cooling/coolers-para-cpu/arctic-cooling-alpine-11-pro-rev-2.html', 'arctic-cooling-alpine-11-pro-rev-2-ucaco-ap110-gbb01-by-arctic-47b.gif'),
	(110, 21, 1, 4, 'Fonte', 'Aerocool KCAS 500W 80 PLUS Bronze', 1, 37.9, 'https://www.chiptec.net/componentes-para-computadores/fontes/fontes-de-alimentacao/aerocool-kcas-500w-80-plus-bronze.html?___SID=U', 'aerocool-kcas-500w-80-plus-bronze-kcas500s-by-aerocool-4ba.gif'),
	(111, 21, 1, 5, 'RAM', 'Corsair Vengeance Blue 2x4096MB (8GB) DDR3 1600Mhz CAS9 1.5V', 1, 59.9, 'https://www.chiptec.net/componentes-para-computadores/memorias-ram/memorias-ddriii/memorias-ddr3-1600/corsair-vengeance-blue-2x4096mb-8gb-ddr3-1600mhz-cas9-1-5v.html?___SID=U', 'corsair-vengeance-blue-2x4096mb-8gb-ddr3-1600mhz-cas9-1-5v-cmz8gx3m2a1600c9b-by-corsair-bf8.gif'),
	(112, 21, 1, 6, 'Caixa', 'Aerocool CS-105 - Black', 1, 28.9, 'https://www.chiptec.net/componentes-para-computadores/caixas-para-computadores/caixas-micro-atx/aerocool-cs-105-black.html?___SID=U', 'aerocool-cs-105-black-cs105bl-by-aerocool-234.gif'),
	(113, 21, 1, 7, 'Disco', 'HP 1TB 6G SATA 7200RPM 3.5 NHP LFF HDD', 1, 79.9, 'https://www.chiptec.net/componentes-para-computadores/armazenamento-interno/discos-rigidos-3-5-sata/hp-1tb-6g-sata-7200rpm-3-5-nhp-lff-hdd.html?___SID=U', 'hp-1tb-6g-sata-7200rpm-3-5-nhp-lff-hdd-843266-b21-by-hp-c4b.gif'),
	(114, 21, 1, 8, 'CPU', 'Intel Core i5 7640X 4GHz 6MB BOX', 1, 205.9, 'https://www.chiptec.net/componentes-para-computadores/processadores/intel-socket-2066/intel-core-i5-7640x-4ghz-6mb-box.html?___SID=U', 'intel-core-i5-7640x-4ghz-6mb-box-bx80677i57640x-by-intel-0a1.gif'),
	(122, 22, 1, 1, 'Processador', 'AMD FX 4300 Black Edition 3.8GHz 8MB BOX SKAM3+', 1, 58.3, 'https://www.chiptec.net/componentes-para-computadores/processadores/amd-socket-am3/amd-fx-4300-black-edition-3-8ghz-8mb-box-skam3.html?___SID=U', 'amd-fx-4300-black-edition-3-8ghz-8mb-box-skam3-fd4300wmhkbox-by-amd-67f.gif'),
	(123, 22, 1, 2, 'Gráfica', 'Asrock 760GM-HDV AMD 760G SKAM3+', 1, 56.9, 'https://www.chiptec.net/componentes-para-computadores/motherboards/amd-socket-am3/asrock-760gm-hdv-amd-760g-skam3.html?___SID=U', 'asrock-760gm-hdv-amd-760g-skam3-90-mxb7u0-a0uayz-by-asrock-947.gif'),
	(124, 22, 1, 3, 'Cooling', 'Arctic Cooling Alpine 11 Pro Rev.2', 1, 9.5, 'https://www.chiptec.net/componentes-para-computadores/cooling/coolers-para-cpu/arctic-cooling-alpine-11-pro-rev-2.html', 'arctic-cooling-alpine-11-pro-rev-2-ucaco-ap110-gbb01-by-arctic-47b.gif'),
	(125, 22, 1, 4, 'Fonte', 'Aerocool KCAS 500W 80 PLUS Bronze', 1, 37.9, 'https://www.chiptec.net/componentes-para-computadores/fontes/fontes-de-alimentacao/aerocool-kcas-500w-80-plus-bronze.html?___SID=U', 'aerocool-kcas-500w-80-plus-bronze-kcas500s-by-aerocool-4ba.gif'),
	(126, 22, 1, 5, 'RAM', 'Corsair Vengeance Blue 2x4096MB (8GB) DDR3 1600Mhz CAS9 1.5V', 1, 59.9, 'https://www.chiptec.net/componentes-para-computadores/memorias-ram/memorias-ddriii/memorias-ddr3-1600/corsair-vengeance-blue-2x4096mb-8gb-ddr3-1600mhz-cas9-1-5v.html?___SID=U', 'corsair-vengeance-blue-2x4096mb-8gb-ddr3-1600mhz-cas9-1-5v-cmz8gx3m2a1600c9b-by-corsair-bf8.gif'),
	(127, 22, 1, 6, 'Caixa', 'Aerocool CS-105 - Black', 1, 28.9, 'https://www.chiptec.net/componentes-para-computadores/caixas-para-computadores/caixas-micro-atx/aerocool-cs-105-black.html?___SID=U', 'aerocool-cs-105-black-cs105bl-by-aerocool-234.gif'),
	(128, 22, 1, 7, 'Disco', 'HP 1TB 6G SATA 7200RPM 3.5 NHP LFF HDD', 1, 79.9, 'https://www.chiptec.net/componentes-para-computadores/armazenamento-interno/discos-rigidos-3-5-sata/hp-1tb-6g-sata-7200rpm-3-5-nhp-lff-hdd.html?___SID=U', 'hp-1tb-6g-sata-7200rpm-3-5-nhp-lff-hdd-843266-b21-by-hp-c4b.gif'),
	(129, 22, 1, 8, 'CPU', 'Intel Core i5 7640X 4GHz 6MB BOX', 1, 205.9, 'https://www.chiptec.net/componentes-para-computadores/processadores/intel-socket-2066/intel-core-i5-7640x-4ghz-6mb-box.html?___SID=U', 'intel-core-i5-7640x-4ghz-6mb-box-bx80677i57640x-by-intel-0a1.gif'),
	(137, 23, 1, 1, 'Processador', 'AMD FX 4300 Black Edition 3.8GHz 8MB BOX SKAM3+', 1, 58.3, 'https://www.chiptec.net/componentes-para-computadores/processadores/amd-socket-am3/amd-fx-4300-black-edition-3-8ghz-8mb-box-skam3.html?___SID=U', 'amd-fx-4300-black-edition-3-8ghz-8mb-box-skam3-fd4300wmhkbox-by-amd-67f.gif'),
	(138, 23, 1, 2, 'Gráfica', 'Asrock 760GM-HDV AMD 760G SKAM3+', 1, 56.9, 'https://www.chiptec.net/componentes-para-computadores/motherboards/amd-socket-am3/asrock-760gm-hdv-amd-760g-skam3.html?___SID=U', 'asrock-760gm-hdv-amd-760g-skam3-90-mxb7u0-a0uayz-by-asrock-947.gif'),
	(139, 23, 1, 3, 'Cooling', 'Arctic Cooling Alpine 11 Pro Rev.2', 1, 9.5, 'https://www.chiptec.net/componentes-para-computadores/cooling/coolers-para-cpu/arctic-cooling-alpine-11-pro-rev-2.html', 'arctic-cooling-alpine-11-pro-rev-2-ucaco-ap110-gbb01-by-arctic-47b.gif'),
	(140, 23, 1, 4, 'Fonte', 'Aerocool KCAS 500W 80 PLUS Bronze', 1, 37.9, 'https://www.chiptec.net/componentes-para-computadores/fontes/fontes-de-alimentacao/aerocool-kcas-500w-80-plus-bronze.html?___SID=U', 'aerocool-kcas-500w-80-plus-bronze-kcas500s-by-aerocool-4ba.gif'),
	(141, 23, 1, 5, 'RAM', 'Corsair Vengeance Blue 2x4096MB (8GB) DDR3 1600Mhz CAS9 1.5V', 1, 59.9, 'https://www.chiptec.net/componentes-para-computadores/memorias-ram/memorias-ddriii/memorias-ddr3-1600/corsair-vengeance-blue-2x4096mb-8gb-ddr3-1600mhz-cas9-1-5v.html?___SID=U', 'corsair-vengeance-blue-2x4096mb-8gb-ddr3-1600mhz-cas9-1-5v-cmz8gx3m2a1600c9b-by-corsair-bf8.gif'),
	(142, 23, 1, 6, 'Caixa', 'Aerocool CS-105 - Black', 1, 28.9, 'https://www.chiptec.net/componentes-para-computadores/caixas-para-computadores/caixas-micro-atx/aerocool-cs-105-black.html?___SID=U', 'aerocool-cs-105-black-cs105bl-by-aerocool-234.gif'),
	(143, 23, 1, 7, 'Disco', 'HP 1TB 6G SATA 7200RPM 3.5 NHP LFF HDD', 1, 79.9, 'https://www.chiptec.net/componentes-para-computadores/armazenamento-interno/discos-rigidos-3-5-sata/hp-1tb-6g-sata-7200rpm-3-5-nhp-lff-hdd.html?___SID=U', 'hp-1tb-6g-sata-7200rpm-3-5-nhp-lff-hdd-843266-b21-by-hp-c4b.gif'),
	(144, 23, 1, 8, 'CPU', 'Intel Core i5 7640X 4GHz 6MB BOX', 1, 205.9, 'https://www.chiptec.net/componentes-para-computadores/processadores/intel-socket-2066/intel-core-i5-7640x-4ghz-6mb-box.html?___SID=U', 'intel-core-i5-7640x-4ghz-6mb-box-bx80677i57640x-by-intel-0a1.gif'),
	(152, 24, 1, 1, 'Processador', 'AMD FX 4300 Black Edition 3.8GHz 8MB BOX SKAM3+', 1, 58.3, 'https://www.chiptec.net/componentes-para-computadores/processadores/amd-socket-am3/amd-fx-4300-black-edition-3-8ghz-8mb-box-skam3.html?___SID=U', 'amd-fx-4300-black-edition-3-8ghz-8mb-box-skam3-fd4300wmhkbox-by-amd-67f.gif'),
	(153, 24, 1, 2, 'Gráfica', 'Asrock 760GM-HDV AMD 760G SKAM3+', 1, 56.9, 'https://www.chiptec.net/componentes-para-computadores/motherboards/amd-socket-am3/asrock-760gm-hdv-amd-760g-skam3.html?___SID=U', 'asrock-760gm-hdv-amd-760g-skam3-90-mxb7u0-a0uayz-by-asrock-947.gif'),
	(154, 24, 1, 3, 'Cooling', 'Arctic Cooling Alpine 11 Pro Rev.2', 1, 9.5, 'https://www.chiptec.net/componentes-para-computadores/cooling/coolers-para-cpu/arctic-cooling-alpine-11-pro-rev-2.html', 'arctic-cooling-alpine-11-pro-rev-2-ucaco-ap110-gbb01-by-arctic-47b.gif'),
	(155, 24, 1, 4, 'Fonte', 'Aerocool KCAS 500W 80 PLUS Bronze', 1, 37.9, 'https://www.chiptec.net/componentes-para-computadores/fontes/fontes-de-alimentacao/aerocool-kcas-500w-80-plus-bronze.html?___SID=U', 'aerocool-kcas-500w-80-plus-bronze-kcas500s-by-aerocool-4ba.gif'),
	(156, 24, 1, 5, 'RAM', 'Corsair Vengeance Blue 2x4096MB (8GB) DDR3 1600Mhz CAS9 1.5V', 1, 59.9, 'https://www.chiptec.net/componentes-para-computadores/memorias-ram/memorias-ddriii/memorias-ddr3-1600/corsair-vengeance-blue-2x4096mb-8gb-ddr3-1600mhz-cas9-1-5v.html?___SID=U', 'corsair-vengeance-blue-2x4096mb-8gb-ddr3-1600mhz-cas9-1-5v-cmz8gx3m2a1600c9b-by-corsair-bf8.gif'),
	(157, 24, 1, 6, 'Caixa', 'Aerocool CS-105 - Black', 1, 28.9, 'https://www.chiptec.net/componentes-para-computadores/caixas-para-computadores/caixas-micro-atx/aerocool-cs-105-black.html?___SID=U', 'aerocool-cs-105-black-cs105bl-by-aerocool-234.gif'),
	(158, 24, 1, 7, 'Disco', 'HP 1TB 6G SATA 7200RPM 3.5 NHP LFF HDD', 1, 79.9, 'https://www.chiptec.net/componentes-para-computadores/armazenamento-interno/discos-rigidos-3-5-sata/hp-1tb-6g-sata-7200rpm-3-5-nhp-lff-hdd.html?___SID=U', 'hp-1tb-6g-sata-7200rpm-3-5-nhp-lff-hdd-843266-b21-by-hp-c4b.gif'),
	(159, 24, 1, 8, 'CPU', 'Intel Core i5 7640X 4GHz 6MB BOX', 1, 205.9, 'https://www.chiptec.net/componentes-para-computadores/processadores/intel-socket-2066/intel-core-i5-7640x-4ghz-6mb-box.html?___SID=U', 'intel-core-i5-7640x-4ghz-6mb-box-bx80677i57640x-by-intel-0a1.gif'),
	(167, 25, 1, 1, 'Processador', 'AMD FX 4300 Black Edition 3.8GHz 8MB BOX SKAM3+', 1, 58.3, 'https://www.chiptec.net/componentes-para-computadores/processadores/amd-socket-am3/amd-fx-4300-black-edition-3-8ghz-8mb-box-skam3.html?___SID=U', 'amd-fx-4300-black-edition-3-8ghz-8mb-box-skam3-fd4300wmhkbox-by-amd-67f.gif'),
	(168, 25, 1, 2, 'Gráfica', 'Asrock 760GM-HDV AMD 760G SKAM3+', 1, 56.9, 'https://www.chiptec.net/componentes-para-computadores/motherboards/amd-socket-am3/asrock-760gm-hdv-amd-760g-skam3.html?___SID=U', 'asrock-760gm-hdv-amd-760g-skam3-90-mxb7u0-a0uayz-by-asrock-947.gif'),
	(169, 25, 1, 3, 'Cooling', 'Arctic Cooling Alpine 11 Pro Rev.2', 1, 9.5, 'https://www.chiptec.net/componentes-para-computadores/cooling/coolers-para-cpu/arctic-cooling-alpine-11-pro-rev-2.html', 'arctic-cooling-alpine-11-pro-rev-2-ucaco-ap110-gbb01-by-arctic-47b.gif'),
	(170, 25, 1, 4, 'Fonte', 'Aerocool KCAS 500W 80 PLUS Bronze', 1, 37.9, 'https://www.chiptec.net/componentes-para-computadores/fontes/fontes-de-alimentacao/aerocool-kcas-500w-80-plus-bronze.html?___SID=U', 'aerocool-kcas-500w-80-plus-bronze-kcas500s-by-aerocool-4ba.gif'),
	(171, 25, 1, 5, 'RAM', 'Corsair Vengeance Blue 2x4096MB (8GB) DDR3 1600Mhz CAS9 1.5V', 1, 59.9, 'https://www.chiptec.net/componentes-para-computadores/memorias-ram/memorias-ddriii/memorias-ddr3-1600/corsair-vengeance-blue-2x4096mb-8gb-ddr3-1600mhz-cas9-1-5v.html?___SID=U', 'corsair-vengeance-blue-2x4096mb-8gb-ddr3-1600mhz-cas9-1-5v-cmz8gx3m2a1600c9b-by-corsair-bf8.gif'),
	(172, 25, 1, 6, 'Caixa', 'Aerocool CS-105 - Black', 1, 28.9, 'https://www.chiptec.net/componentes-para-computadores/caixas-para-computadores/caixas-micro-atx/aerocool-cs-105-black.html?___SID=U', 'aerocool-cs-105-black-cs105bl-by-aerocool-234.gif'),
	(173, 25, 1, 7, 'Disco', 'HP 1TB 6G SATA 7200RPM 3.5 NHP LFF HDD', 1, 79.9, 'https://www.chiptec.net/componentes-para-computadores/armazenamento-interno/discos-rigidos-3-5-sata/hp-1tb-6g-sata-7200rpm-3-5-nhp-lff-hdd.html?___SID=U', 'hp-1tb-6g-sata-7200rpm-3-5-nhp-lff-hdd-843266-b21-by-hp-c4b.gif'),
	(174, 25, 1, 8, 'CPU', 'Intel Core i5 7640X 4GHz 6MB BOX', 1, 205.9, 'https://www.chiptec.net/componentes-para-computadores/processadores/intel-socket-2066/intel-core-i5-7640x-4ghz-6mb-box.html?___SID=U', 'intel-core-i5-7640x-4ghz-6mb-box-bx80677i57640x-by-intel-0a1.gif'),
	(182, 26, 1, 1, 'Processador', 'AMD FX 4300 Black Edition 3.8GHz 8MB BOX SKAM3+', 1, 58.3, 'https://www.chiptec.net/componentes-para-computadores/processadores/amd-socket-am3/amd-fx-4300-black-edition-3-8ghz-8mb-box-skam3.html?___SID=U', 'amd-fx-4300-black-edition-3-8ghz-8mb-box-skam3-fd4300wmhkbox-by-amd-67f.gif'),
	(183, 26, 1, 2, 'Gráfica', 'Asrock 760GM-HDV AMD 760G SKAM3+', 1, 56.9, 'https://www.chiptec.net/componentes-para-computadores/motherboards/amd-socket-am3/asrock-760gm-hdv-amd-760g-skam3.html?___SID=U', 'asrock-760gm-hdv-amd-760g-skam3-90-mxb7u0-a0uayz-by-asrock-947.gif'),
	(184, 26, 1, 3, 'Cooling', 'Arctic Cooling Alpine 11 Pro Rev.2', 1, 9.5, 'https://www.chiptec.net/componentes-para-computadores/cooling/coolers-para-cpu/arctic-cooling-alpine-11-pro-rev-2.html', 'arctic-cooling-alpine-11-pro-rev-2-ucaco-ap110-gbb01-by-arctic-47b.gif'),
	(185, 26, 1, 4, 'Fonte', 'Aerocool KCAS 500W 80 PLUS Bronze', 1, 37.9, 'https://www.chiptec.net/componentes-para-computadores/fontes/fontes-de-alimentacao/aerocool-kcas-500w-80-plus-bronze.html?___SID=U', 'aerocool-kcas-500w-80-plus-bronze-kcas500s-by-aerocool-4ba.gif'),
	(186, 26, 1, 5, 'RAM', 'Corsair Vengeance Blue 2x4096MB (8GB) DDR3 1600Mhz CAS9 1.5V', 1, 59.9, 'https://www.chiptec.net/componentes-para-computadores/memorias-ram/memorias-ddriii/memorias-ddr3-1600/corsair-vengeance-blue-2x4096mb-8gb-ddr3-1600mhz-cas9-1-5v.html?___SID=U', 'corsair-vengeance-blue-2x4096mb-8gb-ddr3-1600mhz-cas9-1-5v-cmz8gx3m2a1600c9b-by-corsair-bf8.gif'),
	(187, 26, 1, 6, 'Caixa', 'Aerocool CS-105 - Black', 1, 28.9, 'https://www.chiptec.net/componentes-para-computadores/caixas-para-computadores/caixas-micro-atx/aerocool-cs-105-black.html?___SID=U', 'aerocool-cs-105-black-cs105bl-by-aerocool-234.gif'),
	(188, 26, 1, 7, 'Disco', 'HP 1TB 6G SATA 7200RPM 3.5 NHP LFF HDD', 1, 79.9, 'https://www.chiptec.net/componentes-para-computadores/armazenamento-interno/discos-rigidos-3-5-sata/hp-1tb-6g-sata-7200rpm-3-5-nhp-lff-hdd.html?___SID=U', 'hp-1tb-6g-sata-7200rpm-3-5-nhp-lff-hdd-843266-b21-by-hp-c4b.gif'),
	(189, 26, 1, 8, 'CPU', 'Intel Core i5 7640X 4GHz 6MB BOX', 1, 205.9, 'https://www.chiptec.net/componentes-para-computadores/processadores/intel-socket-2066/intel-core-i5-7640x-4ghz-6mb-box.html?___SID=U', 'intel-core-i5-7640x-4ghz-6mb-box-bx80677i57640x-by-intel-0a1.gif'),
	(197, 27, 1, 1, 'Processador', 'AMD FX 4300 Black Edition 3.8GHz 8MB BOX SKAM3+', 1, 58.3, 'https://www.chiptec.net/componentes-para-computadores/processadores/amd-socket-am3/amd-fx-4300-black-edition-3-8ghz-8mb-box-skam3.html?___SID=U', 'amd-fx-4300-black-edition-3-8ghz-8mb-box-skam3-fd4300wmhkbox-by-amd-67f.gif'),
	(198, 27, 1, 2, 'Gráfica', 'Asrock 760GM-HDV AMD 760G SKAM3+', 1, 56.9, 'https://www.chiptec.net/componentes-para-computadores/motherboards/amd-socket-am3/asrock-760gm-hdv-amd-760g-skam3.html?___SID=U', 'asrock-760gm-hdv-amd-760g-skam3-90-mxb7u0-a0uayz-by-asrock-947.gif'),
	(199, 27, 1, 3, 'Cooling', 'Arctic Cooling Alpine 11 Pro Rev.2', 1, 9.5, 'https://www.chiptec.net/componentes-para-computadores/cooling/coolers-para-cpu/arctic-cooling-alpine-11-pro-rev-2.html', 'arctic-cooling-alpine-11-pro-rev-2-ucaco-ap110-gbb01-by-arctic-47b.gif'),
	(200, 27, 1, 4, 'Fonte', 'Aerocool KCAS 500W 80 PLUS Bronze', 1, 37.9, 'https://www.chiptec.net/componentes-para-computadores/fontes/fontes-de-alimentacao/aerocool-kcas-500w-80-plus-bronze.html?___SID=U', 'aerocool-kcas-500w-80-plus-bronze-kcas500s-by-aerocool-4ba.gif'),
	(201, 27, 1, 5, 'RAM', 'Corsair Vengeance Blue 2x4096MB (8GB) DDR3 1600Mhz CAS9 1.5V', 1, 59.9, 'https://www.chiptec.net/componentes-para-computadores/memorias-ram/memorias-ddriii/memorias-ddr3-1600/corsair-vengeance-blue-2x4096mb-8gb-ddr3-1600mhz-cas9-1-5v.html?___SID=U', 'corsair-vengeance-blue-2x4096mb-8gb-ddr3-1600mhz-cas9-1-5v-cmz8gx3m2a1600c9b-by-corsair-bf8.gif'),
	(202, 27, 1, 6, 'Caixa', 'Aerocool CS-105 - Black', 1, 28.9, 'https://www.chiptec.net/componentes-para-computadores/caixas-para-computadores/caixas-micro-atx/aerocool-cs-105-black.html?___SID=U', 'aerocool-cs-105-black-cs105bl-by-aerocool-234.gif'),
	(203, 27, 1, 7, 'Disco', 'HP 1TB 6G SATA 7200RPM 3.5 NHP LFF HDD', 1, 79.9, 'https://www.chiptec.net/componentes-para-computadores/armazenamento-interno/discos-rigidos-3-5-sata/hp-1tb-6g-sata-7200rpm-3-5-nhp-lff-hdd.html?___SID=U', 'hp-1tb-6g-sata-7200rpm-3-5-nhp-lff-hdd-843266-b21-by-hp-c4b.gif'),
	(204, 27, 1, 8, 'CPU', 'Intel Core i5 7640X 4GHz 6MB BOX', 1, 205.9, 'https://www.chiptec.net/componentes-para-computadores/processadores/intel-socket-2066/intel-core-i5-7640x-4ghz-6mb-box.html?___SID=U', 'intel-core-i5-7640x-4ghz-6mb-box-bx80677i57640x-by-intel-0a1.gif'),
	(212, 28, 1, 1, 'Processador', 'AMD FX 4300 Black Edition 3.8GHz 8MB BOX SKAM3+', 1, 58.3, 'https://www.chiptec.net/componentes-para-computadores/processadores/amd-socket-am3/amd-fx-4300-black-edition-3-8ghz-8mb-box-skam3.html?___SID=U', 'amd-fx-4300-black-edition-3-8ghz-8mb-box-skam3-fd4300wmhkbox-by-amd-67f.gif'),
	(213, 28, 1, 2, 'Gráfica', 'Asrock 760GM-HDV AMD 760G SKAM3+', 1, 56.9, 'https://www.chiptec.net/componentes-para-computadores/motherboards/amd-socket-am3/asrock-760gm-hdv-amd-760g-skam3.html?___SID=U', 'asrock-760gm-hdv-amd-760g-skam3-90-mxb7u0-a0uayz-by-asrock-947.gif'),
	(214, 28, 1, 3, 'Cooling', 'Arctic Cooling Alpine 11 Pro Rev.2', 1, 9.5, 'https://www.chiptec.net/componentes-para-computadores/cooling/coolers-para-cpu/arctic-cooling-alpine-11-pro-rev-2.html', 'arctic-cooling-alpine-11-pro-rev-2-ucaco-ap110-gbb01-by-arctic-47b.gif'),
	(215, 28, 1, 4, 'Fonte', 'Aerocool KCAS 500W 80 PLUS Bronze', 1, 37.9, 'https://www.chiptec.net/componentes-para-computadores/fontes/fontes-de-alimentacao/aerocool-kcas-500w-80-plus-bronze.html?___SID=U', 'aerocool-kcas-500w-80-plus-bronze-kcas500s-by-aerocool-4ba.gif'),
	(216, 28, 1, 5, 'RAM', 'Corsair Vengeance Blue 2x4096MB (8GB) DDR3 1600Mhz CAS9 1.5V', 1, 59.9, 'https://www.chiptec.net/componentes-para-computadores/memorias-ram/memorias-ddriii/memorias-ddr3-1600/corsair-vengeance-blue-2x4096mb-8gb-ddr3-1600mhz-cas9-1-5v.html?___SID=U', 'corsair-vengeance-blue-2x4096mb-8gb-ddr3-1600mhz-cas9-1-5v-cmz8gx3m2a1600c9b-by-corsair-bf8.gif'),
	(217, 28, 1, 6, 'Caixa', 'Aerocool CS-105 - Black', 1, 28.9, 'https://www.chiptec.net/componentes-para-computadores/caixas-para-computadores/caixas-micro-atx/aerocool-cs-105-black.html?___SID=U', 'aerocool-cs-105-black-cs105bl-by-aerocool-234.gif'),
	(218, 28, 1, 7, 'Disco', 'HP 1TB 6G SATA 7200RPM 3.5 NHP LFF HDD', 1, 79.9, 'https://www.chiptec.net/componentes-para-computadores/armazenamento-interno/discos-rigidos-3-5-sata/hp-1tb-6g-sata-7200rpm-3-5-nhp-lff-hdd.html?___SID=U', 'hp-1tb-6g-sata-7200rpm-3-5-nhp-lff-hdd-843266-b21-by-hp-c4b.gif'),
	(219, 28, 1, 8, 'CPU', 'Intel Core i5 7640X 4GHz 6MB BOX', 1, 205.9, 'https://www.chiptec.net/componentes-para-computadores/processadores/intel-socket-2066/intel-core-i5-7640x-4ghz-6mb-box.html?___SID=U', 'intel-core-i5-7640x-4ghz-6mb-box-bx80677i57640x-by-intel-0a1.gif'),
	(227, 29, 1, 1, 'Processador', 'AMD FX 4300 Black Edition 3.8GHz 8MB BOX SKAM3+', 1, 58.3, 'https://www.chiptec.net/componentes-para-computadores/processadores/amd-socket-am3/amd-fx-4300-black-edition-3-8ghz-8mb-box-skam3.html?___SID=U', 'amd-fx-4300-black-edition-3-8ghz-8mb-box-skam3-fd4300wmhkbox-by-amd-67f.gif'),
	(228, 29, 1, 2, 'Gráfica', 'Asrock 760GM-HDV AMD 760G SKAM3+', 1, 56.9, 'https://www.chiptec.net/componentes-para-computadores/motherboards/amd-socket-am3/asrock-760gm-hdv-amd-760g-skam3.html?___SID=U', 'asrock-760gm-hdv-amd-760g-skam3-90-mxb7u0-a0uayz-by-asrock-947.gif'),
	(229, 29, 1, 3, 'Cooling', 'Arctic Cooling Alpine 11 Pro Rev.2', 1, 9.5, 'https://www.chiptec.net/componentes-para-computadores/cooling/coolers-para-cpu/arctic-cooling-alpine-11-pro-rev-2.html', 'arctic-cooling-alpine-11-pro-rev-2-ucaco-ap110-gbb01-by-arctic-47b.gif'),
	(230, 29, 1, 4, 'Fonte', 'Aerocool KCAS 500W 80 PLUS Bronze', 1, 37.9, 'https://www.chiptec.net/componentes-para-computadores/fontes/fontes-de-alimentacao/aerocool-kcas-500w-80-plus-bronze.html?___SID=U', 'aerocool-kcas-500w-80-plus-bronze-kcas500s-by-aerocool-4ba.gif'),
	(231, 29, 1, 5, 'RAM', 'Corsair Vengeance Blue 2x4096MB (8GB) DDR3 1600Mhz CAS9 1.5V', 1, 59.9, 'https://www.chiptec.net/componentes-para-computadores/memorias-ram/memorias-ddriii/memorias-ddr3-1600/corsair-vengeance-blue-2x4096mb-8gb-ddr3-1600mhz-cas9-1-5v.html?___SID=U', 'corsair-vengeance-blue-2x4096mb-8gb-ddr3-1600mhz-cas9-1-5v-cmz8gx3m2a1600c9b-by-corsair-bf8.gif'),
	(232, 29, 1, 6, 'Caixa', 'Aerocool CS-105 - Black', 1, 28.9, 'https://www.chiptec.net/componentes-para-computadores/caixas-para-computadores/caixas-micro-atx/aerocool-cs-105-black.html?___SID=U', 'aerocool-cs-105-black-cs105bl-by-aerocool-234.gif'),
	(233, 29, 1, 7, 'Disco', 'HP 1TB 6G SATA 7200RPM 3.5 NHP LFF HDD', 1, 79.9, 'https://www.chiptec.net/componentes-para-computadores/armazenamento-interno/discos-rigidos-3-5-sata/hp-1tb-6g-sata-7200rpm-3-5-nhp-lff-hdd.html?___SID=U', 'hp-1tb-6g-sata-7200rpm-3-5-nhp-lff-hdd-843266-b21-by-hp-c4b.gif'),
	(234, 29, 1, 8, 'CPU', 'Intel Core i5 7640X 4GHz 6MB BOX', 1, 205.9, 'https://www.chiptec.net/componentes-para-computadores/processadores/intel-socket-2066/intel-core-i5-7640x-4ghz-6mb-box.html?___SID=U', 'intel-core-i5-7640x-4ghz-6mb-box-bx80677i57640x-by-intel-0a1.gif'),
	(242, 30, 1, 1, 'Processador', 'AMD FX 4300 Black Edition 3.8GHz 8MB BOX SKAM3+', 1, 58.3, 'https://www.chiptec.net/componentes-para-computadores/processadores/amd-socket-am3/amd-fx-4300-black-edition-3-8ghz-8mb-box-skam3.html?___SID=U', 'amd-fx-4300-black-edition-3-8ghz-8mb-box-skam3-fd4300wmhkbox-by-amd-67f.gif'),
	(243, 30, 1, 2, 'Gráfica', 'Asrock 760GM-HDV AMD 760G SKAM3+', 1, 56.9, 'https://www.chiptec.net/componentes-para-computadores/motherboards/amd-socket-am3/asrock-760gm-hdv-amd-760g-skam3.html?___SID=U', 'asrock-760gm-hdv-amd-760g-skam3-90-mxb7u0-a0uayz-by-asrock-947.gif'),
	(244, 30, 1, 3, 'Cooling', 'Arctic Cooling Alpine 11 Pro Rev.2', 1, 9.5, 'https://www.chiptec.net/componentes-para-computadores/cooling/coolers-para-cpu/arctic-cooling-alpine-11-pro-rev-2.html', 'arctic-cooling-alpine-11-pro-rev-2-ucaco-ap110-gbb01-by-arctic-47b.gif'),
	(245, 30, 1, 4, 'Fonte', 'Aerocool KCAS 500W 80 PLUS Bronze', 1, 37.9, 'https://www.chiptec.net/componentes-para-computadores/fontes/fontes-de-alimentacao/aerocool-kcas-500w-80-plus-bronze.html?___SID=U', 'aerocool-kcas-500w-80-plus-bronze-kcas500s-by-aerocool-4ba.gif'),
	(246, 30, 1, 5, 'RAM', 'Corsair Vengeance Blue 2x4096MB (8GB) DDR3 1600Mhz CAS9 1.5V', 1, 59.9, 'https://www.chiptec.net/componentes-para-computadores/memorias-ram/memorias-ddriii/memorias-ddr3-1600/corsair-vengeance-blue-2x4096mb-8gb-ddr3-1600mhz-cas9-1-5v.html?___SID=U', 'corsair-vengeance-blue-2x4096mb-8gb-ddr3-1600mhz-cas9-1-5v-cmz8gx3m2a1600c9b-by-corsair-bf8.gif'),
	(247, 30, 1, 6, 'Caixa', 'Aerocool CS-105 - Black', 1, 28.9, 'https://www.chiptec.net/componentes-para-computadores/caixas-para-computadores/caixas-micro-atx/aerocool-cs-105-black.html?___SID=U', 'aerocool-cs-105-black-cs105bl-by-aerocool-234.gif'),
	(248, 30, 1, 7, 'Disco', 'HP 1TB 6G SATA 7200RPM 3.5 NHP LFF HDD', 1, 79.9, 'https://www.chiptec.net/componentes-para-computadores/armazenamento-interno/discos-rigidos-3-5-sata/hp-1tb-6g-sata-7200rpm-3-5-nhp-lff-hdd.html?___SID=U', 'hp-1tb-6g-sata-7200rpm-3-5-nhp-lff-hdd-843266-b21-by-hp-c4b.gif'),
	(249, 30, 1, 8, 'CPU', 'Intel Core i5 7640X 4GHz 6MB BOX', 1, 205.9, 'https://www.chiptec.net/componentes-para-computadores/processadores/intel-socket-2066/intel-core-i5-7640x-4ghz-6mb-box.html?___SID=U', 'intel-core-i5-7640x-4ghz-6mb-box-bx80677i57640x-by-intel-0a1.gif'),
	(257, 31, 1, 1, 'Processador', 'AMD FX 4300 Black Edition 3.8GHz 8MB BOX SKAM3+', 1, 58.3, 'https://www.chiptec.net/componentes-para-computadores/processadores/amd-socket-am3/amd-fx-4300-black-edition-3-8ghz-8mb-box-skam3.html?___SID=U', 'amd-fx-4300-black-edition-3-8ghz-8mb-box-skam3-fd4300wmhkbox-by-amd-67f.gif'),
	(258, 31, 1, 2, 'Gráfica', 'Asrock 760GM-HDV AMD 760G SKAM3+', 1, 56.9, 'https://www.chiptec.net/componentes-para-computadores/motherboards/amd-socket-am3/asrock-760gm-hdv-amd-760g-skam3.html?___SID=U', 'asrock-760gm-hdv-amd-760g-skam3-90-mxb7u0-a0uayz-by-asrock-947.gif'),
	(259, 31, 1, 3, 'Cooling', 'Arctic Cooling Alpine 11 Pro Rev.2', 1, 9.5, 'https://www.chiptec.net/componentes-para-computadores/cooling/coolers-para-cpu/arctic-cooling-alpine-11-pro-rev-2.html', 'arctic-cooling-alpine-11-pro-rev-2-ucaco-ap110-gbb01-by-arctic-47b.gif'),
	(260, 31, 1, 4, 'Fonte', 'Aerocool KCAS 500W 80 PLUS Bronze', 1, 37.9, 'https://www.chiptec.net/componentes-para-computadores/fontes/fontes-de-alimentacao/aerocool-kcas-500w-80-plus-bronze.html?___SID=U', 'aerocool-kcas-500w-80-plus-bronze-kcas500s-by-aerocool-4ba.gif'),
	(261, 31, 1, 5, 'RAM', 'Corsair Vengeance Blue 2x4096MB (8GB) DDR3 1600Mhz CAS9 1.5V', 1, 59.9, 'https://www.chiptec.net/componentes-para-computadores/memorias-ram/memorias-ddriii/memorias-ddr3-1600/corsair-vengeance-blue-2x4096mb-8gb-ddr3-1600mhz-cas9-1-5v.html?___SID=U', 'corsair-vengeance-blue-2x4096mb-8gb-ddr3-1600mhz-cas9-1-5v-cmz8gx3m2a1600c9b-by-corsair-bf8.gif'),
	(262, 31, 1, 6, 'Caixa', 'Aerocool CS-105 - Black', 1, 28.9, 'https://www.chiptec.net/componentes-para-computadores/caixas-para-computadores/caixas-micro-atx/aerocool-cs-105-black.html?___SID=U', 'aerocool-cs-105-black-cs105bl-by-aerocool-234.gif'),
	(263, 31, 1, 7, 'Disco', 'HP 1TB 6G SATA 7200RPM 3.5 NHP LFF HDD', 1, 79.9, 'https://www.chiptec.net/componentes-para-computadores/armazenamento-interno/discos-rigidos-3-5-sata/hp-1tb-6g-sata-7200rpm-3-5-nhp-lff-hdd.html?___SID=U', 'hp-1tb-6g-sata-7200rpm-3-5-nhp-lff-hdd-843266-b21-by-hp-c4b.gif'),
	(264, 31, 1, 8, 'CPU', 'Intel Core i5 7640X 4GHz 6MB BOX', 1, 205.9, 'https://www.chiptec.net/componentes-para-computadores/processadores/intel-socket-2066/intel-core-i5-7640x-4ghz-6mb-box.html?___SID=U', 'intel-core-i5-7640x-4ghz-6mb-box-bx80677i57640x-by-intel-0a1.gif');
/*!40000 ALTER TABLE `orderinfodetails` ENABLE KEYS */;

-- Dumping structure for table 2207508_wrc.user
CREATE TABLE IF NOT EXISTS `user` (
  `email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `phonenumber` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `taxnumber` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `uid` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `pass` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `admin` smallint(6) NOT NULL,
  `status` int(11) NOT NULL COMMENT '0: disable; 1: enable',
  `deliveryname` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `deliverystreet` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `deliveryzipcode` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `deliverycity` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `invoicename` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `invoicestreet` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `invoicezipcode` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `invoicecity` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `creationdate` datetime DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table 2207508_wrc.user: ~0 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`email`, `name`, `phonenumber`, `taxnumber`, `uid`, `pass`, `admin`, `status`, `deliveryname`, `deliverystreet`, `deliveryzipcode`, `deliverycity`, `invoicename`, `invoicestreet`, `invoicezipcode`, `invoicecity`, `creationdate`) VALUES
	('gdiogo2@gmail.com', 'Graça Diogo', '968038530', '212154546', 'HMENMRRCNKBZMRETWLHU', '', 0, 0, 'Graça Diogo', 'Praceta Carlos Paião, 27, 3D', '2785-679', 'Rana', 'Graça Diogo', 'Praceta Carlos Paião, 27, 3D', '2785-679', 'Rana', '2019-01-31 18:03:23');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
