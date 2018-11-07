<!--
Author: Brendan Burdick
Date: April 29th, 2017
Professor: Andrew Jung
Filename: main_page.php

Purpose of Program:
The purpose of this file is to display the entire database with photos. To do this, I included, the
header, footer, and Display_Employee.php files.
-->
<?php
    session_start();
    include("header.php"); //Include header.
    include("Display_Employee.php"); //Include Display_Employee.php.
    include("footer.php"); //Include footer.
?>