-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2022 at 08:56 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `comp_attendance`
--

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` text NOT NULL,
  `mobileno` text NOT NULL,
  `semester` varchar(50) NOT NULL,
  `prn` varchar(50) NOT NULL,
  `division` varchar(10) NOT NULL,
  `dsa` int(11) NOT NULL,
  `dsatotal` int(11) NOT NULL,
  `ppl` int(11) NOT NULL,
  `ppltotal` int(11) NOT NULL,
  `mp` int(11) NOT NULL,
  `mptotal` int(11) NOT NULL,
  `m3` int(11) NOT NULL,
  `m3total` int(11) NOT NULL,
  `se` int(11) NOT NULL,
  `setotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `email`, `mobileno`, `semester`, `prn`, `division`, `dsa`, `dsatotal`, `ppl`, `ppltotal`, `mp`, `mptotal`, `m3`, `m3total`, `se`, `setotal`) VALUES
(1, 'Praful', 'praful@gmail.com', '8796452130', 'fourth', 'ABC132', 'A', 33, 34, 1, 1, 1, 1, 1, 1, 1, 1),
(2, 'Ajinkya', 'ajinkya@gmail.com', '8987456218', 'fourth', 'ABS1234', 'A', 34, 34, 1, 1, 1, 1, 1, 1, 1, 1),
(3, 'Prathamesh', 'prathamesh@gmail.com', '8987456218', 'fourth', 'ABC123', 'A', 33, 33, 1, 1, 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `subid` int(50) NOT NULL DEFAULT 1,
  `subname` varchar(50) NOT NULL,
  `subshort` varchar(50) NOT NULL,
  `subsemester` int(50) NOT NULL,
  `subyear` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subid`, `subname`, `subshort`, `subsemester`, `subyear`) VALUES
(1, 'Data Structures and Algorithm', 'DSA', 4, 'second'),
(2, 'Principle of Programming Language', 'PPL', 4, 'second'),
(3, 'Microprocessor', 'MP', 4, 'second'),
(4, 'Mathematics 3', 'M3', 4, 'second'),
(5, 'Software Engineering', 'SE', 4, 'second');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `qualification` varchar(50) NOT NULL,
  `joiningdate` date NOT NULL,
  `password` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `fourthsemsubjects` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `mobile`, `qualification`, `joiningdate`, `password`, `image`, `role`, `username`, `fourthsemsubjects`) VALUES
(101, 'Vaishnavi Dobe', 'vaishnavidobe@gmail.com', '7896545218', 'BE', '2022-04-02', '123', '71110profile.jpg', 'faculty', 'vaishnavi', 'PPL'),
(102, 'Harshada Khadilkar', 'harshada@gmail.com', '1230547854', 'BE', '2022-04-01', '123456', '57424profile.jpg', 'faculty', 'harshada', 'DSA'),
(103, 'Saurabh Kamble', 'saurabhkamble@gmail.com', '1023258741', 'BE', '2022-04-01', '123456', '25812profile.jpg', 'faculty', 'saurabh', 'MP'),
(999, 'Aniket Dobe', 'hi@aniketdobe.ml', '9874563210', 'BE', '2022-03-03', '123456', '43632download.jpg', 'admin', 'admin', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `prn` (`prn`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`subid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4849;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13232;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
