<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class detail extends Model
{
    //
    public $timestamps = false;

    public function place(){
        return $this->belongsTo(place::class);
    }
    /**
     * The table associated with the model.
     *
     * @var string
     */

    public $table = 'details';
}
