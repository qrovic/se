-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 27, 2024 at 12:40 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(35, 38, 'Choco Pie', 'Desserts', '0619eb8ec27c02b0a49395bb3ed67d2c.jpg');

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
(38, 50, 'fgdfg', '', '455', 'dunkin@gmail.com', 'dunkin', 'Owner', '');

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
(50, 'sfds', 'fgdfg', 'Online', '—Pngtree—vector shopping bag icon_4162833.png');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `itemprice`
--
ALTER TABLE `itemprice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

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
