SET sql_mode = '';

--
-- Table structure for table `acc_coa`
--

DROP TABLE IF EXISTS `acc_coa`;
CREATE TABLE IF NOT EXISTS `acc_coa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `UpdateDate` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `HeadCode` (`HeadCode`),
  KEY `PHeadName` (`PHeadName`),
  KEY `HeadLevel` (`HeadLevel`),
  KEY `IsTransaction` (`IsTransaction`),
  KEY `IsGL` (`IsGL`),
  KEY `IsBudget` (`IsBudget`),
  KEY `IsDepreciation` (`IsDepreciation`),
  KEY `isCashNature` (`isCashNature`),
  KEY `isBankNature` (`isBankNature`)
) ENGINE=InnoDB AUTO_INCREMENT=224 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `acc_coa`
--

INSERT INTO `acc_coa` (`id`, `pheadcode`, `HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `isCashNature`, `isBankNature`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `isSubType`, `subType`, `isStock`, `isFixedAssetSch`, `noteNo`, `assetCode`, `depCode`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES(8, 502, '50202', 'Accounts Payable', 'Current Liabilities', 3, 1, 0, 1, 0, 0, 'L', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-05-17 12:52:17', 0, '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`id`, `pheadcode`, `HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `isCashNature`, `isBankNature`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `isSubType`, `subType`, `isStock`, `isFixedAssetSch`, `noteNo`, `assetCode`, `depCode`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES(9, 102, '10202', 'Account Receivable', 'Current Asset', 3, 1, 0, 1, 0, 0, 'A', 0, 0, 0, 0, 1, 0, 0, '', '', '', 1, '2022-04-04 11:00:54', 0, '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`id`, `pheadcode`, `HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `isCashNature`, `isBankNature`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `isSubType`, `subType`, `isStock`, `isFixedAssetSch`, `noteNo`, `assetCode`, `depCode`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES(10, 0, '1', 'Assets', 'COA', 1, 1, 0, 0, 0, 0, 'A', 0, 0, 0, 0, 1, 0, 0, '', '', '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`id`, `pheadcode`, `HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `isCashNature`, `isBankNature`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `isSubType`, `subType`, `isStock`, `isFixedAssetSch`, `noteNo`, `assetCode`, `depCode`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES(13, 102, '10201', 'Cash', 'Current Asset', 3, 1, 0, 0, 0, 0, 'A', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-04-10 12:07:11', 0, '2015-10-15 15:57:55');
INSERT INTO `acc_coa` (`id`, `pheadcode`, `HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `isCashNature`, `isBankNature`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `isSubType`, `subType`, `isStock`, `isFixedAssetSch`, `noteNo`, `assetCode`, `depCode`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES(15, 10201, '1020101', 'Cash In Hand', 'Cash', 4, 1, 1, 1, 1, 0, 'A', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-04-12 08:16:03', 0, '2016-05-23 12:05:43');
INSERT INTO `acc_coa` (`id`, `pheadcode`, `HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `isCashNature`, `isBankNature`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `isSubType`, `subType`, `isStock`, `isFixedAssetSch`, `noteNo`, `assetCode`, `depCode`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES(16, 1, '102', 'Current Asset', 'Assets', 2, 1, 0, 0, 0, 0, 'A', 0, 0, 0, 0, 1, 0, 0, '', '', '', 0, '0000-00-00 00:00:00', 0, '2018-07-07 11:23:00');
INSERT INTO `acc_coa` (`id`, `pheadcode`, `HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `isCashNature`, `isBankNature`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `isSubType`, `subType`, `isStock`, `isFixedAssetSch`, `noteNo`, `assetCode`, `depCode`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES(17, 5, '502', 'Current Liabilities', 'Liabilities', 2, 1, 0, 0, 0, 0, 'L', 0, 0, 0, 0, 1, 0, 0, '', '', '', 0, '2014-08-30 13:18:20', 0, '2015-10-15 19:49:21');
INSERT INTO `acc_coa` (`id`, `pheadcode`, `HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `isCashNature`, `isBankNature`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `isSubType`, `subType`, `isStock`, `isFixedAssetSch`, `noteNo`, `assetCode`, `depCode`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES(19, 10202, '1020202', 'Customer Receivable', 'Account Receivable', 4, 1, 1, 0, 0, 0, 'A', 0, 0, 0, 1, 3, 0, 0, NULL, NULL, NULL, 1, '2022-04-27 10:00:13', 0, '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`id`, `pheadcode`, `HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `isCashNature`, `isBankNature`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `isSubType`, `subType`, `isStock`, `isFixedAssetSch`, `noteNo`, `assetCode`, `depCode`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES(22, 10202, '1020301', 'Employee Receivable', 'Account Receivable', 4, 1, 1, 0, 0, 0, 'A', 0, 0, 0, 0, 1, 0, 0, '', '', '', 1, '2022-04-04 11:01:32', 0, '2018-07-07 12:31:42');
INSERT INTO `acc_coa` (`id`, `pheadcode`, `HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `isCashNature`, `isBankNature`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `isSubType`, `subType`, `isStock`, `isFixedAssetSch`, `noteNo`, `assetCode`, `depCode`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES(23, 4, '401', 'Cost of Goods Solds', 'Expenses', 2, 1, 1, 1, 0, 0, 'E', 0, 0, 0, 0, 1, 0, 0, '', '', '', 1, '2022-04-02 10:28:34', 0, '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`id`, `pheadcode`, `HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `isCashNature`, `isBankNature`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `isSubType`, `subType`, `isStock`, `isFixedAssetSch`, `noteNo`, `assetCode`, `depCode`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES(24, 0, '2', 'Shareholder\'s Equity', 'COA', 1, 1, 0, 0, 0, 0, 'L', 0, 0, 0, 0, 1, 0, 0, '', '', '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`id`, `pheadcode`, `HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `isCashNature`, `isBankNature`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `isSubType`, `subType`, `isStock`, `isFixedAssetSch`, `noteNo`, `assetCode`, `depCode`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES(25, 0, '4', 'Expenses', 'COA', 1, 1, 0, 0, 0, 0, 'E', 0, 0, 0, 0, 1, 0, 0, '', '', '', 2, '2019-11-24 05:45:24', 0, '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`id`, `pheadcode`, `HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `isCashNature`, `isBankNature`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `isSubType`, `subType`, `isStock`, `isFixedAssetSch`, `noteNo`, `assetCode`, `depCode`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES(26, 1, '101', 'Fixed Assets', 'Assets', 2, 1, 0, 0, 0, 0, 'A', 0, 0, 0, 0, 1, 0, 0, '', '', '', 0, '0000-00-00 00:00:00', 0, '2015-10-15 15:29:11');
INSERT INTO `acc_coa` (`id`, `pheadcode`, `HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `isCashNature`, `isBankNature`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `isSubType`, `subType`, `isStock`, `isFixedAssetSch`, `noteNo`, `assetCode`, `depCode`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES(27, 4, '402', 'Over Head Cost', 'Expenses', 2, 1, 1, 1, 0, 0, 'E', 0, 0, 0, 0, 1, 0, 0, '', '', '', 1, '2022-04-04 10:01:58', 0, '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`id`, `pheadcode`, `HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `isCashNature`, `isBankNature`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `isSubType`, `subType`, `isStock`, `isFixedAssetSch`, `noteNo`, `assetCode`, `depCode`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES(29, 0, '3', 'Income', 'COA', 1, 1, 0, 0, 0, 0, 'I', 0, 0, 0, 0, 1, 0, 0, '', '', '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`id`, `pheadcode`, `HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `isCashNature`, `isBankNature`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `isSubType`, `subType`, `isStock`, `isFixedAssetSch`, `noteNo`, `assetCode`, `depCode`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES(30, 0, '5', 'Liabilities', 'COA', 1, 1, 0, 0, 0, 0, 'L', 0, 0, 0, 0, 1, 0, 0, '', '', '', 0, '2013-07-04 12:32:07', 0, '2015-10-15 19:46:54');
INSERT INTO `acc_coa` (`id`, `pheadcode`, `HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `isCashNature`, `isBankNature`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `isSubType`, `subType`, `isStock`, `isFixedAssetSch`, `noteNo`, `assetCode`, `depCode`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES(31, 5, '501', 'Long Term Liabilities', 'Liabilities', 2, 1, 0, 0, 0, 0, 'L', 0, 0, 0, 0, 1, 0, 0, '', '', '', 0, '2014-08-30 13:18:20', 0, '2015-10-15 19:49:21');
INSERT INTO `acc_coa` (`id`, `pheadcode`, `HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `isCashNature`, `isBankNature`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `isSubType`, `subType`, `isStock`, `isFixedAssetSch`, `noteNo`, `assetCode`, `depCode`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES(33, 3, '301', 'Direct Income', 'Income', 2, 1, 1, 1, 0, 0, 'I', 0, 0, 0, 0, 1, 0, 0, '', '', '', 1, '2022-04-02 10:31:45', 0, '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`id`, `pheadcode`, `HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `isCashNature`, `isBankNature`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `isSubType`, `subType`, `isStock`, `isFixedAssetSch`, `noteNo`, `assetCode`, `depCode`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES(35, 3, '302', 'Indirect Income', 'Income', 2, 1, 1, 1, 0, 0, 'I', 0, 0, 0, 0, 1, 0, 0, '', '', '', 1, '2022-04-02 10:55:45', 0, '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`id`, `pheadcode`, `HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `isCashNature`, `isBankNature`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `isSubType`, `subType`, `isStock`, `isFixedAssetSch`, `noteNo`, `assetCode`, `depCode`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES(36, 50202, '5020201', 'Supplier Payable', 'Accounts Payable', 4, 1, 0, 1, 0, 0, 'L', 0, 0, 0, 1, 4, 0, 0, NULL, NULL, NULL, 1, '2022-05-17 12:52:44', 0, '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`id`, `pheadcode`, `HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `isCashNature`, `isBankNature`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `isSubType`, `subType`, `isStock`, `isFixedAssetSch`, `noteNo`, `assetCode`, `depCode`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES(41, 102, '10203', 'Prepaid Expenses', 'Current Asset', 3, 1, 0, 0, 0, 0, 'A', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-04-10 06:45:19', 0, '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`id`, `pheadcode`, `HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `isCashNature`, `isBankNature`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `isSubType`, `subType`, `isStock`, `isFixedAssetSch`, `noteNo`, `assetCode`, `depCode`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES(43, 102, '10204', 'Inventory', 'Current Asset', 3, 1, 0, 0, 0, 0, 'A', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-04-10 06:48:32', 0, '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`id`, `pheadcode`, `HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `isCashNature`, `isBankNature`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `isSubType`, `subType`, `isStock`, `isFixedAssetSch`, `noteNo`, `assetCode`, `depCode`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES(44, 502, '50203', 'Accrued Expenses', 'Current Liabilities', 3, 1, 0, 0, 0, 0, 'L', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-04-10 06:50:20', 0, '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`id`, `pheadcode`, `HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `isCashNature`, `isBankNature`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `isSubType`, `subType`, `isStock`, `isFixedAssetSch`, `noteNo`, `assetCode`, `depCode`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES(46, 501, '50101', 'Long-Term Debt', 'Long Term Liabilities', 3, 1, 0, 0, 0, 0, 'L', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-04-10 06:51:45', 0, '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`id`, `pheadcode`, `HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `isCashNature`, `isBankNature`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `isSubType`, `subType`, `isStock`, `isFixedAssetSch`, `noteNo`, `assetCode`, `depCode`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES(47, 501, '50102', 'Other Long-Term  Liabilities', 'Long Term Liabilities', 3, 1, 0, 0, 0, 0, 'L', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-04-10 06:53:04', 0, '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`id`, `pheadcode`, `HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `isCashNature`, `isBankNature`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `isSubType`, `subType`, `isStock`, `isFixedAssetSch`, `noteNo`, `assetCode`, `depCode`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES(48, 2, '201', 'Equity', 'Shareholder\'s Equity', 2, 1, 0, 0, 0, 0, 'L', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 0, '2022-04-10 06:56:38', 0, '2022-04-10 06:56:38');
INSERT INTO `acc_coa` (`id`, `pheadcode`, `HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `isCashNature`, `isBankNature`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `isSubType`, `subType`, `isStock`, `isFixedAssetSch`, `noteNo`, `assetCode`, `depCode`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES(49, 201, '20101', 'Equity Capital', 'Equity', 3, 1, 0, 0, 0, 0, 'L', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-05-17 12:31:33', 0, '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`id`, `pheadcode`, `HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `isCashNature`, `isBankNature`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `isSubType`, `subType`, `isStock`, `isFixedAssetSch`, `noteNo`, `assetCode`, `depCode`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES(50, 201, '20102', 'Retained Earnings', 'Equity', 3, 1, 0, 0, 0, 0, 'L', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-04-10 07:01:45', 0, '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`id`, `pheadcode`, `HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `isCashNature`, `isBankNature`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `isSubType`, `subType`, `isStock`, `isFixedAssetSch`, `noteNo`, `assetCode`, `depCode`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES(51, 101, '10101', 'Property & Equipment', 'Fixed Assets', 3, 1, 0, 0, 0, 0, 'A', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-04-10 11:35:53', 0, '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`id`, `pheadcode`, `HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `isCashNature`, `isBankNature`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `isSubType`, `subType`, `isStock`, `isFixedAssetSch`, `noteNo`, `assetCode`, `depCode`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES(52, 101, '10102', 'Goodwills', 'Fixed Assets', 3, 1, 0, 0, 0, 0, 'A', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-04-23 06:47:21', 0, '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`id`, `pheadcode`, `HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `isCashNature`, `isBankNature`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `isSubType`, `subType`, `isStock`, `isFixedAssetSch`, `noteNo`, `assetCode`, `depCode`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES(53, 301, '30101', 'Construction Income', 'Direct Income', 3, 1, 0, 0, 0, 0, 'I', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-04-10 08:08:04', 0, '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`id`, `pheadcode`, `HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `isCashNature`, `isBankNature`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `isSubType`, `subType`, `isStock`, `isFixedAssetSch`, `noteNo`, `assetCode`, `depCode`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES(54, 301, '30102', 'Reimbursement Income', 'Direct Income', 3, 1, 0, 0, 0, 0, 'I', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-04-10 08:09:02', 0, '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`id`, `pheadcode`, `HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `isCashNature`, `isBankNature`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `isSubType`, `subType`, `isStock`, `isFixedAssetSch`, `noteNo`, `assetCode`, `depCode`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES(55, 401, '40101', 'Cost of Goods Sold', 'Cost of Goods Solds', 3, 1, 0, 0, 0, 0, 'E', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-04-10 08:13:52', 0, '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`id`, `pheadcode`, `HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `isCashNature`, `isBankNature`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `isSubType`, `subType`, `isStock`, `isFixedAssetSch`, `noteNo`, `assetCode`, `depCode`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES(56, 401, '40102', 'Job Expenses', 'Cost of Goods Solds', 3, 1, 0, 0, 0, 0, 'E', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-04-10 08:14:18', 0, '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`id`, `pheadcode`, `HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `isCashNature`, `isBankNature`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `isSubType`, `subType`, `isStock`, `isFixedAssetSch`, `noteNo`, `assetCode`, `depCode`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES(57, 402, '40201', 'Automobile', 'Over Head Cost', 3, 1, 0, 0, 0, 0, 'E', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-04-10 08:14:37', 0, '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`id`, `pheadcode`, `HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `isCashNature`, `isBankNature`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `isSubType`, `subType`, `isStock`, `isFixedAssetSch`, `noteNo`, `assetCode`, `depCode`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES(58, 402, '40202', 'Bank Service Charges', 'Over Head Cost', 3, 1, 0, 0, 0, 0, 'E', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-04-10 08:15:32', 0, '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`id`, `pheadcode`, `HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `isCashNature`, `isBankNature`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `isSubType`, `subType`, `isStock`, `isFixedAssetSch`, `noteNo`, `assetCode`, `depCode`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES(59, 402, '40203', 'Insurance', 'Over Head Cost', 3, 1, 0, 0, 0, 0, 'E', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-04-10 08:15:58', 0, '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`id`, `pheadcode`, `HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `isCashNature`, `isBankNature`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `isSubType`, `subType`, `isStock`, `isFixedAssetSch`, `noteNo`, `assetCode`, `depCode`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES(60, 402, '40204', 'Interest Expenses', 'Over Head Cost', 3, 1, 0, 0, 0, 0, 'E', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-04-10 08:16:36', 0, '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`id`, `pheadcode`, `HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `isCashNature`, `isBankNature`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `isSubType`, `subType`, `isStock`, `isFixedAssetSch`, `noteNo`, `assetCode`, `depCode`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES(61, 402, '40205', 'Payroll Expenses', 'Over Head Cost', 3, 1, 0, 0, 0, 0, 'E', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-04-10 08:17:08', 0, '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`id`, `pheadcode`, `HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `isCashNature`, `isBankNature`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `isSubType`, `subType`, `isStock`, `isFixedAssetSch`, `noteNo`, `assetCode`, `depCode`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES(62, 402, '40206', 'Postage', 'Over Head Cost', 3, 1, 0, 0, 0, 0, 'E', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-04-10 08:17:26', 0, '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`id`, `pheadcode`, `HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `isCashNature`, `isBankNature`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `isSubType`, `subType`, `isStock`, `isFixedAssetSch`, `noteNo`, `assetCode`, `depCode`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES(63, 402, '40207', 'Professional Fees', 'Over Head Cost', 3, 1, 0, 0, 0, 0, 'E', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-04-10 08:17:55', 0, '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`id`, `pheadcode`, `HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `isCashNature`, `isBankNature`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `isSubType`, `subType`, `isStock`, `isFixedAssetSch`, `noteNo`, `assetCode`, `depCode`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES(64, 402, '40208', 'Repairs', 'Over Head Cost', 3, 1, 0, 0, 0, 0, 'E', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-04-10 08:18:38', 0, '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`id`, `pheadcode`, `HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `isCashNature`, `isBankNature`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `isSubType`, `subType`, `isStock`, `isFixedAssetSch`, `noteNo`, `assetCode`, `depCode`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES(65, 402, '40209', 'Tools and Macchnery', 'Over Head Cost', 3, 1, 0, 0, 0, 0, 'E', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-04-10 08:28:02', 0, '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`id`, `pheadcode`, `HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `isCashNature`, `isBankNature`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `isSubType`, `subType`, `isStock`, `isFixedAssetSch`, `noteNo`, `assetCode`, `depCode`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES(66, 402, '40210', 'Utilities', 'Over Head Cost', 3, 1, 0, 0, 0, 0, 'E', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-04-10 08:28:42', 0, '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`id`, `pheadcode`, `HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `isCashNature`, `isBankNature`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `isSubType`, `subType`, `isStock`, `isFixedAssetSch`, `noteNo`, `assetCode`, `depCode`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES(67, 40210, '4021001', 'Electic Bill', 'Utilities', 4, 1, 0, 0, 0, 0, 'E', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-04-10 09:05:45', 0, '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`id`, `pheadcode`, `HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `isCashNature`, `isBankNature`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `isSubType`, `subType`, `isStock`, `isFixedAssetSch`, `noteNo`, `assetCode`, `depCode`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES(68, 40210, '4021002', 'House Rent', 'Utilities', 4, 1, 0, 0, 0, 0, 'E', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-04-10 09:06:05', 0, '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`id`, `pheadcode`, `HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `isCashNature`, `isBankNature`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `isSubType`, `subType`, `isStock`, `isFixedAssetSch`, `noteNo`, `assetCode`, `depCode`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES(69, 102, '10205', 'Cash at Bank', 'Current Asset', 3, 1, 0, 0, 0, 0, 'A', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-05-17 12:44:19', 0, '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`id`, `pheadcode`, `HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `isCashNature`, `isBankNature`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `isSubType`, `subType`, `isStock`, `isFixedAssetSch`, `noteNo`, `assetCode`, `depCode`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES(75, 10102, '1010201', 'Goodwill', 'Goodwills', 4, 1, 0, 0, 0, 0, 'A', 0, 0, 15, 0, 1, 0, 1, NULL, 'GD001', NULL, 1, '2022-04-23 06:45:48', 0, '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`id`, `pheadcode`, `HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `isCashNature`, `isBankNature`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `isSubType`, `subType`, `isStock`, `isFixedAssetSch`, `noteNo`, `assetCode`, `depCode`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES(77, 50204, '5020401', 'property sales', 'Unearned Revenue', 4, 1, 0, 0, 0, 0, 'L', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-04-10 11:40:48', 0, '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`id`, `pheadcode`, `HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `isCashNature`, `isBankNature`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `isSubType`, `subType`, `isStock`, `isFixedAssetSch`, `noteNo`, `assetCode`, `depCode`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES(78, 50101, '5010101', 'Debts', 'Long-Term Debt', 4, 1, 0, 0, 0, 0, 'L', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-04-10 11:41:49', 0, '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`id`, `pheadcode`, `HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `isCashNature`, `isBankNature`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `isSubType`, `subType`, `isStock`, `isFixedAssetSch`, `noteNo`, `assetCode`, `depCode`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES(79, 50102, '5010201', 'Other Long-Term  Liabilities', 'Other Long-Term  Liabilities', 4, 1, 0, 0, 0, 0, 'L', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-04-10 11:42:03', 0, '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`id`, `pheadcode`, `HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `isCashNature`, `isBankNature`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `isSubType`, `subType`, `isStock`, `isFixedAssetSch`, `noteNo`, `assetCode`, `depCode`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES(80, 20101, '2010101', 'Capital Fund', 'Equity Capital', 4, 1, 0, 0, 0, 0, 'L', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-04-10 11:42:36', 0, '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`id`, `pheadcode`, `HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `isCashNature`, `isBankNature`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `isSubType`, `subType`, `isStock`, `isFixedAssetSch`, `noteNo`, `assetCode`, `depCode`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES(81, 20102, '2010201', 'Current year Profit & Loss', 'Retained Earnings', 4, 1, 0, 0, 0, 0, 'L', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-04-10 11:42:53', 0, '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`id`, `pheadcode`, `HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `isCashNature`, `isBankNature`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `isSubType`, `subType`, `isStock`, `isFixedAssetSch`, `noteNo`, `assetCode`, `depCode`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES(82, 20102, '2010202', 'Last year Profit & Loss', 'Retained Earnings', 4, 1, 0, 0, 0, 0, 'L', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-04-10 11:43:03', 0, '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`id`, `pheadcode`, `HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `isCashNature`, `isBankNature`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `isSubType`, `subType`, `isStock`, `isFixedAssetSch`, `noteNo`, `assetCode`, `depCode`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES(84, 502, '50201', 'Provisions', 'Current Liabilities', 3, 1, 0, 0, 0, 0, 'L', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-04-10 11:46:00', 0, '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`id`, `pheadcode`, `HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `isCashNature`, `isBankNature`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `isSubType`, `subType`, `isStock`, `isFixedAssetSch`, `noteNo`, `assetCode`, `depCode`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES(85, 50205, '5020104', 'Depreciation of Goodwill', 'Depreciations', 4, 1, 0, 0, 0, 0, 'L', 0, 0, 0, 0, 1, 0, 1, NULL, NULL, 'GD001', 1, '2022-04-23 06:47:07', 0, '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`id`, `pheadcode`, `HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `isCashNature`, `isBankNature`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `isSubType`, `subType`, `isStock`, `isFixedAssetSch`, `noteNo`, `assetCode`, `depCode`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES(86, 502, '50204', 'Unearned Revenue', 'Current Liabilities', 3, 1, 0, 0, 0, 0, 'L', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-05-17 12:53:09', 0, '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`id`, `pheadcode`, `HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `isCashNature`, `isBankNature`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `isSubType`, `subType`, `isStock`, `isFixedAssetSch`, `noteNo`, `assetCode`, `depCode`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES(88, 102, '10206', 'Advance', 'Current Asset', 3, 1, 0, 0, 0, 0, 'A', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-04-11 11:56:56', 0, '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`id`, `pheadcode`, `HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `isCashNature`, `isBankNature`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `isSubType`, `subType`, `isStock`, `isFixedAssetSch`, `noteNo`, `assetCode`, `depCode`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES(89, 10206, '1020601', 'Advance against Employee', 'Advance', 4, 1, 0, 0, 0, 0, 'A', 0, 0, 0, 1, 2, 0, 0, NULL, NULL, NULL, 1, '2022-04-11 11:57:18', 0, '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`id`, `pheadcode`, `HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `isCashNature`, `isBankNature`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `isSubType`, `subType`, `isStock`, `isFixedAssetSch`, `noteNo`, `assetCode`, `depCode`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES(90, 10206, '1020602', 'Advance Against Customer', 'Advance', 4, 1, 0, 0, 0, 0, 'A', 0, 0, 0, 1, 3, 0, 0, NULL, NULL, NULL, 1, '2022-04-11 11:57:35', 0, '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`id`, `pheadcode`, `HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `isCashNature`, `isBankNature`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `isSubType`, `subType`, `isStock`, `isFixedAssetSch`, `noteNo`, `assetCode`, `depCode`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES(91, 10201, '1020102', 'Petty Cash', 'Cash', 4, 1, 0, 0, 1, 0, 'A', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-04-12 08:16:19', 0, '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`id`, `pheadcode`, `HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `isCashNature`, `isBankNature`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `isSubType`, `subType`, `isStock`, `isFixedAssetSch`, `noteNo`, `assetCode`, `depCode`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES(94, 402, '40301', 'Purchase Account', 'Purchase Accounts', 3, 1, 0, 0, 0, 0, 'E', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 0, '2022-04-16 10:31:43', 0, '2022-04-16 10:31:43');
INSERT INTO `acc_coa` (`id`, `pheadcode`, `HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `isCashNature`, `isBankNature`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `isSubType`, `subType`, `isStock`, `isFixedAssetSch`, `noteNo`, `assetCode`, `depCode`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES(95, 40201, '4030102', 'Purchase', 'Purchase Account', 4, 1, 0, 0, 0, 0, 'E', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-04-16 10:33:59', 0, '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`id`, `pheadcode`, `HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `isCashNature`, `isBankNature`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `isSubType`, `subType`, `isStock`, `isFixedAssetSch`, `noteNo`, `assetCode`, `depCode`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES(96, 301, '30103', 'Sales Accounts', 'Direct Income', 3, 1, 0, 0, 0, 0, 'I', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-04-16 10:34:37', 0, '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`id`, `pheadcode`, `HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `isCashNature`, `isBankNature`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `isSubType`, `subType`, `isStock`, `isFixedAssetSch`, `noteNo`, `assetCode`, `depCode`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES(97, 30103, '3010301', 'Sales Account', 'Sales Accounts', 4, 1, 0, 0, 0, 0, 'I', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-04-16 10:34:57', 0, '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`id`, `pheadcode`, `HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `isCashNature`, `isBankNature`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `isSubType`, `subType`, `isStock`, `isFixedAssetSch`, `noteNo`, `assetCode`, `depCode`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES(99, 40205, '4020501', 'Salary Expense', 'Payroll Expenses', 4, 1, 0, 0, 0, 0, 'E', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-04-20 06:24:08', 0, '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`id`, `pheadcode`, `HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `isCashNature`, `isBankNature`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `isSubType`, `subType`, `isStock`, `isFixedAssetSch`, `noteNo`, `assetCode`, `depCode`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES(104, 50201, '5020102', 'Provision for npf contribution', 'Provisions', 4, 1, 0, 0, 0, 0, 'L', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-05-10 06:19:45', 0, '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`id`, `pheadcode`, `HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `isCashNature`, `isBankNature`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `isSubType`, `subType`, `isStock`, `isFixedAssetSch`, `noteNo`, `assetCode`, `depCode`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES(106, 50201, '5020101', 'Provision for State Income Tax', 'Provisions', 4, 1, 0, 0, 0, 0, 'L', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-04-26 06:44:29', 0, '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`id`, `pheadcode`, `HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `isCashNature`, `isBankNature`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `isSubType`, `subType`, `isStock`, `isFixedAssetSch`, `noteNo`, `assetCode`, `depCode`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES(107, 402, '40211', 'State Income Tax', 'Over Head Cost', 3, 1, 0, 0, 0, 0, 'E', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-04-26 06:44:46', 0, '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`id`, `pheadcode`, `HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `isCashNature`, `isBankNature`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `isSubType`, `subType`, `isStock`, `isFixedAssetSch`, `noteNo`, `assetCode`, `depCode`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES(108, 40211, '4021101', 'State Income Tax', 'State Income Tax', 4, 1, 0, 0, 0, 0, 'E', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-04-26 06:45:00', 0, '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`id`, `pheadcode`, `HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `isCashNature`, `isBankNature`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `isSubType`, `subType`, `isStock`, `isFixedAssetSch`, `noteNo`, `assetCode`, `depCode`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES(110, 402, '40212', 'Employeer ICF Expense', 'Over Head Cost', 3, 1, 0, 0, 0, 0, 'E', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-05-10 06:35:37', 0, '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`id`, `pheadcode`, `HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `isCashNature`, `isBankNature`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `isSubType`, `subType`, `isStock`, `isFixedAssetSch`, `noteNo`, `assetCode`, `depCode`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES(111, 40212, '4021201', 'Employeer 1% ICF Expense', 'Employeer ICF Expense', 4, 1, 0, 0, 0, 0, 'E', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-05-17 11:34:02', 0, '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`id`, `pheadcode`, `HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `isCashNature`, `isBankNature`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `isSubType`, `subType`, `isStock`, `isFixedAssetSch`, `noteNo`, `assetCode`, `depCode`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES(112, 502, '50205', 'Depreciations', 'Current Liabilities', 3, 1, 0, 0, 0, 0, 'L', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 0, '2022-05-10 09:35:15', 0, '2022-05-10 09:35:15');
INSERT INTO `acc_coa` (`id`, `pheadcode`, `HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `isCashNature`, `isBankNature`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `isSubType`, `subType`, `isStock`, `isFixedAssetSch`, `noteNo`, `assetCode`, `depCode`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES(191, 40205, '4020502', 'Employee 5 % NPF Expenses', 'Payroll Expenses', 4, 1, 0, 0, 0, 0, 'E', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-05-17 11:32:14', 0, '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`id`, `pheadcode`, `HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `isCashNature`, `isBankNature`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `isSubType`, `subType`, `isStock`, `isFixedAssetSch`, `noteNo`, `assetCode`, `depCode`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES(192, 40205, '4020503', 'Employee 10 % NPF Expenses', 'Payroll Expenses', 4, 1, 0, 0, 0, 0, 'E', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-05-17 11:32:36', 0, '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`id`, `pheadcode`, `HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `isCashNature`, `isBankNature`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `isSubType`, `subType`, `isStock`, `isFixedAssetSch`, `noteNo`, `assetCode`, `depCode`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES(213, 0, '602020000001', '1-Bdtask', 'Vendor Payable', 2, 1, 1, 0, 0, 0, 'L', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 0, '2022-06-13 13:32:26', 0, '0000-00-00 00:00:00');
INSERT INTO `acc_coa` (`id`, `pheadcode`, `HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `isCashNature`, `isBankNature`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `isSubType`, `subType`, `isStock`, `isFixedAssetSch`, `noteNo`, `assetCode`, `depCode`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES(223, 10205, '1020501', 'ABC Bank', 'Cash at Bank', 4, 1, 0, 0, 0, 1, 'A', 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 1, '2022-06-16 08:47:51', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `acc_monthly_balance`
--

DROP TABLE IF EXISTS `acc_monthly_balance`;
CREATE TABLE IF NOT EXISTS `acc_monthly_balance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `updatedDate` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `acc_opening_balance`
--

DROP TABLE IF EXISTS `acc_opening_balance`;
CREATE TABLE IF NOT EXISTS `acc_opening_balance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fyear` int(11) NOT NULL,
  `COAID` int(11) NOT NULL,
  `subType` int(11) NOT NULL DEFAULT 1,
  `subCode` int(11) DEFAULT NULL,
  `Debit` decimal(10,0) NOT NULL,
  `Credit` decimal(10,0) NOT NULL,
  `openDate` date NOT NULL,
  `CreateBy` int(11) NOT NULL,
  `CreateDate` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `COAID` (`COAID`),
  KEY `year` (`fyear`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `acc_predefine_account`
--

DROP TABLE IF EXISTS `acc_predefine_account`;
CREATE TABLE IF NOT EXISTS `acc_predefine_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `prov_npfcode` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `COAID` (`cashCode`),
  KEY `cashCode` (`cashCode`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `acc_predefine_account`
--

INSERT INTO `acc_predefine_account` (`id`, `cashCode`, `bankCode`, `advance`, `fixedAsset`, `purchaseCode`, `salesCode`, `customerCode`, `supplierCode`, `costs_of_good_solds`, `vat`, `tax`, `inventoryCode`, `CPLCode`, `LPLCode`, `salary_code`, `emp_npf_contribution`, `empr_npf_contribution`, `emp_icf_contribution`, `empr_icf_contribution`, `prov_state_tax`, `state_tax`, `prov_npfcode`) VALUES(0, 10201, 10205, 10206, 101, 40301, 3010301, 1020202, 5020201, 401, 0, 0, 0, 2010201, 2010202, 4020501, 4020502, 4020503, 4021201, 0, 5020101, 4021101, 5020102);

-- --------------------------------------------------------

--
-- Table structure for table `acc_subcode`
--

DROP TABLE IF EXISTS `acc_subcode`;
CREATE TABLE IF NOT EXISTS `acc_subcode` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subTypeId` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `referenceNo` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_by` int(11) NOT NULL,
  `created_date` date NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `subTypeId` (`subTypeId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `acc_subtype`
--

DROP TABLE IF EXISTS `acc_subtype`;
CREATE TABLE IF NOT EXISTS `acc_subtype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subtypeName` varchar(200) NOT NULL,
  `staus` int(11) NOT NULL DEFAULT 1,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `acc_subtype`
--

INSERT INTO `acc_subtype` (`id`, `subtypeName`, `staus`, `created_by`, `created_date`) VALUES(1, 'None', 1, 1, '2022-04-05 10:19:27');
INSERT INTO `acc_subtype` (`id`, `subtypeName`, `staus`, `created_by`, `created_date`) VALUES(2, 'employee', 1, 1, '2022-04-06 08:14:48');
INSERT INTO `acc_subtype` (`id`, `subtypeName`, `staus`, `created_by`, `created_date`) VALUES(3, 'Customer', 1, 1, '2022-04-10 08:49:22');
INSERT INTO `acc_subtype` (`id`, `subtypeName`, `staus`, `created_by`, `created_date`) VALUES(4, 'Supplier', 1, 1, '2022-04-10 08:49:22');
INSERT INTO `acc_subtype` (`id`, `subtypeName`, `staus`, `created_by`, `created_date`) VALUES(6, 'Agent', 1, 1, '2022-04-10 08:50:12');

-- --------------------------------------------------------

--
-- Table structure for table `acc_transaction`
--

DROP TABLE IF EXISTS `acc_transaction`;
CREATE TABLE IF NOT EXISTS `acc_transaction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `subCode` int(11) DEFAULT NULL,
  UNIQUE KEY `ID` (`id`),
  KEY `VNo` (`VNo`),
  KEY `COAID` (`COAID`),
  KEY `RevCodde` (`RevCodde`),
  KEY `subType` (`subType`),
  KEY `subCode` (`subCode`),
  KEY `referenceNo` (`referenceNo`),
  KEY `vid` (`vid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `acc_vaucher`
--

DROP TABLE IF EXISTS `acc_vaucher`;
CREATE TABLE IF NOT EXISTS `acc_vaucher` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0 = non yet transfer to transation,  1 = Tranfer to transition',
  PRIMARY KEY (`id`),
  KEY `VNo` (`VNo`),
  KEY `fyear` (`fyear`),
  KEY `VDate` (`VDate`),
  KEY `COAID` (`COAID`),
  KEY `RevCodde` (`RevCodde`),
  KEY `subType` (`subType`),
  KEY `subCode` (`subCode`),
  KEY `referenceNo` (`referenceNo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

DROP TABLE IF EXISTS `activity_logs`;
CREATE TABLE IF NOT EXISTS `activity_logs` (
  `activity_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(11) NOT NULL COMMENT 'for employee , it will save employee_id',
  `type` varchar(30) NOT NULL COMMENT 'ticket, employee, attendnace etc.',
  `action` varchar(15) NOT NULL COMMENT 'create, update, delete',
  `action_id` varchar(15) NOT NULL,
  `table_name` varchar(30) DEFAULT NULL,
  `slug` varchar(150) NOT NULL,
  `form_data` text DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1=created, 2=updated, 3=deleted ',
  PRIMARY KEY (`activity_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`activity_id`, `user_id`, `type`, `action`, `action_id`, `table_name`, `slug`, `form_data`, `create_date`, `status`) VALUES(1, '1', 'coa_account', 'create', '0', 'acc_coa', 'bank/Bank/create_bank', '{\"HeadCode\":\"1020501\",\"pheadcode\":\"10205\",\"HeadName\":\" Bank\",\"PHeadName\":\"Cash at Bank\",\"HeadLevel\":4,\"IsActive\":1,\"isStock\":0,\"isSubType\":0,\"DepreciationRate\":0,\"HeadType\":\"A\",\"IsBudget\":0,\"isCashNature\":0,\"isBankNature\":1,\"isFixedAssetSch\":0,\"assetCode\":null,\"depCode\":null,\"subType\":1,\"noteNo\":null,\"CreateBy\":\"1\",\"CreateDate\":\"2022-06-16 08:29:17\"}', '2022-06-16 12:29:17', 1);
INSERT INTO `activity_logs` (`activity_id`, `user_id`, `type`, `action`, `action_id`, `table_name`, `slug`, `form_data`, `create_date`, `status`) VALUES(2, '1', 'coa_account', 'create', '0', 'acc_coa', 'bank/Bank/create_bank', '{\"HeadCode\":\"1020501\",\"pheadcode\":\"10205\",\"HeadName\":\"AVCDS\",\"PHeadName\":\"Cash at Bank\",\"HeadLevel\":4,\"IsActive\":1,\"isStock\":0,\"isSubType\":0,\"DepreciationRate\":0,\"HeadType\":\"A\",\"IsBudget\":0,\"isCashNature\":0,\"isBankNature\":1,\"isFixedAssetSch\":0,\"assetCode\":null,\"depCode\":null,\"subType\":1,\"noteNo\":null,\"CreateBy\":\"1\",\"CreateDate\":\"2022-06-16 08:39:06\"}', '2022-06-16 12:39:06', 1);
INSERT INTO `activity_logs` (`activity_id`, `user_id`, `type`, `action`, `action_id`, `table_name`, `slug`, `form_data`, `create_date`, `status`) VALUES(3, '1', 'coa_account', 'create', '0', 'acc_coa', 'bank/Bank/create_bank', '{\"HeadCode\":\"1020501\",\"pheadcode\":\"10205\",\"HeadName\":\"bnbn\",\"PHeadName\":\"Cash at Bank\",\"HeadLevel\":4,\"IsActive\":1,\"isStock\":0,\"isSubType\":0,\"DepreciationRate\":0,\"HeadType\":\"A\",\"IsBudget\":0,\"isCashNature\":0,\"isBankNature\":1,\"isFixedAssetSch\":0,\"assetCode\":null,\"depCode\":null,\"subType\":1,\"noteNo\":null,\"CreateBy\":\"1\",\"CreateDate\":\"2022-06-16 08:46:05\"}', '2022-06-16 12:46:05', 1);
INSERT INTO `activity_logs` (`activity_id`, `user_id`, `type`, `action`, `action_id`, `table_name`, `slug`, `form_data`, `create_date`, `status`) VALUES(4, '1', 'coa_account', 'create', '0', 'acc_coa', 'bank/Bank/create_bank', '{\"HeadCode\":\"1020501\",\"pheadcode\":\"10205\",\"HeadName\":\"ABC Bank\",\"PHeadName\":\"Cash at Bank\",\"HeadLevel\":4,\"IsActive\":1,\"isStock\":0,\"isSubType\":0,\"DepreciationRate\":0,\"HeadType\":\"A\",\"IsBudget\":0,\"isCashNature\":0,\"isBankNature\":1,\"isFixedAssetSch\":0,\"assetCode\":null,\"depCode\":null,\"subType\":1,\"noteNo\":null,\"CreateBy\":\"1\",\"CreateDate\":\"2022-06-16 08:47:51\"}', '2022-06-16 12:47:51', 1);

-- --------------------------------------------------------

--
-- Table structure for table `appsetting`
--

DROP TABLE IF EXISTS `appsetting`;
CREATE TABLE IF NOT EXISTS `appsetting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `latitude` varchar(30) DEFAULT NULL,
  `longitude` varchar(30) DEFAULT NULL,
  `acceptablerange` int(11) DEFAULT NULL,
  `googleapi_authkey` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `appsetting`
--

INSERT INTO `appsetting` (`id`, `latitude`, `longitude`, `acceptablerange`, `googleapi_authkey`) VALUES(1, '23.829312399999996', '90.42076019999999', 20, 'Authorization: Key=AAAACc-ZrPQ:APA91bH0tBWMWQOq9l3RBXdZ9O0-g8rUhISTVgRtan_59iOuzbeuSK8bUcbHL9IBJ9B8loKTbNfXgwO1KIi6ZFfXxI0IyHvw0oIO9MOxPeovbQfNlVrye9tfocgtgCtm49Zrd-NM4_VJ');

-- --------------------------------------------------------

--
-- Table structure for table `attendance_history`
--

DROP TABLE IF EXISTS `attendance_history`;
CREATE TABLE IF NOT EXISTS `attendance_history` (
  `atten_his_id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `id` int(11) NOT NULL DEFAULT 0,
  `state` text NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`atten_his_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `award`
--

DROP TABLE IF EXISTS `award`;
CREATE TABLE IF NOT EXISTS `award` (
  `award_id` int(11) NOT NULL AUTO_INCREMENT,
  `award_name` varchar(50) NOT NULL,
  `aw_description` varchar(200) NOT NULL,
  `awr_gift_item` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `employee_id` varchar(30) NOT NULL,
  `awarded_by` varchar(30) NOT NULL,
  PRIMARY KEY (`award_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bank_information`
--

DROP TABLE IF EXISTS `bank_information`;
CREATE TABLE IF NOT EXISTS `bank_information` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `COAID` int(11) DEFAULT NULL,
  `bank_name` varchar(250) NOT NULL,
  `account_name` varchar(200) DEFAULT NULL,
  `account_number` varchar(100) NOT NULL,
  `branch_name` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bank_information`
--

INSERT INTO `bank_information` (`id`, `COAID`, `bank_name`, `account_name`, `account_number`, `branch_name`) VALUES(2, 1020501, 'ABC Bank', 'ABC', '123456789', 'ABC');

-- --------------------------------------------------------

--
-- Table structure for table `candidate_basic_info`
--

DROP TABLE IF EXISTS `candidate_basic_info`;
CREATE TABLE IF NOT EXISTS `candidate_basic_info` (
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
  `zip` int(11) NOT NULL,
  PRIMARY KEY (`can_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `candidate_education_info`
--

DROP TABLE IF EXISTS `candidate_education_info`;
CREATE TABLE IF NOT EXISTS `candidate_education_info` (
  `can_edu_id` int(11) NOT NULL AUTO_INCREMENT,
  `can_id` varchar(30) NOT NULL,
  `degree_name` varchar(30) CHARACTER SET latin1 NOT NULL,
  `university_name` varchar(50) CHARACTER SET latin1 NOT NULL,
  `cgp` varchar(30) CHARACTER SET latin1 NOT NULL,
  `comments` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `sequencee` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`can_edu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `candidate_interview`
--

DROP TABLE IF EXISTS `candidate_interview`;
CREATE TABLE IF NOT EXISTS `candidate_interview` (
  `can_int_id` int(11) NOT NULL AUTO_INCREMENT,
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
  `details` varchar(50) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`can_int_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `candidate_selection`
--

DROP TABLE IF EXISTS `candidate_selection`;
CREATE TABLE IF NOT EXISTS `candidate_selection` (
  `can_sel_id` int(11) NOT NULL AUTO_INCREMENT,
  `can_id` varchar(30) CHARACTER SET latin1 NOT NULL,
  `employee_id` varchar(50) CHARACTER SET latin1 NOT NULL,
  `pos_id` varchar(30) CHARACTER SET latin1 NOT NULL,
  `selection_terms` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`can_sel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `candidate_shortlist`
--

DROP TABLE IF EXISTS `candidate_shortlist`;
CREATE TABLE IF NOT EXISTS `candidate_shortlist` (
  `can_short_id` int(11) NOT NULL AUTO_INCREMENT,
  `can_id` varchar(30) CHARACTER SET latin1 NOT NULL,
  `job_adv_id` int(11) NOT NULL,
  `date_of_shortlist` varchar(50) CHARACTER SET latin1 NOT NULL,
  `interview_date` varchar(30) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`can_short_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `candidate_workexperience`
--

DROP TABLE IF EXISTS `candidate_workexperience`;
CREATE TABLE IF NOT EXISTS `candidate_workexperience` (
  `can_workexp_id` int(11) NOT NULL AUTO_INCREMENT,
  `can_id` varchar(30) CHARACTER SET latin1 NOT NULL,
  `company_name` varchar(50) CHARACTER SET latin1 NOT NULL,
  `working_period` varchar(50) CHARACTER SET latin1 NOT NULL,
  `duties` varchar(30) CHARACTER SET latin1 NOT NULL,
  `supervisor` varchar(50) CHARACTER SET latin1 NOT NULL,
  `sequencee` varchar(10) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`can_workexp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `custom_table`
--

DROP TABLE IF EXISTS `custom_table`;
CREATE TABLE IF NOT EXISTS `custom_table` (
  `custom_id` int(11) NOT NULL AUTO_INCREMENT,
  `custom_field` varchar(100) NOT NULL,
  `custom_data_type` int(11) NOT NULL,
  `custom_data` text NOT NULL,
  `employee_id` varchar(20) NOT NULL,
  PRIMARY KEY (`custom_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
CREATE TABLE IF NOT EXISTS `department` (
  `dept_id` int(11) NOT NULL AUTO_INCREMENT,
  `department_name` varchar(100) NOT NULL,
  `parent_id` int(11) NOT NULL,
  PRIMARY KEY (`dept_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dept_id`, `department_name`, `parent_id`) VALUES(1, 'Technical', 0);
INSERT INTO `department` (`dept_id`, `department_name`, `parent_id`) VALUES(3, 'Backend', 1);
INSERT INTO `department` (`dept_id`, `department_name`, `parent_id`) VALUES(4, 'Front End', 1);
INSERT INTO `department` (`dept_id`, `department_name`, `parent_id`) VALUES(5, 'SEO', 1);
INSERT INTO `department` (`dept_id`, `department_name`, `parent_id`) VALUES(10, 'Sales', 0);
INSERT INTO `department` (`dept_id`, `department_name`, `parent_id`) VALUES(11, 'Small Sales', 10);

-- --------------------------------------------------------

--
-- Table structure for table `deviceinfo`
--

DROP TABLE IF EXISTS `deviceinfo`;
CREATE TABLE IF NOT EXISTS `deviceinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `device_ip` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `duty_type`
--

DROP TABLE IF EXISTS `duty_type`;
CREATE TABLE IF NOT EXISTS `duty_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `duty_type`
--

INSERT INTO `duty_type` (`id`, `type_name`) VALUES(1, 'Full Time');
INSERT INTO `duty_type` (`id`, `type_name`) VALUES(2, 'Part Time');
INSERT INTO `duty_type` (`id`, `type_name`) VALUES(3, 'Contructual');
INSERT INTO `duty_type` (`id`, `type_name`) VALUES(4, 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `employee_benifit`
--

DROP TABLE IF EXISTS `employee_benifit`;
CREATE TABLE IF NOT EXISTS `employee_benifit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bnf_cl_code` varchar(100) NOT NULL,
  `bnf_cl_code_des` varchar(250) NOT NULL,
  `bnff_acural_date` date NOT NULL,
  `bnf_status` tinyint(4) NOT NULL,
  `employee_id` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `employee_equipment`
--

DROP TABLE IF EXISTS `employee_equipment`;
CREATE TABLE IF NOT EXISTS `employee_equipment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(20) NOT NULL,
  `equipment_id` int(11) NOT NULL,
  `issue_date` date NOT NULL,
  `damarage_desc` text NOT NULL,
  `return_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `employee_history`
--

DROP TABLE IF EXISTS `employee_history`;
CREATE TABLE IF NOT EXISTS `employee_history` (
  `emp_his_id` int(11) NOT NULL AUTO_INCREMENT,
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
  `monthly_work_hours` varchar(11) NOT NULL DEFAULT '173.33',
  PRIMARY KEY (`emp_his_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `employee_performance`
--

DROP TABLE IF EXISTS `employee_performance`;
CREATE TABLE IF NOT EXISTS `employee_performance` (
  `emp_per_id` int(11) NOT NULL AUTO_INCREMENT,
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
  `updated_by` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`emp_per_id`),
  UNIQUE KEY `perform_sl` (`perform_sl`),
  KEY `employee_id` (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `employee_position`
--

DROP TABLE IF EXISTS `employee_position`;
CREATE TABLE IF NOT EXISTS `employee_position` (
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

DROP TABLE IF EXISTS `employee_salary_payment`;
CREATE TABLE IF NOT EXISTS `employee_salary_payment` (
  `emp_sal_pay_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(50) CHARACTER SET latin1 NOT NULL,
  `total_salary` varchar(50) CHARACTER SET latin1 NOT NULL,
  `total_working_minutes` varchar(50) CHARACTER SET latin1 NOT NULL,
  `working_period` varchar(50) CHARACTER SET latin1 NOT NULL,
  `payment_due` varchar(50) CHARACTER SET latin1 NOT NULL,
  `payment_date` varchar(50) CHARACTER SET latin1 NOT NULL,
  `salary_name` varchar(100) DEFAULT NULL,
  `payment_type` int(11) DEFAULT NULL,
  `bank_name` varchar(250) DEFAULT NULL,
  `paid_by` varchar(50) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`emp_sal_pay_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `employee_salary_setup`
--

DROP TABLE IF EXISTS `employee_salary_setup`;
CREATE TABLE IF NOT EXISTS `employee_salary_setup` (
  `e_s_s_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(30) CHARACTER SET latin1 NOT NULL,
  `sal_type` varchar(30) NOT NULL,
  `salary_type_id` varchar(30) CHARACTER SET latin1 NOT NULL,
  `amount` varchar(30) CHARACTER SET latin1 NOT NULL,
  `is_percentage` int(2) DEFAULT NULL COMMENT 'all amount will add or deduct on percent if true ',
  `create_date` date DEFAULT NULL,
  `update_date` datetime(6) DEFAULT NULL,
  `update_id` varchar(30) CHARACTER SET latin1 NOT NULL,
  `gross_salary` float NOT NULL,
  PRIMARY KEY (`e_s_s_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `employee_sal_pay_type`
--

DROP TABLE IF EXISTS `employee_sal_pay_type`;
CREATE TABLE IF NOT EXISTS `employee_sal_pay_type` (
  `emp_sal_pay_type_id` int(11) UNSIGNED NOT NULL,
  `payment_period` varchar(50) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `emp_attendance`
--

DROP TABLE IF EXISTS `emp_attendance`;
CREATE TABLE IF NOT EXISTS `emp_attendance` (
  `att_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(50) CHARACTER SET latin1 NOT NULL,
  `date` varchar(30) CHARACTER SET latin1 NOT NULL,
  `sign_in` varchar(30) CHARACTER SET latin1 DEFAULT NULL,
  `sign_out` varchar(30) CHARACTER SET latin1 DEFAULT NULL,
  `staytime` time DEFAULT NULL,
  PRIMARY KEY (`att_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `equipment`
--

DROP TABLE IF EXISTS `equipment`;
CREATE TABLE IF NOT EXISTS `equipment` (
  `equipment_id` int(11) NOT NULL AUTO_INCREMENT,
  `equipment_name` varchar(100) NOT NULL,
  `type_id` int(11) NOT NULL,
  `model` varchar(100) NOT NULL,
  `serial_no` varchar(50) NOT NULL,
  `price` varchar(11) DEFAULT NULL,
  `is_assign` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`equipment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `equipment_type`
--

DROP TABLE IF EXISTS `equipment_type`;
CREATE TABLE IF NOT EXISTS `equipment_type` (
  `type_id` int(11) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(100) NOT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `expense_information`
--

DROP TABLE IF EXISTS `expense_information`;
CREATE TABLE IF NOT EXISTS `expense_information` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `expense_name` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `financial_year`
--

DROP TABLE IF EXISTS `financial_year`;
CREATE TABLE IF NOT EXISTS `financial_year` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `yearName` varchar(30) NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `isCloseReq` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 2 COMMENT '1=active, 0=closed, 2=pending',
  `created_by` int(6) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(6) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=178 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `financial_year`
--

INSERT INTO `financial_year` (`id`, `yearName`, `startDate`, `endDate`, `isCloseReq`, `status`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES(1, '2019', '2019-01-01', '2019-12-31', 1, 0, 1, '2022-04-27 08:23:22', NULL, NULL);
INSERT INTO `financial_year` (`id`, `yearName`, `startDate`, `endDate`, `isCloseReq`, `status`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES(2, '2020', '2020-01-01', '2020-12-31', 1, 0, 1, '2022-04-27 09:56:34', NULL, NULL);
INSERT INTO `financial_year` (`id`, `yearName`, `startDate`, `endDate`, `isCloseReq`, `status`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES(3, '2021', '2021-01-01', '2021-12-31', 1, 0, 1, '2022-04-27 08:23:33', 2022, '2022-06-15 14:29:22');
INSERT INTO `financial_year` (`id`, `yearName`, `startDate`, `endDate`, `isCloseReq`, `status`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES(177, '2022', '2022-01-01', '2022-12-31', 0, 1, 1, '2022-06-15 14:29:22', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `gender`
--

DROP TABLE IF EXISTS `gender`;
CREATE TABLE IF NOT EXISTS `gender` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gender_name` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gender`
--

INSERT INTO `gender` (`id`, `gender_name`) VALUES(1, 'Male');
INSERT INTO `gender` (`id`, `gender_name`) VALUES(2, 'Female');
INSERT INTO `gender` (`id`, `gender_name`) VALUES(3, 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `gmb_bank_info`
--

DROP TABLE IF EXISTS `gmb_bank_info`;
CREATE TABLE IF NOT EXISTS `gmb_bank_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(11) NOT NULL,
  `acc_number` varchar(20) NOT NULL,
  `bank_name` varchar(50) NOT NULL,
  `bban_num` varchar(20) NOT NULL,
  `branch_address` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `gmb_employee_file`
--

DROP TABLE IF EXISTS `gmb_employee_file`;
CREATE TABLE IF NOT EXISTS `gmb_employee_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `other_benefit` decimal(11,2) DEFAULT 0.00 COMMENT 'From Benefit tab of employee form',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `gmb_employee_types`
--

DROP TABLE IF EXISTS `gmb_employee_types`;
CREATE TABLE IF NOT EXISTS `gmb_employee_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `details` text DEFAULT NULL,
  `CreateDate` date NOT NULL,
  `CreateBy` varchar(11) NOT NULL,
  `UpdateDate` date DEFAULT NULL,
  `UpdateBy` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gmb_employee_types`
--

INSERT INTO `gmb_employee_types` (`id`, `name`, `details`, `CreateDate`, `CreateBy`, `UpdateDate`, `UpdateBy`) VALUES(1, 'Interns', 'Interns', '0000-00-00', '', '2022-04-06', '1');
INSERT INTO `gmb_employee_types` (`id`, `name`, `details`, `CreateDate`, `CreateBy`, `UpdateDate`, `UpdateBy`) VALUES(2, 'Contractual', 'Contractual', '2022-04-06', '1', NULL, NULL);
INSERT INTO `gmb_employee_types` (`id`, `name`, `details`, `CreateDate`, `CreateBy`, `UpdateDate`, `UpdateBy`) VALUES(3, 'Full time', 'Full time', '2022-04-06', '1', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `gmb_emp_perform_criteria`
--

DROP TABLE IF EXISTS `gmb_emp_perform_criteria`;
CREATE TABLE IF NOT EXISTS `gmb_emp_perform_criteria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_perform_type_id` int(20) NOT NULL COMMENT 'from gmb_emp_perform_type table',
  `name` varchar(250) NOT NULL,
  `description` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gmb_emp_perform_criteria`
--

INSERT INTO `gmb_emp_perform_criteria` (`id`, `emp_perform_type_id`, `name`, `description`) VALUES(1, 1, 'Demonstrated Knowledge of duties & Quality of Work', NULL);
INSERT INTO `gmb_emp_perform_criteria` (`id`, `emp_perform_type_id`, `name`, `description`) VALUES(2, 1, 'Timeliness of Delivery', NULL);
INSERT INTO `gmb_emp_perform_criteria` (`id`, `emp_perform_type_id`, `name`, `description`) VALUES(3, 1, 'Impact of Achievement', NULL);
INSERT INTO `gmb_emp_perform_criteria` (`id`, `emp_perform_type_id`, `name`, `description`) VALUES(4, 1, 'Overall Achievement of Goals/Objectives', NULL);
INSERT INTO `gmb_emp_perform_criteria` (`id`, `emp_perform_type_id`, `name`, `description`) VALUES(5, 1, 'Going beyond the call of Duty', 'Extra(6,9 or 12) bonus point to be earned for going beyond the call of duty');
INSERT INTO `gmb_emp_perform_criteria` (`id`, `emp_perform_type_id`, `name`, `description`) VALUES(6, 2, 'Interpersonal skills & ability to work in a team environment', '');
INSERT INTO `gmb_emp_perform_criteria` (`id`, `emp_perform_type_id`, `name`, `description`) VALUES(7, 2, 'Attendance and Punctuality', '');
INSERT INTO `gmb_emp_perform_criteria` (`id`, `emp_perform_type_id`, `name`, `description`) VALUES(8, 2, 'Communication Skills', '');
INSERT INTO `gmb_emp_perform_criteria` (`id`, `emp_perform_type_id`, `name`, `description`) VALUES(9, 2, 'Contributing to IIHT Gambia’s mission)', '');

-- --------------------------------------------------------

--
-- Table structure for table `gmb_emp_perform_eval`
--

DROP TABLE IF EXISTS `gmb_emp_perform_eval`;
CREATE TABLE IF NOT EXISTS `gmb_emp_perform_eval` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `score` int(11) NOT NULL,
  `short_code` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gmb_emp_perform_eval`
--

INSERT INTO `gmb_emp_perform_eval` (`id`, `name`, `score`, `short_code`) VALUES(1, 'Poor', 0, 'P');
INSERT INTO `gmb_emp_perform_eval` (`id`, `name`, `score`, `short_code`) VALUES(2, 'Need Improvement', 3, 'NI');
INSERT INTO `gmb_emp_perform_eval` (`id`, `name`, `score`, `short_code`) VALUES(3, 'Good', 6, 'G');
INSERT INTO `gmb_emp_perform_eval` (`id`, `name`, `score`, `short_code`) VALUES(4, 'Very Good', 9, 'VG');
INSERT INTO `gmb_emp_perform_eval` (`id`, `name`, `score`, `short_code`) VALUES(5, 'Excellent', 12, 'E');

-- --------------------------------------------------------

--
-- Table structure for table `gmb_emp_perform_type`
--

DROP TABLE IF EXISTS `gmb_emp_perform_type`;
CREATE TABLE IF NOT EXISTS `gmb_emp_perform_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `description` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gmb_emp_perform_type`
--

INSERT INTO `gmb_emp_perform_type` (`id`, `name`, `description`) VALUES(1, 'Assessment of Goals / Objective set during the review period', NULL);
INSERT INTO `gmb_emp_perform_type` (`id`, `name`, `description`) VALUES(2, 'Assessment of other performance standards and indicators', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `gmb_emp_perform_values`
--

DROP TABLE IF EXISTS `gmb_emp_perform_values`;
CREATE TABLE IF NOT EXISTS `gmb_emp_perform_values` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_per_id` int(11) NOT NULL COMMENT 'From employee_performance table  ',
  `emp_perform_type_id` int(11) NOT NULL COMMENT 'From gmb_emp_perform_type table ',
  `emp_perform_criteria_id` int(11) NOT NULL COMMENT 'From gmb_emp_perform_criteria table',
  `emp_perform_eval` int(11) NOT NULL,
  `score` varchar(20) NOT NULL,
  `comments` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `emp_per_id` (`emp_per_id`),
  KEY `emp_performance_id` (`emp_perform_type_id`),
  KEY `emp_perform_criteria_id` (`emp_perform_criteria_id`),
  KEY `emp_perform_eval_id` (`emp_perform_eval`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `gmb_payroll_post`
--

DROP TABLE IF EXISTS `gmb_payroll_post`;
CREATE TABLE IF NOT EXISTS `gmb_payroll_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ssg_id` int(11) NOT NULL,
  `salary_month` varchar(200) NOT NULL,
  `payment_nature` varchar(20) NOT NULL COMMENT 'cash/bank ledger headcode',
  `amount` decimal(11,0) NOT NULL,
  `CreateDate` date NOT NULL,
  `CreateBy` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `gmb_perform_development_plan`
--

DROP TABLE IF EXISTS `gmb_perform_development_plan`;
CREATE TABLE IF NOT EXISTS `gmb_perform_development_plan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_per_id` int(11) NOT NULL COMMENT 'From employee_performance table',
  `recommand_areas` text NOT NULL,
  `expected_outcomes` text DEFAULT NULL,
  `responsible_person` varchar(250) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `emp_per_id` (`emp_per_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `gmb_perform_key_goals`
--

DROP TABLE IF EXISTS `gmb_perform_key_goals`;
CREATE TABLE IF NOT EXISTS `gmb_perform_key_goals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_per_id` int(11) NOT NULL COMMENT 'From employee_performance table',
  `key_goals` text NOT NULL,
  `completion_period` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `gmb_prform_sub_category`
--

DROP TABLE IF EXISTS `gmb_prform_sub_category`;
CREATE TABLE IF NOT EXISTS `gmb_prform_sub_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `details` text DEFAULT NULL,
  `CreateDate` date NOT NULL,
  `CreateBy` varchar(11) NOT NULL,
  `UpdateDate` date DEFAULT NULL,
  `UpdateBy` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gmb_prform_sub_category`
--

INSERT INTO `gmb_prform_sub_category` (`id`, `name`, `details`, `CreateDate`, `CreateBy`, `UpdateDate`, `UpdateBy`) VALUES(1, 'Attitude', 'Attitudes', '2022-04-07', '1', '2022-04-11', '1');
INSERT INTO `gmb_prform_sub_category` (`id`, `name`, `details`, `CreateDate`, `CreateBy`, `UpdateDate`, `UpdateBy`) VALUES(2, 'Punctuality', 'Punctuality', '2022-04-07', '1', NULL, NULL);
INSERT INTO `gmb_prform_sub_category` (`id`, `name`, `details`, `CreateDate`, `CreateBy`, `UpdateDate`, `UpdateBy`) VALUES(3, 'Proejct complete', 'Proejct complete test', '2022-04-07', '1', '2022-04-07', '1');

-- --------------------------------------------------------

--
-- Table structure for table `gmb_rules_map`
--

DROP TABLE IF EXISTS `gmb_rules_map`;
CREATE TABLE IF NOT EXISTS `gmb_rules_map` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(100) NOT NULL,
  `rule_id` varchar(20) NOT NULL COMMENT 'from gmbi_rules_setup table',
  `employee_id` varchar(20) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1 = active, 0 = inactive',
  `create_date` date NOT NULL,
  `create_by` varchar(11) NOT NULL,
  `update_date` date DEFAULT NULL,
  `update_by` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gmb_rules_map`
--

INSERT INTO `gmb_rules_map` (`id`, `type`, `rule_id`, `employee_id`, `status`, `create_date`, `create_by`, `update_date`, `update_by`) VALUES(1, 'time', '12', '1', 1, '2022-06-13', '1', NULL, NULL);
INSERT INTO `gmb_rules_map` (`id`, `type`, `rule_id`, `employee_id`, `status`, `create_date`, `create_by`, `update_date`, `update_by`) VALUES(2, 'time', '12', '2', 1, '2022-06-13', '1', NULL, NULL);
INSERT INTO `gmb_rules_map` (`id`, `type`, `rule_id`, `employee_id`, `status`, `create_date`, `create_by`, `update_date`, `update_by`) VALUES(3, 'time', '10', '3', 1, '2022-06-15', '1', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `gmb_salary_advance`
--

DROP TABLE IF EXISTS `gmb_salary_advance`;
CREATE TABLE IF NOT EXISTS `gmb_salary_advance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(50) NOT NULL,
  `salary_month` varchar(50) NOT NULL COMMENT 'for the month advance will be deducted',
  `amount` decimal(11,0) NOT NULL,
  `release_amount` decimal(11,0) DEFAULT 0,
  `paid` tinyint(4) NOT NULL DEFAULT 0 COMMENT 'paid_to_employee',
  `CreateDate` date NOT NULL,
  `CreateBy` int(11) NOT NULL,
  `UpdateDate` date DEFAULT NULL,
  `UpdateBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `gmb_salary_generate`
--

DROP TABLE IF EXISTS `gmb_salary_generate`;
CREATE TABLE IF NOT EXISTS `gmb_salary_generate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sal_month_year` varchar(30) NOT NULL,
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
  `lwp` decimal(11,2) DEFAULT NULL COMMENT 'leave without pay ',
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
  `basic_transport_allowance` decimal(20,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `gmb_salary_sheet_generate`
--

DROP TABLE IF EXISTS `gmb_salary_sheet_generate`;
CREATE TABLE IF NOT EXISTS `gmb_salary_sheet_generate` (
  `ssg_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `gdate` varchar(30) DEFAULT NULL,
  `start_date` varchar(30) NOT NULL,
  `end_date` varchar(30) NOT NULL,
  `generate_by` varchar(30) NOT NULL COMMENT 'user_id',
  `approved` tinyint(1) DEFAULT 0 COMMENT '1 = approved, 0= not approved',
  `approved_by` varchar(20) DEFAULT NULL,
  `approved_date` date DEFAULT NULL,
  PRIMARY KEY (`ssg_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `gmb_setup_rules`
--

DROP TABLE IF EXISTS `gmb_setup_rules`;
CREATE TABLE IF NOT EXISTS `gmb_setup_rules` (
  `rule_id` int(11) NOT NULL AUTO_INCREMENT,
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
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'if deleted then 1 , else 0',
  PRIMARY KEY (`rule_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gmb_setup_rules`
--

INSERT INTO `gmb_setup_rules` (`rule_id`, `type`, `name`, `percent`, `fixed`, `start_time`, `end_time`, `description`, `created_at`, `created_by`, `updated_at`, `updated_by`, `is_deleted`) VALUES(6, 'time', 'Attendance time', NULL, NULL, '15:30', '20:30', 'Rule for attendance time', '2022-04-02 03:30:57', '1', '2022-04-02 03:59:41', '1', 0);
INSERT INTO `gmb_setup_rules` (`rule_id`, `type`, `name`, `percent`, `fixed`, `start_time`, `end_time`, `description`, `created_at`, `created_by`, `updated_at`, `updated_by`, `is_deleted`) VALUES(8, 'time', 'Regular Worker', NULL, NULL, '10:00', '18:00', 'Regular Worker', '2022-04-04 02:01:02', '1', NULL, NULL, 1);
INSERT INTO `gmb_setup_rules` (`rule_id`, `type`, `name`, `percent`, `fixed`, `start_time`, `end_time`, `description`, `created_at`, `created_by`, `updated_at`, `updated_by`, `is_deleted`) VALUES(10, 'time', 'Test attendance', NULL, NULL, '08:30', '16:30', '', '2022-04-04 03:01:48', '1', '2022-04-05 09:26:20', '1', 0);
INSERT INTO `gmb_setup_rules` (`rule_id`, `type`, `name`, `percent`, `fixed`, `start_time`, `end_time`, `description`, `created_at`, `created_by`, `updated_at`, `updated_by`, `is_deleted`) VALUES(12, 'time', 'Regular', NULL, NULL, '10:00', '18:00', 'Regular', '2022-05-18 06:55:07', '1', NULL, NULL, 0);
INSERT INTO `gmb_setup_rules` (`rule_id`, `type`, `name`, `percent`, `fixed`, `start_time`, `end_time`, `description`, `created_at`, `created_by`, `updated_at`, `updated_by`, `is_deleted`) VALUES(13, 'time', 'Test', NULL, NULL, '12:23', '21:21', 'Test', '2022-06-15 12:21:41', '1', '2022-06-15 12:21:54', '1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `gmb_sub_cat_perform`
--

DROP TABLE IF EXISTS `gmb_sub_cat_perform`;
CREATE TABLE IF NOT EXISTS `gmb_sub_cat_perform` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(11) NOT NULL,
  `sub_cat_id` varchar(11) NOT NULL COMMENT 'id from gmb_prform_sub_category table',
  `points` int(11) NOT NULL COMMENT 'points out of 100',
  `CreateDate` date DEFAULT NULL,
  `CreateBy` varchar(11) DEFAULT NULL,
  `UpdateDate` date DEFAULT NULL,
  `UpdateBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `gmb_tax_calculation`
--

DROP TABLE IF EXISTS `gmb_tax_calculation`;
CREATE TABLE IF NOT EXISTS `gmb_tax_calculation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tax_sl` int(11) NOT NULL,
  `min` int(11) NOT NULL,
  `max` int(11) NOT NULL,
  `add_smount` varchar(11) NOT NULL DEFAULT '0',
  `tax_percent` varchar(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `grand_loan`
--

DROP TABLE IF EXISTS `grand_loan`;
CREATE TABLE IF NOT EXISTS `grand_loan` (
  `loan_id` int(11) NOT NULL AUTO_INCREMENT,
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
  `loan_status` varchar(30) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`loan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `income_area`
--

DROP TABLE IF EXISTS `income_area`;
CREATE TABLE IF NOT EXISTS `income_area` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `income_field` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `job_advertisement`
--

DROP TABLE IF EXISTS `job_advertisement`;
CREATE TABLE IF NOT EXISTS `job_advertisement` (
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

DROP TABLE IF EXISTS `language`;
CREATE TABLE IF NOT EXISTS `language` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phrase` varchar(100) NOT NULL,
  `english` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1234 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(2, 'login', 'Login');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(3, 'email', 'Email Address');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(4, 'password', 'Password');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(5, 'reset', 'Reset');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(6, 'dashboard', 'Dashboard');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(7, 'home', 'Home');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(8, 'profile', 'Profile');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(9, 'profile_setting', 'Profile Setting');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(10, 'firstname', 'First Name');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(11, 'lastname', 'Last Name');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(12, 'about', 'About');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(13, 'preview', 'Preview');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(14, 'image', 'Image');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(15, 'save', 'Save');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(16, 'upload_successfully', 'Upload Successfully!');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(17, 'user_added_successfully', 'User Added Successfully!');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(18, 'please_try_again', 'Please Try Again...');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(19, 'inbox_message', 'Inbox Messages');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(20, 'sent_message', 'Sent Message');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(21, 'message_details', 'Message Details');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(22, 'new_message', 'New Message');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(23, 'receiver_name', 'Receiver Name');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(24, 'sender_name', 'Sender Name');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(25, 'subject', 'Subject');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(26, 'message', 'Message');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(27, 'message_sent', 'Message Sent!');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(28, 'ip_address', 'IP Address');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(29, 'last_login', 'Last Login');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(30, 'last_logout', 'Last Logout');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(31, 'status', 'Status');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(32, 'delete_successfully', 'Delete Successfully!');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(33, 'send', 'Send');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(34, 'date', 'Date');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(35, 'action', 'Action');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(36, 'sl_no', 'SL No.');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(37, 'are_you_sure', 'Are You Sure ? ');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(38, 'application_setting', 'Application Setting');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(39, 'application_title', 'Application Title');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(40, 'address', 'Address');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(41, 'phone', 'Phone');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(42, 'favicon', 'Favicon');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(43, 'logo', 'Logo');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(44, 'language', 'Language');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(45, 'left_to_right', 'Left To Right');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(46, 'right_to_left', 'Right To Left');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(47, 'footer_text', 'Footer Text');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(48, 'site_align', 'Application Alignment');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(49, 'welcome_back', 'Welcome Back!');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(50, 'please_contact_with_admin', 'Please Contact With Admin');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(51, 'incorrect_email_or_password', 'Incorrect Email/Password');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(52, 'select_option', 'Select Option');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(53, 'ftp_setting', 'Data Synchronize [FTP Setting]');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(54, 'hostname', 'Host Name');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(55, 'username', 'User Name');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(56, 'ftp_port', 'FTP Port');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(57, 'ftp_debug', 'FTP Debug');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(58, 'project_root', 'Project Root');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(59, 'update_successfully', 'Update Successfully');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(60, 'save_successfully', 'Save Successfully!');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(62, 'internet_connection', 'Internet Connection');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(63, 'ok', 'Ok');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(64, 'not_available', 'Not Available');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(65, 'available', 'Available');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(66, 'outgoing_file', 'Outgoing File');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(67, 'incoming_file', 'Incoming File');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(68, 'data_synchronize', 'Data Synchronize');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(69, 'unable_to_upload_file_please_check_configuration', 'Unable to upload file! please check configuration');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(70, 'please_configure_synchronizer_settings', 'Please configure synchronizer settings');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(71, 'download_successfully', 'Download Successfully');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(72, 'unable_to_download_file_please_check_configuration', 'Unable to download file! please check configuration');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(73, 'data_import_first', 'Data Import First');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(74, 'data_import_successfully', 'Data Import Successfully!');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(75, 'unable_to_import_data_please_check_config_or_sql_file', 'Unable to import data! please check configuration / SQL file.');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(76, 'download_data_from_server', 'Download Data from Server');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(77, 'data_import_to_database', 'Data Import To Database');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(79, 'data_upload_to_server', 'Data Upload to Server');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(80, 'please_wait', 'Please Wait...');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(81, 'ooops_something_went_wrong', ' Ooops something went wrong...');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(82, 'module_permission_list', 'Module Permission List');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(83, 'user_permission', 'User Permission');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(84, 'add_module_permission', 'Add Module Permission');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(85, 'module_permission_added_successfully', 'Module Permission Added Successfully!');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(86, 'update_module_permission', 'Update Module Permission');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(87, 'download', 'Download');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(88, 'module_name', 'Module Name');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(89, 'create', 'Create');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(90, 'read', 'Read');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(91, 'update', 'Update');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(92, 'delete', 'Delete');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(93, 'module_list', 'Module List');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(94, 'add_module', 'Add Module');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(95, 'directory', 'Module Direcotory');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(96, 'description', 'Description');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(97, 'image_upload_successfully', 'Image Upload Successfully!');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(98, 'module_added_successfully', 'Module Added Successfully');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(99, 'inactive', 'Inactive');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(100, 'active', 'Active');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(101, 'user_list', 'User List');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(102, 'see_all_message', 'See All Messages');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(103, 'setting', 'Setting');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(104, 'logout', 'Logout');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(105, 'admin', 'Admin');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(106, 'add_user', 'Add User');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(107, 'user', 'User');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(108, 'module', 'Module');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(109, 'new', 'New');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(110, 'inbox', 'Inbox');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(111, 'sent', 'Sent');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(112, 'synchronize', 'Synchronize');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(113, 'data_synchronizer', 'Data Synchronizer');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(114, 'module_permission', 'Module Permission');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(115, 'backup_now', 'Backup Now!');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(116, 'restore_now', 'Restore Now!');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(117, 'backup_and_restore', 'Backup and Download');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(118, 'captcha', 'Captcha Word');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(119, 'database_backup', 'Database Backup');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(120, 'restore_successfully', 'Restore Successfully');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(121, 'backup_successfully', 'Backup Successfully');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(122, 'filename', 'File Name');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(123, 'file_information', 'File Information');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(124, 'size', 'size');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(125, 'backup_date', 'Backup Date');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(126, 'overwrite', 'Overwrite');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(127, 'invalid_file', 'Invalid File!');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(128, 'invalid_module', 'Invalid Module');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(129, 'remove_successfully', 'Remove Successfully!');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(130, 'install', 'Install');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(131, 'uninstall', 'Uninstall');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(132, 'tables_are_not_available_in_database', 'Tables are not available in database.sql');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(133, 'no_tables_are_registered_in_config', 'No tables are registerd in config.php');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(134, 'enquiry', 'Enquiry');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(135, 'read_unread', 'Read/Unread');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(136, 'enquiry_information', 'Enquiry Information');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(137, 'user_agent', 'User Agent');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(138, 'checked_by', 'Checked By');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(139, 'new_enquiry', 'New Enquiry');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(140, 'crud', 'Crud');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(141, 'view', 'View');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(142, 'name', 'Name');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(143, 'add', 'Address');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(144, 'ph', 'Phone');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(145, 'cid', 'SL No');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(146, 'view_atn', 'AttendanceView');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(147, 'mang', 'Employemanagement');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(148, 'designation', 'Position');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(149, 'test', 'Test');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(150, 'sl', 'SL');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(151, 'bdtask', 'BDTASK');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(152, 'practice', 'Practice');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(153, 'branch_name', 'Branch Name');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(154, 'chairman_name', 'Chairman');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(155, 'b_photo', 'Photo');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(156, 'b_address', 'Address');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(157, 'position', 'Position');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(158, 'advertisement', 'Advertisement');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(159, 'position_name', 'Position');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(160, 'position_details', 'Details');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(161, 'circularprocess', 'Recruitment');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(162, 'pos_id', 'Position');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(163, 'adv_circular_date', 'Publish Date');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(164, 'circular_dadeline', 'Dadeline');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(165, 'adv_file', 'Documents');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(166, 'adv_details', 'Details');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(167, 'attendance', 'Attendance');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(168, 'employee', 'Employee');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(169, 'emp_id', 'Employee Name');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(170, 'sign_in', 'Sign In');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(171, 'sign_out', 'Sign Out');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(172, 'staytime', 'Stay Time');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(173, 'abc', '1');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(174, 'first_name', 'First Name');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(175, 'last_name', 'Last Name');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(176, 'alter_phone', 'Alternative Phone');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(177, 'present_address', 'Present Address');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(178, 'parmanent_address', 'Permanent Address');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(179, 'candidateinfo', 'Candidate Info');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(180, 'add_advertisement', 'Add Advertisement');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(181, 'advertisement_list', 'Manage Advertisement ');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(182, 'candidate_basic_info', 'Candidate Information');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(183, 'can_basicinfo_list', 'Manage Candidate');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(184, 'add_canbasic_info', 'Add New Candidate');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(185, 'candidate_education_info', 'Candidate Educational Info');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(186, 'can_educationinfo_list', 'Candidate Edu Info list');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(187, 'add_edu_info', 'Add Educational Info');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(188, 'can_id', 'Candidate Id');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(189, 'degree_name', 'Obtained Degree');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(190, 'university_name', 'University');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(191, 'cgp', 'CGPA');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(192, 'comments', 'Comments');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(193, 'signature', 'Signature');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(194, 'candidate_workexperience', 'Candidate Work Experience');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(195, 'can_workexperience_list', 'Work Experience list');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(196, 'add_can_experience', 'Add Work Experience');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(197, 'company_name', 'Company Name');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(198, 'working_period', 'Working Period');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(199, 'duties', 'Duties');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(200, 'supervisor', 'Supervisor');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(201, 'candidate_workexpe', 'Candidate Work Experience');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(202, 'candidate_shortlist', 'Candidate Shortlist');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(203, 'shortlist_view', 'Manage Shortlist');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(204, 'add_shortlist', 'Add Shortlist');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(205, 'date_of_shortlist', 'Shortlist Date');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(206, 'interview_date', 'Interview Date');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(207, 'submit', 'Submit');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(208, 'candidate_id', 'Your ID');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(209, 'job_adv_id', 'Job Position');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(210, 'sequence', 'Sequence');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(211, 'candidate_interview', 'Interview');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(212, 'interview_list', 'Interview list');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(213, 'add_interview', 'Interview');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(214, 'interviewer_id', 'Interviewer');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(215, 'interview_marks', 'Viva Marks');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(216, 'written_total_marks', 'Written Total Marks');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(217, 'mcq_total_marks', 'MCQ Total Marks');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(218, 'recommandation', 'Recommandation');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(219, 'selection', 'Selection');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(220, 'details', 'Details');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(221, 'candidate_selection', 'Candidate Selection');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(222, 'selection_list', 'Selection List');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(223, 'add_selection', 'Add Selection');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(224, 'employee_id', 'Employee Id');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(225, 'position_id', '1');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(226, 'selection_terms', 'Selection Terms');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(227, 'total_marks', 'Total Marks');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(228, 'photo', 'Picture');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(229, 'your_id', 'Your ID');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(230, 'change_image', 'Change Photo');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(231, 'picture', 'Photograph');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(232, 'ad', 'Add');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(233, 'write_y_p_info', 'Write Your Persoanal Information');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(234, 'emp_position', 'Employee Position');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(235, 'add_pos', 'Add Position');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(236, 'list_pos', 'List of Position');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(237, 'emp_salary_stup', 'Employee Salary SetUp');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(238, 'add_salary_stup', 'Add Salary Setup');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(239, 'list_salarystup', 'List of Salary Setup');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(240, 'emp_sal_name', 'Salary Name');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(241, 'emp_sal_type', 'Salary Type');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(242, 'emp_performance', 'Employee Performance');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(243, 'add_performance', 'Add Performance');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(244, 'list_performance', 'List of Performance');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(245, 'note', 'Note');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(246, 'note_by', 'Note By');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(247, 'number_of_star', 'Number of Star');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(248, 'updated_by', 'Updated By');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(249, 'emp_sal_payment', 'Manage Employee Salary');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(250, 'add_payment', 'Add Payment');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(251, 'list_payment', 'List of payment');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(252, 'total_salary', 'Total Salary');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(253, 'total_working_minutes', 'Working Hour');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(254, 'payment_due', 'Payment Type');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(255, 'payment_date', 'Date');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(256, 'paid_by', 'Paid By');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(257, 'view_employee_payment', 'Employee Payment List');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(258, 'sal_payment_type', 'Salary Payment Type');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(259, 'add_payment_type', 'Add Payment Type');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(260, 'list_payment_type', 'List of Payment Type');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(261, 'payment_period', 'Payment Period');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(262, 'payment_type', 'Payment Type');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(263, 'time', 'Punch Time');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(264, 'shift', 'Shift');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(265, 'location', 'Location');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(266, 'logtype', 'Log Type');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(267, 'branch', 'Location');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(268, 'student', 'Students');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(269, 'csv', 'CSV');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(270, 'save_successfull', 'Your Data Save Successfully');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(271, 'successfully_updated', 'Your Data Successfully Updated');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(272, 'atn_form', 'Attendance Form');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(273, 'atn_report', 'Attendance Reports');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(274, 'end_date', 'To');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(275, 'start_date', 'From');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(276, 'done', 'Done');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(277, 'employee_id_se', 'Write Employee Id or name here ');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(278, 'attendance_repor', 'Attendance Report');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(279, 'e_time', 'End Time');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(280, 's_time', 'Start Time');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(281, 'atn_datewiserer', 'Date Wise Report');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(282, 'atn_report_id', 'Date And Id base Report');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(283, 'atn_report_time', 'Date And Time report');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(284, 'payroll', 'Payroll');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(285, 'loan', 'Loan');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(286, 'loan_grand', 'Grant Loan');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(287, 'add_loan', 'Add Loan');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(288, 'loan_list', 'List of Loan');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(289, 'loan_details', 'Loan Details');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(290, 'amount', 'Amount');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(291, 'interest_rate', 'Interest Percentage');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(292, 'installment_period', 'Installment Period');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(293, 'repayment_amount', 'Repayment Total');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(294, 'date_of_approve', 'Approve Date');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(295, 'repayment_start_date', 'Repayment From');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(296, 'permission_by', 'Permitted By');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(297, 'grand', 'Grant');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(298, 'installment', 'Installment');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(299, 'loan_status', 'status');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(300, 'installment_period_m', 'Installment Period in Month');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(301, 'successfully_inserted', 'Your loan Successfully Granted');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(302, 'loan_installment', 'Loan Installment');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(303, 'add_installment', 'Add Installment');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(304, 'installment_list', 'List of Installment');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(305, 'loan_id', 'Loan No');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(306, 'installment_amount', 'Installment Amount');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(307, 'payment', 'Payment');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(308, 'received_by', 'Receiver');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(309, 'installment_no', 'Install No');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(310, 'notes', 'Notes');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(311, 'paid', 'Paid');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(312, 'loan_report', 'Loan Report');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(313, 'e_r_id', 'Enter Your Employee ID');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(314, 'leave', 'Leave');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(315, 'add_leave', 'Add Leave');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(316, 'list_leave', 'List of Leave');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(317, 'dayname', 'Weekly Leave Day');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(318, 'holiday', 'Holiday');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(319, 'list_holiday', 'List of Holidays');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(320, 'no_of_days', 'Number of Days');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(321, 'holiday_name', 'Holiday Name');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(322, 'set', 'SET');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(323, 'tax', 'Tax');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(324, 'tax_setup', 'Tax Setup');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(325, 'add_tax_setup', 'Add Tax Setup');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(326, 'list_tax_setup', 'List of Tax setup');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(327, 'tax_collection', 'Tax collection');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(328, 'start_amount', 'Start Amount');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(329, 'end_amount', 'End Amount');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(330, 'rate', 'Tax Rate');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(331, 'date_start', 'Date Start');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(332, 'amount_tax', 'Tax Amount');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(333, 'collection_by', 'Collection By');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(334, 'date_end', 'Date End');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(335, 'income_net_period', 'Income  Net period');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(336, 'default_amount', 'Default Amount');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(337, 'add_sal_type', 'Add Salary Type');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(338, 'list_sal_type', 'Salary Type List');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(339, 'salary_type_setup', 'Salary Type Setup');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(340, 'salary_setup', 'Salary SetUp');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(341, 'add_sal_setup', 'Add Salary Setup');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(342, 'list_sal_setup', 'Salary Setup List');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(343, 'salary_type_id', 'Salary Type');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(344, 'salary_generate', 'Salary Generate');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(345, 'add_sal_generate', 'Generate Now');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(346, 'list_sal_generate', 'Generated Salary List');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(347, 'gdate', 'Generate Date');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(348, 'start_dates', 'Start Date');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(349, 'generate', 'Generate ');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(350, 'successfully_saved_saletup', ' Set up Successfull');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(351, 's_date', 'Start Date');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(352, 'e_date', 'End Date');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(353, 'salary_payable', 'Payable Salary');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(354, 'tax_manager', 'Tax');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(355, 'generate_by', 'Generate By');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(356, 'successfully_paid', 'Successfully Paid');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(357, 'direct_empl', ' Employee');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(358, 'add_emp_info', 'Add New Employee');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(359, 'new_empl_pos', 'Add New Employee Position');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(360, 'manage', 'Manage Position');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(361, 'ad_advertisement', 'ADD POSITION');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(362, 'moduless', 'Modules');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(363, 'next', 'Next');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(364, 'finish', 'Finish');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(365, 'request', 'Request');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(366, 'successfully_saved', 'Your Data Successfully Saved');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(367, 'sal_type', 'Salary Type');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(368, 'sal_name', 'Salary Name');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(369, 'leave_application', 'Leave Application');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(370, 'apply_strt_date', 'Application Start Date');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(371, 'apply_end_date', 'Application End date');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(372, 'leave_aprv_strt_date', 'Approve Start Date');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(373, 'leave_aprv_end_date', 'Approved End Date');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(374, 'num_aprv_day', 'Aproved Day');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(375, 'reason', 'Reason');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(376, 'approve_date', 'Approved Date');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(377, 'leave_type', 'Leave Type');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(378, 'apply_hard_copy', 'Application Hard Copy');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(379, 'approved_by', 'Approved By');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(380, 'notice', 'Notice Board');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(381, 'noticeboard', 'Notice Board');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(382, 'notice_descriptiion', 'Description');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(383, 'notice_date', 'Notice Date');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(384, 'notice_type', 'Notice Type');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(385, 'notice_by', 'Notice By');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(386, 'notice_attachment', 'Attachment');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(387, 'account_name', 'Account Name');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(388, 'account_type', 'Account Type');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(389, 'account_id', 'Account Name');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(390, 'transaction_description', 'Description');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(391, 'payment_id', 'Payment');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(392, 'create_by_id', 'Created By');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(393, 'account', 'Account');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(394, 'account_add', 'Add Account');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(395, 'account_transaction', 'Transaction');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(396, 'award', 'Award');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(397, 'new_award', 'New Award');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(398, 'award_name', 'Award Name');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(399, 'aw_description', 'Award Description');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(400, 'awr_gift_item', 'Gift Item');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(401, 'awarded_by', 'Award By');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(402, 'employee_name', 'Employee Name');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(403, 'employee_list', 'Atn List');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(404, 'department', 'Department');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(405, 'department_name', 'Department Name ');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(406, 'clockout', 'ClockOut');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(407, 'se_account_id', 'Select Account Name');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(408, 'division', 'Sub Department');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(409, 'add_division', 'Add Sub Department');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(410, 'update_division', 'Update Sub Department');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(411, 'division_name', 'Sub Department Name');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(412, 'division_list', 'Manage Sub Department');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(413, 'designation_list', 'Position List');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(414, 'manage_designation', 'Manage Position');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(415, 'add_designation', 'Add Position');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(416, 'select_division', 'Select Division');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(417, 'select_designation', 'Select Position');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(418, 'asset', 'Asset');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(419, 'asset_type', 'Asset Type');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(420, 'add_type', 'Add Type');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(421, 'type_list', 'Type List');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(422, 'type_name', 'Type Name');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(423, 'select_type', 'Select Type');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(424, 'equipment_name', 'Equipment Name');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(425, 'model', 'Model');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(426, 'serial_no', 'Serial No');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(427, 'equipment', 'Equipment');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(428, 'add_equipment', 'Add Equipment');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(429, 'equipment_list', 'Equipment List');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(430, 'type', 'Type');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(431, 'equipment_maping', 'Equipment Mapping');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(432, 'add_maping', 'Add Mapping');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(433, 'maping_list', 'Mapping List');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(434, 'update_equipment', 'Update Equipment');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(435, 'select_employee', 'Select Employee');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(436, 'select_equipment', 'Select Equipment');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(437, 'basic_info', 'Basic Info');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(438, 'middle_name', 'Middle Name');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(439, 'state', 'Country');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(440, 'city', 'City');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(441, 'zip_code', 'Zip Code');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(442, 'maiden_name', 'Maiden Name');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(443, 'add_employee', 'Add Employee');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(444, 'manage_employee', 'Manage Employee');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(445, 'employee_update_form', 'Employee Update Form');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(446, 'what_you_search', 'What You Search');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(447, 'search', 'Search');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(448, 'duty_type', 'Duty Type');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(449, 'hire_date', 'Hire Date');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(450, 'original_h_date', 'Original Hire Date');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(451, 'voluntary_termination', 'Voluntary Termination');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(452, 'termination_reason', 'Termination Reason');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(453, 'termination_date', 'Termination Date');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(454, 're_hire_date', 'Re Hire Date');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(455, 'rate_type', 'Rate Type');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(456, 'pay_frequency', 'Pay Frequency');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(457, 'pay_frequency_txt', 'Pay Frequency Text');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(458, 'hourly_rate2', 'Hourly rate2');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(459, 'hourly_rate3', 'Hourly Rate3');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(460, 'home_department', 'Home Department');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(461, 'department_text', 'Department Text');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(462, 'benifit_class_code', 'Benefit Class code');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(463, 'benifit_desc', 'Benefit Description');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(464, 'benifit_acc_date', 'Benefit Accrual Date');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(465, 'benifit_sta', 'Benefit Status');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(466, 'super_visor_name', 'Supervisor Name');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(467, 'is_super_visor', 'Is Supervisor');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(468, 'supervisor_report', 'Supervisor Report');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(469, 'dob', 'Date of Birth');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(470, 'gender', 'Gender');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(471, 'marital_stats', 'Marital Status');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(472, 'ethnic_group', 'Ethnic Group');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(473, 'eeo_class_gp', 'EEO Class');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(474, 'ssn', 'SSN');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(475, 'work_in_state', 'Work in State');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(476, 'live_in_state', 'Live in State');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(477, 'home_email', 'Home Email');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(478, 'business_email', 'Business Email');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(479, 'home_phone', 'Home Phone');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(480, 'business_phone', 'Business Phone');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(481, 'cell_phone', 'Cell Phone');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(482, 'emerg_contct', 'Emergency Contact');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(483, 'emerg_home_phone', 'Emergency Home Phone');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(484, 'emrg_w_phone', 'Emergency Work Phone');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(485, 'emer_con_rela', 'Emergency Contact Relation');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(486, 'alt_em_contct', 'Alter Emergency Contact');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(487, 'alt_emg_h_phone', 'Alt Emergency Home Phone');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(488, 'alt_emg_w_phone', 'Alt Emergency  Work Phone');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(489, 'reports', 'Reports');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(490, 'employee_reports', 'Employee Reports');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(491, 'demographic_report', 'Demographic Report');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(492, 'posting_report', 'Positional Report');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(493, 'custom_report', 'Custom Report');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(494, 'benifit_report', 'Benefit Report');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(495, 'demographic_info', 'Demographical Information');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(496, 'positional_info', 'Positional Information');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(497, 'assets_info', 'Assets Information');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(498, 'custom_field', 'Custom Field');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(499, 'custom_value', 'Custom Data');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(500, 'adhoc_report', 'Adhoc Report');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(501, 'asset_assignment', 'Asset Assignment');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(502, 'assign_asset', 'Assign Assets');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(503, 'assign_list', 'Assign List');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(504, 'update_assign', 'Update Assign');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(505, 'citizenship', 'Citizenship');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(506, 'class_sta', 'Class status');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(507, 'class_acc_date', 'Class Accrual date');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(508, 'class_descript', 'Class Description');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(509, 'class_code', 'Class Code');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(510, 'return_asset', 'Return Assets');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(511, 'dept_id', 'Department ID');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(512, 'parent_id', 'Parent ID');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(513, 'equipment_id', 'Equipment ID');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(514, 'issue_date', 'Issue Date');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(515, 'damarage_desc', 'Damarage Description');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(516, 'return_date', 'Return Date');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(517, 'is_assign', 'Is Assign');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(518, 'emp_his_id', 'Employee History ID');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(519, 'damarage_descript', 'Damage Description');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(520, 'return', 'Return');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(521, 'return_successfull', 'Return Successfull');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(522, 'return_list', 'Return List');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(523, 'custom_data', 'Custom Data');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(524, 'passing_year', 'Passing Year');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(525, 'is_admin', 'Is Admin');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(526, 'zip', 'Zip Code');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(527, 'original_hire_date', 'Original Hire Date');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(528, 'rehire_date', 'Rehire Date');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(529, 'class_code_desc', 'Class Code Description');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(530, 'class_status', 'Class Status');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(531, 'super_visor_id', 'Supervisor ID');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(532, 'marital_status', 'Marital Status');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(533, 'emrg_h_phone', 'Emergency Home Phone');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(534, 'emgr_contct_relation', 'Emergency Contact Relation');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(535, 'id', 'ID');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(536, 'type_id', 'Equipment Type');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(537, 'custom_id', 'Custom ID');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(538, 'custom_data_type', 'Custom Data Type');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(539, 'role_permission', 'Role Permission');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(540, 'permission_setup', 'Permission Setup');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(541, 'add_role', 'Add Role');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(542, 'role_list', 'Role List');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(543, 'user_access_role', 'User Access Role');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(544, 'menu_item_list', 'Menu Item List');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(545, 'ins_menu_for_application', 'Ins Menu  For Application');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(546, 'menu_title', 'Menu Title');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(547, 'page_url', 'Page Url');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(548, 'parent_menu', 'Parent Menu');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(549, 'role', 'Role');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(550, 'role_name', 'Role Name');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(551, 'single_checkin', 'Single Check In');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(552, 'bulk_checkin', 'Bulk Check In');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(553, 'manage_attendance', 'Manage Attendance');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(554, 'attendance_list', 'Attendance List');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(555, 'checkin', 'Check In');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(556, 'checkout', 'Check Out');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(557, 'stay', 'Stay');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(558, 'attendance_report', 'Attendance Report');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(559, 'work_hour', 'Work Hour');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(560, 'cancel', 'Cancel');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(561, 'confirm_clock', 'Confirm Checkout');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(562, 'add_attendance', 'Add Attendance');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(563, 'upload_csv', 'Upload CSV');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(564, 'import_attendance', 'Import Attendance');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(565, 'manage_account', 'Manage Account');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(566, 'add_account', 'Add Account');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(567, 'add_new_account', 'Add New Account');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(568, 'account_details', 'Account Details');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(569, 'manage_transaction', 'Manage Transaction');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(570, 'add_expence', 'Add Experience');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(571, 'add_income', 'Add Income');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(572, 'return_now', 'Return Now !!');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(573, 'manage_award', 'Manage Award');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(574, 'add_new_award', 'Add New Award');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(575, 'personal_information', 'Personal Information');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(576, 'educational_information', 'Educational Information');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(577, 'past_experience', 'Past Experience');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(578, 'basic_information', 'Basic Information');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(579, 'result', 'Result');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(580, 'institute_name', 'Institute Name');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(581, 'education', 'Education');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(582, 'manage_shortlist', 'Manage Short List');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(583, 'manage_interview', 'Manage Interview');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(584, 'manage_selection', 'Manage Selection');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(585, 'add_new_dept', 'Add New Department');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(586, 'manage_dept', 'Manage Department');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(587, 'successfully_checkout', 'Checkout Successful !');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(588, 'grant_loan', 'Grant Loan');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(589, 'successfully_installed', 'Successfully Installed');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(590, 'total_loan', 'Total Loan');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(591, 'total_amount', 'Total Amount');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(592, 'filter', 'Filter');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(593, 'weekly_holiday', 'Weekly Holiday');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(594, 'manage_application', 'Manage Application');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(595, 'add_application', 'Add Application');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(596, 'manage_holiday', 'Manage Holiday');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(597, 'add_more_holiday', 'Add More Holiday');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(598, 'manage_weekly_holiday', 'Manage Weekly Holiday');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(599, 'add_weekly_holiday', 'Add Weekly Holiday');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(600, 'manage_granted_loan', 'Manage Granted Loan');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(601, 'manage_installment', 'Manage Installment');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(602, 'add_new_notice', 'Add New Notice');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(603, 'manage_notice', 'Manage Notice');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(604, 'salary_type', 'Salary Benefits');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(605, 'manage_salary_generate', 'Manage Salary Generate');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(606, 'generate_now', 'Generate Now');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(607, 'add_salary_setup', 'Add Salary Setup');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(608, 'manage_salary_setup', 'Manage Salary Setup');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(609, 'add_salary_type', 'Add Salary Benefits');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(610, 'manage_salary_type', 'Manage Salary Benefits');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(611, 'manage_tax_setup', 'Manage Tax Setup');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(612, 'setup_tax', 'Setup Tax');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(613, 'add_more', 'Add More');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(614, 'tax_rate', 'Tax Rate');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(615, 'no', 'No');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(616, 'setup', 'Setup');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(617, 'biographicalinfo', 'Bio-Graphical Information');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(618, 'positional_information', 'Positional Information');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(620, 'benifits', 'Benefits');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(621, 's_rate', 'Rate');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(622, 'others_leave_application', 'Leave Application');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(623, 'add_leave_type', 'Add Leave Type');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(624, 'others_leave', 'Others Leave');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(625, 'number_of_leave_days', 'Number of Leave Days');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(626, 'app_date', 'Application Date');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(627, 'apply_day', 'Apply Day');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(628, 'time_zone', 'Time Zone ');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(629, 'accounts', 'Accounts');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(630, 'c_o_a', 'Chart of Account');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(631, 'debit_voucher', 'Debit Voucher');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(632, 'credit_voucher', 'Credit Voucher');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(633, 'contra_voucher', 'Contra Voucher');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(634, 'journal_voucher', 'Journal Voucher');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(635, 'voucher_approval', 'Voucher Approval');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(636, 'account_report', 'Account Report');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(637, 'voucher_report', 'Voucher Report');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(638, 'cash_book', 'Cash Book');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(639, 'bank_book', 'Bank Book');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(640, 'general_ledger', 'General Ledger');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(641, 'trial_balance', 'Trial Balance');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(642, 'profit_loss', 'Profit Loss');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(643, 'cash_flow', 'Cash Flow');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(644, 'coa_print', 'Coa Print');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(645, 'grant', 'Grant');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(646, 'confirm', 'Confirm');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(647, 'pay_now', 'Pay Now ??');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(648, 'find', 'Find');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(649, 'gl_head', 'GL Head');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(650, 'acc_code', 'Account Code');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(651, 'from_date', 'From Date');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(652, 'to_date', 'To Date');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(653, 'bank_book_voucher', 'Bank Book Voucher');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(654, 'bank_book_report_of', 'Bank Book Report Of');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(655, 'on', 'On');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(656, 'to', 'To');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(657, 'opening_balance', 'Opening Balance');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(658, 'balance', 'Balance');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(659, 'credit', 'Credit');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(660, 'debit', 'Debit');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(661, 'head_of_account', 'Head Of Account');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(662, 'voucher_type', 'Voucher Type');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(663, 'voucher_no', 'Voucher No');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(664, 'transaction_date', 'Transaction Date');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(665, 'cash_book_voucher', 'Cash Book Voucher');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(666, 'cash_book_report_on', 'Cash Book Report On');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(667, 'particulars', 'Particulars');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(668, 'amount_in_dollar', 'Amount In Dollar');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(669, 'opening_cash_and_equivalent', 'Opening Cash && Equivalent');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(670, 'cash_flow_statement', 'Cash Flow Statement');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(671, 'code', 'Code');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(672, 'remark', 'Remark');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(673, 'debit_account_head', 'Debit Account Head');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(674, 'cash_in_hand', 'Cash In Hand');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(675, 'credit_account_head', 'Credit Account Head');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(676, 'transaction_head', 'Transaction Head');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(677, 'with_details', 'With Details');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(678, 'no_report', 'No Of Report');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(679, 'total', 'Total');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(680, 'current_balance', 'Current Balance');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(681, 'pre_balance', 'Pre Balance');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(682, 'trial_balance_with_opening_as_on', 'Trial Balance With Detail');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(683, 'as_on', 'As On');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(684, 'chairman', 'Chairman');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(685, 'prepared_by', 'Prepared By');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(686, 'statement_of_comprehensive_income', 'Statement Of Comprehensive Income');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(687, 'from', 'From');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(688, 'total_expenses', 'Total Expenses');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(689, 'total_income', 'Total Income');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(690, 'authorized_signature', 'Authorize Signature');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(691, 'account_official', 'Account Official');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(692, 'approved', 'Approved');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(693, 'update_credit_voucher', 'Update Credit Voucher');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(694, 'benefits', 'Benefit');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(695, 'class', 'Class');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(696, 'biographical_info', 'Biographical Info');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(697, 'additional_address', 'Additional Address');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(698, 'custom', 'Custom');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(699, 'can_name', 'Candidate Name');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(700, 'select', 'Select');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(701, 'benefit_type', 'Benefit Type');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(702, 'salary_benefits_type', 'Benefits Type');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(703, 'addition', 'Addition');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(704, 'basic', 'Basic');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(705, 'deduction', 'Deduction');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(706, 'gross_salary', 'Gross Salary');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(707, 'total_loan_amount', 'Total Loan Amount');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(708, 'loan_no', 'Loan No');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(709, 'loan_issue_id', 'Loan Issue Id');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(710, 'repayment', 'Repayment');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(711, 'candidate_name', 'Candidate name');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(712, 'employee_performance', 'Employee Performance');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(713, 'check_in', 'Check In');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(714, 'check_out', 'Check Out');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(715, 'datewise_report', 'Date Wise Report');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(716, 'employee_wise_report', 'Employee Wise Report');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(717, 'date_in_time_report', 'Date & In Time Report');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(718, 'report_view', 'Report View');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(719, 'notice_form', 'Notice Form');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(720, 'atn_log', 'Load Device Data');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(721, 'atn_log_datewise', 'Attendance Log');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(722, 'device_connection', 'Device Connection');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(723, 'user_name', 'User Name');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(724, 'in_time', 'In Time');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(725, 'out_time', 'Out Time');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(726, 'worked_hours', 'Worked Hours');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(727, 'wasteg_hour', 'Wastage Hours');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(728, 'net_hour', 'Net Hours');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(729, 'device_information', 'Device Information');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(730, 'plz_generate_an_ip', 'Please Generate an Ip');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(731, 'device_name', 'Device Name');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(732, 'device_ip', 'Device Ip');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(733, 'device_user', 'Device User');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(734, 'n_b_spendtime', 'N.B : You Spent');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(735, 'hours_out_of_workinghour', 'Hours out of Working hours');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(736, 'total_employee', 'Total Employee');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(737, 'present_employee', 'Present Employee');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(738, 'today_worked_hour', 'Today\'s Worked Hours');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(739, 'todays_transaction', 'Today\'s Transaction');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(740, 'device_model', 'Device Model');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(741, 'download_sample_file', 'Download Sample File');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(742, 'salar_month', 'Salary Month');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(743, 'bank', 'Bank');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(744, 'add_bank', 'Add Bank');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(745, 'bank_list', 'Bank List');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(746, 'update_bank', 'Update Bank');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(747, 'bank_name', 'Bank Name');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(748, 'account_number', 'Account Number');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(749, 'cash_adjustment', 'Cash Adjustment');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(750, 'adjustment_type', 'Adjustment Type');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(751, 'bank_adjustment', 'Bank Adjustment');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(752, 'expense', 'Expense');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(753, 'expense_item', 'Expense Item');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(754, 'expense_statement', 'Expense Statement');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(755, 'expense_name', 'Expense Name');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(756, 'add_expense', 'Add Expense');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(757, 'print', 'Print');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(758, 'income', 'Income');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(759, 'income_field', 'Income Field');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(760, 'update_income', 'Update Income');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(761, 'income_statement', 'Income Statement');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(762, 'attendence', 'Attendance');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(763, 'working_day', 'Working Day');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(764, 'salary_month', 'Salary Month');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(765, 'salary_slip', 'Salary Slip');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(766, 'head_code', 'Head Code');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(767, 'particular', 'Particulars');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(768, 'parent_type', 'Parent Type');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(769, 'expense_sheet', 'Expense Sheet');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(770, 'head_name', 'Head Name');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(771, 'income_sheet', 'Income Sheet');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(772, 'recruitment', ' Recruitment');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(773, 'ref_number', 'Reference Number');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(774, 'employee_signature', 'Employee Signature');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(775, 'name_of_bank', 'Name Of Bank');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(776, 'net_salary', 'Net Salary');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(777, 'in_word', 'In Word');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(778, 'total_deduction', 'Total Deduction');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(779, 'total_addition', 'Total Addition');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(780, 'basic_salary', 'Basic Salary');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(781, 'earnings', 'Earnings');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(782, 'salary_date', 'Salary Date');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(783, 'money_receipt', 'Money Receipt');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(784, 'balance_adjustment', 'Balance Adjustment');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(785, 'parent_head', 'Parent Head');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(786, 'child_head', 'Child Head');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(787, 'due_amount', 'Due Amount');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(788, 'loan_payment', 'Loan Payment');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(789, 'todays_notice', 'Today\'s Notice');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(790, 'attend_employee', 'Attend Employee');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(791, 'department_wise', 'Department Wise');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(792, 'income_expense', 'Income Expense');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(793, 'todays_leave', 'Today\'s Leave');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(794, 'leave_day', 'Leave Day');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(795, 'leave_finish', 'Leave Finish');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(796, 'loan_amount', 'Loan Amount');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(797, 'leave_employee', 'Leave Employee');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(798, 'absent_employee', 'Absent Employee');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(799, 'worked_hour', 'Worked Hours');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(800, 'new_password', 'New Password');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(801, 'latitude', 'Latitude');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(802, 'longitude', 'Longitude');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(803, 'acceptablerange', 'Acceptable Range');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(804, 'googleapi_authkey', 'Google Api Auth Key');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(805, 'approve', 'Approve');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(806, 'decline', 'Decline');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(807, 'attendance_history', 'Attendance History');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(808, 'give_attendance', 'Give Attendance');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(809, 'ledger_history', 'Ledger History');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(810, 'request_leave', 'Request Leave');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(811, 'my_profile', 'My Profile');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(812, 'salary_statement', 'Salary Statement');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(813, 'notices', 'Notice');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(814, 'working_hour', 'Working Hour');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(815, 'qr_attendance', 'QR Attendance');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(816, 'leave_remaining', 'Leave Remaining');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(817, 'total_attendance', 'Total Attendance');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(818, 'day_absent', 'Day Absent');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(819, 'day_present', 'Day Present');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(820, 'previous', 'Previous');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(821, 'network_alert', 'Check Network Connection');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(822, 'select_date', 'Select Date');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(823, 'attendance_log', 'Attendance Log');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(824, 'in', 'In');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(825, 'out', 'Out');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(826, 'load_more', 'Load More');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(827, 'data_not_found', 'Data Not Found');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(828, 'worked', 'Worked');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(829, 'wastage', 'Wastage');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(830, 'punch_time', 'Punch Time');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(831, 'loading', 'Loading ...');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(832, 'wrong_info_alert', 'Some Information Was Wrong There');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(833, 'from_to_date_alrt', 'From And To Date Field Are Require');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(834, 'qr_scan', 'QR Scan');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(835, 'stop_scan', 'Stop Scan');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(836, 'scan_again', 'Scan Again');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(837, 'confirm_attendance', 'Confirm Attendance');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(838, 'scan_alert', 'Your Scan Qr Was Wrong!! Please Scan Again');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(839, 'attn_success_mgs', 'Attendance Successfully Saved');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(840, 'you_r_not_in_office', 'You Are Not In The Office Location');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(841, 'out_of_range', 'Out Of Range');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(842, 'request_for_leave', 'Request For Leave');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(843, 'leave_reason', 'Leave Reason');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(844, 'write_reason', 'Write Reason');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(845, 'send_request', 'Send Request');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(846, 'leave_his_status', 'Leave History Status');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(847, 'total_tax', 'Total Tax');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(848, 'employment_date', 'Employment Date');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(849, 'notice_details', 'Notice Details');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(850, 'no_notice_to_show', 'No Notice to Show');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(851, 'welcome_msg', 'Welcome To HRM');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(852, 'enter_your_email', 'Enter Your Email');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(853, 'enter_your_password', 'Enter Your Password');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(854, 'cannot_remember_pass', 'Can not Remember Password');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(855, 'forgot_password', 'Forgot Password');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(856, 'email_pass_cannot_empt', 'Email or password can not be empty');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(857, 'email_format_was_not_right', 'Email format was not Right!');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(858, 'email_or_pass_not_matched', 'Email or password not matched!');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(859, 'reset_your_password', 'Reset Your Password');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(860, 'your_remember_password', 'You Remember Password');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(861, 'back_to_login', 'Back to Login');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(862, 'email_fild_can_not_empty', 'Email Field can not be empty');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(863, 'email_not_found', 'Email Not Found');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(864, 'successfully_send_email', 'Successfully Send Email!');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(865, 'email_is_not_valid', 'Email Is Not Valid');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(866, 'sorry_email_not_sent', 'Sorry Email Not Sent');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(867, 'day_leave', 'Day Leave');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(868, 'search_work_details', 'Search Work Details');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(869, 'times', 'Time');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(870, 'request_not_send', 'Request Not Send');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(871, 'leave_request_success', 'Your Leave Request SuccessFul');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(872, 'all_field_are_required', 'All Field Are Required');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(873, 'plz_select_data_properly', 'Please select date properly');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(874, 'pending', 'Pending');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(875, 'unpaid', 'Unpaid');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(876, 'salary_details', 'Salary Details');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(877, 'worked_days', 'Worked Days');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(878, 'monthly_attendance', 'Monthly Attendance');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(879, 'year', 'Year');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(880, 'month', 'Month');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(881, 'missing_attendance', 'Missing Attendance');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(882, 'daily_presents', 'Daily Presents');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(883, 'all', 'All');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(884, 'daily_absent', 'Daily Absent');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(885, 'monthly_presents', 'Monthly Presents');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(886, 'monthly_absent', 'Monthly Absent');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(887, 'leave_report', 'Leave Report');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(888, 'employee_on_leave', 'Employee On Leave');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(889, 'leave_balance', 'Leave Balance');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(890, 'without_weekend', 'Without Weekend');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(891, 'new_recruited_employee', 'New Recruited');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(892, 'todays_present', 'Today\'s Presents');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(893, 'todays_absent', 'Today\'s Absents');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(894, 'male', 'Male');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(895, 'female', 'Female');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(896, 'latest_notice', 'Latest Notice');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(897, 'attendance_last_30days', 'Attendance (Last 30 Days)');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(898, 'recruited_current_year', 'Recruited (Current Year)');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(899, 'absent_15days', 'Absent (Last 15 Days)');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(900, 'loanreceive', 'Loan Received');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(901, 'current_year', 'Current Year');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(902, 'awarded', 'Awarded');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(903, 'loanpayment', 'Loan Payment');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(904, 'login_info', 'Login Info');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(905, 'user_email', 'User Email');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(906, 'update_now', 'Update Now');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(907, 'notesupdate', 'Note: If you want to update software,you Must have immediate previous version');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(908, 'purchase_key', 'Purchase Key');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(909, 'mobile_app_setting', 'Mobile App Setting(Addons)');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(910, 'noupdates', 'No update available');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(911, 'update_attendence', 'Update Attendence');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(912, 'successfully_exported', 'Successfully Exported');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(913, 'export_attendance', 'Export Attendance');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(914, 'bulk_export', 'Bulk Export');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(915, 'point_shared_by', 'Point Shared By');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(916, 'update_collaborative_point', 'Update Collaborative Point');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(917, 'add_collaborative_point', 'Add Collaborative Points');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(918, 'update_management_point', 'Update Management Point');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(919, 'point', 'Points');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(920, 'add_management_point', 'Add Management Points');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(921, 'management_point', 'Management Points');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(922, 'update_point_category', 'Update Point Category');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(923, 'point_category', 'Point Category');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(924, 'add_point_category', 'Add Point Category');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(925, 'attendence_end', 'Attendence End');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(926, 'attendence_start', 'Attendence Start');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(927, 'attendence_point', 'Attendance Points');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(928, 'general_point', 'General Points');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(929, 'employee_point', 'Employee Points');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(930, 'collaborative_point', 'Collaborative Points');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(931, 'management_point', 'Management Points');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(932, 'point_categories', 'Point Categories');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(933, 'point_settings', 'Point Settings');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(934, 'rewardpoint', 'Reward Points');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(935, 'successfully_uploaded', 'Successfully Uploaded');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(936, 'buy_now', 'Buy Now');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(937, 'invalid_purchase_key', 'Invalid Purchase Key');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(938, 'addon', 'Add-ons');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(939, 'procurements', 'Procurement');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(940, 'requests', 'Request');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(941, 'quotation', 'Quotation');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(942, 'requesting_person', 'Requesting Person');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(943, 'requesting_dept', 'Requesting Department');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(944, 'request_list', 'Request List');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(945, 'add_request', 'Add Request');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(946, 'description_material', 'Description of materials/Goods/Service');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(947, 'quantity', 'Quantity');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(948, 'reason_for_requesting', 'Reason For Requesting');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(949, 'edit_request', 'Edit Request');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(950, 'request_form', 'Request Form');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(951, 'unit_list', 'Units');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(952, 'add_unit', 'Add Unit');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(953, 'update_unit', 'Update Unit');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(954, 'unit', 'Unit');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(955, 'quote', 'Quote');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(956, 'quotation_form', 'Quotation Form');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(957, 'name_of_company', 'Name Of Company');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(958, 'pin_or_equivalent', 'Pin Or Equivalent');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(959, 'expected_date_delivery', 'Expected Date of Delivery');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(960, 'place_of_delivery', 'Place of Delivery');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(961, 'signature_and_stamp', 'Signature and Stamp');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(962, 'update_quotation', 'Update Quotation');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(963, 'bid_analysis', 'Bid Analysis');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(964, 'bid_analysis_form', 'Bid Analysis Form');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(965, 'bid_analysis_list', 'Bid Analysis List');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(966, 'sba_no', 'SBA/ NO.');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(967, 'location', 'Location');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(968, 'attachment', 'Attachment');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(969, 'company', 'Company');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(970, 'reason_of_choosing', 'Reason Of Choosing');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(971, 'remarks', 'Remarks');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(972, 'vendor_name', 'Vendor Name');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(973, 'purchase_order_no', 'PO#');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(974, 'price_per_unit', 'Price/Unit');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(975, 'bid_no', 'Bid No');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(976, 'purchase_order', 'Purchase Order');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(977, 'purchase_order_form', 'Purchase Order Form');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(978, 'purchase_order_list', 'Purchase Order List');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(979, 'title', 'Title');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(980, 'update_purchase_order', 'Update Purchase Order');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(981, 'good_received', 'Good Received');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(982, 'good_received_form', 'Good Received Form');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(983, 'good_received_list', 'Good Received List');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(984, 'update_good_received', 'Update Good Received');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(985, 'committee_list', 'Committee List');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(986, 'add_committee', 'Add Committee');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(987, 'update_committee', 'Update Committee');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(988, 'committee', 'Committee');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(989, 'signature', 'Signature Image');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(990, 'committees', 'Committees');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(991, 'create_committee', 'Create Committee');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(992, 'request_approval', 'Request Approval');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(993, 'reason_for_approval', 'Reason for Approval');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(994, 'vendors', 'Vendors');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(995, 'vendor', 'Add Vendor');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(996, 'vendor_list', 'Vendor List');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(997, 'mobile_no', 'Mobile No');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(998, 'vendor_name', 'Vendor Name');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(999, 'previous_balance', 'Previous Balance');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1000, 'create_vendor', 'Create Vendor');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1001, 'discount', 'Discount');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1002, 'price', 'Price');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1003, 'vendor_name', 'Vendor');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1004, 'add_request', 'Add Request');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1005, 'percentage', 'Percentage');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1006, 'projectmanagement', 'Project Management');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1007, 'clients', 'Clients');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1008, 'add_new_client', 'Add New Client');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1009, 'client_name', 'Client Name');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1010, 'manage_clients', 'Manage Clients');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1011, 'update_client', 'Update Client');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1012, 'projects', 'Projects');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1013, 'add_new_project', 'Add New Project');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1014, 'manage_projects', 'Manage Projects');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1015, 'project_name', 'Project Name');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1016, 'project_lead', 'Project Lead');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1017, 'approximate_tasks', 'Approximate Tasks');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1018, 'summary', 'Summary');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1019, 'project_duration', 'Project Duration');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1020, 'update_project', 'Update Project');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1021, 'task', 'Task');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1022, 'create_task', 'Create Task');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1023, 'manage_tasks', 'Manage Tasks');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1024, 'team_member', 'Team Member');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1025, 'priority', 'Priority');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1026, 'reporter', 'Reporter');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1027, 'assignee', 'Assignee');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1028, 'sprint', 'Sprint');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1029, 'sprints', 'Sprints');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1030, 'create_sprint', 'Create Sprint');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1031, 'sprint_name', 'Sprint Name');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1032, 'duration', 'Duration');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1033, 'sprint_goal', 'Sprint Goal');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1034, 'backlogs', 'Backlogs');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1035, 'manage_sprints', 'Manage Sprints');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1036, 'manage_backlogs', 'Manage Backlogs');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1037, 'transfer_tasks', 'Transfer Tasks');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1038, 'create_date', 'Create Date');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1039, 'transfer_to_backlogs', 'Transfer tasks to Backlogs');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1040, 'all_tasks', 'All Tasks');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1041, 'kanban_board', 'Kanban Board');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1042, 'own_tasks', 'Own Tasks');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1043, 'previous_version', 'Previous Version');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1044, 'get_retros', 'Get Retros');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1045, 'starting_date', 'Start Date');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1046, 'pm_reports', 'Reports');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1047, 'project_lists', 'Project Lists');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1049, 'to_do', 'To Do');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1050, 'in_progress', 'In Progress');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1051, 'created_by', 'Created By');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1052, 'client', 'Client');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1053, 'reward_points', 'Reward Points');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1054, 'sprint_started', 'Sprint Start');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1055, 'ending_date', 'End Date');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1056, 'team_members', 'Team Members');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1057, 'inactive_employee', 'Inactive Employee');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1058, 'manage_inactive_employee', 'Manage Inactive Employee');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1059, 'attachment', 'Attachment');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1060, 'company', 'Company');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1061, 'create_financial_year', 'Create financial year');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1062, 'financial_year', 'Financial year');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1063, 'setup_rules', 'Setup Rules');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1064, 'rules', 'Rules');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1065, 'add_new_rule', 'Add New Rule');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1066, 'manage_rules', 'Manage Rules');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1068, 'percent', 'Percent');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1069, 'fixed', 'Fixed');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1070, 'start_time', 'Start Time');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1071, 'end_time', 'End Time');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1072, 'financial_year_start_date', 'Financial year start date');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1073, 'financial_year_end_date', 'Financial year end date');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1074, 'allocated_time', 'Task Time (In minutes)');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1075, 'rules_list', 'Rules List');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1076, 'allowance', 'Allowance');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1077, 'allowance_amount', 'Allowance Amount');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1078, 'rule', 'Rule');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1079, 'financiall_year', 'Financial Year');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1080, 'transdate', 'Transaction Date');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1081, 'lateness_early_closing_report', 'Lateness and early closing report');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1082, 'attendance_time', 'Attendance Time');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1083, 'lateness_early_closing', 'Lateness and early closing');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1084, 'report', 'report');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1085, 'currency_symbol', 'Currency Symbol');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1086, 'employee_type', 'Employee Type');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1087, 'employee_types', 'Employee Types');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1088, 'add_employee_type', 'Add employee type');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1089, 'manage_types', 'Manage types');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1090, 'update_employee_type', 'Update employee type');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1091, 'perform_sub_category', 'Performance Sub Category');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1092, 'performance', 'Performance');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1093, 'performance_category', 'Performance Category');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1094, 'category_wise_performance', 'Category Wise Performance');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1095, 'manage_sub_category', 'Manage Sub Category');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1096, 'add_sub_category', 'Add Sub Category');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1097, 'update_sub_category', 'Update Sub Category');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1098, 'sub_category', 'Sub Category');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1099, 'manage_category_wise_performance', 'Manage Category Wise Performance');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1100, 'add_category_wise_performance', 'Add Category Wise Performance');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1101, 'update_category_wise_performance', 'Update Category Wise Performance');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1102, 'score', 'Score');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1103, 'please_enter_HeadName', 'Chart of Account head name can\'t be blank');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1104, 'HeadName', 'Chart of Account head name');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1105, 'message_coa_create', 'Chart of Account created successfully');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1106, 'message_coa_update', 'Chart of Account updated successfully');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1107, 'bank_info', 'Bank Info');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1108, 'account_number', 'Account Number');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1109, 'bank_name', 'Bank Name');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1110, 'bban_num', 'BBAN Number');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1111, 'branch_address', 'Branch Address');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1112, 'salary_info', 'Salary Info');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1113, 'gross_salary', 'Gross Salary');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1114, 'transport', 'Transport');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1115, 'house_rent', 'House Rent');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1116, 'medical', 'Medical');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1117, 'other_allowance', 'Other Allowance');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1118, 'state_income_tax', 'State Income Tax');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1119, 'loan_deduct', 'Loan Deduct');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1120, 'salary_advance', 'Salary Advance');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1121, 'stamp', 'Stamp');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1122, 'allowance', 'Allowance');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1123, 'soc_sec_npf_tax', 'Soc.Sec.Npf');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1124, 'tin_no', 'TIN No');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1126, 'balance_sheet', 'Balance Sheet');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1127, 'sos', 'SOS');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1128, 'subtype', 'Subtype');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1129, 'generate_salary', 'Generate Salary');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1130, 'create_opening_balance', 'Create opening balance');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1131, 'create_debit_voucher', 'Create debit voucher');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1132, 'create_credit_voucher', 'Create credit voucher');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1133, 'VNo', 'VNo');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1134, 'reverseHead', 'Reverse Account Name');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1135, 'comment', 'Comment');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1136, 'ledgerComment', 'Ledger Comment');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1137, 'create_journal_voucher', 'Create journal voucher');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1138, 'create_contra_voucher', 'Create contra voucher');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1139, 'employee_salary_chart', 'Employee Salary Chart');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1140, 'ledger_comment', 'Ledger Comment');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1141, 'monthly_work_hours', 'Monthly Work Hours');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1142, 'reverse_account_head', 'Reverse Account Head');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1143, 'salary_advance', 'Salary Advance');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1144, 'release_amount', 'Release Amount');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1145, 'add_salary_advance', 'Add Salary Advance');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1146, 'manage_salary_advance', 'Manage Salary Advance');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1147, 'paid_to_employee', 'Paid To Employee');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1148, 'update_salary_advance', 'Update Salary Advance');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1149, 'general-ledger-filter', 'General Ledger Filter');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1150, 'closing_balance', 'Closing Balance');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1151, 'installment_cleared', 'Installment Cleared');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1152, 'ledger_comment', 'Ledger Comment');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1153, 'trial_balance_filter', 'Trial balance filter');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1154, 'cash_book_report', 'Cash book report');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1155, 'bank', 'Bank');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1156, 'bank_book_report', 'Bank book report');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1157, 'in_words', 'In Words');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1158, 'review_period', 'Review Period');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1159, 'voucher_date', 'Voucher Date');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1160, 'authorised_by', 'Authorised By');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1161, 'pay_by', 'Pay By');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1162, 'credit_voucher', 'Credit Voucher');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1163, 'debit_voucher', 'Debit Voucher');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1164, 'profit_loss_report', 'Profit loss report');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1165, 'employee_comments', 'Employee Comments');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1166, 'post', 'Post');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1167, 'total_equity', 'Total Shareholder\'s Equity');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1168, 'total_liabilities_equity', 'Total Liabilities & Shareholder\'s Equity');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1169, 'total_liabilities', 'Total Liabilities');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1170, 'total_assets', 'Total Assets');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1171, 'net_amount', 'Net Amount');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1172, 'gross_profit', 'Gross Profit');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1173, 'total_income', 'Total Income');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1174, 'total_expense', 'Total Expenses');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1175, 'total_cogs', 'Total COGS');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1176, 'fixedasset_schedule', 'Fixed Assets Schedule');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1177, 'fixed_assets_report', 'Fixed Assets Annual Report');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1178, 'employee_hourly_rate_computation', 'Employee Hourly Rate Computation');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1179, 'day_book', 'Day Book');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1180, 'voucher', 'Voucher');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1181, 'accrual_basis', 'Accrual Basis');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1182, 'cash_basis', 'Cash Basis');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1183, 'receipt_payment', 'Receipt & Payment');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1184, 'approved_date', 'Approved Date');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1185, 'receipt', 'Receipt');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1186, 'payments', 'Payments');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1187, 'cashinhand', 'Cash in Hand');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1188, 'cash_bank', 'Cash at Bank');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1189, 'advance', 'advance');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1190, 'gtotal', 'Ground Total');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1191, 'are_you_sure_reverse', 'Are you sure reverse this voucher');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1192, 'payroll_&_loan', 'Payroll & Loan');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1193, 'loan_to_employee', 'Loan To Employee');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1194, 'sub_ledger', 'Sub Ledger');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1195, 'npf3_soc_sec_tax_report', 'NPF3 Social Security Tax');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1196, 'account_head', 'Account Head');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1197, 'sub_account', 'Sub Account');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1198, 'create_date', 'Create date');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1199, 'sate_income_tax_schedule', 'Sate Income Tax Schedule');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1200, 'sate_income_tax_report', 'Sate Income Tax Report');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1201, 'cash', 'Cash');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1202, 'iicf3_contribution_report', 'IICF3 Contribution Report');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1203, 'gra_ret_5', 'GRA RET 5');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1204, 'social_security_npf_icf', 'Soc.Sec.(NPF & ICF)');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1205, 'salary_confirmation_form', 'Salary Confirmation Form');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1206, 'opening_balance_fixed_assets', 'Opening Balance of Fixed Assets');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1207, 'additions', 'Additions');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1208, 'adjustment', 'Adjustment');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1209, 'closing_balance_fixed_assets', 'Closing Balance of Fixed Assets');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1210, 'depreciation_rate', 'Depreciation Rate');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1211, 'depreciation_value', 'Depreciation Value');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1212, 'opening_balance_accumulated_depreciation', 'Opening Balance of Accumulated Depreciation');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1213, 'closing_balance_accumulated_depreciation', 'Closing Balance of Accumulated Depreciation');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1214, 'written_down_value', 'Written Down Value');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1215, 'expenditure_statement', 'Statement of Expenditure');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1216, 'year_closing', 'Year Closing');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1217, 'predefined_accounts', 'Predefined Accounts');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1218, 'select_account', 'Select Account');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1219, 'bank_reconciliation', 'Bank Reconciliation');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1220, 'bank_reconciliation_report', 'Bank Reconciliation Report');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1221, 'check_no', 'Check No\r\n');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1222, 'no_data_found', 'There is no record found');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1223, 'check_date', 'Check Date');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1224, 'unapproved', 'Unapproved');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1225, 'close_financial_year', 'Close financial year');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1226, 'year_close', 'Year Close');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1227, 'account_delete_message', 'Some transation occured to this bank account. first reverse this transation then try again!');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1228, 'payment_source', 'Payment Source');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1229, 'can_not_delete_as_voucher_already_approved', 'Can not delete as voucher already approved of this good received !');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1230, 'currency_in_words', 'Currency In Words');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1231, 'remove', 'Remove');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1232, 'tax_percent', 'Tax Percent');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1233, 'add_amount', 'Add Amount');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES(1234, 'leave_approval', 'Leave Approval');

