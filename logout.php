<?php

session_start();
session_unset();
    
    $_SESSION['id'] = null;           
    $_SESSION['nome'] = null;
    $_SESSION['email'] =  null;
    $_SESSION['logout'] = null;

header("Refresh: 0;url=index.php?msg=4");

?>