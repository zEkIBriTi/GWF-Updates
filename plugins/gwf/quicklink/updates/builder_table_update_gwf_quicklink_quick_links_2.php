<?php namespace Gwf\Quicklink\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateGwfQuicklinkQuickLinks2 extends Migration
{
    public function up()
    {
        Schema::table('gwf_quicklink_quick_links', function($table)
        {
            $table->string('url', 255)->nullable()->change();
            $table->string('slug', 255)->nullable()->change();
        });
    }
    
    public function down()
    {
        Schema::table('gwf_quicklink_quick_links', function($table)
        {
            $table->string('url', 255)->nullable(false)->change();
            $table->string('slug', 255)->nullable(false)->change();
        });
    }
}
