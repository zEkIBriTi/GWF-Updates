<?php namespace Flosch\Slideshow\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateFloschSlideshowSlideshows extends Migration
{
    public function up()
    {
        Schema::table('flosch_slideshow_slideshows', function($table)
        {
            $table->boolean('active')->default(0);
        });
    }
    
    public function down()
    {
        Schema::table('flosch_slideshow_slideshows', function($table)
        {
            $table->dropColumn('active');
        });
    }
}
