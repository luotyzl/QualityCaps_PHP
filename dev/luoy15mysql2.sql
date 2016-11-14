-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2016-11-14 12:37:51
-- 服务器版本： 5.7.9-log
-- PHP Version: 5.6.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `luoy15mysql2`
--

-- --------------------------------------------------------

--
-- 表的结构 `cart_items`
--

CREATE TABLE `cart_items` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` double NOT NULL,
  `user_id` varchar(512) NOT NULL COMMENT 'can be a temporary id',
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `cart_items`
--

INSERT INTO `cart_items` (`id`, `product_id`, `quantity`, `user_id`, `created`, `modified`) VALUES
(38, 12, 2, '4', '2016-07-07 04:08:42', '2016-07-06 20:14:20'),
(37, 16, 3, '4', '2016-07-07 04:08:40', '2016-07-06 20:14:20'),
(32, 12, 2, '37a1eaee93c11f53e3eaa8b253c480fd', '2016-07-06 22:24:24', '2016-07-06 14:24:24'),
(31, 16, 1, '37a1eaee93c11f53e3eaa8b253c480fd', '2016-07-06 22:24:21', '2016-07-06 14:24:21');

-- --------------------------------------------------------

--
-- 表的结构 `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `description` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='categories of products';

--
-- 转存表中的数据 `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created`, `modified`) VALUES
(1, 'Men''s', 'Explore fashion.', '2014-06-01 00:35:07', '2014-05-31 01:34:33'),
(16, 'Women''s', '', '2016-11-10 19:37:03', '2016-11-10 11:37:03'),
(17, 'Children''s', '', '2016-11-10 19:37:09', '2016-11-10 11:37:09');

-- --------------------------------------------------------

--
-- 表的结构 `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL COMMENT 'transaction id',
  `transaction_id` varchar(512) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_cost` decimal(19,2) NOT NULL,
  `status` int(11) NOT NULL COMMENT '0=waiting,1=shipped',
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='orders made by customers';

--
-- 转存表中的数据 `orders`
--

INSERT INTO `orders` (`id`, `transaction_id`, `user_id`, `total_cost`, `status`, `created`, `modified`) VALUES
(2, '550A9261311A5', 4, '168.00', 1, '2015-03-19 10:09:54', '2015-03-19 09:09:54'),
(3, '550B7A36B0AA6', 4, '1005.00', 1, '2015-03-20 02:39:03', '2015-03-20 01:39:03'),
(4, '5824FC38E0C1C', 22, '80.00', 0, '2016-11-11 07:01:12', '2016-11-10 23:01:12'),
(5, '5824FF00CC094', 22, '36.80', 1, '2016-11-11 07:13:04', '2016-11-10 23:13:04'),
(6, '5826CDD5A59ED', 29, '23.00', 0, '2016-11-12 16:07:49', '2016-11-12 08:07:49'),
(7, '5826CE80A427E', 22, '144.90', 1, '2016-11-12 16:10:40', '2016-11-12 08:10:40'),
(8, '5827A8AF896FF', 22, '358.80', 0, '2016-11-13 07:41:35', '2016-11-12 23:41:35');

-- --------------------------------------------------------

--
-- 表的结构 `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `transaction_id` varchar(512) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` decimal(19,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='products under an order or transaction';

--
-- 转存表中的数据 `order_items`
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
(35, '57594E01AECE9', 3, '100.00', 2, '2016-06-09 19:07:45', '2016-06-09 11:07:45'),
(36, '5824FC38E0C1C', 21, '16.00', 1, '2016-11-11 07:01:12', '2016-11-10 23:01:12'),
(37, '5824FC38E0C1C', 24, '16.00', 3, '2016-11-11 07:01:12', '2016-11-10 23:01:12'),
(38, '5824FC38E0C1C', 27, '16.00', 1, '2016-11-11 07:01:12', '2016-11-10 23:01:12'),
(39, '5824FF00CC094', 21, '16.00', 2, '2016-11-11 07:13:04', '2016-11-10 23:13:04'),
(40, '5826CDD5A59ED', 28, '20.00', 1, '2016-11-12 16:07:49', '2016-11-12 08:07:49'),
(41, '5826CE80A427E', 29, '100.00', 1, '2016-11-12 16:10:40', '2016-11-12 08:10:40'),
(42, '5826CE80A427E', 28, '20.00', 1, '2016-11-12 16:10:40', '2016-11-12 08:10:40'),
(43, '5826CE80A427E', 30, '6.00', 1, '2016-11-12 16:10:40', '2016-11-12 08:10:40'),
(44, '5827A8AF896FF', 28, '20.00', 12, '2016-11-13 07:41:35', '2016-11-12 23:41:35'),
(45, '5827A8AF896FF', 30, '6.00', 12, '2016-11-13 07:41:35', '2016-11-12 23:41:35');

-- --------------------------------------------------------

--
-- 表的结构 `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(512) NOT NULL,
  `price` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='products that can be added to cart';

--
-- 转存表中的数据 `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `category_id`, `supplier_id`) VALUES
(29, 'B cap', 100, 1, 3),
(28, 'dddap', 20, 17, 3),
(30, 'z cap', 6, 16, 1);

-- --------------------------------------------------------

--
-- 表的结构 `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` varchar(512) NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='image files related to a product';

