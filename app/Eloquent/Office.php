<?php

namespace Pmis\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    protected $table = 'offices';

    protected $fillable = ['office_name', 'district_id','office_type'];

    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function district()
    {
        return $this->belongsTo('Pmis\Eloquent\District', 'district_id', 'id');
    }
}
