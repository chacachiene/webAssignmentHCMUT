-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2023 at 06:34 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laptrinhweb_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `name`, `phone`) VALUES
(1, 'tung1', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Tùng', '0971479331');

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE `bill` (
  `indx` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `customerID` int(11) NOT NULL,
  `date` text NOT NULL,
  `totalcost` double NOT NULL,
  `Pay_method` char(10) DEFAULT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'wait'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bill`
--

INSERT INTO `bill` (`indx`, `id`, `customerID`, `date`, `totalcost`, `Pay_method`, `status`) VALUES
(1, 1, 14, '2023-04-24 06:48:44', 38, 'zalopay', 'waiting'),
(2, 1, 19, '2023-04-24 16:43:50', 38, 'cash', 'waiting'),
(3, 2, 14, '2023-04-24 06:49:40', 379, 'cash', 'waiting'),
(4, 3, 14, '2023-04-24 07:40:31', 152, 'cash', 'waiting'),
(5, 4, 14, '2023-04-24 09:52:39', 84738, 'cash', 'waiting'),
(6, 5, 14, '2023-04-25 09:02:23', 5114, 'cash', 'waiting');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `customerID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `customerID`) VALUES
(14, 14),
(17, 17),
(19, 19),
(21, 21);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `indx` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `customerID` int(11) NOT NULL,
  `content` text NOT NULL,
  `comment_date` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`indx`, `productID`, `customerID`, `content`, `comment_date`) VALUES
(1, 1, 14, '12333333333333333333', '2023-04-25'),
(2, 2, 14, '11111111111111111111111111', '2023-04-25'),
(3, 10, 14, 'aaaaaaaaaaaaaadsadsad', '2023-04-25'),
(4, 11, 14, 'vvvvvvvvvvvvvvvvvsdfdsf', '2023-04-25'),
(5, 1, 17, 'assssssssssfdsaxzv', '2023-04-25'),
(6, 2, 17, 'cbzzdsadgd', '2023-04-25'),
(7, 10, 17, 'dsavgdxsvzcxv', '2023-04-25'),
(8, 11, 17, 'dsaffgvdxvzcxv', '2023-04-25'),
(9, 1, 19, 'asdddddddddddddddddddddd', '2023-04-25'),
(10, 2, 19, 'dsvcxzvbsdag', '2023-04-25'),
(11, 10, 19, 'dsadxzvcx', '2023-04-25'),
(12, 11, 19, 'fsdafdsxvz', '2023-04-25'),
(13, 1, 21, 'dfadfdzxvcxv', '2023-04-25'),
(14, 2, 21, 'asDASCXZC', '2023-04-25'),
(15, 10, 21, 'a33333333333333333333333333', '2023-04-25'),
(16, 11, 21, 'fsdafadsfadsfas', '2023-04-25');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `address` varchar(256) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `active` int(11) DEFAULT NULL,
  `image` text DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `username`, `password`, `name`, `phone`, `address`, `birthday`, `active`, `image`, `status`) VALUES
(14, 'tung1', '$2y$10$dzQDCLb19Jxrdo00yGauBuTb0gbmtopRm54jU8WW.1upH8Cn9hbWS', 'Tùng', '0971479222', '372', '2002-02-17', 1, 'tung1.png', 'null'),
(17, 'tung2', '$2y$10$PF3./7qP7Ue6/cNjSJ.GqOcgMG7UxoX1z/7jS8sflDap89gzNKZua', 'Tùng', '0971479331', '372/12/7', '1960-01-01', 0, 'default.png', 'normal'),
(18, 'tung3', '$2y$10$IsAQgejI64xdf.SdOfP4iOqadrgB29JLGUT.Ppxv.iRDnj7eJXTHi', 'Tùng', '0971479331', '372/23/7 cmt8 tphcm', '2002-02-17', NULL, 'default.png', 'normal'),
(19, 'tung4', '$2y$10$uCXij4KfCCp17Pd3hhdkbO27KyJf5.qCyBFnPYifBlHg3cqq5YwaK', 'Tung66', '0971479331', '372/23/7', '2002-02-17', 0, 'tung4.png', 'normal'),
(20, 'tung5', '$2y$10$gB3q38BSafKiNva/7fXwgObx6DQNBf9V6dsqFwMjVaSeqXCi1fj1y', 'Tùng Hoa', '123456789', 'Tùng Hoa', '1960-01-01', NULL, 'default.png', 'normal'),
(21, 'tung6', '$2y$10$IbcN2r4g.ubpzqepOoSbdOCJNPxJko.RsvgnTXQq6PQW6yP/QRKHO', 'tung', '0971479331', '123456', '1960-01-01', 1, 'default.png', 'normal');

-- --------------------------------------------------------

--
-- Table structure for table `keep`
--

