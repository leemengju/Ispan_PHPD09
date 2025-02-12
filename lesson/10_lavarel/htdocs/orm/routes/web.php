<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\MyModel;
use App\Models\House;
use App\Models\Phone;

// <---------------------------------------------{eloquent}---------------------------------------->

Route::get("/MyModel", function () {
    foreach (MyModel::where('uid', 'A01')->get() as $user) {
        print($user->cname . '<br>');
        $lives = $user->lives; //$lives 是用來存取與 $user 關聯的「居住地」資料的變數。這句話代表$user的lives資訊
        foreach ($lives as $house) { //在這段程式碼中，迴圈遍歷 $lives，每個 Live 實例用變數 $house 表示。
            print($house->address . '<br>'); //印出$house裡面的address資訊
        }
        $house = House::find(1);
        foreach ($house->own as $phone) {
            echo $phone->tel . "<br>";
        }
    }
});

// find 是用於查找主鍵（id）的記錄，不能用來指定其他欄位查詢。
Route::get("/live", function () {
    $user = MyModel::where('uid', 'A01')->first();
    $house = House::find(1);
    $user->live()->save($house); //這段程式碼試圖通過function_live()將 $house 與 $user 建立關聯並保存：
    print('ok');
});

Route::get("/bill", function () {
    $house = House::find(1);
    $sum = 0;
    foreach ($house->bills as $bill) {
        echo $bill->fee . "<br>";
        $sum += $bill->amount;
    }
});



//  <---------------------{eloquent_insert}-------------------------->
Route::get('/insert', function () {
    $user = new MyModel;
    $user->uid = 'A07';
    $user->cname = '陳小美';
    $user->save();
    print('ok');
});

//  <---------------------{eloquent_update}-------------------------->
Route::get('/update', function () {
    $user = MyModel::find('A07');
    $user->cname = '陳小姐';
    $user->save();
    print('ok');
});

//  <---------------------{eloquent_delete}-------------------------->
Route::get('/delete', function () {
    $user = MyModel::find('A07');
    $user->delete();
});

// <---------------------------------------------{QUERY BUILDER}---------------------------------------->
// <------------------------------將查詢的 SQL 指令包裝成 PHP 函數---------------------------------------->

Route::get('/', function () {
    $users = DB::table('userinfo')
        ->join('live', 'userinfo.uid', '=', 'live.uid')
        ->join('house', 'live.hid', '=', 'house.hid')
        ->where('userinfo.uid', 'A07')
        // ->orderBy(  'userinfo.uid','desc')
        ->get();
    // ->dd();//除錯專用
    // // ->dump()//除錯專用


    // 讓輸出的內容可以分段
    print('<pre>');
    print_r($users);
    print('</pre>');
});

Route::get('/hello/{name?}', function ($name = 'Laravel') {
    return 'Hello, ' . $name;
});
// <---------------------------------------------{查身分的運算式}---------------------------------------->
Route::view('/search', 'search', ['uid' => '',]);


Route::post('/search', function (Request $request) {
    $uid = $request->uid;
    $users = DB::select('select * from userinfo where uid=?', [$uid]);
    foreach ($users as $user) {
        print($user->cname . '<br>');
        print($user->password . '<br>');
        print($user->birthday . '<br>');;
    }
});

// <---------------------------------------------{表格}---------------------------------------->
Route::view('/form', 'form', ['uid' => '',]);
Route::post('/form', [FormController::class, 'do']);

// <---------------------------------------------{讀取照片}---------------------------------------->

Route::get('/photo', function () {
    // 定義檔案的相對路徑
    $filePath = 'documents/aQPOrBYvbmz0U0utWleBtdDgrpN6lM6KHqmYDj3z.jpg';

    // 檢查檔案是否存在
    if (!Storage::exists($filePath)) {
        return response()->json(['error' => 'File not found'], 404);
    }

    // 取得檔案的 MIME 類型
    $mimeType = Storage::mimeType($filePath);

    // 讀取檔案內容
    $data = Storage::get($filePath);

    // 返回檔案內容並設置適當的內容類型
    return response($data, 200)->header('Content-Type', $mimeType);
});