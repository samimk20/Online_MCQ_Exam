<?php

    session_start();
    
    // Finally, destroy the session.
    session_destroy();
    
    //header("Location: index.php?log=out");
    echo "<script>window.location='index.php';</script>";
    exit;
 
?> 