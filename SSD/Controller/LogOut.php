<?php
require_once "Function.php";
$_SESSION['Token'] = null;
$_SESSION['Fname'] = null;
$_SESSION['Lname'] = null;
$_SESSION['Uimg'] = null;
$_SESSION['Email'] = null;
$_SESSION['ID'] = null;
$_SESSION['Pages']=null;
$_SESSION['Name'] =null;
echo $link = "Location:../index.php";
header($link);