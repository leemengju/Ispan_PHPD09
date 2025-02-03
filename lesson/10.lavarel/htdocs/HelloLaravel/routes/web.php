<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


Route::get('/', function () {
   return view('welcome');
});
// <---------------------------------------------用url查詢canme---------------------------------------->

Route::get('/query/{uid}', function ($uid) {
$users= DB::select('select * from userinfo where uid=?',[$uid]);
Foreach ($users as $user) {
    print($user ->cname.'<br>');
}
});

Route::get('/query/{uid?}', function ($uid=1) {
$users= DB::select('select * from userinfo where uid=? or ?',[$uid,$uid]);
Foreach ($users as $user) {
    print($user ->cname.'<br>');
}
});


// <---------------------------------------------{a+b的運算式}---------------------------------------->

Route::get('/compute', function() {
    return view('compute')
        ->with('a', '')
        ->with('b', '');
});
Route::view('/compute', 'compute', ['a'=>'', 'b'=>'', 'result'=>'']);


Route::post('/compute', function(Request $request) {
   $a = $request->a;
   $b = $request->b;
   $result = $a + $b;


   return view('compute')
       ->with('a', $a)
       ->with('b', $b)
       ->with('result', $result);
});

// <---------------------------------------------{查身分的運算式}---------------------------------------->
Route::view('/search', 'search', ['uid'=>'',]);


Route::post('/search', function(Request $request) {
    $uid = $request->uid;
    $users= DB::select('select * from userinfo where uid=?',[$uid]);
    Foreach ($users as $user) {
        print($user ->cname.'<br>');
        print($user ->password.'<br>');
        print($user ->birthday.'<br>');
       ;
    }
    });
    