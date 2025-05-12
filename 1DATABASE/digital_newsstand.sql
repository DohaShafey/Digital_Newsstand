-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: May 12, 2025 at 07:43 PM
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
-- Database: `digital newsstand`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_subscription` (IN `p_planId` INT, IN `p_paymentId` INT, IN `p_userId` INT)   BEGIN
    DECLARE plan_duration INT;
    DECLARE new_subscriptionId INT;

    -- جلب مدة الخطة (planDuration) من جدول الـ plan
    SELECT planDuration INTO plan_duration
    FROM plan
    WHERE planId = p_planId;

    -- إدخال البيانات في جدول subscriptions
    INSERT INTO subscriptions (planId, paymentId, userId, startDate, endDate)
    VALUES (p_planId, p_paymentId, p_userId, CURDATE(), DATE_ADD(CURDATE(), INTERVAL plan_duration DAY));

    -- جلب subscriptionId الجديد
    SET new_subscriptionId = LAST_INSERT_ID();

    -- تحديث جدول subscriptions إذا لزم الأمر (إذا كنت بحاجة لتحديث أي شيء بعد الإدخال)
    -- يمكن إضافة عمليات تحديث أخرى هنا إذا لزم الأمر.

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `articleId` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `articleTitle` varchar(100) NOT NULL,
  `articleAuthor` varchar(50) NOT NULL,
  `articleContent` text NOT NULL,
  `languageId` int(11) NOT NULL,
  `categoryId` int(11) NOT NULL,
  `articlePublicationDate` date NOT NULL,
  `articlelImg` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`articleId`, `userId`, `articleTitle`, `articleAuthor`, `articleContent`, `languageId`, `categoryId`, `articlePublicationDate`, `articlelImg`) VALUES
(3, 1, 'TEST_TITLE', 'doha', 'test_content', 1, 1, '2025-05-01', 'https://www.thebusinessguardians.com/wp-content/uploads/2021/03/New-Project-58-1024x683.jpg');

--
-- Triggers `article`
--
DELIMITER $$
CREATE TRIGGER `trg_article_author_insert` BEFORE INSERT ON `article` FOR EACH ROW BEGIN
    SET NEW.articleAuthor = (SELECT userName FROM user WHERE userId = NEW.userId);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryId` int(11) NOT NULL,
  `categoryName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryId`, `categoryName`) VALUES
(1, 'Technology ');

-- --------------------------------------------------------

--
-- Table structure for table `content_engagement`
--

CREATE TABLE `content_engagement` (
  `userId` int(11) NOT NULL,
  `articleId` int(11) NOT NULL,
  `engagementType` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `content_engagement`
--

INSERT INTO `content_engagement` (`userId`, `articleId`, `engagementType`) VALUES
(1, 3, 'save');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedbackId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `feedbackStatus` varchar(50) NOT NULL,
  `feedbackComment` varchar(200) NOT NULL,
  `feedbackDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedbackId`, `userId`, `feedbackStatus`, `feedbackComment`, `feedbackDate`) VALUES
(2, 1, 'accepted', 'test comment', '2025-05-08 22:28:26');

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE `language` (
  `languageId` int(11) NOT NULL,
  `languageName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`languageId`, `languageName`) VALUES
(1, 'English');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `paymentId` int(11) NOT NULL,
  `paymentMethodId` int(11) NOT NULL,
  `paymentDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`paymentId`, `paymentMethodId`, `paymentDate`) VALUES
(1, 1, '2025-05-08 20:18:37'),
(2, 2, '2025-05-08 20:18:42');

-- --------------------------------------------------------

--
-- Table structure for table `plan`
--

