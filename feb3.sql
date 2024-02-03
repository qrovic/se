-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 03, 2024 at 09:52 AM
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
-- Database: `se2`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `customerid` int(11) NOT NULL,
  `itempriceid` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `date` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`customerid`, `itempriceid`, `quantity`, `date`) VALUES
(25, 33, 2, '2024-01-29'),
(25, 34, 1, '2024-01-29'),
(25, 37, 9, '2024-01-29'),
(25, 41, 1, '2024-01-29'),
(31, 33, 2, '2024-01-29'),
(31, 34, 1, '2024-01-29'),
(32, 2, 5, '2024-01-29'),
(32, 5, 2, '2024-01-29'),
(32, 35, 7, '2024-01-29'),
(32, 37, 5, '2024-01-29'),
(33, 36, 3, '2024-01-30'),
(33, 37, 2, '2024-01-30'),
(34, 3, 1, '2024-01-30'),
(34, 5, 2, '2024-01-30'),
(34, 19, 1, '2024-01-30'),
(34, 21, 3, '2024-01-30'),
(34, 22, 1, '2024-01-30'),
(34, 34, 4, '2024-01-30'),
(35, 34, 1, '2024-01-30'),
(36, 34, 1, '2024-01-30'),
(62, 33, 1, '2024-02-01'),
(70, 40, 1, '2024-02-01'),
(74, 37, 1, '2024-02-01'),
(92, 23, 1, '2024-02-01'),
(92, 33, 1, '2024-02-01'),
(92, 37, 1, '2024-02-01'),
(92, 39, 1, '2024-02-01'),
(92, 40, 5, '2024-02-01'),
(92, 51, 3, '2024-02-01'),
(92, 52, 1, '2024-02-01'),
(92, 118, 1, '2024-02-02'),
(93, 33, 1, '2024-02-01'),
(95, 37, 1, '2024-02-02'),
(95, 117, 3, '2024-02-02'),
(96, 39, 1, '2024-02-02'),
(96, 40, 1, '2024-02-02'),
(97, 3, 1, '2024-02-02'),
(97, 36, 1, '2024-02-02'),
(97, 37, 2, '2024-02-02'),
(97, 40, 1, '2024-02-02'),
(97, 51, 1, '2024-02-02'),
(100, 53, 1, '2024-02-02'),
(102, 33, 1, '2024-02-02'),
(102, 34, 1, '2024-02-02'),
(102, 37, 1, '2024-02-02'),
(102, 38, 1, '2024-02-02'),
(102, 39, 1, '2024-02-02'),
(102, 41, 1, '2024-02-02'),
(103, 40, 1, '2024-02-02'),
(104, 39, 1, '2024-02-02'),
(105, 22, 2, '2024-02-02'),
(105, 23, 4, '2024-02-02'),
(105, 34, 2, '2024-02-02'),
(105, 35, 3, '2024-02-02'),
(105, 36, 2, '2024-02-02'),
(105, 37, 4, '2024-02-02'),
(105, 38, 4, '2024-02-02'),
(105, 39, 6, '2024-02-02'),
(105, 40, 30, '2024-02-02'),
(105, 41, 12, '2024-02-02'),
(105, 51, 1, '2024-02-02'),
(105, 52, 1, '2024-02-02'),
(105, 115, 1, '2024-02-02'),
(106, 40, 1, '2024-02-02'),
(107, 40, 1, '2024-02-02'),
(108, 41, 1, '2024-02-02'),
(109, 33, 1, '2024-02-02'),
(110, 41, 5, '2024-02-02'),
(111, 37, 1, '2024-02-02'),
(113, 33, 1, '2024-02-02'),
(113, 34, 2, '2024-02-02'),
(113, 41, 1, '2024-02-02'),
(115, 40, 1, '2024-02-02'),
(116, 40, 2, '2024-02-02'),
(116, 51, 2, '2024-02-02'),
(117, 37, 1, '2024-02-02'),
(118, 33, 1, '2024-02-02'),
(118, 35, 1, '2024-02-02'),
(118, 37, 3, '2024-02-02'),
(118, 41, 2, '2024-02-02'),
(119, 33, 1, '2024-02-02'),
(119, 34, 4, '2024-02-02'),
(119, 40, 9, '2024-02-02'),
(120, 33, 2, '2024-02-02'),
(120, 34, 7, '2024-02-02'),
(120, 37, 2, '2024-02-02'),
(122, 37, 1, '2024-02-02'),
(124, 33, 1, '2024-02-02'),
(125, 20, 3, '2024-02-02'),
(125, 36, 3, '2024-02-02'),
(127, 113, 1, '2024-02-02'),
(136, 33, 4, '2024-02-02'),
(136, 36, 2, '2024-02-02'),
(137, 34, 1, '2024-02-02'),
(138, 39, 1, '2024-02-02'),
(139, 20, 1, '2024-02-02'),
(140, 36, 7, '2024-02-02'),
(140, 38, 8, '2024-02-02'),
(141, 120, 1, '2024-02-02'),
(142, 37, 1, '2024-02-02'),
(142, 39, 1, '2024-02-02'),
(143, 39, 1, '2024-02-02'),
(144, 36, 1, '2024-02-02'),
(146, 119, 5, '2024-02-02'),
(147, 119, 7, '2024-02-02'),
(147, 125, 3, '2024-02-02'),
(147, 127, 1, '2024-02-02'),
(147, 130, 1, '2024-02-02'),
(147, 144, 1, '2024-02-02'),
(147, 148, 1, '2024-02-02'),
(147, 164, 1, '2024-02-02'),
(148, 119, 1, '2024-02-02'),
(150, 130, 1, '2024-02-02'),
(151, 129, 5, '2024-02-03'),
(152, 177, 2, '2024-02-03'),
(152, 179, 1, '2024-02-03'),
(153, 121, 1, '2024-02-03'),
(154, 122, 6, '2024-02-03'),
(154, 129, 1, '2024-02-03'),
(154, 132, 1, '2024-02-03'),
(154, 152, 3, '2024-02-03'),
(155, 121, 6, '2024-02-03'),
(155, 124, 2, '2024-02-03'),
(155, 125, 3, '2024-02-03'),
(155, 129, 3, '2024-02-03'),
(156, 163, 3, '2024-02-03'),
(165, 119, 1, '2024-02-03'),
(166, 119, 2, '2024-02-03'),
(166, 140, 2, '2024-02-03'),
(168, 134, 1, '2024-02-03'),
(168, 173, 1, '2024-02-03'),
(169, 119, 1, '2024-02-03'),
(170, 119, 3, '2024-02-03'),
(170, 130, 3, '2024-02-03'),
(170, 136, 1, '2024-02-03'),
(170, 152, 1, '2024-02-03'),
(171, 119, 1, '2024-02-03'),
(171, 129, 4, '2024-02-03'),
(171, 150, 1, '2024-02-03'),
(171, 163, 1, '2024-02-03'),
(171, 165, 1, '2024-02-03'),
(172, 129, 4, '2024-02-03'),
(172, 132, 3, '2024-02-03'),
(172, 161, 1, '2024-02-03'),
(172, 181, 4, '2024-02-03');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `status` varchar(255) DEFAULT 'ordering'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `status`) VALUES
(1, NULL),
(2, NULL),
(3, NULL),
(4, NULL),
(5, NULL),
(6, NULL),
(7, NULL),
(8, NULL),
(9, NULL),
(10, NULL),
(11, NULL),
(12, NULL),
(13, NULL),
(14, NULL),
(15, NULL),
(16, NULL),
(17, NULL),
(18, NULL),
(19, NULL),
(20, NULL),
(21, NULL),
(22, NULL),
(23, NULL),
(24, NULL),
(25, NULL),
(26, NULL),
(27, NULL),
(28, NULL),
(29, NULL),
(30, NULL),
(31, NULL),
(32, NULL),
(33, NULL),
(34, NULL),
(35, NULL),
(36, NULL),
(37, NULL),
(38, NULL),
(39, NULL),
(40, NULL),
(41, NULL),
(42, NULL),
(43, NULL),
(44, NULL),
(45, NULL),
(46, NULL),
(47, NULL),
(48, NULL),
(49, NULL),
(50, NULL),
(51, NULL),
(52, NULL),
(53, NULL),
(54, NULL),
(55, NULL),
(56, NULL),
(57, NULL),
(58, NULL),
(59, NULL),
(60, NULL),
(61, NULL),
(62, NULL),
(63, NULL),
(64, NULL),
(65, NULL),
(66, NULL),
(67, NULL),
(68, NULL),
(69, NULL),
(70, NULL),
(71, NULL),
(72, NULL),
(73, NULL),
(74, NULL),
(75, 'ordering'),
(76, 'ordering'),
(77, 'ordering'),
(78, 'ordering'),
(79, 'ordering'),
(80, 'ordering'),
(81, 'ordering'),
(82, 'ordering'),
(83, 'ordering'),
(84, 'ordering'),
(85, 'ordering'),
(86, 'ordering'),
(87, 'ordering'),
(88, 'cancelled'),
(89, 'cancelled'),
(90, 'cancelled'),
(91, 'cancelled'),
(92, 'cancelled'),
(93, 'cancelled'),
(94, 'ordering'),
(95, 'ordering'),
(96, 'ordering'),
(97, 'ordering'),
(98, 'ordering'),
(99, 'ordering'),
(100, 'ordering'),
(101, 'ordering'),
(102, 'ordering'),
(103, 'ordering'),
(104, 'ordering'),
(105, 'cancelled'),
(106, 'cancelled'),
(107, 'ordering'),
(108, 'ordering'),
(109, 'ordering'),
(110, 'ordering'),
(111, 'ordering'),
(112, 'ordering'),
(113, 'cancelled'),
(114, 'ordering'),
(115, 'ordering'),
(116, 'ordering'),
(117, 'cancelled'),
(118, 'cancelled'),
(119, 'ordering'),
(120, 'ordering'),
(121, 'ordering'),
(122, 'ordering'),
(123, 'cancelled'),
(124, 'ordering'),
(125, 'cancelled'),
(126, 'cancelled'),
(127, 'ordering'),
(128, 'cancelled'),
(129, 'cancelled'),
(130, 'cancelled'),
(131, 'cancelled'),
(132, 'cancelled'),
(133, 'cancelled'),
(134, 'cancelled'),
(135, 'ordering'),
(136, 'ordering'),
(137, 'cancelled'),
(138, 'ordering'),
(139, 'ordering'),
(140, 'ordering'),
(141, 'ordering'),
(142, 'ordering'),
(143, 'cancelled'),
(144, 'ordering'),
(145, 'ordering'),
(146, 'cancelled'),
(147, 'ordering'),
(148, 'cancelled'),
(149, 'ordering'),
(150, 'ordering'),
(151, 'ordering'),
(152, 'ordering'),
(153, 'ordering'),
(154, 'cancelled'),
(155, 'cancelled'),
(156, 'ordering'),
(157, 'ordering'),
(158, 'ordering'),
(159, 'ordering'),
(160, 'ordering'),
(161, 'ordering'),
(162, 'ordering'),
(163, 'ordering'),
(164, 'ordering'),
(165, 'ordering'),
(166, 'cancelled'),
(167, 'ordering'),
(168, 'ordering'),
(169, 'ordering'),
(170, 'cancelled'),
(171, 'cancelled'),
(172, 'ordering'),
(173, 'ordering');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id` int(11) NOT NULL,
  `storeid` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `pic` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `storeid`, `name`, `category`, `pic`) VALUES
(116, 38, 'Chicken w rice', 'Drinks', '2pcChickenRice-500 (1).jpeg'),
(117, 38, 'Mc Cafe', 'Drinks', '04d5e0a61a03f43d4136c336aaa0cc98.png'),
(118, 38, 'Peach Mango Pie', 'Desserts', '04d5e0a61a03f43d4136c336aaa0cc98.png'),
(119, 38, 'Royal Float', 'Drinks', '6047_ouT40HgTUVKbk1bm_.jpg'),
(120, 47, 'Strawberry Cake', 'Drinks', '6047_ouT40HgTUVKbk1bm_.jpg'),
(121, 47, 'Mango Pie', 'Desserts', '13987665_10157244563490023_1444107325514963127_o.jpg'),
(122, 46, 'Leche Flan', 'Desserts', '20210723-Leche-Flan-Rezel-17-3bdcb943a559409d9b62976818423d96.jpg'),
(123, 38, 'Coke w fries', 'Items', '22219996_1592256907487196_8596183077658277485_o.jpg'),
(124, 46, 'Halo Halo', 'Desserts', 'a1yd4IAL-MKMVhTqpzfERg.jpg'),
(125, 38, 'Chicken', 'Meals', 'a2002470507_10.jpg'),
(126, 49, 'Coke Float', 'Drinks', 'afcba0789b6c1e945b7e93cf6b6e6efc.jpg'),
(127, 38, 'Chicken w fries and drinks', 'Combos', 'artworks-JHayJ4ei7u8FDVl7-hsS2fg-t500x500.jpg'),
(128, 46, 'Barbeque', 'Meals', 'bbq.jpg'),
(129, 38, 'Big Mac', 'Snacks', 'burger.jpeg'),
(130, 38, 'Mango Shake', 'Drinks', 'DC_201906_2790_MediumMangoPineappleSmoothie_Glass_A1_832x472_1-3-product-tile-desktop.jpg'),
(131, 38, 'Fries w coke float', 'Combos', 'download (1).jpg'),
(132, 47, 'Egg pie', 'Snacks', 'Filipino-Egg-Pie-3.jpg'),
(133, 49, 'Foot Long', 'Snacks', 'footlong.jpeg'),
(134, 49, 'Fries', 'Snacks', 'fries.jpg'),
(135, 38, 'Iced Mc Cafe', 'Drinks', 'icedcaramelmac_2col_2-column-desktop.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `itemprice`
--

CREATE TABLE `itemprice` (
  `size` varchar(255) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `variant` varchar(255) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `itemid` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `itemprice`
--

INSERT INTO `itemprice` (`size`, `price`, `variant`, `stock`, `itemid`, `id`) VALUES
('Medium', 11, 'Prito', 12, 115, 118),
('Small', 89, 'Mainit', 100, 116, 119),
('Medium', 99, 'Mainit', 65, 116, 120),
('Small', 55, 'hot', 29, 117, 121),
('Medium', 70, 'hot', 98, 117, 122),
('large', 90, 'hot', 65, 117, 123),
('Small', 60, 'cold', 54, 117, 124),
('Medium', 85, 'cold', 97, 117, 125),
('large', 105, 'cold', 44, 117, 126),
('Regular', 75, 'Spicy', 98, 118, 127),
('Regular', 70, 'Sweet', 44, 118, 128),
('Small', 40, 'cold', 6, 119, 129),
('Medium', 55, 'cold', 9, 119, 130),
('Large', 70, 'cold', 23, 119, 131),
('1 slice', 115, 'Regular', 566, 120, 132),
('Whole cake', 555, 'Regular', 87, 120, 133),
('1 slice', 180, 'Special', 65, 120, 134),
('Whole cake', 800, 'Special', 53, 120, 135),
('Small', 60, 'Sweet', 66, 121, 136),
('Large', 80, 'Sweet', 54, 121, 137),
('Small', 50, 'Unsweetened', 85, 121, 138),
('Large', 65, 'Unsweetened', 83, 121, 139),
('1 slice', 40, 'Regular', 65, 122, 140),
('whole pie', 350, 'Regular', 64, 122, 141),
('Small fries', 95, 'cold', 76, 123, 142),
('Medium Fries', 115, 'cold', 87, 123, 143),
('Small', 50, 'Regular ', 6, 124, 144),
('Medium', 60, 'Regular ', 2, 124, 145),
('Large', 70, 'Regular ', 242, 124, 146),
('Small', 65, 'Special', 23, 124, 147),
('Medium', 80, 'Special', 23, 124, 148),
('Large', 95, 'Special', 23, 124, 149),
('Regular', 78, 'Spicy', 55, 125, 150),
('Regular', 65, 'Not Spicy', 876, 125, 151),
('Small', 50, 'Regular', 65, 126, 152),
('Medium', 55, 'Regular', 23, 126, 153),
('large', 60, 'Regular', 11, 126, 154),
('Small Fries', 180, 'Upgrade to coke float', 23, 127, 155),
('Medium Fries', 195, 'Upgrade to coke float', 667, 127, 156),
('Large Fries', 215, 'Upgrade to coke float', 77, 127, 157),
('Small Fries', 150, 'Regular', 7667, 127, 158),
('Medium Fries', 175, 'Regular', 88, 127, 159),
('Large Fries', 190, 'Regular', 7778, 127, 160),
('1 stick', 20, 'Spicy Sauce', 667, 128, 161),
('1 stick', 18, 'Not Spicy', 7667, 128, 162),
('Regular', 105, 'Spicy', 78, 129, 163),
('Regular', 90, 'Not Spicy', 7878, 129, 164),
('Small', 60, 'smoothie', 76, 130, 165),
('Medium', 70, 'smoothie', 77, 130, 166),
('Small', 70, 'creamy', 66, 130, 167),
('Medium', 85, 'creamy', 87, 130, 168),
('Small Coke Float', 90, 'Large Fries', 77, 131, 169),
('Large Coke Float', 115, 'Large Fries', 77, 131, 170),
('Small Coke Float', 75, 'Small Fries', 13, 131, 171),
('Large Coke Float', 60, 'Small Fries', 13, 131, 172),
('1 slice', 50, 'Regular', 67, 132, 173),
('whole pie', 300, 'Regular', 76, 132, 174),
('Regular SIze', 80, 'Spicy', 22, 133, 175),
('Regular SIze', 75, 'Not SPicy', 232, 133, 176),
('Small', 45, 'Regular', 87, 134, 177),
('Medium', 55, 'Regular', 76, 134, 178),
('large', 65, 'Regular', 76, 134, 179),
('Small', 55, 'hot', 87, 135, 180),
('Medium', 60, 'hot', 77, 135, 181),
('large', 75, 'hot', 878, 135, 182),
('Small', 60, 'cold', 7667, 135, 183),
('Medium', 65, 'cold', 88, 135, 184),
('large', 80, 'cold', 787, 135, 185);

-- --------------------------------------------------------

--
-- Table structure for table `orderitem`
--

CREATE TABLE `orderitem` (
  `id` int(11) NOT NULL,
  `orderid` int(11) NOT NULL,
  `itempriceid` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `customerid` int(11) NOT NULL,
  `status` varchar(255) DEFAULT 'to_pay',
  `itempriceid` int(11) NOT NULL,
  `date` date DEFAULT current_timestamp(),
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`customerid`, `status`, `itempriceid`, `date`, `quantity`) VALUES
(95, NULL, 37, '2024-02-02', 3),
(95, NULL, 117, '2024-02-02', 6),
(95, NULL, 118, '2024-02-02', 3),
(96, NULL, 39, '2024-02-02', 3334),
(97, NULL, 3, '2024-02-02', 1),
(97, NULL, 36, '2024-02-02', 1),
(97, NULL, 37, '2024-02-02', 2),
(97, NULL, 40, '2024-02-02', 1),
(97, NULL, 51, '2024-02-02', 1),
(100, NULL, 54, '2024-02-02', 1),
(102, NULL, 33, '2024-02-02', 1),
(102, NULL, 34, '2024-02-02', 1),
(102, NULL, 37, '2024-02-02', 1),
(102, NULL, 38, '2024-02-02', 1),
(102, NULL, 39, '2024-02-02', 1),
(102, NULL, 41, '2024-02-02', 1),
(103, NULL, 40, '2024-02-02', 30),
(104, NULL, 39, '2024-02-02', 1),
(107, NULL, 41, '2024-02-02', 1),
(108, NULL, 41, '2024-02-02', 1),
(109, NULL, 33, '2024-02-02', 1),
(111, NULL, 37, '2024-02-02', 1),
(116, NULL, 39, '2024-02-02', 2),
(116, NULL, 52, '2024-02-02', 2),
(120, NULL, 33, '2024-02-02', 2),
(120, NULL, 34, '2024-02-02', 20),
(120, NULL, 37, '2024-02-02', 2),
(122, NULL, 40, '2024-02-02', 5),
(124, NULL, 33, '2024-02-02', 1),
(127, NULL, 116, '2024-02-02', 1),
(136, NULL, 35, '2024-02-02', 2),
(136, NULL, 37, '2024-02-02', 78),
(138, NULL, 39, '2024-02-02', 1),
(140, NULL, 36, '2024-02-02', 100),
(140, NULL, 37, '2024-02-02', 7),
(141, NULL, 120, '2024-02-02', 1),
(142, NULL, 37, '2024-02-02', 1),
(142, NULL, 39, '2024-02-02', 1),
(144, NULL, 38, '2024-02-02', 900),
(151, NULL, 130, '2024-02-03', 5),
(152, NULL, 177, '2024-02-03', 5),
(152, NULL, 179, '2024-02-03', 7),
(153, NULL, 121, '2024-02-03', 5),
(165, NULL, 120, '2024-02-03', 1);

-- --------------------------------------------------------

--
-- Table structure for table `queue`
--

CREATE TABLE `queue` (
  `id` int(11) NOT NULL,
  `orderid` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sale`
