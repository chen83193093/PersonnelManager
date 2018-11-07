<!--
Author: Rachel Da Silva
Date: April 20th, 2017
Professor: Andrew Jung
Filename: project_anex.php

Purpose of Program:
The purpose of this file is to update the project table in the PersonnelManager database. This
file takes the data that was passed from update_project.php and sends it to the database. Once
this is completed, it redirects the user to the MainPageContent.php page.
-->
<?php
	session_start();
	//variables to pick up arrays
	$one = array();
	$two = array();
	$three = array();
	$idCheck = array();


//linking array string to their values
	foreach($_POST as $key => $value)
	{
		if(preg_match('/ProjectID/', $key))
		{
			$idCheck[] = $value;
		}
    
    	if(preg_match('/ProjectName/', $key))
		{
			$one[] = $value;
		}
		if(preg_match('/Budget/', $key))
		{
			$two[] = $value;
		}

		if(preg_match('/Status/', $key))
		{
			$three[] = $value;
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
		$query = "UPDATE project SET ProjectName='$one[$i]', Budget='$two[$i]', Status='$three[$i]' WHERE ProjectID='$idCheck[$i]'";
		
    	$result = mysqli_query($link, $query) or die("Query failed" .mysqli_connect_error());
	}
	
	mysqli_close($link);
    echo "<script type='text/javascript'>window.top.location='./MainPageContent.php';</script>";
	//header("Location: ./MainPageContent.php"); //CANT FIGURE OUT ERROR.
?>