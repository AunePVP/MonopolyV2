<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('location: login.php');
    exit;
} elseif ($_SESSION['username'] == "guest") {
    echo "You need to login first".
        exit;
}
if (isset($_GET['action']) && $_GET['action'] == "logout") {
    session_destroy();
    unset($_SESSION['username']);
    setcookie("username", "", time() - (86400 * 30), "/");
    setcookie("Server", "", time() - (86400 * 30), "/");
    //header("location: ../");
}
echo "Hi ".$_SESSION['username'];
?>
<h3>Logout</h3>
<a href="?action=logout">Logout</a>
