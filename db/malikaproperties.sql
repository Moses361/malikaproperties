-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: pam
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

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
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(255) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_pass` varchar(255) NOT NULL,
  `admin_image` text NOT NULL,
  `admin_county` text NOT NULL,
  `admin_about` text NOT NULL,
  `admin_contact` varchar(255) NOT NULL,
  `admin_job` varchar(255) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (2,'Ms. Malika','malika@gmail.com','malika','malika.jpg','Kenya',' Change the about description for Malika','+254741261053','System Administrator');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cart` (
  `p_id` int(11) NOT NULL,
  `ip_add` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `p_price` varchar(255) NOT NULL,
  `size` text NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transport_cost` int(12) NOT NULL DEFAULT 0,
  `origin` varchar(50) DEFAULT NULL,
  `destination` varchar(50) DEFAULT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart`
--

LOCK TABLES `cart` WRITE;
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer_orders`
--

DROP TABLE IF EXISTS `customer_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer_orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `due_amount` int(11) NOT NULL,
  `invoice_no` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `size` text NOT NULL,
  `order_date` date NOT NULL,
  `order_status` text NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_orders`
--

LOCK TABLES `customer_orders` WRITE;
/*!40000 ALTER TABLE `customer_orders` DISABLE KEYS */;
INSERT INTO `customer_orders` VALUES (1,3,4200,1754384297,1,'Small','2021-10-25','pending'),(2,3,3800,1527749710,1,'Medium','2021-10-26','pending'),(3,3,4000,1774675043,1,'Medium','2021-10-26','pending'),(4,3,5500,1814567015,1,'','2023-03-02','Complete'),(5,3,20000,1832173183,1,'','2023-03-03','Complete'),(6,2,16000,1645751042,1,'','2023-03-03','pending'),(7,2,8300,1645751042,1,'','2023-03-03','pending'),(8,2,20000,1645751042,1,'','2023-03-03','pending'),(9,2,8000,1645751042,1,'','2023-03-03','Complete'),(10,4,5500,1161203515,1,'','2023-03-03','Complete'),(11,4,8300,51086434,1,'','2023-03-04','Complete');
/*!40000 ALTER TABLE `customer_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(255) NOT NULL,
  `second_name` varchar(255) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `customer_pass` varchar(255) NOT NULL,
  `customer_county` text NOT NULL,
  `customer_city` text NOT NULL,
  `customer_contact` varchar(255) NOT NULL,
  `customer_address` text NOT NULL,
  `customer_image` text NOT NULL,
  `customer_ip` varchar(100) NOT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES (3,'Linea','Devida','devida@gmail.com','devida','Mombasa','','0790364875','Mptwapa','bell-peppers-421087_640.jpg','127.0.0.1'),(4,'Moses','Odhiambo','odhismoses20@gmail.com','1234','Kiambu','','0759930912','P.o Box 126, Kosele.','mose.jpg','::1'),(5,'oses','Odhiambo','odhismoses20@gmail.com','0759930921','vihiga','','0759930912','po box 126 vihiga','mose.jpg','::1'),(6,'Moses ','Odhiambo ','moses@gmail.com','Moseso570','Homabay','','0790102001','po box 126 Kosele','moses.jpg','::1'),(7,'name','name','test@gmail.com','1234','kenya','nairobi','1234','1234','Ganji.png','127.0.0.1'),(8,'pam','testy','will@gmail.com','test','Homabay','nairobi','0790102001','none','chili-664635_640.jpg','::1'),(9,'linky','link','linky@gmail.com','1234','nairobi','nairobi','0790102001','link','bell-peppers-421087_640.jpg','::1'),(10,'Maureen','Mbugua','maureen@gmail.com','1234','Kiambu','nairobi','0768062331','Kiambu','BingWallpaper (24).jpg','::1'),(11,'Faith','Atieno','faith@gmail.com','1234','Kajiado','nairobi','0792071075','Kajiado','BingWallpaper (23).jpg','::1'),(12,'Roony','Odhiambo','ronny@gmail.com','1234','Homabya','nairobi','0759930912','Kiambu','movers.jfif','::1'),(13,'Vivian','Akinyi','vivian@gmail.com','1234','Homabya','nairobi','0703258308','Homabay ','laptops.jpg','::1'),(14,'muteti','john','johniekyalo001@gmail.com','1998000','kitui','nairobi','0112831777','p.o box 52, mwingi','2023-02-26 (1).png','::1'),(15,'Tonny','Victor','tonny@gmail.com','1234','Kiambu','nairobi','0790102001','Nairobi ','download.jpg','::1'),(16,'tony','tony3','tony@gmail.com','1234','kitui','nairobi','0790102001','None','farm 1.jfif','::1'),(17,'edwin','ochieng','edwinochieng@gmail.com','1234','Siaya','nairobi','0746482121','Kiambu','movers.jpg','::1'),(18,'Joseph ','Kariuki','jose@gmail.com','1234','Nyeri','nairobi','0758826552','Nyeri','farm.jfif','::1'),(19,'Kodondi','Shadrack','kodondi@gmail.com','1234','Nairobi','nairobi','0759930912','Juja','admin side.png','::1');
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `subject` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `message` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`message_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` VALUES (1,'muteti','johniekyalo001@gmail.com','feedback','nice services! ');
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quantity` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `order_id` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer` varchar(255) DEFAULT NULL,
  `order_id` varchar(255) DEFAULT NULL,
  `payment_status` varchar(10) NOT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `origin` varchar(100) NOT NULL,
  `destination` varchar(100) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `location` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=121 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (68,'moses@gmail.com','714940','pending','27100','Nairobi','Coast','2023-03-31 21:00:00','Nairobi'),(69,'moses@gmail.com','295482','pending','27100','Rift valley','Nairobi','2023-03-27 21:00:00',NULL),(70,'johniekyalo001@gmail.com','619841','pending','25500','Nairobi','Western','2023-04-05 21:00:00',NULL),(71,'johniekyalo001@gmail.com','314756','pending','25500','Rift valley','Nairobi','2023-03-29 21:00:00',NULL),(72,'moses@gmail.com','824238','pending','60000','Nairobi','Coast','2023-04-04 21:00:00',NULL),(89,'jose@gmail.com','670899','pending','66500','Nairobi','Nairobi','2023-03-29 16:40:15',NULL),(90,'jose@gmail.com','670899','pending','66500','Nairobi','Nairobi','2023-03-29 16:40:15',NULL),(91,'jose@gmail.com','670899','pending','66500','Nairobi','Nairobi','2023-03-29 16:40:16',NULL),(92,'jose@gmail.com','690138','pending','13500','Nairobi','Nairobi','2023-03-29 16:43:48',NULL),(93,'jose@gmail.com','690138','pending','13500','Nairobi','Thika','2023-03-29 16:43:48',NULL),(94,'jose@gmail.com','556681','pending','55000','Nairobi','Nairobi','2023-03-29 18:12:43',NULL),(95,'jose@gmail.com','556681','pending','55000','Nairobi','Nairobi','2023-03-29 18:12:43',NULL),(96,'jose@gmail.com','541780','pending','16000','Nairobi','Lodwar','2023-03-29 18:23:13',NULL),(97,'jose@gmail.com','541780','pending','16000','Nairobi','Kendu Bay','2023-03-29 18:23:14',NULL),(98,'jose@gmail.com','504036','pending','5500','Nairobi','Nairobi','2023-03-29 19:21:07',NULL),(99,'moses@gmail.com','941646','pending','20000','Kendu Bay','Nairobi','2023-03-29 19:31:36',NULL),(100,'jose@gmail.com','760854','pending','5500','Nairobi','Kisumu','2023-03-29 21:00:00',NULL),(101,'jose@gmail.com','797391','pending','5500','Nairobi','Kisumu','2023-03-29 21:00:00',NULL),(102,'jose@gmail.com','957053','Paid','8300','Nairobi','Nairobi','2023-03-29 21:00:00',NULL),(103,'jose@gmail.com','361128','Paid','5500','Kakamega','Nairobi','2023-03-31 21:00:00',NULL),(104,'jose@gmail.com','236304','Paid','5500','Nairobi','Sotik','2023-03-31 21:00:00',NULL),(105,'jose@gmail.com','424038','Cancelled','20000','Nairobi','Nyeri','2023-03-30 21:00:00',NULL),(106,'moses@gmail.com','171670','pending','75390','Nairobi','Kisumu','2023-04-12 21:00:00',NULL),(107,'moses@gmail.com','171670','pending','75390','Nairobi','Kisumu','2023-04-12 21:00:00',NULL),(108,'moses@gmail.com','778279','pending','8066','Nairobi','Malindi','2023-04-12 10:03:33',NULL),(109,'kodondi@gmail.com','855252','pending','32295','Kisumu','Nairobi','2023-04-12 12:22:09',NULL),(110,'odhismoses20@gmail.com','999936','pending','10500','Nairobi','Nairobi','2024-06-22 13:01:21',NULL),(111,'odhismoses20@gmail.com','817265','pending','10500','Nairobi','Nairobi','2024-06-22 13:01:21',NULL),(112,'odhismoses20@gmail.com','501390','pending','10500','Nairobi','Nairobi','2024-06-22 13:01:21',NULL),(113,'odhismoses20@gmail.com','964001','pending','10500','Nairobi','Nairobi','2024-06-22 13:01:21',NULL),(114,'odhismoses20@gmail.com','772056','pending','10500','Nairobi','Nairobi','2024-06-22 13:01:21',NULL),(115,'odhismoses20@gmail.com','232238','pending','145000','Nairobi','Nairobi','2024-07-30 21:00:00',NULL),(116,'odhismoses20@gmail.com','232238','pending','145000','Nairobi','Nairobi','2024-07-20 15:27:15',NULL),(117,'odhismoses20@gmail.com','284506','pending','145000','Nairobi','Nairobi','2024-07-30 21:00:00',NULL),(118,'odhismoses20@gmail.com','284506','pending','145000','Nairobi','Nairobi','2024-07-20 15:27:15',NULL),(119,'odhismoses20@gmail.com','704900','pending','145000','Nairobi','Nairobi','2024-07-30 21:00:00',NULL),(120,'odhismoses20@gmail.com','704900','pending','145000','Nairobi','Nairobi','2024-07-20 15:27:15',NULL);
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_no` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `payment_mode` text NOT NULL,
  `ref_no` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `payment_date` text NOT NULL,
  PRIMARY KEY (`payment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
INSERT INTO `payments` VALUES (1,47548,5500,'Paypall',2147483647,0,'23/04/2023'),(2,47548,20000,'Paypall',2147483647,0,'23/04/2023'),(3,47548,20000,'Paypall',2147483647,0,'23/04/2023'),(4,1358727648,5500,'Paypall',2147483647,0,'23/04/2023'),(5,47548,5500,'Paypall',2147483647,0,'23/04/2023');
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pending_orders`
--

DROP TABLE IF EXISTS `pending_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pending_orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `invoice_no` int(11) NOT NULL,
  `product_id` text NOT NULL,
  `qty` int(11) NOT NULL,
  `size` text NOT NULL,
  `order_status` text NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pending_orders`
--

LOCK TABLES `pending_orders` WRITE;
/*!40000 ALTER TABLE `pending_orders` DISABLE KEYS */;
INSERT INTO `pending_orders` VALUES (10,4,1161203515,'26',1,'','Complete'),(11,4,51086434,'30',1,'','Complete');
/*!40000 ALTER TABLE `pending_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_categories`
--

DROP TABLE IF EXISTS `product_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_categories` (
  `p_cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `p_cat_title` text NOT NULL,
  `p_cat_desc` text NOT NULL,
  PRIMARY KEY (`p_cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_categories`
--

LOCK TABLES `product_categories` WRITE;
/*!40000 ALTER TABLE `product_categories` DISABLE KEYS */;
INSERT INTO `product_categories` VALUES (1,'INTERIOR FEATURES','We move your vehicle from one place to another'),(2,'OUTDOOR SPACE','\r\n\r\n\r\n\r\nOffice relocation refers to the process of moving an existing workplace or business to a new physical location.\r\n\r\n\r\n\r\n\r\n'),(3,'BUILDING FACILITIES','The process of moving and transporting electronic equipment and devices, such as computers, servers, and other electronics, from one location to another.'),(4,'COMMUNITY SERVICES','The process of storing and managing goods or products in a designated facility or storage space until they are ready to be distributed or shipped to their final destination.'),(7,'RECREATIONAL OPTIONS',' Relocating business operations, equipment, and facilities from one location to another,'),(8,'SAFETY AND SECURITY','Changes physical location, including furniture, equipment, and other assets, to a new property.'),(9,'CONVINIENCE SERVICES','Organizing and optimizing a living or working space by removing unnecessary or unwanted items and arranging them');
/*!40000 ALTER TABLE `product_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `p_cat_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `product_title` text NOT NULL,
  `product_img1` text NOT NULL,
  `product_img2` text NOT NULL,
  `product_img3` text NOT NULL,
  `product_price` int(11) DEFAULT NULL,
  `product_keywords` text NOT NULL,
  `product_desc` text NOT NULL,
  `product_label` text NOT NULL,
  `product_sale` int(11) NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (25,2,0,'2024-07-23 05:50:42','Interior Features','interior1.jpg','interior2.jpg','interior3.jpg',50000,'','<p>Affordable to comrades</p>','',0),(26,4,0,'2024-07-23 06:02:11','Outdoor Spaces','outdoor1.jpg','outdoor2.jpg','outdoor3.jpg',80000,'','<p>Affordable</p>','',0),(27,7,0,'2024-07-23 06:14:45','Building Facilities','building1.jpg','building2.jpg','building3.jpg',95000,'','<p>Book and enjoy the service</p>','',0),(28,8,0,'2024-07-23 06:26:07','Community Services','comm1.jpg','comm2.jpg','comm3.jpg',100000,'','<p>This service has discounted cost</p>','',0),(29,3,0,'2024-07-23 06:40:25','Recreational Options ','spa1.jpg','spa2.jpg','spa3.jpg',120000,'','<p>We take good care of your office items</p>','',0),(30,9,0,'2024-07-23 06:51:20','Safety and Security','cctv1.jpg','cctv2.jpg','cctv3.jpg',98000,'','<p>Neat and well organise office office at affordable price</p>','',0),(31,1,0,'2024-07-23 07:02:06','Convenience Services','amenity1.jpg','amenity2.jpg','amenity3.jpg',150000,'','<p>One among the best services you can trust</p>','',0),(33,3,0,'2024-07-23 07:11:13','Eco-friendly Features','eco2.jpg','eco1.jpg','eco3.jpg',85000,'','<p>Experience professional service</p>','',0),(35,7,7,'2024-07-27 03:27:03','Moses House','20230128_141553.jpg','20230320_174609.jpg','20230128_141705.jpg',2000,'Moses House','<p>Moses de dev services</p>\r\n<p>&nbsp;</p>','Moses House',0);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `referals`
--

DROP TABLE IF EXISTS `referals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `referals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `date` varchar(100) DEFAULT NULL,
  `link_code` varchar(50) DEFAULT NULL,
  `initiator` varchar(200) DEFAULT NULL,
  `discount` int(11) DEFAULT NULL,
  `redeemed` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `referals`
--

LOCK TABLES `referals` WRITE;
/*!40000 ALTER TABLE `referals` DISABLE KEYS */;
INSERT INTO `referals` VALUES (1,'colls','12-12-2023','rtyu88','devida@gmail.com',200,0),(2,'test@gmail.com','2023-03-07 09:00:02','test@gmail.com','devida@gmail.com',200,0),(3,'will@gmail.com','2023-03-07 07:24:20','will@gmail.com','moses@gmail.com',200,1),(4,'linky@gmail.com','2023-03-07 07:27:12','linky@gmail.com','moses@gmail.com',200,1),(5,'maureen@gmail.com','2023-03-08 11:08:37','maureen@gmail.com','moses@gmail.com',200,1),(6,'faith@gmail.com','2023-03-08 11:10:55','faith@gmail.com','maureen@gmail.com',200,0),(7,'ronny@gmail.com','2023-03-09 07:15:09','ronny@gmail.com','moses@gmail.com',200,1),(8,'vivian@gmail.com','2023-03-09 19:30:54','vivian@gmail.com','maureen@gmail.com',200,0),(9,'johniekyalo001@gmail.com','2023-03-09 19:42:13','johniekyalo001@gmail.com','odhismose20@gmail.com',200,0),(10,'tonny@gmail.com','2023-03-10 13:30:41','tonny@gmail.com','moses@gmail.com',200,1),(11,'tony@gmail.com','2023-03-12 07:33:32','tony@gmail.com','odhismose20@gmail.com',200,0),(12,'edwinochieng@gmail.com','2023-03-17 15:55:14','edwinochieng@gmail.com','moses@gmail.com',200,1),(13,'jose@gmail.com','2023-03-27 20:05:03','moses@gmail.com','jose@gmail.com',200,1),(14,'kodondi@gmail.com','2023-04-12 14:17:33','kodondi@gmail.com','moses@gmail.com',200,0);
/*!40000 ALTER TABLE `referals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `slider`
--

DROP TABLE IF EXISTS `slider`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `slider` (
  `slide_id` int(11) NOT NULL AUTO_INCREMENT,
  `slide_name` varchar(255) NOT NULL,
  `slide_image` text NOT NULL,
  `slide_url` varchar(255) NOT NULL,
  PRIMARY KEY (`slide_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `slider`
--

LOCK TABLES `slider` WRITE;
/*!40000 ALTER TABLE `slider` DISABLE KEYS */;
INSERT INTO `slider` VALUES (16,'slide1','slide-1.jpg',''),(17,'slide2','slide-2.jpg',''),(18,'slide 3','slide-3.jpg',''),(19,'slide 4','slide-4.jpg','');
/*!40000 ALTER TABLE `slider` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `terms`
--

DROP TABLE IF EXISTS `terms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `terms` (
  `term_id` int(11) NOT NULL AUTO_INCREMENT,
  `term_title` varchar(100) NOT NULL,
  `term_link` varchar(100) NOT NULL,
  `term_desc` text NOT NULL,
  PRIMARY KEY (`term_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `terms`
--

LOCK TABLES `terms` WRITE;
/*!40000 ALTER TABLE `terms` DISABLE KEYS */;
INSERT INTO `terms` VALUES (9,'Rules & Regulations','link_1','<div>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quidem ut itaque quibusdam dolores modi natus. Enim earum laboriosam, quos error voluptatem fugiat eos? In maiores quia eligendi, ea aperiam voluptate.</div>'),(10,'Promo & Regulations','link_2','<div>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quidem ut itaque quibusdam dolores modi natus. Enim earum laboriosam, quos error voluptatem fugiat eos? In maiores quia eligendi, ea aperiam voluptate.</div>'),(11,'Refund Condition Policy','link_3','<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quidem ut itaque quibusdam dolores modi natus. Enim earum laboriosam, quos error voluptatem fugiat eos? In maiores quia eligendi, ea aperiam voluptate.</p>');
/*!40000 ALTER TABLE `terms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `transaction_id` varchar(70) NOT NULL,
  `checked` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
INSERT INTO `transactions` VALUES (3,364950,'ws_CO_30032023101232946114662464',1),(4,289172,'ws_CO_30032023101903945114662464',1),(5,957053,'',1),(6,361128,'',1),(7,236304,'ws_CO_30032023110203044114662464',1),(8,424038,'ws_CO_30032023111235831114662464',1),(9,171670,'',0),(10,778279,'',0),(11,855252,'',0),(12,704900,'',0);
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-07-28  8:51:31
