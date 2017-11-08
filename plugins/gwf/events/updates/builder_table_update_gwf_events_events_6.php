<?php namespace Gwf\Events\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateGwfEventsEvents6 extends Migration
{
    public function up()
    {
        Schema::table('gwf_events_events', function($table)
        {
            $table->integer('recorder');
        });
    }
    
    public function down()
    {
        Schema::table('gwf_events_events', function($table)
        {
            $table->dropColumn('recorder');
        });
    }
}
