<?php namespace SublimeArts\SublimeChimp\Tests\Unit\Models;

require "vendor/autoload.php";

use PluginTestCase;
use SublimeArts\SublimeChimp\Models\Settings;

class SettingsTest extends PluginTestCase
{

    public function tearDown()
    {
        Settings::truncate();
        parent::tearDown();
    }

    /**
     * @test
     * @expectedException ApplicationException
     */
    public function it_throws_an_exception_when_required_settings_are_not_set()
    {
        Settings::set('mailchimp_username', '');
        Settings::checkRequired();
    }

}
