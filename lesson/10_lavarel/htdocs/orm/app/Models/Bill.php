<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Bill extends Model
{
    // $table 和  $primaryKey 的變數名稱不可以動。
    // 只能單一欄位主索引。
    // 複合索引就不下了。
    protected $table = "Bill";
    // protected $primaryKey = "hid";
    // protected $keyType = "int";

    public $timestamps = false;
}
