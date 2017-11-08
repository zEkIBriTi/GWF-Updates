<?php namespace gwf\Howdoi\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateGwfHowdoiHowdoi2 extends Migration
{
    public function up()
    {
        Schema::table('gwf_howdoi_howdoi', function($table)
        {
            $table->boolean('activation_status');
        });
    }
    
    public function down()
    {
        Schema::table('gwf_howdoi_howdoi', function($table)
        {
            $table->dropColumn('activation_status');
        });
    }
}
