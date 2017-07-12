<?php

namespace Pmis\Eloquent;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CensusInformation.
 */
class CensusInformation extends Model
{
    /**
     * @var string
     */
    protected $table = 'census_information';

    /**
     * @var array
     */
    protected $fillable = ['total_population','birth_per_sec','death_per_sec','migration_per_sec','sex_ratio','census_year','status'];

    /**
     * @var array
     */
    protected $dates = ['census_year'];

    /**
     * Scope a query to only include active census.
     *
     * @param $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    /**
     * Scope a query to only include inactive census.
     *
     * @param $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeInActive($query)
    {
        return $query->where('status', 0);
    }
}
