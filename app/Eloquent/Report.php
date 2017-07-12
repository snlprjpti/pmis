<?php

namespace Pmis\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Request;

class Report extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'fiscal_id',
        'office_id',
        'type',
        'submission_date',
        'file_size',
        'file_path',
        'file_name',
        'file_type',
    ];

    /**
     * Name of the table.
     *
     * @var string
     */
    protected $table = 'reports';

    /**
     * Primary key column name.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Scope a query to only filter documents.
     *
     * @param $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFiltered($query)
    {
        if (!empty(Request::query('financial_year'))) {
            $query = $query->where('fiscal_id', Request::query('financial_year'));
        }
        if (!empty(Request::query('type'))) {
            $query = $query->where('type', Request::query('type'));
        }
        if (!empty(Request::query('office'))) {
            $query = $query->where('office_id', Request::query('office_id'));
        }

        return $query;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function uploader()
    {
        return $this->belongsTo('Pmis\Eloquent\User', 'user_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function district()
    {
        return $this->belongsTo('Pmis\Eloquent\District', 'district_id', 'id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fiscal()
    {
        return $this->belongsTo('Pmis\Eloquent\Fiscal', 'fiscal_id', 'id');
    }

    public function office()
    {
        return $this->belongsTo('Pmis\Eloquent\Office', 'office_id', 'id');
    }

    public function getPaginated()
    {
        $reports = self::with(['fiscal', 'office', 'uploader'])->filtered();

        if (!is_super_admin()) {
            $reports = $reports->where('office_id', auth()->user()->office_id);
        }

        return $reports->paginate(20);
    }
}