CREATE TABLE `keep` (
  `cartID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `amount` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `keep`
--

INSERT INTO `keep` (`cartID`, `productID`, `amount`) VALUES
(14, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` double NOT NULL,
  `type` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `image1` varchar(255) NOT NULL,
  `image2` varchar(255) NOT NULL,
  `image3` varchar(255) NOT NULL,
  `amount` int(11) DEFAULT NULL,
  `rating` int(11) NOT NULL,
  `chip` varchar(255) NOT NULL,
  `ram` varchar(255) NOT NULL,
  `screen` varchar(255) NOT NULL,
  `battery` varchar(255) NOT NULL,
  `outstanding` varchar(255) NOT NULL,
  `guarantee` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `type`, `image`, `image1`, `image2`, `image3`, `amount`, `rating`, `chip`, `ram`, `screen`, `battery`, `outstanding`, `guarantee`) VALUES
(1, 'Mac 2021', '34.44', 'Macbook', 'https://cdn.dienthoaigiakho.vn/photos/1655452036715-macbookair-m2-sb-2.jpg', 'https://cdn.dienthoaigiakho.vn/photos/1655452036729-macbookair-m2-sb-3.jpg', 'https://cdn.dienthoaigiakho.vn/photos/1655452036703-macbookair-m2-sb-1.jpg', 'https://cdn.dienthoaigiakho.vn/photos/1655452036693-macbookair-m2-sb.jpg', 80, 4, 'i7 10th', '8G', '15.6\" FHD (1920 x 1080) Mac ComfyView LCD, Anti-Glare', '10000mAh', 'Tận hưởng trải nghiệm chơi game mượt mà, không bị nhòe. Màn hình viền mỏng cũng đã được tăng tỷ lệ so với thân máy lên 80%.', 'Bảo hành: 12 tháng LaptopAZ'),
(2, 'Macbook Pro 16 M1 Max 10', '77000.1', 'Macbook', 'https://cdn2.cellphones.com.vn/x358,webp,q100/media/catalog/product/m/a/macbook-pro-2021-05_4_2.jpg', 'https://cdn2.cellphones.com.vn/x358,webp,q100/media/catalog/product/m/a/macbook-pro-2021-006_4.jpg', 'https://cdn2.cellphones.com.vn/x358,webp,q100/media/catalog/product/m/a/macbook-pro-2021-005_3.jpg', 'https://cdn2.cellphones.com.vn/x358,webp,q100/media/catalog/product/m/a/macbook-pro-2021-003_3.jpg', 88, 4, 'Apple M1 Max 10 CPU', '32GB', '15.6\" FHD (1920 x 1080) Mac ComfyView LCD, Anti-Glare', '16.2 inches - 120Hz, Liquid Retina, Mini LED, XDR', 'Không chỉ là điểm nhận biết trên các thiết bị smartphone, hiện nay tai thỏ đã xuất hiện trên thế hệ Macbook mới nhất. Macbook Pro 16 M1 Max với thiết kế độc đáo, màn hình chất lượng mang lại trải nghiệm vượt  trội. Máy tính Macbook Pro 16 inch 2021 được t', 'Chính sách bảo hành của Apple luôn được đánh giá cao trong ngành công nghiệp công nghệ. Với mỗi sản phẩm mà khách hàng mua, Apple cung cấp một thời gian bảo hành hợp lý để đảm bảo sự hài lòng và yên tâm cho khách hàng. Thông thường, thời gian bảo hành của'),
(10, 'MacBook Air M1 256GB', '1800', 'Macbook', 'https://www.maccenter.vn/App_images/MacBookAir-2020-M1-SpaceGray-A.jpg', 'https://www.maccenter.vn/App_images/MacBookAir-2020-M1-SpaceGray-B.jpg', 'https://www.maccenter.vn/App_images/MacBookAir-2020-M1-SpaceGray-C.jpg', 'https://www.maccenter.vn/App_images/MacBookAir-2020-M1-SpaceGray-D.jpg', 98, 5, 'The 7-core GPU in M1 chip', '8GB', '13.3-inch (diagonal) LED-backlit display with IPS technology; 2560-by-1600 native resolution at 227 pixels per inch with support for millions of colors', 'Built-in 49.9-watt-hour lithium-polymer battery', 'Tận hưởng trải nghiệm mượt mà, không bị nhòe. Màn hình viền mỏng cũng đã được tăng tỷ lệ so với thân máy lên 80%.', 'Chính sách bảo hành của Apple luôn được đánh giá cao trong ngành công nghiệp công nghệ. Với mỗi sản phẩm mà khách hàng mua, Apple cung cấp một thời gian bảo hành hợp lý để đảm bảo sự hài lòng và yên tâm cho khách hàng. Thông thường, thời gian bảo hành của'),
(11, 'Apple Macbook Air M2 2022', '2569', 'Macbook', 'https://cdn2.cellphones.com.vn/x358,webp,q100/media/catalog/product/m/a/macbook_air_m2_1_1.jpg', 'https://cdn2.cellphones.com.vn/x358,webp,q100/media/catalog/product/2/_/2_54_9.png', 'https://cdn2.cellphones.com.vn/x358,webp,q100/media/catalog/product/3/_/3_40_7.png', 'https://cdn2.cellphones.com.vn/x358,webp,q100/media/catalog/product/6/_/6_17_6.png', 114, 4, 'Apple M2 8 nhân CPU', '8GB', '13.3 inch 2560 x 1664 pixels Retina display', '58.2Whrs lên đến 20 giờ', 'Sau thành công của dòng Macbook M1 thì Apple lại chuẩn bị mang đến cho người dùng dòng sản phẩm Macbook Air 2022 với những điểm nâng cấp đáng chú ý. Bên cạnh đó mức giá thành lại thấp hơn so với hiện tại, chắc chắn rằng các iFan đang rất nóng lòng chờ đón', 'Chính sách bảo hành của Apple luôn được đánh giá cao trong ngành công nghiệp công nghệ. Với mỗi sản phẩm mà khách hàng mua, Apple cung cấp một thời gian bảo hành hợp lý để đảm bảo sự hài lòng và yên tâm cho khách hàng. Thông thường, thời gian bảo hành của'),
(12, 'Macbook Pro 14 inch 2021', '4649', 'Macbook', 'https://cdn2.cellphones.com.vn/x358,webp,q100/media/catalog/product/m/a/macbook-pro-2021-06.jpg', 'https://cdn2.cellphones.com.vn/x358,webp,q100/media/catalog/product/m/a/macbook-pro-2021-001_1.jpg', 'https://cdn2.cellphones.com.vn/x358,webp,q100/media/catalog/product/m/a/macbook-pro-2021-005_1.jpg', 'https://cdn2.cellphones.com.vn/x358,webp,q100/media/catalog/product/m/a/macbook-pro-2021-004_1.jpg', 87, 5, 'M1 Pro/M1 Max', '16GB', '14.2 inches - 120Hz, Liquid Retina, Mini LED, XDR', '60Whrs lên đến 24 giờ', 'Kế thừa những tinh hoa từ đời MacBook tốt nhất cùng với những nâng cấp đáng kể trong nhiều năm qua, Macbook Pro 14 inch dự kiến sẽ là mẫu laptop làm cho giới công nghệ \"phát sốt\", cũng như là cỗ máy xử lý công việc tối ưu h', 'Chính sách bảo hành của Apple luôn được đánh giá cao trong ngành công nghiệp công nghệ. Với mỗi sản phẩm mà khách hàng mua, Apple cung cấp một thời gian bảo hành hợp lý để đảm bảo sự hài lòng và yên tâm cho khách hàng. Thông thường, thời gian bảo hành của'),
(13, 'MacBook Pro 16 inch M2 Pro 2023', '6399', 'Macbook', 'https://cdn2.cellphones.com.vn/x358,webp,q100/media/catalog/product/m/a/macbook_pro_14_inch__41iqg8l6hsyi_large_1.jpg', 'https://cdn2.cellphones.com.vn/x358,webp,q100/media/catalog/product/r/o/routers_compare__dg2f68dd3y0y_large_1.jpg', 'https://cdn2.cellphones.com.vn/x358,webp,q100/media/catalog/product/i/n/in_the_box_14_inch__cla7biqzxe6a_large_1.jpg', 'https://cdn2.cellphones.com.vn/x358,webp,q100/media/catalog/product/k/e/keyboard_14_inch__bjo3gj8bnogi_large_1.jpg', 86, 5, 'Apple M2 Pro 12 nhân', '16GB', '16 inches - 120Hz, Liquid Retina, Mini LED, XDR', '70Wh Sạc 96W', 'Macbook Pro 16 M2 Pro 1TB 2023 được xem là sự lựa chọn hoàn hảo dành cho bạn với loạt tiện ích thông minh tích hợp sẵn. Đặc biệt thông qua “sức mạnh” vượt trội của con chip Apple M2 Pro, bạn sẽ được trải nghiệm những trận game đặc sắc hay thỏa sức sáng tạ', 'Chính sách bảo hành của Apple luôn được đánh giá cao trong ngành công nghiệp công nghệ. Với mỗi sản phẩm mà khách hàng mua, Apple cung cấp một thời gian bảo hành hợp lý để đảm bảo sự hài lòng và yên tâm cho khách hàng. Thông thường, thời gian bảo hành của'),
(14, 'iPad Pro 12.9 2021 M1 WiFi 256GB', '2512', 'Ipad', 'https://cdn2.cellphones.com.vn/x358,webp,q100/media/catalog/product/i/p/ipad-pro-12-9-2021-1_1_1.jpg', 'https://cdn2.cellphones.com.vn/x358,webp,q100/media/catalog/product/i/p/ipad-pro-12-9-2021_1_1_3.jpg', 'https://cdn.tgdd.vn/Products/Images/522/238645/Kit/ipad-pro-m1-129-inch-wifi-128gb-2021-bh-org.jpg', 'https://cdn.tgdd.vn/Products/Images/522/238645/Kit/ipad-pro-m1-129-inch-wifi-128gb-2021-bh-n-2.jpg', 78, 4, 'Apple M1 8 nhân', '8GB', '12.9 inches - Tần số quét 120Hz', '40.88Wh', 'Apple iPad Pro 12.9 2021 M1 WiFi 256GB là phiên bản iPad thế hệ kế tiếp mà Apple tung ra trong mùa hè này. Chiếc iPad Pro 12.9 inch 2021 được trang bị mản hình lớn, có tỉ lệ tương phản 1,000,000 : 1, được thiết kế với vẻ ngoài sang trọng, hiện đại,', 'Chính sách bảo hành của Apple luôn được đánh giá cao trong ngành công nghiệp công nghệ. Với mỗi sản phẩm mà khách hàng mua, Apple cung cấp một thời gian bảo hành hợp lý để đảm bảo sự hài lòng và yên tâm cho khách hàng. Thông thường, thời gian bảo hành của'),
(15, 'iPhone 13 128GB', '1689', 'Iphone', 'https://cdn2.cellphones.com.vn/x358,webp,q100/media/catalog/product/1/4/14_1_9_2_9.jpg', 'https://cdn2.cellphones.com.vn/x358,webp,q100/media/catalog/product/1/3/13_4_7_2_7.jpg', 'https://cdn2.cellphones.com.vn/x358,webp,q100/media/catalog/product/1/4/14_1_9_2_9.jpg', 'https://cdn2.cellphones.com.vn/x358,webp,q100/media/catalog/product/1/2/12_3_8_2_8.jpg', 70, 4, 'Apple A15', '4 GB', '6.1 inches - Super Retina XDR OLED\r\n', '3240mAh', 'Về kích thước, iPhone 13 sẽ có 4 phiên bản khác nhau và kích thước không đổi so với series iPhone 12 hiện tại. Nếu iPhone 12 có sự thay đổi trong thiết kế từ góc cạnh bo tròn (Thiết kế được duy trì từ thời iPhone 6 đến iPhone 11 Pro Max) sang thiết kế vuô', 'Chính sách bảo hành của Apple luôn được đánh giá cao trong ngành công nghiệp công nghệ. Với mỗi sản phẩm mà khách hàng mua, Apple cung cấp một thời gian bảo hành hợp lý để đảm bảo sự hài lòng và yên tâm cho khách hàng. Thông thường, thời gian bảo hành của'),
(16, 'Apple Watch SE 2022 44mm', '6750', 'Apple watch', 'https://cdn2.cellphones.com.vn/x358,webp,q100/media/catalog/product/a/p/apple_lte_13_.png', 'https://cdn2.cellphones.com.vn/x358,webp,q100/media/catalog/product/1/_/1_258_2.jpg', 'https://cdn2.cellphones.com.vn/x358,webp,q100/media/catalog/product/2/_/2_248_1.jpg', 'https://cdn2.cellphones.com.vn/x358,webp,q100/media/catalog/product/3/_/3_231_2.jpg', 77, 5, 'Apple S8 SiP', '1GB', 'Retina LTPO OLED (1.000 nits)\r\n', 'Pin Lithium-ion sử dụng đến 18 giờ', 'Apple Watch SE 2022 44mm GPS viền nhôm chính là siêu phẩm với đầy sự tinh tế, hiện đại và đẳng cấp sẽ được nhà Táo cho ra mắt vào tháng 9 năm nay. Với nhiều cập nhật nổi bật về thiết kế, nhiều công nghệ màn hình hiện đại hơn và nhiều tiện ích mở rộng hơn ', 'Chính sách bảo hành của Apple luôn được đánh giá cao trong ngành công nghiệp công nghệ. Với mỗi sản phẩm mà khách hàng mua, Apple cung cấp một thời gian bảo hành hợp lý để đảm bảo sự hài lòng và yên tâm cho khách hàng. Thông thường, thời gian bảo hành của'),
(17, 'iPad mini 6 WiFi 64GB', '1189', 'Ipad', 'https://cdn2.cellphones.com.vn/x358,webp,q100/media/catalog/product/3/_/3_229.jpg', 'https://cdn2.cellphones.com.vn/x358,webp,q100/media/catalog/product/6/8/683-1024_5.jpg', 'https://cdn2.cellphones.com.vn/x358,webp,q100/media/catalog/product/i/p/ipad-mini-6-5.jpg', 'https://cdn2.cellphones.com.vn/x358,webp,q100/media/catalog/product/6/8/683-1024_1_.jpg', 112, 3, 'Apple A15 Bionic 6 nhân', '4 GB', '8.3 inches - IPS LCD', '19.3 Wh', 'Với sự thành công của các thế hệ iPad mini trước iPad mini 6 là sản phẩm kế nhiệm mới với nhiều tính năng hiện kèm nhiều sự nâng cấp đáng chú ý dành cho người dùng trong năm nay. Nếu bạn đang có nhu cầu mua cho mình một chiếc máy tính bảng iPad để phục vụ', 'Chính sách bảo hành của Apple luôn được đánh giá cao trong ngành công nghiệp công nghệ. Với mỗi sản phẩm mà khách hàng mua, Apple cung cấp một thời gian bảo hành hợp lý để đảm bảo sự hài lòng và yên tâm cho khách hàng. Thông thường, thời gian bảo hành của'),
(18, 'iPad 10.2 2021 4G 64GB', '979', 'Ipad', 'https://cdn2.cellphones.com.vn/x358,webp,q100/media/catalog/product/x/_/x_mmas_5.png', 'https://cdn2.cellphones.com.vn/x358,webp,q100/media/catalog/product/i/p/ipad_10.2_1_1.jpg', 'https://cdn2.cellphones.com.vn/x358,webp,q100/media/catalog/product/1/5/1536-1024_1__2_7.jpg', 'https://cdn2.cellphones.com.vn/x358,webp,q100/media/catalog/product/1/5/1536-1024_4__5_7.jpg', 45, 5, 'Apple A13 Bionic (7 nm+)', '4 GB', '10.2 inches - Liquid Retina', '32.4 Wh (~ 8600 mAh)', 'Bên cạnh iPhone 13 , Apple Watch Series 7, thì iPad 10.2 gen 9 là sản phẩm đang nhận được sự quan tâm của cộng đồng, đặc biệt là người hâm mô dòng sản phẩm của nhà Táo. Trong số đó, iPad 10.2 2021 4G 64GB có sức hút lớn do giá thành dự kiến không quá cao ', 'Chính sách bảo hành của Apple luôn được đánh giá cao trong ngành công nghiệp công nghệ. Với mỗi sản phẩm mà khách hàng mua, Apple cung cấp một thời gian bảo hành hợp lý để đảm bảo sự hài lòng và yên tâm cho khách hàng. Thông thường, thời gian bảo hành của'),
(19, 'iPad Gen 10 10.9 inch 2022 Wifi 64GB', '1099', 'Ipad', 'https://cdn2.cellphones.com.vn/x358,webp,q100/media/catalog/product/i/p/ipad-2022-hero-blue-wifi-select.png', 'https://cdn2.cellphones.com.vn/x358,webp,q100/media/catalog/product/3/_/3_303.jpg', 'https://cdn2.cellphones.com.vn/x358,webp,q100/media/catalog/product/4/_/4_260.jpg', 'https://cdn2.cellphones.com.vn/x358,webp,q100/media/catalog/product/5/_/5_219.jpg', 76, 4, 'A14 Bionic', '4 GB', '10.9 inches - IPS LCD', '28.6 Wh (~ 7587 mAh)', 'iPad gen 10 2022 (iPad 10.9 inch) là chiếc máy tính bảng mới nhất sở hữu sức mạnh vô song từ con chip A14 Bionic chạy trên hệ điều hành iPadOS 16. Với thiết kế tối giản đã cải thiện các đường nét để hình ảnh luôn hợp thời trang, chiếc iPad này sẽ cho bạn ', 'Chính sách bảo hành của Apple luôn được đánh giá cao trong ngành công nghiệp công nghệ. Với mỗi sản phẩm mà khách hàng mua, Apple cung cấp một thời gian bảo hành hợp lý để đảm bảo sự hài lòng và yên tâm cho khách hàng. Thông thường, thời gian bảo hành của'),
(20, 'iPad Pro 12.9 inch 2022 M2 Wifi 128GB', '2799', 'Ipad', 'https://cdn2.cellphones.com.vn/x358,webp,q100/media/catalog/product/i/p/ipad-pro-13-select-wifi-spacegray-202210-02_3.jpg', 'https://cdn2.cellphones.com.vn/x358,webp,q100/media/catalog/product/1/_/1_331.jpg', 'https://cdn2.cellphones.com.vn/x358,webp,q100/media/catalog/product/3/_/3_304.jpg', 'https://cdn2.cellphones.com.vn/x358,webp,q100/media/catalog/product/2/_/2_317.jpg', 119, 5, 'Apple M2 8 nhân', '8 GB', '12.9 inches - Liquid Retina', '40.88 Wh (~ 10.835 mAh)', 'Sau iPhone, iPad chính là sản phẩm tiếp theo được Apple cho ra mắt phiên bản 2022. Máy tính bảng iPad Pro 12.9 inch 2022 M2 Wifi được trang bị con chip M2 thế hệ mới, camera chụp ảnh chuyên nghiệp cùng Apple Pencil giúp mang lại cho người dùng những trải ', 'Chính sách bảo hành của Apple luôn được đánh giá cao trong ngành công nghiệp công nghệ. Với mỗi sản phẩm mà khách hàng mua, Apple cung cấp một thời gian bảo hành hợp lý để đảm bảo sự hài lòng và yên tâm cho khách hàng. Thông thường, thời gian bảo hành của'),
(21, 'iPhone 14 256GB', '2229', 'Iphone', 'https://cdn2.cellphones.com.vn/x358,webp,q100/media/catalog/product/p/h/photo_2022-09-28_21-58-51_2.jpg', 'https://cdn2.cellphones.com.vn/x358,webp,q100/media/catalog/product/1/6/16_10_2.png', 'https://cdn2.cellphones.com.vn/x358,webp,q100/media/catalog/product/1/5/15.1_4.png', 'https://cdn2.cellphones.com.vn/x358,webp,q100/media/catalog/product/1/5/15.5_1_2.png', 334, 5, 'Apple A15 Bionic 6 nhân', '\r\n6 GB', '6.1 inches - OLED\r\n', '3279 mAh', 'iPhone 14 phiên bản 256GB chính hãng VN/A có thiết kế 6,1 inch phổ biến, có hệ thống camera kép mới, phát hiện sự cố, dịch vụ an toàn đầu tiên trong ngành điện thoại thông minh với SOS khẩn cấp qua vệ tinh và tuổi thọ pin tốt nhất trên iPhone.', 'Chính sách bảo hành của Apple luôn được đánh giá cao trong ngành công nghiệp công nghệ. Với mỗi sản phẩm mà khách hàng mua, Apple cung cấp một thời gian bảo hành hợp lý để đảm bảo sự hài lòng và yên tâm cho khách hàng. Thông thường, thời gian bảo hành của'),
(22, 'iPhone 14 Plus 128GB', '2159', 'Iphone', 'https://cdn2.cellphones.com.vn/x358,webp,q100/media/catalog/product/p/h/photo_2022-09-28_21-58-48_5.jpg', 'https://cdn2.cellphones.com.vn/x358,webp,q100/media/catalog/product/1/8/18.1.png', 'https://cdn2.cellphones.com.vn/x358,webp,q100/media/catalog/product/1/8/18.2.png', 'https://cdn2.cellphones.com.vn/x358,webp,q100/media/catalog/product/1/8/18.6.png', 336, 4, 'Apple A15 Bionic', '\r\n6 GB', '6.7 inches - Super Retina XDR OLED\r\n', '4325 mAh', 'iPhone 14 Plus sở hữu màn hình Super Retina XDR OLED thiết kế tai thỏ, kích thước 6.7 inch, kết hợp công nghệ True Tone, HDR, Haptic Touch, Không chỉ vậy, sản phẩm còn trang bị chip A15 Bionic mạnh mẽ, RAM 6GB, bộ nhớ trong 128GB và chạy trên hệ điều hành', 'Chính sách bảo hành của Apple luôn được đánh giá cao trong ngành công nghiệp công nghệ. Với mỗi sản phẩm mà khách hàng mua, Apple cung cấp một thời gian bảo hành hợp lý để đảm bảo sự hài lòng và yên tâm cho khách hàng. Thông thường, thời gian bảo hành của'),
(23, 'iPhone 12 64GB', '1439', 'Iphone', 'https://cdn2.cellphones.com.vn/x358,webp,q100/media/catalog/product/1/_/1_252.jpg', 'https://cdn2.cellphones.com.vn/x358,webp,q100/media/catalog/product/1/2/121775005_214053020136993_4215871422753310748_n_1.jpg', 'https://cdn2.cellphones.com.vn/x358,webp,q100/media/catalog/product/i/p/iphone-12-mini-2-do-11_1.jpg', 'https://cdn2.cellphones.com.vn/x358,webp,q100/media/catalog/product/_/0/_0004_iphone_12_green_hero_2-up_cropped_screen__usen.jpg', 447, 5, '\r\nApple A14 Bionic (5 nm)', '4 GB', '6.1 inches - OLED\r\n', 'Li-Ion, sạc nhanh 20W, sạc không dây 15W, USB Power Delivery 2.0', 'iPhone 12 gây ấn tượng với người dùng bởi thiết kế vuông vức quen thuộc, đây là thiết kế đã từng xuất hiện trên thế hệ iPhone 5 trước đó. Điện thoại được hoàn thiện mỏng hơn với cụm camera lớn hơn.\r\n\r\nĐặc biệt, máy được trang bị một khung viền thép không ', 'Chính sách bảo hành của Apple luôn được đánh giá cao trong ngành công nghiệp công nghệ. Với mỗi sản phẩm mà khách hàng mua, Apple cung cấp một thời gian bảo hành hợp lý để đảm bảo sự hài lòng và yên tâm cho khách hàng. Thông thường, thời gian bảo hành của'),
(24, 'iPhone 14 Pro Max 1T', '4179', 'Iphone', 'https://cdn2.cellphones.com.vn/x358,webp,q100/media/catalog/product/v/_/v_ng_23.png', 'https://cdn2.cellphones.com.vn/x358,webp,q100/media/catalog/product/b/_/b_c_1_14.png', 'https://cdn2.cellphones.com.vn/x358,webp,q100/media/catalog/product/v/_/v_ng_23.png', 'https://cdn2.cellphones.com.vn/x358,webp,q100/media/catalog/product/x/_/x_m_28.png', 90, 5, 'Apple A16 Bionic 6 nhân', '6 GB', '6.7 inches - Super Retina XDR OLED\r\n', '4.352 mAh', 'Kích thước màn hình iPhone 14 Pro Max vẫn là 6.7 inch tuy nhiên phần “tai thỏ” đã được thay thế bằng một đường cắt hình viên thuốc. Apple gọi đây là Dynamic Island - nơi chứa camera Face ID và một đường cắt hình tròn thứ hai cho camera trước.\n\nNgoài ra, i', 'Chính sách bảo hành của Apple luôn được đánh giá cao trong ngành công nghiệp công nghệ. Với mỗi sản phẩm mà khách hàng mua, Apple cung cấp một thời gian bảo hành hợp lý để đảm bảo sự hài lòng và yên tâm cho khách hàng. Thông thường, thời gian bảo hành của'),
(25, 'Apple Watch Series 8 41mm GPS viền nhôm', '905', 'Apple watch', 'https://cdn2.cellphones.com.vn/x358,webp,q100/media/catalog/product/1/_/1_267_1.jpg', 'https://cdn2.cellphones.com.vn/x358,webp,q100/media/catalog/product/2/_/2_255_1.jpg', 'https://cdn2.cellphones.com.vn/x358,webp,q100/media/catalog/product/m/p/mp6v3ref_vw_pf_watch-41-alum-silver-nc-8s_vw_pf_wf_co.jpg', 'https://cdn2.cellphones.com.vn/x358,webp,q100/media/catalog/product/a/p/apple_gps_1_.png', 347, 4, 'Apple S8 SiP', '1GB', 'Retina LTPO OLED (1.000 nits)\r\n', 'Pin Lithium-ion sử dụng đến 18 giờ', 'Apple Watch Series 8 41mm vừa được Apple cho ra mắt đã khiến fan công nghệ điêu đứng bởi nhiều tính năng mới trên thiết bị. Không chỉ làm mới thiết kế bên ngoài, sản phẩm còn được cải tiến mạnh mẽ về mặt cấu hình mang đến những trải nghiệm thú vị cho ngườ', 'Chính sách bảo hành của Apple luôn được đánh giá cao trong ngành công nghiệp công nghệ. Với mỗi sản phẩm mà khách hàng mua, Apple cung cấp một thời gian bảo hành hợp lý để đảm bảo sự hài lòng và yên tâm cho khách hàng. Thông thường, thời gian bảo hành của'),
(26, 'Apple Watch Ultra 49mm Viền Titan - Dây cao su', '1889', 'Apple watch', 'https://cdn2.cellphones.com.vn/x358,webp,q100/media/catalog/product/3/_/3_308_1_1.png', 'https://cdn2.cellphones.com.vn/x358,webp,q100/media/catalog/product/2/_/2_338_4.png', 'https://cdn2.cellphones.com.vn/x358,webp,q100/media/catalog/product/1/_/1_362.png', 'https://cdn2.cellphones.com.vn/x358,webp,q100/media/catalog/product/a/p/apple_gps_10_.png', 347, 4, 'Apple S8 SiP', '1GB', 'Retina LTPO OLED (1.000 nits)\r\n', 'Pin Lithium-ion sử dụng đến 18 giờ', 'Apple Watch Ultra 49mm là chiếc đồng hồ cao cấp nhất của nhà Apple, thiết bị Apple Watch Ultrađược thiết kế cực kỳ hầm hố và trang bị hàng loạt các tính năng cao cấp, thể hiện rõ sự sang trọng cho người sử dụng. ', 'Chính sách bảo hành của Apple luôn được đánh giá cao trong ngành công nghiệp công nghệ. Với mỗi sản phẩm mà khách hàng mua, Apple cung cấp một thời gian bảo hành hợp lý để đảm bảo sự hài lòng và yên tâm cho khách hàng. Thông thường, thời gian bảo hành của'),
(27, 'Apple Watch SE 2022 40mm', '629', 'Apple watch', 'https://cdn2.cellphones.com.vn/x358,webp,q100/media/catalog/product/1/_/1_258.jpg', 'https://cdn2.cellphones.com.vn/x358,webp,q100/media/catalog/product/2/_/2_248.jpg', 'https://cdn2.cellphones.com.vn/x358,webp,q100/media/catalog/product/3/_/3_231.jpg', 'https://cdn2.cellphones.com.vn/x358,webp,q100/media/catalog/product/a/p/apple_lte_12_.png', 453, 5, 'Apple S8 SiP', '1GB', 'Retina LTPO OLED (1.000 nits)\r\n', 'Pin Lithium-ion sử dụng đến 18 giờ', 'Tiếp tục là sản phẩm đồng hồ thông minh thuộc phân khúc tầm trung, đồng hồ Apple Watch SE 2022 là phiên bản kế nhiệm Apple Watch SE được ra mắt trước đó. Đồng hồ thông minh Apple Watch SE 2022 được trang bị con chip Apple S8 cùng tính năng ấn tượng như ph', 'Chính sách bảo hành của Apple luôn được đánh giá cao trong ngành công nghiệp công nghệ. Với mỗi sản phẩm mà khách hàng mua, Apple cung cấp một thời gian bảo hành hợp lý để đảm bảo sự hài lòng và yên tâm cho khách hàng. Thông thường, thời gian bảo hành của'),
(28, 'Apple Watch Series 7 45mm Nike Viền nhôm dây cao su', '849', 'Apple watch', 'https://cdn2.cellphones.com.vn/x358,webp,q100/media/catalog/product/m/l/ml833_vw_34fr_watch-41-alum-midnight-nc-nike7s_vw_34fr_wf_co_1.jpg', 'https://cdn2.cellphones.com.vn/x358,webp,q100/media/catalog/product/m/l/ml833_vw_34fr_watch-41-alum-starlight-nc-nike7s_vw_34fr_wf_co_1.jpg', 'https://cdn2.cellphones.com.vn/x358,webp,q100/media/catalog/product/n/i/nike-2_1_1.jpg', 'https://cdn2.cellphones.com.vn/x358,webp,q100/media/catalog/product/a/p/apple_gps_3_.png', 235, 4, 'Apple S8 SiP', '1GB', 'Màn hình luôn bật Retina\r\n', '18 giờ sử dụng', 'Không chỉ là chiếc đồng hồ thông minh thường thấy, Apple Watch Series 7 Nike 45mm viền nhôm bạc dây cao su là sự hợp tác giữa Apple và thương hiệu thể thao Nike để cho ra sản phẩm smartwatch đồng hành cùng bạn trên mọi quá trình', 'Chính sách bảo hành của Apple luôn được đánh giá cao trong ngành công nghiệp công nghệ. Với mỗi sản phẩm mà khách hàng mua, Apple cung cấp một thời gian bảo hành hợp lý để đảm bảo sự hài lòng và yên tâm cho khách hàng. Thông thường, thời gian bảo hành của');

