<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cott extends Model
{
    //
    public $timestamps = true;
    protected $connection = 'mysql';
    protected $table = 'cotts';
}
