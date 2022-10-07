<?php
$data = json_decode(file_get_contents("src/data.json"));
include_once 'src/language.php';
foreach ($data->Color->{$lang} as $cid => $color) {
    echo "<div class='colorparent' id='$cid'><details><summary style='background-color:$color->color'><span class='eyebrow'>Hamburg</span><span class='colorn'>$color->name</span></summary><div class='strparent'>";
    foreach ($data->Street as $value => $street) :
        if ($cid != $street->color) {
            continue;
        }
        $color = $data->Color->{$lang}->{$cid}->color;
        $name = $street->streetname;
        $price = $street->price;
        $mortage = $street->hypothek;
        if ($street->color != "9" && $street->color != "10") { // Check if normal street or utilitie
            $price = $street->price;
            $mortage = $street->hypothek;
            $house1 = $street->{1};
            $house2 = $street->{2};
            $house3 = $street->{3};
            $house4 = $street->{4};
            $hotel = $street->{5};
            $house = $street->housecost;
            $rent = $street->rent;
        } elseif($street->color == "10") {
            $rr[2] = $street->{2};
            $rr[3] = $street->{3};
            $rr[4] = $street->{4};
            $rent = $street->rent;
        }
        ?>
        <div class="street" id="<?php echo $value ?>">
            <details>
                <summary style='background-color:<?php echo $color?>'>
                    <span class='eyebrow'>Hamburg</span>
                    <span class='colorn'><?php echo $name ?></span>
                </summary>
                <?php if ($street->color != "9" && $street->color != "10"):?>
                    <div class="rent"><?php echo $ltrans[$lang][5];echo " $".$rent?></div>
                    <div class="houses">
                        <div><span><?php echo $ltrans[$lang][1]?></span><span class="right">$ <?php echo $house1?></span></div>
                        <div><span><?php echo $ltrans[$lang][2]?></span><span class="right"><?php echo $house2?></span></div>
                        <div><span><?php echo $ltrans[$lang][3]?></span><span class="right"><?php echo $house3?></span></div>
                        <div><span><?php echo $ltrans[$lang][4]?></span><span class="right"><?php echo $house4?></span></div>
                    </div>
                    <div class="hotel"><?php echo $ltrans[$lang][6]?> $<?php echo $hotel?></div>
                    <div class="mortage"><?php echo $ltrans[$lang][7]?> $<?php echo $mortage?></div>
                    <div class="house"><?php echo $ltrans[$lang][8]?> $<?php echo $house; echo $ltrans[$lang][9]?></div>
                    <div class="hotels"><?php echo $ltrans[$lang][10]?> $<?php echo $house; echo $ltrans[$lang][11]?></div>
                    <div class="dexpl"><?php echo $ltrans[$lang][12]?></div>
                <?php elseif ($street->color == "9"):?>
                    <div class="u4t">
                        <?php echo $ltrans[$lang][13]?>
                    </div>
                    <div class="mortage">
                        <?php echo $ltrans[$lang][7]?> $<?php echo $mortage?>
                    </div>
                <?php elseif ($street->color == "10"):?>
                    <div class="houses" style="width:95%">
                        <div style="margin: 10px 0"><span style="width: 63%"><?php echo $ltrans[$lang][14]?></span><span class="right" style="width: 37%">$ <?php echo $rent?></span></div>
                        <div style="margin-bottom: 2%"><span style="width: 63%"><?php echo $ltrans[$lang][15]." 2 ".$ltrans[$lang][16]?></span><span class="right" style="width: 37%">$ <?php echo $rr[2]?></span></div>
                        <div style="margin-bottom: 2%"><span style="width: 63%"><?php echo $ltrans[$lang][15]." 3 ".$ltrans[$lang][16]?></span><span class="right" style="width: 37%">$ <?php echo $rr[3]?></span></div>
                        <div style="margin-bottom: 2%"><span style="width: 63%"><?php echo $ltrans[$lang][15]." 4 ".$ltrans[$lang][16]?></span><span class="right" style="width: 37%">$ <?php echo $rr[4]?></span></div>
                    </div>
                    <div class="mortage">
                        <?php echo $ltrans[$lang][7]?> $<?php echo $mortage?>
                    </div>
                <?php endif;?>
            </details>
        </div>
    <?php
    endforeach;
    echo "</div></details></div>";
}
?>