-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2020 at 10:10 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `show`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Descrption` text NOT NULL,
  `parent` int(11) NOT NULL,
  `Ordering` int(11) DEFAULT NULL,
  `Visibilty` tinyint(4) NOT NULL DEFAULT '0',
  `Allow_Comment` tinyint(4) NOT NULL DEFAULT '0',
  `Allow_Ads` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`ID`, `Name`, `Descrption`, `parent`, `Ordering`, `Visibilty`, `Allow_Comment`, `Allow_Ads`) VALUES
(14, 'Hand Made', 'Hand Made Items', 0, 1, 1, 1, 1),
(15, 'computers', 'comput items', 0, 2, 0, 0, 0),
(16, 'cell phone', 'cell phone', 0, 3, 0, 0, 0),
(17, 'clothing ', 'clothing', 0, 4, 0, 0, 0),
(18, 'tools', 'home tools', 0, 5, 0, 0, 0),
(19, 'Nokia', 'Nokia phones', 16, 1, 0, 0, 0),
(21, 'Hammers', 'Hammers Desc', 18, 1, 0, 0, 0),
(22, 'Boxes', 'Boxes', 14, 5, 0, 0, 0),
(23, 'games', 'Hand Made Items', 18, 2, 0, 0, 0),
(24, 'LapTop', 'laptop show ', 0, 3, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `c_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  `comment_date` date NOT NULL,
  `item_ID` int(11) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`c_id`, `comment`, `status`, `comment_date`, `item_ID`, `userID`) VALUES
(3, 'very good very good ', 1, '2020-06-07', 21, 7),
(50, 'commment', 1, '2020-06-09', 20, 5),
(51, 'very good', 1, '2020-06-09', 25, 8),
(52, 'very cool', 1, '2020-06-09', 25, 8),
(53, 'vary Nice the  thanks', 1, '2020-06-11', 25, 8),
(56, 'this is Me mohamed', 1, '2020-06-11', 25, 7);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Descrption` text NOT NULL,
  `price` varchar(255) NOT NULL,
  `Add_date` date NOT NULL,
  `country_made` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `Rating` smallint(6) NOT NULL,
  `Approve` tinyint(4) NOT NULL DEFAULT '0',
  `cat_ID` int(11) NOT NULL,
  `Member_ID` int(11) NOT NULL,
  `tags` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_ID`, `Name`, `Descrption`, `price`, `Add_date`, `country_made`, `image`, `status`, `Rating`, `Approve`, `cat_ID`, `Member_ID`, `tags`) VALUES
(19, 'speaker', 'very good speaker', '$100', '2020-06-07', 'chine', '', '1', 0, 1, 15, 1, ''),
(20, 'microphone', 'veryv good microphone veryv ', '$108', '2020-06-07', 'USA', '', '1', 0, 1, 15, 5, ''),
(21, 'iphone6s', 'Apple iphone 6s', '$300', '2020-06-07', 'USA', '', '1', 0, 1, 16, 6, ''),
(22, 'Magic mouse', 'Apple Magic mouse', '$150', '2020-06-07', 'USA', '', '1', 0, 1, 15, 5, ''),
(25, 'Game', 'test game in cuptior', '100', '2020-06-08', 'Europe', '', '1', 0, 1, 15, 8, ''),
(26, 'Hand Made', 'Apple Magic mouse', '120', '2020-06-08', 'USA', '', '1', 0, 1, 14, 8, ''),
(27, 'pc', 'Apple Magic mouse', '$120', '2020-06-08', 'eypt', '', '2', 0, 1, 16, 8, ''),
(28, 'Electronic', 'cat 9 Network cable', '$120', '2020-06-11', 'Europe', '', '2', 0, 1, 17, 5, ''),
(29, 'mouse', 'test game in cuptior', '$120', '2020-06-11', 'USA', '', '1', 0, 1, 15, 8, ''),
(30, 'hussein', 'husseinhussein mohamed', '80', '2020-06-11', 'Europe', '', '1', 0, 1, 16, 8, ''),
(31, 'Dantes inferno', 'mobli networkmobli networkmobli network', '80', '2020-06-11', 'eypt', '', '1', 0, 1, 15, 8, ''),
(32, 'kuybord', 'Apple Magic mouse', '100', '2020-06-11', 'USA', '', '3', 0, 1, 15, 8, ''),
(33, 'My item', 'My new Description', '120', '2020-06-11', 'USA', '', '1', 0, 1, 16, 8, 'fancy, new, tag, demo,hussein'),
(34, 'Woaden Game', 'A Good woaden game', '100', '2020-06-12', 'eypt', '', '1', 0, 1, 14, 8, ' hand,Discount ,Gurantee'),
(35, 'Diablo 3', 'Good palystation 4 game', '70', '2020-06-14', 'USA', '', '1', 0, 1, 23, 8, 'RPG, Oline ,Game'),
(36, 'Ys otth in Felghana ', 'Ps Game  s', '100', '2020-06-14', 'japan', '', '1', 0, 1, 23, 8, 'online,RPG ,Game,demo'),
(38, 'Dantes inferno00', 'Apple Magic mouse', '1200', '2020-06-14', 'Europe', '98100273_1451_1515495140.jpg', '1', 0, 1, 23, 8, 'fancy, new, tag, demo,hussein'),
(39, 'Electronicrr', 'A Good Ps6 Geme', '120', '2020-06-14', 'eypt', '81831404_1451_1515086136.jpg', '1', 0, 0, 23, 8, 'online,RPG ,Game,demo'),
(40, 'Electronicrr', 'A Good Ps6 Geme', '120', '2020-06-14', 'eypt', '64587126_1451_1515086136.jpg', '1', 0, 0, 23, 8, 'online,RPG ,Game,demo'),
(41, 'playstation 5', 'good playstation 5 ', '150', '2020-06-14', 'USA', '43453947_1451_1515086229.jpg', '1', 0, 1, 23, 8, 'online,RPG ,Game,demo'),
(42, 'switsh', 'A Good switsh', '100', '2020-06-14', 'Europe', '58020567_index.jpg', '1', 0, 1, 15, 8, 'online,RPG ,Game,demo'),
(43, 'Dell', 'dell in use', '1200', '2020-06-14', 'USA', '65247899_index.jpg', '1', 0, 1, 24, 1, 'dell,laptop,');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL COMMENT 'to identfy user',
  `Username` varchar(255) NOT NULL COMMENT 'username to login',
  `Password` varchar(255) NOT NULL COMMENT 'password  to login',
  `Email` varchar(255) NOT NULL,
  `FullName` varchar(255) NOT NULL,
  `GroupID` int(11) NOT NULL DEFAULT '0' COMMENT 'idenfint user group',
  `Truststatus` int(11) NOT NULL DEFAULT '0' COMMENT 'seller Rank',
  `Regstatus` int(11) NOT NULL DEFAULT '0' COMMENT 'user approve',
  `Date` date NOT NULL,
  `avatar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Username`, `Password`, `Email`, `FullName`, `GroupID`, `Truststatus`, `Regstatus`, `Date`, `avatar`) VALUES
