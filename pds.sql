-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 27, 2018 at 01:26 PM
-- Server version: 5.7.11
-- PHP Version: 7.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pds`
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

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`BranchesID`, `UID`, `Address1`, `Address2`, `Postcode`, `State`, `Region`) VALUES
('KD', 2, 'KD Addr l1', 'KD Addr l2', 40400, 'Selangor', 'C'),
('MD', 2, 'MD Addr l1', 'MD Addr l2', 40000, 'Selangor', 'C'),
('SBH', 3, 'SBH Addr l1', 'SBH Addr l2', 54321, 'Sabah', 'SB'),
('SRK', 3, 'SRK Addr l1', 'SRK Addr l2', 43215, 'Sarawak', 'SK'),
('TG', 2, 'TG Addr l1', 'TG Addr l2', 21345, 'Terengganu', 'E');

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

INSERT INTO `logtickets` (`TIcketID`, `UID`, `DateTime`, `PostponeDateTime`, `StatusID`, `Reason`, `UIDContractor`) VALUES
('20180301_1330_TIC001', 2, '2018-03-01 13:30:00', NULL, 'I', '', 6),
('20180301_1330_TIC001', 2, '2018-03-01 13:30:00', NULL, 'D', '', 6),
('20180301_1330_TIC002', 2, '2018-03-03 09:30:00', NULL, 'I', '', 4),
('20180301_1530_TIC003', 3, '2018-03-01 15:30:00', NULL, 'I', '', 5),
('20180303_1330_TIC004', 3, '2018-03-03 13:30:00', NULL, 'I', '', 5),
('20180303_1330_TIC004', 3, '2018-03-03 13:30:00', '2018-03-10 13:30:00', 'P', '', 5),
('20180201_1330_TIC005', 2, '2018-02-01 13:30:00', NULL, 'I', '', 4),
('20180201_1330_TIC005', 2, '2018-02-01 13:30:00', NULL, 'D', '', 4),
('20180201_1330_TIC005', 2, '2018-02-01 13:30:00', NULL, 'C', '', 4);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `StatusID` varchar(50) NOT NULL,
  `StatusDetail` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`StatusID`, `StatusDetail`) VALUES
('C', 'Close'),
('D', 'Done'),
('IC', 'Incomplete'),
('IP', 'Inprogress'),
('P', 'Postpone');

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `TicketID` varchar(50) NOT NULL,
  `UID` int(50) NOT NULL,
  `SearchID` int(11) NOT NULL,
  `DateTime` datetime NOT NULL,
  `BranchID` varchar(50) NOT NULL,
  `CategoryID` varchar(50) NOT NULL,
  `StatusID` varchar(50) NOT NULL,
  `Detail` text NOT NULL,
  `UIDContractor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`TicketID`, `UID`, `SearchID`, `DateTime`, `BranchID`, `CategoryID`, `StatusID`, `Detail`, `UIDContractor`) VALUES
('20180201_1330_TIC005', 2, 5, '2018-02-01 13:30:00', 'MD', 'D3', 'C', 'Auto nozel problem', 4),
('20180301_1330_TIC001', 2, 1, '2018-03-01 13:30:00', 'KD', 'D1', 'D', 'Pump has been damaged, need immediate repair. ', 6),
('20180301_1530_TIC003', 3, 3, '2018-03-01 15:30:00', 'SBH', 'D1', 'I', 'Pump damaged, need to replace', 5),
('20180303_0930_TIC002', 2, 2, '2018-03-03 09:30:00', 'TG', 'D2', 'I', 'Petrol did not come out. Need to check', 4),
('20180303_1330_TIC004', 3, 4, '2018-03-03 13:30:00', 'SRK', 'D4', 'P', 'Price is not tally, might becaused of another reason, need to recheck', 5);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UID` int(50) NOT NULL,
  `Username` varchar(50) NOT NULL,
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
  `UserStatus` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UID`, `Username`, `Password`, `UserType`, `CompanyName`, `CompAddress1`, `CompAddress2`, `Postcode`, `State`, `Region`, `FullName`, `Contact`, `UserStatus`) VALUES
(1, 'HQ1', 'HQ1', 'HQ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(2, 'D1', 'D1', 'D', NULL, '', '', NULL, NULL, NULL, NULL, NULL, 0),
(3, 'D2', 'D2', 'D', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(4, 'C1', 'C1', 'C', 'Company Contractor 1', 'Comp Addr l1', 'Comp Addr l2', 40400, 'Selangor', 'C', 'Didiy Kacak', '0123456789', 0),
(5, 'C2', 'C2', 'C', 'Company Contractor 2', 'Comp Addr l1', 'Comp Addr l2', 40000, 'Sarawak', 'SK', 'Mie Hensem', '0123456789', 0),
(6, 'C3', 'C3', 'C', 'Company Contractor 3', 'Comp Addr l1', 'Comp Addr l2', 32145, 'Kuala Lumpur', 'C', 'Fairus Bergaya', '0100011001', 0),
(7, 'Fairus', '123456', 'D', 'EFSB', 'Addr1', 'Addr2', 6650, 'Wilayah Persekutuan Kuala Lumpur', 'S', 'Fairus Munir', NULL, 1);

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
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`StatusID`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`TicketID`);

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
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