CREATE TABLE `plan` (
  `planId` int(11) NOT NULL,
  `planName` varchar(50) NOT NULL,
  `planPrice` decimal(10,2) NOT NULL,
  `planDuration` int(11) NOT NULL,
  `planFeatures` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plan`
--

INSERT INTO `plan` (`planId`, `planName`, `planPrice`, `planDuration`, `planFeatures`) VALUES
(1, 'basic', 9.99, 7, '✔ Access to basic content\r\n✔ 5GB Storage\r\n✔ Email Support'),
(2, 'Standard', 19.99, 30, '✔ Everything in Basic\r\n✔ 50GB Storage\r\n✔ Priority Support'),
(3, 'Premium', 29.99, 365, '✔ Everything in Standard\r\n✔ 200GB Storage\r\n✔ 1-on-1 Coaching');

-- --------------------------------------------------------

--
-- Table structure for table `promo`
--

CREATE TABLE `promo` (
  `promoId` int(11) NOT NULL,
  `promoName` varchar(30) NOT NULL,
  `promoValue` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `promo`
--

INSERT INTO `promo` (`promoId`, `promoName`, `promoValue`) VALUES
(1, 'NOPROMO0', 0.00),
(2, 'WELCOME05', 5.00),
(3, 'SAVE10', 10.00);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `roleId` int(11) NOT NULL,
  `roleName` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`roleId`, `roleName`) VALUES
(1, 'admin'),
(3, 'premium'),
(2, 'regular');

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `subscriptionId` int(11) NOT NULL,
  `planId` int(11) NOT NULL,
  `paymentId` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `startDate` timestamp NULL DEFAULT current_timestamp(),
  `endDate` timestamp NULL DEFAULT NULL,
  `paymentAmount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`subscriptionId`, `planId`, `paymentId`, `userId`, `startDate`, `endDate`, `paymentAmount`) VALUES
(3, 1, 1, 1, '2025-05-08 22:08:54', '2025-05-15 22:08:54', 4.99);

--
-- Triggers `subscriptions`
--
DELIMITER $$
CREATE TRIGGER `calculate_end_date` BEFORE INSERT ON `subscriptions` FOR EACH ROW BEGIN
    DECLARE plan_duration INT;
    
    -- جلب مدة الخطة من جدول plan
    SELECT planDuration INTO plan_duration 
    FROM plan 
    WHERE planId = NEW.planId;
    
    -- حساب endDate (startDate + المدة بالأيام)
    SET NEW.endDate = DATE_ADD(NEW.startDate, INTERVAL plan_duration DAY);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `subscription_promo`
--

