-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Jan 04, 2026 at 05:41 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ourmusic`
--

-- --------------------------------------------------------

--
-- Table structure for table `music`
--

CREATE TABLE `music` (
  `id` int(11) UNSIGNED NOT NULL,
  `nama` varchar(150) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `penyanyi` varchar(100) NOT NULL,
  `tahun` year(4) NOT NULL,
  `gambar` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `music`
--

INSERT INTO `music` (`id`, `nama`, `kategori`, `penyanyi`, `tahun`, `gambar`) VALUES
(12, 'Secukupnya', 'Pop Indonesia', 'Hindia', '2019', 'secukupnya.jpg'),
(13, 'Home', 'Pop Soul', 'Bruno Major', '2017', 'home.jpg'),
(14, 'Star', 'K-R&B', 'Colde', '2021', 'star.jfif'),
(15, 'Nina', 'Alternative Rock', '.feast', '2019', 'nina.jpg'),
(16, 'Peradaban', 'Alternative Rock', '.feast', '2018', 'nina.jpg'),
(17, 'Konsekuens', 'Alternative Rock', '.feast', '2023', 'nina.jpg'),
(18, 'Best Part', 'R&B', 'Daniel Caesar ft. H.E.R.', '2017', 'bestpart.jpg'),
(19, 'Japanese Denim', 'R&B', 'Daniel Caesar', '2016', 'bestpart.jpg'),
(20, 'Always', 'R&B', 'Daniel Caesar', '2023', 'bestpart.jpg'),
(21, 'Best Part', 'R&B', 'Daniel Caesar', '2017', NULL),
(22, 'Best Part', 'R&B', 'Daniel Caesar ', '2017', NULL),
(23, 'Secukupnya', 'Pop Indonesia', 'Hindia Belanda', '2019', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `playlist`
--

CREATE TABLE `playlist` (
  `id_playlist` int(11) NOT NULL,
  `id` int(11) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `playlist`
--

INSERT INTO `playlist` (`id_playlist`, `id`, `username`) VALUES
(2, 7, 'fahri'),
(4, 11, 'adminin'),
(5, 12, 'adminin'),
(6, 14, 'adminin'),
(7, 11, 'nanana'),
(8, 14, 'nanana'),
(9, 15, 'adminey'),
(11, 13, 'andre12');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `role`) VALUES
(1, 'fahri', 'fahri@gmail.com', '$2y$10$/xdWpeWw3seT8EOudSSZneVBrn6SOioooesW5ByxtW9kNi27znBGW', 'user'),
(13, 'admin', 'admin@gmail.com', '$2y$10$NpFay5Ot7UFzD.OkOvb2m.G8o7l/6hIgZK2LYpu6RTKSvsyIr20fC', 'admin'),
(14, 'adminey', 'adminin@gamil.com', '$2y$10$ow5yuic2T7KOJBP/deXL7eFA5IB.NdFJmOrNzwLUX23TZbXwfqNGS', 'admin'),
(15, 'nanana', 'nanana@gmail.com', '$2y$10$Ek9j2ZO7Gw.xO059TEAXJehBNApFGsx.MU0xUAuWHkiUri.h.kIFO', 'admin'),
(16, 'andre12', 'andre@gmail.com', '$2y$10$az9jSJjeEiqZPVJv7F9pZe9edLoQqOGNA1cFYwZvz0LW5IAorxrye', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `music`
--
ALTER TABLE `music`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `playlist`
--
ALTER TABLE `playlist`
  ADD PRIMARY KEY (`id_playlist`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `music`
--
ALTER TABLE `music`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `playlist`
--
ALTER TABLE `playlist`
  MODIFY `id_playlist` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
