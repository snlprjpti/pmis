<?php

namespace Pmis\Eloquent;

use Illuminate\Database\Eloquent\Model;

class VitalStatisticType extends Model
{
    protected $fillable = ['name'];

    public $timestamps = false;
}
