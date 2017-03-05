<?php namespace SublimeArts\SublimeChimp\Tests\Unit\Classes;

require "vendor/autoload.php";

use PluginTestCase;
use SublimeArts\SublimeChimp\Models\Settings;
use SublimeArts\SublimeChimp\Classes\MailChimp\ApiRequestor;

class ApiRequestorTest extends PluginTestCase
{

    public function setUp()
    {
        parent::setUp();
        Settings::set('mailchimp_api_key', uniqid() . '-us7');
        Settings::set('mailchimp_username', 'john@doe.com');
    }

    /** @test */
    public function it_returns_the_proper_http_client_instance()
    {
        $this->assertInstanceOf('GuzzleHttp\Client', ApiRequestor::httpClient());

        /** Just passing in a random model instance to test if it's class is returned back as intended. */
        ApiRequestor::setHttpClient(Settings::instance());
        $this->assertInstanceOf('SublimeArts\SublimeChimp\Models\Settings', ApiRequestor::httpClient());
    }

}