--

CREATE TABLE `sale` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `orderid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `storeid` int(11) DEFAULT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `contactno` text DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `mname` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `storeid`, `fname`, `lname`, `contactno`, `email`, `password`, `role`, `mname`) VALUES
(26, 38, 'low high hHAHAHHA', 'Quilantang', '09193162290', 'admin@gmail.com', 'admin', 'Owner', 'Jose'),
(27, 39, 'Where every drink turns into a dream', 'Quilantang', '09193162290', 'quilantangrovic@gmail.com', 'mayjune123', 'Owner', ''),
(28, 40, 'Heuhsudhbsd', 'shijfsrjhksrf', '09193162290', 'febijbkjsfesk@gmail.com', 'fhjkbscdnjkcsdknjscd', 'Owner', 'Jbjscbkjc'),
(29, 41, 'DADASH', 'FSHHDF', '09191873187', 'admin@gmail.com', 'admin', 'Owner', 'SDFHSH'),
(30, 42, 'jjsjsjksf', '', '', '', '', 'Owner', ''),
(31, 43, 'sdhsjsdj', 'DXVJDJ', '2898938', 'admin@gmail.com', 'admin', 'Owner', 'DXVJJN'),
(32, 44, NULL, '', '', '', '', 'Owner', ''),
(33, 45, NULL, '', '', '', '', 'Owner', ''),
(34, 46, 'Chicken inasal', 'Inasal', '09193162888', 'mangjose@gmail.com', 'manginasal', 'Owner', 'Jose'),
(35, 47, 'yummy donut', 'donut', '091942622284', 'dunkin@gmail.com', 'dunkin', 'Owner', ''),
(36, 48, 'esdhjf', 'donut', '092327837', 'dunkin2@gmail.com', 'dunkin', 'Owner', ''),
(37, 49, 'jasdjkjda', 'bee', '09193162290', 'jollibee@gmail.com', 'dunkin', 'Owner', ''),
(38, 50, 'fgdfg', '', '455', 'dunkin@gmail.com', 'dunkin', 'Owner', ''),
(39, 51, NULL, '', '', '', '', 'Owner', ''),
(40, 52, NULL, '', '', '', '', 'Owner', ''),
(41, 53, NULL, '', '', '', '', 'Owner', ''),
(42, 54, 'ugyyg', 'WUI', '9193189', '', 'admin', 'Owner', 'j');

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE `store` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT 'Online',
  `pic` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `store`
--

INSERT INTO `store` (`id`, `name`, `description`, `status`, `pic`) VALUES
(38, 'Mcdo', 'low high hHAHAHHA', 'Online', 'mcdo.png'),
(46, 'Mang Inasal', 'Chicken inasal', 'Online', 'flat,750x,075,f-pad,750x1000,f8f8f8 (1).jpg'),
(47, 'Dunkin', 'yummy donut', 'Online', '1678.png'),
(49, 'Jollibee', 'jasdjkjda', 'Online', '87d166c686ccca056ebcafba8ceae13f.jpg'),
(51, '', NULL, 'Online', NULL),
(52, '', NULL, 'Online', NULL),
(53, '', NULL, 'Online', NULL),
(54, 'Nyalime', 'ugyyg', 'Online', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`customerid`,`itempriceid`),
  ADD KEY `itempriceid` (`itempriceid`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `storeid` (`storeid`);

--
-- Indexes for table `itemprice`
--
ALTER TABLE `itemprice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `itemid` (`itemid`);

