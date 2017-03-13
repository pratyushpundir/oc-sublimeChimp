<?php namespace SublimeArts\SublimeChimp\Updates;

use SublimeArts\SublimeChimp\Models\Recipient;
use Faker\Factory;
use Seeder;

class SeedRecipientsTable extends Seeder
{
    public function run()
    {
        $faker = Factory::create();

        for ($i = 0; $i < 50; $i++) { 
            Recipient::create([
                'name' => $faker->name,
                'email' => $faker->email
            ]);
        }
    }
}