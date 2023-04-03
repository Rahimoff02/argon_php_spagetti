<?php
session_start();  
$axtar='';
$taxtar='';

if(!isset($_SESSION['email']) or !isset($_SESSION['parol'])) 
{echo'<meta http-equiv="refresh" content="0; URL=sign-in.php">'; exit;} 
$con=mysqli_connect('localhost','root','','stock_ms');
?>