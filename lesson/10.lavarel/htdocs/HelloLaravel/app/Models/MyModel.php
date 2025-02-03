<!-- <---------------------------model是
 作運算的------------------> 
<?php
namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class MyModel extends Model
{
    function add($a,$b){
        return $a + $b;
    }
}

