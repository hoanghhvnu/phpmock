-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 24, 2014 at 05:43 PM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mockphp`
--

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
(1, 'Dell Inc'),
(2, 'Samsung'),
(5, 'Sharp'),
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`cate_id`, `cate_name`, `cate_parent`, `cate_order`) VALUES
(19, 'Smart phone', 0, 0),
(20, 'Feature phone', 0, 0),
(21, 'Special phone', 0, 0),
(24, 'HTC', 19, 0),
(25, 'Nesus', 0, 0),
(26, 'Galaxy S', 19, 0),
(27, 'Galaxy tab', 19, 0),
(29, 'HTC one X', 24, 0),
(32, 'Mobiado', 21, 0),
(33, 'Apple', 19, 0),
(34, 'Iphone 4s', 33, 0),
(35, 'hsfal', 21, 4);

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
(1, 1, 0),
(19, 43, 1),
(19, 44, 1),
(19, 46, 1),
(21, 45, 1),
(23, 44, 1),
(24, 21, 1),
(24, 22, 1),
(29, 21, 1),
(29, 22, 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_comment`
--


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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `tbl_images`
--

INSERT INTO `tbl_images` (`img_id`, `img_name`, `img_title`, `img_status`, `pro_id`) VALUES
(7, '12game.jpg', '', 1, 21),
(9, 'images.jpg', '', 1, 22),
(10, '12game.jpg', '', 1, 43),
(11, '12game.jpg', '', 1, 44);

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
  `cus_gender` tinyint(1) NOT NULL DEFAULT '1',
  `order_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `order_status` tinyint(4) NOT NULL DEFAULT '2',
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`order_id`, `cus_name`, `cus_email`, `cus_phone`, `cus_address`, `cus_gender`, `order_date`, `order_status`) VALUES
(1, 'HoangHH', 'hoanghh@smartosc.com', 987898098, 'Cau Giay', 1, '0000-00-00 00:00:00', 1),
(2, 'HoangHH', 'hoanghh@smartosc.com', 987898098, 'Cau Giay', 1, '2014-07-24 09:17:16', 1),
(3, 'DucTM', 'ductm@smartosc.com', 978989098, 'Cau giay', 1, '2014-07-24 10:56:52', 1),
(4, 'DucTM', 'ductm@smartosc.com', 978989098, 'Cau giay', 1, '2014-07-24 15:37:40', 1),
(7, 'DucTM', 'ductm@smartosc.com', 978989098, 'Cau giay', 1, '2014-07-24 16:25:47', 2),
(8, 'DucTM', 'ductm@smartosc.com', 978989098, 'Cau giay', 1, '2014-07-24 16:25:48', 1),
(9, 'DucTM', 'ductm@smartosc.com', 978989098, 'Cau giay', 1, '2014-07-24 16:26:16', 2),
(10, 'DucTM', 'ductm@smartosc.com', 978989098, 'Cau giay', 1, '2014-07-24 16:26:21', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_orderdetail`
--

CREATE TABLE IF NOT EXISTS `tbl_orderdetail` (
  `orderdetail_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pro_id` int(10) NOT NULL,
  `pro_name` varchar(255) NOT NULL,
  `pro_price` float NOT NULL,
  `pro_quantity` int(10) NOT NULL,
  `order_id` int(10) NOT NULL,
  PRIMARY KEY (`orderdetail_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `tbl_orderdetail`
--

INSERT INTO `tbl_orderdetail` (`orderdetail_id`, `pro_id`, `pro_name`, `pro_price`, `pro_quantity`, `order_id`) VALUES
(2, 18, 'Samsung galaxy s2', 700, 2, 1),
(3, 22, 'HTC One X aonu', 400, 2, 1),
(4, 44, 'HTC One X aonueu', 500, 2, 2),
(5, 44, 'HTC One X aonueu', 500, 2, 3),
(6, 22, 'HTC One X aonu', 500, 2, 3),
(7, 18, 'Samsung galaxy s2', 500, 2, 3),
(8, 22, 'HTC One X aonu', 500, 2, 4),
(9, 18, 'Samsung galaxy s2', 500, 2, 5),
(10, 22, 'HTC One X aonu', 500, 2, 4),
(11, 22, 'HTC One X aonu', 500, 2, 6),
(12, 18, 'Samsung galaxy s2', 500, 2, 7),
(13, 18, 'Samsung galaxy s2', 500, 2, 8),
(14, 22, 'HTC One X aonu', 500, 2, 9),
(15, 22, 'HTC One X aonu', 500, 2, 10);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=47 ;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`pro_id`, `pro_name`, `pro_price`, `pro_price_sale`, `pro_images`, `pro_desc`, `pro_info`, `pro_status`, `bran_id`, `country_id`, `pro_quantity`) VALUES
(18, 'Samsung galaxy s2', 800, 299, '1723398_436963906450335_497667250_n.jpg', 'dien thoai iphone', 'smartphone', 1, 2, 2, 100),
(21, 'HTC One Xh', 800, 299, 'Alone_One.jpg', 'dien thoai iphone', 'smartphone', 1, 1, 1, 100),
(22, 'HTC One X aonu', 800, 299, 'aou.jpg', 'dien thoai iphone', 'smartphone', 1, 2, 1, 100),
(43, 'Experia', 900, 903, '12game.jpg', 'oaeaoue', 'aouaouao', 1, 9, 1, 111),
(44, 'HTC One X aonueu', 800, 299, '1723398_436963906450335_497667250_n.jpg', '.u,u,', ',u.,eu,e', 1, 1, 1, 100),
(45, 'oiaoioaioa', 4523, 52352, '12game.jpg', 'eiaoei', 'oaiaoiao', 1, 2, 1, 3452),
(46, 'aoioaioai', 111, 111, '12game.jpg', 'eoaou', 'aouaoua', 1, 1, 1, 1212121);

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

--
-- Dumping data for table `tbl_slide`
--


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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`usr_id`, `usr_name`, `usr_password`, `usr_email`, `usr_address`, `usr_phone`, `usr_level`, `usr_gender`) VALUES
(1, 'HoangHH', '123456', 'hoanghh@smartosc.com', 'Cau Giay', '0949393498', '1', 1),
(2, 'DucTM', '909090', 'ductm@smartosc.com', 'Hanoi', '0943980098', '2', 1),
(3, 'VietDQ', 'dddhhh', 'vietdq@smartosc.com', 'Ha Noi', '0934909493', '1', 1),
(4, 'KhoiPK', '999999', 'khoipk@smartosc.com', 'Vinh Phuc', '0943729099', '2', 1),
(15, 'Phan van A', 'dddddd', 'phanan@gmail.com', 'Cau giay', '0949393498', '1', 1),
(19, 'LaVanDang', 'aaaaaa', 'aoseunsao@gmail.com', 'oasutao', '0943729099', '2', 1),
(20, 'ChiPheo', 'hhhhhh', 'osaeu@gmail.com', 'otneuhsaotusao', '0934909493', '2', 2);
