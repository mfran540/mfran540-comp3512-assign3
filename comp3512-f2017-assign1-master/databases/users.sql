USE `book`;

#
# Table structure for table 'Users'
#

DROP TABLE IF EXISTS `Users`;

CREATE TABLE `Users` (
  `UserID` INTEGER NOT NULL, 
  `FirstName` VARCHAR(255), 
  `LastName` VARCHAR(255), 
  `Address` VARCHAR(255), 
  `City` VARCHAR(255), 
  `Region` VARCHAR(255), 
  `Country` VARCHAR(255), 
  `Postal` VARCHAR(255), 
  `Phone` VARCHAR(255), 
  `Email` VARCHAR(255), 
  `Privacy` VARCHAR(255), 
  PRIMARY KEY (`UserID`)
) ENGINE=innodb DEFAULT CHARSET=utf8;

SET autocommit=1;

#
# Dumping data for table 'UserDetails'
#

INSERT INTO `Users` (`UserID`, `FirstName`, `LastName`, `Address`, `City`, `Region`, `Country`, `Postal`, `Phone`, `Email`, `Privacy`) VALUES (1, 'Luís', 'Gonçalves', 'Av. Brigadeiro Faria Lima, 2170', 'São José dos Campos', 'SP', 'Brazil', '12227-000', '+55 (12) 3923-5555', 'luisg@embraer.com.br', '1');
INSERT INTO `Users` (`UserID`, `FirstName`, `LastName`, `Address`, `City`, `Region`, `Country`, `Postal`, `Phone`, `Email`, `Privacy`) VALUES (2, 'Leonie', 'Köhler', 'Theodor-Heuss-Straße 34', 'Stuttgart', NULL, 'Germany', '70174', '+49 0711 2842222', 'leonekohler@surfeu.de', '1');
INSERT INTO `Users` (`UserID`, `FirstName`, `LastName`, `Address`, `City`, `Region`, `Country`, `Postal`, `Phone`, `Email`, `Privacy`) VALUES (3, 'Bjørn', 'Hansen', 'Ullevålsveien 14', 'Oslo', NULL, 'Norway', '0171', '+47 22 44 22 22', 'bjorn.hansen@yahoo.no', '1');
INSERT INTO `Users` (`UserID`, `FirstName`, `LastName`, `Address`, `City`, `Region`, `Country`, `Postal`, `Phone`, `Email`, `Privacy`) VALUES (4, 'François', 'Tremblay', '1498 rue Bélanger', 'Montréal', 'QC', 'Canada', 'H2G 1A7', '+1 (514) 721-4711', 'ftremblay@gmail.com', '1');
INSERT INTO `Users` (`UserID`, `FirstName`, `LastName`, `Address`, `City`, `Region`, `Country`, `Postal`, `Phone`, `Email`, `Privacy`) VALUES (5, 'František', 'Wichterlová', 'Klanova 9/506', 'Prague', NULL, 'Czech Republic', '14700', '+420 2 4172 5555', 'frantisekw@jetbrains.com', '2');
INSERT INTO `Users` (`UserID`, `FirstName`, `LastName`, `Address`, `City`, `Region`, `Country`, `Postal`, `Phone`, `Email`, `Privacy`) VALUES (6, 'Astrid', 'Gruber', 'Rotenturmstraße 4, 1010 Innere Stadt', 'Vienna', NULL, 'Austria', '1010', '+43 01 5134505', 'astrid.gruber@apple.at', '1');
INSERT INTO `Users` (`UserID`, `FirstName`, `LastName`, `Address`, `City`, `Region`, `Country`, `Postal`, `Phone`, `Email`, `Privacy`) VALUES (7, 'Helena', 'Holý', 'Rilská 3174/6', 'Prague', NULL, 'Czech Republic', '14300', '+420 2 4177 0449', 'hholy@gmail.com', '2');
INSERT INTO `Users` (`UserID`, `FirstName`, `LastName`, `Address`, `City`, `Region`, `Country`, `Postal`, `Phone`, `Email`, `Privacy`) VALUES (8, 'Frank', 'Harris', '1600 Amphitheatre Parkway', 'Mountain View', 'CA', 'USA', '94043-1351', '+1 (425) 882-8080', 'fharris@google.com', '1');
INSERT INTO `Users` (`UserID`, `FirstName`, `LastName`, `Address`, `City`, `Region`, `Country`, `Postal`, `Phone`, `Email`, `Privacy`) VALUES (9, 'Jack', 'Smith', '1 Microsoft Way', 'Redmond', 'WA', 'USA', '98052-8300', '+1 (425) 882-8080', 'jacksmith@microsoft.com', '2');
INSERT INTO `Users` (`UserID`, `FirstName`, `LastName`, `Address`, `City`, `Region`, `Country`, `Postal`, `Phone`, `Email`, `Privacy`) VALUES (10, 'Michelle', 'Brooks', '627 Broadway', 'New York', 'NY', 'USA', '10012-2612', '+1 (212) 221-3546', 'michelleb@aol.com', '1');
INSERT INTO `Users` (`UserID`, `FirstName`, `LastName`, `Address`, `City`, `Region`, `Country`, `Postal`, `Phone`, `Email`, `Privacy`) VALUES (11, 'Tim', 'Goyer', '1 Infinite Loop', 'Cupertino', 'CA', 'USA', '95014', '+1 (408) 996-1010', 'tgoyer@apple.com', '1');
INSERT INTO `Users` (`UserID`, `FirstName`, `LastName`, `Address`, `City`, `Region`, `Country`, `Postal`, `Phone`, `Email`, `Privacy`) VALUES (12, 'Robert', 'Brown', '796 Dundas Street West', 'Toronto', 'ON', 'Canada', 'M6J 1V1', '+1 (416) 363-8888', 'robbrown@shaw.ca', '2');
INSERT INTO `Users` (`UserID`, `FirstName`, `LastName`, `Address`, `City`, `Region`, `Country`, `Postal`, `Phone`, `Email`, `Privacy`) VALUES (13, 'Edward', 'Francis', '230 Elgin Street', 'Ottawa', 'ON', 'Canada', 'K2P 1L7', '+1 (613) 234-3322', 'edfrancis@yachoo.ca', '2');
INSERT INTO `Users` (`UserID`, `FirstName`, `LastName`, `Address`, `City`, `Region`, `Country`, `Postal`, `Phone`, `Email`, `Privacy`) VALUES (14, 'Mark', 'Philips', '8210 111 ST NW', 'Edmonto', 'AB', 'Canada', 'T6G 2C7', '+1 (780) 434-4554', 'mphilips12@shaw.ca', '1');
INSERT INTO `Users` (`UserID`, `FirstName`, `LastName`, `Address`, `City`, `Region`, `Country`, `Postal`, `Phone`, `Email`, `Privacy`) VALUES (15, 'Martha', 'Silk', '194A Chain Lake Drive', 'Halifax', 'NS', 'Canada', 'B3S 1C5', '+1 (902) 450-0450', 'marthasilk@gmail.com', '1');
INSERT INTO `Users` (`UserID`, `FirstName`, `LastName`, `Address`, `City`, `Region`, `Country`, `Postal`, `Phone`, `Email`, `Privacy`) VALUES (16, 'Aaron', 'Mitchell', '696 Osborne Street', 'Winnipeg', 'MB', 'Canada', 'R3L 2B9', '+1 (204) 452-6452', 'aaronmitchell@yahoo.ca', '2');
INSERT INTO `Users` (`UserID`, `FirstName`, `LastName`, `Address`, `City`, `Region`, `Country`, `Postal`, `Phone`, `Email`, `Privacy`) VALUES (17, 'Ellie', 'Sullivan', '5112 48 Street', 'Yellowknife', 'NT', 'Canada', 'X1A 1N6', '+1 (867) 920-2233', 'ellie.sullivan@shaw.ca', '2');
INSERT INTO `Users` (`UserID`, `FirstName`, `LastName`, `Address`, `City`, `Region`, `Country`, `Postal`, `Phone`, `Email`, `Privacy`) VALUES (18, 'João', 'Fernandes', 'Rua da Assunção 53', 'Lisbon', NULL, 'Portugal', NULL, '+351 (213) 466-111', 'jfernandes@yahoo.pt', '2');
INSERT INTO `Users` (`UserID`, `FirstName`, `LastName`, `Address`, `City`, `Region`, `Country`, `Postal`, `Phone`, `Email`, `Privacy`) VALUES (19, 'Madalena', 'Sampaio', 'Rua dos Campeões Europeus de Viena, 4350', 'Porto', NULL, 'Portugal', NULL, '+351 (225) 022-448', 'masampaio@sapo.pt', '2');
INSERT INTO `Users` (`UserID`, `FirstName`, `LastName`, `Address`, `City`, `Region`, `Country`, `Postal`, `Phone`, `Email`, `Privacy`) VALUES (20, 'Hannah', 'Schneider', 'Tauentzienstraße 8', 'Berlin', NULL, 'Germany', '10789', '+49 030 26550280', 'hannah.schneider@yahoo.de', '1');
INSERT INTO `Users` (`UserID`, `FirstName`, `LastName`, `Address`, `City`, `Region`, `Country`, `Postal`, `Phone`, `Email`, `Privacy`) VALUES (21, 'Camille', 'Bernard', '4, Rue Milton', 'Paris', NULL, 'France', '75009', '+33 01 49 70 65 65', 'camille.bernard@yahoo.fr', '1');
INSERT INTO `Users` (`UserID`, `FirstName`, `LastName`, `Address`, `City`, `Region`, `Country`, `Postal`, `Phone`, `Email`, `Privacy`) VALUES (22, 'Isabelle', 'Mercier', '68, Rue Jouvence', 'Dijon', NULL, 'France', '21000', '+33 03 80 73 66 99', 'isabelle_mercier@apple.fr', '1');
INSERT INTO `Users` (`UserID`, `FirstName`, `LastName`, `Address`, `City`, `Region`, `Country`, `Postal`, `Phone`, `Email`, `Privacy`) VALUES (23, 'Emma', 'Jones', '202 Hoxton Street', 'London', NULL, 'United Kingdom', 'N1 5LH', '+44 020 7707 0707', 'emma_jones@hotmail.com', '1');
INSERT INTO `Users` (`UserID`, `FirstName`, `LastName`, `Address`, `City`, `Region`, `Country`, `Postal`, `Phone`, `Email`, `Privacy`) VALUES (24, 'Phil', 'Hughes', '113 Lupus St', 'London', NULL, 'United Kingdom', 'SW1V 3EN', '+44 020 7976 5722', 'phil.hughes@gmail.com', '1');
INSERT INTO `Users` (`UserID`, `FirstName`, `LastName`, `Address`, `City`, `Region`, `Country`, `Postal`, `Phone`, `Email`, `Privacy`) VALUES (25, 'Manoj', 'Pareek', '12,Community Centre', 'Delhi', NULL, 'India', '110017', '+91 0124 39883988', 'manoj.pareek@rediff.com', '1');
INSERT INTO `Users` (`UserID`, `FirstName`, `LastName`, `Address`, `City`, `Region`, `Country`, `Postal`, `Phone`, `Email`, `Privacy`) VALUES (26, 'Puja', 'Srivastava', '3,Raj Bhavan Road', 'Bangalore', NULL, 'India', '560001', '+91 080 22289999', 'puja_srivastava@yahoo.in', '2');
INSERT INTO `Users` (`UserID`, `FirstName`, `LastName`, `Address`, `City`, `Region`, `Country`, `Postal`, `Phone`, `Email`, `Privacy`) VALUES (27, 'Mark', 'Taylor', '421 Bourke Street', 'Sidney', 'NSW', 'Australia', '2010', '+61 (02) 9332 3633', 'mark.taylor@yahoo.au', '1');
INSERT INTO `Users` (`UserID`, `FirstName`, `LastName`, `Address`, `City`, `Region`, `Country`, `Postal`, `Phone`, `Email`, `Privacy`) VALUES (28, 'Richard', 'Cunningham', '2211 W Berry Street', 'Fort Worth', 'TX', 'USA', '76110', '+1 (817) 924-7272', 'ricunningham@hotmail.com', '1');
INSERT INTO `Users` (`UserID`, `FirstName`, `LastName`, `Address`, `City`, `Region`, `Country`, `Postal`, `Phone`, `Email`, `Privacy`) VALUES (29, 'Patrick', 'Gray', '1033 N Park Ave', 'Tucson', 'AZ', 'USA', '85719', '+1 (520) 622-4200', 'patrick.gray@aol.com', '2');
INSERT INTO `Users` (`UserID`, `FirstName`, `LastName`, `Address`, `City`, `Region`, `Country`, `Postal`, `Phone`, `Email`, `Privacy`) VALUES (30, 'Terhi', 'Hämäläinen', 'Porthaninkatu 9', 'Helsinki', NULL, 'Finland', '00530', '+358 09 870 2000', 'terhi.hamalainen@apple.fi', '2');
INSERT INTO `Users` (`UserID`, `FirstName`, `LastName`, `Address`, `City`, `Region`, `Country`, `Postal`, `Phone`, `Email`, `Privacy`) VALUES (31, 'Stanisław', 'Wójcik', 'Ordynacka 10', 'Warsaw', NULL, 'Poland', '00-358', '+48 22 828 37 39', 'stanisław.wójcik@wp.pl', '1');
# 31 records