--
-- Indexes for table `orderitem`
--
ALTER TABLE `orderitem`
  ADD PRIMARY KEY (`id`),
  ADD KEY `itempriceid` (`itempriceid`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`customerid`,`itempriceid`),
  ADD KEY `customerid` (`customerid`),
  ADD KEY `itempriceid` (`itempriceid`);

--
-- Indexes for table `queue`
--
ALTER TABLE `queue`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orderid` (`orderid`);

--
-- Indexes for table `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale_ibfk_1` (`orderid`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`),
  ADD KEY `storeid` (`storeid`);

--
-- Indexes for table `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=174;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT for table `itemprice`
--
ALTER TABLE `itemprice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=186;

--
-- AUTO_INCREMENT for table `orderitem`
--
ALTER TABLE `orderitem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `queue`
--
ALTER TABLE `queue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sale`
--
ALTER TABLE `sale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`customerid`) REFERENCES `customer` (`id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`itempriceid`) REFERENCES `itemprice` (`id`);

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `item_ibfk_1` FOREIGN KEY (`storeid`) REFERENCES `store` (`id`);

--
-- Constraints for table `itemprice`
--
ALTER TABLE `itemprice`
  ADD CONSTRAINT `itemprice_ibfk_1` FOREIGN KEY (`itemid`) REFERENCES `item` (`id`);

--
-- Constraints for table `orderitem`
--
ALTER TABLE `orderitem`
  ADD CONSTRAINT `orderitem_ibfk_1` FOREIGN KEY (`orderid`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `orderitem_ibfk_2` FOREIGN KEY (`itempriceid`) REFERENCES `item` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customerid`) REFERENCES `customer` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`itempriceid`) REFERENCES `itemprice` (`id`);

--
-- Constraints for table `queue`
--
ALTER TABLE `queue`
  ADD CONSTRAINT `queue_ibfk_1` FOREIGN KEY (`orderid`) REFERENCES `orders` (`id`);

--
-- Constraints for table `sale`
--
ALTER TABLE `sale`
  ADD CONSTRAINT `sale_ibfk_1` FOREIGN KEY (`orderid`) REFERENCES `orders` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
