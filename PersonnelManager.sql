CREATE DATABASE PersonnelManager;

create table Employee(
    EmployeeID int not null auto_increment,
    FirstName char(15) not null,
    LastName char(15) not null,
    DateOfBirth varchar(10) not null,
    Gender char(20) not null,
    Demographic char(20) not null,
    Username varchar(15) not null,
    Password varchar(15) not null,
    DateJoined varchar(10) not null,
    AnnualSalary int not null,
    Department int,
    PRIMARY KEY (EmployeeID));

create table Department(
    DepartmentID int not null auto_increment,
    DeptName char(30) not null,
    NoOfStaff int not null,
    Location char(30) not null,
    CurrentProject int,
    PRIMARY KEY(DepartmentID));

create table Project(
    ProjectID int not null auto_increment,
    ProjectName char(30) not null,
    Budget int not null,
    Status char(25) not null,
    PRIMARY KEY (ProjectID));
    
create table employee_images(
    id tinyint(3) unsigned NOT NULL auto_increment,
    image blob NOT NULL,
    PRIMARY KEY(id));
    
ALTER TABLE Employee ADD FOREIGN KEY (Department) REFERENCES Department(DepartmentID);

ALTER TABLE Department ADD FOREIGN KEY (CurrentProject) REFERENCES Project(ProjectID);
    
INSERT INTO Project VALUE(NULL, 'Personnel Management', 100000, 'In Progress');
INSERT INTO Project VALUE(NULL, 'Fraction Generator', 80000, 'Complete');
INSERT INTO Project VALUE(NULL, 'File Database', 50000, 'Complete');
INSERT INTO Project VALUE(NULL, 'Tic-Tac-Toe Game', 20000, 'Complete');

INSERT INTO Department VALUE(NULL, 'Software Development', 5, 'Framingham, Massachusetts', 1);
INSERT INTO Department VALUE(NULL, 'System Analysis', 7, 'Sudbury, Massachusetts', 4);
INSERT INTO Department VALUE(NULL, 'Quality Assurance', 4, 'Stow, Massachusetts', 2);
INSERT INTO Department VALUE(NULL, 'Database Management', 9, 'Boston, Massachusetts', 3);

INSERT INTO employee VALUE(NULL, 'Brendan', 'Burdick', '1995-06-13', 'Male', 'Caucasian', 'bburdick', 'booty', '2017-04-17', 50000, 1);
INSERT INTO employee VALUE(NULL, 'Anthony', 'Clements', '1994-04-20', 'Male', 'Caucasian', 'aclements', '420420', '2017-04-17', 60000, 1);
INSERT INTO employee VALUE(NULL, 'Ryan', 'Divittorio', '1994-05-05', 'Male', 'Caucasian', 'rdivittorio', 'rdivi', '2017-04-17', 70000, 1);

INSERT INTO employee_images VALUE(NULL, 'blob.jpg');