<?php namespace gwf\Complains\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateGwfComplains2 extends Migration
{
    public function up()
    {
        Schema::table('gwf_complains_', function($table)
        {
            $table->string('recorder');
        });
    }
    
    public function down()
    {
        Schema::table('gwf_complains_', function($table)
        {
            $table->dropColumn('recorder');
        });
    }
}
