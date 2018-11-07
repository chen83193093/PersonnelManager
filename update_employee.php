<!--
Author: Rachel Da Silva
Date: April 20th, 2017
Professor: Andrew Jung
Filename: update_employee.php

Purpose of Program:
The purpose of this file is to provide a screen to edit employee information within the 
PersonnelManager database. Queries are used to pull the current employee information,
display it to the screen, and adjust the values as needed. Once the form is submitted, the
data is sent to the employee_anex.php file to fully upload to the database.
-->
<?php
    session_start();
    include("header.php"); //Include header.
    include("bodystyle.html"); //Include background.

    echo '<head>
              <title>Head Meets Body - Personal Management System</title>
              <link href="./style.css" rel="stylesheet" type="text/css">
              
              <style>
              
                table{
                    background-color:lightgrey;
                }
                
              </style>
          </head>';


    //Edit Employee table from here down

    echo"<center><br />Click here to edit <a href = './update_department.php'>  Department  </a> or   <a href = './update_project.php'>  Project </a> instead<br><br><hr>
    <h1 style='font-family:Comic Sans MS, cursive, sans-serif;'>Choose Which Data to Edit:</h1></center>";  //alternitives to facilitate user navigation


        //connecting to the database
            $link = mysqli_connect("localhost", "root", "root", "PersonnelManager") or die ('cannot connect');

    //pulling information to display in the form bellow
            $query = "SELECT * FROM employee";
            $result = mysqli_query($link, $query) or die ("Query failed" .mysqli_connect_error());



    //input information will be sent and processed on employee_anex / startting table to display on browser
            echo"<center><form action=./employee_anex.php method=POST>
                    <table cellpadding=3 cellspacing=2>";

    //Submit at the top to facilitate navigation -- Submiting new entries for update / when hit reset will reset back to current values
             echo" 
             <td colspam='2'><input type=submit name=submit value=Submit>&nbsp;&nbsp;
             <input type=reset name=reset value=Reset></td></tr>";

    //going though database rows and fetching info 
        $count = 0;
        while($info = mysqli_fetch_assoc($result))
        {
            $count++; //read one, go to the next one



    //Display EmployeeID - non edit permits
             echo"<tr>
                  <td><hr><hr>Employee ID: &nbsp;&nbsp;&nbsp; $info[EmployeeID]</td><td><input type=hidden name=EmployeeID$count value='$info[EmployeeID]' /></td></tr>";
    //Display - Edit First Name
            echo"<tr>
                 <td>First Name:</td><td></td> 
                 <td><input type=text name=FirstName$count value='$info[FirstName]' /></td></tr>";
    //Display - Edit Last Name
            echo"<tr>
                 <td>Last Name:</td><td></td> 
                 <td><input type=text name=LastName$count value='$info[LastName]' /></td></tr>";
    //Display - Edit Date of Birth
            echo"<tr>
                 <td>Birthday:</td><td></td>
                 <td> <input type=date name=DateOfBirth$count value='$info[DateOfBirth]' /></td></tr>";
    //Display - Edit Gender
            echo"<tr>
                <td>Gender: (ie. Male / Female ...)</td><td></td>
                <td><input type=text name=Gender$count value='$info[Gender]' />";
    //Display - Edit Demographics			
            echo"<tr>
                <td>Demographic: (ie. Caucasian ...)</td><td></td>
                <td><input type=text name=Demographic$count value='$info[Demographic]' />";
    //Display - Edit UserName
            echo"<tr>
                <td>User Name: </td><td></td>
                <td><input type=text name=Username$count value='$info[Username]' /></td></tr>";
    //Display - Edit Password
            echo"<tr>
                <td>Password: </td><td></td>
                <td><input type=password name=Password$count value='$info[Password]' /></td></tr>";
    //Display - Edit Date Joined
            echo"<tr>
                <td>Date Joined Company: </td><td></td>
                <td><input type=date name=DateJoined$count value='$info[DateJoined]' /></td></tr>";
    //Display - Edit Anual Salary
            echo"<tr>
                <td>Anual Annual Salary: </td><td></td>
                <td><input type=text name=AnnualSalary$count value='$info[AnnualSalary]' /></td></tr>";

    //Display - Edit Department ID
            echo"<tr>
                <td>Department ID: </td><td></td>
                <td><input type=text name=Department$count value='$info[Department]' /></td></tr>" ; 


    }


    //submiting new entries for update / when hit reset will reset back to current values
        echo" 
             <td colspam='2'><input type=submit name=submit value=Submit>&nbsp;&nbsp;
             <input type=reset name=reset value=Reset></td></tr>";
             echo "</table></form></center>";

             mysqli_close($link); //close connection

    include ("footer.php"); //Include footer.
?>



