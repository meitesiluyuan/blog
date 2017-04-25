<?php

namespace App\Common\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{

    protected $table='regions';  //地区表

    protected $fillable=['pid,name,type'];
}
