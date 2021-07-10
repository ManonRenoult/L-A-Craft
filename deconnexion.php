<?php
session_start ();
if (empty ($_SESSION['username'])){
    header("Location: ./index.php");
}
/*
setcookie('Pseudo','',time()-1800);
setcookie('Password','',time()-1800);
*/
session_destroy ();
header ('Location: ./index.php');
exit;
?>