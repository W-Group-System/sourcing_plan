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

    public function delete_requests() {
        return $this->hasOne(DeletionRequest::class, 'item_id', 'id')->where('type', 'Cott');
    }
}
