<?php 
require_once ('app/functions.php');
destroyAllSessions();
$_SESSION['ms']="You sucsefly loget out";
header("location: index.php");