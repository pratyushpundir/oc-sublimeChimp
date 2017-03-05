<?php namespace SublimeArts\SublimeChimp\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateCampaignsTable extends Migration
{
    public function up()
    {
        Schema::create('sa_sublimechimp_campaigns', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');

            $table->string('name')->notnull()->unique();
            $table->integer('mailing_list_id')->unsigned()->nullable();
            $table->string('mailchimp_id')->nullable();
            $table->string('mailchimp_list_id')->nullable();
            $table->string('type')->nullable();
            $table->string('subject_line')->nullable();
            $table->string('reply_to')->nullable();
            $table->string('current_status')->nullable();
            $table->integer('emails_sent')->unsigned()->nullable();
            $table->timestamp('sent_on')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sa_sublimechimp_campaigns');
    }
}
