<?php

    session_start();
    session_destroy();
    header("location:../votemat_index.php");

?>