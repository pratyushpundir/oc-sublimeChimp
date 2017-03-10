<?php namespace SublimeArts\SublimeChimp\Classes\MailChimp;

abstract class ApiResource
{

    /** List of all attributes required for a particular MailChimp Resource. */
    public static $requiredAttributes = [];

    /** Mapping of MailChimp attributes to those employed by native models. */
    public static $mailChimpToNativeAttrMapping = [];

    /**
     * Accepts a native model instance and employs the mapping above to return
     * an array that is understandable by MailChimp.
     * @param  Model $nativeInstance An Instance of the native model.
     * @return Array                 An array of translated model instance data.
     */
    
    /** TODO: MAKE THIS WORK!!! */
    public static function getMailChimpSchema($nativeInstance)
    {
        $translation = [];

        foreach ( static::$requiredAttributes as $mcAttribute ) {
            
            if ( ! is_array($mcAttribute) ) {
                $nativeAttribute = array_search($mcAttribute, static::$mailChimpToNativeAttrMapping);
                $translation[$mcAttribute] = $nativeInstance->{$nativeAttribute};
            } else {
                
            }

        }

        return $translation;
    }

    
    
}