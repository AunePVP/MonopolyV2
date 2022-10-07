<?php
if (isset($_GET['oid'])) {
    $ownerID = $_GET['oid'];
    setcookie("Server", $ownerID, time() + (3600 * 10), "/");
} elseif (isset($_COOKIE['Server'])) {
    $ownerID = $_COOKIE['Server'];
}
$data = json_decode(file_get_contents("src/data.json"));
$gameowner = $data->Owner->{$ownerID}->name;
$conn = new mysqli($servername, $dbusername, $password, $dbname);
$tbname = "players".$ownerID;
$sql = "SELECT id, name, money FROM $tbname";
$result = mysqli_query($conn, $sql);
$x = 0;
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        if ($row["name"]) {
            $pshow[$x]['id'] = $row["id"];
            $pshow[$x]['name'] = $row["name"];
            $pshow[$x]['money'] = $row["money"];
        }
        $x++;
    }
} else {
    echo "0 results";
}
mysqli_close($conn);
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
# Choose Player and set name form.
$nameErr = $player_nErr = "";
$name = $player_n = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        $nameErr = "Du musst deinen Namen eingeben.";
    } elseif($_POST["name"] == "0") {
        $nameErr = "Bitte verwende einen anderen Nutzernamen.";
    } else {
        $name = test_input($_POST["name"]);
    }
    if (empty($_POST["player"])) {
        $player_nErr = "Du musst einen Spieler aussuchen.";
    } else {
        $player_n = test_input($_POST["player"]);
    }
    $player_n = test_input($_POST["player"]);
    if (!empty($_POST["name"]) && !empty($_POST["player"])) {
        $conn = new mysqli($servername, $dbusername, $password, $dbname);
        $sql = "UPDATE $tbname SET name='$name' WHERE id=$player_n";
        if (!$conn->query($sql)) {
            echo "Error updating record: " . $conn->error;
        }
        $_SESSION['username'] = $name;
        $_SESSION["id"] = $player_n;
        //setcookie("username", $name, time() + (86400 * 30));
        //setcookie("id", $player_n, time() + (86400 * 30));
        echo '<meta http-equiv="refresh" content="0 URL='.htmlspecialchars($_SERVER["PHP_SELF"]).'">';
        $conn->close();
    }
}
?>
<style>
    section {
        display: flex;
        height: 100vh;
    }
    #setup {
        width: 410px;
        background-color: #2B2F43;
        margin: auto;
        border-radius: 6px;
        padding: 20px;
        color: white;
    }
    #setup table {
        width: 100%;
        border-collapse: collapse;
        margin: 15px 0;
    }
    #setup table th {
        border-style: solid;
        border-width: 0 0 2px 0;
    }
    #setup table td {
        text-align: center;
    }
    tr:nth-child(even) {
        background-color: rgb(60, 65, 85);
    }
    #setup #player {
        border-radius: 4px;
        width: 100%;
        padding: 5px 35px 5px 5px;
        font-size: 16px;
        height: 34px;
        border: none;
    }
    #setup #iusername {
        width: -webkit-fill-available;
        padding: 0 5px;
        border-radius: 4px;
        border: none;
        display: inline-block;
        font-size: 16px;
        height: 34px;
        font-family: Helvetica, sans-serif;
        outline: none;
    }
    #setup #player, #setup #iusername {
        width: -webkit-fill-available;
        margin: 0 0 10px;

    }
    #submit {
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
    }
</style>
<section>
    <div id="setup">
        <div id="headline"><span style="font-weight: 600;font-size: 33px;letter-spacing: 1px;">Monopoly<br></span><span>von <?php echo $gameowner ?></span></div>
        <table>
            <tr>
                <th><?php echo $ltrans[$lang][17]?></th>
                <th><?php echo $ltrans[$lang][18]?></th>
                <th><?php echo $ltrans[$lang][19]?></th>
            </tr>
            <?php
            foreach ($pshow as $show) {
                echo "<tr><td>".$show['id']."</td>";
                echo "<td style='border-style: solid;border-width: 0 1px;'>".$show['name']."</td>";
                echo "<td>$".$show['money']."</td></tr>";
            }
            ?>
        </table>
        <div id="form">
            <div>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])."?oid=".$ownerID;?>">
                    <label for="player" style="font-size: 20px;"><?php echo $ltrans[$lang][17]?>:</label><select required="required" name="player" id="player">
                        <option disabled selected value style="display:none"><?php echo $ltrans[$lang][20]?></option>
                        <option value="1"><?php echo $ltrans[$lang][17]?> 1</option>
                        <option value="2"><?php echo $ltrans[$lang][17]?> 2</option>
                        <option value="3"><?php echo $ltrans[$lang][17]?> 3</option>
                        <option value="4"><?php echo $ltrans[$lang][17]?> 4</option>
                        <option value="5"><?php echo $ltrans[$lang][17]?> 5</option>
                        <option value="6"><?php echo $ltrans[$lang][17]?> 6</option>
                        <option value="7"><?php echo $ltrans[$lang][17]?> 7</option>
                        <option value="8"><?php echo $ltrans[$lang][17]?> 8</option>
                    </select>
                    <label for="iusername" style="font-size: 20px;"><?php echo $ltrans[$lang][18]?>:</label><input type="text" name="name" id="iusername" placeholder="xxxxxx">
                    <div style="display:flex;justify-content: flex-end;">
                        <input type="submit" id="submit">
                    </div>
                </form>
            </div>
            <?php
            # Update data in database.
            ?>
        </div>
    </div>
</section>
