<?php

use Illuminate\Database\Eloquent\Model;

class Weight extends Model
{
    protected $table = 'yuxiu_weight';

    public $timestamps = false;
    

    public static function getAnchorRoomWeight()
    {
        return self::all();
    }

}
