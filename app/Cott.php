<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cott extends Model
{
    use SoftDeletes;
    //
    public $timestamps = true;
    protected $connection = 'mysql';
    protected $table = 'cotts';
}
