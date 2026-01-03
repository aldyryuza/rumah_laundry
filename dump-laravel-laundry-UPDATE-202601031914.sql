-- MySQL dump 10.13  Distrib 5.6.23, for Win64 (x86_64)
--
-- Host: localhost    Database: laravel-laundry
-- ------------------------------------------------------
-- Server version	5.6.23

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `invoices`
--

DROP TABLE IF EXISTS `invoices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invoices` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(10) unsigned NOT NULL,
  `invoice_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `invoice_date` date NOT NULL,
  `total_amount` decimal(12,2) NOT NULL,
  `paid_amount` decimal(12,2) NOT NULL DEFAULT '0.00',
  `remaining_amount` decimal(12,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `invoices_invoice_number_unique` (`invoice_number`),
  KEY `invoices_order_id_foreign` (`order_id`),
  CONSTRAINT `invoices_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoices`
--

LOCK TABLES `invoices` WRITE;
/*!40000 ALTER TABLE `invoices` DISABLE KEYS */;
INSERT INTO `invoices` VALUES (10,4,'INV-202601-0001','2026-01-01',10000.00,10000.00,0.00,'2026-01-01 08:42:55','2026-01-01 08:52:36'),(16,12,'INV-202601-0002','2026-01-01',315000.00,315000.00,0.00,'2026-01-01 09:12:59','2026-01-01 09:12:59'),(17,5,'INV-202601-0003','2026-01-01',720000.00,720000.00,0.00,'2026-01-01 09:13:23','2026-01-01 09:13:23'),(18,13,'INV-202601-0004','2026-01-01',615000.00,615000.00,0.00,'2026-01-01 09:28:23','2026-01-01 09:28:23'),(19,11,'INV-202601-0005','2026-01-01',1680000.00,170000.00,1510000.00,'2026-01-01 09:46:15','2026-01-01 09:46:15'),(28,22,'INV-20260103-0001','2026-01-03',510000.00,510000.00,0.00,'2026-01-03 04:01:42','2026-01-03 04:01:42');
/*!40000 ALTER TABLE `invoices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `laundry_packages`
--

