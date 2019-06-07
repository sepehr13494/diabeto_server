<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class place extends Model
{
    //
    public $timestamps = false;

    public function detail(){
        return $this->hasOne(detail::class);
    }

    public $table = 'places';
}