(1, 'hussein', '601f1889667efaebb33b8c12572835da3f027f78', 'husseinmohamed010@gmial.com', 'huseeinmohamed', 1, 0, 1, '2020-05-05', ''),
(5, 'saad', '601f1889667efaebb33b8c12572835da3f027f78', 'saad@a.com', 'saadheshim1', 0, 0, 1, '2020-06-06', '82124081_'),
(6, 'hassan', '601f1889667efaebb33b8c12572835da3f027f78', 'hasan@g.com', 'abrihim', 0, 0, 1, '2020-06-06', '71944481_'),
(7, 'mohamed', '601f1889667efaebb33b8c12572835da3f027f78', 'm@g.com', 'mohameahmed', 0, 0, 1, '2020-06-06', '59426422_'),
(8, 'ahmed', '601f1889667efaebb33b8c12572835da3f027f78', 'ahmed@g.com', 'ahmedsamha', 0, 0, 1, '2020-06-07', '89919312_11282170_810601925702591_781726885_n.jpg'),
(10, 'mhuomed', '601f1889667efaebb33b8c12572835da3f027f78', 'm@go.com', 'mohuomed mohamed', 0, 0, 1, '2020-06-14', '26396235_1451_1515086136.jpg'),
(11, 'husseinmohamed', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'a@g.com', 'ahmedsamhasaad', 1, 0, 1, '2020-06-14', '95668152_1451_1515086136.jpg'),
(13, 'ahmedmohamed', '601f1889667efaebb33b8c12572835da3f027f78', 'saadmohame@g.com', 'saadheshim', 0, 0, 0, '2020-06-14', '47792623_3.jpg'),
(14, 'hussein5', '601f1889667efaebb33b8c12572835da3f027f78', 'hus@a.com', 'huseeinmohamed', 1, 0, 0, '2020-06-14', '43440188_1451_1515086136.jpg'),
(15, 'mounshr', '601f1889667efaebb33b8c12572835da3f027f78', 'mddo@g.com', 'ssssssssss', 0, 0, 0, '2020-06-14', '87396010_index.jpg'),
(16, 'ahmedsaadmohamed', '601f1889667efaebb33b8c12572835da3f027f78', 'saad@g.com', 'huseeinmohamed', 0, 0, 1, '2020-06-14', '74192077_5.jpg'),
(17, 'ahmedaaaaa', '601f1889667efaebb33b8c12572835da3f027f78', 'ahmed@g.com', 'abrihim', 0, 0, 1, '2020-06-14', '68785092_02.jpg'),
(18, 'husseinddd', '601f1889667efaebb33b8c12572835da3f027f78', 'a@g.com', 'abrihimjh', 0, 0, 1, '2020-06-14', '78867875_index.jpg'),
(19, 'alinour', '601f1889667efaebb33b8c12572835da3f027f78', 'ali@g.comh', 'alinouraldin', 0, 0, 1, '2020-06-15', '36023682_index.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Name` (`Name`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`c_id`),
  ADD KEY `item_comment` (`item_ID`),
  ADD KEY `user_comment` (`userID`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_ID`),
  ADD KEY `cat_1` (`cat_ID`),
  ADD KEY `member_1` (`Member_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'to identfy user', AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `item_comment` FOREIGN KEY (`item_ID`) REFERENCES `items` (`item_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_comment` FOREIGN KEY (`userID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `cat_1` FOREIGN KEY (`cat_ID`) REFERENCES `categories` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `member_1` FOREIGN KEY (`Member_ID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
