<!-- 10.0.100.160 -->
<?php

    $upload = $_FILES['upload'];
    //var_dump($upload);
    foreach($upload as $k => $v){
        echo "{$k} : {$v}<br />";
    }

    if ($upload['error'] == 0){
        move_uploaded_file($upload['tmp_name'], "upload/{$upload['name']}");
    }else{
        echo 'Upload Failure';
    }


?>