<?php namespace Gwf\Events\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateGwfEventsEvents7 extends Migration
{
    public function up()
    {
        Schema::table('gwf_events_events', function($table)
        {
            $table->time('event_length')->nullable()->change();
        });
    }
    
    public function down()
    {
        Schema::table('gwf_events_events', function($table)
        {
            $table->time('event_length')->nullable(false)->change();
        });
    }
}
