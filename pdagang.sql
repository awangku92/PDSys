-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 15, 2018 at 07:47 AM
-- Server version: 5.7.11
-- PHP Version: 7.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pdagang`
--

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `BranchesID` varchar(50) NOT NULL,
  `UID` int(11) NOT NULL,
  `Address1` text NOT NULL,
  `Address2` text NOT NULL,
  `Postcode` int(11) NOT NULL,
  `State` varchar(50) NOT NULL,
  `Region` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `CategoryID` varchar(50) NOT NULL,
  `CategoryType` varchar(50) NOT NULL,
  `Priority` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`CategoryID`, `CategoryType`, `Priority`) VALUES
('D1', 'Damaged pump', 1),
('D2', 'Petrol  did not come out', 2),
('D3', 'Damaged auto nozel ', 3),
('D4', 'Petrol price is not tally', 4);

-- --------------------------------------------------------

--
-- Table structure for table `logtickets`
--

CREATE TABLE `logtickets` (
  `SearchID` int(11) NOT NULL,
  `TIcketID` varchar(50) NOT NULL,
  `UID` int(11) NOT NULL,
  `DateTime` datetime NOT NULL,
  `PostponeDateTime` datetime DEFAULT NULL,
  `StatusID` varchar(50) NOT NULL,
  `Reason` text NOT NULL,
  `UIDContractor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logtickets`
--

INSERT INTO `logtickets` (`SearchID`, `TIcketID`, `UID`, `DateTime`, `PostponeDateTime`, `StatusID`, `Reason`, `UIDContractor`) VALUES
(57, '20180815_1208_TIC1', 19, '2018-08-15 12:08:44', NULL, 'IP', '', 0),
(60, '20180815_1208_TIC1', 19, '2018-08-15 12:08:44', '2018-08-15 14:02:00', 'IP', '', 21),
(61, '20180815_0212_TIC2', 19, '2018-08-15 14:12:43', NULL, 'IP', '', 0),
(62, '20180815_0212_TIC2', 19, '2018-08-15 14:12:43', '2018-08-15 14:27:00', 'IP', '', 21);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `StatusID` varchar(50) NOT NULL,
  `StatusDetail` text NOT NULL,
  `Description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`StatusID`, `StatusDetail`, `Description`) VALUES
('C', 'Close', 'Can only be assigned when Dealer assigned Done Status'),
('D', 'Done', 'Can only be assigned only by Dealer'),
('I', 'Incomplete', 'If contractor cannot finish on time, Contractor will deal with Dealer for new date'),
('IP', 'Inprogress', 'When ticket is created by Dealer, and assigned Contractor and Date by HQ (Default Status)'),
('P', 'Postpone', 'If both party inform by the Contractor why they cannot come on the date');

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `TicketID` varchar(50) NOT NULL,
  `UID` int(50) NOT NULL,
  `SearchID` int(11) NOT NULL,
  `DateTime` datetime NOT NULL,
  `State` varchar(50) NOT NULL,
  `CategoryID` varchar(50) NOT NULL,
  `StatusID` varchar(50) NOT NULL,
  `Detail` text NOT NULL,
  `UIDContractor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`TicketID`, `UID`, `SearchID`, `DateTime`, `State`, `CategoryID`, `StatusID`, `Detail`, `UIDContractor`) VALUES
('20180815_0212_TIC2', 19, 44, '2018-08-15 14:12:43', 'Selangor', 'D2', 'IP', 'leaking ', 21),
('20180815_1208_TIC1', 19, 43, '2018-08-15 12:08:44', 'Selangor', 'D1', 'IP', 'Stolen pump', 21);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UID` int(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `UserType` varchar(20) NOT NULL,
  `CompanyName` varchar(50) DEFAULT NULL,
  `CompAddress1` text,
  `CompAddress2` text,
  `Postcode` int(10) DEFAULT NULL,
  `State` varchar(50) DEFAULT NULL,
  `Region` varchar(50) DEFAULT NULL,
  `FullName` varchar(100) DEFAULT NULL,
  `Contact` varchar(20) DEFAULT NULL,
  `UserStatus` int(11) NOT NULL DEFAULT '0',
  `Branch` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UID`, `Email`, `Password`, `UserType`, `CompanyName`, `CompAddress1`, `CompAddress2`, `Postcode`, `State`, `Region`, `FullName`, `Contact`, `UserStatus`, `Branch`) VALUES
(18, 'hq@petronas.my', 'hq', 'HQ', NULL, NULL, NULL, NULL, NULL, NULL, 'Petronas HQ', '0191234567', 1, NULL),
(19, 'didiy@petronas.my', 'didiy', 'D', NULL, 'Jln Sepah Puteri', 'KD', 12345, 'Selangor', 'Central', 'Didiy Harjono', '031234567', 1, 'Kota Damansara'),
(20, 'mi@petronas.my', 'mi', 'D', NULL, 'Tepi masjid', 'dekat melaka', 54321, 'Melaka', 'Southern', 'Miey Azwa', '012345678', 1, 'Masjid Tanah'),
(21, 'fairus@petronas.my', 'fairus', 'C', 'Contractor Petronas 1', 'PJTC', 'Damansara Perdana', 56789, 'Selangor', 'Central', 'Fairus Munir', '0123456789', 1, NULL),
(22, 'awang@petronas.my', 'awang', 'C', 'Contractor Petronas 2', 'Bandar Melaka', 'dekat melaka', 23123, 'Melaka', 'Southern', 'Awang', '0123456789', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `usertype`
--

CREATE TABLE `usertype` (
  `UserType` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usertype`
--

INSERT INTO `usertype` (`UserType`) VALUES
('C'),
('D'),
('HQ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`BranchesID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`CategoryID`);

--
-- Indexes for table `logtickets`
--
ALTER TABLE `logtickets`
  ADD PRIMARY KEY (`SearchID`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`StatusID`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`TicketID`),
  ADD UNIQUE KEY `SearchID` (`SearchID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UID`);

--
-- Indexes for table `usertype`
--
ALTER TABLE `usertype`
  ADD PRIMARY KEY (`UserType`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `logtickets`
--
ALTER TABLE `logtickets`
  MODIFY `SearchID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `SearchID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
