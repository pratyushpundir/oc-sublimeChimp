<?php namespace SublimeArts\SublimeChimp\Models;

use Model, Log;
use SublimeArts\SublimeChimp\Classes\MailChimp\Campaign as MCCampaign;

/**
 * Campaign Model
 */
class Campaign extends Model
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
    protected $fillable = [];

    /**
     * @var array Relations
     */
    public $belongsTo = [
        'mailingList' => [ 'SublimeArts\SublimeChimp\Models\MailingList' ]
    ];

    public function beforeCreate()
    {
        $this->reply_to = ($this->reply_to && $this->reply_to != '') 
                        ? $this->reply_to 
                        : Settings::get('default_reply_to');
                        
        $this->from_name = ($this->from_name && $this->from_name != '') 
                        ? $this->from_name 
                        : Settings::get('default_from_name');
    }

    public function afterCreate()
    {
        $mcCampaign = MCCampaign::create($this);

        Log::alert($mcCampaign->getBody()->getContents());
    }
}
