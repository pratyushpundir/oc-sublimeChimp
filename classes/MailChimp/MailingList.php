<?php namespace SublimeArts\SublimeChimp\Classes\MailChimp;

use SublimeArts\SublimeChimp\Classes\MailChimp\ApiRequestor;
use SublimeArts\SublimeChimp\Classes\MailChimp\ApiResource;
use SublimeArts\SublimeChimp\Models\Settings;
use Log;

class MailingList extends ApiResource
{

    public static $requiredAttributes = [
        'name',
        'contact' => [
            'company',
            'address1',
            'city',
            'state',
            'zip',
            'country'
        ],
        'permission_reminder',
        'campaign_defaults' => [
            'from_name',
            'from_email',
            'subject',
            'language'
        ],
        'email_type_option'
    ];

    public static $mailChimpToNativeAttrMapping = [
        
    ];

    /**
     * Create a new MailChimp List with the passed in native record instance.
     * @param   MailingList  $instance  Instance of the native MailingList model class
     * @return  Array                   Complete data of successfully saved MailChimp List
     */
    public static function create($instance)
    {   
        $data = [
            'name' => $instance->name,
            'contact' => [
                'company' => Settings::get('contact_organization'),
                'address1' => Settings::get('contact_address'),
                'city' => Settings::get('contact_city'),
                'state' => Settings::get('contact_state'),
                'zip' => Settings::get('contact_zip'),
                'country' => Settings::get('contact_country')
            ],
            'permission_reminder' => $instance->permission_reminder,
            'campaign_defaults' => [
                'from_name' => ($instance->campaign)
                                ? $instance->campaign->from_name
                                : Settings::get('default_from_name'),
                'from_email' => ($instance->campaign)
                                ? $instance->campaign->reply_to
                                : Settings::get('default_reply_to'),
                'subject' => ($instance->campaign)
                                ? $instance->campaign->subject_line
                                : 'Your custom subject here!',
                'language' => 'en'
            ],
            'email_type_option' => true
        ];

        return ApiRequestor::save('lists', $data);
    }

    /**
     * Get a List from MailChimp API based on the passed MailChimp ID.
     * @param  String  $listId  MailChimp ID of the List to be fetched
     * @return Array            Complete data of the fetched List if successfully found 
     */
    public static function get($listId)
    {
        return ApiRequestor::get('lists', $listId);
    }

    /**
     * Get all Lists saved on MailChimp.
     * @return Array  All Lists on MailChimp
     */
    public static function all()
    {
        return ApiRequestor::get('lists');
    }
    
}