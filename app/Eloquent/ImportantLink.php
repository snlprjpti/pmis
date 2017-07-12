<?php namespace Pmis\Eloquent;

use Illuminate\Database\Eloquent\Model;

class ImportantLink extends Model {

	protected $table = 'important_links';

    public $timestamps = false;

    protected $fillable = [
        'organization_name',
        'country_id',
        'address',
        'email',
        'url',
        'description',
        'link_status',
        'display_order'
    ];

    public function country()
    {
        return $this->belongsTo('Pmis\Eloquent\Country');
    }

}
