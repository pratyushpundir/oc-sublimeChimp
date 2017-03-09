<?php namespace SublimeArts\SublimeChimp\Tests\Integration\Classes;

require "vendor/autoload.php";

use PluginTestCase;
use SublimeArts\SublimeChimp\Models\Settings;
use SublimeArts\SublimeChimp\Classes\MailChimp\ApiRequestor;
use Log;

class ApiRequestorTest extends PluginTestCase
{
    private $campaignData;
    private $listData;
    private $templateData;

    public function setUp()
    {
        parent::setUp();

        Settings::set('mailchimp_api_key', env('MAILCHIMP_API_KEY'));
        Settings::set('mailchimp_username', env('MAILCHIMP_USERNAME'));

        $this->campaignData = [
            [
                'type' => 'regular',
                'settings' => [
                    'title' => 'Regular Test Campaign. WILL BE AUTO DELETED.',
                    'subject_line' => 'This is an Integration Test. WILL BE AUTO DELETED.',
                    'from_name' => 'SublimeArts',
                    'reply_to' => 'pratyushpundir@icloud.com'
                ]
            ],
            [
                'type' => 'plaintext',
                'settings' => [
                    'title' => 'PlainText Test Campaign. WILL BE AUTO DELETED.',
                    'subject_line' => 'This is an Integration Test. WILL BE AUTO DELETED.',
                    'from_name' => 'SublimeArts',
                    'reply_to' => 'pratyushpundir@icloud.com'
                ]
            ],

        ];
    }
    
    /** @test */
    public function it_creates_a_single_record_on_mailchimp_and_fetches_it()
    {
        /** Campaign 1 */
        $record1 = ApiRequestor::save('campaigns', $this->campaignData[0]);

        $this->assertContains( 'regular', $record1 );
        $this->assertContains( 'Regular Test Campaign. WILL BE AUTO DELETED.', $record1 );
        $this->assertContains( 'This is an Integration Test. WILL BE AUTO DELETED.', $record1 );
        $this->assertContains( 'SublimeArts', $record1 );
        $this->assertContains( 'pratyushpundir@icloud.com', $record1 );

        /** Campaign 2 */
        $record2 = ApiRequestor::save('campaigns', $this->campaignData[1]);

        $this->assertContains( 'plaintext', $record2 );
        $this->assertContains( 'PlainText Test Campaign. WILL BE AUTO DELETED.', $record2 );
        $this->assertContains( 'This is an Integration Test. WILL BE AUTO DELETED.', $record2 );
        $this->assertContains( 'SublimeArts', $record2 );
        $this->assertContains( 'pratyushpundir@icloud.com', $record2 );

        return [$record1["id"], $record2["id"]];
    }

    /**
     * @test
     * @depends it_creates_a_single_record_on_mailchimp_and_fetches_it
     */
    public function it_gets_all_records_of_a_given_type_from_mailchimp($recordIds)
    {
        // $records = ApiRequestor::get( 'campaigns' );
        // Log::alert($records);
        
        // foreach ($recordIds as $recordId) {
        //     $this->assertContains( $recordId, $records["campaigns"] );
        // }
    }

    /**
     * @test
     * @depends it_creates_a_single_record_on_mailchimp_and_fetches_it
     */
    public function it_gets_the_record_with_the_given_mailchimp_id($recordIds)
    {

        /** Get Text Campaign 1 */
        $record1 = ApiRequestor::get( 'campaigns', $recordIds[0] );
        $this->assertContains( 'regular', $record1 );
        $this->assertContains( 'Regular Test Campaign. WILL BE AUTO DELETED.', $record1 );
        $this->assertContains( 'This is an Integration Test. WILL BE AUTO DELETED.', $record1 );
        $this->assertContains( 'SublimeArts', $record1 );
        $this->assertContains( 'pratyushpundir@icloud.com', $record1 );

        /** Get Text Campaign 2 */
        $record2 = ApiRequestor::get( 'campaigns', $recordIds[1] );
        $this->assertContains( 'plaintext', $record2 );
        $this->assertContains( 'PlainText Test Campaign. WILL BE AUTO DELETED.', $record2 );
        $this->assertContains( 'This is an Integration Test. WILL BE AUTO DELETED.', $record2 );
        $this->assertContains( 'SublimeArts', $record2 );
        $this->assertContains( 'pratyushpundir@icloud.com', $record2 );

    }

    /**
     * @test
     * @expectedException ApplicationException
     */
    public function it_throws_an_application_exception_if_a_record_with_the_given_id_is_not_found()
    {
        ApiRequestor::get( 'campaigns', 'gibbersih' );
    }

    /**
     * @test
     * @expectedException ApplicationException
     * @depends it_creates_a_single_record_on_mailchimp_and_fetches_it
     */
    public function it_deletes_a_record_with_the_given_id_on_mailchimp($recordIds)
    {

        foreach ($recordIds as $recordId) {
            $result = ApiRequestor::delete( 'campaigns', $recordId );
            ApiRequestor::get( 'campaigns', $recordId );
        }
        
    }

}