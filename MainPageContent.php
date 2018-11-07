<!--
Author: Brendan Burdick and Brendan Burdick
Date: April 29th, 2017
Professor: Andrew Jung
Filename: MainPageContent.php

Purpose of Program:
The purpose of this file is to provide a home page to the system. On this page we have navbars, a small database view, 
and other ways to get around the system. When you click on the logo in the upper left hand portion of the screen, it 
brings you here.
-->
<?php 
session_start();

include 'header.php'; //Include header.
echo '
    <head>
        <style>
            .button {
                border: none;
                color: white;
                padding: 15px 32px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                width: 100%;
            }
            
            .button:hover {
                border: 1px solid #69afd5;
                color: lightgray;
                cursor: pointer;
                transition-duration: 0.5s;
            }
            
            body{
                background-image: url("bgimage.jpeg");
                background-color: lightgrey;
            }
        </style>
    </head>
    
    <body</body>
    <br /><center><h1 style="font-family:Comic Sans MS, cursive, sans-serif;">Welcome to the Head Meets Body Personnel Management System!</h1>
    <p style="font-family:Comic Sans MS, cursive, sans-serif;">
    If this is your first time here, do not fear! We have your back. There are plenty of things you can do with this system, including: </p></center>

	<table align=center>
        <tr>
            <td><a href="./ShowWholeDatabase.php"><button class=button style="background-color: #69afd5; ">Seeing the Entire Database w/ Pictures</button></a></td>
            <td><a href="./NewEmployee.php"><button class=button style="background-color: #69afd5;">Adding New Employees to the Database</button></a></td>
        </tr>
        <tr>
            <td><a href="./update_employee.php"><button class=button style="background-color: #69afd5;">Editing Existing Database Information</button></a></td>
            <td><a href="./Delete_Demographics.php"><button class=button style="background-color: #69afd5;">Delete Personnel From the Database</button></a></td>
        </tr>
    </table>

	<br /><br /><br />

    <hr width=75%>';

    echo '<br /><br /><br />';
    
    include ("showall.php"); //Include a small view of the database.
    include 'footer.php'; //Include footer.
?>