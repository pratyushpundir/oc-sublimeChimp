<?php namespace SublimeArts\SublimeChimp\Classes\MailChimp;

use October\Rain\Exception\ApplicationException;
use SublimeArts\SublimeChimp\Models\Settings;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Client;
use Log;

class ApiRequestor
{

    protected static $httpClient;

    /**
     * Sets a custom Http Client or defaults to the bundled 
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
     * Saves a record of a given type with the provided data to MailChimp and 
     * returns an associative array with the created record if successful.
     * @param  String  $recordType  Either 'campaigns', 'lists', 'templates', etc.
     * @param  Array   $data        Passed in data to be saved as record  
     * @return Array                Newly created record
     */
    public static function save($recordType, $data)
    {

        try {

            $record = static::httpClient()->request('POST', $recordType, [
                'json' => $data
            ]);

            return json_decode($record->getBody()->getContents(), true);

        } catch (ClientException $e) {

            Log::error( $e );
            
            $recordType = studly_case( str_singular( $recordType ) );
            
            throw new ApplicationException(
                "{$recordType} creation on MailChimp failed. Aborting!! Check system Log for details."
            );

        }

    }

    /**
     * Gets either a single record of the provided MailChimp record ID or 
     * all records of a specified type if no record ID is provided.
     * @param  String  $recordType  Either 'campaigns', 'lists', 'templates', etc.
     * @param  String  $recordId    MailChimp ID of a particular record to be fetched
     * @return Array                Response received from the MailChimp API
     */
    public static function get($recordType, $recordId = null)
    {
        try {

            if ( ! $recordId ) {
                
                /** Get all */
                return json_decode(
                    static::httpClient()
                        ->request('GET', $recordType)
                        ->getBody()->getContents(), 
                    true
                );

            } else {
                
                /** Get one */
                return json_decode(
                    static::httpClient()
                        ->request('GET', "{$recordType}/{$recordId}")
                        ->getBody()->getContents(), 
                    true
                );

            }

        } catch (ClientException $e) {
            throw new ApplicationException("Record(s) not found!");
        }
    }

    public static function update($recordType, $recordId, $data)
    {
        try {
            
            return json_decode(
                static::httpClient()
                    ->request('PATCH', "{$recordType}/{$recordId}", ['json' => $data])
                    ->getBody()->getContents(), 
                true
            );

        } catch (ClientException $e) {
            throw new ApplicationException($e);
        }
    }

    /**
     * Delete a MailChimp record of a given type and with the provided MailChimp ID
     * @param  String  $recordType  Either 'campaigns', 'lists', 'templates', etc.
     * @param  String  $recordId    MailChimp ID of a particular record to be deleted
     * @return Array                Response received from the MailChimp API
     */
    public static function delete($recordType, $recordIds)
    {
        if ( ! is_array($recordIds) ) {
            
            try {
                
                return json_decode(
                    static::httpClient()->request('DELETE', "{$recordType}/{$recordIds}")
                        ->getBody()->getContents(), 
                    true
                );

            } catch (ClientException $e) {
                throw new ApplicationException("Ooops! Something went wrong! Are you sure the record exists?");
            }

        } else {

            /** Do not allow batch deletion for now. Will allow soon! */
            throw new ApplicationException("Batch deletion is not allowed for your protection!");
        }
    }

}