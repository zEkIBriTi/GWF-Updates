<?php namespace Gwf\Events\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateGwfEvents extends Migration
{
    public function up()
    {
        Schema::create('gwf_events_', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title', 250);
            $table->date('start_date');
            $table->time('start_time');
            $table->date('end_date');
            $table->time('end_time');
            $table->time('event_length');
            $table->text('content');
            $table->boolean('published');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('gwf_events_');
    }
}
