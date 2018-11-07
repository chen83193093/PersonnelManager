<!--
Author: Dylan Schofield
Date: April 20th, 2017
Professor: Andrew Jung
Filename: logout.php

Purpose of Program:
The purpose of this file is to provide a header for most pages. This file is used on
almost all pages.
-->
<?php   
session_start(); //to ensure you are using same session
session_destroy(); //destroy the session
header("Location: ./index.html"); //to redirect back to "index.php" after logging out
exit();
?>