-- MySQL dump 10.13  Distrib 8.0.28, for Win64 (x86_64)
--
-- Host: localhost    Database: tp5
-- ------------------------------------------------------
-- Server version	5.6.17

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `administrateurs`
--

DROP TABLE IF EXISTS `administrateurs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `administrateurs` (
  `idAdmin` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(10) NOT NULL,
  `password` varchar(8) NOT NULL,
  PRIMARY KEY (`idAdmin`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `administrateurs`
--

LOCK TABLES `administrateurs` WRITE;
/*!40000 ALTER TABLE `administrateurs` DISABLE KEYS */;
INSERT INTO `administrateurs` VALUES (1,'admin','admin');
/*!40000 ALTER TABLE `administrateurs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `approvisionnement`
--


DROP TABLE IF EXISTS `approvisionnement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `approvisionnement` (
  `numeroAppro` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `idFournisseur` int(11) DEFAULT NULL,
  PRIMARY KEY (`numeroAppro`),
  KEY `fk20` (`idFournisseur`),
  CONSTRAINT `fk20` FOREIGN KEY (`idFournisseur`) REFERENCES `fournisseur` (`idFournisseur`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `approvisionnement`
--

LOCK TABLES `approvisionnement` WRITE;
/*!40000 ALTER TABLE `approvisionnement` DISABLE KEYS */;
INSERT INTO `approvisionnement` VALUES (1,'2024-05-23 03:03:00',12),(2,'2024-05-23 03:15:00',12);
/*!40000 ALTER TABLE `approvisionnement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categorie` (
  `idCategorie` varchar(10) NOT NULL,
  `nomCategorie` varchar(50) NOT NULL,
  PRIMARY KEY (`idCategorie`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorie`
--

LOCK TABLES `categorie` WRITE;
/*!40000 ALTER TABLE `categorie` DISABLE KEYS */;
INSERT INTO `categorie` VALUES ('DE1','Dell Electro'),('TV1','LG10221');
/*!40000 ALTER TABLE `categorie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `client`
--

DROP TABLE IF EXISTS `client`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `client` (
  `idClient` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) NOT NULL,
  `adresse` varchar(45) NOT NULL,
  `telephone` int(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`idClient`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client`
--

LOCK TABLES `client` WRITE;
/*!40000 ALTER TABLE `client` DISABLE KEYS */;
INSERT INTO `client` VALUES (1,'mohammed','sba',0672947764,'moha@gmail.com'),(12,'riyad ','rue tayeb',0542557268,'riyad@gmail.com');
/*!40000 ALTER TABLE `client` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `commande`
--

DROP TABLE IF EXISTS `commande`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `commande` (
  `numeroCmd` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `idClient` int(11) DEFAULT NULL,
  PRIMARY KEY (`numeroCmd`),
  KEY `fk1_idx` (`idClient`),
  CONSTRAINT `fk1` FOREIGN KEY (`idClient`) REFERENCES `client` (`idClient`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=latin1 COMMENT='			';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `commande`
--

LOCK TABLES `commande` WRITE;
/*!40000 ALTER TABLE `commande` DISABLE KEYS */;
INSERT INTO `commande` VALUES (1,'2024-04-13 00:00:00',1),(2,'2024-04-13 00:41:32',1);
/*!40000 ALTER TABLE `commande` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fournisseur`
--

DROP TABLE IF EXISTS `fournisseur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fournisseur` (
  `idFournisseur` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) NOT NULL,
  `adresse` varchar(45) NOT NULL,
  `telephone` int(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`idFournisseur`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fournisseur`
--

LOCK TABLES `fournisseur` WRITE;
/*!40000 ALTER TABLE `fournisseur` DISABLE KEYS */;
INSERT INTO `fournisseur` VALUES (12,'mohammed','sba',40,'mohammed@gmail.com');
/*!40000 ALTER TABLE `fournisseur` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ligneappro`
--

DROP TABLE IF EXISTS `ligneappro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ligneappro` (
  `numeroAppro` int(11) NOT NULL,
  `quantite` int(11) DEFAULT NULL,
  `reference` varchar(50) NOT NULL,
  `prixAchat` float NOT NULL,
  PRIMARY KEY (`numeroAppro`,`reference`),
  KEY `po_idx` (`reference`),
  CONSTRAINT `po` FOREIGN KEY (`reference`) REFERENCES `produit` (`reference`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ap` FOREIGN KEY (`numeroAppro`) REFERENCES `approvisionnement` (`numeroAppro`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ligneappro`
--

LOCK TABLES `ligneappro` WRITE;
/*!40000 ALTER TABLE `ligneappro` DISABLE KEYS */;
INSERT INTO `ligneappro` VALUES (1,2,'AZ10',300),(1,1,'ong',199);
/*!40000 ALTER TABLE `ligneappro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lignecmd`
--

DROP TABLE IF EXISTS `lignecmd`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lignecmd` (
  `numeroCmd` int(11) NOT NULL,
  `quantite` int(11) DEFAULT NULL,
  `reference` varchar(50) NOT NULL,
  `prixVente` float NOT NULL,
  PRIMARY KEY (`numeroCmd`,`reference`),
  KEY `fk3_idx` (`reference`),
  CONSTRAINT `fk2` FOREIGN KEY (`numeroCmd`) REFERENCES `commande` (`numeroCmd`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk3` FOREIGN KEY (`reference`) REFERENCES `produit` (`reference`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lignecmd`
--

LOCK TABLES `lignecmd` WRITE;
/*!40000 ALTER TABLE `lignecmd` DISABLE KEYS */;
INSERT INTO `lignecmd` VALUES (1,1,'AZ10',1),(1,1,'T440p',1000);
/*!40000 ALTER TABLE `lignecmd` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produit`
--

DROP TABLE IF EXISTS `produit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `produit` (
  `reference` varchar(50) NOT NULL,
  `libelle` varchar(45) NOT NULL,
  `prixUnitaire` float NOT NULL,
  `quantiteStock` int(11) NOT NULL,
  `prixAchat` float NOT NULL,
  `image` varchar(45) DEFAULT NULL,
  `idCategorie` varchar(45) NOT NULL,
  PRIMARY KEY (`reference`),
  KEY `fk5_idx` (`idCategorie`),
  CONSTRAINT `fk5` FOREIGN KEY (`idCategorie`) REFERENCES `categorie` (`idCategorie`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produit`
--

LOCK TABLES `produit` WRITE;
/*!40000 ALTER TABLE `produit` DISABLE KEYS */;
INSERT INTO `produit` VALUES ('AZ10','azib',20,13,7,'azib der3y.png','TV1'),('dde','Lenovo',199,1,11,'default.png','DE1');
/*!40000 ALTER TABLE `produit` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-12-23 16:31:09
ALTER TABLE `lignecmd` DROP FOREIGN KEY `fk3`;
ALTER TABLE `ligneappro` DROP FOREIGN KEY `po`;
ALTER TABLE `ligneappro` DROP FOREIGN KEY `ap`;
ALTER TABLE `commande` DROP FOREIGN KEY `fk1`;
ALTER TABLE `approvisionnement` DROP FOREIGN KEY `fk20`;
