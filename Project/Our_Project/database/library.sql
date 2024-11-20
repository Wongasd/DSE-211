-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2024 at 04:29 PM
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
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `AuthorID` int(11) NOT NULL,
  `FirstName` varchar(100) DEFAULT NULL,
  `LastName` varchar(100) DEFAULT NULL,
  `Image` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`AuthorID`, `FirstName`, `LastName`, `Image`, `Description`) VALUES
(1, '1231', '12313', '', '321'),
(2, '321', '123', '', '123'),
(3, 'asdasd', 'asdasda', '', '123234'),
(4, 'Brain', 'Heaveny', 'db_image/firepunch.jpg', 'she POG');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `BookID` int(11) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `AuthorID` int(11) DEFAULT NULL,
  `PublisherID` int(11) DEFAULT NULL,
  `PublishedYear` date DEFAULT NULL,
  `GenreID` int(11) DEFAULT NULL,
  `Quantity` int(11) DEFAULT 1,
  `Image` varchar(52) NOT NULL,
  `Description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`BookID`, `Title`, `AuthorID`, `PublisherID`, `PublishedYear`, `GenreID`, `Quantity`, `Image`, `Description`) VALUES
(5, 'dsadasd', 1, 1, '2024-11-05', 2, 7, 'db_image/673c11432b175.png', 'POG'),
(6, 'Jojo', 2, 7, '2011-11-12', 1, 6, 'db_image/but_I_refuse.jpg', 'YEEEEEEEEEEEEEEEEEEEEEEE'),
(7, '60 Seconds', 4, 6, '1991-12-31', 1, 5, 'db_image/673d92cf68eb7.jpg', 'every 60 seconds, A minute pass');

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `GenreID` int(11) NOT NULL,
  `GenreName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`GenreID`, `GenreName`) VALUES
(2, 'Comedy'),
(1, 'Fantasy');

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE `permission` (
  `PermissionID` int(52) NOT NULL,
  `PermissionName` varchar(52) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`PermissionID`, `PermissionName`) VALUES
(1, 'Admin'),
(2, 'User'),
(3, 'Librarian');

-- --------------------------------------------------------

--
-- Table structure for table `publishers`
--

CREATE TABLE `publishers` (
  `PublisherID` int(11) NOT NULL,
  `PublisherName` varchar(255) NOT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `Phone` varchar(15) DEFAULT NULL,
  `Image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `publishers`
--

INSERT INTO `publishers` (`PublisherID`, `PublisherName`, `Address`, `Phone`, `Image`) VALUES
(6, 'Steven', 'no.1 taman beach, lkjfshlakjsfdh', '+6011232134', 'db_image/Fubuki_heh.jpg'),
(7, 'jkljkljl', 'uoukuikujhjkkh', '+601212321542', 'db_image/publisher_673d87ede364c.gif');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `TransactionID` int(11) NOT NULL,
  `BookID` int(11) DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL,
  `BorrowDate` date NOT NULL,
  `ReturnDate` date DEFAULT NULL,
  `DueDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `FirstName` varchar(100) DEFAULT NULL,
  `LastName` varchar(100) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Phone` varchar(15) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `MembershipDate` date DEFAULT NULL,
  `Permission` varchar(15) NOT NULL,
  `Image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `FirstName`, `LastName`, `Password`, `Email`, `Phone`, `Address`, `MembershipDate`, `Permission`, `Image`) VALUES
(14, 'asd', 'dsa', '$2y$10$V5DoELPqLe0f6o3uvydyIe2ArtS26JqPoy4bdQfEcTZ6dL1UKefZ6', 'asd@gmail.com', '+601231312312', 'asdasdadad', '2024-11-19', '1', NULL),
(15, 'Mike', 'Tyson', '$2y$10$PSOXk5yqr6DdlH5hkJzpzOc/Ic66vvUFMpTDA29dPI451Bf7UxoXq', 'mike@gmail.com', '+601098340982', 'mike,, mike mike, mike mike', '2024-11-20', '2', 'db_image/(COCO)NUT.png'),
(16, 'Lib', 'Bil', '$2y$10$AzWIvwpuEad7zRrCIO5XfOI1tKZEKOfGBFodeFCU1VZ5WQuLf1o42', 'lib@gmail.com', '+601231231231', '', '2024-11-20', '3', '673dfaf2243521.65232657.jpg'),
(17, 'Test', 'Testtt', '$2y$10$SCMs9X5Y.PczdZqTrbW8SuV9ItG85MD1ahZmt18sc3In5ULF7E1W2', 'test@gmail.com', '+601241344512', 'odssflajsjdfhnsaljkdfb', '2024-11-20', '3', '673dfbcecdfac6.57081833.jpg'),
(18, 'dasfsvgfdhg', 'dsvgfbhgnfm', '$2y$10$Qtyjs0IG9yq1EPmopC7Gb.zWQ8CNla9.WHcJIyfgkAX86l.gKdqNS', 'jkl@gmail.com', '+6012345678', 'adfvsgfbdhtjhyfjg,k', '2024-11-20', '3', '673dfd22401998.51669577.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`AuthorID`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`BookID`),
  ADD UNIQUE KEY `AuthorID_2` (`AuthorID`),
  ADD UNIQUE KEY `PublisherID` (`PublisherID`),
  ADD KEY `AuthorID` (`AuthorID`),
  ADD KEY `PublishersID` (`PublisherID`),
  ADD KEY `Genre` (`GenreID`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`GenreID`),
  ADD UNIQUE KEY `GenreName` (`GenreName`);

--
-- Indexes for table `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`PermissionID`);

--
-- Indexes for table `publishers`
--
ALTER TABLE `publishers`
  ADD PRIMARY KEY (`PublisherID`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`TransactionID`),
  ADD KEY `BookID` (`BookID`),
  ADD KEY `BorrowerID` (`UserID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `AuthorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `BookID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `GenreID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
  MODIFY `PermissionID` int(52) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `publishers`
--
ALTER TABLE `publishers`
  MODIFY `PublisherID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `TransactionID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`AuthorID`) REFERENCES `authors` (`AuthorID`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`BookID`) REFERENCES `books` (`BookID`),
  ADD CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
