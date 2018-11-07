<!--
Author: Karen Da Silva
Date: April 29th, 2017
Professor: Andrew Jung
Filename: showall.php

Purpose of Program:
The purpose of this file is to provide a small view of the active employees in th database. This
is used within the MainPageContent.php file.
-->
<?php 	

    session_start();

    echo '<head>
        <title>Head Meets Body - Personal Management System</title>
            <link href="./style.css" rel="stylesheet" type="text/css">

    <style>
    table{
    	border-collapse: collapse;

    }
    td, th{
    	border: 1px solid #dddddd;
    	text-align: left;
    	padding: 8px;
    }
    tr:nth-child(even){
    	background-color: #dddddd;
    }
    </style>
    </head>';


//ShowAll Page from here down

echo" 
<center><h1> Active Employees in the Database </h1>";

    //connect to the database
		$link = mysqli_connect("localhost", "root", "root", "PersonnelManager") or die ('cannot connect');

        //Pulling Info from the database
		$query = "SELECT * FROM employee";
		$result = mysqli_query($link, $query) or die ("Query failed" .mysqli_connect_error()); 



        //start of table for browser display
		echo"<table cellpadding=3 cellspacing=2 width=800px>";

                 
    //count to "count through row of the table"
	$count = 0;
    //while fetching information that is connected to the $result query statet above
	while($info = mysqli_fetch_assoc($result))

	{
		$count++; //read one go to the next one



	
//Display EmployeeID
         echo"<tr><td colspam=2>Employee ID: $info[EmployeeID]</td></tr>";
//Display Profile Pricture to enter here
 /*    echo"<td>";
         echo '<img src="data:image/jpeg;base64,'.base64_encode( $result['image'] ).'"/>';
         echo"</td>";  */
//Display First Name
		echo"<tr>
			 <td>First Name: <br /> $info[FirstName]</td>";
//Display Last Name
		echo"
			 <td>Last Name: <br /> $info[LastName]</td>";
//Display Date of Birth
		echo"
		     <td>Birthday: <br /> $info[DateOfBirth]</td>";
//Display Gender
		echo"
            <td>Gender: <br /> $info[Gender] </td>";
//Display Demographics			
        echo"
            <td>Demographic: <br />$info[Demographic]</td></tr></center>"; 


}
	
	//ending table
		 echo "</table></form>";

		 mysqli_close($link);  //closing conection

?>



