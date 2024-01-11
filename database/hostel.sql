CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
);

INSERT INTO `admin` (`id`, `username`, `email`, `password`) VALUES
(1, 'admin', 'admin@gmail.com', 'admin1234');

CREATE TABLE IF NOT EXISTS `userregistration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(255) NOT NULL,
  `middleName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `contactNo` bigint(20) NOT NULL unique,
  `email` varchar(255) NOT NULL unique,
  `password` varchar(255) NOT NULL,
  `passUpdateDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);

INSERT INTO `userregistration` (`id`, `firstName`, `middleName`, `lastName`, `gender`, `contactNo`, `email`, `password`, `passUpdateDate`) VALUES
(10, 'Sudip', '', 'Paudel', 'male', 9846706734, 'sudip@gmail.com', 'Sudip1234', '2023-05-17 01:31:07');

CREATE TABLE `hostelbook` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `roomno` int(11) NOT NULL unique,
  `foodstatus` varchar(20) NOT NULL,
  `feespm` int(11) NOT NULL,
  `stayfrom` date NOT NULL,
  `duration` int(11) NOT NULL,
  `firstName` varchar(500) NOT NULL,
  `middleName` varchar(50),
  `lastName` varchar(50) NOT NULL,
  `gender` varchar(250) NOT NULL,
  `contactno` bigint(10) NOT NULL unique,
  `emailid` varchar(500) NOT NULL unique,
  `guardianName` varchar(500) NOT NULL,
  `guardianRelation` varchar(500) NOT NULL,
  `guardianContactno` bigint(10) NOT NULL unique,
  `address` varchar(100),
  `updationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);

INSERT INTO `hostelbook` (`id`, `roomno`, `foodstatus`, `feespm`, `stayfrom`,  `duration`, `firstName`, `middleName`, `lastName`, `gender`, `contactno`, `emailid`, `guardianName`, `guardianRelation`, `guardianContactno`, `address`, `updationDate`) VALUES
(1, 200, 'yes', 5000, '2023-04-22',  6, 'Sudip', '', 'Paudel', 'Male', 9808186878, 'sudip@gmail.com', 'Messi', 'Brother', 9750648590, 'USA', '2023-03-26 00:00:00');

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `room_no` int(11) NOT NULL unique,
  `fees` int(11) NOT NULL,
  `posting_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
  
  
);

INSERT INTO `rooms` (`id`, `room_no`, `fees`, `posting_date`) VALUES
(1, 100, 8000, '2023-04-11 22:45:43'),
(2, 201, 6000, '2022-04-12 01:30:47'),
(3, 200, 6000, '2022-04-12 01:30:58'),
(4, 112, 4000, '2023-04-12 01:31:07'),
(5, 132, 2000, '2023-04-12 01:31:15');

CREATE TABLE IF NOT EXISTS `userlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userEmail` varchar(255) NOT NULL unique,
  `password` varchar(20),
  PRIMARY KEY (`id`)
);

INSERT INTO `userlog` (`id`, `userId`, `userEmail`, `password`) VALUES
(1,  'sudip@gmail.com', '1234');
ALTER TABLE `hostelbook` ADD COLUMN `roomid` INT(11) NOT NULL;

ALTER TABLE `hostelbook` ADD CONSTRAINT `fk_hostelbook_room` FOREIGN KEY (`roomid`) REFERENCES `rooms`(`id`);

