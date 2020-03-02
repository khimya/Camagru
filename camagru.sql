-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 02, 2020 at 09:43 PM
-- Server version: 5.7.29-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `camagru`
--

-- --------------------------------------------------------

--
-- Table structure for table `cmnt`
--

CREATE TABLE `cmnt` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cmnt` text NOT NULL,
  `display_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cmnt`
--

INSERT INTO `cmnt` (`id`, `post_id`, `user_id`, `cmnt`, `display_name`) VALUES
(44, 56, 43, 'hello bro', ''),
(45, 56, 43, 'wow test 1', ''),
(46, 56, 43, 'plzz', ''),
(47, 56, 43, 'addd', ''),
(48, 56, 43, 'plz', ''),
(49, 56, 43, 'plz', ''),
(50, 56, 43, 'plz', ''),
(51, 56, 43, 'plz', ''),
(52, 56, 43, 'plz', ''),
(53, 56, 43, 'plz', ''),
(54, 56, 43, 'plz', ''),
(55, 56, 43, 'plz', ''),
(56, 56, 43, 'plz', ''),
(57, 56, 43, 'plz', ''),
(58, 56, 43, 'plz', ''),
(59, 56, 43, 'plz', ''),
(60, 55, 43, 'tooz', ''),
(61, 55, 43, 'boz', ''),
(62, 55, 43, 'yoyoy', ''),
(63, 45, 43, 'oho', ''),
(64, 59, 46, 'cool', ''),
(65, 59, 43, 'thx', ''),
(66, 43, 43, 'hello', ''),
(67, 59, 43, 'etryukyiluo', ''),
(68, 67, 43, 'hello', ''),
(69, 71, 43, 'msdoum', ''),
(70, 72, 43, 'hehe', ''),
(71, 72, 43, 'hello', ''),
(72, 43, 43, 'sss', ''),
(73, 71, 43, 'ss', ''),
(74, 71, 43, 'ssssss', ''),
(75, 70, 43, 'sf', ''),
(76, 69, 43, 'fef3', ''),
(77, 43, 43, 'hi', ''),
(78, 80, 43, 'frefkjefje', ''),
(79, 122, 43, 'first comment', 'khimya'),
(80, 122, 43, 'first comment', 'khimya'),
(81, 122, 43, 'first comment', 'khimya'),
(82, 1, 1, '1', '1'),
(83, 1, 1, '1', 'fefefefefefefefef'),
(84, 1, 1, '1', 'fefefefefefefefef'),
(85, 122, 43, 'first comment', 'khimya'),
(86, 122, 43, 'first comment', 'khimya'),
(87, 122, 43, 'first comment', 'khimya'),
(88, 122, 43, 'first comment', 'khimya'),
(89, 122, 43, 'first comment', 'khimya'),
(90, 122, 43, 'first comment', 'khimya'),
(91, 122, 43, 'first comment', 'khimya'),
(92, 122, 43, 'first comment', 'khimya'),
(93, 122, 43, 'first comment', 'khimya'),
(94, 122, 43, 'first comment', 'khimya'),
(95, 122, 43, 'first comment', 'khimya'),
(96, 122, 43, 'first comment', 'khimya'),
(97, 122, 43, 'first comment', 'khimya'),
(98, 122, 43, 'first comment', 'khimya'),
(99, 122, 43, 'first comment', 'khimya'),
(100, 122, 43, 'first comment', 'khimya'),
(101, 122, 43, 'first comment', 'khimya'),
(102, 122, 43, 'first comment', 'khimya'),
(103, 122, 43, 'first comment', 'khimya'),
(104, 122, 43, 'first comment', 'khimya'),
(105, 122, 43, 'first comment', 'khimya'),
(106, 122, 43, 'first comment', 'khimya'),
(107, 122, 43, 'first comment', 'khimya'),
(108, 122, 43, 'first comment', 'khimya'),
(109, 122, 43, 'first comment', 'khimya'),
(110, 122, 43, 'first comment', 'khimya'),
(111, 122, 43, 'first comment', 'khimya'),
(112, 122, 43, 'first comment', 'khimya'),
(113, 122, 43, 'first comment', 'khimya'),
(114, 122, 43, 'first comment', 'khimya'),
(115, 122, 43, 'first comment', 'khimya'),
(116, 122, 43, 'first comment', 'khimya'),
(117, 122, 43, 'first comment', 'khimya'),
(118, 122, 43, 'first comment', 'khimya'),
(119, 122, 43, 'first comment', 'khimya'),
(120, 122, 43, 'first comment', 'khimya'),
(121, 122, 43, 'first comment', 'khimya'),
(122, 122, 43, 'first comment', 'khimya'),
(123, 122, 43, 'first comment', 'khimya'),
(124, 122, 43, 'first comment', 'khimya'),
(125, 122, 43, 'first comment', 'khimya'),
(126, 122, 43, 'first comment', 'khimya'),
(127, 122, 43, 'first comment', 'khimya'),
(128, 122, 43, 'first comment', 'khimya'),
(129, 122, 43, 'first comment', 'khimya'),
(130, 122, 43, 'first comment', 'khimya'),
(131, 122, 43, 'first comment', 'khimya'),
(132, 122, 43, 'first comment', 'khimya'),
(133, 122, 43, 'first comment', 'khimya'),
(134, 122, 43, 'first comment', 'khimya'),
(135, 122, 43, 'first comment', 'khimya'),
(136, 122, 43, 'first comment', 'khimya'),
(137, 122, 43, 'first comment', 'khimya'),
(138, 122, 43, 'first comment', 'khimya'),
(139, 122, 43, 'first comment', 'khimya'),
(140, 122, 43, 'first comment', 'khimya'),
(141, 122, 43, 'first comment', 'khimya'),
(142, 122, 43, 'first comment', 'khimya'),
(143, 122, 43, 'first comment', 'khimya'),
(144, 122, 43, 'first comment', 'khimya'),
(145, 122, 43, 'first comment', 'khimya'),
(146, 122, 43, 'first comment', 'khimya'),
(147, 122, 43, 'first comment', 'khimya'),
(148, 122, 43, 'first comment', 'khimya'),
(149, 122, 43, 'first comment', 'khimya'),
(150, 122, 43, 'first comment', 'khimya'),
(151, 122, 43, 'first comment', 'khimya'),
(152, 122, 43, 'first comment', 'khimya'),
(153, 122, 43, 'first comment', 'khimya'),
(154, 122, 43, 'first comment', 'khimya'),
(155, 75, 43, 'owh what an old picture', 'khimya'),
(156, 75, 43, 'owh what an old picture', 'khimya'),
(157, 79, 43, 'fefefefefefefe', 'khimya'),
(158, 122, 43, 'etrytuyiu', 'khimya'),
(159, 122, 43, 'etrytuyiu', 'khimya'),
(160, 122, 43, 'etrytuyiu', 'khimya'),
(161, 78, 43, 'deddede', 'khimya'),
(162, 78, 43, 'deddede', 'khimya'),
(163, 78, 43, 'deddede', 'khimya'),
(164, 79, 43, 'dcfbhjnkml', 'khimya'),
(165, 78, 43, 'weaertyui', 'khimya'),
(166, 122, 47, 'ff34f34', 'testing'),
(167, 123, 43, 'wetrytu', 'khimya'),
(168, 123, 43, 'fwergrger', 'khimya'),
(169, 123, 43, 'fwergrger', 'khimya'),
(170, 123, 43, 'dwefewfew', 'khimya'),
(171, 79, 51, 'frsfjker', 'khimya'),
(172, 125, 46, 'ncie pic', 'ybenbrai'),
(173, 125, 46, 'efewfwe', 'ybenbrai'),
(174, 125, 46, 'fwefewf', 'ybenbrai'),
(175, 125, 46, 'cewweew', 'ybenbrai'),
(176, 125, 46, 'cecece', 'ybenbrai'),
(177, 125, 46, 'cecece', 'ybenbrai'),
(178, 125, 46, 'cecece', 'ybenbrai'),
(179, 125, 46, 'cecece', 'ybenbrai'),
(180, 125, 46, 'cecece', 'ybenbrai'),
(181, 125, 46, 'cecece', 'ybenbrai'),
(182, 125, 46, 'cecece', 'ybenbrai'),
(183, 125, 46, 'cecece', 'ybenbrai'),
(184, 125, 46, 'cecece', 'ybenbrai'),
(185, 125, 46, 'cecece', 'ybenbrai'),
(186, 125, 46, 'cecece', 'ybenbrai'),
(187, 125, 46, 'cecece', 'ybenbrai'),
(188, 125, 46, 'dedede', 'ybenbrai'),
(189, 125, 46, 'cewcew', 'ybenbrai'),
(190, 125, 46, 'cewcew', 'ybenbrai'),
(191, 125, 46, 'cewcew', 'ybenbrai'),
(192, 125, 46, 'cewcew', 'ybenbrai'),
(193, 125, 46, 'cewcew', 'ybenbrai'),
(194, 125, 46, 'cewcew', 'ybenbrai'),
(195, 125, 46, 'cewcew', 'ybenbrai'),
(196, 125, 46, 'cewcew', 'ybenbrai'),
(197, 125, 46, 'cewcew', 'ybenbrai'),
(198, 125, 46, 'cewcew', 'ybenbrai'),
(199, 125, 46, 'cewcew', 'ybenbrai'),
(200, 125, 46, 'cewcew', 'ybenbrai'),
(201, 125, 46, 'cewcew', 'ybenbrai'),
(202, 125, 46, 'cewcew', 'ybenbrai'),
(203, 124, 46, 'yooyoyoy', 'ybenbrai'),
(204, 124, 46, 'nice', 'ybenbrai'),
(205, 152, 51, 'beatiful picture of me', 'khimya'),
(206, 153, 46, 'toz pic pic', 'ybenbrai');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `post_id`) VALUES
(102, 43, 56),
(103, 46, 59),
(106, 43, 59),
(108, 43, 67),
(110, 43, 71),
(111, 43, 72),
(112, 43, 69),
(113, 46, 75),
(114, 46, 80),
(115, 43, 43),
(116, 43, 80),
(117, 51, 79),
(118, 51, 124),
(119, 51, 51),
(120, 51, 127),
(122, 51, 131),
(123, 51, 152),
(124, 46, 153),
(126, 46, 152);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `image` longtext NOT NULL,
  `like_count` int(11) NOT NULL DEFAULT '0',
  `cmnt_count` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `created_at`, `image`, `like_count`, `cmnt_count`) VALUES
(72, 46, 'dededede', '2020-02-16 04:06:10', 'upload/5e48bfb2cb3c5.png', 0, 0),
(73, 46, '11', '2020-02-16 04:08:56', 'upload/5e48c0582aa47.png', 0, 0),
(74, 46, '22', '2020-02-16 04:09:25', 'upload/5e48c075cd55a.png', 0, 0),
(75, 46, 'sip', '2020-02-16 22:25:45', 'upload/5e49c169ccd70.png', 1, 1),
(76, 46, 'dededed', '2020-02-16 23:10:58', 'upload/5e49cc020501f.png', 0, 0),
(77, 46, 'dd', '2020-02-16 23:12:48', 'upload/5e49cc70a905e.png', 0, 0),
(78, 46, 'ee', '2020-02-16 23:14:08', 'upload/5e49ccc0be58d.png', 0, 2),
(79, 46, 'ddd', '2020-02-16 23:16:25', 'upload/5e49cd4976398.png', 1, 3),
(80, 46, 'dedede', '2020-02-16 23:26:44', 'upload/5e49cfb405937.png', 2, 1),
(111, 43, 'ghjjk', '2020-02-19 21:51:32', 'upload/5e4dade46ac3b.png', 0, 0),
(112, 43, 'ghijko', '2020-02-19 21:51:41', 'upload/5e4dadece4d3b.png', 0, 0),
(113, 43, 'ddd', '2020-02-19 21:55:28', 'upload/5e4daed035c8c.png', 0, 0),
(114, 43, 'knjoml,', '2020-02-21 21:02:52', 'upload/5e50457cbe75d.png', 0, 0),
(115, 43, '85', '2020-02-21 21:03:23', 'upload/5e50459ae8eb2.png', 0, 0),
(116, 43, 'j;o&#39;o&#39;p', '2020-02-21 22:26:50', 'upload/5e50592ac183e.png', 0, 0),
(117, 43, 'smile', '2020-02-24 10:50:27', 'upload/5e53aa72eb549.png', 0, 0),
(118, 43, 'dwedede', '2020-02-24 10:50:59', 'upload/5e53aa93a099d.png', 0, 0),
(119, 43, 'teryrdtfyu', '2020-02-24 10:56:05', 'upload/5e53abc4e7476.png', 0, 0),
(120, 43, 'qw5e6r56t7', '2020-02-24 10:56:11', 'upload/5e53abcb38246.png', 0, 0),
(121, 43, 'byth', '2020-02-24 10:56:16', 'upload/5e53abd0b5962.png', 0, 0),
(122, 43, 'feececcececececece', '2020-02-24 14:25:57', 'upload/5e53dcf571ea9.png', 0, 2),
(123, 47, 'dewfewfewf', '2020-02-24 20:15:15', 'upload/5e542ed3a4d05.png', 0, 3),
(124, 51, 'ywrthrt', '2020-02-25 19:16:49', 'upload/5e5572a1b9f32.png', 1, 2),
(125, 51, 'dede', '2020-02-25 19:16:56', 'upload/5e5572a89a682.png', 0, 7),
(126, 46, 'cqwece', '2020-02-26 21:43:07', 'upload/5e56e66bb062d.png', 0, 0),
(127, 51, 'vrrvrvrvrv', '2020-02-27 12:37:34', 'upload/5e57b80e35a92.png', 1, 0),
(128, 51, 'dedede', '2020-02-27 19:58:54', 'upload/5e581f7e448f6.png', 0, 0),
(129, 51, 'dedede', '2020-02-27 20:26:53', 'upload/5e58260dc1667.png', 0, 0),
(130, 51, 'dede', '2020-02-27 20:26:57', 'upload/5e582611e0905.png', 0, 0),
(131, 51, 'dededed', '2020-02-29 01:24:57', 'upload/5e59bd6927ac3.png', 1, 0),
(132, 51, 'ssss', '2020-02-29 21:46:33', 'upload/5e5adbb9151cc.png', 0, 0),
(133, 51, 'ssss', '2020-02-29 21:48:45', 'upload/5e5adc3dca3fe.png', 0, 0),
(134, 51, 'dede', '2020-03-01 14:10:12', 'upload/5e5bc244812d1.png', 0, 0),
(135, 51, 'dedededede', '2020-03-01 14:10:31', 'upload/5e5bc2577e17f.png', 0, 0),
(136, 51, 'dede', '2020-03-01 14:10:36', 'upload/5e5bc25c06fa4.png', 0, 0),
(137, 51, 'this is a simple picture with joker filter', '2020-03-01 15:00:43', 'upload/5e5bce1ba59d5.png', 0, 0),
(138, 51, 'ghjkl;', '2020-03-01 17:00:05', 'upload/5e5bea15a441f.png', 0, 0),
(139, 51, 'deded', '2020-03-01 17:24:56', 'upload/5e5befe82401d.png', 0, 0),
(140, 51, 'dedcdscvsdvdsvds', '2020-03-01 17:25:05', 'upload/5e5beff1c75b2.png', 0, 0),
(141, 51, 'fefefefe', '2020-03-01 20:03:58', 'upload/5e5c152ed15a9.png', 0, 0),
(142, 51, 'wow', '2020-03-01 20:04:05', 'upload/5e5c1535d66a9.png', 0, 0),
(143, 51, 'cececece', '2020-03-01 20:11:27', 'upload/5e5c16ef2886b.png', 0, 0),
(145, 51, 'ddd', '2020-03-01 20:11:48', 'upload/5e5c170491bd2.png', 0, 0),
(146, 51, 'cool', '2020-03-01 20:12:02', 'upload/5e5c17124b93f.png', 0, 0),
(147, 51, 'this is me and biggy and the filter', '2020-03-01 20:24:17', 'upload/5e5c19f12f7ab.png', 0, 0),
(148, 51, 'biggy', '2020-03-01 20:24:41', 'upload/5e5c1a09b7919.png', 0, 0),
(149, 51, 'bdbgg', '2020-03-01 20:25:19', 'upload/5e5c1a2f3d5c7.png', 0, 0),
(151, 51, 'dedede', '2020-03-01 20:28:54', 'upload/5e5c1b0602fae.png', 0, 0),
(152, 51, 'ytuktilouilio', '2020-03-02 13:19:14', 'upload/5e5d07d2d64fa.png', 2, 1),
(153, 46, 'hello', '2020-03-02 13:20:05', 'upload/5e5d080523850.png', 1, 1),
(154, 51, 'ghfhg', '2020-03-02 13:48:37', 'upload/5e5d0eb5c23ec.png', 0, 0),
(155, 51, 'ssss', '2020-03-02 13:54:53', 'upload/5e5d102d0751e.png', 0, 0),
(156, 51, 'aaaa', '2020-03-02 13:55:47', 'upload/5e5d1063de431.png', 0, 0),
(157, 51, 'ssss', '2020-03-02 13:56:08', 'upload/5e5d107833e4e.png', 0, 0),
(158, 51, 'ssss', '2020-03-02 14:04:03', 'upload/5e5d12534b3c5.png', 0, 0),
(159, 51, 'ssss', '2020-03-02 14:13:33', 'upload/5e5d148d00565.png', 0, 0),
(160, 51, 'sssss', '2020-03-02 14:14:58', 'upload/5e5d14e24663e.png', 0, 0),
(161, 51, 'sssss', '2020-03-02 14:16:38', 'upload/5e5d1546acb4b.png', 0, 0),
(162, 51, 'sss', '2020-03-02 14:16:46', 'upload/5e5d154ecf891.png', 0, 0),
(163, 51, 'sss', '2020-03-02 14:20:06', 'upload/5e5d16161c14e.png', 0, 0),
(164, 51, 'ssss', '2020-03-02 14:24:58', 'upload/5e5d173a1f5e5.png', 0, 0),
(165, 51, 'ssss', '2020-03-02 14:29:45', 'upload/5e5d1859d8c5f.png', 0, 0),
(166, 51, 'ssss', '2020-03-02 14:29:50', 'upload/5e5d185e30a3c.png', 0, 0),
(167, 51, 'sss', '2020-03-02 14:30:18', 'upload/5e5d187ac4f69.png', 0, 0),
(168, 51, '78t8yu9i', '2020-03-02 21:02:37', 'upload/5e5d746d06015.png', 0, 0),
(169, 51, 'fewfwf', '2020-03-02 21:03:46', 'upload/5e5d74b2cd190.png', 0, 0),
(170, 51, 'sdgfdfg', '2020-03-02 21:09:23', 'upload/5e5d7603c6805.png', 0, 0),
(171, 51, '[o[o[', '2020-03-02 21:11:34', 'upload/5e5d7686453be.png', 0, 0),
(172, 51, 'vbhjk', '2020-03-02 21:11:57', 'upload/5e5d769d6ada8.png', 0, 0),
(173, 51, 'ghjkuikl', '2020-03-02 21:12:02', 'upload/5e5d76a287705.png', 0, 0),
(174, 51, 'ihy8l', '2020-03-02 21:12:07', 'upload/5e5d76a79d439.png', 0, 0),
(175, 51, '23etrytuu', '2020-03-02 21:31:23', 'upload/5e5d7b2b486d5.png', 0, 0),
(176, 51, 'd', '2020-03-02 21:39:31', 'upload/5e5d7d138642b.png', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `display_name` varchar(255) NOT NULL,
  `email` varchar(225) NOT NULL,
  `password` varchar(255) NOT NULL,
  `cle` varchar(32) NOT NULL,
  `actif` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `notification` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `display_name`, `email`, `password`, `cle`, `actif`, `created_at`, `notification`) VALUES
(44, 'kbahrar', 'yavow17735@qmailers.com', '$2y$10$2QZdxkJzB1JEtCLiVwrmIOlxbuFp/2/yuyxAEPQMoo0C1uM/WpO9i', '994e151cc3ca7129d0d77d1f036a2bf0', 1, '2020-02-13 13:50:12', 1),
(45, 'Youssef', 'sanal12245@mailmink.com', '$2y$10$t9puBMeNkCwrnBz0EaN.E.Fs0QK5kMzMTCOL.heJpma8ZU/iQcFNG', 'd3b865349e5cbc108442d1f650e3dbdc', 1, '2020-02-13 22:45:44', 1),
(46, 'ybenbrai', 'earthian.man@gmail.com', '$2y$10$jD//H0jGDFH92.Wh.DCxfudx32ndcn6vn8WD4Z/DSNm/OoZyFE5Lm', '8ccb481bf0b310017f06f1cca834e285', 1, '2020-02-15 15:25:42', 0),
(51, 'khimya', 'benbraitit@gmail.com', '$2y$10$dmkFKKrmO7JB29M6qfjJtOGlx.3LWMac4lJPCC9fdRS52tbBCcrBG', 'b59e9b49f71171d0c4c11c221308b107', 1, '2020-02-25 14:13:35', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cmnt`
--
ALTER TABLE `cmnt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `cmnt`
--
ALTER TABLE `cmnt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=207;
--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=177;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
