<?php
// logout.php
session_start();
session_destroy();
header("Location: admin_in.php");
exit();
?>