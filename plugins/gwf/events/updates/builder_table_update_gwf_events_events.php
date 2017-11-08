<?php namespace Gwf\Events\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateGwfEventsEvents extends Migration
{
    public function up()
    {
        Schema::rename('gwf_events_', 'gwf_events_events');
        Schema::table('gwf_events_events', function($table)
        {
            $table->increments('id')->unsigned(false)->change();
        });
    }
    
    public function down()
    {
        Schema::rename('gwf_events_events', 'gwf_events_');
        Schema::table('gwf_events_', function($table)
        {
            $table->increments('id')->unsigned()->change();
        });
    }
}
