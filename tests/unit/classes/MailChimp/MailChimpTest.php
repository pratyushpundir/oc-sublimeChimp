<?php namespace SublimeArts\SublimeChimp\Tests\Unit\Classes\MailChimp;

require "vendor/autoload.php";

use PluginTestCase;
use SublimeArts\SublimeChimp\Models\Settings;
use SublimeArts\SublimeChimp\Classes\MailChimp\MailChimp;

class MailChimpTest extends PluginTestCase
{

    public function setUp()
    {
        parent::setUp();
        Settings::set('mailchimp_api_key', uniqid() . '-us7');
        Settings::set('mailchimp_username', 'john@doe.com');
    }

    /** @test */
    public function it_returns_the_mailchimp_base_api_uri()
    {
        $this->assertEquals(
            'https://us7.api.mailchimp.com/3.0/', 
            MailChimp::getApiBase()
        );
    }

    /** @test */
    public function it_generates_a_base_uri_from_the_api_key()
    {
        $this->assertEquals(
            'https://us7.api.mailchimp.com/3.0/', 
            MailChimp::getBaseUri(Settings::get('mailchimp_api_key'))
        );
    }

    /** @test */
    public function it_returns_the_mailchimp_user()
    {
        $this->assertEquals(
            'john@doe.com',
            MailChimp::getApiUser()
        );
    }

}