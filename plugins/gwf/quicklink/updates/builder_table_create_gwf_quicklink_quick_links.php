<?php namespace Gwf\Quicklink\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateGwfQuicklinkQuickLinks extends Migration
{
    public function up()
    {
        Schema::create('gwf_quicklink_quick_links', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title', 255);
            $table->string('url', 255);
            $table->string('slug', 255);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('gwf_quicklink_quick_links');
    }
}
