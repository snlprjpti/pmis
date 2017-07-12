<?php

namespace Pmis\Eloquent;

use Illuminate\Database\Eloquent\Model;

class DistrictInformation extends Model
{
    protected $fillable = ['parent_id','district_id','title','content','display_order','status'];

    public $timestamps = false;

    public function district()
    {
        return $this->belongsTo('Pmis\Eloquent\District');
    }
    public function subpages() {
        return $this->hasMany('Pmis\Eloquent\DistrictInformation','parent_id');
    }

    public function setParentIdAttribute($value)
    {
        $this->attributes['parent_id'] = empty($value)?null:$value;

    }
}
