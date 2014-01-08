-- phpMyAdmin SQL Dump
-- version 4.0.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 08, 2014 at 01:32 AM
-- Server version: 5.5.33
-- PHP Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `modelmates`
--

-- --------------------------------------------------------

--
-- Table structure for table `access_control`
--

CREATE TABLE `access_control` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(10) unsigned NOT NULL,
  `permission_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(10) NOT NULL,
  `passw` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `user`, `passw`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `conversations`
--

CREATE TABLE `conversations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `starter_id` int(10) unsigned NOT NULL,
  `recipient_id` int(10) unsigned NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `image` int(10) unsigned DEFAULT NULL,
  `date` date NOT NULL,
  `start` time NOT NULL,
  `finish` time NOT NULL,
  `title` varchar(100) NOT NULL,
  `location` varchar(200) NOT NULL,
  `assisting` int(10) unsigned NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `event_assistamts`
--

CREATE TABLE `event_assistamts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `event_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `event_covers`
--

CREATE TABLE `event_covers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `event_id` int(10) unsigned NOT NULL,
  `title` varchar(100) NOT NULL,
  `price` decimal(10,2) unsigned NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `width` int(5) DEFAULT NULL,
  `height` int(5) DEFAULT NULL,
  `size` int(10) unsigned NOT NULL,
  `uri` varchar(100) NOT NULL,
  `extension` varchar(5) NOT NULL,
  `type` varchar(20) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=72 ;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `user_id`, `width`, `height`, `size`, `uri`, `extension`, `type`, `created`) VALUES
(36, 7, 1920, 1080, 490808, '7z1079860493-24978e1d0f34df9a376a59c9d5aeb4f5', 'jpg', 'image/jpeg', '2013-11-25 22:39:39'),
(37, 7, 1920, 1080, 490808, '7z68101476-8ced88e3090a20eb7a47af27e74a8701', 'jpg', 'image/jpeg', '2013-11-25 16:43:56'),
(38, 7, 1920, 1080, 1254905, '7z699536131-db9d3d443771a349b71d2a87a6388b46', 'jpg', 'image/jpeg', '2013-11-25 16:44:02'),
(39, 7, 1920, 1080, 2026771, '7z1920729795-442304e80407a88eda78017b06029d67', 'png', 'image/png', '2013-11-25 16:44:12'),
(40, 9, 1000, 627, 211494, '9z1722162851-638a462f2e896a0f1a1e09598863b8d2', 'png', 'image/png', '2013-12-27 20:53:27'),
(41, 9, 1344, 840, 311322, '9z2083506998-13da84387da8935bb94d12f033ab593d', 'png', 'image/png', '2013-12-27 23:04:44'),
(42, 9, 1000, 627, 211494, '9z479035787-725a3b7b9988301bcc930daa38be746b', 'png', 'image/png', '2013-12-27 23:08:59'),
(43, 9, 863, 540, 537071, '9z771714243-9433d135b6651e9dbb85bfcb557bd25d', 'png', 'image/png', '2013-12-27 23:09:49'),
(44, 9, 500, 296, 30519, '9z282366133-cff6fb1d355ad0877ca2afe84a55ef1e', 'png', 'image/png', '2013-12-27 23:13:11'),
(45, 9, 500, 296, 30519, '9z1718540758-4ed625d36a13ec00e41fb86db2ef3b5f', 'png', 'image/png', '2013-12-27 23:18:56'),
(46, 9, 500, 296, 30519, '9z1248476712-5d01061102160ca7fc19725824973f6c', 'png', 'image/png', '2013-12-27 23:20:54'),
(47, 1, 275, 183, 6126, '1z1520342464-4ab1478457fb9ef7d018c850bbe7d190', 'jpeg', 'image/jpeg', '2014-01-07 22:16:55'),
(48, 1, 275, 183, 6126, '1z471733538-a9438844c91c7a55e92c68c451d3ba4f', 'jpeg', 'image/jpeg', '2014-01-07 22:17:53'),
(49, 1, 1032, 913, 591003, '1z803112290-eec4e2f3f5ca784baf7f9329a016643c', 'png', 'image/png', '2014-01-07 22:20:23'),
(50, 1, 1031, 1035, 698572, '1z71229334-f2fa58b0bdedcbed46eab39c69c34b6c', 'png', 'image/png', '2014-01-07 22:20:44'),
(51, 1, 1088, 1164, 766586, '1z775224670-9312ad50b41f98602f307c8ae563856b', 'png', 'image/png', '2014-01-07 22:21:04'),
(52, 1, 1088, 1164, 766586, '1z926357444-82f00b4680e0de5c5beea482c4228328', 'png', 'image/png', '2014-01-07 22:34:07'),
(53, 1, 1031, 1035, 698572, '1z1369876630-ebd57b7f9d7607bc171cf0795fcf6a2c', 'png', 'image/png', '2014-01-07 22:34:23'),
(54, 1, 1032, 913, 591003, '1z1180675502-bbbb51b0fd11eb104c9268eebfbf7ddb', 'png', 'image/png', '2014-01-07 22:34:39'),
(55, 1, 1088, 1164, 766586, '1z1397680912-b08cdba700cda2cbe105b6ef15a379c1', 'png', 'image/png', '2014-01-07 22:35:55'),
(56, 1, 1088, 1164, 766586, '1z620946245-dbf2746265c9faeb2ea6c4fa3a094f61', 'png', 'image/png', '2014-01-07 22:37:58'),
(57, 1, 1032, 913, 591003, '1z1868742176-fd60e810391e43168c91f1084f03e268', 'png', 'image/png', '2014-01-07 22:38:27'),
(58, 1, 1031, 1035, 698572, '1z1912409351-35ee7358d65e6a501b1f2dace7b1ec4b', 'png', 'image/png', '2014-01-07 22:39:27'),
(59, 1, 1032, 913, 591003, '1z116468435-fb32c4aa1ca60b857fbbd1b7fd773148', 'png', 'image/png', '2014-01-07 22:39:43'),
(60, 1, 1088, 1164, 766586, '1z1458807487-03ff6429d557b200f5a90d2745c5a111', 'png', 'image/png', '2014-01-07 22:39:59'),
(61, 1, 1088, 1164, 766586, '1z2068780938-16ef213e4b54d14faaa13c58c5026e50', 'png', 'image/png', '2014-01-07 22:40:33'),
(62, 1, 1088, 1164, 766586, '1z596452202-721910dc55e70d5068d418f4a454cfee', 'png', 'image/png', '2014-01-07 22:43:11'),
(63, 1, 1088, 1164, 766586, '1z404796020-84a8b2cf2efbbc8e0809378ed6726d19', 'png', 'image/png', '2014-01-07 22:45:19'),
(64, 1, 1032, 913, 591003, '1z1474032611-e3a4dabc118821287763af9e2b195d11', 'png', 'image/png', '2014-01-07 22:45:34'),
(65, 1, 1031, 1035, 698572, '1z1806485607-6d90161d39f9f05ddc8e262f6e48132c', 'png', 'image/png', '2014-01-07 22:45:50'),
(66, 1, 1031, 1035, 698572, '1z1268351702-cdf40af19eb14f6f167e74db895687ad', 'png', 'image/png', '2014-01-07 22:49:07'),
(67, 1, 1032, 913, 591003, '1z345298320-f099839a4bf4c4d5c106d73e69dc5ce5', 'png', 'image/png', '2014-01-07 22:49:22'),
(68, 1, 1088, 1164, 766586, '1z1907535504-40541cd83c797dcef271abb84f7b039f', 'png', 'image/png', '2014-01-07 22:49:50'),
(69, 1, 1032, 913, 591003, '1z1540105499-128c618780cec05d48e8fd606eec11de', 'png', 'image/png', '2014-01-07 23:00:05'),
(70, 1, 1088, 1164, 766586, '1z835371882-cadee468d43d7784cf0b4bceb3a2d9fb', 'png', 'image/png', '2014-01-07 23:00:30'),
(71, 1, 1031, 1035, 698572, '1z1230213654-ddec582677a8e8300e50ff8fcd3eeeaa', 'png', 'image/png', '2014-01-07 23:00:48');

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

CREATE TABLE `galleries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `updated` datetime NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `hot100`
--

