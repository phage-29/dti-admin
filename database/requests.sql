CREATE TABLE `requests` (
    `id` int NOT NULL AUTO_INCREMENT,
    `TicketNo` varchar(45) NOT NULL,
    `OfficeID` int DEFAULT NULL,
    `DivisionID` int DEFAULT NULL,
    `Requestor` varchar(45) NOT NULL,
    `Email` varchar(45) NOT NULL,
    `Title` varchar(255) NOT NULL,
    `CategoryID` int DEFAULT NULL,
    `SubCategoryID` int DEFAULT NULL,
    `Remarks` text,
    `Status` varchar(45) DEFAULT 'Pending',
    `Priority` enum('Low', 'Medium', 'High') DEFAULT 'Medium',
    `CreatedAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    `UpdatedAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `ReceivedBy` int DEFAULT NULL,
    `ApprovedBy` int DEFAULT NULL,
    `AssistedBy` int DEFAULT NULL,

    -- Fields specific to meetings
    `Schedule` date,
    `TimeStart` time,
    `TimeEnd` time,
    `HostID` int,
    `MeetingID` varchar(50),
    `Passcode` varchar(10),
    `InviteLink` varchar(255),

    -- Fields specific to helpdesks
    `DateReceived` date,
    `DateSchedule` date,
    `RepairType` enum('minor', 'major'),
    `DateStarted` datetime,
    `DateEnded` datetime,
    `Diagnosis` text,
    `Action` text,
    `Recommendation` text,

    PRIMARY KEY (`id`)
);
