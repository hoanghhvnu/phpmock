-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 01, 2014 at 09:01 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mockphp`
--

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE IF NOT EXISTS `slider` (
  `pro_id` int(10) NOT NULL DEFAULT '0',
  `pro_images` varchar(255) DEFAULT NULL,
  `slide_order` int(10) DEFAULT NULL,
  PRIMARY KEY (`pro_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`pro_id`, `pro_images`, `slide_order`) VALUES
(18, 'lumia1020.jpg', 1),
(22, 'iphone5s.jpg', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bran`
--

CREATE TABLE IF NOT EXISTS `tbl_bran` (
  `bran_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `bran_name` varchar(200) NOT NULL,
  PRIMARY KEY (`bran_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tbl_bran`
--

INSERT INTO `tbl_bran` (`bran_id`, `bran_name`) VALUES
(1, 'samsung'),
(5, 'Sharp'),
(6, 'Dell'),
(7, 'Asus'),
(8, 'Acer'),
(9, 'Sony'),
(10, 'HTC');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE IF NOT EXISTS `tbl_category` (
  `cate_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cate_name` varchar(50) NOT NULL,
  `cate_parent` int(10) NOT NULL DEFAULT '0',
  `cate_order` int(5) NOT NULL,
  PRIMARY KEY (`cate_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=57 ;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`cate_id`, `cate_name`, `cate_parent`, `cate_order`) VALUES
(33, 'Smartphone', 0, 0),
(34, 'Mobile', 0, 0),
(35, 'May tinh bang', 0, 0),
(36, 'Laptop', 0, 0),
(37, 'Sam Sung', 33, 1),
(38, 'Nokia', 33, 1),
(39, 'Apple', 33, 1),
(40, 'HTC', 33, 1),
(41, 'Sam Sung', 34, 0),
(42, 'Nokia', 34, 0),
(43, 'Motorona', 35, 1),
(45, 'Dell', 36, 1),
(46, 'Sony', 36, 1),
(47, 'Asus', 36, 1),
(48, 'Acer', 36, 1),
(49, 'SS Trend Lite', 37, 2),
(50, 'SS Galaxy Y', 37, 0),
(51, 'Sam Sung Tab 3', 37, 0),
(52, 'SS Galaxy V', 37, 0),
(53, 'Hitech', 35, 1),
(54, 'SunPhone', 35, 1),
(55, 'FPT', 46, 2),
(56, 'VietTel', 46, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cateproduct`
--

CREATE TABLE IF NOT EXISTS `tbl_cateproduct` (
  `cate_id` int(10) NOT NULL,
  `pro_id` int(10) NOT NULL,
  `catepro_order` int(3) NOT NULL,
  PRIMARY KEY (`cate_id`,`pro_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_cateproduct`
--

INSERT INTO `tbl_cateproduct` (`cate_id`, `pro_id`, `catepro_order`) VALUES
(33, 47, 1),
(33, 48, 1),
(33, 49, 1),
(33, 50, 1),
(33, 51, 1),
(34, 1, 0),
(34, 23, 1),
(34, 48, 1),
(34, 50, 1),
(34, 51, 1),
(35, 23, 1),
(35, 44, 1),
(35, 45, 1),
(35, 46, 1),
(35, 49, 1),
(36, 18, 1),
(36, 45, 1),
(36, 52, 1),
(37, 18, 1),
(37, 23, 1),
(38, 18, 1),
(38, 44, 1),
(38, 46, 1),
(38, 47, 1),
(39, 18, 1),
(39, 23, 1),
(40, 23, 1),
(41, 23, 1),
(42, 23, 1),
(45, 23, 1),
(46, 23, 1),
(48, 52, 0),
(50, 23, 1),
(52, 23, 1),
(53, 23, 1),
(54, 23, 1),
(56, 23, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_comment`
--

CREATE TABLE IF NOT EXISTS `tbl_comment` (
  `com_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `com_author` varchar(50) NOT NULL,
  `com_email` varchar(50) NOT NULL,
  `com_content` text NOT NULL,
  `com_score` float NOT NULL,
  `com_status` tinyint(1) NOT NULL,
  `pro_id` int(10) NOT NULL,
  PRIMARY KEY (`com_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_comment`
--

INSERT INTO `tbl_comment` (`com_id`, `com_author`, `com_email`, `com_content`, `com_score`, `com_status`, `pro_id`) VALUES
(1, 'Long', 'longhtc@amail.com', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 7, 1, 18),
(2, 'Huan', 'huandt@gmail.com', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 3, 1, 18),
(3, 'Ha', 'ha@gmail.com', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, 0, 18),
(4, 'Kha', 'kha@bamail.com', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, 1, 18);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_country`
--

CREATE TABLE IF NOT EXISTS `tbl_country` (
  `coun_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `coun_name` varchar(50) NOT NULL,
  PRIMARY KEY (`coun_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_country`
--

INSERT INTO `tbl_country` (`coun_id`, `coun_name`) VALUES
(1, 'Viet Nam'),
(2, 'Han Quoc'),
(3, 'Nhat Ban');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_images`
--

CREATE TABLE IF NOT EXISTS `tbl_images` (
  `img_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `img_name` varchar(50) NOT NULL,
  `img_title` varchar(200) NOT NULL,
  `img_status` tinyint(1) NOT NULL DEFAULT '1',
  `pro_id` int(10) NOT NULL,
  PRIMARY KEY (`img_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_images`
--

INSERT INTO `tbl_images` (`img_id`, `img_name`, `img_title`, `img_status`, `pro_id`) VALUES
(1, 'laptop1tn.jpg', '', 1, 18),
(2, 'laptop2tn.jpg', '', 1, 18),
(3, 'laptop3tn.jpg', '', 1, 18),
(4, 'laptop4tn.jpg', '', 1, 18);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE IF NOT EXISTS `tbl_order` (
  `order_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cus_name` varchar(50) NOT NULL,
  `cus_email` varchar(50) NOT NULL,
  `cus_phone` int(15) NOT NULL,
  `cus_address` varchar(200) NOT NULL,
  `create_date` datetime NOT NULL,
  `order_status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_orderdetail`
--

CREATE TABLE IF NOT EXISTS `tbl_orderdetail` (
  `orderdetail_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pro_name` varchar(200) NOT NULL,
  `pro_price` float NOT NULL,
  `pro_number` int(10) NOT NULL,
  `order_id` int(10) NOT NULL,
  PRIMARY KEY (`orderdetail_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE IF NOT EXISTS `tbl_product` (
  `pro_id` int(10) NOT NULL AUTO_INCREMENT,
  `pro_name` varchar(200) NOT NULL,
  `pro_price` float NOT NULL,
  `pro_price_sale` float NOT NULL,
  `pro_images` varchar(255) NOT NULL,
  `pro_desc` text NOT NULL,
  `pro_info` text NOT NULL,
  `pro_status` tinyint(1) NOT NULL DEFAULT '0',
  `bran_id` int(10) unsigned NOT NULL,
  `country_id` int(10) unsigned NOT NULL,
  `pro_quantity` int(11) NOT NULL DEFAULT '100',
  PRIMARY KEY (`pro_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=53 ;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`pro_id`, `pro_name`, `pro_price`, `pro_price_sale`, `pro_images`, `pro_desc`, `pro_info`, `pro_status`, `bran_id`, `country_id`, `pro_quantity`) VALUES
(18, 'Samsung galaxy s2', 800, 299, 'laptop4.jpg', 'dien thoai iphone', 'smartphone', 1, 1, 1, 100),
(21, 'HTC One X', 800, 299, 'aou.jpg', 'dien thoai iphone', 'smartphone', 1, 1, 1, 100),
(22, 'HTC One X', 800, 299, 'aou.jpg', 'dien thoai iphone', 'smartphone', 1, 1, 1, 100),
(23, 'Nokia 9888', 800, 299, 'aou.jpg', 'dien thoai iphone', 'smartphone', 1, 1, 1, 100),
(24, 'HTC One X', 800, 299, 'aou.jpg', 'dien thoai iphone', 'smartphone', 1, 1, 1, 100),
(26, 'HTC One X', 800, 299, 'aou.jpg', 'dien thoai iphone', 'smartphone', 1, 1, 1, 100),
(27, 'HTC One X', 800, 299, 'aou.jpg', 'dien thoai iphone', 'smartphone', 1, 1, 1, 100),
(28, 'HTC One X', 800, 299, 'aou.jpg', 'dien thoai iphone', 'smartphone', 1, 1, 1, 100),
(29, 'HTC One X', 800, 299, 'aou.jpg', 'dien thoai iphone', 'smartphone', 1, 1, 1, 100),
(30, 'HTC One X', 800, 299, 'aou.jpg', 'dien thoai iphone', 'smartphone', 1, 1, 1, 100),
(31, 'HTC One X', 800, 299, 'aou.jpg', 'dien thoai iphone', 'smartphone', 1, 1, 1, 100),
(32, 'HTC One X', 800, 299, 'aou.jpg', 'dien thoai iphone', 'smartphone', 1, 1, 1, 100),
(33, 'HTC One X', 800, 299, 'aou.jpg', 'dien thoai iphone', 'smartphone', 1, 1, 1, 100),
(34, 'HTC One X', 800, 299, 'aou.jpg', 'dien thoai iphone', 'smartphone', 1, 1, 1, 100),
(35, 'HTC One X', 800, 299, 'aou.jpg', 'dien thoai iphone', 'smartphone', 1, 1, 1, 100),
(36, 'HTC One X', 800, 299, 'aou.jpg', 'dien thoai iphone', 'smartphone', 1, 1, 1, 100),
(37, 'HTC One X', 800, 299, 'aou.jpg', 'dien thoai iphone', 'smartphone', 1, 1, 1, 100),
(38, 'HTC One X', 800, 299, 'aou.jpg', 'dien thoai iphone', 'smartphone', 1, 1, 1, 100),
(39, 'HTC One X', 800, 299, 'aou.jpg', 'dien thoai iphone', 'smartphone', 1, 1, 1, 100),
(40, 'HTC One X', 800, 299, 'aou.jpg', 'dien thoai iphone', 'smartphone', 1, 1, 1, 100),
(41, 'HTC One X', 800, 299, 'aou.jpg', 'dien thoai iphone', 'smartphone', 1, 1, 1, 100),
(42, 'HTC One X', 800, 299, 'aou.jpg', 'dien thoai iphone', 'smartphone', 1, 2, 1, 100),
(43, 'SamSung Galaxy Yd', 45.99, 43.77, 'Hydrangeas.jpg', 'dsfsdf', 'sdfsdf', 1, 1, 1, 100),
(44, 'SamSung Galaxy Ydsfsdf', 45.99, 43.77, 'Hydrangeas.jpg', 'sdfsdf', 'sdfsdfd', 1, 1, 1, 100),
(45, 'nolkia 1200', 2.99, 2.98, 'Penguins.jpg', 'dfefw', 'wrw', 1, 5, 1, 100),
(46, 'Samsung galaxy s2ss', 45.99, 43.77, 'Hydrangeas.jpg', 'sdcds', 'cdscsd', 1, 1, 1, 100),
(47, 'Samsung galaxy s222', 45.99, 43.77, 'Hydrangeas.jpg', 'sdcsdc', 'sdfdsd', 1, 1, 1, 100),
(48, 'Nokia 1200w', 2.99, 2.98, 'Penguins.jpg', 'wqq', 'wqeq', 1, 2, 2, 100),
(49, 'SamSung Galaxy Y', 2.99, 2.98, 'Penguins.jpg', 'sgsgaa', 'weww', 1, 2, 3, 100),
(50, 'Iphone 90S', 45.99, 43.77, 'Jellyfish.jpg', 'Chiec dien thoai doi moi', 'Rat dep', 1, 10, 1, 2),
(51, 'Iphone 90Ss', 45.99, 43.77, 'image7.jpg', 'ddad', 'sdad', 1, 5, 2, 100),
(52, 'hohdhadh', 300, 200, 'image.jpg', 'dfd', 'dfdfs', 1, 1, 1, 100);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_slide`
--

CREATE TABLE IF NOT EXISTS `tbl_slide` (
  `slide_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `slide_title` varchar(200) NOT NULL,
  `slide_desc` text NOT NULL,
  `slide_name` varchar(255) NOT NULL,
  `slide_order` int(3) NOT NULL,
  `slide_status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`slide_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `usr_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `usr_name` varchar(50) NOT NULL,
  `usr_password` char(50) NOT NULL,
  `usr_email` varchar(100) NOT NULL,
  `usr_address` text NOT NULL,
  `usr_phone` varchar(15) NOT NULL,
  `usr_level` char(1) NOT NULL DEFAULT '1',
  `usr_gender` tinyint(1) NOT NULL,
  PRIMARY KEY (`usr_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`usr_id`, `usr_name`, `usr_password`, `usr_email`, `usr_address`, `usr_phone`, `usr_level`, `usr_gender`) VALUES
(1, 'HoangHH', '123456', 'hoanghh@smartosc.com', 'Cau Giayhn', '0949393498', '1', 1),
(2, 'DucTM', '909090', 'ductm@smartosc.com', 'Hanoi', '0943980098', '2', 1),
(3, 'VietDQ', 'dddhhh', 'vietdq@smartosc.com', 'Ha Noi', '0934909493', '1', 1),
(4, 'KhoiPK', '999999', 'khoipk@smartosc.com', 'Vinh Phuc', '0943729099', '2', 1),
(5, 'otueasaouhs', '123456', 'oanusaoeus@oaeuso', 'noahusao', '0940439', '2', 1),
(6, 'otueasaouhs', '123456', 'oanusaoeus@oaeuso', 'noahusao', '0940439', '2', 1),
(10, 'otueasaouhs', 'uuu', 'hoanghh@smartosc.com', 'Cau Giay', '0940439', '1', 1),
(15, 'Phan van a', 'dddddd', 'phanan@gmail.com', 'Cau giay', '0949393498', '1', 1),
(19, 'LaVanDang', 'aaaaaa', 'aoseunsao@gmail.com', 'oasutao', '0943729099', '2', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
