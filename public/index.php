<?php
session_start();

use app\library\Authenticate;
use app\library\GoogleClient;

require '../vendor/autoload.php';

$googleClient = new GoogleClient;
$googleClient->init();
$auth = new Authenticate;
if ($googleClient->authorized()) {
    $auth->authGoogle($googleClient->getData());
}

if(isset($_GET['logout'])) {
    $auth->logout();
}

$authUrl = $googleClient->generateAuthLink();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  Olá,
   <?php
    if(isset($_SESSION['user'], $_SESSION['auth'])):
        echo $_SESSION['user']->firstName . ' ' . $_SESSION['user']->lastName;
        ?>
  <a href="?logout=true">Logout</a>
    <?php else: ?>
      Visitante
    <?php endif ?>

  <form action="">
    <input type="text" name="email" placeholder="Email">
    <input type="text" name="password" placeholder="Password">
    <button type="submit">Login</button>
    <a href="<?php echo $authUrl; ?>">Login with google</a>
    <a href="/register">Register</a>
  </form>
</body>
</html>