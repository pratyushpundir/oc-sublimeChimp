<?php namespace SublimeArts\SublimeChimp\Models;

use Model;

/**
 * Settings Model
 */
class Settings extends Model
{
    public $implement = ['System.Behaviors.SettingsModel'];

    public $settingsCode = 'sa_sublimechimp_settings';

    public $settingsFields = 'fields.yaml';
}
