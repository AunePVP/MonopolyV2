<main>
    <style>
        body {
            background-color: #171a25;
            scroll-behavior: smooth;
        }
        main {
            display: block;
            width:100%!important;
        }
        .main {
            min-height: 110px;
            background-color: rgb(23,26,37);
            clip-path: polygon(0 0, 100% 100px, 100% 100%, 0% 100%);
            z-index: 1;
            width: 100%;
            position: absolute;


        }
        .main #content {
            width: 80%;
            min-height: 250px;
            margin: 0 auto;
            font-family: 'Open Sans', sans-serif;
            padding: 125px 0 15px;
            color: white;
        }

        #background {
            background-repeat: no-repeat;
            background-image: url("/src/img/Monopoly-background.jpg");
            min-height: calc(100vh + 100px);
            background-size: cover;
            background-position: top;
            position: relative;
            z-index: 0;
        }
        #container .button {
            display: block;
            text-align: center;
            font-size: 20px;
            font-family: 'Open Sans', sans-serif;
            color:#fff;
            border-radius: 14px;
            background: rgba(86, 86, 86, 0.65);
            text-decoration: none;
            border: none;
            width: 180px;
            padding: 20px 0;
            margin: auto;
            height: fit-content;
        }
        .content .cut {
            background-color: rgb(40, 44, 57);
            box-sizing: border-box;
            padding: 0 30px;

        }
        @media only screen and (min-width: 800px) {
            .main {
                top: 100vh
            }
            #container {
                display:flex;
                height: 100vh;
            }
            #projects .content {
                display: flex;
                flex-wrap: wrap;
            }
            .content .cut {
                width: 49%;
                margin: 0.5% auto;
            }


        }
        @media only screen and (max-width: 550px) {
            .main #content {
                width: 90%;
            }
        }
        @media (pointer: fine) {
            #background {
                background-attachment: fixed;
            }
        }
        @media only screen and (max-width: 800px) {
            .main {
                top: 60vh
            }
            #background {
                background-position: center -100px;;
            }
            #container {
                padding: 30% 0;
            }
            #container .button {
                margin: 15px auto;
            }
        }
    </style>
    <div id="background">
        <div id="container">
            <a href="#status" class="button"><?php echo $ltrans[$lang][32];?></a>
            <a href="#projects" class="button"><?php echo $ltrans[$lang][33];?></a>
            <a href="https://github.com/AunePVP" target="_blank" rel="noopener noreferrer" class="button"><?php echo $ltrans[$lang][34]?></a>
        </div>
    </div>
    <div class="main">
        <div id="content">
            <?php #include 'content/lorem-ipsum.html'?>
            <div id="projects" class="<?php echo $projekte ?>">
                <h2 class="headline"><?php echo $lang3;?></h2>
                <div class="content">
                    <div class="cut fade <?php echo $sitemonopoly?>">
                        <h3 class="headline" style="width:100%;">Monopoly</h3>
                        <p><?php echo $lang4;?><br>
                            <a class="white" style="text-align: center;" href="monopoly/overview.php"><?php echo $lang10;?></a>
                        </p>
                    </div>
                    <div class="cut fade <?php echo $sitepassword?>">
                        <h3 class="headline" style="width:100%;"><?php echo $lang5;?></h3>
                        <p><?php echo $lang6;?><br>
                            <a style="text-align: center;" href="passwort"><?php echo $lang11;?></a>
                        </p>
                    </div>
                    <div class="cut fade <?php echo $siteserverblock?>">
                        <h3 class="headline" style="width:100%;">Server Block</h3>
                        <p><?php echo $lang7;?>
                            <a style="text-align: center;" href="virtual-host"><?php echo $lang12;?></a>
                        </p>
                    </div>
                    <div class="cut fade <?php echo $sitegsq?>">
                        <h3 class="headline" style="width:100%;">Game Server Query</h3>
                        <p>Mit dieser Website können Daten von verschiedenen Game Servern ausgelesen werden. Dazu zählen Art des Spiels, Spieleranzahl, Map usw. Die Website wird stetig von mir weiter entwickelt.<br>
                            <a style="text-align: center;" href="/"><?php echo $lang10;?></a>
                        </p>
                    </div>
                    <div class="cut fade <?php echo $sitescp?>">
                        <h3 class="headline" style="width:100%;">SCP Command Generator</h3>
                        <p>SCP ist das klassische Tool, um unter Linux und POSIX-kompatiblen Betriebssystemen Dateien zwischen Maschinen verschlüsselt zu kopieren.<br>
                            <a style="text-align: center;" href="/">Erstelle jetz einen Befehl</a>
                        </p>
                    </div>
                    <div class="cut fade <?php echo $siteapi?>">
                        <h3 class="headline" style="width:100%;">API Abfragen</h3>
                        <p>Durch die Simple gestaltung, der Seite lassen sich sehr einfach verschiedene API's ohne techniche Vorerfahrung abfragen.<br>
                            <a style="text-align: center;" href="monopoly">Jetzt abfragen</a>
                        </p>
                    </div>
                    <div class="cut fade <?php echo $sitesteamuser?>">
                        <h3 class="headline" style="width:100%;">Steam User Query</h3>
                        <p><?php echo $lang8;?><br>
                            <a style="text-align: center;" href="playerinfo"><?php echo $lang10;?></a>
                        </p>
                    </div>
                    <div class="cut fade <?php echo $sitepermissioncalc?>">
                        <h3 class="headline" style="width:100%;">Chmod Permission Calculator</h3>
                        <p><?php echo $lang9;?><br>
                            <a style="text-align: center;" href="permission-calc"><?php echo $lang10;?></a>
                        </p>
                    </div>
                    <div class="cut fade <?php echo $siteqr?>">
                        <h3 class="headline" style="width:100%;">QR Transfer</h3>
                        <p><?php echo $lang39;?><br>
                            <a style="text-align: center;" href="qr"><?php echo $lang10;?></a>
                        </p>
                    </div>
                </div>
            </div>
            <div id="status" class="<?php echo $systemstatuspage?>">
                <a href="https://statuspage.muehlhaeusler.online" target="_blank" style="color: white;text-decoration: none;"><h2 class="headline">Server Status</h2></a>
                <div class="content">
                    <?php
                    //readfile($url."/index.php")
                    include($url."/index.php")
                    ?>
                    <div class="statusdiv"><a class="statusbutton white-hover" href="https://statuspage.muehlhaeusler.online" target="_blank"><?php echo $lang38;?></a></div>
                </div>
            </div>
        </div>
    </div>
</main>