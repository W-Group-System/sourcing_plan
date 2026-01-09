<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeletionRequest extends Model
{
    protected $connection = 'mysql';
    protected $table = 'deletion_requests';

    public function cotts() {
        return $this->belongsTo(Cott::class, 'item_id', 'id')->withTrashed();
    }

    public function spis() {
        return $this->belongsTo(Spi::class, 'item_id', 'id')->withTrashed();
    }

    public function po_spis() {
        return $this->belongsTo(SpiPo::class, 'item_id', 'id')->withTrashed();
    }
    public function po_cotts() {
        return $this->belongsTo(CottPo::class, 'item_id', 'id')->withTrashed();
    }
    public function requestor() {
        return $this->belongsTo(User::class, 'requestor_id', 'id');
    }
    public function approvedBy() {
        return $this->belongsTo(User::class, 'approved_by_id', 'id');
    }

}