CREATE TABLE `hot100` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `rank` decimal(3,1) unsigned NOT NULL,
  `year` int(4) unsigned NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `listings`
--

CREATE TABLE `listings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category` int(11) DEFAULT NULL,
  `image` int(10) unsigned NOT NULL,
  `title` varchar(100) NOT NULL,
  `state` varchar(20) DEFAULT NULL,
  `city` varchar(40) DEFAULT NULL,
  `type` varchar(100) NOT NULL,
  `description` text,
  `parking` tinyint(1) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `rank` decimal(3,1) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category` (`category`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=42 ;

--
-- Dumping data for table `listings`
--

INSERT INTO `listings` (`id`, `category`, `image`, `title`, `state`, `city`, `type`, `description`, `parking`, `address`, `phone`, `rank`, `created`) VALUES
(1, 3, 0, 'Testing', 'AK', 'qweqwe', 'asdasd', 'Testing description', 0, 'Address here', '11112222', 0.0, '0000-00-00 00:00:00'),
(2, 3, 0, 'Testing', 'AK', 'qweqwe', 'asdasd', 'Testing description', 0, 'Address here', '11112222', 0.0, '2013-12-30 23:03:56'),
(3, 1, 0, 'Test', 'AR', 'Santa Clara', 'Italian Food', 'Testing Listings', 1, 'Some Address', '8888', 0.0, '2014-01-07 22:58:26');

-- --------------------------------------------------------

--
-- Table structure for table `listing_categories`
--

CREATE TABLE `listing_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(20) NOT NULL,
  `description` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `listing_categories`
