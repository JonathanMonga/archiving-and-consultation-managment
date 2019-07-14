-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             9.5.0.5332
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for gestion_archive
CREATE DATABASE IF NOT EXISTS `gestion_archive` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `gestion_archive`;

-- Dumping structure for table gestion_archive.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table gestion_archive.admin: ~0 rows (approximately)
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` (`id`, `nom`, `mdp`) VALUES
	(1, 'leaticia', '12345'),
	(2, 'leaticia', '12345');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;

-- Dumping structure for table gestion_archive.archive
CREATE TABLE IF NOT EXISTS `archive` (
  `code_archive` varchar(255) NOT NULL,
  `nom_archive` varchar(255) NOT NULL,
  `quantite_stock` int(11) NOT NULL,
  `aliment` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `code_cage` varchar(255) NOT NULL,
  `code_categorie` varchar(255) NOT NULL,
  PRIMARY KEY (`code_archive`),
  KEY `archive_ibfk_1` (`code_cage`),
  KEY `archive_ibfk_2` (`code_categorie`),
  CONSTRAINT `archive_ibfk_1` FOREIGN KEY (`code_cage`) REFERENCES `cage` (`code_cage`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `archive_ibfk_2` FOREIGN KEY (`code_categorie`) REFERENCES `categorie` (`code_categorie`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table gestion_archive.archive: ~0 rows (approximately)
/*!40000 ALTER TABLE `archive` DISABLE KEYS */;
INSERT INTO `archive` (`code_archive`, `nom_archive`, `quantite_stock`, `aliment`, `age`, `code_cage`, `code_categorie`) VALUES
	('ANI001', 'Tigre', 7, 'Viande', 4, 'CAGE001', 'CAT001');
/*!40000 ALTER TABLE `archive` ENABLE KEYS */;

-- Dumping structure for table gestion_archive.cage
CREATE TABLE IF NOT EXISTS `cage` (
  `code_cage` varchar(255) NOT NULL,
  `nom_cage` varchar(255) NOT NULL,
  PRIMARY KEY (`code_cage`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table gestion_archive.cage: ~2 rows (approximately)
/*!40000 ALTER TABLE `cage` DISABLE KEYS */;
INSERT INTO `cage` (`code_cage`, `nom_cage`) VALUES
	('CAGE001', 'Cage lion'),
	('CAGE002', 'Cage antillope'),
	('CAGE003', 'Cage chimpanze');
/*!40000 ALTER TABLE `cage` ENABLE KEYS */;

-- Dumping structure for table gestion_archive.categorie
CREATE TABLE IF NOT EXISTS `categorie` (
  `code_categorie` varchar(255) NOT NULL,
  `nom_categorie` varchar(255) NOT NULL,
  PRIMARY KEY (`code_categorie`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table gestion_archive.categorie: ~2 rows (approximately)
/*!40000 ALTER TABLE `categorie` DISABLE KEYS */;
INSERT INTO `categorie` (`code_categorie`, `nom_categorie`) VALUES
	('CAT001', 'Carnivore'),
	('CAT002', 'Herbivore'),
	('CAT003', 'Volant');
/*!40000 ALTER TABLE `categorie` ENABLE KEYS */;

-- Dumping structure for table gestion_archive.provenance
CREATE TABLE IF NOT EXISTS `provenance` (
  `code_provenance` varchar(255) NOT NULL,
  `nom_provenance` varchar(255) NOT NULL,
  PRIMARY KEY (`code_provenance`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table gestion_archive.provenance: ~2 rows (approximately)
/*!40000 ALTER TABLE `provenance` DISABLE KEYS */;
INSERT INTO `provenance` (`code_provenance`, `nom_provenance`) VALUES
	('PRO001', 'Upemba'),
	('PRO002', 'Salonga');
/*!40000 ALTER TABLE `provenance` ENABLE KEYS */;

-- Dumping structure for table gestion_archive.provenir
CREATE TABLE IF NOT EXISTS `provenir` (
  `code_provenance` varchar(255) NOT NULL,
  `code_archive` varchar(255) NOT NULL,
  `date` date NOT NULL,
  KEY `provenir_ibfk_1` (`code_provenance`),
  KEY `provenir_ibfk_2` (`code_archive`),
  CONSTRAINT `provenir_ibfk_1` FOREIGN KEY (`code_provenance`) REFERENCES `provenance` (`code_provenance`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `provenir_ibfk_2` FOREIGN KEY (`code_archive`) REFERENCES `archive` (`code_archive`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table gestion_archive.provenir: ~0 rows (approximately)
/*!40000 ALTER TABLE `provenir` DISABLE KEYS */;
INSERT INTO `provenir` (`code_provenance`, `code_archive`, `date`) VALUES
	('PRO002', 'ANI001', '2019-06-24');
/*!40000 ALTER TABLE `provenir` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