#
# Table structure for table 'UsersLogin'
#

DROP TABLE IF EXISTS `UsersLogin`;

CREATE TABLE `UsersLogin` (
  `UserID` INTEGER NOT NULL AUTO_INCREMENT, 
  `UserName` VARCHAR(255), 
  `Password` VARCHAR(255), 
  `Salt` VARCHAR(32), 
  `State` INTEGER, 
  `DateJoined` DATETIME, 
  `DateLastModified` DATETIME, 
  PRIMARY KEY (`UserID`)
) ENGINE=innodb DEFAULT CHARSET=utf8;

SET autocommit=1;

#
# Dumping data for table 'UsersLogin'
#

INSERT INTO `UsersLogin` (`UserID`, `UserName`, `Password`, `Salt`, `State`, `DateJoined`, `DateLastModified`) VALUES (1, 'luisg@embraer.com.br', '81c71e87e09e4310e3b974c79a8f817b', 'HoGiVlunac11vDbbFHpoB0OdDOEkA6Uk', 1, '2012-10-08 00:00:00', '2012-11-15 00:00:00');
INSERT INTO `UsersLogin` (`UserID`, `UserName`, `Password`, `Salt`, `State`, `DateJoined`, `DateLastModified`) VALUES (2, 'leonekohler@surfeu.de', '5a2b2e0fcff2d5d36bd0f988b1acfe41', 'VubVwUzwUC29gpVff7iZm3Aoe6LWba57', 1, '2012-08-22 00:00:00', '2012-10-15 00:00:00');
INSERT INTO `UsersLogin` (`UserID`, `UserName`, `Password`, `Salt`, `State`, `DateJoined`, `DateLastModified`) VALUES (3, 'ftremblay@gmail.com', 'cdcabbb42c07586007f367353c2bd241', 'YP6aWNCsANhgpmQ8vrrmZBb6L54sOxkp', 1, '2012-10-28 00:00:00', '2012-11-16 00:00:00');
INSERT INTO `UsersLogin` (`UserID`, `UserName`, `Password`, `Salt`, `State`, `DateJoined`, `DateLastModified`) VALUES (4, 'bjorn.hansen@yahoo.no', '9cad8e966c8b47a27e2703e51a75d23e', 'vFDJ8jISdVfCIMkTpbze5ECLMeritDe8', 1, '2012-07-31 00:00:00', '2012-08-14 00:00:00');
INSERT INTO `UsersLogin` (`UserID`, `UserName`, `Password`, `Salt`, `State`, `DateJoined`, `DateLastModified`) VALUES (5, 'frantisekw@jetbrains.com', '6d465b9782c5a1ffd5e64b8be43a25f1', 't5llWFtASh1LwDjbSuAcA7gZ7d8MBz2J', 1, '2012-08-06 00:00:00', '2012-09-25 00:00:00');
INSERT INTO `UsersLogin` (`UserID`, `UserName`, `Password`, `Salt`, `State`, `DateJoined`, `DateLastModified`) VALUES (6, 'hholy@gmail.com', '7eb81f3fdd0c1c96951b85905da420f2', 'VoTVT17OHoGxaZwmit3g07uwwdx0FoFE', 1, '2012-11-01 00:00:00', '2012-12-14 00:00:00');
INSERT INTO `UsersLogin` (`UserID`, `UserName`, `Password`, `Salt`, `State`, `DateJoined`, `DateLastModified`) VALUES (7, 'astrid.gruber@apple.at', '6f8c4eed1a70ab63cc010e49157871fb', 'eWGrN16jTtprvlNS3ynaUUIZwYZSaYv3', 1, '2012-06-05 00:00:00', '2013-01-10 00:00:00');
INSERT INTO `UsersLogin` (`UserID`, `UserName`, `Password`, `Salt`, `State`, `DateJoined`, `DateLastModified`) VALUES (8, 'fharris@google.com', 'e62798b951bab59d58bcbd6b49159bed', '8kLYNpRXd57yHh2NG8xeMedFLb9q3v4V', 1, '2012-09-25 00:00:00', '2012-11-18 00:00:00');
INSERT INTO `UsersLogin` (`UserID`, `UserName`, `Password`, `Salt`, `State`, `DateJoined`, `DateLastModified`) VALUES (9, 'jacksmith@microsoft.com', '3ce9cf0d08e544eaace1f5280b7e79ad', 'WLwDFTyhbHpBFySCJ8a6pqgpXkHM1oAV', 1, '2012-11-16 00:00:00', '2013-01-18 00:00:00');
INSERT INTO `UsersLogin` (`UserID`, `UserName`, `Password`, `Salt`, `State`, `DateJoined`, `DateLastModified`) VALUES (10, 'michelleb@aol.com', 'badc7aadfb35a97f503d2d0643fc48aa', 'LYRv2m2DkHT0er5GqAtnX4DiZ7pAKtA4', 1, '2012-12-07 00:00:00', '2013-03-07 00:00:00');
INSERT INTO `UsersLogin` (`UserID`, `UserName`, `Password`, `Salt`, `State`, `DateJoined`, `DateLastModified`) VALUES (11, 'tgoyer@apple.com', '9ebc2309a19d8b6cc30a78b627d2a8d0', 'PgJBPfjDqmY30b6w38H0QBqolgyAQPpE', 1, '2013-01-14 00:00:00', '2013-04-19 00:00:00');
INSERT INTO `UsersLogin` (`UserID`, `UserName`, `Password`, `Salt`, `State`, `DateJoined`, `DateLastModified`) VALUES (12, 'robbrown@shaw.ca', 'acb354fef1df68cea98f75bfb4e11efe', 'NeNAmefofIuB18TsKSlySz8hTLw4NJXv', 1, '2013-02-07 00:00:00', '2013-06-11 00:00:00');
INSERT INTO `UsersLogin` (`UserID`, `UserName`, `Password`, `Salt`, `State`, `DateJoined`, `DateLastModified`) VALUES (13, 'edfrancis@yachoo.ca', 'd1b76d1c9e9a0af1b243348d6aa208db', 'CdQkKYIAH7784lUQ7CbJtXDwcgCuVnql', 1, '2012-12-20 00:00:00', '2013-01-11 00:00:00');
INSERT INTO `UsersLogin` (`UserID`, `UserName`, `Password`, `Salt`, `State`, `DateJoined`, `DateLastModified`) VALUES (14, 'mphilips12@shaw.ca', '4d5df99ea28d85bee1943057c0fa5af1', '5JD3H7F7FCgA3XySfVUqn7IvZRRvkyLD', 1, '2012-05-21 00:00:00', '2012-10-28 00:00:00');
INSERT INTO `UsersLogin` (`UserID`, `UserName`, `Password`, `Salt`, `State`, `DateJoined`, `DateLastModified`) VALUES (15, 'marthasilk@gmail.com', '701a6c379457427da2109b6a5cc4db4e', 'rh5PWxACiKkaWhL8XjRoEiTB4vOjjnRH', 1, '2012-11-17 00:00:00', '2012-12-01 00:00:00');
INSERT INTO `UsersLogin` (`UserID`, `UserName`, `Password`, `Salt`, `State`, `DateJoined`, `DateLastModified`) VALUES (16, 'aaronmitchell@yahoo.ca', 'cad0020cfe7be03ec30799f3a555614a', 'G2tZArYb7JR25d02apafzwZ0GFFb6tIP', 1, '2013-02-12 00:00:00', '2013-03-21 00:00:00');
INSERT INTO `UsersLogin` (`UserID`, `UserName`, `Password`, `Salt`, `State`, `DateJoined`, `DateLastModified`) VALUES (17, 'ellie.sullivan@shaw.ca', '6edddf2a896de8586087175dfff26b25', 're1Hjavg48wRI7Kt0GOA8HquU2fczMY1', 1, '2012-09-10 00:00:00', '2012-11-05 00:00:00');
INSERT INTO `UsersLogin` (`UserID`, `UserName`, `Password`, `Salt`, `State`, `DateJoined`, `DateLastModified`) VALUES (18, 'jfernandes@yahoo.pt', '44494012fa8815059890b206d78b15e4', '1pUQJIlNVYAAPv0HYmkt8hWrErMfJKAg', 1, '2012-08-27 00:00:00', '2012-09-03 00:00:00');
INSERT INTO `UsersLogin` (`UserID`, `UserName`, `Password`, `Salt`, `State`, `DateJoined`, `DateLastModified`) VALUES (19, 'masampaio@sapo.pt', '3d708043f9b48cbf0b6906609864659f', 'KxWAVWa3dtIEFg9smi8v0vX0lii8vHBI', 1, '2012-07-29 00:00:00', '2012-12-10 00:00:00');
INSERT INTO `UsersLogin` (`UserID`, `UserName`, `Password`, `Salt`, `State`, `DateJoined`, `DateLastModified`) VALUES (20, 'hannah.schneider@yahoo.de', '5b07a28fc054211e3ca3b1ea79fdd5e4', 'TMBUkDfMyv6hRez3KVDnCfjLht3yLvJX', 1, '2012-08-01 00:00:00', '2012-11-02 00:00:00');
INSERT INTO `UsersLogin` (`UserID`, `UserName`, `Password`, `Salt`, `State`, `DateJoined`, `DateLastModified`) VALUES (21, 'camille.bernard@yahoo.fr', '417ea2d71b3d61dd12c7bf126fc8e83d', 'p3L5I7yj8OSnR43VFi8jKGHSeNY7MpsI', 1, '2012-10-29 00:00:00', '2012-12-07 00:00:00');
INSERT INTO `UsersLogin` (`UserID`, `UserName`, `Password`, `Salt`, `State`, `DateJoined`, `DateLastModified`) VALUES (22, 'isabelle_mercier@apple.fr', '0ccc0904c901d7bf847c42a70f7fb187', 'aIP5DI349uWKfng6V084FTAauGKCKhnI', 1, '2012-11-12 00:00:00', '2013-01-21 00:00:00');
INSERT INTO `UsersLogin` (`UserID`, `UserName`, `Password`, `Salt`, `State`, `DateJoined`, `DateLastModified`) VALUES (23, 'emma_jones@hotmail.com', '02982989b8ceb5e2276e85633ff7fe02', 'tCr41u0Ap5wwyjki778lGcV9hYVHHOwg', 1, '2012-08-27 00:00:00', '2012-10-29 00:00:00');
INSERT INTO `UsersLogin` (`UserID`, `UserName`, `Password`, `Salt`, `State`, `DateJoined`, `DateLastModified`) VALUES (24, 'phil.hughes@gmail.com', '4f3a9fa4ab53fd6d486e1825d0923e13', '9A9GY16GX7LY02Y3M9vWV0ruYZHToRQT', 1, '2012-07-24 00:00:00', '2012-08-28 00:00:00');
INSERT INTO `UsersLogin` (`UserID`, `UserName`, `Password`, `Salt`, `State`, `DateJoined`, `DateLastModified`) VALUES (25, 'manoj.pareek@rediff.com', '57a618989f36d9a360b28a3137d21ea7', 'VIlh0rsTTk16V9zcxqLvh2gclZyQOUqS', 1, '2012-09-07 00:00:00', '2013-01-11 00:00:00');
INSERT INTO `UsersLogin` (`UserID`, `UserName`, `Password`, `Salt`, `State`, `DateJoined`, `DateLastModified`) VALUES (26, 'puja_srivastava@yahoo.in', '40df37ea86d9eca113d9792920ea8f5f', 'yRh5Y1wmaitivmZquChMWdmsw7Qp7Zlm', 1, '2013-02-01 00:00:00', '2013-05-07 00:00:00');
INSERT INTO `UsersLogin` (`UserID`, `UserName`, `Password`, `Salt`, `State`, `DateJoined`, `DateLastModified`) VALUES (27, 'mark.taylor@yahoo.au', '01a5da61e8b9cfa23fc60d755ae9dd41', 'MPNdWXkMvW2lUfD4B1GCjjc897xQGodV', 1, '2012-09-17 00:00:00', '2012-11-06 00:00:00');
INSERT INTO `UsersLogin` (`UserID`, `UserName`, `Password`, `Salt`, `State`, `DateJoined`, `DateLastModified`) VALUES (28, 'ricunningham@hotmail.com', 'f67ea90a2e7d22c2a1f1efb5db58cbb9', 'gfFw77kT6E2cujRF4k40Eekp0374PqXk', 1, '2012-08-21 00:00:00', '2012-11-10 00:00:00');
INSERT INTO `UsersLogin` (`UserID`, `UserName`, `Password`, `Salt`, `State`, `DateJoined`, `DateLastModified`) VALUES (29, 'patrick.gray@aol.com', '7824ba805eb58f0d8b5e4607f3d70b09', 'RwdSqVGvp4hfSSsVLGhpbKoJwUmv7vG1', 1, '2012-08-27 00:00:00', '2012-08-30 00:00:00');
INSERT INTO `UsersLogin` (`UserID`, `UserName`, `Password`, `Salt`, `State`, `DateJoined`, `DateLastModified`) VALUES (30, 'terhi.hamalainen@apple.fi', 'be8ecb3abe6abd9a83235cd731d3b3f3', 'LnirideCAMlz2LoILM2fb7nPE8yiqnRT', 1, '2013-01-24 00:00:00', '2013-01-28 00:00:00');
INSERT INTO `UsersLogin` (`UserID`, `UserName`, `Password`, `Salt`, `State`, `DateJoined`, `DateLastModified`) VALUES (31, 'stanisław.wójcik@wp.pl', '50096c8cc2ee2915e26989554bf7b190', 'cDw2VtsHAFhyQlOoc7nYCHyivicq1mzG', 1, '2012-11-25 00:00:00', '2012-12-13 00:00:00');
# 31 records