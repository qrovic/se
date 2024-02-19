-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 29, 2024 at 05:47 AM
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
(31, 34, 1, '2024-01-29');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`) VALUES
(1),
(2),
(3),
(4),
(5),
(6),
(7),
(8),
(9),
(10),
(11),
(12),
(13),
(14),
(15),
(16),
(17),
(18),
(19),
(20),
(21),
(22),
(23),
(24),
(25),
(26),
(27),
(28),
(29),
(30),
(31);

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
(2, 38, 'Mocha Latte', 'Drinks', 'mocha.jpeg'),
(3, 38, 'Fries', 'Snacks', 'mcdofries.jpg'),
(4, 38, 'Iced Coffee', 'Combos', 'icedcofee.jpg'),
(5, 38, 'Spaghetti', 'Snacks', 'spag.jpeg'),
(6, 40, 'Burger', 'Snacks', 'burger.jpeg'),
(12, 49, 'Fries', 'Snacks', 'jollibee-french-fries-021419-1.jpg'),
(13, 49, 'Chicken Joy', 'Meals', 'a2002470507_10.jpg'),
(14, 49, 'Coke Float', 'Drinks', 'afcba0789b6c1e945b7e93cf6b6e6efc.jpg'),
(15, 49, 'Float with Fries', 'Combos', '22219996_1592256907487196_8596183077658277485_o.jpg'),
(16, 46, 'Legs with Rice', 'Combos', 'mang-inasal-ready-to-cook-01-2.jpg'),
(17, 46, 'Halo Halo', 'Desserts', 'a1yd4IAL-MKMVhTqpzfERg.jpg'),
(18, 46, 'Palabok w halo', 'Combos', 'Palabok-Halo-Halo-Merienda-Combo.jpg'),
(19, 38, 'Chicken', 'Meals', '2pcChickenRice-500.jpeg'),
(20, 38, 'Ube sundae', 'Desserts', 'mcdo-1-hot-fudge-sundae-1606112816.jpeg'),
(21, 38, 'Choco Sundae', 'Desserts', 'mcdo-1-hot-fudge-sundae-1606112816.jpeg'),
(22, 38, 'Strawberry Float', 'Drinks', 'Red-Velvet-McFloat.webp'),
(23, 38, 'Float w fries', 'Combos', 'download (1).jpg'),
(24, 38, 'Royal Float', 'Drinks', '6047_ouT40HgTUVKbk1bm_.jpg'),
(25, 38, 'Mango Shake', 'Drinks', 'DC_201906_2790_MediumMangoPineappleSmoothie_Glass_A1_832x472_1-3-product-tile-desktop.jpg'),
(26, 38, 'Foamy Caramel', 'Drinks', '04d5e0a61a03f43d4136c336aaa0cc98.png'),
(27, 38, 'Iced Coffee', 'Drinks', 'icedcaramelmac_2col_2-column-desktop.jpg'),
(28, 38, 'Caramel Latte', 'Drinks', 't-mcdonalds-mccafe-iced-mocha-medium-1566921962.jpg'),
(30, 38, 'Fries Chicken Coke', 'Combos', 'artworks-JHayJ4ei7u8FDVl7-hsS2fg-t500x500.jpg'),
(31, 38, 'Mc cafe chicken', 'Combos', 'bfcaa72dc815c9309c595d85343f226d.png_720x720q80.png'),
(32, 38, 'Breakfast bundle', 'Combos', 'greenprc-sausagemcmuffincoffeehb435x320-1587617068.png'),
(33, 38, 'Oreo mcflurry', 'Desserts', 'screen-shot-2019-08-26-at-1-02-16-pm-1566838950.png'),
(34, 38, 'Mango pie', 'Desserts', '13987665_10157244563490023_1444107325514963127_o.jpg'),
(35, 38, 'Choco Pie', 'Desserts', '0619eb8ec27c02b0a49395bb3ed67d2c.jpg'),
(36, NULL, NULL, '', NULL),
(37, 46, 'LOmi', 'Drinks', NULL),
(38, 38, 'chicken', 'Drinks', NULL),
(39, 38, 'sdjsdjdj', 'Drinks', NULL),
(40, 38, 'popo', 'Drinks', NULL),
(41, 47, 'Donut', 'Drinks', NULL),
(45, 38, 'kokitf', 'Drinks', 't-mcdonalds-mccafe-iced-mocha-medium-1566921962.jpg'),
(46, 38, 'tuyo', 'Drinks', NULL),
(47, 38, 'poto', 'Drinks', NULL);

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
('Medium', NULL, 'hot', NULL, 36, 1),
('Small', NULL, 'hot', NULL, 37, 2),
('Medium', NULL, 'hot', NULL, 37, 3),
('Small', NULL, 'cold', NULL, 37, 4),
('Medium', NULL, 'cold', NULL, 37, 5),
('Small', NULL, 'hot', NULL, 38, 6),
('Small', NULL, 'hot', NULL, 39, 7),
('Medium', NULL, 'hot', NULL, 39, 8),
('wala', NULL, 'hot', NULL, 39, 9),
('Small', NULL, 'cold', NULL, 39, 10),
('Medium', NULL, 'cold', NULL, 39, 11),
('wala', NULL, 'cold', NULL, 39, 12),
('Small', NULL, 'ohno', NULL, 39, 13),
('Medium', NULL, 'ohno', NULL, 39, 14),
('wala', NULL, 'ohno', NULL, 39, 15),
('masarap', NULL, 'malakiiiiiiiiii', NULL, 40, 16),
('di masarap', NULL, 'malakiiiiiiiiii', NULL, 40, 17),
('masarap', NULL, 'maliit', NULL, 40, 18),
('di masarap', NULL, 'maliit', NULL, 40, 19),
('Jumbo', NULL, 'Choco', NULL, 41, 20),
('Mediocore', NULL, 'Choco', NULL, 41, 21),
('Jumbo', NULL, 'Vanilla', NULL, 41, 22),
('Mediocore', NULL, 'Vanilla', NULL, 41, 23),
('pola', NULL, 'manok', NULL, 44, 24),
('pole', NULL, 'manok', NULL, 44, 25),
('baka', NULL, 'manok', NULL, 44, 26),
('pola', NULL, 'koka', NULL, 44, 27),
('pole', NULL, 'koka', NULL, 44, 28),
('baka', NULL, 'koka', NULL, 44, 29),
('pola', NULL, 'dragon', NULL, 44, 30),
('pole', NULL, 'dragon', NULL, 44, 31),
('baka', NULL, 'dragon', NULL, 44, 32),
('pola', 9, 'manok', 98, 45, 33),
('pole', 989, 'manok', 9898, 45, 34),
('baka', 9, 'manok', 98, 45, 35),
('pola', 9, 'koka', 98, 45, 36),
('pole', 989, 'koka', 9898, 45, 37),
('baka', 9, 'koka', 98, 45, 38),
('pola', 9, 'dragon', 98, 45, 39),
('pole', 989, 'dragon', 9898, 45, 40),
('baka', 9, 'dragon', 98, 45, 41),
('Small', NULL, 'hot', NULL, 47, 42);

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
  `id` int(11) NOT NULL,
  `customerid` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `itempriceid` int(11) DEFAULT NULL,
  `orderid` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(41, 53, NULL, '', '', '', '', 'Owner', '');

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
(53, '', NULL, 'Online', NULL);

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
  ADD KEY `orderid` (`orderid`),
  ADD KEY `itempriceid` (`itempriceid`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customerid` (`customerid`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `itemprice`
--
ALTER TABLE `itemprice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `orderitem`
--
ALTER TABLE `orderitem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

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
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customerid`) REFERENCES `customer` (`id`);

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
