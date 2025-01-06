-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2025-01-03 06:34:44
-- 伺服器版本： 10.4.32-MariaDB
-- PHP 版本： 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `pchome_ranking`
--

DELIMITER $$
--
-- 程序
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_product_rating` (IN `input_pid` INT)   BEGIN
    -- 宣告變數
    DECLARE avg_rating FLOAT; -- 平均評分
    DECLARE total_reviews INT; -- 總評論數

    -- 計算平均評分和總評論數
    SELECT 
        (five_star * 5 + four_star * 4 + three_star * 3 + two_star * 2 + one_star * 1) / 
        (five_star + four_star + three_star + two_star + one_star) AS average_rating,
        (five_star + four_star + three_star + two_star + one_star) AS reviews_count
    INTO 
        avg_rating, total_reviews
    FROM product_info
    WHERE Pid = input_pid;

    -- 查詢商品名稱和圖片 URL 並顯示結果
    SELECT 
        b.Pname AS 商品名稱, 
        b.Pimg AS 圖片_URL, 
        ROUND(avg_rating, 1) AS 平均評分, 
        total_reviews AS 總評論數
    FROM bestsellers b
    WHERE b.Pid = input_pid;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `new_year_sales` ()   BEGIN
    DECLARE dd DATE;
    DECLARE status VARCHAR(255);

    SET dd = CURDATE(); -- 抓取現在時間

    UPDATE product_info 
    SET Pdiscount = 
        CASE 
            WHEN dd BETWEEN '2025/01-03' AND '2025/02/02 23:59:59.999' THEN Pprice * 0.8
            WHEN dd > '2025/02/02' THEN Pprice
            ELSE Pprice
        END;

    IF dd BETWEEN '2025/01/03' AND '2025/02/02' THEN
        SET status = '新年優惠已應用';
    ELSEIF dd > '2025/02/02' THEN
        SET status = '新年優惠已結束';
    ELSE
        SET status = '新年優惠未開始';
    END IF;

    SELECT status AS '狀態';
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spec_img` (IN `Pspec` VARCHAR(255))   BEGIN
    IF Pspec = '火花燈' THEN
        SELECT 'https://hackmd.io/_uploads/r1DJbVVL1e.png' AS status;
    ELSEIF Pspec = '石磨灰' THEN
        SELECT 'https://hackmd.io/_uploads/rJGAx4N8Jl.png' AS status;
    ELSEIF Pspec = '日式深蒸綠茶' THEN
        SELECT 'https://hackmd.io/_uploads/H1k_ZNNL1g.png' AS status;
    ELSEIF Pspec = '春笠清茶' THEN
        SELECT 'https://hackmd.io/_uploads/rJMoZ4E8ke.png' AS status;
    ELSEIF Pspec = '蜜香紅茶' THEN
        SELECT 'https://hackmd.io/_uploads/BJi9ZVEI1e.png' AS status;
    ELSEIF Pspec = '金萱烏龍茶' THEN
        SELECT 'https://hackmd.io/_uploads/rJ4q-VNUye.png' AS status;
    ELSE
        SELECT 'Invalid specification' AS status;
    END IF;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- 資料表結構 `bestsellers`
--

