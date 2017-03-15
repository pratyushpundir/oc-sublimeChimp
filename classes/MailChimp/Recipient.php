<?php namespace SublimeArts\SublimeChimp\Classes\MailChimp;

use SublimeArts\SublimeChimp\Classes\MailChimp\ApiRequestor;
use SublimeArts\SublimeChimp\Classes\MailChimp\ApiResource;
use SublimeArts\SublimeChimp\Models\Settings;
use Log;

class Recipient extends ApiResource
{

    public static $requiredAttributes = [
        "email_address",
        "status",
        "merge_fields" => [
            "NAME"
        ]
    ];

    public static $mailChimpToNativeAttrMapping = [
        
    ];

    /**
     * Subscribe a new MailChimp List Member with the passed in native record instance.
     * @param   Recipient  $instance  Instance of the native Recipient model class
     * @return  Array                 Complete data of successfully saved MailChimp List Member
     */
    public static function subscribe($instance)
    {   
        // $data = [
        //     "email_address" => $instance->email,
        //     "status" => "subscribed",
        //     "merge_fields" => [
        //         "NAME" => $instance->name
        //     ]
        // ];

        // $listId = $instance->mailingLists->first()->mailchimp_id;

        // $remoteRecord = json_decode(
        //     ApiRequestor::httpClient()->request('POST', "lists/{$listId}/members/", [
        //         'json' => $data
        //     ])->getBody()->getContents()
        // , true);

        // Log::alert($remoteRecord);
    }
    
}