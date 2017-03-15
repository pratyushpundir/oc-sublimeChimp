<?php namespace SublimeArts\SublimeChimp\Updates;

use SublimeArts\SublimeChimp\Models\MailingList;
use SublimeArts\SublimeChimp\Models\Recipient;
use SublimeArts\SublimeChimp\Models\Settings;
use Faker\Factory;
use Carbon\Carbon;
use Seeder;

class SeedRecipientsTable extends Seeder
{

    public function run()
    {
        Settings::set('mailchimp_api_key', env('MAILCHIMP_API_KEY'));
        Settings::set('mailchimp_username', env('MAILCHIMP_USERNAME'));

        $faker = Factory::create();

        for ($i = 0; $i < 50; $i++) {
            Recipient::create([
                'name' => $faker->name,
                'email' => $faker->email
            ]);
        }

        $mailingList = MailingList::create([
            'name' => 'Demo List',
            'permission_reminder' => 'This is a test permission reminder. Nobody on this list is a real person.',
            'email_type_option' => true
        ]);

        $recipients = Recipient::all()->random(20);

        foreach ($recipients as $recipient) {
            $mailingList->recipients()->save($recipient, [
                'status' => 'subscribed',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }

}
