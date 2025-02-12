<!-- <-----------------------------------API會將傳輸內容轉為字串------------------------------------------- -->
<!-- public 後面加上api -->
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Models\MyModel;
use App\Models\House;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get("/MyModel", function () {
    $users = MyModel::all();
    $json = $users->toJson(JSON_UNESCAPED_UNICODE);

    return response($json)
        ->header('content-Type', 'application/json')
        ->header('charset', 'utf-8');
});

// <-----------------------------------修改密碼--------------------------------->
// <-----------------------------------使用local端walkman來檢測是否成功--------------------------------->
Route::post('/update', function (Request $request) {
    $uid = $request->uid;
    $old = $request->old;
    $new = $request->new;
    $user = MyModel::find($uid);
    if (isset($user)) {
        if ($old == $user->password) {
            $user->password = $new;
            $user->save();
            return response(
                '{Ok:1}'
            )->header('content-Type', 'application/json');
        }
    }
    return response(
        '{Ok:0}'
    )->header('content-Type', 'application/json');
});
// <-----------------------------------測試登入--------------------------------->
//用hash哈希密碼比較安全
// 需要先檢查用戶，再檢查密碼
Route::post('/login', function (Request $request) {
    $uid  = $request->uid;
    $old  = $request->old;
    $user = MyModel::find($uid);
    if (!isset($user)) {
        return response()->json(['error' => 'User not found'], 404);
    }
        if (Hash::check($old, $user->password)) {
            return response()->json(['message' => 'success'], 200);
        } else {

            return response()->json(['error' => 'invalid password'], 401);
        }
    
});


