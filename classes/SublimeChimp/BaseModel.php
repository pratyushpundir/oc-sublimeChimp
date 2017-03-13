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
        $adaptorClass = static::getAdaptorClass();
        $mcRecord = $adaptorClass::create($this);
        $this->update(["mailchimp_id" => $mcRecord["id"]]);

    }

    /**
     * Translates the model's classname into a fully-qualified
     * adaptor classname as we have setup.
     * @return String                Fully-qualified classname of the adaptor for this model
     */
    public static function getAdaptorClass()
    {
        $classNameParts = explode( 'SublimeArts\SublimeChimp\Models\\', get_called_class() );

        $nativeClassName = array_pop( $classNameParts );

        $adaptorClass = "SublimeArts\SublimeChimp\Classes\MailChimp\\" . $nativeClassName;
        return $adaptorClass;
    }

}