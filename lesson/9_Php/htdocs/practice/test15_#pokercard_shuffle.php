<?php
// 洗牌
$poker = range(0, 51);
shuffle($poker);
foreach ($poker as $card) {
    echo "{$card}<br />";
}
echo "<hr/>";
?>


<?php

$players = [[], [], [], []];
foreach ($poker as $i => $card) {
    $players[$i % 4][(int)$i / 4] = $card;
}



?>



<table width='100%' border="1">

    <?php
    $Hues=["&spades;","&hearts;","&diamond;","&clubs"];
    $values=['A',1,2,3,4,5,6,7,8,9,10,"J","Q","K"];
    foreach ($players as $player) {
        echo "<tr>";
        foreach($player as $card){
            $Hue= $Hues[(int)($card/13)];
            $value= $values[$card%13];
            echo "<td> $Hue{$value}<td>";
        }
        echo "<tr>";
    }
    ?>
    <?php
    // // $Hues = ["&spades;", "<font color='red'>&hearts;</font>", "<font color='red'>&diamond;</font>", "&clubs;"];
    // // $values = ['A', 2, 3, 4, 5, 6, 7, 8, 9, 10, 'J', 'Q', 'K'];
    // // foreach ($players as $player) {
    // //     echo "<tr>";
    // //     foreach ($player as $card) {
    // //         $Hue = $Hues[(int)( $card/13)];
    // //         $value = $values[$card% 13];
    // //         echo "<td>$Hue{$value}<td>";
    // //     }
    // //     echo "<tr>";
    // }
    ?>
</table>