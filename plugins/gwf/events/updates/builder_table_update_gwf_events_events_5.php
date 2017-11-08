<?php namespace Gwf\Events\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateGwfEventsEvents5 extends Migration
{
    public function up()
    {
        Schema::table('gwf_events_events', function($table)
        {
            $table->string('location', 250);
            $table->string('audience', 250);
            $table->string('guest_of_honor', 250);
        });
    }
    
    public function down()
    {
        Schema::table('gwf_events_events', function($table)
        {
            $table->dropColumn('location');
            $table->dropColumn('audience');
            $table->dropColumn('guest_of_honor');
        });
    }
}
