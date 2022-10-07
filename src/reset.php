<?php
include_once 'language.php';
include_once 'config.php';
$conn = mysqli_connect($servername, $dbusername, $password, $dbname);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $gameid = $_POST['password'];

    // Check if there are any servers woth this pin
    try {
        $sql = "SELECT id FROM players$gameid";
        $result = mysqli_query($conn, $sql);
        if (!mysqli_num_rows($result) > 0) {
            echo "no database";
        }
    }
    catch( Exception $e )
    {
        $error = TRUE;
    }
    try {
        $sql = "SELECT id FROM streets$gameid";
        $result = mysqli_query($conn, $sql);
        if (!mysqli_num_rows($result) > 0) {
            echo "no database";
        }
    }
    catch( Exception $e )
    {
        $error = TRUE;
    }
    // If a table doesn't exist, an error will be thrown
    // If there's no error, reset tables
    // start with playes table
    $sql = "UPDATE players$gameid SET name = '0', streets = '[0]', money = '1500'";
    if (!isset($error)) {
        $sql = "UPDATE players$gameid SET name = '0', streets = '[0]', money = '1500'";
        if (!mysqli_query($conn, $sql)) {
            echo "Error updating record: " . mysqli_error($conn);
        }
        $sql = "UPDATE streets$gameid SET houses = '0'";
        if (!mysqli_query($conn, $sql)) {
            echo "Error updating record: " . mysqli_error($conn);
        }
    } else {
        echo "error";
    }
    header('Location: ../');
}

?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="css/reset.css">
    <title><?php echo $ltrans[$lang][47]?></title>
</head>
<body>
    <div id="passwort-generate">
        <h2><?php echo $ltrans[$lang][48]?></h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>">
            <input id="passwd" type="text" size="23" name="password" placeholder="••••">
            <div class="button">
                <input id="button" type="submit" value="<?php echo $ltrans[$lang][48]?>">
            </div>
        </form>
    </div>
</body>
</html>