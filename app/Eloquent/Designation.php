<?php

namespace Pmis\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    protected $table = 'designations';

    protected $fillable = ['name', 'display_order'];

    public $timestamps = false;

    public function setDisplayOrderAttribute($value)
    {
        $this->attributes['display_order'] = (empty($value)) ? null : $value;
    }
}