CREATE TABLE `subscription_promo` (
  `promoId` int(11) NOT NULL,
  `subscriptionId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subscription_promo`
--

INSERT INTO `subscription_promo` (`promoId`, `subscriptionId`) VALUES
(2, 3);

--
-- Triggers `subscription_promo`
--
DELIMITER $$
CREATE TRIGGER `update_payment_amount_on_promo` AFTER UPDATE ON `subscription_promo` FOR EACH ROW BEGIN
  DECLARE plan_price DECIMAL(10,2);
  DECLARE promo_value DECIMAL(10,2);
  DECLARE plan_id INT;

  -- Get planId from subscriptions
  SELECT planId INTO plan_id
  FROM subscriptions
  WHERE subscriptionId = NEW.subscriptionId;

  -- Get plan price
  SELECT planPrice INTO plan_price
  FROM plan
  WHERE planId = plan_id;

  -- Get new promo value
  SELECT promoValue INTO promo_value
  FROM promo
  WHERE promoId = NEW.promoId;

  -- Update the paymentAmount in subscriptions
  UPDATE subscriptions
  SET paymentAmount = plan_price - IFNULL(promo_value, 0)
  WHERE subscriptionId = NEW.subscriptionId;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userId` int(11) NOT NULL,
  `userName` varchar(50) NOT NULL,
  `userEmail` varchar(100) NOT NULL,
  `userPassword` varchar(20) NOT NULL,
  `userRole` int(11) NOT NULL,
  `languageId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userId`, `userName`, `userEmail`, `userPassword`, `userRole`, `languageId`) VALUES
(1, 'doha', 'doha.hamed.2006@gmail.com', '1111', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_category`
--

CREATE TABLE `user_category` (
  `userId` int(11) NOT NULL,
  `categoryId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_category`
--

INSERT INTO `user_category` (`userId`, `categoryId`) VALUES
(1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`articleId`),
  ADD KEY `userId` (`userId`),
  ADD KEY `languageId` (`languageId`),
  ADD KEY `categoryId` (`categoryId`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryId`),
  ADD UNIQUE KEY `categoryName` (`categoryName`);

--
-- Indexes for table `content_engagement`
--
ALTER TABLE `content_engagement`
  ADD PRIMARY KEY (`userId`,`articleId`),
  ADD KEY `articleId` (`articleId`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedbackId`),
  ADD KEY `userId2` (`userId`);

--
-- Indexes for table `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`languageId`),
  ADD UNIQUE KEY `languageName` (`languageName`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`paymentId`);

--
-- Indexes for table `plan`
--
ALTER TABLE `plan`
  ADD PRIMARY KEY (`planId`);

--
-- Indexes for table `promo`
--
ALTER TABLE `promo`
  ADD PRIMARY KEY (`promoId`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`roleId`),
  ADD UNIQUE KEY `roleName` (`roleName`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`subscriptionId`,`planId`,`paymentId`),
  ADD KEY `fk_plan` (`planId`),
  ADD KEY `fk_payment` (`paymentId`),
  ADD KEY `fk_user` (`userId`);

--
-- Indexes for table `subscription_promo`
--
ALTER TABLE `subscription_promo`
  ADD PRIMARY KEY (`promoId`,`subscriptionId`),
  ADD KEY `subscriptionId` (`subscriptionId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `userEmail` (`userEmail`),
  ADD UNIQUE KEY `userEmail_2` (`userEmail`),
  ADD KEY `roleId` (`userRole`),
  ADD KEY `languageId` (`languageId`);

--
-- Indexes for table `user_category`
--
ALTER TABLE `user_category`
  ADD PRIMARY KEY (`userId`,`categoryId`),
  ADD KEY `categoryId` (`categoryId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `articleId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedbackId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `language`
--
ALTER TABLE `language`
  MODIFY `languageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `paymentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `plan`
--
ALTER TABLE `plan`
  MODIFY `planId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `promo`
--
ALTER TABLE `promo`
  MODIFY `promoId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `roleId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `subscriptionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `article_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `article_ibfk_2` FOREIGN KEY (`languageId`) REFERENCES `language` (`languageId`),
  ADD CONSTRAINT `article_ibfk_3` FOREIGN KEY (`categoryId`) REFERENCES `category` (`categoryId`);

--
-- Constraints for table `content_engagement`
--
ALTER TABLE `content_engagement`
  ADD CONSTRAINT `content_engagement_ibfk_1` FOREIGN KEY (`articleId`) REFERENCES `article` (`articleId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `content_engagement_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `userId2` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`);

--
-- Constraints for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD CONSTRAINT `fk_payment` FOREIGN KEY (`paymentId`) REFERENCES `payment` (`paymentId`),
  ADD CONSTRAINT `fk_plan` FOREIGN KEY (`planId`) REFERENCES `plan` (`planId`),
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`);

--
-- Constraints for table `subscription_promo`
--
ALTER TABLE `subscription_promo`
  ADD CONSTRAINT `subscription_promo_ibfk_1` FOREIGN KEY (`subscriptionId`) REFERENCES `subscriptions` (`subscriptionId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `subscription_promo_ibfk_2` FOREIGN KEY (`promoId`) REFERENCES `promo` (`promoId`) ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`userRole`) REFERENCES `role` (`roleId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`languageId`) REFERENCES `language` (`languageId`) ON UPDATE CASCADE;

--
-- Constraints for table `user_category`
--
ALTER TABLE `user_category`
  ADD CONSTRAINT `user_category_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`),
  ADD CONSTRAINT `user_category_ibfk_2` FOREIGN KEY (`categoryId`) REFERENCES `category` (`categoryId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
