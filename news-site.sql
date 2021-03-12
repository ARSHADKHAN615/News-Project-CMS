-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 27, 2020 at 09:10 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `news-site`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `post` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `post`) VALUES
(1, 'SPORTS ', 1),
(2, 'ENTERTAINMENT', 3),
(3, 'HISTORY ', 3);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `post_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `category` varchar(100) NOT NULL,
  `post_date` varchar(50) NOT NULL,
  `author` int(11) NOT NULL,
  `post_img` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `title`, `description`, `category`, `post_date`, `author`, `post_img`) VALUES
(1, 'Babur Mughal Emperor', '                               Babur, born Zah?r ud-D?n Muhammad, was the founder of the Mughal Empire and first Emperor of the Mughal dynasty in the Indian subcontinent. He was a descendant of Timur and Genghis Khan through his father and mother respectively                ', '3', '18 Dec, 2020', 1, 'download.jpg'),
(2, 'Entertainment is 2014', ' Indian Hindi-language action comedy film written and directed by popular screenwriter duo Sajid-Farhad and produced by Ramesh S. Taurani under Tips Industries Limited. Based on an original story by K. Subash, the film stars Akshay Kumar and Junior - The Wonder Dog,[1] along with Tamannaah, Mithun Chakraborty, Johnny Lever, Prakash Raj and Sonu Sood. The Film was released on 8 August 2014.                ', '2', '18 Dec, 2020', 3, '220px-Its_Entertainment.jpg'),
(3, 'Sport includes all forms of competitive physical activity or games', '                               Sport Is generally recognized as system of activities which are based in physical athleticism or physical dexterity, with the largest major competitions such as the Olympic Games admitting only sports meeting this definition and other organizations such as the Council of Europe using definitions precluding activities without a physical element from classification as sports.                ', '1', '18 Dec, 2020', 2, '1280px-Youth-soccer-indiana.jpg'),
(4, 'Ertugul ', '                               Lorem ipsum dolor sit amet consectetur adipiscing elit hendrerit nisi mauris vivamus id, metus sem cum molestie lobortis suspendisse vulputate dignissim magna donec. Nascetur quam pretium aliquam porta est curabitur eleifend sed, tellus rhoncus ligula mus nibh ad purus gravida potenti, suscipit torquent ridiculus quis dictumst nam tempus. Est aliquam sagittis accumsan facilisi interdum molestie vitae montes aenean euismod, convallis non integer nec eu taciti placerat lectus.                ', '3', '18 Dec, 2020', 2, 'download (1).jpg'),
(5, 'What are examples of entertainment', 'Entertainment is a form of activity that holds the attention and interest of an audience or gives pleasure and delight. It can be an idea or a task, but is more likely to be one of the activities or events that have developed over thousands of years specifically for the purpose of keeping an audience attention', '2', '18 Dec, 2020', 2, 'entertainment.jpg'),
(6, 'What is the role of entertainment in our life?', '                               It might not seem apparent, but entertainment plays a very big role in ensuring that people live normal and happy lives. Over the years, with the introduction of better entertainment avenues, people have started consuming entertainment more. This is simply because of the importance that it holds.                ', '2', '18 Dec, 2020', 1, '1608311857-WhatsApp Image 2020-12-17 at 10.27.17 AM.jpeg'),
(7, 'I am Arshad Ali Khan', '?   Exploring new technologies and Web Development and quick hacks.\r\n?   Studying B.COM and Programming at Ahmedabad science and Commerce College.\r\n?   Working as a Freelance Self-employees.\r\n?   Learning more about UI/UX Design and Web Development.\r\n??   Pursuing WordPress and Blog Writing as hobbies/side hustles.', '3', '18 Dec, 2020', 3, '1608311618-1608311282-entertainment.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `websiteName` varchar(60) NOT NULL,
  `logo` varchar(50) NOT NULL,
  `footerDesc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`websiteName`, `logo`, `footerDesc`) VALUES
('News Website ', 'download (1).jpg', '© Copyright 2019 News | Powered by Arshad Khan');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(40) DEFAULT NULL,
  `role` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `username`, `password`, `role`) VALUES
(1, 'Arshad', 'Khan', 'AK007', '80c9ef0fb86369cd25f90af27ef53a9e', 1),
(2, 'Virat', 'Kohli ', 'VK100', 'bb2495c2b8e05a7b27d14bdf986ec113', 0),
(3, 'nabil ', 'SHIKHA ', 'NS786', '36c7c45baa40b319d0025cf743288d0b', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`),
  ADD UNIQUE KEY `post_id` (`post_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
