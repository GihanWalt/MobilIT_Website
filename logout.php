<?php

// Start the session
session_start();

// Destroy the session
session_destroy();

header("location: index.php");
exit;

?>