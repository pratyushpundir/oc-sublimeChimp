<?php namespace SublimeArts\SublimeChimp\Models;

use Log, Flash;
use October\Rain\Exception\SystemException;
use SublimeArts\SublimeChimp\Classes\MailChimp\Campaign as MCCampaign;
use SublimeArts\SublimeChimp\Classes\SublimeChimp\BaseModel;

/**
 * Campaign Model
 */
class Campaign extends BaseModel
{
    /**
     * @var string The database table used by the model.
     */
    public $table = 'sa_sublimechimp_campaigns';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [
        "mailchimp_id"
    ];

    /**
     * @var array Relations
     */
    public $belongsTo = [
        'mailingList' => [ 'SublimeArts\SublimeChimp\Models\MailingList' ]
    ];

}
