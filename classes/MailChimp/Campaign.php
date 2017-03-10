<?php namespace SublimeArts\SublimeChimp\Classes\MailChimp;

use SublimeArts\SublimeChimp\Classes\MailChimp\ApiRequestor;
use SublimeArts\SublimeChimp\Classes\MailChimp\ApiResource;
use Log, Flash;

class Campaign extends ApiResource
{

    public static $requiredAttributes = [
        'type',
        'recipients' => [
            'list_id'
        ],
        'settings' => [
            'title',
            'subject_line',
            'from_name',
            'reply_to'
        ]
    ];

    public static $mailChimpToNativeAttrMapping = [
        'type' => 'type',
        'recipients' => [
            'list_id' => 'mailchimp_list_id'
        ],
        'settings' => [
            'title' => 'name',
            'subject_line' => 'subject_line',
            'from_name' => 'from_name',
            'reply_to' => 'reply_to'
        ]
    ];

    /**
     * Create a new MailChimp Campaign with the passed in native record instance.
     * @param   Campaign  $instance  Instance of the native Campaign model class
     * @return  Array                Complete data of successfully saved MailChimp Campaign
     */
    public static function create($instance)
    {   
        $data = [
            'type' => $instance->type,
            'settings' => [
                'title' => $instance->name,
                'subject_line' => $instance->subject_line,
                'from_name' => $instance->from_name,
                'reply_to' => $instance->reply_to
            ]
        ];

        return ApiRequestor::save('campaigns', $data);
    }

    /**
     * Get a campaign from MailChimp API based on the passed MailChimp Campaign ID.
     * @param  String  $campaignId  MailChimp ID of the Campaign to be fetched
     * @return Array                Complete data of the fetched Campaign if successfully found 
     */
    public static function get($campaignId)
    {
        return ApiRequestor::get('campaigns', $campaignId);
    }

    /**
     * Get all campaigns saved on MailChimp.
     * @return Array  All Campaigns on MailChimp
     */
    public static function all()
    {
        return ApiRequestor::get('campaigns');
    }
    
}