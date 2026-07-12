-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: premiumprint_db
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
-- Current Database: `premiumprint_db`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `premiumprint_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `premiumprint_db`;

--
-- Table structure for table `admin_users`
--

DROP TABLE IF EXISTS `admin_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'admin',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_users`
--

LOCK TABLES `admin_users` WRITE;
/*!40000 ALTER TABLE `admin_users` DISABLE KEYS */;
INSERT INTO `admin_users` VALUES (6,'bilal','hello','bilal','bilal@gmail.com','admin','2026-04-24 02:29:11'),(8,' intikhab','aaf4c61ddcc5e8a2dabede0f3b482cd9aea9434d','intikhab','intikhab@gmail.com','admin','2026-07-03 21:57:31'),(11,' bilal','aaf4c61ddcc5e8a2dabede0f3b482cd9aea9434d','bilal','bilal@gmail.com','admin','2026-07-03 22:10:53');
/*!40000 ALTER TABLE `admin_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users_table` (`id`),
  CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart`
--

LOCK TABLES `cart` WRITE;
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
INSERT INTO `cart` VALUES (28,10,2,1,'2026-05-09 15:08:34');
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(100) NOT NULL,
  `category_image` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (3,'Over The Counter (OTC)','1777085046_otc.jpg','Non-prescription medicines for everyday health needs.','2026-04-25 02:44:06'),(5,'Pain Relief','1777085955_pain rELIF (2).jpg','Fast-acting solutions for headaches, body pain, and inflammation.','2026-04-25 02:59:15'),(6,'Cold & Flu','1777085977_flu.jpg','Effective treatments for cough, cold, and flu symptoms.','2026-04-25 02:59:37'),(7,'Allergy Medicines','1777086139_Allergy Medicines.jpg','Relief from allergies, sneezing, and skin reactions.','2026-04-25 03:02:19'),(8,'Digestive Care ','1777172452_Daigestive Care.png','Products for stomach issues, acidity, and digestion support.','2026-04-26 03:00:52'),(9,'Diabetes Care','1777172495_Daibatic Care.png','Medicines and supplies to manage blood sugar levels.','2026-04-26 03:01:35'),(10,'Heart & Blood Pressure ','1777172523_Heart & Blood Pressure.png','Treatments for heart health and blood pressure control.','2026-04-26 03:02:03'),(11,'Skin Care','1777172549_Skin Care.png','Products to keep your skin healthy, fresh, and glowing.','2026-04-26 03:02:29'),(12,'Hair Care ','1777172582_Hair Care.png','Solutions for strong, shiny, and healthy hair.','2026-04-26 03:03:02'),(13,'Oral Care ','1777172629_Oral Care (2).png','Essentials for dental hygiene and fresh breath.','2026-04-26 03:03:49'),(14,'Bath & Body ','1777172651_Bath & Body.png','Daily care products for hygiene and body wellness.','2026-04-26 03:04:11'),(15,'Baby Products ','1777172673_Baby Products.png','Safe and gentle essentials for baby care.','2026-04-26 03:04:33');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES (2,'DAWOOD BHAI','2026-06-26 21:03:32'),(3,'ZAHID','2026-06-26 21:03:38'),(4,'AMIN','2026-06-26 21:03:47'),(5,'ASIF','2026-06-26 21:04:30'),(6,'ASHRAF BHAI','2026-06-27 20:11:26');
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expenses`
--

DROP TABLE IF EXISTS `expenses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `expenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `expense_date` date NOT NULL,
  `expense_category` varchar(100) NOT NULL,
  `expense_title` varchar(255) NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expenses`
--

