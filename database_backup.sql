-- MySQL dump 10.13  Distrib 9.6.0, for macos26.3 (arm64)
--
-- Host: localhost    Database: qyzylorda_times
-- ------------------------------------------------------
-- Server version	9.6.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
SET @MYSQLDUMP_TEMP_LOG_BIN = @@SESSION.SQL_LOG_BIN;
SET @@SESSION.SQL_LOG_BIN= 0;

--
-- GTID state at the beginning of the backup 
--

SET @@GLOBAL.GTID_PURGED=/*!80000 '+'*/ '09f3a3a8-33db-11f1-b709-e584e2e3cc52:1-288';

--
-- Table structure for table `ads`
--

DROP TABLE IF EXISTS `ads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ads` (
  `id` int NOT NULL AUTO_INCREMENT,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` enum('sidebar','content_bottom') COLLATE utf8mb4_unicode_ci DEFAULT 'sidebar',
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ads`
--

LOCK TABLES `ads` WRITE;
/*!40000 ALTER TABLE `ads` DISABLE KEYS */;
INSERT INTO `ads` VALUES (1,'69fa52f03008c_1778012912.jpg','https://hubtech.kz','Тест','content_bottom','active','2026-05-05 20:28:32');
/*!40000 ALTER TABLE `ads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name_kz` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_ru` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug_kz` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug_ru` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_kz` text COLLATE utf8mb4_unicode_ci,
  `description_ru` text COLLATE utf8mb4_unicode_ci,
  `sort_order` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug_kz` (`slug_kz`),
  UNIQUE KEY `slug_ru` (`slug_ru`),
  KEY `idx_slug_kz` (`slug_kz`),
  KEY `idx_slug_ru` (`slug_ru`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Жаңалықтар','Новости','zhanalyqtar','novosti','Жалпы жаңалықтар','Общие новости',1,'2026-05-03 07:34:14'),(2,'Саясат','Политика','sayasat','politika','Саяси жаңалықтар','Политические новости',2,'2026-05-03 07:34:14'),(3,'Қоғам','Общество','qogam','obschestvo','Қоғамдық өмір','Общественная жизнь',3,'2026-05-03 07:34:14'),(4,'Экономика','Экономика','ekonomika','ekonomika','Экономикалық жаңалықтар','Экономические новости',4,'2026-05-03 07:34:14'),(5,'Білім','Образование','bilim','obrazovanie','Білім беру жүйесі','Система образования',5,'2026-05-03 07:34:14'),(6,'Ауыл шаруашылығы','Сельское хозяйство','auyl-sharuashylygy','selskoe-hozyaystvo','Ауыл шаруашылығы жаңалықтары','Новости сельского хозяйства',6,'2026-05-03 07:34:14'),(7,'Спорт','Спорт','sport','sport','Спорттық жаңалықтар','Спортивные новости',7,'2026-05-03 07:34:14');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `post_id` int NOT NULL,
  `author_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment_text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `author_ip` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('pending','approved','rejected') COLLATE utf8mb4_unicode_ci DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `moderated_at` timestamp NULL DEFAULT NULL,
  `moderated_by` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `moderated_by` (`moderated_by`),
  KEY `idx_post_status` (`post_id`,`status`),
  KEY `idx_status` (`status`),
  CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`moderated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (5,11,'муха ','муха ебаный','::1','approved','2026-10-06 13:37:17','2026-10-06 13:37:27',NULL);
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `currency_cache`
--

DROP TABLE IF EXISTS `currency_cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `currency_cache` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usd_rate` decimal(10,4) DEFAULT NULL,
  `eur_rate` decimal(10,4) DEFAULT NULL,
  `rub_rate` decimal(10,4) DEFAULT NULL,
  `cached_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `expires_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `currency_cache`
--

LOCK TABLES `currency_cache` WRITE;
/*!40000 ALTER TABLE `currency_cache` DISABLE KEYS */;
INSERT INTO `currency_cache` VALUES (8,455.6300,507.8900,5.6500,'2026-10-28 07:14:02','2026-10-29 07:14:02'),(9,457.0900,508.4200,5.6700,'2026-10-29 18:24:50','2026-10-30 18:24:50'),(10,453.6400,508.1700,5.5900,'2026-11-03 12:09:15','2026-11-04 12:09:15');
/*!40000 ALTER TABLE `currency_cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post_tags`
--

DROP TABLE IF EXISTS `post_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `post_tags` (
  `post_id` int NOT NULL,
  `tag_id` int NOT NULL,
  PRIMARY KEY (`post_id`,`tag_id`),
  KEY `tag_id` (`tag_id`),
  CONSTRAINT `post_tags_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `post_tags_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_tags`
--

LOCK TABLES `post_tags` WRITE;
/*!40000 ALTER TABLE `post_tags` DISABLE KEYS */;
/*!40000 ALTER TABLE `post_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `posts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `title_kz` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug_kz` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content_kz` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `excerpt_kz` text COLLATE utf8mb4_unicode_ci,
  `title_ru` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug_ru` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content_ru` text COLLATE utf8mb4_unicode_ci,
  `excerpt_ru` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `views` int DEFAULT '0',
  `status` enum('draft','published') COLLATE utf8mb4_unicode_ci DEFAULT 'draft',
  `is_featured` tinyint(1) DEFAULT '0',
  `is_announcement` tinyint(1) DEFAULT '0',
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug_kz` (`slug_kz`),
  KEY `category_id` (`category_id`),
  KEY `user_id` (`user_id`),
  KEY `idx_slug_kz` (`slug_kz`),
  KEY `idx_slug_ru` (`slug_ru`),
  KEY `idx_status` (`status`),
  KEY `idx_published_at` (`published_at`),
  KEY `idx_views` (`views`),
  KEY `idx_featured` (`is_featured`),
  KEY `idx_announcement` (`is_announcement`),
  FULLTEXT KEY `idx_search_kz` (`title_kz`,`content_kz`),
  FULLTEXT KEY `idx_search_ru` (`title_ru`,`content_ru`),
  CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (9,1,1,'Клубтағы бір түн: Улан жайлы жұрт неге айтып жүр?','klubtagy-bir-tun-ulan-zhayly-zhurt-nege-aytyp-zhur','<p>Өткен демалыста қаладағы танымал клубтардың бірінде болған оқиға әлеуметтік желіде қызу талқыға түсті. Әңгіме ортасында — Улан есімді жігіт.</p><p>&nbsp;</p><p>Куәгерлердің айтуынша, кеш әдеттегідей басталған: қатты музыка, неон жарығы, би алаңындағы адамдар. Улан достарымен бірге келген және көпшіліктің назарын бірден өзіне аударған.</p><p>&nbsp;</p><p>Кейін әлеуметтік желілерде оның клубта белгісіз жігітпен бірге билеп жүрген видеолары тарай бастады. Осыдан кейін интернет қолданушылары оның жеке өмірі мен ориентациясы жайлы түрлі пікір айта бастады.</p><p>&nbsp;</p><p>Алайда Уландын таныстары оның мұндай әңгімелерге аса мән бермейтінін айтады. Кейбір желі қолданушылары да оны қолдап шықты.</p><p>&nbsp;</p><p>«Әр адам өз өмірін өзі таңдауға құқылы», — деп жазды пікір қалдырушылардың бірі.</p><p>&nbsp;</p><p>Бұл оқиға желіде үлкен пікірталас тудырды. Бірі Уландын батылдығын қолдаса, енді бірі қоғамның адамның жеке өміріне тым көп араласатынын айтты.</p><p>&nbsp;</p><p>Қалай болғанда да, бұл жағдай бір нәрсені көрсетті: қазіргі заманда қарапайым клубтағы кештің өзі әп-сәтте бүкіл интернет талқылайтын оқиғаға айналып кетуі мүмкін.</p>','Өткен демалыста қаладағы танымал клубтардың бірінде болған оқиға әлеуметтік желіде қызу талқыға түсті. Әңгіме ортасында — Улан есімді жігіт.&nbsp;Куәгерлердің айтуынша, кеш әдеттегідей басталған: қатты музыка, неон жарығы, би алаңындағы адамдар. Улан достарымен бірге келген және көпшіліктің назарын бірден өзіне аударған.&nbsp;Кейін әлеуметтік желілерде оның клубта белгісіз жігітпен бірге билеп жүрген видеолары тарай бастады. Осыдан кейін интернет қолданушылары оның жеке өмірі мен ориентациясы жа...','Қате орын алды: SQLSTATE[22001]: String data, right truncated: 1406 Data too long for column \'excerpt_kz\' at row 1','ate-oryn-aldy-sqlstate-22001-string-data-right-truncated-1406-data-too-long-for-column-excerpt-kz-at-row-1','<p>В минувшие выходные в одном из популярных клубов города произошла история, которая быстро разлетелась по социальным сетям. Главным героем обсуждений стал парень по имени Улан.</p><p>&nbsp;</p><p>По словам очевидцев, вечер начинался вполне обычно: громкая музыка, неоновые огни и толпы людей на танцполе. Улан пришёл вместе с друзьями и, как рассказывают посетители клуба, сразу оказался в центре внимания благодаря своему яркому стилю и уверенности.</p><p>&nbsp;</p><p>Позже в сети начали появляться видео, где Улан танцует с незнакомым парнем. Некоторые пользователи начали активно обсуждать его ориентацию и личную жизнь. Однако сам Улан, по словам знакомых, спокойно относится к слухам и не считает нужным оправдываться перед обществом.</p><p>&nbsp;</p><p>«Каждый имеет право быть собой», — написал один из пользователей в комментариях, поддержав парня.</p><p>&nbsp;</p><p>История быстро превратилась в повод для споров в интернете: одни поддержали Улана за смелость и открытость, другие раскритиковали излишнее внимание к чужой личной жизни.</p><p>&nbsp;</p><p>Так или иначе, эта ночь показала одну простую вещь — в эпоху социальных сетей даже обычный вечер в клубе может превратиться в вирусную историю.</p>','В минувшие выходные в одном из популярных клубов города произошла история, которая быстро разлетелась по социальным сетям. Главным героем обсуждений стал парень по имени Улан.&nbsp;По словам очевидцев, вечер начинался вполне обычно: громкая музыка, неоновые огни и толпы людей на танцполе. Улан пришёл вместе с друзьями и, как рассказывают посетители клуба, сразу оказался в центре внимания благодаря своему яркому стилю и уверенности.&nbsp;Позже в сети начали появляться видео, где Улан танцует с не...','6a17edd99c4da_1779953113.jpg',5,'published',0,1,'2026-05-28 07:19:00','2026-05-28 07:20:49','2026-11-03 12:09:45'),(11,NULL,NULL,'«Әділет» арқылы жүргізуші куәлігін алу: жолдарда жағдай қиындауы мүмкін бе?','adilet-arqyly-zhurgizushi-kualigin-alu-zholdarda-zhagday-qiyndauy-mumkin-be','<p>Қазақстанда жүргізуші куәлігін алу тәртібіне қатысты жаңалық қоғам арасында қызу талқылана бастады. «Әділет» жүйесі арқылы жүргізуші куәлігін алу мүмкіндігі туралы ақпарат тарағаннан кейін әлеуметтік желілерде түрлі пікірлер айтылуда. Бір тарап бұл өзгерістер азаматтардың уақытын үнемдеп, мемлекеттік қызметтерді қолжетімді етеді деп есептесе, екінші тарап жол қауіпсіздігіне қатысты алаңдаушылық білдіруде.</p><p>Ең басты мәселе — болашақ жүргізушілердің дайындығы. Автокөлікті басқару тек жол ережелерін білумен шектелмейді. Жүргізуші нақты жол жағдайында дұрыс шешім қабылдап, басқа көліктермен арақашықтықты сақтап, жаяу жүргіншілерге және жол қозғалысының басқа қатысушыларына қауіп төндірмеуі керек.</p><p>Егер жүргізуші куәлігін алу талаптары айтарлықтай жеңілдейтін болса, қоғамда тәжірибесі жеткіліксіз жүргізушілер жолға көптеп шығуы мүмкін деген қауіп бар. Бұл әсіресе көлік қозғалысы тығыз қалаларда маңызды мәселе болуы ықтимал.</p><p>Жас және тәжірибесіз жүргізушілер үшін алғашқы айлар ерекше маңызды. Теориялық білім болғанымен, күтпеген жағдай кезінде дұрыс әрекет ету үшін тәжірибе қажет. Сондықтан жүргізушілерді даярлау сапасы мен емтихан талаптарының қалай ұйымдастырылатыны жол қауіпсіздігіне тікелей әсер етеді.</p><p>Әлеуметтік желілерде кейбір қолданушылар жаңа тәртіп жол-көлік оқиғаларының көбеюіне әкелуі мүмкін деп алаңдауда. Алайда мұндай болжамды нақты статистикасыз факт ретінде айтуға болмайды. Жаңа жүйе енгізілген жағдайда оның нәтижесін жол-көлік оқиғаларының статистикасы, емтихан нәтижелері және жаңа жүргізушілердің қатысуымен болған оқиғалар арқылы бағалау қажет.</p><p>Сонымен қатар цифрландырудың оң жақтары да бар. Құжаттарды онлайн рәсімдеу кезектерді азайтып, азаматтардың уақытын үнемдеуге және мемлекеттік қызметтерді алуды жеңілдетуге мүмкіндік береді. Бірақ жүргізуші куәлігі қарапайым құжат емес — оның иесі жол қозғалысының толыққанды қатысушысына айналады.</p><p>Сондықтан негізгі сұрақ куәлікті қаншалықты тез алуға болатынында емес, жүргізушінің жолға шығуға қаншалықты дайын екенінде.</p><p>Егер жаңа тәртіп жүргізушілерді даярлау мен тексеру талаптарын сақтай отырып енгізілсе, цифрландыру азаматтарға ыңғайлы болуы мүмкін. Ал егер тәжірибелік дайындық пен бақылау әлсіресе, жол қауіпсіздігіне қатысты сұрақтар туындайды.</p><p>Қазір қоғам үшін ең маңыздысы — жаңа тәртіптің нақты талаптары мен қауіпсіздік шараларының ашық түсіндірілуі.</p>','Қазақстанда жүргізуші куәлігін алу тәртібіне қатысты жаңалық қоғам арасында қызу талқылана бастады. «Әділет» жүйесі арқылы жүргізуші куәлігін алу мүмкіндігі туралы ақпарат тарағаннан кейін әлеуметтік желілерде түрлі пікірлер айтылуда. Бір тарап бұл өзгерістер азаматтардың уақытын үнемдеп, мемлекеттік қызметтерді қолжетімді етеді деп есептесе, екінші тарап жол қауіпсіздігіне қатысты алаңдаушылық білдіруде.Ең басты мәселе — болашақ жүргізушілердің дайындығы. Автокөлікті басқару тек жол ережелерін ...','Права через «Әділет»: может ли новый порядок изменить ситуацию на дорогах Казахстана?','prava-cherez-d-let-mozhet-li-novyy-poryadok-izmenit-situatsiyu-na-dorogah-kazahstana','<p>Новости, связанные с порядком получения водительских прав через систему «Әділет», вызвали активное обсуждение. Одни считают, что цифровизация способна сделать государственную услугу быстрее и удобнее. Другие опасаются, что возможное упрощение процедуры может привести к появлению на дорогах большего количества недостаточно подготовленных водителей.</p><p>Главный вопрос заключается не только в скорости оформления водительского удостоверения, но и в качестве подготовки человека перед тем, как он самостоятельно сядет за руль.</p><p>Управление автомобилем требует не только знания дорожных знаков и правил. Водителю необходимо уметь оценивать дорожную ситуацию, соблюдать безопасную дистанцию, вовремя реагировать на действия других участников движения и принимать правильные решения в непредвиденных обстоятельствах.</p><p>Именно поэтому возможное упрощение требований вызывает вопросы. Если получение водительского удостоверения станет значительно легче, часть общества опасается увеличения количества неопытных водителей.</p><p>Особенно важным становится вопрос практической подготовки. Человек может хорошо знать теорию, однако реальное движение существенно отличается от экзаменационных вопросов. Плотный поток автомобилей, пешеходные переходы, плохая погода и неожиданные действия других водителей требуют практического опыта.</p><p>В социальных сетях уже можно встретить предположения о том, что изменения способны привести к росту количества ДТП и даже «хаосу на дорогах». Однако говорить об этом как об установленном факте преждевременно. Для подобных выводов необходимы официальная статистика и результаты работы нового порядка после его внедрения.</p><p>При этом сама цифровизация государственных услуг имеет очевидные преимущества. Онлайн-оформление может сократить очереди, уменьшить количество бумажных документов и сэкономить время граждан.</p><p>Но водительское удостоверение отличается от многих других документов. Получая его, человек получает право управлять транспортным средством и становится полноценным участником дорожного движения. Ошибка неподготовленного водителя может создавать опасность не только для него самого, но и для пассажиров, пешеходов и других автомобилистов.</p><p>Поэтому ключевой вопрос заключается в том, останутся ли требования к знаниям и практическим навыкам водителей достаточно строгими.</p><p>Если новая система просто перенесёт часть бюрократических процедур в цифровой формат, сохранив полноценные экзамены и проверку навыков, она может сделать получение государственных услуг удобнее. Если же одновременно будут значительно снижены требования к подготовке будущих водителей, обществу потребуется внимательно следить за последствиями таких изменений.</p><p>Оценивать результат необходимо на основании данных: количества выданных удостоверений, результатов экзаменов, числа новых водителей и статистики ДТП с их участием.</p><p>Главная задача любой реформы в этой сфере должна оставаться неизменной — удобство получения услуги не должно достигаться за счёт безопасности дорожного движения.</p>','Новости, связанные с порядком получения водительских прав через систему «Әділет», вызвали активное обсуждение. Одни считают, что цифровизация способна сделать государственную услугу быстрее и удобнее. Другие опасаются, что возможное упрощение процедуры может привести к появлению на дорогах большего количества недостаточно подготовленных водителей.Главный вопрос заключается не только в скорости оформления водительского удостоверения, но и в качестве подготовки человека перед тем, как он самостоят...','6ac4f8cfda099_1791293647.jpeg',4,'published',0,0,'2026-10-06 13:32:00','2026-10-06 13:34:08','2026-10-21 07:12:14');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `settings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `setting_key` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `setting_value` text COLLATE utf8mb4_unicode_ci,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `setting_key` (`setting_key`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'site_name','Qyzylorda Times','2026-05-03 07:34:14'),(2,'site_description_kz','Қызылорда облысының ресми ақпарат агенттігі','2026-05-03 07:34:14'),(3,'site_description_ru','Официальное информационное агентство Кызылординской области','2026-05-03 07:34:14'),(4,'contact_phone','8 (7242) 27-01-01','2026-05-03 07:34:14'),(5,'contact_email','editor@qyzylordatimes.kz','2026-05-03 07:34:14'),(6,'contact_address_kz','Қызылорда қ., Бейбарыс сұлтан, 1','2026-05-03 07:34:14'),(7,'contact_address_ru','г. Кызылорда, ул. Бейбарыс султан, 1','2026-05-03 07:34:14');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tags` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name_kz` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_ru` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `idx_slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags`
--

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('admin','editor') COLLATE utf8mb4_unicode_ci DEFAULT 'editor',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'zyndan_admin','admin@qyzylordatimes.kz','$2y$12$9U7epWMTg23pFRqOk06c0e4h3w/MFQ.TTRjpdp6Mi/981AaOTgfwm','Администратор','admin','2026-05-03 07:34:14');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `videos`
--

DROP TABLE IF EXISTS `videos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `videos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title_kz` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_ru` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `youtube_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `published_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_published_at` (`published_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `videos`
--

LOCK TABLES `videos` WRITE;
/*!40000 ALTER TABLE `videos` DISABLE KEYS */;
/*!40000 ALTER TABLE `videos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `weather_cache`
--

DROP TABLE IF EXISTS `weather_cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `weather_cache` (
  `id` int NOT NULL AUTO_INCREMENT,
  `temperature` decimal(5,2) DEFAULT NULL,
  `condition` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cached_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `expires_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `weather_cache`
--

LOCK TABLES `weather_cache` WRITE;
/*!40000 ALTER TABLE `weather_cache` DISABLE KEYS */;
INSERT INTO `weather_cache` VALUES (16,12.00,'ясно','01d','2026-10-28 07:14:02','2026-10-28 08:14:02'),(17,3.00,'ясно','01n','2026-10-29 18:24:49','2026-10-29 19:24:49'),(18,2.00,'ясно','01n','2026-10-29 19:25:56','2026-10-29 20:25:56'),(19,16.00,'ясно','01d','2026-10-30 08:03:11','2026-10-30 09:03:11'),(20,16.00,'ясно','01d','2026-10-30 09:04:39','2026-10-30 10:04:39'),(21,16.00,'ясно','01d','2026-10-30 11:14:16','2026-10-30 12:14:16'),(22,15.00,'ясно','01d','2026-11-03 12:09:15','2026-11-03 13:09:15');
/*!40000 ALTER TABLE `weather_cache` ENABLE KEYS */;
UNLOCK TABLES;
SET @@SESSION.SQL_LOG_BIN = @MYSQLDUMP_TEMP_LOG_BIN;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-11-03 18:01:43
