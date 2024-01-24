<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Upload extends Model
{
    //
    use SoftDeletes;
    
    protected $connection = 'mysql';
    protected $table = 'signeds';
}
