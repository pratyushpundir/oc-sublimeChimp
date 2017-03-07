<?php namespace SublimeArts\SublimeChimp\Classes\MailChimp;

use SublimeArts\SublimeChimp\Models\Settings;
use ApplicationException;

class MailChimp
{

    private static $apiVersion = '3.0';

    /** Fetches the MailChimp API key as set in the plugin's Settings. */
    public static function getApiKey()
    {
        return Settings::get('mailchimp_api_key');
    }

    /** Fetches the MailChimp Username as set in the plugin's Settings. */
    public static function getApiUser()
    {
        return Settings::get('mailchimp_username');
    }

    /** 
     * Generates the base MailChimp API url to be used for all requests
     * based on the API key set under plugin Settings.
     */
    public static function getApiBase()
    {
        return static::getBaseUri(static::getApiKey());
    }

    /**
     * Generates the base MailChimp API url to be used for all requests
     * based on the API key passed as an argument.
     */
    public static function getBaseUri($apiKey)
    {
        if ( ! static::getApiKey() || ! static::getApiUser() )
        {
            throw new ApplicationException("Mailchimp API Key and Username are required to be set in Settings before the plugin can be used.");
        }

        return 'https://' . explode('-', $apiKey)[1] . '.api.mailchimp.com/' . static::$apiVersion . '/';
    }

}