<?php
session_start();
if (empty($_SESSION['loginConnect_btn'])) {
    header("Location: ./");
}

/*setcookie('Pseudo','',time()-1800);
setcookie('Password','',time()-1800);*/
session_destroy();
header('Location: ./');
exit;
?>