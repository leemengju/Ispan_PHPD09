<!-- 2. $hashPasswd = password_hash($passwd, PASSWORD_DEFAULT);
目的：

使用 PHP 提供的 password_hash 函數對密碼進行哈希處理。
password_hash 函數：

用於生成安全的密碼哈希，適合儲存在資料庫中。
哈希是一種單向加密，無法反向還原為原始密碼。
它會使用一種安全的演算法（如 bcrypt）來生成加密後的字串。
<?php 
    $passwd = '123456';
    $hashPasswd = password_hash($passwd, PASSWORD_DEFAULT);
    echo $hashPasswd;



    if (password_verify(('123456'),$hashPasswd))
    {
        echo 'ok';
    }else{
        
        echo 'xx';
    }
?>