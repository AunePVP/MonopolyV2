<?php
session_start();
$id = $_SESSION["id"];
$server = $_COOKIE['Server'];
include_once 'config.php';
$streetdata = json_decode(file_get_contents("data.json"));
$conn = mysqli_connect($servername, $dbusername, $password, $dbname);
$sql = "SELECT streets, money FROM players$server WHERE id='$id'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $streets = json_decode($row["streets"]);
        $money = $row["money"];
    }
}

$ids = "'".implode("','",$streets)."'";
$sql = "SELECT * FROM streets$server WHERE id IN ($ids)";
$result = mysqli_query($conn, $sql);
$x="0";
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $data[$x]['id'] = $row["id"];
        $data[$x]['houses'] = $row["houses"];
        $x++;
    }
}
$data["money"] = $money;
mysqli_close($conn);
echo json_encode($data);