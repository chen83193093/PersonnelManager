<!--
Author: Dylan Schofield
Date: April 20th, 2017
Professor: Andrew Jung
Filename: search_result.php

Purpose of Program:
The purpose of this file is to present the results of a desired search term. Throughout the various pages of the
PersonnelManager, users can search for users at any time. Once the search form is filled, the data is sent to this
file, where the search term is checked against the database for a match. A file is also saved separately for later
printing as well.
-->
<?php
    session_start();
	include "header.php"; //Include header.
    include("./bodystyle.html"); //Include background.

$searchText = $_POST["text"];
	
 $query="SELECT * FROM Employee
 		WHERE FirstName LIKE '%" . $searchText ."%'
 		OR LastName LIKE '%" . $searchText ."%'
 		OR DateOfBirth LIKE '%" . $searchText ."%'
 		OR Gender LIKE '%" . $searchText ."%'
 		OR Demographic LIKE '%" . $searchText ."%'
 		OR DateJoined LIKE '%" . $searchText ."%'
 		OR AnnualSalary LIKE '%" . $searchText ."%'
 		OR Department LIKE '%" . $searchText ."%'
 		";

//$query = 'SELECT * FROM employee WHERE FullName LIKE '%$find%;
	$search = $link->query($query);
	//$result=mysqli_fetch_array($search);

$fileName = "SearchResultsFor" . $searchText . ".html";
$fileHandle = fopen($fileName, 'w') or die("Couldn't Open File. Sorry.");

echo '<center><h2>Results for "'.$searchText.'"</h2>';

echo "<table bgcolor='#DDEEFF' border=1 cellpadding=3 cellspacing=2>";
echo "<tr>
	
	<th>ID</th>
	<th>First Name</th>
	<th>Last Name</th>
	<th>Date Of Birth</th>
	<th>Gender</th>
	<th>Demographic</th>
	<th>Date Joined</th>
	<th>Annual Salary</th>
	<th>Dept. Name</th>
	<th>Location</th>
	<th>Project Name</th>
	</tr>";

while ($info=mysqli_fetch_ASSOC($search)) 
{
	
	echo "<tr>";
	echo "<td>$info[EmployeeID]</td>
		 <td>$info[FirstName]</td>
		 <td>$info[LastName]</td>
		 <td>$info[DateOfBirth]</td>
		 <td>$info[Gender]</td>
		 <td>$info[Demographic]</td>
		 <td>$info[DateJoined]</td>
		 <td>$$info[AnnualSalary]</td>
	
		
		";
		 if ($info[Department] === "1"){
		 echo "<td>Software Development</td>";
		 echo "<td>Framingham, MA</td>";
		 echo "<td>Personnel Management</td>";
		}
		elseif ($info[Department] === "2"){
			echo "<td>System Analysis</td>";		
			echo "<td>Sudbury, MA</td>";
			 echo "<td>Tic-Tac-Toe Game</td>";
		}
		elseif ($info[Department] === "3"){
			echo "<td>Quality Assurance</td>";
			echo "<td>Stow, MA</td>";	
			 echo "<td>File Database</td>";	
		}
		elseif ($info[Department] === "4"){
			echo "<td>Database Management</td>";	
			echo "<td>Boston, MA</td>";	
			echo "<td>Fraction Generator</td>";
		}
		else{
			echo "<td> </td>";	
			echo "<td> </td>";	
			echo "<td> </td>";	
		}

	echo "</tr>";
}
	echo "</table></center>";
    
    //RESET TO WRITE FILE
    $search = $link->query($query);

    fwrite($fileHandle, "<center><h2>Results for '$searchText'</h2>
    <br /><br /><table bgcolor='#DDEEFF' border=1 cellpadding=3 cellspacing=2>
    <tr>
	<th>ID</th>
	<th>First Name</th>
	<th>Last Name</th>
	<th>Date Of Birth	</th>
	<th>Gender</th>
	<th>Demographic</th>
	<th>Date Joined</th>
	<th>Annual Salary</th>
	<th>Dept. Name</th>
	<th>Location</th>
	<th>Project Name</th>
	</tr>");

    while ($info=mysqli_fetch_ASSOC($search)) 
    {
        fwrite($fileHandle, "
         <tr>
	     <td>$info[EmployeeID]</td>
		 <td>$info[FirstName]</td>
		 <td>$info[LastName]</td>
		 <td>$info[DateOfBirth]</td>
		 <td>$info[Gender]</td>
		 <td>$info[Demographic]</td>
		 <td>$info[DateJoined]</td>
		 <td>$$info[AnnualSalary]</td>");

        if ($info[Department] === "1"){
		 fwrite($fileHandle, "<td>Software Development</td>
                <td>Framingham, MA</td>
                <td>Personnel Management</td>");
		}
        elseif ($info[Department] === "2"){
		 fwrite($fileHandle, "<td>System Analysis</td>
                <td>Sudbury, MA</td>
                <td>Tic-Tac-Toe Game</td>");
		}
        elseif ($info[Department] === "3"){
		 fwrite($fileHandle, "<td>Quality Assurance</td>
                <td>Stow, MA</td>
                <td>File Database</td>");
		}
        elseif ($info[Department] === "4"){
		 fwrite($fileHandle, "<td>Database Management</td>
                <td>Boston, MA</td>
                <td>Fraction Generator</td>");
		}
        else{
		 fwrite($fileHandle, "<td></td>
                <td></td>
                <td></td>");
		}
        
        fwrite($fileHandle, "</tr>");
    }

    fwrite($fileHandle, "
    </table></center>
    ");

	mysqli_close($link);

	include "footer.php"; //Include footer.

?>