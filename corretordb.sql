CREATE DATABASE  IF NOT EXISTS `imobiliaria` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `imobiliaria`;
-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: localhost    Database: imobiliaria
-- ------------------------------------------------------
-- Server version	8.0.35

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
-- Table structure for table `alugueis`
--

DROP TABLE IF EXISTS `alugueis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `alugueis` (
  `id` int NOT NULL AUTO_INCREMENT,
  `corretor` int NOT NULL,
  `inquilino` int NOT NULL,
  `proprietario` int NOT NULL,
  `valor_total` decimal(10,2) NOT NULL,
  `comissao_corretor` decimal(10,2) NOT NULL,
  `comissao_imob` decimal(10,2) NOT NULL,
  `data` date NOT NULL,
  `data_pgto` date NOT NULL,
  `obs` varchar(255) DEFAULT NULL,
  `usuario` int NOT NULL,
  `imovel` int NOT NULL,
  `data_inicio` date NOT NULL,
  `data_final` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alugueis`
--

LOCK TABLES `alugueis` WRITE;
/*!40000 ALTER TABLE `alugueis` DISABLE KEYS */;
INSERT INTO `alugueis` VALUES (4,9,1,1,2500.00,125.00,125.00,'2022-02-22','2022-02-23','',3,9,'2022-02-23','2024-02-23'),(5,3,3,2,1000.00,50.00,100.00,'2022-02-22','2022-02-22','',3,12,'2022-02-22','2024-02-22');
/*!40000 ALTER TABLE `alugueis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `arquivos`
--

DROP TABLE IF EXISTS `arquivos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `arquivos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `descricao` varchar(500) DEFAULT NULL,
  `arquivo` varchar(100) NOT NULL,
  `data_cad` date NOT NULL,
  `registro` varchar(45) NOT NULL,
  `id_reg` int NOT NULL,
  `usuario` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `arquivos`
--

LOCK TABLES `arquivos` WRITE;
/*!40000 ALTER TABLE `arquivos` DISABLE KEYS */;
INSERT INTO `arquivos` VALUES (1,'Documento de Identidade','','08-02-2022-14-31-51-00.jpeg','2022-03-08','Vendedores',2,3),(2,'Escritura do Imóvel','','08-02-2022-14-33-16-02-FUNDO-ESCURO.rar','2022-03-08','Vendedores',2,3),(6,'Guia de IPTU 2022','','08-02-2022-14-51-50-iptu-2022.pdf','2022-03-08','Vendedores',2,3),(7,'Contrato de Compra e Venda','','08-02-2022-14-52-38-Contrato-de-Compra-e-Venda-Teste.docx','2022-03-08','Vendedores',2,3),(8,'Contrato de Compra e Venda','','08-02-2022-14-52-53-Contrato-de-Compra-e-Venda-Teste.docx','2022-03-08','Vendedores',1,3),(9,'Contrato','','08-02-2022-15-09-41-Contrato-de-Compra-e-Venda-Teste.docx','2022-03-08','Compradores',1,3),(10,'Comprovante de Endereço','','08-02-2022-15-09-54-02-FUNDO-ESCURO.rar','2022-03-08','Compradores',1,3),(14,'Contrato de Compra e Venda','','08-02-2022-15-19-17-Contrato-de-Compra-e-Venda-Teste.docx','2022-03-08','Locatarios',1,3),(16,'Arquivos do Contrato','','15-02-2022-12-46-12-LOGO-2021.rar','2022-03-15','Imóveis',2,3),(17,'Arquivo Teste','','15-02-2022-12-46-28-logo2.jpg','2022-03-15','Imóveis',1,3),(19,'Contrato','','15-02-2022-13-27-17-property-3.jpg','2022-03-15','Imóveis',9,3);
/*!40000 ALTER TABLE `arquivos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bairros`
--

DROP TABLE IF EXISTS `bairros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bairros` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `cidade` int NOT NULL,
  `ativo` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bairros`
--

LOCK TABLES `bairros` WRITE;
/*!40000 ALTER TABLE `bairros` DISABLE KEYS */;
INSERT INTO `bairros` VALUES (1,'Caçari',1,'Sim'),(2,'Canarinho',1,'Sim'),(3,'Centro',2,'Sim'),(4,'Caimbé',3,'Sim');
/*!40000 ALTER TABLE `bairros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cargos`
--

DROP TABLE IF EXISTS `cargos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cargos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cargos`
--

LOCK TABLES `cargos` WRITE;
/*!40000 ALTER TABLE `cargos` DISABLE KEYS */;
INSERT INTO `cargos` VALUES (1,'Tesoureiro'),(2,'Recepcionista'),(3,'Corretor'),(4,'Limpeza'),(5,'Secretária'),(6,'Gerente');
/*!40000 ALTER TABLE `cargos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cidades`
--

DROP TABLE IF EXISTS `cidades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cidades` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `ativo` varchar(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cidades`
--

LOCK TABLES `cidades` WRITE;
/*!40000 ALTER TABLE `cidades` DISABLE KEYS */;
INSERT INTO `cidades` VALUES (1,'Boa Vista','Sim'),(2,'Rorainópolis','Sim'),(3,'Alto Alegre','Sim'),(4,'Caracaraí','Sim'),(5,'Mucajaí','Sim'),(6,'Bonfim','Sim');
/*!40000 ALTER TABLE `cidades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `compradores`
--

DROP TABLE IF EXISTS `compradores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `compradores` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `pessoa` varchar(15) NOT NULL,
  `doc` varchar(20) NOT NULL,
  `email` varchar(45) DEFAULT NULL,
  `endereco` varchar(45) DEFAULT NULL,
  `telefone` varchar(20) NOT NULL,
  `corretor` int NOT NULL,
  `data_cadastro` date NOT NULL,
  `data_nasc` date NOT NULL,
  `obs` varchar(1000) DEFAULT NULL,
  `banco` varchar(45) DEFAULT NULL,
  `tipo` varchar(15) DEFAULT NULL,
  `agencia` varchar(15) DEFAULT NULL,
  `conta` varchar(15) DEFAULT NULL,
  `pix` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compradores`
--

LOCK TABLES `compradores` WRITE;
/*!40000 ALTER TABLE `compradores` DISABLE KEYS */;
INSERT INTO `compradores` VALUES (1,'Jessíca Santos','Física','456.666.666-66','jessica@hotmail.com','Rua C','(22) 22222-2222',9,'2022-02-08','2022-02-08','',NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `compradores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `config`
--

DROP TABLE IF EXISTS `config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `config` (
  `id` int NOT NULL,
  `nome` varchar(45) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `telefone_fixo` varchar(20) DEFAULT NULL,
  `email` varchar(45) NOT NULL,
  `endereco` varchar(100) NOT NULL,
  `cnpj` varchar(20) DEFAULT NULL,
  `relatorio` varchar(10) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `favicon` varchar(100) NOT NULL,
  `logo_rel` varchar(100) NOT NULL,
  `comissao_venda_imob` decimal(10,2) NOT NULL,
  `comissao_venda_corretor` decimal(10,2) NOT NULL,
  `comissao_aluguel_imob` decimal(10,2) NOT NULL,
  `comissao_aluguel_corretor` decimal(10,2) NOT NULL,
  `data_verificacao` date DEFAULT NULL,
  `creci` varchar(20) DEFAULT NULL,
  `nome_banco` varchar(30) DEFAULT NULL,
  `tipo_conta` varchar(20) DEFAULT NULL,
  `agencia` varchar(15) DEFAULT NULL,
  `conta` varchar(15) DEFAULT NULL,
  `nome_beneficiario` varchar(45) DEFAULT NULL,
  `tipo_chave_pix` varchar(20) DEFAULT NULL,
  `chave_pix` varchar(100) DEFAULT NULL,
  `qr_code_pix` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `config`
--

LOCK TABLES `config` WRITE;
/*!40000 ALTER TABLE `config` DISABLE KEYS */;
INSERT INTO `config` VALUES (0,'Inova Tech','(95) 99150-4985','','inovatech@gmail.com','Rua X Número 1100 Bairro Centro - CEP 30512-980 - Belo Horizonte','','pdf','logo.png','favicon.ico','logo.jpg',0.00,0.00,0.00,0.00,'2024-06-29','','','Corrente','','','','CNPJ','','qrcodeexemplo.jpg');
/*!40000 ALTER TABLE `config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contas_banco`
--

DROP TABLE IF EXISTS `contas_banco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contas_banco` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) NOT NULL,
  `banco` varchar(30) NOT NULL,
  `conta` varchar(15) NOT NULL,
  `agencia` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contas_banco`
--

LOCK TABLES `contas_banco` WRITE;
/*!40000 ALTER TABLE `contas_banco` DISABLE KEYS */;
INSERT INTO `contas_banco` VALUES (1,'Bradesco','Bradesco','01250-9','0123'),(2,'Itaú','Itaú','36589-7','5681');
/*!40000 ALTER TABLE `contas_banco` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `frequencias`
--

DROP TABLE IF EXISTS `frequencias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `frequencias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `frequencia` varchar(30) NOT NULL,
  `dias` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `frequencias`
--

LOCK TABLES `frequencias` WRITE;
/*!40000 ALTER TABLE `frequencias` DISABLE KEYS */;
INSERT INTO `frequencias` VALUES (1,'Uma Vez',0),(2,'Diária',1),(3,'Semanal',7),(7,'Mensal',30);
/*!40000 ALTER TABLE `frequencias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `funcionarios`
--

DROP TABLE IF EXISTS `funcionarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `funcionarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `cpf` varchar(20) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `email` varchar(45) NOT NULL,
  `endereco` varchar(100) DEFAULT NULL,
  `data_admissao` date DEFAULT NULL,
  `cargo` int NOT NULL,
  `ativo` varchar(5) NOT NULL,
  `creci` varchar(20) DEFAULT NULL,
  `foto` varchar(100) NOT NULL,
  `obs` varchar(1000) DEFAULT NULL,
  `banco` varchar(45) DEFAULT NULL,
  `tipo` varchar(15) DEFAULT NULL,
  `conta` varchar(15) DEFAULT NULL,
  `agencia` varchar(10) DEFAULT NULL,
  `pix` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `funcionarios`
--

LOCK TABLES `funcionarios` WRITE;
/*!40000 ALTER TABLE `funcionarios` DISABLE KEYS */;
INSERT INTO `funcionarios` VALUES (2,'Marcos Silva','444.444.444-44','(95) 44444-4444','marcos@gmail.com','Rua X','2023-02-08',2,'Sim','','08-02-2022-10-11-56-4.jpg',' ',NULL,NULL,NULL,NULL,NULL),(3,'Marcela Tesoureira','888.888.888-90','(95) 45555-5555','tesoureiro@gmail.com','Rua XXX','2022-02-07',1,'Sim','','08-02-2022-11-16-25-a.png','fasfadsfdas\r\nfdafa\r\nfdsfsaf','Itaú','Poupança','548454','0112','22222222'),(5,'Marta Silva','565.656.565-6','(95) 59656-5656','marta@gmail.com','Rua X','2022-02-08',5,'Não','','08-02-2022-10-58-53-img1.png','',NULL,NULL,NULL,NULL,NULL),(7,'Corretor Teste','844.444.444-44','(95) 55555-5555','corretor@gmail.com','Rua C','2022-02-08',3,'Sim','MG04518','sem-perfil.jpg','',NULL,NULL,NULL,NULL,NULL),(11,'Katia Silva','787.878.454-54','(95) 87457-8787','katia@gmail.com','Rua C','2022-02-22',3,'Sim','','sem-perfil.jpg','','Bradesco','Corrente','454545','45445545','katia@hotmail.com');
/*!40000 ALTER TABLE `funcionarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `imagens_imoveis`
--

DROP TABLE IF EXISTS `imagens_imoveis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `imagens_imoveis` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_imovel` int NOT NULL,
  `foto` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `imagens_imoveis`
--

LOCK TABLES `imagens_imoveis` WRITE;
/*!40000 ALTER TABLE `imagens_imoveis` DISABLE KEYS */;
INSERT INTO `imagens_imoveis` VALUES (3,2,'15-02-2022-12-24-04-property-3.jpg'),(4,2,'15-02-2022-12-24-08-property-4.jpg'),(5,2,'15-02-2022-12-42-31-property-7.jpg'),(6,1,'15-02-2022-12-42-38-property-6.jpg'),(7,9,'15-02-2022-13-26-59-property-3.jpg');
/*!40000 ALTER TABLE `imagens_imoveis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `imoveis`
--

DROP TABLE IF EXISTS `imoveis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `imoveis` (
  `id` int NOT NULL AUTO_INCREMENT,
  `dono` int NOT NULL,
  `corretor` int NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `descricao` text NOT NULL,
  `tipo` int NOT NULL,
  `cidade` int NOT NULL,
  `bairro` int NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `ano` int NOT NULL,
  `visitas` int NOT NULL,
  `area_total` int NOT NULL,
  `area_construida` int NOT NULL,
  `quartos` int NOT NULL,
  `banheiros` int NOT NULL,
  `suites` int NOT NULL,
  `garagens` int NOT NULL,
  `piscinas` int NOT NULL,
  `img_principal` varchar(100) NOT NULL,
  `img_planta` varchar(100) DEFAULT NULL,
  `img_banner` varchar(100) DEFAULT NULL,
  `endereco` varchar(100) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `condicao` varchar(50) DEFAULT NULL,
  `video` varchar(150) DEFAULT NULL,
  `iptu` decimal(10,2) NOT NULL,
  `condominio` decimal(10,2) NOT NULL,
  `comissao_imob` int NOT NULL,
  `comissao_corretor` int NOT NULL,
  `url` varchar(150) NOT NULL,
  `data_cad` date NOT NULL,
  `validade_anuncio` varchar(5) NOT NULL,
  `data_inicio` varchar(45) DEFAULT NULL,
  `data_final` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `imoveis`
--

LOCK TABLES `imoveis` WRITE;
/*!40000 ALTER TABLE `imoveis` DISABLE KEYS */;
INSERT INTO `imoveis` VALUES (1,2,3,'Casa 4 quartos no Caçari','Teste fdafdsa fdsafas afdfaf <br>',3,1,1,400000.00,1989,0,100,80,4,2,2,1,0,'29-06-2024-15-22-56-apartamento-de-luxo-1.png','14-02-2022-21-49-03-floor-plan.jpg','29-06-2024-15-04-26-pexels-expect-best-79873-323780.jpg','Rua Guajajaras 140 Centro','Para Venda','Usado','https://www.youtube.com/embed/OE8Wz0-v5nc',150.00,250.00,7,8,'casa-4-quartos-no-cacari-1','2022-02-14','Sim','2022-02-15','2023-02-15'),(2,1,9,'Casa 5 quartos Bairro Centro','<div><i><b>fsdafdafdasf fafa f<font color=\"********#00FF00********\">dasfa</font></b></i></div><div><i><b>fdsafadfadsf</b></i><br></div>',1,1,1,200000.00,2000,0,100,80,5,2,2,1,0,'29-06-2024-15-17-24-b3e5249b4993410399a3cbbb342dcc2f.jpeg','14-02-2022-21-07-03-floor-plan.jpg','29-06-2024-15-13-51-casacondominio.jpg','Rua C','Para Aluguél','Usado','https://www.youtube.com/embed/OE8Wz0-v5nc',100.00,0.00,0,0,'casa-5-quartos-bairro-centro-2','2022-02-14','Não','2022-02-15','2022-02-15'),(9,1,9,'Cobertura no Bairro Aparecida',' ',4,2,3,2500.00,2022,0,350,320,5,3,3,2,1,'15-02-2022-13-26-30-hero-2.jpg','15-02-2022-13-26-30-floor-plan.jpg','29-06-2024-15-03-42-breadcrumb-bg.jpg','Rua C','Para Venda','Novo','https://www.youtube.com/embed/OE8Wz0-v5nc',250.00,650.00,5,5,'cobertura-no-bairro-aparecida-9','2022-02-15','Sim','2022-02-15','2023-02-15');
/*!40000 ALTER TABLE `imoveis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `locatarios`
--

DROP TABLE IF EXISTS `locatarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `locatarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `pessoa` varchar(15) NOT NULL,
  `doc` varchar(20) NOT NULL,
  `email` varchar(45) DEFAULT NULL,
  `endereco` varchar(30) DEFAULT NULL,
  `telefone` varchar(30) NOT NULL,
  `corretor` int NOT NULL,
  `data_cadastro` date NOT NULL,
  `data_nasc` date NOT NULL,
  `obs` varchar(1000) DEFAULT NULL,
  `banco` varchar(45) DEFAULT NULL,
  `tipo` varchar(15) DEFAULT NULL,
  `agencia` varchar(15) DEFAULT NULL,
  `conta` varchar(15) DEFAULT NULL,
  `pix` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `locatarios`
--

LOCK TABLES `locatarios` WRITE;
/*!40000 ALTER TABLE `locatarios` DISABLE KEYS */;
INSERT INTO `locatarios` VALUES (1,'Pamela Silva','Física','658.454.544-55','pamela@hotmail.com','fdsafa','(84) 55455-5555',3,'2022-02-08','2022-02-08','',NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `locatarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `movimentacoes`
--

DROP TABLE IF EXISTS `movimentacoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `movimentacoes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tipo` varchar(20) NOT NULL,
  `movimento` varchar(35) NOT NULL,
  `descricao` varchar(50) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `usuario` int NOT NULL,
  `data` date NOT NULL,
  `lancamento` varchar(35) NOT NULL,
  `id_mov` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `movimentacoes`
--

LOCK TABLES `movimentacoes` WRITE;
/*!40000 ALTER TABLE `movimentacoes` DISABLE KEYS */;
INSERT INTO `movimentacoes` VALUES (1,'Saída','Conta à Pagar','Conta de Água Fevereiro',480.00,3,'2022-03-15','Bradesco',2),(2,'Saída','Conta à Pagar','Conta de Luz Janeiro',564.98,3,'2022-03-15','Caixa',1),(3,'Saída','Conta à Pagar','(Resíduo) Compra de Cadeiras',400.00,3,'2022-03-15','Caixa',4),(4,'Saída','Conta à Pagar','(Resíduo) Conta de Luz Janeiro',300.00,3,'2022-03-15','Caixa',7),(5,'Entrada','Conta à Receber','aaaaaaa - Parcela 4',20.00,9,'2022-03-15','Caixa',9),(6,'Entrada','Conta à Receber','aaaaaaa - Parcela 4',20.00,9,'2022-03-15','Caixa',9),(7,'Entrada','Conta à Receber','(Resíduo) aaaaaaa - Parcela 3',10.00,9,'2022-03-15','Caixa',8),(8,'Entrada','Conta à Receber','aaaaaaa - Parcela 1',20.00,9,'2022-03-15','Caixa',6),(9,'Entrada','Conta à Receber','Jessíca Santos',4000.00,3,'2022-03-15','Caixa',11),(10,'Entrada','Conta à Receber','Teste',400.00,3,'2022-03-14','Caixa',12),(11,'Saída','Conta à Pagar','dfdfdfa',60.00,3,'2022-03-16','Caixa',11),(12,'Entrada','Conta à Receber','fdfasfdafa',10000.00,3,'2022-03-16','Caixa',13),(13,'Entrada','Conta à Receber','fdsfdasfsaf',150.00,3,'2022-03-16','Caixa',14),(14,'Saída','Conta à Pagar','Conta teste - Parcela 3',200.00,3,'2022-03-16','Caixa',15),(15,'Saída','Conta à Pagar','(Resíduo) Conta teste - Parcela 3',100.00,3,'2022-03-16','Caixa',16),(16,'Saída','Conta à Pagar','Comissão Venda',8000.00,3,'2022-03-21','Caixa',22),(17,'Entrada','Aluguél','Aluguel Parcela - (1)',2500.00,3,'2022-03-21','Caixa',50),(18,'Entrada','Aluguél','Aluguel Parcela - (1)',2500.00,3,'2022-03-21','Caixa',50),(19,'Entrada','Conta à Receber','Marcelo Santos',80.00,3,'2022-03-22','Caixa',91),(20,'Entrada','Conta à Receber','Jessíca Santos',75.00,3,'2022-03-22','Caixa',90),(21,'Saída','Conta à Pagar','Comissão Aluguél',125.00,3,'2022-03-22','Caixa',28),(22,'Entrada','Aluguél','Aluguel Parcela - (1)',2500.00,3,'2022-03-22','Caixa',63),(23,'Entrada','Aluguél','Aluguel Parcela - (1)',2500.00,3,'2022-03-22','Caixa',63),(24,'Entrada','Aluguél','Aluguel Parcela - (1)',2500.00,3,'2022-03-22','Caixa',63),(25,'Entrada','Conta à Receber','Aluguel Parcela - (24)',0.00,3,'2022-03-22','Caixa',86),(26,'Entrada','Conta à Receber','Conta amanha',287.00,3,'2022-03-22','Caixa',95),(27,'Entrada','Aluguél','',2500.00,3,'2022-03-22','Caixa',64),(28,'Entrada','Conta à Receber','Aluguel Parcela - (3)',2500.00,3,'2022-03-22','Caixa',65),(29,'Entrada','Conta à Receber','Aluguel Parcela - (4)',2500.00,3,'2022-03-22','Caixa',66),(30,'Entrada','Conta à Receber','Aluguel Parcela - (5)',2500.00,3,'2022-03-22','Caixa',67),(31,'Entrada','Conta à Receber','Aluguel Parcela - (6)',2550.00,3,'2022-03-22','Caixa',68),(32,'Entrada','Conta à Receber','(Resíduo) Aluguel Parcela - (6)',2550.00,3,'2022-03-22','Caixa',68),(33,'Entrada','Conta à Receber','Aluguel Parcela - (7)',2550.00,3,'2022-03-22','Caixa',69),(34,'Entrada','Conta à Receber','Aluguel Parcela - (8)',2500.00,3,'2022-03-22','Caixa',70),(35,'Entrada','Conta à Receber','Aluguel Parcela - (10)',2500.00,3,'2022-03-22','Caixa',72),(36,'Entrada','Conta à Receber','Aluguel Parcela - (11)',2500.00,3,'2022-03-22','Caixa',73),(37,'Entrada','Conta à Receber','Aluguel Parcela - (9)',2600.00,3,'2022-03-22','Caixa',71),(38,'Entrada','Conta à Receber','Aluguel Parcela - (1)',1000.00,3,'2022-03-22','Caixa',96),(39,'Saída','Conta à Pagar','Aluguél - Marcelo Santos',900.00,3,'2022-03-22','Caixa',42),(40,'Saída','Conta à Pagar','Comissão Aluguél',50.00,3,'2022-03-22','Caixa',41),(41,'Saída','Conta à Pagar','Conta Agua',250.00,3,'2022-03-22','Caixa',43),(42,'Saída','Conta à Pagar','Comissão Venda',4000.00,3,'2022-03-22','Caixa',30),(43,'Entrada','Conta à Receber','Aluguel Parcela - (2)',1060.00,3,'2022-03-22','Caixa',97),(44,'Entrada','Conta à Receber','Aluguel Parcela - (12)',2580.00,3,'2022-03-22','Caixa',74),(45,'Entrada','Conta à Receber','Aluguel Parcela - (13)',2500.00,3,'2022-03-22','Caixa',75),(46,'Saída','Conta à Pagar','Aluguél - Empresa X',2250.00,3,'2022-03-22','Caixa',46),(47,'Entrada','Conta à Receber','Conta Boleto',180.00,0,'2022-03-28','Boleto',120);
/*!40000 ALTER TABLE `movimentacoes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pagar`
--

DROP TABLE IF EXISTS `pagar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pagar` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(50) DEFAULT NULL,
  `pessoa` int NOT NULL,
  `locatario` int NOT NULL,
  `corretor` int NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `data_lanc` date NOT NULL,
  `data_venc` date NOT NULL,
  `data_pgto` date NOT NULL,
  `usuario_lanc` int NOT NULL,
  `usuario_pgto` int NOT NULL,
  `frequencia` int NOT NULL,
  `saida` varchar(50) NOT NULL,
  `arquivo` varchar(255) DEFAULT NULL,
  `pago` varchar(5) NOT NULL,
  `obs` varchar(255) DEFAULT NULL,
  `referencia` varchar(35) NOT NULL,
  `id_ref` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pagar`
--

LOCK TABLES `pagar` WRITE;
/*!40000 ALTER TABLE `pagar` DISABLE KEYS */;
INSERT INTO `pagar` VALUES (1,'Conta de Luz Janeiro',0,0,0,564.98,'2022-02-15','2022-02-16','2022-02-15',3,3,1,'Caixa','15-02-2022-17-42-40-09-11-2021-09-21-26-conta3.jpg','Sim',NULL,'',0),(2,'Conta de Água Fevereiro',0,0,0,480.00,'2022-02-15','2022-02-15','2022-02-15',3,3,1,'Bradesco','15-02-2022-17-43-02-18-10-2021-15-02-46-conta3.jpg','Sim',NULL,'',0),(3,'Conta de Telefone',0,0,0,260.00,'2022-02-15','2022-02-15','2022-02-15',3,0,1,'Itaú','15-02-2022-17-43-18-09-11-2021-10-17-10-pdfteste.pdf','Não',NULL,'',0),(4,'Compra de Cadeiras',0,0,0,490.00,'2022-02-15','2022-02-15','2022-02-15',3,3,1,'Caixa','15-02-2022-17-43-39-09-11-2021-12-04-29-pdfteste.zip','Não',NULL,'',0),(5,'Produtos de Limpeza',0,0,0,380.00,'2022-02-15','2022-02-14','2022-02-15',3,0,1,'Caixa','15-02-2022-17-44-23-19-10-2021-11-48-28-pdfteste.pdf','Não',NULL,'',0),(7,'Conta de Luz Janeiro',0,0,0,264.98,'2022-02-15','2022-02-17','2022-02-15',0,3,1,'Caixa','15-02-2022-17-42-40-09-11-2021-09-21-26-conta3.jpg','Não',NULL,'',0),(8,'Conta de Água Fevereiro - Parcela 1',0,0,0,240.00,'2022-02-15','2022-02-16','2022-02-15',3,0,1,'Bradesco','15-02-2022-17-43-02-18-10-2021-15-02-46-conta3.jpg','Não',NULL,'',0),(9,'Conta de Água Fevereiro - Parcela 2',0,0,9,240.00,'2022-02-21','2022-03-16','2022-02-15',3,0,1,'Bradesco','15-02-2022-17-43-02-18-10-2021-15-02-46-conta3.jpg','Não','','',0),(10,'fdasfdas',0,0,0,500.00,'2022-02-15','2022-02-15','2022-02-15',9,0,0,'Caixa','sem-foto.png','Não',NULL,'',0),(11,'dfdfdfa',2,0,0,60.00,'2022-02-15','2022-02-15','2022-02-16',9,3,0,'Caixa','sem-foto.png','Sim',NULL,'',0),(13,'Conta teste - Parcela 1',0,0,0,200.00,'2022-02-16','2022-02-16','2022-02-15',3,0,30,'Caixa','16-02-2022-15-33-42-09-11-2021-09-21-26-conta3.jpg','Não',NULL,'',0),(14,'Conta teste - Parcela 2',0,0,0,200.00,'2022-02-16','2022-03-16','2022-02-15',3,0,30,'Caixa','16-02-2022-15-33-42-09-11-2021-09-21-26-conta3.jpg','Não',NULL,'',0),(15,'Conta teste - Parcela 3',0,0,0,200.00,'2022-02-16','2022-04-16','2022-02-16',3,3,30,'Caixa','16-02-2022-15-33-42-09-11-2021-09-21-26-conta3.jpg','Sim',NULL,'',0),(16,'Conta teste - Parcela 3',0,0,0,100.00,'2022-02-16','2022-05-16','2022-02-16',0,3,30,'Caixa','16-02-2022-15-33-42-09-11-2021-09-21-26-conta3.jpg','Não',NULL,'',0),(17,'dfafdsafdsaf',0,1,0,50.00,'2022-02-21','2022-02-21','2022-02-15',3,0,0,'Caixa','sem-foto.png','Não','aaaaaaaaaaaa','',0),(18,'Testess',0,0,9,560.00,'2022-02-21','2022-02-21','2022-02-15',3,0,0,'Caixa','sem-foto.png','Não','','',0),(24,'Comissão Venda',0,0,3,8000.00,'2022-02-21','2022-02-21','2022-02-15',3,0,0,'Caixa','sem-foto.png','Não',NULL,'Comissão',4),(28,'Comissão Aluguél',0,0,9,125.00,'2022-02-22','2022-02-23','2022-02-22',3,3,0,'Caixa','sem-foto.png','Sim',NULL,'Comissão',4),(30,'Comissão Venda',0,0,9,4000.00,'2022-02-22','2022-02-22','2022-02-22',3,3,0,'Caixa','sem-foto.png','Sim',NULL,'Comissão',7),(31,'Aluguel Parcela - (3)',0,0,0,2500.00,'2022-02-22','2022-02-23','2022-02-15',3,0,0,'Caixa','sem-foto.png','Não',NULL,'Repasse Aluguél',65),(32,'Aluguel Parcela - (4)',0,0,0,2500.00,'2022-02-22','2022-02-23','2022-02-15',3,0,0,'Caixa','sem-foto.png','Não',NULL,'Repasse Aluguél',66),(33,'Aluguel Parcela - (5)',1,0,0,2250.00,'2022-02-22','2022-02-23','2022-02-15',3,0,0,'Caixa','sem-foto.png','Não',NULL,'Repasse Aluguél',67),(34,'Aluguél - Empresa X',1,0,0,2050.00,'2022-02-22','2022-02-23','2022-02-15',3,0,0,'Caixa','sem-foto.png','Não',NULL,'Repasse Aluguél',68),(35,'Aluguél - Empresa X',1,0,0,2050.00,'2022-02-22','2022-02-23','2022-02-15',3,0,0,'Caixa','sem-foto.png','Não',NULL,'Repasse Aluguél',69),(36,'Aluguél - Empresa X',1,0,0,2250.00,'2022-02-22','2022-02-23','2022-02-15',3,0,0,'Caixa','sem-foto.png','Não',NULL,'Repasse Aluguél',70),(37,'Aluguél - Empresa X',1,0,0,1750.00,'2022-02-22','2022-02-23','2022-02-15',3,0,0,'Caixa','sem-foto.png','Não',NULL,'Repasse Aluguél',72),(38,'Aluguél - Empresa X',1,0,0,2375.00,'2022-02-22','2022-02-23','2022-02-15',3,0,0,'Caixa','sem-foto.png','Não',NULL,'Repasse Aluguél',73),(39,'Conta X',0,1,0,50.00,'2022-02-22','2022-02-22','2022-02-15',3,0,0,'Caixa','sem-foto.png','Não','','',0),(40,'Aluguél - Empresa X',1,0,0,2350.00,'2022-02-22','2022-02-23','2022-02-15',3,0,0,'Caixa','sem-foto.png','Não',NULL,'Repasse Aluguél',71),(41,'Comissão Aluguél',0,0,3,50.00,'2022-02-22','2022-02-22','2022-02-22',3,3,0,'Caixa','sem-foto.png','Sim',NULL,'Comissão',5),(42,'Aluguél - Marcelo Santos',2,0,0,900.00,'2022-02-22','2022-02-23','2022-02-22',3,3,0,'Caixa','sem-foto.png','Sim',NULL,'Repasse Aluguél',96),(43,'Conta Agua',0,0,0,250.00,'2022-02-22','2022-02-22','2022-02-22',3,3,0,'Caixa','sem-foto.png','Sim','','',0),(44,'Aluguél - Marcelo Santos',2,0,0,960.00,'2022-02-22','2022-02-23','2022-02-15',3,0,0,'Caixa','sem-foto.png','Não',NULL,'Repasse Aluguél',97),(45,'Aluguél - Empresa X',1,0,0,2330.00,'2022-02-22','2022-02-23','2022-02-15',3,0,0,'Caixa','sem-foto.png','Não',NULL,'Repasse Aluguél',74),(46,'Aluguél - Empresa X',1,0,0,2250.00,'2022-02-22','2022-02-23','2022-02-22',3,3,0,'Caixa','sem-foto.png','Sim',NULL,'Repasse Aluguél',75),(47,'Conta de Luz',0,0,0,780.00,'2022-02-28','2022-02-28','2022-02-15',3,0,0,'Caixa','28-02-2022-10-06-07-09-11-2021-10-17-10-pdfteste.pdf','Não','','',0),(48,'Conta Teste',0,0,0,1999.99,'2022-02-28','2022-03-01','2022-02-15',3,0,0,'Caixa','sem-foto.png','Não','','',0);
/*!40000 ALTER TABLE `pagar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `receber`
--

DROP TABLE IF EXISTS `receber`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `receber` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(50) DEFAULT NULL,
  `comprador` int NOT NULL,
  `locatario` int NOT NULL,
  `proprietario` int NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `data_lanc` date NOT NULL,
  `data_venc` date NOT NULL,
  `data_pgto` date NOT NULL,
  `usuario_lanc` int NOT NULL,
  `usuario_pgto` int NOT NULL,
  `frequencia` int NOT NULL,
  `saida` varchar(50) NOT NULL,
  `arquivo` varchar(255) DEFAULT NULL,
  `pago` varchar(5) NOT NULL,
  `obs` varchar(255) DEFAULT NULL,
  `referencia` varchar(20) NOT NULL,
  `id_ref` int NOT NULL,
  `boleto` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=122 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `receber`
--

LOCK TABLES `receber` WRITE;
/*!40000 ALTER TABLE `receber` DISABLE KEYS */;
INSERT INTO `receber` VALUES (1,'fdsafas',0,1,0,50.00,'2022-02-15','2022-02-15','2022-02-15',3,0,0,'Caixa','sem-foto.png','Não',NULL,'',0,NULL),(6,'aaaaaaa - Parcela 1',1,0,0,20.00,'2022-02-15','2022-02-15','2022-02-15',9,9,0,'Caixa','15-02-2022-18-41-09-09-11-2021-13-07-27-conta3.jpg','Sim',NULL,'',0,NULL),(7,'aaaaaaa - Parcela 2',1,0,0,20.00,'2022-02-15','2022-03-15','2022-02-15',9,0,0,'Caixa','15-02-2022-18-41-09-09-11-2021-13-07-27-conta3.jpg','Não',NULL,'',0,NULL),(8,'aaaaaaa - Parcela 3',1,0,0,10.00,'2022-02-15','2022-04-15','2022-02-15',9,9,0,'Caixa','15-02-2022-18-41-09-09-11-2021-13-07-27-conta3.jpg','Não',NULL,'',0,NULL),(9,'aaaaaaa - Parcela 4',1,0,0,20.00,'2022-02-15','2022-05-15','2022-02-15',9,9,0,'Caixa','15-02-2022-18-41-09-09-11-2021-13-07-27-conta3.jpg','Sim',NULL,'',0,NULL),(10,'dsafssfsafs',0,0,0,25.00,'2022-02-15','2022-02-15','2022-02-15',3,0,0,'Caixa','sem-foto.png','Não',NULL,'',0,NULL),(11,'Jessíca Santos',1,0,0,4000.00,'2022-02-15','2022-02-14','2022-02-15',3,3,0,'Caixa','sem-foto.png','Sim',NULL,'',0,NULL),(12,'Teste',1,0,0,400.00,'2022-02-15','2022-02-14','2022-02-14',3,3,0,'Caixa','sem-foto.png','Sim',NULL,'',0,NULL),(13,'fdfasfdafa',0,0,0,10000.00,'2022-02-16','2022-02-16','2022-02-16',3,3,0,'Caixa','sem-foto.png','Sim',NULL,'',0,NULL),(14,'fdsfdasfsaf',0,0,0,150.00,'2022-02-16','2022-02-16','2022-02-16',3,3,0,'Caixa','sem-foto.png','Sim',NULL,'',0,NULL),(15,'fdafadsfas',0,0,0,65.00,'2022-02-16','2022-02-16','2022-02-15',3,0,0,'Caixa','sem-foto.png','Não',NULL,'',0,NULL),(16,'Teste',0,0,0,650.00,'2022-02-21','2022-02-21','2022-02-15',3,0,0,'Caixa','sem-foto.png','Não','aaaaaaaaaaaaaaaa','',0,NULL),(17,'freq 7',0,0,0,20.00,'2022-02-21','2022-02-21','2022-02-15',3,0,7,'Caixa','sem-foto.png','Não',' dfds','',0,NULL),(18,'conta',0,0,0,45.00,'2022-02-21','2022-02-21','2022-02-15',3,0,30,'Caixa','sem-foto.png','Não','aaaaaaaaa','',0,NULL),(37,'Venda de Imóvel',1,0,0,32000.00,'2022-02-21','2022-02-21','2022-02-15',3,0,0,'Caixa','sem-foto.png','Não',NULL,'Venda',4,NULL),(63,'Aluguel Parcela - (1)',0,1,0,2500.00,'2022-02-22','2022-01-23','2022-02-22',3,3,0,'Caixa','sem-foto.png','Sim',NULL,'Aluguél',4,NULL),(64,'Aluguel Parcela - (2)',0,1,0,2500.00,'2022-02-22','2022-03-23','2022-02-22',3,3,0,'Caixa','sem-foto.png','Sim',NULL,'Aluguél',4,NULL),(65,'Aluguel Parcela - (3)',0,1,0,2500.00,'2022-02-22','2022-04-23','2022-02-22',3,3,0,'Caixa','sem-foto.png','Sim',NULL,'Aluguél',4,NULL),(66,'Aluguel Parcela - (4)',0,1,0,2500.00,'2022-02-22','2022-05-23','2022-02-22',3,3,0,'Caixa','sem-foto.png','Sim',NULL,'Aluguél',4,NULL),(67,'Aluguel Parcela - (5)',0,1,0,2500.00,'2022-02-22','2022-06-23','2022-02-22',3,3,0,'Caixa','sem-foto.png','Sim',NULL,'Aluguél',4,NULL),(68,'Aluguel Parcela - (6)',0,1,0,0.00,'2022-02-22','2022-07-23','2022-02-22',3,3,0,'Caixa','sem-foto.png','Sim',NULL,'Aluguél',4,NULL),(69,'Aluguel Parcela - (7)',0,1,0,2550.00,'2022-02-22','2022-08-23','2022-02-22',3,3,0,'Caixa','sem-foto.png','Sim',NULL,'Aluguél',4,NULL),(70,'Aluguel Parcela - (8)',0,1,0,2500.00,'2022-02-22','2022-09-23','2022-02-22',3,3,0,'Caixa','sem-foto.png','Sim',NULL,'Aluguél',4,NULL),(71,'Aluguel Parcela - (9)',0,1,0,2600.00,'2022-02-22','2022-10-23','2022-02-22',3,3,0,'Caixa','sem-foto.png','Sim',NULL,'Aluguél',4,NULL),(72,'Aluguel Parcela - (10)',0,1,0,2500.00,'2022-02-22','2022-11-23','2022-02-22',3,3,0,'Caixa','sem-foto.png','Sim',NULL,'Aluguél',4,NULL),(73,'Aluguel Parcela - (11)',0,1,0,2500.00,'2022-02-22','2022-12-23','2022-02-22',3,3,0,'Caixa','sem-foto.png','Sim',NULL,'Aluguél',4,NULL),(74,'Aluguel Parcela - (12)',0,1,0,2580.00,'2022-02-22','2023-01-23','2022-02-22',3,3,0,'Caixa','sem-foto.png','Sim',NULL,'Aluguél',4,NULL),(75,'Aluguel Parcela - (13)',0,1,0,2500.00,'2022-02-22','2023-02-23','2022-02-22',3,3,0,'Caixa','sem-foto.png','Sim',NULL,'Aluguél',4,NULL),(76,'Aluguel Parcela - (14)',0,1,0,2500.00,'2022-02-22','2023-03-23','2022-02-15',3,0,0,'Caixa','sem-foto.png','Não',NULL,'Aluguél',4,NULL),(77,'Aluguel Parcela - (15)',0,1,0,2500.00,'2022-02-22','2023-04-23','2022-02-15',3,0,0,'Caixa','sem-foto.png','Não',NULL,'Aluguél',4,NULL),(78,'Aluguel Parcela - (16)',0,1,0,2500.00,'2022-02-22','2023-05-23','2022-02-15',3,0,0,'Caixa','sem-foto.png','Não',NULL,'Aluguél',4,NULL),(79,'Aluguel Parcela - (17)',0,1,0,2500.00,'2022-02-22','2023-06-23','2022-02-15',3,0,0,'Caixa','sem-foto.png','Não',NULL,'Aluguél',4,NULL),(80,'Aluguel Parcela - (18)',0,1,0,2500.00,'2022-02-22','2023-07-23','2022-02-15',3,0,0,'Caixa','sem-foto.png','Não',NULL,'Aluguél',4,NULL),(81,'Aluguel Parcela - (19)',0,1,0,2500.00,'2022-02-22','2023-08-23','2022-02-15',3,0,0,'Caixa','sem-foto.png','Não',NULL,'Aluguél',4,NULL),(82,'Aluguel Parcela - (20)',0,1,0,2500.00,'2022-02-22','2023-09-23','2022-02-15',3,0,0,'Caixa','sem-foto.png','Não',NULL,'Aluguél',4,NULL),(83,'Aluguel Parcela - (21)',0,1,0,2500.00,'2022-02-22','2023-10-23','2022-02-15',3,0,0,'Caixa','sem-foto.png','Não',NULL,'Aluguél',4,NULL),(84,'Aluguel Parcela - (22)',0,1,0,2500.00,'2022-02-22','2023-11-23','2022-02-15',3,0,0,'Caixa','sem-foto.png','Não',NULL,'Aluguél',4,NULL),(85,'Aluguel Parcela - (23)',0,1,0,2500.00,'2022-02-22','2023-12-23','2022-02-15',3,0,0,'Caixa','sem-foto.png','Não',NULL,'Aluguél',4,NULL),(86,'Aluguel Parcela - (24)',0,1,0,0.00,'2022-02-22','2024-01-23','2022-02-22',3,3,0,'Caixa','sem-foto.png','Sim',NULL,'Aluguél',4,NULL),(88,'Venda de Imóvel',0,0,1,16000.00,'2022-02-22','2022-02-22','2022-02-15',3,0,0,'Caixa','sem-foto.png','Não',NULL,'Venda',7,NULL),(89,'Marcelo Santos',0,0,2,50.00,'2022-02-22','2022-02-22','2022-02-15',3,0,0,'Caixa','sem-foto.png','Não',' ','',0,NULL),(90,'Jessíca Santos',1,0,0,75.00,'2022-02-22','2022-02-22','2022-02-22',3,3,0,'Caixa','sem-foto.png','Sim',' ','',0,NULL),(91,'Marcelo Santos',0,0,2,80.00,'2022-02-22','2022-02-22','2022-02-22',3,3,0,'Caixa','sem-foto.png','Sim',' ','',0,NULL),(92,'fdafdasf',0,0,0,50.00,'2022-02-22','2022-02-22','2022-02-15',3,0,0,'Caixa','sem-foto.png','Não',' ','',0,NULL),(93,'Conta Teste',0,0,5,160.00,'2022-02-22','2022-02-22','2022-02-15',3,0,0,'Caixa','sem-foto.png','Não',' ','',0,'414849865'),(94,'Conta Vencida',0,0,5,1899.99,'2022-02-28','2022-03-03','2022-02-15',3,0,0,'Caixa','sem-foto.png','Não',' ','',0,'414811233'),(95,'Conta amanha',0,0,5,287.00,'2022-02-22','2022-02-23','2022-02-22',3,3,0,'Caixa','sem-foto.png','Sim',' ','',0,NULL),(96,'Aluguel Parcela - (1)',0,3,0,1000.00,'2022-02-22','2022-02-22','2022-02-22',3,3,0,'Caixa','sem-foto.png','Sim',NULL,'Aluguél',5,NULL),(97,'Aluguel Parcela - (2)',0,3,0,1060.00,'2022-02-22','2022-03-22','2022-02-22',3,3,0,'Caixa','sem-foto.png','Sim',NULL,'Aluguél',5,NULL),(98,'Aluguel Parcela - (3)',0,3,0,1000.00,'2022-02-22','2022-04-22','2022-02-15',3,0,0,'Caixa','sem-foto.png','Não',NULL,'Aluguél',5,'414850074'),(99,'Aluguel Parcela - (4)',0,3,0,1000.00,'2022-02-22','2022-05-22','2022-02-15',3,0,0,'Caixa','sem-foto.png','Não',NULL,'Aluguél',5,NULL),(100,'Aluguel Parcela - (5)',0,3,0,1000.00,'2022-02-22','2022-06-22','2022-02-15',3,0,0,'Caixa','sem-foto.png','Não',NULL,'Aluguél',5,NULL),(101,'Aluguel Parcela - (6)',0,3,0,1000.00,'2022-02-22','2022-07-22','2022-02-15',3,0,0,'Caixa','sem-foto.png','Não',NULL,'Aluguél',5,NULL),(102,'Aluguel Parcela - (7)',0,3,0,1000.00,'2022-02-22','2022-08-22','2022-02-15',3,0,0,'Caixa','sem-foto.png','Não',NULL,'Aluguél',5,NULL),(103,'Aluguel Parcela - (8)',0,3,0,1000.00,'2022-02-22','2022-09-22','2022-02-15',3,0,0,'Caixa','sem-foto.png','Não',NULL,'Aluguél',5,NULL),(104,'Aluguel Parcela - (9)',0,3,0,1000.00,'2022-02-22','2022-10-22','2022-02-15',3,0,0,'Caixa','sem-foto.png','Não',NULL,'Aluguél',5,NULL),(105,'Aluguel Parcela - (10)',0,3,0,1000.00,'2022-02-22','2022-11-22','2022-02-15',3,0,0,'Caixa','sem-foto.png','Não',NULL,'Aluguél',5,NULL),(106,'Aluguel Parcela - (11)',0,3,0,1000.00,'2022-02-22','2022-12-22','2022-02-15',3,0,0,'Caixa','sem-foto.png','Não',NULL,'Aluguél',5,NULL),(107,'Aluguel Parcela - (12)',0,3,0,1000.00,'2022-02-22','2023-01-22','2022-02-15',3,0,0,'Caixa','sem-foto.png','Não',NULL,'Aluguél',5,NULL),(108,'Aluguel Parcela - (13)',0,3,0,1000.00,'2022-02-22','2023-02-22','2022-02-15',3,0,0,'Caixa','sem-foto.png','Não',NULL,'Aluguél',5,NULL),(109,'Aluguel Parcela - (14)',0,3,0,1000.00,'2022-02-22','2023-03-22','2022-02-15',3,0,0,'Caixa','sem-foto.png','Não',NULL,'Aluguél',5,NULL),(110,'Aluguel Parcela - (15)',0,3,0,1000.00,'2022-02-22','2023-04-22','2022-02-15',3,0,0,'Caixa','sem-foto.png','Não',NULL,'Aluguél',5,NULL),(111,'Aluguel Parcela - (16)',0,3,0,1000.00,'2022-02-22','2023-05-22','2022-02-15',3,0,0,'Caixa','sem-foto.png','Não',NULL,'Aluguél',5,NULL),(112,'Aluguel Parcela - (17)',0,3,0,1000.00,'2022-02-22','2023-06-22','2022-02-15',3,0,0,'Caixa','sem-foto.png','Não',NULL,'Aluguél',5,NULL),(113,'Aluguel Parcela - (18)',0,3,0,1000.00,'2022-02-22','2023-07-22','2022-02-15',3,0,0,'Caixa','sem-foto.png','Não',NULL,'Aluguél',5,NULL),(114,'Aluguel Parcela - (19)',0,3,0,1000.00,'2022-02-22','2023-08-22','2022-02-15',3,0,0,'Caixa','sem-foto.png','Não',NULL,'Aluguél',5,NULL),(115,'Aluguel Parcela - (20)',0,3,0,1000.00,'2022-02-22','2023-09-22','2022-02-15',3,0,0,'Caixa','sem-foto.png','Não',NULL,'Aluguél',5,NULL),(116,'Aluguel Parcela - (21)',0,3,0,1000.00,'2022-02-22','2023-10-22','2022-02-15',3,0,0,'Caixa','sem-foto.png','Não',NULL,'Aluguél',5,NULL),(117,'Aluguel Parcela - (22)',0,3,0,1000.00,'2022-02-22','2023-11-22','2022-02-15',3,0,0,'Caixa','sem-foto.png','Não',NULL,'Aluguél',5,NULL),(118,'Aluguel Parcela - (23)',0,3,0,1000.00,'2022-02-22','2023-12-22','2022-02-15',3,0,0,'Caixa','sem-foto.png','Não',NULL,'Aluguél',5,NULL),(119,'Aluguel Parcela - (24)',0,3,0,1000.00,'2022-02-22','2024-01-22','2022-02-15',3,0,0,'Caixa','sem-foto.png','Não',NULL,'Aluguél',5,NULL),(120,'Conta Boleto',0,0,0,180.00,'2022-02-28','2022-02-28','2022-02-15',3,0,0,'Boleto','28-02-2022-17-15-05-09-11-2021-09-21-26-conta3.jpg','Sim',' ','',0,'413985942'),(121,'Comissão Aluguél',0,3,0,1600.00,'2022-02-28','2022-02-28','2022-02-15',3,0,0,'Caixa','sem-foto.png','Não',' ','',0,'414849946');
/*!40000 ALTER TABLE `receber` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tarefas`
--

DROP TABLE IF EXISTS `tarefas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tarefas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(45) NOT NULL,
  `descricao` varchar(100) DEFAULT NULL,
  `hora` time NOT NULL,
  `data` date NOT NULL,
  `usuario` int NOT NULL,
  `status` varchar(15) NOT NULL,
  `obs` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tarefas`
--

LOCK TABLES `tarefas` WRITE;
/*!40000 ALTER TABLE `tarefas` DISABLE KEYS */;
INSERT INTO `tarefas` VALUES (1,'Tarefa teste','fdfdasf','10:15:00','2022-02-08',3,'Concluída','fdsfadasfa'),(2,'Visitar Cliente','Marcos Sila','15:30:00','2022-02-08',3,'Agendada','<div><b>fdafdas</b></div><div><b><font size=\"5\" color=\"#333399\">fdafdsafsf</font><br></b></div>'),(3,'Visitar Cliente','Paula Silva','13:30:00','2022-02-09',3,'Agendada',''),(5,'Tarefa Teste','','10:15:00','2022-02-08',9,'Concluída',''),(7,'dsfafdsaf','','16:00:00','2022-02-08',9,'Agendada','');
/*!40000 ALTER TABLE `tarefas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipos`
--

DROP TABLE IF EXISTS `tipos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `ativo` varchar(5) NOT NULL,
  `foto_ficha` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipos`
--

LOCK TABLES `tipos` WRITE;
/*!40000 ALTER TABLE `tipos` DISABLE KEYS */;
INSERT INTO `tipos` VALUES (1,'Casa','08-02-2022-17-05-14-1594166732975hero-3.jpg','Sim','28-02-2022-19-07-05-casa.jpg'),(2,'Chácara','08-02-2022-17-05-44-1594392956630chacara.jpg','Sim','28-02-2022-19-06-57-chacara.jpg'),(3,'Apartamento','08-02-2022-17-05-51-1594321775530property-5.jpg','Sim','28-02-2022-19-06-47-apartamento.jpg'),(4,'Cobertura','08-02-2022-17-05-59-1594392965147cobertura.jpg','Sim','28-02-2022-19-06-33-cobertura.jpg'),(5,'Sítio','08-02-2022-17-06-11-1594392980034sitios.jpg','Sim','28-02-2022-19-04-54-sitio.jpg'),(6,'Terreno','08-02-2022-17-06-22-1594392973025lotes.jpg','Sim','28-02-2022-19-04-40-terreno.jpg'),(7,'Casa Geminada','08-02-2022-17-06-30-1594393033540casa-geminada.jpg','Sim','28-02-2022-19-00-07-casa.jpg'),(9,'Barracão','sem-foto.png','Sim','28-02-2022-19-07-30-barracao.jpg'),(10,'Fazenda','sem-foto.png','Sim','28-02-2022-19-07-46-fazenda.jpg'),(11,'Flat','sem-foto.png','Sim','28-02-2022-19-07-53-flat.jpg'),(12,'Galpão','sem-foto.png','Sim','28-02-2022-19-08-11-galpao.jpg'),(13,'Loja','sem-foto.png','Sim','28-02-2022-19-08-21-loja.jpg'),(14,'Prédio','sem-foto.png','Sim','28-02-2022-19-09-33-predio.jpg'),(15,'Rancho','sem-foto.png','Sim','28-02-2022-19-09-44-rancho.jpg'),(16,'Sobrado','sem-foto.png','Sim','28-02-2022-19-09-58-sobrado.jpg');
/*!40000 ALTER TABLE `tipos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `cpf` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `senha_crip` varchar(150) NOT NULL,
  `senha` varchar(45) NOT NULL,
  `nivel` varchar(25) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `id_func` int NOT NULL,
  `ativo` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (3,'Corretor Admin','000.000.000-10','corretoradm@gmail.com','202cb962ac59075b964b07152d234b70','123','Administrador','29-06-2024-01-21-31-49c8e403cd1929e9e7b02126824ff831.jpg',0,'Sim'),(5,'Marcos Silva','444.444.444-44','marcos@gmail.com','202cb962ac59075b964b07152d234b70','123','Recepcionista','08-02-2022-10-11-56-4.jpg',2,'Sim'),(6,'Marcela Tesoureira','888.888.888-90','tesoureiro@gmail.com','202cb962ac59075b964b07152d234b70','123','Tesoureiro','08-02-2022-11-16-25-a.png',3,'Sim'),(9,'Corretor Teste','844.444.444-44','corretorteste@gmail.com','202cb962ac59075b964b07152d234b70','123','Corretor','sem-perfil.jpg',7,'Sim');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `valor_parcial`
--

DROP TABLE IF EXISTS `valor_parcial`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `valor_parcial` (
  `id` int NOT NULL,
  `id_conta` int NOT NULL,
  `tipo` varchar(20) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `data` date NOT NULL,
  `usuario` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `valor_parcial`
--

LOCK TABLES `valor_parcial` WRITE;
/*!40000 ALTER TABLE `valor_parcial` DISABLE KEYS */;
INSERT INTO `valor_parcial` VALUES (1,4,'Pagar',400.00,'2022-02-15',3),(2,7,'Pagar',300.00,'2022-02-15',3),(3,8,'Receber',10.00,'2022-02-15',9),(4,16,'Pagar',100.00,'2022-02-16',3),(5,68,'Receber',2550.00,'2022-02-22',3),(1,4,'Pagar',400.00,'2022-02-15',3),(2,7,'Pagar',300.00,'2022-02-15',3),(3,8,'Receber',10.00,'2022-02-15',9),(4,16,'Pagar',100.00,'2022-02-16',3),(5,68,'Receber',2550.00,'2022-02-22',3);
/*!40000 ALTER TABLE `valor_parcial` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vendas`
--

DROP TABLE IF EXISTS `vendas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vendas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `corretor` int NOT NULL,
  `comprador` int NOT NULL,
  `vendedor` int NOT NULL,
  `valor_total` decimal(10,2) NOT NULL,
  `comissao_corretor` decimal(10,2) NOT NULL,
  `comissao_imob` decimal(10,2) NOT NULL,
  `data` date NOT NULL,
  `data_pgto` date NOT NULL,
  `pago` varchar(5) NOT NULL,
  `obs` varchar(255) DEFAULT NULL,
  `usuario` int NOT NULL,
  `imovel` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vendas`
--

LOCK TABLES `vendas` WRITE;
/*!40000 ALTER TABLE `vendas` DISABLE KEYS */;
INSERT INTO `vendas` VALUES (4,3,1,2,400000.00,8000.00,24000.00,'2022-02-21','2022-02-21','Sim','',3,1),(7,9,1,1,200000.00,4000.00,12000.00,'2022-02-22','2022-02-22','Não','',3,2);
/*!40000 ALTER TABLE `vendas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vendedores`
--

DROP TABLE IF EXISTS `vendedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vendedores` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `pessoa` varchar(45) NOT NULL,
  `doc` varchar(45) NOT NULL,
  `email` varchar(45) DEFAULT NULL,
  `endereco` varchar(45) DEFAULT NULL,
  `telefone` varchar(45) NOT NULL,
  `corretor` varchar(45) NOT NULL,
  `data_cadastro` date NOT NULL,
  `data_nasc` date NOT NULL,
  `obs` varchar(1000) NOT NULL,
  `banco` varchar(35) NOT NULL,
  `tipo` varchar(20) NOT NULL,
  `agencia` varchar(10) NOT NULL,
  `conta` varchar(15) NOT NULL,
  `pix` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vendedores`
--

LOCK TABLES `vendedores` WRITE;
/*!40000 ALTER TABLE `vendedores` DISABLE KEYS */;
INSERT INTO `vendedores` VALUES (1,'Empresa X','Jurídica','45.454.545/4548-74','aass@hotmail.com','Rua C','(55) 45454-5545','9','2022-02-08','2022-02-08','fdsfasf','','','','',''),(2,'Marcelo Santos','Física','545.154.545-45','aaaa@hotmail.com','Rua C Numero 150','(48) 45545-554','3','2022-02-08','2000-02-08','fdsfdaf','','','','','');
/*!40000 ALTER TABLE `vendedores` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-06-29 15:00:17
