<?php

namespace Pmis\Eloquent;

use Illuminate\Database\Eloquent\Model;

class HelpDeskMessage extends Model
{
    protected $table = 'helpdesk_messages';

    protected $fillable = ['name','email','phone','subject','message','reply_message','viewed_on','replied_on','replied_by'];

    public $dates = ['replied_on'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function replier()
    {
        return $this->belongsTo('Pmis\Eloquent\User', 'replied_by', 'id');
    }

    public function setMessageAttribute($value)
    {
        $this->attributes['message'] = nl2br(strip_tags($value));
    }
}
