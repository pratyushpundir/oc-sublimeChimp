<?php namespace SublimeArts\SublimeChimp\Classes\MailChimp;

use SublimeArts\SublimeChimp\Models\Settings;
use ApplicationException;

class MailChimp
{

    private static $apiVersion = '3.0';

    public static function getApiKey()
    {
        return Settings::get('mailchimp_api_key');
    }

    public static function getApiUser()
    {
        return Settings::get('mailchimp_username');
    }

    public static function getApiBase()
    {
        return static::getBaseUri(static::getApiKey());
    }

    public static function getBaseUri($apiKey)
    {
        if ( ! static::getApiKey() || ! static::getApiUser() )
        {
            throw new ApplicationException("Mailchimp API Key and Username are required to be set in Settings before the plugin can be used.");
        }

        return 'https://' . explode('-', $apiKey)[1] . '.api.mailchimp.com/' . static::$apiVersion . '/';
    }

}