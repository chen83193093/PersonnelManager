<!--
Author: Brendan Burdick
Date: April 20th, 2017
Professor: Andrew Jung
Filename: NewEmployee.php

Purpose of Program:
The purpose of this file is to use sandwich the NewEmployee.html file in
between the header and footer files.
-->
<?php
    session_start();

    include("./header.php");
    
    include("bodystyle.html");
    include("./NewEmployee.html");
    
    include("./footer.php");
?>