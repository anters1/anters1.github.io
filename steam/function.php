
<?php
 


$login = $_POST['login'];
$pas = $_POST['password'];
if ($login == 'admin' && $pas == 'admin')
  {
  session_start();
  $_SESSION['admin'] = true;
  $script = 'adminpanel.php';
  }
else
$script = 'library.php';
header("Location: $script");



?>
