<?php namespace SublimeArts\SublimeChimp\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateRecipientsTable extends Migration
{
    public function up()
    {
        Schema::create('sa_sublimechimp_recipients', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            
            $table->string('name')->nullable();
            $table->string('email')->unique()->index();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sa_sublimechimp_recipients');
    }
}