-- --------------------------------------------------------

--
-- Table structure for table `leave_apply`
--

DROP TABLE IF EXISTS `leave_apply`;
CREATE TABLE IF NOT EXISTS `leave_apply` (
  `leave_appl_id` int(11) NOT NULL AUTO_INCREMENT,
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
  `status` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`leave_appl_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `leave_type`
--

DROP TABLE IF EXISTS `leave_type`;
CREATE TABLE IF NOT EXISTS `leave_type` (
  `leave_type_id` int(2) NOT NULL AUTO_INCREMENT,
  `leave_type` varchar(50) NOT NULL,
  `leave_days` int(2) NOT NULL,
  PRIMARY KEY (`leave_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `loan_installment`
--

DROP TABLE IF EXISTS `loan_installment`;
CREATE TABLE IF NOT EXISTS `loan_installment` (
  `loan_inst_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(21) CHARACTER SET latin1 NOT NULL,
  `loan_id` varchar(21) CHARACTER SET latin1 NOT NULL,
  `installment_amount` varchar(20) CHARACTER SET latin1 NOT NULL,
  `payment` varchar(20) CHARACTER SET latin1 NOT NULL,
  `date` varchar(20) CHARACTER SET latin1 NOT NULL,
  `received_by` varchar(20) CHARACTER SET latin1 NOT NULL,
  `installment_no` varchar(20) CHARACTER SET latin1 NOT NULL DEFAULT '1',
  `notes` varchar(80) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`loan_inst_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `marital_info`
--

DROP TABLE IF EXISTS `marital_info`;
CREATE TABLE IF NOT EXISTS `marital_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `marital_sta` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `marital_info`
--

INSERT INTO `marital_info` (`id`, `marital_sta`) VALUES(1, 'Single');
INSERT INTO `marital_info` (`id`, `marital_sta`) VALUES(2, 'Married');
INSERT INTO `marital_info` (`id`, `marital_sta`) VALUES(3, 'Divorced');
INSERT INTO `marital_info` (`id`, `marital_sta`) VALUES(4, 'Widowed');
INSERT INTO `marital_info` (`id`, `marital_sta`) VALUES(5, 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `datetime` datetime NOT NULL,
  `sender_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=unseen, 1=seen, 2=delete',
  `receiver_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=unseen, 1=seen, 2=delete',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

DROP TABLE IF EXISTS `module`;
CREATE TABLE IF NOT EXISTS `module` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `directory` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`id`, `name`, `description`, `image`, `directory`, `status`) VALUES(39, 'attendance Details ', 'Simple attendance processing System', 'application/modules/attendance/assets/images/thumbnail.jpg', 'attendance', 1);
INSERT INTO `module` (`id`, `name`, `description`, `image`, `directory`, `status`) VALUES(40, 'Employee circulation processing System', 'Simple circulation processing System', 'application/modules/circularprocess/assets/images/thumbnail.jpg', 'circularprocess', 1);
INSERT INTO `module` (`id`, `name`, `description`, `image`, `directory`, `status`) VALUES(41, 'Employee Details ', 'Simple hrm processing System', 'application/modules/employee/assets/images/thumbnail.jpg', 'employee', 1);
INSERT INTO `module` (`id`, `name`, `description`, `image`, `directory`, `status`) VALUES(42, 'Leave Details ', 'Simple leave processing System', 'application/modules/leave/assets/images/thumbnail.jpg', 'leave', 1);
INSERT INTO `module` (`id`, `name`, `description`, `image`, `directory`, `status`) VALUES(43, 'Loan Details ', 'Simple loan processing System', 'application/modules/loan/assets/images/thumbnail.jpg', 'loan', 1);
INSERT INTO `module` (`id`, `name`, `description`, `image`, `directory`, `status`) VALUES(44, 'TAX Details ', 'Simple tax processing System', 'application/modules/tax/assets/images/thumbnail.jpg', 'tax', 1);
INSERT INTO `module` (`id`, `name`, `description`, `image`, `directory`, `status`) VALUES(46, 'Payroll Details ', 'Simple payroll processing System', 'application/modules/payroll/assets/images/thumbnail.jpg', 'payroll', 1);
INSERT INTO `module` (`id`, `name`, `description`, `image`, `directory`, `status`) VALUES(48, 'Account', 'Account information', 'application/modules/account/assets/images/thumbnail.jpg', 'account', 1);
INSERT INTO `module` (`id`, `name`, `description`, `image`, `directory`, `status`) VALUES(49, 'Notice Details ', 'Simple Notice', 'application/modules/noticeboard/assets/images/thumbnail.jpg', 'noticeboard', 1);
INSERT INTO `module` (`id`, `name`, `description`, `image`, `directory`, `status`) VALUES(50, 'Award Details ', 'Simple Award', 'application/modules/award/assets/images/thumbnail.jpg', 'award', 1);
INSERT INTO `module` (`id`, `name`, `description`, `image`, `directory`, `status`) VALUES(52, 'asset Details ', 'Simple asset', 'application/modules/asset/assets/images/thumbnail.jpg', 'asset', 1);

-- --------------------------------------------------------

--
-- Table structure for table `module_permission`
--

DROP TABLE IF EXISTS `module_permission`;
CREATE TABLE IF NOT EXISTS `module_permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_module_id` int(11) NOT NULL,
  `fk_user_id` int(11) NOT NULL,
  `create` tinyint(1) DEFAULT NULL,
  `read` tinyint(1) DEFAULT NULL,
  `update` tinyint(1) DEFAULT NULL,
  `delete` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_module_id` (`fk_module_id`),
  KEY `fk_user_id` (`fk_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `module_purchase_key`
--

DROP TABLE IF EXISTS `module_purchase_key`;
CREATE TABLE IF NOT EXISTS `module_purchase_key` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `identity` varchar(250) DEFAULT NULL,
  `purchase_key` varchar(255) DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `notice_board`
--

DROP TABLE IF EXISTS `notice_board`;
CREATE TABLE IF NOT EXISTS `notice_board` (
  `notice_id` int(11) NOT NULL AUTO_INCREMENT,
  `notice_descriptiion` text NOT NULL,
  `notice_date` date NOT NULL,
  `notice_type` varchar(50) NOT NULL,
  `notice_by` varchar(50) NOT NULL,
  `notice_attachment` text DEFAULT NULL,
  PRIMARY KEY (`notice_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payroll_holiday`
--

DROP TABLE IF EXISTS `payroll_holiday`;
CREATE TABLE IF NOT EXISTS `payroll_holiday` (
  `payrl_holi_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `holiday_name` varchar(30) CHARACTER SET latin1 NOT NULL,
  `start_date` varchar(30) CHARACTER SET latin1 NOT NULL,
  `end_date` varchar(30) CHARACTER SET latin1 NOT NULL,
  `no_of_days` varchar(30) CHARACTER SET latin1 NOT NULL,
  `created_by` varchar(30) CHARACTER SET latin1 NOT NULL,
  `updated_by` varchar(30) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`payrl_holi_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `payroll_tax_collection`
--

DROP TABLE IF EXISTS `payroll_tax_collection`;
CREATE TABLE IF NOT EXISTS `payroll_tax_collection` (
  `tax_coll_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(30) CHARACTER SET latin1 NOT NULL,
  `date_start` varchar(30) CHARACTER SET latin1 NOT NULL,
  `amount_tax` varchar(30) CHARACTER SET latin1 NOT NULL,
  `collection_by` varchar(30) CHARACTER SET latin1 NOT NULL,
  `date_end` varchar(30) CHARACTER SET latin1 NOT NULL,
  `income_net_period` varchar(30) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`tax_coll_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `payroll_tax_setup`
--

DROP TABLE IF EXISTS `payroll_tax_setup`;
CREATE TABLE IF NOT EXISTS `payroll_tax_setup` (
  `tax_setup_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `start_amount` varchar(30) CHARACTER SET latin1 NOT NULL,
  `end_amount` varchar(30) CHARACTER SET latin1 NOT NULL,
  `rate` varchar(30) CHARACTER SET latin1 NOT NULL,
  `status` varchar(30) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`tax_setup_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pay_frequency`
--

DROP TABLE IF EXISTS `pay_frequency`;
CREATE TABLE IF NOT EXISTS `pay_frequency` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `frequency_name` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pay_frequency`
--

INSERT INTO `pay_frequency` (`id`, `frequency_name`) VALUES(1, 'Weekly');
INSERT INTO `pay_frequency` (`id`, `frequency_name`) VALUES(2, 'Biweekly');
INSERT INTO `pay_frequency` (`id`, `frequency_name`) VALUES(3, 'Annual');
INSERT INTO `pay_frequency` (`id`, `frequency_name`) VALUES(4, 'Monthly');

-- --------------------------------------------------------

--
-- Table structure for table `pm_activity_logs`
--

DROP TABLE IF EXISTS `pm_activity_logs`;
CREATE TABLE IF NOT EXISTS `pm_activity_logs` (
  `activity_id` int(11) NOT NULL AUTO_INCREMENT,
  `description` text DEFAULT NULL,
  `user_id` varchar(11) DEFAULT NULL,
  `date_time` datetime DEFAULT NULL,
  PRIMARY KEY (`activity_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pm_clients`
--

DROP TABLE IF EXISTS `pm_clients`;
CREATE TABLE IF NOT EXISTS `pm_clients` (
  `client_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(250) DEFAULT NULL,
  `client_name` varchar(250) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pm_employee_projects`
--

DROP TABLE IF EXISTS `pm_employee_projects`;
CREATE TABLE IF NOT EXISTS `pm_employee_projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` varchar(11) DEFAULT NULL,
  `employee_id` varchar(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pm_projects`
--

DROP TABLE IF EXISTS `pm_projects`;
CREATE TABLE IF NOT EXISTS `pm_projects` (
  `project_id` int(11) NOT NULL AUTO_INCREMENT,
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
  `updated_by` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`project_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pm_sprints`
--

DROP TABLE IF EXISTS `pm_sprints`;
CREATE TABLE IF NOT EXISTS `pm_sprints` (
  `sprint_id` int(11) NOT NULL AUTO_INCREMENT,
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
  `updated_by` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`sprint_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pm_tasks_list`
--

DROP TABLE IF EXISTS `pm_tasks_list`;
CREATE TABLE IF NOT EXISTS `pm_tasks_list` (
  `task_id` int(11) NOT NULL AUTO_INCREMENT,
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
  `updated_by` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`task_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `point_attendence`
--

DROP TABLE IF EXISTS `point_attendence`;
CREATE TABLE IF NOT EXISTS `point_attendence` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(50) NOT NULL,
  `in_time` varchar(50) NOT NULL,
  `point` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `create_date` datetime NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `update_date` datetime NOT NULL,
  `update_by` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `point_categories`
--

DROP TABLE IF EXISTS `point_categories`;
CREATE TABLE IF NOT EXISTS `point_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `point_category` varchar(100) DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `update_by` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `point_collaborative`
--

DROP TABLE IF EXISTS `point_collaborative`;
CREATE TABLE IF NOT EXISTS `point_collaborative` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `point_shared_by` varchar(50) DEFAULT NULL COMMENT 'Employee shared point',
  `point_shared_with` varchar(50) DEFAULT NULL COMMENT 'Employee received point',
  `reason` text DEFAULT NULL,
  `point` varchar(50) DEFAULT NULL,
  `point_date` date DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL COMMENT 'users',
  `update_date` datetime DEFAULT NULL,
  `update_by` varchar(50) DEFAULT NULL COMMENT 'users',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `point_management`
--

DROP TABLE IF EXISTS `point_management`;
CREATE TABLE IF NOT EXISTS `point_management` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(50) DEFAULT NULL,
  `point_category` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `point` varchar(50) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_by` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `point_reward`
--

DROP TABLE IF EXISTS `point_reward`;
CREATE TABLE IF NOT EXISTS `point_reward` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(50) DEFAULT NULL COMMENT 'employee id',
  `attendence` varchar(50) DEFAULT NULL COMMENT 'attendence points',
  `management` varchar(50) DEFAULT NULL COMMENT 'management points',
  `collaborative` varchar(50) DEFAULT NULL COMMENT 'collaborative points',
  `total` int(50) DEFAULT NULL,
  `date` date DEFAULT NULL COMMENT 'pointing time',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `point_settings`
--

DROP TABLE IF EXISTS `point_settings`;
CREATE TABLE IF NOT EXISTS `point_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `general_point` varchar(50) DEFAULT NULL COMMENT 'Maximum limit for collaborative points',
  `attendence_point` varchar(50) DEFAULT NULL,
  `attendence_start` varchar(50) DEFAULT NULL,
  `attendence_end` varchar(50) DEFAULT NULL,
  `collaborative_start` date DEFAULT NULL,
  `collaborative_end` date DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `point_settings`
--

INSERT INTO `point_settings` (`id`, `general_point`, `attendence_point`, `attendence_start`, `attendence_end`, `collaborative_start`, `collaborative_end`, `created_by`, `updated_by`, `created_at`, `update_at`) VALUES(5, '3', '1', '09:30', '10:10', '2021-02-01', '2021-02-16', '19', '113', '2020-12-29 06:43:13', '2021-02-16 06:45:56');

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

DROP TABLE IF EXISTS `position`;
CREATE TABLE IF NOT EXISTS `position` (
  `pos_id` int(11) NOT NULL AUTO_INCREMENT,
  `position_name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `position_details` varchar(255) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`pos_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`pos_id`, `position_name`, `position_details`) VALUES(1, 'Sr. PHP Programmer', 'Sr. Programmer');
INSERT INTO `position` (`pos_id`, `position_name`, `position_details`) VALUES(2, 'Team Lead', 'Team Lead');
INSERT INTO `position` (`pos_id`, `position_name`, `position_details`) VALUES(3, 'Senior SQA', 'Automated SQA');
INSERT INTO `position` (`pos_id`, `position_name`, `position_details`) VALUES(7, 'Manager', 'Sales Manager');

-- --------------------------------------------------------

--
-- Table structure for table `procurement_bid_analysis`
--

DROP TABLE IF EXISTS `procurement_bid_analysis`;
CREATE TABLE IF NOT EXISTS `procurement_bid_analysis` (
  `bid_analysis_form_id` int(11) NOT NULL AUTO_INCREMENT,
  `quotation_form_id` int(11) DEFAULT NULL,
  `sba_no` varchar(200) DEFAULT NULL,
  `location` varchar(500) DEFAULT NULL,
  `attachment` text DEFAULT NULL,
  `total` varchar(20) DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `created_by` varchar(11) DEFAULT NULL,
  `update_date` date DEFAULT NULL,
  `update_by` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`bid_analysis_form_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `procurement_commitee_list`
--

DROP TABLE IF EXISTS `procurement_commitee_list`;
CREATE TABLE IF NOT EXISTS `procurement_commitee_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bid_id` int(11) DEFAULT NULL COMMENT 'when selecting in bid analysis',
  `bid_committee_id` varchar(11) DEFAULT NULL COMMENT 'Selecting in bid analysis',
  `type` varchar(255) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `sign_image` text DEFAULT NULL,
  `date` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `procurement_good_received`
--

DROP TABLE IF EXISTS `procurement_good_received`;
CREATE TABLE IF NOT EXISTS `procurement_good_received` (
  `good_received_id` int(11) NOT NULL AUTO_INCREMENT,
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
  `voucher_id` int(11) NOT NULL COMMENT 'id from acc_voucher table',
  `created_date` date DEFAULT NULL,
  `created_by` varchar(11) DEFAULT NULL,
  `updated_date` date DEFAULT NULL,
  `updated_by` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`good_received_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `procurement_items`
--

DROP TABLE IF EXISTS `procurement_items`;
CREATE TABLE IF NOT EXISTS `procurement_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `form_id` varchar(20) NOT NULL COMMENT 'id of request , quotation or bid analysis, purchase order and good receive form',
  `item_type` varchar(200) DEFAULT NULL COMMENT 'Type can be request, quote, bid , purchase_order or good receive',
  `company` varchar(500) DEFAULT NULL,
  `description_material` text DEFAULT NULL,
  `reason_of_choosing` varchar(500) DEFAULT NULL COMMENT 'ROF#',
  `remarks` varchar(500) DEFAULT NULL,
  `unit` varchar(50) DEFAULT NULL,
  `quantity` varchar(20) DEFAULT NULL,
  `price_per_unit` varchar(11) DEFAULT NULL,
  `total` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `procurement_purchase_order`
--

DROP TABLE IF EXISTS `procurement_purchase_order`;
CREATE TABLE IF NOT EXISTS `procurement_purchase_order` (
  `purchase_order_id` int(11) NOT NULL AUTO_INCREMENT,
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
  `updated_by` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`purchase_order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `procurement_quotation`
--

DROP TABLE IF EXISTS `procurement_quotation`;
CREATE TABLE IF NOT EXISTS `procurement_quotation` (
  `quotation_form_id` int(11) NOT NULL AUTO_INCREMENT,
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
  `updated_by` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`quotation_form_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `procurement_request_form`
--

DROP TABLE IF EXISTS `procurement_request_form`;
CREATE TABLE IF NOT EXISTS `procurement_request_form` (
  `request_form_id` int(11) NOT NULL AUTO_INCREMENT,
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
  `update_by` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`request_form_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `procurement_vendor`
--

DROP TABLE IF EXISTS `procurement_vendor`;
CREATE TABLE IF NOT EXISTS `procurement_vendor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `rate_type`
--

DROP TABLE IF EXISTS `rate_type`;
CREATE TABLE IF NOT EXISTS `rate_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `r_type_name` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `salary_setup_header`
--

DROP TABLE IF EXISTS `salary_setup_header`;
CREATE TABLE IF NOT EXISTS `salary_setup_header` (
  `s_s_h_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(30) CHARACTER SET latin1 NOT NULL,
  `salary_payable` varchar(30) CHARACTER SET latin1 DEFAULT NULL,
  `absent_deduct` varchar(30) CHARACTER SET latin1 DEFAULT NULL,
  `tax_manager` varchar(30) CHARACTER SET latin1 NOT NULL,
  `status` varchar(30) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`s_s_h_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `salary_sheet_generate`
--

DROP TABLE IF EXISTS `salary_sheet_generate`;
CREATE TABLE IF NOT EXISTS `salary_sheet_generate` (
  `ssg_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(30) CHARACTER SET latin1 NOT NULL,
  `gdate` varchar(20) DEFAULT NULL,
  `start_date` varchar(30) CHARACTER SET latin1 NOT NULL,
  `end_date` varchar(30) CHARACTER SET latin1 NOT NULL,
  `generate_by` varchar(30) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`ssg_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `salary_type`
--

DROP TABLE IF EXISTS `salary_type`;
CREATE TABLE IF NOT EXISTS `salary_type` (
  `salary_type_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `sal_name` varchar(50) CHARACTER SET latin1 NOT NULL,
  `emp_sal_type` varchar(50) CHARACTER SET latin1 NOT NULL,
  `default_amount` varchar(30) NOT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`salary_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `schdule_purchse_info`
--

DROP TABLE IF EXISTS `schdule_purchse_info`;
CREATE TABLE IF NOT EXISTS `schdule_purchse_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `purchase_key` varchar(100) DEFAULT NULL,
  `domain` varchar(200) DEFAULT NULL,
  `ip_address` varchar(100) DEFAULT NULL,
  `port` varchar(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sec_menu_item`
--

DROP TABLE IF EXISTS `sec_menu_item`;
CREATE TABLE IF NOT EXISTS `sec_menu_item` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_title` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `page_url` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `module` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_menu` int(11) DEFAULT NULL,
  `is_report` tinyint(1) DEFAULT NULL,
  `createby` int(11) NOT NULL,
  `createdate` datetime NOT NULL,
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=199668 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sec_menu_item`
--

INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(147, 'attendance', '', 'attendance', 0, 0, 2, '2018-10-04 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(148, 'atn_form', 'atnview', 'attendance', 147, 0, 2, '2018-10-04 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(149, 'new_award', 'award_form', 'award', 0, 0, 2, '2018-10-04 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(150, 'candidate_basic_info', '', 'recruitment', 0, 0, 2, '2018-10-04 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(151, 'add_canbasic_info', 'canInfo_form', 'recruitment', 150, 0, 2, '2018-10-04 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(152, 'can_basicinfo_list', 'canInfoview', 'recruitment', 150, 0, 2, '2018-10-04 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(153, 'candidate_shortlist', 'shortlist_form', 'recruitment', 0, 0, 2, '2018-10-04 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(154, 'candidate_interview', 'interview_form', 'recruitment', 0, 0, 2, '2018-10-04 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(155, 'candidate_selection', 'selection_form', 'recruitment', 0, 0, 2, '2018-10-04 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(156, 'department', 'dept_form', 'department', 0, 0, 2, '2018-10-04 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(157, 'division', '', 'department', 0, 0, 2, '2018-10-04 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(158, 'add_division', 'division_form', 'department', 157, 0, 2, '2018-10-04 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(159, 'division_list', 'division_list', 'department', 157, 0, 2, '2018-10-04 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(161, 'position', 'position_form', 'employee', 0, 0, 2, '2018-10-04 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(162, 'direct_empl', '', 'employee', 0, 0, 2, '2018-10-04 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(163, 'add_employee', 'employ_form', 'employee', 162, 0, 2, '2018-10-04 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(164, 'manage_employee', 'employee_view', 'employee', 162, 0, 2, '2018-10-04 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(167, 'weekly_holiday', 'weeklyform', 'leave', 0, 0, 2, '2018-10-08 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(168, 'holiday', 'holiday_form', 'leave', 0, 0, 2, '2018-10-08 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(169, 'others_leave_application', '', 'leave', NULL, 0, 2, '2018-10-08 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(170, 'loan_grand', 'grandloan_form', 'loan', 0, 0, 2, '2018-10-08 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(171, 'loan_installment', 'installment_form', 'loan', 0, 0, 2, '2018-10-08 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(172, 'loan_report', 'ln_report', 'loan', 0, 0, 2, '2018-10-08 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(173, 'notice', 'notice_form', 'noticeboard', 0, 0, 2, '2018-10-08 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(176, 'salary_generate', 'salary_generate_form', 'payroll', 0, 0, 2, '2018-10-08 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(177, 'employee_reports', '', 'reports', 0, 0, 2, '2018-10-09 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(178, 'demographic_report', 'demographic_list', 'reports', 177, 0, 2, '2018-10-09 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(179, 'posting_report', 'positional_list', 'reports', 177, 0, 2, '2018-10-09 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(183, 'adhoc_report', 'adhoc_form', 'reports', 0, 0, 2, '2018-10-09 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(186, 'add_leave_type', 'leave_type_form', 'leave', 169, 0, 2, '2018-10-16 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(187, 'leave_application', 'other_leave_application_form', 'leave', 169, 0, 2, '2018-10-16 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(188, 'c_o_a', 'treeview', 'accounts', NULL, 0, 2, '2018-10-18 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(189, 'financiall_year', 'financiall_year', 'accounts', 0, 0, 2, '2019-12-14 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(190, 'sub_account', 'sub_account', 'accounts', 0, 0, 2, '2019-12-14 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(191, 'predefined_accounts', 'predefined_accounts', 'accounts', 0, 0, 2, '2019-12-14 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(192, 'bank_reconciliation', 'bank_reconciliation', 'accounts', 0, 0, 2, '2019-12-14 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(193, 'debit_voucher', 'debit_voucher', 'accounts', 0, 0, 2, '2018-10-18 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(194, 'credit_voucher', 'credit_voucher', 'accounts', 0, 0, 2, '2018-10-18 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(195, 'contra_voucher', 'contra_voucher', 'accounts', 0, 0, 2, '2018-10-18 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(196, 'journal_voucher', 'journal_voucher', 'accounts', 0, 0, 2, '2018-10-18 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(197, 'voucher_approval', 'voucher_approve', 'accounts', 0, 0, 2, '2018-10-18 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(198, 'opening_balance', 'opening_balance', 'accounts', 0, 0, 2, '2018-10-18 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(199, 'account_report', '', 'accounts', 0, 0, 2, '2018-10-18 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(200, 'cash_book', 'cash_book', 'accounts', 194, 0, 2, '2018-10-18 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(201, 'bank_book', 'bank_book', 'accounts', 194, 0, 2, '2018-10-18 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(202, 'general_ledger', 'general_ledger', 'accounts', 194, 0, 2, '2018-10-18 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(203, 'trial_balance', 'trial_balance', 'accounts', 194, 0, 2, '2018-10-18 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(204, 'add_bank', 'add_bank', 'bank', 0, 0, 2, '2019-12-14 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(205, 'bank_list', 'bank_list', 'bank', 0, 0, 2, '2019-12-14 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(206, 'profit_loss', 'profit_loss_report', 'accounts', 194, 0, 2, '2018-10-18 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(207, 'cash_flow', 'cash_flow_report', 'accounts', 194, 0, 2, '2018-10-18 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(208, 'coa_print', 'coa_print', 'accounts', 194, 0, 2, '2018-10-18 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(211, 'atn_log_datewise', 'attendance_log_datewise', 'attendance', 147, 0, 2, '2019-12-14 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(219, 'emp_sal_payment', 'paymentview', 'payroll', 0, 0, 2, '2019-12-14 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(247, 'vendor_list', 'vendor_list', 'procurements', 243, 0, 1, '2021-03-10 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(246, 'vendor', 'vendor', 'procurements', 243, 0, 1, '2021-03-10 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(243, 'vendors', '', 'procurements', 0, 0, 1, '2021-03-10 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(239, 'good_received_list', 'good_received_list', 'procurements', 237, 0, 1, '2021-03-10 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(238, 'good_received_form', 'good_received_form', 'procurements', 237, 0, 1, '2021-03-10 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(237, 'good_received', '', 'procurements', 0, 0, 1, '2021-03-10 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(236, 'purchase_order_list', 'purchase_order_list', 'procurements', 234, 0, 1, '2021-03-10 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(235, 'purchase_order_form', 'purchase_order_form', 'procurements', 234, 0, 1, '2021-03-10 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(234, 'purchase_order', '', 'procurements', 0, 0, 1, '2021-03-10 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(233, 'bid_analysis_list', 'bid_analysis_list', 'procurements', 231, 0, 1, '2021-03-10 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(232, 'bid_analysis_form', 'bid_analysis_form', 'procurements', 231, 0, 1, '2021-03-10 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(231, 'bid_analysis', '', 'procurements', 0, 0, 1, '2021-03-10 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(230, 'quotation', '', 'procurements', 0, 0, 1, '2021-03-10 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(229, 'request_approval', 'request_approval', 'procurements', 226, 0, 1, '2021-03-10 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(228, 'request_list', 'request_list', 'procurements', 226, 0, 1, '2021-03-10 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(227, 'request_form', 'request_form', 'procurements', 226, 0, 1, '2021-03-10 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(226, 'requests', 'requests', 'procurements', 0, 0, 1, '2021-03-10 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(255, 'team_member', 'team_member', 'projectmanagement', 253, 0, 1, '2021-03-10 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(254, 'project_lists', 'project_lists', 'projectmanagement', 253, 0, 1, '2021-03-10 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(253, 'pm_reports', '', 'projectmanagement', 0, 0, 1, '2021-03-10 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(252, 'manage_tasks', 'manage_tasks', 'projectmanagement', 0, 0, 1, '2021-03-10 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(251, 'sprint', 'sprint', 'projectmanagement', 0, 0, 1, '2021-03-10 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(250, 'task', 'task', 'projectmanagement', 0, 0, 1, '2021-03-10 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(249, 'projects', 'projects', 'projectmanagement', 0, 0, 1, '2021-03-10 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(248, 'clients', 'clients', 'projectmanagement', 0, 0, 1, '2021-03-10 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(263, 'emp_performance', 'emp_performance_form', 'employee', 0, 0, 2, '2018-10-04 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(266, 'salary_advance', 'salary_advance', 'payroll', 0, 0, 2, '2019-12-14 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(273, 'day_book', 'day_book', 'accounts', 194, 0, 2, '2018-10-18 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(274, 'sub_ledger', 'sub_ledger', 'accounts', 194, 0, 2, '2018-10-18 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(275, 'income_statement', 'income_statement', 'accounts', 194, 0, 2, '2018-10-18 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(276, 'expenditure_statement', 'expenditure_statement', 'accounts', 194, 0, 2, '2018-10-18 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(277, 'balance_sheet', 'balance_sheet', 'accounts', 194, 0, 2, '2018-10-18 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(278, 'fixedasset_schedule', 'fixedasset_schedule', 'accounts', 194, 0, 2, '2018-10-18 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(279, 'receipt_payment', 'receipt_payment', 'accounts', 194, 0, 2, '2018-10-18 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(280, 'bank_reconciliation_report', 'bank_reconciliation_report', 'accounts', 194, 0, 2, '2018-10-18 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(281, 'attendance_report', '', 'reports', 0, 0, 2, '2018-10-09 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(282, 'daily_presents', 'daily_presents', 'reports', 281, 0, 2, '2018-10-09 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(283, 'monthly_presents', 'monthly_presents', 'reports', 281, 0, 2, '2018-10-09 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(284, 'daily_absent', 'daily_absent', 'reports', 281, 0, 2, '2018-10-09 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(285, 'monthly_absent', 'monthly_absent', 'reports', 281, 0, 2, '2018-10-09 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(286, 'leave_report', '', 'reports', 0, 0, 2, '2018-10-09 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(287, 'employee_on_leave', 'employee_on_leave', 'reports', 286, 0, 2, '2018-10-09 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(288, 'point_settings', 'point_settings', 'rewardpoint', 0, 0, 1, '2020-12-28 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(289, 'point_categories', 'point_categories', 'rewardpoint', 0, 0, 1, '2020-12-28 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(290, 'management_point', 'management_point', 'rewardpoint', 0, 0, 1, '2020-12-28 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(291, 'collaborative_point', 'collaborative_point', 'rewardpoint', 0, 0, 1, '2020-12-28 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(292, 'employee_point', 'employee_point', 'rewardpoint', 0, 0, 1, '2020-12-28 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(293, 'attendence_point', 'attendence_point', 'rewardpoint', 0, 0, 19, '2020-12-31 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(295, 'payroll', '', 'reports', 0, 0, 2, '2018-10-09 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(296, 'npf3_soc_sec_tax_report', 'npf3_soc_sec_tax_report', 'reports', 295, 0, 2, '2018-10-09 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(297, 'sate_income_tax_schedule', 'sate_income_tax_schedule', 'reports', 295, 0, 2, '2018-10-09 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(298, 'iicf3_contribution_report', 'iicf3_contribution_report', 'reports', 295, 0, 2, '2018-10-09 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(299, 'salary_confirmation_form', 'salary_confirmation_form', 'reports', 295, 0, 2, '2018-10-09 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(300, 'sate_income_tax_schedule', 'sate_income_tax_schedule', 'reports', 295, 0, 2, '2018-10-09 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(301, 'gra_ret_5', 'gra_ret_5', 'reports', 295, 0, 2, '2018-10-09 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(302, 'social_security_npf_icf', 'social_security_npf_icf', 'reports', 295, 0, 2, '2018-10-09 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES(303, 'leave_approval', 'leave_approval', 'leave', 169, 0, 2, '2018-10-16 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `sec_role_permission`
--

DROP TABLE IF EXISTS `sec_role_permission`;
CREATE TABLE IF NOT EXISTS `sec_role_permission` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `can_access` tinyint(1) NOT NULL,
  `can_create` tinyint(1) NOT NULL,
  `can_edit` tinyint(1) NOT NULL,
  `can_delete` tinyint(1) NOT NULL,
  `createby` int(11) NOT NULL,
  `createdate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sec_role_permission`
--

INSERT INTO `sec_role_permission` VALUES
(221, 1, 188, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(222, 1, 189, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(223, 1, 190, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(224, 1, 191, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(225, 1, 192, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(226, 1, 193, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(227, 1, 194, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(228, 1, 195, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(229, 1, 196, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(230, 1, 197, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(231, 1, 198, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(232, 1, 199, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(233, 1, 200, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(234, 1, 201, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(235, 1, 202, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(236, 1, 203, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(237, 1, 206, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(238, 1, 207, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(239, 1, 208, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(240, 1, 273, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(241, 1, 274, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(242, 1, 275, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(243, 1, 276, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(244, 1, 277, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(245, 1, 278, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(246, 1, 279, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(247, 1, 280, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(248, 1, 147, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(249, 1, 148, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(250, 1, 211, 1, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(251, 1, 149, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(252, 1, 204, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(253, 1, 205, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(254, 1, 156, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(255, 1, 157, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(256, 1, 158, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(257, 1, 159, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(258, 1, 161, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(259, 1, 162, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(260, 1, 163, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(261, 1, 164, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(262, 1, 263, 1, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(263, 1, 167, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(264, 1, 168, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(265, 1, 169, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(266, 1, 186, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(267, 1, 187, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(268, 1, 170, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(269, 1, 171, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(270, 1, 172, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(271, 1, 173, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(272, 1, 176, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(273, 1, 219, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(274, 1, 266, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(275, 1, 226, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(276, 1, 227, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(277, 1, 228, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(278, 1, 229, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(279, 1, 230, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(280, 1, 231, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(281, 1, 232, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(282, 1, 233, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(283, 1, 234, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(284, 1, 235, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(285, 1, 236, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(286, 1, 237, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(287, 1, 238, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(288, 1, 239, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(289, 1, 243, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(290, 1, 246, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(291, 1, 247, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(292, 1, 248, 1, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(293, 1, 249, 1, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(294, 1, 250, 1, 1, 1, 0, 1, '2022-09-04 05:11:45'),
(295, 1, 251, 1, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(296, 1, 252, 1, 1, 1, 1, 1, '2022-09-04 05:11:45'),
(297, 1, 253, 1, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(298, 1, 254, 1, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(299, 1, 255, 1, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(300, 1, 150, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(301, 1, 151, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(302, 1, 152, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(303, 1, 153, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(304, 1, 154, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(305, 1, 155, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(306, 1, 177, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(307, 1, 178, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(308, 1, 179, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(309, 1, 183, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(310, 1, 281, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(311, 1, 282, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(312, 1, 283, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(313, 1, 284, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(314, 1, 285, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(315, 1, 286, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(316, 1, 287, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(317, 1, 295, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(318, 1, 296, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(319, 1, 297, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(320, 1, 298, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(321, 1, 299, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(322, 1, 300, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(323, 1, 301, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(324, 1, 302, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(325, 1, 288, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(326, 1, 289, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(327, 1, 290, 0, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(328, 1, 291, 1, 1, 0, 0, 1, '2022-09-04 05:11:45'),
(329, 1, 292, 1, 0, 0, 0, 1, '2022-09-04 05:11:45'),
(330, 1, 293, 1, 0, 0, 0, 1, '2022-09-04 05:11:45');

-- --------------------------------------------------------

--
-- Table structure for table `sec_role_tbl`
--

DROP TABLE IF EXISTS `sec_role_tbl`;
CREATE TABLE IF NOT EXISTS `sec_role_tbl` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` text NOT NULL,
  `role_description` text NOT NULL,
  `create_by` int(11) DEFAULT NULL,
  `date_time` datetime DEFAULT NULL,
  `role_status` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `sec_role_tbl` VALUES
(1, 'Employee', 'Employee', 1, '2022-09-04 05:08:28', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sec_user_access_tbl`
--

DROP TABLE IF EXISTS `sec_user_access_tbl`;
CREATE TABLE IF NOT EXISTS `sec_user_access_tbl` (
  `role_acc_id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_role_id` int(11) NOT NULL,
  `fk_user_id` int(11) NOT NULL,
  PRIMARY KEY (`role_acc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

DROP TABLE IF EXISTS `setting`;
CREATE TABLE IF NOT EXISTS `setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `currency_in_words` varchar(50) NOT NULL,
  `state_income_tax` int(11) NOT NULL,
  `soc_sec_npf_tax` int(11) NOT NULL DEFAULT 5,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `title`, `address`, `email`, `phone`, `logo`, `favicon`, `language`, `timezone`, `site_align`, `footer_text`, `currency_symbol`, `currency_in_words`, `state_income_tax`, `soc_sec_npf_tax`) VALUES(1, 'Bdtask Ltds', '4 th Floor  Mannan Plaza ,Khilkhet,Dhaka-1229', 'bdtask@gmail.com', '0123456789', 'assets/img/icons/2017-07-22/HRM.png', 'assets/img/icons/2017-04-03/m.png', 'english', 'Asia/Dhaka', 'LTR', '2022Ã‚Â©Copyright', '$', 'Dollar', 5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `synchronizer_setting`
--

DROP TABLE IF EXISTS `synchronizer_setting`;
CREATE TABLE IF NOT EXISTS `synchronizer_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hostname` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `port` varchar(10) NOT NULL,
  `debug` varchar(10) NOT NULL,
  `project_root` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

DROP TABLE IF EXISTS `units`;
CREATE TABLE IF NOT EXISTS `units` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unit` varchar(200) DEFAULT NULL,
  `created_by` varchar(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `update_by` varchar(11) DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `unit`, `created_by`, `created_at`, `update_by`, `update_at`) VALUES(1, 'gm', '1', '2021-03-23 01:56:11', NULL, NULL);
INSERT INTO `units` (`id`, `unit`, `created_by`, `created_at`, `update_by`, `update_at`) VALUES(2, 'kg', '1', '2021-03-23 01:56:21', NULL, NULL);
INSERT INTO `units` (`id`, `unit`, `created_by`, `created_at`, `update_by`, `update_at`) VALUES(3, 'pcs', '1', '2021-03-23 01:56:26', NULL, NULL);
INSERT INTO `units` (`id`, `unit`, `created_by`, `created_at`, `update_by`, `update_at`) VALUES(4, 'pounds', '1', '2021-03-23 01:56:35', '1', '2021-03-27 10:45:53');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `token_id` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `weekly_holiday`
--

DROP TABLE IF EXISTS `weekly_holiday`;
CREATE TABLE IF NOT EXISTS `weekly_holiday` (
  `wk_id` int(11) NOT NULL AUTO_INCREMENT,
  `dayname` varchar(30) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`wk_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `weekly_holiday`
--

INSERT INTO `weekly_holiday` (`wk_id`, `dayname`) VALUES(1, 'Satarday,Sunday');

