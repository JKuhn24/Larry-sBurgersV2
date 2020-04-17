use master;
go

--Drop the database if it was already created
drop database if exists larrytables;
go

--Create database larrytables
create database larrytables;
go

use larrytables

--Create the table for contacts

CREATE TABLE contact (
  contactID INT NOT NULL IDENTITY(1,1) PRIMARY KEY,
  contactName varchar(45) NOT NULL,
  contactPhone varchar(14) NOT NULL,
  contactMail varchar(45) NOT NULL,
  contactMessage varchar(500) NOT NULL
) 

--
-- Add data for table `contact`
--

INSERT INTO contact (contactName, contactPhone, contactMail, contactMessage) VALUES
('John Smith', '(208) 523-7852', 'jsmith@gmail.com', 'Really liked my food when I ate there!'),
('Jacob Mathews', '(208) 423-5235', 'jmathews@gmail.com', 'Good food! Will come back another time!'),
('Steve Williams', '(208) 785-8523', 'stevew@gmail.com', 'Hope business goes well! I will be coming back for more food!'),
('Phillip Stevens', '(208) 314-1592', 'pstevens23@gmail.com', 'My wife and I really enjoyed our food there! Will hopefully be back soon!'),
('Karen Stevens', '(208) 653-4856', 'karenstevens@gmail.com', 'An employee tripped and dropped my food! I will never come back here again!'),
('Martin Martinez', '(208) 795-3587', 'martinez46@gmail.com', 'My kids really enjoy eating here.'),
('Sally Clark', '(208) 347-8462', 'SClark72@gmail.com', 'Really enjoyed my time here!'),
('John Baker', '(208) 258-3214', 'JBaker@gmail.com', 'Thank you for the gluten free options'),
('John Nelson', '(208) 123-4567', 'jnelson98@gmail.com', 'Great place to bring the kids'),
('Eric Adams', '(208) 891-0111', 'EAdams@gmail.com', 'Thanks for the meal'),
('Troy Scott', '(208) 212-2562', 'Scottinator@gmail.com', 'Food was cool, but I have had better'),
('Jaime Rodriguez', '(208) 647-6258', 'JaimeR97@gmail.com', 'My burger was burnt'),
('Jeff Hill', '(208) 475-6952', 'JH2251@gmail.com', 'Really fun time here! Hopefully will come back!'),
('Laura Taylor', '(208) 368-6541', 'LTaylor34@gmail.com', 'Really enjoyed my time. I am currently looking for a job and hope to be able to work here.'),
('Steven Lee', '(208) 321-6543', 'SteveLee54@gmail.com', 'As a new employee, I would just like to say everyone who works here is amazing!'),
('Kat Davis', '(208) 987-6543', 'KDavis@gmail.com', 'I only wish there were more options to decide from on the menu'),
('David Jones', '(208) 210-3654', 'DJones93@gmail.com', 'I wish you guys did delivery.'),
('Jackson Moore', '(208) 945-2543', 'Moore62@gmail.com', 'Really had a good time'),
('Emilia Walker', '(208) 478-7852', 'EWalker23@gmail.com', 'Had a fun time with the family here!'),
('Nathan Young', '(208) 752-6547', 'Young256@gmail.com', 'Will probably come back once a week!');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE employee (
  employeeID int NOT NULL IDENTITY(1,1) PRIMARY KEY,
  employeeName varchar(45) NOT NULL,
  employeeNumber varchar(14) NOT NULL,
  employeeMail varchar(45) NOT NULL
)

--
-- Add data for table `employee`
--

INSERT INTO employee (employeeName, employeeNumber, employeeMail) VALUES
('Larry Jones', '(208) 546-7324', 'Larrysburgers@gmail.com'),
('Mary Jones', '(208) 452-3245', 'MJones@gmail.com'),
('Cameron Lee', '(208) 785-1354', 'CLee@gmail.com'),
('Dustin Stevens', '(208) 125-3542', 'DStevens32@gmail.com'),
('Eric Nelson', '(208) 653-5413', 'EricNelson@gmail.com'),
('Alex Mill', '(208) 795-1324', 'AlexM23@gmail.com'),
('Jaime Flores', '(208) 134-4258', 'JFlores0417@gmail.com'),
('Jeff Carl', '(208) 365-8563', 'JCarl@gmail.com'),
('Alex Schlosser', '(208) 321-6521', 'AlexS76@gmail.com'),
('Karen Jones', '(208) 853-5430', 'KarenJ345@gmail.com'),
('Matt Watson', '(208) 132-1354', 'Mattew23@gmail.com'),
('John Scott', '(208) 647-3451', 'JScott5432@gmail.com'),
('Jacob Walker', '(208) 231-6952', 'JW2341@gmail.com'),
('Sally Smith', '(208) 366-6565', 'SSmith2345@gmail.com'),
('Nathan Taylor', '(208) 361-6343', 'NathanT2367@gmail.com'),
('Laura Davis', '(208) 998-6565', 'LDavis1684@gmail.com'),
('Connor Hecklesten', '(208) 352-7452', 'ConnorH21356@gmail.com'),
('Steven Young', '(208) 965-2652', 'YoungS9586@gmail.com'),
('Steven Lee', '(208) 321-6543', 'SteveLee54@gmail.com'),
('Laura Taylor', '(208) 368-6541', 'LTaylor34@gmail.com');
go


-- Create a procedure to add data to the contact table
create procedure InsertContact
@ContactName nchar(50),
@ContactNumber nchar(50),
@ContactMail nchar(50),
@ContactMsg nchar(200)
as
INSERT INTO [larrytables].[dbo].[contact]
           ([contactName]
           ,[contactPhone]
		   ,[contactMail]
           ,[contactMessage])
     VALUES
           (@ContactName
           ,@ContactNumber
		   ,@ContactMail
           ,@ContactMsg)
GO

--Test the procedure
execute InsertContact "Test", "000-000-0000", "test@test.test", "This is a test"
GO


use master;
go


--Create a login
CREATE LOGIN larrylogin WITH PASSWORD='Pa$$w0rd'
go

use larrytables;
go

--Create user using previously created login
CREATE USER larrylogin FOR LOGIN larrylogin WITH DEFAULT_SCHEMA=[dbo]
GO


--give user the ability to execute the procedure InsertContact
GRANT EXECUTE ON InsertContact to larrylogin
go



select * from contact