<?php
require_once 'conection.php';

// Destroy session
session_destroy();

// Redirect to home
header('Location: index.php');
exit;
?>