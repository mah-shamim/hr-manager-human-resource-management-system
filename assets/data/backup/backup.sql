-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 29, 2022 at 07:51 AM
-- Server version: 10.2.44-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `newsoft27_hrm_gmbi2`
--

-- --------------------------------------------------------

--
-- Table structure for table `acc_coa`
--

CREATE TABLE `acc_coa` (
  `id` int(11) NOT NULL,
  `pheadcode` int(11) NOT NULL,
  `HeadCode` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `HeadName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `PHeadName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `HeadLevel` int(11) NOT NULL,
  `IsActive` tinyint(1) NOT NULL,
  `IsTransaction` tinyint(1) NOT NULL,
  `IsGL` tinyint(1) NOT NULL,
  `isCashNature` int(11) NOT NULL DEFAULT 0,
  `isBankNature` int(11) NOT NULL DEFAULT 0,
  `HeadType` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `IsBudget` tinyint(1) NOT NULL,
  `IsDepreciation` tinyint(1) NOT NULL,
  `DepreciationRate` int(11) NOT NULL DEFAULT 0,
  `isSubType` int(11) NOT NULL DEFAULT 0,
  `subType` int(11) NOT NULL DEFAULT 1,
  `isStock` int(11) NOT NULL DEFAULT 0,
  `isFixedAssetSch` int(11) NOT NULL DEFAULT 0,
  `noteNo` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `assetCode` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `depCode` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CreateBy` int(11) NOT NULL,
  `CreateDate` datetime NOT NULL,
  `UpdateBy` int(11) NOT NULL,
  `UpdateDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `acc_coa`
--

INSERT INTO `acc_coa` (`id`, `pheadcode`, `HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `isCashNature`, `isBankNature`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `isSubType`, `subType`, `isStock`, `isFixedAssetSch`, `noteNo`, `assetCode`, `depCode`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES
(8, 502, '50202', 'Accounts Payable', 'Current Liabilities', 3, 1, 0, 1, 0, 0, 'L', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-05-17 12:52:17', 0, '0000-00-00 00:00:00'),
(9, 102, '10202', 'Account Receivable', 'Current Asset', 3, 1, 0, 1, 0, 0, 'A', 0, 0, 0, 0, 1, 0, 0, '', '', '', 1, '2022-04-04 11:00:54', 0, '0000-00-00 00:00:00'),
(10, 0, '1', 'Assets', 'COA', 1, 1, 0, 0, 0, 0, 'A', 0, 0, 0, 0, 1, 0, 0, '', '', '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(13, 102, '10201', 'Cash', 'Current Asset', 3, 1, 0, 0, 0, 0, 'A', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-04-10 12:07:11', 0, '2015-10-15 15:57:55'),
(15, 10201, '1020101', 'Cash In Hand', 'Cash', 4, 1, 1, 1, 1, 0, 'A', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-04-12 08:16:03', 0, '2016-05-23 12:05:43'),
(16, 1, '102', 'Current Asset', 'Assets', 2, 1, 0, 0, 0, 0, 'A', 0, 0, 0, 0, 1, 0, 0, '', '', '', 0, '0000-00-00 00:00:00', 0, '2018-07-07 11:23:00'),
(17, 5, '502', 'Current Liabilities', 'Liabilities', 2, 1, 0, 0, 0, 0, 'L', 0, 0, 0, 0, 1, 0, 0, '', '', '', 0, '2014-08-30 13:18:20', 0, '2015-10-15 19:49:21'),
(19, 10202, '1020202', 'Customer Receivable', 'Account Receivable', 4, 1, 1, 0, 0, 0, 'A', 0, 0, 0, 1, 3, 0, 0, NULL, NULL, NULL, 1, '2022-04-27 10:00:13', 0, '0000-00-00 00:00:00'),
(22, 10202, '1020301', 'Employee Receivable', 'Account Receivable', 4, 1, 1, 0, 0, 0, 'A', 0, 0, 0, 0, 1, 0, 0, '', '', '', 1, '2022-04-04 11:01:32', 0, '2018-07-07 12:31:42'),
(23, 4, '401', 'Cost of Goods Solds', 'Expenses', 2, 1, 1, 1, 0, 0, 'E', 0, 0, 0, 0, 1, 0, 0, '', '', '', 1, '2022-04-02 10:28:34', 0, '0000-00-00 00:00:00'),
(24, 0, '2', 'Shareholder\'s Equity', 'COA', 1, 1, 0, 0, 0, 0, 'L', 0, 0, 0, 0, 1, 0, 0, '', '', '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(25, 0, '4', 'Expenses', 'COA', 1, 1, 0, 0, 0, 0, 'E', 0, 0, 0, 0, 1, 0, 0, '', '', '', 2, '2019-11-24 05:45:24', 0, '0000-00-00 00:00:00'),
(26, 1, '101', 'Fixed Assets', 'Assets', 2, 1, 0, 0, 0, 0, 'A', 0, 0, 0, 0, 1, 0, 0, '', '', '', 0, '0000-00-00 00:00:00', 0, '2015-10-15 15:29:11'),
(27, 4, '402', 'Over Head Cost', 'Expenses', 2, 1, 1, 1, 0, 0, 'E', 0, 0, 0, 0, 1, 0, 0, '', '', '', 1, '2022-04-04 10:01:58', 0, '0000-00-00 00:00:00'),
(29, 0, '3', 'Income', 'COA', 1, 1, 0, 0, 0, 0, 'I', 0, 0, 0, 0, 1, 0, 0, '', '', '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(30, 0, '5', 'Liabilities', 'COA', 1, 1, 0, 0, 0, 0, 'L', 0, 0, 0, 0, 1, 0, 0, '', '', '', 0, '2013-07-04 12:32:07', 0, '2015-10-15 19:46:54'),
(31, 5, '501', 'Long Term Liabilities', 'Liabilities', 2, 1, 0, 0, 0, 0, 'L', 0, 0, 0, 0, 1, 0, 0, '', '', '', 0, '2014-08-30 13:18:20', 0, '2015-10-15 19:49:21'),
(33, 3, '301', 'Direct Income', 'Income', 2, 1, 1, 1, 0, 0, 'I', 0, 0, 0, 0, 1, 0, 0, '', '', '', 1, '2022-04-02 10:31:45', 0, '0000-00-00 00:00:00'),
(35, 3, '302', 'Indirect Income', 'Income', 2, 1, 1, 1, 0, 0, 'I', 0, 0, 0, 0, 1, 0, 0, '', '', '', 1, '2022-04-02 10:55:45', 0, '0000-00-00 00:00:00'),
(36, 50202, '5020201', 'Supplier Payable', 'Accounts Payable', 4, 1, 0, 1, 0, 0, 'L', 0, 0, 0, 1, 4, 0, 0, NULL, NULL, NULL, 1, '2022-05-17 12:52:44', 0, '0000-00-00 00:00:00'),
(41, 102, '10203', 'Prepaid Expenses', 'Current Asset', 3, 1, 0, 0, 0, 0, 'A', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-04-10 06:45:19', 0, '0000-00-00 00:00:00'),
(43, 102, '10204', 'Inventory', 'Current Asset', 3, 1, 0, 0, 0, 0, 'A', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-04-10 06:48:32', 0, '0000-00-00 00:00:00'),
(44, 502, '50203', 'Accrued Expenses', 'Current Liabilities', 3, 1, 0, 0, 0, 0, 'L', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-04-10 06:50:20', 0, '0000-00-00 00:00:00'),
(46, 501, '50101', 'Long-Term Debt', 'Long Term Liabilities', 3, 1, 0, 0, 0, 0, 'L', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-04-10 06:51:45', 0, '0000-00-00 00:00:00'),
(47, 501, '50102', 'Other Long-Term  Liabilities', 'Long Term Liabilities', 3, 1, 0, 0, 0, 0, 'L', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-04-10 06:53:04', 0, '0000-00-00 00:00:00'),
(48, 2, '201', 'Equity', 'Shareholder\'s Equity', 2, 1, 0, 0, 0, 0, 'L', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 0, '2022-04-10 06:56:38', 0, '2022-04-10 06:56:38'),
(49, 201, '20101', 'Equity Capital', 'Equity', 3, 1, 0, 0, 0, 0, 'L', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-05-17 12:31:33', 0, '0000-00-00 00:00:00'),
(50, 201, '20102', 'Retained Earnings', 'Equity', 3, 1, 0, 0, 0, 0, 'L', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-04-10 07:01:45', 0, '0000-00-00 00:00:00'),
(51, 101, '10101', 'Property & Equipment', 'Fixed Assets', 3, 1, 0, 0, 0, 0, 'A', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-04-10 11:35:53', 0, '0000-00-00 00:00:00'),
(52, 101, '10102', 'Goodwills', 'Fixed Assets', 3, 1, 0, 0, 0, 0, 'A', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-04-23 06:47:21', 0, '0000-00-00 00:00:00'),
(53, 301, '30101', 'Construction Income', 'Direct Income', 3, 1, 0, 0, 0, 0, 'I', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-04-10 08:08:04', 0, '0000-00-00 00:00:00'),
(54, 301, '30102', 'Reimbursement Income', 'Direct Income', 3, 1, 0, 0, 0, 0, 'I', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-04-10 08:09:02', 0, '0000-00-00 00:00:00'),
(55, 401, '40101', 'Cost of Goods Sold', 'Cost of Goods Solds', 3, 1, 0, 0, 0, 0, 'E', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-04-10 08:13:52', 0, '0000-00-00 00:00:00'),
(56, 401, '40102', 'Job Expenses', 'Cost of Goods Solds', 3, 1, 0, 0, 0, 0, 'E', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-04-10 08:14:18', 0, '0000-00-00 00:00:00'),
(57, 402, '40201', 'Automobile', 'Over Head Cost', 3, 1, 0, 0, 0, 0, 'E', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-04-10 08:14:37', 0, '0000-00-00 00:00:00'),
(58, 402, '40202', 'Bank Service Charges', 'Over Head Cost', 3, 1, 0, 0, 0, 0, 'E', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-04-10 08:15:32', 0, '0000-00-00 00:00:00'),
(59, 402, '40203', 'Insurance', 'Over Head Cost', 3, 1, 0, 0, 0, 0, 'E', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-04-10 08:15:58', 0, '0000-00-00 00:00:00'),
(60, 402, '40204', 'Interest Expenses', 'Over Head Cost', 3, 1, 0, 0, 0, 0, 'E', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-04-10 08:16:36', 0, '0000-00-00 00:00:00'),
(61, 402, '40205', 'Payroll Expenses', 'Over Head Cost', 3, 1, 0, 0, 0, 0, 'E', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-04-10 08:17:08', 0, '0000-00-00 00:00:00'),
(62, 402, '40206', 'Postage', 'Over Head Cost', 3, 1, 0, 0, 0, 0, 'E', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-04-10 08:17:26', 0, '0000-00-00 00:00:00'),
(63, 402, '40207', 'Professional Fees', 'Over Head Cost', 3, 1, 0, 0, 0, 0, 'E', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-04-10 08:17:55', 0, '0000-00-00 00:00:00'),
(64, 402, '40208', 'Repairs', 'Over Head Cost', 3, 1, 0, 0, 0, 0, 'E', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-04-10 08:18:38', 0, '0000-00-00 00:00:00'),
(65, 402, '40209', 'Tools and Macchnery', 'Over Head Cost', 3, 1, 0, 0, 0, 0, 'E', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-04-10 08:28:02', 0, '0000-00-00 00:00:00'),
(66, 402, '40210', 'Utilities', 'Over Head Cost', 3, 1, 0, 0, 0, 0, 'E', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-04-10 08:28:42', 0, '0000-00-00 00:00:00'),
(67, 40210, '4021001', 'Electic Bill', 'Utilities', 4, 1, 0, 0, 0, 0, 'E', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-04-10 09:05:45', 0, '0000-00-00 00:00:00'),
(68, 40210, '4021002', 'House Rent', 'Utilities', 4, 1, 0, 0, 0, 0, 'E', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-04-10 09:06:05', 0, '0000-00-00 00:00:00'),
(69, 102, '10205', 'Cash at Bank', 'Current Asset', 3, 1, 0, 0, 0, 0, 'A', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-05-17 12:44:19', 0, '0000-00-00 00:00:00'),
(75, 10102, '1010201', 'Goodwill', 'Goodwills', 4, 1, 0, 0, 0, 0, 'A', 0, 0, 15, 0, 1, 0, 1, NULL, 'GD001', NULL, 1, '2022-04-23 06:45:48', 0, '0000-00-00 00:00:00'),
(77, 50204, '5020401', 'property sales', 'Unearned Revenue', 4, 1, 0, 0, 0, 0, 'L', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-04-10 11:40:48', 0, '0000-00-00 00:00:00'),
(78, 50101, '5010101', 'Debts', 'Long-Term Debt', 4, 1, 0, 0, 0, 0, 'L', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-04-10 11:41:49', 0, '0000-00-00 00:00:00'),
(79, 50102, '5010201', 'Other Long-Term  Liabilities', 'Other Long-Term  Liabilities', 4, 1, 0, 0, 0, 0, 'L', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-04-10 11:42:03', 0, '0000-00-00 00:00:00'),
(80, 20101, '2010101', 'Capital Fund', 'Equity Capital', 4, 1, 0, 0, 0, 0, 'L', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-04-10 11:42:36', 0, '0000-00-00 00:00:00'),
(81, 20102, '2010201', 'Current year Profit & Loss', 'Retained Earnings', 4, 1, 0, 0, 0, 0, 'L', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-04-10 11:42:53', 0, '0000-00-00 00:00:00'),
(82, 20102, '2010202', 'Last year Profit & Loss', 'Retained Earnings', 4, 1, 0, 0, 0, 0, 'L', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-04-10 11:43:03', 0, '0000-00-00 00:00:00'),
(84, 502, '50201', 'Provisions', 'Current Liabilities', 3, 1, 0, 0, 0, 0, 'L', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-04-10 11:46:00', 0, '0000-00-00 00:00:00'),
(85, 50205, '5020104', 'Depreciation of Goodwill', 'Depreciations', 4, 1, 0, 0, 0, 0, 'L', 0, 0, 0, 0, 1, 0, 1, NULL, NULL, 'GD001', 1, '2022-04-23 06:47:07', 0, '0000-00-00 00:00:00'),
(86, 502, '50204', 'Unearned Revenue', 'Current Liabilities', 3, 1, 0, 0, 0, 0, 'L', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-05-17 12:53:09', 0, '0000-00-00 00:00:00'),
(88, 102, '10206', 'Advance', 'Current Asset', 3, 1, 0, 0, 0, 0, 'A', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-04-11 11:56:56', 0, '0000-00-00 00:00:00'),
(89, 10206, '1020601', 'Advance against Employee', 'Advance', 4, 1, 0, 0, 0, 0, 'A', 0, 0, 0, 1, 2, 0, 0, NULL, NULL, NULL, 1, '2022-04-11 11:57:18', 0, '0000-00-00 00:00:00'),
(90, 10206, '1020602', 'Advance Against Customer', 'Advance', 4, 1, 0, 0, 0, 0, 'A', 0, 0, 0, 1, 3, 0, 0, NULL, NULL, NULL, 1, '2022-04-11 11:57:35', 0, '0000-00-00 00:00:00'),
(91, 10201, '1020102', 'Petty Cash', 'Cash', 4, 1, 0, 0, 1, 0, 'A', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-04-12 08:16:19', 0, '0000-00-00 00:00:00'),
(93, 4, '403', 'Purchase Accounts', 'Expenses', 2, 1, 0, 0, 0, 0, 'E', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 0, '2022-04-16 10:30:11', 0, '2022-04-16 10:30:11'),
(94, 402, '40301', 'Purchase Account', 'Purchase Accounts', 3, 1, 0, 0, 0, 0, 'E', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 0, '2022-04-16 10:31:43', 0, '2022-04-16 10:31:43'),
(95, 40201, '4030102', 'Purchase', 'Purchase Account', 4, 1, 0, 0, 0, 0, 'E', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-04-16 10:33:59', 0, '0000-00-00 00:00:00'),
(96, 301, '30103', 'Sales Accounts', 'Direct Income', 3, 1, 0, 0, 0, 0, 'I', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-04-16 10:34:37', 0, '0000-00-00 00:00:00'),
(97, 30103, '3010301', 'Sales Account', 'Sales Accounts', 4, 1, 0, 0, 0, 0, 'I', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-04-16 10:34:57', 0, '0000-00-00 00:00:00'),
(99, 40205, '4020501', 'Salary Expense', 'Payroll Expenses', 4, 1, 0, 0, 0, 0, 'E', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-04-20 06:24:08', 0, '0000-00-00 00:00:00'),
(104, 50201, '5020102', 'Provision for npf contribution', 'Provisions', 4, 1, 0, 0, 0, 0, 'L', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-05-10 06:19:45', 0, '0000-00-00 00:00:00'),
(106, 50201, '5020101', 'Provision for State Income Tax', 'Provisions', 4, 1, 0, 0, 0, 0, 'L', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-04-26 06:44:29', 0, '0000-00-00 00:00:00'),
(107, 402, '40211', 'State Income Tax', 'Over Head Cost', 3, 1, 0, 0, 0, 0, 'E', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-04-26 06:44:46', 0, '0000-00-00 00:00:00'),
(108, 40211, '4021101', 'State Income Tax', 'State Income Tax', 4, 1, 0, 0, 0, 0, 'E', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-04-26 06:45:00', 0, '0000-00-00 00:00:00'),
(110, 402, '40212', 'Employeer ICF Expense', 'Over Head Cost', 3, 1, 0, 0, 0, 0, 'E', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-05-10 06:35:37', 0, '0000-00-00 00:00:00'),
(111, 40212, '4021201', 'Employeer 1% ICF Expense', 'Employeer ICF Expense', 4, 1, 0, 0, 0, 0, 'E', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-05-17 11:34:02', 0, '0000-00-00 00:00:00'),
(112, 502, '50205', 'Depreciations', 'Current Liabilities', 3, 1, 0, 0, 0, 0, 'L', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 0, '2022-05-10 09:35:15', 0, '2022-05-10 09:35:15'),
(191, 40205, '4020502', 'Employee 5 % NPF Expenses', 'Payroll Expenses', 4, 1, 0, 0, 0, 0, 'E', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-05-17 11:32:14', 0, '0000-00-00 00:00:00'),
(192, 40205, '4020503', 'Employee 10 % NPF Expenses', 'Payroll Expenses', 4, 1, 0, 0, 0, 0, 'E', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-05-17 11:32:36', 0, '0000-00-00 00:00:00'),
(208, 10205, '1020501', 'Zenith Bank', 'Cash at Bank', 4, 1, 0, 0, 0, 1, 'A', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-05-19 07:59:19', 0, '0000-00-00 00:00:00'),
(210, 10205, '1020502', 'ABC Bank', 'Cash at Bank', 4, 1, 0, 0, 0, 1, 'A', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-05-19 12:21:45', 0, '0000-00-00 00:00:00'),
(211, 10205, '1020503', 'test', 'Cash at Bank', 4, 1, 0, 0, 0, 1, 'A', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-05-19 12:24:58', 0, '0000-00-00 00:00:00'),
(212, 10205, '1020504', 'New Bank', 'Cash at Bank', 4, 1, 0, 0, 0, 1, 'A', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-05-19 12:25:43', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `acc_monthly_balance`
--

CREATE TABLE `acc_monthly_balance` (
  `id` int(11) NOT NULL,
  `fyear` int(11) NOT NULL,
  `COAID` int(11) NOT NULL,
  `balance1` decimal(18,2) NOT NULL DEFAULT 0.00,
  `balance2` decimal(18,2) NOT NULL DEFAULT 0.00,
  `balance3` decimal(18,2) NOT NULL DEFAULT 0.00,
  `balance4` decimal(18,2) NOT NULL DEFAULT 0.00,
  `balance5` decimal(18,2) NOT NULL DEFAULT 0.00,
  `balance6` decimal(18,2) NOT NULL DEFAULT 0.00,
  `balance7` decimal(18,2) NOT NULL DEFAULT 0.00,
  `balance8` decimal(18,2) NOT NULL DEFAULT 0.00,
  `balance9` decimal(18,2) NOT NULL DEFAULT 0.00,
  `balance10` decimal(18,2) NOT NULL DEFAULT 0.00,
  `balance11` decimal(18,2) NOT NULL DEFAULT 0.00,
  `balance12` decimal(18,2) NOT NULL DEFAULT 0.00,
  `totalBalance` decimal(18,2) NOT NULL DEFAULT 0.00,
  `updatedDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `acc_monthly_balance`
--

INSERT INTO `acc_monthly_balance` (`id`, `fyear`, `COAID`, `balance1`, `balance2`, `balance3`, `balance4`, `balance5`, `balance6`, `balance7`, `balance8`, `balance9`, `balance10`, `balance11`, `balance12`, `totalBalance`, `updatedDate`) VALUES
(1, 4, 4030102, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '2022-05-19 08:04:44'),
(2, 4, 1020502, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '2022-05-19 08:04:44'),
(3, 4, 4020501, '0.00', '0.00', '0.00', '0.00', '1165.88', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '2022-05-19 12:16:49'),
(4, 4, 1020101, '0.00', '0.00', '0.00', '0.00', '-1000.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '2022-05-19 12:16:49'),
(5, 4, 1020501, '0.00', '0.00', '0.00', '0.00', '-364.06', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '2022-05-19 12:39:42'),
(6, 4, 4020502, '0.00', '0.00', '0.00', '0.00', '56.06', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '2022-05-19 12:16:49'),
(7, 4, 4020503, '0.00', '0.00', '0.00', '0.00', '112.12', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '2022-05-19 12:16:49'),
(8, 4, 4021201, '0.00', '0.00', '0.00', '0.00', '30.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '2022-05-19 12:16:49'),
(9, 4, 1020602, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '2022-05-19 12:39:42');

-- --------------------------------------------------------

--
-- Table structure for table `acc_opening_balance`
--

CREATE TABLE `acc_opening_balance` (
  `id` int(11) NOT NULL,
  `fyear` int(11) NOT NULL,
  `COAID` int(11) NOT NULL,
  `subType` int(11) NOT NULL DEFAULT 1,
  `subCode` int(11) DEFAULT NULL,
  `Debit` decimal(10,0) NOT NULL,
  `Credit` decimal(10,0) NOT NULL,
  `openDate` date NOT NULL,
  `CreateBy` int(11) NOT NULL,
  `CreateDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `acc_predefine_account`
--

CREATE TABLE `acc_predefine_account` (
  `id` int(11) NOT NULL,
  `cashCode` int(11) NOT NULL,
  `bankCode` int(11) NOT NULL,
  `advance` int(11) NOT NULL,
  `fixedAsset` int(11) NOT NULL,
  `purchaseCode` int(11) NOT NULL,
  `salesCode` int(11) NOT NULL,
  `customerCode` int(11) NOT NULL,
  `supplierCode` int(11) NOT NULL,
  `costs_of_good_solds` int(11) NOT NULL,
  `vat` int(11) NOT NULL,
  `tax` int(11) NOT NULL,
  `inventoryCode` int(11) NOT NULL,
  `CPLCode` int(11) NOT NULL,
  `LPLCode` int(11) NOT NULL,
  `salary_code` int(11) DEFAULT NULL,
  `emp_npf_contribution` int(11) DEFAULT NULL,
  `empr_npf_contribution` int(11) DEFAULT NULL,
  `emp_icf_contribution` int(11) DEFAULT NULL,
  `empr_icf_contribution` int(11) DEFAULT NULL,
  `prov_state_tax` int(11) NOT NULL,
  `state_tax` int(11) NOT NULL,
  `prov_npfcode` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `acc_predefine_account`
--

INSERT INTO `acc_predefine_account` (`id`, `cashCode`, `bankCode`, `advance`, `fixedAsset`, `purchaseCode`, `salesCode`, `customerCode`, `supplierCode`, `costs_of_good_solds`, `vat`, `tax`, `inventoryCode`, `CPLCode`, `LPLCode`, `salary_code`, `emp_npf_contribution`, `empr_npf_contribution`, `emp_icf_contribution`, `empr_icf_contribution`, `prov_state_tax`, `state_tax`, `prov_npfcode`) VALUES
(0, 10201, 10205, 10206, 101, 0, 3010301, 1020202, 5020201, 401, 0, 0, 0, 2010201, 2010202, 4020501, 4020502, 4020503, 4021201, 0, 5020101, 4021101, 5020102);

-- --------------------------------------------------------

--
-- Table structure for table `acc_subcode`
--

CREATE TABLE `acc_subcode` (
  `id` int(11) NOT NULL,
  `subTypeId` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `referenceNo` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_by` int(11) NOT NULL,
  `created_date` date NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `acc_subcode`
--

INSERT INTO `acc_subcode` (`id`, `subTypeId`, `name`, `referenceNo`, `status`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(29, 2, 'Test User', 1, 1, 0, '2022-05-18', 0, '2022-05-18 12:53:15'),
(30, 2, 'Sakin Rahman', 2, 1, 0, '2022-05-19', 0, '2022-05-19 05:11:24'),
(31, 2, 'Harunur Rashid', 3, 1, 0, '2022-05-19', 0, '2022-05-19 05:13:20'),
(32, 3, 'ABC Customer', 0, 1, 1, '2022-05-19', 0, '2022-05-19 12:32:22');

-- --------------------------------------------------------

--
-- Table structure for table `acc_subtype`
--

CREATE TABLE `acc_subtype` (
  `id` int(11) NOT NULL,
  `subtypeName` varchar(200) NOT NULL,
  `staus` int(11) NOT NULL DEFAULT 1,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `acc_subtype`
--

INSERT INTO `acc_subtype` (`id`, `subtypeName`, `staus`, `created_by`, `created_date`) VALUES
(1, 'None', 1, 1, '2022-04-05 10:19:27'),
(2, 'employee', 1, 1, '2022-04-06 08:14:48'),
(3, 'Customer', 1, 1, '2022-04-10 08:49:22'),
(4, 'Supplier', 1, 1, '2022-04-10 08:49:22'),
(6, 'Agent', 1, 1, '2022-04-10 08:50:12');

-- --------------------------------------------------------

--
-- Table structure for table `acc_transaction`
--

CREATE TABLE `acc_transaction` (
  `id` int(11) NOT NULL,
  `vid` int(11) NOT NULL,
  `fyear` int(11) NOT NULL,
  `VNo` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Vtype` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `referenceNo` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `VDate` date DEFAULT NULL,
  `COAID` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Narration` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `chequeNo` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `chequeDate` date DEFAULT NULL,
  `isHonour` int(11) NOT NULL DEFAULT 0,
  `ledgerComment` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Debit` decimal(18,2) DEFAULT NULL,
  `Credit` decimal(18,2) DEFAULT NULL,
  `StoreID` int(11) NOT NULL DEFAULT 0,
  `IsPosted` char(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CreateBy` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CreateDate` datetime DEFAULT NULL,
  `UpdateBy` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `UpdateDate` datetime DEFAULT NULL,
  `IsAppove` char(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `RevCodde` bigint(30) NOT NULL,
  `subType` int(11) NOT NULL DEFAULT 1,
  `subCode` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `acc_transaction`
--

INSERT INTO `acc_transaction` (`id`, `vid`, `fyear`, `VNo`, `Vtype`, `referenceNo`, `VDate`, `COAID`, `Narration`, `chequeNo`, `chequeDate`, `isHonour`, `ledgerComment`, `Debit`, `Credit`, `StoreID`, `IsPosted`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`, `IsAppove`, `RevCodde`, `subType`, `subCode`) VALUES
(3, 2, 4, 'DV-1', 'DV', NULL, '2022-05-19', '4020501', 'Salary for payment', NULL, NULL, 0, 'April 2022', '1000.00', '0.00', 0, '1', '1', '2022-05-19 12:16:49', NULL, NULL, '1', 1020101, 1, NULL),
(4, 2, 4, 'DV-1', 'DV', NULL, '2022-05-19', '1020101', 'Salary for payment', NULL, NULL, 0, 'April 2022', '0.00', '1000.00', 0, '1', '1', '2022-05-19 12:16:49', NULL, NULL, '1', 4020501, 1, NULL),
(5, 3, 4, 'DV-2', 'DV', NULL, '2022-05-19', '4020501', 'Salary for payment', NULL, NULL, 0, 'April 2022', '165.88', '0.00', 0, '1', '1', '2022-05-19 12:16:49', NULL, NULL, '1', 1020501, 1, NULL),
(6, 3, 4, 'DV-2', 'DV', NULL, '2022-05-19', '1020501', 'Salary for payment', NULL, NULL, 0, 'April 2022', '0.00', '165.88', 0, '1', '1', '2022-05-19 12:16:49', NULL, NULL, '1', 4020501, 1, NULL),
(7, 4, 4, 'DV-3', 'DV', NULL, '2022-05-19', '4020502', 'Salary for payment', NULL, NULL, 0, 'April 2022', '56.06', '0.00', 0, '1', '1', '2022-05-19 12:16:49', NULL, NULL, '1', 1020501, 1, NULL),
(8, 4, 4, 'DV-3', 'DV', NULL, '2022-05-19', '1020501', 'Salary for payment', NULL, NULL, 0, 'April 2022', '0.00', '56.06', 0, '1', '1', '2022-05-19 12:16:49', NULL, NULL, '1', 4020502, 1, NULL),
(9, 5, 4, 'DV-4', 'DV', NULL, '2022-05-19', '4020503', 'Salary for payment', NULL, NULL, 0, 'April 2022', '112.12', '0.00', 0, '1', '1', '2022-05-19 12:16:49', NULL, NULL, '1', 1020501, 1, NULL),
(10, 5, 4, 'DV-4', 'DV', NULL, '2022-05-19', '1020501', 'Salary for payment', NULL, NULL, 0, 'April 2022', '0.00', '112.12', 0, '1', '1', '2022-05-19 12:16:49', NULL, NULL, '1', 4020503, 1, NULL),
(11, 6, 4, 'DV-5', 'DV', NULL, '2022-05-19', '4021201', 'Salary for payment', NULL, NULL, 0, 'April 2022', '30.00', '0.00', 0, '1', '1', '2022-05-19 12:16:49', NULL, NULL, '1', 1020501, 1, NULL),
(12, 6, 4, 'DV-5', 'DV', NULL, '2022-05-19', '1020501', 'Salary for payment', NULL, NULL, 0, 'April 2022', '0.00', '30.00', 0, '1', '1', '2022-05-19 12:16:49', NULL, NULL, '1', 4021201, 1, NULL),
(13, 7, 4, 'DV-6', 'DV', '0', '2022-05-19', '1020602', '', NULL, '2022-05-19', 0, 'Advance received from customer', '1000.21', '0.00', 0, '1', '1', '2022-05-19 12:34:38', NULL, NULL, '1', 1020501, 3, 32),
(14, 7, 4, 'DV-6', 'DV', '0', '2022-05-19', '1020501', '', NULL, '2022-05-19', 0, 'Advance received from customer', '0.00', '1000.21', 0, '1', '1', '2022-05-19 12:34:38', NULL, NULL, '1', 1020602, 3, 32),
(15, 8, 4, 'CV-1', 'CV', '0', '2022-05-19', '1020602', '', NULL, '2022-05-19', 0, 'Cash received from customer', '0.00', '1000.21', 0, '1', '1', '2022-05-19 12:39:42', NULL, NULL, '1', 1020501, 3, 32),
(16, 8, 4, 'CV-1', 'CV', '0', '2022-05-19', '1020501', '', NULL, '2022-05-19', 0, 'Cash received from customer', '1000.21', '0.00', 0, '1', '1', '2022-05-19 12:39:42', NULL, NULL, '1', 1020602, 3, 32);

-- --------------------------------------------------------

--
-- Table structure for table `acc_vaucher`
--

CREATE TABLE `acc_vaucher` (
  `id` int(11) NOT NULL,
  `fyear` int(11) NOT NULL,
  `VNo` varchar(50) NOT NULL,
  `Vtype` varchar(50) NOT NULL,
  `referenceNo` varchar(50) DEFAULT NULL,
  `VDate` date NOT NULL,
  `COAID` int(11) NOT NULL,
  `Narration` varchar(255) DEFAULT NULL,
  `chequeno` varchar(30) DEFAULT NULL,
  `chequeDate` date DEFAULT NULL,
  `isHonour` int(11) NOT NULL DEFAULT 0,
  `ledgerComment` varchar(255) DEFAULT NULL,
  `Debit` decimal(18,2) NOT NULL DEFAULT 0.00,
  `Credit` decimal(18,2) NOT NULL DEFAULT 0.00,
  `RevCodde` int(11) NOT NULL,
  `subType` int(11) NOT NULL DEFAULT 1,
  `subCode` int(11) DEFAULT NULL,
  `isApproved` int(11) NOT NULL DEFAULT 0,
  `CreateBy` int(11) NOT NULL,
  `CreateDate` datetime NOT NULL,
  `UpdateBy` int(11) DEFAULT NULL,
  `UpdateDate` datetime DEFAULT NULL,
  `approvedBy` int(11) DEFAULT NULL,
  `approvedDate` datetime DEFAULT NULL,
  `isyearClosed` tinyint(1) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0 = non yet transfer to transation,  1 = Tranfer to transition'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `acc_vaucher`
--

INSERT INTO `acc_vaucher` (`id`, `fyear`, `VNo`, `Vtype`, `referenceNo`, `VDate`, `COAID`, `Narration`, `chequeno`, `chequeDate`, `isHonour`, `ledgerComment`, `Debit`, `Credit`, `RevCodde`, `subType`, `subCode`, `isApproved`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`, `approvedBy`, `approvedDate`, `isyearClosed`, `status`) VALUES
(2, 4, 'DV-1', 'DV', NULL, '2022-05-19', 4020501, 'Salary for payment', NULL, NULL, 0, 'April 2022', '1000.00', '0.00', 1020101, 1, NULL, 1, 1, '2022-05-19 12:13:43', NULL, NULL, 1, '2022-05-19 12:16:49', 0, 1),
(3, 4, 'DV-2', 'DV', NULL, '2022-05-19', 4020501, 'Salary for payment', NULL, NULL, 0, 'April 2022', '165.88', '0.00', 1020501, 1, NULL, 1, 1, '2022-05-19 12:13:43', NULL, NULL, 1, '2022-05-19 12:16:49', 0, 1),
(4, 4, 'DV-3', 'DV', NULL, '2022-05-19', 4020502, 'Salary for payment', NULL, NULL, 0, 'April 2022', '56.06', '0.00', 1020501, 1, NULL, 1, 1, '2022-05-19 12:13:43', NULL, NULL, 1, '2022-05-19 12:16:49', 0, 1),
(5, 4, 'DV-4', 'DV', NULL, '2022-05-19', 4020503, 'Salary for payment', NULL, NULL, 0, 'April 2022', '112.12', '0.00', 1020501, 1, NULL, 1, 1, '2022-05-19 12:13:43', NULL, NULL, 1, '2022-05-19 12:16:49', 0, 1),
(6, 4, 'DV-5', 'DV', NULL, '2022-05-19', 4021201, 'Salary for payment', NULL, NULL, 0, 'April 2022', '30.00', '0.00', 1020501, 1, NULL, 1, 1, '2022-05-19 12:13:43', NULL, NULL, 1, '2022-05-19 12:16:49', 0, 1),
(7, 4, 'DV-6', 'DV', '0', '2022-05-19', 1020602, '', '', '2022-05-19', 0, 'Advance received from customer', '1000.21', '0.00', 1020501, 3, 32, 1, 1, '2022-05-19 12:34:18', NULL, NULL, 1, '2022-05-19 12:34:38', 0, 1),
(8, 4, 'CV-1', 'CV', '0', '2022-05-19', 1020602, '', '', '2022-05-19', 0, 'Cash received from customer', '0.00', '1000.21', 1020501, 3, 32, 1, 1, '2022-05-19 12:39:26', NULL, NULL, 1, '2022-05-19 12:39:42', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `activity_id` int(11) NOT NULL,
  `user_id` varchar(11) NOT NULL COMMENT 'for employee , it will save employee_id',
  `type` varchar(30) NOT NULL COMMENT 'ticket, employee, attendnace etc.',
  `action` varchar(15) NOT NULL COMMENT 'create, update, delete',
  `action_id` varchar(15) NOT NULL,
  `table_name` varchar(30) DEFAULT NULL,
  `slug` varchar(150) NOT NULL,
  `form_data` text DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1=created, 2=updated, 3=deleted	'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`activity_id`, `user_id`, `type`, `action`, `action_id`, `table_name`, `slug`, `form_data`, `create_date`, `status`) VALUES
(1, '1', 'employee', 'create', '1', 'employee_history', 'employee/Employees/create_employee', '{\"employee_id\":1,\"pos_id\":\"3\",\"first_name\":\"Test\",\"middle_name\":\"\",\"last_name\":\"User\",\"maiden_name\":\"\",\"email\":\"test@gmail.com\",\"attendance_time\":\"8\",\"monthly_work_hours\":\"173.33\",\"employee_type\":\"2\",\"phone\":\"2930545\",\"alter_phone\":\"\",\"present_address\":null,\"parmanent_address\":null,\"picture\":\".\\/application\\/modules\\/employee\\/assets\\/images\\/2022-05-18\\/160.jpg\",\"dept_id\":\"11\",\"state\":\"Bangladesh\",\"city\":\"test\",\"zip\":\"1212\",\"citizenship\":\"1\",\"duty_type\":\"1\",\"hire_date\":\"2022-05-18\",\"original_hire_date\":\"2022-05-18\",\"termination_date\":null,\"termination_reason\":\"\",\"voluntary_termination\":\"\",\"rehire_date\":null,\"rate_type\":\"2\",\"rate\":\"0\",\"pay_frequency\":\"4\",\"pay_frequency_txt\":\"\",\"hourly_rate2\":\"\",\"hourly_rate3\":\"\",\"home_department\":\"\",\"department_text\":\"\",\"class_code\":\"\",\"class_code_desc\":\"\",\"class_acc_date\":null,\"class_status\":\"1\",\"is_super_visor\":\"0\",\"super_visor_id\":\"\",\"supervisor_report\":\"\",\"dob\":\"2008-04-29\",\"gender\":\"1\",\"marital_status\":\"1\",\"ethnic_group\":\"\",\"eeo_class_gp\":\"\",\"sos\":\"\",\"work_in_state\":\"\",\"live_in_state\":\"1\",\"home_email\":\"\",\"business_email\":\"\",\"home_phone\":\"2930545\",\"business_phone\":\"\",\"cell_phone\":\"2930545\",\"em_contact_person\":\"2930545\",\"emerg_contct\":\"2930545\",\"emrg_h_phone\":\"2930545\",\"emrg_w_phone\":\"2930545\",\"emgr_contct_relation\":\"\",\"alt_em_contct\":\"\",\"alt_emg_h_phone\":\"2930545\",\"alt_emg_w_phone\":\"2930545\",\"password\":\"e10adc3949ba59abbe56e057f20f883e\"}', '2022-05-18 14:53:15', 1),
(2, '1', 'employee_performance', 'create', '1', 'employee_performance', 'employee/Employees_performance/save_employee_performance', '{\"employee_id\":\"1\",\"review_period\":\"6\",\"position_of_supervisor\":\"test\",\"total_scores\":98,\"employee_comments\":\"\",\"date\":\"2022-05-18\",\"create_date\":\"2022-05-18\",\"create_by\":\"1\",\"perform_sl\":\"SL16528784435571\"}', '2022-05-18 14:54:03', 1),
(3, '1', 'rule', 'create', '12', 'gmb_setup_rules', 'dashboard/rules/create_rule', '{\"name\":\"Regular\",\"type\":\"time\",\"description\":\"Regular\",\"start_time\":\"10:00\",\"end_time\":\"18:00\",\"created_at\":\"2022-05-18 06:55:07\",\"created_by\":\"1\"}', '2022-05-18 14:55:07', 1),
(4, '1', 'employee', 'update', '1', 'employee_history', 'employee/Employees/update_employee_form/1', '{\"employee_id\":\"1\",\"pos_id\":\"3\",\"first_name\":\"Test\",\"maiden_name\":\"\",\"last_name\":\"User\",\"email\":\"test@gmail.com\",\"phone\":\"2930545\",\"attendance_time\":\"12\",\"monthly_work_hours\":\"173.33\",\"employee_type\":\"2\",\"alter_phone\":\"\",\"present_address\":null,\"parmanent_address\":null,\"picture\":\".\\/application\\/modules\\/employee\\/assets\\/images\\/2022-05-18\\/160.jpg\",\"dept_id\":\"11\",\"state\":\"Bangladesh\",\"city\":\"test\",\"zip\":\"1212\",\"citizenship\":\"1\",\"duty_type\":\"1\",\"hire_date\":\"2022-05-18\",\"original_hire_date\":\"2022-05-18\",\"termination_date\":null,\"termination_reason\":\"\",\"voluntary_termination\":\"\",\"rehire_date\":null,\"rate_type\":\"2\",\"rate\":\"0\",\"pay_frequency\":\"4\",\"pay_frequency_txt\":\"\",\"hourly_rate2\":\"0\",\"hourly_rate3\":\"0\",\"home_department\":\"\",\"department_text\":\"\",\"class_code\":\"\",\"class_code_desc\":\"\",\"class_acc_date\":null,\"class_status\":\"1\",\"is_super_visor\":\"0\",\"super_visor_id\":\"\",\"supervisor_report\":\"\",\"dob\":\"2008-04-29\",\"gender\":\"1\",\"marital_status\":\"1\",\"ethnic_group\":\"\",\"eeo_class_gp\":\"\",\"sos\":\"\",\"work_in_state\":\"\",\"live_in_state\":\"1\",\"home_email\":\"\",\"business_email\":\"\",\"home_phone\":\"2930545\",\"business_phone\":\"\",\"cell_phone\":\"2930545\",\"em_contact_person\":\"2930545\",\"emerg_contct\":\"2930545\",\"emrg_h_phone\":\"2930545\",\"emrg_w_phone\":\"2930545\",\"emgr_contct_relation\":\"\",\"alt_em_contct\":\"\",\"alt_emg_h_phone\":\"2930545\",\"alt_emg_w_phone\":\"2930545\",\"password\":\"e10adc3949ba59abbe56e057f20f883e\"}', '2022-05-18 14:55:35', 2),
(5, '1', 'salary generate', 'create', '1', 'gmb_salary_sheet_generate', 'payroll/Payroll/employee_salary_generate', '{\"name\":\"April 2022\",\"gdate\":\"2022-05-18\",\"start_date\":\"2022-4-1\",\"end_date\":\"2022-4-30\",\"generate_by\":\"1\"}', '2022-05-18 14:55:57', 2),
(6, '1', 'salary generate', 'delete', '1', 'gmb_salary_sheet_generate', 'payroll/Payroll/delete_employee_salary_generate/1', '[]', '2022-05-18 14:56:24', 3),
(7, '1', 'salary generate', 'create', '2', 'gmb_salary_sheet_generate', 'payroll/Payroll/employee_salary_generate', '{\"name\":\"May 2022\",\"gdate\":\"2022-05-19\",\"start_date\":\"2022-5-1\",\"end_date\":\"2022-5-31\",\"generate_by\":\"1\"}', '2022-05-19 05:55:54', 2),
(8, '1', 'salary generate', 'create', '3', 'gmb_salary_sheet_generate', 'payroll/Payroll/employee_salary_generate', '{\"name\":\"April 2022\",\"gdate\":\"2022-05-19\",\"start_date\":\"2022-4-1\",\"end_date\":\"2022-4-30\",\"generate_by\":\"1\"}', '2022-05-19 05:56:27', 2),
(9, '1', 'salary generate', 'delete', '2', 'gmb_salary_sheet_generate', 'payroll/Payroll/delete_employee_salary_generate/2', '[]', '2022-05-19 05:59:02', 3),
(10, '1', 'salary generate', 'delete', '3', 'gmb_salary_sheet_generate', 'payroll/Payroll/delete_employee_salary_generate/3', '[]', '2022-05-19 05:59:08', 3),
(11, '1', 'salary_advance', 'create', '1', 'gmb_salary_advance', 'payroll/Salary_advance/create_salary_advance', '{\"employee_id\":\"1\",\"amount\":\"20\",\"salary_month\":\"May 2022\",\"CreateDate\":\"2022-05-19\",\"CreateBy\":\"1\"}', '2022-05-19 07:08:37', 1),
(12, '1', 'employee', 'create', '2', 'employee_history', 'employee/Employees/create_employee', '{\"employee_id\":2,\"pos_id\":\"1\",\"first_name\":\"Sakin\",\"middle_name\":\"\",\"last_name\":\"Rahman\",\"maiden_name\":\"\",\"email\":\"sakib@gmail.com\",\"attendance_time\":\"12\",\"monthly_work_hours\":\"173.33\",\"employee_type\":\"3\",\"phone\":\"04358023\",\"alter_phone\":\"\",\"present_address\":null,\"parmanent_address\":null,\"picture\":null,\"dept_id\":\"3\",\"state\":\"Bangladesh\",\"city\":\"\",\"zip\":\"\",\"citizenship\":\"1\",\"duty_type\":\"1\",\"hire_date\":\"2022-05-19\",\"original_hire_date\":\"2022-05-19\",\"termination_date\":null,\"termination_reason\":\"\",\"voluntary_termination\":\"\",\"rehire_date\":null,\"rate_type\":\"2\",\"rate\":\"0\",\"pay_frequency\":\"4\",\"pay_frequency_txt\":\"\",\"hourly_rate2\":\"\",\"hourly_rate3\":\"\",\"home_department\":\"\",\"department_text\":\"\",\"class_code\":\"\",\"class_code_desc\":\"\",\"class_acc_date\":null,\"class_status\":\"1\",\"is_super_visor\":\"1\",\"super_visor_id\":\"\",\"supervisor_report\":\"\",\"dob\":\"1983-05-07\",\"gender\":\"1\",\"marital_status\":\"1\",\"ethnic_group\":\"\",\"eeo_class_gp\":\"\",\"sos\":\"\",\"work_in_state\":\"\",\"live_in_state\":\"1\",\"home_email\":\"\",\"business_email\":\"\",\"home_phone\":\"04358023\",\"business_phone\":\"\",\"cell_phone\":\"04358023\",\"em_contact_person\":\"\",\"emerg_contct\":\"04358023\",\"emrg_h_phone\":\"04358023\",\"emrg_w_phone\":\"04358023\",\"emgr_contct_relation\":\"\",\"alt_em_contct\":\"\",\"alt_emg_h_phone\":\"04358023\",\"alt_emg_w_phone\":\"04358023\",\"password\":\"e10adc3949ba59abbe56e057f20f883e\"}', '2022-05-19 07:11:24', 1),
(13, '1', 'employee', 'create', '3', 'employee_history', 'employee/Employees/create_employee', '{\"employee_id\":3,\"pos_id\":\"1\",\"first_name\":\"Harunur\",\"middle_name\":\"\",\"last_name\":\"Rashid\",\"maiden_name\":\"\",\"email\":\"harun@gmail.com\",\"attendance_time\":\"10\",\"monthly_work_hours\":\"173.33\",\"employee_type\":\"2\",\"phone\":\"0887432\",\"alter_phone\":\"\",\"present_address\":null,\"parmanent_address\":null,\"picture\":null,\"dept_id\":\"3\",\"state\":\"Andorra\",\"city\":\"\",\"zip\":\"\",\"citizenship\":\"1\",\"duty_type\":\"1\",\"hire_date\":\"2022-05-19\",\"original_hire_date\":\"2022-05-19\",\"termination_date\":null,\"termination_reason\":\"\",\"voluntary_termination\":\"\",\"rehire_date\":null,\"rate_type\":\"2\",\"rate\":\"0\",\"pay_frequency\":\"4\",\"pay_frequency_txt\":\"\",\"hourly_rate2\":\"\",\"hourly_rate3\":\"\",\"home_department\":\"\",\"department_text\":\"\",\"class_code\":\"\",\"class_code_desc\":\"\",\"class_acc_date\":null,\"class_status\":\"1\",\"is_super_visor\":\"0\",\"super_visor_id\":\"\",\"supervisor_report\":\"\",\"dob\":\"1994-05-04\",\"gender\":\"1\",\"marital_status\":\"1\",\"ethnic_group\":\"\",\"eeo_class_gp\":\"\",\"sos\":\"\",\"work_in_state\":\"\",\"live_in_state\":\"1\",\"home_email\":\"\",\"business_email\":\"\",\"home_phone\":\"0887432\",\"business_phone\":\"\",\"cell_phone\":\"0887432\",\"em_contact_person\":\"\",\"emerg_contct\":\"0887432\",\"emrg_h_phone\":\"0887432\",\"emrg_w_phone\":\"0887432\",\"emgr_contct_relation\":\"\",\"alt_em_contct\":\"\",\"alt_emg_h_phone\":\"0887432\",\"alt_emg_w_phone\":\"0887432\",\"password\":\"e10adc3949ba59abbe56e057f20f883e\"}', '2022-05-19 07:13:20', 1),
(14, '1', 'grnd_loan', 'create', '1', 'grand_loan', 'loan/Loan/create_grandloan', '{\"employee_id\":\"1\",\"permission_by\":\"2\",\"loan_details\":\"Test\",\"amount\":\"300\",\"interest_rate\":\"0\",\"installment\":\"150\",\"installment_period\":\"2\",\"repayment_amount\":\"300\",\"date_of_approve\":\"2022-05-19\",\"loan_status\":\"1\",\"repayment_start_date\":\"2022-05-19\"}', '2022-05-19 07:14:01', 1),
(15, '1', 'grnd_loan', 'create', '2', 'grand_loan', 'loan/Loan/create_grandloan', '{\"employee_id\":\"3\",\"permission_by\":\"2\",\"loan_details\":\"Test\",\"amount\":\"200\",\"interest_rate\":\"0\",\"installment\":\"200\",\"installment_period\":\"1\",\"repayment_amount\":\"200\",\"date_of_approve\":\"2022-05-19\",\"loan_status\":\"1\",\"repayment_start_date\":\"2022-05-19\"}', '2022-05-19 07:14:51', 1),
(16, '1', 'salary generate', 'create', '4', 'gmb_salary_sheet_generate', 'payroll/Payroll/employee_salary_generate', '{\"name\":\"April 2022\",\"gdate\":\"2022-05-19\",\"start_date\":\"2022-4-1\",\"end_date\":\"2022-4-30\",\"generate_by\":\"1\"}', '2022-05-19 07:30:54', 2),
(17, '1', 'salary generate', 'delete', '4', 'gmb_salary_sheet_generate', 'payroll/Payroll/delete_employee_salary_generate/4', '[]', '2022-05-19 07:33:54', 3),
(18, '1', 'employee', 'update', '3', 'employee_history', 'employee/Employees/update_employee_form/3', '{\"employee_id\":\"3\",\"pos_id\":\"1\",\"first_name\":\"Harunur\",\"maiden_name\":\"\",\"last_name\":\"Rashid\",\"email\":\"harun@gmail.com\",\"phone\":\"0887432\",\"attendance_time\":\"10\",\"monthly_work_hours\":\"173.33\",\"employee_type\":\"2\",\"alter_phone\":\"\",\"present_address\":null,\"parmanent_address\":null,\"picture\":\"\",\"dept_id\":\"3\",\"state\":\"Andorra\",\"city\":\"\",\"zip\":\"0\",\"citizenship\":\"1\",\"duty_type\":\"1\",\"hire_date\":\"2022-05-19\",\"original_hire_date\":\"2022-05-19\",\"termination_date\":null,\"termination_reason\":\"\",\"voluntary_termination\":\"\",\"rehire_date\":null,\"rate_type\":\"2\",\"rate\":\"0\",\"pay_frequency\":\"4\",\"pay_frequency_txt\":\"\",\"hourly_rate2\":\"0\",\"hourly_rate3\":\"0\",\"home_department\":\"\",\"department_text\":\"\",\"class_code\":\"\",\"class_code_desc\":\"\",\"class_acc_date\":null,\"class_status\":\"1\",\"is_super_visor\":\"0\",\"super_visor_id\":\"\",\"supervisor_report\":\"\",\"dob\":\"1994-05-04\",\"gender\":\"1\",\"marital_status\":\"1\",\"ethnic_group\":\"\",\"eeo_class_gp\":\"\",\"sos\":\"1212\",\"work_in_state\":\"\",\"live_in_state\":\"1\",\"home_email\":\"\",\"business_email\":\"\",\"home_phone\":\"0887432\",\"business_phone\":\"\",\"cell_phone\":\"0887432\",\"em_contact_person\":\"\",\"emerg_contct\":\"0887432\",\"emrg_h_phone\":\"0887432\",\"emrg_w_phone\":\"0887432\",\"emgr_contct_relation\":\"\",\"alt_em_contct\":\"\",\"alt_emg_h_phone\":\"0887432\",\"alt_emg_w_phone\":\"0887432\",\"password\":\"e10adc3949ba59abbe56e057f20f883e\"}', '2022-05-19 07:35:34', 2),
(19, '1', 'employee', 'update', '1', 'employee_history', 'employee/Employees/update_employee_form/1', '{\"employee_id\":\"1\",\"pos_id\":\"3\",\"first_name\":\"Test\",\"maiden_name\":\"\",\"last_name\":\"User\",\"email\":\"test@gmail.com\",\"phone\":\"2930545\",\"attendance_time\":\"12\",\"monthly_work_hours\":\"173.33\",\"employee_type\":\"2\",\"alter_phone\":\"\",\"present_address\":null,\"parmanent_address\":null,\"picture\":\".\\/application\\/modules\\/employee\\/assets\\/images\\/2022-05-18\\/160.jpg\",\"dept_id\":\"11\",\"state\":\"Bangladesh\",\"city\":\"test\",\"zip\":\"1212\",\"citizenship\":\"1\",\"duty_type\":\"1\",\"hire_date\":\"2022-05-18\",\"original_hire_date\":\"2022-05-18\",\"termination_date\":null,\"termination_reason\":\"\",\"voluntary_termination\":\"\",\"rehire_date\":null,\"rate_type\":\"2\",\"rate\":\"0\",\"pay_frequency\":\"4\",\"pay_frequency_txt\":\"\",\"hourly_rate2\":\"0\",\"hourly_rate3\":\"0\",\"home_department\":\"\",\"department_text\":\"\",\"class_code\":\"\",\"class_code_desc\":\"\",\"class_acc_date\":null,\"class_status\":\"1\",\"is_super_visor\":\"0\",\"super_visor_id\":\"\",\"supervisor_report\":\"\",\"dob\":\"2008-04-29\",\"gender\":\"1\",\"marital_status\":\"1\",\"ethnic_group\":\"\",\"eeo_class_gp\":\"\",\"sos\":\"23232\",\"work_in_state\":\"\",\"live_in_state\":\"1\",\"home_email\":\"\",\"business_email\":\"\",\"home_phone\":\"2930545\",\"business_phone\":\"\",\"cell_phone\":\"2930545\",\"em_contact_person\":\"2930545\",\"emerg_contct\":\"2930545\",\"emrg_h_phone\":\"2930545\",\"emrg_w_phone\":\"2930545\",\"emgr_contct_relation\":\"\",\"alt_em_contct\":\"\",\"alt_emg_h_phone\":\"2930545\",\"alt_emg_w_phone\":\"2930545\",\"password\":\"e10adc3949ba59abbe56e057f20f883e\"}', '2022-05-19 07:36:02', 2),
(20, '1', 'salary generate', 'create', '5', 'gmb_salary_sheet_generate', 'payroll/Payroll/employee_salary_generate', '{\"name\":\"April 2022\",\"gdate\":\"2022-05-19\",\"start_date\":\"2022-4-1\",\"end_date\":\"2022-4-30\",\"generate_by\":\"1\"}', '2022-05-19 07:36:29', 2),
(21, '1', 'employee', 'update', '3', 'employee_history', 'employee/Employees/update_employee_form/3', '{\"employee_id\":\"3\",\"pos_id\":\"1\",\"first_name\":\"Harunur\",\"maiden_name\":\"\",\"last_name\":\"Rashid\",\"email\":\"harun@gmail.com\",\"phone\":\"0887432\",\"attendance_time\":\"10\",\"monthly_work_hours\":\"173.33\",\"employee_type\":\"3\",\"alter_phone\":\"\",\"present_address\":null,\"parmanent_address\":null,\"picture\":\"\",\"dept_id\":\"3\",\"state\":\"Andorra\",\"city\":\"\",\"zip\":\"0\",\"citizenship\":\"1\",\"duty_type\":\"1\",\"hire_date\":\"2022-05-19\",\"original_hire_date\":\"2022-05-19\",\"termination_date\":null,\"termination_reason\":\"\",\"voluntary_termination\":\"\",\"rehire_date\":null,\"rate_type\":\"2\",\"rate\":\"0\",\"pay_frequency\":\"4\",\"pay_frequency_txt\":\"\",\"hourly_rate2\":\"0\",\"hourly_rate3\":\"0\",\"home_department\":\"\",\"department_text\":\"\",\"class_code\":\"\",\"class_code_desc\":\"\",\"class_acc_date\":null,\"class_status\":\"1\",\"is_super_visor\":\"0\",\"super_visor_id\":\"\",\"supervisor_report\":\"\",\"dob\":\"1994-05-04\",\"gender\":\"1\",\"marital_status\":\"1\",\"ethnic_group\":\"\",\"eeo_class_gp\":\"\",\"sos\":\"1212\",\"work_in_state\":\"\",\"live_in_state\":\"1\",\"home_email\":\"\",\"business_email\":\"\",\"home_phone\":\"0887432\",\"business_phone\":\"\",\"cell_phone\":\"0887432\",\"em_contact_person\":\"\",\"emerg_contct\":\"0887432\",\"emrg_h_phone\":\"0887432\",\"emrg_w_phone\":\"0887432\",\"emgr_contct_relation\":\"\",\"alt_em_contct\":\"\",\"alt_emg_h_phone\":\"0887432\",\"alt_emg_w_phone\":\"887431\",\"password\":\"e10adc3949ba59abbe56e057f20f883e\"}', '2022-05-19 07:37:50', 2),
(22, '1', 'employee', 'update', '1', 'employee_history', 'employee/Employees/update_employee_form/1', '{\"employee_id\":\"1\",\"pos_id\":\"3\",\"first_name\":\"Test\",\"maiden_name\":\"\",\"last_name\":\"User\",\"email\":\"test@gmail.com\",\"phone\":\"2930545\",\"attendance_time\":\"12\",\"monthly_work_hours\":\"173.33\",\"employee_type\":\"3\",\"alter_phone\":\"\",\"present_address\":null,\"parmanent_address\":null,\"picture\":\".\\/application\\/modules\\/employee\\/assets\\/images\\/2022-05-18\\/160.jpg\",\"dept_id\":\"11\",\"state\":\"Bangladesh\",\"city\":\"test\",\"zip\":\"1212\",\"citizenship\":\"1\",\"duty_type\":\"1\",\"hire_date\":\"2022-05-18\",\"original_hire_date\":\"2022-05-18\",\"termination_date\":null,\"termination_reason\":\"\",\"voluntary_termination\":\"\",\"rehire_date\":null,\"rate_type\":\"2\",\"rate\":\"0\",\"pay_frequency\":\"4\",\"pay_frequency_txt\":\"\",\"hourly_rate2\":\"0\",\"hourly_rate3\":\"0\",\"home_department\":\"\",\"department_text\":\"\",\"class_code\":\"\",\"class_code_desc\":\"\",\"class_acc_date\":null,\"class_status\":\"1\",\"is_super_visor\":\"0\",\"super_visor_id\":\"\",\"supervisor_report\":\"\",\"dob\":\"2008-04-29\",\"gender\":\"1\",\"marital_status\":\"1\",\"ethnic_group\":\"\",\"eeo_class_gp\":\"\",\"sos\":\"23232\",\"work_in_state\":\"\",\"live_in_state\":\"1\",\"home_email\":\"\",\"business_email\":\"\",\"home_phone\":\"2930545\",\"business_phone\":\"\",\"cell_phone\":\"2930545\",\"em_contact_person\":\"2930545\",\"emerg_contct\":\"2930545\",\"emrg_h_phone\":\"2930545\",\"emrg_w_phone\":\"2930545\",\"emgr_contct_relation\":\"\",\"alt_em_contct\":\"\",\"alt_emg_h_phone\":\"2930545\",\"alt_emg_w_phone\":\"2930545\",\"password\":\"e10adc3949ba59abbe56e057f20f883e\"}', '2022-05-19 07:38:14', 2),
(23, '1', 'salary generate', 'delete', '5', 'gmb_salary_sheet_generate', 'payroll/Payroll/delete_employee_salary_generate/5', '[]', '2022-05-19 07:38:34', 3),
(24, '1', 'salary generate', 'create', '6', 'gmb_salary_sheet_generate', 'payroll/Payroll/employee_salary_generate', '{\"name\":\"April 2022\",\"gdate\":\"2022-05-19\",\"start_date\":\"2022-4-1\",\"end_date\":\"2022-4-30\",\"generate_by\":\"1\"}', '2022-05-19 07:39:05', 2),
(25, '1', 'salary generate', 'create', '7', 'gmb_salary_sheet_generate', 'payroll/Payroll/employee_salary_generate', '{\"name\":\"May 2022\",\"gdate\":\"2022-05-19\",\"start_date\":\"2022-5-1\",\"end_date\":\"2022-5-31\",\"generate_by\":\"1\"}', '2022-05-19 07:42:38', 2),
(26, '1', 'salary generate', 'create', '8', 'gmb_salary_sheet_generate', 'payroll/Payroll/employee_salary_generate', '{\"name\":\"June 2022\",\"gdate\":\"2022-05-19\",\"start_date\":\"2022-6-1\",\"end_date\":\"2022-6-30\",\"generate_by\":\"1\"}', '2022-05-19 07:43:27', 2),
(27, '1', 'salary generate', 'delete', '8', 'gmb_salary_sheet_generate', 'payroll/Payroll/delete_employee_salary_generate/8', '[]', '2022-05-19 07:44:41', 3),
(28, '1', 'salary generate', 'delete', '7', 'gmb_salary_sheet_generate', 'payroll/Payroll/delete_employee_salary_generate/7', '[]', '2022-05-19 07:45:06', 3),
(29, '1', 'salary generate', 'delete', '6', 'gmb_salary_sheet_generate', 'payroll/Payroll/delete_employee_salary_generate/6', '[]', '2022-05-19 07:49:36', 3),
(30, '1', 'coa_account', 'create', '0', 'acc_coa', 'bank/Bank/create_bank', '{\"HeadCode\":\"1020501\",\"pheadcode\":\"10205\",\"HeadName\":\"Zenith Bank\",\"PHeadName\":\"Cash at Bank\",\"HeadLevel\":4,\"IsActive\":1,\"isStock\":0,\"isSubType\":0,\"DepreciationRate\":0,\"HeadType\":\"A\",\"IsBudget\":0,\"isCashNature\":0,\"isBankNature\":1,\"isFixedAssetSch\":0,\"assetCode\":null,\"depCode\":null,\"subType\":1,\"noteNo\":null,\"CreateBy\":\"1\",\"CreateDate\":\"2022-05-19 07:59:19\"}', '2022-05-19 09:59:19', 1),
(31, '1', 'coa_account', 'create', '0', 'acc_coa', 'bank/Bank/create_bank', '{\"HeadCode\":1020502,\"pheadcode\":\"10205\",\"HeadName\":\"new bank\",\"PHeadName\":\"Cash at Bank\",\"HeadLevel\":4,\"IsActive\":1,\"isStock\":0,\"isSubType\":0,\"DepreciationRate\":0,\"HeadType\":\"A\",\"IsBudget\":0,\"isCashNature\":0,\"isBankNature\":1,\"isFixedAssetSch\":0,\"assetCode\":null,\"depCode\":null,\"subType\":1,\"noteNo\":null,\"CreateBy\":\"1\",\"CreateDate\":\"2022-05-19 08:00:20\"}', '2022-05-19 10:00:20', 1),
(32, '1', 'debit_vaucher', 'create', 'DV-1', 'acc_vaucher', 'accounts/store_debit_voucher', '{\"fyear\":\"4\",\"VNo\":\"DV-1\",\"Vtype\":\"DV\",\"referenceNo\":null,\"VDate\":\"2022-05-19\",\"COAID\":\"4030102\",\"Narration\":\"\",\"chequeNo\":\"\",\"chequeDate\":\"2022-05-19\",\"isHonour\":0,\"ledgerComment\":\"\",\"Debit\":\"500\",\"Credit\":0,\"RevCodde\":\"1020502\",\"subType\":\"1\",\"subCode\":null,\"isApproved\":0,\"CreateBy\":\"1\",\"CreateDate\":\"2022-05-19 08:01:11\",\"status\":0}', '2022-05-19 10:01:11', 1),
(33, '1', 'approved_vaucher_transation', 'create', '1', 'acc_transaction', 'accounts/isactive/DV-1/active', '{\"vid\":\"1\",\"fyear\":\"4\",\"VNo\":\"DV-1\",\"Vtype\":\"DV\",\"referenceNo\":null,\"VDate\":\"2022-05-19\",\"COAID\":\"4030102\",\"Narration\":\"\",\"chequeNo\":null,\"chequeDate\":\"2022-05-19\",\"isHonour\":\"0\",\"ledgerComment\":\"\",\"Debit\":\"500.00\",\"Credit\":\"0.00\",\"StoreID\":0,\"IsPosted\":1,\"RevCodde\":\"1020502\",\"subType\":\"1\",\"subCode\":null,\"IsAppove\":1,\"CreateBy\":\"1\",\"CreateDate\":\"2022-05-19 08:01:26\"}', '2022-05-19 10:01:26', 1),
(34, '1', 'approved_vaucher_reversetransa', 'create', '2', 'acc_transaction', 'accounts/isactive/DV-1/active', '{\"vid\":\"1\",\"fyear\":\"4\",\"VNo\":\"DV-1\",\"Vtype\":\"DV\",\"referenceNo\":null,\"VDate\":\"2022-05-19\",\"COAID\":\"1020502\",\"Narration\":\"\",\"chequeNo\":null,\"chequeDate\":\"2022-05-19\",\"isHonour\":\"0\",\"ledgerComment\":\"\",\"Debit\":\"0.00\",\"Credit\":\"500.00\",\"StoreID\":0,\"IsPosted\":1,\"RevCodde\":\"4030102\",\"subType\":\"1\",\"subCode\":null,\"IsAppove\":1,\"CreateBy\":\"1\",\"CreateDate\":\"2022-05-19 08:01:26\"}', '2022-05-19 10:01:26', 1),
(35, '1', 'delete_vaucher', 'delete', 'DV-1', 'acc_vaucher', 'accounts/deleteVoucher', '{\"voNO\":\"DV-1\",\"deleteBy\":\"1\",\"deleteDate\":\"2022-05-19 08:05:01\"}', '2022-05-19 10:05:01', 3),
(36, '1', 'salary generate', 'create', '9', 'gmb_salary_sheet_generate', 'payroll/Payroll/employee_salary_generate', '{\"name\":\"April 2022\",\"gdate\":\"2022-05-19\",\"start_date\":\"2022-4-1\",\"end_date\":\"2022-4-30\",\"generate_by\":\"1\"}', '2022-05-19 14:10:53', 2),
(37, '1', 'approved_vaucher_transation', 'create', '3', 'acc_transaction', 'accounts/bulk_voucher_approve', '{\"vid\":\"2\",\"fyear\":\"4\",\"VNo\":\"DV-1\",\"Vtype\":\"DV\",\"referenceNo\":null,\"VDate\":\"2022-05-19\",\"COAID\":\"4020501\",\"Narration\":\"Salary for payment\",\"chequeNo\":null,\"chequeDate\":null,\"isHonour\":\"0\",\"ledgerComment\":\"April 2022\",\"Debit\":\"1000.00\",\"Credit\":\"0.00\",\"StoreID\":0,\"IsPosted\":1,\"RevCodde\":\"1020101\",\"subType\":\"1\",\"subCode\":null,\"IsAppove\":1,\"CreateBy\":\"1\",\"CreateDate\":\"2022-05-19 12:16:49\"}', '2022-05-19 14:16:49', 1),
(38, '1', 'approved_vaucher_reversetransa', 'create', '4', 'acc_transaction', 'accounts/bulk_voucher_approve', '{\"vid\":\"2\",\"fyear\":\"4\",\"VNo\":\"DV-1\",\"Vtype\":\"DV\",\"referenceNo\":null,\"VDate\":\"2022-05-19\",\"COAID\":\"1020101\",\"Narration\":\"Salary for payment\",\"chequeNo\":null,\"chequeDate\":null,\"isHonour\":\"0\",\"ledgerComment\":\"April 2022\",\"Debit\":\"0.00\",\"Credit\":\"1000.00\",\"StoreID\":0,\"IsPosted\":1,\"RevCodde\":\"4020501\",\"subType\":\"1\",\"subCode\":null,\"IsAppove\":1,\"CreateBy\":\"1\",\"CreateDate\":\"2022-05-19 12:16:49\"}', '2022-05-19 14:16:49', 1),
(39, '1', 'approved_vaucher_transation', 'create', '5', 'acc_transaction', 'accounts/bulk_voucher_approve', '{\"vid\":\"3\",\"fyear\":\"4\",\"VNo\":\"DV-2\",\"Vtype\":\"DV\",\"referenceNo\":null,\"VDate\":\"2022-05-19\",\"COAID\":\"4020501\",\"Narration\":\"Salary for payment\",\"chequeNo\":null,\"chequeDate\":null,\"isHonour\":\"0\",\"ledgerComment\":\"April 2022\",\"Debit\":\"165.88\",\"Credit\":\"0.00\",\"StoreID\":0,\"IsPosted\":1,\"RevCodde\":\"1020501\",\"subType\":\"1\",\"subCode\":null,\"IsAppove\":1,\"CreateBy\":\"1\",\"CreateDate\":\"2022-05-19 12:16:49\"}', '2022-05-19 14:16:49', 1),
(40, '1', 'approved_vaucher_reversetransa', 'create', '6', 'acc_transaction', 'accounts/bulk_voucher_approve', '{\"vid\":\"3\",\"fyear\":\"4\",\"VNo\":\"DV-2\",\"Vtype\":\"DV\",\"referenceNo\":null,\"VDate\":\"2022-05-19\",\"COAID\":\"1020501\",\"Narration\":\"Salary for payment\",\"chequeNo\":null,\"chequeDate\":null,\"isHonour\":\"0\",\"ledgerComment\":\"April 2022\",\"Debit\":\"0.00\",\"Credit\":\"165.88\",\"StoreID\":0,\"IsPosted\":1,\"RevCodde\":\"4020501\",\"subType\":\"1\",\"subCode\":null,\"IsAppove\":1,\"CreateBy\":\"1\",\"CreateDate\":\"2022-05-19 12:16:49\"}', '2022-05-19 14:16:49', 1),
(41, '1', 'approved_vaucher_transation', 'create', '7', 'acc_transaction', 'accounts/bulk_voucher_approve', '{\"vid\":\"4\",\"fyear\":\"4\",\"VNo\":\"DV-3\",\"Vtype\":\"DV\",\"referenceNo\":null,\"VDate\":\"2022-05-19\",\"COAID\":\"4020502\",\"Narration\":\"Salary for payment\",\"chequeNo\":null,\"chequeDate\":null,\"isHonour\":\"0\",\"ledgerComment\":\"April 2022\",\"Debit\":\"56.06\",\"Credit\":\"0.00\",\"StoreID\":0,\"IsPosted\":1,\"RevCodde\":\"1020501\",\"subType\":\"1\",\"subCode\":null,\"IsAppove\":1,\"CreateBy\":\"1\",\"CreateDate\":\"2022-05-19 12:16:49\"}', '2022-05-19 14:16:49', 1),
(42, '1', 'approved_vaucher_reversetransa', 'create', '8', 'acc_transaction', 'accounts/bulk_voucher_approve', '{\"vid\":\"4\",\"fyear\":\"4\",\"VNo\":\"DV-3\",\"Vtype\":\"DV\",\"referenceNo\":null,\"VDate\":\"2022-05-19\",\"COAID\":\"1020501\",\"Narration\":\"Salary for payment\",\"chequeNo\":null,\"chequeDate\":null,\"isHonour\":\"0\",\"ledgerComment\":\"April 2022\",\"Debit\":\"0.00\",\"Credit\":\"56.06\",\"StoreID\":0,\"IsPosted\":1,\"RevCodde\":\"4020502\",\"subType\":\"1\",\"subCode\":null,\"IsAppove\":1,\"CreateBy\":\"1\",\"CreateDate\":\"2022-05-19 12:16:49\"}', '2022-05-19 14:16:49', 1),
(43, '1', 'approved_vaucher_transation', 'create', '9', 'acc_transaction', 'accounts/bulk_voucher_approve', '{\"vid\":\"5\",\"fyear\":\"4\",\"VNo\":\"DV-4\",\"Vtype\":\"DV\",\"referenceNo\":null,\"VDate\":\"2022-05-19\",\"COAID\":\"4020503\",\"Narration\":\"Salary for payment\",\"chequeNo\":null,\"chequeDate\":null,\"isHonour\":\"0\",\"ledgerComment\":\"April 2022\",\"Debit\":\"112.12\",\"Credit\":\"0.00\",\"StoreID\":0,\"IsPosted\":1,\"RevCodde\":\"1020501\",\"subType\":\"1\",\"subCode\":null,\"IsAppove\":1,\"CreateBy\":\"1\",\"CreateDate\":\"2022-05-19 12:16:49\"}', '2022-05-19 14:16:49', 1),
(44, '1', 'approved_vaucher_reversetransa', 'create', '10', 'acc_transaction', 'accounts/bulk_voucher_approve', '{\"vid\":\"5\",\"fyear\":\"4\",\"VNo\":\"DV-4\",\"Vtype\":\"DV\",\"referenceNo\":null,\"VDate\":\"2022-05-19\",\"COAID\":\"1020501\",\"Narration\":\"Salary for payment\",\"chequeNo\":null,\"chequeDate\":null,\"isHonour\":\"0\",\"ledgerComment\":\"April 2022\",\"Debit\":\"0.00\",\"Credit\":\"112.12\",\"StoreID\":0,\"IsPosted\":1,\"RevCodde\":\"4020503\",\"subType\":\"1\",\"subCode\":null,\"IsAppove\":1,\"CreateBy\":\"1\",\"CreateDate\":\"2022-05-19 12:16:49\"}', '2022-05-19 14:16:49', 1),
(45, '1', 'approved_vaucher_transation', 'create', '11', 'acc_transaction', 'accounts/bulk_voucher_approve', '{\"vid\":\"6\",\"fyear\":\"4\",\"VNo\":\"DV-5\",\"Vtype\":\"DV\",\"referenceNo\":null,\"VDate\":\"2022-05-19\",\"COAID\":\"4021201\",\"Narration\":\"Salary for payment\",\"chequeNo\":null,\"chequeDate\":null,\"isHonour\":\"0\",\"ledgerComment\":\"April 2022\",\"Debit\":\"30.00\",\"Credit\":\"0.00\",\"StoreID\":0,\"IsPosted\":1,\"RevCodde\":\"1020501\",\"subType\":\"1\",\"subCode\":null,\"IsAppove\":1,\"CreateBy\":\"1\",\"CreateDate\":\"2022-05-19 12:16:49\"}', '2022-05-19 14:16:49', 1),
(46, '1', 'approved_vaucher_reversetransa', 'create', '12', 'acc_transaction', 'accounts/bulk_voucher_approve', '{\"vid\":\"6\",\"fyear\":\"4\",\"VNo\":\"DV-5\",\"Vtype\":\"DV\",\"referenceNo\":null,\"VDate\":\"2022-05-19\",\"COAID\":\"1020501\",\"Narration\":\"Salary for payment\",\"chequeNo\":null,\"chequeDate\":null,\"isHonour\":\"0\",\"ledgerComment\":\"April 2022\",\"Debit\":\"0.00\",\"Credit\":\"30.00\",\"StoreID\":0,\"IsPosted\":1,\"RevCodde\":\"4021201\",\"subType\":\"1\",\"subCode\":null,\"IsAppove\":1,\"CreateBy\":\"1\",\"CreateDate\":\"2022-05-19 12:16:49\"}', '2022-05-19 14:16:49', 1),
(47, '1', 'coa_account', 'create', '0', 'acc_coa', 'bank/Bank/create_bank', '{\"HeadCode\":1020502,\"pheadcode\":\"10205\",\"HeadName\":\"ABC Bank\",\"PHeadName\":\"Cash at Bank\",\"HeadLevel\":4,\"IsActive\":1,\"isStock\":0,\"isSubType\":0,\"DepreciationRate\":0,\"HeadType\":\"A\",\"IsBudget\":0,\"isCashNature\":0,\"isBankNature\":1,\"isFixedAssetSch\":0,\"assetCode\":null,\"depCode\":null,\"subType\":1,\"noteNo\":null,\"CreateBy\":\"1\",\"CreateDate\":\"2022-05-19 12:21:45\"}', '2022-05-19 14:21:45', 1),
(48, '1', 'coa_account', 'create', '0', 'acc_coa', 'bank/Bank/create_bank', '{\"HeadCode\":1020503,\"pheadcode\":\"10205\",\"HeadName\":\"test\",\"PHeadName\":\"Cash at Bank\",\"HeadLevel\":4,\"IsActive\":1,\"isStock\":0,\"isSubType\":0,\"DepreciationRate\":0,\"HeadType\":\"A\",\"IsBudget\":0,\"isCashNature\":0,\"isBankNature\":1,\"isFixedAssetSch\":0,\"assetCode\":null,\"depCode\":null,\"subType\":1,\"noteNo\":null,\"CreateBy\":\"1\",\"CreateDate\":\"2022-05-19 12:24:58\"}', '2022-05-19 14:24:58', 1),
(49, '1', 'coa_account', 'create', '0', 'acc_coa', 'bank/Bank/create_bank', '{\"HeadCode\":1020504,\"pheadcode\":\"10205\",\"HeadName\":\"New Bank\",\"PHeadName\":\"Cash at Bank\",\"HeadLevel\":4,\"IsActive\":1,\"isStock\":0,\"isSubType\":0,\"DepreciationRate\":0,\"HeadType\":\"A\",\"IsBudget\":0,\"isCashNature\":0,\"isBankNature\":1,\"isFixedAssetSch\":0,\"assetCode\":null,\"depCode\":null,\"subType\":1,\"noteNo\":null,\"CreateBy\":\"1\",\"CreateDate\":\"2022-05-19 12:25:43\"}', '2022-05-19 14:25:43', 1),
(50, '1', 'sub_account', 'create', '32', 'acc_subcode', 'accounts/accounts/subaccount_list', '{\"subTypeId\":\"3\",\"name\":\"ABC Customer\",\"referenceNo\":0,\"status\":1,\"created_by\":\"1\",\"created_date\":\"2022-05-19 12:32:22\"}', '2022-05-19 14:32:22', 1),
(51, '1', 'debit_vaucher', 'create', 'DV-6', 'acc_vaucher', 'accounts/store_debit_voucher', '{\"fyear\":\"4\",\"VNo\":\"DV-6\",\"Vtype\":\"DV\",\"referenceNo\":\"0\",\"VDate\":\"2022-05-19\",\"COAID\":\"1020602\",\"Narration\":\"\",\"chequeNo\":\"\",\"chequeDate\":\"2022-05-19\",\"isHonour\":0,\"ledgerComment\":\"Advance received from customer\",\"Debit\":\"1000.21\",\"Credit\":0,\"RevCodde\":\"1020501\",\"subType\":\"3\",\"subCode\":\"32\",\"isApproved\":0,\"CreateBy\":\"1\",\"CreateDate\":\"2022-05-19 12:34:18\",\"status\":0}', '2022-05-19 14:34:18', 1),
(52, '1', 'approved_vaucher_transation', 'create', '13', 'acc_transaction', 'accounts/isactive/DV-6/active', '{\"vid\":\"7\",\"fyear\":\"4\",\"VNo\":\"DV-6\",\"Vtype\":\"DV\",\"referenceNo\":\"0\",\"VDate\":\"2022-05-19\",\"COAID\":\"1020602\",\"Narration\":\"\",\"chequeNo\":null,\"chequeDate\":\"2022-05-19\",\"isHonour\":\"0\",\"ledgerComment\":\"Advance received from customer\",\"Debit\":\"1000.21\",\"Credit\":\"0.00\",\"StoreID\":0,\"IsPosted\":1,\"RevCodde\":\"1020501\",\"subType\":\"3\",\"subCode\":\"32\",\"IsAppove\":1,\"CreateBy\":\"1\",\"CreateDate\":\"2022-05-19 12:34:38\"}', '2022-05-19 14:34:38', 1),
(53, '1', 'approved_vaucher_reversetransa', 'create', '14', 'acc_transaction', 'accounts/isactive/DV-6/active', '{\"vid\":\"7\",\"fyear\":\"4\",\"VNo\":\"DV-6\",\"Vtype\":\"DV\",\"referenceNo\":\"0\",\"VDate\":\"2022-05-19\",\"COAID\":\"1020501\",\"Narration\":\"\",\"chequeNo\":null,\"chequeDate\":\"2022-05-19\",\"isHonour\":\"0\",\"ledgerComment\":\"Advance received from customer\",\"Debit\":\"0.00\",\"Credit\":\"1000.21\",\"StoreID\":0,\"IsPosted\":1,\"RevCodde\":\"1020602\",\"subType\":\"3\",\"subCode\":\"32\",\"IsAppove\":1,\"CreateBy\":\"1\",\"CreateDate\":\"2022-05-19 12:34:38\"}', '2022-05-19 14:34:38', 1),
(54, '1', 'credit_vaucher', 'create', 'CV-1', 'acc_vaucher', 'accounts/store_credit_voucher', '{\"fyear\":\"4\",\"VNo\":\"CV-1\",\"Vtype\":\"CV\",\"referenceNo\":\"0\",\"VDate\":\"2022-05-19\",\"COAID\":\"1020602\",\"Narration\":\"\",\"chequeNo\":\"\",\"chequeDate\":\"2022-05-19\",\"isHonour\":0,\"ledgerComment\":\"Cash received from customer\",\"Debit\":0,\"Credit\":\"1000.21\",\"RevCodde\":\"1020501\",\"subType\":\"3\",\"subCode\":\"32\",\"isApproved\":0,\"CreateBy\":\"1\",\"CreateDate\":\"2022-05-19 12:39:26\",\"status\":0}', '2022-05-19 14:39:26', 1),
(55, '1', 'approved_vaucher_transation', 'create', '15', 'acc_transaction', 'accounts/isactive/CV-1/active', '{\"vid\":\"8\",\"fyear\":\"4\",\"VNo\":\"CV-1\",\"Vtype\":\"CV\",\"referenceNo\":\"0\",\"VDate\":\"2022-05-19\",\"COAID\":\"1020602\",\"Narration\":\"\",\"chequeNo\":null,\"chequeDate\":\"2022-05-19\",\"isHonour\":\"0\",\"ledgerComment\":\"Cash received from customer\",\"Debit\":\"0.00\",\"Credit\":\"1000.21\",\"StoreID\":0,\"IsPosted\":1,\"RevCodde\":\"1020501\",\"subType\":\"3\",\"subCode\":\"32\",\"IsAppove\":1,\"CreateBy\":\"1\",\"CreateDate\":\"2022-05-19 12:39:42\"}', '2022-05-19 14:39:42', 1),
(56, '1', 'approved_vaucher_reversetransa', 'create', '16', 'acc_transaction', 'accounts/isactive/CV-1/active', '{\"vid\":\"8\",\"fyear\":\"4\",\"VNo\":\"CV-1\",\"Vtype\":\"CV\",\"referenceNo\":\"0\",\"VDate\":\"2022-05-19\",\"COAID\":\"1020501\",\"Narration\":\"\",\"chequeNo\":null,\"chequeDate\":\"2022-05-19\",\"isHonour\":\"0\",\"ledgerComment\":\"Cash received from customer\",\"Debit\":\"1000.21\",\"Credit\":\"0.00\",\"StoreID\":0,\"IsPosted\":1,\"RevCodde\":\"1020602\",\"subType\":\"3\",\"subCode\":\"32\",\"IsAppove\":1,\"CreateBy\":\"1\",\"CreateDate\":\"2022-05-19 12:39:42\"}', '2022-05-19 14:39:42', 1),
(57, '1', 'salary generate', 'create', '10', 'gmb_salary_sheet_generate', 'payroll/Payroll/employee_salary_generate', '{\"name\":\"May 2022\",\"gdate\":\"2022-05-19\",\"start_date\":\"2022-5-1\",\"end_date\":\"2022-5-31\",\"generate_by\":\"1\"}', '2022-05-19 14:42:36', 2),
(58, '25', 'financial_year', 'update', '0', 'financial_year', 'accounts/accounts/update_financial_year', '{\"id\":\"4\",\"yearName\":\"2022\",\"startDate\":\"2022-01-01\",\"endDate\":\"2022-12-31\",\"updated_by\":\"25\",\"updated_date\":\"2022-05-19 01:16:57\"}', '2022-05-19 15:16:57', 2);

-- --------------------------------------------------------

--
-- Table structure for table `appsetting`
--

CREATE TABLE `appsetting` (
  `id` int(11) NOT NULL,
  `latitude` varchar(30) DEFAULT NULL,
  `longitude` varchar(30) DEFAULT NULL,
  `acceptablerange` int(11) DEFAULT NULL,
  `googleapi_authkey` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `appsetting`
--

INSERT INTO `appsetting` (`id`, `latitude`, `longitude`, `acceptablerange`, `googleapi_authkey`) VALUES
(1, '23.829312399999996', '90.42076019999999', 20, 'Authorization: Key=AAAACc-ZrPQ:APA91bH0tBWMWQOq9l3RBXdZ9O0-g8rUhISTVgRtan_59iOuzbeuSK8bUcbHL9IBJ9B8loKTbNfXgwO1KIi6ZFfXxI0IyHvw0oIO9MOxPeovbQfNlVrye9tfocgtgCtm49Zrd-NM4_VJ');

-- --------------------------------------------------------

--
-- Table structure for table `attendance_history`
--

CREATE TABLE `attendance_history` (
  `atten_his_id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `id` int(11) NOT NULL DEFAULT 0,
  `state` text NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendance_history`
--

INSERT INTO `attendance_history` (`atten_his_id`, `uid`, `id`, `state`, `time`) VALUES
(1, 1, 0, '1', '2022-04-03 08:15:00'),
(2, 1, 0, '1', '2022-04-03 19:20:00'),
(3, 1, 0, '1', '2022-04-04 09:10:00'),
(5, 1, 0, '1', '2022-04-04 17:10:00'),
(6, 1, 0, '1', '2022-04-05 08:10:00'),
(7, 1, 0, '1', '2022-04-05 20:40:00'),
(8, 1, 0, '1', '2022-04-06 06:40:00'),
(9, 1, 0, '1', '2022-04-06 20:40:00'),
(10, 1, 0, '1', '2022-04-07 05:55:00'),
(11, 1, 0, '1', '2022-04-07 21:10:00'),
(12, 1, 0, '1', '2022-04-10 06:15:00'),
(13, 1, 0, '1', '2022-04-10 23:15:00'),
(14, 1, 0, '1', '2022-04-11 03:45:00'),
(15, 1, 0, '1', '2022-04-11 23:15:00'),
(16, 1, 0, '1', '2022-04-12 01:20:00'),
(17, 1, 0, '1', '2022-04-12 22:45:00'),
(18, 1, 0, '1', '2022-04-13 02:05:00'),
(19, 1, 0, '1', '2022-04-13 23:55:00'),
(20, 1, 0, '1', '2022-04-14 00:10:00'),
(21, 1, 0, '1', '2022-04-14 23:55:00'),
(22, 1, 0, '1', '2022-04-17 00:05:00'),
(23, 1, 0, '1', '2022-04-17 23:50:00'),
(24, 2, 0, '1', '2022-04-03 04:25:00'),
(25, 2, 0, '1', '2022-04-03 21:50:00'),
(26, 3, 0, '1', '2022-04-03 03:05:00'),
(27, 3, 0, '1', '2022-04-03 23:55:00'),
(28, 3, 0, '1', '2022-04-04 05:50:00'),
(29, 3, 0, '1', '2022-04-04 20:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `award`
--

CREATE TABLE `award` (
  `award_id` int(11) NOT NULL,
  `award_name` varchar(50) NOT NULL,
  `aw_description` varchar(200) NOT NULL,
  `awr_gift_item` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `employee_id` varchar(30) NOT NULL,
  `awarded_by` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bank_information`
--

CREATE TABLE `bank_information` (
  `id` int(11) NOT NULL,
  `COAID` int(11) DEFAULT NULL,
  `bank_name` varchar(250) NOT NULL,
  `account_name` varchar(200) DEFAULT NULL,
  `account_number` varchar(100) NOT NULL,
  `branch_name` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bank_information`
--

INSERT INTO `bank_information` (`id`, `COAID`, `bank_name`, `account_name`, `account_number`, `branch_name`) VALUES
(1, 1020501, 'Zenith Bank', 'Bay Tech', '123456', 'New Branch'),
(3, 1020502, 'ABC Bank', 'test', '1235', 'test'),
(4, 1020503, 'test', 'test', '123456', 'khk'),
(5, 1020504, 'New Bank', 'trtrt', '4242', 'tr');

-- --------------------------------------------------------

--
-- Table structure for table `candidate_basic_info`
--

CREATE TABLE `candidate_basic_info` (
  `can_id` varchar(20) NOT NULL,
  `first_name` varchar(11) CHARACTER SET latin1 NOT NULL,
  `last_name` varchar(30) CHARACTER SET latin1 NOT NULL,
  `email` varchar(30) CHARACTER SET latin1 NOT NULL,
  `phone` varchar(20) CHARACTER SET latin1 NOT NULL,
  `alter_phone` varchar(20) CHARACTER SET latin1 NOT NULL,
  `present_address` varchar(100) CHARACTER SET latin1 NOT NULL,
  `parmanent_address` varchar(100) CHARACTER SET latin1 NOT NULL,
  `picture` text DEFAULT NULL,
  `ssn` varchar(50) NOT NULL,
  `state` varchar(30) NOT NULL,
  `city` varchar(30) NOT NULL,
  `zip` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `candidate_education_info`
--

CREATE TABLE `candidate_education_info` (
  `can_edu_id` int(11) NOT NULL,
  `can_id` varchar(30) NOT NULL,
  `degree_name` varchar(30) CHARACTER SET latin1 NOT NULL,
  `university_name` varchar(50) CHARACTER SET latin1 NOT NULL,
  `cgp` varchar(30) CHARACTER SET latin1 NOT NULL,
  `comments` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `sequencee` varchar(255) CHARACTER SET latin1 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `candidate_interview`
--

CREATE TABLE `candidate_interview` (
  `can_int_id` int(11) NOT NULL,
  `can_id` varchar(30) CHARACTER SET latin1 NOT NULL,
  `job_adv_id` varchar(50) CHARACTER SET latin1 NOT NULL,
  `interview_date` varchar(30) CHARACTER SET latin1 NOT NULL,
  `interviewer_id` varchar(50) CHARACTER SET latin1 NOT NULL,
  `interview_marks` varchar(50) CHARACTER SET latin1 NOT NULL,
  `written_total_marks` varchar(50) CHARACTER SET latin1 NOT NULL,
  `mcq_total_marks` varchar(50) CHARACTER SET latin1 NOT NULL,
  `total_marks` varchar(30) NOT NULL,
  `recommandation` varchar(50) CHARACTER SET latin1 NOT NULL,
  `selection` varchar(50) CHARACTER SET latin1 NOT NULL,
  `details` varchar(50) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `candidate_selection`
--

CREATE TABLE `candidate_selection` (
  `can_sel_id` int(11) NOT NULL,
  `can_id` varchar(30) CHARACTER SET latin1 NOT NULL,
  `employee_id` varchar(50) CHARACTER SET latin1 NOT NULL,
  `pos_id` varchar(30) CHARACTER SET latin1 NOT NULL,
  `selection_terms` varchar(50) CHARACTER SET latin1 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `candidate_shortlist`
--

CREATE TABLE `candidate_shortlist` (
  `can_short_id` int(11) NOT NULL,
  `can_id` varchar(30) CHARACTER SET latin1 NOT NULL,
  `job_adv_id` int(11) NOT NULL,
  `date_of_shortlist` varchar(50) CHARACTER SET latin1 NOT NULL,
  `interview_date` varchar(30) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `candidate_workexperience`
--

CREATE TABLE `candidate_workexperience` (
  `can_workexp_id` int(11) NOT NULL,
  `can_id` varchar(30) CHARACTER SET latin1 NOT NULL,
  `company_name` varchar(50) CHARACTER SET latin1 NOT NULL,
  `working_period` varchar(50) CHARACTER SET latin1 NOT NULL,
  `duties` varchar(30) CHARACTER SET latin1 NOT NULL,
  `supervisor` varchar(50) CHARACTER SET latin1 NOT NULL,
  `sequencee` varchar(10) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `custom_table`
--

CREATE TABLE `custom_table` (
  `custom_id` int(11) NOT NULL,
  `custom_field` varchar(100) NOT NULL,
  `custom_data_type` int(11) NOT NULL,
  `custom_data` text NOT NULL,
  `employee_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `dept_id` int(11) NOT NULL,
  `department_name` varchar(100) NOT NULL,
  `parent_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dept_id`, `department_name`, `parent_id`) VALUES
(1, 'Technical', 0),
(3, 'Backend', 1),
(4, 'Front End', 1),
(5, 'SEO', 1),
(10, 'Sales', 0),
(11, 'Small Sales', 10);

-- --------------------------------------------------------

--
-- Table structure for table `deviceinfo`
--

CREATE TABLE `deviceinfo` (
  `id` int(11) NOT NULL,
  `device_ip` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `duty_type`
--

CREATE TABLE `duty_type` (
  `id` int(11) NOT NULL,
  `type_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `duty_type`
--

INSERT INTO `duty_type` (`id`, `type_name`) VALUES
(1, 'Full Time'),
(2, 'Part Time'),
(3, 'Contructual'),
(4, 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `employee_benifit`
--

CREATE TABLE `employee_benifit` (
  `id` int(11) NOT NULL,
  `bnf_cl_code` varchar(100) NOT NULL,
  `bnf_cl_code_des` varchar(250) NOT NULL,
  `bnff_acural_date` date NOT NULL,
  `bnf_status` tinyint(4) NOT NULL,
  `employee_id` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `employee_equipment`
--

CREATE TABLE `employee_equipment` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(20) NOT NULL,
  `equipment_id` int(11) NOT NULL,
  `issue_date` date NOT NULL,
  `damarage_desc` text NOT NULL,
  `return_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `employee_history`
--

CREATE TABLE `employee_history` (
  `emp_his_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `employee_status` tinyint(1) NOT NULL DEFAULT 1,
  `pos_id` varchar(30) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(30) NOT NULL,
  `email` varchar(32) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `alter_phone` varchar(30) NOT NULL,
  `present_address` varchar(100) DEFAULT NULL,
  `parmanent_address` varchar(100) DEFAULT NULL,
  `picture` text DEFAULT NULL,
  `degree_name` varchar(30) DEFAULT NULL,
  `university_name` varchar(50) DEFAULT NULL,
  `cgp` varchar(30) DEFAULT NULL,
  `passing_year` varchar(30) DEFAULT NULL,
  `company_name` varchar(30) DEFAULT NULL,
  `working_period` varchar(30) DEFAULT NULL,
  `duties` varchar(30) DEFAULT NULL,
  `supervisor` varchar(30) DEFAULT NULL,
  `signature` text DEFAULT NULL,
  `is_admin` int(2) NOT NULL DEFAULT 0,
  `dept_id` int(11) DEFAULT NULL,
  `division_id` int(11) NOT NULL,
  `maiden_name` varchar(50) NOT NULL,
  `state` varchar(30) NOT NULL,
  `city` varchar(30) NOT NULL,
  `zip` int(11) NOT NULL,
  `citizenship` int(11) NOT NULL,
  `duty_type` int(11) NOT NULL,
  `hire_date` date NOT NULL,
  `original_hire_date` date NOT NULL,
  `termination_date` date DEFAULT NULL,
  `termination_reason` text NOT NULL,
  `voluntary_termination` int(11) NOT NULL,
  `rehire_date` date DEFAULT NULL,
  `rate_type` int(11) NOT NULL,
  `rate` float NOT NULL,
  `pay_frequency` int(11) NOT NULL,
  `pay_frequency_txt` varchar(50) NOT NULL,
  `hourly_rate2` float NOT NULL,
  `hourly_rate3` float NOT NULL,
  `home_department` varchar(100) NOT NULL,
  `department_text` varchar(100) NOT NULL,
  `class_code` varchar(50) NOT NULL,
  `class_code_desc` varchar(100) NOT NULL,
  `class_acc_date` date DEFAULT NULL,
  `class_status` tinyint(4) NOT NULL,
  `is_super_visor` int(11) DEFAULT NULL,
  `super_visor_id` varchar(30) DEFAULT NULL,
  `supervisor_report` text NOT NULL,
  `dob` date DEFAULT NULL,
  `gender` int(11) NOT NULL,
  `marital_status` int(11) NOT NULL,
  `ethnic_group` varchar(100) NOT NULL,
  `eeo_class_gp` varchar(100) NOT NULL,
  `ssn` varchar(50) DEFAULT NULL,
  `work_in_state` varchar(200) NOT NULL,
  `live_in_state` int(11) NOT NULL,
  `home_email` varchar(50) NOT NULL,
  `business_email` varchar(50) NOT NULL,
  `home_phone` varchar(30) NOT NULL,
  `business_phone` varchar(30) NOT NULL,
  `cell_phone` varchar(30) NOT NULL,
  `emgr_contct_relation` varchar(50) NOT NULL,
  `emerg_contct` varchar(30) NOT NULL,
  `emrg_h_phone` varchar(30) NOT NULL,
  `emrg_w_phone` varchar(30) NOT NULL,
  `alt_em_contct` varchar(30) NOT NULL,
  `em_contact_person` text DEFAULT NULL,
  `alt_emg_h_phone` varchar(30) NOT NULL,
  `alt_emg_w_phone` varchar(30) NOT NULL,
  `password` varchar(150) DEFAULT NULL,
  `attendance_time` varchar(50) DEFAULT NULL COMMENT 'attendance time rule from rule_setup for each employee',
  `sos` varchar(11) DEFAULT NULL COMMENT 'SOS Number, based on this value employee will fall in Soc Sec NPF tax',
  `employee_type` varchar(11) NOT NULL,
  `monthly_work_hours` varchar(11) NOT NULL DEFAULT '173.33'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee_history`
--

INSERT INTO `employee_history` (`emp_his_id`, `employee_id`, `employee_status`, `pos_id`, `first_name`, `middle_name`, `last_name`, `email`, `phone`, `alter_phone`, `present_address`, `parmanent_address`, `picture`, `degree_name`, `university_name`, `cgp`, `passing_year`, `company_name`, `working_period`, `duties`, `supervisor`, `signature`, `is_admin`, `dept_id`, `division_id`, `maiden_name`, `state`, `city`, `zip`, `citizenship`, `duty_type`, `hire_date`, `original_hire_date`, `termination_date`, `termination_reason`, `voluntary_termination`, `rehire_date`, `rate_type`, `rate`, `pay_frequency`, `pay_frequency_txt`, `hourly_rate2`, `hourly_rate3`, `home_department`, `department_text`, `class_code`, `class_code_desc`, `class_acc_date`, `class_status`, `is_super_visor`, `super_visor_id`, `supervisor_report`, `dob`, `gender`, `marital_status`, `ethnic_group`, `eeo_class_gp`, `ssn`, `work_in_state`, `live_in_state`, `home_email`, `business_email`, `home_phone`, `business_phone`, `cell_phone`, `emgr_contct_relation`, `emerg_contct`, `emrg_h_phone`, `emrg_w_phone`, `alt_em_contct`, `em_contact_person`, `alt_emg_h_phone`, `alt_emg_w_phone`, `password`, `attendance_time`, `sos`, `employee_type`, `monthly_work_hours`) VALUES
(1, 1, 1, '3', 'Test', '', 'User', 'test@gmail.com', '2930545', '', NULL, NULL, './application/modules/employee/assets/images/2022-05-18/160.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 11, 0, '', 'Bangladesh', 'test', 1212, 1, 1, '2022-05-18', '2022-05-18', NULL, '', 0, NULL, 2, 0, 4, '', 0, 0, '', '', '', '', NULL, 1, 0, '', '', '2008-04-29', 1, 1, '', '', NULL, '', 1, '', '', '2930545', '', '2930545', '', '2930545', '2930545', '2930545', '', '2930545', '2930545', '2930545', 'e10adc3949ba59abbe56e057f20f883e', '12', '23232', '3', '173.33'),
(2, 2, 1, '1', 'Sakin', '', 'Rahman', 'sakib@gmail.com', '04358023', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 3, 0, '', 'Bangladesh', '', 0, 1, 1, '2022-05-19', '2022-05-19', NULL, '', 0, NULL, 2, 0, 4, '', 0, 0, '', '', '', '', NULL, 1, 1, '', '', '1983-05-07', 1, 1, '', '', NULL, '', 1, '', '', '04358023', '', '04358023', '', '04358023', '04358023', '04358023', '', '', '04358023', '04358023', 'e10adc3949ba59abbe56e057f20f883e', '12', '', '3', '173.33'),
(3, 3, 1, '1', 'Harunur', '', 'Rashid', 'harun@gmail.com', '0887432', '', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 3, 0, '', 'Andorra', '', 0, 1, 1, '2022-05-19', '2022-05-19', NULL, '', 0, NULL, 2, 0, 4, '', 0, 0, '', '', '', '', NULL, 1, 0, '', '', '1994-05-04', 1, 1, '', '', NULL, '', 1, '', '', '0887432', '', '0887432', '', '0887432', '0887432', '0887432', '', '', '0887432', '887431', 'e10adc3949ba59abbe56e057f20f883e', '10', '1212', '3', '173.33');

-- --------------------------------------------------------

--
-- Table structure for table `employee_performance`
--

CREATE TABLE `employee_performance` (
  `emp_per_id` int(11) NOT NULL,
  `employee_id` varchar(50) CHARACTER SET latin1 NOT NULL,
  `perform_sl` varchar(50) NOT NULL,
  `position_of_supervisor` varchar(200) DEFAULT NULL,
  `review_period` varchar(20) DEFAULT NULL,
  `note` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `date` varchar(50) CHARACTER SET latin1 NOT NULL,
  `note_by` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  `number_of_star` int(11) DEFAULT NULL,
  `total_scores` varchar(11) DEFAULT NULL COMMENT 'Total after saving the employee appraisal form',
  `employee_comments` text DEFAULT NULL,
  `emplo` int(11) NOT NULL,
  `status` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `create_by` varchar(11) NOT NULL,
  `update_date` date DEFAULT NULL,
  `updated_by` varchar(50) CHARACTER SET latin1 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee_performance`
--

INSERT INTO `employee_performance` (`emp_per_id`, `employee_id`, `perform_sl`, `position_of_supervisor`, `review_period`, `note`, `date`, `note_by`, `score`, `number_of_star`, `total_scores`, `employee_comments`, `emplo`, `status`, `create_date`, `create_by`, `update_date`, `updated_by`) VALUES
(1, '1', 'SL16528784435571', 'test', '6', NULL, '2022-05-18', NULL, NULL, NULL, '98', '', 0, NULL, '2022-05-18', '1', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employee_position`
--

CREATE TABLE `employee_position` (
  `emp_pos_id` int(10) UNSIGNED NOT NULL,
  `employee_id` varchar(50) CHARACTER SET latin1 NOT NULL,
  `first_name` varchar(50) CHARACTER SET latin1 NOT NULL,
  `position_name` varchar(50) CHARACTER SET latin1 NOT NULL,
  `position_details` varchar(100) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `employee_salary_payment`
--

CREATE TABLE `employee_salary_payment` (
  `emp_sal_pay_id` int(11) NOT NULL,
  `employee_id` varchar(50) CHARACTER SET latin1 NOT NULL,
  `total_salary` varchar(50) CHARACTER SET latin1 NOT NULL,
  `total_working_minutes` varchar(50) CHARACTER SET latin1 NOT NULL,
  `working_period` varchar(50) CHARACTER SET latin1 NOT NULL,
  `payment_due` varchar(50) CHARACTER SET latin1 NOT NULL,
  `payment_date` varchar(50) CHARACTER SET latin1 NOT NULL,
  `salary_name` varchar(100) DEFAULT NULL,
  `payment_type` int(11) DEFAULT NULL,
  `bank_name` varchar(250) DEFAULT NULL,
  `paid_by` varchar(50) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `employee_salary_setup`
--

CREATE TABLE `employee_salary_setup` (
  `e_s_s_id` int(11) UNSIGNED NOT NULL,
  `employee_id` varchar(30) CHARACTER SET latin1 NOT NULL,
  `sal_type` varchar(30) NOT NULL,
  `salary_type_id` varchar(30) CHARACTER SET latin1 NOT NULL,
  `amount` varchar(30) CHARACTER SET latin1 NOT NULL,
  `is_percentage` int(2) DEFAULT NULL COMMENT 'all amount will add or deduct on percent if true ',
  `create_date` date DEFAULT NULL,
  `update_date` datetime(6) DEFAULT NULL,
  `update_id` varchar(30) CHARACTER SET latin1 NOT NULL,
  `gross_salary` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `employee_sal_pay_type`
--

CREATE TABLE `employee_sal_pay_type` (
  `emp_sal_pay_type_id` int(11) UNSIGNED NOT NULL,
  `payment_period` varchar(50) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `emp_attendance`
--

CREATE TABLE `emp_attendance` (
  `att_id` int(10) UNSIGNED NOT NULL,
  `employee_id` varchar(50) CHARACTER SET latin1 NOT NULL,
  `date` varchar(30) CHARACTER SET latin1 NOT NULL,
  `sign_in` varchar(30) CHARACTER SET latin1 DEFAULT NULL,
  `sign_out` varchar(30) CHARACTER SET latin1 DEFAULT NULL,
  `staytime` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `equipment`
--

CREATE TABLE `equipment` (
  `equipment_id` int(11) NOT NULL,
  `equipment_name` varchar(100) NOT NULL,
  `type_id` int(11) NOT NULL,
  `model` varchar(100) NOT NULL,
  `serial_no` varchar(50) NOT NULL,
  `price` varchar(11) DEFAULT NULL,
  `is_assign` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `equipment_type`
--

CREATE TABLE `equipment_type` (
  `type_id` int(11) NOT NULL,
  `type_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `expense_information`
--

CREATE TABLE `expense_information` (
  `id` int(11) NOT NULL,
  `expense_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `financial_year`
--

CREATE TABLE `financial_year` (
  `id` int(4) NOT NULL,
  `yearName` varchar(30) NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `isCloseReq` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 2 COMMENT '1=active, 0=closed, 2=pending',
  `created_by` int(6) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(6) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `financial_year`
--

INSERT INTO `financial_year` (`id`, `yearName`, `startDate`, `endDate`, `isCloseReq`, `status`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1, '2019', '2019-01-01', '2019-12-31', 1, 0, 1, '2022-04-27 08:23:22', NULL, NULL),
(2, '2020', '2020-01-01', '2020-12-31', 1, 0, 1, '2022-04-27 09:56:34', NULL, NULL),
(3, '2021', '2021-01-01', '2021-12-31', 1, 0, 1, '2022-04-27 08:23:33', NULL, NULL),
(4, '2022', '2022-01-01', '2022-12-31', 0, 1, 1, '2022-04-27 08:18:07', 25, '2022-05-19 01:16:57');

-- --------------------------------------------------------

--
-- Table structure for table `gender`
--

CREATE TABLE `gender` (
  `id` int(11) NOT NULL,
  `gender_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gender`
--

INSERT INTO `gender` (`id`, `gender_name`) VALUES
(1, 'Male'),
(2, 'Female'),
(3, 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `gmb_bank_info`
--

CREATE TABLE `gmb_bank_info` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(11) NOT NULL,
  `acc_number` varchar(20) NOT NULL,
  `bank_name` varchar(50) NOT NULL,
  `bban_num` varchar(20) NOT NULL,
  `branch_address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gmb_bank_info`
--

INSERT INTO `gmb_bank_info` (`id`, `employee_id`, `acc_number`, `bank_name`, `bban_num`, `branch_address`) VALUES
(1, '7', '8374823912', 'Brac', '75454', 'Dhaka'),
(2, '8', '1234569999', 'Test', 'bb21', 'test addressssss'),
(3, '9', '111111111111', 'Test', '', ''),
(4, '10', '', '', '', ''),
(8, '11', '', '', '', ''),
(14, '12', '', '', '', ''),
(15, '13', '5433', 'MTB', '555', 'Dhk'),
(16, '1', '', '', '', ''),
(17, '2', '', '', '', ''),
(18, '3', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `gmb_employee_file`
--

CREATE TABLE `gmb_employee_file` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `tin_no` int(50) DEFAULT NULL COMMENT 'TIN No',
  `gross_salary` varchar(11) NOT NULL,
  `basic` varchar(11) NOT NULL,
  `transport` varchar(11) DEFAULT NULL,
  `house_rent` varchar(11) DEFAULT NULL,
  `medical` varchar(11) DEFAULT NULL,
  `other_allowance` varchar(11) DEFAULT NULL,
  `state_income_tax` varchar(11) DEFAULT NULL COMMENT 'State income tax in percent',
  `soc_sec_npf_tax` varchar(11) DEFAULT NULL COMMENT 'Soc.Sec.NPF tax in percent',
  `loan_deduct` varchar(11) DEFAULT NULL,
  `salary_advance` varchar(11) DEFAULT NULL,
  `lwp` varchar(11) DEFAULT NULL COMMENT 'leave without pay',
  `pf` varchar(11) DEFAULT NULL COMMENT 'providend fund',
  `stamp` varchar(11) DEFAULT NULL COMMENT 'deduct type',
  `medical_benefit` decimal(11,2) DEFAULT 0.00 COMMENT 'From Benefit tab of employee form',
  `family_benefit` decimal(11,2) DEFAULT 0.00 COMMENT 'From Benefit tab of employee form',
  `transportation_benefit` decimal(11,2) DEFAULT 0.00 COMMENT 'From Benefit tab of employee form',
  `other_benefit` decimal(11,2) DEFAULT 0.00 COMMENT 'From Benefit tab of employee form'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gmb_employee_file`
--

INSERT INTO `gmb_employee_file` (`id`, `employee_id`, `tin_no`, `gross_salary`, `basic`, `transport`, `house_rent`, `medical`, `other_allowance`, `state_income_tax`, `soc_sec_npf_tax`, `loan_deduct`, `salary_advance`, `lwp`, `pf`, `stamp`, `medical_benefit`, `family_benefit`, `transportation_benefit`, `other_benefit`) VALUES
(1, 1, 111, '1200', '1000', '200', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0.00', '0.00', '0.00', '0.00'),
(2, 2, 5675, '800', '500', '300', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '50.00', '50.00', '30.00', '0.00'),
(3, 3, 89786, '800', '600', '200', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0.00', '0.00', '0.00', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `gmb_employee_types`
--

CREATE TABLE `gmb_employee_types` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `details` text DEFAULT NULL,
  `CreateDate` date NOT NULL,
  `CreateBy` varchar(11) NOT NULL,
  `UpdateDate` date DEFAULT NULL,
  `UpdateBy` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gmb_employee_types`
--

INSERT INTO `gmb_employee_types` (`id`, `name`, `details`, `CreateDate`, `CreateBy`, `UpdateDate`, `UpdateBy`) VALUES
(1, 'Interns', 'Interns', '0000-00-00', '', '2022-04-06', '1'),
(2, 'Contractual', 'Contractual', '2022-04-06', '1', NULL, NULL),
(3, 'Full time', 'Full time', '2022-04-06', '1', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `gmb_emp_perform_criteria`
--

CREATE TABLE `gmb_emp_perform_criteria` (
  `id` int(11) NOT NULL,
  `emp_perform_type_id` int(20) NOT NULL COMMENT 'from gmb_emp_perform_type table',
  `name` varchar(250) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gmb_emp_perform_criteria`
--

INSERT INTO `gmb_emp_perform_criteria` (`id`, `emp_perform_type_id`, `name`, `description`) VALUES
(1, 1, 'Demonstrated Knowledge of duties & Quality of Work', NULL),
(2, 1, 'Timeliness of Delivery', NULL),
(3, 1, 'Impact of Achievement', NULL),
(4, 1, 'Overall Achievement of Goals/Objectives', NULL),
(5, 1, 'Going beyond the call of Duty', 'Extra(6,9 or 12) bonus point to be earned for going beyond the call of duty'),
(6, 2, 'Interpersonal skills & ability to work in a team environment', ''),
(7, 2, 'Attendance and Punctuality', ''),
(8, 2, 'Communication Skills', ''),
(9, 2, 'Contributing to IIHT Gambia’s mission)', '');

-- --------------------------------------------------------

--
-- Table structure for table `gmb_emp_perform_eval`
--

CREATE TABLE `gmb_emp_perform_eval` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `score` int(11) NOT NULL,
  `short_code` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gmb_emp_perform_eval`
--

INSERT INTO `gmb_emp_perform_eval` (`id`, `name`, `score`, `short_code`) VALUES
(1, 'Poor', 0, 'P'),
(2, 'Need Improvement', 3, 'NI'),
(3, 'Good', 6, 'G'),
(4, 'Very Good', 9, 'VG'),
(5, 'Excellent', 12, 'E');

-- --------------------------------------------------------

--
-- Table structure for table `gmb_emp_perform_type`
--

CREATE TABLE `gmb_emp_perform_type` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gmb_emp_perform_type`
--

INSERT INTO `gmb_emp_perform_type` (`id`, `name`, `description`) VALUES
(1, 'Assessment of Goals / Objective set during the review period', NULL),
(2, 'Assessment of other performance standards and indicators', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `gmb_emp_perform_values`
--

CREATE TABLE `gmb_emp_perform_values` (
  `id` int(11) NOT NULL,
  `emp_per_id` int(11) NOT NULL COMMENT 'From employee_performance table	',
  `emp_perform_type_id` int(11) NOT NULL COMMENT 'From gmb_emp_perform_type table	',
  `emp_perform_criteria_id` int(11) NOT NULL COMMENT 'From gmb_emp_perform_criteria table',
  `emp_perform_eval` int(11) NOT NULL,
  `score` varchar(20) NOT NULL,
  `comments` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gmb_emp_perform_values`
--

INSERT INTO `gmb_emp_perform_values` (`id`, `emp_per_id`, `emp_perform_type_id`, `emp_perform_criteria_id`, `emp_perform_eval`, `score`, `comments`) VALUES
(1, 1, 1, 1, 12, '12', ''),
(2, 1, 1, 2, 12, '12', ''),
(3, 1, 1, 3, 12, '12', ''),
(4, 1, 1, 4, 12, '12', ''),
(5, 1, 1, 5, 10, '10', ''),
(6, 1, 2, 6, 10, '10', ''),
(7, 1, 2, 7, 10, '10', ''),
(8, 1, 2, 8, 10, '10', ''),
(9, 1, 2, 9, 10, '10', '');

-- --------------------------------------------------------

--
-- Table structure for table `gmb_payroll_post`
--

CREATE TABLE `gmb_payroll_post` (
  `id` int(11) NOT NULL,
  `ssg_id` int(11) NOT NULL,
  `salary_month` varchar(200) NOT NULL,
  `payment_nature` varchar(20) NOT NULL COMMENT 'cash/bank ledger headcode',
  `amount` decimal(11,0) NOT NULL,
  `CreateDate` date NOT NULL,
  `CreateBy` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `gmb_perform_development_plan`
--

CREATE TABLE `gmb_perform_development_plan` (
  `id` int(11) NOT NULL,
  `emp_per_id` int(11) NOT NULL COMMENT 'From employee_performance table',
  `recommand_areas` text NOT NULL,
  `expected_outcomes` text DEFAULT NULL,
  `responsible_person` varchar(250) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gmb_perform_development_plan`
--

INSERT INTO `gmb_perform_development_plan` (`id`, `emp_per_id`, `recommand_areas`, `expected_outcomes`, `responsible_person`, `start_date`, `end_date`) VALUES
(43, 3, '1. Taking Initiative by adding values to IIHT', 'DP1', 'Hardik', '2022-04-25', '2022-04-26'),
(44, 3, '2. Being Proactive in your roles and responsibility', 'DP2', 'Hardik', '2022-04-25', '2022-04-26'),
(45, 3, '3. Leadership Skills', 'DP3', 'Hardik', '2022-04-25', '2022-04-26'),
(46, 5, 'R1', 'E1', 'RP1', '2022-04-27', '2022-04-27'),
(47, 5, 'R2', 'E2', 'RP2', '2022-04-28', '2022-04-28'),
(48, 5, 'R3', 'E3', 'RP3', '2022-04-29', '2022-04-29'),
(49, 5, 'R4', 'E4', 'RP4', '2022-04-30', '2022-04-30'),
(51, 6, 't', 't', 't', '2022-05-18', '2022-05-18'),
(52, 1, '1. Taking Initiative by adding values to IIHT...', 'Increasing Enrollment,\r\nAll Programs are up to date\r\nTrainers follow the curriculum and completing on time.', 'Hardik H Joshi', '2022-04-01', '2022-04-02'),
(53, 1, '2. Being Proactive in your roles and responsibility', 'Weekly Review on Student assignment, attendance, and Trainer Delivery', 'Hardik H Joshi', '2022-04-03', '2022-04-04'),
(54, 1, '3. Leadership Skills', 'Motivate your Staff and being involve with student and trainer to identify challenges and create opportunity.', 'Hardik H Joshi', '2022-04-05', '2022-04-06'),
(55, 1, 't', 't', 't', '2022-05-18', '2022-05-18');

-- --------------------------------------------------------

--
-- Table structure for table `gmb_perform_key_goals`
--

CREATE TABLE `gmb_perform_key_goals` (
  `id` int(11) NOT NULL,
  `emp_per_id` int(11) NOT NULL COMMENT 'From employee_performance table',
  `key_goals` text NOT NULL,
  `completion_period` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gmb_perform_key_goals`
--

INSERT INTO `gmb_perform_key_goals` (`id`, `emp_per_id`, `key_goals`, `completion_period`) VALUES
(44, 3, '1. 1. Assisting IIHT to reach there January 2022 Semester Goal which is 140 students', '2022-04-25'),
(45, 3, '2. All students record from Sep 2021 till the date need to update into the IIHT System', '2022-04-26'),
(46, 5, 'G1', '2022-04-27'),
(47, 5, 'G2', '2022-04-28'),
(49, 6, 'tt', '2022-05-18'),
(50, 1, '1. Assisting IIHT to reach there January 2022 Semester Goal which is 140 students', '2022-04-01'),
(51, 1, '2. All students record from Sep 2021 till the date need to update into the IIHT System', '2022-04-02'),
(52, 1, '3. Randomly monitoring Class on weekly basis and report to CEO and Higher Management', '2022-03-27'),
(53, 1, '4. Weekly Activities report on Program performance and need to share with myself and CEO', '2022-04-05'),
(54, 1, 'tt', '2022-05-18');

-- --------------------------------------------------------

--
-- Table structure for table `gmb_prform_sub_category`
--

CREATE TABLE `gmb_prform_sub_category` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `details` text DEFAULT NULL,
  `CreateDate` date NOT NULL,
  `CreateBy` varchar(11) NOT NULL,
  `UpdateDate` date DEFAULT NULL,
  `UpdateBy` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gmb_prform_sub_category`
--

INSERT INTO `gmb_prform_sub_category` (`id`, `name`, `details`, `CreateDate`, `CreateBy`, `UpdateDate`, `UpdateBy`) VALUES
(1, 'Attitude', 'Attitudes', '2022-04-07', '1', '2022-04-11', '1'),
(2, 'Punctuality', 'Punctuality', '2022-04-07', '1', NULL, NULL),
(3, 'Proejct complete', 'Proejct complete test', '2022-04-07', '1', '2022-04-07', '1');

-- --------------------------------------------------------

--
-- Table structure for table `gmb_rules_map`
--

CREATE TABLE `gmb_rules_map` (
  `id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `rule_id` varchar(20) NOT NULL COMMENT 'from gmbi_rules_setup table',
  `employee_id` varchar(20) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1 = active, 0 = inactive',
  `create_date` date NOT NULL,
  `create_by` varchar(11) NOT NULL,
  `update_date` date DEFAULT NULL,
  `update_by` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gmb_rules_map`
--

INSERT INTO `gmb_rules_map` (`id`, `type`, `rule_id`, `employee_id`, `status`, `create_date`, `create_by`, `update_date`, `update_by`) VALUES
(1, 'time', '8', '1', 0, '2022-05-18', '1', NULL, NULL),
(2, 'time', '12', '1', 1, '2022-05-18', '1', NULL, NULL),
(3, 'time', '12', '2', 1, '2022-05-19', '1', NULL, NULL),
(4, 'time', '10', '3', 1, '2022-05-19', '1', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `gmb_salary_advance`
--

CREATE TABLE `gmb_salary_advance` (
  `id` int(11) NOT NULL,
  `employee_id` int(50) NOT NULL,
  `salary_month` varchar(50) NOT NULL COMMENT 'for the month advance will be deducted',
  `amount` decimal(11,0) NOT NULL,
  `release_amount` decimal(11,0) DEFAULT 0,
  `paid` tinyint(4) NOT NULL DEFAULT 0 COMMENT 'paid_to_employee',
  `CreateDate` date NOT NULL,
  `CreateBy` int(11) NOT NULL,
  `UpdateDate` date DEFAULT NULL,
  `UpdateBy` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gmb_salary_advance`
--

INSERT INTO `gmb_salary_advance` (`id`, `employee_id`, `salary_month`, `amount`, `release_amount`, `paid`, `CreateDate`, `CreateBy`, `UpdateDate`, `UpdateBy`) VALUES
(1, 1, 'May 2022', '20', '20', 0, '2022-05-19', 1, '2022-05-19', 1);

-- --------------------------------------------------------

--
-- Table structure for table `gmb_salary_generate`
--

CREATE TABLE `gmb_salary_generate` (
  `id` int(11) NOT NULL,
  `sal_month_year` varchar(11) NOT NULL,
  `employee_id` varchar(11) NOT NULL,
  `tin_no` int(50) DEFAULT NULL COMMENT 'TIN No',
  `total_attendance` varchar(11) DEFAULT NULL COMMENT 'tagret_hours / days',
  `total_count` varchar(11) DEFAULT NULL COMMENT 'weorked_hours / days',
  `atten_allowance` decimal(11,2) DEFAULT NULL COMMENT 'based on taget hours / days',
  `gross` decimal(11,2) NOT NULL COMMENT 'from employee_file table',
  `basic` decimal(11,2) NOT NULL COMMENT 'from employee_file table',
  `transport` decimal(11,2) NOT NULL,
  `house_rent` decimal(11,2) DEFAULT NULL,
  `medical` decimal(11,2) DEFAULT NULL,
  `other_allowance` decimal(11,2) DEFAULT NULL,
  `gross_salary` decimal(11,2) NOT NULL COMMENT 'after adding all allowance with basic',
  `income_tax` decimal(11,2) DEFAULT NULL COMMENT 'from employee_file table it will convert to amount',
  `soc_sec_npf_tax` decimal(11,2) DEFAULT NULL COMMENT 'from employee_file table it will convert to amount',
  `employer_contribution` decimal(11,2) DEFAULT NULL COMMENT '10 % of basic if there soc.sec.tax available ',
  `icf_amount` decimal(11,0) NOT NULL COMMENT 'Id social security tax available',
  `loan_deduct` decimal(11,2) DEFAULT NULL,
  `loan_id` int(11) DEFAULT NULL COMMENT 'From grand_loan table',
  `salary_advance` decimal(11,2) DEFAULT NULL,
  `salary_adv_id` int(11) DEFAULT NULL COMMENT 'From gmb_salary_advance table',
  `lwp` decimal(11,2) DEFAULT NULL COMMENT 'leave without pay	',
  `pf` decimal(11,2) DEFAULT NULL COMMENT 'providend fund',
  `stamp` decimal(11,2) DEFAULT NULL COMMENT 'deduct type',
  `net_salary` decimal(11,2) NOT NULL COMMENT 'after deduct net amount from gross salary',
  `createDate` date NOT NULL,
  `createBy` varchar(11) NOT NULL,
  `updateDate` date DEFAULT NULL,
  `updateBy` varchar(11) DEFAULT NULL,
  `medical_benefit` decimal(11,2) NOT NULL,
  `family_benefit` decimal(11,2) NOT NULL,
  `transportation_benefit` decimal(11,2) NOT NULL,
  `other_benefit` decimal(11,2) NOT NULL,
  `normal_working_hrs_month` decimal(20,2) NOT NULL,
  `actual_working_hrs_month` decimal(20,2) NOT NULL,
  `hourly_rate_basic` decimal(20,2) NOT NULL,
  `hourly_rate_trasport_allowance` decimal(20,2) NOT NULL,
  `basic_salary_pro_rated` decimal(20,2) NOT NULL,
  `transport_allowance_pro_rated` decimal(20,2) NOT NULL,
  `basic_transport_allowance` decimal(20,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gmb_salary_generate`
--

INSERT INTO `gmb_salary_generate` (`id`, `sal_month_year`, `employee_id`, `tin_no`, `total_attendance`, `total_count`, `atten_allowance`, `gross`, `basic`, `transport`, `house_rent`, `medical`, `other_allowance`, `gross_salary`, `income_tax`, `soc_sec_npf_tax`, `employer_contribution`, `icf_amount`, `loan_deduct`, `loan_id`, `salary_advance`, `salary_adv_id`, `lwp`, `pf`, `stamp`, `net_salary`, `createDate`, `createBy`, `updateDate`, `updateBy`, `medical_benefit`, `family_benefit`, `transportation_benefit`, `other_benefit`, `normal_working_hrs_month`, `actual_working_hrs_month`, `hourly_rate_basic`, `hourly_rate_trasport_allowance`, `basic_salary_pro_rated`, `transport_allowance_pro_rated`, `basic_transport_allowance`) VALUES
(19, 'April 2022', '1', 111, '173.33', '188.08', NULL, '1200.00', '1000.00', '200.00', NULL, NULL, NULL, '1200.00', '0.00', '50.00', '100.00', '15', '150.00', 1, '0.00', NULL, NULL, NULL, NULL, '1000.00', '2022-05-19', '1', NULL, NULL, '0.00', '0.00', '0.00', '0.00', '173.33', '188.08', '5.77', '1.15', '1000.00', '200.00', '1200.00'),
(20, 'April 2022', '2', 5675, '173.33', '17.42', NULL, '800.00', '500.00', '300.00', NULL, NULL, NULL, '210.40', '0.00', '0.00', '0.00', '0', '0.00', NULL, '0.00', NULL, NULL, NULL, NULL, '210.40', '2022-05-19', '1', NULL, NULL, '50.00', '50.00', '30.00', '0.00', '173.33', '17.42', '2.88', '1.73', '50.25', '30.15', '210.40'),
(21, 'April 2022', '3', 89786, '173.33', '35', NULL, '800.00', '600.00', '200.00', NULL, NULL, NULL, '161.54', '0.00', '6.06', '12.12', '15', '200.00', 2, '0.00', NULL, NULL, NULL, NULL, '-44.52', '2022-05-19', '1', NULL, NULL, '0.00', '0.00', '0.00', '0.00', '173.33', '35.00', '3.46', '1.15', '121.16', '40.39', '161.54'),
(22, 'May 2022', '1', 111, '173.33', '0', NULL, '1200.00', '1000.00', '200.00', NULL, NULL, NULL, '0.00', '0.00', '0.00', '0.00', '0', '150.00', 1, '20.00', 1, NULL, NULL, NULL, '-170.00', '2022-05-19', '1', NULL, NULL, '0.00', '0.00', '0.00', '0.00', '173.33', '0.00', '5.77', '1.15', '0.00', '0.00', '0.00'),
(23, 'May 2022', '2', 5675, '173.33', '0', NULL, '800.00', '500.00', '300.00', NULL, NULL, NULL, '130.00', '0.00', '0.00', '0.00', '0', '0.00', NULL, '0.00', NULL, NULL, NULL, NULL, '130.00', '2022-05-19', '1', NULL, NULL, '50.00', '50.00', '30.00', '0.00', '173.33', '0.00', '2.88', '1.73', '0.00', '0.00', '130.00'),
(24, 'May 2022', '3', 89786, '173.33', '0', NULL, '800.00', '600.00', '200.00', NULL, NULL, NULL, '0.00', '0.00', '0.00', '0.00', '0', '0.00', NULL, '0.00', NULL, NULL, NULL, NULL, '0.00', '2022-05-19', '1', NULL, NULL, '0.00', '0.00', '0.00', '0.00', '173.33', '0.00', '3.46', '1.15', '0.00', '0.00', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `gmb_salary_sheet_generate`
--

CREATE TABLE `gmb_salary_sheet_generate` (
  `ssg_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `gdate` varchar(30) DEFAULT NULL,
  `start_date` varchar(30) NOT NULL,
  `end_date` varchar(30) NOT NULL,
  `generate_by` varchar(30) NOT NULL COMMENT 'user_id',
  `approved` tinyint(1) DEFAULT 0 COMMENT '1 = approved, 0= not approved',
  `approved_by` varchar(20) DEFAULT NULL,
  `approved_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gmb_salary_sheet_generate`
--

INSERT INTO `gmb_salary_sheet_generate` (`ssg_id`, `name`, `gdate`, `start_date`, `end_date`, `generate_by`, `approved`, `approved_by`, `approved_date`) VALUES
(9, 'April 2022', '2022-05-19', '2022-4-1', '2022-4-30', '1', 1, '1', '2022-05-19'),
(10, 'May 2022', '2022-05-19', '2022-5-1', '2022-5-31', '1', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `gmb_setup_rules`
--

CREATE TABLE `gmb_setup_rules` (
  `rule_id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL COMMENT 'time, basic, allowance, tax etc',
  `name` varchar(250) NOT NULL,
  `percent` varchar(50) DEFAULT NULL COMMENT 'if not amount, then percent',
  `fixed` varchar(20) DEFAULT NULL COMMENT 'if not percent, then amount',
  `start_time` varchar(20) DEFAULT NULL COMMENT 'time',
  `end_time` varchar(20) DEFAULT NULL COMMENT 'time',
  `description` text DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `created_by` varchar(20) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(20) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'if deleted then 1 , else 0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gmb_setup_rules`
--

INSERT INTO `gmb_setup_rules` (`rule_id`, `type`, `name`, `percent`, `fixed`, `start_time`, `end_time`, `description`, `created_at`, `created_by`, `updated_at`, `updated_by`, `is_deleted`) VALUES
(2, 'allowance', 'Tour allowance', NULL, '700', NULL, NULL, 'Tour allowance', '2022-04-02 02:55:52', '1', '2022-04-02 04:01:49', '1', 1),
(3, 'basic', 'Test', NULL, '5000', NULL, NULL, NULL, '2022-04-02 02:56:54', '1', NULL, NULL, 1),
(4, 'tax', 'Test', '5', NULL, NULL, NULL, 'fgfgfg', '2022-04-02 03:03:18', '1', NULL, NULL, 1),
(5, 'allowance', 'Medical allowance', NULL, '300', NULL, NULL, 'Medical allowance', '2022-04-02 03:05:34', '1', NULL, NULL, 1),
(6, 'time', 'Attendance time', NULL, NULL, '15:30', '20:30', 'Rule for attendance time', '2022-04-02 03:30:57', '1', '2022-04-02 03:59:41', '1', 0),
(8, 'time', 'Regular Worker', NULL, NULL, '10:00', '18:00', 'Regular Worker', '2022-04-04 02:01:02', '1', NULL, NULL, 1),
(9, 'allowance', 'testssssqq', NULL, '200', NULL, NULL, 'testsss', '2022-04-04 02:01:32', '1', '2022-04-04 02:01:43', '1', 1),
(10, 'time', 'Test attendance', NULL, NULL, '08:30', '16:30', '', '2022-04-04 03:01:48', '1', '2022-04-05 09:26:20', '1', 0),
(11, 'tax', 'Rule 1', '5', NULL, NULL, NULL, 'Rule 1', '2022-04-04 04:08:27', '1', '2022-04-05 09:27:40', '1', 1),
(12, 'time', 'Regular', NULL, NULL, '10:00', '18:00', 'Regular', '2022-05-18 06:55:07', '1', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `gmb_sub_cat_perform`
--

CREATE TABLE `gmb_sub_cat_perform` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(11) NOT NULL,
  `sub_cat_id` varchar(11) NOT NULL COMMENT 'id from gmb_prform_sub_category table',
  `points` int(11) NOT NULL COMMENT 'points out of 100',
  `CreateDate` date DEFAULT NULL,
  `CreateBy` varchar(11) DEFAULT NULL,
  `UpdateDate` date DEFAULT NULL,
  `UpdateBy` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gmb_sub_cat_perform`
--

INSERT INTO `gmb_sub_cat_perform` (`id`, `employee_id`, `sub_cat_id`, `points`, `CreateDate`, `CreateBy`, `UpdateDate`, `UpdateBy`) VALUES
(2, '1', '1', 33, '2022-03-07', '1', NULL, NULL),
(3, '1', '2', 32, '2022-04-07', '1', '2022-04-07', 1),
(5, '1', '1', 81, '2022-04-07', '1', '2022-04-07', 1),
(6, '4', '3', 100, '2022-04-11', '1', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `gmb_tax_calculation`
--

CREATE TABLE `gmb_tax_calculation` (
  `id` int(11) NOT NULL,
  `min` varchar(11) NOT NULL,
  `max` varchar(11) NOT NULL,
  `add_smount` varchar(11) NOT NULL DEFAULT '0',
  `tax_percent` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gmb_tax_calculation`
--

INSERT INTO `gmb_tax_calculation` (`id`, `min`, `max`, `add_smount`, `tax_percent`) VALUES
(1, '0', '2000', '0', '0'),
(2, '2000', '2833.33', '0', '5'),
(3, '2833.33', '3666.67', '41.67', '10'),
(4, '3666.67', '4499.99', '125', '15'),
(5, '4499.99', '5333.33', '250', '20'),
(6, '5333.33', '5333.33', '416.665', '25');

-- --------------------------------------------------------

--
-- Table structure for table `grand_loan`
--

CREATE TABLE `grand_loan` (
  `loan_id` int(11) NOT NULL,
  `employee_id` int(20) NOT NULL,
  `permission_by` varchar(30) CHARACTER SET latin1 NOT NULL,
  `loan_details` varchar(30) CHARACTER SET latin1 NOT NULL,
  `amount` decimal(30,0) NOT NULL,
  `interest_rate` decimal(30,0) NOT NULL,
  `installment` decimal(30,0) NOT NULL,
  `installment_period` int(11) NOT NULL COMMENT 'numbers of installments',
  `installment_cleared` int(11) NOT NULL DEFAULT 0 COMMENT 'Numbers of installment cleared from salary generate',
  `repayment_amount` decimal(11,0) NOT NULL,
  `released_amount` decimal(11,0) NOT NULL DEFAULT 0 COMMENT 'Summation of amount released after each salary generate',
  `releas` int(11) NOT NULL,
  `date_of_approve` varchar(30) CHARACTER SET latin1 NOT NULL,
  `repayment_start_date` varchar(30) CHARACTER SET latin1 NOT NULL,
  `created_by` varchar(30) CHARACTER SET latin1 NOT NULL,
  `updated_by` varchar(30) CHARACTER SET latin1 NOT NULL,
  `loan_status` varchar(30) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `grand_loan`
--

INSERT INTO `grand_loan` (`loan_id`, `employee_id`, `permission_by`, `loan_details`, `amount`, `interest_rate`, `installment`, `installment_period`, `installment_cleared`, `repayment_amount`, `released_amount`, `releas`, `date_of_approve`, `repayment_start_date`, `created_by`, `updated_by`, `loan_status`) VALUES
(1, 1, '2', 'Test', '300', '0', '150', 2, 2, '300', '300', 0, '2022-05-19', '2022-05-19', '', '1', '1'),
(2, 3, '2', 'Test', '200', '0', '200', 1, 1, '200', '200', 0, '2022-05-19', '2022-05-19', '', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `income_area`
--

CREATE TABLE `income_area` (
  `id` int(11) NOT NULL,
  `income_field` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `job_advertisement`
--

CREATE TABLE `job_advertisement` (
  `job_adv_id` int(10) UNSIGNED NOT NULL,
  `pos_id` varchar(30) CHARACTER SET latin1 NOT NULL,
  `adv_circular_date` varchar(30) CHARACTER SET latin1 NOT NULL,
  `circular_dadeline` varchar(30) CHARACTER SET latin1 NOT NULL,
  `adv_file` tinytext CHARACTER SET latin1 NOT NULL,
  `adv_details` varchar(255) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE `language` (
  `id` int(11) NOT NULL,
  `phrase` varchar(100) NOT NULL,
  `english` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`id`, `phrase`, `english`) VALUES
(2, 'login', 'Login'),
(3, 'email', 'Email Address'),
(4, 'password', 'Password'),
(5, 'reset', 'Reset'),
(6, 'dashboard', 'Dashboard'),
(7, 'home', 'Home'),
(8, 'profile', 'Profile'),
(9, 'profile_setting', 'Profile Setting'),
(10, 'firstname', 'First Name'),
(11, 'lastname', 'Last Name'),
(12, 'about', 'About'),
(13, 'preview', 'Preview'),
(14, 'image', 'Image'),
(15, 'save', 'Save'),
(16, 'upload_successfully', 'Upload Successfully!'),
(17, 'user_added_successfully', 'User Added Successfully!'),
(18, 'please_try_again', 'Please Try Again...'),
(19, 'inbox_message', 'Inbox Messages'),
(20, 'sent_message', 'Sent Message'),
(21, 'message_details', 'Message Details'),
(22, 'new_message', 'New Message'),
(23, 'receiver_name', 'Receiver Name'),
(24, 'sender_name', 'Sender Name'),
(25, 'subject', 'Subject'),
(26, 'message', 'Message'),
(27, 'message_sent', 'Message Sent!'),
(28, 'ip_address', 'IP Address'),
(29, 'last_login', 'Last Login'),
(30, 'last_logout', 'Last Logout'),
(31, 'status', 'Status'),
(32, 'delete_successfully', 'Delete Successfully!'),
(33, 'send', 'Send'),
(34, 'date', 'Date'),
(35, 'action', 'Action'),
(36, 'sl_no', 'SL No.'),
(37, 'are_you_sure', 'Are You Sure ? '),
(38, 'application_setting', 'Application Setting'),
(39, 'application_title', 'Application Title'),
(40, 'address', 'Address'),
(41, 'phone', 'Phone'),
(42, 'favicon', 'Favicon'),
(43, 'logo', 'Logo'),
(44, 'language', 'Language'),
(45, 'left_to_right', 'Left To Right'),
(46, 'right_to_left', 'Right To Left'),
(47, 'footer_text', 'Footer Text'),
(48, 'site_align', 'Application Alignment'),
(49, 'welcome_back', 'Welcome Back!'),
(50, 'please_contact_with_admin', 'Please Contact With Admin'),
(51, 'incorrect_email_or_password', 'Incorrect Email/Password'),
(52, 'select_option', 'Select Option'),
(53, 'ftp_setting', 'Data Synchronize [FTP Setting]'),
(54, 'hostname', 'Host Name'),
(55, 'username', 'User Name'),
(56, 'ftp_port', 'FTP Port'),
(57, 'ftp_debug', 'FTP Debug'),
(58, 'project_root', 'Project Root'),
(59, 'update_successfully', 'Update Successfully'),
(60, 'save_successfully', 'Save Successfully!'),
(62, 'internet_connection', 'Internet Connection'),
(63, 'ok', 'Ok'),
(64, 'not_available', 'Not Available'),
(65, 'available', 'Available'),
(66, 'outgoing_file', 'Outgoing File'),
(67, 'incoming_file', 'Incoming File'),
(68, 'data_synchronize', 'Data Synchronize'),
(69, 'unable_to_upload_file_please_check_configuration', 'Unable to upload file! please check configuration'),
(70, 'please_configure_synchronizer_settings', 'Please configure synchronizer settings'),
(71, 'download_successfully', 'Download Successfully'),
(72, 'unable_to_download_file_please_check_configuration', 'Unable to download file! please check configuration'),
(73, 'data_import_first', 'Data Import First'),
(74, 'data_import_successfully', 'Data Import Successfully!'),
(75, 'unable_to_import_data_please_check_config_or_sql_file', 'Unable to import data! please check configuration / SQL file.'),
(76, 'download_data_from_server', 'Download Data from Server'),
(77, 'data_import_to_database', 'Data Import To Database'),
(79, 'data_upload_to_server', 'Data Upload to Server'),
(80, 'please_wait', 'Please Wait...'),
(81, 'ooops_something_went_wrong', ' Ooops something went wrong...'),
(82, 'module_permission_list', 'Module Permission List'),
(83, 'user_permission', 'User Permission'),
(84, 'add_module_permission', 'Add Module Permission'),
(85, 'module_permission_added_successfully', 'Module Permission Added Successfully!'),
(86, 'update_module_permission', 'Update Module Permission'),
(87, 'download', 'Download'),
(88, 'module_name', 'Module Name'),
(89, 'create', 'Create'),
(90, 'read', 'Read'),
(91, 'update', 'Update'),
(92, 'delete', 'Delete'),
(93, 'module_list', 'Module List'),
(94, 'add_module', 'Add Module'),
(95, 'directory', 'Module Direcotory'),
(96, 'description', 'Description'),
(97, 'image_upload_successfully', 'Image Upload Successfully!'),
(98, 'module_added_successfully', 'Module Added Successfully'),
(99, 'inactive', 'Inactive'),
(100, 'active', 'Active'),
(101, 'user_list', 'User List'),
(102, 'see_all_message', 'See All Messages'),
(103, 'setting', 'Setting'),
(104, 'logout', 'Logout'),
(105, 'admin', 'Admin'),
(106, 'add_user', 'Add User'),
(107, 'user', 'User'),
(108, 'module', 'Module'),
(109, 'new', 'New'),
(110, 'inbox', 'Inbox'),
(111, 'sent', 'Sent'),
(112, 'synchronize', 'Synchronize'),
(113, 'data_synchronizer', 'Data Synchronizer'),
(114, 'module_permission', 'Module Permission'),
(115, 'backup_now', 'Backup Now!'),
(116, 'restore_now', 'Restore Now!'),
(117, 'backup_and_restore', 'Backup and Download'),
(118, 'captcha', 'Captcha Word'),
(119, 'database_backup', 'Database Backup'),
(120, 'restore_successfully', 'Restore Successfully'),
(121, 'backup_successfully', 'Backup Successfully'),
(122, 'filename', 'File Name'),
(123, 'file_information', 'File Information'),
(124, 'size', 'size'),
(125, 'backup_date', 'Backup Date'),
(126, 'overwrite', 'Overwrite'),
(127, 'invalid_file', 'Invalid File!'),
(128, 'invalid_module', 'Invalid Module'),
(129, 'remove_successfully', 'Remove Successfully!'),
(130, 'install', 'Install'),
(131, 'uninstall', 'Uninstall'),
(132, 'tables_are_not_available_in_database', 'Tables are not available in database.sql'),
(133, 'no_tables_are_registered_in_config', 'No tables are registerd in config.php'),
(134, 'enquiry', 'Enquiry'),
(135, 'read_unread', 'Read/Unread'),
(136, 'enquiry_information', 'Enquiry Information'),
(137, 'user_agent', 'User Agent'),
(138, 'checked_by', 'Checked By'),
(139, 'new_enquiry', 'New Enquiry'),
(140, 'crud', 'Crud'),
(141, 'view', 'View'),
(142, 'name', 'Name'),
(143, 'add', 'Address'),
(144, 'ph', 'Phone'),
(145, 'cid', 'SL No'),
(146, 'view_atn', 'AttendanceView'),
(147, 'mang', 'Employemanagement'),
(148, 'designation', 'Position'),
(149, 'test', 'Test'),
(150, 'sl', 'SL'),
(151, 'bdtask', 'BDTASK'),
(152, 'practice', 'Practice'),
(153, 'branch_name', 'Branch Name'),
(154, 'chairman_name', 'Chairman'),
(155, 'b_photo', 'Photo'),
(156, 'b_address', 'Address'),
(157, 'position', 'Position'),
(158, 'advertisement', 'Advertisement'),
(159, 'position_name', 'Position'),
(160, 'position_details', 'Details'),
(161, 'circularprocess', 'Recruitment'),
(162, 'pos_id', 'Position'),
(163, 'adv_circular_date', 'Publish Date'),
(164, 'circular_dadeline', 'Dadeline'),
(165, 'adv_file', 'Documents'),
(166, 'adv_details', 'Details'),
(167, 'attendance', 'Attendance'),
(168, 'employee', 'Employee'),
(169, 'emp_id', 'Employee Name'),
(170, 'sign_in', 'Sign In'),
(171, 'sign_out', 'Sign Out'),
(172, 'staytime', 'Stay Time'),
(173, 'abc', '1'),
(174, 'first_name', 'First Name'),
(175, 'last_name', 'Last Name'),
(176, 'alter_phone', 'Alternative Phone'),
(177, 'present_address', 'Present Address'),
(178, 'parmanent_address', 'Permanent Address'),
(179, 'candidateinfo', 'Candidate Info'),
(180, 'add_advertisement', 'Add Advertisement'),
(181, 'advertisement_list', 'Manage Advertisement '),
(182, 'candidate_basic_info', 'Candidate Information'),
(183, 'can_basicinfo_list', 'Manage Candidate'),
(184, 'add_canbasic_info', 'Add New Candidate'),
(185, 'candidate_education_info', 'Candidate Educational Info'),
(186, 'can_educationinfo_list', 'Candidate Edu Info list'),
(187, 'add_edu_info', 'Add Educational Info'),
(188, 'can_id', 'Candidate Id'),
(189, 'degree_name', 'Obtained Degree'),
(190, 'university_name', 'University'),
(191, 'cgp', 'CGPA'),
(192, 'comments', 'Comments'),
(193, 'signature', 'Signature'),
(194, 'candidate_workexperience', 'Candidate Work Experience'),
(195, 'can_workexperience_list', 'Work Experience list'),
(196, 'add_can_experience', 'Add Work Experience'),
(197, 'company_name', 'Company Name'),
(198, 'working_period', 'Working Period'),
(199, 'duties', 'Duties'),
(200, 'supervisor', 'Supervisor'),
(201, 'candidate_workexpe', 'Candidate Work Experience'),
(202, 'candidate_shortlist', 'Candidate Shortlist'),
(203, 'shortlist_view', 'Manage Shortlist'),
(204, 'add_shortlist', 'Add Shortlist'),
(205, 'date_of_shortlist', 'Shortlist Date'),
(206, 'interview_date', 'Interview Date'),
(207, 'submit', 'Submit'),
(208, 'candidate_id', 'Your ID'),
(209, 'job_adv_id', 'Job Position'),
(210, 'sequence', 'Sequence'),
(211, 'candidate_interview', 'Interview'),
(212, 'interview_list', 'Interview list'),
(213, 'add_interview', 'Interview'),
(214, 'interviewer_id', 'Interviewer'),
(215, 'interview_marks', 'Viva Marks'),
(216, 'written_total_marks', 'Written Total Marks'),
(217, 'mcq_total_marks', 'MCQ Total Marks'),
(218, 'recommandation', 'Recommandation'),
(219, 'selection', 'Selection'),
(220, 'details', 'Details'),
(221, 'candidate_selection', 'Candidate Selection'),
(222, 'selection_list', 'Selection List'),
(223, 'add_selection', 'Add Selection'),
(224, 'employee_id', 'Employee Id'),
(225, 'position_id', '1'),
(226, 'selection_terms', 'Selection Terms'),
(227, 'total_marks', 'Total Marks'),
(228, 'photo', 'Picture'),
(229, 'your_id', 'Your ID'),
(230, 'change_image', 'Change Photo'),
(231, 'picture', 'Photograph'),
(232, 'ad', 'Add'),
(233, 'write_y_p_info', 'Write Your Persoanal Information'),
(234, 'emp_position', 'Employee Position'),
(235, 'add_pos', 'Add Position'),
(236, 'list_pos', 'List of Position'),
(237, 'emp_salary_stup', 'Employee Salary SetUp'),
(238, 'add_salary_stup', 'Add Salary Setup'),
(239, 'list_salarystup', 'List of Salary Setup'),
(240, 'emp_sal_name', 'Salary Name'),
(241, 'emp_sal_type', 'Salary Type'),
(242, 'emp_performance', 'Employee Performance'),
(243, 'add_performance', 'Add Performance'),
(244, 'list_performance', 'List of Performance'),
(245, 'note', 'Note'),
(246, 'note_by', 'Note By'),
(247, 'number_of_star', 'Number of Star'),
(248, 'updated_by', 'Updated By'),
(249, 'emp_sal_payment', 'Manage Employee Salary'),
(250, 'add_payment', 'Add Payment'),
(251, 'list_payment', 'List of payment'),
(252, 'total_salary', 'Total Salary'),
(253, 'total_working_minutes', 'Working Hour'),
(254, 'payment_due', 'Payment Type'),
(255, 'payment_date', 'Date'),
(256, 'paid_by', 'Paid By'),
(257, 'view_employee_payment', 'Employee Payment List'),
(258, 'sal_payment_type', 'Salary Payment Type'),
(259, 'add_payment_type', 'Add Payment Type'),
(260, 'list_payment_type', 'List of Payment Type'),
(261, 'payment_period', 'Payment Period'),
(262, 'payment_type', 'Payment Type'),
(263, 'time', 'Punch Time'),
(264, 'shift', 'Shift'),
(265, 'location', 'Location'),
(266, 'logtype', 'Log Type'),
(267, 'branch', 'Location'),
(268, 'student', 'Students'),
(269, 'csv', 'CSV'),
(270, 'save_successfull', 'Your Data Save Successfully'),
(271, 'successfully_updated', 'Your Data Successfully Updated'),
(272, 'atn_form', 'Attendance Form'),
(273, 'atn_report', 'Attendance Reports'),
(274, 'end_date', 'To'),
(275, 'start_date', 'From'),
(276, 'done', 'Done'),
(277, 'employee_id_se', 'Write Employee Id or name here '),
(278, 'attendance_repor', 'Attendance Report'),
(279, 'e_time', 'End Time'),
(280, 's_time', 'Start Time'),
(281, 'atn_datewiserer', 'Date Wise Report'),
(282, 'atn_report_id', 'Date And Id base Report'),
(283, 'atn_report_time', 'Date And Time report'),
(284, 'payroll', 'Payroll'),
(285, 'loan', 'Loan'),
(286, 'loan_grand', 'Grant Loan'),
(287, 'add_loan', 'Add Loan'),
(288, 'loan_list', 'List of Loan'),
(289, 'loan_details', 'Loan Details'),
(290, 'amount', 'Amount'),
(291, 'interest_rate', 'Interest Percentage'),
(292, 'installment_period', 'Installment Period'),
(293, 'repayment_amount', 'Repayment Total'),
(294, 'date_of_approve', 'Approve Date'),
(295, 'repayment_start_date', 'Repayment From'),
(296, 'permission_by', 'Permitted By'),
(297, 'grand', 'Grant'),
(298, 'installment', 'Installment'),
(299, 'loan_status', 'status'),
(300, 'installment_period_m', 'Installment Period in Month'),
(301, 'successfully_inserted', 'Your loan Successfully Granted'),
(302, 'loan_installment', 'Loan Installment'),
(303, 'add_installment', 'Add Installment'),
(304, 'installment_list', 'List of Installment'),
(305, 'loan_id', 'Loan No'),
(306, 'installment_amount', 'Installment Amount'),
(307, 'payment', 'Payment'),
(308, 'received_by', 'Receiver'),
(309, 'installment_no', 'Install No'),
(310, 'notes', 'Notes'),
(311, 'paid', 'Paid'),
(312, 'loan_report', 'Loan Report'),
(313, 'e_r_id', 'Enter Your Employee ID'),
(314, 'leave', 'Leave'),
(315, 'add_leave', 'Add Leave'),
(316, 'list_leave', 'List of Leave'),
(317, 'dayname', 'Weekly Leave Day'),
(318, 'holiday', 'Holiday'),
(319, 'list_holiday', 'List of Holidays'),
(320, 'no_of_days', 'Number of Days'),
(321, 'holiday_name', 'Holiday Name'),
(322, 'set', 'SET'),
(323, 'tax', 'Tax'),
(324, 'tax_setup', 'Tax Setup'),
(325, 'add_tax_setup', 'Add Tax Setup'),
(326, 'list_tax_setup', 'List of Tax setup'),
(327, 'tax_collection', 'Tax collection'),
(328, 'start_amount', 'Start Amount'),
(329, 'end_amount', 'End Amount'),
(330, 'rate', 'Tax Rate'),
(331, 'date_start', 'Date Start'),
(332, 'amount_tax', 'Tax Amount'),
(333, 'collection_by', 'Collection By'),
(334, 'date_end', 'Date End'),
(335, 'income_net_period', 'Income  Net period'),
(336, 'default_amount', 'Default Amount'),
(337, 'add_sal_type', 'Add Salary Type'),
(338, 'list_sal_type', 'Salary Type List'),
(339, 'salary_type_setup', 'Salary Type Setup'),
(340, 'salary_setup', 'Salary SetUp'),
(341, 'add_sal_setup', 'Add Salary Setup'),
(342, 'list_sal_setup', 'Salary Setup List'),
(343, 'salary_type_id', 'Salary Type'),
(344, 'salary_generate', 'Salary Generate'),
(345, 'add_sal_generate', 'Generate Now'),
(346, 'list_sal_generate', 'Generated Salary List'),
(347, 'gdate', 'Generate Date'),
(348, 'start_dates', 'Start Date'),
(349, 'generate', 'Generate '),
(350, 'successfully_saved_saletup', ' Set up Successfull'),
(351, 's_date', 'Start Date'),
(352, 'e_date', 'End Date'),
(353, 'salary_payable', 'Payable Salary'),
(354, 'tax_manager', 'Tax'),
(355, 'generate_by', 'Generate By'),
(356, 'successfully_paid', 'Successfully Paid'),
(357, 'direct_empl', ' Employee'),
(358, 'add_emp_info', 'Add New Employee'),
(359, 'new_empl_pos', 'Add New Employee Position'),
(360, 'manage', 'Manage Position'),
(361, 'ad_advertisement', 'ADD POSITION'),
(362, 'moduless', 'Modules'),
(363, 'next', 'Next'),
(364, 'finish', 'Finish'),
(365, 'request', 'Request'),
(366, 'successfully_saved', 'Your Data Successfully Saved'),
(367, 'sal_type', 'Salary Type'),
(368, 'sal_name', 'Salary Name'),
(369, 'leave_application', 'Leave Application'),
(370, 'apply_strt_date', 'Application Start Date'),
(371, 'apply_end_date', 'Application End date'),
(372, 'leave_aprv_strt_date', 'Approve Start Date'),
(373, 'leave_aprv_end_date', 'Approved End Date'),
(374, 'num_aprv_day', 'Aproved Day'),
(375, 'reason', 'Reason'),
(376, 'approve_date', 'Approved Date'),
(377, 'leave_type', 'Leave Type'),
(378, 'apply_hard_copy', 'Application Hard Copy'),
(379, 'approved_by', 'Approved By'),
(380, 'notice', 'Notice Board'),
(381, 'noticeboard', 'Notice Board'),
(382, 'notice_descriptiion', 'Description'),
(383, 'notice_date', 'Notice Date'),
(384, 'notice_type', 'Notice Type'),
(385, 'notice_by', 'Notice By'),
(386, 'notice_attachment', 'Attachment'),
(387, 'account_name', 'Account Name'),
(388, 'account_type', 'Account Type'),
(389, 'account_id', 'Account Name'),
(390, 'transaction_description', 'Description'),
(391, 'payment_id', 'Payment'),
(392, 'create_by_id', 'Created By'),
(393, 'account', 'Account'),
(394, 'account_add', 'Add Account'),
(395, 'account_transaction', 'Transaction'),
(396, 'award', 'Award'),
(397, 'new_award', 'New Award'),
(398, 'award_name', 'Award Name'),
(399, 'aw_description', 'Award Description'),
(400, 'awr_gift_item', 'Gift Item'),
(401, 'awarded_by', 'Award By'),
(402, 'employee_name', 'Employee Name'),
(403, 'employee_list', 'Atn List'),
(404, 'department', 'Department'),
(405, 'department_name', 'Department Name '),
(406, 'clockout', 'ClockOut'),
(407, 'se_account_id', 'Select Account Name'),
(408, 'division', 'Sub Department'),
(409, 'add_division', 'Add Sub Department'),
(410, 'update_division', 'Update Sub Department'),
(411, 'division_name', 'Sub Department Name'),
(412, 'division_list', 'Manage Sub Department'),
(413, 'designation_list', 'Position List'),
(414, 'manage_designation', 'Manage Position'),
(415, 'add_designation', 'Add Position'),
(416, 'select_division', 'Select Division'),
(417, 'select_designation', 'Select Position'),
(418, 'asset', 'Asset'),
(419, 'asset_type', 'Asset Type'),
(420, 'add_type', 'Add Type'),
(421, 'type_list', 'Type List'),
(422, 'type_name', 'Type Name'),
(423, 'select_type', 'Select Type'),
(424, 'equipment_name', 'Equipment Name'),
(425, 'model', 'Model'),
(426, 'serial_no', 'Serial No'),
(427, 'equipment', 'Equipment'),
(428, 'add_equipment', 'Add Equipment'),
(429, 'equipment_list', 'Equipment List'),
(430, 'type', 'Type'),
(431, 'equipment_maping', 'Equipment Mapping'),
(432, 'add_maping', 'Add Mapping'),
(433, 'maping_list', 'Mapping List'),
(434, 'update_equipment', 'Update Equipment'),
(435, 'select_employee', 'Select Employee'),
(436, 'select_equipment', 'Select Equipment'),
(437, 'basic_info', 'Basic Info'),
(438, 'middle_name', 'Middle Name'),
(439, 'state', 'Country'),
(440, 'city', 'City'),
(441, 'zip_code', 'Zip Code'),
(442, 'maiden_name', 'Maiden Name'),
(443, 'add_employee', 'Add Employee'),
(444, 'manage_employee', 'Manage Employee'),
(445, 'employee_update_form', 'Employee Update Form'),
(446, 'what_you_search', 'What You Search'),
(447, 'search', 'Search'),
(448, 'duty_type', 'Duty Type'),
(449, 'hire_date', 'Hire Date'),
(450, 'original_h_date', 'Original Hire Date'),
(451, 'voluntary_termination', 'Voluntary Termination'),
(452, 'termination_reason', 'Termination Reason'),
(453, 'termination_date', 'Termination Date'),
(454, 're_hire_date', 'Re Hire Date'),
(455, 'rate_type', 'Rate Type'),
(456, 'pay_frequency', 'Pay Frequency'),
(457, 'pay_frequency_txt', 'Pay Frequency Text'),
(458, 'hourly_rate2', 'Hourly rate2'),
(459, 'hourly_rate3', 'Hourly Rate3'),
(460, 'home_department', 'Home Department'),
(461, 'department_text', 'Department Text'),
(462, 'benifit_class_code', 'Benefit Class code'),
(463, 'benifit_desc', 'Benefit Description'),
(464, 'benifit_acc_date', 'Benefit Accrual Date'),
(465, 'benifit_sta', 'Benefit Status'),
(466, 'super_visor_name', 'Supervisor Name'),
(467, 'is_super_visor', 'Is Supervisor'),
(468, 'supervisor_report', 'Supervisor Report'),
(469, 'dob', 'Date of Birth'),
(470, 'gender', 'Gender'),
(471, 'marital_stats', 'Marital Status'),
(472, 'ethnic_group', 'Ethnic Group'),
(473, 'eeo_class_gp', 'EEO Class'),
(474, 'ssn', 'SSN'),
(475, 'work_in_state', 'Work in State'),
(476, 'live_in_state', 'Live in State'),
(477, 'home_email', 'Home Email'),
(478, 'business_email', 'Business Email'),
(479, 'home_phone', 'Home Phone'),
(480, 'business_phone', 'Business Phone'),
(481, 'cell_phone', 'Cell Phone'),
(482, 'emerg_contct', 'Emergency Contact'),
(483, 'emerg_home_phone', 'Emergency Home Phone'),
(484, 'emrg_w_phone', 'Emergency Work Phone'),
(485, 'emer_con_rela', 'Emergency Contact Relation'),
(486, 'alt_em_contct', 'Alter Emergency Contact'),
(487, 'alt_emg_h_phone', 'Alt Emergency Home Phone'),
(488, 'alt_emg_w_phone', 'Alt Emergency  Work Phone'),
(489, 'reports', 'Reports'),
(490, 'employee_reports', 'Employee Reports'),
(491, 'demographic_report', 'Demographic Report'),
(492, 'posting_report', 'Positional Report'),
(493, 'custom_report', 'Custom Report'),
(494, 'benifit_report', 'Benefit Report'),
(495, 'demographic_info', 'Demographical Information'),
(496, 'positional_info', 'Positional Information'),
(497, 'assets_info', 'Assets Information'),
(498, 'custom_field', 'Custom Field'),
(499, 'custom_value', 'Custom Data'),
(500, 'adhoc_report', 'Adhoc Report'),
(501, 'asset_assignment', 'Asset Assignment'),
(502, 'assign_asset', 'Assign Assets'),
(503, 'assign_list', 'Assign List'),
(504, 'update_assign', 'Update Assign'),
(505, 'citizenship', 'Citizenship'),
(506, 'class_sta', 'Class status'),
(507, 'class_acc_date', 'Class Accrual date'),
(508, 'class_descript', 'Class Description'),
(509, 'class_code', 'Class Code'),
(510, 'return_asset', 'Return Assets'),
(511, 'dept_id', 'Department ID'),
(512, 'parent_id', 'Parent ID'),
(513, 'equipment_id', 'Equipment ID'),
(514, 'issue_date', 'Issue Date'),
(515, 'damarage_desc', 'Damarage Description'),
(516, 'return_date', 'Return Date'),
(517, 'is_assign', 'Is Assign'),
(518, 'emp_his_id', 'Employee History ID'),
(519, 'damarage_descript', 'Damage Description'),
(520, 'return', 'Return'),
(521, 'return_successfull', 'Return Successfull'),
(522, 'return_list', 'Return List'),
(523, 'custom_data', 'Custom Data'),
(524, 'passing_year', 'Passing Year'),
(525, 'is_admin', 'Is Admin'),
(526, 'zip', 'Zip Code'),
(527, 'original_hire_date', 'Original Hire Date'),
(528, 'rehire_date', 'Rehire Date'),
(529, 'class_code_desc', 'Class Code Description'),
(530, 'class_status', 'Class Status'),
(531, 'super_visor_id', 'Supervisor ID'),
(532, 'marital_status', 'Marital Status'),
(533, 'emrg_h_phone', 'Emergency Home Phone'),
(534, 'emgr_contct_relation', 'Emergency Contact Relation'),
(535, 'id', 'ID'),
(536, 'type_id', 'Equipment Type'),
(537, 'custom_id', 'Custom ID'),
(538, 'custom_data_type', 'Custom Data Type'),
(539, 'role_permission', 'Role Permission'),
(540, 'permission_setup', 'Permission Setup'),
(541, 'add_role', 'Add Role'),
(542, 'role_list', 'Role List'),
(543, 'user_access_role', 'User Access Role'),
(544, 'menu_item_list', 'Menu Item List'),
(545, 'ins_menu_for_application', 'Ins Menu  For Application'),
(546, 'menu_title', 'Menu Title'),
(547, 'page_url', 'Page Url'),
(548, 'parent_menu', 'Parent Menu'),
(549, 'role', 'Role'),
(550, 'role_name', 'Role Name'),
(551, 'single_checkin', 'Single Check In'),
(552, 'bulk_checkin', 'Bulk Check In'),
(553, 'manage_attendance', 'Manage Attendance'),
(554, 'attendance_list', 'Attendance List'),
(555, 'checkin', 'Check In'),
(556, 'checkout', 'Check Out'),
(557, 'stay', 'Stay'),
(558, 'attendance_report', 'Attendance Report'),
(559, 'work_hour', 'Work Hour'),
(560, 'cancel', 'Cancel'),
(561, 'confirm_clock', 'Confirm Checkout'),
(562, 'add_attendance', 'Add Attendance'),
(563, 'upload_csv', 'Upload CSV'),
(564, 'import_attendance', 'Import Attendance'),
(565, 'manage_account', 'Manage Account'),
(566, 'add_account', 'Add Account'),
(567, 'add_new_account', 'Add New Account'),
(568, 'account_details', 'Account Details'),
(569, 'manage_transaction', 'Manage Transaction'),
(570, 'add_expence', 'Add Experience'),
(571, 'add_income', 'Add Income'),
(572, 'return_now', 'Return Now !!'),
(573, 'manage_award', 'Manage Award'),
(574, 'add_new_award', 'Add New Award'),
(575, 'personal_information', 'Personal Information'),
(576, 'educational_information', 'Educational Information'),
(577, 'past_experience', 'Past Experience'),
(578, 'basic_information', 'Basic Information'),
(579, 'result', 'Result'),
(580, 'institute_name', 'Institute Name'),
(581, 'education', 'Education'),
(582, 'manage_shortlist', 'Manage Short List'),
(583, 'manage_interview', 'Manage Interview'),
(584, 'manage_selection', 'Manage Selection'),
(585, 'add_new_dept', 'Add New Department'),
(586, 'manage_dept', 'Manage Department'),
(587, 'successfully_checkout', 'Checkout Successful !'),
(588, 'grant_loan', 'Grant Loan'),
(589, 'successfully_installed', 'Successfully Installed'),
(590, 'total_loan', 'Total Loan'),
(591, 'total_amount', 'Total Amount'),
(592, 'filter', 'Filter'),
(593, 'weekly_holiday', 'Weekly Holiday'),
(594, 'manage_application', 'Manage Application'),
(595, 'add_application', 'Add Application'),
(596, 'manage_holiday', 'Manage Holiday'),
(597, 'add_more_holiday', 'Add More Holiday'),
(598, 'manage_weekly_holiday', 'Manage Weekly Holiday'),
(599, 'add_weekly_holiday', 'Add Weekly Holiday'),
(600, 'manage_granted_loan', 'Manage Granted Loan'),
(601, 'manage_installment', 'Manage Installment'),
(602, 'add_new_notice', 'Add New Notice'),
(603, 'manage_notice', 'Manage Notice'),
(604, 'salary_type', 'Salary Benefits'),
(605, 'manage_salary_generate', 'Manage Salary Generate'),
(606, 'generate_now', 'Generate Now'),
(607, 'add_salary_setup', 'Add Salary Setup'),
(608, 'manage_salary_setup', 'Manage Salary Setup'),
(609, 'add_salary_type', 'Add Salary Benefits'),
(610, 'manage_salary_type', 'Manage Salary Benefits'),
(611, 'manage_tax_setup', 'Manage Tax Setup'),
(612, 'setup_tax', 'Setup Tax'),
(613, 'add_more', 'Add More'),
(614, 'tax_rate', 'Tax Rate'),
(615, 'no', 'No'),
(616, 'setup', 'Setup'),
(617, 'biographicalinfo', 'Bio-Graphical Information'),
(618, 'positional_information', 'Positional Information'),
(620, 'benifits', 'Benefits'),
(621, 's_rate', 'Rate'),
(622, 'others_leave_application', 'Leave Application'),
(623, 'add_leave_type', 'Add Leave Type'),
(624, 'others_leave', 'Others Leave'),
(625, 'number_of_leave_days', 'Number of Leave Days'),
(626, 'app_date', 'Application Date'),
(627, 'apply_day', 'Apply Day'),
(628, 'time_zone', 'Time Zone '),
(629, 'accounts', 'Accounts'),
(630, 'c_o_a', 'Chart of Account'),
(631, 'debit_voucher', 'Debit Voucher'),
(632, 'credit_voucher', 'Credit Voucher'),
(633, 'contra_voucher', 'Contra Voucher'),
(634, 'journal_voucher', 'Journal Voucher'),
(635, 'voucher_approval', 'Voucher Approval'),
(636, 'account_report', 'Account Report'),
(637, 'voucher_report', 'Voucher Report'),
(638, 'cash_book', 'Cash Book'),
(639, 'bank_book', 'Bank Book'),
(640, 'general_ledger', 'General Ledger'),
(641, 'trial_balance', 'Trial Balance'),
(642, 'profit_loss', 'Profit Loss'),
(643, 'cash_flow', 'Cash Flow'),
(644, 'coa_print', 'Coa Print'),
(645, 'grant', 'Grant'),
(646, 'confirm', 'Confirm'),
(647, 'pay_now', 'Pay Now ??'),
(648, 'find', 'Find'),
(649, 'gl_head', 'GL Head'),
(650, 'acc_code', 'Account Code'),
(651, 'from_date', 'From Date'),
(652, 'to_date', 'To Date'),
(653, 'bank_book_voucher', 'Bank Book Voucher'),
(654, 'bank_book_report_of', 'Bank Book Report Of'),
(655, 'on', 'On'),
(656, 'to', 'To'),
(657, 'opening_balance', 'Opening Balance'),
(658, 'balance', 'Balance'),
(659, 'credit', 'Credit'),
(660, 'debit', 'Debit'),
(661, 'head_of_account', 'Head Of Account'),
(662, 'voucher_type', 'Voucher Type'),
(663, 'voucher_no', 'Voucher No'),
(664, 'transaction_date', 'Transaction Date'),
(665, 'cash_book_voucher', 'Cash Book Voucher'),
(666, 'cash_book_report_on', 'Cash Book Report On'),
(667, 'particulars', 'Particulars'),
(668, 'amount_in_dollar', 'Amount In Dollar'),
(669, 'opening_cash_and_equivalent', 'Opening Cash && Equivalent'),
(670, 'cash_flow_statement', 'Cash Flow Statement'),
(671, 'code', 'Code'),
(672, 'remark', 'Remark'),
(673, 'debit_account_head', 'Debit Account Head'),
(674, 'cash_in_hand', 'Cash In Hand'),
(675, 'credit_account_head', 'Credit Account Head'),
(676, 'transaction_head', 'Transaction Head'),
(677, 'with_details', 'With Details'),
(678, 'no_report', 'No Of Report'),
(679, 'total', 'Total'),
(680, 'current_balance', 'Current Balance'),
(681, 'pre_balance', 'Pre Balance'),
(682, 'trial_balance_with_opening_as_on', 'Trial Balance With Detail'),
(683, 'as_on', 'As On'),
(684, 'chairman', 'Chairman'),
(685, 'prepared_by', 'Prepared By'),
(686, 'statement_of_comprehensive_income', 'Statement Of Comprehensive Income'),
(687, 'from', 'From'),
(688, 'total_expenses', 'Total Expenses'),
(689, 'total_income', 'Total Income'),
(690, 'authorized_signature', 'Authorize Signature'),
(691, 'account_official', 'Account Official'),
(692, 'approved', 'Approved'),
(693, 'update_credit_voucher', 'Update Credit Voucher'),
(694, 'benefits', 'Benefit'),
(695, 'class', 'Class'),
(696, 'biographical_info', 'Biographical Info'),
(697, 'additional_address', 'Additional Address'),
(698, 'custom', 'Custom'),
(699, 'can_name', 'Candidate Name'),
(700, 'select', 'Select'),
(701, 'benefit_type', 'Benefit Type'),
(702, 'salary_benefits_type', 'Benefits Type'),
(703, 'addition', 'Addition'),
(704, 'basic', 'Basic'),
(705, 'deduction', 'Deduction'),
(706, 'gross_salary', 'Gross Salary'),
(707, 'total_loan_amount', 'Total Loan Amount'),
(708, 'loan_no', 'Loan No'),
(709, 'loan_issue_id', 'Loan Issue Id'),
(710, 'repayment', 'Repayment'),
(711, 'candidate_name', 'Candidate name'),
(712, 'employee_performance', 'Employee Performance'),
(713, 'check_in', 'Check In'),
(714, 'check_out', 'Check Out'),
(715, 'datewise_report', 'Date Wise Report'),
(716, 'employee_wise_report', 'Employee Wise Report'),
(717, 'date_in_time_report', 'Date & In Time Report'),
(718, 'report_view', 'Report View'),
(719, 'notice_form', 'Notice Form'),
(720, 'atn_log', 'Load Device Data'),
(721, 'atn_log_datewise', 'Attendance Log'),
(722, 'device_connection', 'Device Connection'),
(723, 'user_name', 'User Name'),
(724, 'in_time', 'In Time'),
(725, 'out_time', 'Out Time'),
(726, 'worked_hours', 'Worked Hours'),
(727, 'wasteg_hour', 'Wastage Hours'),
(728, 'net_hour', 'Net Hours'),
(729, 'device_information', 'Device Information'),
(730, 'plz_generate_an_ip', 'Please Generate an Ip'),
(731, 'device_name', 'Device Name'),
(732, 'device_ip', 'Device Ip'),
(733, 'device_user', 'Device User'),
(734, 'n_b_spendtime', 'N.B : You Spent'),
(735, 'hours_out_of_workinghour', 'Hours out of Working hours'),
(736, 'total_employee', 'Total Employee'),
(737, 'present_employee', 'Present Employee'),
(738, 'today_worked_hour', 'Today\'s Worked Hours'),
(739, 'todays_transaction', 'Today\'s Transaction'),
(740, 'device_model', 'Device Model'),
(741, 'download_sample_file', 'Download Sample File'),
(742, 'salar_month', 'Salary Month'),
(743, 'bank', 'Bank'),
(744, 'add_bank', 'Add Bank'),
(745, 'bank_list', 'Bank List'),
(746, 'update_bank', 'Update Bank'),
(747, 'bank_name', 'Bank Name'),
(748, 'account_number', 'Account Number'),
(749, 'cash_adjustment', 'Cash Adjustment'),
(750, 'adjustment_type', 'Adjustment Type'),
(751, 'bank_adjustment', 'Bank Adjustment'),
(752, 'expense', 'Expense'),
(753, 'expense_item', 'Expense Item'),
(754, 'expense_statement', 'Expense Statement'),
(755, 'expense_name', 'Expense Name'),
(756, 'add_expense', 'Add Expense'),
(757, 'print', 'Print'),
(758, 'income', 'Income'),
(759, 'income_field', 'Income Field'),
(760, 'update_income', 'Update Income'),
(761, 'income_statement', 'Income Statement'),
(762, 'attendence', 'Attendance'),
(763, 'working_day', 'Working Day'),
(764, 'salary_month', 'Salary Month'),
(765, 'salary_slip', 'Salary Slip'),
(766, 'head_code', 'Head Code'),
(767, 'particular', 'Particulars'),
(768, 'parent_type', 'Parent Type'),
(769, 'expense_sheet', 'Expense Sheet'),
(770, 'head_name', 'Head Name'),
(771, 'income_sheet', 'Income Sheet'),
(772, 'recruitment', ' Recruitment'),
(773, 'ref_number', 'Reference Number'),
(774, 'employee_signature', 'Employee Signature'),
(775, 'name_of_bank', 'Name Of Bank'),
(776, 'net_salary', 'Net Salary'),
(777, 'in_word', 'In Word'),
(778, 'total_deduction', 'Total Deduction'),
(779, 'total_addition', 'Total Addition'),
(780, 'basic_salary', 'Basic Salary'),
(781, 'earnings', 'Earnings'),
(782, 'salary_date', 'Salary Date'),
(783, 'money_receipt', 'Money Receipt'),
(784, 'balance_adjustment', 'Balance Adjustment'),
(785, 'parent_head', 'Parent Head'),
(786, 'child_head', 'Child Head'),
(787, 'due_amount', 'Due Amount'),
(788, 'loan_payment', 'Loan Payment'),
(789, 'todays_notice', 'Today\'s Notice'),
(790, 'attend_employee', 'Attend Employee'),
(791, 'department_wise', 'Department Wise'),
(792, 'income_expense', 'Income Expense'),
(793, 'todays_leave', 'Today\'s Leave'),
(794, 'leave_day', 'Leave Day'),
(795, 'leave_finish', 'Leave Finish'),
(796, 'loan_amount', 'Loan Amount'),
(797, 'leave_employee', 'Leave Employee'),
(798, 'absent_employee', 'Absent Employee'),
(799, 'worked_hour', 'Worked Hours'),
(800, 'new_password', 'New Password'),
(801, 'latitude', 'Latitude'),
(802, 'longitude', 'Longitude'),
(803, 'acceptablerange', 'Acceptable Range'),
(804, 'googleapi_authkey', 'Google Api Auth Key'),
(805, 'approve', 'Approve'),
(806, 'decline', 'Decline'),
(807, 'attendance_history', 'Attendance History'),
(808, 'give_attendance', 'Give Attendance'),
(809, 'ledger_history', 'Ledger History'),
(810, 'request_leave', 'Request Leave'),
(811, 'my_profile', 'My Profile'),
(812, 'salary_statement', 'Salary Statement'),
(813, 'notices', 'Notice'),
(814, 'working_hour', 'Working Hour'),
(815, 'qr_attendance', 'QR Attendance'),
(816, 'leave_remaining', 'Leave Remaining'),
(817, 'total_attendance', 'Total Attendance'),
(818, 'day_absent', 'Day Absent'),
(819, 'day_present', 'Day Present'),
(820, 'previous', 'Previous'),
(821, 'network_alert', 'Check Network Connection'),
(822, 'select_date', 'Select Date'),
(823, 'attendance_log', 'Attendance Log'),
(824, 'in', 'In'),
(825, 'out', 'Out'),
(826, 'load_more', 'Load More'),
(827, 'data_not_found', 'Data Not Found'),
(828, 'worked', 'Worked'),
(829, 'wastage', 'Wastage'),
(830, 'punch_time', 'Punch Time'),
(831, 'loading', 'Loading ...'),
(832, 'wrong_info_alert', 'Some Information Was Wrong There'),
(833, 'from_to_date_alrt', 'From And To Date Field Are Require'),
(834, 'qr_scan', 'QR Scan'),
(835, 'stop_scan', 'Stop Scan'),
(836, 'scan_again', 'Scan Again'),
(837, 'confirm_attendance', 'Confirm Attendance'),
(838, 'scan_alert', 'Your Scan Qr Was Wrong!! Please Scan Again'),
(839, 'attn_success_mgs', 'Attendance Successfully Saved'),
(840, 'you_r_not_in_office', 'You Are Not In The Office Location'),
(841, 'out_of_range', 'Out Of Range'),
(842, 'request_for_leave', 'Request For Leave'),
(843, 'leave_reason', 'Leave Reason'),
(844, 'write_reason', 'Write Reason'),
(845, 'send_request', 'Send Request'),
(846, 'leave_his_status', 'Leave History Status'),
(847, 'total_tax', 'Total Tax'),
(848, 'employment_date', 'Employment Date'),
(849, 'notice_details', 'Notice Details'),
(850, 'no_notice_to_show', 'No Notice to Show'),
(851, 'welcome_msg', 'Welcome To HRM'),
(852, 'enter_your_email', 'Enter Your Email'),
(853, 'enter_your_password', 'Enter Your Password'),
(854, 'cannot_remember_pass', 'Can not Remember Password'),
(855, 'forgot_password', 'Forgot Password'),
(856, 'email_pass_cannot_empt', 'Email or password can not be empty'),
(857, 'email_format_was_not_right', 'Email format was not Right!'),
(858, 'email_or_pass_not_matched', 'Email or password not matched!'),
(859, 'reset_your_password', 'Reset Your Password'),
(860, 'your_remember_password', 'You Remember Password'),
(861, 'back_to_login', 'Back to Login'),
(862, 'email_fild_can_not_empty', 'Email Field can not be empty'),
(863, 'email_not_found', 'Email Not Found'),
(864, 'successfully_send_email', 'Successfully Send Email!'),
(865, 'email_is_not_valid', 'Email Is Not Valid'),
(866, 'sorry_email_not_sent', 'Sorry Email Not Sent'),
(867, 'day_leave', 'Day Leave'),
(868, 'search_work_details', 'Search Work Details'),
(869, 'times', 'Time'),
(870, 'request_not_send', 'Request Not Send'),
(871, 'leave_request_success', 'Your Leave Request SuccessFul'),
(872, 'all_field_are_required', 'All Field Are Required'),
(873, 'plz_select_data_properly', 'Please select date properly'),
(874, 'pending', 'Pending'),
(875, 'unpaid', 'Unpaid'),
(876, 'salary_details', 'Salary Details'),
(877, 'worked_days', 'Worked Days'),
(878, 'monthly_attendance', 'Monthly Attendance'),
(879, 'year', 'Year'),
(880, 'month', 'Month'),
(881, 'missing_attendance', 'Missing Attendance'),
(882, 'daily_presents', 'Daily Presents'),
(883, 'all', 'All'),
(884, 'daily_absent', 'Daily Absent'),
(885, 'monthly_presents', 'Monthly Presents'),
(886, 'monthly_absent', 'Monthly Absent'),
(887, 'leave_report', 'Leave Report'),
(888, 'employee_on_leave', 'Employee On Leave'),
(889, 'leave_balance', 'Leave Balance'),
(890, 'without_weekend', 'Without Weekend'),
(891, 'new_recruited_employee', 'New Recruited'),
(892, 'todays_present', 'Today\'s Presents'),
(893, 'todays_absent', 'Today\'s Absents'),
(894, 'male', 'Male'),
(895, 'female', 'Female'),
(896, 'latest_notice', 'Latest Notice'),
(897, 'attendance_last_30days', 'Attendance (Last 30 Days)'),
(898, 'recruited_current_year', 'Recruited (Current Year)'),
(899, 'absent_15days', 'Absent (Last 15 Days)'),
(900, 'loanreceive', 'Loan Received'),
(901, 'current_year', 'Current Year'),
(902, 'awarded', 'Awarded'),
(903, 'loanpayment', 'Loan Payment'),
(904, 'login_info', 'Login Info'),
(905, 'user_email', 'User Email'),
(906, 'update_now', 'Update Now'),
(907, 'notesupdate', 'Note: If you want to update software,you Must have immediate previous version'),
(908, 'purchase_key', 'Purchase Key'),
(909, 'mobile_app_setting', 'Mobile App Setting(Addons)'),
(910, 'noupdates', 'No update available'),
(911, 'update_attendence', 'Update Attendence'),
(912, 'successfully_exported', 'Successfully Exported'),
(913, 'export_attendance', 'Export Attendance'),
(914, 'bulk_export', 'Bulk Export'),
(915, 'point_shared_by', 'Point Shared By'),
(916, 'update_collaborative_point', 'Update Collaborative Point'),
(917, 'add_collaborative_point', 'Add Collaborative Points'),
(918, 'update_management_point', 'Update Management Point'),
(919, 'point', 'Points'),
(920, 'add_management_point', 'Add Management Points'),
(921, 'management_point', 'Management Points'),
(922, 'update_point_category', 'Update Point Category'),
(923, 'point_category', 'Point Category'),
(924, 'add_point_category', 'Add Point Category'),
(925, 'attendence_end', 'Attendence End'),
(926, 'attendence_start', 'Attendence Start'),
(927, 'attendence_point', 'Attendance Points'),
(928, 'general_point', 'General Points'),
(929, 'employee_point', 'Employee Points'),
(930, 'collaborative_point', 'Collaborative Points'),
(931, 'management_point', 'Management Points'),
(932, 'point_categories', 'Point Categories'),
(933, 'point_settings', 'Point Settings'),
(934, 'rewardpoint', 'Reward Points'),
(935, 'successfully_uploaded', 'Successfully Uploaded'),
(936, 'buy_now', 'Buy Now'),
(937, 'invalid_purchase_key', 'Invalid Purchase Key'),
(938, 'addon', 'Add-ons'),
(939, 'procurements', 'Procurement'),
(940, 'requests', 'Request'),
(941, 'quotation', 'Quotation'),
(942, 'requesting_person', 'Requesting Person'),
(943, 'requesting_dept', 'Requesting Department'),
(944, 'request_list', 'Request List'),
(945, 'add_request', 'Add Request'),
(946, 'description_material', 'Description of materials/Goods/Service'),
(947, 'quantity', 'Quantity'),
(948, 'reason_for_requesting', 'Reason For Requesting'),
(949, 'edit_request', 'Edit Request'),
(950, 'request_form', 'Request Form'),
(951, 'unit_list', 'Units'),
(952, 'add_unit', 'Add Unit'),
(953, 'update_unit', 'Update Unit'),
(954, 'unit', 'Unit'),
(955, 'quote', 'Quote'),
(956, 'quotation_form', 'Quotation Form'),
(957, 'name_of_company', 'Name Of Company'),
(958, 'pin_or_equivalent', 'Pin Or Equivalent'),
(959, 'expected_date_delivery', 'Expected Date of Delivery'),
(960, 'place_of_delivery', 'Place of Delivery'),
(961, 'signature_and_stamp', 'Signature and Stamp'),
(962, 'update_quotation', 'Update Quotation'),
(963, 'bid_analysis', 'Bid Analysis'),
(964, 'bid_analysis_form', 'Bid Analysis Form'),
(965, 'bid_analysis_list', 'Bid Analysis List'),
(966, 'sba_no', 'SBA/ NO.'),
(967, 'location', 'Location'),
(968, 'attachment', 'Attachment'),
(969, 'company', 'Company'),
(970, 'reason_of_choosing', 'Reason Of Choosing'),
(971, 'remarks', 'Remarks'),
(972, 'vendor_name', 'Vendor Name'),
(973, 'purchase_order_no', 'PO#'),
(974, 'price_per_unit', 'Price/Unit'),
(975, 'bid_no', 'Bid No'),
(976, 'purchase_order', 'Purchase Order'),
(977, 'purchase_order_form', 'Purchase Order Form'),
(978, 'purchase_order_list', 'Purchase Order List'),
(979, 'title', 'Title'),
(980, 'update_purchase_order', 'Update Purchase Order'),
(981, 'good_received', 'Good Received'),
(982, 'good_received_form', 'Good Received Form'),
(983, 'good_received_list', 'Good Received List'),
(984, 'update_good_received', 'Update Good Received'),
(985, 'committee_list', 'Committee List'),
(986, 'add_committee', 'Add Committee'),
(987, 'update_committee', 'Update Committee'),
(988, 'committee', 'Committee'),
(989, 'signature', 'Signature Image'),
(990, 'committees', 'Committees'),
(991, 'create_committee', 'Create Committee'),
(992, 'request_approval', 'Request Approval'),
(993, 'reason_for_approval', 'Reason for Approval'),
(994, 'vendors', 'Vendors'),
(995, 'vendor', 'Add Vendor'),
(996, 'vendor_list', 'Vendor List'),
(997, 'mobile_no', 'Mobile No'),
(998, 'vendor_name', 'Vendor Name'),
(999, 'previous_balance', 'Previous Balance'),
(1000, 'create_vendor', 'Create Vendor'),
(1001, 'discount', 'Discount'),
(1002, 'price', 'Price'),
(1003, 'vendor_name', 'Vendor'),
(1004, 'add_request', 'Add Request'),
(1005, 'percentage', 'Percentage'),
(1006, 'projectmanagement', 'Project Management'),
(1007, 'clients', 'Clients'),
(1008, 'add_new_client', 'Add New Client'),
(1009, 'client_name', 'Client Name'),
(1010, 'manage_clients', 'Manage Clients'),
(1011, 'update_client', 'Update Client'),
(1012, 'projects', 'Projects'),
(1013, 'add_new_project', 'Add New Project'),
(1014, 'manage_projects', 'Manage Projects'),
(1015, 'project_name', 'Project Name'),
(1016, 'project_lead', 'Project Lead'),
(1017, 'approximate_tasks', 'Approximate Tasks'),
(1018, 'summary', 'Summary'),
(1019, 'project_duration', 'Project Duration'),
(1020, 'update_project', 'Update Project'),
(1021, 'task', 'Task'),
(1022, 'create_task', 'Create Task'),
(1023, 'manage_tasks', 'Manage Tasks'),
(1024, 'team_member', 'Team Member'),
(1025, 'priority', 'Priority'),
(1026, 'reporter', 'Reporter'),
(1027, 'assignee', 'Assignee'),
(1028, 'sprint', 'Sprint'),
(1029, 'sprints', 'Sprints'),
(1030, 'create_sprint', 'Create Sprint'),
(1031, 'sprint_name', 'Sprint Name'),
(1032, 'duration', 'Duration'),
(1033, 'sprint_goal', 'Sprint Goal'),
(1034, 'backlogs', 'Backlogs'),
(1035, 'manage_sprints', 'Manage Sprints'),
(1036, 'manage_backlogs', 'Manage Backlogs'),
(1037, 'transfer_tasks', 'Transfer Tasks'),
(1038, 'create_date', 'Create Date'),
(1039, 'transfer_to_backlogs', 'Transfer tasks to Backlogs'),
(1040, 'all_tasks', 'All Tasks'),
(1041, 'kanban_board', 'Kanban Board'),
(1042, 'own_tasks', 'Own Tasks'),
(1043, 'previous_version', 'Previous Version'),
(1044, 'get_retros', 'Get Retros'),
(1045, 'starting_date', 'Start Date'),
(1046, 'pm_reports', 'Reports'),
(1047, 'project_lists', 'Project Lists'),
(1049, 'to_do', 'To Do'),
(1050, 'in_progress', 'In Progress'),
(1051, 'created_by', 'Created By'),
(1052, 'client', 'Client'),
(1053, 'reward_points', 'Reward Points'),
(1054, 'sprint_started', 'Sprint Start'),
(1055, 'ending_date', 'End Date'),
(1056, 'team_members', 'Team Members'),
(1057, 'inactive_employee', 'Inactive Employee'),
(1058, 'manage_inactive_employee', 'Manage Inactive Employee'),
(1059, 'attachment', 'Attachment'),
(1060, 'company', 'Company'),
(1061, 'create_financial_year', 'Create financial year'),
(1062, 'financial_year', 'Financial year'),
(1063, 'setup_rules', 'Setup Rules'),
(1064, 'rules', 'Rules'),
(1065, 'add_new_rule', 'Add New Rule'),
(1066, 'manage_rules', 'Manage Rules'),
(1068, 'percent', 'Percent'),
(1069, 'fixed', 'Fixed'),
(1070, 'start_time', 'Start Time'),
(1071, 'end_time', 'End Time'),
(1072, 'financial_year_start_date', 'Financial year start date'),
(1073, 'financial_year_end_date', 'Financial year end date'),
(1074, 'allocated_time', 'Task Time (In minutes)'),
(1075, 'rules_list', 'Rules List'),
(1076, 'allowance', 'Allowance'),
(1077, 'allowance_amount', 'Allowance Amount'),
(1078, 'rule', 'Rule'),
(1079, 'financiall_year', 'Financial Year'),
(1080, 'transdate', 'Transaction Date'),
(1081, 'lateness_early_closing_report', 'Lateness and early closing report'),
(1082, 'attendance_time', 'Attendance Time'),
(1083, 'lateness_early_closing', 'Lateness and early closing'),
(1084, 'report', 'report'),
(1085, 'currency_symbol', 'Currency Symbol'),
(1086, 'employee_type', 'Employee Type'),
(1087, 'employee_types', 'Employee Types'),
(1088, 'add_employee_type', 'Add employee type'),
(1089, 'manage_types', 'Manage types'),
(1090, 'update_employee_type', 'Update employee type'),
(1091, 'perform_sub_category', 'Performance Sub Category'),
(1092, 'performance', 'Performance'),
(1093, 'performance_category', 'Performance Category'),
(1094, 'category_wise_performance', 'Category Wise Performance'),
(1095, 'manage_sub_category', 'Manage Sub Category'),
(1096, 'add_sub_category', 'Add Sub Category'),
(1097, 'update_sub_category', 'Update Sub Category'),
(1098, 'sub_category', 'Sub Category'),
(1099, 'manage_category_wise_performance', 'Manage Category Wise Performance'),
(1100, 'add_category_wise_performance', 'Add Category Wise Performance'),
(1101, 'update_category_wise_performance', 'Update Category Wise Performance'),
(1102, 'score', 'Score'),
(1103, 'please_enter_HeadName', 'Chart of Account head name can\'t be blank'),
(1104, 'HeadName', 'Chart of Account head name'),
(1105, 'message_coa_create', 'Chart of Account created successfully'),
(1106, 'message_coa_update', 'Chart of Account updated successfully'),
(1107, 'bank_info', 'Bank Info'),
(1108, 'account_number', 'Account Number'),
(1109, 'bank_name', 'Bank Name'),
(1110, 'bban_num', 'BBAN Number'),
(1111, 'branch_address', 'Branch Address'),
(1112, 'salary_info', 'Salary Info'),
(1113, 'gross_salary', 'Gross Salary'),
(1114, 'transport', 'Transport'),
(1115, 'house_rent', 'House Rent'),
(1116, 'medical', 'Medical'),
(1117, 'other_allowance', 'Other Allowance'),
(1118, 'state_income_tax', 'State Income Tax'),
(1119, 'loan_deduct', 'Loan Deduct'),
(1120, 'salary_advance', 'Salary Advance'),
(1121, 'stamp', 'Stamp'),
(1122, 'allowance', 'Allowance'),
(1123, 'soc_sec_npf_tax', 'Soc.Sec.Npf'),
(1124, 'tin_no', 'TIN No'),
(1126, 'balance_sheet', 'Balance Sheet'),
(1127, 'sos', 'SOS'),
(1128, 'subtype', 'Subtype'),
(1129, 'generate_salary', 'Generate Salary'),
(1130, 'create_opening_balance', 'Create opening balance'),
(1131, 'create_debit_voucher', 'Create debit voucher'),
(1132, 'create_credit_voucher', 'Create credit voucher'),
(1133, 'VNo', 'VNo'),
(1134, 'reverseHead', 'Reverse Account Name'),
(1135, 'comment', 'Comment'),
(1136, 'ledgerComment', 'Ledger Comment'),
(1137, 'create_journal_voucher', 'Create journal voucher'),
(1138, 'create_contra_voucher', 'Create contra voucher'),
(1139, 'employee_salary_chart', 'Employee Salary Chart'),
(1140, 'ledger_comment', 'Ledger Comment'),
(1141, 'monthly_work_hours', 'Monthly Work Hours'),
(1142, 'reverse_account_head', 'Reverse Account Head'),
(1143, 'salary_advance', 'Salary Advance'),
(1144, 'release_amount', 'Release Amount'),
(1145, 'add_salary_advance', 'Add Salary Advance'),
(1146, 'manage_salary_advance', 'Manage Salary Advance'),
(1147, 'paid_to_employee', 'Paid To Employee'),
(1148, 'update_salary_advance', 'Update Salary Advance'),
(1149, 'general-ledger-filter', 'General Ledger Filter'),
(1150, 'closing_balance', 'Closing Balance'),
(1151, 'installment_cleared', 'Installment Cleared'),
(1152, 'ledger_comment', 'Ledger Comment'),
(1153, 'trial_balance_filter', 'Trial balance filter'),
(1154, 'cash_book_report', 'Cash book report'),
(1155, 'bank', 'Bank'),
(1156, 'bank_book_report', 'Bank book report'),
(1157, 'in_words', 'In Words'),
(1158, 'review_period', 'Review Period'),
(1159, 'voucher_date', 'Voucher Date'),
(1160, 'authorised_by', 'Authorised By'),
(1161, 'pay_by', 'Pay By'),
(1162, 'credit_voucher', 'Credit Voucher'),
(1163, 'debit_voucher', 'Debit Voucher'),
(1164, 'profit_loss_report', 'Profit loss report'),
(1165, 'employee_comments', 'Employee Comments'),
(1166, 'post', 'Post'),
(1167, 'total_equity', 'Total Shareholder\'s Equity'),
(1168, 'total_liabilities_equity', 'Total Liabilities & Shareholder\'s Equity'),
(1169, 'total_liabilities', 'Total Liabilities'),
(1170, 'total_assets', 'Total Assets'),
(1171, 'net_amount', 'Net Amount'),
(1172, 'gross_profit', 'Gross Profit'),
(1173, 'total_income', 'Total Income'),
(1174, 'total_expense', 'Total Expenses'),
(1175, 'total_cogs', 'Total COGS'),
(1176, 'fixedasset_schedule', 'Fixed Assets Schedule'),
(1177, 'fixed_assets_report', 'Fixed Assets Annual Report'),
(1178, 'employee_hourly_rate_computation', 'Employee Hourly Rate Computation'),
(1179, 'day_book', 'Day Book'),
(1180, 'voucher', 'Voucher'),
(1181, 'accrual_basis', 'Accrual Basis'),
(1182, 'cash_basis', 'Cash Basis'),
(1183, 'receipt_payment', 'Receipt & Payment'),
(1184, 'approved_date', 'Approved Date'),
(1185, 'receipt', 'Receipt'),
(1186, 'payments', 'Payments'),
(1187, 'cashinhand', 'Cash in Hand'),
(1188, 'cash_bank', 'Cash at Bank'),
(1189, 'advance', 'advance'),
(1190, 'gtotal', 'Ground Total'),
(1191, 'are_you_sure_reverse', 'Are you sure reverse this voucher'),
(1192, 'payroll_&_loan', 'Payroll & Loan'),
(1193, 'loan_to_employee', 'Loan To Employee'),
(1194, 'sub_ledger', 'Sub Ledger'),
(1195, 'npf3_soc_sec_tax_report', 'NPF3 Social Security Tax'),
(1196, 'account_head', 'Account Head'),
(1197, 'sub_account', 'Sub Account'),
(1198, 'create_date', 'Create date'),
(1199, 'sate_income_tax_schedule', 'Sate Income Tax Schedule'),
(1200, 'sate_income_tax_report', 'Sate Income Tax Report'),
(1201, 'cash', 'Cash'),
(1202, 'iicf3_contribution_report', 'IICF3 Contribution Report'),
(1203, 'gra_ret_5', 'GRA RET 5'),
(1204, 'social_security_npf_icf', 'Soc.Sec.(NPF & ICF)'),
(1205, 'salary_confirmation_form', 'Salary Confirmation Form'),
(1206, 'opening_balance_fixed_assets', 'Opening Balance of Fixed Assets'),
(1207, 'additions', 'Additions'),
(1208, 'adjustment', 'Adjustment'),
(1209, 'closing_balance_fixed_assets', 'Closing Balance of Fixed Assets'),
(1210, 'depreciation_rate', 'Depreciation Rate'),
(1211, 'depreciation_value', 'Depreciation Value'),
(1212, 'opening_balance_accumulated_depreciation', 'Opening Balance of Accumulated Depreciation'),
(1213, 'closing_balance_accumulated_depreciation', 'Closing Balance of Accumulated Depreciation'),
(1214, 'written_down_value', 'Written Down Value'),
(1215, 'expenditure_statement', 'Statement of Expenditure'),
(1216, 'year_closing', 'Year Closing'),
(1217, 'predefined_accounts', 'Predefined Accounts'),
(1218, 'select_account', 'Select Account'),
(1219, 'bank_reconciliation', 'Bank Reconciliation'),
(1220, 'bank_reconciliation_report', 'Bank Reconciliation Report'),
(1221, 'check_no', 'Check No\r\n'),
(1222, 'no_data_found', 'There is no record found'),
(1223, 'check_date', 'Check Date'),
(1224, 'unapproved', 'Unapproved'),
(1225, 'close_financial_year', 'Close financial year'),
(1226, 'year_close', 'Year Close'),
(1227, 'account_delete_message', 'Some transation occured to this bank account. first reverse this transation then try again!');

-- --------------------------------------------------------

--
-- Table structure for table `leave_apply`
--

CREATE TABLE `leave_apply` (
  `leave_appl_id` int(11) NOT NULL,
  `employee_id` varchar(20) NOT NULL,
  `leave_type_id` int(2) NOT NULL,
  `apply_strt_date` date DEFAULT NULL,
  `apply_end_date` date DEFAULT NULL,
  `apply_day` int(11) NOT NULL,
  `leave_aprv_strt_date` date DEFAULT NULL,
  `leave_aprv_end_date` date DEFAULT NULL,
  `num_aprv_day` varchar(15) NOT NULL,
  `reason` varchar(100) NOT NULL,
  `apply_hard_copy` text DEFAULT NULL,
  `apply_date` date DEFAULT NULL,
  `approve_date` date DEFAULT NULL,
  `approved_by` varchar(30) NOT NULL,
  `leave_type` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `leave_type`
--

CREATE TABLE `leave_type` (
  `leave_type_id` int(2) NOT NULL,
  `leave_type` varchar(50) NOT NULL,
  `leave_days` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `loan_installment`
--

CREATE TABLE `loan_installment` (
  `loan_inst_id` int(11) NOT NULL,
  `employee_id` varchar(21) CHARACTER SET latin1 NOT NULL,
  `loan_id` varchar(21) CHARACTER SET latin1 NOT NULL,
  `installment_amount` varchar(20) CHARACTER SET latin1 NOT NULL,
  `payment` varchar(20) CHARACTER SET latin1 NOT NULL,
  `date` varchar(20) CHARACTER SET latin1 NOT NULL,
  `received_by` varchar(20) CHARACTER SET latin1 NOT NULL,
  `installment_no` varchar(20) CHARACTER SET latin1 NOT NULL DEFAULT '1',
  `notes` varchar(80) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `marital_info`
--

CREATE TABLE `marital_info` (
  `id` int(11) NOT NULL,
  `marital_sta` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `marital_info`
--

INSERT INTO `marital_info` (`id`, `marital_sta`) VALUES
(1, 'Single'),
(2, 'Married'),
(3, 'Divorced'),
(4, 'Widowed'),
(5, 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `datetime` datetime NOT NULL,
  `sender_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=unseen, 1=seen, 2=delete',
  `receiver_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=unseen, 1=seen, 2=delete'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE `module` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `directory` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`id`, `name`, `description`, `image`, `directory`, `status`) VALUES
(39, 'attendance Details ', 'Simple attendance processing System', 'application/modules/attendance/assets/images/thumbnail.jpg', 'attendance', 1),
(40, 'Employee circulation processing System', 'Simple circulation processing System', 'application/modules/circularprocess/assets/images/thumbnail.jpg', 'circularprocess', 1),
(41, 'Employee Details ', 'Simple hrm processing System', 'application/modules/employee/assets/images/thumbnail.jpg', 'employee', 1),
(42, 'Leave Details ', 'Simple leave processing System', 'application/modules/leave/assets/images/thumbnail.jpg', 'leave', 1),
(43, 'Loan Details ', 'Simple loan processing System', 'application/modules/loan/assets/images/thumbnail.jpg', 'loan', 1),
(44, 'TAX Details ', 'Simple tax processing System', 'application/modules/tax/assets/images/thumbnail.jpg', 'tax', 1),
(46, 'Payroll Details ', 'Simple payroll processing System', 'application/modules/payroll/assets/images/thumbnail.jpg', 'payroll', 1),
(48, 'Account', 'Account information', 'application/modules/account/assets/images/thumbnail.jpg', 'account', 1),
(49, 'Notice Details ', 'Simple Notice', 'application/modules/noticeboard/assets/images/thumbnail.jpg', 'noticeboard', 1),
(50, 'Award Details ', 'Simple Award', 'application/modules/award/assets/images/thumbnail.jpg', 'award', 1),
(52, 'asset Details ', 'Simple asset', 'application/modules/asset/assets/images/thumbnail.jpg', 'asset', 1);

-- --------------------------------------------------------

--
-- Table structure for table `module_permission`
--

CREATE TABLE `module_permission` (
  `id` int(11) NOT NULL,
  `fk_module_id` int(11) NOT NULL,
  `fk_user_id` int(11) NOT NULL,
  `create` tinyint(1) DEFAULT NULL,
  `read` tinyint(1) DEFAULT NULL,
  `update` tinyint(1) DEFAULT NULL,
  `delete` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `module_purchase_key`
--

CREATE TABLE `module_purchase_key` (
  `id` int(11) NOT NULL,
  `identity` varchar(250) DEFAULT NULL,
  `purchase_key` varchar(255) DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `notice_board`
--

CREATE TABLE `notice_board` (
  `notice_id` int(11) NOT NULL,
  `notice_descriptiion` text NOT NULL,
  `notice_date` date NOT NULL,
  `notice_type` varchar(50) NOT NULL,
  `notice_by` varchar(50) NOT NULL,
  `notice_attachment` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payroll_holiday`
--

CREATE TABLE `payroll_holiday` (
  `payrl_holi_id` int(11) UNSIGNED NOT NULL,
  `holiday_name` varchar(30) CHARACTER SET latin1 NOT NULL,
  `start_date` varchar(30) CHARACTER SET latin1 NOT NULL,
  `end_date` varchar(30) CHARACTER SET latin1 NOT NULL,
  `no_of_days` varchar(30) CHARACTER SET latin1 NOT NULL,
  `created_by` varchar(30) CHARACTER SET latin1 NOT NULL,
  `updated_by` varchar(30) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `payroll_tax_collection`
--

CREATE TABLE `payroll_tax_collection` (
  `tax_coll_id` int(11) UNSIGNED NOT NULL,
  `employee_id` varchar(30) CHARACTER SET latin1 NOT NULL,
  `date_start` varchar(30) CHARACTER SET latin1 NOT NULL,
  `amount_tax` varchar(30) CHARACTER SET latin1 NOT NULL,
  `collection_by` varchar(30) CHARACTER SET latin1 NOT NULL,
  `date_end` varchar(30) CHARACTER SET latin1 NOT NULL,
  `income_net_period` varchar(30) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `payroll_tax_setup`
--

CREATE TABLE `payroll_tax_setup` (
  `tax_setup_id` int(11) UNSIGNED NOT NULL,
  `start_amount` varchar(30) CHARACTER SET latin1 NOT NULL,
  `end_amount` varchar(30) CHARACTER SET latin1 NOT NULL,
  `rate` varchar(30) CHARACTER SET latin1 NOT NULL,
  `status` varchar(30) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pay_frequency`
--

CREATE TABLE `pay_frequency` (
  `id` int(11) NOT NULL,
  `frequency_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pay_frequency`
--

INSERT INTO `pay_frequency` (`id`, `frequency_name`) VALUES
(1, 'Weekly'),
(2, 'Biweekly'),
(3, 'Annual'),
(4, 'Monthly');

-- --------------------------------------------------------

--
-- Table structure for table `pm_activity_logs`
--

CREATE TABLE `pm_activity_logs` (
  `activity_id` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `user_id` varchar(11) DEFAULT NULL,
  `date_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pm_clients`
--

CREATE TABLE `pm_clients` (
  `client_id` int(11) NOT NULL,
  `company_name` varchar(250) DEFAULT NULL,
  `client_name` varchar(250) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pm_employee_projects`
--

CREATE TABLE `pm_employee_projects` (
  `id` int(11) NOT NULL,
  `project_id` varchar(11) DEFAULT NULL,
  `employee_id` varchar(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pm_projects`
--

CREATE TABLE `pm_projects` (
  `project_id` int(11) NOT NULL,
  `first_parent_project_id` int(11) DEFAULT 0 COMMENT 'if create any new version of existing project. it will always remaan the first parent id.',
  `second_parent_project_id` int(20) DEFAULT 0 COMMENT 'it will use for backlogs task transfer.',
  `version_no` varchar(20) DEFAULT '1' COMMENT 'It will increment always, after creating new version, otherwise always 1',
  `project_name` varchar(250) DEFAULT NULL,
  `client_id` varchar(11) DEFAULT NULL,
  `project_lead` varchar(11) DEFAULT NULL,
  `approximate_tasks` varchar(50) DEFAULT NULL,
  `complete_tasks` varchar(20) DEFAULT NULL,
  `start_date` date DEFAULT NULL COMMENT 'when the first sprint is started of any project',
  `project_start_date` date DEFAULT NULL COMMENT 'On project creation, this date will be defined',
  `close_date` date DEFAULT NULL COMMENT 'when project is being closed from project update.',
  `project_duration` varchar(20) DEFAULT NULL,
  `completed_days` varchar(20) DEFAULT NULL COMMENT 'days passed from start date of the project',
  `project_summary` text DEFAULT NULL,
  `is_completed` varchar(11) DEFAULT '0' COMMENT 'can complete forcefully or manually be completed',
  `project_reward_point` varchar(20) NOT NULL DEFAULT '0' COMMENT 'this point will be given to all the employee of this project',
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pm_sprints`
--

CREATE TABLE `pm_sprints` (
  `sprint_id` int(11) NOT NULL,
  `project_id` varchar(11) DEFAULT NULL COMMENT 'under a project',
  `sprint_name` varchar(500) DEFAULT NULL,
  `duration` varchar(50) DEFAULT NULL COMMENT 'in days',
  `start_date` date DEFAULT NULL,
  `close_date` date DEFAULT NULL,
  `sprint_goal` text DEFAULT NULL,
  `is_finished` int(3) DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pm_tasks_list`
--

CREATE TABLE `pm_tasks_list` (
  `task_id` int(11) NOT NULL,
  `project_id` varchar(11) DEFAULT NULL,
  `sprint_id` varchar(11) DEFAULT NULL,
  `summary` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `project_lead` varchar(11) DEFAULT NULL COMMENT 'Reporter of the project',
  `employee_id` varchar(11) DEFAULT NULL COMMENT 'Team members',
  `priority` int(5) DEFAULT NULL COMMENT 'high = 2 or 1 = medium or low = 0',
  `attachment` text DEFAULT NULL,
  `task_status` varchar(50) DEFAULT '1' COMMENT 'to do =1 , in progress = 2 or done = 3',
  `is_task` int(3) DEFAULT 0 COMMENT 'if 0 remain in backlogs else show in task',
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `point_attendence`
--

CREATE TABLE `point_attendence` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(50) NOT NULL,
  `in_time` varchar(50) NOT NULL,
  `point` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `create_date` datetime NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `update_date` datetime NOT NULL,
  `update_by` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `point_attendence`
--

INSERT INTO `point_attendence` (`id`, `employee_id`, `in_time`, `point`, `description`, `create_date`, `created_by`, `update_date`, `update_by`) VALUES
(1, '1', '08:15', '1', '', '2022-04-03 00:00:00', '1', '2022-04-03 00:00:00', '1'),
(2, '1', '09:10', '1', '', '2022-04-04 00:00:00', '1', '2022-04-04 00:00:00', '1'),
(3, '1', '18:20', '0', '', '2022-03-28 00:00:00', '1', '0000-00-00 00:00:00', ''),
(4, '1', '08:10', '1', '', '2022-04-05 00:00:00', '1', '2022-04-05 00:00:00', '1'),
(5, '1', '06:40', '1', '', '2022-04-06 00:00:00', '1', '2022-04-06 00:00:00', '1'),
(6, '1', '05:55', '1', '', '2022-04-07 00:00:00', '1', '2022-04-07 00:00:00', '1'),
(7, '1', '06:15', '1', '', '2022-04-10 00:00:00', '1', '2022-04-10 00:00:00', '1'),
(8, '1', '03:45', '1', '', '2022-04-11 00:00:00', '1', '2022-04-11 00:00:00', '1'),
(9, '1', '01:20', '1', '', '2022-04-12 00:00:00', '1', '2022-04-12 00:00:00', '1'),
(10, '1', '02:05', '1', '', '2022-04-13 00:00:00', '1', '2022-04-13 00:00:00', '1'),
(11, '1', '00:10', '1', '', '2022-04-14 00:00:00', '1', '2022-04-14 00:00:00', '1'),
(12, '1', '00:05', '1', '', '2022-04-17 00:00:00', '1', '2022-04-17 00:00:00', '1'),
(13, '2', '04:25', '1', '', '2022-04-03 00:00:00', '1', '2022-04-03 00:00:00', '1'),
(14, '3', '03:05', '1', '', '2022-04-03 00:00:00', '1', '2022-04-03 00:00:00', '1'),
(15, '3', '05:50', '1', '', '2022-04-04 00:00:00', '1', '2022-04-04 00:00:00', '1');

-- --------------------------------------------------------

--
-- Table structure for table `point_categories`
--

CREATE TABLE `point_categories` (
  `id` int(11) NOT NULL,
  `point_category` varchar(100) DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `update_by` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `point_categories`
--

INSERT INTO `point_categories` (`id`, `point_category`, `created_by`, `update_by`, `created_at`, `update_at`) VALUES
(1, 'hjhj', '21', NULL, '2022-05-18 06:16:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `point_collaborative`
--

CREATE TABLE `point_collaborative` (
  `id` int(11) NOT NULL,
  `point_shared_by` varchar(50) DEFAULT NULL COMMENT 'Employee shared point',
  `point_shared_with` varchar(50) DEFAULT NULL COMMENT 'Employee received point',
  `reason` text DEFAULT NULL,
  `point` varchar(50) DEFAULT NULL,
  `point_date` date DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL COMMENT 'users',
  `update_date` datetime DEFAULT NULL,
  `update_by` varchar(50) DEFAULT NULL COMMENT 'users'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `point_management`
--

CREATE TABLE `point_management` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(50) DEFAULT NULL,
  `point_category` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `point` varchar(50) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_by` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `point_reward`
--

CREATE TABLE `point_reward` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(50) DEFAULT NULL COMMENT 'employee id',
  `attendence` varchar(50) DEFAULT NULL COMMENT 'attendence points',
  `management` varchar(50) DEFAULT NULL COMMENT 'management points',
  `collaborative` varchar(50) DEFAULT NULL COMMENT 'collaborative points',
  `total` int(50) DEFAULT NULL,
  `date` date DEFAULT NULL COMMENT 'pointing time'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `point_reward`
--

INSERT INTO `point_reward` (`id`, `employee_id`, `attendence`, `management`, `collaborative`, `total`, `date`) VALUES
(1, '1', '11', NULL, NULL, 11, '2022-04-03'),
(2, '2', '1', NULL, NULL, 1, '2022-04-03'),
(3, '3', '2', NULL, NULL, 2, '2022-04-03');

-- --------------------------------------------------------

--
-- Table structure for table `point_settings`
--

CREATE TABLE `point_settings` (
  `id` int(11) NOT NULL,
  `general_point` varchar(50) DEFAULT NULL COMMENT 'Maximum limit for collaborative points',
  `attendence_point` varchar(50) DEFAULT NULL,
  `attendence_start` varchar(50) DEFAULT NULL,
  `attendence_end` varchar(50) DEFAULT NULL,
  `collaborative_start` date DEFAULT NULL,
  `collaborative_end` date DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `point_settings`
--

INSERT INTO `point_settings` (`id`, `general_point`, `attendence_point`, `attendence_start`, `attendence_end`, `collaborative_start`, `collaborative_end`, `created_by`, `updated_by`, `created_at`, `update_at`) VALUES
(5, '3', '1', '09:30', '10:10', '2021-02-01', '2021-02-16', '19', '113', '2020-12-29 06:43:13', '2021-02-16 06:45:56');

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE `position` (
  `pos_id` int(11) NOT NULL,
  `position_name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `position_details` varchar(255) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`pos_id`, `position_name`, `position_details`) VALUES
(1, 'Sr. PHP Programmer', 'Sr. Programmer'),
(2, 'Team Lead', 'Team Lead'),
(3, 'Senior SQA', 'Automated SQA'),
(7, 'Manager', 'Sales Manager');

-- --------------------------------------------------------

--
-- Table structure for table `procurement_bid_analysis`
--

CREATE TABLE `procurement_bid_analysis` (
  `bid_analysis_form_id` int(11) NOT NULL,
  `quotation_form_id` int(11) DEFAULT NULL,
  `sba_no` varchar(200) DEFAULT NULL,
  `location` varchar(500) DEFAULT NULL,
  `attachment` text DEFAULT NULL,
  `total` varchar(20) DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `created_by` varchar(11) DEFAULT NULL,
  `update_date` date DEFAULT NULL,
  `update_by` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `procurement_commitee_list`
--

CREATE TABLE `procurement_commitee_list` (
  `id` int(11) NOT NULL,
  `bid_id` int(11) DEFAULT NULL COMMENT 'when selecting in bid analysis',
  `bid_committee_id` varchar(11) DEFAULT NULL COMMENT 'Selecting in bid analysis',
  `type` varchar(255) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `sign_image` text DEFAULT NULL,
  `date` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `procurement_good_received`
--

CREATE TABLE `procurement_good_received` (
  `good_received_id` int(11) NOT NULL,
  `purchase_order_id` int(11) DEFAULT NULL,
  `vendor_name` varchar(200) DEFAULT NULL,
  `vendor_id` varchar(11) DEFAULT NULL,
  `invoice_number` varchar(20) DEFAULT NULL,
  `unit_price_total` varchar(20) DEFAULT NULL,
  `total` varchar(11) DEFAULT NULL,
  `discount` varchar(11) DEFAULT NULL,
  `grand_total` varchar(20) DEFAULT NULL,
  `payment_type` varchar(50) DEFAULT NULL,
  `headnode` varchar(50) DEFAULT NULL,
  `received_by_signature` text DEFAULT NULL,
  `received_by_name` varchar(200) DEFAULT NULL,
  `received_by_title` varchar(200) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `created_by` varchar(11) DEFAULT NULL,
  `updated_date` date DEFAULT NULL,
  `updated_by` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `procurement_items`
--

CREATE TABLE `procurement_items` (
  `id` int(11) NOT NULL,
  `form_id` varchar(20) NOT NULL COMMENT 'id of request , quotation or bid analysis, purchase order and good receive form',
  `item_type` varchar(200) DEFAULT NULL COMMENT 'Type can be request, quote, bid , purchase_order or good receive',
  `company` varchar(500) DEFAULT NULL,
  `description_material` text DEFAULT NULL,
  `reason_of_choosing` varchar(500) DEFAULT NULL COMMENT 'ROF#',
  `remarks` varchar(500) DEFAULT NULL,
  `unit` varchar(50) DEFAULT NULL,
  `quantity` varchar(20) DEFAULT NULL,
  `price_per_unit` varchar(11) DEFAULT NULL,
  `total` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `procurement_purchase_order`
--

CREATE TABLE `procurement_purchase_order` (
  `purchase_order_id` int(11) NOT NULL,
  `good_received_id` int(11) DEFAULT NULL COMMENT 'After using this purchase order in good received, the purchase order id will fill here',
  `quotation_id` varchar(100) DEFAULT NULL,
  `vendor_name` varchar(500) DEFAULT NULL COMMENT 'vendor or company',
  `location` varchar(500) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `total` varchar(20) DEFAULT NULL,
  `discount` varchar(11) DEFAULT NULL,
  `grand_total` varchar(11) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `authorizer_name` varchar(250) DEFAULT NULL,
  `authorizer_title` varchar(250) DEFAULT NULL,
  `authorizer_signature` text DEFAULT NULL,
  `authorizer_date` date DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `created_by` varchar(11) DEFAULT NULL,
  `updated_date` date DEFAULT NULL,
  `updated_by` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `procurement_quotation`
--

CREATE TABLE `procurement_quotation` (
  `quotation_form_id` int(11) NOT NULL,
  `request_form_id` int(11) DEFAULT NULL COMMENT 'Converted request no as quote',
  `bid_analysis_id` int(11) DEFAULT NULL COMMENT 'After using this quote in Bid, the bid id will fill here',
  `purchase_order_id` int(11) DEFAULT NULL COMMENT 'After using this quote in purchase order, the purchase id will fill here',
  `name_of_company` varchar(200) DEFAULT NULL COMMENT 'vendor named as company',
  `vendor_id` varchar(11) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `pin_or_equivalent` varchar(200) DEFAULT NULL,
  `expected_date_delivery` date DEFAULT NULL,
  `place_of_delivery` varchar(200) DEFAULT NULL,
  `signature_and_stamp` text DEFAULT NULL,
  `total` varchar(20) DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `created_by` varchar(10) DEFAULT NULL,
  `update_date` date DEFAULT NULL,
  `updated_by` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `procurement_request_form`
--

CREATE TABLE `procurement_request_form` (
  `request_form_id` int(11) NOT NULL,
  `serial_no` varchar(50) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `requesting_dept` varchar(20) DEFAULT NULL,
  `requesting_person` varchar(200) DEFAULT NULL,
  `requesting_reason` text DEFAULT NULL,
  `expected_start_time` date DEFAULT NULL,
  `expected_end_time` date DEFAULT NULL,
  `is_approve` int(1) NOT NULL DEFAULT 0 COMMENT 'If request is approved or not',
  `reason` text DEFAULT NULL COMMENT 'reason for approval',
  `quoted` tinyint(1) DEFAULT 0 COMMENT '0= not quoted , 1 = quoted',
  `created_at` datetime DEFAULT NULL,
  `cteated_by` varchar(50) DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `update_by` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `procurement_vendor`
--

CREATE TABLE `procurement_vendor` (
  `id` int(11) NOT NULL,
  `vendor_name` varchar(200) DEFAULT NULL,
  `mobile_no` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `zip` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `previous_balance` varchar(20) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `rate_type`
--

CREATE TABLE `rate_type` (
  `id` int(11) NOT NULL,
  `r_type_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `salary_setup_header`
--

CREATE TABLE `salary_setup_header` (
  `s_s_h_id` int(11) UNSIGNED NOT NULL,
  `employee_id` varchar(30) CHARACTER SET latin1 NOT NULL,
  `salary_payable` varchar(30) CHARACTER SET latin1 DEFAULT NULL,
  `absent_deduct` varchar(30) CHARACTER SET latin1 DEFAULT NULL,
  `tax_manager` varchar(30) CHARACTER SET latin1 NOT NULL,
  `status` varchar(30) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `salary_setup_header`
--

INSERT INTO `salary_setup_header` (`s_s_h_id`, `employee_id`, `salary_payable`, `absent_deduct`, `tax_manager`, `status`) VALUES
(1, '34', NULL, '0', '0', ''),
(2, '34', NULL, '0', '0', ''),
(3, '34', NULL, '0', '0', ''),
(4, '1', NULL, '0', '0', ''),
(5, '34', NULL, '0', '0', ''),
(6, '34', NULL, '0', '0', ''),
(7, '34', NULL, '0', '0', ''),
(8, '34', NULL, '0', '0', ''),
(9, '4', NULL, '0', '0', ''),
(10, '5', NULL, '0', '1', '');

-- --------------------------------------------------------

--
-- Table structure for table `salary_sheet_generate`
--

CREATE TABLE `salary_sheet_generate` (
  `ssg_id` int(11) UNSIGNED NOT NULL,
  `name` varchar(30) CHARACTER SET latin1 NOT NULL,
  `gdate` varchar(20) DEFAULT NULL,
  `start_date` varchar(30) CHARACTER SET latin1 NOT NULL,
  `end_date` varchar(30) CHARACTER SET latin1 NOT NULL,
  `generate_by` varchar(30) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `salary_sheet_generate`
--

INSERT INTO `salary_sheet_generate` (`ssg_id`, `name`, `gdate`, `start_date`, `end_date`, `generate_by`) VALUES
(1, 'March 2020', '2020-03-18', '2020-3-1', '2020-3-31', ''),
(3, 'February 2020', '2020-03-23', '2020-2-1', '2020-2-29', ''),
(6, 'August 2020', '2020-03-23', '2020-8-1', '2020-8-31', ''),
(8, 'April 2022', '2022-04-11', '2022-4-1', '2022-4-30', '');

-- --------------------------------------------------------

--
-- Table structure for table `salary_type`
--

CREATE TABLE `salary_type` (
  `salary_type_id` int(10) UNSIGNED NOT NULL,
  `sal_name` varchar(50) CHARACTER SET latin1 NOT NULL,
  `emp_sal_type` varchar(50) CHARACTER SET latin1 NOT NULL,
  `default_amount` varchar(30) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `salary_type`
--

INSERT INTO `salary_type` (`salary_type_id`, `sal_name`, `emp_sal_type`, `default_amount`, `status`) VALUES
(1, 'Transport Allownce', '1', '', ''),
(2, 'Basic Salary', '1', '', ''),
(3, 'Loan', '0', '', ''),
(4, 'Salary Advance', '0', '', ''),
(5, 'SOS', '0', '', ''),
(6, 'State Income Tax', '0', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `schdule_purchse_info`
--

CREATE TABLE `schdule_purchse_info` (
  `id` int(11) NOT NULL,
  `purchase_key` varchar(100) DEFAULT NULL,
  `domain` varchar(200) DEFAULT NULL,
  `ip_address` varchar(100) DEFAULT NULL,
  `port` varchar(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sec_menu_item`
--

CREATE TABLE `sec_menu_item` (
  `menu_id` int(11) NOT NULL,
  `menu_title` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `page_url` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `module` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_menu` int(11) DEFAULT NULL,
  `is_report` tinyint(1) DEFAULT NULL,
  `createby` int(11) NOT NULL,
  `createdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sec_menu_item`
--

INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES
(147, 'attendance', '', 'attendance', 0, 0, 2, '2018-10-04 00:00:00'),
(148, 'atn_form', 'atnview', 'attendance', 147, 0, 2, '2018-10-04 00:00:00'),
(149, 'new_award', 'award_form', 'award', 0, 0, 2, '2018-10-04 00:00:00'),
(150, 'candidate_basic_info', '', 'recruitment', 0, 0, 2, '2018-10-04 00:00:00'),
(151, 'add_canbasic_info', 'canInfo_form', 'recruitment', 150, 0, 2, '2018-10-04 00:00:00'),
(152, 'can_basicinfo_list', 'canInfoview', 'recruitment', 150, 0, 2, '2018-10-04 00:00:00'),
(153, 'candidate_shortlist', 'shortlist_form', 'recruitment', 0, 0, 2, '2018-10-04 00:00:00'),
(154, 'candidate_interview', 'interview_form', 'recruitment', 0, 0, 2, '2018-10-04 00:00:00'),
(155, 'candidate_selection', 'selection_form', 'recruitment', 0, 0, 2, '2018-10-04 00:00:00'),
(156, 'department', 'dept_form', 'department', 0, 0, 2, '2018-10-04 00:00:00'),
(157, 'division', '', 'department', 0, 0, 2, '2018-10-04 00:00:00'),
(158, 'add_division', 'division_form', 'department', 157, 0, 2, '2018-10-04 00:00:00'),
(159, 'division_list', 'division_list', 'department', 157, 0, 2, '2018-10-04 00:00:00'),
(161, 'position', 'position_form', 'employee', 0, 0, 2, '2018-10-04 00:00:00'),
(162, 'direct_empl', '', 'employee', 0, 0, 2, '2018-10-04 00:00:00'),
(163, 'add_employee', 'employ_form', 'employee', 162, 0, 2, '2018-10-04 00:00:00'),
(164, 'manage_employee', 'employee_view', 'employee', 162, 0, 2, '2018-10-04 00:00:00'),
(167, 'weekly_holiday', 'weeklyform', 'leave', 0, 0, 2, '2018-10-08 00:00:00'),
(168, 'holiday', 'holiday_form', 'leave', 0, 0, 2, '2018-10-08 00:00:00'),
(169, 'others_leave_application', '', 'leave', NULL, 0, 2, '2018-10-08 00:00:00'),
(170, 'loan_grand', 'grandloan_form', 'loan', 0, 0, 2, '2018-10-08 00:00:00'),
(171, 'loan_installment', 'installment_form', 'loan', 0, 0, 2, '2018-10-08 00:00:00'),
(172, 'loan_report', 'ln_report', 'loan', 0, 0, 2, '2018-10-08 00:00:00'),
(173, 'notice', 'notice_form', 'noticeboard', 0, 0, 2, '2018-10-08 00:00:00'),
(176, 'salary_generate', 'salary_generate_form', 'payroll', 0, 0, 2, '2018-10-08 00:00:00'),
(177, 'employee_reports', '', 'reports', 0, 0, 2, '2018-10-09 00:00:00'),
(178, 'demographic_report', 'demographic_list', 'reports', 177, 0, 2, '2018-10-09 00:00:00'),
(179, 'posting_report', 'positional_list', 'reports', 177, 0, 2, '2018-10-09 00:00:00'),
(183, 'adhoc_report', 'adhoc_form', 'reports', 0, 0, 2, '2018-10-09 00:00:00'),
(186, 'add_leave_type', 'leave_type_form', 'leave', 169, 0, 2, '2018-10-16 00:00:00'),
(187, 'leave_application', 'other_leave_application_form', 'leave', 169, 0, 2, '2018-10-16 00:00:00'),
(188, 'c_o_a', 'treeview', 'accounts', NULL, 0, 2, '2018-10-18 00:00:00'),
(189, 'financiall_year', 'financiall_year', 'accounts', 0, 0, 2, '2019-12-14 00:00:00'),
(190, 'sub_account', 'sub_account', 'accounts', 0, 0, 2, '2019-12-14 00:00:00'),
(191, 'predefined_accounts', 'predefined_accounts', 'accounts', 0, 0, 2, '2019-12-14 00:00:00'),
(192, 'bank_reconciliation', 'bank_reconciliation', 'accounts', 0, 0, 2, '2019-12-14 00:00:00'),
(193, 'debit_voucher', 'debit_voucher', 'accounts', 0, 0, 2, '2018-10-18 00:00:00'),
(194, 'credit_voucher', 'credit_voucher', 'accounts', 0, 0, 2, '2018-10-18 00:00:00'),
(195, 'contra_voucher', 'contra_voucher', 'accounts', 0, 0, 2, '2018-10-18 00:00:00'),
(196, 'journal_voucher', 'journal_voucher', 'accounts', 0, 0, 2, '2018-10-18 00:00:00'),
(197, 'voucher_approval', 'voucher_approve', 'accounts', 0, 0, 2, '2018-10-18 00:00:00'),
(198, 'opening_balance', 'opening_balance', 'accounts', 0, 0, 2, '2018-10-18 00:00:00'),
(199, 'account_report', '', 'accounts', 0, 0, 2, '2018-10-18 00:00:00'),
(200, 'cash_book', 'cash_book', 'accounts', 194, 0, 2, '2018-10-18 00:00:00'),
(201, 'bank_book', 'bank_book', 'accounts', 194, 0, 2, '2018-10-18 00:00:00'),
(202, 'general_ledger', 'general_ledger', 'accounts', 194, 0, 2, '2018-10-18 00:00:00'),
(203, 'trial_balance', 'trial_balance', 'accounts', 194, 0, 2, '2018-10-18 00:00:00'),
(204, 'add_bank', 'add_bank', 'bank', 0, 0, 2, '2019-12-14 00:00:00'),
(205, 'bank_list', 'bank_list', 'bank', 0, 0, 2, '2019-12-14 00:00:00'),
(206, 'profit_loss', 'profit_loss_report', 'accounts', 194, 0, 2, '2018-10-18 00:00:00'),
(207, 'cash_flow', 'cash_flow_report', 'accounts', 194, 0, 2, '2018-10-18 00:00:00'),
(208, 'coa_print', 'coa_print', 'accounts', 194, 0, 2, '2018-10-18 00:00:00'),
(211, 'atn_log_datewise', 'attendance_log_datewise', 'attendance', 147, 0, 2, '2019-12-14 00:00:00'),
(219, 'emp_sal_payment', 'paymentview', 'payroll', 0, 0, 2, '2019-12-14 00:00:00'),
(263, 'emp_performance', 'emp_performance_form', 'employee', 0, 0, 2, '2018-10-04 00:00:00'),
(266, 'salary_advance', 'salary_advance', 'payroll', 0, 0, 2, '2019-12-14 00:00:00'),
(273, 'day_book', 'day_book', 'accounts', 194, 0, 2, '2018-10-18 00:00:00'),
(274, 'sub_ledger', 'sub_ledger', 'accounts', 194, 0, 2, '2018-10-18 00:00:00'),
(275, 'income_statement', 'income_statement', 'accounts', 194, 0, 2, '2018-10-18 00:00:00'),
(276, 'expenditure_statement', 'expenditure_statement', 'accounts', 194, 0, 2, '2018-10-18 00:00:00'),
(277, 'balance_sheet', 'balance_sheet', 'accounts', 194, 0, 2, '2018-10-18 00:00:00'),
(278, 'fixedasset_schedule', 'fixedasset_schedule', 'accounts', 194, 0, 2, '2018-10-18 00:00:00'),
(279, 'receipt_payment', 'receipt_payment', 'accounts', 194, 0, 2, '2018-10-18 00:00:00'),
(280, 'bank_reconciliation_report', 'bank_reconciliation_report', 'accounts', 194, 0, 2, '2018-10-18 00:00:00'),
(281, 'attendance_report', '', 'reports', 0, 0, 2, '2018-10-09 00:00:00'),
(282, 'daily_presents', 'daily_presents', 'reports', 281, 0, 2, '2018-10-09 00:00:00'),
(283, 'monthly_presents', 'monthly_presents', 'reports', 281, 0, 2, '2018-10-09 00:00:00'),
(284, 'daily_absent', 'daily_absent', 'reports', 281, 0, 2, '2018-10-09 00:00:00'),
(285, 'monthly_absent', 'monthly_absent', 'reports', 281, 0, 2, '2018-10-09 00:00:00'),
(286, 'leave_report', '', 'reports', 0, 0, 2, '2018-10-09 00:00:00'),
(287, 'employee_on_leave', 'employee_on_leave', 'reports', 286, 0, 2, '2018-10-09 00:00:00'),
(288, 'point_settings', 'point_settings', 'rewardpoint', 0, 0, 1, '2020-12-28 00:00:00'),
(289, 'point_categories', 'point_categories', 'rewardpoint', 0, 0, 1, '2020-12-28 00:00:00'),
(290, 'management_point', 'management_point', 'rewardpoint', 0, 0, 1, '2020-12-28 00:00:00'),
(291, 'collaborative_point', 'collaborative_point', 'rewardpoint', 0, 0, 1, '2020-12-28 00:00:00'),
(292, 'employee_point', 'employee_point', 'rewardpoint', 0, 0, 1, '2020-12-28 00:00:00'),
(293, 'attendence_point', 'attendence_point', 'rewardpoint', 0, 0, 19, '2020-12-31 00:00:00'),
(295, 'payroll', '', 'reports', 0, 0, 2, '2018-10-09 00:00:00'),
(296, 'npf3_soc_sec_tax_report', 'npf3_soc_sec_tax_report', 'reports', 295, 0, 2, '2018-10-09 00:00:00'),
(297, 'sate_income_tax_schedule', 'sate_income_tax_schedule', 'reports', 295, 0, 2, '2018-10-09 00:00:00'),
(298, 'iicf3_contribution_report', 'iicf3_contribution_report', 'reports', 295, 0, 2, '2018-10-09 00:00:00'),
(299, 'salary_confirmation_form', 'salary_confirmation_form', 'reports', 295, 0, 2, '2018-10-09 00:00:00'),
(300, 'sate_income_tax_schedule', 'sate_income_tax_schedule', 'reports', 295, 0, 2, '2018-10-09 00:00:00'),
(301, 'gra_ret_5', 'gra_ret_5', 'reports', 295, 0, 2, '2018-10-09 00:00:00'),
(302, 'social_security_npf_icf', 'social_security_npf_icf', 'reports', 295, 0, 2, '2018-10-09 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `sec_role_permission`
--

CREATE TABLE `sec_role_permission` (
  `id` bigint(20) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `can_access` tinyint(1) NOT NULL,
  `can_create` tinyint(1) NOT NULL,
  `can_edit` tinyint(1) NOT NULL,
  `can_delete` tinyint(1) NOT NULL,
  `createby` int(11) NOT NULL,
  `createdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sec_role_permission`
--

INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES
(256, 3, 188, 1, 1, 1, 1, 1, '2022-05-19 12:59:06'),
(257, 3, 189, 1, 1, 1, 1, 1, '2022-05-19 12:59:06'),
(258, 3, 190, 0, 0, 0, 0, 1, '2022-05-19 12:59:06'),
(259, 3, 191, 1, 1, 0, 0, 1, '2022-05-19 12:59:06'),
(260, 3, 192, 1, 1, 1, 1, 1, '2022-05-19 12:59:06'),
(261, 3, 193, 1, 1, 0, 0, 1, '2022-05-19 12:59:06'),
(262, 3, 194, 1, 1, 1, 0, 1, '2022-05-19 12:59:06'),
(263, 3, 195, 1, 1, 0, 1, 1, '2022-05-19 12:59:06'),
(264, 3, 196, 0, 0, 0, 0, 1, '2022-05-19 12:59:06'),
(265, 3, 197, 0, 0, 0, 0, 1, '2022-05-19 12:59:06'),
(266, 3, 198, 0, 0, 0, 0, 1, '2022-05-19 12:59:06'),
(267, 3, 199, 0, 0, 0, 0, 1, '2022-05-19 12:59:06'),
(268, 3, 200, 0, 0, 0, 0, 1, '2022-05-19 12:59:06'),
(269, 3, 201, 0, 0, 0, 0, 1, '2022-05-19 12:59:06'),
(270, 3, 202, 0, 0, 0, 0, 1, '2022-05-19 12:59:06'),
(271, 3, 203, 0, 0, 0, 0, 1, '2022-05-19 12:59:06'),
(272, 3, 206, 1, 1, 1, 1, 1, '2022-05-19 12:59:06'),
(273, 3, 207, 0, 0, 0, 0, 1, '2022-05-19 12:59:06'),
(274, 3, 208, 0, 0, 0, 0, 1, '2022-05-19 12:59:06'),
(275, 3, 273, 0, 0, 0, 0, 1, '2022-05-19 12:59:06'),
(276, 3, 274, 0, 0, 0, 0, 1, '2022-05-19 12:59:06'),
(277, 3, 275, 0, 0, 0, 0, 1, '2022-05-19 12:59:06'),
(278, 3, 276, 0, 0, 0, 0, 1, '2022-05-19 12:59:06'),
(279, 3, 277, 0, 0, 0, 0, 1, '2022-05-19 12:59:06'),
(280, 3, 278, 0, 0, 0, 0, 1, '2022-05-19 12:59:06'),
(281, 3, 279, 0, 0, 0, 0, 1, '2022-05-19 12:59:06'),
(282, 3, 280, 0, 0, 0, 0, 1, '2022-05-19 12:59:06'),
(283, 3, 147, 0, 0, 0, 0, 1, '2022-05-19 12:59:06'),
(284, 3, 148, 0, 0, 0, 0, 1, '2022-05-19 12:59:06'),
(285, 3, 211, 0, 0, 0, 0, 1, '2022-05-19 12:59:06'),
(286, 3, 149, 0, 0, 0, 0, 1, '2022-05-19 12:59:06'),
(287, 3, 204, 0, 0, 0, 0, 1, '2022-05-19 12:59:06'),
(288, 3, 205, 0, 0, 0, 0, 1, '2022-05-19 12:59:06'),
(289, 3, 156, 0, 0, 0, 0, 1, '2022-05-19 12:59:06'),
(290, 3, 157, 0, 0, 0, 0, 1, '2022-05-19 12:59:06'),
(291, 3, 158, 0, 0, 0, 0, 1, '2022-05-19 12:59:06'),
(292, 3, 159, 0, 0, 0, 0, 1, '2022-05-19 12:59:06'),
(293, 3, 161, 0, 0, 0, 0, 1, '2022-05-19 12:59:06'),
(294, 3, 162, 0, 0, 0, 0, 1, '2022-05-19 12:59:06'),
(295, 3, 163, 0, 0, 0, 0, 1, '2022-05-19 12:59:06'),
(296, 3, 164, 0, 0, 0, 0, 1, '2022-05-19 12:59:06'),
(297, 3, 263, 0, 0, 0, 0, 1, '2022-05-19 12:59:06'),
(298, 3, 167, 0, 0, 0, 0, 1, '2022-05-19 12:59:06'),
(299, 3, 168, 0, 0, 0, 0, 1, '2022-05-19 12:59:06'),
(300, 3, 169, 0, 0, 0, 0, 1, '2022-05-19 12:59:06'),
(301, 3, 186, 0, 0, 0, 0, 1, '2022-05-19 12:59:06'),
(302, 3, 187, 0, 0, 0, 0, 1, '2022-05-19 12:59:06'),
(303, 3, 170, 0, 0, 0, 0, 1, '2022-05-19 12:59:06'),
(304, 3, 171, 0, 0, 0, 0, 1, '2022-05-19 12:59:06'),
(305, 3, 172, 0, 0, 0, 0, 1, '2022-05-19 12:59:06'),
(306, 3, 173, 0, 0, 0, 0, 1, '2022-05-19 12:59:06'),
(307, 3, 176, 0, 0, 0, 0, 1, '2022-05-19 12:59:06'),
(308, 3, 219, 0, 0, 0, 0, 1, '2022-05-19 12:59:06'),
(309, 3, 266, 0, 0, 0, 0, 1, '2022-05-19 12:59:06'),
(310, 3, 150, 0, 0, 0, 0, 1, '2022-05-19 12:59:06'),
(311, 3, 151, 0, 0, 0, 0, 1, '2022-05-19 12:59:06'),
(312, 3, 152, 0, 0, 0, 0, 1, '2022-05-19 12:59:06'),
(313, 3, 153, 0, 0, 0, 0, 1, '2022-05-19 12:59:06'),
(314, 3, 154, 0, 0, 0, 0, 1, '2022-05-19 12:59:06'),
(315, 3, 155, 0, 0, 0, 0, 1, '2022-05-19 12:59:06'),
(316, 3, 177, 0, 0, 0, 0, 1, '2022-05-19 12:59:06'),
(317, 3, 178, 0, 0, 0, 0, 1, '2022-05-19 12:59:06'),
(318, 3, 179, 0, 0, 0, 0, 1, '2022-05-19 12:59:06'),
(319, 3, 183, 0, 0, 0, 0, 1, '2022-05-19 12:59:06'),
(320, 3, 281, 0, 0, 0, 0, 1, '2022-05-19 12:59:06'),
(321, 3, 282, 0, 0, 0, 0, 1, '2022-05-19 12:59:06'),
(322, 3, 283, 0, 0, 0, 0, 1, '2022-05-19 12:59:06'),
(323, 3, 284, 0, 0, 0, 0, 1, '2022-05-19 12:59:06'),
(324, 3, 285, 0, 0, 0, 0, 1, '2022-05-19 12:59:06'),
(325, 3, 286, 0, 0, 0, 0, 1, '2022-05-19 12:59:06'),
(326, 3, 287, 0, 0, 0, 0, 1, '2022-05-19 12:59:06'),
(327, 3, 295, 0, 0, 0, 0, 1, '2022-05-19 12:59:06'),
(328, 3, 296, 0, 0, 0, 0, 1, '2022-05-19 12:59:06'),
(329, 3, 297, 0, 0, 0, 0, 1, '2022-05-19 12:59:06'),
(330, 3, 298, 0, 0, 0, 0, 1, '2022-05-19 12:59:06'),
(331, 3, 299, 0, 0, 0, 0, 1, '2022-05-19 12:59:06'),
(332, 3, 300, 0, 0, 0, 0, 1, '2022-05-19 12:59:06'),
(333, 3, 301, 0, 0, 0, 0, 1, '2022-05-19 12:59:06'),
(334, 3, 302, 0, 0, 0, 0, 1, '2022-05-19 12:59:06'),
(335, 3, 288, 0, 0, 0, 0, 1, '2022-05-19 12:59:06'),
(336, 3, 289, 0, 0, 0, 0, 1, '2022-05-19 12:59:06'),
(337, 3, 290, 0, 0, 0, 0, 1, '2022-05-19 12:59:06'),
(338, 3, 291, 0, 0, 0, 0, 1, '2022-05-19 12:59:06'),
(339, 3, 292, 0, 0, 0, 0, 1, '2022-05-19 12:59:06'),
(340, 3, 293, 0, 0, 0, 0, 1, '2022-05-19 12:59:06'),
(426, 4, 188, 1, 1, 1, 1, 1, '2022-05-19 01:12:37'),
(427, 4, 189, 1, 1, 1, 1, 1, '2022-05-19 01:12:37'),
(428, 4, 190, 0, 0, 0, 0, 1, '2022-05-19 01:12:37'),
(429, 4, 191, 0, 0, 0, 0, 1, '2022-05-19 01:12:37'),
(430, 4, 192, 0, 0, 0, 0, 1, '2022-05-19 01:12:37'),
(431, 4, 193, 0, 0, 0, 0, 1, '2022-05-19 01:12:37'),
(432, 4, 194, 0, 0, 0, 0, 1, '2022-05-19 01:12:37'),
(433, 4, 195, 0, 0, 0, 0, 1, '2022-05-19 01:12:37'),
(434, 4, 196, 0, 0, 0, 0, 1, '2022-05-19 01:12:37'),
(435, 4, 197, 0, 0, 0, 0, 1, '2022-05-19 01:12:37'),
(436, 4, 198, 0, 0, 0, 0, 1, '2022-05-19 01:12:37'),
(437, 4, 199, 0, 0, 0, 0, 1, '2022-05-19 01:12:37'),
(438, 4, 200, 0, 0, 0, 0, 1, '2022-05-19 01:12:37'),
(439, 4, 201, 0, 0, 0, 0, 1, '2022-05-19 01:12:37'),
(440, 4, 202, 0, 0, 0, 0, 1, '2022-05-19 01:12:37'),
(441, 4, 203, 0, 0, 0, 0, 1, '2022-05-19 01:12:37'),
(442, 4, 206, 0, 0, 0, 0, 1, '2022-05-19 01:12:37'),
(443, 4, 207, 0, 0, 0, 0, 1, '2022-05-19 01:12:37'),
(444, 4, 208, 0, 0, 0, 0, 1, '2022-05-19 01:12:37'),
(445, 4, 273, 0, 0, 0, 0, 1, '2022-05-19 01:12:37'),
(446, 4, 274, 0, 0, 0, 0, 1, '2022-05-19 01:12:37'),
(447, 4, 275, 0, 0, 0, 0, 1, '2022-05-19 01:12:37'),
(448, 4, 276, 0, 0, 0, 0, 1, '2022-05-19 01:12:37'),
(449, 4, 277, 0, 0, 0, 0, 1, '2022-05-19 01:12:37'),
(450, 4, 278, 0, 0, 0, 0, 1, '2022-05-19 01:12:37'),
(451, 4, 279, 0, 0, 0, 0, 1, '2022-05-19 01:12:37'),
(452, 4, 280, 0, 0, 0, 0, 1, '2022-05-19 01:12:37'),
(453, 4, 147, 0, 0, 0, 0, 1, '2022-05-19 01:12:37'),
(454, 4, 148, 0, 0, 0, 0, 1, '2022-05-19 01:12:37'),
(455, 4, 211, 0, 0, 0, 0, 1, '2022-05-19 01:12:37'),
(456, 4, 149, 0, 0, 0, 0, 1, '2022-05-19 01:12:37'),
(457, 4, 204, 0, 0, 0, 0, 1, '2022-05-19 01:12:37'),
(458, 4, 205, 0, 0, 0, 0, 1, '2022-05-19 01:12:37'),
(459, 4, 156, 0, 0, 0, 0, 1, '2022-05-19 01:12:37'),
(460, 4, 157, 0, 0, 0, 0, 1, '2022-05-19 01:12:37'),
(461, 4, 158, 0, 0, 0, 0, 1, '2022-05-19 01:12:37'),
(462, 4, 159, 0, 0, 0, 0, 1, '2022-05-19 01:12:37'),
(463, 4, 161, 0, 0, 0, 0, 1, '2022-05-19 01:12:37'),
(464, 4, 162, 0, 0, 0, 0, 1, '2022-05-19 01:12:37'),
(465, 4, 163, 0, 0, 0, 0, 1, '2022-05-19 01:12:37'),
(466, 4, 164, 0, 0, 0, 0, 1, '2022-05-19 01:12:37'),
(467, 4, 263, 0, 0, 0, 0, 1, '2022-05-19 01:12:37'),
(468, 4, 167, 0, 0, 0, 0, 1, '2022-05-19 01:12:37'),
(469, 4, 168, 0, 0, 0, 0, 1, '2022-05-19 01:12:37'),
(470, 4, 169, 0, 0, 0, 0, 1, '2022-05-19 01:12:37'),
(471, 4, 186, 0, 0, 0, 0, 1, '2022-05-19 01:12:37'),
(472, 4, 187, 0, 0, 0, 0, 1, '2022-05-19 01:12:37'),
(473, 4, 170, 0, 0, 0, 0, 1, '2022-05-19 01:12:37'),
(474, 4, 171, 0, 0, 0, 0, 1, '2022-05-19 01:12:37'),
(475, 4, 172, 0, 0, 0, 0, 1, '2022-05-19 01:12:37'),
(476, 4, 173, 0, 0, 0, 0, 1, '2022-05-19 01:12:37'),
(477, 4, 176, 0, 0, 0, 0, 1, '2022-05-19 01:12:37'),
(478, 4, 219, 0, 0, 0, 0, 1, '2022-05-19 01:12:37'),
(479, 4, 266, 0, 0, 0, 0, 1, '2022-05-19 01:12:37'),
(480, 4, 150, 0, 0, 0, 0, 1, '2022-05-19 01:12:37'),
(481, 4, 151, 0, 0, 0, 0, 1, '2022-05-19 01:12:37'),
(482, 4, 152, 0, 0, 0, 0, 1, '2022-05-19 01:12:37'),
(483, 4, 153, 0, 0, 0, 0, 1, '2022-05-19 01:12:37'),
(484, 4, 154, 0, 0, 0, 0, 1, '2022-05-19 01:12:37'),
(485, 4, 155, 0, 0, 0, 0, 1, '2022-05-19 01:12:37'),
(486, 4, 177, 0, 0, 0, 0, 1, '2022-05-19 01:12:37'),
(487, 4, 178, 0, 0, 0, 0, 1, '2022-05-19 01:12:37'),
(488, 4, 179, 0, 0, 0, 0, 1, '2022-05-19 01:12:37'),
(489, 4, 183, 0, 0, 0, 0, 1, '2022-05-19 01:12:37'),
(490, 4, 281, 0, 0, 0, 0, 1, '2022-05-19 01:12:37'),
(491, 4, 282, 0, 0, 0, 0, 1, '2022-05-19 01:12:37'),
(492, 4, 283, 0, 0, 0, 0, 1, '2022-05-19 01:12:37'),
(493, 4, 284, 0, 0, 0, 0, 1, '2022-05-19 01:12:37'),
(494, 4, 285, 0, 0, 0, 0, 1, '2022-05-19 01:12:37'),
(495, 4, 286, 0, 0, 0, 0, 1, '2022-05-19 01:12:37'),
(496, 4, 287, 0, 0, 0, 0, 1, '2022-05-19 01:12:37'),
(497, 4, 295, 0, 0, 0, 0, 1, '2022-05-19 01:12:37'),
(498, 4, 296, 0, 0, 0, 0, 1, '2022-05-19 01:12:37'),
(499, 4, 297, 0, 0, 0, 0, 1, '2022-05-19 01:12:37'),
(500, 4, 298, 0, 0, 0, 0, 1, '2022-05-19 01:12:37'),
(501, 4, 299, 0, 0, 0, 0, 1, '2022-05-19 01:12:37'),
(502, 4, 300, 0, 0, 0, 0, 1, '2022-05-19 01:12:37'),
(503, 4, 301, 0, 0, 0, 0, 1, '2022-05-19 01:12:37'),
(504, 4, 302, 0, 0, 0, 0, 1, '2022-05-19 01:12:37'),
(505, 4, 288, 0, 0, 0, 0, 1, '2022-05-19 01:12:37'),
(506, 4, 289, 0, 0, 0, 0, 1, '2022-05-19 01:12:37'),
(507, 4, 290, 0, 0, 0, 0, 1, '2022-05-19 01:12:37'),
(508, 4, 291, 0, 0, 0, 0, 1, '2022-05-19 01:12:37'),
(509, 4, 292, 0, 0, 0, 0, 1, '2022-05-19 01:12:37'),
(510, 4, 293, 0, 0, 0, 0, 1, '2022-05-19 01:12:37');

-- --------------------------------------------------------

--
-- Table structure for table `sec_role_tbl`
--

CREATE TABLE `sec_role_tbl` (
  `role_id` int(11) NOT NULL,
  `role_name` text NOT NULL,
  `role_description` text NOT NULL,
  `create_by` int(11) DEFAULT NULL,
  `date_time` datetime DEFAULT NULL,
  `role_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sec_role_tbl`
--

INSERT INTO `sec_role_tbl` (`role_id`, `role_name`, `role_description`, `create_by`, `date_time`, `role_status`) VALUES
(3, 'Test', 'Test', 1, '2022-05-19 12:58:45', 1),
(4, 'Test 1', 'xyz', 1, '2022-05-19 01:12:16', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sec_user_access_tbl`
--

CREATE TABLE `sec_user_access_tbl` (
  `role_acc_id` int(11) NOT NULL,
  `fk_role_id` int(11) NOT NULL,
  `fk_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sec_user_access_tbl`
--

INSERT INTO `sec_user_access_tbl` (`role_acc_id`, `fk_role_id`, `fk_user_id`) VALUES
(5, 4, 25);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `logo` varchar(50) DEFAULT NULL,
  `favicon` varchar(100) DEFAULT NULL,
  `language` varchar(100) DEFAULT NULL,
  `timezone` varchar(150) NOT NULL,
  `site_align` varchar(50) DEFAULT NULL,
  `footer_text` varchar(255) DEFAULT NULL,
  `currency_symbol` varchar(11) NOT NULL,
  `state_income_tax` int(11) NOT NULL,
  `soc_sec_npf_tax` int(11) NOT NULL DEFAULT 5
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `title`, `address`, `email`, `phone`, `logo`, `favicon`, `language`, `timezone`, `site_align`, `footer_text`, `currency_symbol`, `state_income_tax`, `soc_sec_npf_tax`) VALUES
(1, 'Bdtask Ltds', '4 th Floor  Mannan Plaza ,Khilkhet,Dhaka-1229', 'bdtask@gmail.com', '0123456789', 'assets/img/icons/2017-07-22/HRM.png', 'assets/img/icons/2017-04-03/m.png', 'english', 'Asia/Dhaka', 'LTR', '2022Ã‚Â©Copyright', 'GMD', 5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `synchronizer_setting`
--

CREATE TABLE `synchronizer_setting` (
  `id` int(11) NOT NULL,
  `hostname` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `port` varchar(10) NOT NULL,
  `debug` varchar(10) NOT NULL,
  `project_root` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` int(11) NOT NULL,
  `unit` varchar(200) DEFAULT NULL,
  `created_by` varchar(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `update_by` varchar(11) DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `unit`, `created_by`, `created_at`, `update_by`, `update_at`) VALUES
(1, 'gm', '1', '2021-03-23 01:56:11', NULL, NULL),
(2, 'kg', '1', '2021-03-23 01:56:21', NULL, NULL),
(3, 'pcs', '1', '2021-03-23 01:56:26', NULL, NULL),
(4, 'pounds', '1', '2021-03-23 01:56:35', '1', '2021-03-27 10:45:53');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `about` text DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(32) NOT NULL,
  `password_reset_token` varchar(20) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `last_logout` datetime DEFAULT NULL,
  `ip_address` varchar(14) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `is_admin` tinyint(4) NOT NULL DEFAULT 0,
  `token_id` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `about`, `email`, `password`, `password_reset_token`, `image`, `last_login`, `last_logout`, `ip_address`, `status`, `is_admin`, `token_id`) VALUES
(1, 'Super', 'Admin', NULL, 'admin@example.com', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, '2022-05-29 05:50:00', '2022-05-29 05:30:12', '182.160.105.18', 1, 1, NULL),
(23, 'Test', 'User', NULL, 'test@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', NULL, './application/modules/employee/assets/images/2022-05-18/160.jpg', '2022-05-28 07:56:55', '2022-05-28 08:34:08', '182.160.105.18', 1, 0, NULL),
(24, 'Sakin', 'Rahman', NULL, 'sakib@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', NULL, '', NULL, NULL, NULL, 1, 0, NULL),
(25, 'Harunur', 'Rashid', NULL, 'harun@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', NULL, '', '2022-05-19 13:16:43', '2022-05-19 13:16:03', '182.160.105.18', 1, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `weekly_holiday`
--

CREATE TABLE `weekly_holiday` (
  `wk_id` int(11) NOT NULL,
  `dayname` varchar(30) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `weekly_holiday`
--

INSERT INTO `weekly_holiday` (`wk_id`, `dayname`) VALUES
(1, 'Satarday,Sunday');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acc_coa`
--
ALTER TABLE `acc_coa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `HeadCode` (`HeadCode`),
  ADD KEY `PHeadName` (`PHeadName`),
  ADD KEY `HeadLevel` (`HeadLevel`),
  ADD KEY `IsTransaction` (`IsTransaction`),
  ADD KEY `IsGL` (`IsGL`),
  ADD KEY `IsBudget` (`IsBudget`),
  ADD KEY `IsDepreciation` (`IsDepreciation`),
  ADD KEY `isCashNature` (`isCashNature`),
  ADD KEY `isBankNature` (`isBankNature`);

--
-- Indexes for table `acc_monthly_balance`
--
ALTER TABLE `acc_monthly_balance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `acc_opening_balance`
--
ALTER TABLE `acc_opening_balance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `COAID` (`COAID`),
  ADD KEY `year` (`fyear`);

--
-- Indexes for table `acc_predefine_account`
--
ALTER TABLE `acc_predefine_account`
  ADD PRIMARY KEY (`id`),
  ADD KEY `COAID` (`cashCode`),
  ADD KEY `cashCode` (`cashCode`);

--
-- Indexes for table `acc_subcode`
--
ALTER TABLE `acc_subcode`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subTypeId` (`subTypeId`);

--
-- Indexes for table `acc_subtype`
--
ALTER TABLE `acc_subtype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `acc_transaction`
--
ALTER TABLE `acc_transaction`
  ADD UNIQUE KEY `ID` (`id`),
  ADD KEY `VNo` (`VNo`),
  ADD KEY `COAID` (`COAID`),
  ADD KEY `RevCodde` (`RevCodde`),
  ADD KEY `subType` (`subType`),
  ADD KEY `subCode` (`subCode`),
  ADD KEY `referenceNo` (`referenceNo`),
  ADD KEY `vid` (`vid`);

--
-- Indexes for table `acc_vaucher`
--
ALTER TABLE `acc_vaucher`
  ADD PRIMARY KEY (`id`),
  ADD KEY `VNo` (`VNo`),
  ADD KEY `fyear` (`fyear`),
  ADD KEY `VDate` (`VDate`),
  ADD KEY `COAID` (`COAID`),
  ADD KEY `RevCodde` (`RevCodde`),
  ADD KEY `subType` (`subType`),
  ADD KEY `subCode` (`subCode`),
  ADD KEY `referenceNo` (`referenceNo`);

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`activity_id`);

--
-- Indexes for table `appsetting`
--
ALTER TABLE `appsetting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance_history`
--
ALTER TABLE `attendance_history`
  ADD PRIMARY KEY (`atten_his_id`);

--
-- Indexes for table `award`
--
ALTER TABLE `award`
  ADD PRIMARY KEY (`award_id`);

--
-- Indexes for table `bank_information`
--
ALTER TABLE `bank_information`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `candidate_basic_info`
--
ALTER TABLE `candidate_basic_info`
  ADD PRIMARY KEY (`can_id`);

--
-- Indexes for table `candidate_education_info`
--
ALTER TABLE `candidate_education_info`
  ADD PRIMARY KEY (`can_edu_id`);

--
-- Indexes for table `candidate_interview`
--
ALTER TABLE `candidate_interview`
  ADD PRIMARY KEY (`can_int_id`);

--
-- Indexes for table `candidate_selection`
--
ALTER TABLE `candidate_selection`
  ADD PRIMARY KEY (`can_sel_id`);

--
-- Indexes for table `candidate_shortlist`
--
ALTER TABLE `candidate_shortlist`
  ADD PRIMARY KEY (`can_short_id`);

--
-- Indexes for table `candidate_workexperience`
--
ALTER TABLE `candidate_workexperience`
  ADD PRIMARY KEY (`can_workexp_id`);

--
-- Indexes for table `custom_table`
--
ALTER TABLE `custom_table`
  ADD PRIMARY KEY (`custom_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`dept_id`);

--
-- Indexes for table `deviceinfo`
--
ALTER TABLE `deviceinfo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `duty_type`
--
ALTER TABLE `duty_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_benifit`
--
ALTER TABLE `employee_benifit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_equipment`
--
ALTER TABLE `employee_equipment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_history`
--
ALTER TABLE `employee_history`
  ADD PRIMARY KEY (`emp_his_id`);

--
-- Indexes for table `employee_performance`
--
ALTER TABLE `employee_performance`
  ADD PRIMARY KEY (`emp_per_id`),
  ADD UNIQUE KEY `perform_sl` (`perform_sl`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `employee_salary_payment`
--
ALTER TABLE `employee_salary_payment`
  ADD PRIMARY KEY (`emp_sal_pay_id`);

--
-- Indexes for table `employee_salary_setup`
--
ALTER TABLE `employee_salary_setup`
  ADD PRIMARY KEY (`e_s_s_id`);

--
-- Indexes for table `emp_attendance`
--
ALTER TABLE `emp_attendance`
  ADD PRIMARY KEY (`att_id`);

--
-- Indexes for table `equipment`
--
ALTER TABLE `equipment`
  ADD PRIMARY KEY (`equipment_id`);

--
-- Indexes for table `equipment_type`
--
ALTER TABLE `equipment_type`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `expense_information`
--
ALTER TABLE `expense_information`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `financial_year`
--
ALTER TABLE `financial_year`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gender`
--
ALTER TABLE `gender`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gmb_bank_info`
--
ALTER TABLE `gmb_bank_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gmb_employee_file`
--
ALTER TABLE `gmb_employee_file`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gmb_employee_types`
--
ALTER TABLE `gmb_employee_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gmb_emp_perform_criteria`
--
ALTER TABLE `gmb_emp_perform_criteria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gmb_emp_perform_eval`
--
ALTER TABLE `gmb_emp_perform_eval`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gmb_emp_perform_type`
--
ALTER TABLE `gmb_emp_perform_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gmb_emp_perform_values`
--
ALTER TABLE `gmb_emp_perform_values`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emp_per_id` (`emp_per_id`),
  ADD KEY `emp_performance_id` (`emp_perform_type_id`),
  ADD KEY `emp_perform_criteria_id` (`emp_perform_criteria_id`),
  ADD KEY `emp_perform_eval_id` (`emp_perform_eval`);

--
-- Indexes for table `gmb_payroll_post`
--
ALTER TABLE `gmb_payroll_post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gmb_perform_development_plan`
--
ALTER TABLE `gmb_perform_development_plan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emp_per_id` (`emp_per_id`);

--
-- Indexes for table `gmb_perform_key_goals`
--
ALTER TABLE `gmb_perform_key_goals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gmb_prform_sub_category`
--
ALTER TABLE `gmb_prform_sub_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gmb_rules_map`
--
ALTER TABLE `gmb_rules_map`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gmb_salary_advance`
--
ALTER TABLE `gmb_salary_advance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gmb_salary_generate`
--
ALTER TABLE `gmb_salary_generate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gmb_salary_sheet_generate`
--
ALTER TABLE `gmb_salary_sheet_generate`
  ADD PRIMARY KEY (`ssg_id`);

--
-- Indexes for table `gmb_setup_rules`
--
ALTER TABLE `gmb_setup_rules`
  ADD PRIMARY KEY (`rule_id`);

--
-- Indexes for table `gmb_sub_cat_perform`
--
ALTER TABLE `gmb_sub_cat_perform`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gmb_tax_calculation`
--
ALTER TABLE `gmb_tax_calculation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grand_loan`
--
ALTER TABLE `grand_loan`
  ADD PRIMARY KEY (`loan_id`);

--
-- Indexes for table `income_area`
--
ALTER TABLE `income_area`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leave_apply`
--
ALTER TABLE `leave_apply`
  ADD PRIMARY KEY (`leave_appl_id`);

--
-- Indexes for table `leave_type`
--
ALTER TABLE `leave_type`
  ADD PRIMARY KEY (`leave_type_id`);

--
-- Indexes for table `loan_installment`
--
ALTER TABLE `loan_installment`
  ADD PRIMARY KEY (`loan_inst_id`);

--
-- Indexes for table `marital_info`
--
ALTER TABLE `marital_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `module_permission`
--
ALTER TABLE `module_permission`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_module_id` (`fk_module_id`),
  ADD KEY `fk_user_id` (`fk_user_id`);

--
-- Indexes for table `module_purchase_key`
--
ALTER TABLE `module_purchase_key`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notice_board`
--
ALTER TABLE `notice_board`
  ADD PRIMARY KEY (`notice_id`);

--
-- Indexes for table `payroll_holiday`
--
ALTER TABLE `payroll_holiday`
  ADD PRIMARY KEY (`payrl_holi_id`);

--
-- Indexes for table `payroll_tax_collection`
--
ALTER TABLE `payroll_tax_collection`
  ADD PRIMARY KEY (`tax_coll_id`);

--
-- Indexes for table `payroll_tax_setup`
--
ALTER TABLE `payroll_tax_setup`
  ADD PRIMARY KEY (`tax_setup_id`);

--
-- Indexes for table `pay_frequency`
--
ALTER TABLE `pay_frequency`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pm_activity_logs`
--
ALTER TABLE `pm_activity_logs`
  ADD PRIMARY KEY (`activity_id`);

--
-- Indexes for table `pm_clients`
--
ALTER TABLE `pm_clients`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `pm_employee_projects`
--
ALTER TABLE `pm_employee_projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pm_projects`
--
ALTER TABLE `pm_projects`
  ADD PRIMARY KEY (`project_id`);

--
-- Indexes for table `pm_sprints`
--
ALTER TABLE `pm_sprints`
  ADD PRIMARY KEY (`sprint_id`);

--
-- Indexes for table `pm_tasks_list`
--
ALTER TABLE `pm_tasks_list`
  ADD PRIMARY KEY (`task_id`);

--
-- Indexes for table `point_attendence`
--
ALTER TABLE `point_attendence`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `point_categories`
--
ALTER TABLE `point_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `point_collaborative`
--
ALTER TABLE `point_collaborative`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `point_management`
--
ALTER TABLE `point_management`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `point_reward`
--
ALTER TABLE `point_reward`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `point_settings`
--
ALTER TABLE `point_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`pos_id`);

--
-- Indexes for table `procurement_bid_analysis`
--
ALTER TABLE `procurement_bid_analysis`
  ADD PRIMARY KEY (`bid_analysis_form_id`);

--
-- Indexes for table `procurement_commitee_list`
--
ALTER TABLE `procurement_commitee_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `procurement_good_received`
--
ALTER TABLE `procurement_good_received`
  ADD PRIMARY KEY (`good_received_id`);

--
-- Indexes for table `procurement_items`
--
ALTER TABLE `procurement_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `procurement_purchase_order`
--
ALTER TABLE `procurement_purchase_order`
  ADD PRIMARY KEY (`purchase_order_id`);

--
-- Indexes for table `procurement_quotation`
--
ALTER TABLE `procurement_quotation`
  ADD PRIMARY KEY (`quotation_form_id`);

--
-- Indexes for table `procurement_request_form`
--
ALTER TABLE `procurement_request_form`
  ADD PRIMARY KEY (`request_form_id`);

--
-- Indexes for table `procurement_vendor`
--
ALTER TABLE `procurement_vendor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rate_type`
--
ALTER TABLE `rate_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salary_setup_header`
--
ALTER TABLE `salary_setup_header`
  ADD PRIMARY KEY (`s_s_h_id`);

--
-- Indexes for table `salary_sheet_generate`
--
ALTER TABLE `salary_sheet_generate`
  ADD PRIMARY KEY (`ssg_id`);

--
-- Indexes for table `salary_type`
--
ALTER TABLE `salary_type`
  ADD PRIMARY KEY (`salary_type_id`);

--
-- Indexes for table `schdule_purchse_info`
--
ALTER TABLE `schdule_purchse_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sec_menu_item`
--
ALTER TABLE `sec_menu_item`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `sec_role_permission`
--
ALTER TABLE `sec_role_permission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sec_role_tbl`
--
ALTER TABLE `sec_role_tbl`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `sec_user_access_tbl`
--
ALTER TABLE `sec_user_access_tbl`
  ADD PRIMARY KEY (`role_acc_id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `synchronizer_setting`
--
ALTER TABLE `synchronizer_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `weekly_holiday`
--
ALTER TABLE `weekly_holiday`
  ADD PRIMARY KEY (`wk_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acc_coa`
--
ALTER TABLE `acc_coa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=213;

--
-- AUTO_INCREMENT for table `acc_monthly_balance`
--
ALTER TABLE `acc_monthly_balance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `acc_opening_balance`
--
ALTER TABLE `acc_opening_balance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `acc_predefine_account`
--
ALTER TABLE `acc_predefine_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `acc_subcode`
--
ALTER TABLE `acc_subcode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `acc_subtype`
--
ALTER TABLE `acc_subtype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `acc_transaction`
--
ALTER TABLE `acc_transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `acc_vaucher`
--
ALTER TABLE `acc_vaucher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `activity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `appsetting`
--
ALTER TABLE `appsetting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `attendance_history`
--
ALTER TABLE `attendance_history`
  MODIFY `atten_his_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `award`
--
ALTER TABLE `award`
  MODIFY `award_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bank_information`
--
ALTER TABLE `bank_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `candidate_education_info`
--
ALTER TABLE `candidate_education_info`
  MODIFY `can_edu_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `candidate_interview`
--
ALTER TABLE `candidate_interview`
  MODIFY `can_int_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `candidate_selection`
--
ALTER TABLE `candidate_selection`
  MODIFY `can_sel_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `candidate_shortlist`
--
ALTER TABLE `candidate_shortlist`
  MODIFY `can_short_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `candidate_workexperience`
--
ALTER TABLE `candidate_workexperience`
  MODIFY `can_workexp_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `custom_table`
--
ALTER TABLE `custom_table`
  MODIFY `custom_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `dept_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `deviceinfo`
--
ALTER TABLE `deviceinfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `duty_type`
--
ALTER TABLE `duty_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `employee_benifit`
--
ALTER TABLE `employee_benifit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee_equipment`
--
ALTER TABLE `employee_equipment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee_history`
--
ALTER TABLE `employee_history`
  MODIFY `emp_his_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employee_performance`
--
ALTER TABLE `employee_performance`
  MODIFY `emp_per_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `employee_salary_payment`
--
ALTER TABLE `employee_salary_payment`
  MODIFY `emp_sal_pay_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee_salary_setup`
--
ALTER TABLE `employee_salary_setup`
  MODIFY `e_s_s_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `emp_attendance`
--
ALTER TABLE `emp_attendance`
  MODIFY `att_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `equipment`
--
ALTER TABLE `equipment`
  MODIFY `equipment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `equipment_type`
--
ALTER TABLE `equipment_type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expense_information`
--
ALTER TABLE `expense_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `financial_year`
--
ALTER TABLE `financial_year`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=176;

--
-- AUTO_INCREMENT for table `gender`
--
ALTER TABLE `gender`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `gmb_bank_info`
--
ALTER TABLE `gmb_bank_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `gmb_employee_file`
--
ALTER TABLE `gmb_employee_file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `gmb_employee_types`
--
ALTER TABLE `gmb_employee_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `gmb_emp_perform_criteria`
--
ALTER TABLE `gmb_emp_perform_criteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `gmb_emp_perform_eval`
--
ALTER TABLE `gmb_emp_perform_eval`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `gmb_emp_perform_type`
--
ALTER TABLE `gmb_emp_perform_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `gmb_emp_perform_values`
--
ALTER TABLE `gmb_emp_perform_values`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `gmb_payroll_post`
--
ALTER TABLE `gmb_payroll_post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gmb_perform_development_plan`
--
ALTER TABLE `gmb_perform_development_plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `gmb_perform_key_goals`
--
ALTER TABLE `gmb_perform_key_goals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `gmb_prform_sub_category`
--
ALTER TABLE `gmb_prform_sub_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `gmb_rules_map`
--
ALTER TABLE `gmb_rules_map`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `gmb_salary_advance`
--
ALTER TABLE `gmb_salary_advance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `gmb_salary_generate`
--
ALTER TABLE `gmb_salary_generate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `gmb_salary_sheet_generate`
--
ALTER TABLE `gmb_salary_sheet_generate`
  MODIFY `ssg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `gmb_setup_rules`
--
ALTER TABLE `gmb_setup_rules`
  MODIFY `rule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `gmb_sub_cat_perform`
--
ALTER TABLE `gmb_sub_cat_perform`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `gmb_tax_calculation`
--
ALTER TABLE `gmb_tax_calculation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `grand_loan`
--
ALTER TABLE `grand_loan`
  MODIFY `loan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `income_area`
--
ALTER TABLE `income_area`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `language`
--
ALTER TABLE `language`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1228;

--
-- AUTO_INCREMENT for table `leave_apply`
--
ALTER TABLE `leave_apply`
  MODIFY `leave_appl_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leave_type`
--
ALTER TABLE `leave_type`
  MODIFY `leave_type_id` int(2) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loan_installment`
--
ALTER TABLE `loan_installment`
  MODIFY `loan_inst_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `marital_info`
--
ALTER TABLE `marital_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `module`
--
ALTER TABLE `module`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `module_permission`
--
ALTER TABLE `module_permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `module_purchase_key`
--
ALTER TABLE `module_purchase_key`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notice_board`
--
ALTER TABLE `notice_board`
  MODIFY `notice_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payroll_holiday`
--
ALTER TABLE `payroll_holiday`
  MODIFY `payrl_holi_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payroll_tax_collection`
--
ALTER TABLE `payroll_tax_collection`
  MODIFY `tax_coll_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payroll_tax_setup`
--
ALTER TABLE `payroll_tax_setup`
  MODIFY `tax_setup_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pay_frequency`
--
ALTER TABLE `pay_frequency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pm_activity_logs`
--
ALTER TABLE `pm_activity_logs`
  MODIFY `activity_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pm_clients`
--
ALTER TABLE `pm_clients`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pm_employee_projects`
--
ALTER TABLE `pm_employee_projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pm_projects`
--
ALTER TABLE `pm_projects`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pm_sprints`
--
ALTER TABLE `pm_sprints`
  MODIFY `sprint_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pm_tasks_list`
--
ALTER TABLE `pm_tasks_list`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `point_attendence`
--
ALTER TABLE `point_attendence`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `point_categories`
--
ALTER TABLE `point_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `point_collaborative`
--
ALTER TABLE `point_collaborative`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `point_management`
--
ALTER TABLE `point_management`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `point_reward`
--
ALTER TABLE `point_reward`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `point_settings`
--
ALTER TABLE `point_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `pos_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `procurement_bid_analysis`
--
ALTER TABLE `procurement_bid_analysis`
  MODIFY `bid_analysis_form_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `procurement_commitee_list`
--
ALTER TABLE `procurement_commitee_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `procurement_good_received`
--
ALTER TABLE `procurement_good_received`
  MODIFY `good_received_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `procurement_items`
--
ALTER TABLE `procurement_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `procurement_purchase_order`
--
ALTER TABLE `procurement_purchase_order`
  MODIFY `purchase_order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `procurement_quotation`
--
ALTER TABLE `procurement_quotation`
  MODIFY `quotation_form_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `procurement_request_form`
--
ALTER TABLE `procurement_request_form`
  MODIFY `request_form_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `procurement_vendor`
--
ALTER TABLE `procurement_vendor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rate_type`
--
ALTER TABLE `rate_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `salary_setup_header`
--
ALTER TABLE `salary_setup_header`
  MODIFY `s_s_h_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `salary_sheet_generate`
--
ALTER TABLE `salary_sheet_generate`
  MODIFY `ssg_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `salary_type`
--
ALTER TABLE `salary_type`
  MODIFY `salary_type_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `schdule_purchse_info`
--
ALTER TABLE `schdule_purchse_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sec_menu_item`
--
ALTER TABLE `sec_menu_item`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=199668;

--
-- AUTO_INCREMENT for table `sec_role_permission`
--
ALTER TABLE `sec_role_permission`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=511;

--
-- AUTO_INCREMENT for table `sec_role_tbl`
--
ALTER TABLE `sec_role_tbl`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sec_user_access_tbl`
--
ALTER TABLE `sec_user_access_tbl`
  MODIFY `role_acc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `synchronizer_setting`
--
ALTER TABLE `synchronizer_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `weekly_holiday`
--
ALTER TABLE `weekly_holiday`
  MODIFY `wk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
