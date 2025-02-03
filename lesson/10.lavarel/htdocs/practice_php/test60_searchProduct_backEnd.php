

<?php



if (!isset($_REQUEST['orderID'])) {
    $respond = ['error' => 1];
} else {
    $orderId = $_REQUEST['orderID'];
    $mysqli = new mysqli('localhost', 'root', '', 'lance');
    $mysqli->set_charset('utf8');
    $sql = "SELECT o.CustomerID, c.CompanyName, o.EmployeeID, e.LastName, o.OrderDate, p.ProductName, od.UnitPrice, od.Quantity, (od.UnitPrice * od.Quantity) sum
                FROM orderdetails od
                JOIN orders o ON (o.OrderID = od.OrderID)
                JOIN products p ON (p.ProductID = od.ProductID)
                JOIN employees e ON (e.EmployeeID = o.EmployeeID)
                JOIN customers c ON (o.CustomerID = c.CustomerID)
                WHERE od.OrderID = ? ";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $orderId);
    if (!$stmt->execute()) {
        $respond = ['error' => 2];
    } else {
        $stmt->store_result();
        if ($stmt->num_rows() == 0) {
            $respond = ['error' => 3];
        } else {
            $respond = ['error' => 0];
            $stmt->bind_result($cid,$cname,$eid,$ename,$date,$pname,$price,$qty,$sum);
            while ($stmt->fetch()) {
                $respond['cid'] = $cid;
                $respond['cname'] = $cname;
                $respond['eid'] = $eid;
                $respond['ename'] = $ename;
                $respond['date'] = substr($date,0 ,10) ;
                $respond['detail'][] = [
                    'pname' => $pname,
                    'price' => $price,
                    'qty' => $qty,
                    'sum' => $sum,
                ];
            }
        }
    }
}


header('Content-type: application/json');
echo json_encode($respond, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);



?>