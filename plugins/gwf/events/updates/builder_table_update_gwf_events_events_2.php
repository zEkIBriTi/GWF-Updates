<?php namespace Gwf\Events\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateGwfEventsEvents2 extends Migration
{
    public function up()
    {
        Schema::table('gwf_events_events', function($table)
        {
            $table->renameColumn('published', 'activation_status');
        });
    }
    
    public function down()
    {
        Schema::table('gwf_events_events', function($table)
        {
            $table->renameColumn('activation_status', 'published');
        });
    }
}
