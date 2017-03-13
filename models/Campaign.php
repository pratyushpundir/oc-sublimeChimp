<?php namespace SublimeArts\SublimeChimp\Models;

use SublimeArts\SublimeChimp\Classes\MailChimp\Campaign as MCCampaign;
use SublimeArts\SublimeChimp\Classes\SublimeChimp\BaseModel;
use October\Rain\Exception\SystemException;
use Log, Flash;

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
        "name",
        "type",
        "subject_line",
        "from_name",
        "reply_to",
        "mailchimp_id"
    ];

    /**
     * @var array Relations
     */
    public $belongsTo = [
        'mailingList' => [ 'SublimeArts\SublimeChimp\Models\MailingList' ]
    ];

    public function beforeSave()
    {
        
        /**
         * Use defaults set under Settings if no value is provided thru the creation form.
         */
        $this->reply_to = ($this->reply_to && $this->reply_to != '') 
                            ? $this->reply_to 
                            : Settings::get('default_reply_to');
                            
        $this->from_name = ($this->from_name && $this->from_name != '') 
                        ? $this->from_name 
                        : Settings::get('default_from_name');

    }

}
