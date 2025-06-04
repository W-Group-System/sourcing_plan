<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class CottPo extends Model
{
    use SoftDeletes;
    //
    public $timestamps = true;
    protected $connection = 'mysql';
    protected $table = 'cott_po';

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_name', 'id');
    }
    
    public function delete_requests() {
        return $this->hasOne(DeletionRequest::class, 'item_id', 'id')->where('type', 'Cott Po');
    }
}
