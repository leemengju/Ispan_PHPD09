<?php
$start = 2;
$rows = 2;
$cols = 4;

// Check and update values from GET parameters if available
if (isset($_GET["start"], $_GET['rows'], $_GET['cols'])) {
    $start = (int)($_GET["start"]);
    $rows = (int)($_GET["rows"]);
    $cols = (int)($_GET["cols"]);
}

// Define constants for rows, start, and columns
define("start", $start);
define("rows", $rows);
define("cols", $cols);
?>


<title>Dynamic Multiplication Table</title>
<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        border: 1px solid black;
        text-align: center;
        padding: 5px;
    }
</style>

<h1>Brad Company</h1>
<hr />
<form action="" method="get">
    <label for="">start:</label>
    <input type="text" name="start" value="<?php echo $start ?>">
    <label for="">rows:</label>
    <input type="text" name="rows" value="<?php echo $rows ?>">
    <label for="">cols:</label>
    <input type="text" name="cols" value="<?php echo $cols ?>">
    <button type='submit'>generate</button>
</form>

<table>
    <?php
    for ($k = 0; $k < rows; $k++) {
        echo "<tr>";
        for ($j = start; $j < start + cols; $j++) {
            $newj = $j + $k * cols;
            echo "<td>";
            for ($i = 1; $i < 9; $i++) {
                $r = $newj * $i;
                echo "{$newj} &times; {$i} ={$r}<br>";
            }
            echo "</td>";
        }
        echo "</tr>";
    }
    ?>
</table>
</body>

</html>