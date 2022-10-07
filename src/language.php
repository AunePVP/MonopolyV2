<?php
if (isset($_COOKIE['language'])) {
    $lang = $_COOKIE['language'];
} elseif (!empty($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
    $lang = (substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2));
    if ($lang == "de") {
        $lang = "de";
    } else {
        $lang = "de";
    }
} else {
    $lang = "en";
}
$ltrans['de'][1] = "Mit 1 Haus";
$ltrans['de'][2] = "Mit 2 Häusern";
$ltrans['de'][3] = "Mit 3 Häusern";
$ltrans['de'][4] = "Mit 4 Häusern";
$ltrans['de'][5] = "MIETE";
$ltrans['de'][6] = "Mit Hotel";
$ltrans['de'][7] = "Hypothekenwert";
$ltrans['de'][8] = "1 Haus kostet";
$ltrans['de'][9] = "";
$ltrans['de'][10] = "1 Hotel kostet ";
$ltrans['de'][11] = " plus 4 Häuser";
$ltrans['de'][12] = "Wenn ein Spieler ALLE Straßen einer Farbgruppe<br/>besitzt, ist die Miete for die UNBEBAUTEN<br>STRAßEN dieser Farbgruppe DOPPELT so hoch.";
$ltrans['de'][13] = "<br>Wenn man ein Versorgungswerk<br>besitzt, ist die Miete 4-mal so hoch<br>wie der Würfelwurf Augen hat.<br><br>Wenn man beide Versorgungswerke<br>besitzt, ist die Miete 10-mal so hoch<br>wie der Würfelwurf Augen hat.<br><br>";
$ltrans['de'][14] = "Miete";
$ltrans['de'][15] = "Wenn man";
$ltrans['de'][16] = "Verkehrsmittel besitzt";
$ltrans['de'][17] = "Spieler";
$ltrans['de'][18] = "Name";
$ltrans['de'][19] = "Geld";
$ltrans['de'][20] = "Wähle einen Spieler.";
$ltrans['de'][21] = "Registrieren";
$ltrans['de'][22] = "Benutzername";
$ltrans['de'][23] = "Passwort";
$ltrans['de'][24] = "Anzeigename";
$ltrans['de'][25] = "Registrieren";
$ltrans['de'][26] = "Anmelden";
$ltrans['de'][27] = "Bitte füll jede Zeile aus.";
$ltrans['de'][28] = "Der Benutzername benötigt mindestens 4 Zeichen.<br>";
$ltrans['de'][29] = "Es sind nur Buchstaben, Zahlen und ".'"ä ö ü ß _"'." erlaubt.<br>" ;
$ltrans['de'][30] = "Das Passwort stimmt nicht überein.";
$ltrans['de'][31] = "Please use at least 8 characters for your password.";
$ltrans['de'][32] = "Spielbrett";
$ltrans['de'][33] = "Mehr Informationen";
$ltrans['de'][34] = "Spielen";
$ltrans['de'][35] = "Kaufen";
$ltrans['de'][36] = "Miete Zahlen";
$ltrans['de'][37] = "Handeln";
$ltrans['de'][38] = "Häuser und Hotels";
$ltrans['de'][39] = "Hypothek";
$ltrans['de'][40] = "Auktion";
$ltrans['de'][41] = "Die Miete beträgt ";
$ltrans['de'][42] = "Die Miete mit einem Haus beträgt ";
$ltrans['de'][43] = "Die Miete mit ";
$ltrans['de'][44] = " Häusern beträgt ";
$ltrans['de'][45] = "Die Miete mit einem Hotel beträgt ";
$ltrans['de'][46] = "Bezahlen";
$ltrans['de'][47] = "Zurücksetzen";
$ltrans['de'][48] = "Spiel zurücksetzen";
$ltrans['en'][1] = "With 1 House";
$ltrans['en'][2] = "With 2 Houses";
$ltrans['en'][3] = "With 3 Houses";
$ltrans['en'][4] = "With 4 Houses";
$ltrans['en'][5] = "RENT";
$ltrans['en'][6] = "With Hotel";
$ltrans['en'][7] = "Mortage Value";
$ltrans['en'][8] = "Houses Cost";
$ltrans['en'][9] = " each";
$ltrans['en'][10] = "Hotels, ";
$ltrans['en'][11] = " plus 4 houses";
$ltrans['en'][12] = "If a player owns ALL the Lots of any Color-Group, the<br/>rent is Doubled on Unimproved Lots in that group.";
$ltrans['en'][13] = "<br>If one Utility is owned,<br>rent is 4 times amount<br>shown on dice.<br><br>If both Utilities are owned,<br>rent is 10 times amount<br>shown on dice.<br><br>";
$ltrans['en'][14] = "Rent";
$ltrans['en'][15] = "If";
$ltrans['en'][16] = "railroads are owned";
$ltrans['en'][17] = "Player";
$ltrans['en'][18] = "Name";
$ltrans['en'][19] = "Money";
$ltrans['en'][20] = "Choose a player.";
$ltrans['en'][21] = "Register";
$ltrans['en'][22] = "Username";
$ltrans['en'][23] = "Password";
$ltrans['en'][24] = "Display Name";
$ltrans['en'][25] = "Register";
$ltrans['en'][26] = "Log in";
$ltrans['en'][27] = "Please fill out every line.<br>";
$ltrans['en'][28] = "Please use at least 4 characters for your username.<br>";
$ltrans['en'][29] = "Special characters are not allowed in user names.<br>";
$ltrans['en'][30] = "Those passwords didn't match. Try again.";
$ltrans['en'][31] = "Please use at least 8 characters for your password.";
$ltrans['en'][32] = "Game-Board";
$ltrans['en'][33] = "More";
$ltrans['en'][34] = "Play";
$ltrans['en'][35] = "Buy";
$ltrans['en'][36] = "Pay Rent";
$ltrans['en'][37] = "Trade";
$ltrans['en'][38] = "Houses and Hotels";
$ltrans['en'][39] = "Mortage";
$ltrans['en'][40] = "Auction";
$ltrans['en'][41] = "The rent is ";
$ltrans['en'][42] = "The rent with one house is ";
$ltrans['en'][43] = "The rent with ";
$ltrans['en'][44] = " houses is ";
$ltrans['en'][45] = "The rent with a hotel is ";
$ltrans['en'][46] = "Pay";
$ltrans['en'][47] = "Reset";
$ltrans['en'][48] = "Reset Game";



