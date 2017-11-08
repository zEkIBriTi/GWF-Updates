<?php namespace gwf\Complains\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateGwfComplains extends Migration
{
    public function up()
    {
        Schema::table('gwf_complains_', function($table)
        {
            $table->renameColumn('attachment', 'attachments');
        });
    }
    
    public function down()
    {
        Schema::table('gwf_complains_', function($table)
        {
            $table->renameColumn('attachments', 'attachment');
        });
    }
}
