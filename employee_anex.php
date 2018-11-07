<!--
Author: Rachel Da Silva
Date: April 20th, 2017
Professor: Andrew Jung
Filename: employee_anex.php

Purpose of Program:
The purpose of this file is to update the employee table in the PersonnelManager database. This
file takes the data that was passed from employee.php and sends it to the database. Once
this is completed, it redirects the user to the department.php page.
-->
<?php
	//session_start();
	//variables to pick up arrays
	$one = array();
	$two = array();
	$three = array();
	$four = array();
	$five = array();
	$six = array();
	$seven = array();
	$eight = array();
	$nine = array();
	$ten = array();
	$idCheck = array();


//linking array string to their values
	foreach($_POST as $key => $value)
	{
		if(preg_match('/EmployeeID/', $key))
		{
			$idCheck[] = $value;
		}
    
    	if(preg_match('/FirstName/', $key))
		{
			$one[] = $value;
		}
		if(preg_match('/LastName/', $key))
		{
			$two[] = $value;
		}

		if(preg_match('/DateOfBirth/', $key))
		{
			$three[] = $value;
		}

		if(preg_match('/Gender/', $key))
		{
			$four[] = $value;
		}
		if(preg_match('/Demographic/', $key))
		{
			$five[] = $value;
		}
		if(preg_match('/Username/', $key))
		{
			$six[] = $value;
		}
		if(preg_match('/Password/', $key))
		{
			$seven[] = $value;
		}
		if(preg_match('/DateJoined/', $key))
		{
			$eight[] = $value;
		}
		if(preg_match('/AnnualSalary/', $key))
		{
			$nine[] = $value;
		}
		if(preg_match('/Department/', $key))
		{
			$ten[] = $value;
		} 
	
	}

		
//count to check table id
	$num = count($idCheck);  

//connecting to the database
	$link = mysqli_connect("localhost", "root", "root", "PersonnelManager") or die('cannot connect');
    //mysql_select_db("test") or die('cannot select DB');


//go through the array
	for($i = 0; $i < $num; $i++)

		//updating entries
	{
		$query = "UPDATE Employee SET FirstName='$one[$i]', 
									  LastName='$two[$i]', 
									  DateOfBirth='$three[$i]', 
									  Gender='$four[$i]', 
									  Demographic='$five[$i]', 
									  Username='$six[$i]', 
									  Password='$seven[$i]', 
									  DateJoined='$eight[$i]', 
									  AnnualSalary='$nine[$i]' ,
									  Department='$ten[$i]'  
									  WHERE EmployeeID='$idCheck[$i]'";
		
    	$result = mysqli_query($link, $query) or die("Query failed" .mysqli_connect_error());
	}
	mysqli_close($link);
    echo "<script type='text/javascript'>window.top.location='./update_department.php';</script>";
    
?>