-- --------------------------------------------------------

--
-- Table structure for table `products_of_bill`
--

CREATE TABLE `products_of_bill` (
  `Bill_ID` int(11) NOT NULL,
  `Product_ID` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `customerID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products_of_bill`
--

INSERT INTO `products_of_bill` (`Bill_ID`, `Product_ID`, `amount`, `customerID`) VALUES
(1, 1, 1, 14),
(1, 1, 1, 19),
(2, 1, 10, 14),
(3, 1, 4, 14),
(4, 1, 1, 14),
(4, 2, 1, 14),
(5, 12, 1, 14);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`indx`),
  ADD KEY `customerID` (`customerID`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customerID` (`customerID`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`indx`),
  ADD KEY `customerID` (`customerID`),
  ADD KEY `productID` (`productID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `adminID` (`active`);

--
-- Indexes for table `keep`
--
ALTER TABLE `keep`
  ADD KEY `cartID` (`cartID`),
  ADD KEY `productID` (`productID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_of_bill`
--
ALTER TABLE `products_of_bill`
  ADD PRIMARY KEY (`Bill_ID`,`Product_ID`,`customerID`),
  ADD KEY `customerID` (`customerID`),
  ADD KEY `Product_ID` (`Product_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bill`
--
ALTER TABLE `bill`
  MODIFY `indx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `indx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bill`
--
ALTER TABLE `bill`
  ADD CONSTRAINT `bill_ibfk_1` FOREIGN KEY (`customerID`) REFERENCES `customer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`customerID`) REFERENCES `customer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`customerID`) REFERENCES `customer` (`id`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`productID`) REFERENCES `products` (`id`);

--
-- Constraints for table `keep`
--
ALTER TABLE `keep`
  ADD CONSTRAINT `keep_ibfk_1` FOREIGN KEY (`cartID`) REFERENCES `cart` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `keep_ibfk_3` FOREIGN KEY (`productID`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `keep_ibfk_4` FOREIGN KEY (`productID`) REFERENCES `products` (`id`);

--
-- Constraints for table `products_of_bill`
--
ALTER TABLE `products_of_bill`
  ADD CONSTRAINT `products_of_bill_ibfk_1` FOREIGN KEY (`Bill_ID`) REFERENCES `bill` (`id`),
  ADD CONSTRAINT `products_of_bill_ibfk_2` FOREIGN KEY (`customerID`) REFERENCES `customer` (`id`),
  ADD CONSTRAINT `products_of_bill_ibfk_3` FOREIGN KEY (`Product_ID`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
