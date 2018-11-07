<!--
Author: Brendan Burdick
Date: April 20th, 2017
Professor: Andrew Jung
Filename: AddNewEmployee.php

Purpose of Program:
The purpose of this file is to use take all of the data from the form in
NewEmployee.html and attempt to add it into the PersonnelManager database.
-->
<?php

	session_start();
    include("bodystyle.html"); //Set background.
    include ("header.php"); //Insert header.

    //Variables to hold data from form.
	$newFirstname = $_POST["Firstname"];
    $newLastname = $_POST["Lastname"];
	$newDOB = $_POST["DOB"];
    $newGender = $_POST["Gender"];
	$newDemographic = $_POST["Demographic"];
    $newUsername = $_POST["Username"];
    $newPassword = $_POST["Password"];
    $newDateJoined = $_POST["DateJoin"];
    $newSalary = $_POST["Salary"];
    $newDept = $_POST["Dept"];

    //Create connection.
    $link = new mysqli("localhost:8889", "root", "root", "PersonnelManager");

    //Check connection.
    if(mysqli_connect_error())
    {
        die("Connection failed: " .mysqli_connect_error());
    }


    $query = "INSERT INTO Employee VALUE(NULL, '$newFirstname', '$newLastname', '$newDOB', '$newGender', '$newDemographic', '$newUsername', '$newPassword', '$newDateJoined', $newSalary, $newDept);"; //Query that contains the new data to add.
        
    $result = mysqli_query($link, $query);

    if($result){
        include("bodystyle.html");
        include("addImage.html");
    }

    else{ //Otherwise, display the error.
        echo "Error: " . $query ."<br />" . mysqli_error($link);
    }

    include ("footer.php"); //Insert footer.
?>