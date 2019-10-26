# Basic-Banking-System
This is a remodified version of my database management systems final project. Repurposed to be hosted on my personal website and database. 

You can view the live project at https://syedfahadnadeem.com/projects/banking-system/

## Database structure

**Accounts Table**
```
CREATE TABLE `Accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(10) DEFAULT NULL,
  `cid` int(11) NOT NULL,
  `balance` float NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`),
  CONSTRAINT `Accounts_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `Users` (`id`)
)
```
**Sources Table**
```
CREATE TABLE `Sources` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
)
```
**Transactions Table**
```
CREATE TABLE `Transactions` (
  `tid` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `type` char(1) NOT NULL,
  `amount` float NOT NULL,
  `mydatetime` datetime NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`tid`),
  KEY `cid` (`cid`),
  KEY `sid` (`sid`),
  KEY `aid` (`aid`),
  CONSTRAINT `Transactions_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `Users` (`id`),
  CONSTRAINT `Transactions_ibfk_2` FOREIGN KEY (`sid`) REFERENCES `Sources` (`id`),
  CONSTRAINT `Transactions_ibfk_3` FOREIGN KEY (`aid`) REFERENCES `Accounts` (`id`)
)
```
**Users Table**
```
CREATE TABLE `Users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `role` varchar(20) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `first_name` varchar(20) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `zipcode` varchar(5) DEFAULT NULL,
  `state` char(2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`)
)
```
