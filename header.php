<!--
Author: Dylan Schofield
Date: April 20th, 2017
Professor: Andrew Jung
Filename: header.php

Purpose of Program:
The purpose of this file is to provide a header for most pages. This file is used on
almost all pages.
-->
<?php
    session_start();

    $link = mysqli_connect("localhost", "root", "root", "PersonnelManager") or die("Unable to connect mysql" .mysqli_connect_error());

    //if(!empty($_SESSION["CurrentUser"])){
        echo '<head>
        <title>Head Meets Body - Personal Management System</title>
            <link href="./style.css" rel="stylesheet" type="text/css">
    </head>
    <body style="overflow: visible !important;">
        <div id="bodywrap">
            <div class="header">
                <div id="headerleft">
                    <a href="./MainPageContent.php"><img align="center" alt="Company Logo here" height="100px" id="companylogo" src="sample_logo.png" width="150px"></a>
                </div>
                <div id="headerright">
                    <div id="welcome">
                        <p>Welcome back!<br>
                        You are currently logged in.<br></p>
                        <a href="./index.html"><button>Log Out</button></a>
                    </div>
                </div>
            </div>
            <div>
                    <div class="nav">
                <a href="./MainPageContent.php"><strong>Home</strong></a> | <a href="./NewEmployee.php"><strong>Add New Employees</strong></a> | <a href="./update_employee.php"><strong>Edit Database Information<strong></a> | <a href="Delete_Demographics.php"><strong>Delete An Employee<strong></a>
            </div>
            
                <center><br />
                 <form action="./search_result.php" method="post">
                     Search: <input type="text" name="text" />
                 <input type="submit" name="submit" value="Submit" />
                </form>
                </center>
    ';
    /*}
    else{
        session_start(); //to ensure you are using same session
        session_destroy(); //destroy the session
        header("location:./index.html"); //to redirect back to "index.php" after logging out
    }*/
?>