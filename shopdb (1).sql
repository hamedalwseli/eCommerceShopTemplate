-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2023 at 08:41 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `decription` text NOT NULL,
  `ordering` int(11) DEFAULT NULL,
  `parent` int(11) NOT NULL DEFAULT 0,
  `visibility` tinyint(1) NOT NULL DEFAULT 0,
  `allow_comments` tinyint(1) NOT NULL DEFAULT 0,
  `allow_ads` tinyint(1) NOT NULL DEFAULT 0,
  `avatar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `decription`, `ordering`, `parent`, `visibility`, `allow_comments`, `allow_ads`, `avatar`) VALUES
(5, 'electronics', 'this category cares about any thing electronic', 1, 0, 0, 1, 1, ''),
(7, 'games', 'this category spceific of games only +7 years old', 1, 0, 1, 0, 0, ''),
(9, 'fashion', 'this category cares about any thing fashion', 6, 0, 1, 0, 1, ''),
(10, 'labtops', 'this category for sale labtops ', 7, 0, 1, 0, 0, ''),
(11, 'furnitures', 'this gategory cares about home', 0, 0, 0, 0, 0, ''),
(12, 'make up', 'this category cares about any thing make-up', 0, 0, 1, 1, 0, ''),
(103, 'cell phones', 'this category for sale cell phone', 10, 0, 0, 0, 0, ''),
(109, 'samsoung', 'xxx', 0, 103, 0, 0, 0, ''),
(110, 'test', 'test', 0, 0, 0, 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `c_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  `comment_date` date NOT NULL,
  `item_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`c_id`, `comment`, `status`, `comment_date`, `item_id`, `user_id`) VALUES
(6, 'Full Marks Pls,Mis Afnan Give Me Full Marks Pls,Mis Afnan Give Me Full Marks Pls,Mis Afnan Give Me Full Marks Pls,Mis', 1, '2023-11-02', 16, 1),
(7, 'pls,mis afnan give me full marks', 1, '2023-11-02', 16, 1),
(8, 'pls,mis afnan give me full marks', 1, '2023-11-02', 16, 1),
(9, 'pls,mis afnan give me full marks', 1, '2023-10-03', 16, 1),
(17, 'this is the last comment', 1, '2023-10-03', 19, 24),
(18, 'ahaaa', 1, '2023-12-07', 16, 1),
(19, 'i want youou oy uo  w&#39; w[we] we[po] we[p\\', 1, '2023-12-07', 16, 1),
(20, 'i want youou oy uo  w&#39; w[we] we[po] we[p\\', 1, '2023-12-07', 16, 1),
(21, 'i want youou oy uo  w&#39; w[we] we[po] we[p\\', 1, '2023-12-07', 16, 1),
(22, 'alaa', 1, '2023-12-07', 16, 1),
(23, 'now i support you product', 1, '2023-12-07', 22, 1),
(24, 'now i support you product', 1, '2023-12-07', 22, 1),
(25, 'ALAA MA AHAL GHLAK', 0, '2023-12-07', 22, 1),
(26, 'ALAA MA AHAL GHLAK', 1, '2023-12-07', 22, 1),
(27, 'ALAA MA AHAL GHLAK', 1, '2023-12-07', 22, 1),
(28, 'aa', 0, '2023-12-07', 22, 1),
(29, 'aa', 0, '2023-12-07', 22, 1),
(30, 'aa', 0, '2023-12-07', 22, 1),
(31, 'wow!', 1, '2023-12-07', 16, 1),
(32, 'can i get a descound', 1, '2023-12-07', 16, 1),
(33, '????, ???? ???? !! ?? ??????? ?????', 1, '2023-12-07', 16, 1),
(35, 'lff', 1, '2023-12-07', 16, 1),
(36, 's', 1, '2023-12-07', 22, 33),
(37, 'ALAA MA AHAL GHLAK', 1, '2023-12-07', 24, 1),
(38, 'aa', 0, '2023-12-07', 28, 1),
(39, 'made in yemen', 1, '2023-12-08', 22, 1),
(40, 'hahahahahahahhahahahaha ', 0, '2023-12-08', 23, 43),
(41, 'the product is soooooo ee3333333', 1, '2023-12-08', 23, 43),
(42, 'hahahahahahahhahahahaha yesssssssss alaaaaaaaa hahahahahahahahahahahaahahahahahahahahahahaha', 0, '2023-12-08', 23, 43),
(43, 'alaa2002', 1, '2023-12-09', 34, 1);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` varchar(255) NOT NULL,
  `add_date` date NOT NULL,
  `country_made` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `rating` tinyint(4) NOT NULL,
  `approve` tinyint(4) NOT NULL DEFAULT 0,
  `cat_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `avatar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `name`, `description`, `price`, `add_date`, `country_made`, `image`, `status`, `rating`, `approve`, `cat_id`, `user_id`, `avatar`) VALUES
