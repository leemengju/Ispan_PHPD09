<?php
    // 表格的來源
    $url = 'https://data.moa.gov.tw/Service/OpenData/ODwsv/ODwsvAgriculturalProduce.aspx';
    //從連結接收json格式
    $json = file_get_contents($url);
    // 將json轉為陣列
    $datas = json_decode($json);
   
// 環境部屬
    $mysqli = new mysqli('localhost','root','', 'lance');
    $mysqli->set_charset('utf8');

    $mysqli->query('DELETE FROM gift');
    $mysqli->query('ALTER TABLE gift AUTO_INCREMENT = 1');

    foreach($datas as $row){
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
    echo 'OK';
    


?>