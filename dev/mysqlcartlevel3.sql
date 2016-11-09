-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 06, 2016 at 10:19 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mysqlcartlevel3`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE IF NOT EXISTS `cart_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `quantity` double NOT NULL,
  `user_id` varchar(512) NOT NULL COMMENT 'can be a temporary id',
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=39 ;

--
-- Dumping data for table `cart_items`
--

INSERT INTO `cart_items` (`id`, `product_id`, `quantity`, `user_id`, `created`, `modified`) VALUES
(38, 12, 2, '4', '2016-07-07 04:08:42', '2016-07-06 20:14:20'),
(37, 16, 3, '4', '2016-07-07 04:08:40', '2016-07-06 20:14:20'),
(32, 12, 2, '37a1eaee93c11f53e3eaa8b253c480fd', '2016-07-06 22:24:24', '2016-07-06 14:24:24'),
(31, 16, 1, '37a1eaee93c11f53e3eaa8b253c480fd', '2016-07-06 22:24:21', '2016-07-06 14:24:21');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `description` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='categories of products' AUTO_INCREMENT=15 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created`, `modified`) VALUES
(1, 'Fashion', 'Explore fashion.', '2014-06-01 00:35:07', '2014-05-31 01:34:33'),
(2, 'Electronics', 'Save on the latest unlocked smartphones.', '2014-06-01 00:35:07', '2014-05-31 01:34:33'),
(3, 'Motors', 'Explore motors.', '2014-06-01 00:35:07', '2014-05-31 01:34:54'),
(4, 'Home & Garden', 'Explore home and outdoor decor.', '2015-03-18 01:48:52', '2015-03-17 17:48:52'),
(5, 'Collectibles & Art', 'The auction house experience, re-imagined.', '2015-03-18 01:49:29', '2015-03-17 17:49:29'),
(6, 'Toys & Hobbies', 'Explore toys and hobbies.', '2015-03-18 01:49:57', '2015-03-17 17:49:57'),
(7, 'Sporting Goods', 'Explore sporting goods.', '2015-03-18 01:50:38', '2015-03-17 17:50:38'),
(12, 'Deals & Gifts', 'Explore deals and gifts.', '2015-03-18 13:59:12', '2015-03-18 05:59:12');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'transaction id',
  `transaction_id` varchar(512) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_cost` decimal(19,2) NOT NULL,
  `status` int(11) NOT NULL COMMENT '0=pending,1=completed',
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='orders made by customers' AUTO_INCREMENT=20 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `transaction_id`, `user_id`, `total_cost`, `status`, `created`, `modified`) VALUES
(2, '550A9261311A5', 4, '168.00', 1, '2015-03-19 10:09:54', '2015-03-19 09:09:54'),
(3, '550B7A36B0AA6', 4, '1005.00', 0, '2015-03-20 02:39:03', '2015-03-20 01:39:03'),
(4, '550BE6406535B', 4, '370.00', 0, '2015-03-20 10:20:01', '2015-03-20 09:20:01'),
(5, '5510D7DEEC5F7', 4, '51.00', 1, '2015-03-24 04:19:59', '2015-03-24 03:19:59'),
(6, '55110D902E688', 14, '228.00', 1, '2015-03-24 08:09:04', '2015-03-24 07:09:04'),
(8, '5513186984E41', 4, '300.00', 0, '2015-03-26 04:19:53', '2015-03-25 20:19:53'),
(9, '55131956B657F', 14, '520.00', 0, '2015-03-26 04:23:50', '2015-03-25 20:23:50'),
(10, '55137CD0EE994', 15, '994.00', 0, '2015-03-26 11:28:17', '2015-03-26 03:28:17'),
(11, '5745DF7CA5467', 4, '454.00', 0, '2016-05-26 01:23:08', '2016-05-25 17:23:08'),
(12, '5745E0454515D', 20, '242.00', 0, '2016-05-26 01:26:29', '2016-05-25 17:26:29'),
(13, '5746732616103', 4, '340.00', 0, '2016-05-26 11:53:10', '2016-05-26 03:53:10'),
(14, '5746755662EC4', 4, '631.00', 0, '2016-05-26 12:02:30', '2016-05-26 04:02:30'),
(15, '574677D6C02E7', 4, '590.00', 0, '2016-05-26 12:13:10', '2016-05-26 04:13:10'),
(16, '574681E65A002', 4, '673.00', 0, '2016-05-26 12:56:06', '2016-05-26 04:56:06'),
(17, '5746A732C127D', 4, '946.00', 1, '2016-05-26 15:35:14', '2016-05-26 07:35:14'),
(18, '57594D5BCD4D4', 4, '571.00', 0, '2016-06-09 19:04:59', '2016-06-09 11:04:59'),
(19, '57594E01AECE9', 4, '540.00', 0, '2016-06-09 19:07:45', '2016-06-09 11:07:45');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE IF NOT EXISTS `order_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transaction_id` varchar(512) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` decimal(19,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='products under an order or transaction' AUTO_INCREMENT=36 ;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `transaction_id`, `product_id`, `price`, `quantity`, `created`, `modified`) VALUES
(2, '550A9261311A5', 16, '17.00', 3, '2015-03-19 10:09:53', '2015-03-19 09:09:53'),
(3, '550A9261311A5', 14, '39.00', 3, '2015-03-19 10:09:54', '2015-03-19 09:09:54'),
(4, '550B7A36B0AA6', 16, '17.00', 2, '2015-03-20 02:39:02', '2015-03-20 01:39:02'),
(5, '550B7A36B0AA6', 12, '179.00', 4, '2015-03-20 02:39:02', '2015-03-20 01:39:02'),
(6, '550B7A36B0AA6', 4, '85.00', 3, '2015-03-20 02:39:02', '2015-03-20 01:39:02'),
(7, '550BE6406535B', 4, '85.00', 2, '2015-03-20 10:20:00', '2015-03-20 09:20:00'),
(8, '550BE6406535B', 15, '50.00', 4, '2015-03-20 10:20:01', '2015-03-20 09:20:01'),
(9, '5510D7DEEC5F7', 16, '17.00', 3, '2015-03-24 04:19:58', '2015-03-24 03:19:58'),
(10, '55110D902E688', 9, '78.00', 1, '2015-03-24 08:09:04', '2015-03-24 07:09:04'),
(11, '55110D902E688', 15, '50.00', 3, '2015-03-24 08:09:04', '2015-03-24 07:09:04'),
(13, '5513186984E41', 15, '50.00', 6, '2015-03-26 04:19:53', '2015-03-25 20:19:53'),
(14, '55131956B657F', 13, '140.00', 3, '2015-03-26 04:23:50', '2015-03-25 20:23:50'),
(15, '55131956B657F', 15, '50.00', 2, '2015-03-26 04:23:50', '2015-03-25 20:23:50'),
(16, '55137CD0EE994', 2, '229.00', 4, '2015-03-26 11:28:16', '2015-03-26 03:28:16'),
(17, '55137CD0EE994', 9, '78.00', 1, '2015-03-26 11:28:17', '2015-03-26 03:28:17'),
(18, '5745DF7CA5467', 17, '34.00', 1, '2016-05-26 01:23:08', '2016-05-25 17:23:08'),
(19, '5745DF7CA5467', 13, '140.00', 3, '2016-05-26 01:23:08', '2016-05-25 17:23:08'),
(20, '5745E0454515D', 17, '34.00', 3, '2016-05-26 01:26:29', '2016-05-25 17:26:29'),
(21, '5745E0454515D', 13, '140.00', 1, '2016-05-26 01:26:29', '2016-05-25 17:26:29'),
(22, '5746732616103', 10, '50.00', 4, '2016-05-26 11:53:10', '2016-05-26 03:53:10'),
(23, '5746732616103', 13, '140.00', 1, '2016-05-26 11:53:10', '2016-05-26 03:53:10'),
(24, '5746755662EC4', 11, '103.00', 2, '2016-05-26 12:02:30', '2016-05-26 04:02:30'),
(25, '5746755662EC4', 4, '85.00', 5, '2016-05-26 12:02:30', '2016-05-26 04:02:30'),
(26, '574677D6C02E7', 17, '34.00', 5, '2016-05-26 12:13:10', '2016-05-26 04:13:10'),
(27, '574677D6C02E7', 13, '140.00', 3, '2016-05-26 12:13:10', '2016-05-26 04:13:10'),
(28, '574681E65A002', 17, '34.00', 4, '2016-05-26 12:56:06', '2016-05-26 04:56:06'),
(29, '574681E65A002', 12, '179.00', 3, '2016-05-26 12:56:06', '2016-05-26 04:56:06'),
(30, '5746A732C127D', 16, '17.00', 3, '2016-05-26 15:35:14', '2016-05-26 07:35:14'),
(31, '5746A732C127D', 12, '179.00', 5, '2016-05-26 15:35:14', '2016-05-26 07:35:14'),
(32, '57594D5BCD4D4', 12, '179.00', 3, '2016-06-09 19:04:59', '2016-06-09 11:04:59'),
(33, '57594D5BCD4D4', 16, '17.00', 2, '2016-06-09 19:04:59', '2016-06-09 11:04:59'),
(34, '57594E01AECE9', 4, '85.00', 4, '2016-06-09 19:07:45', '2016-06-09 11:07:45'),
(35, '57594E01AECE9', 3, '100.00', 2, '2016-06-09 19:07:45', '2016-06-09 11:07:45');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(512) NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `active_until` datetime NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='products that can be added to cart' AUTO_INCREMENT=20 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `category_id`, `active_until`, `created`, `modified`) VALUES
(1, '1968 Ferrari Other 250 GTO', '1962 Ferrari GTO Coupe built by Rod Tempero Motor Body Builder New Zealand 250 GTO Ferrari', 1200000, 3, '2019-09-15 00:00:00', '2015-03-18 18:05:15', '2015-03-18 10:05:15'),
(2, 'Carly Romper', '<ul><li><span style="font-size: 1em;">Printed</span></li><li><span style="font-size: 1em;">100% Silk</span></li><li><span style="font-size: 1em;">Dry Clean Only</span></li><li><span style="font-size: 1em;">Unlined</span></li><li><span style="font-size: 1em;">3.5" inseam</span></li><li><span style="font-size: 1em;">Model is 5''10"&nbsp;</span></li><li><span style="font-size: 1em;">Wearing a size Small</span></li></ul>', 229, 1, '2019-09-15 00:00:00', '2015-03-18 23:42:04', '2015-03-18 15:42:04'),
(3, 'Abercrombie & Fitch Men Moose Logo Mesh Polo Shirt', '<ol><li><span style="font-size: 1em;">Brand: Abercrombie &amp; Fitch</span></li><li><span style="font-size: 1em;">Muscle fit</span></li><li><span style="font-size: 1em;">Composition:100% cotton,exclusive of decoration</span></li><li><span style="font-size: 1em;">Made in Vietnam.</span></li></ol>', 100, 1, '2019-09-15 00:00:00', '2015-03-18 23:59:07', '2015-03-18 15:59:07'),
(4, 'Polo Ralph Lauren Men''s Faxon Low Sneaker', 'Polo Ralph Lauren puts its distinctive stamp on a minimalist sneaker with the Faxon. The sleek canvas upper follows a classic retro shape, but the addition of rawhide laces and an embroidered logo detail lend fresh updates.', 85, 1, '2019-09-15 00:00:00', '2015-03-19 00:04:03', '2015-03-18 16:04:03'),
(5, 'U.S. Polo Assn. Men''s Slim Fit Cotton Slub Solid Polo', 'Two button contrast color front placket. Small pony embroidered on left chest. Vent at hem has contrast color taping; back longer than front. Slim fit.', 22, 1, '2019-09-15 00:00:00', '2015-03-19 00:08:03', '2015-03-18 16:08:03'),
(6, 'Seafolly Women''s Vintage Vacation Boyleg One Piece Swimsuit Maillot', '<ul><li><span style="font-size: 1em;">87% Nylon/13% Elastane</span></li><li><span style="font-size: 1em;">Imported</span></li><li><span style="font-size: 1em;">Hand Wash</span></li><li><span style="font-size: 1em;">Vintage inspired boy leg maillot</span></li><li><span style="font-size: 1em;">Ruched front pane</span></li></ul>', 172, 1, '2019-09-15 00:00:00', '2015-03-19 09:02:16', '2015-03-19 01:02:16'),
(7, 'Seafolly Women''s Goddess Boy-Leg One-Piece Swimsuit', '<ol><li><span style="font-size: 1em;">93% Nylon/7%&nbsp;</span><span style="font-size: 1em;">Elastane&nbsp;</span></li><li><span style="font-size: 1em;">Imported&nbsp;</span></li><li><span style="font-size: 1em;">Tie closure&nbsp;</span></li><li><span style="font-size: 1em;">Hand Wash&nbsp;</span></li><li><span style="font-size: 1em;">Vintage-inspired one-piece swimsuit featuring halter-neck tie and ruched front panel</span></li></ol>', 143, 1, '2019-09-15 00:00:00', '2015-03-19 09:06:53', '2015-03-19 01:06:53'),
(8, 'BCBGMax Azria Women''s Miryam Sleeveless Color-Block Dress', 'A minimal, color blocked shirtdress with a fitted dress is a necessity for any daytime event.', 228, 1, '2019-09-15 00:00:00', '2015-03-19 09:18:06', '2015-03-19 01:18:06'),
(9, 'JULIAN JORDANOV, Ex Libris', '<ol><li><span style="font-size: 1em;">LIMITED EDITION 6/20, 2004.&nbsp;</span></li><li><span style="font-size: 1em;">Scarce as Limited Edition.</span></li><li><span style="font-size: 1em;">Limited edition No:  6/20        Technique:&nbsp;</span></li><li><span style="font-size: 1em;">&nbsp;C3  C5\r\nImage size: 117 x 55 mm â€“ Card size:198 x 136 mm!</span></li></ol>', 78, 5, '2019-09-15 00:00:00', '2015-03-19 15:38:09', '2015-03-19 07:38:09'),
(10, 'Hamilton Beach 46201 12 Cup Digital Coffeemaker, Stainless Steel', 'The Hamilton Beach 12-Cup Digital Coffeemaker has an easy-access design for fast and easy filling so you can enjoy the perfect cup of coffee in the morning. The digital coffee maker features adjustable brewing with bold, regular and number of cup options.&nbsp;<br><p>The adjustable keep warm function ensures that you will never get a cold cup of coffee. </p>', 50, 12, '2019-09-15 00:00:00', '2015-03-19 15:44:02', '2015-03-19 07:44:02'),
(11, 'LG Electronics TONE INFINIM Bluetooth Stereo Headset - Retail Packaging - Silver', 'LG TONE INFINIM provides cutting edge design, convenient technology, and a high level of performance and reliability in a mobile device.', 103, 2, '2019-09-15 00:00:00', '2015-03-19 15:59:14', '2015-03-19 07:59:14'),
(12, 'Nexus 7 from Google', '<ul><li><span style="font-size: 1em;">7-Inch</span></li><li><span style="font-size: 1em;">16 GB</span></li><li><span style="font-size: 1em;">Black by ASUS Tablet</span></li></ul>', 179, 2, '2019-09-15 00:00:00', '2015-03-19 16:38:43', '2015-03-19 08:38:43'),
(13, 'Samsung Galaxy Tab 4 (7-Inch, White)', '<ul><li><span style="font-size: 1em;">Android 4.4 Kit Kat OS,&nbsp;</span></li><li><span style="font-size: 1em;">1.2 GHz quad-core processor&nbsp;</span></li><li><span style="font-size: 1em;">8 GB Flash Memory,&nbsp;</span></li><li><span style="font-size: 1em;">1.5 GB RAM Memory&nbsp;</span></li><li><span style="font-size: 1em;">WXGA Display (1280x800 Resolution)&nbsp;</span></li><li><span style="font-size: 1em;">32GB of memory available through a microSD slot</span></li><li><span style="font-size: 1em;">50GB of free Dropbox storage&nbsp;</span></li><li><span style="font-size: 1em;">Comes with over $300 of free content and services</span></li></ul>', 140, 2, '2019-09-15 00:00:00', '2015-03-19 16:41:31', '2015-03-19 08:41:31'),
(14, 'Gardman R687 4-Tier Mini Greenhouse', '<ul><li><span style="font-size: 1em;">Small greenhouse with 4 shelves for deck, patio, or balcony</span></li><li><span style="font-size: 1em;">Ideal for seed propagation and plant growing and display</span></li><li><span style="font-size: 1em;">Sturdy shelves for pots and seed trays; plastic cover with full length roll up zipper&nbsp;</span></li><li><span style="font-size: 1em;">Dimensions when built: 62 by 27 by 19 inches (h x l x w);&nbsp;</span><span style="font-size: 1em;">each tier is 12-1/2 inches high</span></li></ul>', 39, 4, '2019-09-15 00:00:00', '2015-03-19 16:45:42', '2015-03-19 08:45:42'),
(15, 'Spalding NBA Street Basketball', '<span style="font-size: 1em;">Ultra-durable,&nbsp;</span><span style="font-size: 1em;">performance rubber cover.&nbsp;</span><span style="font-size: 1em;">Designed to withstand the rough-and-tumble street game.&nbsp;</span><span style="font-size: 1em;">Wide channel design for excellent grip.&nbsp;</span><span style="font-size: 1em;">Features the NBA logo.</span>', 50, 7, '2019-09-15 00:00:00', '2015-03-19 16:48:34', '2015-03-19 08:48:34'),
(16, 'Bandai Hobby Thousand Sunny Model Ship "One Piece"', '<ul><li><span style="font-size: 1em;">Snap together no glue required</span></li><li><span style="font-size: 1em;">Colored plastic</span></li><li><span style="font-size: 1em;">no paint required&nbsp;</span></li><li><span style="font-size: 1em;">Runner x4</span></li><li><span style="font-size: 1em;">marking sticker x1</span></li><li><span style="font-size: 1em;">color sticker x1</span></li><li><span style="font-size: 1em;">instruction manual</span></li></ul>', 17, 6, '2019-09-15 00:00:00', '2015-03-19 17:02:25', '2015-03-19 09:02:25'),
(17, 'Bandai Tamashii Nations Nami (New World Ver.) "One Piece"', 'Beautifully sculpted\r\nAnime Acurate Coloring\r\nSpecial Display Stand', 34, 6, '2019-09-15 00:00:00', '2015-03-19 17:07:20', '2015-03-19 09:07:20');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE IF NOT EXISTS `product_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `name` varchar(512) NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='image files related to a product' AUTO_INCREMENT=69 ;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `name`, `created`, `modified`) VALUES
(8, 1, '1968-ferrari-other-250-gto-2.jpg', '0000-00-00 00:00:00', '2015-03-18 10:07:37'),
(7, 1, '1968-ferrari-other-250-gto-1.jpg', '0000-00-00 00:00:00', '2015-03-18 10:07:37'),
(9, 1, '1968-ferrari-other-250-gto-3.jpg', '0000-00-00 00:00:00', '2015-03-18 10:07:37'),
(10, 1, '1968-ferrari-other-250-gto-4.jpg', '0000-00-00 00:00:00', '2015-03-18 10:07:37'),
(11, 1, '1968-ferrari-other-250-gto-5.jpg', '0000-00-00 00:00:00', '2015-03-18 10:07:37'),
(12, 1, '1968-ferrari-other-250-gto-6.jpg', '0000-00-00 00:00:00', '2015-03-18 10:07:37'),
(13, 2, 'carly-romper-1.jpg', '0000-00-00 00:00:00', '2015-03-18 15:46:04'),
(14, 2, 'carly-romper-2.jpg', '0000-00-00 00:00:00', '2015-03-18 15:46:04'),
(15, 2, 'carly-romper-3.jpg', '0000-00-00 00:00:00', '2015-03-18 15:46:04'),
(16, 2, 'carly-romper-4.jpg', '0000-00-00 00:00:00', '2015-03-18 15:46:04'),
(17, 3, 'abercrombie-fitch-men-moose-logo-mesh-polo-shirt-1.jpg', '0000-00-00 00:00:00', '2015-03-18 15:59:07'),
(18, 3, 'abercrombie-fitch-men-moose-logo-mesh-polo-shirt-2.jpg', '0000-00-00 00:00:00', '2015-03-18 15:59:07'),
(19, 3, 'abercrombie-fitch-men-moose-logo-mesh-polo-shirt-3.jpg', '0000-00-00 00:00:00', '2015-03-18 15:59:07'),
(20, 4, 'polo-ralph-lauren-mens-faxon-low-sneaker-1.jpg', '0000-00-00 00:00:00', '2015-03-18 16:04:03'),
(21, 4, 'polo-ralph-lauren-mens-faxon-low-sneaker-2.jpg', '0000-00-00 00:00:00', '2015-03-18 16:04:03'),
(22, 4, 'polo-ralph-lauren-mens-faxon-low-sneaker-3.jpg', '0000-00-00 00:00:00', '2015-03-18 16:04:03'),
(23, 5, 'us-polo-assn-mens-slim-fit-cotton-slub-solid-polo-1.jpg', '0000-00-00 00:00:00', '2015-03-18 16:08:03'),
(24, 5, 'us-polo-assn-mens-slim-fit-cotton-slub-solid-polo-2.jpg', '0000-00-00 00:00:00', '2015-03-18 16:08:03'),
(25, 6, 'seafolly-womens-vintage-vacation-boyleg-one-piece-swimsuit-maillot-1.jpg', '0000-00-00 00:00:00', '2015-03-19 01:02:16'),
(26, 6, 'seafolly-womens-vintage-vacation-boyleg-one-piece-swimsuit-maillot-2.jpg', '0000-00-00 00:00:00', '2015-03-19 01:02:16'),
(46, 12, 'nexus-7-from-google-3.jpg', '0000-00-00 00:00:00', '2015-03-19 08:38:43'),
(44, 12, 'nexus-7-from-google-1.jpg', '0000-00-00 00:00:00', '2015-03-19 08:38:43'),
(45, 12, 'nexus-7-from-google-2.jpg', '0000-00-00 00:00:00', '2015-03-19 08:38:43'),
(29, 8, 'bcbgmax-azria-womens-miryam-sleeveless-color-block-dress-1.jpg', '0000-00-00 00:00:00', '2015-03-19 01:18:06'),
(30, 8, 'bcbgmax-azria-womens-miryam-sleeveless-color-block-dress-2.jpg', '0000-00-00 00:00:00', '2015-03-19 01:18:06'),
(31, 9, 'julian-jordanov-ex-libris-don-quihote-1.jpg', '0000-00-00 00:00:00', '2015-03-19 07:38:09'),
(32, 9, 'julian-jordanov-ex-libris-don-quihote-2.jpg', '0000-00-00 00:00:00', '2015-03-19 07:38:09'),
(33, 10, 'hamilton-beach-46201-12-cup-digital-coffeemaker-stainless-steel-1.jpg', '0000-00-00 00:00:00', '2015-03-19 07:44:02'),
(34, 10, 'hamilton-beach-46201-12-cup-digital-coffeemaker-stainless-steel-2.jpg', '0000-00-00 00:00:00', '2015-03-19 07:44:02'),
(35, 10, 'hamilton-beach-46201-12-cup-digital-coffeemaker-stainless-steel-3.jpg', '0000-00-00 00:00:00', '2015-03-19 07:44:02'),
(36, 10, 'hamilton-beach-46201-12-cup-digital-coffeemaker-stainless-steel-4.jpg', '0000-00-00 00:00:00', '2015-03-19 07:44:02'),
(37, 10, 'hamilton-beach-46201-12-cup-digital-coffeemaker-stainless-steel-5.jpg', '0000-00-00 00:00:00', '2015-03-19 07:44:02'),
(38, 11, 'lg-electronics-tone-infinim-bluetooth-stereo-headset-retail-packaging-silver-1.jpg', '0000-00-00 00:00:00', '2015-03-19 07:59:14'),
(39, 11, 'lg-electronics-tone-infinim-bluetooth-stereo-headset-retail-packaging-silver-2.jpg', '0000-00-00 00:00:00', '2015-03-19 07:59:14'),
(40, 11, 'lg-electronics-tone-infinim-bluetooth-stereo-headset-retail-packaging-silver-3.jpg', '0000-00-00 00:00:00', '2015-03-19 07:59:14'),
(41, 11, 'lg-electronics-tone-infinim-bluetooth-stereo-headset-retail-packaging-silver-4.jpg', '0000-00-00 00:00:00', '2015-03-19 07:59:14'),
(42, 7, 'seafolly-womens-goddess-boy-leg-one-piece-swimsuit-1.jpg', '0000-00-00 00:00:00', '2015-03-19 08:18:25'),
(43, 7, 'seafolly-womens-goddess-boy-leg-one-piece-swimsuit-2.jpg', '0000-00-00 00:00:00', '2015-03-19 08:18:25'),
(47, 13, 'samsung-galaxy-tab-4-7-inch-white-1.jpg', '0000-00-00 00:00:00', '2015-03-19 08:41:31'),
(48, 13, 'samsung-galaxy-tab-4-7-inch-white-2.jpg', '0000-00-00 00:00:00', '2015-03-19 08:41:31'),
(49, 13, 'samsung-galaxy-tab-4-7-inch-white-3.jpg', '0000-00-00 00:00:00', '2015-03-19 08:41:31'),
(50, 13, 'samsung-galaxy-tab-4-7-inch-white-4.jpg', '0000-00-00 00:00:00', '2015-03-19 08:41:31'),
(51, 14, 'gardman-r687-4-tier-mini-greenhouse-1.jpg', '0000-00-00 00:00:00', '2015-03-19 08:45:42'),
(52, 14, 'gardman-r687-4-tier-mini-greenhouse-2.jpg', '0000-00-00 00:00:00', '2015-03-19 08:45:42'),
(53, 15, 'spalding-nba-street-basketball-1.jpg', '0000-00-00 00:00:00', '2015-03-19 08:48:34'),
(54, 16, 'bandai-hobby-thousand-sunny-model-ship-one-piece-grand-ship-collection-1.jpg', '0000-00-00 00:00:00', '2015-03-19 09:02:25'),
(55, 16, 'bandai-hobby-thousand-sunny-model-ship-one-piece-grand-ship-collection-2.jpg', '0000-00-00 00:00:00', '2015-03-19 09:02:25'),
(56, 16, 'bandai-hobby-thousand-sunny-model-ship-one-piece-grand-ship-collection-3.jpg', '0000-00-00 00:00:00', '2015-03-19 09:02:25'),
(57, 16, 'bandai-hobby-thousand-sunny-model-ship-one-piece-grand-ship-collection-4.jpg', '0000-00-00 00:00:00', '2015-03-19 09:02:25'),
(58, 17, 'bandai-tamashii-nations-nami-new-world-ver-one-piece-figuartszero-bandai-tamashii-nations-3.jpg', '0000-00-00 00:00:00', '2016-05-25 19:33:38'),
(59, 17, 'bandai-tamashii-nations-nami-new-world-ver-one-piece-figuartszero-bandai-tamashii-nations-2.jpg', '0000-00-00 00:00:00', '2015-03-19 09:07:20'),
(60, 17, 'bandai-tamashii-nations-nami-new-world-ver-one-piece-figuartszero-bandai-tamashii-nations-1.jpg', '0000-00-00 00:00:00', '2016-05-25 19:33:13'),
(61, 17, 'bandai-tamashii-nations-nami-new-world-ver-one-piece-figuartszero-bandai-tamashii-nations-4.jpg', '0000-00-00 00:00:00', '2015-03-19 09:07:20'),
(62, 17, 'bandai-tamashii-nations-nami-new-world-ver-one-piece-figuartszero-bandai-tamashii-nations-5.jpg', '0000-00-00 00:00:00', '2015-03-19 09:07:20'),
(67, 19, 'products.jpg', '0000-00-00 00:00:00', '2015-03-26 03:29:34');

