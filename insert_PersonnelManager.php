<!--
Author: Karen Sullivan
Date: April 20th, 2017
Professor: Andrew Jung
Filename: insert_PersonnelManager.php

Purpose of Program:
The purpose of this file is to upload images into the employee_images table. This is used
during the "Add New User" step.
-->
<?php 
    session_start();
    include ("header.php"); //Include header.
    include ("bodystyle.html"); //Include background.
    $link=mysqli_connect("localhost","root","root","personnelmanager")or die("Connection Failed:".mysqli_connect_error());

        if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) 
        {

            // Temporary file name stored on the server

            $tmpName = $_FILES['image']['tmp_name'];


            // Read the file

            $fp = fopen($tmpName, 'r');

            $data = fread($fp, filesize($tmpName));

            $data = addslashes($data);

            fclose($fp);

            //SQL quiery to insert image into db
            $query = "INSERT INTO employee_images (image) VALUES ('$data')";
            $result = mysqli_query($link, $query) or die("Query failed" .mysqli_connect_error());

            echo "Thank you, your data was added.";
            include("Display_Employee.php");
            }

        else 
        {
            //file will fail if it is too big... tried uploading 760 Kb... must change file size.
            echo "Please try again....no image selected/uploaded.";

        }
    include ("footer.php");  //Include header.

    // Close our MySQL Link
    mysqli_close($link);
 ?>