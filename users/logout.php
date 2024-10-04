<?php
session_start();
include("../misc/redirect.php");

session_unset();
session_destroy();
redirect('login.php');