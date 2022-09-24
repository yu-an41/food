-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2022-09-25 00:45:08
-- 伺服器版本： 10.5.17-MariaDB
-- PHP 版本： 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `shop-nowastefood`
--

-- --------------------------------------------------------

--
-- 資料表結構 `shop_list`
--

CREATE TABLE `shop_list` (
  `sid` int(11) NOT NULL,
  `shop_cover` varchar(255) NOT NULL,
  `shop_email` varchar(255) NOT NULL,
  `shop_password` varchar(255) NOT NULL,
  `shop_name` varchar(255) NOT NULL,
  `shop_phone` varchar(255) NOT NULL,
  `shop_address_city` varchar(255) NOT NULL,
  `shop_address_area` varchar(255) NOT NULL,
  `shop_address_detail` varchar(255) NOT NULL,
  `shop_opentime` varchar(255) NOT NULL,
  `shop_closetime` varchar(255) NOT NULL,
  `shop_deadline` varchar(255) NOT NULL,
  `shop_approved` int(11) NOT NULL,
  `shop_created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `shop_list`
--

INSERT INTO `shop_list` (`sid`, `shop_cover`, `shop_email`, `shop_password`, `shop_name`, `shop_phone`, `shop_address_city`, `shop_address_area`, `shop_address_detail`, `shop_opentime`, `shop_closetime`, `shop_deadline`, `shop_approved`, `shop_created_at`) VALUES
(1, '01cover.jpg', 'mail480@test.com', '$2y$10$hUFpyDraflMZy3qG11Q5zezZKWLzUVyRP2veVYbXewe6aEUF8rtfK', 'Cafejiasong 咖央', '02-75081819', '台北市', '大安區', '大安路一段51巷2號2樓', '11:00', '19:00', '19:00', 1, '2022-09-19 14:56:31'),
(2, '02cover.jpg', 'mail117@test.com', '$2y$10$acqrIVG8LBH.u4n/PMCfZuJ3pqfQrzyZwSE7.n84fF/Hyq5umygGO', 'Ling Day Sofa', '05-68975690', '台北市', '大安區', '和平東路二段175巷46號2樓', '12:00', '22:00', '20:00', 1, '2022-09-19 14:56:31'),
(3, '03cover.jpg', 'mail131@test.com', '$2y$10$mXaEjp0yQLy/IU70DoahZ.nUmE2/CIWxmmvTwxiNcogFaKe6p5sgy', '十三甜品棧', '06-96288007', '新北市', '三重區', '仁愛街445巷', '11:00', '20:00', '18:00', 1, '2022-09-19 14:56:31'),
(4, '04cover.jpg', 'mail601@test.com', '$2y$10$/iAzi8XDbU3LUv3auGmeU.Uw8vnBM.fBhLtGAebbowhQo5IDcP51u', '微密 jolie', '07-86122108', '台北市', '中山區', '民權西路70巷45-2號', '13:00', '21:00', '18:00', 1, '2022-09-19 14:56:31'),
(5, '05cover.jpg', 'mail220@test.com', '$2y$10$8okjo59QoXuIf3lm1WLUl.T/ncESIn4Vm88Nsyl8rhSTMtGO4kcs2', 'waku waku pasta', '04-85393626', '台北市', '信義區', '松高路11號4樓', '11:00', '20:00', '20:00', 1, '2022-09-19 14:56:31'),
(6, '06cover.jpg', 'mail680@test.com', '$2y$10$cq34C1xdG53ALZWySt4g4.OqzmA2se9f9TV4gbxXgKoMdy41WbbaW', '暖男炸雞', '06-55860924', '台北市', '信義區', '永吉路30巷122號旁的空地', '16:00', '23:00', '20:00', 1, '2022-09-19 14:56:31'),
(7, '07cover.jpg', 'mail369@test.com', '$2y$10$2yyZmnlJMHQxRkUW32JNQ.SSbcGYLQIAO9NWMSkFT237pcdvpXHwy', 'Fizz', '06-80800344', '台北市', '大安區', '和平東路三段68號', '11:00', '18:00', '18:00', 1, '2022-09-19 14:56:31'),
(8, '08cover.jpg', 'mail515@test.com', '$2y$10$57BFrrfXpX0F0hHgut8mWeYPfLNH5ks9Tjw/Gyx3JNDMesI.biMje', '食三食堂', '03-42906605', '台北市', '大安區', '和平東路三段228巷13號', '11:00', '15:00', '15:00', 1, '2022-09-19 14:56:31'),
(9, '09cover.jpg', 'mail410@test.com', '$2y$10$lDVSFJjlACEHy/KgeD6KROaj2QzBG0WdvRuqV9lWGXjeX8b3pQi4q', '勝利洋食', '08-28955282', '台北市', '大安區', '敦化南路一段161巷8號', '12:00', '20:00', '18:00', 1, '2022-09-19 14:56:31'),
(10, '10cover.jpg', 'mail581@test.com', '$2y$10$pkSsJXV9gcPGW5nJlstUpug9O33f3Z5r7lOuYkJHs4ILnZd8rDz06', 'the TOAST • PROJECT', '06-81097564', '新北市', '板橋區', '松柏街1巷22弄2號', '8:00', '15:00', '15:00', 1, '2022-09-19 14:56:31'),
(11, '11cover.jpg', 'mail704@test.com', '$2y$10$CcFRbSVJrz4j5mjj3Wpn8uY8XkkJWjObqCj6rKN4LQPfmKexrjnoG', 'Mimi köri ミミ - 小秘密', '06-43843790', '屏東縣', '屏東市', '市民享路173號', '7:00', '20:00', '19:00', 1, '2022-09-19 14:56:31'),
(12, '12cover.jpg', 'mail310@test.com', '$2y$10$ha48B/bBeOhl4XOcfBfbHebvqKLlXXqIuO1g138jRBFNA4.o1Cepa', '收藏糖餅', '02-99292448', '台中市', '北區', '尊賢街', '14:00', '20:00', '18:00', 1, '2022-09-19 14:56:31'),
(13, '13cover.jpg', 'mail617@test.com', '$2y$10$LhL9eP3T1GBejavrujShgeNp6qiJFxV6zuWcJQsF6VMCAutgkYoN.', '飽嗝製所泰式早午餐', '04-63292182', '屏東縣', '屏東市', '和平路470號', '8:00', '15:00', '15:00', 1, '2022-09-24 17:16:39'),
(14, '14cover.jpg', 'mail301@test.com', '$2y$10$Wbn6ZyNldaq4.DSqu38fM.n/NpRqowHftxxxcuWtgxKUgGZ4SbNda', '杯沿溫度咖啡', '03-98624312', '屏東縣', '屏東市', '公安街79號', '11:00', '20:00', '19:00', 1, '2022-09-24 17:16:39'),
(15, '15cover.jpg', 'mail844@test.com', '$2y$10$zfwgR7nP4gDAJGBxnolxH.tSlOsUP.JTNbRsU9zolE5NOAuLINdjy', '龍興冰品店', '04-43195192', '台南市', '中西區', '金華路四段39號', '11:00', '20:00', '18:00', 1, '2022-09-24 17:16:39'),
(16, '16cover.jpg', 'mail292@test.com', '$2y$10$JZKJ0tiVstYGFSj4PXkqpugdTBkIFRnWV310oeVD2I/kl09P72AnC', '灑白甜鮮奶麻糬舖', '05-94049869', '台北市', '大同區', '南京西路25巷38號之2號', '11:00', '20:00', '20:00', 1, '2022-09-24 17:16:39'),
(17, '17cover.jpg', 'mail204@test.com', '$2y$10$EV.XYD6mW.Xcr3LpxGF/vOaCwa2ZOW3djYHBb6XaPGqu1cqs0GhV6', '七誠米粿', '06-30560862', '台南市', '中西區', '國華街三段105號', '8:00', '15:00', '15:00', 1, '2022-09-24 17:16:39'),
(18, '18cover.jpg', 'mail513@test.com', '$2y$10$/sliCCMxuVkxSTDO3BiAQ.bhg0yRAfE8JhF2roHLBtu3GdfClP9Ym', '清水堂', '02-64757605', '台南市', '中西區', '中正路305號', '11:00', '18:00', '18:00', 1, '2022-09-24 17:16:39'),
(19, '19cover.jpg', 'mail628@test.com', '$2y$10$oeRFq6jSGKb8zKWp7fpp/OBiySHq3KmLVDnH68i2ICqwnjLKuhS3e', '小日常雞蛋糕', '08-73131911', '台南市', '中西區', '神農街47號入口', '15:00', '20:00', '19:00', 1, '2022-09-24 17:16:40'),
(20, '20cover.jpg', 'mail661@test.com', '$2y$10$BQuzlvcmlG8vKeqRaTXoduCL08njUUFcHoSyg0FwqwY5qS0Iv8T4S', '溫柔', '02-15606862', '台北市', '板橋區', '民有街10號', '11:00', '20:00', '18:00', 1, '2022-09-24 17:16:40'),
(21, '21cover.jpg', 'mail838@test.com', '$2y$10$l8WJBngJnsBLbRnRnYw0bemWnJD1yCRbS9AD2KnXVzvRmCQLIEG1a', '金光鐘錶Mix & Match', '07-34216223', '台北市', '中山區', '林森北路351號1樓', '11:00', '20:00', '18:00', 1, '2022-09-24 17:16:40'),
(22, '22cover.jpg', 'mail488@test.com', '$2y$10$Ocbpng5qgkgTveNTvLBqLOcnmDxxv/GH3E/fBBPHK1XkSPucMBLbK', 'Mooo Burger', '03-76094733', '台北市', '信義區', '逸仙路42巷19號1樓', '11:00', '15:00', '15:00', 1, '2022-09-24 17:16:40'),
(23, '23cover.jpg', 'mail285@test.com', '$2y$10$Mzbzk.voDUcKyzgmb3JNsuK5m/p3xYh1v1893DIrnoAB4PLS4EPce', 'Goody Pâtisserie古迪法式甜點', '04-58555163', '台北市', '信義區', '崇德街38巷30號1樓', '11:00', '18:00', '18:00', 1, '2022-09-24 17:16:40'),
(24, '24cover.jpg', 'mail702@test.com', '$2y$10$aBFvxr/AUc1VjvMEnTGgKeCia5x9mg3WlPyb1idRP0nIWVYF7WGNu', '冰ㄉ• かき氷', '07-58900193', '台南市', '中西區', '萬昌街39號', '11:00', '20:00', '20:00', 1, '2022-09-24 17:16:40'),
(25, '25cover.jpg', 'mail746@test.com', '$2y$10$SNlE/7x/qMGZE9PQFj7Oiu9DTlY1Mmfu.xZjDiLp7qFcNkcYkCki.', '浮生避難所', '03-35409677', '台北市', '大安區', '和平東路二段283巷4弄5號', '11:00', '18:00', '18:00', 1, '2022-09-24 17:16:40'),
(26, '26cover.jpg', 'mail537@test.com', '$2y$10$BAQb9KBuc4MMLMPy8tX8xu/Y/PuyTHe8KFzh7cdu6fga9.xJI9bw2', '沒有特別計畫cafe', '07-44674449', '新北市', '淡水區', '中山北路一段207巷37弄1號', '13:00', '20:00', '20:00', 1, '2022-09-24 17:16:40'),
(27, '27cover.jpg', 'mail670@test.com', '$2y$10$0Mmrs0Hzdeov1yx0R6NltemP7KtdG5UqQGoQ9dZb4Euwptjy4BuUa', '果果Guoguo', '05-58545637', '台北市', '大安區', '瑞安街202號', '13:00', '20:00', '19:00', 1, '2022-09-24 17:16:40'),
(28, '28cover.jpg', 'mail221@test.com', '$2y$10$NXrtki4mx/wQafpsrMiYdeY4iJP7qejwSs929byuqtClu5UWKoQki', '金花碳烤吐司專賣', '03-35511662', '台北市', '萬華區', '內江街21號1樓', '8:00', '15:00', '15:00', 1, '2022-09-24 17:16:40'),
(29, '29cover.jpg', 'mail832@test.com', '$2y$10$GaLpAStOTtaBtX2PuGdVrO5rPbXGZp7VzsaZD6LRI3r7e7GEqHxVS', '羊毛與花', '06-32911035', '台北市', '中正區', '信義路一段9-1號號', '11:00', '20:00', '20:00', 1, '2022-09-24 17:16:40'),
(30, '30cover.jpg', 'mail956@test.com', '$2y$10$Hb.ZBY5mqnlIH7TU2ah1WukN1DU/3ItBFwX9Vw..xaZP5pU.2NjX.', 'Woosa', '04-67968559', '台北市', '信義區', '忠孝東路四段553巷28號', '11:00', '20:00', '18:00', 1, '2022-09-24 17:16:41'),
(31, '31cover.jpg', 'mail269@test.com', '$2y$10$mxY7Q0tEYwsb2.7fOrqEqON0mhRhrxRxSfFeS7LNGSj59NE81q7cC', '某某甜點', '02-51035289', '台北市', '大安區', '仁愛路四段345巷4弄7號', '13:00', '20:00', '20:00', 1, '2022-09-24 17:16:41'),
(32, '32cover.jpg', 'mail881@test.com', '$2y$10$H/Q3eHEubCWOhs6FpXWUguKv1mJ4vOqvkDzSaf/yWlKjQOTkzUuAG', '蘋果肉桂咖啡餐酒館', '04-81389497', '台北市', '信義區', '松山路540巷3弄4號', '11:00', '20:00', '19:00', 1, '2022-09-24 17:16:41'),
(33, '33cover.jpg', 'mail158@test.com', '$2y$10$3B0BCL8CSBHcIxpt5KFKc./LU65e.lGA1AkbYViq9SGBxAzgS7QDK', '美菊麵包店', '08-53721836', '屏東縣', '屏東市', '公園路66號', '11:00', '20:00', '19:00', 1, '2022-09-24 17:16:41'),
(34, '34cover.jpg', 'mail591@test.com', '$2y$10$XJNmbDWwQwouhGT6S6zsPe.uhKNQU2XrjEyjAtpl2tJuHyW2q9ee2', '錵饌 真・麵鋪', '07-34659303', '新北市', '板橋區', '文化路二段125巷38號', '11:00', '20:00', '18:00', 1, '2022-09-24 17:16:41'),
(35, '35cover.jpg', 'mail124@test.com', '$2y$10$7af2yOB.GJ1KFDGLf3ewauWFFnPLXN3kaI7CyZiomxWJVKGbFGQ9u', '醇涎坊古早味鍋燒意麵', '08-33401319', '台南市', '中西區', '保安路53號', '6:00', '20:00', '20:00', 1, '2022-09-24 17:16:41'),
(36, '36cover.jpg', 'mail656@test.com', '$2y$10$uMxsP6cU/CztJdRR3WqyyutjE5rdTq0zkNE7zRJH5wDrWklNqMiWm', '禾間糧倉𝗠𝗶𝗱𝗱𝗹𝗲 𝗥𝗲𝘀𝘁𝗿𝗼', '08-64778938', '台中市', '北區', '台灣大道二段342-1號', '11:00', '20:00', '20:00', 1, '2022-09-24 17:16:41'),
(37, '37cover.jpg', 'mail426@test.com', '$2y$10$wu9T/9jUKOdmO2.QPFR3gOau8nyJC69xUozwUcX2f53JI1F3kKvui', 'Crybaby', '04-70028441', '台北市', '大安區', '信義路三段198號', '7:00', '20:00', '20:00', 1, '2022-09-24 17:16:41'),
(38, '38cover.jpg', 'mail325@test.com', '$2y$10$AzamWs23VyNHQE7YafdDJu8Bo3rp/HHmxua6UP2YRxMUrVPz0s.Lu', '福七', '02-49813460', '台北市', '松山區', '民生東路三段130巷32號1樓', '11:00', '20:00', '20:00', 1, '2022-09-24 17:16:41'),
(39, '39cover.jpg', 'mail383@test.com', '$2y$10$SFUX5oP5VpxPE30FN3zylO6cCeg9P6zaYDo7fDDGYzJ62S77Kup3m', '北安咖哩', '04-83614761', '台北市', '中山區', '北安路584號', '11:00', '20:00', '19:00', 1, '2022-09-24 17:16:42'),
(40, '40cover.jpg', 'mail998@test.com', '$2y$10$fbo./o/pHGwi3kL8LFZgCejEwtR0kImdGjQnNUw0bEQk/JuC1VjsO', 'Burgerverse', '02-25728339', '台北市', '信義區', '基隆路一段147巷5弄2號', '11:00', '15:00', '15:00', 1, '2022-09-24 17:16:42'),
(41, '41cover.jpg', 'mail665@test.com', '$2y$10$.tLOHJvM/yKqObw3APu5jOwX2NPtOQWRTImKtEgCJM0ZLEFM6Gchy', '貝爵妮法式點心坊', '05-34521767', '台中市', '西區', '精誠五街34號', '11:00', '20:00', '18:00', 1, '2022-09-24 17:16:42'),
(42, '42cover.jpg', 'mail257@test.com', '$2y$10$eUnzUTUsn4hxmcF8ZMQevuWcuA9RviCphxBCeE7h3ZOsllLIAAYnO', '捲捲義廚', '03-85351341', '新北市', '中和區', '興南路一段76號2樓', '11:00', '21:00', '18:00', 1, '2022-09-24 17:16:42'),
(43, '43cover.jpg', 'mail845@test.com', '$2y$10$8UnSFj2TQZepANLR7XvUOeWnd05jS60GMSNnCHgzToIzIp/Q8jiHq', '大鶴黑寶', '05-52043834', '台北市', '中山區', '南京東路一段13巷7弄9號1樓', '13:00', '20:00', '19:00', 1, '2022-09-24 17:16:42'),
(44, '44cover.jpg', 'mail357@test.com', '$2y$10$WsVy.fFttuklpeFLNYEkDuYxAkGhxTHV3WL2k4a.IWa4amfwGD67K', '竣師父牛肉麵', '05-86911652', '台北市', '大安區', '大安路一段52巷24號', '11:00', '20:00', '19:00', 1, '2022-09-24 17:16:42');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `shop_list`
--
ALTER TABLE `shop_list`
  ADD PRIMARY KEY (`sid`),
  ADD UNIQUE KEY `shop_email` (`shop_email`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `shop_list`
--
ALTER TABLE `shop_list`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
