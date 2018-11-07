<!--
Author: Karen Sullivan
Date: April 20th, 2017
Professor: Andrew Jung
Filename: Delete_Demographics.php

Purpose of Program:
The purpose of this file is to provide a screen to the user for database deletion. Upon loading,
the user is presented with a list of active employees in the database. From here, the user can check
a check box (or multiple check boxes), and when they click submit, those users will be deleted. The
first user cannot be deleted, since they are the admin of the system.
-->
<?php
    session_start();
    include("./header.php"); //Include header.
    include("./bodystyle.html"); //Include background.

    //establish database connection- show error if connection fails
    $link=mysqli_connect("localhost","root","root","personnelmanager") or die("Connection Failed:".mysqli_connect_error());
    $query="select * from employee, department, project 
    where employee.department = department.DepartmentID and department.CurrentProject=project.projectID";

    $result=mysqli_query($link,$query)or die("Query Failed:".mysqli_connect_error()); //Call query.
    $nbr_rows=mysqli_num_rows($result); //Get row count.

    echo "<br />";

    echo '<center><h1 style="font-family:Comic Sans MS, cursive, sans-serif;">Select the Employees to Delete:</h1>';

    echo "<form action=./delete_this.php method=POST>
        <table bgcolor='#DDEEFF' border=1 cellpadding=3 cellspacing=2>
        <tr>
        <th></th>
        <th>EmployeeID</th>
        <th>FirstName</th>
        <th>LastName</th>
        <th>DateOfBirth</th>
        <th>Gender</th>
        <th>Demographic</th>
        <th>DateJoined</th>
        <th>AnnualSalary</th>
        <th>DeptName</th>
        <th>Location</th>
        <th>ProjectName</th>
        <th>Budget</th>
        <th>Status</th>
        </tr>";

    while ($info=mysqli_fetch_assoc($result)) //Display table.
    {

        $id =$info['EmployeeID'];
        
        if($id == 1)
        {
            echo "<tr>";
            echo "  <td><center><b>X</b></center></td>";
            echo "	<td>$info[EmployeeID]</td>
                    <td>$info[FirstName]</td>
                    <td>$info[LastName]</td>
                    <td>$info[DateOfBirth]</td>
                    <td>$info[Gender]</td>
                    <td>$info[Demographic]</td>
                    <td>$info[DateJoined]</td>
                    <td>$info[AnnualSalary]</td>
                    <td>$info[DeptName]</td>
                    <td>$info[Location]</td>
                    <td>$info[ProjectName]</td>
                    <td>$info[Budget]</td>
                    <td>$info[Status]</td>";
            echo "</tr>";
        }
        
        else
        {
        echo "<tr>";
        echo "<td><input type=checkbox name=selectdb[$id] value=$id></td>";
        echo "	<td>$info[EmployeeID]</td>
                <td>$info[FirstName]</td>
                <td>$info[LastName]</td>
                <td>$info[DateOfBirth]</td>
                <td>$info[Gender]</td>
                <td>$info[Demographic]</td>
                <td>$info[DateJoined]</td>
                <td>$info[AnnualSalary]</td>
                <td>$info[DeptName]</td>
                <td>$info[Location]</td>
                <td>$info[ProjectName]</td>
                <td>$info[Budget]</td>
                <td>$info[Status]</td>";
        echo "</tr>";
        }

    }

    echo "<tr><td colspan=22 align=center><input type=submit value=submit>&nbsp;&nbsp;<input type =reset value=reset></td></td>";
    echo "</table></form>";

    mysqli_close($link); //Close connection.

    include("./footer.php"); //Include footer.
 ?>