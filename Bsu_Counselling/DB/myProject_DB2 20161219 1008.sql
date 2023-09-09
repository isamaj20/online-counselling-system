-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.16-MariaDB


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema library_system
--

CREATE DATABASE IF NOT EXISTS library_system;
USE library_system;

--
-- Definition of table `archive`
--

DROP TABLE IF EXISTS `archive`;
CREATE TABLE `archive` (
  `Book_id` int(10) unsigned NOT NULL DEFAULT '0',
  `Title` varchar(45) NOT NULL DEFAULT '',
  `ISSBN` varchar(45) NOT NULL DEFAULT '',
  `Author` varchar(45) NOT NULL DEFAULT '0',
  `Copy` int(10) unsigned NOT NULL DEFAULT '0',
  `Publisher` varchar(45) NOT NULL DEFAULT '0',
  `Category` varchar(45) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Book_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `archive`
--

/*!40000 ALTER TABLE `archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `archive` ENABLE KEYS */;


--
-- Definition of table `author`
--

DROP TABLE IF EXISTS `author`;
CREATE TABLE `author` (
  `Author_id` int(11) NOT NULL DEFAULT '0',
  `Name` varchar(45) NOT NULL DEFAULT '',
  `Book_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`Author_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `author`
--

/*!40000 ALTER TABLE `author` DISABLE KEYS */;
INSERT INTO `author` (`Author_id`,`Name`,`Book_id`) VALUES 
 (1,'Isama',1);
/*!40000 ALTER TABLE `author` ENABLE KEYS */;


--
-- Definition of table `books`
--

DROP TABLE IF EXISTS `books`;
CREATE TABLE `books` (
  `Book_id` int(10) unsigned NOT NULL DEFAULT '0',
  `Title` varchar(100) NOT NULL DEFAULT '',
  `ISSBN` varchar(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`Book_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

/*!40000 ALTER TABLE `books` DISABLE KEYS */;
INSERT INTO `books` (`Book_id`,`Title`,`ISSBN`) VALUES 
 (1,'Food','23');
/*!40000 ALTER TABLE `books` ENABLE KEYS */;


--
-- Definition of table `borrow_books`
--

DROP TABLE IF EXISTS `borrow_books`;
CREATE TABLE `borrow_books` (
  `Request_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Book_id` int(10) unsigned NOT NULL DEFAULT '0',
  `Student_id` varchar(45) NOT NULL DEFAULT '',
  `Date` varchar(45) NOT NULL DEFAULT '',
  `Issued_by` varchar(45) NOT NULL DEFAULT '',
  `Expected_Return_date` varchar(45) NOT NULL DEFAULT '',
  `Return_status` varchar(45) NOT NULL DEFAULT '',
  `Date_returned` varchar(45) NOT NULL DEFAULT '',
  `Recieved_by` varchar(45) NOT NULL DEFAULT '',
  `Fined` varchar(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`Request_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `borrow_books`
--

/*!40000 ALTER TABLE `borrow_books` DISABLE KEYS */;
INSERT INTO `borrow_books` (`Request_id`,`Book_id`,`Student_id`,`Date`,`Issued_by`,`Expected_Return_date`,`Return_status`,`Date_returned`,`Recieved_by`,`Fined`) VALUES 
 (1,4,'BSU/SC/CMP/12/1000','12/12/2015','Mr John','17/12/2015','Not Yet Returned','null','null','null'),
 (2,2,'BSU/CMP/13/0000','12/01/2016','Mr Adeyi','19/01/2016','Not Yet Returned','null','null','null'),
 (3,4,'BSU/CMP/14/001','15/01/2016','Isama','25/01/2016','Not Returned','null','null','null'),
 (4,4,'BSU/MTH/12/0003','01/10/2016','Moses','10/10/2016','Not Yet Returned','null','null','null');
/*!40000 ALTER TABLE `borrow_books` ENABLE KEYS */;


--
-- Definition of table `borrowbook`
--

DROP TABLE IF EXISTS `borrowbook`;
CREATE TABLE `borrowbook` (
  `Borrow_id` int(10) unsigned NOT NULL DEFAULT '0',
  `Request_id` int(10) unsigned NOT NULL DEFAULT '0',
  `Book_id` int(10) unsigned NOT NULL DEFAULT '0',
  `Student_id` varchar(45) NOT NULL DEFAULT '0',
  `Date_Borrowed` varchar(15) NOT NULL DEFAULT '',
  `Issued_By` varchar(45) NOT NULL DEFAULT '0',
  `Expected_Return_Date` varchar(15) NOT NULL DEFAULT '',
  `Return_Status` varchar(20) NOT NULL DEFAULT '',
  `Date_Returned` varchar(15) NOT NULL DEFAULT '',
  `Received_By` varchar(45) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Borrow_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `borrowbook`
--

/*!40000 ALTER TABLE `borrowbook` DISABLE KEYS */;
INSERT INTO `borrowbook` (`Borrow_id`,`Request_id`,`Book_id`,`Student_id`,`Date_Borrowed`,`Issued_By`,`Expected_Return_Date`,`Return_Status`,`Date_Returned`,`Received_By`) VALUES 
 (1,1,1,'BSU/SC/CMP/12/16810','25:02:2016','admin','03:03:2016','PENDING','00:00:0000','Nil'),
 (2,1,1,'BSU/SC/CMP/12/16810','25:02:2016','admin','03:03:2016','PENDING','00:00:0000','Nil'),
 (3,1,1,'BSU/SC/CMP/12/16810','25:02:2016','admin','03:03:2016','PENDING','00:00:0000','Nil'),
 (4,1,1,'BSU/SC/CMP/12/16810','25:02:2016','admin','03:03:2016','PENDING','00:00:0000','Nil');
/*!40000 ALTER TABLE `borrowbook` ENABLE KEYS */;


--
-- Definition of table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `Category_id` int(11) NOT NULL DEFAULT '0',
  `Name` varchar(45) NOT NULL DEFAULT '',
  `Book_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`Category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` (`Category_id`,`Name`,`Book_id`) VALUES 
 (1,'Biology',1);
/*!40000 ALTER TABLE `category` ENABLE KEYS */;


--
-- Definition of table `copies`
--

DROP TABLE IF EXISTS `copies`;
CREATE TABLE `copies` (
  `Copy_id` int(10) unsigned NOT NULL DEFAULT '0',
  `Book_id` int(10) unsigned NOT NULL DEFAULT '0',
  `Borrowed` int(10) unsigned NOT NULL DEFAULT '0',
  `Returned` int(10) unsigned NOT NULL DEFAULT '0',
  `Available` int(10) unsigned NOT NULL DEFAULT '0',
  `Total` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`Copy_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `copies`
--

/*!40000 ALTER TABLE `copies` DISABLE KEYS */;
INSERT INTO `copies` (`Copy_id`,`Book_id`,`Borrowed`,`Returned`,`Available`,`Total`) VALUES 
 (1,1,3,0,888,891);
/*!40000 ALTER TABLE `copies` ENABLE KEYS */;


--
-- Definition of table `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE `images` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `imageurl` varchar(250) NOT NULL DEFAULT '',
  `User_id` varchar(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `images`
--

/*!40000 ALTER TABLE `images` DISABLE KEYS */;
/*!40000 ALTER TABLE `images` ENABLE KEYS */;


--
-- Definition of table `librarian`
--

DROP TABLE IF EXISTS `librarian`;
CREATE TABLE `librarian` (
  `Librarian_id` varchar(45) NOT NULL DEFAULT '',
  `Fname` varchar(45) NOT NULL DEFAULT '',
  `Sname` varchar(45) NOT NULL DEFAULT '',
  `Mname` varchar(45) NOT NULL DEFAULT '',
  `User_id` varchar(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`Librarian_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `librarian`
--

/*!40000 ALTER TABLE `librarian` DISABLE KEYS */;
INSERT INTO `librarian` (`Librarian_id`,`Fname`,`Sname`,`Mname`,`User_id`) VALUES 
 ('01','Admin','Admin','Admin','admin');
/*!40000 ALTER TABLE `librarian` ENABLE KEYS */;


--
-- Definition of table `pictures`
--

DROP TABLE IF EXISTS `pictures`;
CREATE TABLE `pictures` (
  `studentid` varchar(45) NOT NULL DEFAULT '',
  `pic` blob,
  PRIMARY KEY (`studentid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pictures`
--

/*!40000 ALTER TABLE `pictures` DISABLE KEYS */;
/*!40000 ALTER TABLE `pictures` ENABLE KEYS */;


--
-- Definition of table `publisher`
--

DROP TABLE IF EXISTS `publisher`;
CREATE TABLE `publisher` (
  `Publisher_id` int(10) unsigned NOT NULL DEFAULT '0',
  `Name` varchar(45) NOT NULL DEFAULT '',
  `Book_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`Publisher_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `publisher`
--

/*!40000 ALTER TABLE `publisher` DISABLE KEYS */;
INSERT INTO `publisher` (`Publisher_id`,`Name`,`Book_id`) VALUES 
 (1,'isamacares',1);
/*!40000 ALTER TABLE `publisher` ENABLE KEYS */;


--
-- Definition of table `request`
--

DROP TABLE IF EXISTS `request`;
CREATE TABLE `request` (
  `Request_id` int(10) unsigned NOT NULL DEFAULT '0',
  `Book_id` int(10) unsigned NOT NULL DEFAULT '0',
  `Student_id` varchar(45) NOT NULL DEFAULT '',
  `Request_Date` varchar(45) NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Title` varchar(45) NOT NULL DEFAULT '',
  `ISBN` int(10) unsigned NOT NULL DEFAULT '0',
  `Author_id` int(10) unsigned NOT NULL DEFAULT '0',
  `Publisher_id` int(10) unsigned NOT NULL DEFAULT '0',
  `Category_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`Request_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `request`
--

/*!40000 ALTER TABLE `request` DISABLE KEYS */;
INSERT INTO `request` (`Request_id`,`Book_id`,`Student_id`,`Request_Date`,`Title`,`ISBN`,`Author_id`,`Publisher_id`,`Category_id`) VALUES 
 (1,1,'BSU/SC/CMP/12/16810','24:02:2016','Food',23,1,1,1),
 (2,1,'BSU/SC/CMP/12/16810','25:02:2016','Food',23,1,1,1),
 (3,1,'BSU/SC/CMP/12/16835','25:02:2016','Food',23,1,1,1),
 (4,1,'BSU/SC/CMP/12/16835','25:02:2016','Food',23,1,1,1),
 (5,1,'BSU/SC/CMP/12/16835','25:02:2016','Food',23,1,1,1),
 (6,1,'BSU/SC/CMP/12/16835','25:02:2016','Food',23,1,1,1),
 (7,1,'BSU/SC/CMP/12/16835','25:02:2016','Food',23,1,1,1),
 (8,1,'BSU/SC/CMP/12/16835','25:02:2016','Food',23,1,1,1);
/*!40000 ALTER TABLE `request` ENABLE KEYS */;


--
-- Definition of table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE `student` (
  `Student_id` varchar(45) NOT NULL DEFAULT '',
  `Fname` varchar(45) NOT NULL DEFAULT '',
  `Sname` varchar(45) NOT NULL DEFAULT '',
  `Mname` varchar(45) NOT NULL DEFAULT '',
  `User_id` varchar(45) NOT NULL DEFAULT '',
  `imageURL` varchar(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`Student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

/*!40000 ALTER TABLE `student` DISABLE KEYS */;
INSERT INTO `student` (`Student_id`,`Fname`,`Sname`,`Mname`,`User_id`,`imageURL`) VALUES 
 ('BSU/SC/CMP/12/16810','Mary','Ameh','Ene','ameh','images/pics/1453246280s111111111.jpg'),
 ('BSU/SC/CMP/12/16835','John','Isama','Adeyi','JOHN','images/pics/14532380575-009.jpg'),
 ('oiiihh','[]poiguh','lhjvhcb ','poihguvh','wini','images/pics/1453980307826_(640x554).jpg'),
 ('rtty','8764','899999','34566','you','images/pics/1453555214ng');
/*!40000 ALTER TABLE `student` ENABLE KEYS */;


--
-- Definition of table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `User_id` varchar(20) NOT NULL DEFAULT '0',
  `Password` varchar(45) NOT NULL DEFAULT '',
  `Role` varchar(45) NOT NULL DEFAULT '',
  `Status` varchar(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`User_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`User_id`,`Password`,`Role`,`Status`) VALUES 
 ('admin','admin','Admin','Active'),
 ('ameh','mary','Student','Active'),
 ('JOHN','john','Student','Active'),
 ('wini','wini','Student','Active'),
 ('you','you','Student','Active');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