LOCK TABLES `expenses` WRITE;
/*!40000 ALTER TABLE `expenses` DISABLE KEYS */;
/*!40000 ALTER TABLE `expenses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_name` varchar(255) NOT NULL,
  `sample_no` varchar(100) NOT NULL,
  `job_date` date DEFAULT NULL,
  `customer_name` varchar(255) NOT NULL,
  `worker_name` varchar(255) NOT NULL,
  `machine` varchar(255) NOT NULL,
  `job_qty` int(11) NOT NULL,
  `job_color` varchar(100) NOT NULL,
  `total_qty` int(11) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
INSERT INTO `jobs` VALUES (4,'LETTER HEAD  3 COLOR JOB','56','2026-07-12','AMIN','INTIKHAB','GTO ',4000,'3',12000,5000.00,'2026-07-12 09:37:07');
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `service_type` varchar(100) DEFAULT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` VALUES (1,11,'Bilal Ahmed','bilalahmed3273632@gmail.com','03353278632','feedback','bnsdvjkbjvbjklbvbjbds;avd\r\n','2026-05-08 16:57:30');
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
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `product_price` decimal(10,2) DEFAULT NULL,
  `qty` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_items`
--

LOCK TABLES `order_items` WRITE;
/*!40000 ALTER TABLE `order_items` DISABLE KEYS */;
INSERT INTO `order_items` VALUES (1,0,1,'Ketoprofen Gel',300.00,1,'2026-05-07 15:08:13'),(2,0,4,'Nasal Spray',350.00,1,'2026-05-07 15:08:13'),(3,0,6,'Oral Rehydration Salts',50.00,1,'2026-05-07 15:09:44'),(4,0,3,'Diclofenac Sodium 50mg',220.00,3,'2026-05-07 15:09:44'),(5,0,7,'Antacid Suspension',300.00,1,'2026-05-07 15:09:44'),(6,0,4,'Nasal Spray',350.00,1,'2026-05-07 15:09:44');
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
  `user_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `postal_code` varchar(20) DEFAULT NULL,
  `payment_method` varchar(50) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_status` varchar(50) DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,10,'bilal','03353278632','hello@gamil.com','karachi','bscdhiabcba gacui uiauiv au vgdasi ','72250','cod',650.00,650.00,'Pending','2026-05-07 15:08:13'),(2,11,'gello','0303030303','gello@gmail.com','karachi','navjklhuvuo ha vhauhvauv uhavhuasv ','7250','cod',1360.00,1360.00,'Pending','2026-05-07 15:09:44');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `payment_date` date NOT NULL,
  `payment_method` varchar(50) DEFAULT 'Cash',
  `remarks` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`),
  CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
INSERT INTO `payments` VALUES (3,4,2000.00,'2026-06-15','Cash','FOR BILL PAYMENT','2026-07-12 09:38:45');
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prescriptions`
--

DROP TABLE IF EXISTS `prescriptions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prescriptions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `patient_name` varchar(255) DEFAULT NULL,
  `doctor_name` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `prescription_file` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prescriptions`
--

