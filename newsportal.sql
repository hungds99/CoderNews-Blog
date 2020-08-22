CREATE DATABASE `codernews`;

USE `codernews`;

-- Table Admin 
CREATE TABLE `tbladmin` (
  `id` int(11) NOT NULL auto_increment,
  `AdminUserName` varchar(255) NOT NULL,
  `AdminPassword` varchar(255) NOT NULL,
  `AdminEmailId` varchar(255) NOT NULL,
  `Is_Active` int(11) NOT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  primary key(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `tbladmin` (`id`, `AdminUserName`, `AdminPassword`, `AdminEmailId`, `Is_Active`, `CreationDate`, `UpdationDate`) VALUES
(1, 'admin', '$2y$12$i4LMfeFPQpGSNPTaccIkKuwxAkJ4PhBr3JND7FpXwWFjRvchQn17C', 'dinhsyhung99@gmail.com', 1, '2020-08-07 17:51:00', '2020-08-07 18:21:07');


CREATE TABLE `tblcategory` (
  `id` int(11) NOT NULL auto_increment,
  `CategoryName` varchar(200) DEFAULT NULL,
  `Description` mediumtext DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL,
  `Is_Active` int(1) DEFAULT NULL,
  primary key (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `tblcategory` (`id`, `CategoryName`, `Description`, `PostingDate`, `UpdationDate`, `Is_Active`) VALUES
(2, 'Java', 'Java, java core, java 8', '2020-08-07 10:28:09', '2020-08-07 18:41:07', 1),
(3, 'Spring', 'Spring, framework, mvc, core, cloud', '2020-08-07 10:28:09', '2020-08-07 18:41:07', 1),
(5, 'Database', 'Mysql, SQL, no SQL', '2020-08-07 10:28:09', '2020-08-07 18:41:07', 1),
(6, 'Tools', 'IDE, text editor', '2020-08-07 10:28:09', '2020-08-07 18:41:07', 1),
(7, 'Devops', 'AWS, cloud, Azure', '2020-08-07 10:28:09', '2020-08-07 18:41:07', 1);


CREATE TABLE `tblsubcategory` (
  `SubCategoryId` int(11) NOT NULL auto_increment,
  `CategoryId` int(11) DEFAULT NULL,
  `Subcategory` varchar(255) DEFAULT NULL,
  `SubCatDescription` mediumtext DEFAULT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL,
  `Is_Active` int(1) DEFAULT NULL,
  primary key(`SubCategoryId`),
  foreign key(`CategoryId`) references tblcategory(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `tblsubcategory` (`SubCategoryId`, `CategoryId`, `Subcategory`, `SubCatDescription`, `PostingDate`, `UpdationDate`, `Is_Active`) VALUES
(3, 2, 'Java Core', 'Java core', '2020-08-07 15:45:38', '0000-00-00 00:00:00', 1),
(4, 2, 'Java 8', 'Java 8', '2020-08-07 15:45:38', '0000-00-00 00:00:00', 1),
(5, 3, 'Spring MVC', 'Spring MVC', '2020-08-07 15:45:38', '0000-00-00 00:00:00', 1),
(6, 3, 'Spring Boot', 'Spring boot', '2020-08-07 15:45:38', '0000-00-00 00:00:00', 1),
(7, 5, 'Mysql', 'Mysql', '2020-08-07 15:45:38', '0000-00-00 00:00:00', 1),
(8, 5, 'MongoDB', 'Nosql, mongo', '2020-08-07 15:45:38', '0000-00-00 00:00:00', 1),
(9, 6, 'Eclipse', 'ecplipse', '2020-08-07 15:45:38', '0000-00-00 00:00:00', 1),
(10, 6, 'STS 4', 'Spring tool', '2020-08-07 15:45:38', '0000-00-00 00:00:00', 1),
(11, 7, 'Azure', 'Azure', '2020-08-07 15:45:38', '0000-00-00 00:00:00', 1),
(12, 7, 'Docker', 'Docker', '2020-08-07 15:45:38', '0000-00-00 00:00:00', 1),
(13, 7, 'Jenkins', 'Jenkins', '2020-08-07 15:45:38', '0000-00-00 00:00:00', 1);


CREATE TABLE `tblposts` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `PostTitle` VARCHAR(600) DEFAULT NULL,
    `CategoryId` INT(11) DEFAULT NULL,
    `SubCategoryId` INT(11) DEFAULT NULL,
    `PostDetails` LONGTEXT CHARACTER SET UTF8 DEFAULT NULL,
    `PostingDate` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP (),
    `UpdationDate` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP (),
    `Is_Active` INT(1) DEFAULT NULL,
    `PostUrl` VARCHAR(600) DEFAULT NULL,
    `PostImage` VARCHAR(255) DEFAULT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`CategoryId`)
        REFERENCES tblcategory (`id`),
    FOREIGN KEY (`SubCategoryId`)
        REFERENCES tblsubcategory (`SubCategoryId`)
)  ENGINE=INNODB DEFAULT CHARSET=UTF8;


CREATE TABLE `tblcomments` (
  `id` int(11) NOT NULL auto_increment,
  `postId` int(11) DEFAULT NULL,
  `name` varchar(120) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `comment` mediumtext CHARACTER SET utf8 DEFAULT NULL,
  `postingDate` timestamp NULL DEFAULT current_timestamp(),
  `status` int(1) DEFAULT NULL,
  primary key(`id`),
  foreign key(`postId`) references tblposts(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `tblpages` (
  `id` int(11) NOT NULL,
  `PageName` varchar(200) DEFAULT NULL,
  `PageTitle` mediumtext DEFAULT NULL,
  `Description` longtext DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  primary key(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `tblpages` (`id`, `PageName`, `PageTitle`, `Description`, `PostingDate`, `UpdationDate`) VALUES
(1, 'aboutus', 'Giới thiệu', '<font color=\"#7b8898\" face=\"Mercury SSm A, Mercury SSm B, Georgia, Times, Times New Roman, Microsoft YaHei New, Microsoft Yahei, å¾®è½¯é›…é»‘, å®‹ä½“, SimSun, STXihei, åŽæ–‡ç»†é»‘, serif\"><span style=\"font-size: 26px;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</span></font><br>', '2018-06-30 18:01:03', '2018-06-30 19:19:51'),
(2, 'contactus', 'Liên hệ', '<p><br></p><p><b>Address :&nbsp; </b>Hai Chau - Da Nang - Viet Nam</p><p><b>Phone Number : </b>+91 -01234567890</p><p><b>Email -id : </b>dinhsyhung99@gmail.com</p>', '2018-06-30 18:01:36', '2018-06-30 19:23:25');
