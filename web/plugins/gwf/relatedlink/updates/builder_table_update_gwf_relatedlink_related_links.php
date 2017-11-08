<?php namespace gwf\Relatedlink\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateGwfRelatedlinkRelatedLinks extends Migration
{
    public function up()
    {
        Schema::table('gwf_relatedlink_related_links', function($table)
        {
            $table->date('updated_at')->nullable();
            $table->date('created_at')->nullable()->change();
            $table->dropColumn('update_at');
        });
    }
    
    public function down()
    {
        Schema::table('gwf_relatedlink_related_links', function($table)
        {
            $table->dropColumn('updated_at');
            $table->date('created_at')->nullable(false)->change();
            $table->date('update_at');
        });
    }
}
