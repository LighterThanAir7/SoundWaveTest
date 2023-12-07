-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 05, 2023 at 12:35 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `soundwave_loc`
--

CREATE DATABASE IF NOT EXISTS `soundwave_loc` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `soundwave_loc`;

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE `albums` (
  `id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `name` varchar(255) DEFAULT NULL,
  `created_on` datetime DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`id`, `status`, `name`, `created_on`, `created_by`) VALUES
(44, 1, 'Good For Me', '2023-06-27 12:24:43', 12),
(45, 1, 'Somebody Loves You', '2023-06-27 12:24:43', 12),
(46, 1, 'We Control The Sunlight', '2023-06-27 12:24:43', 12),
(47, 1, 'A State Of Trance FOREVER', '2023-06-27 12:24:43', 12),
(48, 1, 'Intense (The More Intense Edition)', '2023-06-27 12:24:43', 12),
(49, 1, 'A State Of Trance Episode 800 (Part 2)', '2023-06-27 12:24:43', 12),
(50, 1, '10 Years', '2023-06-27 12:24:43', 12),
(51, 1, 'Take This', '2023-06-27 12:24:43', 12),
(52, 1, 'Fatum Presents: 20 Years Of Anjunabeats', '2023-06-27 12:24:43', 12),
(53, 1, 'Ferry Corsten presents Corsten’s Countdown Best of 2015', '2023-06-27 12:24:43', 12),
(54, 1, 'Tuvan', '2023-06-27 12:24:43', 12),
(55, 1, 'Concrete Angel', '2023-06-27 12:24:43', 12),
(56, 1, 'U', '2023-06-27 12:24:43', 12),
(57, 1, 'Lighter Than Air', '2023-06-27 12:24:43', 12),
(58, 1, 'As The Rush Comes', '2023-06-27 12:24:43', 12),
(59, 1, 'Southern Sun / Ready Steady Go', '2023-06-27 12:24:43', 12),
(60, 1, 'The Air I Breathe', '2023-06-27 12:24:43', 12),
(61, 1, 'Sunny Tales', '2023-06-27 12:24:43', 12),
(62, 1, 'Unbreakable', '2023-06-27 12:24:43', 12),
(63, 1, 'Far From In Love', '2023-08-16 12:46:51', 12);

-- --------------------------------------------------------

--
-- Table structure for table `artists`
--

CREATE TABLE `artists` (
  `id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `name` varchar(255) NOT NULL,
  `created_on` datetime DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `artists`
--

INSERT INTO `artists` (`id`, `status`, `name`, `created_on`, `created_by`) VALUES
(535, 1, 'Above & Beyond', '2023-06-27 12:24:43', 12),
(536, 1, 'Zoë Johnston', '2023-06-27 12:24:43', 12),
(537, 1, 'Aly & Fila', '2023-06-27 12:24:43', 12),
(538, 1, 'Plumb', '2023-06-27 12:24:43', 12),
(539, 1, 'Jwaydan', '2023-06-27 12:24:43', 12),
(540, 1, 'Armin van Buuren', '2023-06-27 12:24:43', 12),
(541, 1, 'Kazi Jay', '2023-06-27 12:24:43', 12),
(542, 1, 'Miri Ben-Ari', '2023-06-27 12:24:43', 12),
(543, 1, 'Gareth Emery', '2023-06-27 12:24:43', 12),
(544, 1, 'Gareth Emery & Standerwick', '2023-06-27 12:24:43', 12),
(545, 1, 'Standerwick', '2023-06-27 12:24:43', 12),
(546, 1, 'HALIENE', '2023-06-27 12:24:43', 12),
(547, 1, 'Rising Star', '2023-06-27 12:24:43', 12),
(548, 1, 'Bryan Kearney', '2023-06-27 12:24:43', 12),
(549, 1, 'Out of the Dust', '2023-06-27 12:24:43', 12),
(550, 1, 'Ferry Corsten', '2023-06-27 12:24:43', 12),
(551, 1, 'Gaia', '2023-06-27 12:24:43', 12),
(552, 1, 'Christina Novelli', '2023-06-27 12:24:43', 12),
(553, 1, 'Bo Bruce', '2023-06-27 12:24:43', 12),
(554, 1, 'Marlo', '2023-06-27 12:24:43', 12),
(555, 1, 'Feenixpawl', '2023-06-27 12:24:43', 12),
(556, 1, 'Motorcycle', '2023-06-27 12:24:43', 12),
(557, 1, 'Paul Oakenfold', '2023-06-27 12:24:43', 12),
(558, 1, 'Carla Werner', '2023-06-27 12:24:43', 12),
(559, 1, 'Richard Durand', '2023-06-27 12:24:43', 12),
(560, 1, 'Sunlounger', '2023-06-27 12:24:43', 12),
(561, 1, 'Zara', '2023-06-27 12:24:43', 12),
(562, 1, 'Susana', '2023-06-27 12:24:43', 12),
(563, 1, 'Roger Shah', '2023-06-27 12:24:43', 12),
(564, 1, 'Aly & Fila feat. Jwaydan', '2023-08-16 12:49:02', 12),
(565, 1, 'Ferry Corsten presents Gouryella', '2023-08-16 12:49:02', 12),
(566, 1, 'Array', '2023-08-16 13:33:11', 12),
(567, 1, 'Ferry Corsten presents Gouryel', '2023-08-16 13:36:46', 12);

-- --------------------------------------------------------

--
-- Table structure for table `collaborating_artists`
--

CREATE TABLE `collaborating_artists` (
  `id` int(10) NOT NULL,
  `song_id` int(10) NOT NULL,
  `artist_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `collaborating_artists`
--

INSERT INTO `collaborating_artists` (`id`, `song_id`, `artist_id`) VALUES
(1, 1, 536),
(2, 2, 536),
(3, 3, 538),
(4, 5, 537),
(5, 5, 541),
(6, 6, 542),
(7, 7, 549),
(8, 7, 538),
(9, 10, 552),
(10, 11, 544),
(11, 11, 545),
(12, 11, 546),
(13, 12, 553),
(14, 13, 555),
(15, 16, 558),
(16, 17, 552),
(17, 19, 561),
(18, 20, 537),
(19, 20, 563);

-- --------------------------------------------------------

--
-- Table structure for table `music_genres`
--

CREATE TABLE `music_genres` (
  `id` int(10) NOT NULL,
  `status` tinyint(1) DEFAULT 1,
  `name` varchar(50) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `created_on` datetime DEFAULT current_timestamp(),
  `created_by` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `music_genres`
--

INSERT INTO `music_genres` (`id`, `status`, `name`, `img`, `created_on`, `created_by`) VALUES
(5, 1, 'Rock', 'doc/music_genres/img_1691872721.jpg', '2023-06-08 23:38:39', 12),
(6, 1, 'Electronic', 'doc/music_genres/img_1691872766.jpg', '2023-06-08 23:38:46', 12),
(7, 1, 'Soul', 'doc/music_genres/img_1691872776.jpg', '2023-06-08 23:39:03', 12),
(8, 1, 'EDM', 'doc/music_genres/img_1691872824.jpg', '2023-06-08 23:39:10', 12),
(9, 1, 'Alternative', 'doc/music_genres/img_1691872816.jpg', '2023-06-08 23:39:22', 12),
(10, 1, 'Blues', 'doc/music_genres/img_1691928613.jpg', '2023-06-08 23:39:33', 12),
(11, 1, 'Jazz', 'doc/music_genres/img_1691928621.jpg', '2023-06-08 23:39:42', 12),
(12, 1, 'Pop', 'doc/music_genres/img_1691928640.jpg', '2023-06-08 23:39:49', 12),
(13, 1, 'Rap', 'doc/music_genres/img_1691928647.jpg', '2023-06-08 23:39:57', 12),
(14, 1, 'Classical', 'doc/music_genres/img_1691928655.jpg', '2023-06-08 23:40:05', 12),
(15, 1, 'R&B', 'doc/music_genres/img_1691928698.jpg', '2023-06-08 23:45:11', 12),
(16, 1, 'Soul & Funk', 'doc/music_genres/img_1691928675.jpg', '2023-06-08 23:45:25', 12),
(17, 1, 'Flamenco', 'doc/music_genres/img_1691928710.jpg', '2023-06-08 23:45:36', 12),
(18, 1, 'Schlager', 'doc/music_genres/img_1691928732.jpg', '2023-06-08 23:45:49', 12),
(19, 1, 'Afro', 'doc/music_genres/img_1691928724.jpg', '2023-06-08 23:46:00', 12),
(20, 1, 'Latin music', 'doc/music_genres/img_1691928744.jpg', '2023-06-08 23:46:24', 12),
(21, 1, 'Metal', 'doc/music_genres/img_1691928754.jpg', '2023-06-08 23:46:37', 12),
(22, 1, 'Reggae', 'doc/music_genres/img_1691928763.jpg', '2023-06-08 23:46:49', 12),
(23, 1, 'K-pop', 'doc/music_genres/img_1691928774.jpg', '2023-06-08 23:47:00', 12),
(24, 1, 'Movie & Series', 'doc/music_genres/img_1691928781.jpg', '2023-06-08 23:47:16', 12),
(31, 1, 'Trance', 'doc/music_genres/img_1692114668.jpg', '2023-08-15 17:51:08', 12),
(32, 1, 'Dance', 'doc/music_genres/img_1692114681.jpg', '2023-08-15 17:51:21', 12),
(33, 1, 'Electro', 'doc/music_genres/img_1692114701.jpg', '2023-08-15 17:51:41', 12);

-- --------------------------------------------------------

--
-- Table structure for table `playlist_categories`
--

CREATE TABLE `playlist_categories` (
  `id` int(10) NOT NULL,
  `status` tinyint(1) DEFAULT 1,
  `name` varchar(100) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `created_on` datetime DEFAULT current_timestamp(),
  `created_by` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `playlist_categories`
--

INSERT INTO `playlist_categories` (`id`, `status`, `name`, `img`, `created_on`, `created_by`) VALUES
(1, 1, 'Charts', 'doc/playlist_categories/img_1691927453.jpg', '2023-08-13 13:50:53', 12),
(2, 1, 'New Releases', 'doc/playlist_categories/img_1691927463.jpg', '2023-08-13 13:51:03', 12),
(3, 1, 'Chill', 'doc/playlist_categories/img_1691927471.jpg', '2023-08-13 13:51:11', 12),
(4, 1, 'Feel Good', 'doc/playlist_categories/img_1691927480.jpg', '2023-08-13 13:51:20', 12),
(5, 1, 'Party', 'doc/playlist_categories/img_1691927488.jpg', '2023-08-13 13:51:28', 12),
(6, 1, 'Workout', 'doc/playlist_categories/img_1691927497.jpg', '2023-08-13 13:51:37', 12),
(7, 1, 'Melancholia', 'doc/playlist_categories/img_1691927506.jpg', '2023-08-13 13:51:46', 12),
(8, 1, 'At Home', 'doc/playlist_categories/img_1691927516.jpg', '2023-08-13 13:51:56', 12),
(9, 1, 'Summer', 'doc/playlist_categories/img_1691927523.jpg', '2023-08-13 13:52:03', 12),
(10, 1, 'Focus', 'doc/playlist_categories/img_1691927530.jpg', '2023-08-13 13:52:10', 12);

-- --------------------------------------------------------

--
-- Table structure for table `podcast_categories`
--

CREATE TABLE `podcast_categories` (
  `id` int(10) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `name` varchar(100) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `created_on` datetime DEFAULT current_timestamp(),
  `created_by` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `podcast_categories`
--

INSERT INTO `podcast_categories` (`id`, `status`, `name`, `img`, `created_on`, `created_by`) VALUES
(1, 1, 'Music', 'doc/podcasts/podcast-categories/img_1691855975.jpg', '2023-08-12 17:57:13', 1),
(2, 1, 'Education', 'doc/podcasts/podcast-categories/img_1691856418.jpg', '2023-08-12 18:06:58', 1),
(3, 1, 'Business', 'doc/podcasts/podcast-categories/img_1691856467.jpg', '2023-08-12 18:07:47', 1),
(4, 1, 'Lifestyle', 'doc/podcasts/podcast-categories/img_1691856489.jpg', '2023-08-12 18:08:09', 1),
(5, 1, 'History', 'doc/podcasts/podcast-categories/img_1691856497.jpg', '2023-08-12 18:08:17', 1),
(6, 1, 'Mistery', 'doc/podcasts/podcast-categories/img_1691856508.jpg', '2023-08-12 18:08:28', 1),
(7, 1, 'Sports', 'doc/podcasts/podcast-categories/img_1691856518.jpg', '2023-08-12 18:08:38', 1),
(8, 1, 'Film & TV', 'doc/podcasts/podcast-categories/img_1691856535.jpg', '2023-08-12 18:08:55', 1),
(9, 1, 'Travel', 'doc/podcasts/podcast-categories/img_1691856549.jpg', '2023-08-12 18:09:09', 1),
(10, 1, 'Summer Podcasts', 'doc/podcasts/podcast-categories/img_1691856563.jpg', '2023-08-12 18:09:23', 1),
(11, 1, 'Interviews', 'doc/podcasts/podcast-categories/img_1691856576.jpg', '2023-08-12 18:09:36', 1),
(12, 1, 'Medicine', 'doc/podcasts/podcast-categories/img_1691856586.jpg', '2023-08-12 18:09:46', 1),
(13, 1, 'Politics', 'doc/podcasts/podcast-categories/img_1691856599.jpg', '2023-08-12 18:09:59', 1),
(14, 1, 'Ecology', 'doc/podcasts/podcast-categories/img_1691856610.jpg', '2023-08-12 18:10:10', 1),
(15, 1, 'Carrer Growth', 'doc/podcasts/podcast-categories/img_1691856622.jpg', '2023-08-12 18:10:22', 1),
(16, 1, 'Podcast Charts', 'doc/podcasts/podcast-categories/img_1691856635.jpg', '2023-08-12 18:10:35', 1),
(17, 1, 'New Podcasts', 'doc/podcasts/podcast-categories/img_1691856646.jpg', '2023-08-12 18:10:46', 1),
(18, 1, 'For Foodies', 'doc/podcasts/podcast-categories/img_1691856660.jpg', '2023-08-12 18:11:00', 1),
(19, 1, 'Storytelling', 'doc/podcasts/podcast-categories/img_1691856673.jpg', '2023-08-12 18:11:13', 1),
(20, 1, 'For entrepreneurs', 'doc/podcasts/podcast-categories/img_1691856687.jpg', '2023-08-12 18:11:27', 1);

-- --------------------------------------------------------

--
-- Table structure for table `songs`
--

CREATE TABLE `songs` (
  `id` int(11) NOT NULL,
  `status` tinyint(1) DEFAULT 1,
  `title` varchar(255) DEFAULT NULL,
  `artist_id` int(10) DEFAULT NULL,
  `album` varchar(255) DEFAULT NULL,
  `duration` varchar(10) DEFAULT NULL,
  `lyrics` text DEFAULT NULL,
  `song_path` varchar(255) DEFAULT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `artwork_img` text NOT NULL,
  `released_on` date DEFAULT NULL,
  `created_on` datetime DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `songs`
--

INSERT INTO `songs` (`id`, `status`, `title`, `artist_id`, `album`, `duration`, `lyrics`, `song_path`, `filename`, `artwork_img`, `released_on`, `created_on`, `created_by`) VALUES
(1, 1, 'Good For Me (Above & Beyond Extended Club Mix)', 535, 'Good For Me', '8:52', NULL, 'doc/songs/Above & Beyond - Good For Me (Above & Beyond Extended Club Mix).mp3', 'Above & Beyond - Good For Me (Above & Beyond Extended Club Mix).jpg', 'doc/artworks/original/Above & Beyond - Good For Me (Above & Beyond Extended Club Mix).jpg', '2007-03-05', '2023-08-19 11:27:44', NULL),
(2, 1, 'No One On Earth (Gabriel & Dresden Extended Mix)', 535, 'Fatum Presents: 20 Years Of Anjunabeats', '9:20', NULL, 'doc/songs/Above & Beyond - No One On Earth (Gabriel & Dresden Extended Mix).mp3', 'Above & Beyond - No One On Earth (Gabriel & Dresden Extended Mix).jpg', 'doc/artworks/original/Above & Beyond - No One On Earth (Gabriel & Dresden Extended Mix).jpg', '2020-09-17', '2023-08-19 11:27:44', NULL),
(3, 1, 'Somebody Loves You', 537, 'Somebody Loves You', '5:45', NULL, 'doc/songs/Aly & Fila - Somebody Loves You.mp3', 'Aly & Fila - Somebody Loves You.jpg', 'doc/artworks/original/Aly & Fila - Somebody Loves You.jpg', '2020-09-25', '2023-08-19 11:27:44', NULL),
(4, 1, 'We Control The Sunlight', 564, 'We Control The Sunlight', '8:29', NULL, 'doc/songs/Aly & Fila feat. Jwaydan - We Control The Sunlight.mp3', 'Aly & Fila feat. Jwaydan - We Control The Sunlight.jpg', 'doc/artworks/original/Aly & Fila feat. Jwaydan - We Control The Sunlight.jpg', '2011-07-04', '2023-08-19 11:27:44', NULL),
(5, 1, 'For All Time (Extended Mix)', 540, 'A State Of Trance FOREVER', '9:06', NULL, 'doc/songs/Armin van Buuren - For All Time (Extended Mix).mp3', 'Armin van Buuren - For All Time (Extended Mix).jpg', 'doc/artworks/original/Armin van Buuren - For All Time (Extended Mix).jpg', '2021-09-03', '2023-08-19 11:27:44', NULL),
(6, 1, 'Intense', 540, 'Intense (The More Intense Edition)', '8:48', NULL, 'doc/songs/Armin van Buuren - Intense.mp3', 'Armin van Buuren - Intense.jpg', 'doc/artworks/original/Armin van Buuren - Intense.jpg', '2013-11-15', '2023-08-19 11:27:44', NULL),
(7, 1, 'Take This (Extended Mix)', 548, 'Take This', '8:42', NULL, 'doc/songs/Bryan Kearney - Take This (Extended Mix).mp3', 'Bryan Kearney - Take This (Extended Mix).jpg', 'doc/artworks/original/Bryan Kearney - Take This (Extended Mix).jpg', '2022-04-29', '2023-08-19 11:27:44', NULL),
(8, 1, 'Anahera (Extended Mix)', 567, 'Ferry Corsten presents Corsten’s Countdown Best of 2015', '7:40', NULL, 'doc/songs/Ferry Corsten presents Gouryella - Anahera (Extended Mix).mp3', 'Ferry Corsten presents Gouryella - Anahera (Extended Mix).jpg', 'doc/artworks/original/Ferry Corsten presents Gouryella - Anahera (Extended Mix).jpg', '2015-12-28', '2023-08-19 11:27:44', NULL),
(9, 1, 'Tuvan', 551, 'Tuvan', '8:10', NULL, 'doc/songs/Gaia - Tuvan.mp3', 'Gaia - Tuvan.jpg', 'doc/artworks/original/Gaia - Tuvan.jpg', '2009-09-21', '2023-08-19 11:27:44', NULL),
(10, 1, 'Concrete Angel (Original Mix)', 543, 'Concrete Angel', '7:09', NULL, 'doc/songs/Gareth Emery - Concrete Angel (Original Mix).mp3', 'Gareth Emery - Concrete Angel (Original Mix).jpg', 'doc/artworks/original/Gareth Emery - Concrete Angel (Original Mix).jpg', '2012-02-13', '2023-08-19 11:27:44', NULL),
(11, 1, 'Saving Light', 543, 'A State Of Trance Episode 800 (Part 2)', '4:54', NULL, 'doc/songs/Gareth Emery - Saving Light.mp3', 'Gareth Emery - Saving Light.jpg', 'doc/artworks/original/Gareth Emery - Saving Light.jpg', '2017-02-02', '2023-08-19 11:27:44', NULL),
(12, 1, 'U (Bryan Kearney Remix)', 543, 'U', '7:46', NULL, 'doc/songs/Gareth Emery - U (Bryan Kearney Remix).mp3', 'Gareth Emery - U (Bryan Kearney Remix).jpg', 'doc/artworks/original/Gareth Emery - U (Bryan Kearney Remix).jpg', '2015-03-18', '2023-08-19 11:27:44', NULL),
(13, 1, 'Lighter Than Air (Extended Mix)', 554, 'Lighter Than Air', '5:04', NULL, 'doc/songs/Marlo - Lighter Than Air (Extended Mix).mp3', 'Marlo - Lighter Than Air (Extended Mix).jpg', 'doc/artworks/original/Marlo - Lighter Than Air (Extended Mix).jpg', '2019-04-26', '2023-08-19 11:27:44', NULL),
(14, 1, 'As The Rush Comes (Gabriel & Dresden Sweeping Strings Remix)', 556, 'As The Rush Comes', '10:42', NULL, 'doc/songs/Motorcycle - As The Rush Comes (Gabriel & Dresden Sweeping Strings Remix).mp3', 'Motorcycle - As The Rush Comes (Gabriel & Dresden Sweeping Strings Remix).jpg', 'doc/artworks/original/Motorcycle - As The Rush Comes (Gabriel & Dresden Sweeping Strings Remix).jpg', '2005-01-01', '2023-08-19 11:27:44', NULL),
(15, 1, 'As The Rush Comes', 556, 'As The Rush Comes', '3:32', NULL, 'doc/songs/Motorcycle - As The Rush Comes.mp3', 'Motorcycle - As The Rush Comes.jpg', 'doc/artworks/original/Motorcycle - As The Rush Comes.jpg', '2005-01-01', '2023-08-19 11:27:44', NULL),
(16, 1, 'Southern Sun (DJ Tiësto Remix)', 557, 'Southern Sun / Ready Steady Go', '9:45', NULL, 'doc/songs/Paul Oakenfold - Southern Sun (DJ Tiësto Remix).mp3', 'Paul Oakenfold - Southern Sun (DJ Tiësto Remix).jpg', 'doc/artworks/original/Paul Oakenfold - Southern Sun (DJ Tiësto Remix).jpg', '2002-03-19', '2023-08-19 11:27:44', NULL),
(17, 1, 'The Air I Breathe (Club Mix)', 559, 'The Air I Breathe', '7:20', NULL, 'doc/songs/Richard Durand - The Air I Breathe (Club Mix).mp3', 'Richard Durand - The Air I Breathe (Club Mix).jpg', 'doc/artworks/original/Richard Durand - The Air I Breathe (Club Mix).jpg', '2018-10-12', '2023-08-19 11:27:44', NULL),
(18, 1, 'Clear Blue Moon (Original Mix)', 547, '10 Years', '7:27', NULL, 'doc/songs/Rising Star - Clear Blue Moon (Original Mix).mp3', 'Rising Star - Clear Blue Moon (Original Mix).jpg', 'doc/artworks/original/Rising Star - Clear Blue Moon (Original Mix).jpg', '2006-11-11', '2023-08-19 11:27:44', NULL),
(19, 1, 'Lost (Dance Version)', 560, 'Sunny Tales', '9:23', NULL, 'doc/songs/Sunlounger - Lost (Dance Version).mp3', 'Sunlounger - Lost (Dance Version).jpg', 'doc/artworks/original/Sunlounger - Lost (Dance Version).jpg', '2008-08-18', '2023-08-19 11:27:44', NULL),
(20, 1, 'Unbreakable (Extended Mix)', 562, 'Unbreakable', '7:46', NULL, 'doc/songs/Susana - Unbreakable (Extended Mix).mp3', 'Susana - Unbreakable (Extended Mix).jpg', 'doc/artworks/original/Susana - Unbreakable (Extended Mix).jpg', '2016-09-12', '2023-08-19 11:27:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `song_genre`
--

CREATE TABLE `song_genre` (
  `id` int(10) NOT NULL,
  `song_id` int(10) NOT NULL,
  `genre_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `song_genre`
--

INSERT INTO `song_genre` (`id`, `song_id`, `genre_id`) VALUES
(1, 1, 32),
(2, 1, 31),
(3, 2, 32),
(4, 2, 31),
(5, 3, 32),
(6, 3, 31),
(7, 4, 32),
(8, 4, 31),
(9, 5, 32),
(10, 5, 31),
(11, 6, 32),
(12, 6, 31),
(13, 7, 32),
(14, 7, 31),
(15, 8, 32),
(16, 8, 31),
(17, 9, 32),
(18, 9, 31),
(19, 9, 12),
(20, 9, 5),
(21, 10, 33),
(22, 10, 32),
(23, 10, 31),
(24, 11, 32),
(25, 11, 31),
(26, 12, 32),
(27, 13, 32),
(28, 13, 31),
(29, 14, 32),
(30, 15, 32),
(31, 16, 33),
(32, 16, 32),
(33, 16, 12),
(34, 17, 32),
(35, 17, 31),
(36, 18, 32),
(37, 18, 31),
(38, 19, 32),
(39, 20, 32),
(40, 20, 31);

-- --------------------------------------------------------

--
-- Table structure for table `spt_user_type`
--

CREATE TABLE `spt_user_type` (
  `id` int(10) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `spt_user_type`
--

INSERT INTO `spt_user_type` (`id`, `status`, `name`) VALUES
(1, 1, 'Super Administrator'),
(2, 1, 'Administrator'),
(4, 1, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `id_type` int(10) DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `sex` enum('musko','zensko') NOT NULL,
  `date_birth` date DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `init_password` varchar(255) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_by` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `status`, `id_type`, `firstname`, `lastname`, `username`, `password`, `sex`, `date_birth`, `img`, `init_password`, `last_login`, `created_on`, `created_by`) VALUES
(1, 1, 1, 'Admin', 'Adminić', 'admin', '590eb3e55ff9f6965aa6de7e0e3b9a33', 'musko', NULL, 'doc/user_images/img_1_1687854728.webp', NULL, '2023-08-12 22:40:25', NULL, 1),
(12, 1, 4, 'Benjamin', 'Babić', 'bbabic', '68c82eceae744eeade77f47c2e702580', 'musko', '2000-02-23', 'doc/user_images/img_12_1687857156.jpeg', NULL, '2023-08-22 09:49:19', '2023-06-02 19:59:54', 1),
(19, 1, 4, 'Test User', 'A', 'testusera', NULL, 'musko', '2023-06-01', NULL, NULL, NULL, '2023-06-27 12:25:48', 12);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`id`),
  ADD KEY `albums_ibfk_1` (`created_by`);

--
-- Indexes for table `artists`
--
ALTER TABLE `artists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `collaborating_artists`
--
ALTER TABLE `collaborating_artists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `song_id` (`song_id`),
  ADD KEY `artist_id` (`artist_id`);

--
-- Indexes for table `music_genres`
--
ALTER TABLE `music_genres`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `playlist_categories`
--
ALTER TABLE `playlist_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `podcast_categories`
--
ALTER TABLE `podcast_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `songs`
--
ALTER TABLE `songs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_album` (`album`),
  ADD KEY `artist_id` (`artist_id`);

--
-- Indexes for table `song_genre`
--
ALTER TABLE `song_genre`
  ADD PRIMARY KEY (`id`),
  ADD KEY `song_id` (`song_id`),
  ADD KEY `genre_id` (`genre_id`);

--
-- Indexes for table `spt_user_type`
--
ALTER TABLE `spt_user_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_type` (`id_type`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `albums`
--
ALTER TABLE `albums`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `artists`
--
ALTER TABLE `artists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=568;

--
-- AUTO_INCREMENT for table `collaborating_artists`
--
ALTER TABLE `collaborating_artists`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `music_genres`
--
ALTER TABLE `music_genres`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `playlist_categories`
--
ALTER TABLE `playlist_categories`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `podcast_categories`
--
ALTER TABLE `podcast_categories`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `songs`
--
ALTER TABLE `songs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `song_genre`
--
ALTER TABLE `song_genre`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `spt_user_type`
--
ALTER TABLE `spt_user_type`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `albums`
--
ALTER TABLE `albums`
  ADD CONSTRAINT `albums_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `collaborating_artists`
--
ALTER TABLE `collaborating_artists`
  ADD CONSTRAINT `collaborating_artists_ibfk_1` FOREIGN KEY (`song_id`) REFERENCES `songs` (`id`),
  ADD CONSTRAINT `collaborating_artists_ibfk_2` FOREIGN KEY (`artist_id`) REFERENCES `artists` (`id`);

--
-- Constraints for table `songs`
--
ALTER TABLE `songs`
  ADD CONSTRAINT `songs_ibfk_1` FOREIGN KEY (`artist_id`) REFERENCES `artists` (`id`);

--
-- Constraints for table `song_genre`
--
ALTER TABLE `song_genre`
  ADD CONSTRAINT `song_genre_ibfk_1` FOREIGN KEY (`song_id`) REFERENCES `songs` (`id`),
  ADD CONSTRAINT `song_genre_ibfk_2` FOREIGN KEY (`genre_id`) REFERENCES `music_genres` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
