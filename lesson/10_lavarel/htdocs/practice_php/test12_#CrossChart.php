<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    
        <?php
$start=2;
$rows=2;
$cols=4;
if(isset($_GET['start'])){
    $start=$_GET['start'];
    $Rows=$_GET['rows'];
    $Cols=$_GET['cols'];

}

        define("ROWS", $Rows);
        define("STSRT", $start);
        define("COLS", $Cols);
        ?>
        <h1>Brad Company</h1>
        <hr />
        <form action="test12_cossChart.php">

            Start: <input type="number" name="start" />
            Rows: <input type="number" name="rows" />
            Columns: <input type="number" name="cols" />
            <input type="submit" value="Change" />

        </form>
        <table width='100%' border="1">

            <?php
            // 兩列
            for ($k = 0; $k < 2; $k++) {
                echo '</tr>';

                for ($j = STSRT; $j < STSRT + COLS; $j++) {
                    $newj = $j + $k * COLS;
                    echo '<td>';
                    for ($i = 1; $i < 10; $i++) {
                        $r = $newj * $i;
                        echo "{$newj} x {$i}={$r}<br/>";
                    }
                    echo '</td>';
                }
                echo '</tr>';
            }
            ?>



        </table>




        <p id="pTimes"></p>
        <script>
            var temp4 = '';
            for (var i = 2; i <= 9; i++) {
                for (var j = 2; j <= 9; j++) {
                    temp4 += `${i}+${j}=${i * j}&#9;`
                }
                temp4 += `<br>`;
                document.getElementById('pTimes').innerHTML = temp4;
            }
        </script>


</body>

</html>