--

INSERT INTO `listing_categories` (`id`, `title`, `description`) VALUES
(1, 'Dining', 'Dining Experiences'),
(2, 'Entertainment ', 'Entertainment Experiences'),
(3, 'Nightlife', 'Nightlife Experiences'),
(4, 'Shopping', 'Shopping Experiences'),
(5, 'Wellness', 'Wellness Experiences'),
(6, 'Luxury Rentals', 'Luxury Rentals Experiences'),
(7, 'Travel', 'Travel Experiences'),
(8, 'Special Gift', 'Special Gift Experiences');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `conversation_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `inbox` tinyint(1) NOT NULL,
  `outbox` tinyint(1) NOT NULL,
  `text` text NOT NULL,
  `from` int(10) unsigned NOT NULL,
  `to` int(10) unsigned NOT NULL,
  `created` datetime NOT NULL,
  `readed` datetime NOT NULL,
  `stared` tinyint(1) NOT NULL,
  `trashed` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `description` text,
  `group` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pictures`
--

CREATE TABLE `pictures` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `object_id` int(10) unsigned NOT NULL,
  `object_type` varchar(10) NOT NULL,
  `file_id` int(10) unsigned NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `file_id` (`file_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=72 ;

--
-- Dumping data for table `pictures`
--

INSERT INTO `pictures` (`id`, `object_id`, `object_type`, `file_id`, `created`) VALUES
(36, 24, 'profile', 36, '2013-11-25 22:39:40'),
(37, 7, 'profile', 37, '2013-11-25 16:43:56'),
(38, 7, 'profile', 38, '2013-11-25 16:44:02'),
(39, 7, 'profile', 39, '2013-11-25 16:44:12'),
(40, 9, 'profile', 40, '2013-12-27 20:53:27'),
(41, 9, 'profile', 41, '2013-12-27 23:04:44'),
(42, 9, 'profile', 42, '2013-12-27 23:08:59'),
(43, 9, 'profile', 43, '2013-12-27 23:09:49'),
(44, 9, 'profile', 44, '2013-12-27 23:13:11'),
(45, 9, 'profile', 45, '2013-12-27 23:18:56'),
(46, 9, 'profile', 46, '2013-12-27 23:20:54'),
(47, 0, 'listing', 47, '2014-01-07 22:16:55'),
(48, 0, 'listing', 48, '2014-01-07 22:17:53'),
(49, 0, 'listing', 49, '2014-01-07 22:20:23'),
(50, 0, 'listing', 50, '2014-01-07 22:20:44'),
(51, 0, 'listing', 51, '2014-01-07 22:21:04'),
(52, 0, 'listing', 52, '2014-01-07 22:34:07'),
(53, 0, 'listing', 53, '2014-01-07 22:34:23'),
(54, 0, 'listing', 54, '2014-01-07 22:34:39'),
(55, 0, 'listing', 55, '2014-01-07 22:35:55'),
(56, 0, 'listing', 56, '2014-01-07 22:37:58'),
(57, 0, 'listing', 57, '2014-01-07 22:38:27'),
(58, 0, 'listing', 58, '2014-01-07 22:39:27'),
(59, 0, 'listing', 59, '2014-01-07 22:39:43'),
(60, 0, 'listing', 60, '2014-01-07 22:39:59'),
(61, 0, 'listing', 61, '2014-01-07 22:40:33'),
(62, 0, 'listing', 62, '2014-01-07 22:43:11'),
(63, 0, 'listing', 63, '2014-01-07 22:45:19'),
(64, 0, 'listing', 64, '2014-01-07 22:45:34'),
(65, 0, 'listing', 65, '2014-01-07 22:45:50'),
(66, 0, 'listing', 66, '2014-01-07 22:49:07'),
(67, 0, 'listing', 67, '2014-01-07 22:49:22'),
(68, 0, 'listing', 68, '2014-01-07 22:49:50'),
(69, 41, 'listing', 69, '2014-01-07 23:00:05'),
(70, 41, 'listing', 70, '2014-01-07 23:00:30'),
(71, 41, 'listing', 71, '2014-01-07 23:00:48');

-- --------------------------------------------------------

--
-- Table structure for table `privacy`
--

CREATE TABLE `privacy` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `description` text,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `privacy_settings`
--

CREATE TABLE `privacy_settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `privacy_id` int(10) unsigned NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `crelation` varchar(50) DEFAULT NULL,
  `drelation` varchar(50) DEFAULT NULL,
  `race` varchar(20) DEFAULT NULL,
  `body` varchar(20) DEFAULT NULL,
  `personality` varchar(20) DEFAULT NULL,
  `children` tinyint(1) DEFAULT NULL,
  `height` varchar(10) DEFAULT NULL,
  `weight` varchar(10) DEFAULT NULL,
  `eyes` varchar(20) DEFAULT NULL,
  `hair` varchar(20) DEFAULT NULL,
  `bestasset` varchar(20) DEFAULT NULL,
  `smoking` varchar(20) DEFAULT NULL,
  `drinking` varchar(20) DEFAULT NULL,
  `drugs` varchar(20) DEFAULT NULL,
  `income` varchar(20) DEFAULT NULL,
  `bodyart` varchar(20) DEFAULT NULL,
  `education` varchar(40) DEFAULT NULL,
  `tagline` text,
  `about` text,
  `lookingfor` varchar(20) DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=173 ;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `crelation`, `drelation`, `race`, `body`, `personality`, `children`, `height`, `weight`, `eyes`, `hair`, `bestasset`, `smoking`, `drinking`, `drugs`, `income`, `bodyart`, `education`, `tagline`, `about`, `lookingfor`, `created`, `updated`) VALUES
