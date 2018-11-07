<!--
Author: Brendan Burdick
Date: April 29th, 2017
Professor: Andrew Jung
Filename: main_page.php

Purpose of Program:
The purpose of this program is to serve as the initializer for our Personnel Management program.
This file takes the form contents that index.html passed it and reacts to it based on what data
was passed. All of the form data is saved into php variables and used within the four functions
which are detailed below. If the user checked that this is the first time the system is being run,
then this file calls the CreateDatabase function, which creates the PersonnelManager database. If
it is not the first time this system is being used, the inputted credentials are checked against the
database to see if the inputted username and password are correct. If the login is correct, the user
is sent to MainPageContent.php. If the login is incorrect, the user is prompted to try again.
-->

<?php
	session_start();
    
	$uname = $_POST["username"]; //Holds inputted username.
    $pword = $_POST["password"]; //Holds inputted password.
    $FirstTime = $_POST["firstTimeStatus"]; //Holds the value of if it is the first time the system is being used.

    $_SESSION["CurrentUser"] = $_POST["username"]; //Session control variable.
    
    main($FirstTime, $uname, $pword); //Call the 'main' function. This starts the PersonnelManager Program.

    /*
    * The main function starts the personnel manager program. It checks whether the system has been used
    * before and if it hasn't, the personnelmanager database is created. If the system has been used, it attempts
    * to log in.
    **/
    function main($firstTimeStatus, $uname, $pword){
        if($firstTimeStatus === "Yes")
        {
            CreateDatabase(); //Call function to create database.
            $firstTimeStatus = "No";
            return;
        }
            
        login($uname, $pword); //Attempt to log in.
    }

    /*
    * The CreateDatabase function creates the personnelmanager database from scratch. It starts by creating
    * a link without a database attached. It then uses this link to create a PersonnelManager database. After
    * that, data is inputted via multiple SQL statements. A default 4 projects and 4 departments are inputted
    * to the table, and a default admin user as well.
    **/
    function CreateDatabase(){ //Displays on database creation.
        //Create connection.
        $link = new mysqli("localhost:8889", "root", "root"); //Initial link to localhost.

        //Check connection.
        if(mysqli_connect_error())
        {
            die("Connection failed: " .mysqli_connect_error());
        }

        //Create the new database, if it does not exist;
        $CreateDatabase = "CREATE DATABASE PersonnelManager;"; //SQL statement to create the new database.
        mysqli_query($link, $CreateDatabase); //Call the SQL statement.

        //Adjust the link to reflect the newly created database. Add the startup information.
        $link = new mysqli("localhost:8889", "root", "root", "PersonnelManager"); //Adjust the link to add data.
        $AddDatabaseData = " 
        
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

        INSERT INTO employee VALUE(NULL, 'Admin', 'Admin', '2017-01-01', 'Male', 'Caucasian', 'Admin', 'Admin', '2017-05-01', 123456, 1);
            
        INSERT INTO employee_images VALUE(NULL, 'blob.jpg');";
        
        mysqli_multi_query($link, $AddDatabaseData); //Call the SQL queries to add the departments, project, and starting user.
        mysqli_close($link); //Close the link.
        
        CreateDatabaseDialogue(); //Call CreateDatabaseDialogue to state that the database has been created.
        return;
    }


    /*
    * The CreateDatabaseDialogue function simply displays a message stating that the database
    * has been successfully created.
    **/
    function CreateDatabaseDialogue(){ //Displays on database creation.
        echo "
        <head>
            <title>Database Created</title>
            <link href=./style.css rel='stylesheet' type='text/css'>
        </head>
            
        <body>
	       <div id=videoWrapper>
		      <video autoplay=true id=film loop=true style=z-index:8;><source src=./typing.webm type=video/webm></video>
	       </div>
           
            <div id=loginwrapper>
                <div id='login'>
                    <b>Database was successfully created!</b><br /><br />
                    <a href=./index.html>Click Here to Return and Log-In</a>
                </div>
	       </div>
       </body>";
        
       session_unset(); //Session is properly deleted.
       session_destroy();
    }


    /*
    * The login function takes the inputted credentials from index.html and checks them against
    * the database to make sure the login is correct. If the login is correct, the user proceeds
    * into the system. If not, they can try again.
    **/
    function login($uname, $pword){
        
        //Create connection.
        $link = new mysqli("localhost:8889", "root", "root", "PersonnelManager");

        //Check connection.
        if(mysqli_connect_error())
        {
            DatabaseErrorScreen();
            return;
        }
        
        //Check for valid username (that it exists).
        $query = "SELECT * FROM employee WHERE Username='$uname'";
        $result = mysqli_query($link, $query);

        $info = mysqli_fetch_assoc($result);
        
        if($info[Username] === $uname){ //If there is a username in the database that matches the inputted username...
            if($info[Password] === $pword){ //If the password that is inputted matches the user's password, continue.
                require("./MainPageContent.php"); //Main function.
            }

            else{ //If the password that is inputted doesn't match to the user's password, display the error screen.
                LoginErrorScreen(); //Display login error.
            }
        }

        else{ //If there is no username in the database that matches the inputted username, display the error screen.
            LoginErrorScreen(); //Display login error.
        }
    }


    /*
    * This function is used in the case of an incorrect username or password being entered.
    **/
    function LoginErrorScreen(){ //Displays on invalid login screen.
        echo "
        <head>
            <title>Invalid Login</title>
            <link href=./style.css rel='stylesheet' type='text/css'>
        </head>
            
        <body>
	       <div id=videoWrapper>
		      <video autoplay=true id=film loop=true style=z-index:8;><source src=./typing.webm type=video/webm></video>
	       </div>
           
            <div id=loginwrapper>
                <div id='login'>
                    <b>Incorrect Username or Password Was Entered.</b><br /><br />
                    <a href=./index.html>Click Here to Retry</a>
                </div>
	       </div>
       </body>";
        
       session_unset();
       session_destroy();
    }

    /*
    * This function is used in the case of either a user attempting to use the database without creating the database
    * first.
    **/
    function DatabaseErrorScreen(){ //Displays on invalid login screen.
        echo "
        <head>
            <title>Database Not Created</title>
            <link href=./style.css rel='stylesheet' type='text/css'>
        </head>
            
        <body>
	       <div id=videoWrapper>
		      <video autoplay=true id=film loop=true style=z-index:8;><source src=./typing.webm type=video/webm></video>
	       </div>
           
            <div id=loginwrapper>
                <div id='login'>
                    <b>The database hasn't been created yet! Go back, and choose 'Yes' on the login screen.</b><br /><br />
                    <a href=./index.html>Click Here to Retry</a>
                </div>
	       </div>
       </body>";
        
       session_unset();
       session_destroy();
    }
?>