CREATE TABLE `bestsellers` (
  `pid` int(11) NOT NULL,
  `rank` int(11) NOT NULL,
  `Pimg` varchar(255) DEFAULT NULL,
  `Pname` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `bestsellers`
--

INSERT INTO `bestsellers` (`pid`, `rank`, `Pimg`, `Pname`) VALUES
(1, 1, 'https://hackmd.io/_uploads/HJUdYZN8kg.png', 'Kleenex 舒潔蓬柔舒膚抽取衛生紙(100抽x64包)'),
(2, 2, 'https://hackmd.io/_uploads/r1odYbNIyg.png', 'GARMINFenix 8 AMOLED 全方位戶外進階GPS智慧腕錶 51mm'),
(3, 3, 'https://hackmd.io/_uploads/BkXxqW4Lyx.png', '原萃【冷萃】寶特瓶450ml (24入/箱)(口味任選)');

-- --------------------------------------------------------

--
-- 資料表結構 `more_info`
--

CREATE TABLE `more_info` (
  `pid` int(11) NOT NULL,
  `Mp_id` int(11) NOT NULL,
  `Morename` varchar(255) NOT NULL,
  `Moreprice` int(11) NOT NULL,
  `Moreimg` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `more_info`
--

INSERT INTO `more_info` (`pid`, `Mp_id`, `Morename`, `Moreprice`, `Moreimg`) VALUES
(3, 1, '\'原萃【冷萃】寶特瓶450ml (24入X2箱)(口味任選)\'', 1160, 'https://img.pchome.com.tw/cs/items/DBAB7I1900HG4UT/yt000001_1731239558.jpg'),
(3, 2, '\'原萃寶特瓶580ml (24入/箱)(口味任選)\'', 480, 'https://img.pchome.com.tw/cs/items/DBAB7IA900HF1PS/yt000001_1719928616.jpg'),
(3, 3, '\'原萃寶特瓶580ml (24入X2箱)(口味任選)\'', 815, 'https://img.pchome.com.tw/cs/items/DBAB7I1900HG4V9/yt000001_1735784757.jpg');

-- --------------------------------------------------------

--
-- 資料表結構 `product_info`
--

CREATE TABLE `product_info` (
  `Pid` int(11) NOT NULL,
  `Pprice` int(11) DEFAULT NULL,
  `Pdiscount` int(11) DEFAULT NULL,
  `Pdisc` varchar(255) DEFAULT NULL,
  `five_star` int(11) NOT NULL,
  `four_star` int(11) NOT NULL,
  `three_star` int(11) NOT NULL,
  `two_star` int(11) NOT NULL,
  `one_star` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `product_info`
--

INSERT INTO `product_info` (`Pid`, `Pprice`, `Pdiscount`, `Pdisc`, `five_star`, `four_star`, `three_star`, `two_star`, `one_star`) VALUES
(1, 785, NULL, '• PChome獨家暢銷王\r\n• 紙張如湯種系蓬厚有彈性\r\n• 添加蠶絲蛋白精華，觸感細緻柔滑', 1827, 98, 20, 0, 20),
(2, 38900, NULL, '• AMOLED版亮度更升級，通過 MIL-STD-810 軍規測試，磕碰不煩惱，同時承襲強悍電力\r\n• 完整數據高效訓練，一次掌握身體狀態，支援休閒潛水40m與百種運動，陪你玩到天涯海角\r\n• 可撥打及接聽電話，並支援 Garmin Pay，輕鬆感應支付', 57, 1, 0, 0, 0),
(3, 840, NULL, '• 市價：840\r\n• 獨特滴濾慢釀工法\r\n• 無糖、無香料', 950, 20, 0, 0, 5);

-- --------------------------------------------------------

--
-- 資料表結構 `product_spec`
--

CREATE TABLE `product_spec` (
  `Pid` int(11) NOT NULL,
  `Pspec` varchar(100) NOT NULL,
  `Pimg` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `product_spec`
--

INSERT INTO `product_spec` (`Pid`, `Pspec`, `Pimg`) VALUES
(2, '火花燈', 'https://hackmd.io/_uploads/r1DJbVVL1e.png'),
(2, '石磨灰', 'https://hackmd.io/_uploads/rJGAx4N8Jl.png'),
(3, '日式深蒸綠茶', 'https://hackmd.io/_uploads/H1k_ZNNL1g.png\r\n'),
(3, '春笠清茶', 'https://hackmd.io/_uploads/rJMoZ4E8ke.png'),
(3, '蜜香紅茶', 'https://hackmd.io/_uploads/BJi9ZVEI1e.png'),
(3, '金萱烏龍茶', 'https://hackmd.io/_uploads/rJ4q-VNUye.png');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `bestsellers`
--
ALTER TABLE `bestsellers`
  ADD PRIMARY KEY (`pid`);

--
-- 資料表索引 `more_info`
--
ALTER TABLE `more_info`
  ADD PRIMARY KEY (`pid`,`Morename`);

--
-- 資料表索引 `product_info`
--
ALTER TABLE `product_info`
  ADD PRIMARY KEY (`Pid`);

--
-- 資料表索引 `product_spec`
--
ALTER TABLE `product_spec`
  ADD PRIMARY KEY (`Pid`,`Pspec`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `bestsellers`
--
ALTER TABLE `bestsellers`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `more_info`
--
ALTER TABLE `more_info`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `product_info`
--
ALTER TABLE `product_info`
  MODIFY `Pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `product_spec`
--
ALTER TABLE `product_spec`
  MODIFY `Pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
