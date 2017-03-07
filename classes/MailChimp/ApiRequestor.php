<?php namespace SublimeArts\SublimeChimp\Classes\MailChimp;

use SublimeArts\SublimeChimp\Models\Settings;
use GuzzleHttp\Client;

class ApiRequestor
{

    protected static $httpClient;

    /**
     * Allows setting a custom Http Client or defaults to the bundled 
     * GuzzleHttp Client.
     */
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

    /**
     * Returns an instance of the Http Client set above or defaults to
     * the bundled GuzzleHttp.
     */
    public static function httpClient()
    {
        if ( ! static::$httpClient ) {
            static::setHttpClient();
        }
        return static::$httpClient;
    }

    /**
     * Saves a record of a given type with the provided data to MailChimp.
     * @param  String    $recordType  Either 'campaigns', 'lists' or 'templates'
     * @param  Array     $data        Passed in data to be saved as record  
     * @return Response               JSON Response received from the MailChimp API
     */
    public static function save($recordType, $data)
    {
        return static::httpClient()->request('POST', $recordType, [
            'json' => $data
        ]);
    }

    /**
     * Gets either a single record of the provided MailChimp record ID or 
     * all records of a specified type if no record ID is provided.
     * @param  String    $recordType  Either 'campaigns', 'lists' or 'templates'
     * @param  String    $recordId    MailChimp ID of a particular record to be fecthed
     * @return Response               JSON Response received from the MailChimp API
     */
    public static function get($recordType, $recordId = null)
    {
        if ( ! $recordId ) {
            return static::httpClient()->request('GET', $recordType);
        } else {
            return static::httpClient()->request('GET', "{$recordType}/{$recordId}");
        }
    }

}