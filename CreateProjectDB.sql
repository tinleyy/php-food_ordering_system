-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- 主機: localhost
-- 產生時間： 2018 年 07 月 16 日 20:02
-- 伺服器版本: 10.1.31-MariaDB
-- PHP 版本： 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `projectDB`
--

-- --------------------------------------------------------

--
-- 資料表結構 `managers`
--

CREATE TABLE `managers` (
  `ManagerId` int(11) UNSIGNED NOT NULL,
  `Name` varchar(255) NOT NULL DEFAULT '',
  `Password` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `managers`
--

INSERT INTO `managers` (`ManagerId`, `Name`, `Password`) VALUES
(1, 'MsAda', 'root'),
(2, 'Elsie', 'root'),
(3, 'Amiyah', 'root'),
(4, 'Mischa', 'root'),
(5, 'Kathy', 'root\r\n'),
(6, 'Traci', 'root'),
(7, 'Alysha', 'root'),
(8, 'Nellie', 'root'),
(9, 'Catherine', 'root\r\n'),
(10, 'Norah', 'root'),
(11, 'Gabriella', 'root'),
(12, 'Elisabeth', 'root'),
(13, 'Leonie', 'root'),
(14, 'Lucinda', 'root'),
(15, 'Donna', 'root'),
(16, 'Leia', 'root'),
(17, 'Nelly', 'root'),
(18, 'Humaira', 'root'),
(19, 'Finlay', 'root'),
(20, 'Madison', 'root');

-- --------------------------------------------------------

--
-- 資料表結構 `orders`
--

CREATE TABLE `orders` (
  `OrderId` int(11) UNSIGNED NOT NULL,
  `RestaurantId` int(11) DEFAULT NULL,
  `SupplierStockId` int(11) DEFAULT NULL,
  `ManagerId` int(11) DEFAULT NULL,
  `WarehouseStaffId` int(11) DEFAULT NULL,
  `Amount` int(11) DEFAULT NULL,
  `Approved` tinyint(1) DEFAULT '0',
  `PurchaseDate` date DEFAULT NULL,
  `DeliveryDate` date DEFAULT NULL,
  `ReceivedDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `orders`
--

INSERT INTO `orders` (`OrderId`, `RestaurantId`, `SupplierStockId`, `ManagerId`, `WarehouseStaffId`, `Amount`, `Approved`, `PurchaseDate`, `DeliveryDate`, `ReceivedDate`) VALUES
(1, 1, 2, NULL, NULL, 220, 0, '2018-07-26', NULL, NULL),
(2, 2, 4, NULL, NULL, 500, 0, '2018-07-26', NULL, NULL),
(3, 3, 10, 1, NULL, 170, 1, '2018-07-31', NULL, NULL),
(4, 6, 19, NULL, NULL, 410, 0, '2018-08-01', NULL, NULL),
(5, 9, 19, 1, NULL, 400, 2, '2018-07-27', NULL, NULL),
(6, 4, 14, NULL, NULL, 120, 0, '2018-07-25', NULL, NULL),
(7, 1, 8, 1, NULL, 240, 1, '2018-07-26', NULL, NULL),
(8, 1, 7, 1, NULL, 50, 2, '2018-07-31', NULL, NULL);

-- --------------------------------------------------------

--
-- 資料表結構 `restaurants`
--

CREATE TABLE `restaurants` (
  `RestaurantId` int(11) UNSIGNED NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `Descriptions` varchar(1024) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `restaurants`
--

INSERT INTO `restaurants` (`RestaurantId`, `Name`, `Password`, `Descriptions`) VALUES
(1, 'Island Pizza', 'root', '557 South 10th Rd. Sanford, NC 27330'),
(2, 'Chopping Block Steakhouse', 'root', '32 North Elm St. Michigan City, IN 46360'),
(3, 'Pockets', 'root', '947 Tailwater St. Fort Worth, TX 76110'),
(4, 'Springfield Inn', 'root', '902 Selby Lane Rockville Centre, NY 11570'),
(5, 'Ponti Seafood Grill', 'root', '99 West Ohio Drive Calumet City, IL 60409'),
(6, '1924 Main', 'root', '611 Yukon Street Matthews, NC 28104'),
(7, 'Emma Cafe & Catering Inc', 'root', '7578 East William Court Wyandotte, MI 48192'),
(8, 'Tracks Restaurant & Bar', 'root', '2 Crescent Dr. Elgin, IL 60120'),
(9, 'Philadelphia\'s Steaks', 'root', '256 Jennings Lane Emporia, KS 66801'),
(10, 'Brown Derby Road House', 'root', '245 Heritage Ave. Middle Village, NY 11379'),
(11, 'Original Roadhouse Grill', 'root', '708 E. Bedford Ave. Round Lake, IL 60073'),
(12, 'Kalamata\'s', 'root', '64 NE. Locust Road \r\nDekalb, IL 60115'),
(13, 'Sidecar', 'root', '609 4th Ave. Drexel Hill, PA 19026'),
(14, 'Calabria Pizza & Restaurant', 'root', '1 Temple Drive Southgate, MI 48195'),
(15, 'Lions Choice', 'root', '9613 SW. Newbridge Dr. Elizabethton, TN 37643'),
(16, 'El Cancun Restaurant', 'root', '7548 Summer Lane Centreville, VA 20120'),
(17, 'Sakura Restaurant Woodfield', 'root', '7934 Sulphur Springs St. North Kingstown, RI 02852'),
(18, 'Campiello', 'root', '53 South Cross Court Fargo, ND 58102'),
(19, 'Round-Up Steakhouse', 'root', '35 Pennsylvania Street Adrian, MI 49221'),
(20, 'Tello\'s Italian Bistro', 'root', '9845 Tailwater Street Palm Harbor, FL 34683');

-- --------------------------------------------------------

--
-- 資料表結構 `stock`
--

CREATE TABLE `stock` (
  `StockId` int(11) UNSIGNED NOT NULL,
  `ManagerId` int(11) DEFAULT NULL,
  `Name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `stock`
--

INSERT INTO `stock` (`StockId`, `ManagerId`, `Name`) VALUES
(1, 1, 'ginger'),
(2, 2, 'chambord'),
(3, 3, 'halibut'),
(4, 4, 'apricots'),
(5, 5, 'cottage cheese'),
(6, 6, 'beef'),
(7, 7, 'oregano'),
(8, 8, 'cookies'),
(9, 9, 'mussels'),
(10, 10, 'veal'),
(11, 11, 'rice vinegar'),
(12, 12, 'chives'),
(13, 13, 'fish sauce'),
(14, 14, 'zinfandel wine'),
(15, 15, 'red chile powder'),
(16, 16, 'zest'),
(17, 17, 'vanilla'),
(18, 18, 'bagels'),
(19, 19, 'kiwi'),
(20, 20, 'cucumbers'),
(21, 1, 'strawberries');

-- --------------------------------------------------------

--
-- 資料表結構 `suppliers`
--

CREATE TABLE `suppliers` (
  `SupplierId` int(11) UNSIGNED NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `suppliers`
--

INSERT INTO `suppliers` (`SupplierId`, `Name`, `Password`) VALUES
(1, 'vtc', 'root'),
(2, 'Buzzy Bee Media', 'root'),
(3, 'Cryptic Lighting', 'root'),
(4, 'Squid Electronics', 'root'),
(5, 'Nemotors', 'root');

-- --------------------------------------------------------

--
-- 資料表結構 `supplierstock`
--

CREATE TABLE `supplierstock` (
  `SupplierStockId` int(11) UNSIGNED NOT NULL,
  `SupplierId` int(11) DEFAULT NULL,
  `StockId` int(11) DEFAULT NULL,
  `Amount` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `supplierstock`
--

INSERT INTO `supplierstock` (`SupplierStockId`, `SupplierId`, `StockId`, `Amount`) VALUES
(1, 1, 1, 200),
(2, 2, 3, 1000),
(3, 1, 2, 23),
(4, 2, 4, 45),
(5, 3, 6, 36),
(6, 4, 8, 2523),
(7, 5, 5, 78),
(8, 3, 7, 24),
(9, 1, 9, 213),
(10, 2, 11, 332),
(11, 3, 10, 45),
(12, 3, 12, 245),
(13, 4, 13, 43),
(14, 2, 14, 44),
(15, 4, 15, 345),
(17, 2, 16, 33),
(18, 3, 17, 43),
(19, 5, 18, 66),
(20, 4, 19, 35),
(21, 3, 20, 500);

-- --------------------------------------------------------

--
-- 資料表結構 `warehousestaff`
--

CREATE TABLE `warehousestaff` (
  `WarehouseStaffId` int(11) UNSIGNED NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `warehousestaff`
--

INSERT INTO `warehousestaff` (`WarehouseStaffId`, `Name`, `Password`) VALUES
(1, 'jack', 'root');

-- --------------------------------------------------------

--
-- 資料表結構 `warehousestock`
--

CREATE TABLE `warehousestock` (
  `WarehouseStockId` int(11) UNSIGNED NOT NULL,
  `WarehouseStaffId` int(11) DEFAULT NULL,
  `StockId` int(11) DEFAULT NULL,
  `Amount` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `warehousestock`
--

INSERT INTO `warehousestock` (`WarehouseStockId`, `WarehouseStaffId`, `StockId`, `Amount`) VALUES
(1, 1, 1, 20),
(2, 1, 2, 5),
(3, 1, 3, 400),
(4, 1, 4, 28),
(5, 1, 5, 130),
(6, 1, 6, 71),
(7, 1, 7, 69),
(8, 1, 8, 141),
(9, 1, 9, 86),
(10, 1, 10, 174),
(11, 1, 11, 194),
(12, 1, 12, 1233),
(13, 1, 13, 55),
(14, 1, 14, 434),
(15, 1, 15, 82),
(16, 1, 16, 57),
(17, 1, 17, 33),
(18, 1, 18, 200),
(19, 1, 19, 435),
(20, 1, 20, 42);

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `managers`
--
ALTER TABLE `managers`
  ADD PRIMARY KEY (`ManagerId`);

--
-- 資料表索引 `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderId`);

--
-- 資料表索引 `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`RestaurantId`);

--
-- 資料表索引 `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`StockId`);

--
-- 資料表索引 `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`SupplierId`);

--
-- 資料表索引 `supplierstock`
--
ALTER TABLE `supplierstock`
  ADD PRIMARY KEY (`SupplierStockId`);

--
-- 資料表索引 `warehousestaff`
--
ALTER TABLE `warehousestaff`
  ADD PRIMARY KEY (`WarehouseStaffId`);

--
-- 資料表索引 `warehousestock`
--
ALTER TABLE `warehousestock`
  ADD PRIMARY KEY (`WarehouseStockId`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `managers`
--
ALTER TABLE `managers`
  MODIFY `ManagerId` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- 使用資料表 AUTO_INCREMENT `orders`
--
ALTER TABLE `orders`
  MODIFY `OrderId` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- 使用資料表 AUTO_INCREMENT `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `RestaurantId` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- 使用資料表 AUTO_INCREMENT `stock`
--
ALTER TABLE `stock`
  MODIFY `StockId` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- 使用資料表 AUTO_INCREMENT `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `SupplierId` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- 使用資料表 AUTO_INCREMENT `supplierstock`
--
ALTER TABLE `supplierstock`
  MODIFY `SupplierStockId` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- 使用資料表 AUTO_INCREMENT `warehousestaff`
--
ALTER TABLE `warehousestaff`
  MODIFY `WarehouseStaffId` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用資料表 AUTO_INCREMENT `warehousestock`
--
ALTER TABLE `warehousestock`
  MODIFY `WarehouseStockId` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=452;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
