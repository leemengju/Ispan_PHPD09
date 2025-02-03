<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class MyModel extends Model
{
    // $table 和  $primaryKey 的變數名稱不可以動。
    // 只能單一欄位主索引。
    protected $table = "UserInfo";
    protected $primaryKey = "uid";
    protected $keyType = "string"; //就是varchar型態

    public $timestamps = false;

    function lives(): BelongsToMany //多對多關係，在 Laravel 中，模型之間的關聯可以是 hasOne、hasMany、belongsTo、belongsToMany 等
    {
        return $this->belongsToMany(
            House::class,
            "live",
            "uid", //live.uid
            "hid" //Live.hid
        );
    }
}
