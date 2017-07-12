<?php

namespace Pmis\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Fiscal extends Model
{
    protected $table = 'fiscals';

    protected $fillable = ['name','status'];
}
