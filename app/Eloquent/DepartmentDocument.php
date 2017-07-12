<?php

namespace Pmis\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Request;

class DepartmentDocument extends Model
{
    protected $fillable = [
        'user_id',
        'office_id',
        'title',
        'author',
        'published_on',
        'type',
        'file_size',
        'file_path',
        'file_name',
        'file_type',
        'documents_status',
    ];

    /**
     * Name of the table.
     *
     * @var string
     */
    protected $table = 'department_documents';

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
        if (!empty(Request::query('title'))) {
            $query = $query->where('title', 'LIKE', '%'.Request::query('title').'%');
        }
        if (!empty(Request::query('type'))) {
            $query = $query->where('type', Request::query('type'));
        }
        if (!empty(Request::query('office'))) {
            $query = $query->where('office_id', Request::query('office'));
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
    public function office()
    {
        return $this->belongsTo('Pmis\Eloquent\Office', 'office_id', 'id');
    }
}
