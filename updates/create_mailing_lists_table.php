<?php namespace SublimeArts\SublimeChimp\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateMailingListsTable extends Migration
{
    public function up()
    {
        Schema::create('sa_sublimechimp_mailing_lists', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');

            $table->string('name')->unique();
            $table->string('mailchimp_id')->nullable();
            $table->string('permission_reminder')->nullable();
            $table->boolean('email_type_option')->default(true);

            $table->timestamps();
        });

        Schema::create('sa_mailing_list_recipient', function(Blueprint $table) {
            $table->integer('mailing_list_id')->unsigned();
            $table->integer('recipient_id')->unsigned();
            $table->string('status')->nullable();
            $table->timestamps();
            $table->primary(['mailing_list_id', 'recipient_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('sa_sublimechimp_mailing_lists');
        Schema::dropIfExists('sa_mailing_list_recipient');
    }
}
