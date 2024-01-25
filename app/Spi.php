<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Spi extends Model
{
    use SoftDeletes;
    //
    protected $connection = 'mysql';
    protected $table = 'spis';
}
