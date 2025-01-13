<?php
$start = 2;
$rows = 2;
$cols = 4;

// Check and update values from GET parameters if available
if (isset($_GET['start'], $_GET['rows'], $_GET['cols'])) {
    $start = (int)$_GET['start'];
    $rows = (int)$_GET['rows'];
    $cols = (int)$_GET['cols'];
}

// Define constants for rows, start, and columns
define("ROWS", $rows);
define("START", $start);
define("COLS", $cols);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Multiplication Table</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            text-align: center;
            padding: 5px;
        }
    </style>
</head>
<body>
    <h1>Brad Company</h1>
    <hr />

    <form action="" method="get">
        <label for="start">Start:</label>
        <input type="number" id="start" name="start" value="<?= htmlspecialchars($start) ?>" required />

        <label for="rows">Rows:</label>
        <input type="number" id="rows" name="rows" value="<?= htmlspecialchars($rows) ?>" required />

        <label for="cols">Columns:</label>
        <input type="number" id="cols" name="cols" value="<?= htmlspecialchars($cols) ?>" required />

        <button type="submit">Generate</button>
    </form>

    <table>
        <?php
        // 每次進入這個迴圈時，會新增一個 HTML 表格列 <tr>。
        for ($k = 0; $k < ROWS; $k++) {
            echo '<tr>';
            // 控制表格中有多少個 <td> 單元格
            for ($j = START; $j < START + COLS; $j++) {
                // 新的J值為原本的J值，加上rows數乘上cols數。下一個欄位的開始3=2+1*1
                $newj = $j + $k * COLS;
                echo '<td>';
                // 單元格的內容物
                for ($i = 1; $i <= 9; $i++) {
                    $r = $newj * $i;
                    echo "{$newj} &times; {$i} = {$r}<br>";
                }
                echo '</td>';
            }
            echo '</tr>';
        }
        ?>
    </table>
</body>
</html>