DROP TABLE IF EXISTS `laundry_packages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `laundry_packages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `duration_day` int(11) NOT NULL,
  `price_per_kg` decimal(12,2) DEFAULT NULL,
  `price_per_pcs` decimal(12,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `laundry_packages`
--

LOCK TABLES `laundry_packages` WRITE;
/*!40000 ALTER TABLE `laundry_packages` DISABLE KEYS */;
INSERT INTO `laundry_packages` VALUES (1,'Cuci Kering Regular',2,10000.00,1000.00,'2026-01-01 07:28:45','2026-01-01 07:28:45'),(2,'Cuci Kering Kilat',1,15000.00,1500.00,'2026-01-01 07:29:26','2026-01-01 07:29:26'),(3,'Cuci Kering Express',1,20000.00,2000.00,'2026-01-01 07:29:56','2026-01-01 07:29:56');
/*!40000 ALTER TABLE `laundry_packages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `laundry_types`
--

DROP TABLE IF EXISTS `laundry_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `laundry_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `is_weight_based` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `laundry_types_code_unique` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `laundry_types`
--

LOCK TABLES `laundry_types` WRITE;
/*!40000 ALTER TABLE `laundry_types` DISABLE KEYS */;
INSERT INTO `laundry_types` VALUES (1,'CS','Cuci Satuan',0,'2026-01-01 07:20:45','2026-01-01 07:23:16'),(2,'DC','Dry Clean',1,'2026-01-01 07:23:31','2026-01-01 07:23:31'),(3,'CK','Cuci Komplit',1,'2026-01-01 07:24:00','2026-01-01 07:24:00');
/*!40000 ALTER TABLE `laundry_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES ('2014_10_12_000000_create_users_table',1),('2014_10_12_100000_create_password_resets_table',1),('2026_01_01_140015_create_laundry_types_table',2),('2026_01_01_140251_create_laundry_packages_table',2),('2026_01_01_140356_create_orders_table',2),('2026_01_01_140517_create_payments_table',2),('2026_01_01_140618_create_invoices_table',2),('2026_01_01_140708_create_order_items_table',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(10) unsigned NOT NULL,
  `item_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `qty` int(11) NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `subtotal` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_items_order_id_foreign` (`order_id`),
  CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_items`
--

LOCK TABLES `order_items` WRITE;
/*!40000 ALTER TABLE `order_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `no_order` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `laundry_type_id` int(10) unsigned NOT NULL,
  `laundry_package_id` int(10) unsigned NOT NULL,
  `weight` decimal(8,2) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `date_in` date NOT NULL,
  `date_out` date DEFAULT NULL,
  `status` enum('antrian','dikerjakan','selesai_dikerjakan','menunggu_pembayaran','selesai') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'antrian',
  `notes` text COLLATE utf8_unicode_ci,
  `subtotal` decimal(12,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `finished_at` timestamp NULL DEFAULT NULL,
  `paid_at` timestamp NULL DEFAULT NULL,
  `nama_user` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alamat` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `no_hp` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `orders_no_order_unique` (`no_order`),
  KEY `orders_user_id_foreign` (`user_id`),
  KEY `orders_laundry_type_id_foreign` (`laundry_type_id`),
  KEY `orders_laundry_package_id_foreign` (`laundry_package_id`),
  CONSTRAINT `orders_laundry_package_id_foreign` FOREIGN KEY (`laundry_package_id`) REFERENCES `laundry_packages` (`id`),
  CONSTRAINT `orders_laundry_type_id_foreign` FOREIGN KEY (`laundry_type_id`) REFERENCES `laundry_types` (`id`),
  CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (4,'CS-01012026-0001',1,1,1,73.00,10,'2026-01-01','2026-01-03','selesai','Dolores explicabo I',10000.00,'2026-01-01 08:34:10','2026-01-01 08:52:36','2026-01-01 08:42:39','2026-01-01 08:44:50',NULL,NULL,NULL),(5,'DC-01012026-0001',1,2,3,36.00,0,'2026-01-01','2026-01-02','selesai','Nisi non aut dolores',720000.00,'2026-01-01 08:53:04','2026-01-01 08:53:39','2026-01-01 08:53:27',NULL,NULL,NULL,NULL),(6,'CK-01012026-0001',5,3,3,70.00,0,'2026-01-01','2026-01-02','selesai','Maxime pariatur Imp',1400000.00,'2026-01-01 09:04:31','2026-01-01 09:04:51','2026-01-01 09:04:40',NULL,NULL,NULL,NULL),(11,'DC-01012026-0002',5,2,3,84.00,0,'2026-01-01','2026-01-02','menunggu_pembayaran','At dicta impedit de',1680000.00,'2026-01-01 09:09:48','2026-01-01 09:33:28','2026-01-01 09:33:20',NULL,NULL,NULL,NULL),(12,'DC-01012026-0003',5,2,2,21.00,0,'2026-01-01','2026-01-02','selesai','Nostrum placeat asp',315000.00,'2026-01-01 09:10:01','2026-01-01 09:11:02','2026-01-01 09:10:51',NULL,NULL,NULL,NULL),(13,'CK-01012026-0002',5,3,2,41.00,0,'2026-01-01','2026-01-02','selesai','TESTING',615000.00,'2026-01-01 09:26:15','2026-01-01 09:28:17','2026-01-01 09:27:31',NULL,NULL,NULL,NULL),(14,'CS-01012026-0002',6,1,1,4.00,123,'2026-01-01','2026-01-03','antrian','Nisi fugiat dolore r',123000.00,'2026-01-01 10:40:18','2026-01-01 10:40:18',NULL,NULL,NULL,NULL,NULL),(15,'CS-02012026-0001',1,1,1,0.00,2,'2026-01-02','2026-01-04','antrian','cuci yang bersih',2000.00,'2026-01-02 11:34:52','2026-01-02 11:34:52',NULL,NULL,NULL,NULL,NULL),(16,'CS-02012026-0002',1,1,1,0.00,2,'2026-01-02','2026-01-04','antrian','cuci yang bersih',2000.00,'2026-01-02 11:34:52','2026-01-02 11:34:52',NULL,NULL,NULL,NULL,NULL),(17,'CS-02012026-0003',1,1,1,0.00,2,'2026-01-02','2026-01-04','antrian','cuci yang bersih',2000.00,'2026-01-02 11:34:54','2026-01-02 11:34:54',NULL,NULL,NULL,NULL,NULL),(18,'CK-03012026-0001',NULL,3,2,95.00,0,'2026-01-03','2026-01-04','antrian','Dicta duis ipsum ci',1425000.00,'2026-01-03 03:09:34','2026-01-03 03:09:34',NULL,NULL,NULL,'Tempore tempora hic','92347860896'),(19,'DC-03012026-0001',NULL,2,3,85.00,0,'2026-01-03','2026-01-04','antrian','Nulla obcaecati erro',1700000.00,'2026-01-03 03:10:05','2026-01-03 03:10:05',NULL,NULL,NULL,'Incidunt ea a fuga','1231212'),(20,'DC-03012026-0002',NULL,2,2,80.00,0,'2026-01-03','2026-01-03','antrian','Doloremque accusamus',1200000.00,'2026-01-03 03:13:49','2026-01-03 03:13:49',NULL,NULL,'Excepteur cumque ani','Nostrum sapiente quo','90238457'),(21,'DC-03012026-0003',NULL,2,2,80.00,0,'2026-01-03','2026-01-03','antrian','Doloremque accusamus',1200000.00,'2026-01-03 03:15:07','2026-01-03 03:15:07',NULL,NULL,'Excepteur cumque ani','Nostrum sapiente quo','90238457'),(22,'CK-03012026-0002',NULL,3,1,51.00,0,'2026-01-03','2026-01-03','selesai','Est irure est ut eu ',510000.00,'2026-01-03 03:27:50','2026-01-03 03:51:27','2026-01-03 03:28:15',NULL,'Testing','Soluta sint rem tota','Magnam et nulla maxi');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(10) unsigned NOT NULL,
  `payment_date` datetime NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `method` enum('cash','transfer','qris') COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('pending','paid') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'paid',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `payments_order_id_foreign` (`order_id`),
  CONSTRAINT `payments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
INSERT INTO `payments` VALUES (7,4,'2026-01-01 15:42:51',5000.00,'cash','paid','2026-01-01 08:42:51','2026-01-01 08:42:51'),(9,4,'2026-01-01 15:52:36',5000.00,'cash','paid','2026-01-01 08:52:36','2026-01-01 08:52:36'),(10,5,'2026-01-01 15:53:39',720000.00,'cash','paid','2026-01-01 08:53:39','2026-01-01 08:53:39'),(11,6,'2026-01-01 16:04:51',1400000.00,'cash','paid','2026-01-01 09:04:51','2026-01-01 09:04:51'),(12,12,'2026-01-01 16:11:02',315000.00,'cash','paid','2026-01-01 09:11:02','2026-01-01 09:11:02'),(13,13,'2026-01-01 16:27:53',20000.00,'cash','paid','2026-01-01 09:27:53','2026-01-01 09:27:53'),(14,13,'2026-01-01 16:28:17',595000.00,'cash','paid','2026-01-01 09:28:17','2026-01-01 09:28:17'),(15,11,'2026-01-01 16:33:28',70000.00,'cash','paid','2026-01-01 09:33:28','2026-01-01 09:33:28'),(16,11,'2026-01-01 16:37:21',100000.00,'transfer','paid','2026-01-01 09:37:21','2026-01-01 09:37:21'),(17,22,'2026-01-03 10:49:54',10000.00,'cash','paid','2026-01-03 03:49:54','2026-01-03 03:49:54'),(18,22,'2026-01-03 10:51:27',500000.00,'cash','paid','2026-01-03 03:51:27','2026-01-03 03:51:27');
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Pelanggan 1','gecyk@mailinator.com','test','$2y$10$ZYhVzBWoYYVUSa5qlI/gFevEBZ4jwn/ATn1N/C6MIw.LpIwFkUF.i','pelanggan',NULL,NULL,'2026-01-01 07:57:37','+1 (478) 277-4063','Reprehenderit eaque '),(2,'admin','admin@admin','admin','$2y$10$FDQixJiDwtU6BEdMuyKwp.6SgVklB8yfSYgGlIXlKqca3.jKeraF2','admin','OB8YpA9tc55sDVAcZGIuoGMI60ZHPECSMQ3hJfRyELiSQTXwH3I5TtwVJBgm','2026-01-01 05:55:46','2026-01-02 14:24:59','1234','admin'),(5,'pelanggan 2','gafibibiw@mailinator.com','pelanggan2','$2y$10$k0rOqPNu1XQKsGTVMC2tjOiaKZvCam6fPFayK6gXBpit8eshFpBsG','pelanggan',NULL,'2026-01-01 09:04:22','2026-01-01 09:04:22','+1 (969) 975-7569','Doloremque sunt poss'),(6,'pelanggan','topa@mailinator.com','pelanggan','$2y$10$tVdDkZsxqHa.3s9gnGcJBuBewlzUkvSWNltzLOSK6qj68CycrB/EC','pelanggan','xxMZwpU7voZyLcYLbjgVsJJIwehlsRRcczktUMLCNwVaE8X7Wfobir5xkRdE','2026-01-01 10:32:05','2026-01-02 13:51:51','+1 (427) 458-7855','Voluptatibus aliquip'),(7,'owner','vaxodony@mailinator.com','owner','$2y$10$kjAdaj2NtQw4ET43j5q.7OnT0wbSXIoM08JgcPtMCaeGv4tkCs1CS','owner','30GLejrlx0jBkWeqKPzmQaKaLK1frcHQlrJL10M5qEPiZyWDziYzSGlhKaDe','2026-01-02 13:55:22','2026-01-02 14:31:41','+1 (379) 203-8412','Iusto vel ad saepe i');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'laravel-laundry'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-01-03 19:14:19
