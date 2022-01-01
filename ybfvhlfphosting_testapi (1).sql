-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th5 09, 2021 lúc 03:43 PM
-- Phiên bản máy phục vụ: 10.3.28-MariaDB-log-cll-lve
-- Phiên bản PHP: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `ybfvhlfphosting_testapi`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `client_atm`
--

CREATE TABLE `client_atm` (
  `id` int(11) NOT NULL,
  `type` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `note` text COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `password` text COLLATE utf8_unicode_ci NOT NULL,
  `stk` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `pHash` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `cmdId` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `time` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `checkSum` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `sum_login` varchar(256) CHARACTER SET utf8 NOT NULL,
  `SESSION_ID` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `ip` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `client_atm`
--

INSERT INTO `client_atm` (`id`, `type`, `note`, `username`, `password`, `stk`, `pHash`, `cmdId`, `time`, `status`, `checkSum`, `sum_login`, `SESSION_ID`, `ip`) VALUES
(30, 'MOMO', '', 'sđt chơi', '000000', '0359302368', '8FATouvFSMITXey5tPnko5rSWiu7YwIdTIccSAFz9j2zB1bGtB63VXfmEvysYHyY', '1613046983576000000', '1613046983576', 1, '05KLzxsTwdgUqkF0KG6XiljhaMW7JexLMgDA+ciOn/rayVBgRgUeU6ZTEvmX095juNEm7dFbYwirWjSZhx7ldA==', '', '', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `csm_admin`
--

CREATE TABLE `csm_admin` (
  `id` int(11) NOT NULL,
  `steam_id` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `csm_admin`
--

INSERT INTO `csm_admin` (`id`, `steam_id`, `username`, `password`, `email`, `phone`, `ip`) VALUES
(1, '76561198311252332', 'Admin', 'd8059a8b5c57905549537781409c9be4', 'cotruong@gmail.com', '0359302368', '113.172.178.216');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `momo_history_bank`
--

CREATE TABLE `momo_history_bank` (
  `id` int(11) NOT NULL,
  `game` text COLLATE utf8_unicode_ci NOT NULL,
  `NumberPhone` text COLLATE utf8_unicode_ci NOT NULL,
  `FULL_NAME` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL COMMENT 'status = 0 Chờ status = 1 Đã Duyệt status = 2 Hủy',
  `partnerId` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `partnerName` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `amount` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `real_amount` int(11) NOT NULL,
  `comment` text CHARACTER SET utf8 NOT NULL COMMENT 'nội dung KH CK',
  `tranId` varchar(256) COLLATE utf8_unicode_ci NOT NULL COMMENT 'mả giao dịch momobanking',
  `time` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kq` int(11) NOT NULL COMMENT '1 là trượt, 2 là trúng, 0 kxd',
  `day` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `setting`
--

CREATE TABLE `setting` (
  `key` text COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `setting`
--

INSERT INTO `setting` (`key`, `value`) VALUES
('ck00', '1.9'),
('ck01', '3'),
('nd00', 'G1'),
('nd01', 'G2'),
('nd02', 'C'),
('nd03', 'L'),
('nd04', 'T'),
('nd05', 'X'),
('ck03', '2');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `setting_mini`
--

CREATE TABLE `setting_mini` (
  `id` int(11) NOT NULL,
  `note` text COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `chietkhau` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `number` int(11) NOT NULL,
  `min` int(11) NOT NULL,
  `max` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `setting_mini`
--

INSERT INTO `setting_mini` (`id`, `note`, `type`, `chietkhau`, `number`, `min`, `max`) VALUES
(1, 'G1', 'MINI 01', '1', 2, 0, 500000),
(2, 'G2', 'MINI 02', '1', 3, 0, 500000),
(3, 'T', 'MINI 03', '2', 1, 0, 500000),
(4, 'X', 'MINI 03', '2', 1, 0, 500000),
(5, 'C', 'MINI 03', '2', 1, 0, 500000),
(6, 'L', 'MINI 03', '2', 1, 0, 500000);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `client_atm`
--
ALTER TABLE `client_atm`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `csm_admin`
--
ALTER TABLE `csm_admin`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Chỉ mục cho bảng `momo_history_bank`
--
ALTER TABLE `momo_history_bank`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `setting_mini`
--
ALTER TABLE `setting_mini`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `client_atm`
--
ALTER TABLE `client_atm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT cho bảng `csm_admin`
--
ALTER TABLE `csm_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `momo_history_bank`
--
ALTER TABLE `momo_history_bank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT cho bảng `setting_mini`
--
ALTER TABLE `setting_mini`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
