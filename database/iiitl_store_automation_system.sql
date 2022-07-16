-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2022 at 05:44 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `iiitl_store_automation_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `category_list`
--

CREATE TABLE `category_list` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category_list`
--

INSERT INTO `category_list` (`id`, `name`) VALUES
(10, 'Pens & Highlighters'),
(11, 'Books'),
(12, 'Result'),
(13, 'Notes'),
(14, 'Sancks');

-- --------------------------------------------------------

--
-- Table structure for table `customer_list`
--

CREATE TABLE `customer_list` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `contact` varchar(30) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_list`
--

INSERT INTO `customer_list` (`id`, `name`, `contact`, `address`) VALUES
(1, 'Faculty 1', '123123', 'Dept of CS. IIIT Lucknow'),
(2, 'Staff', '7326274743', 'Dept. Admin'),
(3, 'BKC', '8987865643', 'IIITL');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` int(30) NOT NULL,
  `product_id` int(30) NOT NULL,
  `qty` int(30) NOT NULL,
  `type` tinyint(1) NOT NULL COMMENT '1= stockin , 2 = stockout , 3 = return',
  `stock_from` varchar(100) NOT NULL COMMENT 'sales/receiving/returning',
  `form_id` int(30) NOT NULL,
  `other_details` text NOT NULL,
  `remarks` text NOT NULL,
  `recommended` varchar(200) NOT NULL,
  `approved` varchar(200) NOT NULL,
  `issued` varchar(200) NOT NULL,
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(50) DEFAULT NULL,
  `comment` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `product_id`, `qty`, `type`, `stock_from`, `form_id`, `other_details`, `remarks`, `recommended`, `approved`, `issued`, `date_updated`, `status`, `comment`) VALUES
(436, 25, 10, 1, 'receiving', 61, '{\"price\":\"200\",\"qty\":\"10\"}', 'Stock from Receiving-96801037\n', '', '', '', '2022-05-03 20:45:35', 'Approved', ''),
(437, 26, 10, 1, 'receiving', 61, '{\"price\":\"20\",\"qty\":\"10\"}', 'Stock from Receiving-96801037\n', '', '', '', '2022-05-03 20:45:35', 'Approved', ''),
(438, 25, 20, 1, 'receiving', 62, '{\"price\":\"170\",\"qty\":\"20\"}', 'Stock from Receiving-74876874\n', '', '', '', '2022-05-03 20:45:36', 'Approved', ''),
(440, 25, 2, 2, 'Sales', 302, '{\"qty\":\"2\"}', 'Stock out from Sales-38051987\n', '', '', 'Admin', '2022-05-03 20:46:52', 'Approved', ''),
(442, 32, 10, 1, 'receiving', 63, '{\"price\":\"120\",\"qty\":\"10\"}', 'Stock from Receiving-00000000\n', '', '', '', '2022-05-04 19:45:02', 'Approved', ''),
(443, 32, 2, 2, 'Sales', 304, '{\"qty\":\"2\"}', 'Stock out from Sales-00000000\n', 'nbvbsf', 'vks', 'Admin', '2022-05-04 19:46:43', 'Approved', ''),
(444, 32, 1, 2, 'Sales', 305, '{\"qty\":\"1\"}', 'Stock out from Sales-39566874\n', 'safkjkj', 'kjbsfkj', 'Admin', '2022-05-05 15:09:55', 'Approved', ''),
(445, 32, 1, 2, 'Sales', 306, '{\"qty\":\"1\"}', 'Stock out from Sales-62237460\n', 'asd', 'jbksf', 'Admin', '2022-05-11 16:42:46', 'Approved', ''),
(446, 22, 50, 1, 'receiving', 64, '{\"price\":\"100\",\"qty\":\"50\"}', 'Stock from Receiving-32891607\n', '', '', '', '2022-06-01 13:41:50', 'Approved', ''),
(447, 26, 10, 2, 'Sales', 307, '{\"qty\":\"10\"}', 'Stock out from Sales-27814552\n', '', '', 'Admin', '2022-06-01 13:42:07', 'Approved', '');

-- --------------------------------------------------------

--
-- Table structure for table `issue_requests`
--

