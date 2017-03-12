<?php namespace SublimeArts\SublimeChimp\Classes\SublimeChimp;

use SublimeArts\SublimeChimp\Models\Settings;
use Model, Log;

class BaseModel extends Model
{

    public function beforeCreate()
    {
        
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

        $adaptorClass = "SublimeArts\SublimeChimp\Classes\MailChimp\\" . $nativeClassName;
        return $adaptorClass;
    }

}