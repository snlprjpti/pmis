<?php

namespace Pmis\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Request;

class Book extends Model
{
    /**
     * Fillable to database with mass assignment.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'office_id',
        'title',
        'author',
        'organization_name',
        'organization_type',
        'publisher',
        'type',
        'published_year',
        'file_size',
        'file_path',
        'file_name',
        'file_type',
        'book_status',
    ];

    /**
     * Name of the table.
     *
     * @var string
     */
    protected $table = 'books';

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
        if (!empty(Request::query('organization_type'))) {
            $query = $query->where('organization_type', Request::query('organization_type'));
        }
        if (!empty(Request::query('office'))) {
            $query = $query->where('office_id', Request::query('office'));
        }

        return $query;
    }

    public function uploader()
    {
        return $this->belongsTo('Pmis\Eloquent\User', 'user_id', 'id');
    }

    public function office()
    {
        return $this->belongsTo('Pmis\Eloquent\Office', 'office_id', 'id');
    }

    public function getPaginated()
    {
        $books = self::with('office')->filtered()->where('office_id', auth()->user()->office_id);

        if (!is_super_admin()) {
            $books = $books->orWhere('is_viewable_to_district', 1);
        } else {
            $books = $books->orWhere('is_viewable_to_central', 1);
        }

        return $books->paginate(20);
    }
}
