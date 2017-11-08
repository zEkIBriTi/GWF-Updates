<?php namespace Gwf\Welcomenote\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateGwfWelcomenoteWelcomeNotes extends Migration
{
    public function up()
    {
        Schema::create('gwf_welcomenote_welcome_notes', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('person', 150);
            $table->string('title', 250);
            $table->text('content');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            $table->integer('recorder');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('gwf_welcomenote_welcome_notes');
    }
}
