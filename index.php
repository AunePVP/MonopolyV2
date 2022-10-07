<?php
include_once 'src/config.php';
include_once 'src/language.php';
$title = "Monopoly";
session_start();
$username = $_SESSION["username"] ?? "public";
if (isset($_GET['oid'])) {
    $setup = TRUE;
} else {
    $setup = FALSE;
}

?>
<!doctype html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="src/css/style.css">
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>-->
    <script src="src/script.js"></script>
    <title><?php echo $title ?></title>
</head>
<div id="nav">
    <ul>
        <li><a href="">Monopoly</a></li>
        <div style="width: 100%;"></div>
        <?php
        if (isset($_SESSION['username'])) {
            $username = $_SESSION['username'];
            echo '<div class="login"><a class="button white-hover" href='."'user'".'>'.$username.'</a><div class="dropdown-content"></div></div>';
        }else {
            $_SESSION['backURI'] = $_SERVER['REQUEST_URI'];
            echo '<div class="login"><a class="button white-hover" href='."'user/login.php'".'>Login</a><div class="dropdown-content"></div></div>';
        }
        ?>
    </ul>
</div>
<body onload="loadstreets()">
<?php
if ($setup) {
    include 'src/setup.php';
} elseif(isset($_COOKIE['Server'])) {
    echo "<main id='main'>";
    include 'src/street.php';
    echo "</main>";
    echo "<div class='navbar' id='myNavbar'><div id='bottom-a'>$username</div>";
    $id = $id = $_SESSION["id"];
    echo "<div id='money'>1500$</div></div>";
} else {
    include 'src/info.php';
}
?>
</body>
</html>
