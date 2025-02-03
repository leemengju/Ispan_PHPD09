<?php
   
    $mysqli = new mysqli('localhost','root','', 'lance');
    $mysqli->set_charset('utf8');
  
    $sql = 'SELECT id,name,city FROM gift';
    $result=$mysqli->query($sql);

    while ($row=$result->fetch_object()) {
      echo"{$row->name}</br>";
    }

?>