CREATE TABLE `issue_requests` (
  `id` int(30) NOT NULL,
  `product` varchar(255) NOT NULL,
  `qty` int(30) NOT NULL,
  `recommended` varchar(255) NOT NULL,
  `approved` varchar(255) NOT NULL,
  `comment` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product_list`
--

CREATE TABLE `product_list` (
  `id` int(30) NOT NULL,
  `product_id` int(30) NOT NULL,
  `category_id` int(30) NOT NULL,
  `name` varchar(150) NOT NULL,
  `mfg_date` date NOT NULL,
  `exp_date` date NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_list`
--

INSERT INTO `product_list` (`id`, `product_id`, `category_id`, `name`, `mfg_date`, `exp_date`, `description`) VALUES
(22, 59614110, 11, 'Algorithm By Vks', '2021-12-11', '2025-12-11', 'Library Room'),
(23, 73348146, 10, 'Pen', '2021-12-11', '2022-12-11', 'Ball Pen'),
(24, 83256187, 11, 'Cloud Computing', '2022-04-19', '2026-04-21', 'Pearson Publication'),
(25, 35318842, 11, 'Computer Network', '2022-04-19', '2025-04-19', 'Pearson Publication'),
(26, 55658256, 10, 'Yellow Marker', '2022-04-19', '2024-04-19', 'Nice !'),
(31, 71264948, 13, 'DSA', '2022-05-02', '2024-10-02', 'For Placement Series'),
(32, 20365406, 13, 'C++', '2022-05-04', '2022-05-11', 'c++ notes'),
(33, 84578789, 14, 'Aloo chips', '2022-06-01', '2024-01-01', 'chips');

-- --------------------------------------------------------

--
-- Table structure for table `receiving_list`
--

CREATE TABLE `receiving_list` (
  `id` int(30) NOT NULL,
  `ref_no` varchar(100) NOT NULL,
  `supplier_id` int(30) NOT NULL,
  `total_amount` double NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `status` varchar(100) DEFAULT NULL COMMENT '1=Approved , 2=Rejected'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `receiving_list`
--

INSERT INTO `receiving_list` (`id`, `ref_no`, `supplier_id`, `total_amount`, `date_added`, `status`) VALUES
(61, '96801037\n', 12, 2200, '2022-05-03 20:44:56', 'Approved'),
(62, '74876874\n', 10, 3400, '2022-05-03 20:45:20', 'Approved'),
(63, '00000000\n', 9, 1200, '2022-05-04 19:44:24', 'Approved'),
(64, '32891607\n', 9, 5000, '2022-06-01 13:39:54', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `requests_status`
--

CREATE TABLE `requests_status` (
  `id` int(10) NOT NULL,
  `ref_no` varchar(100) NOT NULL,
  `customer_id` int(30) NOT NULL,
  `status` varchar(50) DEFAULT NULL COMMENT '1=Approved, 0=Rejected',
  `date_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `requests_status`
--

INSERT INTO `requests_status` (`id`, `ref_no`, `customer_id`, `status`, `date_updated`) VALUES
(0, '[value-3]', 0, '1', '0000-00-00 00:00:00'),
(1, '1', 0, '0', '0000-00-00 00:00:00'),
(76, '[value-3]', 0, '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `sales_list`
--

CREATE TABLE `sales_list` (
  `id` int(30) NOT NULL,
  `ref_no` varchar(100) NOT NULL,
  `customer_id` int(30) NOT NULL,
  `comment` text NOT NULL,
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(50) DEFAULT NULL COMMENT '1=Approved,0=Rejected'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales_list`
--

INSERT INTO `sales_list` (`id`, `ref_no`, `customer_id`, `comment`, `date_updated`, `status`) VALUES
(302, '38051987\n', 1, '', '2022-05-03 20:46:52', 'Approved'),
(304, '00000000\n', 3, 'pls approve!', '2022-05-04 19:46:43', 'Approved'),
(305, '39566874\n', 3, 'sf', '2022-05-05 15:09:55', 'Approved'),
(306, '62237460\n', 3, '', '2022-05-11 16:42:46', 'Approved'),
(307, '27814552\n', 1, '', '2022-06-01 13:42:07', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `supplier_list`
--

CREATE TABLE `supplier_list` (
  `id` int(30) NOT NULL,
  `supplier_name` text NOT NULL,
  `contact` varchar(30) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier_list`
--

INSERT INTO `supplier_list` (`id`, `supplier_name`, `contact`, `address`) VALUES
(9, 'Supplier 1', '123123', 'Gomti nagar'),
(10, 'Supplier 2', '8823897423', 'jjksdfbk'),
(11, 'Supplier 3', '8836682663', 'IIITL \r\n'),
(12, 'Supplier 5', '987654321', 'IIT');

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE `system_settings` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `cover_img` text NOT NULL,
  `about_content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_settings`
--

INSERT INTO `system_settings` (`id`, `name`, `email`, `contact`, `cover_img`, `about_content`) VALUES
(1, 'Online Food Ordering System', 'info@sample.com', '+6948 8542 623', '1600654680_photo-1504674900247-0877df9cc836.jpg', '&lt;p style=&quot;text-align: center; background: transparent; position: relative;&quot;&gt;&lt;span style=&quot;font-size:28px;background: transparent; position: relative;&quot;&gt;ABOUT US&lt;/span&gt;&lt;/b&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;text-align: center; background: transparent; position: relative;&quot;&gt;&lt;span style=&quot;background: transparent; position: relative; font-size: 14px;&quot;&gt;&lt;span style=&quot;font-size:28px;background: transparent; position: relative;&quot;&gt;&lt;b style=&quot;margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; text-align: justify;&quot;&gt;Lorem Ipsum&lt;/b&gt;&lt;span style=&quot;color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-weight: 400; text-align: justify;&quot;&gt;&amp;nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&amp;#x2019;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&lt;/span&gt;&lt;br&gt;&lt;/span&gt;&lt;/b&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;text-align: center; background: transparent; position: relative;&quot;&gt;&lt;span style=&quot;background: transparent; position: relative; font-size: 14px;&quot;&gt;&lt;span style=&quot;font-size:28px;background: transparent; position: relative;&quot;&gt;&lt;span style=&quot;color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-weight: 400; text-align: justify;&quot;&gt;&lt;br&gt;&lt;/span&gt;&lt;/b&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;text-align: center; background: transparent; position: relative;&quot;&gt;&lt;span style=&quot;background: transparent; position: relative; font-size: 14px;&quot;&gt;&lt;span style=&quot;font-size:28px;background: transparent; position: relative;&quot;&gt;&lt;h2 style=&quot;font-size:28px;background: transparent; position: relative;&quot;&gt;Where does it come from?&lt;/h2&gt;&lt;p style=&quot;text-align: center; margin-bottom: 15px; padding: 0px; color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-weight: 400;&quot;&gt;Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.&lt;/p&gt;&lt;/span&gt;&lt;/b&gt;&lt;/span&gt;&lt;/p&gt;');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `name` varchar(200) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 2 COMMENT '1=admin , 2 = cashier'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `type`) VALUES
(1, 'Administrator', 'admin', 'admin123', 1),
(8, 'Staff', 'staff1', 'staff123', 2),
(9, 'vijay', 'vijay', '123', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category_list`
--
ALTER TABLE `category_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_list`
--
ALTER TABLE `customer_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `issue_requests`
--
ALTER TABLE `issue_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_list`
--
ALTER TABLE `product_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receiving_list`
--
ALTER TABLE `receiving_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requests_status`
--
ALTER TABLE `requests_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_list`
--
ALTER TABLE `sales_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier_list`
--
ALTER TABLE `supplier_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_settings`
--
ALTER TABLE `system_settings`
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
-- AUTO_INCREMENT for table `category_list`
--
ALTER TABLE `category_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `customer_list`
--
ALTER TABLE `customer_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=448;

--
-- AUTO_INCREMENT for table `issue_requests`
--
ALTER TABLE `issue_requests`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_list`
--
ALTER TABLE `product_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `receiving_list`
--
ALTER TABLE `receiving_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `sales_list`
--
ALTER TABLE `sales_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=308;

--
-- AUTO_INCREMENT for table `supplier_list`
--
ALTER TABLE `supplier_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `system_settings`
--
ALTER TABLE `system_settings`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