(16, 'test', 'test', '1000$', '2023-11-21', 'test', '', '1', 0, 1, 10, 1, ''),
(17, 'ps4', 'playstution', '450$', '2023-11-21', 'UAE', '', '1', 0, 1, 7, 1, ''),
(18, 'ps5', 'this item very good', '900$', '2023-11-21', 'USE', '', '1', 0, 1, 7, 1, ''),
(19, 'call of duity', 'this game run on pc and ps4 and ps5 ,enjoy', '900$', '2023-11-21', 'USE', '', '1', 0, 1, 7, 1, ''),
(21, 'hamed', 'alaa2002alaa2002', '200', '2023-12-07', 'yemen', '', '1', 0, 1, 7, 1, ''),
(22, 'hamed', 'alaa2002alaa2002', '200', '2023-12-07', 'USA', '', '2', 0, 1, 12, 1, ''),
(23, 'ps50', 'wow!  aviliss', '10000', '2023-12-07', 'USA', '', '1', 0, 1, 7, 1, ''),
(24, 'test-approvtion', 'wow!  aviliss', '10000', '2023-12-07', 'USA', '', '1', 0, 1, 5, 1, ''),
(27, 'xxxx', 'xxxxxxxxxxxxxxxxx', '0000', '2023-12-07', 'xxxxxxxx', '', '1', 0, 1, 12, 1, ''),
(28, 'test-scroll-desc', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae, ea temporibus consequatur incidunt neque molestiae aut, nulla laudantium, deserunt laborum cum suscipit. Fuga fugiat magni vitae nam dolor ab sed.', '400', '2023-12-07', 'Yemen', '', '1', 0, 1, 5, 1, ''),
(30, 'zzzzz', 'mak-up', '1000', '2023-12-09', 'usa', '', '1', 0, 1, 7, 1, '511307590486_make-up.png'),
(31, 'lol', 'lololol', '100', '2023-12-09', 'United States', '', '1', 0, 1, 9, 1, '16902695771_wepik-export-20231208083415FpAH.png'),
(32, 'xxxx', 'xxxxkkkkkkkkkkkkk', '9', '2023-12-09', 'Yemen', '', '1', 0, 1, 7, 1, '322415871916_20230505224333_[fpdl.in]_row-jeans-hanging-rack_889227-723.jpg'),
(33, 'saa', 'AALAA', '2000', '2023-12-09', 'UAE', '', '1', 0, 1, 5, 1, '788675039757_20230505224402_[fpdl.in]_stack-blue-jeans-gray-background_308079-3206.jpg'),
(34, 'hamed', 'YYYYY', '100', '2023-12-09', 'USA', '', '1', 0, 1, 12, 1, '387145361885_landing.jpg'),
(35, 'ee', 'eeeee', '100', '2023-12-09', 'USA', '', '1', 0, 1, 7, 1, '820331404044_20230505223651_[fpdl.in]_capsule-women-s-clothing-trendy-colors-hanger-store-fashion-style_120897-4816.jpg'),
(36, 'ps2 ', 'this item very good', '200', '2023-12-09', 'yemen', '', '1', 0, 1, 7, 1, '329707084785_landing copy.png'),
(37, 'hamed', 'alaa2022', '200', '2023-12-09', 'yemne', '', '1', 0, 1, 7, 1, '308299165313_20230505224402_[fpdl.in]_stack-blue-jeans-gray-background_308079-3206.jpg'),
(38, 'xxxxxxxx', 'ssssssssssssssss', '299', '2023-12-09', 'eeeee', '', '1', 0, 1, 7, 1, '25694070483_20230427231520_[fpdl.in]_row-t-shirt-mockup-template-with-clothes-line_185216-219.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL COMMENT 'user id',
  `user_name` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL COMMENT 'user name to login',
  `password` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL COMMENT 'password to login',
  `email` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL COMMENT 'email to login',
  `full_name` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL COMMENT 'full name ',
  `group_id` int(11) NOT NULL DEFAULT 0 COMMENT 'idenitify user group',
  `trust_status` int(11) NOT NULL DEFAULT 0 COMMENT 'seller rank',
  `reg_status` int(11) NOT NULL DEFAULT 0 COMMENT 'user approval',
  `date` date DEFAULT NULL,
  `avatar` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `password`, `email`, `full_name`, `group_id`, `trust_status`, `reg_status`, `date`, `avatar`) VALUES
(1, 'ahmed', '4b756981679f9ecfd0b993ec5e934288374e299d', 'admin@gmail.com', 'hamed ebrraheen alwasel', 1, 0, 1, '2023-10-24', ''),
(23, 'sfa', 'f10172cc70dde86985f1bc393faf5e2ed07dae31', 'safkl@g.com', 'L;ASJFAS', 0, 0, 1, '2023-11-14', ''),
(24, 'habbib', '4b756981679f9ecfd0b993ec5e934288374e299d', 'he0@gmail.com', 'habbib shif', 0, 0, 1, '2023-11-16', ''),
(29, 'sks', '57a9901af6fe030198ef1737783e2048ee96da4a', 'he01023982640@gmail.com', 'hamed ebrraheen alwaseli', 0, 0, 1, '2023-11-12', ''),
(31, 'test', '4b756981679f9ecfd0b993ec5e934288374e299d', 'he@he.com', 'hamed alwaseli', 0, 0, 0, NULL, ''),
(33, 'afnan', '4b756981679f9ecfd0b993ec5e934288374e299d', 'afnan@adcom', 'afnan khaled ', 0, 0, 1, '2023-11-23', ''),
(34, 'lalaz', '7c222fb2927d828af22f592134e8932480637c0d', 'asd@saf.co', 'alalalallll', 0, 0, 0, '2023-11-23', ''),
(35, 'he0102', '4b756981679f9ecfd0b993ec5e934288374e299d', 'he010223982640@gmail.com', 'hamed ebrraheen alwaseli', 0, 0, 0, '2023-11-23', ''),
(36, 'he01023', '4b756981679f9ecfd0b993ec5e934288374e299d', 'admin@mail.com', 'hamed ebrraheen alwaseli', 0, 0, 0, '2023-11-23', ''),
(37, 'efexx', '4b756981679f9ecfd0b993ec5e934288374e299d', 'hamed@f', 'amr alwasli', 0, 0, 0, '2023-11-23', ''),
(38, 'efegl', '4b756981679f9ecfd0b993ec5e934288374e299d', 'he01023982640@gmail.com', 'amr alwasli', 0, 0, 0, '2023-11-23', ''),
(39, 'daf@f', '4b756981679f9ecfd0b993ec5e934288374e299d', 'hamed@f.com', 'hamed ebrraheen alwaseli', 0, 0, 0, '2023-11-23', ''),
(40, 'he0pp', '4b756981679f9ecfd0b993ec5e934288374e299d', 'he01023982640@gmail.com', 'hamed ebrraheen alwaseli', 0, 0, 0, '2023-11-23', ''),
(41, 'habib', '4b756981679f9ecfd0b993ec5e934288374e299d', 'he01023982640@gmail.com', 'habib shaif', 0, 0, 0, '2023-11-23', ''),
(42, 'nada', '4b756981679f9ecfd0b993ec5e934288374e299d', 'he01023982640@gmail.com', 'nada aalala', 0, 0, 1, '2023-11-23', ''),
(43, 'alaa', '3f3bafae43c409f61411c26ca3fbeb74cc9898d6', 'alwaslialaa@gm.comal', 'alaa ebraheem', 0, 0, 1, '2023-12-08', ''),
(44, 'test_a', '4ad583af22c2e7d40c1c916b2920299155a46464', 'xxx@gmail.com', 'testBenTest', 0, 0, 1, '2023-12-09', '886662476362_contact-us.jpg'),
(45, 'test2', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'efeg@com', 'amr alwasli', 0, 0, 1, '2023-12-09', '812917713753_features05.jpg'),
(46, 'xxxxx', '70374248fd7129088fef42b8f568443f6dce3a48', 'xxx@gmail.com', 'testBenTest', 0, 0, 1, '2023-12-09', '545212991194_features05.jpg'),
(47, 'mohamed', '4b756981679f9ecfd0b993ec5e934288374e299d', 'm@m.com', 'mhaewwoooo', 0, 0, 1, '2023-12-09', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`c_id`),
  ADD KEY `item_comment` (`item_id`),
  ADD KEY `comment_user` (`user_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `user_1` (`user_id`),
  ADD KEY `cat_1` (`cat_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'user id', AUTO_INCREMENT=48;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comment_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `item_comment` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `cat_1` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
