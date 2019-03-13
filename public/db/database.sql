-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.30-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table 2207508_wrc.component
DROP TABLE IF EXISTS `component`;
CREATE TABLE IF NOT EXISTS `component` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cost` float DEFAULT NULL,
  `link` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table 2207508_wrc.component: ~20 rows (approximately)
DELETE FROM `component`;
/*!40000 ALTER TABLE `component` DISABLE KEYS */;
INSERT INTO `component` (`id`, `type`, `description`, `cost`, `link`, `image`) VALUES
	(1, 'Cpu', 'AMD FX 4300 Black Edition 3.8GHz 8MB BOX SKAM3+', 58.3, 'https://www.chiptec.net/componentes-para-computadores/processadores/amd-socket-am3/amd-fx-4300-black-edition-3-8ghz-8mb-box-skam3.html?___SID=U', 'amd-fx-4300-black-edition-3-8ghz-8mb-box-skam3-fd4300wmhkbox-by-amd-67f.gif'),
	(2, 'Mb', 'Asrock 760GM-HDV AMD 760G SKAM3+', 56.9, 'https://www.chiptec.net/componentes-para-computadores/motherboards/amd-socket-am3/asrock-760gm-hdv-amd-760g-skam3.html?___SID=U', 'asrock-760gm-hdv-amd-760g-skam3-90-mxb7u0-a0uayz-by-asrock-947.gif'),
	(3, 'Fan', 'Arctic Cooling Alpine 11 Pro Rev.2', 9.5, 'https://www.chiptec.net/componentes-para-computadores/cooling/coolers-para-cpu/arctic-cooling-alpine-11-pro-rev-2.html', 'arctic-cooling-alpine-11-pro-rev-2-ucaco-ap110-gbb01-by-arctic-47b.gif'),
	(4, 'Power', 'Aerocool KCAS 500W 80 PLUS Bronze', 37.9, 'https://www.chiptec.net/componentes-para-computadores/fontes/fontes-de-alimentacao/aerocool-kcas-500w-80-plus-bronze.html?___SID=U', 'aerocool-kcas-500w-80-plus-bronze-kcas500s-by-aerocool-4ba.gif'),
	(5, 'RAM', 'Corsair Vengeance Blue 2x4096MB (8GB) DDR3 1600Mhz CAS9 1.5V', 59.9, 'https://www.chiptec.net/componentes-para-computadores/memorias-ram/memorias-ddriii/memorias-ddr3-1600/corsair-vengeance-blue-2x4096mb-8gb-ddr3-1600mhz-cas9-1-5v.html?___SID=U', 'corsair-vengeance-blue-2x4096mb-8gb-ddr3-1600mhz-cas9-1-5v-cmz8gx3m2a1600c9b-by-corsair-bf8.gif'),
	(6, 'Caixa', 'Aerocool CS-105 - Black', 28.9, 'https://www.chiptec.net/componentes-para-computadores/caixas-para-computadores/caixas-micro-atx/aerocool-cs-105-black.html?___SID=U', 'aerocool-cs-105-black-cs105bl-by-aerocool-234.gif'),
	(7, 'Disco', 'HP 1TB 6G SATA 7200RPM 3.5 NHP LFF HDD', 79.9, 'https://www.chiptec.net/componentes-para-computadores/armazenamento-interno/discos-rigidos-3-5-sata/hp-1tb-6g-sata-7200rpm-3-5-nhp-lff-hdd.html?___SID=U', 'hp-1tb-6g-sata-7200rpm-3-5-nhp-lff-hdd-843266-b21-by-hp-c4b.gif'),
	(8, 'Cpu', 'Intel core I5 7640x 4Ghz 6Mb Box', 205.9, 'https://www.chiptec.net/componentes-para-computadores/processadores/intel-socket-2066/intel-core-i5-7640x-4ghz-6mb-box.html?___SID=U', 'intel-core-i5-7640x-4ghz-6mb-box-bx80677i57640x-by-intel-0a1.gif'),
	(9, 'Mb', 'Asus prime B250-Plus Intel B250 SK1151', 87.9, 'https://www.chiptec.net/componentes-para-computadores/motherboards/intel-socket-1151/asus-prime-b250-plus-intel-b250-sk1151.html?___SID=U', 'asus-prime-b250-plus-intel-b250-sk1151-90mb0sj0-m0eay0-by-asus-239.gif'),
	(10, 'Fan', 'Artic Cooling Freezer I11', 22.5, 'https://www.chiptec.net/componentes-para-computadores/cooling/coolers-para-cpu/arctic-cooling-freezer-i11.html', 'arctic-cooling-freezer-i11-ucaco-fi11001-csa01-by-arctic-e30.gif'),
	(11, 'Power', 'Aerocool Vx Plus 750W', 50.9, 'https://www.chiptec.net/componentes-para-computadores/fontes/fontes-de-alimentacao/aerocool-vx-plus-750w.html?___SID=U', 'aerocool-vx-plus-750w-vxplus750-by-aerocool-08f.gif'),
	(12, 'RAM', 'Antec S Series black RGB DDR4 8Gb 3000Mhz CAS16', 92.9, 'https://www.chiptec.net/componentes-para-computadores/memorias-ram/memorias-ddr4/memorias-ddr4-3000/antec-5-series-black-rgb-ddr4-8gb-3000mhz-cas16.html?___SID=U', 'antec-5-series-black-rgb-ddr4-8gb-3000mhz-cas16-amd4uz130001608g-5ds-by-antec-507.gif'),
	(13, 'Caixa', 'Aerocool Cyclops Advance Black USB 3.0', 51.9, 'https://www.chiptec.net/componentes-para-computadores/caixas-para-computadores/caixas-atx/aerocool-cyclops-advance-black-usb-3-0.html?___SID=U', 'aerocool-cyclops-advance-black-usb-3-0-cyclopsadbk-by-aerocool-ca1.png'),
	(14, 'Disco', 'Crucial Mx500 SSD 2.5 SATA III 1TB', 159.5, 'https://www.chiptec.net/componentes-para-computadores/armazenamento-interno/discos-ssd/crucial-mx500-ssd-2-5-sata-iii-1tb.html?___SID=U', 'crucial-mx500-ssd-2-5-sata-iii-1tb-ct1000mx500ssd1-by-crucial-33c.gif'),
	(15, 'PG', 'Asus GTX 1050 TI Cerberus Advance OC 4GB GDDR5 ', 205, 'https://www.chiptec.net/componentes-para-computadores/placas-graficas/placas-graficas-pci-e/asus-gtx1050-ti-cerberus-advanced-oc-4gb-gddr5-pci-e.html?___SID=U', 'asus-gtx1050-ti-cerberus-advanced-oc-4gb-gddr5-pci-e-90yv0a75-m0na00-by-asus-995.gif'),
	(16, 'Cpu', 'Intel Core i7 7740X 4.3GHz 8MB BOX', 359.9, 'https://www.chiptec.net/componentes-para-computadores/processadores/intel-socket-2066/intel-core-i7-7740x-4-3ghz-8mb-box.html?___SID=U', 'intel-core-i7-7740x-4-3ghz-8mb-box-bx80677i77740x-by-intel-e89.gif'),
	(17, 'Mb', 'Asus ROG Strix H370-F Gaming Intel H370 SK1151', 161.9, 'https://www.chiptec.net/componentes-para-computadores/motherboards/intel-socket-1151/asus-rog-strix-h370-f-gaming-intel-b360-sk1151.html?___SID=U', 'asus-rog-strix-h370-f-gaming-intel-h370-sk1151-90mb0wf0-m0eay0-by-asus-4bf.gif'),
	(18, 'Fan', 'Cooler Master Hyper 103', 25.5, 'https://www.chiptec.net/componentes-para-computadores/cooling/coolers-para-cpu/cooler-master-hyper-103.html?___SID=U', 'cooler-master-hyper-103-rr-h103-22pb-r1-by-cooler-master-fef.gif'),
	(19, 'Power', 'ASUS ROG Thor 850W Modular 80+ Platinum', 229.9, 'https://www.chiptec.net/componentes-para-computadores/fontes/fontes-de-alimentacao/asus-rog-thor-850w-modular-80-platinum.html?___SID=U', 'asus-rog-thor-850w-modular-80-platinum-90ye0090-b001n0-by-asus-b2c.gif'),
	(20, 'RAM', 'Antec 5 Series Black RGB DDR4 2x8GB 3000MHz CAS16', 183.9, 'https://www.chiptec.net/componentes-para-computadores/memorias-ram/memorias-ddr4/memorias-ddr4-3000/antec-5-series-black-rgb-ddr4-2x8gb-3000mhz-cas16.html?___SID=U', 'antec-5-series-black-rgb-ddr4-2x8gb-3000mhz-cas16-amd4uz130001608g-5dd-by-antec-722.gif'),
	(21, 'Mb', 'Crucial MX500 SSD 2.5 Sata III 2TB', 362.9, 'https://www.chiptec.net/componentes-para-computadores/armazenamento-interno/discos-ssd/crucial-mx500-ssd-2-5-sata-iii-2tb.html?___SID=U', 'crucial-mx500-ssd-2-5-sata-iii-2tb-ct2000mx500ssd1-by-crucial-307.gif'),
	(22, 'PG', 'Asus GTX1060 STRIX Gaming 6GB GDDR5 PCI-E', 384.9, 'https://www.chiptec.net/componentes-para-computadores/placas-graficas/placas-graficas-pci-e/asus-gtx1060-strix-gaming-6gb-gddr5-pci-e.html?___SID=U', 'asus-gtx1060-strix-gaming-6gb-gddr5-pci-e-90yv09q1-m0na00-by-asus-1fb.gif');
/*!40000 ALTER TABLE `component` ENABLE KEYS */;

-- Dumping structure for table 2207508_wrc.computer
DROP TABLE IF EXISTS `computer`;
CREATE TABLE IF NOT EXISTS `computer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `longdesc` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` float DEFAULT NULL,
  `image` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table 2207508_wrc.computer: ~3 rows (approximately)
DELETE FROM `computer`;
/*!40000 ALTER TABLE `computer` DISABLE KEYS */;
INSERT INTO `computer` (`id`, `description`, `longdesc`, `price`, `image`) VALUES
	(1, 'Computador básico', 'Serve as necessidades básicas do utilizador ocasional', 400, 'aerocool-cs-105-black-cs105bl-by-aerocool-234.gif'),
	(2, 'Computador médio', 'Perfeito para uma utilização diária na maioria dos casos', 1300, 'aerocool-cyclops-advance-black-usb-3-0-cyclopsadbk-by-aerocool-ae6.gif'),
	(3, 'Computador Gaming', 'Computador de alto rendimento, para gaming, utilização intensiva, desenvolvimento aplicacional.', 1950, 'aerocool-quartz-blue-quartzbl-by-aerocool-deb.gif');
/*!40000 ALTER TABLE `computer` ENABLE KEYS */;

-- Dumping structure for table 2207508_wrc.computercomponents
DROP TABLE IF EXISTS `computercomponents`;
CREATE TABLE IF NOT EXISTS `computercomponents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `computerid` int(11) DEFAULT NULL,
  `componentid` int(11) DEFAULT NULL,
  `qtd` int(11) DEFAULT NULL,
  `ordering` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table 2207508_wrc.computercomponents: ~22 rows (approximately)
