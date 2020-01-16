-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 05, 2020 at 03:16 PM
-- Server version: 5.7.19
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `time_ordered` datetime NOT NULL,
  `address` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `bill` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `users_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `time_ordered`, `address`, `bill`, `status`) VALUES
(2, 2, '2019-12-31 00:11:39', '', 1500, 1),
(3, 2, '2019-12-31 00:20:26', '', 520, 1),
(4, 2, '2019-12-31 07:25:52', '', 422, 1),
(5, 2, '2019-12-31 19:57:03', '', 1540, 1),
(6, 2, '2020-01-01 12:50:26', '', 14200, 1),
(7, 2, '2020-01-01 19:16:55', 'Pozarevac', 5344, 1),
(8, 2, '2020-01-01 19:28:50', 'Beograd', 2850, 1),
(9, 2, '2020-01-01 20:40:54', 'Smederevo', 5820, 1),
(10, 2, '2020-01-01 22:09:37', 'Kostolac', 34335, 1),
(11, 2, '2020-01-02 08:32:47', 'Pozarevac', 23070, 1),
(13, 2, '2020-01-02 19:48:08', 'Novi Sad', 13260, 1),
(14, 2, '2020-01-03 20:32:55', 'Srem', 7815, 1),
(15, 14, '2020-01-04 00:36:52', 'Pozarevac', 35790, 1),
(16, 14, '2020-01-04 00:39:12', 'Sombor', 31425, 1),
(17, 14, '2020-01-04 00:39:55', 'Sombor', 12180, 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_list`
--

DROP TABLE IF EXISTS `order_list`;
CREATE TABLE IF NOT EXISTS `order_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `response` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_list`
--

INSERT INTO `order_list` (`id`, `order_id`, `product_id`, `quantity`, `response`) VALUES
(3, 2, 7, 1, 1),
(4, 2, 7, 1, 1),
(5, 2, 8, 1, 1),
(6, 3, 7, 1, 1),
(7, 3, 7, 1, 1),
(8, 3, 8, 1, 1),
(9, 4, 7, 1, 1),
(10, 4, 7, 1, 1),
(11, 4, 8, 1, 1),
(30, 15, 7, 5, 1),
(29, 14, 7, 3, 1),
(14, 6, 7, 4, 1),
(15, 6, 8, 6, 1),
(16, 7, 7, 6, 1),
(17, 7, 8, 2, 1),
(18, 8, 7, 2, 1),
(19, 8, 8, 5, 1),
(20, 9, 7, 4, 1),
(21, 10, 7, 5, 1),
(22, 10, 8, 3, 1),
(23, 10, 7, 2, 1),
(24, 10, 8, 4, 1),
(25, 11, 8, 5, 1),
(26, 12, 9, 100, 0),
(27, 13, 7, 2, 1),
(28, 13, 8, 3, 1),
(31, 15, 7, 3, 1),
(32, 16, 7, 5, 1),
(33, 16, 8, 7, 1),
(34, 17, 7, 6, 1),
(35, 17, 8, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) NOT NULL,
  `product` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `users_id` (`users_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `users_id`, `product`, `description`, `price`, `image`) VALUES
(7, 1, 'Jelka', 'Opis Jelke', 1455, 'https://dijaspora.shop/media/catalog/product/cache/1/thumbnail/1000x1000/9df78eab33525d08d6e5fb8d27136e95/n/o/novogodisnja-jelka-snezna-180cm-180884_1.jpg'),
(8, 1, 'Patike', 'izmena opisa', 3450, 'https://www.thespot.rs/image.aspx?imageId=155908');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `surname` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `mail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `admin` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `password`, `mail`, `phone`, `admin`) VALUES
(1, 'Nikola', 'Jovanović', '202cb962ac59075b964b07152d234b70', 'nikola@gmail.com', '0621234567', 1),
(2, 'Petar', 'Perić', 'a67151334118c75ca987f0c67e5fd5b0', 'petar@gmail.com', '0622234567', 0),
(3, 'Milos', 'Milosevic', 'c7652e9778bd8a1fd2a42f42512d2895', 'milos@gmail.com', '0613234567', 0),
(14, 'Mladen', 'Mladenovic', '2bac8256bdd2b14f9ef2991ec8fc07fc', 'mladen@gmail.com', '061358877', 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
