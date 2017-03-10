<?php namespace SublimeArts\SublimeChimp\Tests\Unit\Classes\SublimeChimp;

require "vendor/autoload.php";

use PluginTestCase;
use SublimeArts\SublimeChimp\Classes\SublimeChimp\BaseModel;

class BaseModelTest extends PluginTestCase
{

    /**
     * @test
     */
    public function it_translates_a_native_classname_into_our_adaptor_classname()
    {
        $nativeClassName = 'SublimeArts\SublimeChimp\Models\Campaign';
        
        $adaptorClass = BaseModel::getAdaptorClass($nativeClassName);
        
        $this->assertEquals($adaptorClass, 'SublimeArts\SublimeChimp\Classes\MailChimp\Campaign');
    }

}