--
-- 转存表中的数据 `product_images`
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
(67, 19, 'products.jpg', '0000-00-00 00:00:00', '2015-03-26 03:29:34'),
(69, 20, '538ac321c5906213.jpg!600x600.jpg', '2016-11-10 09:13:43', '2016-11-10 01:13:43'),
(70, 21, '538ac321c5906213.jpg!600x600.jpg', '2016-11-10 09:14:33', '2016-11-10 01:14:33'),
(71, 22, '538ac321c5906213.jpg!600x600.jpg', '2016-11-10 09:16:46', '2016-11-10 01:16:46'),
(72, 23, '538ac321c5906213.jpg!600x600.jpg', '2016-11-10 09:33:30', '2016-11-10 01:33:30'),
(73, 24, '538ac321c5906213.jpg!600x600.jpg', '2016-11-10 09:33:54', '2016-11-10 01:33:54'),
(74, 26, '538ac321c5906213.jpg!600x600.jpg', '2016-11-10 19:37:53', '2016-11-10 11:37:53'),
(75, 27, '538ac321c5906213.jpg!600x600.jpg', '2016-11-11 05:47:49', '2016-11-10 21:47:49'),
(76, 28, 'banner4.png', '2016-11-12 15:46:46', '2016-11-12 07:46:46'),
(77, 29, 'banner2.jpg', '2016-11-12 16:09:36', '2016-11-12 08:09:36'),
(78, 30, 'banner2.jpg', '2016-11-12 16:10:04', '2016-11-12 08:10:04');

-- --------------------------------------------------------

--
-- 表的结构 `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `phone` varchar(32) NOT NULL,
  `email` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `phone`, `email`) VALUES
(1, 'thomas', '12345678', 'luotyzl@gmail.com'),
(3, 'raymon', '8907166', 'luotyzl@gmail.com');

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `email` varchar(64) NOT NULL,
  `contact_number` varchar(64) NOT NULL,
  `address` text NOT NULL,
  `password` varchar(512) NOT NULL,
  `access_level` varchar(16) NOT NULL,
  `access_code` text NOT NULL,
  `status` int(11) NOT NULL COMMENT '0=disable,1=able',
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='admin and customer users';

--
-- 转存表中的数据 `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `contact_number`, `address`, `password`, `access_level`, `access_code`, `status`, `created`, `modified`) VALUES
(23, 'luotyzl', 'luo.ys@126.com', '12345678', '73 adsasd', '$2y$10$qeWPYsTl85COjBzJKq2tfe5F0b.KJIuclsAHffoQqKF9KN0jIxVDm', 'Customer', 'wETEGKswEKgHxy8M9SYWyEEKuYi8YFBy', 1, '2016-11-10 10:50:26', '2016-11-13 23:11:32'),
(22, 'admin', 'luotyzl@gmail.com', '2040582296', '72 woodward rd', '$2y$10$gnJJtHD98HQK//u7vgY5q.nUUIeb/wv0DQCV1IzSzTy3MF3Tk0P6W', 'Admin', 'dkVH2rKsIpKodNDBUwoHjtxFAaT6b7x3', 1, '2016-11-10 07:59:56', '2016-11-12 23:01:11'),
(25, 'luoy15', 'luotyzl@gmail.com', '9899898989', 'asdjlajsdljasdj', '$2y$10$BfQSxMt6IlfDsL5Bgh..IeqRz4Ui5ClZrJkvaKY7ZX81mlzixZSyS', 'Customer', 'zLxRbBgq2M1TxildmDJYEuilawlPhJNY', 1, '2016-11-10 11:22:04', '2016-11-10 03:50:00'),
(27, 'Raymon', '282930556@qq.com', '2040582296', '73 wood ward rd', '$2y$10$QkbosUMpxIzVefyKxS5j4uoTfANlayNaOEAn8f9Fm9W.0kTaD5aWS', 'Customer', '5ghG5YpUsnH6mRuRuI7oNjdvuu2oDV58', 1, '2016-11-10 11:52:23', '2016-11-10 11:36:43'),
(29, 'customer', 'luotyzl@gmail.com', '2040582296', '2323sdasdasd', '$2y$10$VNxCceKJniuEW8ZszCjas.UlSu1d3k50x9k.2.iTm/3vn3qAGcjBK', 'Customer', 'mOMOdJFMsJXUWx05BO3fbng75FD9sPuV', 1, '2016-11-11 10:46:04', '2016-11-12 23:01:50'),
(30, 'luotyzl2', 'luotyzl@gmail.com', '2040582296', 'asdasd', '$2y$10$3X0fW9AXDyhqSQwUltH7f.E5/zK2uqC1FzGumy3avmHJ833VPLZiO', 'Customer', 'dEEipE7LcgYaky8upazbsgvFP5Agbjjt', 1, '2016-11-13 07:02:52', '2016-11-12 23:02:52'),
(31, 'luotyzl3', 'luotyzl@gmail.com', '2040582296', 'asdasdasdasdasd', '$2y$10$cb19KTnHam.Z1dgYk00xbeBTUnl.hylccfyD.gj35zfgKV8KOEqgC', 'Customer', 'bI9oAFKtXOPkowbo8z23r5ChzQqHqEMc', 0, '2016-11-13 07:04:59', '2016-11-12 23:36:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;
--
-- 使用表AUTO_INCREMENT `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- 使用表AUTO_INCREMENT `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'transaction id', AUTO_INCREMENT=9;
--
-- 使用表AUTO_INCREMENT `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- 使用表AUTO_INCREMENT `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- 使用表AUTO_INCREMENT `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;
--
-- 使用表AUTO_INCREMENT `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- 使用表AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
