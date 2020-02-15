-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 12, 2019 at 05:39 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `recipes`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `post` text NOT NULL,
  `created_at` datetime(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `uid`, `title`, `post`, `created_at`) VALUES
(11, 37, 'Homemade Pizza', 'In large bowl, dissolve yeast and sugar in water; let stand for 5 minutes. Add oil and salt. Stir in flour, a cup at a time, until a soft dough forms.Turn onto floured surface; knead until smooth and elastic, about 2-3 minutes. Place in a greased bowl, turning once to grease the top. Cover and let rise in a warm place until doubled, about 45 minutes. Meanwhile, cook beef and onion over medium heat until no longer pink; drain.Punch down dough; divide in half. Press each into a greased 12-in. pizza pan. Combine the tomato sauce, oregano and basil; spread over each crust. Top with beef mixture, green pepper and cheese.Bake at 400Â° for 25-30 minutes or until crust is lightly browned.', '2019-10-04 19:10:22.000000'),
(13, 41, 'Best Italian Beef Vegetable Soup test', 'Kitchen tipsOur tasting panel thought the flavor was almost like an Italian cabbage roll.Turn this into a main dish by adding more ground beef.Nutrition Facts1 cup: 127 calories, 3g fat (1g saturated fat), 24mg cholesterol, 617mg sodium, 14g carbohydrate (9g sugars, 3g fiber), 11g protein.&nbsp;Diabetic Exchanges:&nbsp;1 starch, 1 lean meat.', '2019-10-12 15:50:45.000000'),
(17, 37, 'Cashew Butter', 'Process cashews and salt in a food processor until desired consistency, about 5-7 minutes, scraping down sides as needed. Add coconut oil and process another 30 seconds. Store in an airtight container in refrigerator.', '2019-10-04 21:17:23.000000'),
(19, 41, 'How to Smoke a Turkey?', 'When the turkey reaches the proper temperatures, remove it from the smoker and tent it with foil. Let it stand for at least 20 minutes (but preferably 30 to 45 minutes) before carving. While youâ€™re waiting, make gravy with the pan drippings.', '2019-10-04 23:05:20.000000'),
(21, 37, 'Rise and Shine Parfait', 'Ingredients4 cups fat-free vanilla yogurt2 medium peaches, chopped2 cups fresh blackberries1/2 cup granola without raisins or Kashi Go Lean Crunch cerealLayer half of the yogurt, peaches, blackberries and granola into 4 parfait glasses. Repeat layers.', '2019-10-05 12:36:59.000000'),
(58, 41, 'Кошка Мягкая Статуэтка Кукла Животное Портретная Скульптура Кошки Любой Масти На Заказ', 'Кошка Мягкая Статуэтка Кукла Животное Портретная Скульптура Кошки Любой Масти На ЗаказКошка Мягкая Статуэтка Кукла Животное Портретная Скульптура Кошки Любой Масти На Заказ', '2019-10-12 15:51:25.000000');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` char(50) NOT NULL,
  `email` char(50) NOT NULL,
  `pwd` varchar(250) NOT NULL,
  `rool` int(11) NOT NULL,
  `avatar` varchar(250) NOT NULL,
  `updated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `pwd`, `rool`, `avatar`, `updated`) VALUES
(37, 'Katy Admin', 'admin@gmail.com', '$2y$10$Vwj9AMdWGspCVWdPZMiJburMrnkA6UiZT/0O2HY2KaU4/pJr64a4.', 7, 'defoult.png', '2019-09-27 21:06:42'),
(41, 'Katy User', 'katy@gmail.com', '$2y$10$AkOfhQeLxDmB7LsW7QTTvuW/ZGHulgsPHGCaajHURvUEbpa68vTku', 6, 'defoult1.png', '2019-09-27 22:14:23'),
(101, 'mama', 'mama@gmail.com', '$2y$10$0AbWzSDSFvR58a9H/ihnQuDA5VKK3z9CQP6RPJ/h376YuVyCMLqeG', 6, '17.jpg', '2019-10-12 17:26:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
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
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
