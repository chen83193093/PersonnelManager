<!--
Author: Rachel Da Silva
Date: April 20th, 2017
Professor: Andrew Jung
Filename: update_project.php

Purpose of Program:
The purpose of this file is to provide a screen to edit project information within the 
PersonnelManager database. Queries are used to pull the current project information,
display it to the screen, and adjust the values as needed. Once the form is submitted, the
data is sent to the project_anex.php file to fully upload to the database.
-->
<?php 	
    session_start();
    include("./header.php"); //Include header.
    include("./bodystyle.html"); //Include background.
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


    echo"<center><br />Click here to edit <a href = './update_employee.php'>  Employee  </a> or   <a href = './update_department.php'>  Department </a> instead<br><br><hr>
    <h1 style='font-family:Comic Sans MS, cursive, sans-serif;'>Choose Which Data to Edit:</h1></center>";  //alternitives to facilitate user navigation


     //connecting to the database
            $link = mysqli_connect("localhost", "root", "root", "PersonnelManager") or die ('cannot connect');

    //pulling information to display in the form bellow

            $query = "SELECT * FROM project";
            $result = mysqli_query($link, $query) or die ("Query failed" .mysqli_connect_error());

    //input information will be sent and processed on employee_anex / startting table to display on browser
            echo"<center><form action=./project_anex.php method=POST>
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


    //Display ProjectID - non edit permits
            //from Project Table
            echo"<tr>
                 <td><hr><hr>Project ID: &nbsp;&nbsp;&nbsp; $info[ProjectID]</td><td><input type=hidden name=ProjectID$count value='$info[ProjectID]' /></td></tr>";
    //Display - Edit Project Name
            echo"<tr>
                 <td>Project Name: </td><td><input type=text name=ProjectName$count value='$info[ProjectName]' /></td></tr>";
    //Display - Edit Budget
            echo"<tr>
                 <td>Budget: </td><td><input type=text name=Budget$count value='$info[Budget]' /></td></tr>";
    //Display - Edit Status
            echo"<tr>
                 <td>Status: </td><td><input type=text name=Status$count value='$info[Status]' /></td></tr>";

        }

    //submiting new entries for update / when hit reset will reset back to current values
        echo"<tr>
             <td colspam='2'><input type=submit name=submit value=Submit>&nbsp;&nbsp;
             <input type=reset name=reset value=Reset></td></tr>";
             echo "</table></form></center<";

             mysqli_close($link); //close connection

    include("./footer.php"); //Include footer.
?>

