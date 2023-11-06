-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Oct 20, 2023 at 06:53 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gwsc`
--

-- --------------------------------------------------------

--
-- Table structure for table `amenity`
--

CREATE TABLE `amenity` (
  `Amenity_ID` int(11) NOT NULL,
  `Description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `amenity`
--

INSERT INTO `amenity` (`Amenity_ID`, `Description`) VALUES
(1, 'Freshwater source'),
(2, 'Campfire ring or stove'),
(3, 'Toilet facilities'),
(4, 'Tents and sleeping gear'),
(5, 'Picnic tables or Campsite benches'),
(6, 'Trash and Recycling receptacles'),
(7, 'First aid kit'),
(8, 'Maps and Information'),
(9, 'Firewood'),
(10, 'Trash bags'),
(11, 'Food and Water'),
(12, 'Swim gear'),
(13, 'Sunscreen and Sun protection'),
(14, 'Camp chairs'),
(15, 'Wildlife protection'),
(16, 'Rain gear'),
(17, 'Internet access'),
(18, 'Showers'),
(19, 'Car parking'),
(20, 'Navigation tools');

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

CREATE TABLE `area` (
  `Area_ID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `area`
--

INSERT INTO `area` (`Area_ID`, `Name`) VALUES
(1, 'England'),
(2, 'Scotland'),
(3, 'Wales'),
(4, 'Northern Ireland');

-- --------------------------------------------------------

--
-- Table structure for table `attraction`
--

CREATE TABLE `attraction` (
  `Attraction_ID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Area_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attraction`
--

INSERT INTO `attraction` (`Attraction_ID`, `Name`, `Area_ID`) VALUES
(1, 'Stonehenge', 1),
(2, 'York Minster', 3),
(3, 'Dover Castle', 4),
(4, 'Blackpool', 2),
(5, 'Edinburgh Castle', 2),
(6, 'Loch Ness', 3),
(7, 'Glasgow', 2),
(8, 'The Hermitage', 1);

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `Booking_ID` int(11) NOT NULL,
  `Checkin` date NOT NULL,
  `Checkout` date NOT NULL,
  `Site_ID` int(11) NOT NULL,
  `Customer_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`Booking_ID`, `Checkin`, `Checkout`, `Site_ID`, `Customer_ID`) VALUES
(1, '2023-10-20', '2023-10-22', 1, 2),
(2, '2023-10-21', '2023-10-22', 4, 1),
(3, '2023-10-26', '2023-10-27', 1, 2),
(4, '2023-10-28', '2023-10-29', 2, 4),
(5, '2023-10-25', '2023-10-26', 5, 3),
(6, '2023-11-01', '2023-11-03', 2, 4),
(7, '2023-11-04', '2023-11-04', 1, 1),
(8, '2023-11-04', '2023-11-05', 3, 2),
(9, '2023-12-01', '2023-12-02', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `Contact_ID` int(11) NOT NULL,
  `Topic` varchar(20) NOT NULL,
  `Title` varchar(30) NOT NULL,
  `Content` text NOT NULL,
  `Customer_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`Contact_ID`, `Topic`, `Title`, `Content`, `Customer_ID`) VALUES
(1, 'camping', 'camping full', 'camping sites are quite small. with proper amount of people it is not efficient', 4),
(2, 'payment', 'paypal', 'i would like to pay for the charge with paypal', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `Customer_ID` int(11) NOT NULL,
  `Username` varchar(20) DEFAULT NULL,
  `First_name` varchar(20) DEFAULT NULL,
  `Last_name` varchar(20) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `Email` varchar(30) DEFAULT NULL,
  `Phone` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`Customer_ID`, `Username`, `First_name`, `Last_name`, `Password`, `Email`, `Phone`) VALUES
(1, 'minthant', 'min', 'thant', '$2y$10$56oWuwlQQCRvkEOQFeb0i.SxRLtN.dqF7chB0nP1ZbarsiVWv2iIy', 'minthant@gmail.com', '09123456789'),
(2, 'shinpaing', 'shin', 'paing', '$2y$10$4C2iJdfpt/7BbChvziCMP.RerwpNvbapm7/vOff4IGi6zTMyWE3vy', 'shinpaing@gmail.com', '09999999999'),
(3, 'kaung', 'kaung', 'kaung', '$2y$10$KgLwAVVbw77dXTBuoFWnPuC/uzsTGpSuxThtbXNhrK3XCR2pibs5G', 'kaung@gmail.com', '097777777777'),
(4, 'niki', 'ni', 'ki', '$2y$10$leLJebC7TqsBTQC4e4VeVerr8YnTMT1diUepqKMzvpKiEhcH6c.Be', 'niki@gmail.com', '0944444444444');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `Review_ID` int(11) NOT NULL,
  `Description` text NOT NULL,
  `Customer_ID` int(11) NOT NULL,
  `Site_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`Review_ID`, `Description`, `Customer_ID`, `Site_ID`) VALUES