(157, 7, 'Single', 'Single', 'White', 'Slim', 'Outgoing', 0, '4'' 0"', NULL, 'Blue', 'Blonde', 'Hair', '0', '0', '0', '100000', '0', 'Primary', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(158, 7, 'Single', 'Single', 'White', 'Slim', 'Outgoing', 0, '4'' 0"', NULL, 'Blue', 'Blonde', 'Hair', '0', '0', '0', '100000', '0', 'Primary', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(159, 7, 'Single', 'Single', 'White', 'Slim', 'Outgoing', 0, '4'' 0"', NULL, 'Blue', 'Blonde', 'Hair', '0', '0', '0', '100000', '0', 'Primary', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(160, 7, 'Single', 'Single', 'White', 'Slim', 'Outgoing', 0, '4'' 0"', NULL, 'Blue', 'Blonde', 'Hair', '0', '0', '0', '100000', '0', 'Primary', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(161, 8, 'Single', 'Single', 'Latin / Hispanic', 'Slim', 'Outgoing', 0, '4'' 0"', NULL, 'Blue', 'Blonde', 'Hair', 'Never', 'Never', 'Never', '1000000', 'Nothing', 'Master', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(162, 9, 'Single', 'Single', 'White', 'Slim', 'Outgoing', 0, '4'' 0"', NULL, 'Blue', 'Blonde', 'Hair', 'Never', 'Never', 'Never', '100000', 'Nothing', 'Primary', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(163, 9, 'Single', 'Single', 'White', 'Slim', 'Outgoing', 0, '4'' 0"', NULL, 'Blue', 'Blonde', 'Hair', 'Never', 'Never', 'Never', '100000', 'Nothing', 'Primary', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(164, 9, 'Single', 'Single', 'White', 'Slim', 'Outgoing', 0, '4'' 0"', NULL, 'Blue', 'Blonde', 'Hair', 'Never', 'Never', 'Never', '100000', 'Nothing', 'Primary', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(165, 9, 'Single', 'Single', 'White', 'Slim', 'Outgoing', 0, '4'' 0"', NULL, 'Blue', 'Blonde', 'Hair', 'Never', 'Never', 'Never', '100000', 'Nothing', 'Primary', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(166, 9, 'Single', 'Single', 'White', 'Slim', 'Outgoing', 0, '4'' 0"', NULL, 'Blue', 'Blonde', 'Hair', 'Never', 'Never', 'Never', '100000', 'Nothing', 'Primary', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(167, 9, 'Single', 'Single', 'White', 'Slim', 'Outgoing', 0, '4'' 0"', NULL, 'Blue', 'Blonde', 'Hair', 'Never', 'Never', 'Never', '100000', 'Nothing', 'Primary', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(168, 9, 'Single', 'Single', 'White', 'Slim', 'Outgoing', 0, '4'' 0"', NULL, 'Blue', 'Blonde', 'Hair', 'Never', 'Never', 'Never', '100000', 'Nothing', 'Primary', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(169, 9, 'Single', 'Single', 'White', 'Slim', 'Outgoing', 0, '4'' 0"', NULL, 'Blue', 'Blonde', 'Hair', 'Never', 'Never', 'Never', '100000', 'Nothing', 'Primary', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(170, 9, 'Single', 'Single', 'White', 'Slim', 'Outgoing', 0, '4'' 0"', NULL, 'Blue', 'Blonde', 'Hair', 'Never', 'Never', 'Never', '100000', 'Nothing', 'Primary', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(171, 9, 'Single', 'Single', 'White', 'Slim', 'Outgoing', 0, '4'' 0"', NULL, 'Blue', 'Blonde', 'Hair', 'Never', 'Never', 'Never', '100000', 'Nothing', 'Primary', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(172, 9, 'Single', 'Single', 'White', 'Slim', 'Outgoing', 0, '4'' 0"', NULL, 'Blue', 'Blonde', 'Hair', 'Never', 'Never', 'Never', '100000', 'Nothing', 'Primary', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `hot100_id` int(10) unsigned NOT NULL,
  `question` text NOT NULL,
  `answer` text,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `description` text,
  `price` decimal(7,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `title`, `description`, `price`) VALUES
(1, '3 Day Trial Membership', 'Try Us Out Now!', NULL),
(2, 'Silver Membership', 'Basic Access to all the features', 49.00),
(3, 'Gold Membership', 'Advance access and priority listing', 99.00);

-- --------------------------------------------------------

--
-- Table structure for table `todays_girl`
--

CREATE TABLE `todays_girl` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `hot100_id` int(10) unsigned NOT NULL,
  `day` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `nickname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `country` varchar(50) NOT NULL DEFAULT 'United States of America',
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `zip` varchar(10) NOT NULL,
  `birthday` date NOT NULL,
  `type` int(11) NOT NULL,
  `password` varchar(100) NOT NULL,
  `token` varchar(100) NOT NULL,
  `hot_shot` int(11) unsigned NOT NULL,
  `picture` int(11) unsigned NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `expires` datetime NOT NULL,
  `online` tinyint(4) NOT NULL,
  `logout` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nickname` (`nickname`),
  UNIQUE KEY `email` (`email`),
  KEY `role_id` (`role_id`),
  KEY `picture` (`picture`),
  KEY `hot_shot` (`hot_shot`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `fname`, `lname`, `nickname`, `email`, `gender`, `country`, `city`, `state`, `zip`, `birthday`, `type`, `password`, `token`, `hot_shot`, `picture`, `created`, `updated`, `expires`, `online`, `logout`) VALUES
(1, 3, 'Admin', 'Admin', 'Admin', 'Admin@modelmates.com', 'Male', 'United States of America', 'San Francisco', 'CA', '12121', '2014-01-07', 1, '', '', 0, 0, '2014-01-07 00:00:00', '2014-01-07 00:00:00', '2015-12-31 00:00:00', 0, '0000-00-00 00:00:00'),
(7, 1, 'Cristian', 'Araya', 'cristian', 'cristian0789@gmail.com', 'male', 'United States of America', 'San Jose', 'CA', '12121', '1989-08-07', 1, '075a2b810b68af9e46b6ffee819cc6a7', '3deb02464e882ba877a2a612b724580b', 0, 0, '2013-11-25 22:34:44', '2013-11-25 22:34:44', '0000-00-00 00:00:00', 1, '2013-11-25 22:34:44'),
(8, 1, 'Matt', 'Miz', 'Matt', 'email@email.com', 'male', 'United States of America', 'Boca Raton', 'CA', '90230', '1976-01-22', 1, 'f0526a21ee508f182bc0fb1631634ef3', 'a539f36f4398ba1cf36eef45f7f46df1', 0, 0, '2013-12-16 10:56:14', '2013-12-16 10:56:14', '0000-00-00 00:00:00', 1, '2013-12-16 10:56:14'),
(9, 1, 'Cristian', 'Araya', 'cristian1', 'cristian0789@1gmail.com', 'male', 'United States of America', 'San Jose', 'CA', '12121', '1987-06-07', 1, '0192023a7bbd73250516f069df18b500', '6963555bf2182781c65f5588e7d76239', 0, 0, '2013-12-26 22:18:55', '2013-12-26 22:18:55', '0000-00-00 00:00:00', 1, '2013-12-26 22:18:55');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `object_id` int(10) unsigned NOT NULL,
  `object_type` varchar(10) NOT NULL,
  `file_id` int(10) unsigned NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `videos_of_day`
--

CREATE TABLE `videos_of_day` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `hot100_id` int(10) unsigned NOT NULL,
  `day` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `hot100_id` int(10) unsigned NOT NULL,
  `type` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `rank` decimal(3,1) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `files_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `listings`
--
ALTER TABLE `listings`
  ADD CONSTRAINT `listings_ibfk_1` FOREIGN KEY (`category`) REFERENCES `listing_categories` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION;

--
-- Constraints for table `pictures`
--
ALTER TABLE `pictures`
  ADD CONSTRAINT `pictures_ibfk_1` FOREIGN KEY (`file_id`) REFERENCES `files` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `profiles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