DELETE FROM `computercomponents`;
/*!40000 ALTER TABLE `computercomponents` DISABLE KEYS */;
INSERT INTO `computercomponents` (`id`, `computerid`, `componentid`, `qtd`, `ordering`) VALUES
	(1, 1, 1, 1, 1),
	(2, 1, 2, 1, 2),
	(3, 1, 3, 1, 3),
	(4, 1, 4, 1, 4),
	(5, 1, 5, 1, 5),
	(6, 1, 6, 1, 6),
	(7, 1, 7, 1, 7),
	(8, 2, 8, 1, 1),
	(9, 2, 9, 1, 2),
	(10, 2, 10, 1, 3),
	(11, 2, 11, 1, 4),
	(12, 2, 13, 1, 5),
	(13, 2, 12, 1, 6),
	(14, 2, 14, 1, 7),
	(15, 2, 15, 1, 8),
	(16, 3, 16, 1, 1),
	(17, 3, 17, 1, 2),
	(18, 3, 18, 1, 3),
	(19, 3, 19, 1, 4),
	(20, 3, 20, 1, 5),
	(21, 3, 21, 1, 6),
	(22, 3, 22, 1, 7);
/*!40000 ALTER TABLE `computercomponents` ENABLE KEYS */;

-- Dumping structure for table 2207508_wrc.oauth_access_tokens
DROP TABLE IF EXISTS `oauth_access_tokens`;
CREATE TABLE IF NOT EXISTS `oauth_access_tokens` (
  `access_token` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `client_id` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `expires` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `scope` varchar(4000) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`access_token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table 2207508_wrc.oauth_access_tokens: ~0 rows (approximately)
DELETE FROM `oauth_access_tokens`;
/*!40000 ALTER TABLE `oauth_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_access_tokens` ENABLE KEYS */;

-- Dumping structure for table 2207508_wrc.oauth_clients
DROP TABLE IF EXISTS `oauth_clients`;
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
DELETE FROM `oauth_clients`;
/*!40000 ALTER TABLE `oauth_clients` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_clients` ENABLE KEYS */;

-- Dumping structure for table 2207508_wrc.orderinfo
DROP TABLE IF EXISTS `orderinfo`;
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

-- Dumping data for table 2207508_wrc.orderinfo: ~0 rows (approximately)
DELETE FROM `orderinfo`;
/*!40000 ALTER TABLE `orderinfo` DISABLE KEYS */;
/*!40000 ALTER TABLE `orderinfo` ENABLE KEYS */;

-- Dumping structure for table 2207508_wrc.orderinfodetails
DROP TABLE IF EXISTS `orderinfodetails`;
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

-- Dumping data for table 2207508_wrc.orderinfodetails: ~0 rows (approximately)
DELETE FROM `orderinfodetails`;
/*!40000 ALTER TABLE `orderinfodetails` DISABLE KEYS */;
/*!40000 ALTER TABLE `orderinfodetails` ENABLE KEYS */;

-- Dumping structure for table 2207508_wrc.user
DROP TABLE IF EXISTS `user`;
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
DELETE FROM `user`;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
