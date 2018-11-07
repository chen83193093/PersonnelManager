<!--
Author: Karen Sullivan
Date: April 20th, 2017
Professor: Andrew Jung
Filename: Delete_This.php

Purpose of Program:
The purpose of this file is to work with Delete_Demographics.php and delete the corresponding information that was sent.
Delete_Demographics.php passed information to this file, and this file removes it from the database.
-->
<?php  
    session_start();
    include("header.php"); //Include header.
    include("./bodystyle.html"); //Include background.

    $deleteData =array();
    $deleteData =$_POST['selectdb'];// name of the checkbox identifying delete

    $link=mysqli_connect("localhost","root","root","personnelmanager") or die("Connection Failed:".mysqli_connect_error());

    while(list($key,$value) =each($deleteData)) //For each item checked, delete it.
    {
        $query= "DELETE FROM employee WHERE EmployeeID ='$value'";

        $result=mysqli_query($link,$query)or die("Query Failed:".mysqli_connect_error());
    }
    if (!$result) 
    {
        echo "Can not delete!";
    }
    else //Confirmtation message.
    {
        echo "<br /><center><h2>EMPLOYEE INFORMATION DELETED.</h2>";
        echo "<a href='./main_page.php'>Return to Home Page</a><center><br /><br /><br />";
    }

    mysqli_close($link); 
    
	include("footer.php"); //Include footer.
?>



