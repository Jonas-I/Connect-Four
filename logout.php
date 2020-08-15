<?php
session_start();
session_destroy();
header('Location: https://venus.cs.qc.cuny.edu/~imjo9615/CS355/home.html?status=loggedout');
?>