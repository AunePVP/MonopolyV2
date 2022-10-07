<?php
include_once '../src/config.php';
include_once '../src/language.php';
$title = "Registration";
session_start();
if (isset($_SESSION['username'])) {
    header('location: ../');
}
if (array_key_exists('register', $_POST)) {
    $username = trim($_POST["username"]);
    $password1 = trim($_POST["password1"]);
    $password2 = trim($_POST["password2"]);
    $displayname = trim($_POST["displayname"]);
    if (!empty($username) && !empty($password1) && !empty($password2)) {
        if (strlen($username) < 4) {
            $errors['mincharacters'] = $ltrans[$lang][28];
        }
        if (!preg_match("/^[a-zA-Z0-9_-äöüß.-]*$/m", $username)) {
            $errors['specialuser'] = $ltrans[$lang][29];
        }
        if ($password1 !== $password2) {
            $errors['nomatch'] = $ltrans[$lang][30];
        }
        if (strlen($password1) < 4) {
            $errors['mincharacterspw'] = $ltrans[$lang][31];
        }
    } else {
        $errors['emptyline'] = $ltrans[$lang][27];
    }
    if (!isset($errors)) {
        $conn = mysqli_connect($servername, $dbusername, $password, $dbname);
        $sql = "SELECT * FROM users WHERE username='$username'";
        $result = $conn->query($sql);
        if (!$result->num_rows == 0) {
            $errors['userexists'] = "A user with this username already exists. Please choos another username or login <a href='login.php'>here</a>.";
        }
        if (!isset($errors)) {
            $password = hash('sha256', $password1);
            $sql = "INSERT INTO users (username, displayname, password) VALUES('$username', '$displayname', '$password')";
            mysqli_query($conn, $sql);
            $_SESSION['username'] = $username;
            header('location: index.php');
        }
        mysqli_close($conn);
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" >
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../src/css/style.css">
    <title><?php echo $title?></title>
</head>
<div id="nav">
    <ul>
        <li><a href="../">Monopoly</a></li>
        <div style="width: 100%;"></div>
    </ul>
</div>
<body>
<div class="login-popup">
    <div class="centerdiv">
        <div class="padding15">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" style="margin:0">
                <label for="username"><?php echo $ltrans[$lang][22]?>:</label><input id="username" class="input" name="username" type="text" minlength="4" maxlength="15" placeholder="leo.mhs" autocomplete="off">
                <label for="displayname"><?php echo $ltrans[$lang][24]?>:</label><input id="displayname" class="input" name="displayname" type="text" minlength="2" maxlength="15" placeholder="Leo" autocomplete="off">
                <?php if(isset($errors['mincharacters'])){echo $errors['mincharacters'];}elseif(isset($errors['specialuser'])){echo $errors['specialuser'];}elseif(isset($errors['userexists'])){echo $errors['userexists'];}?>
                <label for="password1"><?php echo $ltrans[$lang][23]?>:</label><input id="password1" class="input" name="password1" type="password" minlength="8" placeholder="xxxxxxxxxxxx" autocomplete="off">
                <label for="password2"><?php echo $ltrans[$lang][23]?>:</label><input id="password2" class="input" name="password2" type="password" minlength="8" placeholder="xxxxxxxxxxxx" autocomplete="off">
                <?php if(isset($errors['nomatch'])){echo $errors['nomatch'];}elseif(isset($errors['mincharacterspw'])){echo $errors['mincharacterspw'];} ?>
                <div style="display:flex;justify-content: flex-end;-webkit-align-items: center;align-items: center;">
                    <?php if (isset ($errors['emptyline'])){echo $errors['emptyline'];}
                    ?>
                    <input class="submit" type="submit" name="register" value="<?php echo $ltrans[$lang][25]?>" style="display: <?php echo $displaysubmit?>">
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>