-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3306
-- Thời gian đã tạo: Th5 30, 2022 lúc 06:55 PM
-- Phiên bản máy phục vụ: 10.4.19-MariaDB
-- Phiên bản PHP: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `cosmeticsnew`
--

DELIMITER $$
--
-- Thủ tục
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `chitietblog` (IN `id_blog` INT(200))  SELECT * FROM blogs where blog_id=id_blog$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `chitietlichsumua` (IN `h` VARCHAR(200))  SELECT transactions.magiaodich,products.product_title,transactions.quality,transactions.ngaythang FROM transactions,user,products WHERE transactions.product_id=products.product_id AND user.id=transactions.id AND transactions.magiaodich=h$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `chitietsanpham` (IN `pro_id` INT(200))  SELECT * FROM products where product_id= pro_id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `dsspdocquyen` ()  SELECT * FROM products where sukien = 'exclusivity'$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_insert_category` (IN `product_title_` VARCHAR(255))  INSERT INTO categories (categories.cat_title)
VALUES (product_title_)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_insert_product` (IN `product_cat_` INT(100), IN `product_title_` VARCHAR(255), IN `product_price_` INT(100), IN `product_desc_` TEXT, IN `product_image_` TEXT, IN `phantram_` INT(100), IN `product_keywords_` VARCHAR(255), IN `sukien_` VARCHAR(100))  INSERT INTO products(products.product_cat, products.product_title, products.product_price, products.product_desc, products.product_image, products.phantram, products.product_keywords, products.sukien)
value(product_cat_, product_title_, product_price_, product_desc_, product_image_, phantram_, product_keywords_, sukien_)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_update_pr` (IN `product_cat_` INT(100), IN `product_title_` VARCHAR(255), IN `product_price_` INT(100), IN `product_sale_` INT(100), IN `product_desc_` TEXT, IN `product_image_` TEXT, IN `sukien_` VARCHAR(100), IN `product_keywords_` VARCHAR(255), IN `phantram_` INT(100), IN `date_` VARCHAR(150), IN `get_pro_id_` INT(100))  UPDATE products set products.product_cat = product_cat_, products.product_title =product_title_, products.product_price=product_price_, products.product_sale=product_sale_, products.product_desc=product_desc_,
products.product_image=product_image_, products.sukien=sukien_, products.product_keywords = product_keywords_,
products.phantram=phantram_, products.date= date_ where products.product_id = get_pro_id_$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `viewblog` ()  SELECT * FROM blogs$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `xemlichsudatmua` (IN `id_user` INT(100))  SELECT * FROM transactions WHERE transactions.id= id_user GROUP BY transactions.magiaodich$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Xuatsanphamtheodm` (IN `cat_id` INT(255))  SELECT * FROM products where product_cat = cat_id$$

--
-- Các hàm
--
CREATE DEFINER=`root`@`localhost` FUNCTION `SUM_Contact` () RETURNS INT(11) RETURN (select COUNT(*) from contacts where contact_id >0)$$

CREATE DEFINER=`root`@`localhost` FUNCTION `sum_quality_cart` () RETURNS INT(100) RETURN (SELECT SUM(quality)FROM cart )$$

CREATE DEFINER=`root`@`localhost` FUNCTION `Tong_user` () RETURNS INT(100) RETURN (select COUNT(*) from user where role = 'guest')$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `banners`
--

