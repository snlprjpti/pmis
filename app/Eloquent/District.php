<?php

namespace Pmis\Eloquent;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $fillable = ['name','zone_id','headquarter','map_path'];

    public $timestamps = false;

    public function zone()
    {
        return $this->belongsTo('Pmis\Eloquent\Zone');
    }

    public function informations()
    {
        return $this->hasMany('Pmis\Eloquent\DistrictInformation');
    }

    public function vdc()
    {
        return $this->hasMany('Pmis\Eloquent\Vdc');
    }
}
