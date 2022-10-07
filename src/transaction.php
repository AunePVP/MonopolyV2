<?php
session_start();
include_once 'config.php';
$server = $_COOKIE['Server'];
$conn = mysqli_connect($servername, $dbusername, $password, $dbname);
$streetdata = json_decode(file_get_contents("data.json"));
if (isset ($_GET['usage'])) {
    $usage = $_GET['usage'];
}
$id = $_SESSION["id"];
// Find out basic information
$sql = "SELECT streets, money FROM players$server WHERE id='$id'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $money = $row["money"];
        $ownedstreets = json_decode($row["streets"]);
    }
}
$count = 0;
// Buy a street
if ($usage == "buy") {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $street = $_POST["street"];
    }
    $price = $streetdata->Street->{$street}->price;
    $sql = "SELECT id, streets, money FROM players$server";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $streets = json_decode($row["streets"]);
            $playerid = $row["id"];
            if (in_array($street, $streets)) {
                $error[$count]["description"] = "This property is already owned by playerid:".$playerid;
                $count++;
            }
        }
    }
    if ($money < $price) {
        $error[$count]["description"] = "Not enough money. You need at least $price$. You have $money$.";
    }
    if (!isset($error)) {
        // Update street and money
        $ownedstreets[] = "$street";
        $ownedstreets = json_encode($ownedstreets);
        $money = $money - $price;
        $sql = "UPDATE players$server SET streets='$ownedstreets', money='$money' WHERE id='$id'";
        if (!mysqli_query($conn, $sql)) {
            echo "Error updating record: " . mysqli_error($conn);
        }

    }
    header('LOCATION: ../');
} elseif ($usage == "rent") {
    // Get the street
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $street = $_POST["street"];
    }
    // Find out the amount of houses
    $sql = "SELECT houses FROM streets$server WHERE id='$street'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $houses = $row["houses"];
        }
    }
    // Find out how much the rent is
    if ($houses == 0) {
        $rent = $streetdata->Street->{$street}->rent;
    } elseif($houses > 0 && $houses < 6) {
        $rent = $streetdata->Street->{$street}->{$houses};
    }
    if (in_array($street, $ownedstreets)) {
        $count++;
        $error[$count]["description"] = "You already own this street";
    } else {
        if ($money < $rent) {
            $count++;
            $error[$count]["description"] = "You don't have enough money to pay rent.";
        } else {
            // Find out who owns this property and get the money
            $sql = "SELECT id, streets, money FROM players$server";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    $streets = json_decode($row["streets"]);
                    if (in_array($street, $streets)) {
                        $ownerid = $row["id"];
                        $ownermoney = $row["money"];
                    }
                }
            }
            echo "The street is owned by $ownerid and he has $ownermoney$.<br>";
            // Calculate the new balance of the hosted person
            $money = $money - $rent;
            // Calculate the new balance of the owner
            $ownermoney = $ownermoney + $rent;
            // Upload both
            $sql = "UPDATE players$server SET money='$money' WHERE id='$id'";
            if (!mysqli_query($conn, $sql)) {
                echo "Error updating record: " . mysqli_error($conn);
            }
            $sql = "UPDATE players$server SET money='$ownermoney' WHERE id='$ownerid'";
            if (!mysqli_query($conn, $sql)) {
                echo "Error updating record: " . mysqli_error($conn);
            }
        }
    }
    header('LOCATION: ../');
}