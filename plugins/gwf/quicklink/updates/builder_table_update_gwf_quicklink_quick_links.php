<?php namespace Gwf\Quicklink\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateGwfQuicklinkQuickLinks extends Migration
{
    public function up()
    {
        Schema::table('gwf_quicklink_quick_links', function($table)
        {
            $table->integer('activationstatus');
            $table->increments('id')->unsigned(false)->change();
        });
    }
    
    public function down()
    {
        Schema::table('gwf_quicklink_quick_links', function($table)
        {
            $table->dropColumn('activationstatus');
            $table->increments('id')->unsigned()->change();
        });
    }
}
