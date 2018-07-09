-- MySQL dump 10.13  Distrib 5.5.47, for Win32 (x86)
--
-- Host: localhost    Database: shop
-- ------------------------------------------------------
-- Server version	5.5.47

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
-- Table structure for table `sp_address`
--

DROP TABLE IF EXISTS `sp_address`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sp_address` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '地址ID',
  `name` varchar(10) NOT NULL DEFAULT '' COMMENT '收货人',
  `phone` char(11) NOT NULL DEFAULT '' COMMENT '联系电话',
  `prov` varchar(20) NOT NULL DEFAULT '' COMMENT '省',
  `city` varchar(20) NOT NULL DEFAULT '' COMMENT '市',
  `dist` varchar(20) NOT NULL DEFAULT '' COMMENT '区',
  `address` varchar(150) NOT NULL DEFAULT '' COMMENT '详细地址',
  `email` varchar(50) NOT NULL DEFAULT '' COMMENT '邮箱地址',
  `member_id` mediumint(8) unsigned NOT NULL COMMENT '会员ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='地址表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sp_address`
--

LOCK TABLES `sp_address` WRITE;
/*!40000 ALTER TABLE `sp_address` DISABLE KEYS */;
INSERT INTO `sp_address` VALUES (2,'林嘉峡','18927400385','北京','东城区','','桥洞下','2703412633@qq.com',1),(3,'林逸','13333333333','北京','东城区','','武当','123@qq.com',1);
/*!40000 ALTER TABLE `sp_address` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sp_admin`
--

DROP TABLE IF EXISTS `sp_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sp_admin` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `username` varchar(20) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '用户账号',
  `name` varchar(10) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '用户昵称',
  `password` varchar(32) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '密码',
  `gender` tinyint(3) unsigned NOT NULL COMMENT '性别：1：男0：女',
  `phone` char(11) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '手机号码',
  `email` varchar(25) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '邮箱地址',
  `is_use` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '是否使用：1：使用0：禁用',
  `create_time` int(10) unsigned NOT NULL COMMENT '添加时间',
  `update_time` int(10) unsigned NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COMMENT='用户表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sp_admin`
--

LOCK TABLES `sp_admin` WRITE;
/*!40000 ALTER TABLE `sp_admin` DISABLE KEYS */;
INSERT INTO `sp_admin` VALUES (1,'chaojiwudiqiang','叶师傅','63573e3d6b8be995be619981b0fa6bda',1,'18927400385','2703412633@qq.com',1,1526799645,1527858968),(2,'woyaodashige','叶问','ce8db815742bc1320ae20a10c2d0ac9d',0,'13333333333','asd@asd.asd',1,1526799683,1526808703),(3,'shenqibaobei','神奇宝贝','ce8db815742bc1320ae20a10c2d0ac9d',1,'13333333333','sdf@fsd.sdf',0,1526956071,0),(4,'wudimeishaonv','无敌美少女','4364ebb5839ec85855aea7b094033bfd',1,'13333333333','sdf@fsd.sdf',1,1526956131,0),(5,'chaojiwudimei','超级无敌美少女','4364ebb5839ec85855aea7b094033bfd',1,'13333333333','sdf@fsd.sdf',1,1526956188,0),(6,'miaowazhongzi','妙蛙种子','ce8db815742bc1320ae20a10c2d0ac9d',1,'13333333333','sdf@fsd.sdf',1,1526956221,1526998316),(7,'zaijiansunwukong','再见孙悟空','63573e3d6b8be995be619981b0fa6bda',1,'13333333333','sdf@fsd.sdf',1,1526957360,0);
/*!40000 ALTER TABLE `sp_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sp_admin_role`
--

DROP TABLE IF EXISTS `sp_admin_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sp_admin_role` (
  `admin_id` tinyint(3) unsigned NOT NULL COMMENT '用户ID',
  `role_id` tinyint(3) unsigned NOT NULL COMMENT '角色ID',
  KEY `admin_id` (`admin_id`) USING BTREE,
  KEY `role_id` (`role_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='用户角色表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sp_admin_role`
--

LOCK TABLES `sp_admin_role` WRITE;
/*!40000 ALTER TABLE `sp_admin_role` DISABLE KEYS */;
INSERT INTO `sp_admin_role` VALUES (2,2),(2,1),(3,3),(4,3),(5,3),(6,3),(7,2),(1,0);
/*!40000 ALTER TABLE `sp_admin_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sp_advert`
--

DROP TABLE IF EXISTS `sp_advert`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sp_advert` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '公司名称',
  `sm_pic` varchar(150) NOT NULL DEFAULT '' COMMENT '缩略图',
  `pic` varchar(150) NOT NULL DEFAULT '' COMMENT '图片路径',
  `url` varchar(150) NOT NULL DEFAULT '' COMMENT '广告链接地址',
  `status` tinyint(3) unsigned NOT NULL COMMENT '状态',
  `create_time` int(10) unsigned NOT NULL COMMENT '添加时间',
  `update_time` int(10) unsigned NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='广告表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sp_advert`
--

LOCK TABLES `sp_advert` WRITE;
/*!40000 ALTER TABLE `sp_advert` DISABLE KEYS */;
INSERT INTO `sp_advert` VALUES (2,'秒滴科技有限公司','20180605\\thumb_730667133a97934d07b20513a5e32521.jpg','20180605\\730667133a97934d07b20513a5e32521.jpg','http://www.miaodiyun.com/?qmymark=dedcbe590015c3e82cc9bbfc7f3a1e74#B_vid=11936665384569322600',1,1528185859,1528185920),(3,'牵引力有限公司','20180605\\thumb_b6403e2f02bf4e4e7dfae8d23a8a3cc9.jpg','20180605\\b6403e2f02bf4e4e7dfae8d23a8a3cc9.jpg','/',1,1528186013,1528245494);
/*!40000 ALTER TABLE `sp_advert` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sp_attribute`
--

DROP TABLE IF EXISTS `sp_attribute`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sp_attribute` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '属性ID',
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '属性名称',
  `choice` tinyint(3) unsigned NOT NULL COMMENT '属性可选：0：唯一 1：可选',
  `values` varchar(150) NOT NULL DEFAULT '' COMMENT '属性的可选值，多个可选值用，隔开',
  `type_id` mediumint(8) unsigned NOT NULL COMMENT '所属类型',
  `create_time` int(10) unsigned NOT NULL COMMENT '添加时间',
  `update_time` int(10) unsigned NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='属性表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sp_attribute`
--

LOCK TABLES `sp_attribute` WRITE;
/*!40000 ALTER TABLE `sp_attribute` DISABLE KEYS */;
INSERT INTO `sp_attribute` VALUES (1,'直径',1,'20cm，25cm，30cm，35cm',1,1527748667,1528262777),(2,'材料',0,'不锈钢，不锈钢内丹，304不锈钢',1,1527748720,1528257575),(4,'容量',1,'1L，2L，3L，4L，5L',1,1527835850,1528262699),(5,'大家说',0,'',1,1528262840,0),(6,'功能',0,'炖，煮，火锅，蒸，焖，炒，炸，铁板烧，定时，预约，煮饭，煲仔饭，蛋糕，酸奶',1,1528262884,1528263132);
/*!40000 ALTER TABLE `sp_attribute` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sp_banner`
--

DROP TABLE IF EXISTS `sp_banner`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sp_banner` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT 'bannerID',
  `name` varchar(25) NOT NULL DEFAULT '' COMMENT 'banner名称',
  `sm_pic` varchar(150) NOT NULL DEFAULT '' COMMENT '缩略图',
  `pic` varchar(150) NOT NULL DEFAULT '' COMMENT 'banner图',
  `create_time` int(10) unsigned NOT NULL COMMENT '添加时间',
  `update_time` int(10) unsigned NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='banner表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sp_banner`
--

LOCK TABLES `sp_banner` WRITE;
/*!40000 ALTER TABLE `sp_banner` DISABLE KEYS */;
INSERT INTO `sp_banner` VALUES (1,'轮播一','20180604\\thumb_6cede7f2a5dc94e469dfacb858ba5ed8.jpg','20180604\\6cede7f2a5dc94e469dfacb858ba5ed8.jpg',1528119594,1528119811),(2,'轮播二','20180604\\thumb_86b9e1093a774b279b12f49e9ab5bb3b.jpg','20180604\\86b9e1093a774b279b12f49e9ab5bb3b.jpg',1528119880,0),(3,'轮播三','20180604\\thumb_a40a83aaf44f617724f4142a94c19f00.jpg','20180604\\a40a83aaf44f617724f4142a94c19f00.jpg',1528119897,1528121983);
/*!40000 ALTER TABLE `sp_banner` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sp_brand`
--

DROP TABLE IF EXISTS `sp_brand`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sp_brand` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '品牌ID',
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '品牌名称',
  `english` varchar(30) NOT NULL DEFAULT '' COMMENT '品牌英文名称',
  `url` varchar(150) NOT NULL DEFAULT '' COMMENT '品牌链接地址',
  `sm_logo` varchar(150) NOT NULL DEFAULT '' COMMENT '品牌logo缩略图',
  `logo` varchar(150) NOT NULL DEFAULT '' COMMENT '品牌logo',
  `create_time` int(10) unsigned NOT NULL COMMENT '添加时间',
  `update_time` int(10) unsigned NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COMMENT='品牌表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sp_brand`
--

LOCK TABLES `sp_brand` WRITE;
/*!40000 ALTER TABLE `sp_brand` DISABLE KEYS */;
INSERT INTO `sp_brand` VALUES (1,'小熊','Bear','https://baike.baidu.com/item/%E5%B0%8F%E7%86%8A%E7%94%B5%E5%99%A8/2871066?fr=aladdin','20180604\\thumb_482dffc35e20f837dfe419df912309e3.png','20180604\\482dffc35e20f837dfe419df912309e3.png',1527318182,1528122356),(2,'苏泊尔','Supor','https://baike.baidu.com/item/%E8%8B%8F%E6%B3%8A%E5%B0%94/10963024?fr=aladdin','20180604\\thumb_cb25eba123ebf781d7e361c1daae4321.jpg','20180604\\cb25eba123ebf781d7e361c1daae4321.jpg',1527319839,1528122346),(3,'美的','Midea','https://baike.baidu.com/item/%E7%BE%8E%E7%9A%84%E9%9B%86%E5%9B%A2/9590056?fromtitle=%E7%BE%8E%E7%9A%84&amp;fromid=1500709&amp;fr=aladdin','20180604\\thumb_dedaf4a9d868863d86e6cdeb412dc503.jpg','20180604\\dedaf4a9d868863d86e6cdeb412dc503.jpg',1527344183,1528122339),(4,'九阳','Joyoung','https://baike.baidu.com/item/%E4%B9%9D%E9%98%B3/9007602?fr=aladdin','20180604\\thumb_370d183aaba88d53f132f1ffde4de96c.jpg','20180604\\370d183aaba88d53f132f1ffde4de96c.jpg',1527602385,1528122315);
/*!40000 ALTER TABLE `sp_brand` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sp_cart`
--

DROP TABLE IF EXISTS `sp_cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sp_cart` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '购物车ID',
  `goods_id` mediumint(8) unsigned NOT NULL COMMENT '商品ID',
  `goods_attr_id` varchar(50) NOT NULL DEFAULT '' COMMENT '商品属性ID',
  `goods_number` smallint(5) unsigned NOT NULL COMMENT '购买数量',
  `member_id` char(32) NOT NULL DEFAULT '' COMMENT '会员ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='购物车表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sp_cart`
--

LOCK TABLES `sp_cart` WRITE;
/*!40000 ALTER TABLE `sp_cart` DISABLE KEYS */;
INSERT INTO `sp_cart` VALUES (8,2,'51,54',1,'1'),(9,2,'54,65',1,'1');
/*!40000 ALTER TABLE `sp_cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sp_category`
--

DROP TABLE IF EXISTS `sp_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sp_category` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '分类ID',
  `name` varchar(15) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '分类名称',
  `pid` smallint(5) unsigned NOT NULL COMMENT '上级分类',
  `create_time` int(10) unsigned NOT NULL COMMENT '添加时间',
  `update_time` int(10) unsigned NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COMMENT='分类表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sp_category`
--

LOCK TABLES `sp_category` WRITE;
/*!40000 ALTER TABLE `sp_category` DISABLE KEYS */;
INSERT INTO `sp_category` VALUES (1,'早餐神器 极速享受',0,1526999100,0),(2,'懒人厨房 百变料理',0,1526999107,0),(3,'养生至尚 极致生活',0,1526999113,1527859895),(4,'早餐神器',1,1527867273,1527923358),(5,'极速享受',1,1527923375,0),(6,'懒人厨房',2,1527923384,0),(7,'百变料理',2,1527923394,0),(8,'养生至尚',3,1527923407,0),(9,'极致生活',3,1527923476,0);
/*!40000 ALTER TABLE `sp_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sp_comment`
--

DROP TABLE IF EXISTS `sp_comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sp_comment` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '评论ID',
  `content` text NOT NULL COMMENT '评论内容',
  `member_id` mediumint(8) unsigned NOT NULL COMMENT '会员ID',
  `goods_id` mediumint(8) unsigned NOT NULL COMMENT '商品ID',
  `create_time` int(10) unsigned NOT NULL COMMENT '评论时间',
  `agree_star` tinyint(3) unsigned NOT NULL COMMENT '满意度评星',
  `speed_star` tinyint(3) unsigned NOT NULL COMMENT '送货速度评星',
  `pack_star` tinyint(3) unsigned NOT NULL COMMENT '包装评星',
  `sm_pic` varchar(150) NOT NULL DEFAULT '' COMMENT '缩略图',
  `pic` varchar(150) NOT NULL DEFAULT '' COMMENT '评论图片',
  `evalutes` tinyint(3) unsigned NOT NULL COMMENT '买家印象',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='评论表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sp_comment`
--

LOCK TABLES `sp_comment` WRITE;
/*!40000 ALTER TABLE `sp_comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `sp_comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sp_constact`
--

DROP TABLE IF EXISTS `sp_constact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sp_constact` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '名称',
  `content` text NOT NULL COMMENT '内容',
  `url` varchar(150) NOT NULL DEFAULT '' COMMENT '路由',
  `img` varchar(150) NOT NULL DEFAULT '' COMMENT '图片',
  `update_time` int(10) unsigned NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COMMENT='联系我们表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sp_constact`
--

LOCK TABLES `sp_constact` WRITE;
/*!40000 ALTER TABLE `sp_constact` DISABLE KEYS */;
INSERT INTO `sp_constact` VALUES (1,'公司logo','','/','20180605\\e6749533b25b333eca0f3cc4d6fe2e23.jpg',1528174435),(2,'QQ公众号','','/','20180605\\229a97164f01236c4d5c7b49bd9d2e27.png',1528164642),(3,'QQ公众号','','/','20180605\\6ca36c1f6aed51b387dba000d06e5eb4.png',1528164677),(4,'520余家售后网点','','/','20180605\\61ce00d17f62b878b27a4c444f30b5c3.png',1528164691),(5,'520余家售后网点','','/','20180605\\cf2898e531519c5ca69302fc6688efc9.png',1528164702),(6,'帮助中心','','/','',1528164815),(7,'账号管理','','/','',1528164823),(8,'购物指南','','/','',1528164830),(9,'订单操作','','','',0),(10,'帮助中心','','','',0),(11,'账号管理','','','',0),(12,'购物指南','','','',0),(13,'订单操作','','','',0),(14,'帮助中心','','','',0),(15,'账号管理','','','',0),(16,'购物指南','','','',0),(17,'订单操作','','','',0),(18,'帮助中心','','','',0),(19,'账号管理','','','',0),(20,'购物指南','','','',0),(21,'订单操作','','','',0),(22,'在 线 客 服','400-400-4000','/','',1528165044),(23,'','©mi.com 京ICP证110507号 京ICP备10046444号 京公网安备11010802020134号 京网文[2014]0059-0009号','','',1528174169),(24,'','违法和不良信息举报电话：185-0130-1238，本网站所列数据，除特殊说明，所有数据均出自我司实验室测试','','',1528165154);
/*!40000 ALTER TABLE `sp_constact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sp_favourable_price`
--

DROP TABLE IF EXISTS `sp_favourable_price`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sp_favourable_price` (
  `goods_id` mediumint(8) unsigned NOT NULL COMMENT '商品ID',
  `number` int(10) unsigned NOT NULL COMMENT '优惠数量',
  `price` decimal(10,2) NOT NULL COMMENT '优惠价格',
  PRIMARY KEY (`goods_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='优惠价格表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sp_favourable_price`
--

LOCK TABLES `sp_favourable_price` WRITE;
/*!40000 ALTER TABLE `sp_favourable_price` DISABLE KEYS */;
/*!40000 ALTER TABLE `sp_favourable_price` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sp_goods`
--

DROP TABLE IF EXISTS `sp_goods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sp_goods` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '商品ID',
  `name` varchar(45) NOT NULL DEFAULT '' COMMENT '商品名称',
  `cat_id` mediumint(8) unsigned NOT NULL COMMENT '主分类ID',
  `brand_id` mediumint(8) unsigned NOT NULL COMMENT '品牌ID',
  `type_id` mediumint(8) unsigned NOT NULL COMMENT '分类ID',
  `supermarket_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '市场价',
  `shop_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '本店价',
  `credit` int(10) unsigned NOT NULL COMMENT '赠送积分',
  `credit_price` int(10) unsigned NOT NULL COMMENT '如果用积分兑换，需要的积分数',
  `is_promote` tinyint(3) unsigned NOT NULL COMMENT '是否促销：0：不促销1：促销',
  `promote_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '促销价',
  `promote_start_time` int(10) unsigned NOT NULL COMMENT '促销开始时间',
  `promote_end_time` int(10) unsigned NOT NULL COMMENT '促销结束时间',
  `sm_logo` varchar(150) NOT NULL DEFAULT '' COMMENT 'logo缩略图',
  `logo` varchar(150) NOT NULL DEFAULT '' COMMENT 'logo',
  `is_sale` tinyint(3) unsigned NOT NULL COMMENT '是否上架：0：下架1：上架',
  `is_new` tinyint(3) unsigned NOT NULL COMMENT '是否新品',
  `is_best` tinyint(3) unsigned NOT NULL COMMENT '是否推荐',
  `is_hot` tinyint(3) unsigned NOT NULL COMMENT '是否热卖',
  `sort` tinyint(3) unsigned NOT NULL DEFAULT '100' COMMENT '排序字段',
  `goods_desc` text NOT NULL COMMENT '商品描述',
  `create_time` int(10) unsigned NOT NULL COMMENT '添加时间',
  `update_time` int(10) unsigned NOT NULL COMMENT '更新时间',
  `is_delete` tinyint(3) unsigned NOT NULL COMMENT '是否删除',
  `seo_keyword` varchar(150) NOT NULL DEFAULT '' COMMENT 'seo优化关键字',
  `seo_desc` varchar(150) NOT NULL DEFAULT '' COMMENT 'seo优化描述',
  `feature` varchar(30) NOT NULL DEFAULT '' COMMENT '商品特色',
  `is_freight` tinyint(3) unsigned NOT NULL COMMENT '是否包邮：1：包邮0：不包邮',
  `freight_price` decimal(10,2) unsigned NOT NULL COMMENT '邮费',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='商品表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sp_goods`
--

LOCK TABLES `sp_goods` WRITE;
/*!40000 ALTER TABLE `sp_goods` DISABLE KEYS */;
INSERT INTO `sp_goods` VALUES (1,'强锅',1,2,1,10000.00,9999.00,500,0,0,0.00,0,0,'20180602\\thumb_b7dbcefc194f36b4bb80e165c68d1ee1.jpg','20180602\\b7dbcefc194f36b4bb80e165c68d1ee1.jpg',1,1,1,1,100,'&lt;p&gt;超级无敌强&lt;/p&gt;',1527913168,1528263827,0,'','','本产品全国联保',0,0.00),(2,'华锅',1,2,1,50000.00,49800.00,0,0,1,45000.00,1528178850,1528787042,'20180602\\thumb_9657fe055bdb1871ca3ddc2f8eb444a1.jpg','20180602\\9657fe055bdb1871ca3ddc2f8eb444a1.jpg',1,0,1,1,100,'&lt;p&gt;骚锅&lt;/p&gt;',1527919768,1528646218,0,'','','本产品全国联保',0,0.00),(3,'栋锅',3,4,1,8000.00,8100.00,500,5000,0,0.00,0,0,'20180606\\thumb_5cce583706d23a7c0cf01f86adf0b7d3.jpg','20180606\\5cce583706d23a7c0cf01f86adf0b7d3.jpg',0,1,0,1,100,'&lt;p&gt;垃圾锅&lt;/p&gt;',1527920042,1528275867,0,'','','本产品全国联保',0,0.00),(4,'豪锅',1,1,1,8000.00,8500.00,500,0,0,7000.00,1528181386,1528267788,'20180605\\thumb_2487e711f030daf3e6bee6d352c118c1.jpg','20180605\\2487e711f030daf3e6bee6d352c118c1.jpg',1,0,1,1,100,'&lt;p&gt;只有富豪才能拥有的锅&lt;/p&gt;',1528179826,1528600443,0,'','','本产品全国联保',0,0.00),(5,'权锅',8,3,1,12000.00,15000.00,700,0,0,0.00,0,0,'20180605\\thumb_1e95eafc9f93535e6d5cdde706a2dd0f.jpg','20180605\\1e95eafc9f93535e6d5cdde706a2dd0f.jpg',1,1,1,1,100,'&lt;p&gt;冰与火，权利的锅&lt;/p&gt;',1528180132,1528263597,0,'','','享受三包服务',0,0.00),(6,'宏锅',3,4,1,10000.00,12000.00,800,0,0,0.00,0,0,'20180605\\thumb_690ea81c3a2668d9379f48c150ca1b64.jpg','20180605\\690ea81c3a2668d9379f48c150ca1b64.jpg',1,0,1,1,100,'&lt;p&gt;宏才远志的锅&lt;br/&gt;&lt;/p&gt;',1528180611,1528263550,0,'','','享受三包服务',0,0.00),(7,'辉锅',2,3,1,8000.00,9800.00,700,0,1,8000.00,1528181142,1528613143,'20180605\\thumb_0f4bdf4a0e87a0107189fbcc4c8df506.jpg','20180605\\0f4bdf4a0e87a0107189fbcc4c8df506.jpg',1,1,0,1,100,'&lt;p&gt;灰太狼的锅&lt;/p&gt;',1528180701,1528263313,0,'','','享受三包服务',0,0.00),(8,'龙锅',2,2,1,50000.00,50000.00,1000,0,1,49999.00,1528181029,1528181031,'20180605\\thumb_a6cc1df4a1f86ab5b83084091fd36fc2.jpg','20180605\\a6cc1df4a1f86ab5b83084091fd36fc2.jpg',1,1,1,1,100,'&lt;p&gt;九五之尊&lt;/p&gt;',1528181128,1528464033,0,'','','享受三包服务',0,0.00),(9,'诚锅',2,2,1,500.00,498.00,20,0,0,0.00,0,0,'20180610\\thumb_b756100f6abd241b94d06983d77425bf.jpg','20180610\\b756100f6abd241b94d06983d77425bf.jpg',1,1,1,1,100,'&lt;p&gt;强无敌&lt;/p&gt;',1528600220,1528600828,0,'','','本产品全国联保',1,5.00),(10,'帅锅',2,2,1,300.00,280.00,10,0,0,0.00,0,0,'20180610\\thumb_c52dcb224530c63b080fd9a955bd03fb.jpg','20180610\\c52dcb224530c63b080fd9a955bd03fb.jpg',1,1,1,1,100,'&lt;p&gt;捞仔，羡慕么&lt;/p&gt;',1528600919,0,0,'','','本产品全国联保',1,0.00);
/*!40000 ALTER TABLE `sp_goods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sp_goods_attribute`
--

DROP TABLE IF EXISTS `sp_goods_attribute`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sp_goods_attribute` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `goods_id` mediumint(8) unsigned NOT NULL COMMENT '商品ID',
  `attribute_id` mediumint(8) unsigned NOT NULL COMMENT '属性ID',
  `attribute_value` varchar(150) NOT NULL DEFAULT '' COMMENT '属性值',
  `attribute_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '属性价格',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8 COMMENT='商品属性表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sp_goods_attribute`
--

LOCK TABLES `sp_goods_attribute` WRITE;
/*!40000 ALTER TABLE `sp_goods_attribute` DISABLE KEYS */;
INSERT INTO `sp_goods_attribute` VALUES (1,8,1,'20cm',2000.00),(2,8,1,'25cm',5000.00),(3,8,1,'30cm',10000.00),(4,8,2,'不锈钢',10000.00),(5,8,4,'1L',0.00),(6,8,4,'3L',5000.00),(7,8,4,'5L',7000.00),(8,8,5,'大容量',7000.00),(9,8,6,'铁板烧',7000.00),(10,7,1,'20cm',0.00),(11,7,1,'25cm',700.00),(12,7,2,'不锈钢内丹',0.00),(13,7,4,'1L',500.00),(14,7,4,'2L',700.00),(15,7,6,'预约',0.00),(16,6,1,'25cm',0.00),(17,6,1,'30cm',700.00),(18,6,2,'304不锈钢',0.00),(19,6,4,'1L',0.00),(20,6,4,'2L',50.00),(21,6,4,'3L',150.00),(22,6,4,'4L',300.00),(23,6,5,'迷你',0.00),(24,6,6,'煲仔饭',0.00),(25,5,1,'20cm',0.00),(26,5,1,'25cm',50.00),(27,5,1,'30cm',100.00),(28,5,2,'不锈钢',0.00),(29,5,4,'1L',50.00),(30,5,4,'2L',100.00),(31,5,4,'4L',150.00),(32,5,6,'焖',0.00),(33,4,1,'20cm',0.00),(34,4,1,'30cm',500.00),(35,4,1,'35cm',700.00),(36,4,2,'不锈钢内丹',700.00),(37,4,4,'1L',0.00),(38,4,4,'3L',50.00),(39,4,4,'4L',120.00),(40,4,5,'大容量',120.00),(41,4,6,'煲仔饭',120.00),(42,3,1,'20cm',45.00),(43,3,1,'25cm',70.00),(44,3,1,'35cm',120.00),(45,3,2,'304不锈钢',120.00),(46,3,4,'3L',70.00),(47,3,4,'4L',140.00),(48,3,4,'1L',0.00),(49,3,5,'智能',0.00),(50,3,6,'铁板烧',0.00),(51,2,1,'25cm',5000.00),(52,2,1,'30cm',10000.00),(53,2,2,'304不锈钢',3000.00),(54,2,4,'4L',0.00),(55,2,4,'5L',7000.00),(56,2,5,'新款',7000.00),(57,2,6,'蛋糕',7000.00),(58,1,1,'20cm',0.00),(59,1,1,'30cm',100.00),(60,1,2,'不锈钢内丹',0.00),(61,1,4,'2L',70.00),(62,1,4,'4L',120.00),(63,1,5,'小容量',0.00),(64,1,6,'蛋糕',0.00),(65,2,1,'20cm',3000.00),(66,9,1,'20cm',0.00),(67,9,1,'25cm',50.00),(68,9,2,'不锈钢内丹',50.00),(69,9,4,'1L',0.00),(70,9,4,'2L',100.00),(71,9,6,'酸奶',100.00),(72,10,1,'20cm',0.00),(73,10,1,'25cm',50.00),(74,10,1,'35cm',100.00),(75,10,4,'2L',0.00),(76,10,4,'4L',200.00);
/*!40000 ALTER TABLE `sp_goods_attribute` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sp_goods_cat`
--

DROP TABLE IF EXISTS `sp_goods_cat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sp_goods_cat` (
  `goods_id` mediumint(8) unsigned NOT NULL COMMENT '商品ID',
  `cat_id` mediumint(8) unsigned NOT NULL COMMENT '分类ID',
  KEY `goods_id` (`goods_id`) USING BTREE,
  KEY `cat_id` (`cat_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品扩展分类表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sp_goods_cat`
--

LOCK TABLES `sp_goods_cat` WRITE;
/*!40000 ALTER TABLE `sp_goods_cat` DISABLE KEYS */;
INSERT INTO `sp_goods_cat` VALUES (7,9),(7,5),(7,7),(6,6),(6,4),(5,8),(5,2),(5,7),(1,4),(1,2),(3,2),(3,4),(8,8),(8,9),(4,4),(4,7),(4,3),(9,4),(10,4),(10,3),(10,7),(2,2);
/*!40000 ALTER TABLE `sp_goods_cat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sp_goods_number`
--

DROP TABLE IF EXISTS `sp_goods_number`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sp_goods_number` (
  `goods_id` mediumint(8) unsigned NOT NULL COMMENT '商品ID',
  `number` int(11) NOT NULL COMMENT '商品库存量',
  `attribute_id` varchar(150) NOT NULL DEFAULT '' COMMENT '商品属性ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品库存表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sp_goods_number`
--

LOCK TABLES `sp_goods_number` WRITE;
/*!40000 ALTER TABLE `sp_goods_number` DISABLE KEYS */;
INSERT INTO `sp_goods_number` VALUES (3,50,'3,4'),(3,10,'1,5'),(1,50,'59,61'),(2,200,'54,65'),(2,10,'51,54');
/*!40000 ALTER TABLE `sp_goods_number` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sp_goods_picture`
--

DROP TABLE IF EXISTS `sp_goods_picture`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sp_goods_picture` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `sm_picture` varchar(150) NOT NULL DEFAULT '' COMMENT '缩略图图片',
  `picture` varchar(150) NOT NULL DEFAULT '' COMMENT '图片',
  `goods_id` mediumint(8) unsigned NOT NULL COMMENT '商品ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COMMENT='商品图片表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sp_goods_picture`
--

LOCK TABLES `sp_goods_picture` WRITE;
/*!40000 ALTER TABLE `sp_goods_picture` DISABLE KEYS */;
INSERT INTO `sp_goods_picture` VALUES (1,'20180602\\thumb_948a7155f492fd187f99e03302ffde9f.jpg','20180602\\948a7155f492fd187f99e03302ffde9f.jpg',1),(4,'20180602\\thumb_70794486311c93527ef979910968b892.jpg','20180602\\70794486311c93527ef979910968b892.jpg',2),(5,'20180602\\thumb_23dca788db28d3bc8b74729f7a88404f.jpg','20180602\\23dca788db28d3bc8b74729f7a88404f.jpg',2),(6,'20180602\\thumb_141ad621038907b8f3e8bdae2d05485d.png','20180602\\141ad621038907b8f3e8bdae2d05485d.png',2),(7,'20180602\\thumb_bc57dddc4db2bfd596eb7063318e8d2f.jpg','20180602\\bc57dddc4db2bfd596eb7063318e8d2f.jpg',3),(8,'20180602\\thumb_45aff43d6b5d6b751f9595d71dd49317.jpg','20180602\\45aff43d6b5d6b751f9595d71dd49317.jpg',3),(9,'20180602\\thumb_db2854540a97d00d3a492981180206b3.jpg','20180602\\db2854540a97d00d3a492981180206b3.jpg',3),(10,'20180605\\thumb_a17e91beb049484d682d405c434bfc6d.jpg','20180605\\a17e91beb049484d682d405c434bfc6d.jpg',4),(11,'20180605\\thumb_eb6768372096c1389f36f915c022a564.jpg','20180605\\eb6768372096c1389f36f915c022a564.jpg',4),(12,'20180605\\thumb_1ce2be56a412049048bd5e0d56cda99a.jpg','20180605\\1ce2be56a412049048bd5e0d56cda99a.jpg',4),(13,'20180605\\thumb_f65238bad248bf6fc29487497f088ac8.jpg','20180605\\f65238bad248bf6fc29487497f088ac8.jpg',5),(14,'20180605\\thumb_9f45b86f8f2ac259f0faf6cdf43c147a.jpg','20180605\\9f45b86f8f2ac259f0faf6cdf43c147a.jpg',5),(15,'20180605\\thumb_d21c18a2a1d13abb3eba81609e6c837d.png','20180605\\d21c18a2a1d13abb3eba81609e6c837d.png',5),(16,'20180605\\thumb_403104105772540f69c3f51eb64b3b8e.jpg','20180605\\403104105772540f69c3f51eb64b3b8e.jpg',6),(17,'20180605\\thumb_9b50ccc91ddc18c183d96fad14cd1e5f.jpg','20180605\\9b50ccc91ddc18c183d96fad14cd1e5f.jpg',7),(18,'20180605\\thumb_46688dcfb672ab2f74d3b24dac66d79d.jpg','20180605\\46688dcfb672ab2f74d3b24dac66d79d.jpg',7),(19,'20180605\\thumb_121dd7941d48a80f9b3f6f1dd5f095db.jpg','20180605\\121dd7941d48a80f9b3f6f1dd5f095db.jpg',7),(20,'20180605\\thumb_0f87095a9d309e3e61af124d112e8006.jpg','20180605\\0f87095a9d309e3e61af124d112e8006.jpg',8),(21,'20180605\\thumb_c2c719ca27ba8e466bed59b94342c4d2.jpg','20180605\\c2c719ca27ba8e466bed59b94342c4d2.jpg',8),(22,'20180605\\thumb_fb7d8b3ee61ea55e4254ebdb634d99b4.jpg','20180605\\fb7d8b3ee61ea55e4254ebdb634d99b4.jpg',8),(23,'20180610\\thumb_75ae28bcad68b89403010da9a3399e6f.jpg','20180610\\75ae28bcad68b89403010da9a3399e6f.jpg',9),(24,'20180610\\thumb_e0da71c1baa5c942e85667224f1110d9.jpg','20180610\\e0da71c1baa5c942e85667224f1110d9.jpg',9),(25,'20180610\\thumb_143f647f399917ae491ecbb627155f7f.jpg','20180610\\143f647f399917ae491ecbb627155f7f.jpg',9),(26,'20180610\\thumb_2a824fe4a7a64433e061b9916e0db405.jpg','20180610\\2a824fe4a7a64433e061b9916e0db405.jpg',10),(27,'20180610\\thumb_5c36a59e56ac0986ddf6840cf2df91c0.jpg','20180610\\5c36a59e56ac0986ddf6840cf2df91c0.jpg',10),(28,'20180610\\thumb_e915d9ea71c8c5bcf84619fbda5836a8.jpg','20180610\\e915d9ea71c8c5bcf84619fbda5836a8.jpg',10);
/*!40000 ALTER TABLE `sp_goods_picture` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sp_impression`
--

DROP TABLE IF EXISTS `sp_impression`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sp_impression` (
  `member_id` mediumint(8) unsigned NOT NULL COMMENT '会员ID',
  `goods_id` mediumint(8) unsigned NOT NULL COMMENT '商品ID',
  `count` smallint(5) unsigned NOT NULL COMMENT '浏览次数',
  PRIMARY KEY (`member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='印象表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sp_impression`
--

LOCK TABLES `sp_impression` WRITE;
/*!40000 ALTER TABLE `sp_impression` DISABLE KEYS */;
/*!40000 ALTER TABLE `sp_impression` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sp_member`
--

DROP TABLE IF EXISTS `sp_member`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sp_member` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `username` varchar(20) NOT NULL DEFAULT '' COMMENT '账号',
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '昵称',
  `real_name` char(10) NOT NULL DEFAULT '' COMMENT '真实姓名',
  `password` char(32) NOT NULL DEFAULT '' COMMENT '密码',
  `gender` tinyint(3) unsigned NOT NULL COMMENT '性别：0：保密1：男2：女',
  `phone` char(11) NOT NULL DEFAULT '' COMMENT '手机',
  `email` varchar(50) NOT NULL DEFAULT '' COMMENT '邮箱',
  `face` varchar(150) NOT NULL DEFAULT '' COMMENT '头像',
  `credit` int(10) unsigned NOT NULL COMMENT '积分',
  `money` int(10) unsigned NOT NULL COMMENT '余额',
  `birthday` int(10) unsigned NOT NULL COMMENT '出生年月',
  `create_time` int(10) unsigned NOT NULL COMMENT '添加时间',
  `update_time` int(10) unsigned NOT NULL COMMENT '更新时间',
  `hobby` varchar(50) NOT NULL DEFAULT '' COMMENT '爱好',
  `status` tinyint(3) unsigned NOT NULL COMMENT '状态：0：未激活1：已激活2：已删除',
  `email_code` char(32) NOT NULL DEFAULT '' COMMENT '邮箱验证码',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='会员表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sp_member`
--

LOCK TABLES `sp_member` WRITE;
/*!40000 ALTER TABLE `sp_member` DISABLE KEYS */;
INSERT INTO `sp_member` VALUES (1,'chaojiwudiqiang','超级无敌强','林嘉峡','63573e3d6b8be995be619981b0fa6bda',2,'18927400385','2703412633@qq.com','20180608\\10685a7074e57701daff4f617277b223.jpg',20001,0,842544000,1528212875,1528556069,'',1,'');
/*!40000 ALTER TABLE `sp_member` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sp_member_level`
--

DROP TABLE IF EXISTS `sp_member_level`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sp_member_level` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '会员等级名称',
  `top_number` int(10) unsigned NOT NULL COMMENT '积分上限',
  `bottom_number` int(10) unsigned NOT NULL COMMENT '积分下限',
  `rate` tinyint(3) unsigned NOT NULL COMMENT '折扣率，百分比，例如9折=90',
  `create_time` int(10) unsigned NOT NULL COMMENT '添加时间',
  `update_time` int(10) unsigned NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='会员等级表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sp_member_level`
--

LOCK TABLES `sp_member_level` WRITE;
/*!40000 ALTER TABLE `sp_member_level` DISABLE KEYS */;
INSERT INTO `sp_member_level` VALUES (1,'注册会员',20000,0,100,1527490724,1527859908),(2,'中级会员',50000,20001,99,1527490756,0),(3,'白金会员',150000,50001,98,1527490810,0),(4,'至尊会员',500000,150001,97,1527490839,0);
/*!40000 ALTER TABLE `sp_member_level` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sp_member_price`
--

DROP TABLE IF EXISTS `sp_member_price`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sp_member_price` (
  `goods_id` mediumint(8) unsigned NOT NULL COMMENT '商品ID',
  `level_id` mediumint(8) unsigned NOT NULL COMMENT '会员等级ID',
  `level_price` decimal(10,2) unsigned NOT NULL COMMENT '当前级别价格'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='会员价格表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sp_member_price`
--

LOCK TABLES `sp_member_price` WRITE;
/*!40000 ALTER TABLE `sp_member_price` DISABLE KEYS */;
INSERT INTO `sp_member_price` VALUES (7,1,9800.00),(7,2,9702.00),(7,3,9604.00),(7,4,9506.00),(6,1,12000.00),(6,2,11880.00),(6,3,11760.00),(6,4,11640.00),(5,1,15000.00),(5,2,14850.00),(5,3,14700.00),(5,4,14550.00),(1,1,9999.00),(1,2,9899.01),(1,3,9799.02),(1,4,9699.03),(3,1,8100.00),(3,2,8019.00),(3,3,7938.00),(3,4,7857.00),(8,1,50000.00),(8,2,49500.00),(8,3,49000.00),(8,4,48500.00),(4,1,8500.00),(4,2,8415.00),(4,3,8330.00),(4,4,8245.00),(9,1,498.00),(9,2,493.02),(9,3,488.04),(9,4,483.06),(10,1,280.00),(10,2,277.20),(10,3,274.40),(10,4,271.60),(2,1,49800.00),(2,2,49302.00),(2,3,48804.00),(2,4,48306.00);
/*!40000 ALTER TABLE `sp_member_price` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sp_nav`
--

DROP TABLE IF EXISTS `sp_nav`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sp_nav` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT '导航ID',
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '导航名称',
  `url` varchar(30) NOT NULL DEFAULT '' COMMENT '路由地址',
  `update_time` int(10) unsigned NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='导航表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sp_nav`
--

LOCK TABLES `sp_nav` WRITE;
/*!40000 ALTER TABLE `sp_nav` DISABLE KEYS */;
INSERT INTO `sp_nav` VALUES (1,'首页','/',1528081302),(2,'热销商品','',0),(3,'推荐商品','',0),(4,'最新商品','',0),(5,'联系我们','',0);
/*!40000 ALTER TABLE `sp_nav` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sp_order`
--

DROP TABLE IF EXISTS `sp_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sp_order` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '订单ID',
  `member_id` mediumint(8) unsigned NOT NULL COMMENT '会员ID',
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '收货人',
  `prov` varchar(20) NOT NULL DEFAULT '' COMMENT '省',
  `city` varchar(20) NOT NULL DEFAULT '' COMMENT '市',
  `dist` varchar(20) NOT NULL DEFAULT '' COMMENT '区',
  `address` varchar(150) NOT NULL COMMENT '详细地址',
  `phone` char(11) NOT NULL DEFAULT '' COMMENT '联系电话',
  `total_price` decimal(10,2) NOT NULL COMMENT '订单总价',
  `post_method` tinyint(3) unsigned NOT NULL COMMENT '发货方式',
  `pay_method` tinyint(3) unsigned NOT NULL COMMENT '付款方式',
  `post_status` tinyint(3) unsigned NOT NULL COMMENT '发货状态：0：未发货1：已发货2：已收货',
  `pay_status` tinyint(3) unsigned NOT NULL COMMENT '支付状态：0：待支付1：未支付2：已支付',
  `create_time` int(10) unsigned NOT NULL COMMENT '下单时间',
  `order_number` char(32) NOT NULL DEFAULT '' COMMENT '订单号',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='订单表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sp_order`
--

LOCK TABLES `sp_order` WRITE;
/*!40000 ALTER TABLE `sp_order` DISABLE KEYS */;
INSERT INTO `sp_order` VALUES (1,1,'林嘉峡','北京','东城区','','桥洞下','18927400385',50000.00,0,0,0,1,1528702958,'7bd6670f2666439eb456ad31b41c380c');
/*!40000 ALTER TABLE `sp_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sp_order_goods`
--

DROP TABLE IF EXISTS `sp_order_goods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sp_order_goods` (
  `order_id` mediumint(8) unsigned NOT NULL COMMENT '订单ID',
  `member_id` mediumint(8) unsigned NOT NULL COMMENT '会员ID',
  `goods_id` mediumint(8) unsigned NOT NULL COMMENT '商品ID',
  `goods_attr_id` varchar(50) NOT NULL DEFAULT '' COMMENT '商品属性ID',
  `price` decimal(10,2) NOT NULL COMMENT '商品价格',
  `number` int(11) NOT NULL COMMENT '购买数量'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='订单商品表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sp_order_goods`
--

LOCK TABLES `sp_order_goods` WRITE;
/*!40000 ALTER TABLE `sp_order_goods` DISABLE KEYS */;
INSERT INTO `sp_order_goods` VALUES (1,1,2,'51,54',50000.00,1);
/*!40000 ALTER TABLE `sp_order_goods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sp_payword`
--

DROP TABLE IF EXISTS `sp_payword`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sp_payword` (
  `member_id` mediumint(8) unsigned NOT NULL COMMENT '会员ID',
  `payword` char(32) NOT NULL DEFAULT '' COMMENT '支付密码'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='支付密码表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sp_payword`
--

LOCK TABLES `sp_payword` WRITE;
/*!40000 ALTER TABLE `sp_payword` DISABLE KEYS */;
INSERT INTO `sp_payword` VALUES (1,'e10adc3949ba59abbe56e057f20f883e');
/*!40000 ALTER TABLE `sp_payword` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sp_privilege`
--

DROP TABLE IF EXISTS `sp_privilege`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sp_privilege` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT '权限ID',
  `name` varchar(10) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '权限名称',
  `pid` smallint(5) unsigned NOT NULL COMMENT '上级权限',
  `controller` varchar(15) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '控制器',
  `action` varchar(15) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '方法',
  `is_show` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '是否显示：1：显示0：不显示',
  `create_time` int(10) unsigned NOT NULL COMMENT '添加时间',
  `update_time` int(10) unsigned NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=117 DEFAULT CHARSET=utf8mb4 COMMENT='权限&菜单表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sp_privilege`
--

LOCK TABLES `sp_privilege` WRITE;
/*!40000 ALTER TABLE `sp_privilege` DISABLE KEYS */;
INSERT INTO `sp_privilege` VALUES (1,'系统管理',0,'','',1,1526556039,0),(2,'管理员管理',0,'','',1,1526556048,0),(3,'栏目管理',1,'Menu','index',1,1526556055,1526611555),(4,'用户管理',2,'Admin','index',1,1526556070,1526611570),(5,'角色管理',2,'Role','index',1,1526556079,0),(6,'权限管理',2,'Privilege','index',1,1526556086,0),(7,'栏目添加页面',3,'Menu','create',1,1526556203,0),(8,'栏目新增',3,'Menu','save',1,1526556219,0),(9,'栏目修改页面',3,'Menu','edit',1,1526556234,0),(10,'栏目更新',3,'Menu','update',1,1526556251,0),(11,'栏目删除',3,'Menu','delete',1,1526556264,0),(12,'栏目批量删除',3,'Menu','deletion',1,1526556284,0),(13,'权限添加页面',6,'Privilege','create',1,1526556389,0),(14,'权限新增',6,'Privilege','save',1,1526556407,0),(15,'权限修改页面',6,'Privilege','edit',1,1526556423,0),(16,'权限更新',6,'Privilege','update',1,1526556445,0),(17,'权限删除',6,'Privilege','delete',1,1526556462,0),(18,'权限批量删除',6,'Privilege','deletion',1,1526556481,0),(19,'用户添加页面',4,'Admin','create',1,1526635628,0),(20,'用户新增',4,'Admin','save',1,1526635648,0),(21,'用户修改页面',4,'Admin','edit',1,1526635664,0),(22,'用户更新',4,'Admin','update',1,1526635690,0),(23,'用户删除',4,'Admin','delete',1,1526635711,0),(24,'用户批量删除',4,'Admin','deletion',1,1526635816,0),(25,'角色添加页面',5,'Role','create',1,1526635839,0),(26,'角色新增',5,'Role','save',1,1526635857,0),(27,'角色修改页面',5,'Role','edit',1,1526635886,0),(28,'角色更新',5,'Role','update',1,1526635903,0),(29,'角色删除',5,'Role','delete',1,1526635925,0),(30,'角色批量删除',5,'Role','deletion',1,1526635945,0),(31,'商品管理',0,'','',1,1526914484,0),(32,'分类管理',31,'Category','index',1,1526914849,0),(33,'分类添加页面',32,'Category','create',1,1526999242,0),(34,'分类新增',32,'Category','save',1,1526999260,0),(35,'分类修改页面',32,'Category','edit',1,1526999433,0),(36,'分类更新',32,'Category','update',1,1526999449,0),(37,'分类删除',32,'Category','delete',1,1526999463,0),(38,'分类批量删除',32,'Category','deletion',1,1526999479,0),(39,'用户状态管理',4,'Admin','isuse',1,1526999545,1526999680),(40,'类型管理',31,'Type','index',1,1526999763,1526999881),(41,'类型添加页面',40,'Type','create',1,1526999899,0),(42,'类型新增',40,'Type','save',1,1526999959,0),(43,'类型修改页面',40,'Type','edit',1,1527000006,0),(44,'类型更新',40,'Type','update',1,1527000065,0),(45,'类型删除',40,'Type','delete',1,1527000077,0),(46,'类型批量删除',40,'Type','deletion',1,1527000091,0),(47,'品牌管理',31,'Brand','index',1,1527086006,0),(48,'品牌添加页面',47,'Brand','create',1,1527086033,0),(49,'品牌新增',47,'Brand','save',1,1527086046,0),(50,'品牌修改页面',47,'Brand','edit',1,1527086070,0),(51,'品牌更新',47,'Brand','update',1,1527086088,0),(52,'品牌删除',47,'Brand','delete',1,1527086107,0),(53,'品牌批量删除',47,'Brand','deletion',1,1527086121,0),(54,'属性管理',31,'Attribute','index',1,1527086165,1528030755),(55,'属性添加页面',54,'Attribute','create',1,1527086182,0),(56,'属性新增',54,'Attribute','save',1,1527086198,0),(57,'属性修改页面',54,'Attribute','edit',1,1527086217,0),(58,'属性更新',54,'Attribute','update',1,1527086244,0),(59,'属性删除',54,'Attribute','delete',1,1527086255,1527086265),(60,'属性批量删除',54,'Attribute','deletion',1,1527086282,0),(61,'商品列表',31,'Goods','index',1,1527347962,1527401546),(62,'商品添加页面',61,'Goods','create',1,1527347993,0),(63,'商品新增',61,'Goods','save',1,1527348008,0),(64,'商品修改页面',61,'Goods','edit',1,1527348029,0),(65,'商品更新',61,'Goods','update',1,1527348030,1527348071),(66,'商品删除',84,'Goods','delete',1,1527348093,1528033252),(67,'商品批量删除',84,'Goods','deletion',1,1527348112,1528033265),(68,'会员管理',0,'','',1,1527400556,0),(69,'会员级别管理',68,'Level','index',1,1527401569,1527435077),(70,'会员级别添加页面',69,'Level','create',1,1527401586,1527434274),(71,'会员级别新增',69,'Level','save',1,1527401599,1527434268),(72,'会员级别修改页面',69,'Level','edit',1,1527401617,1527434263),(73,'会员级别更新',69,'Level','update',1,1527401634,1527434240),(74,'会员级别删除',69,'Level','delete',1,1527401649,1527434248),(75,'会员级别批量删除',69,'Level','deletion',1,1527401665,1527434257),(76,'图片管理',0,'','',1,1527603201,0),(77,'水印管理',76,'Water','index',1,1527603238,0),(78,'水印添加页面',77,'Water','create',1,1527603444,0),(79,'水印新增',77,'Water','save',1,1527603458,0),(80,'水印修改页面',77,'Water','edit',1,1527603472,0),(81,'水印更新',77,'Water','update',1,1527603491,0),(82,'水印删除',77,'Water','delete',1,1527603510,0),(83,'水印批量删除',77,'Water','deletion',1,1527603524,1527912921),(84,'商品回收站',31,'Goods','recyclelist',1,1528032933,1528033113),(85,'商品移除',61,'Goods','recycle',1,1528033294,0),(86,'商品批量移除',61,'Goods','recycles',1,1528033397,0),(87,'商品还原',84,'Goods','restore',1,1528033441,0),(88,'商品分类显示',61,'Goods','showCat',1,1528039673,1528039689),(89,'商品属性显示',61,'Goods','showAttr',1,1528039728,0),(90,'商品属性编辑显示',61,'Goods','editAttr',1,1528039891,0),(91,'商品属性删除',61,'Goods','delAttr',1,1528040193,0),(92,'商品相册数量检测',61,'Goods','checknum',1,1528040244,0),(93,'商品相册图片删除',61,'Goods','delImg',1,1528040274,0),(94,'商品库存',61,'Goods','kucun',1,1528040306,0),(95,'前台管理',0,'','',1,1528042388,0),(96,'导航管理',95,'Nav','index',1,1528042413,0),(97,'分类搜索展示',61,'Goods','catList',1,1528105837,0),(98,'导航修改页面',96,'Nav','edit',1,1528106092,0),(99,'导航更新',96,'Goods','update',1,1528106109,1528118355),(100,'banner管理',95,'Banner','index',1,1528118392,0),(101,'banner添加页面',100,'Banner','create',1,1528118419,0),(102,'banner新增',100,'Banner','save',1,1528118442,0),(103,'banner修改页面',100,'Banner','edit',1,1528118458,0),(104,'banner更新',100,'Banner','update',1,1528118474,0),(105,'banner删除',100,'Banner','delete',1,1528118500,0),(106,'banner批量删除',100,'Banner','deletion',1,1528118517,0),(107,'联系我们',95,'Constact','index',1,1528126217,0),(108,'联系修改页面',107,'Constact','edit',1,1528184299,0),(109,'联系更新',107,'Constact','update',1,1528184316,0),(110,'广告栏位管理',95,'Advert','index',1,1528184360,0),(111,'广告栏位添加页面',110,'Advert','create',1,1528184387,1528184448),(112,'广告栏位新增',110,'Advert','save',1,1528184424,1528184433),(113,'广告栏位修改页面',110,'Advert','edit',1,1528184478,0),(114,'广告栏位更新',110,'Advert','update',1,1528184492,0),(115,'广告栏位删除',110,'Advert','delete',1,1528184508,0),(116,'广告栏位批量删除',110,'Advert','deletion',1,1528184526,0);
/*!40000 ALTER TABLE `sp_privilege` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sp_reply`
--

DROP TABLE IF EXISTS `sp_reply`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sp_reply` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '回复ID',
  `content` text NOT NULL COMMENT '回复内容',
  `member_id` mediumint(8) unsigned NOT NULL COMMENT '会员ID',
  `comment_id` mediumint(8) unsigned NOT NULL COMMENT '评论ID',
  `create_time` int(10) unsigned NOT NULL COMMENT '回复时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='回复表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sp_reply`
--

LOCK TABLES `sp_reply` WRITE;
/*!40000 ALTER TABLE `sp_reply` DISABLE KEYS */;
/*!40000 ALTER TABLE `sp_reply` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sp_role`
--

DROP TABLE IF EXISTS `sp_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sp_role` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT '角色ID',
  `name` varchar(10) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '角色名称',
  `describe` varchar(30) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '角色描述',
  `create_time` int(10) unsigned NOT NULL COMMENT '添加时间',
  `update_time` int(10) unsigned NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COMMENT='角色表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sp_role`
--

LOCK TABLES `sp_role` WRITE;
/*!40000 ALTER TABLE `sp_role` DISABLE KEYS */;
INSERT INTO `sp_role` VALUES (1,'经理','权限颇高',1526714726,1527859846),(2,'主管','商品及订单管理',1526715188,0),(3,'普通员工','一般权限',1526790249,1526959189);
/*!40000 ALTER TABLE `sp_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sp_role_privilege`
--

DROP TABLE IF EXISTS `sp_role_privilege`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sp_role_privilege` (
  `role_id` tinyint(3) unsigned NOT NULL COMMENT '角色ID',
  `pri_id` tinyint(3) unsigned NOT NULL COMMENT '权限ID',
  KEY `role_id` (`role_id`) USING BTREE,
  KEY `pri_id` (`pri_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='角色权限表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sp_role_privilege`
--

LOCK TABLES `sp_role_privilege` WRITE;
/*!40000 ALTER TABLE `sp_role_privilege` DISABLE KEYS */;
INSERT INTO `sp_role_privilege` VALUES (2,1),(2,3),(2,7),(2,8),(2,9),(2,10),(2,11),(2,12),(3,12),(3,11),(3,10),(3,9),(3,8),(3,7),(3,3),(3,1),(1,1),(1,3),(1,7),(1,8),(1,9),(1,10),(1,11),(1,12),(1,2),(1,4),(1,19),(1,20),(1,21),(1,22),(1,23),(1,24),(1,5),(1,25),(1,26),(1,27),(1,28),(1,29),(1,30),(1,6),(1,13),(1,14),(1,15),(1,16),(1,17),(1,18);
/*!40000 ALTER TABLE `sp_role_privilege` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sp_type`
--

DROP TABLE IF EXISTS `sp_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sp_type` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '类型ID',
  `name` varchar(30) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '类型名称',
  `create_time` int(10) unsigned NOT NULL COMMENT '添加时间',
  `update_time` int(10) unsigned NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COMMENT='类型表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sp_type`
--

LOCK TABLES `sp_type` WRITE;
/*!40000 ALTER TABLE `sp_type` DISABLE KEYS */;
INSERT INTO `sp_type` VALUES (1,'锅',1527748333,1528257637);
/*!40000 ALTER TABLE `sp_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sp_water`
--

DROP TABLE IF EXISTS `sp_water`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sp_water` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT '水印ID',
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '水印名称',
  `sm_water_img` varchar(150) NOT NULL DEFAULT '' COMMENT '水印缩略图',
  `water_img` varchar(150) NOT NULL DEFAULT '' COMMENT '水印图片',
  `create_time` int(10) unsigned NOT NULL COMMENT '添加时间',
  `update_time` int(10) unsigned NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='图片水印表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sp_water`
--

LOCK TABLES `sp_water` WRITE;
/*!40000 ALTER TABLE `sp_water` DISABLE KEYS */;
INSERT INTO `sp_water` VALUES (3,'萌妹','20180604\\thumb_abfd1f502107ac7dbbf981ac38a66374.jpg','20180604\\abfd1f502107ac7dbbf981ac38a66374.jpg',1527605862,1528122504),(4,'公司logo','20180604\\thumb_291c1f669c0d481ebe2c61e1b306312c.jpg','20180604\\291c1f669c0d481ebe2c61e1b306312c.jpg',1527605870,1528122498);
/*!40000 ALTER TABLE `sp_water` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-06-11 19:38:52
