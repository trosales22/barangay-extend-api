-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 08, 2017 at 02:30 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbbarangayextend`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblbarangay`
--

CREATE TABLE `tblbarangay` (
  `BarangayID` int(255) NOT NULL,
  `BarangayName` varchar(255) NOT NULL,
  `BarangayDescription` varchar(3000) NOT NULL,
  `BarangayLogo` varchar(1000) NOT NULL,
  `DateAndTimeAdded` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblbarangay`
--

INSERT INTO `tblbarangay` (`BarangayID`, `BarangayName`, `BarangayDescription`, `BarangayLogo`, `DateAndTimeAdded`) VALUES
(1, 'TOCLONG', 'Sample Description', 'http://192.168.1.8/Barangay%20Extend/images/barangay_logo/1.png', 'September 22, 2017 | 05:15 PM');

-- --------------------------------------------------------

--
-- Table structure for table `tblfaq`
--

CREATE TABLE `tblfaq` (
  `ID` int(255) NOT NULL,
  `Question` varchar(1000) NOT NULL,
  `Answer` varchar(1000) NOT NULL,
  `DateAndTimeAdded` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblposts`
--

CREATE TABLE `tblposts` (
  `ID` int(255) NOT NULL,
  `TopicTitle` varchar(255) NOT NULL,
  `TopicDescription` varchar(3000) NOT NULL,
  `TopicImage` varchar(1000) NOT NULL,
  `TopicLocationID` varchar(1000) NOT NULL,
  `TopicLocationName` varchar(1000) NOT NULL,
  `TopicLocationAddress` varchar(1000) NOT NULL,
  `TopicType` varchar(255) NOT NULL,
  `TopicPostedBy` varchar(255) NOT NULL,
  `TopicPosterBarangay` varchar(255) NOT NULL,
  `TopicDateAndTimePosted` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblposts`
--

INSERT INTO `tblposts` (`ID`, `TopicTitle`, `TopicDescription`, `TopicImage`, `TopicLocationID`, `TopicLocationName`, `TopicLocationAddress`, `TopicType`, `TopicPostedBy`, `TopicPosterBarangay`, `TopicDateAndTimePosted`) VALUES
(1, 'SM Bacoor', 'SM City Bacoor is a shopping mall in Brgy. Habay in the City of Bacoor, Cavite in the Philippines.', 'http://192.168.1.8/Barangay%20Extend/images/posts/1.png', 'ChIJMW7bo3nSlzMR1Qyq3HYog_4', 'SM Bacoor', 'Tirona Hwy, Bacoor, 4102 Cavite, Philippines', 'Places of Interest', '4f094db3a99b11e7909a60a44cdac4b1', 'TOCLONG', 'October 06, 2017 | 12:07 PM');

-- --------------------------------------------------------

--
-- Table structure for table `tblquestions`
--

CREATE TABLE `tblquestions` (
  `ID` int(255) NOT NULL,
  `Question` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblquestions`
--

INSERT INTO `tblquestions` (`ID`, `Question`) VALUES
(1, 'Who is your favorite teacher or professor?'),
(2, 'What is the name of your favorite pet?'),
(3, 'What is the last name of the teacher who gave you your first failing grade?');

-- --------------------------------------------------------

--
-- Table structure for table `tblrequests`
--

CREATE TABLE `tblrequests` (
  `RequestID` int(255) NOT NULL,
  `RequestedBy` varchar(255) NOT NULL,
  `RequestStatus` varchar(255) NOT NULL,
  `RequestedPosition` varchar(255) NOT NULL,
  `RequesterBarangay` varchar(255) NOT NULL,
  `RequestDateAndTimeRegistered` varchar(255) NOT NULL,
  `RequestDateAndTimeConfirmed` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblrequests`
--

INSERT INTO `tblrequests` (`RequestID`, `RequestedBy`, `RequestStatus`, `RequestedPosition`, `RequesterBarangay`, `RequestDateAndTimeRegistered`, `RequestDateAndTimeConfirmed`) VALUES
(2, '4f094db3a99b11e7909a60a44cdac4b1', 'Declined', 'Resident', 'TOCLONG', 'October 09, 2017 | 10:31 AM', 'October 09, 2017 | 10:41 AM');

-- --------------------------------------------------------

--
-- Table structure for table `tblusers`
--

CREATE TABLE `tblusers` (
  `ID` int(255) NOT NULL,
  `UserID` binary(16) NOT NULL,
  `Firstname` varchar(255) NOT NULL,
  `Lastname` varchar(255) NOT NULL,
  `EmailAddress` varchar(255) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `PhoneNumber` varchar(255) NOT NULL,
  `Gender` varchar(255) NOT NULL,
  `ProfilePicture` varchar(1000) NOT NULL,
  `UserType` varchar(255) NOT NULL,
  `UserStatus` varchar(255) NOT NULL,
  `Barangay` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `SecretQuestion` varchar(255) NOT NULL,
  `SecretAnswer` varchar(255) NOT NULL,
  `DateAndTimeRegistered` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblusers`
--

INSERT INTO `tblusers` (`ID`, `UserID`, `Firstname`, `Lastname`, `EmailAddress`, `Username`, `PhoneNumber`, `Gender`, `ProfilePicture`, `UserType`, `UserStatus`, `Barangay`, `Password`, `SecretQuestion`, `SecretAnswer`, `DateAndTimeRegistered`) VALUES
(1, 0x4f094db3a99b11e7909a60a44cdac4b1, 'Tristan Jules', 'Rosales', 'tristanrosales0@gmail.com', 'tristan.rosales', '09979859471', 'Male', 'http://192.168.1.8/Barangay%20Extend/images/profile_picture/1.png', 'Developer', 'Verified', 'TOCLONG', 'blocker48', 'Who is your favorite teacher or professor?', 'Kaycee Robles Mendez', 'October 05, 2017 | 12:03 AM');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblbarangay`
--
ALTER TABLE `tblbarangay`
  ADD PRIMARY KEY (`BarangayID`);

--
-- Indexes for table `tblfaq`
--
ALTER TABLE `tblfaq`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblposts`
--
ALTER TABLE `tblposts`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblquestions`
--
ALTER TABLE `tblquestions`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblrequests`
--
ALTER TABLE `tblrequests`
  ADD PRIMARY KEY (`RequestID`);

--
-- Indexes for table `tblusers`
--
ALTER TABLE `tblusers`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblbarangay`
--
ALTER TABLE `tblbarangay`
  MODIFY `BarangayID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblfaq`
--
ALTER TABLE `tblfaq`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblposts`
--
ALTER TABLE `tblposts`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblquestions`
--
ALTER TABLE `tblquestions`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblrequests`
--
ALTER TABLE `tblrequests`
  MODIFY `RequestID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblusers`
--
ALTER TABLE `tblusers`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
