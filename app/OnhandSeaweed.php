<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OnhandSeaweed extends Model
{
    public function plants() {
        return $this->belongsTo(Plant::class, 'plant_id', 'id');
    }

}
