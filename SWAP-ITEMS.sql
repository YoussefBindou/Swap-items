-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2023 at 09:52 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `swap_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id_cat` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `descr` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id_cat`, `name`, `descr`) VALUES
(1, 'Fashion', 'Fashion Category Description'),
(2, 'Technology', 'Technology Category Description'),
(3, 'Food', 'Food Category Description'),
(4, 'Beauty', 'Beauty Category Description'),
(5, 'Sports', 'Sports Category Description'),
(6, 'Entertainment', 'Entertainment Category Description'),
(7, 'Home', 'Home Category Description'),
(8, 'Travel', 'Travel Category Description'),
(9, 'Health', 'Health Category Description'),
(10, 'Fitness', 'Fitness Category Description');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(250) NOT NULL,
  `descrition` varchar(255) NOT NULL,
  `coondition` varchar(250) NOT NULL,
  `img` varchar(1000) NOT NULL,
  `category` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `availability` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`item_id`, `item_name`, `descrition`, `coondition`, `img`, `category`, `id_user`, `availability`) VALUES
(84, 'ThinkPad P70', 'i7-6700HQ 3.6Ghz 6th Gen Quad Core, 16GB RAM (UP to 64MB), 512GB SSD , IPS 17.3in 1920x1080 LCD, Nvidia M3000M 4GB Graphics , agn wireless, Bluetooth, Ethernet, Camera, Thundebolt 3, 6 Cell Battery, Win10 Pro 64', 'Used', 'test/6486f22a98923_51Bq4hiZQVL._AC_SX466_.jpg,test/6486f22a98e23_114_339279061.jpg,test/6486f22a994d4_5121Tg+LA5L._AC_SX466_.jpg,test/6486f22a998f7_p70-900-1-o.jpg', 2, 38, 0),
(85, 'Nike', 'Lace up and feel the legacy. Produced at the intersection of art, music and culture, this champion running shoe helped define the ‘90s. Worn by presidents, revolutionized through collabs and celebrated through rare colorways, its striking visuals, Waffle ', 'Used', 'test/6486f3af293b3_2addfa0b-61c7-43c1-b4e9-f4c9fbc9ffae.png,test/6486f3af29a53_ab2c5b89-76c7-479e-bf87-1039b97ce5ca.png,test/6486f3af29f02_f9e940d3-2192-434e-a017-072303ce2f14.png,test/6486f3af2a33f_f252b4be-e16c-4e34-a9c0-35169a9bb763.png', 1, 38, 0),
(87, 'pan', '1.2mm thickness carbon steel non-stick 23cm 29cm 35cm round comals', 'Used', 'test/648715f721693_H77d7e1092e4949f3ab3d940ff41ac7ece.jpg_100x100xz.png,test/648715f721ddb_Hb12b155e829a4b699bf017451e1d49e9K.jpg_100x100xz.png,test/648715f72232a_Hc8ff605018ff4b0b8807b65bbe941803x.jpg_100x100xz.png,test/648715f72282a_Hd368552c8053489583eea3ef11f2d0b2C.jpg_100x100xz.png', 7, 38, 0),
(91, 'sbardila', 'Download Bootstrap to get the compiled CSS and JavaScript, source code, or include it with your favorite package managers like npm, RubyGems, and more.', 'Unused', 'test/648f02704d075_6486f3af2a33f_f252b4be-e16c-4e34-a9c0-35169a9bb763.png,test/648f02704d83b_6486f3af29a53_ab2c5b89-76c7-479e-bf87-1039b97ce5ca.png,test/648f02704dde9_6486f3af29f02_f9e940d3-2192-434e-a017-072303ce2f14.png,test/648f02704e3b4_6486f3af293b3_2addfa0b-61c7-43c1-b4e9-f4c9fbc9ffae.png', 10, 37, 0),
(93, 'GTX 4060', 'GTX 4060GTX 4060GTX 4060GTX 4060', 'Unused', 'test/649406e38363b_6487175223bfa_Hac5cb92f98ec4f0592892238d9428283H.png_100x100xz.png,test/649406e383d45_64871752232da_H7041f47c3a394ce4bc165cef29f56a27k.png_100x100xz.png,test/649406e38734e_64871752247c1_Heaad7f94f92a447dbcd4c325ae43e84dl.png_100x100xz.png,test/649406e387a04_6487175224314_Hd7aa0aa8739844f3a6e82b60bb2a24193.png_100x100xz.png', 2, 37, 0);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL,
  `incoming_msg_id` int(255) NOT NULL,
  `outgoing_msg_id` int(255) NOT NULL,
  `msg` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`msg_id`, `incoming_msg_id`, `outgoing_msg_id`, `msg`) VALUES
(260, 1663262743, 1445123520, '<a href=\'../user/item_info.php?id=83\'><img src=\'../../SWAP-ITEMS/user/test/6486f06549eb2_114_339279061.jpg\' width=\'70\'></a>is This item available?'),
(261, 1445123520, 1663262743, 'yes'),
(262, 1663262743, 1445123520, '<a href=\'../user/item_info.php?id=91\'><img src=\'../../SWAP-ITEMS/user/test/648f02704d075_6486f3af2a33f_f252b4be-e16c-4e34-a9c0-35169a9bb763.png\' width=\'70\'></a>I am Offering this item!'),
(263, 1445123520, 1663262743, 'No i want more '),
(264, 1445123520, 550916432, '<a href=\'../user/item_info.php?id=90\'><img src=\'../../SWAP-ITEMS/user/test/648e589badd11_Screenshot 2023-06-18 020519.jpg\' width=\'70\'></a>is This item available?'),
(265, 1445123520, 550916432, 'hi'),
(266, 1445123520, 550916432, '<a href=\'../user/item_info.php?id=92\'><img src=\'../../SWAP-ITEMS/user/test/6490b2da73e18_6486f0654b034_114_1118894329.jpg\' width=\'70\'></a>I am Offering this item!'),
(267, 753742566, 1149546953, 'ezez'),
(268, 550916432, 768511021, 'salam'),
(269, 768511021, 1445123520, 'salam'),
(270, 1445123520, 768511021, 'salam'),
(271, 768511021, 1445123520, 'salam'),
(272, 768511021, 1445123520, 'salam'),
(273, 1445123520, 1663262743, 'salam'),
(274, 1663262743, 1445123520, 'salam'),
(275, 1663262743, 1445123520, '<a href=\'../user/item_info.php?id=84\'><img src=\'../../SWAP-ITEMS/user/test/6486f22a98923_51Bq4hiZQVL._AC_SX466_.jpg\' width=\'70\'></a>is This item available?'),
(276, 1445123520, 1663262743, 'yes$');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `id` int(11) NOT NULL,
  `id_item` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `report_text` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`id`, `id_item`, `id_user`, `report_text`) VALUES
(6, 87, 37, 'walo\r\n'),
(7, 84, 42, 'cafe'),
(12, 91, 38, 'gfgrt');

-- --------------------------------------------------------

--
-- Table structure for table `usertable`
--

CREATE TABLE `usertable` (
  `id` int(11) NOT NULL,
  `unique_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `code` mediumint(50) NOT NULL,
  `status_o_f` varchar(255) NOT NULL,
  `status` text NOT NULL,
  `img` varchar(255) NOT NULL DEFAULT 'test/0.png',
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(1000) DEFAULT NULL,
  `postcode` varchar(15) DEFAULT '73000',
  `city` varchar(250) NOT NULL DEFAULT 'Dakhla',
  `admin` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usertable`
--

INSERT INTO `usertable` (`id`, `unique_id`, `name`, `email`, `password`, `code`, `status_o_f`, `status`, `img`, `phone`, `address`, `postcode`, `city`, `admin`) VALUES
(37, 1445123520, 'Youssef Bindou', 'admin@gmail.com', '$2y$10$yATElX.rCQqjSnKIVgAIee9LNmQ8BdxrAA8cmlNVU0auvCOMscMwy', 0, 'Active now', 'verified', 'test/james-person-1.jpg', '+212625203733', 'hay hassani Nr1009 Dakhla', '73000', 'Jdida', 1),
(38, 1663262743, 'chadi ', 'c@gmail.com', '$2y$10$HsNo2AL2W5OdNY.axv7l/.7/j1dPEyY3LOKuPVuHl6WxMHbO5p7ta', 0, 'Active now', 'verified', 'test/0014983_400.jpg', '0625203733', '', '73000', 'Dakhla', 0),
(39, 1465902209, 'layla', 'aa@gmail.com', '$2y$10$JF5adSfRek1ckJIpYVnuOuGhfIck2XtYflvYctnoiZEze9dG7mzty', 0, 'Offline now', 'verified', 'test/Kayla-Person.jpg', '', '', '73000', 'Dakhla', 1),
(42, 753742566, 'abdo', 'nn@gmail.com', '$2y$10$ud5jzX4/cWirpzPNqun6Ou2Gwg9gsydZqF3jKL09tNk8LmsKPc8Xy', 0, 'Offline now', 'verified', 'test/0.png', NULL, NULL, '73000', 'Dakhla', 0),
(44, 550916432, 'omar', 'elbouazzaoui@gmail.com', '$2y$10$IhkojhkYrXo3oo4ZoKuX7uEn2qc.ofUxNdyUmkrud31o2nioM.S/O', 0, 'Offline now', 'verified', 'test/0.png', NULL, NULL, '73000', 'Dakhla', 0),
(48, 768511021, 'hatim', 'hatim@gmail.com', '$2y$10$AqyNvfKTvNx4CXdoYulxHuuaRpiwL4m6icYnxiAr7B66RH.OXybri', 0, 'Offline now', 'verified', 'test/0.png', NULL, NULL, '73000', 'Dakhla', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id_cat`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `dd` (`id_user`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_item` (`id_item`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `usertable`
--
ALTER TABLE `usertable`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id_cat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=277;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `usertable`
--
ALTER TABLE `usertable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `dd` FOREIGN KEY (`id_user`) REFERENCES `usertable` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `report_ibfk_1` FOREIGN KEY (`id_item`) REFERENCES `item` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `report_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `usertable` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
