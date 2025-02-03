<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Phone extends Model
{
    // $table 和  $primaryKey 的變數名稱不可以動。
    // 只能單一欄位主索引。
    protected $table = "Phone";
    protected $primaryKey = "hid";
    protected $keyType = "int";

    public $timestamps = false;
}
