<?php

namespace Pmis\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Vdc extends Model
{
    protected $table = 'vdc';
    protected $fillable = ['name','code'];

    public $timestamps = false;

    public function district()
    {
        return $this->belongsTo('Pmis\Eloquent\District');
    }

}