CREATE TABLE `banners` (
  `banner_id` int(100) NOT NULL,
  `banner_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `banner_upto` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `banner_image` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `banners`
--

INSERT INTO `banners` (`banner_id`, `banner_title`, `banner_upto`, `banner_image`) VALUES
(1, 'cosmetics for women', 'upto 50% off', 'gallery-img-5.jpeg'),
(2, 'Happy New Year', 'upto 50% off', 'Kerfin7_NEA_2502.jpg'),
(3, 'cosmetics for new', 'upto 50% off', '5860451.jpg'),
(4, 'cosmetics for men', 'upto 50% off', 'christian-buehner-DItYlc26zVI-unsplash.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `blogs`
--

CREATE TABLE `blogs` (
  `blog_id` int(100) NOT NULL,
  `blog_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `blog_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `blog_image` text COLLATE utf8_unicode_ci NOT NULL,
  `blog_date` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `blog_content` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `blogs`
--

INSERT INTO `blogs` (`blog_id`, `blog_title`, `blog_desc`, `blog_image`, `blog_date`, `blog_content`) VALUES
(1, 'brand\'s makeup remover!', 'NO, because rose water does not remove makeup...', 'blog-2.jpg', 'February 2, 2022', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum molestias rerum numquam,quos aut est culpa quisquam excepturi sed a inventore dicta tempore consequuntur possimus magnam corporis cum doloremque quasi fugiat exercitationem aliquid cupiditate pariatur. Dolor laboriosam  voluptatem ex praesentium magni error debitis maxime alias autem distinctio. Fuga, esse velit!</br>\r\n</br>\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Architecto, reiciendis fugiat quas nemo quia omnis repellat \r\nobcaecati quaerat voluptates fuga error dicta cupiditate pariatur soluta dolorum quis eum quibusdam quam?\r\n</br>\r\n</br>\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Architecto, reiciendis fugiat quas nemo quia omnis repellat \r\nobcaecati quaerat voluptates fuga error dicta cupiditate pariatur soluta dolorum quis eum quibusdam quam?\r\n</br>\r\n</br>\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Architecto, reiciendis fugiat quas nemo quia omnis repellat \r\nobcaecati quaerat voluptates fuga error dicta cupiditate pariatur soluta dolorum quis eum quibusdam quam?\r\n</br>\r\n</br>\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Architecto, reiciendis fugiat quas nemo quia omnis repellat \r\nobcaecati quaerat voluptates fuga error dicta cupiditate pariatur soluta dolorum quis eum quibusdam quam?\r\n'),
(2, 'anti-aging cosmetics', 'Method: wash bitter melon and put it in the freezer for about 15 minutes....', 'blog-1.jpg', '11st September, 2021', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum molestias rerum numquam,quos aut est culpa quisquam excepturi sed a inventore dicta tempore consequuntur possimus magnam corporis cum doloremque quasi fugiat exercitationem aliquid cupiditate pariatur. Dolor laboriosam  voluptatem ex praesentium magni error debitis maxime alias autem distinctio. Fuga, esse velit!</br>\r\n</br>\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Architecto, reiciendis fugiat quas nemo quia omnis repellat obcaecati quaerat voluptates fuga error dicta cupiditate pariatur soluta dolorum quis eum quibusdam quam?\r\n</br>\r\nMethod: wash bitter melon and put it in the freezer for about 15 minutes. Then, slice it thinly and apply it on your face, then gently enjoy the refreshing feeling of the mask.\r\n\r\nTomato\r\n\r\nSkin gradually becomes rosy, bright and smooth thanks to tomato mask which is both simple and economical but remarkably effective. The simplest is to thinly slice tomatoes and apply on the face to help whiten and pink skin. In addition, you can squeeze tomatoes to get water, add a few drops of lemon juice, and then apply this mixture on your face, the result is white skin, shrinking pores.\r\n\r\nMint leaf\r\n\r\nQuite surprising because in addition to being used a lot for health, mint is also present in the secrets of skin beauty such as reducing acne, whitening skin, blurring wrinkles... Very simply, just a handful of mint leaves pureed, Apply on your face after 20 minutes, rinse with clean water, you will feel your skin is smoother and cooler.\r\n\r\nIn other words, blogging is the first step toward finally pursuing your dream job or favorite hobby, so you really can’t go wrong. While starting a blog might seem daunting, I’m going to walk you through every step to make it as smooth as possible. The process is actually quite easy, and you’ll have your blog up and running before you know it.\r\n</br>\r\nMethod: wash bitter melon and put it in the freezer for about 15 minutes. Then, slice it thinly and apply it on your face, then gently enjoy the refreshing feeling of the mask.\r\n\r\nTomato\r\n\r\nSkin gradually becomes rosy, bright and smooth thanks to tomato mask which is both simple and economical but remarkably effective. The simplest is to thinly slice tomatoes and apply on the face to help whiten and pink skin. In addition, you can squeeze tomatoes to get water, add a few drops of lemon juice, and then apply this mixture on your face, the result is white skin, shrinking pores.\r\n\r\nMint leaf\r\n\r\nQuite surprising because in addition to being used a lot for health, mint is also present in the secrets of skin beauty such as reducing acne, whitening skin, blurring wrinkles... Very simply, just a handful of mint leaves pureed, Apply on your face after 20 minutes, rinse with clean water, you will feel your skin is smoother and cooler.\r\n\r\nIn other words, blogging is the first step toward finally pursuing your dream job or favorite hobby, so you really can’t go wrong. While starting a blog might seem daunting, I’m going to walk you through every step to make it as smooth as possible. The process is actually quite easy, and you’ll have your blog up and running before you know it.'),
(3, 'Kill death celk', 'Familiar with a variety of dishes made from chicken eggs, but ....', 'banner1.jpg', '21st September, 2021', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum molestias rerum numquam,quos aut est culpa quisquam excepturi sed a inventore dicta tempore consequuntur possimus magnam corporis cum doloremque quasi fugiat exercitationem aliquid cupiditate pariatur. Dolor laboriosam  voluptatem ex praesentium magni error debitis maxime alias autem distinctio. Fuga, esse velit!</br>\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Architecto, reiciendis fugiat quas nemo quia omnis repellat obcaecati quaerat voluptates fuga error dicta cupiditate pariatur soluta dolorum quis eum quibusdam quam?\r\n</br>\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Earum molestias rerum numquam,quos aut est culpa quisquam excepturi sed a inventore dicta tempore consequuntur possimus magnam corporis cum doloremque quasi fugiat exercitationem aliquid cupiditate pariatur. Dolor laboriosam  voluptatem ex praesentium magni error debitis maxime alias autem distinctio. Fuga, esse velit!</br>\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Architecto, reiciendis fugiat quas nemo quia omnis repellat obcaecati quaerat voluptates fuga error dicta cupiditate pariatur soluta dolorum quis eum quibusdam quam?\r\n</br>\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Earum molestias rerum numquam,quos aut est culpa quisquam excepturi sed a inventore dicta tempore consequuntur possimus magnam corporis cum doloremque quasi fugiat exercitationem aliquid cupiditate pariatur. Dolor laboriosam  voluptatem ex praesentium magni error debitis maxime alias autem distinctio. Fuga, esse velit!</br>\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Architecto, reiciendis fugiat quas nemo quia omnis repellat obcaecati quaerat voluptates fuga error dicta cupiditate pariatur soluta dolorum quis eum quibusdam quam?\r\n'),
(4, 'Where can I get some?', 'There are many variations of passages of Lorem Ipsum available......', 'banner7.jpg', 'December 2, 2021', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.\r\n</br>\r\nThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.\r\n<br>\r\nThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.'),
(5, 'Where does it come from?', 'Contrary to popular belief, Lorem Ipsum is not simply random text....', 'blog-5.jpg', 'October 20, 2021', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.\r\n</br>\r\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.\r\n</br>\r\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.'),
(6, 'Why do we use it?', 'It is a long established fact that a reader will be distracted by .....', 'main2.jpg', '21st September, 2021', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).\r\n</br>\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).\r\n</br>\r\n</br>\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `product_id` int(100) NOT NULL,
  `product_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `quality` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `cart`
--

INSERT INTO `cart` (`cart_id`, `product_id`, `product_title`, `ip_address`, `quality`) VALUES
(395, 48, ' Aerin', '::1', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(100) NOT NULL,
  `cat_title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`, `visible`) VALUES
(1, 'Skin care', 1),
(2, 'Entire care', 1),
(3, 'Hair care', 1),
(4, 'Perfume', 1),
(5, 'Accessory', 1),
(17, 'Make up', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `contacts`
--

CREATE TABLE `contacts` (
  `contact_id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `day` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `gallerys`
--

CREATE TABLE `gallerys` (
  `gallery_id` int(100) NOT NULL,
  `gallery_image` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `gallerys`
--

INSERT INTO `gallerys` (`gallery_id`, `gallery_image`) VALUES
(1, 'gall_ (1).jpg'),
(2, 'gall_ (2).jpg'),
(3, 'gall_ (3).jpg'),
(4, 'gall_ (4).jpg'),
(5, 'gall_ (5).jpg'),
(6, 'gall_ (6).jpg'),
(7, 'lindsey-savage-p4vru5GkP6s-unsplash.jpg'),
(8, 'jacinta-christos-4wO5GON3mg4-unsplash.jpg'),
(9, 'ruijia-wang-K1IlF2yYX8Q-unsplash.jpg'),
(10, 'mariah-hewines-EIq4OSi7F_k-unsplash.jpg'),
(11, 'camille-paralisan-LgoehzzFAMA-unsplash.jpg'),
(12, 'lucas-mendes-CyfmSpqNMD8-unsplash.jpg'),
(13, 'vizzela-cosmeticos-Lhq7OvsE2Cw-unsplash.jpg'),
(14, 'trinh-minh-th-h4cM5JQmxoQ-unsplash.jpg'),
(15, 'jess-harper-sunday-SzpzAJ88YvI-unsplash.jpg'),
(16, 'lume-wellness-_HXI367NQrs-unsplash.jpg'),
(17, 'michela-ampolo-7tDGb3HrITg-unsplash.jpg'),
(18, 'neauthy-skincare-8ZKwW-2SR28-unsplash.jpg'),
(19, 'alexandra-tran-_ieSbbgr3_I-unsplash.jpg'),
(20, 'alex-azabache-mAbw5wxP2I8-unsplash.jpg'),
(21, 'alina-rubo-LZ58cbdEnD0-unsplash.jpg'),
(22, 'thoa-ngo-dKI7fKu-qu0-unsplash.jpg'),
(23, 'jess-harper-sunday-Zl_I43sJHh4-unsplash.jpg'),
(24, 'lumin-vI6H47wyOGY-unsplash.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `history`
--

CREATE TABLE `history` (
  `id_history` int(100) NOT NULL,
  `product_title` varchar(255) NOT NULL,
  `product_price` int(100) NOT NULL,
  `product_image` text NOT NULL,
  `activate` varchar(255) NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `history`
--

INSERT INTO `history` (`id_history`, `product_title`, `product_price`, `product_image`, `activate`, `time`) VALUES
(30, 'NIKE', 4200, 'banner2.jpg', 'Created', '2022-05-30 10:12:22'),
(31, 'NIKE', 4200, 'banner2.jpg', 'Created', '2022-05-30 10:13:17'),
(32, 'Herbal Shampoo ', 3400, 'dan-farrell-CpTbMyO2CcM-unsplash.jpg', 'Updated', '2022-05-30 10:34:39');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `likes`
--

CREATE TABLE `likes` (
  `like_id` int(11) NOT NULL,
  `product_id` int(100) NOT NULL,
  `product_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `product_id` int(100) NOT NULL,
  `quality` int(11) NOT NULL,
  `mahang` varchar(50) NOT NULL,
  `id` int(100) NOT NULL,
  `ngaythang` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `tinhtrang` int(11) NOT NULL,
  `huydon` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`order_id`, `product_id`, `quality`, `mahang`, `id`, `ngaythang`, `tinhtrang`, `huydon`) VALUES
(106, 38, 3, '9728', 1, '2022-05-26 03:54:10', 0, 0),
(107, 46, 8, '9096', 2, '2022-05-26 04:12:13', 1, 0),
(108, 38, 7, '8059', 3, '2022-05-26 04:32:57', 1, 0),
(109, 55, 7, '8059', 3, '2022-05-26 04:32:57', 1, 0),
(110, 53, 4, '4378', 4, '2022-05-26 14:49:23', 0, 0),
(111, 32, 3, '3775', 2, '2022-05-26 15:15:43', 0, 0),
(112, 46, 1, '3775', 2, '2022-05-26 15:15:43', 0, 0),
(113, 56, 3, '3775', 2, '2022-05-26 15:15:43', 0, 0),
(114, 49, 1, '3775', 2, '2022-05-26 15:15:43', 0, 0),
(115, 48, 1, '3248', 2, '2022-05-27 15:11:14', 0, 0),
(116, 51, 3, '3248', 2, '2022-05-27 15:11:14', 0, 0),
(117, 43, 2, '935', 2, '2022-05-30 16:01:35', 0, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `product_id` int(100) NOT NULL,
  `product_cat` int(100) NOT NULL,
  `product_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_price` int(100) NOT NULL,
  `product_sale` int(100) NOT NULL,
  `product_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `product_image` text COLLATE utf8_unicode_ci NOT NULL,
  `phantram` int(100) NOT NULL,
  `product_keywords` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `views` int(11) NOT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT 1,
  `date` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `sukien` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `qualitys` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`product_id`, `product_cat`, `product_title`, `product_price`, `product_sale`, `product_desc`, `product_image`, `phantram`, `product_keywords`, `views`, `visible`, `date`, `sukien`, `qualitys`) VALUES
(30, 1, 'Biotherm', 2600, 3250, 'is safe, easy to use, and highly effective, making your skin firmer, smoother and full of life.', 'sanpham (4) - Copy.jpg', 20, 'Biotherm,b.B,S', 0, 1, '', 'exclusivity\r\n', 20),
(31, 1, 'Ultrahydrate Serum', 4200, 5250, 'Eight moisture magnets quench and soothe ..', 'sanpham (10) - Copy.jpg', 20, 'Ultrahydrate Serum,U,S', 0, 1, '', 'new', 50),
(32, 1, 'Glossler', 1800, 2250, 'A cool, quivery cleanser that dissolves makeup and hydrates like a night cream and smells like dreamy rose water', 'reuben-mansell-oFgXybl7z3E-unsplash.jpg', 20, 'Glossler ,s,G', 0, 1, '', 'new', 47),
(33, 1, 'Pharmaceris', 3800, 4750, '- Reduces wrinkles and prevents aging, prevents the formation of melanin causing darkening and pigmentation.</br> \r\n- Skin feels cool and smooth already.', 'sanpham (8) - Copy.jpg', 20, 'Pharmaceris,s,P', 0, 1, '', 'new', 0),
(34, 1, 'Not Pot ', 4400, 5500, 'Asian cosmetic technology </br>\r\nLift skin tone, tighten shine, moisturize skin', 'sanpham (3) - Copy.jpg', 20, 'Not Pot ,4000,skin,N', 0, 1, '', 'new', 50),
(35, 1, 'Sterillium', 2200, 2750, 'The collection included the following items: Vitamin C Face Cleanser, Witch Hazel Toner , Hyaluronic Acid Gel Moisturizer, Caffeine Eye Cream, Peptides Moisturizer,Retinol Night Serum', 'waldemar-brandt-cAnOxOnm_lg-unsplash.jpg', 20, 'Sterillium,2200,S', 0, 1, '', 'exclusivity', 40),
(36, 1, 'Hyaluronic Acid', 3600, 4500, 'Weight: 30g </br>\r\nEnsure the skin is sufficiently hydrated, significantly reduce wrinkles despite deep wrinkles, prevent skin aging, and retain youthful youthful skin.', 'ana-nogrey-pdFdD7nBmtU-unsplash.jpg', 20, 'Hyaluronic Acid,S,3600', 0, 1, '', 'exclusivity', 50),
(37, 2, 'Hand Cream', 1800, 2250, 'Korean hand care will help you always have soft, smooth hands, relieve pain, Heal wounds, connect happiness', 'irene-kredenets-JleKjX_A5Xg-unsplash.jpg', 20, 'Hand Cream,Ent.1800', 0, 1, '', 'exclusivity', 50),
(38, 2, 'Body Whitening', 4000, 5000, 'Super White Body Cream gives natural pink and white skin, Body Cream always helps women be confident with their smooth beautiful skin right after using the cream.', 'maddi-bazzocco-UKGGgWb6_0g-unsplash.jpg', 20, 'Body Whitening Cream ,400,Entr', 0, 1, '', 'exclusivity', 40),
(39, 2, 'Household Supply ', 4600, 5750, 'Balance moisture, nourish for healthy, smooth skin and significantly improve skin tone- Nourish and restore skin problems caused by harmful UV rays and environmental pollution', 'sanpham (6) - Copy.jpg', 20, 'Household Supply ,4600,E,H', 0, 1, '', 'exclusivity', 32),
(40, 2, 'Necessalre', 2600, 3250, 'Helps to soften skin outstandingly, limiting all conditions of dryness and flaking. Especially suitable for dry, cracked skin conditions. Keep your skin softer and smoother.', 'mathilde-langevin-p3O5f4u95Lo-unsplash (1).jpg', 20, 'Necessalre,N,E,2600', 0, 1, '', 'exclusivity', 40),
(41, 3, 'Deep Conditioning', 2500, 3125, 'Set Salerm Cosmetics KAPS Filler Smoothing Therapy 6-PIECE Professional Kit (w / Sleek Comb) Kap + Ceramides + Keratin (PRO KIT) </br>\r\nMoisturizes the hair from the inside to prolong the straight hair effect.', 'tyler-nix-Y2qEkl4Nt_E-unsplash.jpg', 20, 'Deep Conditioning,Hai,2500,D', 0, 1, '', '20% off', 0),
(43, 3, 'Herbal Shampoo ', 3400, 4250, 'As a completely natural shampoo, it is also especially suitable for permed & dyed hair. Products to help keep DYED HAIR COLOR AND CREATE GOOD CLEANING HAIR, LONG HAIR', 'dan-farrell-CpTbMyO2CcM-unsplash.jpg', 20, 'Herbal Shampoo ,4600,Hai', 0, 1, '', '20% off', 38),
(44, 4, 'Chanel Coco Noir ', 4400, 5500, 'ChanelOriginFrance </br>\r\nIs A New Product Of Channel Perfume Line. Very suitable for Sexy, Personality Women', 'sanpham (2) - Copy.jpg', 20, 'Chanel Coco Noir ,pe,4400', 0, 1, '', '20% off', 40),
(45, 4, ' Gabrielle Chanel ', 4200, 5250, '- Infused with femininity, GABRIELLE CHANEL ESSENCE is the scent of a radiant woman full of life. </br>\r\n- Create a mild fragrance suitable for teenagers', 'laura-chouette-cL1axglwutA-unsplash.jpg', 20, ' Gabrielle Chanel .p,G,4200', 0, 1, '', '20% off', 45),
(46, 4, 'N5 Chanel ', 6600, 8250, 'Chanel No.5 scent has a strange mysterious charm, all thanks to the \"elaborate\" in the process of refining and producing Chanel No.5. </br>\r\nThe fragrance is more modern, more seductive, more delicate', 'laura-chouette-mliJtIEoxaY-unsplash.jpg', 20, 'N5 Chanel ,Pe,6600', 0, 1, '', '20% off', 69),
(47, 4, 'Tommy Girl', 3400, 4250, 'Tommy Girl Perfume Classic Fragrance</br> \r\nThis item is about 95% full.', 'klim-musalimov-92kIaT5A-W0-unsplash.jpg', 20, 'Tommy Girl,3400,T,p', 0, 1, '', '20% off', 56),
(48, 4, ' Aerin', 6600, 8250, 'AERIN Collection perfume Estee Lauder \r\n\r\nColor classification: - Mediterranean - Water lily', 'won-young-park--0V1RB9X-6o-unsplash.jpg', 20, ' Aerin,6600,A,P', 0, 1, '', '20% off', 44),
(49, 4, 'No5 Chane', 4600, 5750, 'Chanel No.5 scent has a strange mysterious charm, all thanks to the \"elaborate\" in the process of refining and producing Chanel No.5. </br>\r\nThe fragrance is more modern, more seductive, more delicate', 'sanpham (9) - Copy.jpg', 20, 'No5 Chane,4600,P', 0, 1, '', 'new', 67),
(50, 4, 'Gabrielle Chanel Paris ', 4200, 5250, '- Infused with femininity, GABRIELLE CHANEL ESSENCE is the scent of a radiant woman full of life. </br>\r\n- Create a mild fragrance suitable for teenagers', 'olena-sergienko-GOVTETevRm8-unsplash.jpg', 20, 'Gabrielle Chanel Paris ,Pe,4200', 0, 1, '', '20% off', 46),
(51, 4, 'Acquadi Gio', 1800, 2250, 'Versace Colognes - Versace, the Dreamer, is an innovative clear and smooth blend between wild and aromatic plants including juniper, mugwort, and tarragon.', 'austin-wilcox-iikGwBbxQhs-unsplash (1).jpg', 20, 'Acquadi Gio ,Perfume,1800', 0, 1, '', '20% off', 43),
(52, 5, 'Tube Makeup Set', 7800, 9750, 'Stored separately in the box and with its own plug, neat but very hygienic, not afraid of dust. Suitable for girls who practice makeup or travel very compact.', 'amy-shamblen-xwM61TPMlYk-unsplash.jpg', 20, 'Tube Makeup Set,Accessory,7800,T,t', 0, 1, '', 'new', 0),
(53, 5, ' Massage ', 2000, 2500, 'Convenient eyebrow brush.Multi-function design.The brush body fits the hand, easy to use. \r\n\r\n', 'content-pixie-0z4h9qneDMA-unsplash.jpg', 20, ' Massage ,Acces,2000,M', 0, 1, '', 'new', 50),
(54, 5, 'Make up Pouch ', 3600, 4500, 'bag used to store cosmetics, some beauty accessoriesNice design, good quality, good looking', 'laura-chouette-O8v_AQ-DI2w-unsplash.jpg', 20, 'Make up Pouch ,Acce,3600', 0, 1, '', 'new', 55),
(55, 5, 'Wilkinson Sword', 2400, 3000, 'Wilkinson Sword Classic Premium Vintage Edition with men\'s shaving soap, shaving brush. </br>\r\nThe Premium Classic Safety Razor with its stainless steel look impresses with its classy look and butterfly mechanism for inserting the blade.', 'jordan-nix-QanhCEMlSdk-unsplash.jpg', 20, 'Wilkinson Sword,Accessory,2400', 0, 1, '', 'exclusivity', 50),
(56, 17, 'Lancome', 4200, 5250, 'Luxuriously designed like iridescent gold bars, bringing good luck and hope to start the year brilliantly.', 'amanda-dalbjorn-t7WrWaewbtw-unsplash.jpg', 20, 'Lancome,4200,Make', 0, 1, '', 'exclusivity', 75),
(57, 17, 'Velvet', 4800, 6000, 'Luxuriously designed like iridescent gold bars, bringing good luck and hope to start the year brilliantly.', 'sandi-benedicta-dukV-jtyRlg-unsplash.jpg', 20, 'Velvet,Make ,4800', 0, 1, '', 'exclusivity', 68),
(58, 17, 'Eye Palette ', 6400, 8000, 'color requirements for girls from neutral to dramatic, the emulsion also gradually increases from light to bright.', 'evangeline-sarney-EyrjiJAwLjQ-unsplash.jpg', 20, 'Eye Palette ,6400,Make', 0, 1, '', 'exclusivity', 60),
(59, 17, 'Mascara TFS.GOLD', 3800, 4750, 'Mascara gives the effect of double lash thickening and supports curling. </br>\r\nSpecially designed repair brush works to repair and prevent local conditions.', 'sanpham (7) - Copy.jpg', 20, 'Mascara TFS.GOLD,Make,M,3800', 0, 1, '', 'exclusivity', 0),
(71, 1, 'Curology', 4200, 0, 'Curology has helped tens of thousands of people clear their skin. But letâ€™s be real â€” thereâ€™s no magic bullet.\r\n\r\n93% of our customers agree: Curology is effective*. Thatâ€™s why we do what we do. We believe in clear, confident skin for all.', 'curology-X1sIr53DhzA-unsplash.jpg', 20, 'Curology,4200,C', 0, 1, '', 'exclusivity', 57),
(76, 2, 'GUCCI GLASSES 67', 6200, 0, 'fhfhhfhhf', 'banner5.jpg', 23, 'GUCCI GLASSES 57', 0, 1, 'May 28, 22', '34', 45),
(77, 1, 'Herbal', 6700, 0, 'ghjhk', 'banner2.jpg', 23, 'GLASSES,GUCCI', 0, 1, 'May 28, 22', 'exclusivity', 45),
(81, 2, '1321', 4224143, 0, '113', 'sdtet', 1313, 'tewt', 0, 1, '', 'setwe', 0),
(82, 3, '213', 113, 0, '221', '313', 12, 'dgat', 0, 1, '', 'ádad', 0),
(83, 4, 'rưerwe', 23, 0, 'sgtsagaHG', 'GHFDSHS', 234, 'srfwstwet', 0, 1, '', 'ssfgsfs', 0),
(84, 3, 'NIKE', 4200, 0, 'hrtsdyhsry', 'banner2.jpg', 23, 'rá»§uywr7yu', 0, 1, '', '34', 0),
(85, 3, 'NIKE', 4200, 0, 'hrtsdyhsry', 'banner2.jpg', 23, 'rá»§uywr7yu', 0, 1, '', '34', 0);

--
-- Bẫy `products`
--
DELIMITER $$
CREATE TRIGGER `history_deleted_pro` BEFORE DELETE ON `products` FOR EACH ROW INSERT INTO history VALUES (null,OLD.product_title,OLD.product_price,OLD.product_image,'Deleted',NOW())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `history_insert_pro` AFTER INSERT ON `products` FOR EACH ROW INSERT INTO history VALUES (null,NEW.product_title,NEW.product_price,NEW.product_image,'Created',NOW())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `history_update_pro` AFTER UPDATE ON `products` FOR EACH ROW INSERT INTO history VALUES (null,NEW.product_title,NEW.product_price,NEW.product_image,'Updated',NOW())
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` int(11) NOT NULL,
  `product_id` int(100) NOT NULL,
  `quality` int(11) NOT NULL,
  `magiaodich` varchar(50) NOT NULL,
  `ngaythang` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id` int(100) NOT NULL,
  `tinhtrangdon` int(11) NOT NULL DEFAULT 0,
  `huydon` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `transactions`
--

INSERT INTO `transactions` (`transaction_id`, `product_id`, `quality`, `magiaodich`, `ngaythang`, `id`, `tinhtrangdon`, `huydon`) VALUES
(107, 38, 3, '9728', '2022-05-26 03:54:10', 1, 0, 0),
(108, 46, 8, '9096', '2022-05-26 04:12:13', 2, 1, 0),
(109, 38, 7, '8059', '2022-05-26 04:32:57', 3, 1, 0),
(110, 55, 7, '8059', '2022-05-26 04:32:57', 3, 1, 0),
(111, 53, 4, '4378', '2022-05-26 14:49:23', 4, 0, 0),
(112, 32, 3, '3775', '2022-05-26 15:15:43', 2, 0, 0),
(113, 46, 1, '3775', '2022-05-26 15:15:43', 2, 0, 0),
(114, 56, 3, '3775', '2022-05-26 15:15:43', 2, 0, 0),
(115, 49, 1, '3775', '2022-05-26 15:15:43', 2, 0, 0),
(116, 48, 1, '3248', '2022-05-27 15:11:14', 2, 0, 0),
(117, 51, 3, '3248', '2022-05-27 15:11:14', 2, 0, 0),
(118, 43, 2, '935', '2022-05-30 16:01:35', 2, 0, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `id` int(100) NOT NULL,
  `ip_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact` text COLLATE utf8_unicode_ci NOT NULL,
  `user_address` text COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'guest',
  `visible` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id`, `ip_address`, `name`, `email`, `password`, `country`, `city`, `contact`, `user_address`, `image`, `role`, `visible`) VALUES
(1, '::1', 'jack', 'jack@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', NULL, NULL, '9057994656', '12 ngo van so, 156 nguyen tat thanj', 'pic-5.png', 'admin', 1),
(2, '::1', 'Nhi', 'Nhi@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', NULL, NULL, '9057994656', '12 ngo van so, 156 nguyen tat thanj', 'pic-6.png', 'guest', 1),
(3, '::1', 'tin', 'nguyenduccay123@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', NULL, NULL, '9057994656', '12 ngo van so, 156 nguyen tat thanj', 'pic-1.png', 'guest', 1),
(4, '::1', 'ozi', 'ozin@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', NULL, NULL, '9057994656', '12 ngo van so', 'pic-3.png', 'guest', 1);

-- --------------------------------------------------------

--
-- Cấu trúc đóng vai cho view `v_contact`
-- (See below for the actual view)
--
CREATE TABLE `v_contact` (
`contact_id` int(100)
,`user_id` int(100)
,`name` varchar(255)
,`email` varchar(255)
,`phone` varchar(255)
,`address` text
,`message` text
,`day` timestamp
,`image` varchar(255)
);

-- --------------------------------------------------------

--
-- Cấu trúc cho view `v_contact`
--
DROP TABLE IF EXISTS `v_contact`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_contact`  AS SELECT `contacts`.`contact_id` AS `contact_id`, `contacts`.`user_id` AS `user_id`, `contacts`.`name` AS `name`, `contacts`.`email` AS `email`, `contacts`.`phone` AS `phone`, `contacts`.`address` AS `address`, `contacts`.`message` AS `message`, `contacts`.`day` AS `day`, `user`.`image` AS `image` FROM (`contacts` left join `user` on(`contacts`.`user_id` = `user`.`id`)) ORDER BY `contacts`.`contact_id` DESC ;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`blog_id`);

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `product_id` (`product_id`,`ip_address`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Chỉ mục cho bảng `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`contact_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `gallerys`
--
ALTER TABLE `gallerys`
  ADD PRIMARY KEY (`gallery_id`);

--
-- Chỉ mục cho bảng `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id_history`);

--
-- Chỉ mục cho bảng `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`like_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `product_id_2` (`product_id`),
  ADD KEY `ip_address` (`ip_address`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `product_id` (`product_id`,`id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `product_cat` (`product_cat`);

--
-- Chỉ mục cho bảng `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `product_id` (`product_id`,`id`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ip_address` (`ip_address`),
  ADD KEY `ip_address_2` (`ip_address`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `blogs`
--
ALTER TABLE `blogs`
  MODIFY `blog_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=396;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `contacts`
--
ALTER TABLE `contacts`
  MODIFY `contact_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT cho bảng `gallerys`
--
ALTER TABLE `gallerys`
  MODIFY `gallery_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT cho bảng `history`
--
ALTER TABLE `history`
  MODIFY `id_history` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT cho bảng `likes`
--
ALTER TABLE `likes`
  MODIFY `like_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT cho bảng `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Các ràng buộc cho bảng `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`product_cat`) REFERENCES `categories` (`cat_id`);

--
-- Các ràng buộc cho bảng `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
