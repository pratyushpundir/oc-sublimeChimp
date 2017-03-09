<?php namespace SublimeArts\SublimeChimp\Classes\SublimeChimp;

use Model, Log;
use SublimeArts\SublimeChimp\Models\Settings;

class BaseModel extends Model
{

    public function beforeCreate()
    {
        /**
         * Use default "reply_to" and "from_name" values set under plugin Settings
         * if none were provided for the Campaign specifically.
         */
        if ( get_class($this) == 'SublimeArts\SublimeChimp\Models\Campaign' ) 
        {
            
            $this->reply_to = ($this->reply_to && $this->reply_to != '') 
                            ? $this->reply_to 
                            : Settings::get('default_reply_to');
                            
            $this->from_name = ($this->from_name && $this->from_name != '') 
                            ? $this->from_name 
                            : Settings::get('default_from_name');
        }
    }

    public function afterCreate()
    {

        /**
         * Create the record on MailChimp using the API and set the
         * MailChimp ID if successful.
         */
        $adaptorClass = static::getAdaptorClass(get_class($this));
        $mcRecord = $adaptorClass::create($this);
        $this->update(["mailchimp_id" => $mcRecord["id"]]);

    }

    /**
     * Translates a native model classname into a fully-qualified
     * adaptor classname as we have setup.
     * @param  String  $nativeClass  Fully-qualified classname of the native model class
     * @return String                Fully-qualified classname of the adaptor for this model
     */
    public static function getAdaptorClass($nativeClass)
    {
        $classNameParts = explode('SublimeArts\SublimeChimp\Models\\', $nativeClass);

        $nativeClassName = array_pop( $classNameParts );

        $result = "SublimeArts\SublimeChimp\Classes\MailChimp\\" . $nativeClassName;
        return $result;
    }

}