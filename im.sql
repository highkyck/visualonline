-- MySQL dump 10.13  Distrib 8.0.11, for Linux (x86_64)
--
-- Host: localhost    Database: im
-- ------------------------------------------------------
-- Server version	8.0.11

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8mb4 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `group`
--

DROP TABLE IF EXISTS `group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `group` (
  `group_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `groupname` varchar(50) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `avatar` varchar(1000) NOT NULL DEFAULT '0',
  PRIMARY KEY (`group_id`),
  KEY `type` (`type`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `group`
--

LOCK TABLES `group` WRITE;
/*!40000 ALTER TABLE `group` DISABLE KEYS */;
INSERT INTO `group` VALUES (1,1,'前端','',1,'0'),(2,1,'后端','',1,'0'),(3,1,'网红','',1,'0'),(4,1,'前端群','',2,'http://tp2.sinaimg.cn/2211874245/180/40050524279/0'),(5,2,'Fly社区官方群','',2,'http://tp2.sinaimg.cn/5488749285/50/5719808192/1'),(6,2,'我的好友','',1,'0'),(7,2,'我的老师','',1,'0');
/*!40000 ALTER TABLE `group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `group_user_map`
--

DROP TABLE IF EXISTS `group_user_map`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `group_user_map` (
  `group_id` int(10) unsigned NOT NULL DEFAULT '0',
  `uid` int(10) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `group_user_map`
--

LOCK TABLES `group_user_map` WRITE;
/*!40000 ALTER TABLE `group_user_map` DISABLE KEYS */;
INSERT INTO `group_user_map` VALUES (1,1),(1,2),(1,3),(2,4),(2,5),(2,6),(3,7),(3,8),(3,9),(3,10),(3,11),(3,12),(6,1),(6,3),(6,4),(6,5),(6,6),(7,7),(7,8),(7,9),(7,10),(7,11),(7,12),(4,1),(4,2),(4,3),(4,4);
/*!40000 ALTER TABLE `group_user_map` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `message` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `from_id` int(10) unsigned NOT NULL DEFAULT '0',
  `to_id` int(10) unsigned NOT NULL DEFAULT '0',
  `content` varchar(2048) NOT NULL DEFAULT '',
  `message_time` int(11) unsigned NOT NULL DEFAULT '0',
  `avatar` varchar(255) NOT NULL DEFAULT '',
  `type` varchar(10) NOT NULL DEFAULT 'friend',
  `from_username` varchar(50) NOT NULL DEFAULT '',
  `is_pushed` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `group_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `message`
--

LOCK TABLES `message` WRITE;
/*!40000 ALTER TABLE `message` DISABLE KEYS */;
INSERT INTO `message` VALUES (1,1,2,'d',1526218130,'http://tp1.sinaimg.cn/1571889140/180/40030060651/1','group','贤心',1,0),(2,1,3,'d',1526218130,'http://tp1.sinaimg.cn/1571889140/180/40030060651/1','group','贤心',1,0),(3,1,4,'d',1526218130,'http://tp1.sinaimg.cn/1571889140/180/40030060651/1','group','贤心',1,0),(4,1,2,'dsafa',1526218348,'http://tp1.sinaimg.cn/1571889140/180/40030060651/1','group','贤心',1,0),(5,1,3,'dsafa',1526218348,'http://tp1.sinaimg.cn/1571889140/180/40030060651/1','group','贤心',1,0),(6,1,4,'dsafa',1526218348,'http://tp1.sinaimg.cn/1571889140/180/40030060651/1','group','贤心',0,0),(7,2,1,'fdafa',1526218358,'http://tva3.sinaimg.cn/crop.0.0.512.512.180/8693225ajw8f2rt20ptykj20e80e8weu.jpg','group','Z_子晴',1,0),(8,2,3,'fdafa',1526218358,'http://tva3.sinaimg.cn/crop.0.0.512.512.180/8693225ajw8f2rt20ptykj20e80e8weu.jpg','group','Z_子晴',1,0),(9,2,4,'fdafa',1526218358,'http://tva3.sinaimg.cn/crop.0.0.512.512.180/8693225ajw8f2rt20ptykj20e80e8weu.jpg','group','Z_子晴',1,0),(10,1,2,'群消息',1526218365,'http://tp1.sinaimg.cn/1571889140/180/40030060651/1','group','贤心',1,0),(11,1,3,'群消息',1526218365,'http://tp1.sinaimg.cn/1571889140/180/40030060651/1','group','贤心',1,0),(12,1,4,'群消息',1526218365,'http://tp1.sinaimg.cn/1571889140/180/40030060651/1','group','贤心',1,0),(13,1,2,'这是群的消息',1526218368,'http://tp1.sinaimg.cn/1571889140/180/40030060651/1','group','贤心',1,0),(14,1,3,'这是群的消息',1526218368,'http://tp1.sinaimg.cn/1571889140/180/40030060651/1','group','贤心',1,0),(15,1,4,'这是群的消息',1526218368,'http://tp1.sinaimg.cn/1571889140/180/40030060651/1','group','贤心',1,0),(16,2,1,'你好呀',1526218370,'http://tva3.sinaimg.cn/crop.0.0.512.512.180/8693225ajw8f2rt20ptykj20e80e8weu.jpg','group','Z_子晴',1,0),(17,2,3,'你好呀',1526218370,'http://tva3.sinaimg.cn/crop.0.0.512.512.180/8693225ajw8f2rt20ptykj20e80e8weu.jpg','group','Z_子晴',1,0),(18,2,4,'你好呀',1526218370,'http://tva3.sinaimg.cn/crop.0.0.512.512.180/8693225ajw8f2rt20ptykj20e80e8weu.jpg','group','Z_子晴',1,0),(19,2,1,'这是群消息',1526218374,'http://tva3.sinaimg.cn/crop.0.0.512.512.180/8693225ajw8f2rt20ptykj20e80e8weu.jpg','group','Z_子晴',1,0),(20,2,3,'这是群消息',1526218374,'http://tva3.sinaimg.cn/crop.0.0.512.512.180/8693225ajw8f2rt20ptykj20e80e8weu.jpg','group','Z_子晴',1,0),(21,2,4,'这是群消息',1526218374,'http://tva3.sinaimg.cn/crop.0.0.512.512.180/8693225ajw8f2rt20ptykj20e80e8weu.jpg','group','Z_子晴',1,0),(22,1,2,'qun xiaoxi ',1526218460,'http://tp1.sinaimg.cn/1571889140/180/40030060651/1','group','贤心',1,0),(23,1,3,'qun xiaoxi ',1526218460,'http://tp1.sinaimg.cn/1571889140/180/40030060651/1','group','贤心',1,0),(24,1,4,'qun xiaoxi ',1526218460,'http://tp1.sinaimg.cn/1571889140/180/40030060651/1','group','贤心',1,0),(25,2,1,'速度发放',1526218466,'http://tva3.sinaimg.cn/crop.0.0.512.512.180/8693225ajw8f2rt20ptykj20e80e8weu.jpg','group','Z_子晴',1,0),(26,2,3,'速度发放',1526218466,'http://tva3.sinaimg.cn/crop.0.0.512.512.180/8693225ajw8f2rt20ptykj20e80e8weu.jpg','group','Z_子晴',1,0),(27,2,4,'速度发放',1526218466,'http://tva3.sinaimg.cn/crop.0.0.512.512.180/8693225ajw8f2rt20ptykj20e80e8weu.jpg','group','Z_子晴',1,0),(28,1,2,'dsaf',1526218474,'http://tp1.sinaimg.cn/1571889140/180/40030060651/1','group','贤心',1,0),(29,1,3,'dsaf',1526218474,'http://tp1.sinaimg.cn/1571889140/180/40030060651/1','group','贤心',1,0),(30,1,4,'dsaf',1526218474,'http://tp1.sinaimg.cn/1571889140/180/40030060651/1','group','贤心',1,0),(31,1,2,'dfasfdal ',1526218495,'http://tp1.sinaimg.cn/1571889140/180/40030060651/1','group','贤心',1,0),(32,1,3,'dfasfdal ',1526218495,'http://tp1.sinaimg.cn/1571889140/180/40030060651/1','group','贤心',1,0),(33,1,4,'dfasfdal ',1526218495,'http://tp1.sinaimg.cn/1571889140/180/40030060651/1','group','贤心',1,0),(34,1,2,'群消息',1526218498,'http://tp1.sinaimg.cn/1571889140/180/40030060651/1','group','贤心',1,0),(35,1,3,'群消息',1526218498,'http://tp1.sinaimg.cn/1571889140/180/40030060651/1','group','贤心',1,0),(36,1,4,'群消息',1526218498,'http://tp1.sinaimg.cn/1571889140/180/40030060651/1','group','贤心',1,0),(37,3,1,'sdafas',1526218555,'http://tp2.sinaimg.cn/1833062053/180/5643591594/0','group','Lemon_CC',1,0),(38,3,2,'sdafas',1526218555,'http://tp2.sinaimg.cn/1833062053/180/5643591594/0','group','Lemon_CC',1,0),(39,3,4,'sdafas',1526218555,'http://tp2.sinaimg.cn/1833062053/180/5643591594/0','group','Lemon_CC',1,0),(40,1,2,'dsafsfd',1526218557,'http://tp1.sinaimg.cn/1571889140/180/40030060651/1','group','贤心',1,0),(41,1,3,'dsafsfd',1526218557,'http://tp1.sinaimg.cn/1571889140/180/40030060651/1','group','贤心',1,0),(42,1,4,'dsafsfd',1526218557,'http://tp1.sinaimg.cn/1571889140/180/40030060651/1','group','贤心',1,0),(43,3,1,'asdfa',1526218642,'http://tp2.sinaimg.cn/1833062053/180/5643591594/0','group','Lemon_CC',1,4),(44,3,2,'asdfa',1526218642,'http://tp2.sinaimg.cn/1833062053/180/5643591594/0','group','Lemon_CC',1,4),(45,3,4,'asdfa',1526218642,'http://tp2.sinaimg.cn/1833062053/180/5643591594/0','group','Lemon_CC',1,4),(46,1,2,'safsadf',1526218663,'http://tp1.sinaimg.cn/1571889140/180/40030060651/1','group','贤心',1,4),(47,1,3,'safsadf',1526218663,'http://tp1.sinaimg.cn/1571889140/180/40030060651/1','group','贤心',1,4),(48,1,4,'safsadf',1526218663,'http://tp1.sinaimg.cn/1571889140/180/40030060651/1','group','贤心',1,4),(49,1,2,'去是社大力开发三等奖',1526218667,'http://tp1.sinaimg.cn/1571889140/180/40030060651/1','group','贤心',1,4),(50,1,3,'去是社大力开发三等奖',1526218667,'http://tp1.sinaimg.cn/1571889140/180/40030060651/1','group','贤心',1,4),(51,1,4,'去是社大力开发三等奖',1526218667,'http://tp1.sinaimg.cn/1571889140/180/40030060651/1','group','贤心',1,4),(52,2,1,'sadf ',1526218685,'http://tva3.sinaimg.cn/crop.0.0.512.512.180/8693225ajw8f2rt20ptykj20e80e8weu.jpg','group','Z_子晴',1,4),(53,2,3,'sadf ',1526218685,'http://tva3.sinaimg.cn/crop.0.0.512.512.180/8693225ajw8f2rt20ptykj20e80e8weu.jpg','group','Z_子晴',1,4),(54,2,4,'sadf ',1526218685,'http://tva3.sinaimg.cn/crop.0.0.512.512.180/8693225ajw8f2rt20ptykj20e80e8weu.jpg','group','Z_子晴',1,4),(55,2,1,'这是群消息',1526218688,'http://tva3.sinaimg.cn/crop.0.0.512.512.180/8693225ajw8f2rt20ptykj20e80e8weu.jpg','group','Z_子晴',1,4),(56,2,3,'这是群消息',1526218688,'http://tva3.sinaimg.cn/crop.0.0.512.512.180/8693225ajw8f2rt20ptykj20e80e8weu.jpg','group','Z_子晴',1,4),(57,2,4,'这是群消息',1526218688,'http://tva3.sinaimg.cn/crop.0.0.512.512.180/8693225ajw8f2rt20ptykj20e80e8weu.jpg','group','Z_子晴',1,4),(58,3,1,'khjuiuuyui',1526218738,'http://tp2.sinaimg.cn/1833062053/180/5643591594/0','group','Lemon_CC',1,4),(59,3,2,'khjuiuuyui',1526218738,'http://tp2.sinaimg.cn/1833062053/180/5643591594/0','group','Lemon_CC',1,4),(60,3,4,'khjuiuuyui',1526218738,'http://tp2.sinaimg.cn/1833062053/180/5643591594/0','group','Lemon_CC',1,4),(61,2,1,'积极考虑',1526218746,'http://tva3.sinaimg.cn/crop.0.0.512.512.180/8693225ajw8f2rt20ptykj20e80e8weu.jpg','group','Z_子晴',1,4),(62,2,3,'积极考虑',1526218746,'http://tva3.sinaimg.cn/crop.0.0.512.512.180/8693225ajw8f2rt20ptykj20e80e8weu.jpg','group','Z_子晴',1,4),(63,2,4,'积极考虑',1526218746,'http://tva3.sinaimg.cn/crop.0.0.512.512.180/8693225ajw8f2rt20ptykj20e80e8weu.jpg','group','Z_子晴',1,4),(64,3,1,'hjkhhjkhj ',1526218755,'http://tp2.sinaimg.cn/1833062053/180/5643591594/0','group','Lemon_CC',1,4),(65,3,2,'hjkhhjkhj ',1526218755,'http://tp2.sinaimg.cn/1833062053/180/5643591594/0','group','Lemon_CC',1,4),(66,3,4,'hjkhhjkhj ',1526218755,'http://tp2.sinaimg.cn/1833062053/180/5643591594/0','group','Lemon_CC',1,4),(67,3,1,'哈哈',1526218838,'http://tp2.sinaimg.cn/1833062053/180/5643591594/0','group','Lemon_CC',1,4),(68,3,2,'哈哈',1526218838,'http://tp2.sinaimg.cn/1833062053/180/5643591594/0','group','Lemon_CC',1,4),(69,3,4,'哈哈',1526218838,'http://tp2.sinaimg.cn/1833062053/180/5643591594/0','group','Lemon_CC',1,4),(70,3,1,'我是刘邦',1526218842,'http://tp2.sinaimg.cn/1833062053/180/5643591594/0','group','Lemon_CC',1,4),(71,3,2,'我是刘邦',1526218842,'http://tp2.sinaimg.cn/1833062053/180/5643591594/0','group','Lemon_CC',1,4),(72,3,4,'我是刘邦',1526218842,'http://tp2.sinaimg.cn/1833062053/180/5643591594/0','group','Lemon_CC',1,4),(73,3,1,'你们还好吗',1526218844,'http://tp2.sinaimg.cn/1833062053/180/5643591594/0','group','Lemon_CC',1,4),(74,3,2,'你们还好吗',1526218844,'http://tp2.sinaimg.cn/1833062053/180/5643591594/0','group','Lemon_CC',1,4),(75,3,4,'你们还好吗',1526218844,'http://tp2.sinaimg.cn/1833062053/180/5643591594/0','group','Lemon_CC',1,4),(76,3,1,'楼的看法金石可镂',1526218846,'http://tp2.sinaimg.cn/1833062053/180/5643591594/0','group','Lemon_CC',1,4),(77,3,2,'楼的看法金石可镂',1526218846,'http://tp2.sinaimg.cn/1833062053/180/5643591594/0','group','Lemon_CC',1,4),(78,3,4,'楼的看法金石可镂',1526218846,'http://tp2.sinaimg.cn/1833062053/180/5643591594/0','group','Lemon_CC',1,4),(79,3,1,'经典款法律是否s打飞机奥斯卡附加赛',1526218848,'http://tp2.sinaimg.cn/1833062053/180/5643591594/0','group','Lemon_CC',1,4),(80,3,2,'经典款法律是否s打飞机奥斯卡附加赛',1526218848,'http://tp2.sinaimg.cn/1833062053/180/5643591594/0','group','Lemon_CC',1,4),(81,3,4,'经典款法律是否s打飞机奥斯卡附加赛',1526218848,'http://tp2.sinaimg.cn/1833062053/180/5643591594/0','group','Lemon_CC',1,4),(82,3,1,'img[http://tp4.sinaimg.cn/2145291155/180/5601307179/1]',1526218854,'http://tp2.sinaimg.cn/1833062053/180/5643591594/0','group','Lemon_CC',1,4),(83,3,2,'img[http://tp4.sinaimg.cn/2145291155/180/5601307179/1]',1526218854,'http://tp2.sinaimg.cn/1833062053/180/5643591594/0','group','Lemon_CC',1,4),(84,3,4,'img[http://tp4.sinaimg.cn/2145291155/180/5601307179/1]',1526218854,'http://tp2.sinaimg.cn/1833062053/180/5643591594/0','group','Lemon_CC',1,4),(85,1,2,'你妹',1526218864,'http://tp1.sinaimg.cn/1571889140/180/40030060651/1','group','贤心',1,4),(86,1,3,'你妹',1526218864,'http://tp1.sinaimg.cn/1571889140/180/40030060651/1','group','贤心',1,4),(87,1,4,'你妹',1526218864,'http://tp1.sinaimg.cn/1571889140/180/40030060651/1','group','贤心',1,4),(88,3,1,'haha ',1526218866,'http://tp2.sinaimg.cn/1833062053/180/5643591594/0','group','Lemon_CC',1,4),(89,3,2,'haha ',1526218866,'http://tp2.sinaimg.cn/1833062053/180/5643591594/0','group','Lemon_CC',1,4),(90,3,4,'haha ',1526218866,'http://tp2.sinaimg.cn/1833062053/180/5643591594/0','group','Lemon_CC',1,4),(91,3,1,'网络延迟了吧',1526218872,'http://tp2.sinaimg.cn/1833062053/180/5643591594/0','group','Lemon_CC',1,4),(92,3,2,'网络延迟了吧',1526218872,'http://tp2.sinaimg.cn/1833062053/180/5643591594/0','group','Lemon_CC',1,4),(93,3,4,'网络延迟了吧',1526218872,'http://tp2.sinaimg.cn/1833062053/180/5643591594/0','group','Lemon_CC',1,4),(94,3,1,'现在就差一个登陆注册，和查找添加好友的功能了',1526218928,'http://tp2.sinaimg.cn/1833062053/180/5643591594/0','group','Lemon_CC',1,4),(95,3,2,'现在就差一个登陆注册，和查找添加好友的功能了',1526218928,'http://tp2.sinaimg.cn/1833062053/180/5643591594/0','group','Lemon_CC',1,4),(96,3,4,'现在就差一个登陆注册，和查找添加好友的功能了',1526218928,'http://tp2.sinaimg.cn/1833062053/180/5643591594/0','group','Lemon_CC',1,4),(97,1,3,'dsafa',1526218955,'http://tp1.sinaimg.cn/1571889140/180/40030060651/1','friend','贤心',1,0),(98,1,3,'dsaf',1526218958,'http://tp1.sinaimg.cn/1571889140/180/40030060651/1','friend','贤心',1,0),(99,1,3,'dasf',1526218959,'http://tp1.sinaimg.cn/1571889140/180/40030060651/1','friend','贤心',1,0),(100,3,1,'你好呀',1526218967,'http://tp2.sinaimg.cn/1833062053/180/5643591594/0','group','Lemon_CC',1,4),(101,3,2,'你好呀',1526218967,'http://tp2.sinaimg.cn/1833062053/180/5643591594/0','group','Lemon_CC',1,4),(102,3,4,'你好呀',1526218967,'http://tp2.sinaimg.cn/1833062053/180/5643591594/0','group','Lemon_CC',1,4),(103,1,2,'nishi shui ',1526218972,'http://tp1.sinaimg.cn/1571889140/180/40030060651/1','group','贤心',1,4),(104,1,3,'nishi shui ',1526218972,'http://tp1.sinaimg.cn/1571889140/180/40030060651/1','group','贤心',1,4),(105,1,4,'nishi shui ',1526218972,'http://tp1.sinaimg.cn/1571889140/180/40030060651/1','group','贤心',1,4),(106,1,2,'dfa',1526221376,'http://tp1.sinaimg.cn/1571889140/180/40030060651/1','group','贤心',1,4),(107,1,3,'dfa',1526221376,'http://tp1.sinaimg.cn/1571889140/180/40030060651/1','group','贤心',1,4),(108,1,4,'dfa',1526221376,'http://tp1.sinaimg.cn/1571889140/180/40030060651/1','group','贤心',1,4),(109,1,2,'img[http://tp4.sinaimg.cn/2145291155/180/5601307179/1]',1526221429,'http://tp1.sinaimg.cn/1571889140/180/40030060651/1','group','贤心',1,4),(110,1,3,'img[http://tp4.sinaimg.cn/2145291155/180/5601307179/1]',1526221429,'http://tp1.sinaimg.cn/1571889140/180/40030060651/1','group','贤心',1,4),(111,1,4,'img[http://tp4.sinaimg.cn/2145291155/180/5601307179/1]',1526221429,'http://tp1.sinaimg.cn/1571889140/180/40030060651/1','group','贤心',1,4),(112,1,2,'img[/data/image/2018/0513/def347dfdb15b620147362e59abf9e32.JPG]',1526222299,'http://tp1.sinaimg.cn/1571889140/180/40030060651/1','friend','贤心',1,0),(113,1,2,'file(/data/file/2018/0513/c877aadfd38d9b3ffbf1a702b949bd8e.pdf)[下载文件]',1526222320,'http://tp1.sinaimg.cn/1571889140/180/40030060651/1','friend','贤心',1,0);
/*!40000 ALTER TABLE `message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL DEFAULT '',
  `avatar` varchar(1000) NOT NULL DEFAULT '',
  `sign` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(50) NOT NULL DEFAULT '',
  `passwd` varchar(32) NOT NULL DEFAULT '',
  `reg_time` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'贤心','http://tp1.sinaimg.cn/1571889140/180/40030060651/1','我是刘邦','','',0),(2,'Z_子晴','http://tva3.sinaimg.cn/crop.0.0.512.512.180/8693225ajw8f2rt20ptykj20e80e8weu.jpg','微电商达人','','',0),(3,'Lemon_CC','http://tp2.sinaimg.cn/1833062053/180/5643591594/0','','','',0),(4,'马小云','http://tp4.sinaimg.cn/2145291155/180/5601307179/1','让天下没有难写的代码','','',0),(5,'徐小峥','http://tp2.sinaimg.cn/1783286485/180/5677568891/1','代码在囧途，也要写到底','','',0),(6,'罗玉凤','http://tp1.sinaimg.cn/1241679004/180/5743814375/0','在自己实力不济的时候，不要去相信什么媒体和记者。他们不是善良的人，有时候候他们的采访对当事人而言就是陷阱','','',0),(7,'长泽梓Azusa','http://tva1.sinaimg.cn/crop.0.0.180.180.180/86b15b6cjw1e8qgp5bmzyj2050050aa8.jpg','我是日本女艺人长泽あずさ','','',0),(8,'大鱼_MsYuyu','http://tp1.sinaimg.cn/5286730964/50/5745125631/0','我瘋了！這也太準了吧  超級笑點低','','',0),(9,'谢楠','http://tp4.sinaimg.cn/1665074831/180/5617130952/0','','','',0),(10,'柏雪近在它香','http://tp2.sinaimg.cn/2518326245/180/5636099025/0','','','',0),(11,'林心如','http://tp3.sinaimg.cn/1223762662/180/5741707953/0','我爱贤心','','',0),(12,'佟丽娅','http://tp4.sinaimg.cn/1345566427/180/5730976522/0','我也爱贤心吖吖啊','','',0);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_group_map`
--

DROP TABLE IF EXISTS `user_group_map`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `user_group_map` (
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `group_id` int(10) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_group_map`
--

LOCK TABLES `user_group_map` WRITE;
/*!40000 ALTER TABLE `user_group_map` DISABLE KEYS */;
INSERT INTO `user_group_map` VALUES (1,1),(1,2),(1,3),(1,4),(1,5),(2,6),(2,7),(2,4),(3,4);
/*!40000 ALTER TABLE `user_group_map` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-05-13 22:39:48
