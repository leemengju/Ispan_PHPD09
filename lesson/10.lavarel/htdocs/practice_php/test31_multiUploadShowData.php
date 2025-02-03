<?php
    // 當 <input type="file" name="upload[]" multiple> 被使用時，$_FILES['upload'] 是一個多維陣列。
    $upload = $_FILES['upload'];


    // $value==0 代表上傳成功
//     使用 foreach 迭代 $upload['error'] 陣列。

// $key 是當前文件的索引（例如 0, 1, 2）。
// $value 是當前文件的錯誤碼（例如 0 表示無錯誤）。
// 如果 $value == 0：

// 代表該文件上傳成功，可以進行後續處理。
// 使用 move_uploaded_file() 將臨時文件移動到目標目錄：
    foreach ($upload['error'] as $key => $value) {
       if ($value==0) {
//         tmp_name[$key] 是當前文件的臨時路徑。
// name[$key] 是當前文件的原始名稱。
// "upload/{$upload['name'][$key]}" 是文件的目標存儲路徑（upload 目錄下）。
        move_uploaded_file($upload["tmp_name"][$key],"upload/{$upload['name'][$key]}");
        $count++;
       }
    }
    echo "upload success:{$count}files";
    


//     3. 完整程式的工作流程
// 獲取上傳的多個文件信息 ($_FILES['upload'])。
// 迭代每個文件的錯誤碼 (error)。
// 如果文件無錯誤 (error == 0)，將其從臨時目錄移動到指定目錄。
// 成功處理的文件數量記錄到 $count。
// 輸出成功上傳的文件數量。
?>