(1, 'I recently camped at Starry Nights Camp, and it was a breathtaking experience. The campsite nestled in the Rockies offered stunning views, clean facilities, and friendly staff. The hiking trails nearby were fantastic, and the night skies were perfect for stargazing. I can\'t wait to return!', 1, 2),
(2, 'Adventure Basecamp was a nice one for me. I can\'t wait to go camp like one near future.', 1, 5),
(3, 'Campground Paradise was a major disappointment. The sites were way too close together, providing zero privacy, and the campground was overcrowded. The restrooms were filthy and in desperate need of maintenance. ', 2, 3),
(4, 'Splash Oasis is a gem along the coast. The crystal-clear waters and tide pools are a paradise for swimmers and marine life enthusiasts.', 2, 1),
(5, 'Wavefront Waters lived up to its name, and not in a good way. The water was dirty and full of algae, making it unappealing and unsuitable for swimming.', 3, 4),
(6, 'Starry Nights Camp was a great one!', 3, 2),
(7, 'This place was a disaster. The water in the river was freezing, and the camping spots were cramped. The facilities were a joke.', 4, 5),
(8, 'We were excited about swimming, but the lake was covered in algae, making it impossible to swim without feeling disgusted.', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `site`
--

CREATE TABLE `site` (
  `Site_ID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Category` varchar(50) NOT NULL,
  `Camping_type` varchar(50) DEFAULT NULL,
  `Lat` varchar(100) NOT NULL,
  `Log` varchar(100) NOT NULL,
  `Img_name` varchar(255) NOT NULL,
  `Area_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `site`
--

INSERT INTO `site` (`Site_ID`, `Name`, `Category`, `Camping_type`, `Lat`, `Log`, `Img_name`, `Area_ID`) VALUES
(1, 'Splash Oasis', 'Swimming', NULL, '52.34411', '1.68901', 'Splash Oasis.jpg', 2),
(2, 'Starry Nights Camp', 'Camping', 'Motorhome', '52.61856', '0.71498', 'Starry Nights Camp.jpg', 4),
(3, 'Campground Paradise', 'Camping', 'Caravan', '52.6863', '1.0655', 'Campground Paradise.jpg', 1),
(4, 'Wavefront Waters', 'Swimming', NULL, '52.54368', '1.73548', 'Wavefront Waters.jpg', 3),
(5, 'Adventure Basecamp', 'Camping', 'Tent', '52.42466', '0.71804', 'Adventure Basecamp.jpg', 4);

-- --------------------------------------------------------

--
-- Table structure for table `site_amenity`
--

CREATE TABLE `site_amenity` (
  `Dummy_ID` int(11) NOT NULL,
  `Amenity_ID` int(11) NOT NULL,
  `Site_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `site_amenity`
--

INSERT INTO `site_amenity` (`Dummy_ID`, `Amenity_ID`, `Site_ID`) VALUES
(1, 2, 1),
(2, 13, 1),
(3, 10, 1),
(4, 19, 1),
(5, 2, 5),
(6, 20, 2),
(7, 18, 2),
(8, 17, 2),
(9, 15, 2),
(10, 4, 5),
(11, 9, 3),
(12, 8, 3),
(13, 17, 3),
(14, 11, 3),
(15, 14, 5),
(16, 3, 4),
(17, 1, 4),
(18, 11, 4),
(19, 14, 4),
(20, 6, 5);

-- --------------------------------------------------------

--
-- Table structure for table `viewcount`
--

CREATE TABLE `viewcount` (
  `viewcount_id` int(11) NOT NULL,
  `viewcount_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `viewcount`
--

INSERT INTO `viewcount` (`viewcount_id`, `viewcount_no`) VALUES
(1, 46);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `amenity`
--
ALTER TABLE `amenity`
  ADD PRIMARY KEY (`Amenity_ID`);

--
-- Indexes for table `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`Area_ID`);

--
-- Indexes for table `attraction`
--
ALTER TABLE `attraction`
  ADD PRIMARY KEY (`Attraction_ID`),
  ADD KEY `att_area_fk` (`Area_ID`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`Booking_ID`),
  ADD KEY `book_site_fk` (`Site_ID`),
  ADD KEY `book_customer_fk` (`Customer_ID`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`Contact_ID`),
  ADD KEY `contact_fk` (`Customer_ID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`Customer_ID`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`Review_ID`),
  ADD KEY `cus_review_fk` (`Customer_ID`),
  ADD KEY `site_review_fk` (`Site_ID`);

--
-- Indexes for table `site`
--
ALTER TABLE `site`
  ADD PRIMARY KEY (`Site_ID`),
  ADD KEY `site_area_fk` (`Area_ID`);

--
-- Indexes for table `site_amenity`
--
ALTER TABLE `site_amenity`
  ADD PRIMARY KEY (`Dummy_ID`),
  ADD KEY `amen_fk` (`Amenity_ID`),
  ADD KEY `site_fk` (`Site_ID`);

--
-- Indexes for table `viewcount`
--
ALTER TABLE `viewcount`
  ADD PRIMARY KEY (`viewcount_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `amenity`
--
ALTER TABLE `amenity`
  MODIFY `Amenity_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `area`
--
ALTER TABLE `area`
  MODIFY `Area_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `attraction`
--
ALTER TABLE `attraction`
  MODIFY `Attraction_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `Booking_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `Contact_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `Customer_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `Review_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `site`
--
ALTER TABLE `site`
  MODIFY `Site_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `site_amenity`
--
ALTER TABLE `site_amenity`
  MODIFY `Dummy_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `viewcount`
--
ALTER TABLE `viewcount`
  MODIFY `viewcount_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attraction`
--
ALTER TABLE `attraction`
  ADD CONSTRAINT `att_area_fk` FOREIGN KEY (`Area_ID`) REFERENCES `area` (`Area_ID`);

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `book_customer_fk` FOREIGN KEY (`Customer_ID`) REFERENCES `customer` (`Customer_ID`),
  ADD CONSTRAINT `book_site_fk` FOREIGN KEY (`Site_ID`) REFERENCES `site` (`Site_ID`);

--
-- Constraints for table `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `contact_fk` FOREIGN KEY (`Customer_ID`) REFERENCES `customer` (`Customer_ID`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `cus_review_fk` FOREIGN KEY (`Customer_ID`) REFERENCES `customer` (`Customer_ID`),
  ADD CONSTRAINT `site_review_fk` FOREIGN KEY (`Site_ID`) REFERENCES `site` (`Site_ID`);

--
-- Constraints for table `site`
--
ALTER TABLE `site`
  ADD CONSTRAINT `site_area_fk` FOREIGN KEY (`Area_ID`) REFERENCES `area` (`Area_ID`);

--
-- Constraints for table `site_amenity`
--
ALTER TABLE `site_amenity`
  ADD CONSTRAINT `site_fk` FOREIGN KEY (`Site_ID`) REFERENCES `site` (`Site_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
