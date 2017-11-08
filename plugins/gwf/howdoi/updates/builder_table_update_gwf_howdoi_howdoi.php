<?php namespace gwf\Howdoi\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateGwfHowdoiHowdoi extends Migration
{
    public function up()
    {
        Schema::table('gwf_howdoi_howdoi', function($table)
        {
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
        });
    }
    
    public function down()
    {
        Schema::table('gwf_howdoi_howdoi', function($table)
        {
            $table->dropColumn('created_at');
            $table->dropColumn('updated_at');
        });
    }
}
