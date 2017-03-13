<?php namespace SublimeArts\SublimeChimp\Models;

use SublimeArts\SublimeChimp\Classes\SublimeChimp\BaseModel;
use SublimeArts\SublimeChimp\Models\Settings;

/**
 * MailingList Model
 */
class MailingList extends BaseModel
{
    /**
     * @var string The database table used by the model.
     */
    public $table = 'sa_sublimechimp_mailing_lists';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [
        'mailchimp_id'
    ];

    /**
     * @var array Relations
     */
    public $hasMany = [
        'campaigns' => [ 'SublimeArts\SublimeChimp\Models\Campaign' ],
        'campaigns_count' => [ 'SublimeArts\SublimeChimp\Models\Campaign', 'count' => 'true' ],
    ];

    public $belongsToMany = [
        'recipients' => [
            'SublimeArts\SublimeChimp\Models\Recipient',
            'table'    => 'sa_mailing_list_recipient',
            'key'      => 'mailing_list_id',
            'otherKey' => 'recipient_id'
        ],
        'recipients_count' => [
            'SublimeArts\SublimeChimp\Models\Recipient',
            'table'    => 'sa_mailing_list_recipient',
            'key'      => 'mailing_list_id',
            'otherKey' => 'recipient_id',
            'count'    => 'true'
        ]
    ];

    public function getContactInfo()
    {
        return json_encode([
            "company" => Settings::get("contact_organization"),
            "address1" => Settings::get("contact_address"),
            "city" => Settings::get("contact_city"),
            "state" => Settings::get("contact_state"),
            "zip" => Settings::get("contact_zip"),
            "country" => Settings::get("contact_country"),
            "phone" => Settings::get("contact_phone")
        ]);
    }

    public function getContactAttribute()
    {
        return ( Settings::get("contact_organization") )
                ? Settings::get("contact_organization")
                : "-";
    }

    public function beforeSave()
    {

        

    }
}
