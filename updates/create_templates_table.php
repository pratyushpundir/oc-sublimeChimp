<?php namespace SublimeArts\SublimeChimp\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateTemplatesTable extends Migration
{
    public function up()
    {
        Schema::create('sa_sublimechimp_templates', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('mailchimp_id')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sa_sublimechimp_templates');
    }
}
