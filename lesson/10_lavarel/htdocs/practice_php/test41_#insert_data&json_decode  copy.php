<?php
// 表格的來源
$url = 'https://data.moa.gov.tw/Service/OpenData/ODwsv/ODwsvAgriculturalProduce.aspx';
//從連結接收json格式
$json=file_get_contents($url);
$json=json_decode($json,true);

$mysqli=new mysqli($dbhost,$dbuser,$dbpass,$dbname);
$mysqli ->set_charset('UTF8');

foreach ($datas as $row) {
    $name = $row->Name;
        $feature = $row->Feature;
        $addr = $row->SalePlace;
        $city = $row->County;
        $town = $row->Township;
        $pic = $row->Column1;
        $sql = 'INSERT INTO gift (name,feature,addr,city,town,pic) ' . 
                "VALUES ('$name','$feature','$addr','$city','$town','$pic')";
        $mysqli->query($sql);
}
echo"ok";