<?php namespace SublimeArts\SublimeChimp\Models;

use ApplicationException;
use Model;

/**
 * Settings Model
 */
class Settings extends Model
{
    /**
     * Settings that are REQUIRED before the plugin can be used reliably.
     */
    private static $requiredSettings = [
        "mailchimp_username" => "MailChimp Username",
        "mailchimp_api_key" => "MailChimp API Key",
        "default_from_name" => "Default 'From' name",
        "default_reply_to" => "Default 'Reply to' email address"
    ];

    public $implement = ['System.Behaviors.SettingsModel'];

    public $settingsCode = 'sa_sublimechimp_settings';

    public $settingsFields = 'fields.yaml';

    public static function initSettingsData()
    {
        /**
         * Sensible defaults for Settings can be set here if needed though MailChimp 
         * integration won't work till actual username and API key are used.
         */
    }

    /**
     * Throws an ApplicationException if the Settings defined in the $requiredSettings class attribute have not been set
     * or returns true if all is well
     * @return boolean
     */
    public static function checkRequired()
    {
        foreach (static::$requiredSettings as $settingName => $settingDescription) {
            if ( ! static::get($settingName) || static::get($settingName) == '' ) {
                throw new ApplicationException("{$settingDescription} not set in SublimeChimp's plugin backend settings!");
            } else {
                return true;
            }
        }
    }
}
