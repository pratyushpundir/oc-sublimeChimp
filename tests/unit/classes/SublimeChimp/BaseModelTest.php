<?php namespace SublimeArts\SublimeChimp\Tests\Unit\Classes\SublimeChimp;

require "vendor/autoload.php";

use SublimeArts\SublimeChimp\Classes\SublimeChimp\BaseModel;
use SublimeArts\SublimeChimp\Models\MailingList;
use SublimeArts\SublimeChimp\Models\Campaign;
use SublimeArts\SublimeChimp\Models\Template;
use PluginTestCase;

class BaseModelTest extends PluginTestCase
{

    /**
     * @test
     */
    public function it_translates_a_native_classname_into_our_adaptor_classname()
    {
        $this->assertEquals(Campaign::getAdaptorClass(), 'SublimeArts\SublimeChimp\Classes\MailChimp\Campaign');
        $this->assertEquals(MailingList::getAdaptorClass(), 'SublimeArts\SublimeChimp\Classes\MailChimp\MailingList');
        $this->assertEquals(Template::getAdaptorClass(), 'SublimeArts\SublimeChimp\Classes\MailChimp\Template');
    }

}