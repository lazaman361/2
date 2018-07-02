-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: sportisimo
-- ------------------------------------------------------
-- Server version	5.7.14

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
-- Table structure for table `authors`
--

DROP TABLE IF EXISTS `authors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `authors` (
  `author_id` int(11) NOT NULL,
  `first_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`author_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `authors`
--

LOCK TABLES `authors` WRITE;
/*!40000 ALTER TABLE `authors` DISABLE KEYS */;
INSERT INTO `authors` VALUES (1,'Marko','Markovic','marmar','a@a.a','064361'),(2,'Milica','Miljkovic','milka','d@r.a','323'),(3,'Ivana','Ivanovic','iva','b@b.b','063987');
/*!40000 ALTER TABLE `authors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `tip` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `icon_path` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tab_name` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `menu_name` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'1','all-icon.png','Sportisimo',NULL),(2,'2',NULL,'Sign up','Sign Up'),(3,'3',NULL,'Login','Login'),(4,'4',NULL,'Logout','Logout'),(5,'5','basketball-icon.png','Basketball News','Basketball'),(6,'5','soccer-icon.png','Soccer News','Soccer'),(7,'5','tennis-icon.png','Tennis News','Tennis'),(8,'5','other-icon','Other News','Other'),(9,'6',NULL,'Add news...',NULL);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `date_added` datetime DEFAULT CURRENT_TIMESTAMP,
  `news_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `content` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`comment_id`),
  KEY `fk_news_id_idx` (`news_id`),
  KEY `fk_user_id_idx` (`user_id`),
  CONSTRAINT `fk_news_id` FOREIGN KEY (`news_id`) REFERENCES `news` (`news_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (1,'2017-08-16 21:27:47',12,1,'Wow, that\'s a good jump.'),(2,'2017-08-16 21:28:19',11,1,'Is ice-hockey a real sport?'),(3,'2017-08-16 21:29:11',12,2,'You bet it is!\r\nAdrenalin rush...'),(4,'2017-08-16 21:30:00',11,2,'It\'s the best sport ever!\r\nGo ice-hockey!'),(5,'2017-08-16 21:30:37',11,NULL,'Hey guys, keep it cool...'),(6,'2017-08-16 21:31:11',11,3,'I agree :)'),(7,'2017-08-16 21:31:31',11,3,'Best wishes to everyone');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `facts`
--

DROP TABLE IF EXISTS `facts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `facts` (
  `fact_id` int(11) NOT NULL AUTO_INCREMENT,
  `fact` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`fact_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `facts`
--

LOCK TABLES `facts` WRITE;
/*!40000 ALTER TABLE `facts` DISABLE KEYS */;
INSERT INTO `facts` VALUES (1,'A race car with a wood-burning engine finished 3rd in the 1927 Indianapolis 500.'),(2,'Boxing legend Rocky Marciano invented the fax machine.'),(3,'The grass at Wimbledon was kept two inches long until 1949 when an English player was bitten by a snake.'),(4,'If Michael Phelps were a country, he\'d rank no. 35 on the all-time Olympic gold medal list ahead of 97 nations.'),(5,'\"Federer\" can be typed entirely with the left hand.'),(6,'There are 18 minutes of total action in a baseball game.'),(7,'At the first modern Olympics, winners were awarded silver medals.'),(8,'China did not win an olympic medal until 1985. At the 2008 Beijing games, the Chinese won 100 medals.'),(9,'Tiger Woods\' actual name is Eldrick Woods. He was named Tiger after one of his father\'s friends, who was a soldier in Vietnam. '),(10,'Shaquille O\'Neal had a rap hit.'),(11,'The game of volleyball was invented in 1895.'),(12,'Most volleyball players jump about 300 times a match.'),(13,'A professional soccer player runs 4.8 kilometers in an average soccer game.'),(14,'The fastest and most efficient swim stroke is the crawl/ freestyle.'),(15,'An hour of vigorous swimming will burn up to 650 calories. It burns off more calories than walking or biking.'),(16,'As with any other type of exercise you need to stay hydrated while swimming and you need to drink water.'),(17,'The record for most marathons run on consecutive days is 365.'),(18,'Usain Bolt\'s world record of 9.58 seconds for 100 metres equals an average speed of 37.58 km/h.');
/*!40000 ALTER TABLE `facts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `news` (
  `news_id` int(11) NOT NULL AUTO_INCREMENT,
  `md5` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `last_updated` datetime DEFAULT NULL,
  `author_id` int(11) DEFAULT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `thumbnail` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content_preview` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`news_id`),
  KEY `fk_author_id_idx` (`author_id`),
  KEY `fk_category_id_idx` (`category_id`),
  KEY `idx_md5` (`md5`),
  CONSTRAINT `fk_author_id` FOREIGN KEY (`author_id`) REFERENCES `authors` (`author_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `fk_category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news`
--

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` VALUES (1,'c4ca4238a0b923820dcc509a6f75849b','2017-08-16 19:44:07','2017-08-16 21:16:38',1,'Maria Sharapova: Five-time Grand Slam winner given US Open wildcard','thumbnail-maria-sharapova.jpg','Maria Sharapova is set to play in her first Grand Slam since her 15-month drugs ban after being given a wildcard for the US Open main draw.','<img class=\"imageNews\" src=\"images/maria-sharapova.jpg\" alt=\"Maria Sharapova\">\r\nFormer world number one Sharapova, 30, returned to action in April but was denied a wildcard for the French Open.\r\nThe Russian five-time major winner was eligible for a place in Wimbledon qualifying through her world ranking, but missed the event with an injury.\r\nThe US Open will take place at Flushing Meadows from 28 August to 10 September.\r\n\"Her suspension under the terms of the tennis anti-doping program was completed and therefore was not one of the factors weighed in our wildcard selection process,\" The United States Tennis Association (USTA), which oversees the US Open, told BBC Sport.\r\n\"Consistent with past practice, a wildcard was provided to a past US champion who needed the wildcard for entry into the main draw.\r\n\"Previous US Open champions who have received US Open main draw wildcards include Martina Hingis, Lleyton Hewitt, Kim Cljisters and Juan Martin del Potro.\r\n\"Additionally, Sharapova has volunteered to speak to young tennis players at the USTA National Campus about the importance of the tennis anti-doping program and the personal responsibility each player has to comply with the program\'s requirements.\"\r\n<img class=\"imageNews\" src=\"images/twitter-billie.jpg\" alt=\"Billie-twitted\">\r\nSharapova returned to playing without a ranking in April and rose to 211 in the world after receiving wildcards in Stuttgart, Madrid and Rome.\r\nShe hoped to receive a wildcard for the French Open, but was denied one for both the main draw and qualifying rounds.\r\nThe 2006 US Open champion then elected to try to reach the Wimbledon main draw through qualifying, however she pulled out of the tournament having failed to recover from the muscle injury she sustained at the Italian Open the previous month.\r\nShe is currently suffering from a left forearm injury which forced her to pull out of this week\'s Cincinnati Open. She withdrew from the Stanford Bank of the West Classic earlier this month after suffering the injury in her first-round match.\r\nIn June 2016, Sharapova was punished with a two-year doping ban for testing positive for heart disease drug meldonium at the 2016 Australian Open.\r\nIt was reduced to 15 months following her appeal to the Court of Arbitration for Sport.',7),(2,'c81e728d9d4c2f636f067f89cc14862c','2017-08-16 19:48:47','2017-08-16 21:16:42',2,'Laver Cup teams: Tomas Berdych selected for Europe, Nick Kyrgios may join Rest of the World side','thumbnail-tomas-berdych.jpg','Czech tennis player Tomas Berdych will join Roger Federer and Rafael Nadal on the Europe side to face the Rest of the World next month at the inaugural edition of the Laver Cup.','Captain Bjorn Borg announced on Tuesday that Berdych will join the host side for the Ryder Cup-style event pitting a six-man Europe side coached by tennis great Borg against John McEnroeâ€™s opposition.\r\n<img class=\"imageNews\" src=\"images/tomas-berdych.jpg\" alt=\"Tomas Berdych\">\r\nMcEnroeâ€™s team will include Americans Sam Querrey, Jack Sock and John Isner as well as Canadaâ€™a Milos Raonic. There are late hopes of trying to convince Australian Nick Kyrgios to participate.\r\nBorgâ€™s selection will feature backups for Federer and Nadal in the form of Marin Cilic and Dominic Thiem for the September 22-24 competition to be played in Prague.\r\n<img class=\"imageNews\" src=\"images/nick-kyrgios.jpg\" alt=\"Billie-twitted\">\r\nâ€œTomas signalled early he wanted to be part of this innovative new tournament and Iâ€™m delighted he will be joining the team,â€ Borg said.\r\nâ€œIt shows the depth in our line-up when we can add a quality player who made last monthâ€™s Wimbledon semi-finals as a captainâ€™s pick.â€\r\nBerdych, 31 and a 2010 Wimbledon runner-up, has been a consistent performer throughout his career. The Czech has played seven grand slam semi-finals and has reached the last four at all of the majors.\r\n<p>\r\n    â€œIâ€™ve known some of my teammates for a very long time and have a lot of respect for all of them,â€ Berdych said.\r\n    â€œTo play alongside them in an event like this will be a different experience and I canâ€™t wait to be part of it.\r\n    â€œTo play in my home city of Prague in front of our amazing Czech fans just makes it even more special.â€\r\n    Final team selections will be made in the coming weeks. The tournament is named in honour of Australian tennis great Rod Laver, the only man to win two calendar-year grand slams.\r\n</p>',7),(3,'eccbc87e4b5ce2fe28308fd9f2a7baf3','2017-08-16 20:13:01','2017-08-16 21:16:46',3,'Rafael Nadal to return to number one after Roger Federer\'s Cincinnati withdrawal','thumbnail-rafa.jpg','Rafael Nadal will be the new world number one from next Monday after Roger Federer withdrew from the Cincinnati Masters with a back injury.','The Swiss 19-time Grand Slam winner was the only player who could have denied Spain\'s Nadal taking the top spot in the rankings from Andy Murray.\r\n<img class=\"imageNews\" src=\"images/rafa.jpg\" alt=\"Tomas Berdych\">\r\nFederer was injured in Sunday\'s Rogers Cup final defeat by Alexander Zverev.\r\nBriton Murray pulled out of Cincinnati last week as he continues to recover from a hip problem.\r\nReigning French Open champion Nadal returns to the top of the rankings for the first time since July 2014.\r\nThe 31-year-old went out of the Rogers Cup in the last 16 against wildcard Denis Shapovalov.\r\n<p>\r\nFederer went all the way to the final before losing to 20-year-old German Zverev in Montreal - the Swiss\' first tournament since winning Wimbledon for the eighth time in July.\r\n\"I am very sorry to pull out,\" said the world number three. \"Cincinnati has some of the best fans in the world and I am sorry I will miss them.\r\n\"Unfortunately, I tweaked my back in Montreal and I need to rest this week.\"\r\nThe Cincinnati Masters leads up to the the US Open, the final Grand Slam of the year, which begins on 28 August.\r\n</p>\r\nFederer, 36, joins fellow top 10 players Murray, Kei Nishikori and Marin Cilic in withdrawing, while 2016 US Open winner Stan Wawrinka and 12-time Grand Slam champion Novak Djokovic will miss the rest of the season.',7),(4,'a87ff679a2f3e71d9181a67b7542122c','2017-08-16 20:19:12','2017-08-16 21:16:49',3,'NBA heads to the Holy Land to develop talent, promote values','thumbnail-latest-news.jpg','The NBA is heading to the Holy Land this week, bringing together some of the top emerging talent from across Europe as part of the leagueâ€™s push to attract more foreign players and expand its global reach.','<p>\r\nAn NBA delegation, led by Commissioner Adam Silver, is in Israel as part of â€œBasketball Without Borders,â€ a program that hosts training camps for top teenage players throughout the world. The visit comes at a time when Silver is seeking ways to make improvements to a league that, while enjoying a surge in popularity, has seen its product impacted by the dominance of a handful of teams and a recent trend of healthy superstars skipping games to rest.\r\n</p>\r\n<p>\r\nIn an interview, Silver said the program aims to give players who have a legitimate chance of reaching the professional ranks a cultural and athletic experience that would be hard to match.\r\n</p>\r\n<p>\r\nâ€œItâ€™s a realization that in order to develop as an elite player at a relatively young age, you need to begin competing against other elite players. And also you need the benefit of top notch coaching,â€ he said.\r\n</p>\r\n<p>\r\nSome 60 of the top Under-17 players across Europe will participate- including 40 boys and 20 girls. They will get a chance to train under current and former NBA players and coaches, including Israelâ€™s Omri Casspi, a new member of the champion Golden State Warriors, and Hall of Famer David Robinson, as well as leading figures from European basketball.\r\n</p>\r\n<p>\r\nOff the court, the program also promotes cultural awareness.\r\n</p>',5),(5,'e4da3b7fbbce2345d7772b0674a318d5','2017-08-16 20:26:36','2017-08-16 21:16:51',2,'Kyrie Irving willing to sign extension if traded to Spurs','thumbnail-spurs.jpg','It had been a while since we\'d heard any update on the bombshell trade request Kyrie Irving made to the Cleveland Cavaliers, but that changed Tuesday morning with Adrian Wojnarowski\'s monster report that brought everything up to speed. ','<img class=\"imageNews\" src=\"images/kyrie-irving.jpg\" alt=\"Kyrie Irving\">\r <p>\r     The biggest update was that the Cavs are operating on the assumption that LeBron James is leaving next summer, which is driving their desire to get a young star back in return for Irving, instead of say, a few solid veterans to put around James. Related to that, the Cavs are reportedly keyed in on Kristaps Porzingis in any potential deal with the Knicks.\r     As for the San Antonio Spurs, another team that was reportedly on Irving\'s shortlist, Wojnarowski reported that the All-Star guard is willing to sign an extension in San Antonio should he be traded there. Via ESPN:\r </p>\r <p>\r     The Spurs have interest in Irving, league sources say, and Irving\'s willingness to commit to an extension with the Spurs makes for legitimate win-now deal possibilities for Cleveland.\r </p>\r <p>\r     That Irving is willing to sign an extension is good news for the Spurs, but unfortunately for them, the Cavs\' current insistence on getting young talent back in any deal is problematic for San Antonio.\r     Aside from Kawhi Leonard -- who the Spurs are absolutely not trading -- there is no one young and talented enough to work as the centerpiece of an Irving trade.\r </p>',5),(6,'1679091c5a880faf6fb5e6087eb1b2dc','2017-08-16 20:32:56','2017-08-16 21:16:54',1,'NBA trade rumors','thumbnail-nba.jpg','Kristaps Porzingis emerges as primary target in Kyrie Irving trade search','<img class=\"imageNews\" src=\"images/kristaps-porzingis.jpg\" alt=\"Kristaps Porzingis\">\r <p>\r     It\'s clear the Cavs have been looking for a blue-chip prospect in any potential trade for star guard Kyrie Irving. It\'s even gotten to the point where Suns rookie Josh Jackson is the sticking point in a deal being completed. But now Cleveland may have its eyes on a certain basketball unicorn playing in New York City.\r \r     Knicks forward Kristaps Porzingis has become a \"primary target\" for the Cavs, according to ESPN\'s Adrian Wojnarowski. As Cleveland continues its search for a trade partner â€” Wojnarowski calls an Irving trade \"inevitable\" â€” the franchise is moving forward under the assumption LeBron James won\'t return following the 2017-18 season, thus the need for a young, emerging star like Porzingis.\r </p>\r <p>\r     That\'s not to say the Cavs wouldn\'t jump at the chance to re-sign James next summer, but owner Dan Gilbert and new general manager Koby Altman understand they cannot be reactive in this situation and risk another nosedive in the standings like the last time James left Cleveland. That\'s why the Cavs have looked into acquiring players like Jackson, Porzingis, Celtics rookie Jayson Tatum and Nuggets second-year guard Jamal Murray, according to Wojnarowski.\r \r     The problem with adding Porzingis? The Cavs would be forced to take on Joakim Noah\'s albatross of a contract. Noah is owed more than $55 million over the next three years after signing a four-year, $72 million deal with the Knicks in the summer of 2016. Wojnarowski describes the conversation as a \"nonstarter\" for New York.\r </p>\r <p>\r     Further complicating matters is Porzingis\' relationship with the Knicks organization. This offseason has been a tumultuous one for the 7-3 monster out of Latvia, as he has seen his favorite assistant coach fired and his name dangled in trade talks, most recently in a report stating former Knicks president Phil Jackson wanted to add Lonzo Ball by trading Porzingis for the No. 1 pick in the 2017 NBA Draft.\r \r     Porzingis has done his best to quell concerns by publicly stating he considers New York \"home\" and wants to stay with the Knicks for his entire career. Maybe the removal of Phil Jackson will help put Porzingis\' mind at ease, but with these new rumors and the constant drama surrounding a possible trade of Carmelo Anthony, the Knicks and Porzingis may realize it\'s best to part sooner rather than later.\r \r     For now, the Cavs will keep perusing the NBA landscape in the hopes a team grows impatient and wants to make a big splash for Irving. Will the Knicks reach that point with Porzingis?\r </p>',5),(7,'8f14e45fceea167a5a36dedd4bea2543','2017-08-16 20:37:13','2017-08-16 21:16:56',1,'Griezmann To Make Shock Man Utd U-Turn?','thumbnail-griezmann.jpg','Atletico Madrid striker Antoine Griezmann, who is believed to have snubbed Manchester United earlier this window, could reportedly make a surprising U-turn on his decision.','The Frenchman was heavily tipped to join Jose Mourinho\'s side ahead of the new campaign, but once news broke that Atletico would not be able to make any signings in this window, the player seemingly decided to stay with the Rojiblancos.\r Griezmann admitted that leaving the club while they were under a transfer ban would be unfair, which fans responded well to.\r \r <img class=\"imageNews\" src=\"images/griezmann.jpg\" alt=\"Griezmann\">\r \r However, according Don Balon, the player is still said to be considering his future at Atletico, and will apparently leave if the club let goalkeeper Jan Oblak join Paris Saint-Germain.\r \r The French giants are said to be chasing the shot-stopper\'s signature ahead of the new campaign, following their world record signing of former FC Barcelona forward Neymar.\r \r Griezmann apparently feels that selling Oblak would show a lack of ambition from the club, and he would therefore consider a move away as a result.\r \r <p>\r     The 26-year-old has scored 83 goals and assisted a further 25 strikes in 160 appearance for Atletico since joining them in 2014.\r </p>',6),(8,'c9f0f895fb98ab9159f51fd0297e236d','2017-08-16 20:42:02','2017-08-16 21:16:58',2,'Liverpool in box seat for Champions League qualification after win at Hoffenheim','thumbnail-trent-alexander-arnold.jpg','Teenager Trent Alexander-Arnold curled in a magnificent free kick on his European debut to set Liverpool on the way to a 2-1 win at Hoffenheim on Tuesday, putting them on the brink of Champions League group stage place.','Liverpool goalkeeper Simon Mignolet saved an early penalty and James Milner\'s shot was deflected into his own net by Havard Nordtveit for the English Premier League side\'s second goal in an end-to-end match.\r <img class=\"imageNews\" src=\"images/trent-alexander-arnold.jpg\" alt=\"Trent\">\r \r An astonishing last-minute own goal by Young Boys defender Kasim Nuhu handed CSKA Moscow a 1-0 away win while Sporting were held to a goalless draw at home by FCSB, formerly Steaua Bucharest, in two of the other Champions League playoff ties.\r \r Alexander-Arnold, 18, who only made his Premier League debut in December, curled a free kick through a gap in the Hoffenheim wall 10 minutes before half-time as Liverpool survived a rocky start.\r \r It could have been very different if Andrej Kramaric had converted a penalty for the Bundesliga side in the 12th minute but he saw a weak effort saved by Mignolet.\r <p>\r     Liverpool had another let-off just before half-time when Mignolet saved from Kramaric and Wagner rolled the rebound wide of the post.\r \r     Hoffenheim, attempting to qualify for the group stage for the first time, had more possession but Liverpool were more threatening and went further ahead in the 77th minute.\r \r     The hosts lost possession trying to play their way out of defence, the ball was switched to substitute James Milner on the left and his shot from a narrow angle deflected off Nordtveit\'s chest and into the top corner.\r </p>',6),(9,'45c48cce2e2d7fbdea1afc51c7c6ad26','2017-08-16 20:46:14','2017-08-16 21:17:01',3,'What Messi Told Neymar Before He Left Barca','thumbnail-messi.jpg','It has been revealed what superstar Lionel Messi reportedly told Neymar before the Brazilian made his final decision to leave FC Barcelona.  ','The Brazilian became the most expensive player in history when joined Paris Saint-Germain two weeks ago, a move many fans and pundits believe he made to escape Messiâ€™s shadow.\r \r It was believed that Barcaâ€™s veteran players were attempting to persuade Neymar to not join the French giants, including the likes of Gerard Pique, Andres Iniesta and Messi.\r \r According to Diario Sport, Messi even promised Neymar that if he stayed, he would help him win the Ballon dâ€™Or â€“ an individual trophy many claim the Brazilian is desperate to win.\r <img class=\"imageNews\" src=\"images/messi.jpg\" alt=\"Messi\">\r \r <p>\r     Messi was believed to have said: â€œWhat do you want?â€™ Do you want to be a Ballon dâ€™Or winner? Iâ€™ll make you win the Ballon dâ€™Or.â€\r </p>\r <p>\r     The Argentine has already won the Ballon dâ€™Or five times in his career, while Real Madrid talisman Cristiano Ronaldo has won the accolade on four occasions.\r \r     The Portuguese is said to be the favourite for the next Ballon dâ€™Or prize, though Neymar is expected to rival Messi and the Los Blancos forward for the award in future.\r </p>',6),(10,'d3d9446802a44259755d38e6d163e820','2017-08-16 20:56:23','2017-08-16 21:17:03',1,'The social media banter between Floyd Mayweather and Conor McGregor has become a reality.','thumbnail-conor-mcgregor.jpg','Nevada commission approves lighter glove size for Floyd Mayweather vs. Conor McGregor','The Nevada Athletic Commission (NAC) approved Wednesday a â€œone-timeâ€ waiver to allow Mayweather and McGregor to wear lighter gloves than boxing rules dictate for their Aug. 26 fight in Las Vegas.\r\n<img class=\"imageNews\" src=\"images/conor-mcgregor.jpg\" alt=\"Conor McGregor\">\r\n\r\n<p>\r\n    The motion passed unanimously to let the matchup be contested with 8-ounce gloves, rather than 10-ounce ones that the regulations state.\r\n\r\n    The glove size argument started two weeks ago on Instagram when Mayweather posted that he wanted to give McGregor an advantage in the fight by reducing the glove size. McGregor, the UFC lightweight champion, wears 4-ounce gloves for MMA. McGregor responded that he didnâ€™t really care either way what the size gloves were.\r\n\r\n    Both Mayweather and McGregor had representatives go before the commission Wednesday and explain why their respective fighters wanted 8-ounce gloves instead of 10-ouncers. Both reps said neither fighter was concerned that it would be a risk.\r\n</p>\r\n<p>\r\n    â€œOn behalf of Team McGregor, we believe itâ€™s fine,â€ said Michael Mersch, McGregorâ€™s representative and a former UFC executive. â€œWe donâ€™t have any health and safety concerns on the behalf of our fighter.â€\r\n\r\n    The commissioners, citing a lack of scientific evidence for their glove size rules dictated by weight class, all gave their approval. Chairman Anthony Marnell did say he was upset that Mayweather and McGregor had used the commission for promotion on social media.\r\n\r\n    â€œI do not like the Nevada State Athletic Commission being used as a pawn in a social media bout,â€ Marnell said. â€œBetween these two, that part of this request pisses me off.\r\n\r\n    â€œThis body is not the subject of two fighters â€¦ to create social media stir and other controversy to sell tickets and to sell DirecTV.â€\r\n</p>\r\n<p>\r\n    Commissioner Skip Avasino, the commissionâ€™s most tenured member, said since it was a hybrid fight â€” an MMA fighter coming in and facing a boxer â€” they could grant a waiver for this occasion. But he recommend a scientific study that was first supposed to be done in 2006 regarding glove size.\r\n\r\n    The Nevada rules â€” and regular boxing rules â€” state that fights at 147 pounds and below can use 8-ounce gloves, but anything above 147 pounds the fight will be contested with 10-ounce gloves. Mayweather vs. McGregor is a 154-pound fight.\r\n\r\n    Mersch said McGregor is at 160 pounds right now and expects him to have no trouble making weight. Mayweatherâ€™s rep said the all-time great boxer will likely be about 150 pounds on weigh-in day Aug. 25.\r\n</p>',8),(11,'6512bd43d9caa6e02c990b0a82652dca','2017-08-16 21:01:50','2017-08-16 21:17:06',1,'Russia captures bronze','thumbnail-ice-hockey.jpg','Nikita Gusev led the way with two goals and an assist as Russia beat Finland 5-3 to earn bronze Sunday in Cologne. It\'s Russia\'s fourth straight Worlds medal.','Russian players and staff celebrate after a 5-3 bronze medal game win over Finland at the 2017 IIHF Ice Hockey World Championship.\r\n<img class=\"imageNews\" src=\"images/ice-hockey.jpg\" alt=\"Ice Hockey\">\r\n\r\n<p>\r\n    Ever-plucky Finland rallied from a 4-0 second-period deficit to make it 4-3 in the third, but couldn\'t complete the comeback.\r\n    Russia\'s Vladimir Tkachyov, Bogdan Kiselevich, and Nikita Kucherov also scored, and Valeri Nichushkin added three assists. Goalie Andrei Vasilevski posted his seventh win of 2017 as Russia outshot Finland 30-29.\r\n    \"For two periods we were fine, then we gave our opponent a chance and they scored three goals,\" said Kucherov. \"We could have got nervous because there was still a lot of time remaining, but we stayed calm. We stayed confident, Vasilevski did great and we didn\'t take too many penalties.\"\r\n    Under head coach Oleg Znarok, Russia also won gold in 2014, silver in 2015, and bronze last year in Moscow. This bronze somewhat makes up for the disappointment of blowing a 2-0 lead after 40 minutes versus Canada and losing 4-2 in the semi-finals.\r\n</p>\r\n<p>\r\n    \"We are happy with a bronze but not satisfied,\" said Kiselevich. \"We didnâ€™t lose to Team Canada yesterday, we lost to ourselves. Canada was good, but we played a stupid third period. We didnâ€™t play for the gold, but got a bronze.\"\r\n    Mikko Rantanen had a goal and an assist, and Mikko Lehtonen and Veli-Matti Savinainen also tallied for Finland, while Sebastian Aho had two helpers. The Finns came fourth after taking silver in both 2014 and 2016. They last won the Worlds in 2011.\r\n</p>',8),(12,'c20ad4d76fe97759aa27a0c99bff6710','2017-08-16 21:08:28','2017-08-16 21:32:47',2,'Backpacker shocks parents by Skyping them in 4300m skydive','thumbnail-skydive.jpg','\'I thought he was on a bus!\' shouts the backpacker\'s father!','\r\n\r\n<img class=\"imageNews\" src=\"images/skydive.jpg\" alt=\"Skydive\">\r\n\r\n<p>\r\n    Remembering to stay in touch with parents while on a hair-raising adventure around the world can be difficult.\r\n\r\n    And when travellers do get in touch, they often leave out worrisome details when recounting the more unpredictable aspects of their route.\r\n\r\n    Not so for Roger Ryan, who Skyped his parents from Australia - without mentioning he was in an aeroplane and about to leap 14,000 feet out of it.\r\n\r\n    His mother and father are captured reacting to his announcement that he \"just needs to get this out of the way, ok?\" and suddenly jumping out of the plane - howling and screaming as he drops to the earth.\r\n</p>\r\n<p>\r\n    At first the Irish pair appear shocked, but soon it becomes apparent where their son gets his sense of humour from.\r\n\r\n    \"I can\'t hear a word he\'s saying,\" says Roger\'s father, before his mother gasps, \"Oh no, he\'s jumping out of an aeroplane!\"\r\n\r\n    A string of expletives and exclamations follow on as the pair begin the breathe and laugh.\r\n</p>',8);
/*!40000 ALTER TABLE `news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  KEY `idx_username` (`username`),
  KEY `idx_password` (`password`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Paja','Patak','paja','$2y$10$WNBZTVP2Xc3OltLAODmVIOEUc0Y2020PHFABsFJzGtXIVCbkuTTDK','pajapatak@mail.com'),(2,'Dusko','Dugousko','Dule','$2y$10$uz48ATc5U3p1/loNz56M/On05N/7hvbbRtheY6u.BzGziHCS2tkfi','dusko.dugousko@gmail.com'),(3,'Lola','Bunny','Lola','$2y$10$6zVcwVRlzSX/Ct6UnVUCquMHN235nDrTpXLk96o9OUlD4cdT3ghdG','lola@gmail.com');
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

-- Dump completed on 2017-08-17 13:24:59
