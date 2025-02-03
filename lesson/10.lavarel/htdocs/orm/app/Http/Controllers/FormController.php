<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Requests\MyFormRequest;

class FormController extends Controller
{
    public function do(Request $request)
    {     // return view('success');
        if ($request->hasFile("photo")) {
            $photo = $request->photo;
            // 這麼存才不會存在相同檔案覆蓋的問題。也不會存在特殊符號損毀後端。
            $photo->storeAs('documents',$photo->hashName());
            print( $photo->getClientOriginalName());
        
        }
        print("no file upload");
    }
}