LOCK TABLES `prescriptions` WRITE;
/*!40000 ALTER TABLE `prescriptions` DISABLE KEYS */;
INSERT INTO `prescriptions` VALUES (1,11,'hello','gello','bvbksdvbkabvbvbvh hvoha vaviuhv','1778215363_Screenshot 2026-01-16 011732.png','2026-05-08 04:42:43');
/*!40000 ALTER TABLE `prescriptions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) NOT NULL,
  `brand_name` varchar(255) DEFAULT NULL,
  `generic_name` varchar(255) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) DEFAULT 0,
  `rating` decimal(2,1) DEFAULT 0.0,
  `description` text DEFAULT NULL,
  `additional_info` text DEFAULT NULL,
  `usage_and_safety` text DEFAULT NULL,
  `warnings` text DEFAULT NULL,
  `precautions` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'Ketoprofen Gel','Fastum Gel','Ketoprofen','Pain Relief','1777589635_Gemini_Generated_Image_guptnpguptnpgupt.png',300.00,10000,4.4,'Ketoprofen Gel is used for topical pain relief. It reduces muscle pain, joint pain, and inflammation. Absorbs quickly into the skin. Provides targeted relief without oral medication. Useful in sports injuries. Improves flexibility and comfort.','External use only. Apply on affected area. Store at room temperature. Keep tube tightly closed. Avoid contact with eyes. Check expiry date.','Apply 2–3 times daily. Massage gently into skin. Do not apply on wounds. Wash hands after use. Use as directed. Avoid overuse.','Do not apply on broken skin. May cause irritation. Avoid sun exposure on applied area. Keep away from children. Stop if rash occurs. Consult doctor if needed.','Use carefully on sensitive skin. Avoid contact with eyes. Check allergies. Store properly. Follow instructions. Use responsibly.','2026-04-30 22:53:55'),(2,'Naproxen 250mg','Naprosyn','Naproxen','Pain Relief','1777590688_Gemini_Generated_Image_er3yxver3yxver3y.png',260.00,10000,4.5,'Naproxen is used to treat pain and inflammation effectively. It is helpful in arthritis, muscle pain, and menstrual cramps. Provides long-lasting pain relief compared to other NSAIDs. Reduces swelling and stiffness. Improves daily activity comfort. Suitable for short-term use.','Tablet form available. Take with food to avoid irritation. Store below room temperature. Keep away from moisture. Check packaging instructions. Do not use expired medicine.','Take 1 tablet every 8–12 hours. Do not exceed recommended dosage. Drink water with medicine. Follow doctor advice. Use short-term only. Stop if side effects appear.','May cause stomach ulcers. Avoid in heart patients without advice. Not suitable for kidney issues. Avoid alcohol. Consult doctor if symptoms persist. Risk of bleeding with misuse.','Use carefully in elderly. Consult during pregnancy. Avoid mixing NSAIDs. Monitor condition. Check allergies. Follow dosage strictly.','2026-04-30 23:11:28'),(3,'Diclofenac Sodium 50mg','Voltaren','Diclofenac','Pain Relief','1777590759_Gemini_Generated_Image_shuff5shuff5shuf.png',220.00,10000,4.6,'Diclofenac Sodium is a strong anti-inflammatory medicine used for pain relief. It helps reduce swelling, stiffness, and joint discomfort. Commonly used in arthritis and muscle injuries. Provides fast and effective relief from moderate pain. Improves movement and flexibility. Suitable for short-term pain management.','Available in tablet and gel form. Best taken after meals. Store in a cool and dry place. Avoid long-term use. Keep medicine sealed properly. Check expiry before use.','Take 1 tablet 2–3 times daily. Follow doctor instructions. Do not exceed recommended dose. Drink sufficient water. Use for short duration. Stop if irritation occurs.','May cause stomach irritation. Avoid in patients with ulcers. Not suitable for kidney disease. Avoid alcohol consumption. Consult doctor if pain persists. May interact with other drugs.','Use lowest effective dose. Consult doctor if pregnant. Avoid combining NSAIDs. Check for allergies. Monitor health condition. Keep away from children.','2026-04-30 23:12:39'),(4,'Nasal Spray','Otrivin','Xylometazoline','Cold & Flu','1777590842_Gemini_Generated_Image_lixm99lixm99lixm.png',350.00,10000,4.6,'Nasal Spray provides quick relief from nasal congestion. It helps open blocked nasal passages. Effective during cold and sinus issues. Works within minutes. Improves breathing comfort. Suitable for short-term use.','Easy spray application. Portable bottle. Store below room temperature. Keep clean nozzle. Avoid sharing. Check expiry.','Use 1–2 sprays per nostril. Do not overuse. Use for limited days. Follow instructions. Clean after use. Use as directed.','Overuse may worsen congestion. Not for long-term use. Avoid in children without advice. Consult doctor if needed. Stop if irritation occurs. Keep out of reach.','Use correctly. Avoid frequent use. Check sensitivity. Store properly. Follow label. Use responsibly.','2026-04-30 23:14:02'),(5,'Cough Syrup','Benadryl','Diphenhydramine','Cold & Flu','1777590912_Gemini_Generated_Image_bkvjoabkvjoabkvj.png',220.00,10000,4.3,'Cough Syrup helps relieve dry cough and throat irritation. It soothes the throat and reduces coughing. Provides comfort during cold and flu. Works quickly for symptom relief. Suitable for short-term use. Improves sleep quality.','Liquid form for easy use. Shake before use. Store in cool place. Keep tightly closed. Avoid sunlight. Check expiry.','Take 1–2 teaspoons daily. Follow doctor advice. Do not exceed dose. Use measuring cap. Drink fluids. Use as needed.','May cause drowsiness. Avoid driving. Do not mix alcohol. Not for young children. Consult doctor if needed. Stop if side effects occur.','Use carefully. Follow dosage. Check allergies. Store safely. Avoid misuse. Keep away from children.','2026-04-30 23:15:13'),(6,'Oral Rehydration Salts','ORS','Electrolyte Solution','Over The Counter (OTC)','1777590981_Gemini_Generated_Image_qk1bqnqk1bqnqk1b.png',50.00,10000,4.8,'ORS is used to treat dehydration caused by diarrhea and vomiting. It restores essential electrolytes in the body. Helps maintain fluid balance effectively. Widely recommended in heat and illness. Safe for children and adults. Essential for hydration recovery.','Powder form to mix with water. Easy to prepare. Store in dry place. Use fresh solution. Do not store mixed solution long. Check instructions.','Mix in clean water. Drink frequently in small amounts. Use as needed. Safe for all ages. Follow medical advice. Maintain hygiene.','Do not mix in dirty water. Avoid excess concentration. Consult doctor if severe dehydration. Keep out of children’s reach. Use properly. Discard unused solution.','Prepare correctly. Use clean water. Store properly. Follow guidelines. Avoid contamination. Monitor condition.','2026-04-30 23:16:21'),(7,'Antacid Suspension','Gaviscon','Aluminum Hydroxide + Magnesium','Over The Counter (OTC)','1777591209_Gemini_Generated_Image_xlkwapxlkwapxlkw.png',300.00,10000,4.5,'Antacid Suspension provides quick relief from acidity and heartburn. It neutralizes stomach acid effectively. Helps reduce bloating and indigestion discomfort. Acts fast for instant relief. Suitable for occasional digestive issues. Improves stomach comfort.','Liquid form for easy consumption. Shake well before use. Store in cool place. Keep bottle tightly closed. Check expiry date. Avoid contamination.','Take 2–3 teaspoons after meals. Use as directed. Do not overdose. Safe for short-term use. Drink water. Follow instructions.','Overuse may cause imbalance. Consult doctor if symptoms persist. Avoid in kidney issues. Not for long-term use. Keep out of children’s reach. Stop if discomfort increases.','Use within limits. Consult doctor if pregnant. Avoid mixing medicines. Check allergies. Store properly. Follow dosage.','2026-04-30 23:20:09'),(8,'Ibuprofen Tablets 200mg','Brufen','Ibuprofen','Over The Counter (OTC)','1777591334_Gemini_Generated_Image_w28fhkw28fhkw28f.png',180.00,10000,4.4,'Ibuprofen Tablets are used for relief of pain, inflammation, and fever. They are effective for headaches, body aches, and joint pain. This medicine works by reducing inflammation in the body. Provides longer-lasting relief compared to simple painkillers. Commonly used for short-term pain management. Helps improve comfort and mobility.','Best taken after meals. Store below room temperature. Keep away from sunlight. Available without prescription. Avoid long-term use. Check expiry date.','Take 1 tablet every 6–8 hours. Do not exceed recommended dose. Take with food or milk. Drink plenty of water. Follow doctor advice if needed. Stop if side effects occur.','May cause stomach irritation. Avoid in kidney disease. Not suitable for ulcers. Avoid alcohol consumption. May interact with medicines. Seek help if symptoms persist.','Use lowest effective dose. Consult doctor if pregnant. Avoid mixing NSAIDs. Check allergies. Monitor usage. Keep away from children.','2026-04-30 23:22:14'),(9,'Multivitamin Tablets','Centrum','Multivitamins','Over The Counter (OTC)','1777591399_Gemini_Generated_Image_fqvcscfqvcscfqvc.png',600.00,10000,4.7,'Multivitamin Tablets provide essential nutrients for daily health support. They help improve energy levels and immune function. Useful in vitamin deficiencies and weakness. Supports overall body performance and metabolism. Promotes healthy skin, bones, and organs. Ideal for adults with busy lifestyles.','Contains a blend of vitamins and minerals. Take regularly for best results. Store in a cool environment. Keep bottle tightly closed. Avoid moisture exposure. Check label for ingredients.','Take 1 tablet daily with food. Do not exceed daily dose. Drink water after intake. Follow doctor advice if needed. Use consistently for benefits. Safe for adults.','Do not overdose. May interact with other supplements. Not for children unless prescribed. Avoid if allergic to ingredients. Consult doctor if pregnant. Stop if adverse effects occur.','Maintain balanced diet. Use under guidance if needed. Check ingredients carefully. Store away from heat. Keep out of reach of children. Follow dosage strictly.','2026-04-30 23:23:19'),(10,'Vitamin C Tablets 500mg','Redoxon','Ascorbic Acid','Over The Counter (OTC)','1777591466_Gemini_Generated_Image_lsapzdlsapzdlsap.png',250.00,10000,4.6,'Vitamin C Tablets help boost immunity and overall health. They support the body in fighting infections and fatigue. Useful in cold, flu, and general weakness conditions. Acts as a strong antioxidant for body protection. Improves skin health and healing process. Suitable for daily supplementation.','Available in chewable and effervescent forms. Easy to consume with pleasant taste. Store in a dry place. Keep container tightly closed. Protect from humidity. Check expiry before use.','Take 1 tablet daily after meals. Dissolve in water if effervescent. Do not exceed recommended dose. Drink sufficient water. Safe for regular use. Follow label instructions.','Excess intake may cause stomach upset. Avoid very high doses. Consult doctor if pregnant. Not a substitute for balanced diet. Keep out of children’s reach. Stop use if discomfort occurs.','Use within recommended limits. Consult doctor if on medication. Avoid overdose. Check allergies before use. Store safely. Follow instructions carefully.','2026-04-30 23:24:26'),(11,'Aspirin Tablets 75mg','Disprin','Aspirin','Over The Counter (OTC)','1777591539_Gemini_Generated_Image_7reqj77reqj77req.png',90.00,10000,4.3,'Aspirin Tablets 75mg are commonly used for pain relief and cardiovascular support. They help reduce mild pain, fever, and inflammation effectively. This medicine also prevents blood clot formation in heart patients. It works by reducing substances that cause inflammation and pain. Widely trusted for both short-term and long-term use under guidance. Provides quick action when taken in soluble form.','Available in chewable and soluble tablet forms. Should be stored in a dry and cool place. Keep away from moisture and direct sunlight. Check packaging instructions before use. Do not use expired medicine. Always keep properly sealed.','Take 1 tablet daily or as directed by doctor. Best taken after meals to avoid stomach irritation. Drink a full glass of water with the tablet. Do not exceed recommended dosage. Use under supervision for long-term therapy. Follow medical advice strictly.','Not suitable for children under 16 years. May cause stomach bleeding if misused. Avoid in patients with ulcers. Do not use before surgery without advice. Can interact with blood-thinning medicines. Seek medical help in case of overdose.','Use carefully in elderly patients. Consult doctor during pregnancy. Avoid alcohol consumption. Check for allergic reactions. Use only as prescribed. Store away from children.','2026-04-30 23:25:39');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `risk_rules`
--

DROP TABLE IF EXISTS `risk_rules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `risk_rules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keyword` varchar(100) DEFAULT NULL,
  `risk_level` enum('low','medium','high') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `risk_rules`
--

LOCK TABLES `risk_rules` WRITE;
/*!40000 ALTER TABLE `risk_rules` DISABLE KEYS */;
INSERT INTO `risk_rules` VALUES (1,'amoxicillin','high'),(2,'diclofenac','high'),(3,'ibuprofen','high'),(4,'aspirin','high'),(5,'diphenhydramine','medium');
/*!40000 ALTER TABLE `risk_rules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_table`
--

DROP TABLE IF EXISTS `users_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mob_num` varchar(15) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` varchar(50) DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_table`
--

LOCK TABLES `users_table` WRITE;
/*!40000 ALTER TABLE `users_table` DISABLE KEYS */;
INSERT INTO `users_table` VALUES (10,'030303030303','hello','f9b6adb29d085ad8d60d3e8d29f8d8c52d3c7367','hello','hello@gamil.com','user','2026-05-06 17:17:06'),(11,'020202020202','gello','f9b6adb29d085ad8d60d3e8d29f8d8c52d3c7367','gello','gello@gamil.com','user','2026-05-06 17:18:19');
/*!40000 ALTER TABLE `users_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `workers`
--

DROP TABLE IF EXISTS `workers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `workers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `worker_name` varchar(255) NOT NULL,
  `monthly_salary` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `workers`
--

LOCK TABLES `workers` WRITE;
/*!40000 ALTER TABLE `workers` DISABLE KEYS */;
INSERT INTO `workers` VALUES (1,'ILYAS BHAI',30000,'2026-06-26 21:00:04'),(3,'INTIKHAB',35000,'2026-06-27 21:28:13');
/*!40000 ALTER TABLE `workers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'premiumprint_db'
--

--
-- Dumping routines for database 'premiumprint_db'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-07-12 15:09:26
