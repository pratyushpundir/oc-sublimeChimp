<?php namespace SublimeArts\SublimeChimp\Classes\MailChimp;

use SublimeArts\SublimeChimp\Models\Settings;
use GuzzleHttp\Client;

class ApiRequestor
{

    protected static $httpClient;

    public static function setHttpClient($httpClient = null)
    {
        if ( ! $httpClient ) {
            static::$httpClient = new Client([
                'base_uri' => MailChimp::getApiBase(),
                'auth' => [
                    MailChimp::getApiUser(),
                    MailChimp::getApiKey()
                ]
            ]);
        } else {
            static::$httpClient = $httpClient;
        }

        return static::$httpClient;
    }

    public static function httpClient()
    {
        if ( ! static::$httpClient ) {
            static::setHttpClient();
        }
        return static::$httpClient;
    }

    public static function save($recordType, $data)
    {
        return static::httpClient()->request('POST', $recordType, [
            'json' => $data
        ]);
    }

    public static function get($recordType, $recordId = null)
    {
        if ( ! $recordId ) {
            return static::httpClient()->request('GET', $recordType);
        } else {
            return static::httpClient()->request('GET', "{$recordType}/{$recordId}");
        }
    }

}