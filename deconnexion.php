<?php
session_start ();
/*
setcookie('Pseudo','',time()-3600);
setcookie('Password','',time()-3600);
*/
session_destroy ();
header ('Location: ./index.php');
exit;
?>