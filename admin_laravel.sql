-- MySQL dump 10.13  Distrib 8.0.32, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: time_sheet
-- ------------------------------------------------------
-- Server version	8.0.34

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
-- Table structure for table `accounts`
--

DROP TABLE IF EXISTS `accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `accounts` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `department_id` int DEFAULT NULL,
  `account_no` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `initial_balance` double DEFAULT NULL,
  `total_balance` double NOT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `is_default` tinyint(1) DEFAULT NULL,
  `is_default_debit` tinyint(1) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accounts`
--

LOCK TABLES `accounts` WRITE;
/*!40000 ALTER TABLE `accounts` DISABLE KEYS */;
INSERT INTO `accounts` VALUES (1,3,'11111','Sales Account',1000,1000,'this is first account',0,NULL,1,'2018-12-18 02:58:02','2023-02-10 05:07:54'),(3,2,'21211','Sa',NULL,0,NULL,1,NULL,1,'2018-12-18 02:58:56','2023-07-30 09:01:28'),(4,1,'110223','DRUGS',0,0,NULL,0,0,1,'2022-08-18 01:27:35','2023-02-10 05:37:52'),(5,3,'001','CBCHS NJANGI',0,0,'MONTHLY NJANGI',0,NULL,1,'2022-11-23 16:50:32','2022-11-23 16:51:00'),(6,2,'123456789','rehan cradit',NULL,0,NULL,0,NULL,1,'2023-02-09 01:31:43','2023-07-30 09:01:28'),(7,3,'1234567897982','rehan debit',NULL,0,NULL,0,1,1,'2023-02-09 01:32:20','2023-02-15 06:52:50'),(8,1,'25456','admin',12,12,'SAKLJDIA',0,NULL,0,'2023-02-15 06:14:32','2023-07-30 09:58:16'),(9,1,'kjwqd','dwq',0,0,'dwq',NULL,NULL,0,'2023-03-13 10:26:17','2023-03-13 10:26:30');
/*!40000 ALTER TABLE `accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `currencies`
--

DROP TABLE IF EXISTS `currencies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `currencies` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exchange_rate` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `currencies`
--

LOCK TABLES `currencies` WRITE;
/*!40000 ALTER TABLE `currencies` DISABLE KEYS */;
INSERT INTO `currencies` VALUES (2,'CFA','CFA',1,'2020-11-01 01:29:12','2022-03-27 12:01:18'),(3,'USD','usd',1,'2023-03-23 05:25:03','2023-03-23 05:25:03'),(4,'Pound','&',2,'2023-07-30 09:32:45','2023-07-30 09:32:45'),(5,'last','last',1,'2023-07-30 09:59:43','2023-07-30 09:59:43');
/*!40000 ALTER TABLE `currencies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `departments` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departments`
--

LOCK TABLES `departments` WRITE;
/*!40000 ALTER TABLE `departments` DISABLE KEYS */;
INSERT INTO `departments` VALUES (1,'MUSIC','98239407',1,'2022-07-16 17:05:06','2023-07-30 08:35:10'),(2,'ADMINSTRATION','HAZXJ',0,'2022-07-16 17:05:15','2023-07-30 08:35:20'),(3,'CASUAL WORKERS','83560332',0,'2022-07-16 17:05:31','2023-07-30 08:35:28'),(4,'Rough','13507833',0,'2023-02-15 03:54:09','2023-02-15 04:00:41'),(5,'vorleak','HAZXJ',0,'2023-02-15 04:00:20','2023-02-15 04:00:33'),(6,'cxz','45645',0,'2023-02-27 08:06:25','2023-07-30 08:35:33'),(7,'test','83560333',1,'2023-07-30 09:02:11','2023-07-30 09:02:11'),(8,'test_2','5154',1,'2023-07-30 09:59:08','2023-07-30 09:59:17'),(9,'tifu','83560332',1,'2023-08-23 13:14:56','2023-08-23 13:14:56');
/*!40000 ALTER TABLE `departments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `employees` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employees`
--

LOCK TABLES `employees` WRITE;
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
INSERT INTO `employees` VALUES (1,'Bah Gracious Webngong','spigimentals@gmail.com','9234100609600',1,45,'spigimentalsgmailcom.jpg','456','Bamenda','Cameroon',1,'2022-07-16 17:06:55','2023-08-03 10:16:49'),(2,'Amos Dorko Budi','amosdorko@gmail.com','923410060960',1,46,'amosdorkogmailcom.jpg','UP Station','Bamenda','Cameroon',1,'2022-07-16 17:12:28','2023-07-31 04:06:10'),(3,'Minkhia Saker','pminkhia@gmail.com','923410060960',1,NULL,'pminkhiagmailcom.jpg','Mile Six, Nkwen','Bamenda','Cameroon',1,'2022-07-16 17:21:32','2023-07-31 04:42:11'),(4,'Kimbi Darell','darell@gmail.com','923410060960',1,NULL,'darellgmailcom.jpg','Bambili','Bamenda','Cameroon',0,'2022-07-16 17:23:10','2023-08-03 10:14:08'),(5,'LOBBE JOEL','lobbejoel@gmail.com','923410060960',1,NULL,'lobbejoelgmailcom.jpg','Bambili','Bamenda','Cameroon',0,'2022-07-16 17:25:20','2023-08-03 10:14:08'),(6,'ERNEST MELODY','ernestkimjazz@gmail.com','+237676376925',1,NULL,'ernestkimjazzgmailcom.jpg','Mile 4, Nkwen','Bamenda','Cameroon',0,'2022-07-16 17:27:27','2023-08-03 10:13:56'),(7,'Mbonjo Randy S.','rgroovesman@gmail.com','+237672714660',1,NULL,NULL,'Bambili','Bamenda','Cameroon',0,'2022-07-16 17:28:43','2023-07-31 04:43:00'),(8,'Leslie wirnyu Gwe','lesliewirnyugwe@gmail.com','+237678999976',1,NULL,NULL,'Center Pool','Bamenda','Cameroon',0,'2022-07-16 17:29:42','2023-07-31 04:43:00'),(9,'TATA DAVID NGAH','davidtata05@gmail.com','+237671293749',3,NULL,NULL,'DOUALA','DOUALA','CAMEROON',0,'2022-11-17 17:42:11','2023-07-31 04:43:00'),(10,'Tyrone Gallagher','razimewaju@mailinator.com','+1 (467) 609-9485',1,NULL,'razimewajumailinatorcom.png','Ipsum laboris velit','Aut quisquam id esse','Adipisci aut minima',0,'2023-07-30 09:53:44','2023-07-31 04:43:00'),(11,'Felix Ferguson','rahazivar@mailinator.com','+1 (606) 253-2447',8,NULL,NULL,'Cum eiusmod eos exce','Aut sint minim enim','Velit sit debitis q',0,'2023-08-03 10:14:25','2023-08-03 10:14:46'),(12,'Demetrius Justice','tajoxa@mailinator.com','+1 (156) 225-6136',8,NULL,NULL,'Qui Nam a perspiciat','Ipsam labore lorem v','Sit autem ex dolor',0,'2023-08-03 10:14:31','2023-08-03 10:15:54'),(13,'Evan Leach','pisysyt@mailinator.com','+1 (499) 745-2502',7,NULL,NULL,'Sunt asperiores beat','Autem voluptatum eli','Quo molestiae pariat',0,'2023-08-03 10:14:37','2023-08-03 10:14:46'),(14,'rehan','rehan@hmail.com','923410060960',1,88,NULL,'545',NULL,NULL,1,'2023-08-04 09:02:58','2023-08-04 09:02:58'),(15,'nill','nill@gmail.com','923410060960',1,91,NULL,NULL,NULL,NULL,1,'2023-08-05 02:46:11','2023-08-05 02:46:11');
/*!40000 ALTER TABLE `employees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expense_categories`
--

DROP TABLE IF EXISTS `expense_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `expense_categories` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expense_categories`
--

LOCK TABLES `expense_categories` WRITE;
/*!40000 ALTER TABLE `expense_categories` DISABLE KEYS */;
INSERT INTO `expense_categories` VALUES (1,'23188592','SALARIES',1,'2022-06-20 21:32:39','2022-06-20 21:32:39'),(2,'51330895','OFFICE SUPPLIES',1,'2022-06-20 21:32:54','2022-06-20 21:32:54'),(3,'91527930','PURCHASES',1,'2022-06-20 21:33:11','2022-06-20 21:33:11'),(4,'13935126','TRANSPORTATION',1,'2022-06-20 21:33:24','2022-06-20 21:33:24'),(5,'81909227','OTHERS',1,'2022-06-20 21:33:49','2022-06-20 21:33:49'),(6,'99185431','REPAIRS',1,'2022-06-20 21:48:32','2022-06-20 21:48:32'),(7,'68252840','HOME AND OTHERS',1,'2022-07-12 17:06:50','2022-07-12 17:06:50'),(8,'34279219','Feul',1,'2023-03-30 02:28:45','2023-03-30 02:28:45'),(9,'45684291','test',1,'2023-07-30 09:15:49','2023-07-30 09:15:49'),(10,'69732843','12',1,'2023-07-30 09:45:26','2023-07-30 09:45:34');
/*!40000 ALTER TABLE `expense_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expenses`
--

DROP TABLE IF EXISTS `expenses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `expenses` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `reference_no` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expense_category_id` int NOT NULL,
  `account_id` int NOT NULL,
  `user_id` int NOT NULL,
  `amount` double NOT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expenses`
--

LOCK TABLES `expenses` WRITE;
/*!40000 ALTER TABLE `expenses` DISABLE KEYS */;
INSERT INTO `expenses` VALUES (1,'er-20220620-045248',1,1,41,50000,'Salary, Chantal','2022-06-20 21:52:48','2022-06-20 21:59:35'),(2,'er-20220620-045617',8,6,1,200,NULL,'2022-06-20 21:56:17','2023-03-30 02:35:12'),(3,'er-20220620-081435',1,1,41,80000,'May salary to Caleb','2022-06-21 01:14:35','2022-06-21 01:14:35'),(4,'er-20220712-120730',7,1,1,250000,'Home expenses for July','2022-07-12 17:07:30','2022-07-12 17:07:30'),(5,'er-20220712-120752',7,1,1,280000,'Home Expenses June','2022-07-12 17:07:52','2022-07-12 17:07:52'),(6,'er-20220712-120830',7,1,1,850000,'India Expenses, June','2022-07-12 17:08:30','2022-07-12 17:09:12'),(7,'er-20220717-074128',4,1,1,300001,'Transportation on the 16th, 17th for installation of Sound','2022-07-17 12:41:28','2022-07-17 12:41:28');
/*!40000 ALTER TABLE `expenses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `galleries`
--

DROP TABLE IF EXISTS `galleries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `galleries` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int DEFAULT NULL,
  `type` enum('image','audio','video','link','short') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `galleries`
--

LOCK TABLES `galleries` WRITE;
/*!40000 ALTER TABLE `galleries` DISABLE KEYS */;
INSERT INTO `galleries` VALUES (3,1,'audio','tmpphpaOXigO.mp3','2023-07-30 13:00:06','2023-07-30 13:00:06'),(5,1,'link','https://www.youtube.com/embed/facz93TkBH0?si=3d4RRuebsq8j6KE-','2023-07-31 00:34:03','2023-07-31 00:34:03'),(6,1,'image','tmpphpmzunSr.jpeg','2023-08-03 07:15:39','2023-08-03 07:15:39'),(7,1,'image','tmpphpqR8v6q.jpeg','2023-08-03 07:16:42','2023-08-03 07:16:42'),(8,1,'audio','tmpphpDh64Mp.mp3','2023-08-03 07:57:45','2023-08-03 07:57:45'),(9,1,'short','https://www.youtube.com/embed/N0sEj6Dn2tA','2023-08-03 09:12:55','2023-08-03 09:12:55'),(10,1,'link','https://www.youtube.com/embed/BIpBgesf0cQ','2023-08-04 03:58:01','2023-08-04 03:58:01'),(11,1,'image','tmpphpzbAVwt.jpg','2023-08-04 04:00:18','2023-08-04 04:00:18');
/*!40000 ALTER TABLE `galleries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `general_settings`
--

DROP TABLE IF EXISTS `general_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `general_settings` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `site_title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `site_logo` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_header` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_footer` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_water_mark` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `staff_access` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_format` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `developed_by` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `invoice_format` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` int DEFAULT NULL,
  `theme` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `currency_position` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `vote_price` int DEFAULT NULL,
  `vote_coin` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `general_settings`
--

LOCK TABLES `general_settings` WRITE;
/*!40000 ALTER TABLE `general_settings` DISABLE KEYS */;
INSERT INTO `general_settings` VALUES (1,'BEYOND COMPANY LTD','20221106095123a.png','202211060951.jpeg','202211065123.jpg','202211060923.png','3','own','d/m/Y','Engr. Mbole 675-321-739','standard',1,'default.css','2018-07-06 06:13:11','2023-08-20 04:56:58','prefix',100,100);
/*!40000 ALTER TABLE `general_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hrm_settings`
--

DROP TABLE IF EXISTS `hrm_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `hrm_settings` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `checkin` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `checkout` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hrm_settings`
--

LOCK TABLES `hrm_settings` WRITE;
/*!40000 ALTER TABLE `hrm_settings` DISABLE KEYS */;
INSERT INTO `hrm_settings` VALUES (1,'7:30am','3:30pm','2019-01-02 02:20:08','2022-06-20 23:39:02');
/*!40000 ALTER TABLE `hrm_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `languages`
--

DROP TABLE IF EXISTS `languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `languages` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `languages`
--

LOCK TABLES `languages` WRITE;
/*!40000 ALTER TABLE `languages` DISABLE KEYS */;
INSERT INTO `languages` VALUES (1,'en','2018-07-07 22:59:17','2019-12-24 17:34:20');
/*!40000 ALTER TABLE `languages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=184 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2018_02_17_060412_create_categories_table',1),(4,'2018_02_20_035727_create_brands_table',1),(5,'2018_02_25_100635_create_suppliers_table',1),(6,'2018_02_27_101619_create_warehouse_table',1),(7,'2018_03_03_040448_create_units_table',1),(8,'2018_03_04_041317_create_taxes_table',1),(9,'2018_03_10_061915_create_customer_groups_table',1),(10,'2018_03_10_090534_create_customers_table',1),(11,'2018_03_11_095547_create_billers_table',1),(12,'2018_04_05_054401_create_products_table',1),(13,'2018_04_06_133606_create_purchases_table',1),(14,'2018_04_06_154600_create_product_purchases_table',1),(15,'2018_04_06_154915_create_product_warhouse_table',1),(16,'2018_04_10_085927_create_sales_table',1),(17,'2018_04_10_090133_create_product_sales_table',1),(18,'2018_04_10_090254_create_payments_table',1),(19,'2018_04_10_090341_create_payment_with_cheque_table',1),(20,'2018_04_10_090509_create_payment_with_credit_card_table',1),(21,'2018_04_13_121436_create_quotation_table',1),(22,'2018_04_13_122324_create_product_quotation_table',1),(23,'2018_04_14_121802_create_transfers_table',1),(24,'2018_04_14_121913_create_product_transfer_table',1),(25,'2018_05_13_082847_add_payment_id_and_change_sale_id_to_payments_table',2),(26,'2018_05_13_090906_change_customer_id_to_payment_with_credit_card_table',3),(27,'2018_05_20_054532_create_adjustments_table',4),(28,'2018_05_20_054859_create_product_adjustments_table',4),(29,'2018_05_21_163419_create_returns_table',5),(30,'2018_05_21_163443_create_product_returns_table',5),(31,'2018_06_02_050905_create_roles_table',6),(32,'2018_06_02_073430_add_columns_to_users_table',7),(33,'2018_06_03_053738_create_permission_tables',8),(36,'2018_06_21_063736_create_pos_setting_table',9),(37,'2018_06_21_094155_add_user_id_to_sales_table',10),(38,'2018_06_21_101529_add_user_id_to_purchases_table',11),(39,'2018_06_21_103512_add_user_id_to_transfers_table',12),(40,'2018_06_23_061058_add_user_id_to_quotations_table',13),(41,'2018_06_23_082427_add_is_deleted_to_users_table',14),(42,'2018_06_25_043308_change_email_to_users_table',15),(43,'2018_07_06_115449_create_general_settings_table',16),(44,'2018_07_08_043944_create_languages_table',17),(45,'2018_07_11_102144_add_user_id_to_returns_table',18),(46,'2018_07_11_102334_add_user_id_to_payments_table',18),(47,'2018_07_22_130541_add_digital_to_products_table',19),(49,'2018_07_24_154250_create_deliveries_table',20),(50,'2018_08_16_053336_create_expense_categories_table',21),(51,'2018_08_17_115415_create_expenses_table',22),(55,'2018_08_18_050418_create_gift_cards_table',23),(56,'2018_08_19_063119_create_payment_with_gift_card_table',24),(57,'2018_08_25_042333_create_gift_card_recharges_table',25),(58,'2018_08_25_101354_add_deposit_expense_to_customers_table',26),(59,'2018_08_26_043801_create_deposits_table',27),(60,'2018_09_02_044042_add_keybord_active_to_pos_setting_table',28),(61,'2018_09_09_092713_create_payment_with_paypal_table',29),(62,'2018_09_10_051254_add_currency_to_general_settings_table',30),(63,'2018_10_22_084118_add_biller_and_store_id_to_users_table',31),(65,'2018_10_26_034927_create_coupons_table',32),(66,'2018_10_27_090857_add_coupon_to_sales_table',33),(67,'2018_11_07_070155_add_currency_position_to_general_settings_table',34),(68,'2018_11_19_094650_add_combo_to_products_table',35),(69,'2018_12_09_043712_create_accounts_table',36),(70,'2018_12_17_112253_add_is_default_to_accounts_table',37),(71,'2018_12_19_103941_add_account_id_to_payments_table',38),(72,'2018_12_20_065900_add_account_id_to_expenses_table',39),(73,'2018_12_20_082753_add_account_id_to_returns_table',40),(74,'2018_12_26_064330_create_return_purchases_table',41),(75,'2018_12_26_144210_create_purchase_product_return_table',42),(76,'2018_12_26_144708_create_purchase_product_return_table',43),(77,'2018_12_27_110018_create_departments_table',44),(78,'2018_12_30_054844_create_employees_table',45),(79,'2018_12_31_125210_create_payrolls_table',46),(80,'2018_12_31_150446_add_department_id_to_employees_table',47),(81,'2019_01_01_062708_add_user_id_to_expenses_table',48),(82,'2019_01_02_075644_create_hrm_settings_table',49),(83,'2019_01_02_090334_create_attendances_table',50),(84,'2019_01_27_160956_add_three_columns_to_general_settings_table',51),(85,'2019_02_15_183303_create_stock_counts_table',52),(86,'2019_02_17_101604_add_is_adjusted_to_stock_counts_table',53),(87,'2019_04_13_101707_add_tax_no_to_customers_table',54),(89,'2019_10_14_111455_create_holidays_table',55),(90,'2019_11_13_145619_add_is_variant_to_products_table',56),(91,'2019_11_13_150206_create_product_variants_table',57),(92,'2019_11_13_153828_create_variants_table',57),(93,'2019_11_25_134041_add_qty_to_product_variants_table',58),(94,'2019_11_25_134922_add_variant_id_to_product_purchases_table',58),(95,'2019_11_25_145341_add_variant_id_to_product_warehouse_table',58),(96,'2019_11_29_182201_add_variant_id_to_product_sales_table',59),(97,'2019_12_04_121311_add_variant_id_to_product_quotation_table',60),(98,'2019_12_05_123802_add_variant_id_to_product_transfer_table',61),(100,'2019_12_08_114954_add_variant_id_to_product_returns_table',62),(101,'2019_12_08_203146_add_variant_id_to_purchase_product_return_table',63),(102,'2020_02_28_103340_create_money_transfers_table',64),(103,'2020_07_01_193151_add_image_to_categories_table',65),(105,'2020_09_26_130426_add_user_id_to_deliveries_table',66),(107,'2020_10_11_125457_create_cash_registers_table',67),(108,'2020_10_13_155019_add_cash_register_id_to_sales_table',68),(109,'2020_10_13_172624_add_cash_register_id_to_returns_table',69),(110,'2020_10_17_212338_add_cash_register_id_to_payments_table',70),(111,'2020_10_18_124200_add_cash_register_id_to_expenses_table',71),(112,'2020_10_21_121632_add_developed_by_to_general_settings_table',72),(113,'2019_08_19_000000_create_failed_jobs_table',73),(114,'2020_10_30_135557_create_notifications_table',73),(115,'2020_11_01_044954_create_currencies_table',74),(116,'2020_11_01_140736_add_price_to_product_warehouse_table',75),(117,'2020_11_02_050633_add_is_diff_price_to_products_table',76),(118,'2020_11_09_055222_add_user_id_to_customers_table',77),(119,'2020_11_17_054806_add_invoice_format_to_general_settings_table',78),(120,'2021_02_10_074859_add_variant_id_to_product_adjustments_table',79),(121,'2021_03_07_093606_create_product_batches_table',80),(122,'2021_03_07_093759_add_product_batch_id_to_product_warehouse_table',80),(123,'2021_03_07_093900_add_product_batch_id_to_product_purchases_table',80),(124,'2021_03_11_132603_add_product_batch_id_to_product_sales_table',81),(127,'2021_03_25_125421_add_is_batch_to_products_table',82),(128,'2021_05_19_120127_add_product_batch_id_to_product_returns_table',82),(130,'2021_05_22_105611_add_product_batch_id_to_purchase_product_return_table',83),(131,'2021_05_23_124848_add_product_batch_id_to_product_transfer_table',84),(132,'2021_05_26_153106_add_product_batch_id_to_product_quotation_table',85),(133,'2021_06_08_213007_create_reward_point_settings_table',86),(134,'2021_06_16_104155_add_points_to_customers_table',87),(135,'2021_06_17_101057_add_used_points_to_payments_table',88),(137,'2023_03_16_084648_create_donors_table',89),(140,'2023_03_16_084707_create_asset_categories_table',90),(141,'2023_03_16_084635_create_regions_table',91),(142,'2023_03_17_060607_create_stations_table',91),(149,'2023_03_16_084718_create_assets_table',92),(150,'2023_03_22_160915_create_image_libraries_table',93),(155,'2023_03_30_071415_create_asset_expenses_table',94),(156,'2023_04_01_145330_create_disposes_table',95),(158,'2023_04_05_154939_create_tranfers_table',96),(159,'2023_04_10_125119_add_column_in_asset_expense',97),(160,'2023_04_13_084706_create_asset_sales_table',98),(161,'2023_04_13_084857_create_asset_sale_details_table',98),(162,'2023_04_17_104345_add-column-in-asset-transfer',99),(163,'2023_04_17_152516_add-column-in-asset-sales',100),(164,'2023_04_17_154947_add-column-in-asset-sale_details',101),(165,'2023_05_07_083315_add_column_in_product_table',102),(166,'2023_05_14_085448_create_bookings_table',103),(167,'2023_05_14_085516_create_booking_products_table',103),(168,'2023_05_14_140910_add_column_in_payments',104),(170,'2023_05_18_053558_insert-in-permission-table',105),(171,'2023_06_01_182050_add_column_in_booking_product',106),(172,'2023_06_28_151008_add_booking_duration_column_in_booking_product',107),(174,'2023_07_07_111837_create_letter_categories_table',108),(176,'2023_07_07_092150_create_letters_table',109),(177,'2023_07_07_111857_create_letter_templates_table',109),(178,'2023_07_08_043657_add_column_in_general_setting',110),(179,'2023_07_08_095354_add_columns_in_users',111),(180,'2023_07_26_123103_add_column_in_user_table',112),(181,'2023_07_31_170225_create_votes_table',113),(182,'2023_08_02_130022_create_judges_table',114),(183,'2023_08_04_113116_create_coins_table',115);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notifications` (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint unsigned NOT NULL,
  `data` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` VALUES ('50d5a341-5d32-4069-986f-448de6684ff2','App\\Notifications\\SendNotification','App\\User',48,'{\"message\":\"test\"}',NULL,'2023-07-30 09:37:56','2023-07-30 09:37:56');
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=199 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (171,'expenses-index','web','2023-07-30 12:13:14','2023-07-30 12:13:14'),(172,'expenses-add','web','2023-07-30 12:13:14','2023-07-30 12:13:14'),(173,'expenses-edit','web','2023-07-30 12:13:14','2023-07-30 12:13:14'),(174,'expenses-delete','web','2023-07-30 12:13:14','2023-07-30 12:13:14'),(175,'account-index','web','2023-07-30 12:13:14','2023-07-30 12:13:14'),(176,'department','web','2023-07-30 12:13:14','2023-07-30 12:13:14'),(177,'employees-index','web','2023-07-30 12:13:15','2023-07-30 12:13:15'),(178,'employees-add','web','2023-07-30 12:13:15','2023-07-30 12:13:15'),(179,'employees-edit','web','2023-07-30 12:13:15','2023-07-30 12:13:15'),(180,'employees-delete','web','2023-07-30 12:13:15','2023-07-30 12:13:15'),(181,'users-index','web','2023-07-30 12:13:15','2023-07-30 12:13:15'),(182,'users-add','web','2023-07-30 12:13:15','2023-07-30 12:13:15'),(183,'users-edit','web','2023-07-30 12:13:15','2023-07-30 12:13:15'),(184,'users-delete','web','2023-07-30 12:13:15','2023-07-30 12:13:15'),(185,'general_setting','web','2023-07-30 12:13:15','2023-07-30 12:13:15'),(186,'dashboard','web','2023-07-30 12:13:15','2023-07-30 12:13:15'),(187,'send_notification','web','2023-07-30 12:13:15','2023-07-30 12:13:15'),(188,'currency','web','2023-07-30 12:13:15','2023-07-30 12:13:15');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` int unsigned NOT NULL,
  `role_id` int unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_has_permissions`
--

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
INSERT INTO `role_has_permissions` VALUES (171,1),(172,1),(173,1),(174,1),(175,1),(176,1),(177,1),(178,1),(179,1),(180,1),(181,1),(182,1),(183,1),(184,1),(185,1),(186,1),(187,1),(188,1),(177,2);
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `guard_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Admin','admin can access all data...','web',1,'2018-06-01 23:46:44','2018-06-02 23:13:05'),(2,'User','user','web',1,'2018-10-22 02:38:13','2023-08-23 13:15:46'),(3,'Voter','Voter','web',0,'2023-07-31 04:03:39','2023-08-23 13:15:31'),(4,'Instrumentalist','Instrumentalist','web',0,'2023-08-04 04:02:47','2023-08-23 13:15:21');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` int NOT NULL,
  `biller_id` int DEFAULT NULL,
  `warehouse_id` int DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `sign` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `stemp` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `otp` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp_time` datetime DEFAULT NULL,
  `otp_verify` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','rehanfaby36@gmail.com','$2y$10$FZS2yL2FRWU1NwzNXOCFG.Qmvuob2itkTpWVzTEIFOkklXqHA6i4K','wnsHwRV1J8nmbBm1My752BYCs0RCqOQ2ROdCC5kwm87pRpYlgwb7rMKQGN76','+923410060960','faby developers',1,NULL,NULL,1,0,'2018-06-02 03:24:15','2023-08-23 13:14:33','tmpphp0kuDTD.png','tmpphpraMNqE.png',NULL,NULL,0),(48,'music','rehanfaby36@gmail.com','$2y$10$1KX4Oo53UTh8rwxRcp105OQcYZgXwVZLnz5BvIwMStU5upCER5yh.',NULL,'+9234100609602','faby developers',2,NULL,NULL,0,1,'2022-12-10 06:24:52','2023-08-23 13:12:31',NULL,NULL,NULL,NULL,0),(81,'+237','user@gmail.com','$2y$10$W57ePANSUcX4maSAaAW8L.ef6Wp/WhpB3JO2i3ZSa9s.0Yp8o3GfG',NULL,'+237',NULL,3,NULL,NULL,0,1,'2023-08-04 05:45:06','2023-08-23 13:12:31',NULL,NULL,NULL,NULL,0),(82,'9234100609600','user@gmail.com','$2y$10$BqPTwnm8En/bVBLLaxJDVudhizFiv7q46rPpqeWiPC0lSmR2Y.6lG',NULL,'9234100609605',NULL,3,NULL,NULL,0,1,'2023-08-04 05:45:26','2023-08-23 13:12:31',NULL,NULL,NULL,NULL,0),(83,'+237675321739','user@gmail.com','$2y$10$8xGsqAc7IPm0occRhrnKX.qcp7Q0yajJD4yIg8jxi3jBk8NJQWqUq',NULL,'923410060960',NULL,3,NULL,NULL,0,1,'2023-08-04 08:02:01','2023-08-23 13:12:31',NULL,NULL,NULL,NULL,0),(87,'923410060960','user@gmail.com','$2y$10$4971VoSFKJtt19HSV3LTc.QCHyOE2SjS87DVjRWEsKbyuZ/lTu3oK',NULL,'923410060960',NULL,3,NULL,NULL,0,1,'2023-08-04 08:46:10','2023-08-23 13:12:31',NULL,NULL,NULL,NULL,0),(88,'rehan','rehan@hmail.com','$2y$10$EPHcilTmJXdKJpAcd.YmTOLOvJuhlY0XJcofoniRTdW0YMs.zXFEK',NULL,'923410060960',NULL,2,NULL,NULL,0,1,'2023-08-04 09:02:57','2023-08-23 13:12:31',NULL,NULL,NULL,NULL,0),(89,'123456789','admin@admin.com','$2y$10$KXQchXVNHSkXeESzd.MWMOHvAcRg3OQT97hoMqM2.uQRJ81AcjkTq',NULL,'+237675321739',NULL,3,NULL,NULL,0,1,'2023-08-05 02:30:03','2023-08-23 13:12:31',NULL,NULL,NULL,NULL,0),(90,'9234100609604','user@gmail.com','$2y$10$RJbANF35WUC1YgEhMqPKKOV97dHDbWEg36niC95fOBBHdRr1ZWWPS',NULL,'9234100609604',NULL,3,NULL,NULL,0,1,'2023-08-05 02:37:46','2023-08-23 13:12:31',NULL,NULL,NULL,NULL,0),(91,'nill','nill@gmail.com','$2y$10$GJWI9bXRPgAiAmOpxYk5JeWDj4pPK6WxhItsh26RP4ta4NbZ7Nwxq',NULL,'923410060960',NULL,2,NULL,NULL,0,1,'2023-08-05 02:46:09','2023-08-23 13:12:31',NULL,NULL,NULL,NULL,0),(92,'1546','user@gmail.com','$2y$10$flOO0GoucW/sKN68NayAueJkG9WL7j4jG34rM9gJd6vrWocVza9xm',NULL,'1546',NULL,3,NULL,NULL,0,1,'2023-08-05 03:12:43','2023-08-23 13:12:44',NULL,NULL,NULL,NULL,0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-08-23 22:26:31
