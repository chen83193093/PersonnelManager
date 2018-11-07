<!--
Author: Rachel Da Silva
Date: April 20th, 2017
Professor: Andrew Jung
Filename: department_anex.php

Purpose of Program:
The purpose of this file is to update the department table in the PersonnelManager database. This
file takes the data that was passed from update_department.php and sends it to the database. Once
this is completed, it redirects the user to the update_project.php page.
-->
<?php
	session_start();
	//variables to pick up arrays
	$one = array();
	$two = array();
	$three = array();
	$four = array();
	$idCheck = array();

//linking array string to their values
	foreach($_POST as $key => $value)
	{
		if(preg_match('/DepartmentID/', $key))
		{
			$idCheck[] = $value;
		}
    
    	if(preg_match('/DeptName/', $key))
		{
			$one[] = $value;
		}
		if(preg_match('/NoOfStaff/', $key))
		{
			$two[] = $value;
		}

		if(preg_match('/Location/', $key))
		{
			$three[] = $value;
		}
		if(preg_match('/CurrentProject/', $key))
		{
			$four[] = $value;
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
		$query = "UPDATE department SET DeptName='$one[$i]', 
										NoOfStaff='$two[$i]', 
										Location='$three[$i]', 
										CurrentProject='$four[$i]' 
										WHERE DepartmentID='$idCheck[$i]'";
		
    	$result = mysqli_query($link, $query) or die("Query failed" .mysqli_connect_error());
	}
	mysqli_close($link);
    echo "<script type='text/javascript'>window.top.location='./update_project.php';</script>";
	//header("Location: ./update_project.php"); // <-CANT FIGURE OUT ERROR.
?>