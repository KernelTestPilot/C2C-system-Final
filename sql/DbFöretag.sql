drop database big_data;
create database big_data;
use big_data;


CREATE TABLE UserID(
id INT NOT NULL AUTO_INCREMENT,
Username varchar(20) UNIQUE,
Password varchar(200),
Email	varchar(50) UNIQUE,
FBid	varchar(100),
Surname varchar(20),
Lastname varchar(20),
Age      int,
created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
primary key(id)
)engine=innodb;


CREATE TABLE SchoolID(
Schoolid INT NOT NULL AUTO_INCREMENT,
Schoolname varchar(30) NOT NULL UNIQUE,
primary key(Schoolid)
)engine=innodb;

CREATE TABLE Inriktning(
InriktningID INT NOT NULL AUTO_INCREMENT,
Schoolid INT,
Inriktning VARCHAR(50) NOT NULL UNIQUE,
foreign key (Schoolid) references SchoolID(Schoolid),
primary key (InriktningID)
)engine=innodb;

CREATE TABLE ProgramID(
Programid INT NOT NULL AUTO_INCREMENT,
Schoolid INT,
inriktningid INT,
Program varchar(30) NOT NULL UNIQUE,
foreign key (inriktningid) references Inriktning(InriktningID),
foreign key (Schoolid) references SchoolID(Schoolid),
primary key(Programid)
)engine=innodb;

CREATE TABLE CourseID(
Courseid INT NOT NULL AUTO_INCREMENT,
Programid INT,
Kursnamn varchar(50) NOT NULL,
Schoolid INT,
foreign key (Programid) references ProgramID(Programid),
foreign key (Schoolid) references SchoolID(Schoolid),
primary key(Courseid)
)engine=innodb;

CREATE TABLE Advert(
AnonID INT NOT NULL AUTO_INCREMENT,
Courseid INT,
Programid INT,
InriktningID INT,
BokNamn VARCHAR(30),
UserID INT,
ISBN BIGINT,
SchoolID INT,
Quality VARCHAR (39),
Author VARCHAR (80),
Price int,
ContactNR int,
publisher VARCHAR(40),
mail VARCHAR(30),
fbID VARCHAR(150),
foreign key (InriktningID) references Inriktning(InriktningID),
foreign key (Programid) references ProgramID(Programid),
foreign key (Courseid) references CourseID(Courseid),
foreign key (UserID) references UserID(id),
foreign key (SchoolID) references SchoolID(Schoolid),
PRIMARY KEY (AnonID)
)engine=innodb;

CREATE TABLE SoldBooks(
SoldID int NOT NULL AUTO_INCREMENT,
Courseid INT,
Programid INT,
InriktningID INT,
BokNamn VARCHAR(30),
ISBN BIGINT,
SchoolID INT,
Price int,
foreign key (InriktningID) references Inriktning(InriktningID),
foreign key (Programid) references ProgramID(Programid),
foreign key (Courseid) references CourseID(Courseid),
foreign key (SchoolID) references SchoolID(Schoolid),
PRIMARY KEY (SoldID)
)engine=innodb;


#add user
insert INTO UserID (Username,Password,Email,Surname,Lastname,Age )
VALUES ("Oskar","$2y$10$U2iH7OlPscsdbup/YZRcUuWNKekYVFE2p19Kc6ZEtLBYrJThGQePu","oskar@hotmail.com","Oskar","Dahlberg",22);

#schools HIS ID #1
insert INTO SchoolID (Schoolname)
VALUES ("Högskolan i Skövde");

insert INTO SchoolID (Schoolname)
VALUES ("Kungliga Tekniska Högskolan");


insert INTO SchoolID (Schoolname)
VALUES ("Luleås Tekniska Högskola");

SELECT * FROM ProgramID;
SELECT * FROM SchoolID WHERE Schoolid =1;
SELECT * FROM CourseID;
SELECT * FROM CourseID WHERE Schoolid =1;
SELECT * FROM Advert;