-- --------------------------------------------------------

--
-- Table structure for table `product_pdfs`
--

CREATE TABLE IF NOT EXISTS `product_pdfs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `name` varchar(512) NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='PDF files related to a product' AUTO_INCREMENT=4 ;

--
-- Dumping data for table `product_pdfs`
--

INSERT INTO `product_pdfs` (`id`, `product_id`, `name`, `created`, `modified`) VALUES
(1, 1, 'report.pdf', '0000-00-00 00:00:00', '2015-03-18 10:09:56'),
(2, 1, 'sample.pdf', '0000-00-00 00:00:00', '2015-03-18 10:09:56');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL,
  `email` varchar(64) NOT NULL,
  `contact_number` varchar(64) NOT NULL,
  `address` text NOT NULL,
  `password` varchar(512) NOT NULL,
  `access_level` varchar(16) NOT NULL,
  `access_code` text NOT NULL,
  `status` int(11) NOT NULL COMMENT '0=pending,1=confirmed',
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='admin and customer users' AUTO_INCREMENT=22 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `contact_number`, `address`, `password`, `access_level`, `access_code`, `status`, `created`, `modified`) VALUES
(1, 'Mike', 'Dalisay', 'mike@example.com', '0999999999', 'Blk. 24 A, Lot 6, Ph. 3, Peace Village', '$2y$10$t0MB15RaS2Uao7BFmR20we0zHw.huxdqq109TEZGk6oHvrLx1fcPu', 'Admin', '', 1, '0000-00-00 00:00:00', '2016-05-25 17:08:44'),
(2, 'Lauro', 'Abogne', 'lauro@eacomm.com', '08888888', 'Pasig City', '$2y$10$it4i11kRKrB19FfpPRWsRO5qtgrgajL7NnxOq180MsIhCKhAmSdDa', 'Customer', '', 1, '0000-00-00 00:00:00', '2015-03-24 07:00:21'),
(4, 'Darwin', 'Potter', 'darwin@example.com', '09194444444', 'Blk. 24 A, Lot 6, Ph. 3, Peace Village, Antipolo City, Rizal.', '$2y$10$YKRguYCRUX88UmdCmbmVOeDUWslSK3jWTEk5jx..6KHAK27wzQWHO', 'Customer', 'ILXFBdMAbHVrJswNDnm231cziO8FZomn', 1, '2014-10-29 17:31:09', '2016-05-25 17:22:27'),
(7, 'Marisol Jane', 'Dalisay', 'mariz@gmail.com', '09998765432', 'Blk. 24 A, Lot 6, Ph. 3, Peace Village', 'mariz', 'Customer', '', 1, '2015-02-25 09:35:52', '2015-03-24 07:00:21'),
(9, 'Marykris', 'De Leon', 'marykrisdarell.deleon@gmail.com', '09194444444', 'Project 4, QC', '$2y$10$uUy7D5qmvaRYttLCx9wnU.WOD3/8URgOX7OBXHPpWyTDjU4ZteSEm', 'Customer', '', 1, '2015-02-27 14:28:46', '2015-03-24 06:51:03'),
(10, 'Merlin', 'Duckerberg', 'merlin@gmail.com', '09991112333', 'Project 2, Quezon City', '$2y$10$VHY58eALB1QyYsP71RHD1ewmVxZZp.wLuhejyQrufvdy041arx1Kq', 'Admin', '', 1, '2015-03-18 06:45:28', '2015-03-24 07:00:21'),
(14, 'Charlon', 'Ignacio', 'charlon@gmail.com', '09876543345', 'Tandang Sora, QC', '$2y$10$Fj6O1tPYI6UZRzJ9BNfFJuhURN9DnK5fQGHEsfol5LXRu.tCYYggu', 'Customer', '', 1, '2015-03-24 08:06:57', '2015-03-24 07:48:00'),
(15, 'Kobe Bro', 'Bryant', 'kobe@gmail.com', '09898787674', 'Los Angeles, California', '$2y$10$fmanyjJxNfJ8O3p9jjUixu6EOHkGZrThtcd..TeNz2g.XZyCIuVpm', 'Customer', '', 1, '2015-03-26 11:28:01', '2015-03-26 03:39:52'),
(20, 'Tim', 'Duncan', 'tim@example.com', '9999999', 'San Antonio, Texas, USA', '$2y$10$9OSKHLhiDdBkJTmd3VLnQeNPCtyH1IvZmcHrz4khBMHdxc8PLX5G6', 'Customer', '0X4JwsRmdif8UyyIHSOUjhZz9tva3Czj', 1, '2016-05-26 01:25:59', '2016-05-25 17:25:59'),
(21, 'Tony', 'Parker', 'tony@example.com', '8888888', 'Blk 24 A Lot 6 Ph 3\r\nPeace Village, San Luis', '$2y$10$lBJfvLyl/X5PieaztTYADOxOQeZJCqETayF.O9ld17z3hcKSJwZae', 'Customer', 'THM3xkZzXeza5ISoTyPKl6oLpVa88tYl', 1, '2016-05-26 01:29:01', '2016-05-25 17:29:01');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
