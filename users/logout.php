<?php
include("../misc/redirect.php");
session_start();
unset($_SESSION['userId']);
unset($_SESSION['username']);
redirect('login.php');