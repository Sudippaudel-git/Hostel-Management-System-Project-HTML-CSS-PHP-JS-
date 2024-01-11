-- Create the admin table
CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(300) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);

-- Insert initial admin data
INSERT INTO `admin` (`id`, `username`, `email`, `password`, `reg_date`, `updation_date`) VALUES
(1, 'admin', 'admin@gmail.com', 'admin1234', '2023-04-04 20:31:45', '2023-04-17');

-- Create the adminlog table
CREATE TABLE IF NOT EXISTS `adminlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adminid` int(11) NOT NULL,
  `logintime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`adminid`) REFERENCES `admin` (`id`)
);

-- Create the userregistration table
CREATE TABLE IF NOT EXISTS `userregistration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `regNo` varchar(255) NOT NULL,
  -- ... other fields ...
  PRIMARY KEY (`id`)
);

-- Insert initial userregistration data
INSERT INTO `userregistration` (`id`, `regNo`, `firstName`, `middleName`, `lastName`, `gender`, `contactNo`, `email`, `password`, `regDate`, `updationDate`, `passUdateDate`) VALUES
(10, '108061211', 'Sudip', '', 'Paudel', 'male', 9846706734, 'sudip@gmail.com', 'Sudip1234', '2023-06-02 04:21:33', '2023-06-23 04:15:00', '2023-06-22 05:16:49');

-- Create the registration table
CREATE TABLE IF NOT EXISTS `registration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `roomno` int(11) NOT NULL unique,
  `foodstatus` varchar(20) NOT NULL,
  `feespm` int(11) NOT NULL,
  `stayfrom` date DEFAULT NULL,
  -- ... other fields ...
  PRIMARY KEY (`id`)
);

-- Insert initial registration data
INSERT INTO `registration` (`id`, `roomno`, `foodstatus`, `feespm`, `stayfrom`, `duration`, `regno`, `firstName`, `middleName`, `lastName`, `gender`, `contactno`, `emailid`, `egycontactno`, `guardianName`, `guardianRelation`, `guardianContactno`, `corresAddress`, `pmntAddress`, `postingDate`, `updationDate`) VALUES
(1, 200, 'yes', 5000, '2020-04-22', 6, 2200, 'Sudip', '', 'Paudel', 'Male', 9808186878, 'sudip@gmail.com', 9808186878, 'Messi', 'Brother', 9750648590, 'USA', 'Argentina', '2023-01-05 00:00:00', '2023-03-26 00:00:00');

-- Create the rooms table
CREATE TABLE IF NOT EXISTS `rooms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `room_no` int(11) NOT NULL unique,
  `fees` int(11) NOT NULL,
  `posting_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);

-- Insert initial rooms data
INSERT INTO `rooms` (`id`, `room_no`, `fees`, `posting_date`) VALUES
(1, 100, 8000, '2023-04-11 22:45:43'),
(2, 201, 6000, '2022-04-12 01:30:47'),
(3, 200, 6000, '2022-04-12 01:30:58'),
(4, 112, 4000, '2023-04-12 01:31:07'),
(5, 132, 2000, '2023-04-12 01:31:15');

-- Create the userlog table
CREATE TABLE IF NOT EXISTS `userlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `userEmail` varchar(255) NOT NULL unique,
  `city` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `loginTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`userId`) REFERENCES `userregistration` (`id`)
);

-- Insert initial userlog data
INSERT INTO `userlog` (`id`, `userId`, `userEmail`, `city`, `country`, `loginTime`) VALUES
(1, 10, 'sudip@gmail.com', 'Ktm', 'Nepal', '2023-01-31');
