-- <---------------------------------------績效排行榜--------------------------------------------?

    SELECT employees.LastName,
    employees.EmployeeID,
    SUM(orderdetails.UnitPrice * orderdetails.Quantity) AS Total
    from orders
    left outer join orderdetails on orders.OrderID=orderdetails.OrderID
    left outer join employees on orders.EmployeeID=employees.EmployeeID
    GROUP BY employees.EmployeeID
    Order by total desc
    -- <---------------------------------------驗證績效--------------------------------------------?
    select SUM(orderdetails.UnitPrice * orderdetails.Quantity) AS Total
    from orderdetails
    where OrderID in(
    select OrderID from orders
    where EmployeeID=4

    )

    -- <--------------------------------ShippedDate> RequiredDate逾時訂單查詢---------------------------------------------------?
    SELECT
    orders.OrderID,
    orders.EmployeeID,
    orders.CustomerID,
    o.ShippedDate,
    o.RequiredDate
    FROM
    orders o
    WHERE
    ShippedDate > RequiredDate;

    <?php
    // <----------------------------------------------綁定時間--------------------------------------------->
    $start = '1996-01-01';
    $end = '2000-12-31';
    if (isset($_GET['start'])) {
        $start = $_GET['start'];
        $end = $_GET['end'];
    }

    // <----------------------------------------------將SQL轉成php碼--------------------------------------------->
    //    1.環境建置
    $mysqli = new mysqli('localhost', 'root', '', 'lance');
    $mysqli->set_charset('utf8');
    //    2.sql指令
    $sql = 'SELECT employees.LastName, 
    employees.EmployeeID, 
    SUM(orderdetails.UnitPrice * orderdetails.Quantity) AS Total
from orders 
 left outer join orderdetails on orders.OrderID= orderdetails.OrderID
 left outer join employees on orders.EmployeeID = employees.EmployeeID

group by employees.EmployeeID 
order by total desc';
    // 3.通過prepare方式和$mysqli 溝通對象，將$sql的內容儲存到變數$stmt。
    $stmt = $mysqli->prepare($sql);
    // 4.因為沒有參數，所以不需要綁定參數。
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $lastname, $total);
    ?>
    <form>
        Start: <input type="date" name="start" value='<?= $start ?>' /> ~
        End: <input type="date" name="end" value='<?= $end ?>' />
        <input type="submit" value="Change" />
    </form>
    <table width='100%' border="1">
        <tr>
            <th>#</th>
            <th>ID</th>
            <th>Name</th>
            <th>Total</th>
        </tr>
        <?php
        $rank = 1;
        while ($stmt->fetch()) {
            echo '<tr>';
            echo "<td>{$rank}</td>";
            echo "<td>{$id}</td>";
            echo "<td>{$lastname}</td>";
            echo "<td>{$total}</td>";
            echo '</tr>';
            $rank++;
        }
        ?>
    </table>