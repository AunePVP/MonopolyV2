<?php
session_start();
include_once 'language.php';
include_once 'config.php';
$server = $_COOKIE['Server'];
$id = $_SESSION["id"];
$conn = mysqli_connect($servername, $dbusername, $password, $dbname);
$streetdata = json_decode(file_get_contents("data.json"));
if (isset($_GET["street"])) {
    $street = $_GET["street"];
}
$streetname = $streetdata->Street->{$street}->streetname;
$streetprice = $streetdata->Street->{$street}->price;

// Get owned streets and money
$sql = "SELECT streets, money FROM players$server WHERE id='$id'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $money = $row["money"];
        $ownedstreets = json_decode($row["streets"]);
    }
}
if (in_array($street, $ownedstreets)) {
    $options[]=3;
    $options[]=4;
    $options[]=5;
} else {
    $alowned = FALSE;
    $x = 0;
    $sql = "SELECT id, streets, money FROM players$server";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $streets = json_decode($row["streets"]);
            $playerid = $row["id"];
            if (in_array($street, $streets)) {
                $alowned = TRUE;
            }
        }
    }
}
if (isset($alowned)) {
    if ($alowned) {
        $options[]=2;
        $options[]=3;
    } else {
        $options[]=1;
        $options[]=6;
    }
}
echo json_encode($options);
?>
<!DOCTYPE html>
<html lang="eng">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/teams/style.css">
    <title></title>
    <style>@import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;800&amp;display=swap');
        html, body {
            min-height: 100% !important;
            height: 100%;
            margin: 0;
            top: 0;
            background: rgb(40, 40, 40);
        }
        #card {
            position: fixed;
            border-radius: 6px;
            background: #fafafa;
            width: 94%;
            margin-left: 3%;
            background-color: black;
            color: white;
        }
        #streetname {
            color: white;
            text-align: center;
            margin: 0px;
            font-family: 'Montserrat', serif;
            font-size: 34px;
            letter-spacing: 3px;
            padding: 5% 5% 0 5%;
            font-weight: bold;
        }
        #streetprice {
            color: white;
            text-align: center;
            margin: 0px;
            font-family: 'Montserrat', serif;
            font-size: 20px;
            letter-spacing: 3px;
            font-weight: semi-bold;
        }
        #cparent {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }
        #cparent .card {
            width: 320px;
            color: white;
            margin: 5px;
            border-radius: 4px;
            border: solid rgb(163, 163, 163);
            background-color: rgb(119, 119, 119);
            font-family: 'Montserrat', serif;
            align-self: flex-start
        }
        .card summary {
            font-size: 20px;
            letter-spacing: 3px;
            text-align: center;
            padding: 12px;
        }
        .card .detailscontent {
            padding: 8px;
            border-top: solid 2px gray;
        }
        .btnparent {
            display:flex;
            justify-content: center;
        }
        .btnparent .button {
            border: none;
            background-color: white;
            border-radius: 4px;
            float: right;
            height: 34px;
            font-family: Helvetica, sans-serif;
            font-size: 14px;
            padding: 2px 10px;
            cursor: pointer;
            color: black;
            -webkit-appearance: none;
            min-width:34px;
            margin-top: 8px;
        }
        form {
            margin: 0;
        }
    </style>
</head>
<body>
<div>
    <div id="streetname"><?php echo $streetname?></div>
    <div id="streetprice"><?php echo $streetprice?>$</div>
    <div id="cparent">
        <?php
        if (in_array(1, $options)):
        ?>
        <details class="card">
            <summary><?php echo $ltrans[$lang][35]?></summary>
            <div class="detailscontent">
                <?php
                if ($lang == "en") {
                    echo $ltrans['en'][35]." ".$streetname." for <U>".$streetprice."$</U>." ;
                } else {
                    echo $streetname." für <U>".$streetprice."$</U> kaufen.";
                }
                ?>
                <div class="btnparent">
                    <form method="post" action="transaction.php?usage=buy">
                    <input style="display: none" type="text" name="street" value="<?php echo $street?>">
                        <input class="button" type="submit" value="<?php echo $ltrans[$lang][35]?>">
                    </form>
                </div>
            </div>
        </details>
        <?php
        endif;
        /* Pay Rent */
        if (in_array(2, $options)):
            // Get amount of houses
            $sql = "SELECT houses FROM streets$server WHERE id='$street'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    $houses = $row["houses"];
                }
            }
        ?>
        <details class="card">
            <summary><?php echo $ltrans[$lang][36]?></summary>
            <div class="detailscontent">
                <?php
                // Create the text inside the details
                if ($houses == 0) {
                    $rent = $streetdata->Street->{$street}->rent;
                    $renttext = $ltrans[$lang][41].$rent."$.";
                } elseif ($houses == 1) {
                    $rent = $streetdata->Street->{$street}->{$houses};
                    $renttext = $ltrans[$lang][42].$rent."$.";
                } elseif ($houses > 1 && $houses < 5) {
                    $rent = $streetdata->Street->{$street}->{$houses};
                    $renttext = $ltrans[$lang][43].$houses.$ltrans[$lang][44].$rent."$.";
                } elseif ($houses == 5) {
                    $rent = $streetdata->Street->{$street}->{$houses};
                    $renttext = $ltrans[$lang][45].$rent."$.";
                }
                echo $renttext;
                ?>
                <div class="btnparent">
                    <form method="post" action="transaction.php?usage=rent">
                        <input style="display: none" type="text" name="street" value="<?php echo $street?>">
                        <input class="button" type="submit" value="<?php echo $ltrans[$lang][46]?>">
                    </form>
                </div>
            </div>
        </details>
        <?php
        endif;
        if (in_array(3, $options)):
        ?>
        <details class="card">
            <summary><?php echo $ltrans[$lang][37]?></summary>
            <div class="detailscontent">HI ihr pisser</div>
        </details>
        <?php
        endif;
        if (in_array(4, $options)):
        ?>
        <details class="card">
            <summary><?php echo $ltrans[$lang][38]?></summary>
            <div class="detailscontent">HI ihr pisser</div>
        </details>
        <?php
        endif;
        if (in_array(5, $options)):
        ?>
        <details class="card">
            <summary><?php echo $ltrans[$lang][39]?></summary>
            <div class="detailscontent">HI ihr pisser</div>
        </details>
        <?php
        endif;
        if (in_array(6, $options)):
        ?>
        <details class="card">
            <summary><?php echo $ltrans[$lang][40]?></summary>
            <div class="detailscontent">HI ihr pisser</div>
        </details>
        <?php
        endif;
        ?>
    </div>
</div>
<script src="dropdown.js" type="text/javascript"></script>
</body>
</html>