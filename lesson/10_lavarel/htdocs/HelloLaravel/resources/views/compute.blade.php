<div>
    <form method="post">
        <!-- 防止前端跨域攻擊 -->
        @csrf
        
        <input name="a" value="{{$a}}">
        <p>
            <input name="b" value="{{$b}}">
        <p>
            <button>加法</button>

    </form>
    <hr>
    <!-- <---------------------------php的語法----------------------------->
    <?php
    
    // if (isset($result)) {
    //     print($result);
    // }
    ?>
    <!-- <---------------------------laravel的語法----------------------------->
    <!-- 如果$result存在，在印出$result，不然就是空白 -->
    {{isset ($result)?$result:""}}
</div>