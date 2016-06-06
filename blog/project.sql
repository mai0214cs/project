-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2016 at 04:36 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) NOT NULL,
  `isperson` enum('No','Yes') NOT NULL DEFAULT 'Yes',
  `company` varchar(250) NOT NULL,
  `gender` enum('female','male') NOT NULL DEFAULT 'male',
  `fullname` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(250) NOT NULL,
  `list_address` text NOT NULL,
  `town` bigint(20) NOT NULL,
  `district` bigint(20) NOT NULL,
  `province` bigint(20) NOT NULL,
  `status` enum('No','Yes') NOT NULL DEFAULT 'Yes',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `detail_attributes`
--

CREATE TABLE `detail_attributes` (
  `id` bigint(20) NOT NULL,
  `id_list` bigint(20) NOT NULL,
  `id_product` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `field_data`
--

CREATE TABLE `field_data` (
  `id` bigint(20) NOT NULL,
  `id_page` bigint(20) NOT NULL,
  `name` varchar(250) NOT NULL,
  `values` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `group_attributes`
--

CREATE TABLE `group_attributes` (
  `id` bigint(20) NOT NULL,
  `name` varchar(250) NOT NULL,
  `type` enum('purpose','material','origin','color','shape','size','quality') NOT NULL DEFAULT 'color',
  `order` int(11) NOT NULL DEFAULT '999',
  `status` enum('hide','show') NOT NULL DEFAULT 'show'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `invoice_number` varchar(20) NOT NULL,
  `id_order` bigint(20) NOT NULL,
  `status` int(11) NOT NULL,
  `invoice_date` datetime NOT NULL,
  `invoice_details` text NOT NULL,
  `id_payment` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_status_ref`
--

CREATE TABLE `invoice_status_ref` (
  `id` int(11) NOT NULL,
  `invoice_name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `invoice_status_ref`
--

INSERT INTO `invoice_status_ref` (`id`, `invoice_name`) VALUES
(1, 'Đã thanh toán'),
(2, 'Chưa thanh toán');

-- --------------------------------------------------------

--
-- Table structure for table `list_attributes`
--

CREATE TABLE `list_attributes` (
  `id` bigint(20) NOT NULL,
  `id_group` bigint(20) NOT NULL DEFAULT '0',
  `name` varchar(250) NOT NULL,
  `order` int(11) NOT NULL DEFAULT '999',
  `status` enum('hide','show') NOT NULL DEFAULT 'show',
  `plus_price` double NOT NULL DEFAULT '0',
  `type_plus_price` enum('percent','quantity') NOT NULL DEFAULT 'quantity',
  `config` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) NOT NULL,
  `id_customer` bigint(20) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `date` datetime NOT NULL,
  `details` text NOT NULL,
  `id_payment` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) NOT NULL,
  `id_product` bigint(20) NOT NULL,
  `id_order` bigint(20) NOT NULL,
  `status` int(11) NOT NULL,
  `quantity` bigint(20) NOT NULL,
  `price` bigint(20) NOT NULL,
  `details` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `order_item_status_ref`
--

CREATE TABLE `order_item_status_ref` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_item_status_ref`
--

INSERT INTO `order_item_status_ref` (`id`, `name`) VALUES
(1, 'Hết hàng'),
(2, 'Dừng bán'),
(3, 'Hoàn thành');

-- --------------------------------------------------------

--
-- Table structure for table `order_status_ref`
--

CREATE TABLE `order_status_ref` (
  `id` int(20) NOT NULL,
  `name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_status_ref`
--

INSERT INTO `order_status_ref` (`id`, `name`) VALUES
(1, 'Chờ xử lý'),
(2, 'Chờ nhận hàng'),
(3, 'Đã hoàn thành'),
(4, 'Hủy đơn hàng');

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE `page` (
  `id` bigint(20) NOT NULL,
  `title` varchar(300) NOT NULL,
  `description` text NOT NULL,
  `detail` longtext NOT NULL,
  `id_page` bigint(20) NOT NULL,
  `avatar` varchar(250) NOT NULL,
  `SEO_title` varchar(250) NOT NULL,
  `SEO_description` varchar(250) NOT NULL,
  `SEO_keyword` varchar(250) NOT NULL,
  `status` enum('No','Yes') NOT NULL DEFAULT 'Yes',
  `orderby` int(11) NOT NULL DEFAULT '999',
  `related` text NOT NULL,
  `type` enum('home','news_category','news_list','product_category','product_list') NOT NULL,
  `alias` varchar(300) NOT NULL,
  `updated_at` date NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`id`, `title`, `description`, `detail`, `id_page`, `avatar`, `SEO_title`, `SEO_description`, `SEO_keyword`, `status`, `orderby`, `related`, `type`, `alias`, `updated_at`, `created_at`) VALUES
(7, 'sdcasfsdghfgghdfes', '', '', 0, '/lib/image.png', '', '', '', 'Yes', 999, '', 'product_category', 'sdcasfsdghfgghdfes', '2016-06-03', '2016-06-03'),
(8, 'gdfgertetwetwegbfgbdfgrdge', '', '', 0, '/lib/image.png', '', '', '', 'Yes', 999, '', 'product_category', 'gdfgertetwetwegbfgbdfgrdge', '2016-06-03', '2016-06-03'),
(9, 'dfgdfgsdtertwetwetdfbdfge', '', '', 0, '/lib/image.png', '', '', '', 'Yes', 999, '', 'product_category', 'dfgdfgsdtertwetwetdfbdfge', '2016-06-03', '2016-06-03'),
(10, 'sdgdasebvrgfd', '', '', 0, '/lib/image.png', '', '', '', 'Yes', 999, '', 'product_category', 'sdgdasebvrgfd', '2016-06-03', '2016-06-03'),
(11, 'sdfsdfsdfs', '', '', 0, '/lib/image.png', '', '', '', 'Yes', 999, '', 'news_category', 'sfsdfsfs', '2016-06-03', '2016-06-03');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `config` text NOT NULL,
  `status` enum('Yes','No') NOT NULL DEFAULT 'No',
  `orderby` int(11) NOT NULL DEFAULT '999'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) NOT NULL,
  `price_import` bigint(20) NOT NULL,
  `price_sale` bigint(20) NOT NULL,
  `price_promotion` bigint(20) NOT NULL,
  `included_VAT` enum('No','Yes') NOT NULL DEFAULT 'No',
  `quantity` bigint(20) NOT NULL DEFAULT '999',
  `manager_inventory` enum('No','Yes') NOT NULL DEFAULT 'No',
  `id_page` bigint(20) NOT NULL,
  `new` enum('Yes','No') NOT NULL DEFAULT 'Yes',
  `seller` enum('Yes','No') NOT NULL DEFAULT 'Yes',
  `promotion` enum('Yes','No') NOT NULL DEFAULT 'Yes',
  `featured` enum('Yes','No') NOT NULL DEFAULT 'Yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shipments`
--

CREATE TABLE `shipments` (
  `id` bigint(20) NOT NULL,
  `id_order` bigint(20) NOT NULL,
  `invoice_number` varchar(20) NOT NULL,
  `shipment_tracking_number` varchar(20) NOT NULL,
  `shipment_date` datetime NOT NULL,
  `shipment_details` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shipment_ref`
--

CREATE TABLE `shipment_ref` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `email` varchar(250) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  `name` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `remember_token` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `created_at`, `updated_at`, `name`, `password`, `remember_token`) VALUES
(1, 'mai0214cs@gmail.com', '2016-06-02', '2016-06-02', 'admin', '$2y$10$aIqX7V5p/Qqa7zVEdl9xbOtcnW4ga9mWKTdSAB095oSu/Ux8dxxM.', ''),
(2, 'mai0214cs.baicakhonggian@gmail.com', '2016-06-02', '2016-06-02', 'maihoamai', '$2y$10$D1.JN8GR2WnTu9WM7Gs2seEOcuII1Qi9qk2v5xJYQVfvOLE4u7hTC', ''),
(3, 'mai0214cs@yahoo.com', '2016-06-03', '2016-06-03', 'Mai DUc Thach', '$2y$10$t1ZYRf1UOcX.H.DOvC3L9uFDtmv8WYqKXCJjDaPkiRKnH//z0C6VO', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_attributes`
--
ALTER TABLE `detail_attributes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Reference_list_attribute` (`id_list`),
  ADD KEY `Reference_list_product` (`id_product`);

--
-- Indexes for table `field_data`
--
ALTER TABLE `field_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group_attributes`
--
ALTER TABLE `group_attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`invoice_number`),
  ADD KEY `id_payment` (`id_payment`),
  ADD KEY `status` (`status`),
  ADD KEY `id_order` (`id_order`);

--
-- Indexes for table `invoice_status_ref`
--
ALTER TABLE `invoice_status_ref`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `list_attributes`
--
ALTER TABLE `list_attributes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Reference_group_attribute` (`id_group`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Reference_Payment` (`id_payment`),
  ADD KEY `Reference_Order_Status` (`status`),
  ADD KEY `Reference_Customer` (`id_customer`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Reference_Product_Order_Item` (`id_product`),
  ADD KEY `Reference_Order_Item` (`id_order`),
  ADD KEY `Reference_Status_Order_Item` (`status`);

--
-- Indexes for table `order_item_status_ref`
--
ALTER TABLE `order_item_status_ref`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_status_ref`
--
ALTER TABLE `order_status_ref`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipments`
--
ALTER TABLE `shipments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Reference_Order_Shipment` (`id_order`),
  ADD KEY `Reference_Shipment_Invoice` (`invoice_number`),
  ADD KEY `Reference_Status_Shipment` (`status`);

--
-- Indexes for table `shipment_ref`
--
ALTER TABLE `shipment_ref`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `detail_attributes`
--
ALTER TABLE `detail_attributes`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `field_data`
--
ALTER TABLE `field_data`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `group_attributes`
--
ALTER TABLE `group_attributes`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `invoice_status_ref`
--
ALTER TABLE `invoice_status_ref`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `list_attributes`
--
ALTER TABLE `list_attributes`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `order_item_status_ref`
--
ALTER TABLE `order_item_status_ref`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `order_status_ref`
--
ALTER TABLE `order_status_ref`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `page`
--
ALTER TABLE `page`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `shipments`
--
ALTER TABLE `shipments`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `shipment_ref`
--
ALTER TABLE `shipment_ref`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_attributes`
--
ALTER TABLE `detail_attributes`
  ADD CONSTRAINT `Reference_list_attribute` FOREIGN KEY (`id_list`) REFERENCES `list_attributes` (`id`),
  ADD CONSTRAINT `Reference_list_product` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`);

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `Reference_Order` FOREIGN KEY (`id_order`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `Reference_Payment_Invoice` FOREIGN KEY (`id_payment`) REFERENCES `payments` (`id`),
  ADD CONSTRAINT `Reference_Status_Invoice` FOREIGN KEY (`status`) REFERENCES `invoice_status_ref` (`id`);

--
-- Constraints for table `list_attributes`
--
ALTER TABLE `list_attributes`
  ADD CONSTRAINT `Reference_group_attribute` FOREIGN KEY (`id_group`) REFERENCES `group_attributes` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `Reference_Customer` FOREIGN KEY (`id_customer`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `Reference_Order_Status` FOREIGN KEY (`status`) REFERENCES `order_status_ref` (`id`),
  ADD CONSTRAINT `Reference_Payment` FOREIGN KEY (`id_payment`) REFERENCES `payments` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `Reference_Order_Item` FOREIGN KEY (`id_order`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `Reference_Product_Order_Item` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `Reference_Status_Order_Item` FOREIGN KEY (`status`) REFERENCES `order_item_status_ref` (`id`);

--
-- Constraints for table `shipments`
--
ALTER TABLE `shipments`
  ADD CONSTRAINT `Reference_Order_Shipment` FOREIGN KEY (`id_order`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `Reference_Shipment_Invoice` FOREIGN KEY (`invoice_number`) REFERENCES `invoices` (`invoice_number`),
  ADD CONSTRAINT `Reference_Status_Shipment` FOREIGN KEY (`status`) REFERENCES `shipment_ref` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
