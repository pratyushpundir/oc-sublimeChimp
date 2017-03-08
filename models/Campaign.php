<?php namespace SublimeArts\SublimeChimp\Models;

use Model, Log, Flash;
use October\Rain\Exception\SystemException;
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
    protected $fillable = [
        "mailchimp_id"
    ];

    /**
     * @var array Relations
     */
    public $belongsTo = [
        'mailingList' => [ 'SublimeArts\SublimeChimp\Models\MailingList' ]
    ];

    public function beforeCreate()
    {
        /**
         * Use default "reply_to" and "from_name" values set under plugin Settings
         * if none were provided for the Campaign specifically.
         */
        $this->reply_to = ($this->reply_to && $this->reply_to != '') 
                        ? $this->reply_to 
                        : Settings::get('default_reply_to');
                        
        $this->from_name = ($this->from_name && $this->from_name != '') 
                        ? $this->from_name 
                        : Settings::get('default_from_name');
    }

    public function afterCreate()
    {

        /**
         * Create the campaign on MailChimp using the API and set the
         * MailChimp ID if successful.
         */
        $mcCampaign = MCCampaign::create($this);
        $this->update(["mailchimp_id" => $mcCampaign["id"]]);

    }
}
