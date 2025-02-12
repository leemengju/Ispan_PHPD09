<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany; 
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class House extends Model
{
    // $table 和  $primaryKey 的變數名稱不可以動。
    // 只能單一欄位主索引。
    protected $table = "House";
    protected $primaryKey = "hid";
    protected $keyType = "int";

    public $timestamps = false;
    public function own(): HasMany {
        return $this->hasMany(
            Phone::class, 
            'hid', // Phone.hid
            'hid'  // House.hid
        );
    }
    public function bills(): HasManyThrough { //三個資料表時彼此之間有關連性
        return $this->hasManyThrough(
            Bill::class, 
            Phone::class, 
            'hid', // Phone.hid
            'tel',  // Bill.tel
            'hid', // House.hid
            'tel',  // phone.tel
        );
        // 從house 查到phone，再查到 bill
    }
}
