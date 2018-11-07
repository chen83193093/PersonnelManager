<!--
Author: Karen Sullivan
Date: April 20th, 2017
Professor: Andrew Jung
Filename: Display_Employee.php

Purpose of Program:
The purpose of this file is solely to provide a table containing information on employees in the database. This
file is used after adding a new employee, and clicking the button on the home page saying "See Full Database
w/ Pictures".
-->
<?php 
    session_start();
    include("bodystyle.html"); //Include background.

    //establish database connection- show error if connection fails
    $link=mysqli_connect("localhost","root","root","personnelmanager") or die("Connection Failed:".mysqli_connect_error());
    //select query amoung multiple tables
    $query="select * from employee, department, project, employee_images
    where employee.department = department.DepartmentID and department.CurrentProject=project.projectID and employee.EmployeeID = employee_images.id";

    $search=$link->query($query); //Call the query.

    $result=mysqli_fetch_array($search);

    //draw table and headers
    echo "<table bgcolor='#DDEEFF' border=1 cellpadding=3 cellspacing=2>";
    echo "<tr>
        <th>Pic</th>
        <th>EmployeeID</th>
        <th>FirstName</th>
        <th>LastName</th>
        <th>DateOfBirth	</th>
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

    while ($result=mysqli_fetch_ASSOC($search)) //Display entire database.
    {
        $id =$result['EmployeeID'];

        echo "<tr>";
        echo "<td>";
        echo '<img width=100% height=auto src="data:image/jpeg;base64,'.base64_encode( $result['image'] ).'"/>';
        echo "</td>";
        echo "<td>$result[EmployeeID]</td>
             <td>$result[FirstName]</td>
             <td>$result[LastName]</td>
             <td>$result[DateOfBirth]</td>
             <td>$result[Gender]</td>
             <td>$result[Demographic]</td>
             <td>$result[DateJoined]</td>
             <td>$result[AnnualSalary]</td>
             <td>$result[DeptName]</td>
             <td>$result[Location]</td>
             <td>$result[ProjectName]</td>
             <td>$result[Budget]</td>
             <td>$result[Status]</td> ";
        echo "</tr>";
    }
        echo "</table>";
        mysqli_close($link);

 ?>